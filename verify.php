<?php 
// +----------------------------------------------------------------------
// | p2p借贷系统
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.vonwey.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Vonwey(vonwey@163.com)
// +----------------------------------------------------------------------\
error_reporting(0);
if(!defined('APP_ROOT_PATH')) 
define('APP_ROOT_PATH', str_replace('verify.php', '', str_replace('\\', '/', __FILE__)));
require APP_ROOT_PATH."system/utils/es_session.php";
es_session::start();
require APP_ROOT_PATH."system/utils/es_image.php";
$verify = isset($_REQUEST['vname']) ? !empty($_REQUEST['vname']) ? strim($_REQUEST['vname']) : 'verify' : 'verify';
$w = isset($_REQUEST['w']) ? intval($_REQUEST['w']) : 50;
$h = isset($_REQUEST['h']) ? intval($_REQUEST['h']) : 22;
es_image::buildImageVerify(4,1,'gif',$w,$h,$verify);
?>