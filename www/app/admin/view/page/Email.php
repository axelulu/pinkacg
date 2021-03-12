<?php
use model\SiteMeta;?>
<div class="layui-body" style="padding-left: 30px;">
    <!-- 内容主体区域 -->
    <div style="padding: 15px;">
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>SMTP邮件设置</legend>
        </fieldset>

        <form class="layui-form UpdateSiteMeta" method="post" action="javascript:;">
        <div class="layui-form-item">
            <label class="layui-form-label">服务器</label>
            <div class="layui-input-block">
                <input type="text" name="smtp_host" lay-verify="title" autocomplete="off" placeholder="请输入您的邮箱服务器" value="<?php echo SiteMeta::GetSiteEmail('smtp_host');?>" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">用户名</label>
            <div class="layui-input-block">
                <input type="text" name="smtp_username" lay-verify="title" autocomplete="off" placeholder="请输入您的邮箱用户名" value="<?php echo SiteMeta::GetSiteEmail('smtp_username');?>" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">密码</label>
            <div class="layui-input-block">
                <input type="text" name="smtp_pass" lay-verify="title" autocomplete="off" placeholder="请输入您的邮箱密码" value="<?php echo SiteMeta::GetSiteEmail('smtp_pass');?>" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">认证协议</label>
            <div class="layui-input-block">
                <input type="text" name="smtp_secure" lay-verify="title" autocomplete="off" placeholder="请输入您的邮箱验证协议" value="<?php echo SiteMeta::GetSiteEmail('smtp_secure');?>" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">SMTP端口</label>
            <div class="layui-input-block">
                <input type="text" name="smtp_port" lay-verify="title" autocomplete="off" placeholder="请输入您的邮箱端口" value="<?php echo SiteMeta::GetSiteEmail('smtp_port');?>" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <button name="submit" class="submit layui-btn" lay-submit="" lay-filter="demo2">提交信息</button>
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
                $SmtpMeta= {
                    'smtp_host': $("input[name='smtp_host']").val(),
                    'smtp_username': $("input[name='smtp_username']").val(),
                    'smtp_pass': $("input[name='smtp_pass']").val(),
                    'smtp_secure': $("input[name='smtp_secure']").val(),
                    'smtp_port': $("input[name='smtp_port']").val(),
                }
                console.log($SmtpMeta);
                $.ajax({
                    url: ghost.ghost_ajax,
                    data: {
                        p: 'admin',
                        a: 'UpdateSmtpMeta',
                        SmtpMeta: $SmtpMeta,
                    },
                    type: 'POST',
                    success: function(msg) {
                        console.log(msg)
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