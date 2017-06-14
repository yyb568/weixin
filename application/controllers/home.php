<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 后台管理首页
 * add by yyb5683@gmail.com
 * 2017年6月12日16:31:04
 */
class Home extends MY_Controller{
	/**
	 * 初始化
	 * add by yyb5683@gmail.com
	 * 2017年6月12日16:32:00
	 */
	public function __construct(){
		parent::__construct();
	}
	
	/**
	 * 管理首页面
	 * add by  yyb5683@gmail.com
	 * 2017年6月12日16:32:21
	 */
	public function index(){
		$this->load->view("main/index",$this->template);
	}
	
} 