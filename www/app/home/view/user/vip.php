<?php
global $LOGINUSER;
use model\UserMeta;
?>
<div class="ghost_setting_content">
    <div class="drafts ghost_setting_content_container">
        <fieldset class="ghost_setting_content_item">
            <legend class="ghost_setting_content_item_title">
                <span class="ghost_setting_content_primary">
                    <span class="poi-icon fa-user-circle fas fa-fw" aria-hidden="true"></span>
                    <span class="ghost_setting_content_text">会员信息</span></span>
            </legend>
            <div class="ghost_setting_content_item_content">
                <div class="ghost_setting_content_preface">
                    <p>您可以在这个页面查看您发布过的帖子，鼠标悬浮即可见编辑按钮。</p>
                    <p>重新编辑帖子后需要二次审核，请谨慎编辑哦！</p>
                </div>
                <div class="ghost_notice_content_preface">
                    <div class="ghost_author_portal_portal_item">
                        <div class="ghost_author_portal_item_title">昵称</div>
                        <div class="ghost_author_portal_item_content"><?php echo UserMeta::GetAuthorMeta($LOGINUSER['ID'])['display_name'];?></div></div>
                    <div class="ghost_author_portal_portal_item">
                        <div class="ghost_author_portal_item_title">UID</div>
                        <div class="ghost_author_portal_item_content"><?php echo $LOGINUSER['ID'];?></div></div>
                    <div class="ghost_author_portal_portal_item">
                        <div class="ghost_author_portal_item_title">描述</div>
                        <div class="ghost_author_portal_item_content"><?php echo UserMeta::GetAuthorMeta($LOGINUSER['ID'])['description'];?></div>
                    </div>
                    <div class="ghost_author_portal_portal_item">
                        <div class="ghost_author_portal_item_title">身份状态：</div>
                        <div class="ghost_author_portal_item_content">超级管理员</div>
                    </div>
                    <div class="ghost_author_portal_portal_item">
                        <div class="ghost_author_portal_item_title">答题状态：</div>
                        <div class="ghost_author_portal_item_content">您已经是超级管理员了，无需答题！</div>
                    </div>
                    <div class="ghost_author_portal_portal_item">
                        <div class="ghost_author_portal_item_title">积分信息：</div>
                        <div class="ghost_author_portal_item_content"><?php echo UserMeta::GetAuthorMeta($LOGINUSER['ID'])['user_credit'];?></div>
                    </div>
                    <div class="ghost_author_portal_portal_item">
                        <div class="ghost_author_portal_item_title">累计发帖</div>
                        <div class="ghost_author_portal_item_content">8729</div></div>
                    <div class="ghost_author_portal_portal_item">
                        <div class="ghost_author_portal_item_title">累计评论</div>
                        <div class="ghost_author_portal_item_content">41</div>
                    </div>
                </div>
            </div>
        </fieldset>
    </div>
</div>