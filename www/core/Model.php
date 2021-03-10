<?php

namespace core;

use core\Dao;

class Model{

    //判断是否登录
    public static function Login(){
        @session_start();
        return isset($_SESSION['user_login']);
    }

    //执行数据库查询指令方法
    protected static function SqlQuery($sql, $all = 0){
        global $config;
        $result = new Dao($config['database']);
        //1代表查询多个内容，其他代表查询单个内容
        if($all == 1){
            return $result->DaoQuery($sql,true);
        }else{
            return $result->DaoQuery($sql,false);
        }
    }

    //执行数据库更新指令方法
    protected static function SqlUpdate($sql){
        global $config;
        $result = new Dao($config['database']);
        return $result->DaoExec($sql);
    }

    //获取时间方法
    public static function TimeTran($the_time) {
        $now_time = date("Y-m-d H:i:s", time());
        $now_time = strtotime($now_time);
        $show_time = strtotime($the_time);
        $t = $now_time - $show_time;
        $f=array(
            '31536000'=>'年',
            '2592000'=>'个月',
            '604800'=>'星期',
            '86400'=>'天',
            '3600'=>'小时',
            '60'=>'分钟',
            '1'=>'秒'
        );
        foreach ($f as $k=>$v){
            if (0 !=$c=floor($t/(int)$k)) {
                return $c.$v.'前';
            }
        }
    }

    //判断用户是否登录
    public static function IsLogin($str){
        $LOGIN = self::Login();
        if(!$LOGIN){
            echo 'user-login';
        }else{
            echo $str;
        }
    }



}

?>