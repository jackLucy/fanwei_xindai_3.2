<?php
// +----------------------------------------------------------------------
// | o2o商业系统
// +----------------------------------------------------------------------
// | Copyright (c) 2010 http://www.vonwey.com All rights reserved.
// +----------------------------------------------------------------------

/* 模块的基本信息 */
if (isset($read_modules) && $read_modules == true)
{
    $module['server_url'] = 'http://esm2.9wtd.com:9001';
	
    $module['class_name']    = 'ESM';
    /* 名称 */
    $module['name']    = "ESM短信平台";
  
    if(ACTION_NAME == "install" || ACTION_NAME == "edit"){
	    require_once APP_ROOT_PATH."system/sms/FW/transport.php";
		$tran = new transport();
		$install_info = $tran->request($module['server_url']."data/install.php");
		$install_info = json_decode($install_info['body'],1);
		
	    $module['lang']  = $install_info['lang'];
	    $module['config'] = $install_info['config'];	
    }
    return $module;
}

// ESM短信平台
require_once APP_ROOT_PATH."system/libs/sms.php";  //引入接口
require_once APP_ROOT_PATH."system/sms/FW/transport.php";
class ESM_sms implements sms
{
	public $sms;
	public $message = "";
	
    public function __construct($smsInfo = '')
    { 	    	
		if(!empty($smsInfo))
		{
			$this->sms = $smsInfo;
		}
    }
	
	public function sendSMS($mobile_number,$content)
	{
		if(is_array($mobile_number)){
			$mobile_number=$mobile_number[0];
		}

		$content.='【友融金融】';
 		$account = $this->sms['user_name'];
		$password =$this->sms['password'];

		$statusStr = array(
			"-1" => "用户名或者密码不正确",
			"0" => "短信发送失败",
			"1" => "短信发送成功",
			"2" => "余额不够",
			"3" => "黑词审核中",
			"4" => "出现异常，人工处理中",
			"6" => "有效号码为空",
			"7" => "短信内容为空",
			"8" => "一级黑词",
			"9" => "没有url提交权限",
			"10" => "发送号码过多",
			"11" => "产品ID异常"
		);
		$smsapi = "http://esm2.9wtd.com:9001/"; //短信网关
		$user = $account ; //短信平台帐号
		$productid = 'yrjr'; // 产品ID必须，如有需要联系客服
		$pass = md5($password); //短信平台密码
 		$phone = $mobile_number;//要发送短信的手机号码
		$sendurl = $smsapi."sendXSms.do?username=".$user."&password=".$pass."&mobile=".$phone."&content=".urlencode($content)."&productid=".$productid;
		$r =file_get_contents($sendurl) ;

		$result=array();
		if($r=='0'){
			$result['status']=true;
		}else{
			$result['status']=false;
		}
		$result['msg'] = $statusStr[$r];
 		return $result;
	}
	
	public function getSmsInfo()
	{	
		return "ESM短信平台";
	}
	
	public function check_fee()
	{

		$account = $this->sms['user_name'];
		$password =$this->sms['password'];
		$statusStr = array(
			"-1" => "用户名或者密码不正确",
			"-2" => "服务器空间不支持,请确认支持curl或者fsocket，联系您的空间商解决或者更换空间！",
			"-9" => "没有url提交权限！"
		);
		$smsapi = "http://esm2.9wtd.com:9001/"; //短信网关
		$user = $account ; //短信平台帐号
		$productid = 'yrjr'; // 产品ID必须，如有需要联系客服
 		$sendurl = $smsapi."balance.do?username=".$user."&password=".$password."&productid=".$productid;;
		$result =file_get_contents($sendurl) ;
		$remain=explode(',',$result);
		 return  '剩下'.$remain[1].'条短信';

	}
}
?>