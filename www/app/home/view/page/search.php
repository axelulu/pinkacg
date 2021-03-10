<?php
use model\Menu;
use model\SiteMeta;
$menu = Menu::GetMenuMeta();
?>
<div class="main">
    <div class="search container">
        <form action="https://pinkacg.com" class="ghost_search_form">
            <div class="ghost_search_form_container">
                <label for="ghost_search_form_s" class="ghost_search_form_input_label">
                    <span class="poi-icon fa-search fas fa-fw" aria-hidden="true"></span>
                </label>
                <input type="search" name="s" class="ghost_search_form_s" placeholder="您想搜索什么？" value="<?php echo Search; ?>"></div>
            <div class="ghost_search_form_cat_container">
                <div class="ghost_search_form_group">
                    <span class="ghost_search_form_group_title">分类 : </span>
                    <div class="ghost_search_form_condition_container">
                        <div class="ghost_search_form_condition_group">
                            <?php
                            foreach($menu as $menu_item){?>
                                <label class="ghost_search_form_condition_label"><input type="radio" hidden="" value="0" checked=""><span data-id="7792" data-page="0" class="ghost_search_form_condition_text is-checked"><?php echo Menu::GetMenuTitle($menu_item['slug'],true);?></span></label>
                            <?php } ?>
                        </div>
                        <div></div>
                    </div>
                </div>
            </div>
        </form>
        <div class="search_box">
            <section class="cat-2 cat-col cat-col-full">
                <div class="cat-container clearfix">
                    <div id="ghost_box_1" class="cms-cat cms-cat-s7"><div class="page-1">
                            <div class="col-md-2 box-1 float-left">
                                <article id="post-5056" class="post type-post status-publish format-standard">
                                    <div class="entry-thumb hover-scale">
                                        <a href="https://pinkacg.com/171.html"><img width="500" height="340" src="<?php echo SiteMeta::GetSiteMetaItem('site_lazy_img');?>" data-original="https://img.catacg.cn/pinkacg_upload/img/2020/06/16dd04d42f526a.jpg?x-oss-process=style/style-pinkacg" class="lazy show" alt="【PV】《请问您今天要来点兔子吗》OVA PV公开 2019年9月26日发售为您朗读" style="display: block;"></a>
                                        <ul class="post-categories">
                                            <li><a href="https://pinkacg.com/new/original" rel="category tag">原创</a></li></ul>            </div>
                                    <a href="https://pinkacg.com/author/1" target="_blank" class="post_box_avatar_link" title="小宅酱">
                                        <img class="post_box_avatar_img" title="小宅酱" src="https://fontawesome.catacg.cn/avatar_img/1/1-cd72a9f3c5ceb1498046b5c9065d5623.jpg" width="50" height="50" alt="小宅酱">
                                        <span class="post_box_avatar_author_name">小宅酱</span>
                                    </a>
                                    <div class="entry-detail">
                                        <header class="entry-header">
                                            <h2 class="entry-title h4"><a href="https://pinkacg.com/171.html" rel="bookmark">【PV】《请问您今天要来点兔子吗》OVA PV公开 2019年9月26日发售为您朗读</a>
                                            </h2>
                                            <div class="entry-meta entry-meta-1">
                                                <span class="entry-date text-muted"><i class="fas fa-bell"></i><time class="entry-date" datetime="2019-07-17 21:36:10" title="2019-07-17 21:36:10">2年前</time></span>
                                                <span class="comments-link text-muted pull-right"><i class="far fa-comment"></i><a href="https://pinkacg.com/171.html">2</a></span>
                                                <span class="views-count text-muted pull-right"><i class="fas fa-eye"></i>83</span>
                                            </div>
                                        </header>
                                    </div>
                                </article>
                            </div>
                            <div class="ghost_other_more_post">
                                <a data-paged="1" data-search="漫" class="more-post ajax-morepost">更多文章 <i class="tico tico-angle-right"></i></a>
                            </div>
                        </div>
                        <script>

                            jQuery(function ($) {
                                //   搜索加载更多
                                $(".search .ajax-morepost").click(function(){
                                    $page = $('.ajax-morepost').attr('data-paged');
                                    $search = $('.ajax-morepost').attr('data-search');
                                    $catid = $('.active').find('.ghost_search_form_condition_text').attr('data-id');
                                    $('.ajax-morepost').attr('data-paged',++$page);
                                    $.ajax({
                                        url:ghost.ghost_ajax+"/action/search_box.php",
                                        type:'POST',
                                        data:{page: $page,search: $search,catid: $catid},
                                        success:function(msg){
                                            if(msg.status==0){
                                                $('.ajax-morepost').html("加载完毕");
                                            }else{
                                                $('#ghost_box_1').append(msg);
                                                $('.page-'+($page)+' img.lazy').lazyload({
                                                    effect: "fadeIn",
                                                });
                                            }
                                        }
                                    });
                                });
                            });
                        </script>
                    </div>
                </div>
            </section>        </div>
    </div>
</div>
