<?php
// +----------------------------------------------------------------------
// | p2p借贷系统
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.vonwey.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Vonwey(vonwey@163.com)
// +----------------------------------------------------------------------

require APP_ROOT_PATH.'app/Lib/uc.php';

class uc_companyModule extends SiteBaseModule
{
	public function index()
	{
		$GLOBALS['tmpl']->assign("page_title",$GLOBALS['lang']['UC_COMPANY']);
		
		$company = $GLOBALS['db']->getRow("SELECT * FROM ".DB_PREFIX."user_company WHERE user_id=".intval($GLOBALS['user_info']['id']));
		
		$GLOBALS['tmpl']->assign("company",$company);
		
		$GLOBALS['tmpl']->assign("inc_file","inc/uc/uc_company.html");
		$GLOBALS['tmpl']->display("page/uc.html");
	}
	
	
	public function save()
	{
		$data =  $_POST;
		foreach($data as $k=>$v){
			if($k=="description"){
				$data[$k] =  replace_public(btrim($v));
			}else{
				$data[$k] =  strim($v);
			}
		}
		$data['user_id'] = intval($GLOBALS['user_info']['id']);
		$mode ="INSERT";
		$where ="";
		if($GLOBALS['db']->getOne("SELECT count(*) FROM ".DB_PREFIX."user_company WHERE user_id=".intval($GLOBALS['user_info']['id'])) > 0){
			$mode = "UPDATE";
			$where ="user_id=".intval($GLOBALS['user_info']['id']);
		}
		
		$GLOBALS['db']->autoExecute(DB_PREFIX."user_company",$data,$mode,$where);
		app_redirect(url("index","uc_company#index"));
	}
}
?>