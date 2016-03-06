<?php

header("content-type:text/html;charset=utf-8");

//shop项目的入口程序文件

//开启调试模式
define('APP_DEBUG',true);

//给系统资源文件路径定义成常量
//前台
define('SITE_URL','http://web.0105.com/');
define('CSS_URL',SITE_URL.'shop/Public/css/');
define('IMG_URL',SITE_URL.'shop/Public/img/');
define('JS_URL',SITE_URL.'shop/Public/js/');
//后台
define('ADMIN_CSS_URL',SITE_URL.'shop/Admin/Public/css/');
define('ADMIN_IMG_URL',SITE_URL.'shop/Admin/Public/img/');
define('ADMIN_JS_URL',SITE_URL.'shop/Admin/Public/js/');

//引入框架的接口文件ThinkPHP.php
include("../ThinkPHP/ThinkPHP.php");
