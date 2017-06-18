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
		$this->load->model("common_model");
	}
	
	/**
	 * 首页
	 * add by yyb5683@gmail.com
	 * 2017年6月17日16:46:58
	 */
	public function index(){
		//查询我的文章
		$params = array (
				'table' => 'blog',
				'select' => 'id,titles,classify,content,created,status,user_id',
				'order' => 'created',
				'order_type' => 'DESC',
				'where' => array('status' => 2),
				'limit' => -1
		);
		//我的文章
		$list = $this->common_model->get_list($params);
		//查询文章分类
		$ClassList = $this->common_model->get_Classification();
		//查询发表文章的用户
		$userlist = $this->common_model->get_UserList();
		$this->template['ClassList'] = $ClassList;
		$this->template['List'] = $list;
		$this->template['userlist'] = $userlist;
		$this->load->view("blog/index",$this->template);
	}
} 