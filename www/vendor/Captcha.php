<?php

//验证码类
namespace vendor;

class Captcha{

	//制作验证码
	/*
	 * @param1 int $width = 450，验证码图片默认宽度
	 * @param2 int $height = 65，验证码图片默认高度
	 * @param3 int $length = 4，验证码默认字符数
	 * @param4 string $fonts = ''，验证码字体，默认为空（内部使用默认字体）
	*/
	public static function getCaptcha($width = 450,$height = 65,$length = 4,$fonts = ''){
		//判定字体资源
		if(empty($fonts)) $fonts = 'verdana.ttf';

		//确定路径
		$fonts = __DIR__ . '/fonts/' . $fonts;

		//制作画布
		$img = imagecreatetruecolor($width,$height);

		//分配背景色：随机浅色系
		$bg_color = imagecolorallocate($img,mt_rand(200,255),mt_rand(200,255),mt_rand(200,255));
		imagefill($img,0,0,$bg_color);

		//增加干扰点：*
		for($i = 0;$i < 50;$i++){
			//随机颜色
			$dots_color = imagecolorallocate($img,mt_rand(140,190),mt_rand(140,190),mt_rand(140,190));
			//写入内容
			imagestring($img,mt_rand(1,5),mt_rand(0,$width),mt_rand(0,$height),'*',$dots_color);
		}

		//增加干扰线
		for($i = 0;$i < 10;$i++){
			//线段颜色
			$line_color = imagecolorallocate($img, mt_rand(80,130), mt_rand(80,130), mt_rand(80,130));
			//制作线段
			imageline($img,mt_rand(0,$width),mt_rand(0,$height),mt_rand(0,$width),mt_rand(0,$height),$line_color);
		}

		//获取随机字符
		$captcha = self::getString($length);
		//保存到session
		@session_start();
		$_SESSION['captcha'] = $captcha;

		//写入图片
		for($i = 0;$i < $length;$i++){
			//增加颜色
			$c_color = imagecolorallocate($img, mt_rand(0,60), mt_rand(0,60), mt_rand(0,60));

			//写入到图片
			imagettftext($img, mt_rand(30,35), mt_rand(-45,45), $width/($length+1)*($i+1), mt_rand(25,$height-25), $c_color, $fonts, $captcha[$i]);
		}

		//输出资源
		header('Content-type:image/png');
		imagepng($img);

		//销毁资源
		imagedestroy($img);
	}

	//获取随机字符串
	private static function getString($length = 4){
		//定义变量保存数据
		$captcha = '';

		//循环随机获取数据
		for($i = 0;$i < $length;$i++){
			//随机确定数字、大写字母还是小写字母
			switch(mt_rand(1,3)){
				case 1:				//数字：49-57分别代表1-9
					$captcha .= chr(mt_rand(49,57));	
					break;
				case 2:				//小写字母
					$captcha .= chr(mt_rand(65,90));
					break;
				case 3:				//大写字母
					$captcha .= chr(mt_rand(97,122));
					break;
			}
		}

		//返回给调用处
		return $captcha;
	}

	//验证验证码
	public static function checkCaptcha($captcha){
		//与session中存的进行对比
		@session_start();
		return (strtolower($captcha) === strtolower($_SESSION['captcha']));
	}
}