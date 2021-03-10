<?php
use model\Menu;?>
<div class="layui-body UpdateHomeLayout" style="padding-left: 30px;">
    <!-- 内容主体区域 -->
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
        <legend>显示搜索框</legend>
    </fieldset>
    <div id="test4" class="demo-transfer"></div>
    <div style="margin-top: 30px;" class="layui-form-item">
        <button lay-demotransferactive="getData" name="submit" class="submit layui-btn" lay-submit="" lay-filter="demo2">跳转式提交</button>
    </div>
</div>
</div>
<script src="<?php echo URL;?>assets/layui/layui.js"></script>
<script>
    layui.use(['transfer', 'layer', 'util'], function(){
        var $ = layui.$,
        transfer = layui.transfer,
        layer = layui.layer,
        util = layui.util;
        //显示搜索框

        transfer.render({
            elem: '#test4',
            data: <?php echo json_encode(Menu::GetMenuMeta()); ?>,
            title: ['全部分类', '已选分类'],
            showSearch: true,
            value: ["ost"],
            id: 'demo1', //定义索引
            parseData: function(res){
                return {
                    "value": res.slug //数据值
                    ,"title": res.name //数据标题
                }
            },
        });
        jQuery(function($) {
        // 分类排序
        $('.UpdateHomeLayout').on('click', '.submit',
            function(event) {
                var getData = transfer.getData('demo1'); //获取右侧数据
                $.ajax({
                    url: ghost.ghost_ajax,
                    data: {
                        p: 'admin',
                        a: 'UpdateHomeLayout',
                        HomeLayout: JSON.stringify(getData),
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
    });
    });

</script>
