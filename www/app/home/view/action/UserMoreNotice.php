<?php
use model\UserCenterNotice;
$Page = $_POST['page'] ?? '';
$UserId = $_POST['userid'] ?? '';
$NoticeMetas = UserCenterNotice::GetAllNoticeByUserId($UserId,$Page * 15,15);
if(!$NoticeMetas){
    header( 'content-type: application/json; charset=utf-8' );
    $result['status']	= 0;
    echo json_encode( $result );
    exit();
}
foreach($NoticeMetas as $NoticeMeta){
    echo UserCenterNotice::GetNoticeType($NoticeMeta);
}
//自动将未读标为已读
UserCenterNotice::readNotice($UserId);
?>