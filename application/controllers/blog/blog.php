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
				'select' => 'id,titles,classify,content,created,status,user_id,pviews',
				'order' => 'created',
				'order_type' => 'DESC',
				'where' => array('status' => 2),
				'limit' => -1
		);
		//我的文章
		$list = $this->common_model->get_list($params);
		//我的文章个数
		$params['total'] = true;
		$total = $this->common_model->get_list($params);
		//查询文章分类
		$ClassList = $this->common_model->get_Classification();
		//查询发表文章的用户
		$userlist = $this->common_model->get_UserList();
		$this->template['ClassList'] = $ClassList;
		$this->template['List'] = $list;
		$this->template['total'] = $total;
		$this->template['userlist'] = $userlist;
		$this->load->view("blog/index",$this->template);
	}
	
	/**
	 * 详情页
	 * add by yyb5683@gmail.com
	 * 2017年6月17日16:46:58
	 */
	public function info($id = 0){
		$params = array (
				'table' => 'blog',
				'select' => 'id,content,titles,created',
				'where' => array('id' => $id),
				'limit' => 1
		);
	 	$info = $this->common_model->get_list($params);
	 	//记录商品浏览量
	 	$this->_history($id);
	 	
	 	$this->template['info'] = $info;
	 	$this->load->view("blog/info",$this->template);
	}
	
	/**
	 * 记录文章浏览量
	 * add by yyb5683@gmail.com
	 * 2017年5月8日09:54:32
	 */
	public function _history($data = 0){
		//判断cookie类里面是否有浏览记录
		if ($_COOKIE['history']){
			$history = unserialize($_COOKIE['history']);
			if (!in_array($data,$history)){
				//当cookie里没有的时候才加入
				$params = array(
						'table' => 'blog',
						'select' => 'id,pviews',
						'where' => array('id' => $data),
						'limit' => 1
				);
				$info = $this->common_model->get_list($params);
				$info['pviews'] += 1;
				$sql ="update yb_blog set pviews = {$info['pviews']} where id = {$data}";
				$this->common_model->query($sql);
				array_unshift($history, $data); //将没有的id加入
			}
			//去除重复记录
			$rows = array();
			foreach ($history as $v){
				if (in_array($v, $rows)){
					continue;
				}
				$rows[] = $v;
			}
			setcookie('history', serialize($rows),time()+(3600*24*100), '/');
		}else{
			//用户刚进来什么都没有
			$params = array(
					'table' => 'blog',
					'select' => 'id,pviews',
					'where' => array('id' => $data),
					'limit' => 1
			);
			$info = $this->common_model->get_list($params);
			$info['pviews'] += 1;
			$sql ="update yb_blog set pviews = {$info['pviews']} where id = {$data}";
			$this->common_model->query($sql);
				
			$history = serialize(array($data));
			setcookie('history', $history,time()+(3600*24*100), '/');
		}
	}
} 