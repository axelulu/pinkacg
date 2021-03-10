<?php

//命名空间
namespace home\controller;

use model\HeadFooder;
use model\PostMeta;
use model\Menu;

class IndexController{

    public function __construct(){
        if(!in_array(A,get_class_methods(__CLASS__))) header('location:' . HOME_URL);
    }

    //初始化公共变量
    private static function GlobalEle($url){
        global $LOGIN,$SiteHeadMeta;
        $SiteHeadMeta = HeadFooder::SiteHeadMeta();
        $LOGIN = PostMeta::Login();
        if($LOGIN){
            global $LOGINUSER;
            @session_start();
            $LOGINUSER = $_SESSION['user_login'];
        }
        require HOME_VIEW . 'mod/header.php';
        require HOME_VIEW . $url;
        require HOME_VIEW . 'mod/footer.php';
    }

    //进入网站首页
    public static function index(){
        if(isset($_GET['id']) && $_GET['id'] != 0 && PostMeta::GetPostMeta((int)$_GET['id'])){
            //文章页面加载
            $PostId = (int)$_GET['id'];
            define('PostId',$PostId);
            self::GlobalEle('page/post.php');
            exit();
        }elseif(isset($_GET['m']) && Menu::GetMenuTitle(trim($_GET['m']),true)){
            //分类页面加载
            $Category = trim($_GET['m']);
            define('Category',$Category);
            self::GlobalEle('page/category.php');
            exit();
        }elseif(isset($_GET['s'])){
            //搜索页面加载
            $Search = trim($_GET['s']);
            define('Search',$Search);
            self::GlobalEle('page/search.php');
            exit();
        }elseif(isset($_POST['url'])){
            //文章内容ajax加载
            $Ajax = trim($_POST['url']);
            //载入ajax文件
            require HOME_VIEW . 'action/' . $Ajax;
            exit();
        }elseif(isset($_POST['UserCenterAjax'])){
            //用户中心菜单ajax加载
            $Ajax = trim($_POST['UserCenterAjax']);
            //载入ajax文件
            require HOME_VIEW . 'user/' . $Ajax . '.php';
            exit();
        }else{
            self::GlobalEle('page/index.php');
        }
    }

    //弹出登录窗口
    public static function ShowLogin(){
        self::GlobalEle('page/index.php');
        echo '<script type="text/javascript">$(document).ready(function(){$(".user-login").trigger("click");});</script>';
    }
}

?>