<?php
// +----------------------------------------------------------------------
// | p2p借贷系统
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.vonwey.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Vonwey(vonwey@163.com)
// +----------------------------------------------------------------------

interface medal{	
	
	//必有字段
//	var $lang;
//	var $description;
//	var $route;
//	var $config;
	
	//获取勋章,返回格式 array('status','info','jump');
	//status 0:领取失败 1:领取成功 2:已经领取
	//jump表示当获取失败时跳转的url
	//该接口在用户中心，勋章管里领取时触发
	function get_medal();
	
	//检测勋章的有效性
	//该接口在用户登录与自动登录的接口中触发
	//return array('status','info');  //可用于发用户通知
	function check_medal();
}
?>