<?php
use model\SiteMeta;
use model\Menu;

$home_cms = SiteMeta::GetSiteMeta('home_cms');
$home_cms = json_decode($home_cms);
?>
<div class="main">
    <!-- 幻灯片 -->
    <?php require_once HOME_VIEW . 'mod/popular.php' ?>
    <!-- 公告 -->
    <div class="container">
        <div class="ghost_site_notice">
            <?php echo SiteMeta::GetSiteMetaItem('site_header_notice');?>
        </div>
    </div>
    <div class="home">
        <!--广告-->
        <div class="container">
        </div>
        <!-- box -->
        <?php
        foreach($home_cms as $home_cms_m){
            if($home_cms_m->mod == '1') require HOME_VIEW . 'mod/box-1.php';
            if($home_cms_m->mod == '2') require HOME_VIEW . 'mod/box-2.php';
            if($home_cms_m->mod == '3') require HOME_VIEW . 'mod/box-3.php';
        }
        ?>
    </div>
    <!--侧板工具-->
    <div class="ghost_slide_wrap">
        <div id="ghost_slide">
            <div class="ghost_tool">
                <?php
                foreach($home_cms as $home_cms_b){
                    echo '<a class="ghost_control">
                              <span class="poi-icon ' . Menu::GetMenuIcon($home_cms_b->name,true) . '" aria-hidden="true"></span>
                              <span class="ghost_control_text">' . Menu::GetMenuTitle($home_cms_b->name,true) . '</span>
                          </a>';
                }
                ?>
                <div class="blue" style="top: 52px;"></div>
            </div>
        </div>
    </div>
    <script>
        //设置cookie
        function setCookie(key, value, expires) {
            document.cookie = encodeURIComponent(key) + '=' + encodeURIComponent(value) + ';expires=' + ddate(expires);
        }

        function ddate(expires) {
            var ddate = new Date()
            ddate.setDate(ddate.getDate() + expires)
            return ddate
        }

        //读取cookie
        function getCookie(name) {
            var arrStr = document.cookie.split('; ');
            //alert(arrStr)
            for (var i = 0; i < arrStr.length; i++) {
                var arr = arrStr[i].split('=')
                //alert(arr[0]+'\n'+arr[1])
                if (arr[0] == name) {
                    return decodeURIComponent(arr[1])
                }
            }
            return ''
        }

        if (getCookie('user') == '') { //3、使用之前封装好的cookie操作函数，这样取cookie比较方便
            console.log('666');
            setCookie('user', 'read', 7);
        }
        // 解决slide定位问题
        jQuery(function ($) {
            var $slide = $("#ghost_slide");
            var sildeH = $slide.height() - 150;
            var minus = ($(window).height() - sildeH) / 2;
            minus = Math.max(minus, 0);
            $(window).resize(function () {//页面高度变化.
                minus = ($(window).height() - sildeH) / 2;//minus可能小于0==> 页面高度小于slide高度.
                minus = Math.max(minus, 0); //取最大值.
                $slide.css("top", sildeH + "px");
            }).scroll(function () {//页面滚动.让slide 居中
                if ($(this).scrollTop() > 400) {
                    $slide.addClass('ghost_hide');
                }
                if ($(this).scrollTop() < 400) {
                    $slide.removeClass('ghost_hide');
                }
                if ($(this).scrollTop() > 100) {
                    $slide.css("top", sildeH + "px");
                } else {
                    $slide.css("top", "0px");
                }
            })
        });

        // 导航条操作.
        jQuery(function ($) {
            var $control = $("#ghost_slide .ghost_control"),
                height = $control.height(),
                $nav = $(".ghost_nav"),
                length = $nav.length,
                index = 0,
                $blue = $("#ghost_slide .blue"),
                mark = true;
            // slide的点击跳转.
            $control.click(function () {
                mark = !mark;
                var This = this;
                index = $(this).index();
                // 替换样式.
                $(this).addClass("on").siblings().removeClass("on");
                $('.ghost_control').find('.show').removeClass("show");
                $(this).find('.ghost_control_text').addClass("show");
                // 跳转.
                $("body,html").stop().animate({//会执行两次
                    "scrollTop": $nav.eq(index).offset().top + "px"
                }, 300, 'easeInOutCubic');
                // 小块跟随.
                $blue.show().stop().animate({
                    top: height * index + "px"
                }, 300, function () {
                    $(this).hide();
                    // 跳转结束让开关开启
                    mark = !mark;
                });
            });
            // 页面滚动,让slide跟随.
            $(window).scroll(function () {
                // 点击跳转时不用检测.
                if (mark) {
                    for (var i = 0; i < length; i++) { //检测滚轮高度
                        if ($nav.eq(i).offset().top - 200 > $(this).scrollTop()) { // 让上一个control 显示.
                            index = i - 1;
                            if (index < 0) { //i=0时.  不显示.
                                index = 0;
                                $control.removeClass("on");
                            } else { //当i>=1时. 才开始显示.
                                $control.eq(index).addClass("on").siblings().removeClass("on");
                                $('.ghost_control').find('.show').removeClass("show");
                                $control.eq(index).find('.ghost_control_text').addClass("show");
                                // $blue 同步.
                                $blue.css("top", height * index + "px");
                            }

                            break;//检测到一个就退出.
                        }
                    }
                    // 最后一个.
                    if ($nav.last().offset().top - 200 < $(this).scrollTop()) {
                        $control.last().addClass("on").siblings().removeClass("on");
                        $('.ghost_control').find('.show').removeClass("show");
                        $control.last().find('.ghost_control_text').addClass("show");
                        // $blue 同步.
                        $blue.css("top", (length - 1) * index + "px");
                    }
                }
            })
        });
    </script>
</div>