<?php

namespace model;

use core\Model;

class UserCenterMsg extends model{
    //获取所有消息
    public static function GetAllMsgList($UserId){
        $sql = "select * from pink_msg where (sender_id = '{$UserId}' or receiver_id = '{$UserId}') and type = 'MsgList';";
        return self::SqlQuery($sql, 1);
    }

    //根据用户id获取所有消息
    public static function GetAllMsgByUserId($UserId){
        $sql = "select * from pink_msg where (sender_id = '{$UserId}' or receiver_id = '{$UserId}') and type = 'MsgContentByUserId' order by msg_time asc;";
        return self::SqlQuery($sql, 1);
    }

    //判断会话是否存在
    public static function IsMsgList($sender_id,$receiver_id){
        $sql = "select * from pink_msg where sender_id = '{$sender_id}' and receiver_id = '{$receiver_id}' and type = 'MsgList';";
        return self::SqlQuery($sql);
    }

    //增加消息会话
    public static function SubmitNewMsgList($sender_id,$receiver_id){
        $time = date('Y-m-d H:i:s');
        $sql = "insert into pink_msg (sender_id,receiver_id,type,msg_time,sender_read,receiver_read,status) values({$sender_id},{$receiver_id},'MsgList','{$time}',0,0,1)";
        return self::SqlUpdate($sql);
    }

    //发送新消息
    public static function SubmitNewMsg($sender_id,$receiver_id,$content){
        $time = date('Y-m-d H:i:s');
        $sql = "insert into pink_msg (sender_id,receiver_id,type,msg_time,msg_content,sender_read,receiver_read,status) values({$sender_id},{$receiver_id},'MsgContentByUserId','{$time}','{$content}',0,0,1)";
        return self::SqlUpdate($sql);
    }
}

?>