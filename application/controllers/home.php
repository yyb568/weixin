<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 后台管理首页
 * add by yyb5683@gmail.com
 * 2017年6月12日16:31:04
 */
define('TOKEN','weixin');
class Home extends MY_Controller{
	/**
	 * 初始化
	 * add by yyb5683@gmail.com
	 * 2017年6月12日16:32:00
	 */
	public function __construct(){
		parent::__construct();
		$wxConfig = $this->getWxJsConfig();
		
	}
	
	/**
	 * 管理首页面
	 * add by  yyb5683@gmail.com
	 * 2017年6月12日16:32:21
	 */
	public function index(){
// 		$this->valid();
// 		$this->load->view("main/index",$this->template);
	}
	
	/**
	 * 首次接入验证
	 * add by  yyb5683@gmail.com
	 * 2017年6月14日09:13:51
	 */
	public function valid(){
		$echoStr = $_GET["echostr"];
	
		//valid signature , option
		if($this->checkSignature()){
			echo $echoStr;
			exit;
		}
	}
	
	/**
	 * 首次接入验证
	 * add by  yyb5683@gmail.com
	 * 2017年6月14日09:13:51
	 */
	private function checkSignature(){
		$signature = $_GET["signature"];
		$timestamp = $_GET["timestamp"];
		$nonce = $_GET["nonce"];
	
		$token = TOKEN;
		$tmpArr = array($token, $timestamp, $nonce);
		sort($tmpArr);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
	
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}
} 