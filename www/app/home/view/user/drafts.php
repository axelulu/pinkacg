<?php
global $LOGINUSER;
use model\UserMeta;
use model\SiteMeta;
use model\PostMeta;
$post_meta = PostMeta::GetPostsMetaByAuthor(8,$LOGINUSER['ID'],'post_modified','publish');
?>
<div class="ghost_setting_content">
    <div class="drafts ghost_setting_content_container" data-userid="<?php echo $LOGINUSER['ID'];?>">
        <fieldset class="ghost_setting_content_item">
            <legend class="ghost_setting_content_item_title">
                <span class="ghost_setting_content_primary">
                    <span class="poi-icon fa-user-circle fas fa-fw" aria-hidden="true"></span>
                    <span class="ghost_setting_content_text">我的稿件</span></span>
            </legend>
            <div class="ghost_setting_content_item_content">
                <div class="ghost_setting_content_preface">
                    <p>您可以在这个页面查看您发布过的帖子，鼠标悬浮即可见编辑按钮。</p>
                    <p>重新编辑帖子后需要二次审核，请谨慎编辑哦！</p>
                </div>
                <div class="ghost_setting_content_my_avatar">
                    <section class="ghost_drafts_posts_table_section">
                        <table class="ghost_drafts_posts_table">
                            <thead>
                            <tr>
                                <th>封面</th>
                                <th>标题</th>
                                <th>操作</th>
                                <th>状态</th>
                                <th>类型</th>
                                <th>日期</th>
                                <th>评论</th>
                                <th>下载</th>
                                <th>点赞</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($post_meta as $post_meta){ ?>
                                <tr class="page-1">
                                    <td class="ghost_drafts_thumbnail" title="封面">
                                        <a class="ghost_drafts_item_thumbnail" href="<?php echo PostMeta::GetPostUrl($post_meta['ID']);?>" target="_blank">
                                            <img class="ghost_drafts_thumbnail_img lazy show" src="<?php echo SiteMeta::GetSiteMetaItem('site_lazy_img');?>" data-original="<?php echo $post_meta['post_header_img'];?>" alt="封面" width="320" height="180"></a>
                                    </td>
                                    <td class="ghost_drafts_postTitle" style="width: 32%;" title="标题">
                                        <a class="ghost_drafts_item_title" href="<?php echo PostMeta::GetPostUrl($post_meta['ID']);?>" target="_blank" title="查看文章"><?php echo $post_meta['post_title'];?></a></td>
                                    <td class="ghost_drafts_control" title="操作">
                                        <div class="ghost_drafts_item_action">
                                            <a href="<?php echo URL . '?c=User&m=editpost&id=' . $post_meta['ID'];?>" target="_blank" title="(编辑)" class="inn-account__my-posts__item__action__link">
                                                <span class="poi-icon fa-edit fas fa-fw" aria-hidden="true"></span>
                                                <span class="poi-icon__text">(编辑)</span></a>
                                        </div>
                                    </td>
                                    <td class="ghost_drafts_status" title="状态">已发布</td>
                                    <td class="ghost_drafts_format" title="类型">标准</td>
                                    <td class="ghost_drafts_date" title="日期"><?php echo UserMeta::TimeTran($post_meta['post_date']);?></td>
                                    <td class="ghost_drafts_comments" title="评论">
                                        <span class="poi-icon fa-comments fas fa-fw" aria-hidden="true"></span><?php echo $post_meta['comment_count'];?></td>
                                    <td class="ghost_drafts_downloads" title="下载">
                                        <span class="poi-icon fa-cloud-download fas fa-fw" aria-hidden="true"></span>0</td>
                                    <td class="ghost_drafts_like" title="文章点赞">
                                        <span class="poi-icon fa-thumbs-o-up fas fa-fw" aria-hidden="true"></span>0</td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                        <div class="ghost_drafts_more_post">
                            <a data-paged="1" class="more-post ajax-morepost">更多文章 <i class="tico tico-angle-right"></i></a>
                        </div>
                    </section>
                </div>
            </div>
        </fieldset>
    </div>
</div>