<?php
// +----------------------------------------------------------------------
// | p2p借贷系统
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.vonwey.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Vonwey(vonwey@163.com)
// +----------------------------------------------------------------------

interface payment{	
	/**
	 * 获取支付代码或提示信息
	 * @param integer $payment_log_id  支付单号ID
	 */
	function get_payment_code($payment_notice_id);
	
	//响应支付
	function response($request);
	
	//响应通知
	function notify($request);
	
	//获取接口的显示
	function get_display_code();	
}
?>