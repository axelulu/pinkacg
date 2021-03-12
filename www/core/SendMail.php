<?php

namespace core;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

use model\SiteMeta;

class SendMail
{
    private $MailModelMeta = array();
    public function SendMsg($email,$RegCode,$Model){
        $site_title = SiteMeta::GetSiteMetaItem('site_name') ?? '';
        $mail = new PHPMailer(true);
        if(!SiteMeta::GetSiteMeta('EmailMeta')){
            exit();
        }
        try {
            //服务器配置
            $mail->CharSet ="UTF-8";                     //设定邮件编码
            $mail->SMTPDebug = 0;                        // 调试模式输出
            $mail->isSMTP();                             // 使用SMTP
            $mail->Host = SiteMeta::GetSiteEmail('smtp_host');                // SMTP服务器
            $mail->SMTPAuth = true;                      // 允许 SMTP 认证
            $mail->Username = SiteMeta::GetSiteEmail('smtp_username');                // SMTP 用户名  即邮箱的用户名
            $mail->Password = SiteMeta::GetSiteEmail('smtp_pass');             // SMTP 密码  部分邮箱是授权码(例如163邮箱)
            $mail->SMTPSecure = SiteMeta::GetSiteEmail('smtp_secure');                    // 允许 TLS 或者ssl协议
            $mail->Port = SiteMeta::GetSiteEmail('smtp_port');                            // 服务器端口 25 或者465 具体要看邮箱服务器支持

            $mail->setFrom(SiteMeta::GetSiteEmail('smtp_username'), $site_title);  //发件人
            $mail->addAddress($email, $site_title);  // 收件人
            //$mail->addAddress('ellen@example.com');  // 可添加多个收件人
            $mail->addReplyTo(SiteMeta::GetSiteEmail('smtp_username'), $site_title); //回复的时候回复给哪个邮箱 建议和发件人一致
            //$mail->addCC('cc@example.com');                    //抄送
            //$mail->addBCC('bcc@example.com');                    //密送

            //发送附件
            // $mail->addAttachment('../xy.zip');         // 添加附件
            // $mail->addAttachment('../thumb-1.jpg', 'new.jpg');    // 发送附件并且重命名

            $this->MailModel($Model,$RegCode);

            //Content
            $mail->isHTML(true);                                  // 是否以HTML文档格式发送  发送后客户端可直接显示对应HTML内容
            $mail->Subject = $this->MailModelMeta['Title'];
            $mail->Body    = $this->MailModelMeta['Content'];
            $mail->AltBody = $RegCode;

            $mail->send();
            return 1;
        } catch (Exception $e) {
            echo '邮件发送失败: ', $mail->ErrorInfo;
        }
    }

    //邮件模版
    private function MailModel($Model,$RegCode){
        $site_title = SiteMeta::GetSiteMetaItem('site_name') ?? '';
        switch ($Model){
            case 'reg':
                $this->MailModelMeta['Title'] = '用户注册验证 -- ' . $site_title;
                $this->MailModelMeta['Content'] = '<h1>您注册粉萌次元的验证码是：' . $RegCode . '</h1><br/>当前时间：' . date('Y-m-d H:i:s');
                break;
            case 'forget':
                $this->MailModelMeta['Title'] = '忘记密码验证 -- ' . $site_title;
                $this->MailModelMeta['Content'] = '<h1>用于您忘记密码的验证码是：' . $RegCode . '</h1><br/>当前时间：' . date('Y-m-d H:i:s');
                break;
            case 'AlterMail':
                $this->MailModelMeta['Title'] = '修改邮箱验证 -- ' . $site_title;
                $this->MailModelMeta['Content'] = '<h1>用于您修改邮箱的验证码是：' . $RegCode . '</h1><br/>当前时间：' . date('Y-m-d H:i:s');
                break;
        }
    }

}