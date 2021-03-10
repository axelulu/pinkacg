<?php
global $LOGINUSER;
use model\SiteMeta;
use model\UserMeta;?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php echo SiteMeta::GetSiteMetaItem('site_name')?> 后台管理 - <?php echo SiteMeta::GetSiteMetaItem('site_desc')?></title>
    <link rel="stylesheet" href="<?php echo URL;?>assets/layui/css/layui.css">
    <script type="text/javascript" src="<?php echo URL . 'assets/js/jquery-3.5.1.min.js';?>"></script>
    <script type="text/javascript">
        var ghost = {
            "ghost_ajax":"<?php echo HOME_AJAX ?>",
        };
    </script>
</head>
<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin">
    <div class="layui-header">
        <div class="layui-logo"><?php echo SiteMeta::GetSiteMetaItem('site_name')?>后台布局</div>
        <!-- 头部区域（可配合layui已有的水平导航） -->
        <ul class="layui-nav layui-layout-left">
            <li class="layui-nav-item"><a href="<?php echo HOME_URL;?>">首页</a></li>
            <li class="layui-nav-item"><a href="">控制台</a></li>
            <li class="layui-nav-item"><a href="">用户</a></li>
            <li class="layui-nav-item">
                <a href="javascript:;">其它系统</a>
                <dl class="layui-nav-child">
                    <dd><a href="">邮件管理</a></dd>
                    <dd><a href="">消息管理</a></dd>
                    <dd><a href="">授权管理</a></dd>
                </dl>
            </li>
        </ul>
        <ul class="layui-nav layui-layout-right">
            <li class="layui-nav-item">
                <a href="javascript:;">
                    <img src="<?php echo UserMeta::GetAuthorMeta($LOGINUSER['ID'])['user_avatar'];?>" class="layui-nav-img">
                    <?php echo UserMeta::GetAuthorMeta($LOGINUSER['ID'])['display_name'];?>
                </a>
                <dl class="layui-nav-child">
                    <dd><a href="">基本资料</a></dd>
                    <dd><a href="">安全设置</a></dd>
                </dl>
            </li>
            <li class="layui-nav-item"><a href="<?php echo HOME_URL;?>index.php?p=admin&a=Logout">退了</a></li>
        </ul>
    </div>

    <div class="layui-side layui-bg-black">
        <div class="layui-side-scroll">
            <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
            <ul class="layui-nav layui-nav-tree"  lay-filter="test">
                <li class="layui-nav-item">
                    <a href="<?php echo HOME_URL;?>?p=admin&page=index">网站首页</a>
                </li>
                <li class="layui-nav-item layui-nav-itemed">
                    <a class="" href="javascript:;">基本设置</a>
                    <dl class="layui-nav-child">
                        <dd><a href="<?php echo HOME_URL;?>?p=admin&page=SiteMeta">基本信息</a></dd>
                        <dd><a href="<?php echo HOME_URL;?>?p=admin&page=HomeLayout">首页布局</a></dd>
                        <dd><a href="javascript:;">内容设置</a></dd>
                        <dd><a href="javascript:;">广告设置</a></dd>
                        <dd><a href="<?php echo HOME_URL;?>?p=admin&page=FooterMeta">底部信息</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item layui-nav-itemed">
                    <a class="" href="javascript:;">进阶管理</a>
                    <dl class="layui-nav-child">
                        <dd><a href="javascript:;">redis设置</a></dd>
                        <dd><a href="<?php echo HOME_URL;?>?p=admin&page=Email">邮件配置</a></dd>
                        <dd><a href="javascript:;">oss配置</a></dd>
                        <dd><a href="<?php echo HOME_URL;?>?p=admin&page=CreditStrategy">积分策略</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item layui-nav-itemed">
                    <a class="" href="javascript:;">内容管理</a>
                    <dl class="layui-nav-child">
                        <dd><a href="javascript:;">文章信息</a></dd>
                        <dd><a href="javascript:;">标签信息</a></dd>
                        <dd><a href="javascript:;">页面信息</a></dd>
                        <dd><a href="javascript:;">媒体信息</a></dd>
                        <dd><a href="javascript:;">用户信息</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item"><a href="">云市场</a></li>
                <li class="layui-nav-item"><a href="">发布商品</a></li>
            </ul>
        </div>
    </div>
