<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 我的博客
 * add by yyb5683@gmail.com
 * 2017年6月17日16:44:33
 */
class Blog extends MY_Controller{
	
	/**
	 * 初始化
	 * add by yyb5683@gmail.com
	 * 2017年6月17日16:45:58
	 */
	public function __construct(){
		parent::__construct();
	}
	
	/**
	 * 首页
	 * add by yyb5683@gmail.com
	 * 2017年6月17日16:46:58
	 */
	public function index (){
		$this->load->view("blog/index",$this->template);
	}
} 