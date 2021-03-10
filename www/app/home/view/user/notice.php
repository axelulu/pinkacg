<?php
global $LOGINUSER;
use model\UserCenterNotice;
$NoticeMetas = UserCenterNotice::GetAllNoticeByUserId($LOGINUSER['ID'],0,15);
?>
<div class="ghost_setting_content">
    <div class="notice ghost_setting_content_container" data-userid="<?php echo $LOGINUSER['ID'];?>">
        <fieldset class="ghost_setting_content_item">
            <legend class="ghost_setting_content_item_title">
                <span class="ghost_setting_content_primary">
                    <span class="poi-icon fa-user-circle fas fa-fw" aria-hidden="true"></span>
                    <span class="ghost_setting_content_text">系统通知</span></span>
            </legend>
            <div class="ghost_setting_content_item_content">
                <div class="ghost_setting_content_preface">
                    <p>您可以在这个页面查看您发布过的帖子，鼠标悬浮即可见编辑按钮。</p>
                    <p>重新编辑帖子后需要二次审核，请谨慎编辑哦！</p>
                </div>
                <div class="ghost_notice_content_preface notice_msg">
                    <?php foreach($NoticeMetas as $NoticeMeta){
                        echo UserCenterNotice::GetNoticeType($NoticeMeta);
                    }
                    //自动将未读标为已读
                    UserCenterNotice::readNotice($LOGINUSER['ID']);?>
                    <div class="ghost_notice_more_post">
                        <a data-paged="0" class="more-post ajax-morepost">更多文章 <i class="tico tico-angle-right"></i></a>
                    </div>
                </div>
            </div>
        </fieldset>
    </div>
</div>