<?php
global $LOGINUSER,$SiteHeadMeta,$LOGIN;
use model\SiteMeta;
use model\Menu;
use model\UserMeta;
use model\PostMeta;
use model\UserCenterNotice;

$site_header_img = SiteMeta::GetSiteMetaItem('site_header_img');
$menu = Menu::getAllCategories();
$Cat = '';
foreach($menu as $menu_item) {
    $Cat .= '<div class="ghost_post_category_item"><a data-catid="' . $menu_item['slug'] . '" class="ghost_post_category_item_link is-parent">' . Menu::GetMenuTitle($menu_item['slug'],true) . '</a><div class="ghost_post_category_item_children">';
    if (isset($menu_item['child'])) {
        foreach ($menu_item['child'] as $menu_child) {
            $Cat .= '<a data-catid="' . $menu_item['slug'] . '" class="ghost_post_category_item_link is-child">' . Menu::GetMenuTitle($menu_item['slug'],true) . '</a>';
        }
    }
    $Cat .= '</div></div>';
}

?>
<!DOCTYPE html>
<html lang="zh-CN">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
		<meta http-equiv="Cache-Control" content="no-transform">
		<meta http-equiv="Cache-Control" content="no-siteapp">
		<meta name="renderer" content="webkit">
		<meta name="force-rendering" content="webkit">
		<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
        <style>
            :root {
                --box-shadow: rgba(0, 0, 0, 0.14) 0px 2px 2px 0px, rgba(0, 0, 0, 0.2) 0px 3px 1px -2px, rgba(0, 0, 0, 0.12) 0px 1px 5px 0px;
                --box-shadow-hover: rgba(0, 0, 0, 0.14) 0px 2px 2px 0px, rgba(0, 0, 0, 0.2) 0px 3px 1px -2px, rgba(0, 0, 0, 0.12) 0px 1px 5px 0px;
                --site-color-tag: rgba(255, 131, 196, 0.69);
                --site-color: #ff83c4;
                --site-background-hover: rgba(237,237,237,0.25);
                --site-background-bg: rgba(232,232,232,0.25);
            }
        </style>
        <?php $SiteHeadMeta; ?>
        <script type="text/javascript">
            var ghost = {
                "ajaxurl":"<?php echo HOME_AJAX ?>",
                "ghost_ajax":"<?php echo HOME_AJAX ?>",
                "siteurl":"<?php echo HOME_URL?>",
                "title":"<?php echo SiteMeta::GetSiteMetaItem('site_name'); ?>",
                "PostCat":'<?php echo $Cat;?>',
                "login_news":"<p>\u6b22\u8fce\u767b\u5f55\u7c89\u840c\u6b21\u5143\uff01<\/p>",
                "ghost_pc_search":"<a class=\"search_bar_item\">\u52a8\u6f2b<\/a><a class=\"search_bar_item\">\u5c0f\u8bf4<\/a><a class=\"search_bar_item\">\u6f2b\u753b<\/a>",
                "dati_length":25,
                "shop_guajian_credit":"-500",
                "ghost_sign_url":"<?php echo HOME_URL?>sign",
                "post_link_max_credit":"30",
                "userid": <?php echo $LOGINUSER['ID'] ?? 0;?>
            };
        </script>
        <link rel="stylesheet" id="fontawesome-css" href="https://cdn.bootcdn.net/ajax/libs/font-awesome/5.13.0/css/all.min.css?ver=6" type="text/css" media="all">
        <link rel="stylesheet" type="text/css" href="<?php echo URL . 'assets/css/bootstrap.min.css';?>">
        <link rel="stylesheet" type="text/css" href="<?php echo URL . 'assets/css/ghost.css';?>">
        <script type="text/javascript" src="<?php echo URL . 'assets/js/jquery-3.5.1.min.js';?>"></script>
        <script type="text/javascript" src="<?php echo URL . 'assets/js/jquery.lazyload.min.js';?>"></script>
        <script type="text/javascript" src="<?php echo URL . 'assets/js/jquery.easing.js';?>"></script>
        <script type="text/javascript" src="<?php echo URL . 'assets/js/ghost.js';?>"></script>
        <script>
		if ((location.href || '').indexOf('vconsole=true') > -1) {
			document.write('<script src="https://cdn.bootcss.com/vConsole/3.3.0/vconsole.min.js"><\/script>');
			document.write('<script>new VConsole()<\/script>');
		}
		</script>
		<?php
		$h = date("H");
		if( ( $h>=19 && $h<=24 ) || ( $h>=0 && $h<7 ) ){?>
		<style>
			html, body {
				background-color: #181a1b;
			}
			#ghost_box_1 article, #ghost_box_2 article, .setting article, .postrank article, .zone_list_box article, .more-post, .home_title_menu_item,#ghost_slide .ghost_control,.ghost_site_notice,body>.footer .footer-wrap>.footer-nav,.ghost_bottom_tools,.ghost_user_menu_nav,.poi-crumb,.ghost_hot_post_post,.ghost_author_widget,.article article,.single_post_body p,.ghost_user_menu_item_link,.ghost_search_form,.ghost_search_form_s,.zone-type-menu li button, .po-zone-tools-right button,.ghost_sign_nav,.ghost_author_nav,.ghost_author_portal,.ghost_author_comment_container,.ghost_author_comment_item_text,.ghost_setting_content_item,.ghost_sidebar,.ghost_guajian_shop_title_menu_item,.ghost_setting_content_preface_control,.ghost_setting_content_text_email,.ghost_setting_content_preface_control_downloadlink, .ghost_setting_content_preface_control_videolink, .ghost_setting_content_preface_control_musiclink,.tox .tox-edit-area__iframe,.tox .tox-toolbar, .tox .tox-toolbar__overflow, .tox .tox-toolbar__primary,.tox .tox-menubar,.ghost_page_box,.ghost_login_box_container, .ghost_comments_box_container, .ghost_reports_box_container, .ghost_addlink_box_container, .ghost_shops_box_container, .ghost_yanwen_container, .ghost_tuwen_container, .ghost_sign_container,.tox .tox-tbtn,.tox .tox-mbtn,.tox .tox-tbtn svg,.tox .tox-statusbar,.header-menu nav>.header-menu-div>ul>li>.sub-menu,.ghost_input,.ghost_comment_container,.ghost_comment_commenter_content,.ghost_comment_item_content_text,.error_page,.layer,.ghost_report_item, .ghost_addlink_item,.ghost_report_reporter_content, .ghost_addlink_reporter_content,.ghost_login_box_content_input,.single_post_body li {
				background-color: #232627!important;
				color: #B1B1C1!important;
			}
			img {
				-webkit-filter: brightness(50%); /*考虑浏览器兼容性：兼容 Chrome, Safari, Opera */
				filter: brightness(50%);
			}
			.header-tu,.ghost-header-logo {
				-webkit-filter: brightness(50%);
				filter: brightness(50%);
			}
		</style>
		<?php }?>
	</head>
<body>
<div style="background-image:url('<?php echo $site_header_img;?>');" class="header-tu">
    <div class="container">
        <div class="header-yonghu poi-container"> 
            <nav class="ghost-topbar">
                <ul class="menu">
                    <li class="ghost-topbar-item is-icon-text"><a href="" title="测试" target="_self"><i style="font-size: 1.2em;" class="fas fa-2x poi-icon" aria-hidden="true"></i> <span>测试</span></a></li>
                    <li class="ghost-topbar-item is-icon-text"><a href="" title="测试" target="_self"><i style="font-size: 1.2em;" class="fas fa-2x poi-icon" aria-hidden="true"></i> <span>测试</span></a></li>
                    <li class="ghost-topbar-item is-icon-text"><a href="" title="测试" target="_self"><i style="font-size: 1.2em;" class="fas fa-2x poi-icon" aria-hidden="true"></i> <span>测试</span></a></li>
                    <li class="ghost-topbar-item is-icon-text"><a href="" title="测试" target="_self"><i style="font-size: 1.2em;" class="fas fa-2x poi-icon" aria-hidden="true"></i> <span>测试</span></a></li>
                </ul>
            </nav> 
        </div>
        <!-- Logo -->
        <div class="ghost-head-nav">
            <a class="logo nav-col" href="<?php echo HOME_URL;?>" title="">
                <img class="ghost-logo" src="<?php echo SiteMeta::GetSiteMetaItem('site_logo');?>" alt="<?php echo SiteMeta::GetSiteMetaItem('site_name');?>">
            </a>
        </div>
    </div>
</div>
<div class="scroll-header-menu container"><!-- 菜单 -->
    <header id="scroll-header" class="header-menu">
        <div style="margin:0px auto" class="header white">
            <div class="ghost-header-logo"> 
            <div style="background-image:url('<?php echo $site_header_img;?>');" class="header-bg">
            </div>
            </div>
            <nav id="header-nav" class="navigation clearfix" role="navigation">

                <div class="header-menu-div">
                    <ul id="menu-%e8%8f%9c%e5%8d%95" class="ghost_menu_ul">
                        <li><a href="<?php echo HOME_URL;?>" style="padding: 10px 15px 10px 10px;font-size: 25px;"><i class="catacg-mune-tubiao fas fa-home"> </i></a></li>
                        <?php
                            foreach($menu as $menu_item){
                            ?>
                            <li id="menu-item-26519" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-has-children menu-item-26519">
                                <a href="<?php echo Menu::GetMenuUrl($menu_item['slug'],true);?>">
                                    <i class="catacg-mune-tubiao <?php echo Menu::GetMenuIcon($menu_item['slug'],true);?>"> </i>
                                    <?php echo Menu::GetMenuTitle($menu_item['slug'],true);?>
                                    <i class="ghost-menu-posts-count" title="本周发布的"><?php echo PostMeta::GetPostNumByMenu($menu_item['slug'])?></i>
                                </a>
                                <?php if(isset($menu_item['child'])){?>
                                    <ul class="sub-menu">
                                        <?php foreach($menu_item['child'] as $menu_child){?>
                                            <li id="menu-item-26520" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-26520">
                                                <a href="<?php echo Menu::GetMenuUrl($menu_child['slug'],true);?>"><i class="catacg-mune-tubiao <?php echo Menu::GetMenuIcon($menu_child['slug'],true);?>">
                                                    </i><?php echo Menu::GetMenuTitle($menu_child['slug'],true);?><i class="ghost-menu-posts-count" title="本周发布的">3</i>
                                                </a>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                <?php } ?>
                            </li>
                            <?php } ?>
                    </ul>
                </div>
                <div class="ghost-nav-tool__container">
                    <?php if(!$LOGIN):?>
                        <li class="login-actions">
                            <a class="user-login login-link bind-redirect"><span>登陆</span></a>
                        </li>
                    <?php else: ?>
                    <div class="ghost_sign_daily">
                        <?php if(UserMeta::IsFirstUserSignDaily($LOGINUSER['ID'])){?>
                        <a style="background: #ff83c466" class="ghost_sign_daily_btn" title="已签到">
                            <span class="poi-icon fa-map-marker fas fa-fw" aria-hidden="true"></span>
                            <span class="poi-icon__text">已签到</span>
                        </a>
                        <?php }else{ ?>
                        <a class="ghost_sign_daily_btn" title="未签到">
                            <span class="poi-icon fa-map-marker fas fa-fw" aria-hidden="true"></span>
                            <span class="poi-icon__text">未签到</span>
                        </a>
                        <?php } ?>
                    </div>
                    <li class="login-actions">
                        <i class="ghost-author-posts-count" title="未读消息数量" style="background: red;border-radius: 50%;right: 48px;top: 5px;padding: 5px;"></i>
                        <a style="padding:0px;background: hsla(0, 0%, 100%, 0);" class="login-link bind-redirect">
                            <img src="https://img.catacg.cn/pinkacg_upload/img/2020/06/6027905533d2eec5809d812f5cd69d14f04263f0.png" alt="" class="ghost_guajian">
                            <img src="<?php echo UserMeta::GetAuthorMeta($LOGINUSER['ID'])['user_avatar'];?>" alt="avatar" class="ghost_setting_content_avatar_img" width="100" height="100">
                        </a>

                        <div class="ghost_user_menu_nav">
                            <div class="ghost_user_menu_item">
                                <div class="ghost_user_menu_item_title">
                                    <div class="ghost_user_menu_item_title_icon">
                                        <i class="poi-icon fas fa-address-card" aria-hidden="true"></i>
                                    </div>
                                    <div class="ghost_user_menu_item_title_text">个人设置</div></div>
                                <a href="<?php echo UserMeta::GetUserUrl('setting');?>" title="我的设置" class="ghost_user_menu_item_link">
                                    <div class="ghost_user_menu_item_link_icon">
                                        <i class="poi-icon fas fa-cog" aria-hidden="true"></i>
                                    </div>
                                    <div class="ghost_user_menu_item_link_text">我的设置</div></a>
                                <a href="<?php echo UserMeta::GetUserUrl('drafts');?>" title="我的草稿" class="ghost_user_menu_item_link">
                                    <div class="ghost_user_menu_item_link_icon">
                                        <i class="poi-icon fas fa-copy" aria-hidden="true"></i>
                                    </div>
                                    <div class="ghost_user_menu_item_link_text">我的草稿</div></a>
                                <a href="<?php echo UserMeta::GetUserUrl('newpost')?>" title="新建文章" class="ghost_user_menu_item_link">
                                    <div class="ghost_user_menu_item_link_icon">
                                        <i class="poi-icon fas fa-paint-brush" aria-hidden="true"></i>
                                    </div>
                                    <div class="ghost_user_menu_item_link_text">新建文章</div></a>
                            </div>
                            <div class="ghost_user_menu_item">
                                <div class="ghost_user_menu_item_title">
                                    <div class="ghost_user_menu_item_title_icon">
                                        <i class="poi-icon fa-bell fas" aria-hidden="true"></i>
                                    </div>
                                    <div class="ghost_user_menu_item_title_text">消息管理</div></div>
                                <i style="top: 64px;right: 82px;" class="ghost-author-posts-count" title="未读通知数量"><?php echo UserCenterNotice::GetUnreadNotice($LOGINUSER['ID'])[0]['num'];?></i>
                                <a href="<?php echo UserMeta::GetUserUrl('notice')?>" title="我的通知" class="ghost_user_menu_item_link">
                                    <div class="ghost_user_menu_item_link_icon">
                                        <i class="poi-icon fas fa-bell" aria-hidden="true"></i>
                                    </div>
                                    <div class="ghost_user_menu_item_link_text">我的通知</div></a>
                                <a href="<?php echo UserMeta::GetUserUrl('msg')?>" title="我的消息" class="ghost_user_menu_item_link">
                                    <div class="ghost_user_menu_item_link_icon">
                                        <i class="poi-icon fas fa-envelope" aria-hidden="true"></i>
                                    </div>
                                    <div class="ghost_user_menu_item_link_text">我的消息</div></a>
                                <a href="<?php echo UserMeta::GetUserUrl('orders')?>" title="我的订单" class="ghost_user_menu_item_link">
                                    <div class="ghost_user_menu_item_link_icon">
                                        <i class="poi-icon fas fa-shopping-cart" aria-hidden="true"></i>
                                    </div>
                                    <div class="ghost_user_menu_item_link_text">我的订单</div></a>
                            </div>
                            <div class="ghost_user_menu_item">
                                <div class="ghost_user_menu_item_title">
                                    <div class="ghost_user_menu_item_title_icon">
                                        <i class="poi-icon fas fa-user-circle" aria-hidden="true"></i>
                                    </div>
                                    <div class="ghost_user_menu_item_title_text">个人中心</div></div>
                                <a href="<?php echo UserMeta::GetUserUrl('stars')?>" title="我的收藏" class="ghost_user_menu_item_link">
                                    <div class="ghost_user_menu_item_link_icon">
                                        <i class="poi-icon fas fa-heart" aria-hidden="true"></i>
                                    </div>
                                    <div class="ghost_user_menu_item_link_text">我的收藏</div></a>
                                <a href="<?php echo UserMeta::GetUserUrl('posts')?>" title="我的文章" class="ghost_user_menu_item_link">
                                    <div class="ghost_user_menu_item_link_icon">
                                        <i class="poi-icon fas fa-file-alt" aria-hidden="true"></i>
                                    </div>
                                    <div class="ghost_user_menu_item_link_text">我的文章</div></a>
                                <a href="<?php echo UserMeta::GetUserUrl('fans')?>" title="我的粉丝" class="ghost_user_menu_item_link">
                                    <div class="ghost_user_menu_item_link_icon">
                                        <i class="poi-icon fa-users fas" aria-hidden="true"></i>
                                    </div>
                                    <div class="ghost_user_menu_item_link_text">我的粉丝</div></a>
                            </div>
                            <div class="ghost_user_menu_item">
                                <div class="ghost_user_menu_item_title">
                                    <div class="ghost_user_menu_item_title_icon">
                                        <i class="poi-icon fas fa-user-circle" aria-hidden="true"></i>
                                    </div>
                                    <div class="ghost_user_menu_item_title_text">我的会员</div></div>
                                <a href="<?php echo UserMeta::GetUserUrl('vip')?>" title="我的会员" class="ghost_user_menu_item_link">
                                    <div class="ghost_user_menu_item_link_icon">
                                        <i class="poi-icon fas fa-user-circle" aria-hidden="true"></i>
                                    </div>
                                    <div class="ghost_user_menu_item_link_text">我的会员</div></a>
                                <a href="<?php echo UserMeta::GetUserUrl('cash')?>" title="我的余额" class="ghost_user_menu_item_link">
                                    <div class="ghost_user_menu_item_link_icon">
                                        <i class="poi-icon fas fa-credit-card" aria-hidden="true"></i>
                                    </div>
                                    <div class="ghost_user_menu_item_link_text">我的余额</div></a>
                                <a href="<?php echo UserMeta::GetUserUrl('credits')?>" title="我的积分" class="ghost_user_menu_item_link">
                                    <div class="ghost_user_menu_item_link_icon">
                                        <i class="poi-icon fas fa-gem" aria-hidden="true"></i>
                                    </div>
                                    <div class="ghost_user_menu_item_link_text">我的积分</div></a>
                            </div>
                            <div class="ghost_user_menu_item">
                                <div class="ghost_user_menu_item_title">
                                    <div class="ghost_user_menu_item_title_icon">
                                        <i class="poi-icon fas fa-unlock" aria-hidden="true"></i>
                                    </div>
                                    <div class="ghost_user_menu_item_title_text">管理设置</div></div>
                                <a href="<?php echo UserMeta::GetUserUrl('shop')?>" title="商城中心" class="ghost_user_menu_item_link">
                                    <div class="ghost_user_menu_item_link_icon">
                                        <i class="poi-icon fas fa-gem" aria-hidden="true"></i>
                                    </div>
                                    <div class="ghost_user_menu_item_link_text">商城中心</div></a>
                                <a href="<?php echo UserMeta::GetUserUrl('price')?>" title="积分抽奖" class="ghost_user_menu_item_link">
                                    <div class="ghost_user_menu_item_link_icon">
                                        <i class="poi-icon fas fa-gem" aria-hidden="true"></i>
                                    </div>
                                    <div class="ghost_user_menu_item_link_text">积分抽奖</div></a>
                                <a href="<?php echo HOME_URL;?>?p=admin" title="后台管理" class="ghost_user_menu_item_link">
                                    <div class="ghost_user_menu_item_link_icon">
                                        <i class="poi-icon fas fa-gem" aria-hidden="true"></i>
                                    </div>
                                    <div class="ghost_user_menu_item_link_text">后台管理</div></a>
                                <a href="<?php echo HOME_URL;?>index.php?c=User&a=Logout" title="注销账号" class="ghost_user_menu_item_link">
                                    <div class="ghost_user_menu_item_link_icon">
                                        <i class="poi-icon fas fa-sign-out-alt" aria-hidden="true"></i>
                                    </div>
                                    <div class="ghost_user_menu_item_link_text">注销账号</div></a>
                            </div>
                        </div>

                    </li>
                    <?php endif; ?>
                    <div class="ghost_header_search_anniu ghost-search-bar_toggle-btn_container"><a class="poi-icon fa-search fa fa-2x ghost-search-bar_btn" aria-label="搜索" title="搜索"></a></div>
                </div>
            </nav>
        </div>
    </header>
</div>