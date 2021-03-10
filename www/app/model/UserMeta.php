<?php

namespace model;

use core\Model;
use model\SiteMeta;

class UserMeta extends Model{

    //判断是否是管理员
    public static function IsAdmin(){
        @session_start();
        $UserId = $_SESSION['user_login']['ID'];
        return self::GetUserByUserId($UserId)['capabilities'];
    }

    //获取用户中心链接方法
    public static function GetUserUrl($slug){
        return HOME_URL . '?c=User&m=' . $slug;
    }

    //获取作者信息
    public static function GetAuthorMeta($AuthorId){
        $sql = 'select * from pink_users where ID = \'' . $AuthorId . '\';';
        return self::SqlQuery($sql);
    }

    //根据用户名获取用户信息
    public static function GetUserByUsername($username){
        $username = addslashes($username);
        $sql = "select * from pink_users where user_login = '{$username}' or user_email = '{$username}';";
        return self::SqlQuery($sql,false);
    }

    //根据用户电子邮件获取用户信息
    public static function GetUserByEmail($email){
        $email = addslashes($email);
        $sql = "select * from pink_users where user_email = '{$email}';";
        return self::SqlQuery($sql,false);
    }

    //根据用户id获取用户信息
    public static function GetUserByUserId($UserId){
        $sql = "select * from pink_users where ID = '{$UserId}';";
        return self::SqlQuery($sql,false);
    }

    //添加用户
    public static function AddUser($username,$email,$password){
        $password = password_hash($password, PASSWORD_DEFAULT);
        $nowtime = date('Y-m-d H:i:s');
        $siteDefaultAvatar = addslashes(SiteMeta::GetSiteMeta('site_default_avatar'));
        $siteDefaultUserlevel = SiteMeta::GetSiteMeta('site_default_level');
        $user_credit = SiteMeta::GetSiteMeta('user_credit');
        $sql = "insert into pink_users (user_login,user_pass,user_email,user_registered,display_name,user_avatar,user_credit,capabilities) values('{$email}','{$password}','{$email}','{$nowtime}','{$username}','{$siteDefaultAvatar}','{$user_credit}','{$siteDefaultUserlevel}');";
        return self::SqlUpdate($sql);
    }

    //修改用户密码
    public static function AlterUserPass($email,$password){
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "update pink_users set user_pass = '{$password}' where user_email = '{$email}';";
        return self::SqlUpdate($sql);
    }

    //更新用户签到时间戳
    public static function AlterUserSignDaily($userid){
        $timer = time();
        $sql = "update pink_users set sign_daily = '{$timer}' where ID = '{$userid}';";
        return self::SqlUpdate($sql);
    }

    //获取每日用户第一个签到时间戳
    public static function GetFirstUserSignDaily(){
        //php获取今日开始时间戳和结束时间戳
        $beginToday=mktime(0,0,0,date('m'),date('d'),date('Y'));
        $endToday=mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
        $sql = "select ID,display_name,sign_daily from pink_users where sign_daily > '{$beginToday}' and sign_daily < '{$endToday}' order by sign_daily;";
        if($User = self::SqlQuery($sql)){
            return $User;
        }else{
            return 0;
        }
    }

    //判断用户是否已经签到
    public static function IsFirstUserSignDaily($userid){
        //php获取今日开始时间戳和结束时间戳
        $beginToday=mktime(0,0,0,date('m'),date('d'),date('Y'));
        $endToday=mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
        $sql = "select * from pink_users where sign_daily > '{$beginToday}' and sign_daily < '{$endToday}' and ID = '{$userid}';";
        if($User = self::SqlQuery($sql)){
            return $User;
        }else{
            return 0;
        }
    }

    //修改用户电子邮件
    public static function AlterUserEmail($NewEmail,$UserId){
        $sql = "update pink_users set user_email = '{$NewEmail}',user_login = '{$NewEmail}' where ID = '{$UserId}';";
        return self::SqlUpdate($sql);
    }

    //修改用户头像
    public static function UpdateAvatarByUserId($UserId,$ImgUrl){
        $ImgUrl = addslashes($ImgUrl);
        $sql = "update pink_users set user_avatar = '{$ImgUrl}' where ID = '{$UserId}';";
        return self::SqlUpdate($sql);
    }

    //修改用户积分
    public static function UpdateUserCredit($UserId,$Credit){
        $Credit = UserMeta::GetAuthorMeta($UserId)['user_credit'] + $Credit;
        $sql = "update pink_users set user_credit = {$Credit} where ID = {$UserId};";
        if($flag = self::SqlUpdate($sql)){
            return $flag;
        }else{
            return 0;
        }
    }

}

?>