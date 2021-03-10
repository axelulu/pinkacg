<?php

namespace model;

use core\Model;
use core\Dao;

class PostMeta extends Model{

    //获取文章class
    public static function GetPostType($PostType = '',$type = ''){
        if($type == $PostType){
            return 'is_success';
        }else{

        }
    }

    public static function IsBuyPost($UserId,$PostId,$Target){
        $sql = "select * from pink_notice where user_id = {$UserId} and target_id = {$Target} and msg_type = 'N_BuyPaidPost' and post_id = {$PostId};";
        return self::SqlQuery($sql);
    }

    //获取分类文章数量
    public static function GetPostNumByMenu($Menu){
        if(isset($Menu)){
            $Menustr = array();
            $Menustr[0] = $Menu;
            $Menustr = json_encode($Menustr);
            $Menustr = addslashes($Menustr);
        }else{
            $Menu = '';
        }
        $sql = "select count(*) as num from pink_posts where post_menu = '{$Menustr}';";
        return self::SqlQuery($sql)['num'];
    }

    //获取单个文章信息方法
    public static function GetPostMeta($key){
        $sql = 'select * from pink_posts where id = "' . $key . '";';
        return self::SqlQuery($sql);
    }

    //获取多个文章
    public static function GetPostsMeta($num,$slug,$type,$ajax = false){
        global $config;
        $result = new Dao($config['database']);
        $slug = array($slug);
        $slug = json_encode($slug);
        if($ajax){
            return $result->DaoQueryPost($slug,$type,$num,12);
        }else{
            return $result->DaoQueryPost($slug,$type,0,$num);
        }
    }

    //通过用户id获取文章信息
    public static function GetPostsMetaByAuthor($num,$Author,$orderby,$type = '',$num2=0){
        if($num2 == 0){
            if(empty($type)){
                $sql = 'select * from pink_posts where post_author = "' . $Author . '" order by ' . $orderby . ' desc limit ' . $num . ';';
            }else{
                $sql = 'select * from pink_posts where post_author = "' . $Author . '" and post_status = "' . $type . '" order by ' . $orderby . ' desc limit ' . $num . ';';
            }
        }else{
            if(empty($type)){
                $sql = 'select * from pink_posts where post_author = "' . $Author . '" order by ' . $orderby . ' desc limit ' . $num . ',' . $num2 . ';';
            }else{
                $sql = 'select * from pink_posts where post_author = "' . $Author . '" and post_status = "' . $type . '" order by ' . $orderby . ' desc limit ' . $num . ',' . $num2 . ';';
            }
        }
        return self::SqlQuery($sql,1);
    }

    //获取文章链接方法
    public static function GetPostUrl($post_id){
        return HOME_URL . $post_id . '.html';
    }

}

?>