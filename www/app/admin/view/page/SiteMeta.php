<?php
use model\SiteMeta;
?>
<div class="layui-body" style="padding-left: 30px;">
    <!-- 内容主体区域 -->
    <div style="padding: 15px;">
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>网站基本设置</legend>
        </fieldset>

        <form class="layui-form UpdateSiteMeta" method="post" action="javascript:;">
            <div class="layui-form-item">
                <label class="layui-form-label">网站名称</label>
                <div class="layui-input-block">
                    <input type="text" name="site_name" lay-verify="title" autocomplete="off" placeholder="请输入您的网站名称" value="<?php echo SiteMeta::GetSiteMetaItem('site_name')?>" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">网站描述</label>
                <div class="layui-input-block">
                    <input type="text" name="site_desc" lay-verify="title" autocomplete="off" placeholder="请输入您的网站描述" value="<?php echo SiteMeta::GetSiteMetaItem('site_desc')?>" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">网站关键词</label>
                <div class="layui-input-block">
                    <input type="text" name="site_keyword" lay-verify="title" autocomplete="off" placeholder="请输入您的网站关键词" value="<?php echo SiteMeta::GetSiteMetaItem('site_keyword')?>" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">网站logo</label>
                <div class="layui-input-block">
                    <input type="text" name="site_logo" lay-verify="title" autocomplete="off" placeholder="请输入您的网站logo" value="<?php echo SiteMeta::GetSiteMetaItem('site_logo')?>" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">头部图片</label>
                <div class="layui-input-block">
                    <input type="text" name="site_header_img" lay-verify="title" autocomplete="off" placeholder="请输入您的网站头部图片" value="<?php echo SiteMeta::GetSiteMetaItem('site_header_img')?>" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">头部icon</label>
                <div class="layui-input-block">
                    <input type="text" name="site_icon" lay-verify="title" autocomplete="off" placeholder="请输入您的网站头部icon" value="<?php echo SiteMeta::GetSiteMetaItem('site_icon')?>" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">默认头像</label>
                <div class="layui-input-block">
                    <input type="text" name="site_default_avatar" lay-verify="title" autocomplete="off" placeholder="请输入用户默认头像" value="<?php echo SiteMeta::GetSiteMetaItem('site_default_avatar')?>" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">懒加载图片</label>
                <div class="layui-input-block">
                    <input type="text" name="site_lazy_img" lay-verify="title" autocomplete="off" placeholder="请输入懒加载图片" value="<?php echo SiteMeta::GetSiteMetaItem('site_lazy_img')?>" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">登录公告</label>
                <div class="layui-input-block">
                    <textarea name="site_login_notice" placeholder="请输入网站登录弹窗公告" class="layui-textarea"><?php echo SiteMeta::GetSiteMetaItem('site_login_notice')?></textarea>
                </div>
            </div>
            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">首页公告</label>
                <div class="layui-input-block">
                    <textarea name="site_header_notice" placeholder="请输入网站首页公告" class="layui-textarea"><?php echo SiteMeta::GetSiteMetaItem('site_header_notice')?></textarea>
                </div>
            </div>
            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">底部信息</label>
                <div class="layui-input-block">
                    <textarea name="site_footer_meta" placeholder="请输入网站底部信息" class="layui-textarea"><?php echo SiteMeta::GetSiteMetaItem('site_footer_meta')?></textarea>
                </div>
            </div>
            <div class="layui-form-item">
                <button name="submit" class="submit layui-btn" lay-submit="" lay-filter="demo2">提交修改</button>
            </div>
        </form>
    </div>
</div>
<script src="<?php echo URL;?>assets/layui/layui.js"></script>
<script>

    layui.use(['form', 'layedit', 'laydate'], function(){
        var layer = layui.layer
    });

    jQuery(function($) {
        // 分类排序
        $('.UpdateSiteMeta').on('click', '.submit',
            function(event) {
                $SiteMeta= {
                    'site_name': $("input[name='site_name']").val(),
                    'site_logo': $("input[name='site_logo']").val(),
                    'site_header_img': $("input[name='site_header_img']").val(),
                    'site_icon': $("input[name='site_icon']").val(),
                    'site_desc': $("input[name='site_desc']").val(),
                    'site_keyword': $("input[name='site_keyword']").val(),
                    'site_lazy_img': $("input[name='site_lazy_img']").val(),
                    'site_default_avatar': $("input[name='site_default_avatar']").val(),
                    'site_login_notice': $("textarea[name='site_login_notice']").val(),
                    'site_header_notice': $("textarea[name='site_header_notice']").val(),
                    'site_footer_meta': $("textarea[name='site_footer_meta']").val(),
                }
                $.ajax({
                    url: ghost.ghost_ajax,
                    data: {
                        p: 'admin',
                        a: 'UpdateSiteMeta',
                        SiteMeta: $SiteMeta,
                    },
                    type: 'POST',
                    success: function(msg) {
                        console.log(msg);
                        if (msg.code == 1) {
                            layer.msg(msg.message, {icon: 1});
                            setTimeout(function() {
                                window.location.reload();
                            },2000);
                        } else {
                            layer.msg(msg.message, {icon: 5});
                            // setTimeout(function() {
                            //     window.location.reload();
                            // },2000);
                        }
                    }
                });
            });
    })
</script>