<?php

namespace core;

date_default_timezone_set("Asia/Shanghai");   //设置时区

if(!defined('ACCESS')){
    //非法访问
    header('location:../public/index.php');
    exit();
}

//初始化类
class App{
    public static function start(){
        //路径常量
        self::set_path();
        //系统设置
        self::set_error();
        //配置文件
        self::set_config();
        //url解析
        self::set_url();
        //自动加载class
        self::set_autoload();
        //分发控制器
        self::set_dispatch();
    }

    //路径常量方法
    private static function set_path(){
        //定义不同路径常量：核心目录、App目录、控制器目录、模型目录、视图目录、扩展目录
        define('CORE_PATH',		ROOT_PATH . 'core/');
        define('APP_PATH',		ROOT_PATH . 'app/');
        define('APP_MODEL',		APP_PATH . 'model/');
        define('HOME_PATH',		APP_PATH . 'home/');
        define('ADMIN_PATH',	APP_PATH . 'admin/');
        define('ADMIN_CONT',	ADMIN_PATH . 'controller/');
        define('ADMIN_VIEW',	ADMIN_PATH . 'view/');			//如果使用Smarty加载，意义不大
        define('HOME_CONT',		HOME_PATH . 'controller/');
        define('HOME_VIEW',		HOME_PATH . 'view/');
        define('VENDOR_PATH',	ROOT_PATH . 'vendor/');
        define('CONFIG_PATH',	ROOT_PATH . 'config/');
        define('HOME_URL', 'http://' . $_SERVER["HTTP_HOST"] . '/');
        define('URL', 'http://' . $_SERVER["HTTP_HOST"] . '/');
        define('HOME_AJAX',	HOME_URL . '?action=ajax');
        //如果框架设计够大够全，还有一些目录常量需要配置
    }

    //读取配置文件
    private static function set_config(){
        global $config;
        $config = include CONFIG_PATH . 'config.php';
    }

    //设置错误模式
    private static function set_error(){
        global $config;
        @ini_set('error_reporting', $config['ini_set']['error_reporting']);
        @ini_set('displary_errors', $config['ini_set']['displary_errors']);
    }

    //解析URL
    private static function set_url(){
        //获取前后台、控制器名字和方法名字：规定浏览器参数中携带p参数、c参数和a参数（p代表platform平台，c代表controller，a代表action）
        $p = $_REQUEST['p'] ?? 'home';			//默认前台
        $c = $_REQUEST['c'] ?? 'Index';			//默认IndexController
        $a = $_REQUEST['a'] ?? 'index';			//默认index方法

        //暂时只是解析，不分发，考虑到后续还要使用，设定为常量
        define('P',$p);
        define('C',$c);
        define('A',$a);
    }

    //四种不同文件夹的类加载方法
    private static function set_autoload_function($classname){
        //此时$class不只是类名，是带着空间的，所以只保留类名
        $classname = str_replace('\\', '/', $classname);
        $class = basename($classname);
        //核心类加载
        $path = CORE_PATH . $class. '.php';				//核心类全路径
        if(file_exists($path)){
            include_once $path;
        }

        //前台控制器和模型加载
        if(P == 'home'){
            $path = HOME_CONT . $class . '.php';
            if(file_exists($path)){
                include_once $path;
            }

        }else{
            //后台
            $path = ADMIN_CONT . $class . '.php';
            if(file_exists($path)){
                include_once $path;
            }

        }

        //
        $path = APP_MODEL . $class . '.php';
        if(file_exists($path)){
            include_once $path;
        }

        //外部类加载
        $path = VENDOR_PATH . $class . '.php';
        if(file_exists($path)){
            include_once $path;
        }

        //如果都加载不到，就让系统报错
    }

    //新建一个方法，让个性化的自动加载注册到自动加载机制
    private static function set_autoload(){
        spl_autoload_register(array(__CLASS__,'set_autoload_function'));
    }

    //分发控制器
    private static function set_dispatch(){
        //分发之前要找到对应的控制器名字和方法名字
        $p = P;
        $c = C;
        $a = A;

        //我们后面会规定控制器必须带Controller名字结尾，模型必须带Model结尾，即IndexController，所以需要补充名字
        $c .= 'Controller';					//控制器全名

        //注意有命名空间，所以访问上要使用空间访问
        $spacename = "\\$p\\controller\\$c";
        if(P !== 'home' && P !== 'admin' || !class_exists($spacename)){
            header('location:' . HOME_URL);
            exit();
        }
        $spacename::$a();
    }
}

?>