<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 控制器基类
 * add by yyb5683@gmail.com
 * 2015年12月10日11:33:26
 */
if (ENVIRONMENT != 'product'){
	ini_set('memory_limit', '256M');
}
class MY_Controller extends CI_Controller{
	
	protected $APPID = 'wx7a01285bc391466a';
	protected $APPSECRET = '2ba3b7f6c89305563e036426eb789a89';
	
	/**
	 * 初始化操作
	 * add by yyb5683@gmail.com
	 * 2015年12月10日11:34:15
	 */
	public function __construct(){
		parent::__construct();
	}
	
	/**
	 * @desc 获取公众号的全局唯一票据access token
	 * @version 2017年6月14日09:44:02
	 */
	public function getTokenUrl() {
		$params = array(
				'grant_type' => 'client_credential',
				'appid' => $this->APPID, //公众号的唯一标识
				'secret' => $this->APPSECRET, //公众号的appsecret
		);
		return 'https://api.weixin.qq.com/cgi-bin/token?' . http_build_query($params);
	}
	
	/**
	 * @desc 获取jsapi_ticket
	 * @version 2015-01-28 10:54:00
	 */
	public static function getTicketUrl($token) {
		$params = array(
				'access_token' => $token,
				'type' => 'jsapi',
		);
		return 'https://api.weixin.qq.com/cgi-bin/ticket/getticket?' . http_build_query($params);
	}
	
	/**
	 * @desc 获取微信js所需签名
	 * @version 2017年6月13日22:42:57
	 */
	public function getWxJsConfig() {
		$accessTokenUrl = $this->getTokenUrl();
	}
	
	/**
	 * 错误信息输出格式
	 * add by yyb5683@gmail.com
	 * 2015年12月25日21:33:39
	 */
	public function showMessage($info){
		$this->template['info'] = $info;
		$html = $this->load->view("error/error",$this->template,true);
		echo $html;die;
	}
	
	/**
	 * 统一的错误输出
	 * add by yyb5683@gmail.com
	 * 2015年12月10日15:49:53
	 */
	public function splitJson($json,$status = 0,$type = 0) {
		$array = array('status' => $status,'info' => $json);
		if (empty($type)){
			echo json_encode($array);exit();
		}else{
			return json_encode($array);
		}
	}
	
}