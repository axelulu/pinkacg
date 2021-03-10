<?php
global $LOGINUSER;
use model\UserMeta;
?>
<div class="ghost_setting_content">
    <div data-userid="<?php echo $LOGINUSER['ID'];?>" class="ghost_setting_content_container">
        <fieldset class="ghost_setting_content_item">
            <legend class="ghost_setting_content_item_title">
                <span class="ghost_setting_content_primary">
                    <span class="poi-icon fa-user-circle fas fa-fw" aria-hidden="true"></span>
                    <span class="ghost_setting_content_text">我的头像</span></span>
            </legend>
            <div class="ghost_setting_content_item_content">
                <div class="ghost_setting_content_preface">
                    <p>修改头像需要 -5 个喵爪哦！</p>
                </div>
                <div class="ghost_setting_content_my_avatar">
                    <div class="ghost_setting_content_my_avatar_img">
                        <img style="width: 100px;height: 100px;" src="<?php echo UserMeta::GetAuthorMeta($LOGINUSER['ID'])['user_avatar'];?>" alt="avatar" class="ghost_setting_content_avatar_img" width="100" height="100"></div>
                    <label class="ghost_setting_content_my_avatar_upload-btn">
                        <span class="poi-icon fa-camera fas fa-fw" aria-hidden="true"></span>
                        <span class="ghost_setting_content_text">更改我的头像</span>
                        <input style="display:none" type="file" name="my_avatar" id="my_avatar" accept=".jpg, .gif, .png" resetonclick="true" data-nonce="f052e9ac30"></label>
                </div>
            </div>
        </fieldset>
        <fieldset class="ghost_setting_content_item">
            <legend class="ghost_setting_content_item_title">
                <span class="ghost_setting_content_primary">
                    <span class="poi-icon fa-user-circle fas fa-fw" aria-hidden="true"></span>
                    <span class="ghost_setting_content_text">个人资料</span></span>
            </legend>
            <div class="ghost_setting_content_item_content">
                <div class="ghost_setting_content_preface">
                    <p>这里可以修改个人资料哦！</p>
                </div>
                <form action="javascript:;" id="my_setting_information">
                    <div class="ghost_setting_content_preface_item">
                        <div class="clearfix ">
                            <div class="col-lg-2 float-left">
                                <div class="ghost_setting_content_preface_item_title">昵称</div></div>
                            <div class="col-lg-10 float-right">
                                <div class="ghost_setting_content_preface_item_content">
                                    <input type="name" class="ghost_setting_content_preface_control" required="" placeholder="昵称" title="昵称" value="<?php echo UserMeta::GetAuthorMeta($LOGINUSER['ID'])['display_name'];?>"></div>
                            </div>
                        </div>
                    </div>
                    <div class="ghost_setting_content_preface_item">
                        <div class="clearfix ">
                            <div class="col-lg-2 float-left">
                                <div class="ghost_setting_content_preface_item_title">描述</div></div>
                            <div class="col-lg-10 float-right">
                                <div class="ghost_setting_content_preface_item_content">
                                    <textarea type="dec" class="ghost_setting_content_preface_control" rows="5" placeholder="描述" title="描述" value="描述"><?php echo UserMeta::GetAuthorMeta($LOGINUSER['ID'])['description'];?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ghost_setting_content_preface_item">
                        <div class="clearfix ">
                            <div class="col-lg-10 float-right">
                                <div class="ghost_setting_content_preface_item_content">
                                    <button type="submit" class="my_text_msg ghost_setting_content_btn_success">
                                        <span class="poi-icon fa-check fas fa-fw" aria-hidden="true"></span>
                                        <span class="ghost_setting_content_text">更新个人资料</span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </fieldset>
        <fieldset class="ghost_setting_content_item">
            <legend class="ghost_setting_content_item_title">
                <span class="ghost_setting_content_primary">
                    <span class="poi-icon fa-at fas fa-fw" aria-hidden="true"></span>
                    <span class="ghost_setting_content_text">账号邮箱</span></span>
            </legend>
            <div class="ghost_setting_content_item_content">
                <div class="ghost_setting_content_preface">
                    <p>修改账号邮箱，需要 -10 个喵爪哦！</p>
                </div>
                <form action="javascript:;">
                    <div class="ghost_setting_content_preface_item">
                        <div class="clearfix">
                            <div class="col-lg-2 float-left">
                                <div class="ghost_setting_content_preface_item_title">邮箱</div></div>
                            <div class="col-lg-10 float-right">
                                <div class="ghost_setting_content_preface_item_content">
                                    <input type="email" class="ghost_setting_content_preface_control" placeholder="邮箱" title="邮箱" required="" value="<?php echo UserMeta::GetAuthorMeta($LOGINUSER['ID'])['user_email'];?>"></div>
                            </div>
                        </div>
                    </div>
                    <div class="ghost_setting_content_preface_item">
                        <div class="clearfix">
                            <div class="col-lg-2 float-left">
                                <div class="ghost_setting_content_preface_item_title">验证码</div></div>
                            <div class="col-lg-10 float-right">
                                <div class="ghost_setting_content_preface_item_content">
                                    <div class="clearfix">
                                        <div style="padding-left:0px" class="col-lg-5 float-left">
                                            <input type="yanzhengma" class="ghost_setting_content_preface_control" placeholder="验证码" title="验证码" required="" value=""></div>
                                        <div class="col-lg-7 float-right">
                                            <a class="sent_email ghost_setting_content_text_email">
                                                <span class="poi-icon fa-envelope fas fa-fw" aria-hidden="true"></span>
                                                <span class="">发送验证码到新邮箱</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ghost_setting_content_preface_item">
                        <div class="clearfix">
                            <div class="col-lg-2 float-left">
                                <div class="ghost_setting_content_preface_item_title"></div>
                            </div>
                            <div class="col-lg-10 float-right">
                                <div class="ghost_setting_content_preface_item_content">
                                    <button type="submit" data-emailnonce="a1f5061af2" class="my_email_msg ghost_setting_content_btn_success">
                                        <span class="poi-icon fa-check fas fa-fw" aria-hidden="true"></span>
                                        <span class="ghost_setting_content_text">更新邮箱</span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </fieldset>
        <fieldset class="ghost_setting_content_item">
            <legend class="ghost_setting_content_item__title is-enabled-toggle">
                <span class="ghost_setting_content_primary">
                    <span class="poi-icon fa-lock fas fa-fw" aria-hidden="true"></span>
                    <span class="ghost_setting_content_text">我的密码</span></span>
            </legend>
            <div class="ghost_setting_content_item__content is-expand">
                <div class="ghost_setting_content_preface">
                    <p>修改密码，需要 -10 个喵爪哦！</p>
                </div>
                <form action="javascript:;">
                    <div class="ghost_setting_content_preface_item">
                        <div class="clearfix">
                            <div class="col-lg-2 float-left">
                                <div class="ghost_setting_content_preface_item_title">旧密码</div></div>
                            <div class="col-lg-10 float-right">
                                <div class="ghost_setting_content_preface_item_content">
                                    <input type="oldpassword" class="ghost_setting_content_preface_control" name="oldPwd" required="" placeholder="旧密码" title="旧密码" value=""></div>
                            </div>
                        </div>
                    </div>
                    <div class="ghost_setting_content_preface_item">
                        <div class="clearfix">
                            <div class="col-lg-2 float-left">
                                <div class="ghost_setting_content_preface_item_title">新密码</div></div>
                            <div class="col-lg-10 float-right">
                                <div class="ghost_setting_content_preface_item_content">
                                    <input type="newpassword" class="ghost_setting_content_preface_control" name="newPwd" required="" placeholder="新密码" title="新密码" minlength="6" value=""></div>
                            </div>
                        </div>
                    </div>
                    <div class="ghost_setting_content_preface_item">
                        <div class="clearfix">
                            <div class="col-lg-2 float-left">
                                <div class="ghost_setting_content_preface_item_title">确认新密码</div></div>
                            <div class="col-lg-10 float-right">
                                <div class="ghost_setting_content_preface_item_content">
                                    <input type="new_password" class="ghost_setting_content_preface_control" name="reTypeNewPwd" required="" placeholder="确认新密码" title="确认新密码" minlength="6" value=""></div>
                            </div>
                        </div>
                    </div>
                    <div class="ghost_setting_content_preface_item">
                        <div class="clearfix">
                            <div class="col-lg-2 float-left">
                                <div class="ghost_setting_content_preface_item_title"></div>
                            </div>
                            <div class="col-lg-10 float-right">
                                <div class="ghost_setting_content_preface_item_content">
                                    <button type="submit" data-pwdnonce="4cb0ab1329" class="my_pwd_msg ghost_setting_content_btn_success">
                                        <span class="poi-icon fa-check fas fa-fw" aria-hidden="true"></span>
                                        <span class="ghost_setting_content_text">更新密码</span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </fieldset>
        <fieldset class="ghost_setting_content_item">
            <legend class="ghost_setting_content_item__title is-enabled-toggle">
                <span class="ghost_setting_content_primary">
                    <span class="poi-icon fa-lock fas fa-fw" aria-hidden="true"></span>
								<span class="ghost_setting_content_text">提醒显示</span></span>
            </legend>
            <div class="ghost_setting_content_item__content is-expand">
                <div class="ghost_setting_content_preface">
                    <p>邮件提醒及内容显示开关</p>
                </div>
                <form action="javascript:;">
                    <div class="ghost_setting_content_preface_item" style="margin: 25px 0px;">
                        <div class="clearfix">
                            <div class="col-lg-4 float-left">
                                <div class="ghost_setting_content_preface_item_title">显示ip地址</div></div>
                            <div class="col-lg-8 float-right">
                                <div class="ghost_setting_content_preface_item_content">
                                    <div class="toggle-button-cover">
                                        <div class="button-cover">
                                            <div class="button r" id="button-3">
                                                <input value="yes" type="checkbox" name="show_ip" class="ghost_show_ip checkbox">
                                                <div class="knobs"></div>
                                                <div class="layer"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ghost_setting_content_preface_item" style="margin: 25px 0px;">
                        <div class="clearfix">
                            <div class="col-lg-4 float-left">
                                <div class="ghost_setting_content_preface_item_title">登录邮件提醒</div></div>
                            <div class="col-lg-8 float-right">
                                <div class="ghost_setting_content_preface_item_content">
                                    <div class="toggle-button-cover">
                                        <div class="button-cover">
                                            <div class="button r" id="button-3">
                                                <input value="yes" type="checkbox" name="login_email_msg" class="ghost_login_email_msg checkbox">
                                                <div class="knobs"></div>
                                                <div class="layer"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ghost_setting_content_preface_item" style="margin: 25px 0px;">
                        <div class="clearfix">
                            <div class="col-lg-4 float-left">
                                <div class="ghost_setting_content_preface_item_title">忘记密码邮件提醒</div></div>
                            <div class="col-lg-8 float-right">
                                <div class="ghost_setting_content_preface_item_content">
                                    <div class="toggle-button-cover">
                                        <div class="button-cover">
                                            <div class="button r" id="button-3">
                                                <input value="yes" type="checkbox" name="forget_email_msg" class="ghost_forget_email_msg checkbox" checked="">
                                                <div class="knobs"></div>
                                                <div class="layer"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ghost_setting_content_preface_item" style="margin: 25px 0px;">
                        <div class="clearfix">
                            <div class="col-lg-4 float-left">
                                <div class="ghost_setting_content_preface_item_title">修改密码邮件提醒</div></div>
                            <div class="col-lg-8 float-right">
                                <div class="ghost_setting_content_preface_item_content">
                                    <div class="toggle-button-cover">
                                        <div class="button-cover">
                                            <div class="button r" id="button-3">
                                                <input value="yes" type="checkbox" name="pwd_email_msg" class="ghost_pwd_email_msg checkbox" checked="">
                                                <div class="knobs"></div>
                                                <div class="layer"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ghost_setting_content_preface_item" style="margin: 25px 0px;">
                        <div class="clearfix">
                            <div class="col-lg-4 float-left">
                                <div class="ghost_setting_content_preface_item_title">修改邮箱邮件提醒</div></div>
                            <div class="col-lg-8 float-right">
                                <div class="ghost_setting_content_preface_item_content">
                                    <div class="toggle-button-cover">
                                        <div class="button-cover">
                                            <div class="button r" id="button-3">
                                                <input value="yes" type="checkbox" name="myemail_email_msg" class="ghost_myemail_email_msg checkbox" checked="">
                                                <div class="knobs"></div>
                                                <div class="layer"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ghost_setting_content_preface_item" style="margin: 25px 0px;">
                        <div class="clearfix">
                            <div class="col-lg-4 float-left">
                                <div class="ghost_setting_content_preface_item_title">修改头像邮件提醒</div></div>
                            <div class="col-lg-8 float-right">
                                <div class="ghost_setting_content_preface_item_content">
                                    <div class="toggle-button-cover">
                                        <div class="button-cover">
                                            <div class="button r" id="button-3">
                                                <input value="yes" type="checkbox" name="avatar_email_msg" class="ghost_avatar_email_msg checkbox" checked="">
                                                <div class="knobs"></div>
                                                <div class="layer"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ghost_setting_content_preface_item" style="margin: 25px 0px;">
                        <div class="clearfix">
                            <div class="col-lg-4 float-left">
                                <div class="ghost_setting_content_preface_item_title">发布评论邮件提醒</div></div>
                            <div class="col-lg-8 float-right">
                                <div class="ghost_setting_content_preface_item_content">
                                    <div class="toggle-button-cover">
                                        <div class="button-cover">
                                            <div class="button r" id="button-3">
                                                <input value="yes" type="checkbox" name="comment_email_msg" class="ghost_comment_email_msg checkbox">
                                                <div class="knobs"></div>
                                                <div class="layer"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ghost_setting_content_preface_item" style="margin: 25px 0px;">
                        <div class="clearfix">
                            <div class="col-lg-4 float-left">
                                <div class="ghost_setting_content_preface_item_title">发布文章邮件提醒</div></div>
                            <div class="col-lg-8 float-right">
                                <div class="ghost_setting_content_preface_item_content">
                                    <div class="toggle-button-cover">
                                        <div class="button-cover">
                                            <div class="button r" id="button-3">
                                                <input value="yes" type="checkbox" name="post_email_msg" class="ghost_post_email_msg checkbox" checked="">
                                                <div class="knobs"></div>
                                                <div class="layer"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ghost_setting_content_preface_item" style="margin: 25px 0px;">
                        <div class="clearfix">
                            <div class="col-lg-4 float-left">
                                <div class="ghost_setting_content_preface_item_title">积分购买链接提醒</div></div>
                            <div class="col-lg-8 float-right">
                                <div class="ghost_setting_content_preface_item_content">
                                    <div class="toggle-button-cover">
                                        <div class="button-cover">
                                            <div class="button r" id="button-3">
                                                <input value="yes" type="checkbox" name="buy_download_link" class="ghost_buy_download_link checkbox" checked="">
                                                <div class="knobs"></div>
                                                <div class="layer"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ghost_setting_content_preface_item" style="margin: 25px 0px;">
                        <div class="clearfix">
                            <div class="col-lg-4 float-left">
                                <div class="ghost_setting_content_preface_item_title">用户私信提醒</div></div>
                            <div class="col-lg-8 float-right">
                                <div class="ghost_setting_content_preface_item_content">
                                    <div class="toggle-button-cover">
                                        <div class="button-cover">
                                            <div class="button r" id="button-3">
                                                <input value="yes" type="checkbox" name="message_email_msg" class="ghost_message_email_msg checkbox" checked="">
                                                <div class="knobs"></div>
                                                <div class="layer"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ghost_setting_content_preface_item">
                        <div class="clearfix">
                            <div class="col-lg-2 float-left">
                                <div class="ghost_setting_content_preface_item_title"></div>
                            </div>
                            <div class="col-lg-10 float-right">
                                <div class="ghost_setting_content_preface_item_content">
                                    <button type="submit" data-switchnonce="11ebcf25ed" class="my_switch_msg ghost_setting_content_btn_success">
                                        <span class="poi-icon fa-check fas fa-fw" aria-hidden="true"></span>
                                        <span class="ghost_setting_content_text">更新选项</span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </fieldset>
    </div>
</div>