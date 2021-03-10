<?php
global $LOGINUSER;
use model\UserCenterMsg;
use model\UserMeta;

?>
<div class="ghost_setting_content">
    <div data-userid="<?php echo $LOGINUSER['ID'];?>" class="drafts ghost_setting_content_container">
        <fieldset class="ghost_setting_content_item">
            <legend class="ghost_setting_content_item_title">
                <span class="ghost_setting_content_primary">
                    <span class="poi-icon fa-user-circle fas fa-fw" aria-hidden="true"></span>
                    <span class="ghost_setting_content_text">系统通知</span></span>
            </legend>
            <div class="ghost_setting_content_item_content">
                <div class="ghost_msg_container">
                    <div class="ghost_msg_nav">
                        <form class="ghost_msg_item_fm" action="javascript:;">
                            <input type="text" class="ghost_setting_content_preface_control_downloadlink msg_input" placeholder="输入用户 UID 以对话" title="输入用户 UID 以对话" required="" value="">
                            <input type="submit" hidden=""></form>
                        <div class="user_msg">
                            <?php
                            foreach(UserCenterMsg::GetAllMsgList($LOGINUSER['ID']) as $AllMsgList){
                            $UserId = $LOGINUSER['ID'] == $AllMsgList['receiver_id'] ? $AllMsgList['sender_id'] : $AllMsgList['receiver_id'];?>
                            <div class="ghost_msg_nav_item is-active">
                                <a class="ghost_msg_nav_item_author_link change_user_content" data-id="<?php echo $UserId;?>" title="<?php echo UserMeta::GetAuthorMeta($UserId)['display_name'];?>">
                                    <img class="ghost_msg_nav_item_author_avatar_img" src="<?php echo UserMeta::GetAuthorMeta($UserId)['user_avatar'];?>" alt="<?php echo UserMeta::GetAuthorMeta($UserId)['display_name'];?>" width="24" height="24">
                                    <span class="ghost_msg_nav_item_author_name"><?php echo UserMeta::GetAuthorMeta($UserId)['display_name'];?></span></a>
                                <a class="ghost_msg_nav_item_close user_11919" data-id="<?php echo $UserId;?>">
                                    <span class="poi-icon fa-times fas" aria-hidden="true"></span>
                                </a>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="ghost_msg_body">
                        <div class="ghost_msg_list_container">
                            <?php
                            foreach(UserCenterMsg::GetAllMsgByUserId($LOGINUSER['ID']) as $AllMsg){
                                $UserId = $AllMsg['sender_id'];
                                $MsgClass = $LOGINUSER['ID'] == $AllMsg['receiver_id'] ? 'MsgRight' : 'MsgLeft';?>
                            <div class="<?php echo $MsgClass;?> ghost_msg_list">
                                <a class="ghost_msg_list_thumbnail" href="<?php echo HOME_URL;?>author/<?php echo $UserId;?>" target="_blank">
                                    <img title="junjie.gao" alt="<?php echo UserMeta::GetAuthorMeta($UserId)['display_name'];?>" class="ghost_msg_list_thumbnail_avatar_img" src="<?php echo UserMeta::GetAuthorMeta($UserId)['user_avatar'];?>" width="40" height="40"></a>
                                <div class="ghost_msg_list_body">
                                    <div class="ghost_msg_list_meta">
                                        <span class="ghost_msg_list_meta_item ghost_msg_list_meta_name"><?php echo UserMeta::GetAuthorMeta($UserId)['display_name'];?></span>
                                        <span class="ghost_msg_list_meta_item ghost_msg_list_meta_uid">(uid:<?php echo $UserId;?>)</span>
                                        <span class="ghost_msg_list_meta_item ghost_msg_list_meta_date"><?php echo UserMeta::TimeTran($AllMsg['msg_time']);?></span></div>
                                    <div class="ghost_msg_list_content"><?php echo $AllMsg['msg_content'];?></div></div>
                            </div>
                            <?php }?>
                        </div>
                        <form class="ghost_msg_list_fm" action="javascript:;">
                            <div class="ghost_msg_list_group is-block">
                                <label class="ghost_msg_list_group_inputs">
                                    <span class="ghost_msg_list_group_icon">
                                        <span class="poi-icon fa-comment-dots fas fa-fw" aria-hidden="true"></span>
                                    </span>
                                    <span class="poi-form__group__inputs__content">
                                        <input type="text" class="ghost_setting_content_preface_control_downloadlink msg_content" placeholder="请输入信息" autocomplete="off" value=""></span>
                                </label>
                                <button type="submit" class="ghost_setting_content_btn_success input_msg">
                                    <span class="poi-icon fa-check fas fa-fw" aria-hidden="true"></span>
                                    <span class="poi-icon__text">发送</span></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </fieldset>
    </div>
</div>