<?php
use model\PostMeta;
use model\SiteMeta;
$AsidePostsMeta = PostMeta::GetPostsMetaByAuthor(6,$PostAuthorMeta['ID'],'post_modified');
?>
<div class="weight float-right col-lg-3">
    <aside id="ghost_widget" class="ghost_widget">
        <div class="ghost_widget_content">
            <div class="widget_ghost_author">            <h3 class="ghost_hot_post_title">
                <span>
                    <i class="fas fa-user-circle"></i>
                    <span>用户工具</span></span>
                </h3>
                <div data-uid="1" class="ghost_author_header ghost_my_flowers ghost_author_widget">
                    <div class="ghost_author_widget_container">
                        <div class="ghost_author_widget_avatar">
                            <a class="ghost_author_widget_avatar_link" href="<?php echo HOME_URL;?>author/<?php echo $PostAuthorMeta['ID'];?>">
                                <img class="ghost_author_widget_avatar_img" width="150" height="150" src="<?php echo $PostAuthorMeta['user_avatar'];?>" alt="<?php echo $PostAuthorMeta['display_name'];?>"></a>
                        </div>
                        <div class="ghost_author_widget_info">
                            <div class="ghost_author_widget_name_container">
                                <a href="<?php echo HOME_URL;?>author/<?php echo $PostAuthorMeta['ID'];?>" class="ghost_author_widget_name_link"><?php echo $PostAuthorMeta['display_name'];?></a></div>
                            <div class="ghost_author_widget_group_container">
                                <div class="ghost_author_widget_group_uid" title="UID"></div>
                                <div class="ghost_author_widget_group_role" style="background-color: rgb(165, 132, 168);">超级管理员</div></div>
                            <div class="ghost_author_widget_description"><?php echo $PostAuthorMeta['description'];?></div></div>
                        <div class="ghost_author_widget_point">
                            <span class="poi-icon fa-paw fas fa-fw" aria-hidden="true"></span>
                            <span class="ghost_author_widget_point_text"><?php echo $PostAuthorMeta['user_credit'];?></span></div>
                        <div class="ghost_author_widget_tools">
                            <a class="ghost-btn ghost-btn_success ghost_author_btn my_flower">
                                <div class="del_flowers">
                                    <span class="poi-icon fa-check fas fa-fw" aria-hidden="true"></span>
                                    <span class="ghost_icon_text">已关注</span>
                                </div>
                            </a>
                            <a class="ghost-btn ghost-btn_default ghost_author_btn send_msg">
                                <span class="poi-icon fa-envelope fas fa-fw" aria-hidden="true"></span>
                                <span class="ghost_icon_text">站内信</span></a>
                        </div>
                        <div class="ghost_author_widget_author_profile_count">
                            <a class="ghost_author_widget_count_item" href="https://pinkacg.com/author/1?type=flowers">
                                <div class="ghost_author_widget_item_number">1</div>
                                <div class="ghost_author_widget_item_name">关注</div></a>
                            <a class="ghost_author_widget_count_item" href="https://pinkacg.com/author/1?type=fans">
                                <div class="ghost_author_widget_item_number">216</div>
                                <div class="ghost_author_widget_item_name">粉丝</div></a>
                            <a class="ghost_author_widget_count_item" href="https://pinkacg.com/author/1?type=posts">
                                <div class="ghost_author_widget_item_number">8395</div>
                                <div class="ghost_author_widget_item_name">帖子</div></a>
                            <a class="ghost_author_widget_count_item" href="https://pinkacg.com/author/1?type=comments">
                                <div class="ghost_author_widget_item_number">41</div>
                                <div class="ghost_author_widget_item_name">评论</div></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="widget_ghost_hot_post">
                <div id="ghost_hot_post" class="ghost_hot_post">
                    <h3 class="ghost_hot_post_title">
                        <span>
                            <i class="fas fa-eye"></i>
                            <span>热门文章</span></span>
                    </h3>
                    <div class="ghost_hot_post_container clearfix">
                        <?php
                        foreach($AsidePostsMeta as $AsidePostMeta){?>
                        <article id="post-1506" class="ghost_hot_post_article">
                            <div class="ghost_hot_post_post">
                                <div class="ghost_hot_post_item_container">
                                    <a href="<?php echo PostMeta::GetPostUrl($AsidePostMeta['ID']);?>" class="ghost_hot_post_item_container_a">
                                        <img class="ghost_hot_post_item_container_img" src="<?php echo SiteMeta::GetSiteMetaItem('site_lazy_img');?>" data-original="<?php echo $AsidePostMeta['post_header_img'];?>" alt="<?php echo $AsidePostMeta['post_title'];?>" width="320" height="180" style="display: block;"></a>
                                    <div class="ghost_hot_post_item_container_item_view">
                                        <i class="fa-eye fas fa-fw poi-icon"></i><?php echo $AsidePostMeta['post_views'];?></div>
                                    <div class="ghost_hot_post_item_container_time">
                                        <time datetime="<?php echo $AsidePostMeta['post_date'];?>" title="<?php echo PostMeta::TimeTran($AsidePostMeta['post_date']);?>"><?php echo PostMeta::TimeTran($AsidePostMeta['post_date']);?></time></div>
                                </div>
                                <h3 class="ghost_hot_post_item_container_item__title" title="<?php echo $AsidePostMeta['post_title'];?>">
                                    <a href="<?php echo PostMeta::GetPostUrl($AsidePostMeta['ID']);?>" class="ghost_hot_post_item_container_title__link"><?php echo $AsidePostMeta['post_title'];?></a></h3>
                            </div>
                        </article>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </aside><!-- #secondary -->
</div>