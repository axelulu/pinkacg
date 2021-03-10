<?php
global $LOGIN,$LOGINUSER;
use model\PostMeta;
use model\SiteMeta;
use model\UserMeta;
use model\Menu;
use model\UserComment;

$PostMeta = PostMeta::GetPostMeta(PostId);
$BottomPosts = PostMeta::GetPostsMeta(12,json_decode($PostMeta['post_menu'])[0],'post_modified');
$PostAuthorMeta = UserMeta::GetAuthorMeta($PostMeta['post_author']);
$PostCommentsMeta = UserComment::noLimitComment(UserComment::GetPostComments(PostId));
$video_urls = $PostMeta['post_video'] ? json_decode($PostMeta['post_video']) : '';
$music_urls = $PostMeta['post_music'] ? json_decode($PostMeta['post_music']) : '';
// 下载
$download_urls = $PostMeta['post_download_link'] ? unserialize($PostMeta['post_download_link']) : '';
?>
<!-- 视频 -->
<?php if($video_urls){?>
    <div data-id="<?php echo PostId; ?>" class="post_video_mod">
    <div class="container clearfix">
        <div id="post_video" class="post-style-5-video-box">
            <?php if( $LOGIN ) {?>
                <iframe src="https://pinkacg.com/player/?url=<?php echo $video_urls[0]->link; ?>" class="iframe ghost_play" width="810" height="450"></iframe>
            <?php }elseif(!$LOGIN){ ?>
                <div class="post_video_login">
                    <div class="ghost_download_content_btn" style="width:100px">
                        <div class="poi-btn-group">
                            <a class="ghost_btn ghost_btn_success download user-login" rel="noreferrer" target="_blank">
                                <span class="poi-icon fa-cloud-download-alt fas fa-fw" aria-hidden="true"></span>
                                <span class="ghost_icon_text">登陆</span></a>
                        </div>
                    </div>
                </div>
            <?php }else{ ?>
                <div class="post_video_login">
                    <div class="ghost_download_content_btn" style="width:100px">
                        <div class="poi-btn-group">
                            <a href="/" class="ghost_btn ghost_btn_success download" rel="noreferrer" target="_blank">
                                <span class="poi-icon fa-cloud-download-alt fas fa-fw" aria-hidden="true"></span>
                                <span class="ghost_icon_text">答题</span></a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="post-video-list">
            <ul class="video_post_right">
                <?php 
                foreach($video_urls as $video_url){ ?>
                    <li class="switch_set" data-url="<?php echo $video_url->link ?>">
                        <div>
                            <div class="post-video-list-img">
                                <img src="<?php echo $video_url->link.'?x-oss-process=video/snapshot,t_7000,f_jpg,w_100,h_60,m_fast' ?>"></div>
                            <div class="video-list-title">
                                <span><?php echo $video_url->name ?></span></div>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>    
<?php } ?>

<!-- 正文 -->
<div class="main single container">
    <div class="clearfix">
        <div data-id="78561" class="article float-left col-lg-9">
            <article>
                <h1 class="ghost_single_title"><?php echo $PostMeta['post_title'];?></h1>
                <header class="ghost_single_header"> 
                    <span class="single_header_item ghost_single_category" title="分类"> 
								<a href="<?php echo Menu::GetMenuUrl($PostMeta['post_menu']);?>" rel="category tag">
                        <i class="fa-folder-open fas fa-fw poi-icon" aria-hidden="true"></i> 
                        <span class="ghost_icon_text"><?php echo Menu::GetMenuTitle($PostMeta['post_menu']);?></span>
								</a>
                    </span>
                    <time datetime="<?php echo $PostMeta['post_date'];?>" class="single_header_item ghost_single_date" title="<?php echo Menu::TimeTran($PostMeta['post_date']);?>">
                        <i class="fa-clock fas fa-fw poi-icon" aria-hidden="true"></i>
                        <span class="ghost_icon_text"><?php echo Menu::TimeTran($PostMeta['post_date']);?></span>
                    </time>
                    <a href="<?php echo HOME_URL;?>author/<?php echo $PostAuthorMeta['ID'];?>" title="<?php echo $PostAuthorMeta['display_name'];?>" class="single_header_item ghost_single_author">
                        <i class="fa-user-circle fas fa-fw poi-icon" aria-hidden="true"></i> <span class="ghost_icon_text"><?php echo $PostAuthorMeta['display_name'];?></span>
                    </a>
                    <span class="single_header_item ghost_single_view" title="查看数"> 
								<a href="javascript:void(0)">
									<i class="fa-play-circle fas fa-fw poi-icon" aria-hidden="true"></i> 
                        <span class="ghost_single_view_num"><?php echo $PostMeta['post_views'];?></span>
									</a>
                    </span>
                    <span class="single_header_item ghost_single_comment_count" title="评论数">
								<a href="javascript:void(0)">
                        <i class="fa-comments fas fa-fw poi-icon" aria-hidden="true"></i> 
                        <span class="ghost_single_comment_count_num"><?php echo $PostMeta['comment_count'];?></span>
									</a>
                    </span>
                    <span class="single_header_item ghost_single_sell_count" title="文章出售数量">
								<a href="javascript:void(0)">
                        <i class="fas fa-shopping-cart fa-fw poi-icon" aria-hidden="true"></i> 
                        <span class="ghost_single_sell_count_num"><?php echo $PostMeta['comment_count'];?></span>
									</a>
                    </span>
                    <span class="single_header_item " title="编辑文章">
                        <a href="https://pinkacg.com/me/edit_post?post_id=78561" target="_blank"><i class="poi-icon fas fa-paint-brush fa-fw" aria-hidden="true"></i> 
                            <span class="">编辑文章</span></a>
                    </span>
                    <span class="single_header_item delete_my_post" title="删除文章">
								<a href="javascript:void(0)">
                        <i class="fa-comments fas fa-fw poi-icon" aria-hidden="true"></i> 
                        <span class="">删除文章</span>
									</a>
                    </span>
                    <span class="single_header_item " title="百度收录">
                        <i class="fa-comments fas fa-fw poi-icon" aria-hidden="true"></i> 
                        <span class=""><a target="_blank" title="点击查看" rel="external nofollow" href="https://www.baidu.com/s?wd=赛博朋克2077中文破解版下载">百度已收录</a></span>
                    </span>
                </header>
                <div class="single_post_body">
                    <!--文章内容-->
                    <?php echo $PostMeta['post_content'];?>
                </div>

                <!-- 下载链接 -->
                <div class="ghost_download_content">
					<div>文章作者的链接:</div>
                    <?php
                    //是否存在下载链接
                    if(!empty($download_urls)):
                        //判断是否登陆
                        if( $LOGIN ) {
                            //循环所有下载链接
                            foreach($download_urls as $key => $downloads){
                            if( $downloads['credit']==0 || !isset($downloads['credit']) || PostMeta::IsBuyPost($LOGINUSER['ID'],PostId,$key) || $LOGINUSER['ID'] === $PostAuthorMeta['ID']){?>
                                <fieldset class="ghost_download_content_content">
                                    <legend class="ghost_download_content_name">
                                        <span class="ghost_download_label_success"><?php echo $downloads['name']; ?></span></legend>
                                    <div class="ghost_download_content_item_download_pwd">
                                        <div class="ghost_download_">
                                            <div class="col-lg-2 float-left">
                                                <div class="ghost_download_content_item_label">
                                                    <span class="poi-icon fa-unlock-alt fas fa-fw" aria-hidden="true"></span>
                                                    <span class="ghost_icon_text">提取密码</span></div>
                                            </div>
                                            <div style="padding-right:0px" class="col-lg-10 float-left">
                                                <div class="poi-btn-group">
                                                    <input class="ghost_input ghost_download_content_item_input" type="text" readonly="" value="<?php echo $downloads['pwd']; ?>">
                                                    <a class="ghost_btn ghost_btn_success ghost_btn_copy">
                                                        <span class="poi-icon fa-copy fas fa-fw" aria-hidden="true"></span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ghost_download_content_item_extract_pwd">
                                        <div class="ghost_download_">
                                            <div class="col-lg-2 float-left">
                                                <div class="ghost_download_content_item_label">
                                                    <span class="poi-icon fa-key fas fa-fw" aria-hidden="true"></span>
                                                    <span class="ghost_icon_text">解压密码</span></div>
                                            </div>
                                            <div style="padding-right:0px" class="col-lg-10 float-left">
                                                <div class="poi-btn-group">
                                                    <input class="ghost_input ghost_download_content_item_input" type="text" readonly="" value="<?php echo $downloads['pwd2']; ?>">
                                                    <a class="ghost_btn ghost_btn_success ghost_btn_copy">
                                                        <span class="poi-icon fa-copy fas fa-fw" aria-hidden="true"></span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ghost_download_content_btn">
                                        <div class="poi-btn-group">
                                            <a href="<?php echo $downloads['link']; ?>" value="<?php echo $downloads['link']; ?>" class="ghost_btn ghost_btn_success download" rel="noreferrer" target="_blank">
                                                <span class="poi-icon fa-cloud-download-alt fas fa-fw" aria-hidden="true"></span>
                                                <span class="ghost_icon_text">下载（如果点击无反应，可能是磁力链接）</span></a>
                                        </div>
                                    </div>
                                </fieldset>
                            <?php }else{?>
                                <fieldset class="ghost_download_content_content">
                                    <legend class="ghost_download_content_name">
                                        <span class="ghost_download_label_success"><?php echo $downloads['name']; ?></span></legend>
                                    <div class="ghost_download_content_btn">
                                        <div class="poi-btn-group">
                                            <a class="ghost_btn ghost_btn_success download buy_download_link" data-id="<?php echo $key ?>" data-author_id="<?php echo $PostAuthorMeta['ID'] ?>" data-user_id="<?php echo $LOGINUSER['ID'] ?>" data-postid="<?php echo PostId ?>" rel="noreferrer" target="_blank">
                                                <span class="poi-icon fa-cloud-download-alt fas fa-fw" aria-hidden="true"></span>
                                                <span class="ghost_icon_text"><?php echo $downloads['credit']; ?>积分购买</span></a>
                                        </div>
                                    </div>
                                </fieldset>
							<?php }
							}
                    }elseif(!$LOGIN){?>
                        <div class="ghost_download_content_btn">
                            <div class="poi-btn-group">
                                <a class="ghost_btn ghost_btn_success download user-login" rel="noreferrer" target="_blank">
                                    <span class="poi-icon fa-cloud-download-alt fas fa-fw" aria-hidden="true"></span>
                                    <span class="ghost_icon_text">登陆查看下载链接</span></a>
                            </div>
                        </div>
                    <? }else{?>
                        <div class="ghost_download_content_btn">
                            <div class="poi-btn-group">
                                <a href="/" class="ghost_btn ghost_btn_success download" rel="noreferrer" target="_blank">
                                    <span class="poi-icon fa-cloud-download-alt fas fa-fw" aria-hidden="true"></span>
                                    <span class="ghost_icon_text">答题成为正式会员即可查看下载链接</span></a>
                            </div>
                        </div>
                    <? }endif; ?>
					<div>热心网友的补链:</div>
                    <?php
                        if(isset($adddownload)):
                            if( $LOGIN ) {
								foreach($adddownload as $key => $downloads){?>
                                    <fieldset class="ghost_download_content_content">
                                        <legend class="ghost_download_content_name">
                                            <span class="ghost_download_label_success"><?php echo $downloads['name']; ?><a href="<?php echo ghost_get_user_author_link($downloads['userid']); ?>">-->链接提供者：<?php echo get_user_meta($downloads['userid'],'nickname',true) ?></a></span></legend>
                                        <div class="ghost_download_content_item_download_pwd">
                                            <div class="ghost_download_">
                                                <div class="col-lg-2 float-left">
                                                    <div class="ghost_download_content_item_label">
                                                        <span class="poi-icon fa-unlock-alt fas fa-fw" aria-hidden="true"></span>
                                                        <span class="ghost_icon_text">提取密码</span></div>
                                                </div>
                                                <div style="padding-right:0px" class="col-lg-10 float-left">
                                                    <div class="poi-btn-group">
                                                        <input class="ghost_input ghost_download_content_item_input" type="text" readonly="" value="<?php echo $downloads['pwd']; ?>">
                                                        <a class="ghost_btn ghost_btn_success ghost_btn_copy">
                                                            <span class="poi-icon fa-copy fas fa-fw" aria-hidden="true"></span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ghost_download_content_item_extract_pwd">
                                            <div class="ghost_download_">
                                                <div class="col-lg-2 float-left">
                                                    <div class="ghost_download_content_item_label">
                                                        <span class="poi-icon fa-key fas fa-fw" aria-hidden="true"></span>
                                                        <span class="ghost_icon_text">解压密码</span></div>
                                                </div>
                                                <div style="padding-right:0px" class="col-lg-10 float-left">
                                                    <div class="poi-btn-group">
                                                        <input class="ghost_input ghost_download_content_item_input" type="text" readonly="" value="<?php echo $downloads['pwd2']; ?>">
                                                        <a class="ghost_btn ghost_btn_success ghost_btn_copy">
                                                            <span class="poi-icon fa-copy fas fa-fw" aria-hidden="true"></span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ghost_download_content_btn">
                                            <div class="poi-btn-group">
                                                <a href="<?php echo $downloads['link']; ?>" value="<?php echo $downloads['link']; ?>" class="ghost_btn ghost_btn_success download" rel="noreferrer" target="_blank">
                                                    <span class="poi-icon fa-cloud-download-alt fas fa-fw" aria-hidden="true"></span>
                                                    <span class="ghost_icon_text">下载（如果点击无反应，可能是磁力链接）</span></a>
                                            </div>
                                        </div>
                                    </fieldset>
						<?php }}endif;?>
                </div>

                <!-- 标签 -->
                <footer class="single_post_footer">
                    <div class="single_post_footer_tags">
                        <a href="https://pinkacg.com/tag/%e8%b5%9b%e5%8d%9a%e6%9c%8b%e5%85%8b2077" rel="tag">赛博朋克2077</a><br>                    
                    </div>
                    <div class="single_post_footer_box">
                        <div class="single_post_footer_share">
                            <a href="http://service.weibo.com/share/share.php?url=https://pinkacg.com/78561.html&amp;coun=1&amp;pic=&amp;title=赛博朋克2077中文破解版下载" class="inn-singular__post__share__item poi-tooltip poi-tooltip_top" rel="nofollow" title="分享到微博" aria-label="分享到微博">
                                <i class="fa-weibo fab fa-fw poi-icon" aria-hidden="true"></i>
                            </a>
                            <a href="http://connect.qq.com/widget/shareqq/index.html?url=https://pinkacg.com/78561.html&amp;desc=来<粉萌次元>看看这篇文章吧，有惊喜哦！&amp;title=赛博朋克2077中文破解版下载&amp;summary=赛博朋克2077中文破解版下载&amp;pics=&amp;site=粉萌次元" class="inn-singular__post__share__item poi-tooltip poi-tooltip_top" rel="nofollow" title="分享到QQ空间" aria-label="分享到QQ空间">
                                <i class="fa-qq fab fa-fw poi-icon" aria-hidden="true"></i>
                            </a>
                            <a href="" class="inn-singular__post__share__item poi-tooltip poi-tooltip_top" rel="nofollow" title="分享到微信" aria-label="分享到微信">
                                <i class="fa-weixin fab fa-fw poi-icon" aria-hidden="true"></i>
                            </a>
                            <a href="http://tieba.baidu.com/f/commit/share/openShareApi?url=https://pinkacg.com/78561.html&amp;title=赛博朋克2077中文破解版下载&amp;comment=&amp;pic=&amp;red_tag=y2016799123" class="inn-singular__post__share__item poi-tooltip poi-tooltip_top" rel="nofollow" title="分享到贴吧" aria-label="分享到贴吧">
                                <i class="fa-bold fas fa-fw poi-icon" aria-hidden="true"></i>
                            </a>
                        </div>
                        <div id="ghost-report" class="single_post_footer_report">
                            <div class="ghost_report single_post_footer_container">
                                <a class="single_post_footer_btn"><span class="poi-icon fa-paperclip fas fa-fw" aria-hidden="true"></span> <span class="ghost_icon_text">链接失效</span></a>
                            </div>
                        </div>
                        <div id="ghost-add_link" class="single_post_footer_report">
                            <div data-userid="1" class="<?php Menu::IsLogin('ghost_add_link')?> single_post_footer_container">
                                <a class="single_post_footer_btn"><span class="poi-icon fa-link fas fa-fw" aria-hidden="true"></span> <span class="ghost_icon_text">帮他补链</span></a>
                            </div>
                        </div>
                        <div class="single_post_footer_report">
                            <div class="<?php Menu::IsLogin('download_img')?> single_post_footer_container">
                                <a class="single_post_footer_btn"><span class="poi-icon fa-images fas fa-fw" aria-hidden="true"></span> <span class="ghost_icon_text">图片下载</span></a>
                            </div>
                        </div>
                        <div class="single_post_footer_report">
                            <div class="<?php Menu::IsLogin('post_stars')?> single_post_footer_container">
                                <a class="single_post_footer_btn"><span class="poi-icon fa-star far fa-fw" aria-hidden="true"></span> <span class="ghost_icon_text">收藏文章</span></a>
                            </div>
                        </div>
                    </div>
                    <ul class="single_post_footer_source">
                        <li> 本作品是由 <a href="https://pinkacg.com">粉萌次元</a> 会员 <a href="https://pinkacg.com/author/1">小宅酱</a> 的投递作品。 </li> <li>转载请务请署名并注明出处：<a href="https://pinkacg.com/78561.html" rel="nofollow">https://pinkacg.com/78561.html</a>。</li>
                        <li>禁止再次修改后发布；任何商业用途均须联系作者。如未经授权用作他处，作者将保留追究侵权者法律责任的权利。</li>
                    </ul>
                </footer>
            </article>

            <!-- 底部文章模块 -->
            <section>
                <div class="cat-container clearfix">
                    <div id="ghost_box_1" class="cms-cat cms-cat-s7">
                        <div class="single_more_posts">
                            <?php
                            foreach($BottomPosts as $PostMeta){
                                $PostUserMeta = UserMeta::GetAuthorMeta($PostMeta['post_author']);
                                $PostUrl = PostMeta::GetPostUrl($PostMeta['ID']);?>
                                <div class="col-md-3 box-1 float-left">
                                    <article id="post-78060" class="post type-post status-publish format-standard">
                                        <div class="entry-thumb hover-scale">
                                            <a href="<?php echo $PostUrl;?>"><img width="500" height="340" src="<?php echo SiteMeta::GetSiteMetaItem('site_lazy_img');?>" data-original="<?php echo $PostMeta['post_header_img'];?>" class="lazy show" alt="<?php echo $PostMeta['post_title'];?>" style="display: block;"></a>
                                            <ul class="post-categories">
                                                <li><a href="<?php echo Menu::GetMenuUrl($PostMeta['post_menu']);?>" rel="category tag"><?php echo Menu::GetMenuTitle($PostMeta['post_menu']);?></a></li></ul>
                                        </div>
                                        <a href="<?php echo $PostUrl;?>" target="_blank" class="post_box_avatar_link" title="<?php echo $PostMeta['post_author'];?>">
                                            <img class="post_box_avatar_img" title="<?php echo $PostUserMeta['display_name'];?>" src="<?php echo $PostUserMeta['user_avatar'];?>" width="50" height="50" alt="<?php echo $PostUserMeta['display_name'];?>">
                                            <span class="post_box_avatar_author_name"><?php echo $PostUserMeta['display_name'];?></span>
                                        </a>
                                        <div class="entry-detail">
                                            <header class="entry-header">
                                                <h2 class="entry-title h4"><a href="<?php echo $PostUrl;?>" rel="bookmark"><?php echo $PostMeta['post_title'];?></a>
                                                </h2>
                                                <div class="entry-meta entry-meta-1">
                                                    <span class="entry-date text-muted"><i class="fas fa-bell"></i><time class="entry-date" datetime="<?php echo $PostMeta['post_date'];?>" title="<?php echo Menu::TimeTran($PostMeta['post_date']);?>"><?php echo Menu::TimeTran($PostMeta['post_date']);?></time></span>
                                                    <span class="comments-link text-muted pull-right"><i class="far fa-comment"></i><a href="<?php echo $PostUrl;?>"><?php echo $PostMeta['comment_count'];?></a></span>
                                                    <span class="views-count text-muted pull-right"><i class="fas fa-eye"></i><?php echo $PostMeta['post_views'];?></span>
                                                </div>
                                            </header>
                                        </div>
                                    </article>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </section>

            <!-- 评论 -->
            <aside>
                <div class="ghost_comment">
                    <div class="<?php Menu::IsLogin('join_comments')?> ghost_comment_faker">
                        <img class="ghost_comment_faker_avatar" src="<?php echo SiteMeta::GetSiteMetaItem('site_default_avatar');?>" alt="avatar" width="18" height="18">
                        <span class="ghost_comment_text">点击参与讨论！</span></div>
                    <h2 class="ghost_comment_title">
                        <span class="poi-icon fa-comments fas fa-fw" aria-hidden="true"></span>
                        <span class="ghost_icon_text">评论</span></h2>
                    <div class="ghost_comment_container">
                        <section>
                            <?php foreach($PostCommentsMeta as $Comment){ ?>
                            <section id="comment-4883" class="ghost_comment_item_container">
                                <div class="ghost_comment_item">
                                    <div class="ghost_comment_item_avatar">
                                        <a href="<?php echo PostMeta::GetPostUrl($Comment['user_id']);?>" class="inn-comment__item__avatar__link" title="shawu">
                                            <img style="padding: 8px;width: 50px;border-radius:50%;height: 50px;" alt="" src="<?php echo UserMeta::GetAuthorMeta($Comment['user_id'])['user_avatar'];?>" class="avatar avatar-50 photo" height="50" width="50"></a>
                                    </div>
                                    <div class="ghost_comment_item_body">
                                        <header class="ghost_comment_item_header">
                                            <div class="ghost_comment_header_text">
                                                <div class="ghost_comment_item_meta_container">
                                                    <a href="" class="ghost_comment_item_author_link"><?php echo UserMeta::GetAuthorMeta($Comment['user_id'])['display_name'];?></a>
                                                    <span class="ghost_comment_item_label_role" style="background-color: rgb(225, 179, 42);"><?php echo UserMeta::GetAuthorMeta($Comment['user_id'])['display_name'];?></span></div>
                                                <div class="ghost_comment_item_author_container">
                                                    <span class="ghost_comment_item_time"><?php echo Menu::TimeTran($Comment['comment_date']);?></span></div>
                                            </div>
                                            <div class="ghost_comment_item_header_tool_container">
                                                <a data-commentid="<?php echo $Comment['comment_ID'];?>" class="poi-tooltip is-top ghost_comment_item_like_btn ghost_like_active" title="赞">
                                                    <span class="ghost_comment_item_like_btn_icon poi-icon fa-thumbs-up far fa-fw" aria-hidden="true"></span>
                                                    <span></span>
                                                </a>
                                                <a data-commentid="<?php echo $Comment['comment_ID'];?>" class="ghost_comment_item_reply_btn ghost_reply_active">回复</a>
                                            </div>
                                        </header>
                                        <div class="ghost_comment_item_content">
                                            <div class="ghost_comment_item_content_text"><?php echo $Comment['comment_content'];?></div></div>
                                    </div>
                                </div>
                                <?php
                                foreach($PostCommentsMeta as $CommentChild){
                                if($CommentChild['comment_parent'] == $Comment['comment_ID']){ ?>
                                <section id="comment-4428" class="ghost_comment_item_container">
                                    <div class="ghost_comment_item">
                                        <div class="ghost_comment_item_avatar">
                                            <a href="<?php echo PostMeta::GetPostUrl($CommentChild['user_id']);?>" class="inn-comment__item__avatar__link" title="shawu">
                                                <img style="padding: 8px;width: 50px;border-radius:50%;height: 50px;" alt="" src="<?php echo UserMeta::GetAuthorMeta($CommentChild['user_id'])['user_avatar'];?>" class="avatar avatar-50 photo" height="50" width="50"></a>
                                        </div>
                                        <div class="ghost_comment_item_body">
                                            <header class="ghost_comment_item_header">
                                                <div class="ghost_comment_header_text">
                                                    <div class="ghost_comment_item_meta_container">
                                                        <a href="" class="ghost_comment_item_author_link"><?php echo UserMeta::GetAuthorMeta($CommentChild['user_id'])['display_name'];?></a>
                                                        <span class="ghost_comment_item_label_role" style="background-color: rgb(225, 179, 42);"><?php echo UserMeta::GetAuthorMeta($CommentChild['user_id'])['display_name'];?></span></div>
                                                    <div class="ghost_comment_item_author_container">
                                                        <span class="ghost_comment_item_time"><?php echo Menu::TimeTran($CommentChild['comment_date']);?></span></div>
                                                </div>
                                                <div class="ghost_comment_item_header_tool_container">
                                                    <a data-commentid="<?php echo $CommentChild['comment_ID'];?>" class="poi-tooltip is-top ghost_comment_item_like_btn ghost_like_active" title="赞">
                                                        <span class="ghost_comment_item_like_btn_icon poi-icon fa-thumbs-up far fa-fw" aria-hidden="true"></span>
                                                        <span></span>
                                                    </a>
                                                    <a data-commentid="<?php echo $CommentChild['comment_ID'];?>" class="ghost_comment_item_reply_btn ghost_reply_active">回复</a>
                                                </div>
                                            </header>
                                            <div class="ghost_comment_item_content">
                                                <div class="ghost_comment_item_content_text"><?php echo $CommentChild['comment_content'];?></div></div>
                                        </div>
                                    </div>
                                </section>
                                <?php }} ?>
                            </section>
                        <?php } ?>
                    </div>
                </div>
            </aside>
        </div>
        <?php require HOME_VIEW . 'mod/aside.php'?>
    </div>
</div>
<script>
    var FunLib = {
        // 图片打包下载
        download: function (images) {
            FunLib.packageImages(images)
        },
        // 打包压缩图片
        packageImages: function (imgs) {
            var imgBase64 = []
            var imageSuffix = [] // 图片后缀
            var zip = new JSZip()
            var img = zip.folder("images")

            for (var i = 0; i < imgs.length; i++) {
                var src = imgs[i].url
                var suffix = src.substring(src.lastIndexOf("."))
                imageSuffix.push(suffix)
                FunLib.getBase64(imgs[i].url).then(function (base64) {
                    imgBase64.push(base64.substring(22))
                    if (imgs.length === imgBase64.length) {
                        for (var i = 0; i < imgs.length; i++) {
                            img.file(imgs[i].name + imageSuffix[i], imgBase64[i], {base64: true})
                        }
                        zip.generateAsync({type: "blob"}).then(function (content) {
                            saveAs(content, "images.zip")
                        })
                    }
                }, function (err) {
                    console.log(err)
                })
            }
        },
        // 传入图片路径，返回base64
        getBase64: function (img) {
            var image = new Image()
            image.crossOrigin = 'Anonymous'
            image.src = img
            var deferred = $.Deferred()
            if (img) {
                image.onload = function () {
                    var canvas = document.createElement("canvas")
                    canvas.width = image.width
                    canvas.height = image.height
                    var ctx = canvas.getContext("2d")
                    ctx.drawImage(image, 0, 0, canvas.width, canvas.height)
                    var dataURL = canvas.toDataURL()
                    deferred.resolve(dataURL)
                }
                return deferred.promise()
            }
        }
    }

    $('.single').on('click', '.download_img',
        function(event) {
            $(this).removeClass('download_img');
            var imgs = new Array();
            var img = $('.content img');
            for(var i=0;i<img.length;i++){
                imgs[i] = new Object();
                imgs[i].url = img.get(i).src;
                imgs[i].name = i;
            }
            FunLib.download(imgs);
            $(this).html('<a class="single_post_footer_btn"><span class="poi-icon fa-flag fas fa-fw" aria-hidden="true"></span> <span class="ghost_icon_text">已请求，请等待</span></a>');
        })
    //获取banner的高度
    var bannerH=$(".widget_ghost_author").offset().top + $(".widget_ghost_author").height()-47;
    //滚动事件
    $(window).scroll(function(){
        var nScrollTop = $(document).height() - $(document).scrollTop() - 1010 - 170;
        var scrollTop=$(this).scrollTop();
//判断bannerH大于或者等于scrollTop高度
        if(scrollTop >= bannerH ){
            $(".widget_ghost_hot_post").addClass('widget_ghost_author_fixed');
            $(".widget_ghost_hot_post").css('left',$(".weight").offset().left+7);
            $(".widget_ghost_hot_post").css('top','56px');
        }else{
            $(".widget_ghost_hot_post").removeClass('widget_ghost_author_fixed');
            $(".widget_ghost_hot_post").css('left','');
            $(".widget_ghost_hot_post").css('top','');
        }
        if(nScrollTop <= 0 ){
            $(".widget_ghost_hot_post").removeClass('widget_ghost_author_fixed');
            $(".widget_ghost_hot_post").css('top','');
        }else{
        }
    })
</script>