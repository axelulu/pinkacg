<?php
use model\SiteMeta;?>
<div class="layui-body" style="padding-left: 30px;">
    <!-- 内容主体区域 -->
    <div style="padding: 15px;">
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>积分策略设置</legend>
        </fieldset>

        <form class="UpdateCreditStrategy layui-form layui-form-pane" action="javascript:;">
            <div class="layui-form-item">
                <label class="layui-form-label">用户签到</label>
                <div class="layui-input-inline">
                    <input type="text" name="N_SignDaily" lay-verify="required" placeholder="用户签到获取积分" value="<?php echo SiteMeta::GetSiteCreditStrategy('N_SignDaily');?>" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">关注用户</label>
                <div class="layui-input-inline">
                    <input type="text" name="N_Flowers" lay-verify="required" placeholder="用户关注用户获取积分" value="<?php echo SiteMeta::GetSiteCreditStrategy('N_Flowers');?>" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">评论文章</label>
                <div class="layui-input-inline">
                    <input type="text" name="N_PostComment" lay-verify="required" placeholder="用户评论文章获取积分" value="<?php echo SiteMeta::GetSiteCreditStrategy('N_PostComment');?>" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">修改头像</label>
                <div class="layui-input-inline">
                    <input type="text" name="N_Avatar" lay-verify="required" placeholder="用户修改头像获取积分" value="<?php echo SiteMeta::GetSiteCreditStrategy('N_Avatar');?>" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">用户注册</label>
                <div class="layui-input-inline">
                    <input type="text" name="N_Reg" lay-verify="required" placeholder="用户注册获取积分" value="<?php echo SiteMeta::GetSiteCreditStrategy('N_Reg');?>" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">忘记密码</label>
                <div class="layui-input-inline">
                    <input type="text" name="N_ForgetPwd" lay-verify="required" placeholder="用户忘记密码获取积分" value="<?php echo SiteMeta::GetSiteCreditStrategy('N_ForgetPwd');?>" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">文章被评论</label>
                <div class="layui-input-inline">
                    <input type="text" name="N_UserComment" lay-verify="required" placeholder="用户文章被评论获取积分" value="<?php echo SiteMeta::GetSiteCreditStrategy('N_UserComment');?>" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">发表文章</label>
                <div class="layui-input-inline">
                    <input type="text" name="N_PublishPost" lay-verify="required" placeholder="用户发表文章获取积分" value="<?php echo SiteMeta::GetSiteCreditStrategy('N_PublishPost');?>" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">取消关注</label>
                <div class="layui-input-inline">
                    <input type="text" name="N_UnFlowers" lay-verify="required" placeholder="用户取消关注用户获取积分" value="<?php echo SiteMeta::GetSiteCreditStrategy('N_UnFlowers');?>" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">出售付费文章</label>
                <div class="layui-input-inline">
                    <input type="text" name="N_SellPaidPost" lay-verify="required" placeholder="用户出售付费文章获取积分" value="<?php echo SiteMeta::GetSiteCreditStrategy('N_SellPaidPost');?>" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">购买付费文章</label>
                <div class="layui-input-inline">
                    <input type="text" name="N_BuyPaidPost" lay-verify="required" placeholder="用户购买付费文章获取积分" value="<?php echo SiteMeta::GetSiteCreditStrategy('N_BuyPaidPost');?>" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">修改密码</label>
                <div class="layui-input-inline">
                    <input type="text" name="N_AlterPwd" lay-verify="required" placeholder="用户修改密码获取积分" value="<?php echo SiteMeta::GetSiteCreditStrategy('N_AlterPwd');?>" autocomplete="off" class="layui-input">
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
        $('.UpdateCreditStrategy').on('click', '.submit',
            function(event) {
                $CreditStrategy= {
                    'N_SignDaily': $("input[name='N_SignDaily']").val(),
                    'N_Flowers': $("input[name='N_Flowers']").val(),
                    'N_PostComment': $("input[name='N_PostComment']").val(),
                    'N_Avatar': $("input[name='N_Avatar']").val(),
                    'N_Reg': $("input[name='N_Reg']").val(),
                    'N_ForgetPwd': $("input[name='N_ForgetPwd']").val(),
                    'N_UserComment': $("input[name='N_UserComment']").val(),
                    'N_PublishPost': $("input[name='N_PublishPost']").val(),
                    'N_UnFlowers': $("input[name='N_UnFlowers']").val(),
                    'N_SellPaidPost': $("input[name='N_SellPaidPost']").val(),
                    'N_BuyPaidPost': $("input[name='N_BuyPaidPost']").val(),
                    'N_AlterPwd': $("input[name='N_AlterPwd']").val(),
                }
                console.log($CreditStrategy);
                $.ajax({
                    url: ghost.ghost_ajax,
                    data: {
                        p: 'admin',
                        a: 'UpdateCreditStrategy',
                        CreditStrategy: $CreditStrategy,
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
                        }
                    }
                });
            });
    })
</script>