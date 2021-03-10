<?php
use model\PostMeta;
use model\Menu;
use model\UserMeta;
use model\SiteMeta;

$post_meta = PostMeta::GetPostsMeta(12,$home_cms_m->name,'post_modified');
?>
<div class="headbox3">
    <div class="headbox3_bg">
        <section class="container ghost_nav style-1 cat-col cat-col-full">
            <div data-cat="<?php echo $home_cms_m->name;?>" class="cat-container clearfix">
                <div class="ghost-homebox__header ghost-panel__header poi-panel__header">
                    <h4 class="ghost-homebox__title ghost-panel__title poi-panel__title"> <a href="<?php echo Menu::GetMenuUrl($home_cms_m->name,true);?>" class="ghost-homebox__title__link"> <span class="ghost-homebox__title__icon__mask" style="color: #61b4ca"> <i class="<?php echo Menu::GetMenuIcon($home_cms_m->name,true);?> poi-icon ghost-homebox__title__icon" aria-hidden="true"></i> </span> <span style="color:#000" class="ghost-homebox__title__text"><?php echo Menu::GetMenuTitle($home_cms_m->name,true);?></span> </a> </h4>
                    <span style="-webkit-box-flex: 1;-ms-flex-positive: 1;flex-grow: 1;"></span>
                    <a data-type="data" class="active home_title_menu_item">最新</a>
                    <a data-type="comment_count" class="home_title_menu_item">评论</a>
                    <a data-type="views" class="home_title_menu_item">浏览</a>
                </div>
                <div id="ghost_box_1" class="cms-cat cms-cat-s7">
                    <?php
                    foreach($post_meta as $post_meta){?>
                        <div class="col-md-2 box-1 float-left">
                            <article id="post-78060" class="post type-post status-publish format-standard">
                                <div class="entry-thumb hover-scale">
                                    <a href="<?php echo PostMeta::GetPostUrl($post_meta['ID']);?>"><img width="500" height="340" src="<?php echo SiteMeta::GetSiteMetaItem('site_lazy_img');?>" data-original="<?php echo $post_meta['post_header_img'];?>" class="lazy show" alt="<?php echo $post_meta['post_title'];?>" style="display: block;"></a>
                                    <ul class="post-categories">
                                        <li><a href="<?php echo Menu::GetMenuUrl($post_meta['post_menu']);?>" rel="category tag"><?php echo Menu::GetMenuTitle($post_meta['post_menu']);?></a></li></ul>
                                </div>
                                <a href="<?php echo PostMeta::GetPostUrl($post_meta['ID']);?>" target="_blank" class="post_box_avatar_link" title="<?php echo $post_meta['post_author'];?>">
                                    <img class="post_box_avatar_img" title="<?php echo UserMeta::GetAuthorMeta($post_meta['post_author'])['display_name'];?>" src="<?php echo UserMeta::GetAuthorMeta($post_meta['post_author'])['user_avatar'];?>" width="50" height="50" alt="<?php echo UserMeta::GetAuthorMeta($post_meta['post_author'])['display_name'];?>">
                                    <span class="post_box_avatar_author_name"><?php echo UserMeta::GetAuthorMeta($post_meta['post_author'])['display_name'];?></span>
                                </a>
                                <div class="entry-detail">
                                    <header class="entry-header">
                                        <h2 class="entry-title h4"><a href="<?php echo PostMeta::GetPostUrl($post_meta['ID']);?>" rel="bookmark"><?php echo $post_meta['post_title'];?></a>
                                        </h2>
                                        <div class="entry-meta entry-meta-1">
                                            <span class="entry-date text-muted"><i class="fas fa-bell"></i><time class="entry-date" datetime="<?php echo $post_meta['post_date'];?>" title="<?php echo UserMeta::TimeTran($post_meta['post_date']);?>"><?php echo UserMeta::TimeTran($post_meta['post_date']);?></time></span>
                                            <span class="comments-link text-muted pull-right"><i class="far fa-comment"></i><a href="<?php echo PostMeta::GetPostUrl($post_meta['ID']);?>"><?php echo $post_meta['comment_count'];?></a></span>
                                            <span class="views-count text-muted pull-right"><i class="fas fa-eye"></i><?php echo $post_meta['post_views'];?></span>
                                        </div>
                                    </header>
                                </div>
                            </article>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="ghost_home_more_post">
                <a class="more-post" href="<?php echo Menu::GetMenuUrl($home_cms_m->name,true);?>">更多文章 <i class="tico tico-angle-right"></i></a>
            </div>
        </section>
    </div>
</div>