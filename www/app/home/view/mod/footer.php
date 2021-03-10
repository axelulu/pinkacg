<?php
use model\SiteMeta;?>
<script>
jQuery(function($) {
    // 顶部滚动菜单
    $(document).scroll(function() {
        var top1 = $(".main").offset().top;
        var gun = $(document).scrollTop();
        if(top1-gun-50<=0){
            $('.scroll-header-menu').removeClass('container');
            $('.navigation').addClass('container');
            $('#scroll-header').addClass('header_menu_top');
            $('.ghost-header-logo').css('width','100%');
        }
        if(top1-gun-50>0){
            $('.scroll-header-menu').addClass('container');
            $('.navigation').removeClass('container');
            $('#scroll-header').removeClass('header_menu_top');
            $('.ghost-header-logo').css('width','');
        }
    })
$(".single_more_posts").each(function(index,element) {
    element.onwheel = function(event){
        event.preventDefault();  
            //设置鼠标滚轮滚动时屏幕滚动条的移动步长  
            var step = 150;  
            if(event.deltaY < 0){  
                //向上滚动鼠标滚轮，屏幕滚动条左移  
                this.scrollLeft -= step;  
            } else {  
                //向下滚动鼠标滚轮，屏幕滚动条右移  
                this.scrollLeft += step;  
            }  
    }
})
})
</script>
<footer class="footer">
    <div class="footer-wrap">
        <!-- 页脚菜单/版权信息 IDC No. -->
        <div class="footer-nav">
		  <div class="ghost-footer-width">
		  <div class="ghost-footer">
		  <aside>
			<div class="widget widget_text">
			  <div class="heading">
				<i class="fas fa-link"></i><span class="widget-title">链接导航</span>
			  </div>
			  <div class="textwidget">
				<ul class="ghost-links-daohang">
				<li class="ghost-footer-link"><a class="ghost-footer-links" href="https://otakusns.com/">御宅社</a></li><li class="ghost-footer-link"><a class="ghost-footer-links" href="<?php echo URL;?>/">粉萌次元</a></li>
                    <li class="ghost-footer-link"><a class="ghost-footer-links" href="https://PILIACG.CN">piliacg/霹雳acg</a></li><li class="ghost-footer-link"><a class="ghost-footer-links" href="https://19moe.com/">妖九萌</a></li>
                    <li class="ghost-footer-link"><a class="ghost-footer-links" href="https://www.onlolikon.com/">音域动漫|分享动漫资源</a></li><li class="ghost-footer-link"><a class="ghost-footer-links" href="https://miaokadm.com/">喵咔动漫</a></li>
                    <li class="ghost-footer-link"><a class="ghost-footer-links" href="https://www.dibidibi.cn/">嘀哔嘀哔（dibidibi）</a></li><li class="ghost-footer-link"><a class="ghost-footer-links" href="http://www.moe321.com/">萌站·次元导航</a></li>
                    <li class="ghost-footer-link"><a class="ghost-footer-links" href="http://www.huo2.cn/">火二次元导航</a></li><li class="ghost-footer-link"><a class="ghost-footer-links" href="http://www.jspoo.com">聚神铺导航</a></li>
                    <li class="ghost-footer-link"><a class="ghost-footer-links" href="https://www.loveu8.cn/">幻梦博客</a></li><li class="ghost-footer-link"><a class="ghost-footer-links" href="https://logirlsns.com/">萌娘社区</a></li>
                    <li class="ghost-footer-link"><a class="ghost-footer-links" href="https://moe.ac/">萌点动漫</a></li><li class="ghost-footer-link"><a class="ghost-footer-links" href="https://zuiacg.moe/">最ACG</a></li>
                    <li class="ghost-footer-link"><a class="ghost-footer-links" href="https://acghf.com/">ACG汉服社</a></li><li class="ghost-footer-link"><a class="ghost-footer-links" href="https://acgmv.srsg.moe/">绯萌社区</a></li>
                    <li class="ghost-footer-link"><a class="ghost-footer-links" href="https://www.ecy1.net/">次元一区</a></li><li class="ghost-footer-link"><a class="ghost-footer-links" href="https://aibenzi.com/">最ACG</a></li>
                    <li class="ghost-footer-link"><a class="ghost-footer-links" href="https://www.c3acg.com/">C3动漫</a></li><li class="ghost-footer-link"><a class="ghost-footer-links" href="https://cangku.one/">绅士仓库</a></li>
                    <li class="ghost-footer-link"><a class="ghost-footer-links" href="http://www.pmjun.com/">泡面菌</a></li><li class="ghost-footer-link"><a class="ghost-footer-links" href="http://www.haitangw.cn">海棠网-专注ACG动漫资讯,新番动漫,二次元</a></li>
                    <li class="ghost-footer-link"><a class="ghost-footer-links" href="https://moegirl.xyz">萌娘导航</a></li>
                </ul>
			  </div>
			</div>
		  </aside>
		  </div>
		 <div class="ghost-footer">
		  <aside>
			<div class="widget widget_text">
			  <div class="heading">
				<i class="fas fa-bullhorn"></i><span class="widget-title">声明</span>
			  </div>
			  <div class="textwidget"><?php echo SiteMeta::GetSiteFooterMetaItem('site_footer_bullhorn')?></div>
			</div>
		  </aside>
		  </div>
		  <div class="ghost-footer">
		  <aside>
			<div class="widget widget_text">
			  <div class="heading">
				<i class="fas fa-user-circle"></i><span class="widget-title">关于我们</span>
			  </div>
			  <div class="textwidget"><?php echo SiteMeta::GetSiteFooterMetaItem('site_footer_about')?></div>
			</div>
		  </aside>
		  </div>
		  <div class="ghost-footer">
		  <aside>
			<div class="widget widget_text">
			  <div class="heading">
				<i class="fas fa-envelope"></i><span class="widget-title">联系我们</span>
			  </div>
			  <div class="textwidget"><?php echo SiteMeta::GetSiteFooterMetaItem('site_footer_callus')?></div>
			</div>
		  </aside>
		  </div>
			</div>
        </div>
    </div>
</footer>
<div class="ghost_bottom_tools">
    <div class="container">
        <div class="ghost_bottom_tools_container">
            <div class="ghost_bottom_tool_container">
				<div class="ghost_bottom_tools_top_item">
					<a class="ghost_bottom_tools_top_link" title="返回顶部"><span class="ghost_bottom_tools_top_icon poi-icon fa-arrow-up fas fa-fw" aria-hidden="true"></span> 
					<span class="ghost_bottom_tools_top_text">返回顶部</span>
					</a>
				</div>
			</div>
        </div>
    </div>
</div>
<div class="ghost_footer"><?php echo SiteMeta::GetSiteMetaItem('site_footer_meta');?></div>
<script>
(function(){
var src = "https://jspassport.ssl.qhimg.com/11.0.1.js?d182b3f28525f2db83acfaaf6e696dba";
document.write('<script src="' + src + '" id="sozz"><\/script>');
})();
</script>
</body>
</html>