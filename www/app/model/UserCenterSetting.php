<?php

namespace model;

use core\model;

class UserCenterSetting extends model{

    //更新用户信息
    public static function UpdateUserMeta($UserId,$UserMeta){
        $UserName = addslashes($UserMeta['name']);
        $UserDec = addslashes($UserMeta['dec']);
        $sql = "update pink_users set display_name = '{$UserName}',description = '{$UserDec}' where ID = '{$UserId}';";
        return self::SqlUpdate($sql);
    }

    //上传用户头像
    public static function UploadAvatar($UserId,$Image,&$error){
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
        $AvatarPath = 'UserAvatar';
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
            $ImgPath = $path . $AvatarPath . '/' . $UserId . '/' . date('Y') . '/' . date('m') . '/' . date('d') . '/' . $image;
            if ( ! is_dir($path . $AvatarPath)) {
                mkdir($path . $AvatarPath);
            }
            if ( ! is_dir($path . $AvatarPath . '/' . $UserId)) {
                mkdir($path . $AvatarPath . '/' . $UserId);
            }
            if ( ! is_dir($path . $AvatarPath . '/' . $UserId . '/' . date('Y') . '/')) {
                mkdir($path . $AvatarPath . '/' . $UserId . '/' . date('Y') . '/');
            }
            if ( ! is_dir($path . $AvatarPath . '/' . $UserId . '/' . date('Y') . '/' . date('m') . '/')) {
                mkdir($path . $AvatarPath . '/' . $UserId . '/' . date('Y') . '/' . date('m') . '/');
            }
            if ( ! is_dir($path . $AvatarPath . '/' . $UserId . '/' . date('Y') . '/' . date('m') . '/' . date('d') . '/')) {
                mkdir($path . $AvatarPath . '/' . $UserId . '/' . date('Y') . '/' . date('m') . '/' . date('d') . '/');
            }
            if(move_uploaded_file($Image['tmp_name'], $ImgPath)){
                if(UserMeta::UpdateAvatarByUserId($UserId, HOME_URL . $ImgPath)){
                    return true;
                }else{
                    $error = '更新头像失败';
                    return false;
                }
            }
        }else{
            $error = '文件上传失败';
            return false;
        }
    }
}

?>