<?php

//命名空间
namespace admin\controller;

use model\UserMeta;
use model\SiteMeta;
use core\SendMail;

class IndexController{

    public function __construct(){
        if(!in_array(A,get_class_methods(__CLASS__))) header('location:' . HOME_URL);
    }

    //判断进入页面
    public static function index(){
        //判定是否有权限：当前只判定是否属于权限模块（index\check\captcha）
        if( UserMeta::Login() ){
            if(UserMeta::IsAdmin() === 'administrator'){
                global $LOGINUSER;
                $LOGIN = UserMeta::Login();
                if($LOGIN){
                    global $LOGINUSER;
                    @session_start();
                    $LOGINUSER = $_SESSION['user_login'];
                }
                require ADMIN_VIEW . 'mod/header.php';
                if(isset($_GET['page']) && $_GET['page'] === 'SiteMeta'){
                    require ADMIN_VIEW . 'page/' . $_GET['page'] . '.php';
                }elseif(isset($_GET['page']) && $_GET['page'] === 'HomeLayout'){
                    require ADMIN_VIEW . 'page/' . $_GET['page'] . '.php';
                }elseif(isset($_GET['page']) && $_GET['page'] === 'Email'){
                    require ADMIN_VIEW . 'page/' . $_GET['page'] . '.php';
                }elseif(isset($_GET['page']) && $_GET['page'] === 'CreditStrategy'){
                    require ADMIN_VIEW . 'page/' . $_GET['page'] . '.php';
                }elseif(isset($_GET['page']) && $_GET['page'] === 'FooterMeta'){
                    require ADMIN_VIEW . 'page/' . $_GET['page'] . '.php';
                }else{
                    require ADMIN_VIEW . 'page/index.php';
                }
                require ADMIN_VIEW . 'mod/footer.php';
                exit();
            }else{
                header('location:' . HOME_URL );
                exit();
            }
        }
        //先登录
        header('location:' . HOME_URL . '?a=ShowLogin');
    }

    //更新用户数据
    public static function UpdateSiteMeta(){
        header( 'content-type: application/json; charset=utf-8' );
        //接收数据
        $_POST['SiteMeta']['site_name'] = isset($_POST['SiteMeta']['site_name']) ? trim($_POST['SiteMeta']['site_name']) : '';
        $_POST['SiteMeta']['site_logo'] = isset($_POST['SiteMeta']['site_logo']) ? trim($_POST['SiteMeta']['site_logo']) : '';
        $_POST['SiteMeta']['site_header_img']  = isset($_POST['SiteMeta']['site_header_img']) ? trim($_POST['SiteMeta']['site_header_img']) : '';
        $_POST['SiteMeta']['site_icon']  = isset($_POST['SiteMeta']['site_icon']) ? trim($_POST['SiteMeta']['site_icon']) : '';
        $_POST['SiteMeta']['site_desc']  = isset($_POST['SiteMeta']['site_desc']) ? trim($_POST['SiteMeta']['site_desc']) : '';
        $_POST['SiteMeta']['site_keyword']  = isset($_POST['SiteMeta']['site_keyword']) ? trim($_POST['SiteMeta']['site_keyword']) : '';
        $_POST['SiteMeta']['site_lazy_img']  = isset($_POST['SiteMeta']['site_lazy_img']) ? trim($_POST['SiteMeta']['site_lazy_img']) : '';
        $_POST['SiteMeta']['site_default_avatar']  = isset($_POST['SiteMeta']['site_default_avatar']) ? trim($_POST['SiteMeta']['site_default_avatar']) : '';
        $_POST['SiteMeta']['site_login_notice']  = isset($_POST['SiteMeta']['site_login_notice']) ? trim($_POST['SiteMeta']['site_login_notice']) : '';
        $_POST['SiteMeta']['site_header_notice']  = isset($_POST['SiteMeta']['site_header_notice']) ? trim($_POST['SiteMeta']['site_header_notice']) : '';
        $_POST['SiteMeta']['site_footer_meta']  = isset($_POST['SiteMeta']['site_footer_meta']) ? trim($_POST['SiteMeta']['site_footer_meta']) : '';

        //网站名称
        if(empty($_POST['SiteMeta']['site_name'])){
            //不对：应该重来
            $result['message']	= '网站名称为空';
            $result['code']	= 0;
            echo json_encode( $result );
            exit();
        }
        //网站logo
        if(empty($_POST['SiteMeta']['site_logo'])){
            //不对：应该重来
            $result['message']	= '网站logo为空';
            $result['code']	= 0;
            echo json_encode( $result );
            exit();
        }
        //网站头部图片
        if(empty($_POST['SiteMeta']['site_header_img'])){
            //不对：应该重来
            $result['message']	= '网站头部图片为空';
            $result['code']	= 0;
            echo json_encode( $result );
            exit();
        }
        //网站icon
        if(empty($_POST['SiteMeta']['site_icon'])){
            //不对：应该重来
            $result['message']	= '网站icon为空';
            $result['code']	= 0;
            echo json_encode( $result );
            exit();
        }
        //网站描述
        if(empty($_POST['SiteMeta']['site_desc'])){
            //不对：应该重来
            $result['message']	= '网站描述为空';
            $result['code']	= 0;
            echo json_encode( $result );
            exit();
        }
        //网站关键词
        if(empty($_POST['SiteMeta']['site_keyword'])){
            //不对：应该重来
            $result['message']	= '网站关键词为空';
            $result['code']	= 0;
            echo json_encode( $result );
            exit();
        }
        //网站懒加载图片
        if(empty($_POST['SiteMeta']['site_lazy_img'])){
            //不对：应该重来
            $result['message']	= '网站懒加载图片为空';
            $result['code']	= 0;
            echo json_encode( $result );
            exit();
        }
        //用户默认头像
        if(empty($_POST['SiteMeta']['site_default_avatar'])){
            //不对：应该重来
            $result['message']	= '用户默认头像为空';
            $result['code']	= 0;
            echo json_encode( $result );
            exit();
        }
        //登录公告
        if(empty($_POST['SiteMeta']['site_login_notice'])){
            //不对：应该重来
            $result['message']	= '登录公告为空';
            $result['code']	= 0;
            echo json_encode( $result );
            exit();
        }
        //首页公告
        if(empty($_POST['SiteMeta']['site_header_notice'])){
            //不对：应该重来
            $result['message']	= '首页公告为空';
            $result['code']	= 0;
            echo json_encode( $result );
            exit();
        }
        //网站底部信息
        if(empty($_POST['SiteMeta']['site_footer_meta'])){
            //不对：应该重来
            $result['message']	= '网站底部信息为空';
            $result['code']	= 0;
            echo json_encode( $result );
            exit();
        }

        $SiteMeta = isset($_POST['SiteMeta']) ? addslashes(json_encode($_POST['SiteMeta'])) : '';

        $sql = @SiteMeta::GetSiteMeta('SiteMeta') ? "update pink_site_meta set site_value = '{$SiteMeta}' where site_key = 'SiteMeta';" : "insert into pink_site_meta (site_value,site_key) values('{$SiteMeta}','SiteMeta');";
        SiteMeta::UpdateSiteMeta($sql);
        $result['message']	= '修改成功';
        $result['code']	= 1;
        echo json_encode( $result );
        exit();
    }

    //更新邮件设置
    public static function UpdateSmtpMeta(){
        header( 'content-type: application/json; charset=utf-8' );
        $SmtpMeta = $_POST['SmtpMeta'] ?? '';
        $SmtpMeta = addslashes(json_encode($SmtpMeta));
        $sql = "update pink_site_meta set site_value = '{$SmtpMeta}' where site_key = 'smtp_meta';";
        if(SiteMeta::UpdateSiteMeta($sql)){
            $result['message']	= '修改成功';
            $result['code']	= 1;
            echo json_encode( $result );
            exit();
        }else{
            $result['message']	= '修改失败';
            $result['code']	= 0;
            echo json_encode( $result );
            exit();
        }
    }

    //更新积分策略设置
    public static function UpdateCreditStrategy(){
        header( 'content-type: application/json; charset=utf-8' );
        $CreditStrategy = $_POST['CreditStrategy'] ?? '';
        $CreditStrategy = addslashes(json_encode($CreditStrategy));
        $sql = "update pink_site_meta set site_value = '{$CreditStrategy}' where site_key = 'CreditStrategy';";
        if(SiteMeta::UpdateSiteMeta($sql)){
            $result['message']	= '修改成功';
            $result['code']	= 1;
            echo json_encode( $result );
            exit();
        }else{
            $result['message']	= '修改失败';
            $result['code']	= 0;
            echo json_encode( $result );
            exit();
        }
    }

    //更新积分策略设置
    public static function UpdateFooterMeta(){
        header( 'content-type: application/json; charset=utf-8' );

        $_POST['FooterMeta']['site_footer_link'] = isset($_POST['FooterMeta']['site_footer_link']) ? trim($_POST['FooterMeta']['site_footer_link']) : '';
        $_POST['FooterMeta']['site_footer_bullhorn'] = isset($_POST['FooterMeta']['site_footer_bullhorn']) ? trim($_POST['FooterMeta']['site_footer_bullhorn']) : '';
        $_POST['FooterMeta']['site_footer_about'] = isset($_POST['FooterMeta']['site_footer_about']) ? trim($_POST['FooterMeta']['site_footer_about']) : '';
        $_POST['FooterMeta']['site_footer_callus'] = isset($_POST['FooterMeta']['site_footer_callus']) ? trim($_POST['FooterMeta']['site_footer_callus']) : '';

        //登录公告
        if(empty($_POST['FooterMeta']['site_footer_link'])){
            //不对：应该重来
            $result['message']	= '登录公告为空';
            $result['code']	= 0;
            echo json_encode( $result );
            exit();
        }

        //登录公告
        if(empty($_POST['FooterMeta']['site_footer_bullhorn'])){
            //不对：应该重来
            $result['message']	= '登录公告为空';
            $result['code']	= 0;
            echo json_encode( $result );
            exit();
        }

        //登录公告
        if(empty($_POST['FooterMeta']['site_footer_about'])){
            //不对：应该重来
            $result['message']	= '登录公告为空';
            $result['code']	= 0;
            echo json_encode( $result );
            exit();
        }

        //登录公告
        if(empty($_POST['FooterMeta']['site_footer_callus'])){
            //不对：应该重来
            $result['message']	= '登录公告为空';
            $result['code']	= 0;
            echo json_encode( $result );
            exit();
        }

        $FooterMeta = isset($_POST['FooterMeta']) ? $_POST['FooterMeta'] : '';
        $FooterMeta = addslashes(json_encode($FooterMeta));

        $sql = @SiteMeta::GetSiteMeta('FooterMeta') ? "update pink_site_meta set site_value = '{$FooterMeta}' where site_key = 'FooterMeta';" : "insert into pink_site_meta (site_value,site_key) values('{$FooterMeta}','FooterMeta');";
        if(SiteMeta::UpdateSiteMeta($sql)){
            $result['message']	= '修改成功';
            $result['code']	= 1;
            echo json_encode( $result );
            exit();
        }else{
            $result['message']	= '修改失败';
            $result['code']	= 0;
            echo json_encode( $result );
            exit();
        }
    }

    //更新首页cms布局
//    public static function UpdateHomeLayout(){
//        $MenuMeta = $_POST['HomeLayout'] ?? '';
//        $sql = "update pink_site_meta set site_value = '{$MenuMeta}' where site_key = 'home_cms';";
//        UserMeta::UpdateSiteMeta($sql);
//        $result['message']	= '更新成功';
//        $result['code']	= 1;
//        echo json_encode( $result );
//        exit();
//    }

}


?>