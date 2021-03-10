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
        if(@SiteMeta::GetSiteMeta('SiteMeta')){
            $SiteMeta = SiteMeta::GetSiteMeta('SiteMeta');
            $SiteMeta = json_decode($SiteMeta);
            $site_name = $SiteMeta->site_name;
            $site_desc = $SiteMeta->site_desc;
            $site_keyword = $SiteMeta->site_keyword;
            $site_logo = $SiteMeta->site_logo;
            $site_header_img = $SiteMeta->site_header_img;
            $site_icon = $SiteMeta->site_icon;
            $site_default_avatar = $SiteMeta->site_default_avatar;
            $site_lazy_img = $SiteMeta->site_lazy_img;
            $site_login_notice = $SiteMeta->site_login_notice;
            $site_header_notice = $SiteMeta->site_header_notice;
            $site_footer_meta = $SiteMeta->site_footer_meta;
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
        if(@SiteMeta::GetSiteMeta('FooterMeta')){
            $FooterMeta = SiteMeta::GetSiteMeta('FooterMeta');
            $FooterMeta = json_decode($FooterMeta);
            $site_footer_link = $FooterMeta->site_footer_link;
            $site_footer_bullhorn = $FooterMeta->site_footer_bullhorn;
            $site_footer_about = $FooterMeta->site_footer_about;
            $site_footer_callus = $FooterMeta->site_footer_callus;
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

}

?>