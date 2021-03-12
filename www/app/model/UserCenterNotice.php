<?php

namespace model;

use core\Model;
use http\Client\Curl\User;
use model\PostMeta;
use model\UserMeta;

class UserCenterNotice extends Model{
    //根据用户获取所有通知
    public static function GetAllNoticeByUserId($UserId, $offset, $num){
        $sql = "select * from pink_notice where user_id = '{$UserId}' limit {$offset},{$num}";
        return self::SqlQuery($sql, 1);
    }

    //获取用户未读通知
    public static function GetUnreadNotice($UserId){
        $sql = "select count(*) as num from pink_notice where user_id = '{$UserId}' and status = 0";
        return self::SqlQuery($sql, 1);
    }

    //将未读通知标为已读
    public static function readNotice($UserId){
        $sql = "update pink_notice set status = 1 where user_id = '{$UserId}';";
        return self::SqlUpdate($sql, 1);
    }

    //获取通知的类型
    public static function GetNoticeType($PostMeta){
        switch($PostMeta['msg_type']){
            case 'N_SignDaily':
                //每日签到通知
                return '<div class="ghost_notice_container">
                    <div class="ghost_notice_container_item">
                        <div style="color: #4dd652;" class="ghost_notice_container_item_num">+'.$PostMeta['msg_credit'].'</div></div>
                    <div class="ghost_notice_container_item_icon">
                        <span class="poi-icon fa-map-marker fas fa-fw" aria-hidden="true"></span>
                    </div>
                    <div class="ghost_notice_container_item_content">签到成功！获得 '.$PostMeta['msg_credit'].' 金币。</div>
                    <time datetime="'.$PostMeta['msg_time'].'" title="'.$PostMeta['msg_time'].'" class="ghost_notice_container_item_date">'.UserMeta::TimeTran($PostMeta['msg_time']).'</time>
                </div>';
                break;
            case 'N_PostComment':
                //评论文章通知
                return '<div class="ghost_notice_container">
                    <div class="ghost_notice_container_item">
                        <div style="color: #4dd652;" class="ghost_notice_container_item_num">+'.$PostMeta['msg_credit'].'</div></div>
                    <div class="ghost_notice_container_item_icon">
                        <span class="poi-icon fa-map-marker fas fa-fw" aria-hidden="true"></span>
                    </div>
                    <div class="ghost_notice_container_item_content">您评论了文章<a target="_blank" class="notice_post_link" href="'.PostMeta::GetPostUrl($PostMeta['post_id']).'">'.PostMeta::GetPostMeta($PostMeta['post_id'])['post_title'].'</a>！获得 '.$PostMeta['msg_credit'].' 金币。</div>
                    <time datetime="'.$PostMeta['msg_time'].'" title="'.$PostMeta['msg_time'].'" class="ghost_notice_container_item_date">'.UserMeta::TimeTran($PostMeta['msg_time']).'</time>
                </div>';
                break;
            case 'N_Avatar':
                //修改头像通知
                return '<div class="ghost_notice_container">
                    <div class="ghost_notice_container_item">
                        <div style="color: #f44336;" class="ghost_notice_container_item_num">'.$PostMeta['msg_credit'].'</div></div>
                    <div class="ghost_notice_container_item_icon">
                        <span class="poi-icon fa-map-marker fas fa-fw" aria-hidden="true"></span>
                    </div>
                    <div class="ghost_notice_container_item_content">您修改了您的头像！扣除 '.$PostMeta['msg_credit'].' 金币。</div>
                    <time datetime="'.$PostMeta['msg_time'].'" title="'.$PostMeta['msg_time'].'" class="ghost_notice_container_item_date">'.UserMeta::TimeTran($PostMeta['msg_time']).'</time>
                </div>';
                break;
            case 'N_AlterEmail':
                //修改邮箱通知
                return '<div class="ghost_notice_container">
                    <div class="ghost_notice_container_item">
                        <div style="color: #f44336;" class="ghost_notice_container_item_num">'.$PostMeta['msg_credit'].'</div></div>
                    <div class="ghost_notice_container_item_icon">
                        <span class="poi-icon fa-map-marker fas fa-fw" aria-hidden="true"></span>
                    </div>
                    <div class="ghost_notice_container_item_content">您修改了您的邮箱！扣除 '.$PostMeta['msg_credit'].' 金币。</div>
                    <time datetime="'.$PostMeta['msg_time'].'" title="'.$PostMeta['msg_time'].'" class="ghost_notice_container_item_date">'.UserMeta::TimeTran($PostMeta['msg_time']).'</time>
                </div>';
                break;
            case 'N_Reg':
                //注册通知
                return '<div class="ghost_notice_container">
                    <div class="ghost_notice_container_item">
                        <div style="color: #4dd652;" class="ghost_notice_container_item_num">+'.$PostMeta['msg_credit'].'</div></div>
                    <div class="ghost_notice_container_item_icon">
                        <span class="poi-icon fa-map-marker fas fa-fw" aria-hidden="true"></span>
                    </div>
                    <div class="ghost_notice_container_item_content">恭喜您注册成为了本站用户！获得 '.$PostMeta['msg_credit'].' 金币。</div>
                    <time datetime="'.$PostMeta['msg_time'].'" title="'.$PostMeta['msg_time'].'" class="ghost_notice_container_item_date">'.UserMeta::TimeTran($PostMeta['msg_time']).'</time>
                </div>';
                break;
            case 'N_ForgetPwd':
                //忘记密码通知
                return '<div class="ghost_notice_container">
                    <div class="ghost_notice_container_item">
                        <div style="color: #f44336;" class="ghost_notice_container_item_num">'.$PostMeta['msg_credit'].'</div></div>
                    <div class="ghost_notice_container_item_icon">
                        <span class="poi-icon fa-map-marker fas fa-fw" aria-hidden="true"></span>
                    </div>
                    <div class="ghost_notice_container_item_content">您进行了忘记密码操作！扣除 '.$PostMeta['msg_credit'].' 金币。</div>
                    <time datetime="'.$PostMeta['msg_time'].'" title="'.$PostMeta['msg_time'].'" class="ghost_notice_container_item_date">'.UserMeta::TimeTran($PostMeta['msg_time']).'</time>
                </div>';
                break;
            case 'N_UserComment':
                //文章被评论通知
                return '<div class="ghost_notice_container">
                    <div class="ghost_notice_container_item">
                        <div style="color: #4dd652;" class="ghost_notice_container_item_num">+'.$PostMeta['msg_credit'].'</div></div>
                    <div class="ghost_notice_container_item_icon">
                        <span class="poi-icon fa-map-marker fas fa-fw" aria-hidden="true"></span>
                    </div>
                    <div class="ghost_notice_container_item_content">您的文章<a target="_blank" class="notice_post_link" href="'.PostMeta::GetPostUrl($PostMeta['post_id']).'">'.PostMeta::GetPostMeta($PostMeta['post_id'])['post_title'].'</a>被'.UserMeta::GetAuthorMeta($PostMeta['target_id'])['display_name'].'评论了！获得 '.$PostMeta['msg_credit'].' 金币。</div>
                    <time datetime="'.$PostMeta['msg_time'].'" title="'.$PostMeta['msg_time'].'" class="ghost_notice_container_item_date">'.UserMeta::TimeTran($PostMeta['msg_time']).'</time>
                </div>';
                break;
            case 'N_PublishPost':
                //发布文章通知
                return '<div class="ghost_notice_container">
                    <div class="ghost_notice_container_item">
                        <div style="color: #4dd652;" class="ghost_notice_container_item_num">+'.$PostMeta['msg_credit'].'</div></div>
                    <div class="ghost_notice_container_item_icon">
                        <span class="poi-icon fa-map-marker fas fa-fw" aria-hidden="true"></span>
                    </div>
                    <div class="ghost_notice_container_item_content">您的文章<a target="_blank" class="notice_post_link" href="'.PostMeta::GetPostUrl($PostMeta['post_id']).'">'.PostMeta::GetPostMeta($PostMeta['post_id'])['post_title'].'</a>发布成功！获得 '.$PostMeta['msg_credit'].' 金币。</div>
                    <time datetime="'.$PostMeta['msg_time'].'" title="'.$PostMeta['msg_time'].'" class="ghost_notice_container_item_date">'.UserMeta::TimeTran($PostMeta['msg_time']).'</time>
                </div>';
                break;
            case 'N_Flowers':
                //关注用户通知
                return '<div class="ghost_notice_container">
                    <div class="ghost_notice_container_item">
                        <div style="color: #4dd652;" class="ghost_notice_container_item_num">+'.$PostMeta['msg_credit'].'</div></div>
                    <div class="ghost_notice_container_item_icon">
                        <span class="poi-icon fa-map-marker fas fa-fw" aria-hidden="true"></span>
                    </div>
                    <div class="ghost_notice_container_item_content">您关注了用户'.UserMeta::GetAuthorMeta($PostMeta['flower_id'])['display_name'].'！获得 '.$PostMeta['msg_credit'].' 金币。</div>
                    <time datetime="'.$PostMeta['msg_time'].'" title="'.$PostMeta['msg_time'].'" class="ghost_notice_container_item_date">'.UserMeta::TimeTran($PostMeta['msg_time']).'</time>
                </div>';
                break;
            case 'N_UnFlowers':
                //取消关注用户通知
                return '<div class="ghost_notice_container">
                    <div class="ghost_notice_container_item">
                        <div style="color: #f44336;" class="ghost_notice_container_item_num">'.$PostMeta['msg_credit'].'</div></div>
                    <div class="ghost_notice_container_item_icon">
                        <span class="poi-icon fa-map-marker fas fa-fw" aria-hidden="true"></span>
                    </div>
                    <div class="ghost_notice_container_item_content">您取消了对用户'.UserMeta::GetAuthorMeta($PostMeta['unflower_id'])['display_name'].'的关注！扣除 '.$PostMeta['msg_credit'].' 金币。</div>
                    <time datetime="'.$PostMeta['msg_time'].'" title="'.$PostMeta['msg_time'].'" class="ghost_notice_container_item_date">'.UserMeta::TimeTran($PostMeta['msg_time']).'</time>
                </div>';
                break;
            case 'N_SellPaidPost':
                //出售付费文章通知
                return '<div class="ghost_notice_container">
                    <div class="ghost_notice_container_item">
                        <div style="color: #4dd652;" class="ghost_notice_container_item_num">+'.$PostMeta['msg_credit'].'</div></div>
                    <div class="ghost_notice_container_item_icon">
                        <span class="poi-icon fa-map-marker fas fa-fw" aria-hidden="true"></span>
                    </div>
                    <div class="ghost_notice_container_item_content">您成功出售了文章<a target="_blank" class="notice_post_link" href="'.PostMeta::GetPostUrl($PostMeta['post_id']).'">'.PostMeta::GetPostMeta($PostMeta['post_id'])['post_title'].'</a>！获得 '.$PostMeta['msg_credit'].' 金币。</div>
                    <time datetime="'.$PostMeta['msg_time'].'" title="'.$PostMeta['msg_time'].'" class="ghost_notice_container_item_date">'.UserMeta::TimeTran($PostMeta['msg_time']).'</time>
                </div>';
                break;
            case 'N_BuyPaidPost':
                //购买付费文章通知
                return '<div class="ghost_notice_container">
                    <div class="ghost_notice_container_item">
                        <div style="color: #f44336;" class="ghost_notice_container_item_num">'.$PostMeta['msg_credit'].'</div></div>
                    <div class="ghost_notice_container_item_icon">
                        <span class="poi-icon fa-map-marker fas fa-fw" aria-hidden="true"></span>
                    </div>
                    <div class="ghost_notice_container_item_content">您成功购买了文章<a target="_blank" class="notice_post_link" href="'.PostMeta::GetPostUrl($PostMeta['post_id']).'">'.PostMeta::GetPostMeta($PostMeta['post_id'])['post_title'].'</a>！扣除 '.$PostMeta['msg_credit'].' 金币。</div>
                    <time datetime="'.$PostMeta['msg_time'].'" title="'.$PostMeta['msg_time'].'" class="ghost_notice_container_item_date">'.UserMeta::TimeTran($PostMeta['msg_time']).'</time>
                </div>';
                break;
            case 'N_AlterPwd':
                //修改密码通知
                return '<div class="ghost_notice_container">
                    <div class="ghost_notice_container_item">
                        <div style="color: #f44336;" class="ghost_notice_container_item_num">'.$PostMeta['msg_credit'].'</div></div>
                    <div class="ghost_notice_container_item_icon">
                        <span class="poi-icon fa-map-marker fas fa-fw" aria-hidden="true"></span>
                    </div>
                    <div class="ghost_notice_container_item_content">您成功修改了您的密码！扣除 '.$PostMeta['msg_credit'].' 金币。</div>
                    <time datetime="'.$PostMeta['msg_time'].'" title="'.$PostMeta['msg_time'].'" class="ghost_notice_container_item_date">'.UserMeta::TimeTran($PostMeta['msg_time']).'</time>
                </div>';
                break;
        }
    }

    //增加通知的类型
    public static function AddUserNotice($UserId,$Type,$PostId = 0,$Target = 0){
        $dates = date('Y-m-d H:i:s');
        switch($Type){
            case 'N_SignDaily':
                //更新用户积分
                $credit = SiteMeta::GetSiteCreditStrategy('N_SignDaily');
                UserMeta::UpdateUserCredit($UserId,$credit);
                //每日签到通知
                $sql = "insert into pink_notice (user_id,target_id,msg_type,msg_credit,msg_time,status) values({$UserId},0,'{$Type}',{$credit},'{$dates}',0);";
                break;
            case 'N_PostComment':
                //评论文章通知
                break;
            case 'N_Avatar':
                //更新用户积分
                $credit = SiteMeta::GetSiteCreditStrategy('N_Avatar');
                UserMeta::UpdateUserCredit($UserId,$credit);
                //修改头像通知
                $sql = "insert into pink_notice (user_id,target_id,msg_type,msg_credit,msg_time,status) values({$UserId},0,'{$Type}',{$credit},'{$dates}',0);";
                break;
            case 'N_AlterEmail':
                //更新用户积分
                $credit = SiteMeta::GetSiteCreditStrategy('N_AlterEmail');
                UserMeta::UpdateUserCredit($UserId,$credit);
                //修改邮箱通知
                $sql = "insert into pink_notice (user_id,target_id,msg_type,msg_credit,msg_time,status) values({$UserId},0,'{$Type}',{$credit},'{$dates}',0);";
                break;
            case 'N_Reg':
                //更新用户积分
                $credit = SiteMeta::GetSiteCreditStrategy('N_Reg');
                UserMeta::UpdateUserCredit($UserId,$credit);
                //注册通知
                $sql = "insert into pink_notice (user_id,target_id,msg_type,msg_credit,msg_time,status) values({$UserId},0,'{$Type}',{$credit},'{$dates}',0);";
                break;
            case 'N_ForgetPwd':
                //更新用户积分
                $credit = SiteMeta::GetSiteCreditStrategy('N_ForgetPwd');
                UserMeta::UpdateUserCredit($UserId,$credit);
                //忘记密码通知
                $sql = "insert into pink_notice (user_id,target_id,msg_type,msg_credit,msg_time,status) values({$UserId},0,'{$Type}',{$credit},'{$dates}',0);";
                break;
            case 'N_UserComment':
                //文章被评论通知
                break;
            case 'N_PublishPost':
                //更新用户积分
                $credit = SiteMeta::GetSiteCreditStrategy('N_PublishPost');
                UserMeta::UpdateUserCredit($UserId,$credit);
                //发布文章通知
                $sql = "insert into pink_notice (user_id,target_id,msg_type,msg_credit,msg_time,post_id,status) values({$UserId},0,'{$Type}',{$credit},'{$dates}','{$PostId}',0);";
                break;
            case 'N_Flowers':
                //关注用户通知
                break;
            case 'N_UnFlowers':
                //取消关注用户通知
                break;
            case 'N_SellPaidPost':
                //更新用户积分
                $credit = SiteMeta::GetSiteCreditStrategy('N_SellPaidPost');
                UserMeta::UpdateUserCredit($UserId,$credit);
                //出售付费文章通知
                $sql = "insert into pink_notice (user_id,target_id,msg_type,msg_credit,msg_time,post_id,status) values({$UserId},{$Target},'{$Type}',{$credit},'{$dates}','{$PostId}',0);";
                break;
            case 'N_BuyPaidPost':
                //更新用户积分
                $credit = SiteMeta::GetSiteCreditStrategy('N_BuyPaidPost');
                UserMeta::UpdateUserCredit($UserId,$credit);
                //购买付费文章通知
                $sql = "insert into pink_notice (user_id,target_id,msg_type,msg_credit,msg_time,post_id,status) values({$UserId},{$Target},'{$Type}',{$credit},'{$dates}','{$PostId}',0);";
                break;
            case 'N_AlterPwd':
                //更新用户积分
                $credit = SiteMeta::GetSiteCreditStrategy('N_AlterPwd');
                UserMeta::UpdateUserCredit($UserId,$credit);
                //修改密码通知
                $sql = "insert into pink_notice (user_id,target_id,msg_type,msg_credit,msg_time,status) values({$UserId},0,'{$Type}',{$credit},'{$dates}',0);";
                break;
        }
        return self::SqlUpdate($sql);
    }
}


?>