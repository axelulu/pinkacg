<?php

//命名空间
namespace model;

use core\Dao;
use core\Model;

//站点信息类
class Comment extends Model{
    //提交文章评论
    public static function SubmitPostComment($UserId,$PostId,$Content){
        global $config;
        $result = new Dao($config['database']);
        $NowTime = date('Y-m-d H:i:s');
        $sql = "insert into pink_comments values(null,{$PostId},'{$NowTime}','{$NowTime}','{$Content}',0,1,'comment',0,{$UserId},0);";
        if($result->DaoExec($sql)){
            return $result->lastInsertId();
        }
    }
}