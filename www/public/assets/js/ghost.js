jQuery(function($) {
    window.addEventListener('load', function(){

        $.ghostalert_loading = function(time, _true) {
            $('body').append('<div class="ghostalert_ ghost_dialog"><div class="ghostalert ghost_dialog_"></div></div>');
            $('.ghostalert').addClass('open');
            $('.ghost_alert').addClass('open');
            setTimeout(function() {
                $('.ghostalert').removeClass('open');
                $('.ghost_alert').removeClass('open');
                setTimeout(function() {
                    $('.ghostalert_').remove();
                },
                250);
                if (_true) {
                    window.location.reload();
                }
            },
            time);
        }
        $.ghostalert_success = function(msg, time, _true) {
            $('.ghostalert').append('<div class="ghost_alert success"><i class="fas fa-check-circle"></i><span>' + msg + '</span></div>');
            $('.ghostalert').addClass('open');
            $('.ghost_alert').addClass('open');
            setTimeout(function() {
                $('.ghostalert').removeClass('open');
                $('.ghost_alert').removeClass('open');
                setTimeout(function() {
                    $('.ghostalert_').remove();
                },
                250);
                if (_true) {
                    window.location.reload();
                }
            },
            time);
        }
        $.ghostalert_warning = function(msg, time, _true) {
            $('.ghostalert').append('<div class="ghost_alert warning"><i class="fas fa-exclamation-circle"></i><span>' + msg + '</span></div>');
            $('.ghostalert').addClass('open');
            $('.ghost_alert').addClass('open');
            setTimeout(function() {
                $('.ghostalert').removeClass('open');
                $('.ghost_alert').removeClass('open');
                setTimeout(function() {
                    $('.ghostalert_').remove();
                },
                250);
                if (_true) {
                    window.location.reload();
                }
            },
            time);
        }
        $.ghostalert_error = function(msg, time, _true) {
            $('.ghostalert').append('<div class="ghost_alert error"><i class="fas fa-exclamation-circle"></i><span>' + msg + '</span></div>');
            $('.ghostalert').addClass('open');
            $('.ghost_alert').addClass('open');
            setTimeout(function() {
                $('.ghostalert').removeClass('open');
                $('.ghost_alert').removeClass('open');
                setTimeout(function() {
                    $('.ghostalert_').remove();
                },
                250);
                if (_true) {
                    window.location.reload();
                }
            },
            time);
        }

        $(function() {
            $("img.lazy").lazyload({
                effect: "fadeIn"
            });
        });
        // author页面ajax
        $('.author .container').on('click', '.ghost_author_nav_item>.msg, .ghost_author_nav_item>.posts, .ghost_author_nav_item>.flowers, .ghost_author_nav_item>.fans, .ghost_author_nav_item>.comments',
        function(event) {
            slug = $(this).attr('data-slug');
            $('#ajax-author').html('<div class="spinner"><div class="double-bounce1"></div><div class="double-bounce2"></div></div>');
            $('.ghost_author_nav').find('.is-active').removeClass('is-active');
            $(this).closest('.ghost_author_nav_item').addClass('is-active');
            $uid = $('.ghost_author_header').attr('data-uid');
            $.ajax({
                url: ghost.ghost_ajax + '/action/author/author-' + slug + '.php',
                data: {
                    uid: $uid
                },
                type: 'POST',
                success: function(msg) {
                    if (msg) {
                        $('#ajax-author').html(msg);
                        $("img.lazy").lazyload({
                            effect: "fadeIn",
                        });
                    } else {
                        $('#ajax-author').html('错误');
                    }
                }
            });
        });
    
        //登录
        $('body').on('click', '.ghost_login_box_footer>.login, .ghost_login_box_footer>.reg, .ghost_login_box_footer>.forget, .login_veriCode',
        function() {
            $.ghostalert_loading(2000, false);
            if ($(this).attr('data-type') == 'login') {
                $user = {
                    'email': $("input[name='email']").val(),
                    'pwd': $("input[name='pwd']").val(),
                    'remember': $("input[name='rememberme']").val(),
                    'user_security': $(this).attr('value'),
                }
                $.ajax({
                    url: ghost.ghost_ajax,
                    data: {
                        c: 'User',
                        a: 'Check',
                        username: $("input[name='email']").val(),
                        password: $("input[name='pwd']").val(),
                        rememberMe: $("input[name='rememberme']").val(),
                        captcha: $(this).attr('value'),
                    },
                    type: 'POST',
                    success: function(msg) {
                        if (msg.code == 1) {
                            $.ghostalert_success(msg.message, 2000, true);
                        } else if (msg.code == 0) {
                            $.ghostalert_error(msg.message, 2000, false);
                        }
                    }
                });
            }
            if ($(this).attr('data-type') == 'reg') {
                $.ajax({
                    url: ghost.ghost_ajax,
                    data: {
                        c: 'User',
                        a: 'Reg',
                        username: $("input[name='username']").val(),
                        email: $("input[name='email']").val(),
                        password: $("input[name='pwd']").val(),
                        veriCode: $("input[name='veriCode']").val(),
                    },
                    type: 'POST',
                    success: function(msg) {
                        if(msg.code==0){
                            $.ghostalert_error(msg.message, 2000, false);
                        }else if(msg.code==1){
                            $.ghostalert_success(msg.message, 2000, true);
                        }
                    }
                });
            }
            if ($(this).attr('data-type') == 'forget') {
                $user = {
                    'email': $("input[name='email']").val(),
                    'pwd': $("input[name='password']").val(),
                    'veriCode': $("input[name='veriCode']").val(),
                    'user_security': $(this).attr('value'),
                }
                $.ajax({
                    url: ghost.ghost_ajax,
                    data: {
                        c: 'User',
                        a: 'ForgetPass',
                        email: $("input[name='email']").val(),
                        password: $("input[name='password']").val(),
                        veriCode: $("input[name='veriCode']").val(),
                    },
                    type: 'POST',
                    success: function(msg) {
                        if(msg.code==0){
                            $.ghostalert_error(msg.message, 2000, false);
                        }else if(msg.code==1){
                            $.ghostalert_success(msg.message, 2000, true);
                        }
                    }
                });
            }
            if ($(this).attr('data-type') == 'getregcode') {
                $.ajax({
                    url: ghost.ghost_ajax,
                    data: {
                        c: 'User',
                        a: 'GetRegCode',
                        email: $("input[name='email']").val(),
                        username: $("input[name='username']").val(),
                        password: $("input[name='pwd']").val(),
                    },
                    type: 'POST',
                    success: function(msg) {
                        if(msg.code==0){
                            $.ghostalert_error(msg.message, 2000, false);
                        }else if(msg.code==1){
                            $.ghostalert_success(msg.message, 2000, false);
                        }
                    }
                });
            }
            if ($(this).attr('data-type') == 'getforgetcode') {
                $.ajax({
                    url: ghost.ghost_ajax,
                    data: {
                        c: 'User',
                        a: 'GetForgetCode',
                        email: $("input[name='email']").val(),
                        username: $("input[name='username']").val(),
                        password: $("input[name='password']").val(),
                    },
                    type: 'POST',
                    success: function(msg) {
                        if(msg.code==0){
                            $.ghostalert_error(msg.message, 2000, false);
                        }else if(msg.code==1){
                            $.ghostalert_success(msg.message, 2000, false);
                        }
                    }
                });
            }
        });
    
        // 搜索弹窗
        $('html').on('click', '.ghost_header_search_anniu',
        function() {
            $('body').append('<div class="ghost_search_bar ghost_dialog">\
                <div class="ghost_search_bar_ ghost_dialog_"></div>\
                <div class="search_bar ghost_search_box_container">\
                    <div>\
                        <form method="get" action="' + ghost.siteurl + '" role="search" class="search_bar_form">\
                            <label class="search_bar_label">搜索</label>\
                            <input type="search" name="s" class="search_bar_input" type="search" placeholder="试试：漫画" aria-label="搜索" value="">\
                        </form>\
                        <div class="search_bar_all">' + ghost.ghost_pc_search + '</div>\
                </div>\
            </div>');
            $('.ghost_search_bar_').addClass('open');
            $('.ghost_search_box_container').addClass('open');
        }) 
        $('html').on('click', '.user-login',
        function() {
            $('body').append('<div class="ghost_login_bar ghost_dialog">\
            <div class="ghost_login_bar_ ghost_dialog_"></div>\
            <div class="ghost_login_box ghost_dialog_box">\
                <div class="ghost_login_box_container">\
                    <form action="javascript:;" id="ghost_login_box_form" class="ghost_login_box_form">\
                        <header class="ghost_login_box_header">\
                            <div class="ghost_login_box_title">\
                                <div class="ghost_login_box_title_left">\
                                    <a data-type="login" class="login ghost_login_box_title_left_item is-active">登录</a>\
                                    <a data-type="reg" class="reg ghost_login_box_title_left_item">注册</a>\
                                    <a data-type="forget" class="forget ghost_login_box_title_left_item">丢失密码</a></div>\
                                <a class="ghost_login_box_close">\
                                    <span class="poi-icon fa-times fas fa-fw" aria-hidden="true"></span>\
                                </a>\
                            </div>\
                        </header>\
                        <div class="ghost_login_box_content">\
                            <div class="ghost_login_box_content_text">\
                                <div>\
                                    <div>' + ghost.login_news + '</div>\
                                    <div class="content">\
                                      <div class="ghost_login_box_content_group">\
                                          <label class="login_input ghost_login_box_content_inputs">\
                                              <span class="ghost_login_box_content_inputs_icon">\
                                                  <span class="poi-icon fa-user fas fa-fw" aria-hidden="true"></span>\
                                              </span>\
                                              <span class="poi-form__group__inputs__content">\
                                                  <input type="email" name="email" class="ghost_login_box_content_input user" placeholder="您的电子邮件" title="您的电子邮件" required="" tabindex="1" minlength="5" value=""></span>\
                                          </label>\
                                      </div>\
                                      <div class="ghost_login_box_content_group">\
                                          <label class="login_input ghost_login_box_content_inputs">\
                                              <span class="ghost_login_box_content_inputs_icon">\
                                                  <span class="poi-icon fa-unlock-alt fas fa-fw" aria-hidden="true"></span>\
                                              </span>\
                                              <span class="poi-form__group__inputs__content">\
                                                  <input name="pwd" type="password" class="ghost_login_box_content_input pwd" placeholder="密码" title="密码" required="" tabindex="1" value=""></span>\
                                          </label>\
                                      </div>\
                                      <label class="remembermetext" for="rememberme"><input name="rememberme" type="checkbox" checked="checked" id="rememberme" class="rememberme" value="forever">14天内记住登录</label>\
                                    </div>\
                                </div>\
                            </div>\
                        </div>\
                        <footer class="ghost_login_box_footer">\
                            <button data-type="login" type="submit" value="' + ghost.userlogin_security_nonce + '" class="ghost_login_box_footer_btn login" tabindex="1">\
                                <span class="poi-icon fa-arrow-alt-circle-right fas fa-fw" aria-hidden="true"></span>\
                                <span class="ghost_icon_text">登录</span></button>\
                        </footer>\
                    </form>\
                </div>\
            </div>\
        </div>');
            $('.ghost_login_bar_').addClass('open');
            $('.ghost_login_box_container').addClass('open');
        }) 
        $('html').on('click', '.ghost_search_bar_',
        function() {
            $('.ghost_search_bar_').removeClass('open');
            $('.ghost_search_box_container').removeClass('open');
            setTimeout(function() {
                $('.ghost_search_bar').remove();
            },
            250);
        }) 
        $('html').on('click', '.ghost_login_box_close,.ghost_login_bar_',
        function() {
            $('.ghost_login_bar_').removeClass('open');
            $('.ghost_login_box_container').removeClass('open');
            setTimeout(function() {
                $('.ghost_login_bar').remove();
            },
            250);
        })
        // 登录注册忘记密码
        $('body').on('click', '.ghost_login_box_title_left>.login,.ghost_login_box_title_left>.reg,.ghost_login_box_title_left>.forget',
        function() {
            $('.ghost_login_box_header').find('.is-active').removeClass('is-active');
            $(this).addClass('is-active');
            if ($(this).attr('data-type') == 'reg') {
                $('.ghost_login_box_content_text .content').html('<div class="is-register">\
                    <div class="ghost_login_box_content_group clearfix">\
                        <label style="margin:0px 10px;" class="ghost_login_box_content_inputs">\
                            <span class="ghost_login_box_content_inputs_icon">\
                                <span class="poi-icon fa-user fas fa-fw" aria-hidden="true"></span>\
                            </span>\
                            <span class="poi-form__group__inputs__content">\
                                            <input type="username" name="username" class="ghost_login_box_content_input username" placeholder="请使用英文字符" title="您的昵称" required="" tabindex="1" minlength="5" value=""></span>\
                        </label>\
                    </div>\
                    <div class="ghost_login_box_content_group clearfix">\
                        <label style="margin: 0px 10px;" class="login_input ghost_login_box_content_inputs">\
                            <span class="ghost_login_box_content_inputs_icon">\
                                <span class="poi-icon fa-at fas fa-fw" aria-hidden="true"></span>\
                            </span>\
                            <span class="poi-form__group__inputs__content">\
                                <input name="email" type="email" class="ghost_login_box_content_input email" placeholder="您的电子邮件" title="您的电子邮件" required="" tabindex="1" value=""></span>\
                        </label>\
                        <label style="margin: 0px 10px;" class="login_input ghost_login_box_content_inputs">\
                            <span class="ghost_login_box_content_inputs_icon">\
                                <span class="poi-icon fa-unlock-alt fas fa-fw" aria-hidden="true"></span>\
                            </span>\
                            <span class="poi-form__group__inputs__content">\
                                <input name="pwd" type="password" class="ghost_login_box_content_input pwd" placeholder="密码" title="密码" required="" tabindex="1" value=""></span>\
                        </label>\
                    </div>\
                    <div class="ghost_login_box_content_group clearfix">\
                        <label class="login_input_ ghost_login_box_content_inputs">\
                            <span class="ghost_login_box_content_inputs_icon">\
                                <span class="poi-icon fa-pencil-alt fas fa-fw" aria-hidden="true"></span>\
                            </span>\
                            <span class="poi-form__group__inputs__content">\
                                <input name="veriCode" type="veriCode" class="ghost_login_box_content_input veriCode" placeholder="邮箱验证码" title="邮箱验证码" required="" tabindex="1" value=""></span>\
                        </label>\
                        <label class="login_veriCode_login_input"><a data-type="getregcode" class="login_veriCode"><span class="poi-icon fa-paper-plane fas fa-fw" aria-hidden="true"></span> <span class="ghost_icon_text">发送验证码</span></a></label>\
                    </div>\
                </div>');
                $('.ghost_login_box_footer').html('<button type="submit" value="' + ghost.userreg_security_nonce + '" data-type="reg" class="ghost_login_box_footer_btn reg" tabindex="1"><span class="poi-icon fa-user-plus fas fa-fw" aria-hidden="true"></span> <span class="ghost_icon_text">注册</span></button>');
            }
            if ($(this).attr('data-type') == 'login') {
                $('.ghost_login_box_content_text .content').html('<div class="is-register">\
                    <div class="ghost_login_box_content_group">\
                        <label class="ghost_login_box_content_inputs">\
                            <span class="ghost_login_box_content_inputs_icon">\
                                <span class="poi-icon fa-user fas fa-fw" aria-hidden="true"></span>\
                            </span>\
                            <span class="poi-form__group__inputs__content">\
                                <input type="email" name="email" class="ghost_login_box_content_input user" placeholder="您的电子邮件" title="您的电子邮件" required="" tabindex="1" minlength="5" value=""></span>\
                        </label>\
                    </div>\
                    <div class="ghost_login_box_content_group">\
                        <label class="ghost_login_box_content_inputs">\
                            <span class="ghost_login_box_content_inputs_icon">\
                                <span class="poi-icon fa-unlock-alt fas fa-fw" aria-hidden="true"></span>\
                            </span>\
                            <span class="poi-form__group__inputs__content">\
                                <input name="pwd" type="password" class="ghost_login_box_content_input pwd" placeholder="密码" title="密码" required="" tabindex="1" value="zhaolu123"></span>\
                        </label>\
                    </div>\
                    <label class="remembermetext" for="rememberme"><input name="rememberme" type="checkbox" checked="checked" id="rememberme" class="rememberme" value="forever">记住我的登录</label>\
                </div>');
                $('.ghost_login_box_footer').html('<button type="submit" value="' + ghost.userlogin_security_nonce + '" data-type="login" class="ghost_login_box_footer_btn login" tabindex="1"><span class="poi-icon fa-arrow-alt-circle-right fas fa-fw" aria-hidden="true"></span><span class="ghost_icon_text">登录</span></button>');
            }
            if ($(this).attr('data-type') == 'forget') {
                $('.ghost_login_box_content_text .content').html('<div class="is-register">\
                    <div class="ghost_login_box_content_group clearfix">\
                        <label style="margin:0px 10px;" class="ghost_login_box_content_inputs">\
                            <span class="ghost_login_box_content_inputs_icon">\
                                <span class="poi-icon fa-at fas fa-fw" aria-hidden="true"></span>\
                            </span>\
                            <span class="poi-form__group__inputs__content">\
                                <input type="email" name="email" class="ghost_login_box_content_input email" placeholder="您的电子邮箱" title="您的电子邮箱" required="" tabindex="1" minlength="5" value=""></span>\
                        </label>\
                    </div>\
                    <div class="ghost_login_box_content_group clearfix">\
                        <label class="login_input_ ghost_login_box_content_inputs">\
                            <span class="ghost_login_box_content_inputs_icon">\
                                <span class="poi-icon fa-pencil-alt fas fa-fw" aria-hidden="true"></span>\
                            </span>\
                            <span class="poi-form__group__inputs__content">\
                                <input name="veriCode" type="veriCode" class="ghost_login_box_content_input veriCode" placeholder="邮箱验证码" title="邮箱验证码" required="" tabindex="1" value=""></span>\
                        </label>\
                        <label class="login_veriCode_login_input"><a data-type="getforgetcode" class="login_veriCode"><span class="poi-icon fa-paper-plane fas fa-fw" aria-hidden="true"></span> <span class="ghost_icon_text">发送验证码</span></a></label>\
                    </div>\
                    <div class="ghost_login_box_content_group clearfix">\
                        <label style="margin:0px 10px;" class="ghost_login_box_content_inputs">\
                            <span class="ghost_login_box_content_inputs_icon">\
                                <span class="poi-icon fa-lock fas fa-fw" aria-hidden="true"></span>\
                            </span>\
                            <span class="poi-form__group__inputs__content">\
                                <input type="pwd" name="password" class="ghost_login_box_content_input pwd" placeholder="您的新密码" title="您的新密码" required="" tabindex="1" minlength="5" value=""></span>\
                        </label>\
                    </div>\
                </div>');
                $('.ghost_login_box_footer').html('<button type="submit" value="' + ghost.userforget_security_nonce + '" data-type="forget" class="ghost_login_box_footer_btn forget" tabindex="1"><span class="poi-icon fa-sync fas fa-fw" aria-hidden="true"></span> <span class="ghost_icon_text">确认更新密码</span></button>');
            }
        });
    
        // 分类排序
        $('.cat').on('click', '.paixu a',
        function(event) {
            $('.cat_ajax_post').html('<div class="spinner"><div class="double-bounce1"></div><div class="double-bounce2"></div></div>');
            $('.paixu').find('.is-active').removeClass('is-active');
            $(this).addClass('is-active');
            $paixu = $(this).attr('data-paixu');
            $cat = $('.paixu').attr('data-id');
            $.ajax({
                url: ghost.ghost_ajax,
                data: {
                    url: 'CatPaixu.php',
                    paixu: $paixu,
                    cat: $cat
                },
                type: 'POST',
                success: function(msg) {
                    if (msg.code != 0) {
                        $('.cat_ajax_post').html(msg);
                        $("img.lazy").lazyload({
                            effect: "fadeIn",
                        });
                    } else {
                        $('.cat_ajax_post').html('错误');
                    }
                }
            });
        });
        // 分类搜索
        $('.search ').on('click', '.ghost_search_form_condition_text',
        function(event) {
            $('#ghost_box_1').html('<div class="spinner"><div class="double-bounce1"></div><div class="double-bounce2"></div></div>');
            $cat_id = $(this).attr('data-id');
            $paixu = $(this).attr('data-paixu');
            $('.active').removeClass('active');
            $(this).parent('.ghost_search_form_condition_label').addClass('active');
            $s = $('.ghost_search_form_s').val();
            $page = $('.ghost_search_form_s').attr('data-page');
            $.ajax({
                url: ghost.ghost_ajax + '/action/search-cat-ajax.php',
                data: {
                    s: $s,
                    page: $page,
                    cat: $cat_id
                },
                type: 'POST',
                success: function(msg) {
                    if (msg) {
                        $('#ghost_box_1').html(msg);
                        $("img.lazy").lazyload({
                            effect: "fadeIn",
                        });
                    } else {
                        $('#ghost_box_1').html('错误');
                    }
                }
            });
        });
        // 回车搜索
        $('body').on('click', '.search_bar_item',
        function(event) {
            $('.search_bar_input').val($(this).text());
            $('.search_bar_form').submit();
        });
    
        // 个人中心页面
        $('.setting').on('click', '.ghost_sidebar_item_sub_item_link',
        function() {
            $('.setting_box').html('<div class="spinner"><div class="double-bounce1"></div><div class="double-bounce2"></div></div>');
            $type = $(this).attr('data-type');
            $.ajax({
                url: ghost.ghost_ajax,
                type: 'POST',
                data:{
                    'UserCenterAjax': $type,
                },
                success: function(msg) {
                    if (msg) {
                        $("title").html(ghost.title);
                        $('.setting_box').html(msg);
                    } else {
                        $('.setting_box').html('错误');
                    }
                }
            });
        });
    
        // 更新个人设置选项
        $('.setting_box').on('click', '.my_text_msg',
        function() {
            $.ghostalert_loading(2000, false);
            $UserMeta = {
                'name': $('.ghost_setting_content_preface_control[type=name]').val(),
                'dec': $('.ghost_setting_content_preface_control[type=dec]').val(),
            }
            if ($UserMeta['name'] == '' || $UserMeta['dec'] == '') {
                $.ghostalert_error('名称或描述空', 2000, false);
                return false;
            }
            $.ajax({
                url: ghost.ajaxurl,
                data: {
                    c: 'User',
                    a: 'UpdateUserMsg',
                    UserMeta: $UserMeta,
                    UserId: $('.ghost_setting_content_container').attr('data-userid'),
                },
                type: 'POST',
                success: function(msg) {
                    if (msg.code == 1) {
                        $.ghostalert_success(msg.message, 2000, false);
                    } else {
                        $.ghostalert_error(msg.message, 2000, false);
                    }
                }
            });
        });
    
        // 提交修改邮箱
        $('.setting_box').on('click', '.my_email_msg',
        function() {
            $.ghostalert_loading(2000, false);
            $EmailMeta = {
                'secure': $('.ghost_setting_content_preface_control[type=yanzhengma]').val(),
                'email': $('.ghost_setting_content_preface_control[type=email]').val(),
                'userid': $('.ghost_setting_content_container').attr('data-userid'),
            }
            if ($EmailMeta['secure'] == '' || $EmailMeta['email'] == '' || $EmailMeta['UserId'] == ''){
                $.ghostalert_error('验证码或邮箱空', 2000, false);
            }
            $.ajax({
                url: ghost.ajaxurl,
                data: {
                    c: 'User',
                    a: 'AlterUserEmail',
                    EmailMeta: $EmailMeta,
                },
                type: 'POST',
                success: function(msg) {
                    if (msg.code == 1) {
                        $.ghostalert_success(msg.message, 2000, false);
                    } else {
                        $.ghostalert_error(msg.message, 2000, false);
                    }
                }
            });
        });
    
        // 提交修改密码
        $('.setting_box').on('click', '.my_pwd_msg',
        function() {
            $.ghostalert_loading(2000, false);
            $PassWord = {
                'userid': $('.ghost_setting_content_container').attr('data-userid'),
                'oldpwd': $('.ghost_setting_content_preface_control[type=oldpassword]').val(),
                'newpwd': $('.ghost_setting_content_preface_control[type=newpassword]').val(),
                'new_pwd': $('.ghost_setting_content_preface_control[type=new_password]').val(),
            }
            if ($PassWord['oldpwd'] == '' || $PassWord['newpwd'] == '' || $PassWord['new_pwd'] == ''){
                $.ghostalert_error('密码为空', 2000, false);
            }
            $.ajax({
                url: ghost.ajaxurl,
                data: {
                    c: 'User',
                    a: 'UpdateUserPass',
                    PassWord: $PassWord,
                },
                type: 'POST',
                success: function(msg) {
                    if (msg.code == 1) {
                        $.ghostalert_success(msg.message, 2000, false);
                    } else {
                        $.ghostalert_error(msg.message, 2000, false);
                    }
                }
            });
        });
    
         // 提交修改其他选项
        $('.setting_box').on('click', '.my_switch_msg',
        function() {
            $msg = {'show_ip': $('.ghost_show_ip[name=show_ip]:checked').val(),
                'login_email_msg': $('.ghost_login_email_msg[name=login_email_msg]:checked').val(),
                'forget_email_msg': $('.ghost_forget_email_msg[name=forget_email_msg]:checked').val(),
                'pwd_email_msg': $('.ghost_pwd_email_msg[name=pwd_email_msg]:checked').val(),
                'myemail_email_msg': $('.ghost_myemail_email_msg[name=myemail_email_msg]:checked').val(),
                'avatar_email_msg': $('.ghost_avatar_email_msg[name=avatar_email_msg]:checked').val(),
                'comment_email_msg': $('.ghost_comment_email_msg[name=comment_email_msg]:checked').val(),
                'post_email_msg': $('.ghost_post_email_msg[name=post_email_msg]:checked').val(),
                'buy_download_link': $('.ghost_buy_download_link[name=buy_download_link]:checked').val(),
                'message_email_msg': $('.ghost_message_email_msg[name=message_email_msg]:checked').val(),
                'switchnonce': $(this).attr('data-switchnonce'),
            }
            $.ghostalert_loading(2000, false);
            $.ajax({
                url: ghost.ajaxurl,
                data: {
                    action: 'change_switch',
                    user: $msg
                },
                type: 'POST',
                success: function(msg) {
                    if (msg.code == 1) {
                        $.ghostalert_success(msg.msg, 2000, false);
                    } else {
                        $.ghostalert_error(msg.msg, 2000, false);
                    }
                }
            });
        });
    
        // 发送修改邮箱
        $('.setting_box').on('click', '.sent_email',
        function() {
            $.ghostalert_loading(2000, false);
            $email = $('.ghost_setting_content_preface_control[type=email]').val();
            $UserId = $('.ghost_setting_content_container').attr('data-userid');
            if ($email == '' || $UserId == ''){
                $.ghostalert_error('邮箱地址为空', 2000, false);
            }
            $.ajax({
                url: ghost.ajaxurl,
                data: {
                    c: 'User',
                    a: 'GetAlterCode',
                    Email: $email,
                    UserId: $UserId,
                },
                type: 'POST',
                success: function(msg) {
                    if (msg.code == 1) {
                        $.ghostalert_success(msg.message, 2000, false);
                    } else {
                        $.ghostalert_error(msg.message, 2000, false);
                    }
                }
            });
        });
    
        // 报告弹窗
        $('body').on('click', '.ghost_report_footer_btn_success[type=submit_reports_]',
        function() {
            $.ghostalert_loading(2000, false);
            $report_container = '';
            if ($('.ghost_report_item_container').find('.active').attr('data-type') == 'other') {
                $report_container = $('.ghost_report_reporter_content').val();
            }
            $report = $('.ghost_report_item_container').find('.active').attr('data-type');
            $reportnonce = $(this).attr('data-report');
            $post_id = $('.article').attr('data-id');
            $.ajax({
                url: ghost.ajaxurl,
                data: {
                    action: 'submit_reports',
                    report: $report,
                    post_id: $post_id,
                    report_container: $report_container,
                    reportnonce: $reportnonce
                },
                type: 'POST',
                success: function(msg) {
                    if (msg.code == 1) {
                        $('.ghost_reports_bar_').removeClass('open');
                        $('.ghost_reports_box_container').removeClass('open');
                        setTimeout(function() {
                            $('.ghost_reports_bar').remove();
                        },
                        250);
                        $.ghostalert_success(msg.msg, 2000, false);
                    } else {
                        $.ghostalert_error(msg.msg, 2000, false);
                    }
                }
            });
        }) 
        $('body').on('click', '.ghost_reports_bar .ghost_report_item',
        function() {
            $(this).closest('.ghost_report_item_container').find('.active').removeClass('active');
            $(this).addClass('active');
            if ($(this).attr('data-type') == 'other') {
                $('.ghost_report_reporter_content').show();
            } else {
                $('.ghost_report_reporter_content').hide();
            }
        }) 
        $('body').on('click', '.ghost_report',
        function() {
            $('body').append('<div class="ghost_reports_bar ghost_dialog">\
            <div class="ghost_reports_bar_ ghost_dialog_"></div>\
            <div class="ghost_reports_box ghost_dialog_box">\
                <div class="ghost_reports_box_container">\
                    <div class="ghost_report_fm">\
                        <header class="ghost_report_header">\
                            <div class="ghost_report_header_title">\
                                <span>\
                                    <span class="poi-icon fa-reports fas fa-fw" aria-hidden="true"></span>\
                                    <span class="ghost_report_text">文章报告</span></span>\
                                <a class="ghost_report_header_close">\
                                    <span class="poi-icon fa-times fas fa-fw" aria-hidden="true"></span>\
                                </a>\
                            </div>\
                        </header>\
                        <div class="ghost_report_content">\
                            <div class="ghost_report_item_container">\
                                <div class="clearfix">\
                                    <div class="col-md-6 float-left">\
                                        <a data-type="link" class="ghost_report_item">下载地址无效</a></div>\
                                    <div class="col-md-6 float-right">\
                                        <a data-type="pwd" class="ghost_report_item">提取码无效</a></div>\
                                    <div class="col-md-6 float-left">\
                                        <a data-type="pwd2" class="ghost_report_item">解压密码无效</a></div>\
                                    <div class="col-md-6 float-right">\
                                        <a data-type="container" class="ghost_report_item">不符合规定的内容</a></div>\
                                    <div class="col-md-12 float-right">\
                                        <a data-type="other" class="ghost_report_item" for="inn-report__item__custom-reason">其他原因</a>\
                                        <textarea style="display:none" class="ghost_report_reporter_content" placeholder="请填写内容 *" style="height: 39px;"></textarea>\
                                    </div>\
                                </div>\
                                <div></div>\
                            </div>\
                        </div>\
                        <footer class="ghost_report_footer">\
                            <button data-reportid="' + $(this).attr('data-reportid') + '" data-report="' + ghost.report_security_nonce + '" class="ghost_report_footer_btn ghost_report_footer_btn_success" title="" type="submit_reports_">\
                                <span class="poi-icon fa-check fas fa-fw" aria-hidden="true"></span>\
                                <span class="ghost_icon_text">提交报告</span></button>\
                        </footer>\
                    </div>\
                </div>\
            </div>\
        </div>');
            $('.ghost_reports_bar_').addClass('open');
            $('.ghost_reports_box_container').addClass('open');
        });
        $('html').on('click', '.ghost_report_header_close,.ghost_reports_bar_',
        function() {
            $('.ghost_reports_bar_').removeClass('open');
            $('.ghost_reports_box_container').removeClass('open');
            setTimeout(function() {
                $('.ghost_reports_bar').remove();
            },
            250); 
        })
    
    // 	收藏文章
        $('body').on('click', '.post_stars',
        function() {
                $this = $(this);
            $.ghostalert_loading(2000, false);
            $post_id = $('.article').attr('data-id');
            $.ajax({
                url: ghost.ajaxurl,
                data: {
                    action: 'post_stars',
                    post_id: $post_id
                },
                type: 'POST',
                success: function(msg) {
                    if (msg.code == 1) {
                        $this.html('<a class="single_post_footer_btn on"><span class="poi-icon fa-star fas fa-fw" aria-hidden="true"></span> <span class="ghost_icon_text">已收藏</span></a>');
                        $.ghostalert_success(msg.msg, 2000, false);
                    } else if (msg.code == 2){
                        $this.html('<a class="single_post_footer_btn"><span class="poi-icon fa-star far fa-fw" aria-hidden="true"></span> <span class="ghost_icon_text">收藏文章</span></a>');
                        $.ghostalert_error(msg.msg, 2000, false);
                    } else{
                        $.ghostalert_error(msg.msg, 2000, false);
                    }
                }
            });
        }) 
    
    // 	添加补链接
        $('body').on('click', '.ghost_report_footer_btn_success[type=submit_addlink_]',
        function() {
            $.ghostalert_loading(2000, false);
            $addlinknonce = $(this).attr('data-addlink');
            $post_id = $('.article').attr('data-id');
            // 下载
            if ($("input[name^='post_download_container']").val()) {
                var links = new Array();
                for (var i = 0; i < parseInt(($("input[name^='post_download_container']").length) / 4); i++) {
                    links[i] = new Object();
                            links[i] = {
                                name : $("input[name='post_download_container[" + i + "][name]']").val(),
                                link : $("input[name='post_download_container[" + i + "][link]']").val(),
                                pwd : $("input[name='post_download_container[" + i + "][pwd]']").val(),
                                pwd2 : $("input[name='post_download_container[" + i + "][pwd2]']").val(),
                                userid : $('.ghost_add_link').attr('data-userid'),
                            }
                }
                var link = links;
            } else {
                var link = '';
            }
            $.ajax({
                url: ghost.ajaxurl,
                data: {
                    action: 'submit_addlink',
                    addlinknonce: $addlinknonce,
                    post_id: $post_id,
                    download: link
                },
                type: 'POST',
                success: function(msg) {
                    if (msg.code == 1) {
                        $('.ghost_addlink_bar_').removeClass('open');
                        $('.ghost_addlink_box_container').removeClass('open');
                        setTimeout(function() {
                            $('.ghost_addlink_bar').remove();
                        },
                        250);
                        $.ghostalert_success(msg.msg, 2000, false);
                    } else {
                        $.ghostalert_error(msg.msg, 2000, false);
                    }
                }
            });
        }) 
        $('body').on('click', '.ghost_reports_bar .ghost_report_item',
        function() {
            $(this).closest('.ghost_report_item_container').find('.active').removeClass('active');
            $(this).addClass('active');
            if ($(this).attr('data-type') == 'other') {
                $('.ghost_report_reporter_content').show();
            } else {
                $('.ghost_report_reporter_content').hide();
            }
        }) 
        $('body').on('click', '.ghost_add_link',
        function() {
            $('body').append('<div class="ghost_addlink_bar ghost_dialog">\
            <div class="ghost_addlink_bar_ ghost_dialog_"></div>\
            <div class="ghost_addlink_box ghost_dialog_box">\
                <div class="ghost_addlink_box_container">\
                    <div class="ghost_addlink_fm">\
                        <header class="ghost_addlink_header">\
                            <div class="ghost_addlink_header_title">\
                                <span>\
                                    <span class="poi-icon fa-reports fas fa-fw" aria-hidden="true"></span>\
                                    <span class="ghost_addlink_text">添加链接</span></span>\
                                <a class="ghost_addlink_header_close">\
                                    <span class="poi-icon fa-times fas fa-fw" aria-hidden="true"></span>\
                                </a>\
                            </div>\
                        </header>\
                        <div class="ghost_addlink_content">\
                            <div class="ghost_addlink_item_container">\
                                            <div class="ghost_setting_content_item_content ghost_download">\
                                <div class="clearfix">\
                                    <div class="clearfix ghost_download_link">\
                                                        <div class="col-lg-12 float-left poi-g_lg-2-10">\
                                                            <label class="ghost_download_link_group_inputs">\
                                                                <span class="ghost_download_link_inputs_icon">\
                                                                    <span class="poi-icon fa-cloud-download-alt fas fa-fw" aria-hidden="true"></span>\
                                                                </span>\
                                                                <span class="ghost_download_link_inputs_content">\
                                                                    <input name="post_download_container[0][name]" class="ghost_setting_content_preface_control_downloadlink " type="text" placeholder="下载名称" title="下载名称" list="customPostStoragedatalist"></span>\
                                                            </label>\
                                                        </div>\
                                                        <div class="col-lg-12 float-left poi-g_lg-2-10">\
                                                            <label class="ghost_download_link_group_inputs">\
                                                                <span class="ghost_download_link_inputs_icon">\
                                                                    <span class="poi-icon fa-link fas fa-fw" aria-hidden="true"></span>\
                                                                </span>\
                                                                <span class="ghost_download_link_inputs_content">\
                                                                    <input name="post_download_container[0][link]" class="ghost_setting_content_preface_control_downloadlink " type="text" placeholder="下载链接" title="下载链接" list="customPostStoragedatalist"></span>\
                                                            </label>\
                                                        </div>\
                                                        <div class="col-lg-12 float-left poi-g_lg-1-10">\
                                                            <label class="ghost_download_link_group_inputs">\
                                                                <span class="ghost_download_link_inputs_icon">\
                                                                    <span class="poi-icon fa-key fas fa-fw" aria-hidden="true"></span>\
                                                                </span>\
                                                                <span class="ghost_download_link_inputs_content">\
                                                                    <input name="post_download_container[0][pwd]" class="ghost_setting_content_preface_control_downloadlink " type="text" placeholder="提取密码" title="提取密码" list="customPostStoragedatalist"></span>\
                                                            </label>\
                                                        </div>\
                                                        <div class="col-lg-12 float-left poi-g_lg-1-10">\
                                                            <label class="ghost_download_link_group_inputs">\
                                                                <span class="ghost_download_link_inputs_icon">\
                                                                    <span class="poi-icon fa-unlock fas fa-fw" aria-hidden="true"></span>\
                                                                </span>\
                                                                <span class="ghost_download_link_inputs_content">\
                                                                    <input name="post_download_container[0][pwd2]" class="ghost_setting_content_preface_control_downloadlink " type="text" placeholder="解压密码" title="解压密码" list="customPostStoragedatalist"></span>\
                                                            </label>\
                                                        </div>\
                                                        <div class="col-lg-1 float-left poi-g_lg-1-10">\
                                                            <div class="poi-btn-group ghost_download_link_storage_btns">\
                                                                <a class="link_add_pop_ups ghost_download_link_delete_btn">\
                                                                    <span class="poi-icon fa-plus fas fa-fw" aria-hidden="true"></span>\
                                                                </a>\
                                                                <a style="background: rgba(241,108,102,.3);color:#fff;cursor: not-allowed;" class="ghost_download_link_delete_btn" disabled="">\
                                                                    <span class="poi-icon fa-trash fas fa-fw" aria-hidden="true"></span>\
                                                                </a>\
                                                            </div>\
                                                        </div>\
                                                    </div>\
                                </div>\
                                <div>\
                                <div>\
                                             </div>\
                            </div>\
                        </div>\
                        <footer class="ghost_addlink_footer">\
                            <button data-addlinkid="' + $(this).attr('data-reportid') + '" data-addlink="' + ghost.report_security_nonce + '" class="ghost_report_footer_btn ghost_report_footer_btn_success" title="" type="submit_addlink_">\
                                <span class="poi-icon fa-check fas fa-fw" aria-hidden="true"></span>\
                                <span class="ghost_icon_text">提交链接</span></button>\
                        </footer>\
                    </div>\
                </div>\
            </div>\
        </div>');
            $('.ghost_addlink_bar_').addClass('open');
            $('.ghost_addlink_box_container').addClass('open');
        });
        $('html').on('click', '.ghost_addlink_header_close,.ghost_addlink_bar_',
        function() {
            $('.ghost_addlink_bar_').removeClass('open');
            $('.ghost_addlink_box_container').removeClass('open');
            setTimeout(function() {
                $('.ghost_addlink_bar').remove();
            },
            250); 
        })
    
        // 弹窗链接添加
        $('body').on('click', '.link_add_pop_ups',
        function() {
            $i = $('.ghost_download .ghost_download_link').length;
            $link = '<div class="clearfix ghost_download_link">\
            <div class="col-lg-12 float-left poi-g_lg-2-10">\
                <label class="ghost_download_link_group_inputs">\
                    <span class="ghost_download_link_inputs_icon">\
                        <span class="poi-icon fa-cloud-download-alt fas fa-fw" aria-hidden="true"></span>\
                    </span>\
                    <span class="ghost_download_link_inputs_content">\
                        <input name="post_download_container[' + $i + '][name]" class="ghost_setting_content_preface_control_downloadlink " type="text" placeholder="下载名称" title="下载名称" list="customPostStoragedatalist" placeholder="下载名称"></span>\
                </label>\
            </div>\
            <div class="col-lg-12 float-left poi-g_lg-2-10">\
                <label class="ghost_download_link_group_inputs">\
                    <span class="ghost_download_link_inputs_icon">\
                        <span class="poi-icon fa-link fas fa-fw" aria-hidden="true"></span>\
                    </span>\
                    <span class="ghost_download_link_inputs_content">\
                        <input name="post_download_container[' + $i + '][link]" class="ghost_setting_content_preface_control_downloadlink " type="text" placeholder="下载链接" title="下载链接" list="customPostStoragedatalist" placeholder="下载链接"></span>\
                </label>\
            </div>\
            <div class="col-lg-12 float-left poi-g_lg-1-10">\
                <label class="ghost_download_link_group_inputs">\
                    <span class="ghost_download_link_inputs_icon">\
                        <span class="poi-icon fa-key fas fa-fw" aria-hidden="true"></span>\
                    </span>\
                    <span class="ghost_download_link_inputs_content">\
                        <input name="post_download_container[' + $i + '][pwd]" class="ghost_setting_content_preface_control_downloadlink " type="text" placeholder="提取密码" title="提取密码" list="customPostStoragedatalist" placeholder="提取密码"></span>\
                </label>\
            </div>\
            <div class="col-lg-12 float-left poi-g_lg-1-10">\
                <label class="ghost_download_link_group_inputs">\
                    <span class="ghost_download_link_inputs_icon">\
                        <span class="poi-icon fa-unlock fas fa-fw" aria-hidden="true"></span>\
                    </span>\
                    <span class="ghost_download_link_inputs_content">\
                        <input name="post_download_container[' + $i + '][pwd2]" class="ghost_setting_content_preface_control_downloadlink " type="text" placeholder="解压密码" title="解压密码" list="customPostStoragedatalist" placeholder="解压密码"></span>\
                </label>\
            </div>\
            <div class="col-lg-1 float-left poi-g_lg-1-10">\
                <div class="poi-btn-group ghost_download_link_storage_btns">\
                    <a class="link_add_pop_ups ghost_download_link_delete_btn">\
                        <span class="poi-icon fa-plus fas fa-fw" aria-hidden="true"></span>\
                    </a>\
                    <a class="link_del ghost_download_link_delete_btn" disabled="">\
                        <span class="poi-icon fa-trash fas fa-fw" aria-hidden="true"></span>\
                    </a>\
                </div>\
            </div>\
        </div>';
            $('.ghost_download').append($link);
        });
    
        // 	颜文表情弹窗
        $('body').on('click', '.ghost_comment_footer_btn.ghost_yanwen',
        function() {
            $('body').append('<div class="ghost_yanwen_bar ghost_dialog">\
                             <div class="ghost_yanwen_bar_ ghost_dialog_"></div>\
                             <div class="ghost_yanwen_box ghost_dialog_box">\
                                <div class="ghost_yanwen_container">\
                                    <div class="ghost_yanwen_content">\
                                        <div class="ghost_yanwen_emotion">\
                                            <a class="ghost_yanwen_item" title="(⊙⊙！) ">(⊙⊙！)</a>\
                                            <a class="ghost_yanwen_item" title="ƪ(‾ε‾“)ʃƪ(">ƪ(‾ε‾“)ʃƪ(</a>\
                                            <a class="ghost_yanwen_item" title="Σ(°Д°;">Σ(°Д°;</a>\
                                            <a class="ghost_yanwen_item" title="눈_눈">눈_눈</a>\
                                            <a class="ghost_yanwen_item" title="(๑>◡<๑) ">(๑&gt;◡&lt;๑)</a>\
                                            <a class="ghost_yanwen_item" title="(❁´▽`❁)">(❁´▽`❁)</a>\
                                            <a class="ghost_yanwen_item" title="(,,Ծ▽Ծ,,)">(,,Ծ▽Ծ,,)</a>\
                                            <a class="ghost_yanwen_item" title="（⺻▽⺻ ）">（⺻▽⺻ ）</a>\
                                            <a class="ghost_yanwen_item" title="乁( ◔ ౪◔)「">乁( ◔ ౪◔)「</a>\
                                            <a class="ghost_yanwen_item" title="ლ(^o^ლ)">ლ(^o^ლ)</a>\
                                            <a class="ghost_yanwen_item" title="(◕ܫ◕)">(◕ܫ◕)</a>\
                                            <a class="ghost_yanwen_item" title="❀.(*´▽`*)❀.">❀.(*´▽`*)❀.</a>\
                                            <a class="ghost_yanwen_item" title="(´･ω･`)">(´･ω･`)</a>\
                                            <a class="ghost_yanwen_item" title="ヽ(ﾟ∀ﾟ)ﾉ">ヽ(ﾟ∀ﾟ)ﾉ</a>\
                                            <a class="ghost_yanwen_item" title="(ฅ>ω<*ฅ)">(ฅ&gt;ω&lt;*ฅ)</a>\
                                            <a class="ghost_yanwen_item" title="ヽ(*≧ω≦)ﾉ">ヽ(*≧ω≦)ﾉ</a>\
                                            <a class="ghost_yanwen_item" title="( ≧Д≦)">( ≧Д≦)</a>\
                                            <a class="ghost_yanwen_item" title="(Ｔ▽Ｔ)">(Ｔ▽Ｔ)</a>\
                                            <a class="ghost_yanwen_item" title="(ノへ￣、) ">(ノへ￣、)</a>\
                                            <a class="ghost_yanwen_item" title="・ﾟ・(ノД`)・ﾟ・">・ﾟ・(ノД`)・ﾟ・</a>\
                                            <a class="ghost_yanwen_item" title="(,, ･∀･)ﾉ゛">(,, ･∀･)ﾉ゛</a>\
                                            <a class="ghost_yanwen_item" title="(o´ω`o)ﾉ">(o´ω`o)ﾉ</a>\
                                            <a class="ghost_yanwen_item" title="(￣^￣)ゞ">(￣^￣)ゞ</a>\
                                            <a class="ghost_yanwen_item" title="⁄(⁄ ⁄•⁄ω⁄•⁄ ⁄)⁄">⁄(⁄ ⁄•⁄ω⁄•⁄ ⁄)⁄</a>\
                                            <a class="ghost_yanwen_item" title="（＊／ω＼＊ )">（＊／ω＼＊ )</a>\
                                            <a class="ghost_yanwen_item" title="(´∇ﾉ｀*)ノ">(´∇ﾉ｀*)ノ</a>\
                                            <a class="ghost_yanwen_item" title="(〃ﾉωﾉ)">(〃ﾉωﾉ)</a>\
                                            <a class="ghost_yanwen_item" title="(╯°□°）╯︵ ┻━┻">(╯°□°）╯︵ ┻━┻</a>\
                                            <a class="ghost_yanwen_item" title="(=ﾟДﾟ=) ▄︻┻┳━ ·.`.`.`. ">(=ﾟДﾟ=) ▄︻┻┳━ ·.`.`.`.</a>\
                                            <a class="ghost_yanwen_item" title="╰(￣ω￣ｏ) [摸摸头]">╰(￣ω￣ｏ) [摸摸头]</a>\
                                            <a class="ghost_yanwen_item" title="( ｰ̀дｰ́ )ง ">( ｰ̀дｰ́ )ง</a>\
                                            <a class="ghost_yanwen_item" title="(๑•̀ㅂ•́)و✧">(๑•̀ㅂ•́)و✧</a>\
                                            <a class="ghost_yanwen_item" title="_(:з」∠)_">_(:з」∠)_</a>\
                                            <a class="ghost_yanwen_item" title="╮(╯▽╰)╭">╮(╯▽╰)╭</a>\
                                            <a class="ghost_yanwen_item" title="（ﾉ´д｀）">（ﾉ´д｀）</a></div>\
                                    </div>\
                                    <footer class="ghost_yanwen_footer">\
                                        <a class="ghost_yanwen_footer_btn ghost_yanwen_header_close" title="">\
                                            <span class="poi-icon fa-times fas fa-fw" aria-hidden="true"></span>\
                                        </a>\
                                    </footer>\
                                </div>\
                             </div>\
                             </div>');
            $('.ghost_yanwen_bar_').addClass('open');
            $('.ghost_yanwen_container').addClass('open');
        }) 
        $('html').on('click', '.ghost_yanwen_header_close,.ghost_yanwen_bar_',
        function() {
            $('.ghost_yanwen_bar_').removeClass('open');
            $('.ghost_yanwen_container').removeClass('open');
            setTimeout(function() {
                $('.ghost_yanwen_bar').remove();
            },
            250); 
        }) 
        $('html').on('click', '.ghost_yanwen_item',
        function() {
            $('.ghost_yanwen_bar_').removeClass('open');
            $('.ghost_yanwen_container').removeClass('open');
            setTimeout(function() {
                $('.ghost_yanwen_bar').remove();
            },
            250);
            $('.ghost_comment_commenter_content').val($('.ghost_comment_commenter_content').val() + $(this).attr('title')); 
        })
    
        // 	图文表情弹窗
        $('body').on('click', '.ghost_comment_footer_btn.ghost_tuwen',
        function() {
            $('body').append('<div class="ghost_tuwen_bar ghost_dialog">\
                             <div class="ghost_tuwen_bar_ ghost_dialog_"></div>\
                             <div class="ghost_tuwen_box ghost_dialog_box">\
                                <div class="ghost_tuwen_container">\
                                    <div class="ghost_tuwen_content">\
                                        <div class="ghost_tuwen_emotion">\
                                            <a class="ghost_tuwen_item" title="滑稽">\
                                                <img class="ghost_tuwen_item_img" src="https://sinaimg.inn-studio.com/large/c524f7d4jw1f0wwjnedhoj200u00ugld.jpg" alt="滑稽" width="50" height="50"></a>\
                                            <a class="ghost_tuwen_item" title="感谢分享">\
                                                <img class="ghost_tuwen_item_img" src="https://sinaimg.inn-studio.com/large/c524f7d4jw1fbk5ir4rznj202s02eglh.jpg" alt="感谢分享" width="50" height="50"></a>\
                                            <a class="ghost_tuwen_item" title="脸红">\
                                                <img class="ghost_tuwen_item_img" src="https://sinaimg.inn-studio.com/large/686ee05djw1eu8ijxc3p7g201c01c3yd.gif" alt="脸红" width="50" height="50"></a>\
                                            <a class="ghost_tuwen_item" title="杯具">\
                                                <img class="ghost_tuwen_item_img" src="https://sinaimg.inn-studio.com/large/686ee05djw1eu8ikpw34jg201e01emx1.gif" alt="杯具" width="50" height="50"></a>\
                                            <a class="ghost_tuwen_item" title="亚历山大">\
                                                <img class="ghost_tuwen_item_img" src="https://sinaimg.inn-studio.com/large/686ee05djw1eu8iliwosmg201e01e74h.gif" alt="亚历山大" width="50" height="50"></a>\
                                            <a class="ghost_tuwen_item" title="想要">\
                                                <img class="ghost_tuwen_item_img" src="https://sinaimg.inn-studio.com/large/686ee05djw1eu8ilzci2jg202s02sglo.gif" alt="想要" width="50" height="50"></a>\
                                            <a class="ghost_tuwen_item" title="吃惊">\
                                                <img class="ghost_tuwen_item_img" src="https://sinaimg.inn-studio.com/large/686ee05djw1eu8j1vay4ej204h049jrb.jpg" alt="吃惊" width="50" height="50"></a>\
                                            <a class="ghost_tuwen_item" title="好样的">\
                                                <img class="ghost_tuwen_item_img" src="https://sinaimg.inn-studio.com/large/686ee05djw1eu8iomh5cbg203g03cdgx.gif" alt="好样的" width="50" height="50"></a>\
                                            <a class="ghost_tuwen_item" title="感谢分享2">\
                                                <img class="ghost_tuwen_item_img" src="https://sinaimg.inn-studio.com/large/c524f7d4jw1f44hq6g2ftj202s02swef.jpg" alt="感谢分享2" width="50" height="50"></a>\
                                            <a class="ghost_tuwen_item" title="生气">\
                                                <img class="ghost_tuwen_item_img" src="https://sinaimg.inn-studio.com/large/c524f7d4jw1eu8fzbvagqj202s02sa9z.jpg" alt="生气" width="50" height="50"></a>\
                                            <a class="ghost_tuwen_item" title="卖萌">\
                                                <img class="ghost_tuwen_item_img" src="https://sinaimg.inn-studio.com/large/c524f7d4jw1eu8g1m0y49j202s02sjrb.jpg" alt="卖萌" width="50" height="50"></a>\
                                            <a class="ghost_tuwen_item" title="OK！">\
                                                <img class="ghost_tuwen_item_img" src="https://sinaimg.inn-studio.com/large/c524f7d4jw1eu8fza5ep2j202s02s3yg.jpg" alt="OK！" width="50" height="50"></a>\
                                            <a class="ghost_tuwen_item" title="不行">\
                                                <img class="ghost_tuwen_item_img" src="https://sinaimg.inn-studio.com/large/c524f7d4jw1eu8fz69u1qj202s02st8n.jpg" alt="不行" width="50" height="50"></a>\
                                            <a class="ghost_tuwen_item" title="叹气">\
                                                <img class="ghost_tuwen_item_img" src="https://sinaimg.inn-studio.com/large/c524f7d4jw1fbk5jxgin9j202s02e743.jpg" alt="叹气" width="50" height="50"></a>\
                                            <a class="ghost_tuwen_item" title="棒！">\
                                                <img class="ghost_tuwen_item_img" src="https://sinaimg.inn-studio.com/large/c524f7d4jw1eu8fz1nm1rj202s02smx3.jpg" alt="棒！" width="50" height="50"></a>\
                                            <a class="ghost_tuwen_item" title="偷笑">\
                                                <img class="ghost_tuwen_item_img" src="https://sinaimg.inn-studio.com/large/c524f7d4jw1f124864q4qj202s02e3ye.jpg" alt="偷笑" width="50" height="50"></a>\
                                            <a class="ghost_tuwen_item" title="噫">\
                                                <img class="ghost_tuwen_item_img" src="https://sinaimg.inn-studio.com/large/c524f7d4jw1f0z83hc4ndj202s02ea9x.jpg" alt="噫" width="50" height="50"></a>\
                                            <a class="ghost_tuwen_item" title="good">\
                                                <img class="ghost_tuwen_item_img" src="https://sinaimg.inn-studio.com/large/c524f7d4jw1f0z83fr4l7j202s02emx2.jpg" alt="good" width="50" height="50"></a>\
                                            <a class="ghost_tuwen_item" title="不明真相">\
                                                <img class="ghost_tuwen_item_img" src="https://sinaimg.inn-studio.com/large/c524f7d4jw1fbk5fo2790j202s02eweb.jpg" alt="不明真相" width="50" height="50"></a>\
                                            <a class="ghost_tuwen_item" title="太棒了">\
                                                <img class="ghost_tuwen_item_img" src="https://sinaimg.inn-studio.com/large/c524f7d4jw1fbk5lerczej202s02edfn.jpg" alt="太棒了" width="50" height="50"></a>\
                                            <a class="ghost_tuwen_item" title="不知所措">\
                                                <img class="ghost_tuwen_item_img" src="https://sinaimg.inn-studio.com/large/c524f7d4jw1fbk5qzpg9aj202s02eq2u.jpg" alt="不知所措" width="50" height="50"></a>\
                                            <a class="ghost_tuwen_item" title="盯..">\
                                                <img class="ghost_tuwen_item_img" src="https://sinaimg.inn-studio.com/large/c524f7d4jw1fbk5pi74hgj202s02et8i.jpg" alt="盯.." width="50" height="50"></a>\
                                            <a class="ghost_tuwen_item" title="所以呢">\
                                                <img class="ghost_tuwen_item_img" src="https://sinaimg.inn-studio.com/large/c524f7d4jw1f0z838j5d4j202s02emx1.jpg" alt="所以呢" width="50" height="50"></a>\
                                            <a class="ghost_tuwen_item" title="残念">\
                                                <img class="ghost_tuwen_item_img" src="https://sinaimg.inn-studio.com/large/c524f7d4jw1fbk5hkglbsj202s02e3yf.jpg" alt="残念" width="50" height="50"></a>\
                                        </div>\
                                    <footer class="ghost_tuwen_footer">\
                                        <a class="ghost_tuwen_footer_btn ghost_tuwen_header_close" title="">\
                                            <span class="poi-icon fa-times fas fa-fw" aria-hidden="true"></span>\
                                        </a>\
                                    </footer>\
                                </div>\
                             </div>\
                             </div>');
            $('.ghost_tuwen_bar_').addClass('open');
            $('.ghost_tuwen_container').addClass('open');
        }) 
        $('html').on('click', '.ghost_tuwen_header_close,.ghost_tuwen_bar_',
        function() {
            $('.ghost_tuwen_bar_').removeClass('open');
            $('.ghost_tuwen_container').removeClass('open');
            setTimeout(function() {
                $('.ghost_tuwen_bar').remove();
            },
            250); 
        }) 
        $('html').on('click', '.ghost_tuwen_item',
        function() {
            $('.ghost_tuwen_bar_').removeClass('open');
            $('.ghost_tuwen_container').removeClass('open');
            setTimeout(function() {
                $('.ghost_tuwen_bar').remove();
            },
            250);
            $('.ghost_comment_commenter_content').val($('.ghost_comment_commenter_content').val() + ' [' + $(this).attr('title') + '] '); 
        })
    
        // 评论弹窗
        function submit_comment($type, $class) {
            $('body').on('click', $class,
            function() {
                $('body').append('<div class="ghost_comments_bar ghost_dialog">\
                <div class="ghost_comments_bar_ ghost_dialog_"></div>\
                <div class="ghost_comments_box ghost_dialog_box">\
                    <div class="ghost_comments_box_container">\
                        <form class="ghost_comment_fm" action="javascript:;">\
                            <header class="ghost_comment_header">\
                                <div class="ghost_comment_header_title">\
                                    <span>\
                                        <span class="poi-icon fa-comments fas fa-fw" aria-hidden="true"></span>\
                                        <span class="ghost_comment_text">发表评论</span></span>\
                                    <a class="ghost_comment_header_close">\
                                        <span class="poi-icon fa-times fas fa-fw" aria-hidden="true"></span>\
                                    </a>\
                                </div>\
                            </header>\
                            <div class="ghost_comment_content">\
                                <textarea name="content" class="ghost_comment_commenter_content" placeholder="请填写评论内容 *" required="" style="height: 39px;"></textarea>\
                            </div>\
                            <footer class="ghost_comment_footer">\
                                <a class="ghost_comment_footer_btn ghost_yanwen" title="颜文表情" style="flex-grow: 2;">\
                                    <span class="poi-icon fa-font fas fa-fw" aria-hidden="true"></span>\
                                </a>\
                                <a class="ghost_comment_footer_btn ghost_tuwen" title="颜文表情" style="flex-grow: 2;">\
                                    <span class="poi-icon fa-smile fas fa-fw" aria-hidden="true"></span>\
                                </a>\
                                <button  type="submit" data-commentid="' + $(this).attr('data-commentid') + '" data-comment="' + ghost.comment_security_nonce + '" class="ghost_comment_' + $type + '_submit ghost_comment_footer_btn ghost_comment_footer_btn_success" title="">\
                                    <span class="poi-icon fa-check fas fa-fw" aria-hidden="true"></span>\
                                    <span class="ghost_icon_text">我说完了</span></button>\
                            </footer>\
                        </form>\
                    </div>\
                </div>\
            </div>');
                $('.ghost_comments_bar_').addClass('open');
                $('.ghost_comments_box_container').addClass('open');
            });
        }
        $('html').on('click', '.ghost_comment_header_close,.ghost_comments_bar_',
        function() {
            $('.ghost_comments_bar_').removeClass('open');
            $('.ghost_comments_box_container').removeClass('open');
            setTimeout(function() {
                $('.ghost_comments_bar').remove();
            },
            250);
        })
        // 评论文章
        submit_comment('post', '.join_comments');
        $('html').on('click', '.ghost_comment_post_submit',
        function() {
            $comment = {
                'content': $('.ghost_comment_commenter_content').val(),
                'commentnonce': $(this).attr('data-comment'),
                'post_id': $('.article').attr('data-id'),
            }
            if ($comment['content'] == '') return false;
            $.ghostalert_loading(2000, false);$.ajax({
                url: ghost.ajaxurl,
                data: {
                    action: 'submit_comments',
                    comment: $comment
                },
                type: 'POST',
                success: function(msg) {
                    if (msg.code == 1) {
                        $('.ghost_comments_bar_').removeClass('open');
                        $('.ghost_comments_box_container').removeClass('open');
                        setTimeout(function() {
                            $('.ghost_comments_bar').remove();
                        },
                        250);
                        $.ghostalert_success(msg.msg, 2000, true);
                    } else {
                        $.ghostalert_error(msg.msg, 2000, false);
                    }
                }
            });
        })
    
        // 评论用户
        submit_comment('user', '.ghost_reply_active');
        $('html').on('click', '.ghost_comment_user_submit',
        function() {
            $comment = {
                'content': $('.ghost_comment_commenter_content').val(),
                'commentnonce': $(this).attr('data-comment'),
                'post_id': $('.article').attr('data-id'),
                'commentid': $(this).attr('data-commentid'),
            }
            if ($comment['content'] == '') return false;
            $.ghostalert_loading(2000, false);
            $.ajax({
                url: ghost.ajaxurl,
                data: {
                    action: 'submit_usercomments',
                    comment: $comment
                },
                type: 'POST',
                success: function(msg) {
                    if (msg.code == 1) {
                        $('.ghost_comments_bar_').removeClass('open');
                        $('.ghost_comments_box_container').removeClass('open');
                        setTimeout(function() {
                            $('.ghost_comments_bar').remove();
                        },
                        250);
                        $.ghostalert_success(msg.msg, 2000, true);
                    } else {
                        $.ghostalert_error(msg.msg, 2000, false);
                    }
                }
            });
        })
    
        // 评论点赞
        $('html').on('click', '.ghost_like_active',
        function() {
            $this = $(this);
            $.ghostalert_loading(2000, false);
            $comments_id = $(this).attr('data-commentid');
            $.ajax({
                url: ghost.ajaxurl,
                data: {
                    action: 'submit_usercomments_like',
                    comments_id: $comments_id
                },
                type: 'POST',
                success: function(msg) {
                    if (msg.code == 1) {
                        $this.addClass('user_like');
                        $this.html('<span class="ghost_comment_item_like_btn_icon poi-icon fa-thumbs-up fas fa-fw" aria-hidden="true"></span><span>' + msg.num + '</span>');
                        $.ghostalert_success(msg.msg, 2000, false);
                    } else {
                        $.ghostalert_error(msg.msg, 2000, false);
                    }
                }
            });
        })
    
        // 积分购买链接
        $('.single').on('click', '.buy_download_link',
        function() {
            $.ghostalert_loading(2000, false);
            $id = $(this).attr('data-id');
            $postid = $(this).attr('data-postid');
            $author_id = $(this).attr('data-author_id');
            $user_id = $(this).attr('data-user_id');
            $.ajax({
                url: ghost.ajaxurl,
                data: {
                    c: 'User',
                    a: 'BuyPaidPost',
                    postid: $postid,
                    author_id: $author_id,
                    user_id: $user_id,
                    type: $id
                },
                type: 'POST',
                success: function(msg) {
                    console.log(msg);
                    if (msg.code == 1) {
                        $.ghostalert_success(msg.message, 2000, true);
                    } else {
                        $.ghostalert_error(msg.message, 2000, true);
                    }
                }
            });
        });
    
        // 新建文章
        $('body').on('click', '.mypost_cat',
        function() {
            $('body').append('<div class="ghost_comments_bar ghost_dialog">\
            <div class="ghost_comments_bar_ ghost_dialog_"></div>\
            <div class="ghost_comments_box ghost_dialog_box">\
                <div class="ghost_comments_box_container">\
                    <div class="ghost_comment_fm">\
                        <header class="ghost_comment_header">\
                            <div class="ghost_comment_header_title">\
                                <span>\
                                    <span class="poi-icon fa-comments fas fa-fw" aria-hidden="true"></span>\
                                    <span class="ghost_comment_text">分类选择</span></span>\
                                <a class="ghost_comment_header_close">\
                                    <span class="poi-icon fa-times fas fa-fw" aria-hidden="true"></span>\
                                </a>\
                            </div>\
                        </header>\
                        <div class="ghost_comment_content">' + ghost.PostCat + '</div>\
                    </div>\
                </div>\
            </div>\
        </div>');
            $('.ghost_comments_bar_').addClass('open');
            $('.ghost_comments_box_container').addClass('open');
        })
    
        // 标签添加
        $('body').on('click', '.add_posttag',
        function() {
            $taghtml = '<div class="poi-btn-group ghost_post_tag_inputs_container">\
                            <input type="text" class="ghost_setting_content_preface_control ghost_post_tag_input" name="tags[]" placeholder="帖子标签" value="">\
                            <a class="poi-btn poi-btn_default ghost_post_tag_input_btn del_tag" disabled="">\
                                <span class="poi-icon fa-trash fas fa-fw" aria-hidden="true"></span>\
                            </a>\
                        </div>';
            $('.ghost_post_tag_inputs').append($taghtml);
        });
    
        $('body').on('click', '.del_tag',
        function() {
            $(this).closest('.ghost_post_tag_inputs_container').remove();
        })
    
        // 链接添加
        $('body').on('click', '.link_add',
        function() {
            $i = $('.ghost_download').children('.ghost_download_link').length;
            $link = '<div class="clearfix ghost_download_link">\
            <div class="col-lg-2 float-left poi-g_lg-2-10">\
                <label class="ghost_download_link_group_inputs">\
                    <span class="ghost_download_link_inputs_icon">\
                        <span class="poi-icon fa-cloud-download-alt fas fa-fw" aria-hidden="true"></span>\
                    </span>\
                    <span class="ghost_download_link_inputs_content">\
                        <input name="post_download_container[' + $i + '][name]" class="ghost_setting_content_preface_control_downloadlink " type="text" placeholder="下载名称" title="下载名称" list="customPostStoragedatalist" placeholder="下载名称"></span>\
                </label>\
            </div>\
            <div class="col-lg-3 float-left poi-g_lg-2-10">\
                <label class="ghost_download_link_group_inputs">\
                    <span class="ghost_download_link_inputs_icon">\
                        <span class="poi-icon fa-link fas fa-fw" aria-hidden="true"></span>\
                    </span>\
                    <span class="ghost_download_link_inputs_content">\
                        <input name="post_download_container[' + $i + '][link]" class="ghost_setting_content_preface_control_downloadlink " type="text" placeholder="下载链接" title="下载链接" list="customPostStoragedatalist" placeholder="下载链接"></span>\
                </label>\
            </div>\
            <div class="col-lg-2 float-left poi-g_lg-1-10">\
                <label class="ghost_download_link_group_inputs">\
                    <span class="ghost_download_link_inputs_icon">\
                        <span class="poi-icon fa-key fas fa-fw" aria-hidden="true"></span>\
                    </span>\
                    <span class="ghost_download_link_inputs_content">\
                        <input name="post_download_container[' + $i + '][pwd]" class="ghost_setting_content_preface_control_downloadlink " type="text" placeholder="提取密码" title="提取密码" list="customPostStoragedatalist" placeholder="提取密码"></span>\
                </label>\
            </div>\
            <div class="col-lg-2 float-left poi-g_lg-1-10">\
                <label class="ghost_download_link_group_inputs">\
                    <span class="ghost_download_link_inputs_icon">\
                        <span class="poi-icon fa-unlock fas fa-fw" aria-hidden="true"></span>\
                    </span>\
                    <span class="ghost_download_link_inputs_content">\
                        <input name="post_download_container[' + $i + '][pwd2]" class="ghost_setting_content_preface_control_downloadlink " type="text" placeholder="解压密码" title="解压密码" list="customPostStoragedatalist" placeholder="解压密码"></span>\
                </label>\
            </div>\
            <div class="col-lg-2 float-left poi-g_lg-1-10">\
                <label class="ghost_download_link_group_inputs">\
                    <span class="ghost_download_link_inputs_icon">\
                        <span class="poi-icon fa-unlock fas fa-fw" aria-hidden="true"></span>\
                    </span>\
                    <span class="ghost_download_link_inputs_content">\
                        <input name="post_download_container[' + $i + '][credit]" class="ghost_setting_content_preface_control_downloadlink " type="text" placeholder="购买积分(0免费)" title="购买积分(0免费)" list="customPostStoragedatalist" placeholder="购买积分(0免费)"></span>\
                </label>\
            </div>\
            <div class="col-lg-1 float-left poi-g_lg-1-10">\
                <div class="poi-btn-group ghost_download_link_storage_btns">\
                    <a class="link_add ghost_download_link_delete_btn">\
                        <span class="poi-icon fa-plus fas fa-fw" aria-hidden="true"></span>\
                    </a>\
                    <a class="link_del ghost_download_link_delete_btn" disabled="">\
                        <span class="poi-icon fa-trash fas fa-fw" aria-hidden="true"></span>\
                    </a>\
                </div>\
            </div>\
        </div>';
            $('.ghost_download').append($link);
        });
    
        $('body').on('click', '.link_del',
        function() {
            $(this).closest('.ghost_download_link').remove();
        })
    
        // 文章分类
        $('body').on('click', '.ghost_post_category_item_link ',
        function() {
            $("input[name^='catId']").val($(this).attr('data-catid'));
            $('.mypost_cat .mypost_cat_text').text($(this).text());
            $('.ghost_comments_bar_').removeClass('open');
            $('.ghost_comments_box_container').removeClass('open');
            setTimeout(function() {
                $('.ghost_comments_bar').remove();
            },
            250);
        })
    
        // 添加文章
        $('body').on('click', '.submit_post',
        function() {
            $.ghostalert_loading(2000, false);
            var tag = [];
            $("input[name^='tag']").each(function() {
                tag.push($(this).val());
            })
            if ($(this).attr('data-type') == 'updatepost') {
                $postmeta = {
                    'title': $('input[name=name]').val(),
                    'meta': tinyMCE.activeEditor.getContent(),
                    'cat': $('input[name=catId]').val(),
                    'tag': tag,
                    'PostImg': $('.set_post_cover').closest('.ghost_my_pic').find('.my_postimg img').attr('src'),
                    'guid': '',
                    'type': $(this).attr('data-type'),
                    'post_id': $(this).attr('data-postid'),
                }
            } else {
                $postmeta = {
                    'title': $('input[name=name]').val(),
                    'meta': tinyMCE.activeEditor.getContent(),
                    'cat': $('input[name=catId]').val(),
                    'tag': tag,
                    'PostImg': $('.set_post_cover').closest('.ghost_my_pic').find('.my_postimg img').attr('src'),
                    'guid': '',
                    'type': $(this).attr('data-type'),
                }
            }
            if ($postmeta['title'] == '') {
                $.ghostalert_error('请输入标题', 2000, false);
                return false;
            }
            if ($postmeta['meta'] == '') {
                $.ghostalert_error('请输入内容', 2000, false);
                return false;
            }
            if ($postmeta['cat'] == '') {
                $.ghostalert_error('请填写分类', 2000, false);
                return false;
            }
            if ($postmeta['tag'] == '') {
                $.ghostalert_error('请输入标签', 2000, false);
                return false;
            }
            if(!$('.set_post_cover').hasClass('ghost_btn_success')){
                $.ghostalert_error('未设置封面', 2000, false);
                return false;
            }
            // 下载
            if ($("input[name^='post_download_container']").val()) {
                var links = new Array();
                for (var i = 0; i < parseInt(($("input[name^='post_download_container']").length) / 5); i++) {
                    links[i] = new Object();
                            links[i] = {
                                name : $("input[name='post_download_container[" + i + "][name]']").val(),
                                link : $("input[name='post_download_container[" + i + "][link]']").val(),
                                pwd : $("input[name='post_download_container[" + i + "][pwd]']").val(),
                                pwd2 : $("input[name='post_download_container[" + i + "][pwd2]']").val(),
                                credit : Math.floor($("input[name='post_download_container[" + i + "][credit]']").val()),
                            }
                    if (links[i]['credit'] > ghost.post_link_max_credit || links[i]['credit'] < 0) {
                        $.ghostalert_error('积分填写错误', 2000, false);
                        return false;
                    }
                }
                var link = links;
            } else {
                var link = '';
            }
            // 音乐
            if ($("input[name^='post_music_container']").val()) {
                var musics = new Array();
                for (var i = 0; i < parseInt(($("input[name^='post_music_container']").length) / 2); i++) {
                    musics[i] = new Object();
                    musics[i]['name'] = $("input[name='post_music_container[" + i + "][name]']").val();
                    musics[i]['link'] = $("input[name='post_music_container[" + i + "][link]']").val();
                }
                var music = JSON.stringify(musics);
            } else {
                var music = '';
            }
            // 视频
            if ($("input[name^='post_video_container']").val()) {
                var videos = new Array();
                for (var i = 0; i < parseInt(($("input[name^='post_video_container']").length) / 2); i++) {
                    videos[i] = new Object();
                    videos[i]['name'] = $("input[name='post_video_container[" + i + "][name]']").val();
                    videos[i]['link'] = $("input[name='post_video_container[" + i + "][link]']").val();
                }
                var video = JSON.stringify(videos);
            } else {
                var video = '';
            }
            $.ajax({
                url: ghost.ajaxurl,
                data: {
                    c: 'User',
                    a: 'SubmitNewPost',
                    postmeta: $postmeta,
                    link: link,
                    video: video,
                    music: music,
                    userid: $('.drafts').attr('data-userid'),
                },
                type: 'POST',
                success: function(msg) {
                    if (msg.code == 1) {
                        $.ghostalert_success(msg.message, 2000, true);
                        window.location.replace(msg.PostUrl);
                    } else {
                        $.ghostalert_error(msg.message, 2000, false);
                    }
                }
            });
        })
    
        $('body').on('click', '.add_post_container',
            function() {
                tinyMCE.activeEditor.selection.setContent($(this).closest('.ghost_my_pic').find('.my_postimg').html());
            })
    
        $('body').on('click', '.set_post_cover',
            function() {
                $('.set_post_cover').removeClass('ghost_btn_success');
                $(this).addClass('ghost_btn_success');
            })
    
        // 常规文章
        $('body').on('click', '.routine_post',
        function() {
            $('.ghost_setting_content_preface_item_content .is_success').removeClass('is_success');
            $(this).addClass('is_success');
            $('.extra_post_content').html('');
        })
    
        // 文章视频
        $('body').on('click', '.video_post',
        function() {
            $('.ghost_setting_content_preface_item_content .is_success').removeClass('is_success');
            $(this).addClass('is_success');
            $('.extra_post_content').html('<fieldset class="ghost_setting_content_item">\
                <legend class="ghost_setting_content_item_title">\
                    <span class="ghost_setting_content_primary">\
                        <span class="poi-icon fa-user-circle fas fa-fw" aria-hidden="true"></span>\
                        <span class="ghost_setting_content_text">添加视频</span></span>\
                </legend>\
                <div class="ghost_setting_content_item_content ghost_video">\
                    <div class="clearfix ghost_video_link">\
                        <div class="col-lg-4 float-left poi-g_lg-2-10">\
                            <label class="ghost_video_link_group_inputs">\
                                <span class="ghost_video_link_inputs_icon">\
                                    <span class="poi-icon fa-cloud-download-alt fas fa-fw" aria-hidden="true"></span>\
                                </span>\
                                <span class="ghost_video_link_inputs_content">\
                                    <input name="post_video_container[0][name]" class="ghost_setting_content_preface_control_videolink " type="text" placeholder="视频名称" title="视频名称" list="customPostStoragedatalist"></span>\
                            </label>\
                        </div>\
                        <div class="col-lg-7 float-left poi-g_lg-2-10">\
                            <label class="ghost_video_link_group_inputs">\
                                <span class="ghost_video_link_inputs_icon">\
                                    <span class="poi-icon fa-link fas fa-fw" aria-hidden="true"></span>\
                                </span>\
                                <span class="ghost_video_link_inputs_content">\
                                    <input name="post_video_container[0][link]" class="ghost_setting_content_preface_control_videolink " type="text" placeholder="视频地址" title="视频地址" list="customPostStoragedatalist"></span>\
                            </label>\
                        </div>\
                        <div class="col-lg-1 float-left poi-g_lg-1-10">\
                            <div class="poi-btn-group ghost_video_link_storage_btns">\
                                <a class="video_add ghost_video_link_delete_btn">\
                                    <span class="poi-icon fa-plus fas fa-fw" aria-hidden="true"></span>\
                                </a>\
                                <a style="background: rgba(241,108,102,.3);color:#fff;cursor: not-allowed;" class="ghost_video_link_delete_btn" disabled="">\
                                    <span class="poi-icon fa-trash fas fa-fw" aria-hidden="true"></span>\
                                </a>\
                            </div>\
                        </div>\
                    </div>\
                </div>\
            </fieldset>');
        })
    
        // 链接添加
        $('body').on('click', '.video_add',
        function() {
            $i = $('.ghost_video').children('.ghost_video_link').length;
            $link = '<div class="clearfix ghost_video_link">\
                        <div class="col-lg-4 float-left poi-g_lg-2-10">\
                            <label class="ghost_video_link_group_inputs">\
                                <span class="ghost_video_link_inputs_icon">\
                                    <span class="poi-icon fa-cloud-download-alt fas fa-fw" aria-hidden="true"></span>\
                                </span>\
                                <span class="ghost_video_link_inputs_content">\
                                    <input name="post_video_container[' + $i + '][name]" class="ghost_setting_content_preface_control_videolink " type="text" placeholder="视频名称" title="视频名称" list="customPostStoragedatalist"></span>\
                            </label>\
                        </div>\
                        <div class="col-lg-7 float-left poi-g_lg-2-10">\
                            <label class="ghost_video_link_group_inputs">\
                                <span class="ghost_video_link_inputs_icon">\
                                    <span class="poi-icon fa-link fas fa-fw" aria-hidden="true"></span>\
                                </span>\
                                <span class="ghost_video_link_inputs_content">\
                                    <input name="post_video_container[' + $i + '][link]" class="ghost_setting_content_preface_control_videolink " type="text" placeholder="视频地址" title="视频地址" list="customPostStoragedatalist"></span>\
                            </label>\
                        </div>\
                        <div class="col-lg-1 float-left poi-g_lg-1-10">\
                            <div class="poi-btn-group ghost_video_link_storage_btns">\
                                <a class="video_add ghost_video_link_delete_btn">\
                                    <span class="poi-icon fa-plus fas fa-fw" aria-hidden="true"></span>\
                                </a>\
                                <a class="ghost_video_link_delete_btn video_del" disabled="">\
                                    <span class="poi-icon fa-trash fas fa-fw" aria-hidden="true"></span>\
                                </a>\
                            </div>\
                        </div>\
                    </div>';
            $('.ghost_video').append($link);
        });
    
        $('body').on('click', '.video_del',
        function() {
            $(this).closest('.ghost_video_link').remove();
        })
    
        // 文章音乐
        $('body').on('click', '.music_post',
        function() {
            $('.ghost_setting_content_preface_item_content .is_success').removeClass('is_success');
            $(this).addClass('is_success');
            $('.extra_post_content').html('<fieldset class="ghost_setting_content_item">\
                <legend class="ghost_setting_content_item_title">\
                    <span class="ghost_setting_content_primary">\
                        <span class="poi-icon fa-user-circle fas fa-fw" aria-hidden="true"></span>\
                        <span class="ghost_setting_content_text">添加音乐</span></span>\
                </legend>\
                <div class="ghost_setting_content_item_content ghost_music">\
                    <div class="clearfix ghost_music_link">\
                        <div class="col-lg-4 float-left poi-g_lg-2-10">\
                            <label class="ghost_music_link_group_inputs">\
                                <span class="ghost_music_link_inputs_icon">\
                                    <span class="poi-icon fa-cloud-download-alt fas fa-fw" aria-hidden="true"></span>\
                                </span>\
                                <span class="ghost_music_link_inputs_content">\
                                    <input name="post_music_container[0][name]" class="ghost_setting_content_preface_control_musiclink " type="text" placeholder="音乐名称" title="音乐名称" list="customPostStoragedatalist"></span>\
                            </label>\
                        </div>\
                        <div class="col-lg-7 float-left poi-g_lg-2-10">\
                            <label class="ghost_music_link_group_inputs">\
                                <span class="ghost_music_link_inputs_icon">\
                                    <span class="poi-icon fa-link fas fa-fw" aria-hidden="true"></span>\
                                </span>\
                                <span class="ghost_music_link_inputs_content">\
                                    <input name="post_music_container[0][link]" class="ghost_setting_content_preface_control_musiclink " type="text" placeholder="音乐地址" title="音乐地址" list="customPostStoragedatalist"></span>\
                            </label>\
                        </div>\
                        <div class="col-lg-1 float-left poi-g_lg-1-10">\
                            <div class="poi-btn-group ghost_music_link_storage_btns">\
                                <a class="music_add ghost_music_link_delete_btn">\
                                    <span class="poi-icon fa-plus fas fa-fw" aria-hidden="true"></span>\
                                </a>\
                                <a style="background: rgba(241,108,102,.3);color:#fff;cursor: not-allowed;" class="ghost_music_link_delete_btn" disabled="">\
                                    <span class="poi-icon fa-trash fas fa-fw" aria-hidden="true"></span>\
                                </a>\
                            </div>\
                        </div>\
                    </div>\
                </div>\
            </fieldset>');
        })
    
        // 链接添加
        $('body').on('click', '.music_add',
        function() {
            $i = $('.ghost_music').children('.ghost_music_link').length;
            $link = '<div class="clearfix ghost_music_link">\
                        <div class="col-lg-4 float-left poi-g_lg-2-10">\
                            <label class="ghost_music_link_group_inputs">\
                                <span class="ghost_music_link_inputs_icon">\
                                    <span class="poi-icon fa-cloud-download-alt fas fa-fw" aria-hidden="true"></span>\
                                </span>\
                                <span class="ghost_music_link_inputs_content">\
                                    <input name="post_music_container[' + $i + '][name]" class="ghost_setting_content_preface_control_musiclink " type="text" placeholder="音乐名称" title="音乐名称" list="customPostStoragedatalist"></span>\
                            </label>\
                        </div>\
                        <div class="col-lg-7 float-left poi-g_lg-2-10">\
                            <label class="ghost_music_link_group_inputs">\
                                <span class="ghost_music_link_inputs_icon">\
                                    <span class="poi-icon fa-link fas fa-fw" aria-hidden="true"></span>\
                                </span>\
                                <span class="ghost_music_link_inputs_content">\
                                    <input name="post_music_container[' + $i + '][link]" class="ghost_setting_content_preface_control_musiclink " type="text" placeholder="音乐地址" title="音乐地址" list="customPostStoragedatalist"></span>\
                            </label>\
                        </div>\
                        <div class="col-lg-1 float-left poi-g_lg-1-10">\
                            <div class="poi-btn-group ghost_music_link_storage_btns">\
                                <a class="music_add ghost_music_link_delete_btn">\
                                    <span class="poi-icon fa-plus fas fa-fw" aria-hidden="true"></span>\
                                </a>\
                                <a class="ghost_music_link_delete_btn music_del" disabled="">\
                                    <span class="poi-icon fa-trash fas fa-fw" aria-hidden="true"></span>\
                                </a>\
                            </div>\
                        </div>\
                    </div>';
            $('.ghost_music').append($link);
        });
    
        $('body').on('click', '.music_del',
        function() {
            $(this).closest('.ghost_music_link').remove();
        })
    
        //   复制
        copyUrl($(".ghost_btn_copy"));
        function copyUrl(dom) {
            dom.click(function() {
                $.ghostalert_loading(1000, false);
                var url = $(this).prev(); //根据实际情况更改,需要复制内容的载体
                url.select();
                document.execCommand("Copy");
                $.ghostalert_success('复制成功', 1000, false);
            })
        }
    
        // 手机端菜单
        $('body').on('click', '.ghost_menu_open',
        function() {
            $('.ghost_mobilemenu_container').addClass('menu_open');
            $('body').append('<div class="mobile_menu_ ghost_dialog"><div class="mobile_menu__ ghost_dialog_ "></div></div>');
            $('.mobile_menu__').addClass('open');
        }) 
        $('body').on('click', '.mobile_menu__',
        function() {
            $('.ghost_mobilemenu_container').removeClass('menu_open');
            $('.mobile_menu__').removeClass('open');
            setTimeout(function() {
                $('.mobile_menu_').remove();
            },
            250);
        }) 
        $('body').on('click', '.ghost_mobile_author_menu',
        function() {
            $('.ghost_mobileusermenu_container').addClass('menu_open');
            $('body').append('<div class="mobile_menu_ ghost_dialog"><div class="mobile_menu__ ghost_dialog_ "></div></div>');
            $('.mobile_menu__').addClass('open');
        }) 
        $('body').on('click', '.mobile_menu__',
        function() {
            $('.ghost_mobileusermenu_container').removeClass('menu_open');
            $('.mobile_menu__').removeClass('open');
            setTimeout(function() {
                $('.mobile_menu_').remove();
            },
            250);
        })
    
        // 关注
        $('.ghost_my_flowers').on('click', '.ghost_author_tools_container .my_flower .flowers,.ghost_author_widget_tools .my_flower .flowers',
        function() {
            $.ghostalert_loading(2000, false);
            $flowerid = $('.ghost_author_header').attr('data-uid');
            $.ajax({
                url: ghost.ajaxurl,
                data: {
                    action: 'ajax_flowers',
                    flowerid: $flowerid,
                },
                type: 'POST',
                success: function(msg) {
                    if (msg.code == 1) {
                        $('.my_flower').html('<div class="del_flowers"><span class="poi-icon fa-check fas fa-fw" aria-hidden="true"></span><span class="ghost_icon_text">已关注</span></div>');
                        $.ghostalert_success(msg.msg, 2000, false);
                    } else {
                        $.ghostalert_error(msg.msg, 2000, false);
                    }
                }
            });
        })
    
        // 取消关注
        $('.ghost_my_flowers').on('click', '.ghost_author_tools_container .del_flowers,.ghost_author_widget_tools .del_flowers',
        function() {
            $.ghostalert_loading(2000, false);
            $flowerid = $('.ghost_author_header').attr('data-uid');
            $.ajax({
                url: ghost.ajaxurl,
                data: {
                    action: 'ajax_del_flowers',
                    flowerid: $flowerid,
                },
                type: 'POST',
                success: function(msg) {
                    if (msg.code == 1) {
                        $('.my_flower').html('<div class="flowers"><span class="poi-icon fa-plus fas fa-fw" aria-hidden="true"></span><span class="ghost_icon_text">加关注</span></div>');
                        $.ghostalert_success(msg.msg, 2000, false);
                    } else {
                        $.ghostalert_error(msg.msg, 2000, false);
                    }
                }
            });
        })
    
        // 私信
        $('.ghost_author_header').on('click', '.ghost_author_btn.send_msg',
        function() {
            $.ghostalert_loading(2000, false);
            $targetid = $('.ghost_author_header').attr('data-uid');
            $.ajax({
                url: ghost.ajaxurl,
                data: {
                    action: 'ajax_send_msg',
                    targetid: $targetid,
                },
                type: 'POST',
                success: function(msg) {
                    if (msg.code == 1) {
                         window.open(ghost.siteurl+'/me/msg',"_blank");
                                  $.ghostalert_success(msg.msg, 2000, false);
                    } else {
                        $.ghostalert_error(msg.msg, 2000, false);
                    }
                }
            });
        })
    
        // 用戶私信切換
        $('.main').on('click', '.change_user_content',
        function() {
            $this = $(this);
            $userid = $this.attr('data-id');
            $.ajax({
                url: ghost.ajaxurl,
                data: {
                    action: 'ajax_change_user_content',
                    userid: $userid,
                },
                type: 'POST',
                success: function(msg) {
                    if (msg.code == 1) {
                        $('.ghost_msg_nav_item').removeClass('is-active');
                        $this.parent('.ghost_msg_nav_item').addClass('is-active');
                        $('.ghost_msg_list_container').html(msg.user_msg);
                    } else {
                        $('.ghost_msg_list_container').html(msg.user_msg);
                    }
                }
            });
        })
    
        // 签到
        $('.ghost-nav-tool__container').on('click', '.ghost_sign_daily',
        function() {
            $.ajax({
                url: ghost.ajaxurl,
                data: {
                    c: 'User',
                    a: 'SignDaily',
                    userid: ghost.userid,
                },
                type: 'POST',
                success: function(msg) {
                    if (msg.code == 1) {
                        $('body').append('<div class="ghost_sign_bar ghost_dialog">\
                                              <div class="ghost_sign_bar_ ghost_dialog_ open"></div>\
                                              <div class="ghost_sign_box ghost_dialog_box">\
                                                  <div class="ghost_sign_container open">\
                                                      <div class="ghost_sign_content">\
                                                         <p style="color: #2ba02e;">' + msg.msg + '</p>\
                                                         <p>今日签到第一名:' + msg.name + '</p>\
                                                         <p>签到时间:' + msg.time + '</p>\
                                                         <p><a href="' + ghost.ghost_sign_url + '" class="ghost_btn ghost_btn_success" rel="noreferrer">\
                                        <span class="poi-icon fa-chart-bar fas fa-fw" aria-hidden="true"></span>\
                                                            <span class="ghost_icon_text">积分排行榜</span></a></p></div>\
                                                      <footer class="ghost_sign_footer">\
                                                          <a class="ghost_sign_footer_btn ghost_sign_header_close" title="">\
                                                              <span class="poi-icon fa-times fas fa-fw" aria-hidden="true"></span>\
                                                          </a>\
                                                      </footer>\
                                                  </div>\
                                              </div>\
                                            </div>');
                    } else {
                        $('body').append('<div class="ghost_sign_bar ghost_dialog">\
                                              <div class="ghost_sign_bar_ ghost_dialog_ open"></div>\
                                              <div class="ghost_sign_box ghost_dialog_box">\
                                                  <div class="ghost_sign_container open">\
                                                      <div class="ghost_sign_content">\
                                                         <p style="color: red;">' + msg.msg + '</p>\
                                                         <p>今日签到第一名:' + msg.name + '</p>\
                                                         <p>签到时间:' + msg.time + '</p>\
                                                         <p><a href="' + ghost.ghost_sign_url + '" class="ghost_btn ghost_btn_success" rel="noreferrer">\
                                        <span class="poi-icon fa-chart-bar fas fa-fw" aria-hidden="true"></span>\
                                        <span class="ghost_icon_text">积分排行榜</span></a></p></div>\
                                                      <footer class="ghost_sign_footer">\
                                                          <a class="ghost_sign_footer_btn ghost_sign_header_close" title="">\
                                                              <span class="poi-icon fa-times fas fa-fw" aria-hidden="true"></span>\
                                                          </a>\
                                                      </footer>\
                                                  </div>\
                                              </div>\
                                            </div>');
                    }
                }
            });
        })
    
        $('html').on('click', '.ghost_sign_header_close',
        function() {
            $('.ghost_sign_bar_').removeClass('open');
            $('.ghost_sign_container').removeClass('open');
            setTimeout(function() {
                $('.ghost_sign_bar').remove();
            },
            250); 
        })
        // 返回顶部
        $(window).scroll(function() {
            var $scrollTop = document.documentElement.scrollTop || window.pageYOffset || document.body.scrollTop; //兼容浏览器
            if ($scrollTop > 100) { //滚动高度可调
                $(".ghost_bottom_tools").show();
            } else {
                $(".ghost_bottom_tools").hide();
            };
        }) 
        $('.ghost_bottom_tools_top_link').click(function() {
            $('html ,body').animate({
                scrollTop: 0
            },
            1500, 'easeOutQuad');
            return false;
        });
    
        // 分类ajax
        $('.cat').on('click', '.ajax-morepost',function() {
            $('.ajax-morepost').html("正在加载");
            $page = $('.ajax-morepost').attr('data-paged');
            $cat = $('.ajax-morepost').attr('data-cat');
            $paixu = $('.paixu .is-active').attr('data-paixu');
            $('.ajax-morepost').attr('data-paged', ++$page);
            $.ajax({
                url: ghost.ghost_ajax,
                type: 'POST',
                data: {
                    url: 'CatMorePost.php',
                    page: $page,
                    cat: $cat,
                    paixu: $paixu
                },
                success: function(msg) {
                    if (msg.code == 0) {
                        $('.ajax-morepost').html("加载完毕");
                    } else {
                        $('#ghost_box_1').append(msg);
                        $('.page-' + $page + ' img.lazy').lazyload({
                            effect: "fadeIn",
                        });
                        $('.ajax-morepost').html("更多文章");
                    }
                }
            });
        });
    
        // 用户ajax
        $('.user_credit').on('click', '.ajax-morepost',
        function() {
            $('.ajax-morepost').html("正在加载");
            $page = $('.ajax-morepost').attr('data-paged');
                $paixu = $('.ghost_sign_nav .active').attr('data-type');
            $('.ajax-morepost').attr('data-paged', ++$page);
            $.ajax({
                url: ghost.ghost_ajax + "/action/sign_type_ajax.php",
                type: 'POST',
                data: {
                    page: $page,
                    paixu: $paixu
                },
                success: function(msg) {
                    if (msg.code == 0) {
                        $('.ajax-morepost').html("加载完毕");
                    } else {
                        $('.ajax_moreuser').append(msg);
                        $('.page-' + ($page + 1) + ' img.lazy').lazyload({
                            effect: "fadeIn",
                        });
                        $('.ajax-morepost').html("更多文章");
                    }
                }
            });
        });
    
        //草稿ajax
        $('.drafts').on('click', '.ajax-morepost',
        function(){
            $page = $('.ajax-morepost').attr('data-paged');
            $userid = $('.drafts').attr('data-userid');
            $('.ajax-morepost').attr('data-paged',++$page);
            $.ajax({
                url: ghost.ghost_ajax,
                type: 'POST',
                data: {
                    url: 'UserMoreDraftsPost.php',
                    page: $page,
                    userid: $userid
                },
                success: function(msg) {
                    if (msg.code == 0) {
                        $('.ajax-morepost').html("加载完毕");
                    } else {
                        $('.ghost_drafts_posts_table tbody').append(msg);
                        $('.page-' + $page + ' img.lazy').lazyload({
                            effect: "fadeIn",
                        });
                        $('.ajax-morepost').html("更多文章");
                    }
                }
            });
        });
    
         // notice ajax
        $('.notice').on('click', '.ajax-morepost',
        function() {
            $('.ajax-morepost').html("正在加载");
            $page = $('.ajax-morepost').attr('data-paged');
            $userid = $('.notice').attr('data-userid');
            $('.ajax-morepost').attr('data-paged', ++$page);
            $.ajax({
                url: ghost.ghost_ajax,
                type: 'POST',
                data: {
                    url: 'UserMoreNotice.php',
                    page: $page,
                    userid: $userid
                },
                success: function(msg) {
                    if (msg.code == 0) {
                        $('.ajax-morepost').html("加载完毕");
                    } else {
                        $('.notice_msg').append(msg);
                        $('.page-' + ($page + 1) + ' img.lazy').lazyload({
                            effect: "fadeIn",
                        });
                        $('.ajax-morepost').html("更多文章");
                    }
                }
            });
        });
    
        // zone ajax
        $('.main').on('click', '.zone-morepost',
        function() {
            $('.zone-morepost').html("正在加载");
            $page = $('.zone-morepost').attr('data-paged');
            $type = $('.my_zone .picked').attr('data-type');
            $('.zone-morepost').attr('data-paged', ++$page);
            $.ajax({
                url: ghost.ghost_ajax + "/action/zone_morepost.php",
                type: 'POST',
                data: {
                    page: $page,
                    type: $type
                },
                success: function(msg) {
                    if (msg.code == 0) {
                        $('.zone-morepost').html("加载完毕");
                    } else {
                        $('.zone_list_box').append(msg);
                        $('.page-' + ($page + 1) + ' img.lazy').lazyload({
                            effect: "fadeIn",
                        });
                        $('.zone-morepost').html("更多文章");
                    }
                }
            });
        });
    
        // zone type
        $(".my_zone .zone_type").click(function() {
            $('.my_zone .picked').removeClass('picked');
            $(this).addClass('picked');
            $type = $(this).attr('data-type');
            $.ajax({
                url: ghost.ghost_ajax + "/action/zone_posttype.php",
                type: 'POST',
                data: {
                    type: $type
                },
                success: function(msg) {
                    if (msg.code == 0) {
                        $('.zone_list_box').html('暂无');
                    } else {
                        $('.zone_list_box').html(msg);
                        $('.page-1 img.lazy').lazyload({
                            effect: "fadeIn",
                        });
                    }
                }
            });
        });
    
        // 首页排序
        $(".container .home_title_menu_item").click(function() {
            $this = $(this);
            $this.closest('.ghost_nav').find('.home_title_menu_item.active').removeClass('active');
            $this.addClass('active');
            $paixu = $this.attr('data-type');
            $cat = $this.closest('.cat-container').attr('data-cat');
            if ($this.closest('.style-1').length) {
                $.ajax({
                    url: ghost.ghost_ajax,
                    type: 'POST',
                    data: {
                        url: 'BoxAjax-1.php',
                        paixu: $paixu,
                        cat: $cat
                    },
                    success: function(msg) {
                        if (msg.code == 0) {
                            $this.closest('.ghost_nav ').find('#ghost_box_1').html("错误");
                        } else {
                            $this.closest('.ghost_nav ').find('#ghost_box_1').html(msg);
                            $this.closest('.ghost_nav ').find('#ghost_box_1 img.lazy').lazyload({
                                effect: "fadeIn",
                            });
                        }
                    }
                });
            } else if ($this.closest('.style-2').length) {
                $.ajax({
                    url: ghost.ghost_ajax,
                    type: 'POST',
                    data: {
                        url: 'BoxAjax-2.php',
                        paixu: $paixu,
                        cat: $cat
                    },
                    success: function(msg) {
                        if (msg.code == 0) {
                            $this.closest('.ghost_nav ').find('#ghost_box_2').html("错误");
                        } else {
                            $this.closest('.ghost_nav ').find('#ghost_box_2').html(msg);
                            $this.closest('.ghost_nav ').find('#ghost_box_2 img.lazy').lazyload({
                                effect: "fadeIn",
                            });
                        }
                    }
                });
            } else if ($this.closest('.style-3').length) {
                $.ajax({
                    url: ghost.ghost_ajax,
                    type: 'POST',
                    data: {
                        url: 'BoxAjax-3.php',
                        paixu: $paixu,
                        cat: $cat
                    },
                    success: function(msg) {
                        if (msg.code == 0) {
                            $this.closest('.ghost_nav ').find('#ghost_box_3').html("错误");
                        } else {
                            $this.closest('.ghost_nav ').find('#ghost_box_3').html(msg);
                            $this.closest('.ghost_nav ').find('#ghost_box_3 img.lazy').lazyload({
                                effect: "fadeIn",
                            });
                        }
                    }
                });
            }
        });
    
        // 文章排行榜更多文章
        $('.post_rank').on('click', '.ajax-morepost',
        function() {
            $('.ajax-morepost').html("正在加载");
            $('.ghost_sign_nav active').removeClass('active');
            $(this).addClass('active');
            $paixu = $('.ghost_sign_nav .active').attr('data-type');
            $page = $('.ajax-morepost').attr('data-paged');
            $('.ajax-morepost').attr('data-paged', ++$page);
            $.ajax({
                url: ghost.ghost_ajax + "/action/post_rank_ajax.php",
                type: 'POST',
                data: {
                    paixu: $paixu,
                    page: $page
                },
                success: function(msg) {
                    if (msg.code == 0) {
                        $('.ajax-morepost').html("加载完毕");
                    } else {
                        $('.postrank').append(msg);
                        $('.page-' + ($page) + ' img.lazy').lazyload({
                            effect: "fadeIn",
                        });
                        $('.ajax-morepost').html("更多文章");
                    }
                }
            });
        });
    
        // 文章排行榜排序
        $(".post_rank .ghost_sign_nav_item").click(function() {
            $this = $(this);
            $('.ghost_sign_nav .active').removeClass('active');
            $this.addClass('active');
            $paixu = $this.attr('data-type');
            $.ajax({
                url: ghost.ghost_ajax + "/action/post_rank_type.php",
                type: 'POST',
                data: {
                    paixu: $paixu
                },
                success: function(msg) {
                    if (msg.code == 0) {
                        $('.ajax_morepost').html("加载完毕");
                    } else {
                        $('.ajax_morepost').html(msg);
                        $('.ajax_morepost img.lazy').lazyload({
                            effect: "fadeIn",
                        });
                    }
                }
            });
        });
    
        // 用户排行榜排序
        $(".user_credit .ghost_sign_nav_item").click(function() {
            $this = $(this);
            $('.ghost_sign_nav .active').removeClass('active');
            $this.addClass('active');
            $paixu = $this.attr('data-type');
            $.ajax({
                url: ghost.ghost_ajax + "/action/sign_type.php",
                type: 'POST',
                data: {
                    paixu: $paixu
                },
                success: function(msg) {
                    if (msg.code == 0) {
                        $('.ajax_moreuser').html("加载完毕");
                    } else {
                        $('.ajax_moreuser').html(msg);
                    }
                }
            });
        });
    
        //   搜索加载更多
        $(".search .ajax-morepost").click(function() {
            $('.ajax-morepost').html("正在加载");
            $page = $('.ajax-morepost').attr('data-paged');
            $search = $('.ajax-morepost').attr('data-search');
            $('.ajax-morepost').attr('data-paged', ++$page);
            $.ajax({
                url: ghost.ghost_ajax + "/action/search_box.php",
                type: 'POST',
                data: {
                    page: $page,
                    search: $search
                },
                success: function(msg) {
                    if (msg.code == 0) {
                        $('.ajax-morepost').html("加载完毕");
                    } else {
                        $('#ghost_box_1').append(msg);
                        $('.page-' + ($page + 1) + ' img.lazy').lazyload({
                            effect: "fadeIn",
                        });
                        $('.ajax-morepost').html("更多文章");
                    }
                }
            });
        });
    
        // 答题页面
        $('body').on('click', '#test_jiaojuan',
        function() {
            var $all_daan = [];
            $j = 0
            for (var i = 0; i < ghost.dati_length; i++) {
                $all_daan[i]  = {
                    'num': $('#qu_' + i).find('.test_content_nr_main').data('num'),
                    'daan': $('#qu_' + i).find('input:radio:checked').val(),
                };
                if ($all_daan[i]['daan']) {
                    $j++;
                };
            }
            if ($j <= ghost.dati_length - 1) {
                $.ghostalert_warning('请选择完所有选项', 2000, false);
            } else {
                $.ajax({
                            url: ghost.ajaxurl,
                    type: 'POST',
                    data: {
                                action: 'dati_result',
                                all_daan: $all_daan
                    },
                    success: function(msg) {
                        if (msg.code == 1) {
                            $('.user_test').html(msg.msg);
                        } else {
                            $('.user_test').html(msg.msg);
                        }
                    }
                });
            }
        })
    
        //作者页面
        $('.author').on('click', '.ajax-morepost',
        function() {
            $('.ajax-morepost').html("正在加载");
            $user_id = $('.ghost_author_header').attr('data-uid');
            $page = $('.ajax-morepost').attr('data-paged');
            $('.ajax-morepost').attr('data-paged', ++$page);
            $.ajax({
                url: ghost.ghost_ajax + "/action/author/author-moreposts.php",
                type: 'POST',
                data: {
                    page: $page,
                    user_id: $user_id
                },
                success: function(msg) {
                    if (msg.code == 0) {
                        $('.ajax-morepost').html("加载完毕");
                    } else {
                        $('#ghost_box_1').append(msg);
                        $('.page-' + ($page + 1) + ' img.lazy').lazyload({
                            effect: "fadeIn",
                        });
                        $('.ajax-morepost').html("更多文章");
                    }
                }
            });
        });
    
        // 私信关闭
        $('body').on('click', '.ghost_msg_nav_item_close',
        function() {
            $.ghostalert_loading(2000, false);
            $this = $(this);
            $is_active = $this.parent('.ghost_msg_nav_item').hasClass('.is-active');
            $send_id = $this.attr('data-id');
            $.ajax({
                url: ghost.ajaxurl,
                data: {
                    c: 'User',
                    a: 'CloseMsgList',
                    send_id: $send_id,
                    is_active: $is_active,
                    userid: $('.drafts').attr('data-userid'),
                },
                type: 'POST',
                success: function(msg) {
                    if (msg.code == 1) {
                        $('.ghost_msg_list').remove();
                        $this.parent('.ghost_msg_nav_item').remove();
                    } else {
                        $.ghostalert_error(msg.user_msg, 2000, false);
                    }
                }
            });
        })
    
        // 发送私信
        $('body').on('click', '.input_msg',
        function() {
            $this = $(this);
            $send_id = $('.user_msg').find('.is-active .ghost_msg_nav_item_close').attr('data-id');
            $content = $('.msg_content').val();
            $.ajax({
                url: ghost.ajaxurl,
                data: {
                    c: 'User',
                    a: 'SubmitMsg',
                    send_id: $send_id,
                    content: $content,
                    userid: $('.drafts').attr('data-userid'),
                },
                type: 'POST',
                success: function(msg) {
                    if (msg.code == 1) {
                        $('.ghost_msg_list_container').append(msg.user_msg);
                        $('.msg_content').val("");
                                    var scrollHeight = $('.ghost_msg_list_container').prop("scrollHeight");
                                  $('.ghost_msg_list_container').animate({scrollTop:scrollHeight}, 400);
                    } else if (msg.code == 0) {
                                    $.ghostalert_loading(2000, false);
                        $.ghostalert_error(msg.user_msg, 2000, false);
                    }else if (msg.code == 2) {
                                    $.ghostalert_loading(2000, false);
                        $.ghostalert_error(msg.user_msg, 2000, false);
                    }else if (msg.code == 3) {
                                    $('.msg_content').focus();
                    }
                }
            });
        })
    
         // 商城开始
        $('body').on('click', '.ghost_shop_footer_btn_success[type=submit_shops_]',
        function() {
            $.ghostalert_loading(2000, false);
            $this = $(this);
            $img = $('.ghost_shops_item').find('.active').find('.ghost_shop_item_img').attr('src');
            $month = $('.monthtype').find('.active').attr('data-num');
            $shop_guajian_ = $this.attr('data-shop');
            $.ajax({
                url: ghost.ajaxurl,
                data: {
                    action: 'ajax_guajian_shop',
                    img: $img,
                    month: $month,
                    shop_guajian_: $shop_guajian_,
                },
                type: 'POST',
                success: function(msg) {
                    if (msg.code == 1) {
                        $.ghostalert_success(msg.msg, 2000, false);
                    } else if (msg.code == 0) {
                        $.ghostalert_error(msg.msg, 2000, false);
                    }
                }
            });
        })
    
         // 商城切换
        $('body').on('click', '.ghost_shop_item_link_cut',
        function() {
            $.ghostalert_loading(2000, false);
            $this = $(this);
            $('.ghost_shops_item').find('.active').removeClass('active');
            $(this).addClass('active');
            $img = $('.ghost_shops_item').find('.active').find('.ghost_shop_item_img').attr('src');
            $.ajax({
                url: ghost.ajaxurl,
                data: {
                    action: 'ajax_guajian_shop_change',
                    img: $img,
                },
                type: 'POST',
                success: function(msg) {
                    if (msg.code == 1) {
                        $.ghostalert_success(msg.msg, 2000, false);
                    } else if (msg.code == 0) {
                        $.ghostalert_error(msg.msg, 2000, false);
                    }
                }
            });
        })
    
        // 商城购买弹窗
        $('.setting').on('click', '.ghost_shop_item_link_submit_vip',
        function() {
            window.open(ghost.siteurl + '/me/answer/');
        })
        $('.setting').on('click', '.ghost_shop_item_link_submit_svip',
        function() {
            window.open(ghost.siteurl + '/me/answer/');
        })
        $('.setting').on('click', '.ghost_shop_item_link_submit',
        function() {
            $('body').append('<div class="ghost_shops_bar ghost_dialog">\
            <div class="ghost_shops_bar_ ghost_dialog_ "></div>\
            <div class="ghost_shops_box ghost_dialog_box">\
                <div class="ghost_shops_box_container">\
                    <div class="ghost_shop_fm">\
                        <header class="ghost_shop_header">\
                            <div class="ghost_shop_header_title">\
                                <span>\
                                    <span class="poi-icon fa-reports fas fa-fw" aria-hidden="true"></span>\
                                                    <span class="ghost_shop_text">挂件购买时长</span></span>\
                                <a class="ghost_shop_header_close">\
                                    <span class="poi-icon fa-times fas fa-fw" aria-hidden="true"></span>\
                                </a>\
                            </div>\
                        </header>\
                        <div class="ghost_shop_content">\
                            <div class="ghost_shop_item_container">\
                                <div class="clearfix monthtype">\
                                                <div class="col-md-3 float-left"><a data-num="1" class="ghost_shop_item">一个月</a></div>\
                                                <div class="col-md-3 float-left"><a data-num="3" class="ghost_shop_item">三个月</a></div>\
                                                <div class="col-md-3 float-left"><a data-num="6" class="ghost_shop_item">六个月</a></div>\
                                                <div class="col-md-3 float-left"><a data-num="12" class="ghost_shop_item">一年</a></div>\
                                </div>\
                                <div class="clearfix credit">\
                                                <div class="col-md-3 float-left"><a data-type="credit" class="ghost_shop_credit_item">积分</a></div>\
                                                <div class="col-md-3 float-left"><a data-num="cash" class="ghost_shop_credit_item">现金</a></div>\
                                </div>\
                                <div class="ghost_shop_item_container_credit">所需要<span class="ghost_shop_item_container_credit_type">积分</span>：<span class="ghost_shop_item_container_credit_span"></span></div>\
                            </div>\
                        </div>\
                        <footer class="ghost_shop_footer">\
                            <button data-shop="' + ghost.shop_guajian_ + '" class="ghost_shop_footer_btn ghost_shop_footer_btn_success" title="" type="submit_shops_">\
                                <span class="poi-icon fa-check fas fa-fw" aria-hidden="true"></span>\
                                                <span class="ghost_icon_text">确定购买</span></button>\
                        </footer>\
                    </div>\
                </div>\
            </div>\
        </div>');
            $('.ghost_shops_bar_').addClass('open');
            $('.ghost_shops_box_container').addClass('open');
            $('.ghost_shops_item').find('.active').removeClass('active');
            $(this).addClass('active');
        });
        $('html').on('click', '.ghost_shop_header_close,.ghost_shops_bar_',
        function() {
            $('.ghost_shops_bar_').removeClass('open');
            $('.ghost_shops_box_container').removeClass('open');
            setTimeout(function() {
                $('.ghost_shops_bar').remove();
            },
            250);
        })
    
        $('body').on('click', '.ghost_shops_bar .ghost_shop_item',
        function() {
            $(this).closest('.ghost_shop_item_container').find('.monthtype').find('.active').removeClass('active');
            $(this).addClass('active');
            $('.ghost_shop_item_container_credit_span').text($(this).attr('data-num') * ghost.shop_guajian_credit);
            if ($(this).attr('data-type') == 'other') {
                $('.ghost_shop_shoper_content').show();
            } else {
                $('.ghost_shop_shoper_content').hide();
            }
        }) 
        $('body').on('click', '.ghost_shops_bar .ghost_shop_credit_item',
        function() {
            $(this).closest('.ghost_shop_item_container').find('.credit').find('.active').removeClass('active');
            $(this).addClass('active');
            $('.ghost_shop_item_container_credit_type').text($(this).text());
            if ($(this).attr('data-type') == 'other') {
                $('.ghost_shop_shoper_content').show();
            } else {
                $('.ghost_shop_shoper_content').hide();
            }
        })
    
        $('body').on('click', '.ghost_guajian_shop_title_menu .ghost_guajian_shop_title_menu_item',
        function() {
            $('.ghost_guajian_shop_title_menu').find('.active').removeClass('active');
            $(this).addClass('active');
            $type = $(this).attr('data-type');
            $.ajax({
                url: ghost.ghost_ajax + "/action/me/me-" + $type + ".php",
                type: 'POST',
                data: {
                    type: $type
                },
                success: function(msg) {
                    if (msg.code == 0) {
                        $('.ghost_shop_guajian_body').html("没有内容");
                    } else {
                        $('.ghost_shop_guajian_body').html(msg);
                    }
                }
            });
        })
        // 商城结束
        $(".video_post_right li").eq(0).addClass('picked');
        $('.switch_set').click(function() {
            $('.picked').removeClass('picked');
            $(this).addClass('picked');
            if (ghost.user_limit) {
                $('.ghost_play').attr('src','https://pinkacg.com/player/?url='+$(this).attr('data-url'));
            }
        })
    
        // APlayer
        $.APlayer_ = function(music_url, cover_url, name_url) {
            const ap = new APlayer({
                container: document.getElementById('post_music'),
                mini: false,
                autoplay: false,
                theme: '#ff6699',
                loop: 'all',
                order: 'random',
                preload: 'auto',
                volume: 0.7,
                mutex: true,
                listFolded: false,
                listMaxHeight: 90,
                lrcType: 3,
                audio: [{
                    name: name_url,
                    artist: 'artist1',
                    url: music_url,
                    cover: cover_url,
                    lrc: 'lrc1.lrc',
                    theme: '#ebd0c2'
                },
                // {
                //     name: 'name2',
                //     artist: 'artist2',
                //     url: 'url2.mp3',
                //     cover: 'cover2.jpg',
                //     lrc: 'lrc2.lrc',
                //     theme: '#46718b'
                // }
                ]
            });
        }
    
         // 删除文章
        $("article .delete_my_post").click(function() {
            $.ghostalert_loading(2000, false);
              $post_id = $('.article').attr('data-id');
            $.ajax({
                url: ghost.ajaxurl,
                data: {
                    action: 'ajax_delete_post',
                    post_id: $post_id,
                },
                type: 'POST',
                success: function(msg) {
                    if (msg.code == 0) {
                        $.ghostalert_success(msg.msg, 2000, false);
                            } else {
                        $.ghostalert_error(msg.msg, 2000, false);
                            }
                }
            });
        });
    
        $('.ghost_single_comment_count').click(function() {
            $('html,body').animate({
                scrollTop: $(".ghost_comment").offset().top - 100
            },
            1500, 'easeOutQuad')
        });
    
        // 灯箱
        $(".single_post_body img").each(function(i) {
            if (!this.parentNode.href) {
               $(this).wrap("<a href='" + this.src + "' data-fancybox='fancybox' data-caption='" + this.alt + "'></a>")
            }
         })
     
         // 头像上传
         $(".main").on('change','#my_avatar',function(e){
             $.ghostalert_loading(2000,false);
             $file = e.currentTarget.files[0];
     
             //结合formData实现图片预览
             var sendData=new FormData();
             sendData.append('c','User');
             sendData.append('a','UpdateAvatar');
             sendData.append('file', $file);
             sendData.append('userid',$('.ghost_setting_content_container').attr('data-userid'));
             $.ajax({
               url: ghost.ajaxurl,
               type: 'POST',
               cache: false,
               data: sendData,
               processData: false,
               contentType: false
             }).done(function(res) {
               if (res.code == 1) {
                 $.ghostalert_success(res.message,3000,true);
               }else{
                 $.ghostalert_warning(res.message,3000,true);
               }
             }).fail(function(res) {
                 $.ghostalert_error(res.message,3000,true);
             });
         
         });
     
     
         // 文章图片上传
         $(".main").on('change','#imgs_upload',function(e){
             $file = e.currentTarget.files;
             for($i=0;$i<$file.length;$i++){
                 //结合formData实现图片预览
                 var sendData=new FormData();
                 sendData.append('c','User');
                 sendData.append('a','UploadPostImg');
                 sendData.append('file',$file[$i]);
                 sendData.append('userid',$('.ghost_setting_content_container').attr('data-userid'));
                 $.ajax({
                     url: ghost.ajaxurl,
                     type: 'POST',
                     cache: false,
                     data: sendData,
                     processData: false,
                     contentType: false
                 }).done(function(res) {
                     if (res.code == 1) {
                         $pic = '<div class="ghost_my_pic"><div class="my_postimg"><img src="'+res.pic+'"></div><div class="pictype"><span class="add_post_container ghost_btn ghost_btn_success">插入文章</span><span class="set_post_cover ghost_btn">设为封面</span></div></div>'
                         $('.ghost_mypic').append($pic);
                     }else{
                         alert(res.message);
                     }
                 }).fail(function(res) {
                         alert(res.message);
                 });
             }
     
             $(this).empty();
         });

        // 回车发送私信
        $('.msg_input').keydown(function(event){
            if(event.keyCode==13){
                $.ghostalert_loading(2000, false);
                $this = $(this);
                $send_id = $this.val();
                $.ajax({
                    url: ghost.ajaxurl,
                    data: {
                        c: 'User',
                        a: 'AddMsgList',
                        send_id: $send_id,
                        userid: $('.drafts').attr('data-userid'),
                    },
                    type:'POST',
                    success:function(msg){
                        if(msg.code==1){
                            $('.ghost_msg_nav_item').removeClass('is-active');
                            $('.user_msg').append(msg.user_msg);
                            $('.ghost_msg_list_container').html(msg.user_conversation);
                            $('.user_'+$send_id).parent('.ghost_msg_nav_item').addClass('is-active');
                            $('.msg_input').val('');
                        }else if(msg.code==0){
                            $.ghostalert_error(msg.message,2000,false);
                        }
                    }
                });
            }
        });
    });

})