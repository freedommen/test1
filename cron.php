<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');
define('APP_MODE','cli');
define ('APP_DEBUG',  true );

$rootPath = dirname(__FILE__);
define ( 'APP_PATH', $rootPath . '/Application/' );
define ( 'RUNTIME_PATH', $rootPath . '/Application/Runtime/' );
require $rootPath . '/ThinkPHP/ThinkPHP.php';
