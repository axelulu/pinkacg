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
            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">底部链接</label>
                <div class="layui-input-block">
                    <textarea name="site_footer_link" placeholder="请输入网站底部链接" class="layui-textarea"><?php echo SiteMeta::GetSiteFooterMetaItem('site_footer_link')?></textarea>
                </div>
            </div>
            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">底部声明</label>
                <div class="layui-input-block">
                    <textarea name="site_footer_bullhorn" placeholder="请输入网站底部声明" class="layui-textarea"><?php echo SiteMeta::GetSiteFooterMetaItem('site_footer_bullhorn')?></textarea>
                </div>
            </div>
            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">关于我们</label>
                <div class="layui-input-block">
                    <textarea name="site_footer_about" placeholder="请输入网站关于我们" class="layui-textarea"><?php echo SiteMeta::GetSiteFooterMetaItem('site_footer_about')?></textarea>
                </div>
            </div>
            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">联系我们</label>
                <div class="layui-input-block">
                    <textarea name="site_footer_callus" placeholder="请输入网站联系我们" class="layui-textarea"><?php echo SiteMeta::GetSiteFooterMetaItem('site_footer_callus')?></textarea>
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
                $FooterMeta= {
                    'site_footer_link': $("textarea[name='site_footer_link']").val(),
                    'site_footer_bullhorn': $("textarea[name='site_footer_bullhorn']").val(),
                    'site_footer_about': $("textarea[name='site_footer_about']").val(),
                    'site_footer_callus': $("textarea[name='site_footer_callus']").val(),
                }
                $.ajax({
                    url: ghost.ghost_ajax,
                    data: {
                        p: 'admin',
                        a: 'UpdateFooterMeta',
                        FooterMeta: $FooterMeta,
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