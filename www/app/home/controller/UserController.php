<?php

namespace home\controller;

use core\SendMail;
use model\Comment;
use model\HeadFooder;
use model\SiteMeta;
use model\UserCenterMsg;
use model\UserCenterNotice;
use model\UserCenterSetting;
use model\UserMeta;
use model\PostMeta;
use model\UserCenterAddPost;

class UserController{

    //初始化公共变量
    private static function GlobalEle($url){
        global $LOGIN;
        $SiteHeadMeta = HeadFooder::SiteHeadMeta();
        $LOGIN = SiteMeta::Login();
        if($LOGIN){
            global $LOGINUSER;
            @session_start();
            $LOGINUSER = $_SESSION['user_login'];
        }

        //载入网页模块
        require HOME_VIEW . 'mod/header.php';
        echo "<div class='main'><div class='clearfix container setting'>";
        require HOME_VIEW . 'user/aside.php';
        echo '<div class="col-lg-10 float-right setting_box">';
        require HOME_VIEW . $url;
        echo '</div></div></div>';
        require HOME_VIEW . 'mod/footer.php';
    }

    //用户中心入口（防用户瞎输入参数）
    public static function index(){
        if(SiteMeta::Login()):
            if(isset($_GET['m']) && trim($_GET['m']) === 'setting'){
                self::GlobalEle('user/setting.php');
            }elseif(isset($_GET['m']) && trim($_GET['m']) === 'drafts'){
                self::GlobalEle('user/drafts.php');
            }elseif(isset($_GET['m']) && trim($_GET['m']) === 'editpost'){
                self::GlobalEle('user/editpost.php');
            }elseif(isset($_GET['m']) && trim($_GET['m']) === 'newpost'){
                self::GlobalEle('user/newpost.php');
            }elseif(isset($_GET['m']) && trim($_GET['m']) === 'notice'){
                self::GlobalEle('user/notice.php');
            }elseif(isset($_GET['m']) && trim($_GET['m']) === 'msg'){
                self::GlobalEle('user/msg.php');
            }elseif(isset($_GET['m']) && trim($_GET['m']) === 'orders'){
                self::GlobalEle('user/orders.php');
            }elseif(isset($_GET['m']) && trim($_GET['m']) === 'stars'){
                self::GlobalEle('user/stars.php');
            }elseif(isset($_GET['m']) && trim($_GET['m']) === 'posts'){
                self::GlobalEle('user/posts.php');
            }elseif(isset($_GET['m']) && trim($_GET['m']) === 'fans'){
                self::GlobalEle('user/fans.php');
            }elseif(isset($_GET['m']) && trim($_GET['m']) === 'vip'){
                self::GlobalEle('user/vip.php');
            }elseif(isset($_GET['m']) && trim($_GET['m']) === 'cash'){
                self::GlobalEle('user/cash.php');
            }elseif(isset($_GET['m']) && trim($_GET['m']) === 'credits'){
                self::GlobalEle('user/credit.php');
            }elseif(isset($_GET['m']) && trim($_GET['m']) === 'shop'){
                self::GlobalEle('user/fans.php');
            }elseif(isset($_GET['m']) && trim($_GET['m']) === 'price'){
                self::GlobalEle('user/fans.php');
            }else{
                header('location:' . HOME_URL);
            }
        else:
            header('location:' . HOME_URL);
        endif;
    }

    //更新用户头像
    public static function UpdateAvatar(){
        header( 'content-type: application/json; charset=utf-8' );
        $UserId = $_POST['userid'] ?? '';
        $Image = $_FILES['file'] ?? '';

        //判断用户权限
        if(!SiteMeta::Login()){
            $result['message']	= '未登录';
            $result['code']	= 0;
            echo json_encode( $result );
            exit();
        }

        //判断积分是否足够
        if(UserMeta::GetAuthorMeta($UserId)['user_credit'] < 0){
            $result['message']	= '积分不足';
            $result['code']	= 0;
            echo json_encode( $result );
            exit();
        }

        if(!empty($UserId) && !empty($Image) && UserCenterSetting::UploadAvatar($UserId,$Image,$error)){

            //忘记密码通知用户
            UserCenterNotice::AddUserNotice($UserId,'N_Avatar');

            $result['message']	= '上传成功';
            $result['code']	= 1;
            echo json_encode( $result );
            exit();
        }else{
            $error = $error ?? '上传失败';
            $result['message']	= $error;
            $result['code']	= 0;
            echo json_encode( $result );
            exit();
        }
    }

    //更新用户详细信息
    public static function UpdateUserMsg(){
        header( 'content-type: application/json; charset=utf-8' );
        $UserId = $_POST['UserId'] ?? '';
        $UserMeta = $_POST['UserMeta'] ?? '';

        //判断用户权限
        if(!SiteMeta::Login()){
            $result['message']	= '未登录';
            $result['code']	= 0;
            echo json_encode( $result );
            exit();
        }

        //更新用户信息
        if(!empty($UserMeta) && UserCenterSetting::UpdateUserMeta($UserId,$UserMeta)){
            $result['message']	= '更新成功';
            $result['code']	= 1;
            echo json_encode( $result );
            exit();
        }else{
            $result['message']	= '更新失败';
            $result['code']	= 0;
            echo json_encode( $result );
            exit();
        }
    }

    //登陆验证用户信息
    public static function Check(){
        header( 'content-type: application/json; charset=utf-8' );
        //接收数据
        $username = isset($_POST['username']) ? trim($_POST['username']) : '';
        $password = isset($_POST['password']) ? trim($_POST['password']) : '';
        $captcha  = isset($_POST['captcha']) ? trim($_POST['captcha']) : '';

        //合法性验证
        if(empty($username) || empty($password)){
            //不对：应该重来
            $result['message']	= '用户名或密码空';
            $result['code']	= 0;
            echo json_encode( $result );
            exit();
        }

        //验证验证码的合法性
//        if(empty($captcha)){
//            exit();
//        }


        //验证验证码的有效性
//        if(!\vendor\Captcha::checkCaptcha($captcha)){
//            //验证码不匹配
//            $result['message']	= '登录失败';
//            $result['code']	= 1;
//            echo json_encode( $result );
//            exit();
//        }

        //验证用户名是否存在：调用模型
        $user = UserMeta::GetUserByUsername($username);

        //判定用户是否存在
        if(!$user){
            //用户名不存在
            $result['message']	= '用户名不存在';
            $result['code']	= 0;
            echo json_encode( $result );
            exit();
        }

        //用户密码验证
        if( !password_verify($password, $user['user_pass']) ){
            //密码不正确
            $result['message']	= '密码错误';
            $result['code']	= 0;
            echo json_encode( $result );
            exit();
        }

        //将用户登录后的信息保存到session中
        @session_start();
        $_SESSION['user_login'] = $user;

        //7天免登录
        if(isset($_POST['rememberMe'])){
            //用户选择了记住用户信息
            setcookie('rememberMe',$user['ID'],time() + 7 * 24 * 3600);
        }

        //登录成功：跳转到首页
        $result['message']	= '登录成功';
        $result['code']	= 1;
        echo json_encode( $result );
    }

    //随机生成六位数验证码
    public static function GenerateCode($length = 6) {
        $min = pow(10 , ($length - 1));
        $max = pow(10, $length) - 1;
        return rand($min, $max);
    }

    //注册时获取验证码
    public static function GetRegCode(){
        header( 'content-type: application/json; charset=utf-8' );
        //接收数据
        $password = isset($_POST['password']) ? trim($_POST['password']) : '';
        $username = isset($_POST['username']) ? trim($_POST['username']) : '';
        $email  = isset($_POST['email']) ? trim($_POST['email']) : '';

        //合法性验证
        if(empty($email) || empty($password)){
            //不对：应该重来
            $result['message']	= '邮箱或密码空';
            $result['code']	= 0;
            echo json_encode( $result );
            exit();
        }

        //检查邮箱是否存在
        if(UserMeta::GetUserByEmail($email)){
            //不对：应该重来
            $result['message']	= '邮箱已存在';
            $result['code']	= 0;
            echo json_encode( $result );
            exit();
        }

        //检查用户名是否存在
        if(UserMeta::GetUserByUsername($username)){
            //不对：应该重来
            $result['message']	= '用户名已存在';
            $result['code']	= 0;
            echo json_encode( $result );
            exit();
        }

        //发送验证码
        $RegCode = self::GenerateCode(6);
        @session_start();
        $_SESSION['RegCode'] = $RegCode;
        //发送邮件
        $SendMail = new SendMail();
        $state = $SendMail->SendMsg($email,$RegCode,'reg');
        if($state == 1){
            $result['message']	= '发送成功';
            $result['code']	= 1;
            echo json_encode( $result );
            exit();
        }
        $result['message']	= '发送失败';
        $result['code']	= 0;
        echo json_encode( $result );
        exit();
    }

    //用户注册
    public static function Reg(){
        header( 'content-type: application/json; charset=utf-8' );
        //接收数据
        $username = isset($_POST['username']) ? trim($_POST['username']) : '';
        $password = isset($_POST['password']) ? trim($_POST['password']) : '';
        $email  = isset($_POST['email']) ? trim($_POST['email']) : '';
        $veriCode  = isset($_POST['veriCode']) ? trim($_POST['veriCode']) : '';

        //合法性验证
        if(empty($username) || empty($password)){
            //不对：应该重来
            $result['message']	= '用户名或密码空';
            $result['code']	= 0;
            echo json_encode( $result );
            exit();
        }

        if(empty($email)){
            $result['message']	= '邮箱空';
            $result['code']	= 0;
            echo json_encode( $result );
            exit();
        }

        if(empty($veriCode)){
            $result['message']	= '验证码空';
            $result['code']	= 0;
            echo json_encode( $result );
            exit();
        }

        //检查邮箱是否存在
        if(UserMeta::GetUserByEmail($email)){
            //不对：应该重来
            $result['message']	= '邮箱已存在';
            $result['code']	= 0;
            echo json_encode( $result );
            exit();
        }

        //检查用户名是否存在
        if(UserMeta::GetUserByUsername($username)){
            //不对：应该重来
            $result['message']	= '用户名已存在';
            $result['code']	= 0;
            echo json_encode( $result );
            exit();
        }

        @session_start();
        $RegCode = $_SESSION['RegCode'];
        unset($_SESSION['RegCode']);
        if($veriCode != $RegCode){
            $result['message']	= '验证码错误';
            $result['code']	= 0;
            echo json_encode( $result );
            exit();
        }
        $AddUser = UserMeta::AddUser($username,$email,$password);
        if($AddUser){
            //验证用户名是否存在：调用模型
            $user = UserMeta::GetUserByUsername($username);

            //将用户登录后的信息保存到session中
            @session_start();
            $_SESSION['user_login'] = $user;

            //注册成功通知用户
            UserCenterNotice::AddUserNotice($user['ID'],'N_Reg');

            //注册成功
            $result['message']	= '注册成功';
            $result['code']	= 1;
            echo json_encode( $result );
            exit();
        }

        $result['message']	= '注册失败';
        $result['code']	= 0;
        echo json_encode( $result );
        exit();
    }

    //忘记密码
    public static function ForgetPass(){
        header( 'content-type: application/json; charset=utf-8' );
        //接收数据
        $password = isset($_POST['password']) ? trim($_POST['password']) : '';
        $email  = isset($_POST['email']) ? trim($_POST['email']) : '';
        $veriCode  = isset($_POST['veriCode']) ? trim($_POST['veriCode']) : '';

        //合法性验证
        if(empty($email) || empty($password)){
            //不对：应该重来
            $result['message']	= '邮箱或密码空';
            $result['code']	= 0;
            echo json_encode( $result );
            exit();
        }

        //检查邮箱是否存在
        if(!UserMeta::GetUserByEmail($email)){
            //不对：应该重来
            $result['message']	= '邮箱已存在';
            $result['code']	= 0;
            echo json_encode( $result );
            exit();
        }

        //判断积分是否足够
        if(UserMeta::GetUserByEmail($email)['user_credit'] < 0){
            $result['message']	= '积分不足';
            $result['code']	= 0;
            echo json_encode( $result );
            exit();
        }

        @session_start();
        $ForgetCode = $_SESSION['ForgetCode'];
        unset($_SESSION['ForgetCode']);
        if($veriCode != $ForgetCode){
            $result['message']	= '验证码错误';
            $result['code']	= 0;
            echo json_encode( $result );
            exit();
        }
        $AddUser = UserMeta::AlterUserPass($email,$password);
        if($AddUser){
            //验证用户名是否存在：调用模型
            $user = UserMeta::GetUserByEmail($email);

            //将用户登录后的信息保存到session中
            @session_start();
            $_SESSION['user_login'] = $user;

            //忘记密码通知用户
            UserCenterNotice::AddUserNotice($user['ID'],'N_ForgetPwd');

            //修改成功
            $result['message']	= '修改成功';
            $result['code']	= 1;
            echo json_encode( $result );
            exit();
        }

        $result['message']	= '修改失败';
        $result['code']	= 0;
        echo json_encode( $result );
        exit();
    }

    //忘记密码时获取验证码
    public static function GetForgetCode(){
        header( 'content-type: application/json; charset=utf-8' );
        //接收数据
        $password = isset($_POST['password']) ? trim($_POST['password']) : '';
        $email  = isset($_POST['email']) ? trim($_POST['email']) : '';

        //合法性验证
        if(empty($email) || empty($password)){
            //不对：应该重来
            $result['message']	= '邮箱或密码空';
            $result['code']	= 0;
            echo json_encode( $result );
            exit();
        }

        //检查邮箱是否存在
        if(!UserMeta::GetUserByEmail($email)){
            //不对：应该重来
            $result['message']	= '邮箱已存在';
            $result['code']	= 0;
            echo json_encode( $result );
            exit();
        }

        //发送验证码
        $ForgetCode = self::GenerateCode(6);
        @session_start();
        $_SESSION['ForgetCode'] = $ForgetCode;
        //发送邮件
        $SendMail = new SendMail();
        $state = $SendMail->SendMsg($email,$ForgetCode,'forget');
        if($state == 1){
            $result['message']	= '发送成功';
            $result['code']	= 1;
            echo json_encode( $result );
            exit();
        }
        $result['message']	= '发送失败';
        $result['code']	= 0;
        echo json_encode( $result );
        exit();
    }

    //修改邮箱时获取验证码
    public static function GetAlterCode(){
        header('content-type:application/json;charset=utf-8');
        //接收数据
        $UserId  = isset($_POST['UserId']) ? trim($_POST['UserId']) : '';
        $Email  = isset($_POST['Email']) ? trim($_POST['Email']) : '';

        //判断用户权限
        if(!SiteMeta::Login()){
            $result['message']	= '未登录';
            $result['code']	= 0;
            echo json_encode( $result );
            exit();
        }

        //合法性验证
        if(empty($UserId)){
            //不对：应该重来
            $result['message']	= '修改失败';
            $result['code']	= 0;
            echo json_encode( $result );
            exit();
        }

        $UserMeta = UserMeta::GetUserByUserId($UserId);
        //检查用户id是否存在
        if(!$UserMeta){
            //不对：应该重来
            $result['message']	= '用户不存在';
            $result['code']	= 0;
            echo json_encode( $result );
            exit();
        }

        //检查邮箱是否存在
        if(UserMeta::GetUserByEmail($Email)){
            //不对：应该重来
            $result['message']	= '邮箱已存在';
            $result['code']	= 0;
            echo json_encode( $result );
            exit();
        }

        //发送验证码
        $AlterCode = self::GenerateCode(6);
        @session_start();
        $_SESSION['AlterCode'] = $AlterCode;
        //发送邮件
        $SendMail = new SendMail();
        $state = $SendMail->SendMsg($Email,$AlterCode,'AlterMail');
        if($state === 1){
            $result['message']	= '发送成功';
            $result['code']	= 1;
            echo json_encode( $result );
            exit();
        }

        $result['message']	= '发送失败';
        $result['code']	= 0;
        echo json_encode( $result );
        exit();
    }

    //修改用户邮箱
    public static function AlterUserEmail(){
        header( 'content-type: application/json; charset=utf-8' );
        //接收数据
        $Secure  = isset($_POST['EmailMeta']['secure']) ? trim($_POST['EmailMeta']['secure']) : '';
        $Email  = isset($_POST['EmailMeta']['email']) ? trim($_POST['EmailMeta']['email']) : '';
        $UserId  = isset($_POST['EmailMeta']['userid']) ? trim($_POST['EmailMeta']['userid']) : '';

        //判断用户权限
        if(!SiteMeta::Login()){
            $result['message']	= '未登录';
            $result['code']	= 0;
            echo json_encode( $result );
            exit();
        }

        //合法性验证
        if(empty($Email) || empty($Secure)){
            //不对：应该重来
            $result['message']	= '邮箱或验证码空';
            $result['code']	= 0;
            echo json_encode( $result );
            exit();
        }

        //检查邮箱是否存在
        if(UserMeta::GetUserByEmail($Email)){
            //不对：应该重来
            $result['message']	= '邮箱已存在';
            $result['code']	= 0;
            echo json_encode( $result );
            exit();
        }

        //判断积分是否足够
        if(UserMeta::GetAuthorMeta($UserId)['user_credit'] < 0){
            $result['message']	= '积分不足';
            $result['code']	= 0;
            echo json_encode( $result );
            exit();
        }

        @session_start();
        $AlterCode = $_SESSION['AlterCode'];
        unset($_SESSION['AlterCode']);
        if($Secure != $AlterCode){
            $result['message']	= '验证码错误';
            $result['code']	= 0;
            echo json_encode( $result );
            exit();
        }
        $AddUser = UserMeta::AlterUserEmail($Email,$UserId);
        if($AddUser){

            //修改用户邮箱通知用户
            UserCenterNotice::AddUserNotice($UserId,'N_AlterEmail');

            $result['message']	= '修改成功';
            $result['code']	= 1;
            echo json_encode( $result );
            exit();
        }

        $result['message']	= '修改失败';
        $result['code']	= 0;
        echo json_encode( $result );
        exit();
    }

    //更新用户密码
    public static function UpdateUserPass(){
        header('content-type:application/json; charset=utf-8');
        $OldPass  = isset($_POST['PassWord']['oldpwd']) ? trim($_POST['PassWord']['oldpwd']) : '';
        $NewPass  = isset($_POST['PassWord']['newpwd']) ? trim($_POST['PassWord']['newpwd']) : '';
        $NewsPass  = isset($_POST['PassWord']['new_pwd']) ? trim($_POST['PassWord']['new_pwd']) : '';
        $UserId  = isset($_POST['PassWord']['userid']) ? trim($_POST['PassWord']['userid']) : '';

        //判断用户权限
        if(!SiteMeta::Login()){
            $result['message']	= '未登录';
            $result['code']	= 0;
            echo json_encode( $result );
            exit();
        }

        if(empty($OldPass) || empty($UserId) || empty($NewPass) || empty($NewsPass)){
            $result['message'] = '密码为空';
            $result['code'] = 0;
            echo json_encode($result);
            exit();
        }

        if($NewPass != $NewsPass){
            $result['message'] = '二次密码不一样';
            $result['code'] = 0;
            echo json_encode($result);
            exit();
        }

        //判断积分是否足够
        if(UserMeta::GetAuthorMeta($UserId)['user_credit'] < 0){
            $result['message']	= '积分不足';
            $result['code']	= 0;
            echo json_encode( $result );
            exit();
        }

        $User = UserMeta::GetUserByUserId($UserId);
        if(!password_verify($OldPass, $User['user_pass'])){
            $result['message'] = '原密码输入错误';
            $result['code'] = 0;
            echo json_encode($result);
            exit();
        }

        //修改密码
        $AlterUserPass = @UserMeta::AlterUserPass($User['user_email'], $NewsPass);
        if($AlterUserPass){

            //更新用户密码通知用户
            UserCenterNotice::AddUserNotice($UserId,'N_AlterPwd');

            $result['message'] = '修改成功';
            $result['code'] = 1;
            echo json_encode($result);
            exit();
        }
        $result['message']	= '修改失败';
        $result['code']	= 0;
        echo json_encode( $result );
        exit();

    }

    //提交新文章
    public static function SubmitNewPost(){
        header('content-type:application/json;charset=utf-8');
        $PostMeta = $_POST['postmeta'] ?? '';
        $Link = $_POST['link'] ?? '';
        $Video = $_POST['video'] ?? '';
        $Music = $_POST['music'] ?? '';
        $UserId = $_POST['userid'] ?? '';

        //判断用户权限
        if(!SiteMeta::Login()){
            $result['message']	= '未登录';
            $result['code']	= 0;
            echo json_encode( $result );
            exit();
        }

        //判断内容为空
        if(!isset($PostMeta['title']) || !isset($PostMeta['meta']) || !isset($PostMeta['cat']) || !isset($PostMeta['tag'])){
            $result['message'] = '文章信息为空';
            $result['code'] = 0;
            echo json_encode($result);
            exit();
        }

        //判断积分是否足够
        if(UserMeta::GetAuthorMeta($UserId)['user_credit'] < 0){
            $result['message']	= '积分不足';
            $result['code']	= 0;
            echo json_encode( $result );
            exit();
        }

        //判断更新文章的方式
        if($PostMeta['type'] == 'newpost'){
            //判断更新的文章的类型
            if(!empty($Video)){
                //视频类型文章video
                $PostId = UserCenterAddPost::InsertPost($PostMeta,$Link,$UserId,$Video,'video');
            }elseif(!empty($Music)){
                //音乐文章类型music
                $PostId = UserCenterAddPost::InsertPost($PostMeta,$Link,$UserId,$Music,'music');
            }else{
                //普通文章类型
                $PostId = UserCenterAddPost::InsertPost($PostMeta,$Link,$UserId,null,'post');
            }
            if($PostId){

                //提交新文章通知用户
                UserCenterNotice::AddUserNotice($UserId,'N_PublishPost',$PostId);

                $result['PostUrl'] = PostMeta::GetPostUrl($PostId);
                $result['message'] = '提交成功';
                $result['code'] = 1;
                echo json_encode($result);
                exit();
            }
        }elseif($PostMeta['type'] == 'updatepost'){
            $PostId = $_POST['postmeta']['post_id'] ?? '';
            //判断更新的文章的类型
            if(!empty($Video)){
                //视频类型文章video
                $flag = UserCenterAddPost::UpdatePost($PostMeta,$Link,$UserId,$Video,'video',$PostId);
            }elseif(!empty($Music)){
                //音乐文章类型music
                $flag = UserCenterAddPost::UpdatePost($PostMeta,$Link,$UserId,$Music,'music',$PostId);
            }else{
                //普通文章类型
                $flag = UserCenterAddPost::UpdatePost($PostMeta,$Link,$UserId,null,'post',$PostId);
            }
            if($flag){

                //提交新文章通知用户
                UserCenterNotice::AddUserNotice($UserId,'N_PublishPost',$PostId);
                $result['PostUrl'] = PostMeta::GetPostUrl($PostId);
                $result['message'] = '提交成功';
                $result['code'] = 1;
                echo json_encode($result);
                exit();
            }
        }
    }

    //上传文章图片
    public static function UploadPostImg(){
        header( 'content-type: application/json; charset=utf-8' );
        $UserId = $_POST['userid'] ?? '';
        $Image = $_FILES['file'] ?? '';

        //判断用户权限
        if(!SiteMeta::Login()){
            $result['message']	= '未登录';
            $result['code']	= 0;
            echo json_encode( $result );
            exit();
        }

        //上传图片
        if(!empty($UserId) && !empty($Image) && $pic = UserCenterAddPost::UploadPostImg($UserId,$Image,$error)){
            $result['message']	= '上传成功';
            $result['pic']	= $pic;
            $result['code']	= 1;
            echo json_encode( $result );
            exit();
        }else{
            $error = $error ?? '上传失败';
            $result['message']	= $error;
            $result['code']	= 0;
            echo json_encode( $result );
            exit();
        }
    }

    //用户每日签到
    public static function SignDaily(){
        header("content-type: application/json; charset=utf-8");
        $UserId = $_POST['userid'] ?? '';
        $FirstSign = UserMeta::GetFirstUserSignDaily();

        //判断用户权限
        if(!SiteMeta::Login()){
            $result['msg']	= '未登录';
            $result['name']	= $FirstSign['display_name'];
            $result['time']	= date('Y-m-d H:i:s',$FirstSign['sign_daily']);
            $result['code']	= 0;
            echo json_encode( $result );
            exit();
        }

        if(!$FirstSign){
            $FirstSign = array();
            $FirstSign['display_name'] = '您自己';
            $FirstSign['sign_daily'] = time();
        }

        //判断积分是否足够
        if(UserMeta::GetAuthorMeta($UserId)['user_credit'] < 0){
            $result['msg']	= '积分不足';
            $result['name']	= $FirstSign['display_name'];
            $result['time']	= date('Y-m-d H:i:s',$FirstSign['sign_daily']);
            $result['code']	= 0;
            echo json_encode( $result );
            exit();
        }

        if(UserMeta::IsFirstUserSignDaily($UserId)){
            $result['msg']	= '您今天已签到';
            $result['name']	= $FirstSign['display_name'];
            $result['time']	= date('Y-m-d H:i:s',$FirstSign['sign_daily']);
            $result['code']	= 0;
        }else{
            UserMeta::AlterUserSignDaily($UserId);

            //每日签到通知用户
            UserCenterNotice::AddUserNotice($UserId,'N_SignDaily');

            $result['msg']	= '签到成功';
            $result['name']	= $FirstSign['display_name'];
            $result['time']	= date('Y-m-d H:i:s',$FirstSign['sign_daily']);
            $result['code']	= 1;
        }
        echo json_encode( $result );
    }

    //增加消息会话
    public static function AddMsgList(){
        header("content-type: application/json; charset=utf-8");
        $sender_id = $_POST['userid'] ?? '';
        $receiver_id = $_POST['send_id'] ?? '';

        //判断用户权限
        if(!SiteMeta::Login()){
            $result['message']	= '未登录';
            $result['code']	= 0;
            echo json_encode( $result );
            exit();
        }

        if(empty($receiver_id)){
            $result['message']	= '接受者id错误';
            $result['code']	= 0;
            echo json_encode( $result );
            exit();
        }
        if(!UserMeta::GetUserByUserId($receiver_id)){
            $result['message']	= '接受者id不存在';
            $result['code']	= 0;
            echo json_encode( $result );
            exit();
        }
        if(empty($sender_id) && self::Login()){
            $result['message']	= '用户id为空';
            $result['code']	= 0;
            echo json_encode( $result );
            exit();
        }

        if($sender_id == $receiver_id){
            $result['message']	= '无法与自己发送消息';
            $result['code']	= 0;
            echo json_encode( $result );
            exit();
        }

        if(UserCenterMsg::IsMsgList($sender_id,$receiver_id)){
            $result['message']	= '会话已存在';
            $result['code']	= 0;
            echo json_encode( $result );
            exit();
        }

        UserCenterMsg::SubmitNewMsgList($sender_id,$receiver_id);

        $time = date('Y-m-d H:i:s');

        $conversation = '';
        foreach(UserCenterMsg::GetAllMsgByUserId($sender_id) as $AllMsg) {
            $UserId = $AllMsg['sender_id'];
            $conversation .= '<div class=" ghost_msg_list">
                                <a class="ghost_msg_list_thumbnail" href="' . HOME_URL . 'author/' . $UserId . '" target="_blank">
                                    <img title="junjie.gao" alt="' . UserMeta::GetAuthorMeta($UserId)['display_name'] . '" class="ghost_msg_list_thumbnail_avatar_img" src="' . UserMeta::GetAuthorMeta($UserId)['user_avatar'] . '" width="40" height="40"></a>
                                <div class="ghost_msg_list_body">
                                    <div class="ghost_msg_list_meta">
                                        <span class="ghost_msg_list_meta_item ghost_msg_list_meta_name">' . UserMeta::GetAuthorMeta($UserId)['display_name'] . '</span>
                                        <span class="ghost_msg_list_meta_item ghost_msg_list_meta_uid">(uid:' . $UserId . ')</span>
                                        <span class="ghost_msg_list_meta_item ghost_msg_list_meta_date">' . UserMeta::TimeTran($time) . '</span></div>
                                    <div class="ghost_msg_list_content">' . $AllMsg['msg_content'] . '</div></div>
                            </div>';
        }

        $result['message']	= '发送成功';
        $result['code']	= 1;
        $result['user_msg']	= '<div class="ghost_msg_nav_item is-active">
                                <a class="ghost_msg_nav_item_author_link change_user_content" data-id="'.$sender_id.'" title="poemcode">
                                    <img class="ghost_msg_nav_item_author_avatar_img" src="'.UserMeta::GetAuthorMeta($sender_id)['user_avatar'].'" alt="'.UserMeta::GetAuthorMeta($sender_id)['display_name'].'" width="24" height="24">
                                    <span class="ghost_msg_nav_item_author_name">'.UserMeta::GetAuthorMeta($sender_id)['display_name'].'</span></a>
                                <a class="ghost_msg_nav_item_close user_11919" data-id="'.$sender_id.'">
                                    <span class="poi-icon fa-times fas" aria-hidden="true"></span>
                                </a>
                            </div>';
        $result['user_conversation'] = $conversation;
        echo json_encode( $result );
        exit();

    }

    //用户中心发送私信
    public static function SubmitMsg(){
        header("content-type: application/json; charset=utf-8");
        $sender_id = $_POST['userid'] ?? '';
        $receiver_id = $_POST['send_id'] ?? '';
        $content = $_POST['content'] ?? '';

        //判断用户权限
        if(!SiteMeta::Login()){
            $result['message']	= '未登录';
            $result['code']	= 0;
            echo json_encode( $result );
            exit();
        }

        if(empty($content)){
            $result['message']	= '发送内容为空';
            $result['code']	= 3;
            echo json_encode( $result );
            exit();
        }
        if(empty($receiver_id)){
            $result['message']	= '接受者id为空';
            $result['code']	= 0;
            echo json_encode( $result );
            exit();
        }
        if(empty($sender_id) && self::Login()){
            $result['message']	= '用户id为空';
            $result['code']	= 0;
            echo json_encode( $result );
            exit();
        }

        UserCenterMsg::SubmitNewMsg($sender_id,$receiver_id,$content);

        $time = date('Y-m-d H:i:s');
        $result['message']	= '发送成功';
        $result['code']	= 1;
        $result['user_msg']	= '<div class=" ghost_msg_list">
                                <a class="ghost_msg_list_thumbnail" href="'.HOME_URL.'author/'.$sender_id.'" target="_blank">
                                    <img title="junjie.gao" alt="'.UserMeta::GetAuthorMeta($sender_id)['display_name'].'" class="ghost_msg_list_thumbnail_avatar_img" src="'.UserMeta::GetAuthorMeta($sender_id)['user_avatar'].'" width="40" height="40"></a>
                                <div class="ghost_msg_list_body">
                                    <div class="ghost_msg_list_meta">
                                        <span class="ghost_msg_list_meta_item ghost_msg_list_meta_name">'.UserMeta::GetAuthorMeta($sender_id)['display_name'].'</span>
                                        <span class="ghost_msg_list_meta_item ghost_msg_list_meta_uid">(uid:'.$sender_id.')</span>
                                        <span class="ghost_msg_list_meta_item ghost_msg_list_meta_date">'.UserMeta::TimeTran($time).'</span></div>
                                    <div class="ghost_msg_list_content">'.$content.'</div></div>
                            </div>';
        echo json_encode( $result );
        exit();
    }

    //购买付费文章链接
    public static function BuyPaidPost(){
        header("content-type: application/json; charset=utf-8");
        $PostId = $_POST['postid'] ?? '';
        $UserId = $_POST['user_id'] ?? '';
        $AuthorId = $_POST['author_id'] ?? '';
        $Target = $_POST['type'] ?? '';

        //判断用户权限
        if(!SiteMeta::Login() || empty($UserId)){
            $result['message']	= '未登录';
            $result['code']	= 0;
            echo json_encode( $result );
            exit();
        }

        //判断积分是否足够
        if(UserMeta::GetAuthorMeta($UserId)['user_credit'] < 0){
            $result['message']	= '积分不足';
            $result['code']	= 0;
            echo json_encode( $result );
            exit();
        }

        //判断用户权限
        if(isset($Type)){
            $result['message']	= '未指定文章id';
            $result['code']	= 0;
            echo json_encode( $result );
            exit();
        }

        //判断用户权限
        if($UserId == $AuthorId){
            $result['message']	= '不能购买自己的文章';
            $result['code']	= 0;
            echo json_encode( $result );
            exit();
        }

        //添加购买文章通知
        UserCenterNotice::AddUserNotice($UserId,'N_BuyPaidPost',$PostId,$Target);
        //通知文章作者文章售出
        UserCenterNotice::AddUserNotice($AuthorId,'N_SellPaidPost',$PostId,$Target);

        $result['message']	= '购买成功';
        $result['code']	= 1;
        echo json_encode( $result );
        exit();

    }

    //提交文章评论
    public static function SubmitPostComment(){
        header('content-type: application/json; charset=utf-8');
        $UserId = $_POST['userid'] ?? '';
        $Content = $_POST['comment']['content'] ?? '';
        $PostId = $_POST['comment']['post_id'] ?? '';

        //判断用户权限
        if(!SiteMeta::Login() || empty($UserId)){
            $result['message']	= '未登录';
            $result['code']	= 0;
            echo json_encode( $result );
            exit();
        }

        //判断用户权限
        if(empty($UserId) || empty($Content) || empty($PostId)){
            $result['message']	= '内容为空';
            $result['code']	= 0;
            echo json_encode( $result );
            exit();
        }

        //提交文章评论
        $CommentId = Comment::SubmitPostComment($UserId,$PostId,$Content);
        $result['message']	= '评论成功';
        $result['code']	= 1;
        $result['CommentId'] = $CommentId;
        echo json_encode( $result );
        exit();

    }

    //退出系统
    public static function Logout(){
        if(UserMeta::Login()){
            //删除session
            session_destroy();

            //清除可能存在的cookie
            setcookie('user_login','',1);
            setcookie('rememberMe','',1);

            //提示：退出成功
        }
        header('location:' . HOME_URL);
    }

    //调用图片验证码
    public static function captcha(){
        //调用验证码类
        \vendor\Captcha::getCaptcha();
    }

}

?>