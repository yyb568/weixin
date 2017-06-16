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
	
	protected $APPID = 'wx2c466f872e9e809b';
	protected $APPSECRET = '53263d460903e8cbc6fcb7c3d5f75022';
	
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
	 * @desc 获取公众号的菜单
	 * @version 2017年6月14日09:44:02
	 */
	public function getAccmenu($tokenInfo = ''){
		return 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token='.$tokenInfo['access_token'];
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
		$this->load->library("memcache");
		//获取授权token
// 		$token = $this->memcache->get('weixin_token');
// 		if (empty($token)){
			$accessTokenUrl = $this->getTokenUrl();
			$tokenInfo = $this->curl($accessTokenUrl);
			if(false == empty($tokenInfo['access_token'])) {
				$this->memcache->set('weixin_token', $tokenInfo['access_token'], $tokenInfo['expires_in']-60);
				$token = $tokenInfo['access_token'];
			}
// 		}
		//自定义菜单
		$this->get_Custommenu($token);
	}
	
	/**
	 * @desc get请求
	 * @version 2017年6月13日22:42:57
	 */
	function curl($url){
		//$json =  file_get_contents($url);
		//return json_decode($json,true);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($ch, CURLOPT_SSLVERSION, 1);
			
		$output = curl_exec($ch);
		curl_close($ch);
		return json_decode($output,true);
			
			
	}
	
	/**
	 * 生成随机数
	 * @param number $length
	 * @return string
	 */
	public function createNonceStr($length = 16) {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$str = "";
		for ($i = 0; $i < $length; $i++) {
			$str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
		}
		return $str;
	}
	
	/**
	 * 错误信息输出格式
	 * add by yyb5683@gmail.com
	 * 2015年12月25日21:33:39
	 */
	public function get_Custommenu($token = ''){
		$access_token = $token;
		$jsonmenu = '{
    		 "button": [
        {
            "name": "链接", 
            "sub_button": [
                {
                    "type": "view", 
                    "name": "我的商城", 
                    "url": "http://leapp.u-ego.com/channel/index"
                }, 
                {
                    "type": "view", 
                    "name": "视频", 
                    "url": "http://v.qq.com/"
                }, 
                {
                    "type": "click", 
                    "name": "赞一下我们", 
                    "key": "BTN_GOOD"
                }
            ]
        }, 
        {
            "name": "查询天气", 
            "sub_button": [
                {
                    "type": "click", 
                    "name": "武汉", 
                    "key": "BTN_TQ_WUHAN"
                }, 
                {
                    "type": "click", 
                    "name": "上海", 
                    "key": "BTN_TQ_SHANGHAI"
                }, 
                {
                    "type": "click", 
                    "name": "北京", 
                    "key": "BTN_TQ_BEIJING"
                }
            ]
        }, 
        {
            "type": "click", 
            "name": "帮助", 
            "key": "BTN_HELP"
        }
    ]
 		}';
		$url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$access_token;
		$result = $this->https_request($url, $jsonmenu);
		var_dump($result);
	}
	
	/**
	 * 请求
	 * add by yyb5683@gmail.com
	 * 2017年6月15日23:13:41
	 */
	function https_request($url,$data = null){
	    $curl = curl_init();
	    curl_setopt($curl, CURLOPT_URL, $url);
	    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
	    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
	   	if (!empty($data)){
		        curl_setopt($curl, CURLOPT_POST, 1);
		        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		}
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	    $output = curl_exec($curl);
	    curl_close($curl);
	    return $output;
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