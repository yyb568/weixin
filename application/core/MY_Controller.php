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
	
	/**
	 * 常量变量定义
	 */
	public $template = array();			//模板数据
	
	/**
	 * 初始化操作
	 * add by yyb5683@gmail.com
	 * 2015年12月10日11:34:15
	 */
	public function __construct(){echo '1';die;
		parent::__construct();
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