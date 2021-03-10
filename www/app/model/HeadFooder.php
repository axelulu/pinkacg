<?php

//命名空间
namespace model;

//站点信息类
class HeadFooder{
    //网站头部信息
    public static function SiteHeadMeta(){
        $site_name = SiteMeta::GetSiteMetaItem('site_name');
        $site_icon = SiteMeta::GetSiteMetaItem('site_icon');
        $site_logo = SiteMeta::GetSiteMetaItem('site_logo');
        $site_keyword = SiteMeta::GetSiteMetaItem('site_keyword');
        $site_desc = SiteMeta::GetSiteMetaItem('site_desc');
        echo '<title>' . $site_name . ' - ' . $site_desc . '</title>
          <meta name="keywords" content="' . $site_keyword . '">
          <meta name="description" content="' . $site_desc . '">
          <meta property="og:description" content="' . $site_desc . '">
          <meta property="og:site_name" content="' . $site_name . '">
          <meta property="og:type" content="website">
          <meta property="og:title" content="' . $site_name . '">
          <meta property="og:url" content="' . HOME_URL . '">
          <meta property="og:image" content="' . $site_logo . '"><link rel="alternate" type="application/atom+xml" title="粉萌次元 Atom Feed" href="https://pinkacg.com/feed/atom">
          <link rel="alternate" type="application/rss+xml" title="粉萌次元 RSS Feed" href="' . HOME_URL . '/feed">
          <link rel="shortcut icon" href="' . $site_icon . '">';
    }

    //网站底部信息
    public function SiteFooterMeta(){}
}

?>