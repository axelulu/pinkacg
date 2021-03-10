<?php
use model\PostMeta;
use model\SiteMeta;

$post_meta = PostMeta::GetPostsMeta(11,'pc','post_modified');
?>
<section id="mod-show" class="content-section clearfix full">
    <div id="popular">
        <div id="ghost-popular-container" class="ghost-popular-container">
            <div class="ghost-popular">
                <?php
                foreach($post_meta as $post_meta){?>
                <a class="ghost-slideshow__item__link ghost-popular-link" href="<?php echo PostMeta::GetPostUrl($post_meta['ID']);?>" style="background-color: rgba(225,225,225,.3);">
                    <img src="<?php echo SiteMeta::GetSiteMetaItem('site_lazy_img');?>" data-original="<?php echo $post_meta['post_header_img'];?>" alt="<?php echo $post_meta['post_title'];?>" class="lazy ghost-popular-img show" style="background-color: rgb(245, 217, 215); display: inline;">
                    <div class="ghost-popular-mask"></div>
                    <h3 class="ghost-popular-title">
                        <span class="ghost-popular-text"><?php echo $post_meta['post_title'];?></span>
                    </h3>
                </a>
                <?php } ?>
            </div>
        </div>
    </div>
</section>