<?php

namespace model;

use core\Dao;
use core\Model;

class UserCenterAddPost extends Model{

    //插入文章
    public static function InsertPost($PostMeta,$Link,$UserId,$Msg,$PostType='post'){
        global $config;
        $result = new Dao($config['database']);

        $NowTime = date('Y-m-d H:i:s');
        $PostImg = $PostMeta['PostImg'];
        $PostCat = array($PostMeta['cat']);
        $PostCat = json_encode($PostCat);
        $PostTag = json_encode($PostMeta['tag'], JSON_UNESCAPED_UNICODE);
        $PostName = urlencode($PostMeta['title']);
        $Link = serialize($Link);
        if($PostType == 'video'){
            //如果是视频文章类型
            $PostMusic = '';
            $PostVideo = $Msg;
        }elseif($PostType == 'music'){
            //如果是音乐文章类型
            $PostMusic = $Msg;
            $PostVideo = '';
        }else{
            //如果是音乐文章类型
            $PostMusic = '';
            $PostVideo = '';
        }
        $sql = "insert into pink_posts (post_author,post_date,post_date_gmt,post_content,post_title,post_excerpt,post_status,comment_status,ping_status,post_name,to_ping,pinged,post_modified,post_modified_gmt,post_content_filtered,post_menu,post_tag,guid,post_type,post_download_link,post_music,post_video,post_header_img) values('{$UserId}','{$NowTime}','{$NowTime}','{$PostMeta['meta']}','{$PostMeta['title']}','','publish','open','open','{$PostName}','','','{$NowTime}','{$NowTime}','','{$PostCat}','{$PostTag}','{$PostMeta['guid']}','{$PostType}','{$Link}','{$PostMusic}','{$PostVideo}','{$PostImg}');";
        if($result->DaoExec($sql)){
            return $result->lastInsertId();
        }
    }

    //更新文章
    public static function UpdatePost(){

    }

    //上传用户头像
    public static function UploadPostImg($UserId,$Image,&$error){
        $allow_type = array(
            'image/jpeg',
            'image/jpg',
            'image/png',
        );
        $allow_format = array(
            'jpeg',
            'jpg',
            'png',
        );
        $PostPath = 'PostImg';
        $path = 'uploads/';
        $max_size = 4096;
        //判断文件是否有效
        if(!is_array($Image) || !isset($Image['error'])){
            $error = '文件无效';
            return false;
        }

        //判断文件存储路径是否有效
        if(!is_dir($path)){
            $error = '文件路径错误';
            return false;
        }

        //判断文件上传过程是否出错
        switch ($Image['error']){
            case 1:
            case 2:
                $error = '文件超出服务器允许大小';
                return false;
            case 3:
                $error = '文件上传过程中出错';
                return false;
            case 4:
                $error = '用户没有选中上传文件';
                return false;
            case 6:
            case 7:
                $error = '文件保存失败';
                return false;
        }

        //判断文件类型是否正确
        if(!in_array($Image['type'],$allow_type)){
            $error = '文件类型错误';
            return false;
        }

        //判断文件格式是否正确
        $ext = ltrim(strrchr($Image['name'],'.'),'.');
        if(!empty($allow_format) && !in_array($ext, $allow_format)){
            $error = '文件格式错误';
            return false;
        }

        //判断文件大小是否正确
        if($Image['size'] > $max_size){
            $error = '当前上传的文件超出大小，最大允许为'. $max_size .'字节';
            return false;
        }

        //判断用户是否存在
        if(!UserMeta::GetUserByUserId($UserId)){
            $error = '用户不存在';
            return false;
        }

        //移动到指定目录
        if(is_uploaded_file($Image['tmp_name'])){
            $image = md5($Image['tmp_name']) . '.' . $ext;
            $ImgPath = $path . $PostPath . '/' . $UserId . '/' . date('Y') . '/' . date('m') . '/' . date('d') . '/' . $image;
            if ( ! is_dir($path . $PostPath)) {
                mkdir($path . $PostPath);
            }
            if ( ! is_dir($path . $PostPath . '/' . $UserId)) {
                mkdir($path . $PostPath . '/' . $UserId);
            }
            if ( ! is_dir($path . $PostPath . '/' . $UserId . '/' . date('Y') . '/')) {
                mkdir($path . $PostPath . '/' . $UserId . '/' . date('Y') . '/');
            }
            if ( ! is_dir($path . $PostPath . '/' . $UserId . '/' . date('Y') . '/' . date('m') . '/')) {
                mkdir($path . $PostPath . '/' . $UserId . '/' . date('Y') . '/' . date('m') . '/');
            }
            if ( ! is_dir($path . $PostPath . '/' . $UserId . '/' . date('Y') . '/' . date('m') . '/' . date('d') . '/')) {
                mkdir($path . $PostPath . '/' . $UserId . '/' . date('Y') . '/' . date('m') . '/' . date('d') . '/');
            }
            if(move_uploaded_file($Image['tmp_name'], $ImgPath)){
                return HOME_URL . $ImgPath;
            }
        }else{
            $error = '文件上传失败';
            return false;
        }
    }
}

?>