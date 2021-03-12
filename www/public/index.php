<?php
//增加入口标记
define('ACCESS', true);

//定义上级目录常量
define('ROOT_PATH', str_replace('\\', '/',dirname(__DIR__)) . '/');
require ROOT_PATH . 'core/App.php';

//初始化文件
\core\App::start();
?>