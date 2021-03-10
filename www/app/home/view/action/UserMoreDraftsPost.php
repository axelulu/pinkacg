<?php
use model\PostMeta;
use model\Menu;
use model\UserMeta;
use model\SiteMeta;

$userid = $_REQUEST['userid'];
$page = $_REQUEST['page'];
$num = 12 * $page;
$post_meta = PostMeta::GetPostsMetaByAuthor(8*$page,$userid,'post_modified','publish',8);
if(!$post_meta){
    header( 'content-type: application/json; charset=utf-8' );
    $result['status']	= 0;
    echo json_encode( $result );
    exit();
}
?>
<?php foreach($post_meta as $post_meta){ ?>
    <tr class="page-<?php echo $page;?>">
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