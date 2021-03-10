<?php

namespace model;

use core\Model;

class UserComment extends Model{

    //构造二级评论数组
    private static $Comment = array();
    public static function noLimitComment($comments,$parent_slug = 0,$level = 0,$parentid = 0){
        //遍历数组：找出当前符合指定层次的分类
        foreach($comments as $comment){
            if($comment['comment_parent'] == $parent_slug){
                //为当前分类添加上层级
                $comment['level'] = $level;
                self::$Comment[$comment['comment_ID']] = $comment;
                self::noLimitComment($comments,$comment['comment_ID'],$level+1,$comment['comment_ID']);
            }
        }

        return self::$Comment;
    }

    //获取文章评论方法
    public static function GetPostComments($PostId){
        $sql = 'select * from pink_comments where comment_post_ID = "' . $PostId . '" order by comment_date desc;';
        return self::SqlQuery($sql,1);
    }

}

?>