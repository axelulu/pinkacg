<?php

namespace model;

use core\Model;

class SiteMeta extends Model{

    //获取网站信息方法
    public static function GetSiteMeta($key){
        $sql = 'select * from pink_site_meta where site_key = "' . $key . '";';
        return self::SqlQuery($sql)['site_value'];
    }

    //更新网站信息
    public static function UpdateSiteMeta($sql){
        return self::SqlUpdate($sql);
    }

    //获取网站信息
    public static function GetSiteMetaItem($type){
        if($SiteMeta = @SiteMeta::GetSiteMeta('SiteMeta')){
            $SiteMeta = unserialize($SiteMeta);
            $site_name = $SiteMeta['site_name'];
            $site_desc = $SiteMeta['site_desc'];
            $site_keyword = $SiteMeta['site_keyword'];
            $site_logo = $SiteMeta['site_logo'];
            $site_header_img = $SiteMeta['site_header_img'];
            $site_icon = $SiteMeta['site_icon'];
            $site_default_avatar = $SiteMeta['site_default_avatar'];
            $site_lazy_img = $SiteMeta['site_lazy_img'];
            $site_login_notice = $SiteMeta['site_login_notice'];
            $site_header_notice = $SiteMeta['site_header_notice'];
            $site_footer_meta = $SiteMeta['site_footer_meta'];
        }else{
            $site_name = '';
            $site_desc = '';
            $site_keyword = '';
            $site_logo = '';
            $site_header_img = '';
            $site_icon = '';
            $site_default_avatar = '';
            $site_lazy_img = '';
            $site_login_notice = '';
            $site_header_notice = '';
            $site_footer_meta = '';
        }
        switch ($type){
            case 'site_name':return $site_name;
                break;
            case 'site_desc':return $site_desc;
                break;
            case 'site_keyword':return $site_keyword;
                break;
            case 'site_logo':return $site_logo;
                break;
            case 'site_header_img':return $site_header_img;
                break;
            case 'site_icon':return $site_icon;
                break;
            case 'site_default_avatar':return $site_default_avatar;
                break;
            case 'site_lazy_img':return $site_lazy_img;
                break;
            case 'site_login_notice':return $site_login_notice;
                break;
            case 'site_header_notice':return $site_header_notice;
                break;
            case 'site_footer_meta':return $site_footer_meta;
                break;
        }
    }

    //获取网站底部信息
    public static function GetSiteFooterMetaItem($type){
        if($FooterMeta = @SiteMeta::GetSiteMeta('FooterMeta')){
            $FooterMeta = unserialize($FooterMeta);
            $site_footer_link = $FooterMeta['site_footer_link'];
            $site_footer_bullhorn = $FooterMeta['site_footer_bullhorn'];
            $site_footer_about = $FooterMeta['site_footer_about'];
            $site_footer_callus = $FooterMeta['site_footer_callus'];
        }else{
            $site_footer_link = '';
            $site_footer_bullhorn = '';
            $site_footer_about = '';
            $site_footer_callus = '';
        }
        switch ($type){
            case 'site_footer_link':return $site_footer_link;
                break;
            case 'site_footer_bullhorn':return $site_footer_bullhorn;
                break;
            case 'site_footer_about':return $site_footer_about;
                break;
            case 'site_footer_callus':return $site_footer_callus;
                break;
        }
    }

    //获取积分策略信息
    public static function GetSiteCreditStrategy($type){
        if($CreditStrategy = @SiteMeta::GetSiteMeta('CreditStrategy')){
            $CreditStrategy = unserialize($CreditStrategy);
            $N_SignDaily = $CreditStrategy['N_SignDaily'];
            $N_Flowers = $CreditStrategy['N_Flowers'];
            $N_PostComment = $CreditStrategy['N_PostComment'];
            $N_Avatar = $CreditStrategy['N_Avatar'];
            $N_Reg = $CreditStrategy['N_Reg'];
            $N_ForgetPwd = $CreditStrategy['N_ForgetPwd'];
            $N_UserComment = $CreditStrategy['N_UserComment'];
            $N_PublishPost = $CreditStrategy['N_PublishPost'];
            $N_UnFlowers = $CreditStrategy['N_UnFlowers'];
            $N_SellPaidPost = $CreditStrategy['N_SellPaidPost'];
            $N_BuyPaidPost = $CreditStrategy['N_BuyPaidPost'];
            $N_AlterPwd = $CreditStrategy['N_AlterPwd'];
        }else{
            $N_SignDaily = 10;
            $N_Flowers = 1;
            $N_PostComment = 2;
            $N_Avatar = -10;
            $N_Reg = 100;
            $N_ForgetPwd = -20;
            $N_UserComment = 4;
            $N_PublishPost = 10;
            $N_UnFlowers = -1;
            $N_SellPaidPost = 10;
            $N_BuyPaidPost = -10;
            $N_AlterPwd = -10;
        }
        switch ($type){
            case 'N_SignDaily':return $N_SignDaily;
                break;
            case 'N_Flowers':return $N_Flowers;
                break;
            case 'N_PostComment':return $N_PostComment;
                break;
            case 'N_Avatar':return $N_Avatar;
                break;
            case 'N_Reg':return $N_Reg;
                break;
            case 'N_ForgetPwd':return $N_ForgetPwd;
                break;
            case 'N_UserComment':return $N_UserComment;
                break;
            case 'N_PublishPost':return $N_PublishPost;
                break;
            case 'N_UnFlowers':return $N_UnFlowers;
                break;
            case 'N_SellPaidPost':return $N_SellPaidPost;
                break;
            case 'N_BuyPaidPost':return $N_BuyPaidPost;
                break;
            case 'N_AlterPwd':return $N_AlterPwd;
                break;
        }
    }

    //获取邮箱配置信息
    public static function GetSiteEmail($type){
        if($CreditStrategy = @SiteMeta::GetSiteMeta('EmailMeta')){
            $CreditStrategy = unserialize($CreditStrategy);
            $SmtpHost = $CreditStrategy['smtp_host'];
            $SmtpUsername = $CreditStrategy['smtp_username'];
            $SmtpPass = $CreditStrategy['smtp_pass'];
            $SmtpSecure = $CreditStrategy['smtp_secure'];
            $SmtpPort = $CreditStrategy['smtp_port'];
        }else{
            $SmtpHost = '';
            $SmtpUsername = '';
            $SmtpPass = '';
            $SmtpSecure = '';
            $SmtpPort = '';
        }
        switch ($type){
            case 'smtp_host':return $SmtpHost;
                break;
            case 'smtp_username':return $SmtpUsername;
                break;
            case 'smtp_pass':return $SmtpPass;
                break;
            case 'smtp_secure':return $SmtpSecure;
                break;
            case 'smtp_port':return $SmtpPort;
                break;
        }
    }

}

?>