<?php
// +----------------------------------------------------------------------
// | p2p借贷系统
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.vonwey.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Vonwey(vonwey@163.com)
// +----------------------------------------------------------------------
//require APP_ROOT_PATH.'app/Lib/uc.php';
class uc_save_carry
{
	public function index(){
		
		$root = array();
		
		$email = strim($GLOBALS['request']['email']);//用户名或邮箱
		$pwd = strim($GLOBALS['request']['pwd']);//密码
		
			
		//检查用户,用户密码
		$user = user_check($email,$pwd);
		$user_id  = intval($user['id']);
		if ($user_id >0){
			require APP_ROOT_PATH.'app/Lib/uc_func.php';
			
			$root['user_login_status'] = 1;
									
			$paypassword = strim($GLOBALS['request']['paypassword']);
			$amount = floatval($GLOBALS['request']['amount']);
			$bid = intval($GLOBALS['request']['bid']);
			
			$result = getUcSaveCarry($amount,$paypassword,$bid);
			 
			$root['response_code'] = $result['status'];
			$root['show_err'] = $result['show_err'];
		}else{
			$root['response_code'] = 0;
			$root['show_err'] ="未登录";
			$root['user_login_status'] = 0;
		}
		output($root);		
	}
}
?>
