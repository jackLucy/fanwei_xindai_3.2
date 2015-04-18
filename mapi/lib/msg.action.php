<?php
// +----------------------------------------------------------------------
// | p2p借贷系统
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.vonwey.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Vonwey(vonwey@163.com)
// +----------------------------------------------------------------------

//require APP_ROOT_PATH.'app/Lib/deal.php';
class msg
{
	public function index(){
		$root = array();
		$email = strim($GLOBALS['request']['email']);//用户名或邮箱
		$pwd = strim($GLOBALS['request']['pwd']);//密码
		$user = user_check($email,$pwd);//检查用户,用户密码
		$user_id  = intval($user['id']);//user_id
		if ($user_id >0){
			
			$rel_id = intval($GLOBALS['request']['deal_id']);   //deal_id  投资项目id;
		
			$data['user_id'] = $user_id;
			$data['rel_id'] = $rel_id;
			$data['title'] = $GLOBALS['request']['title'];
			$data['content'] = $GLOBALS['request']['content'];
			
			$data['create_time'] = TIME_UTC;
			$data['rel_table'] = 'deal';
			$data['is_effect'] = 1;
			
			if ($data['rel_id'] > 0){
				$GLOBALS['db']->autoExecute(DB_PREFIX."message",$data,"INSERT");
			}
			
			if($GLOBALS['db']->affected_rows()){
				$root['response_code'] = 1;
				$root['show_err'] = "留言成功";
			}else{
				$root['response_code'] = 0;
				$root['show_err'] = "留言失败";
			}
			//$message_list = $GLOBALS['db']->getAll("SELECT title,content,a.create_time,rel_id,a.user_id,a.is_effect,b.user_name FROM ".DB_PREFIX."message as a left join ".DB_PREFIX."user as b on  a.user_id = b.id WHERE rel_id = ".$id);
			//$root['message']= $message_list;
			
		}else{
			$root['response_code'] = 0;
			$root['show_err'] ="未登录";
			$root['user_login_status'] = 0;
		}
		output($root);		
	}
}
?>

