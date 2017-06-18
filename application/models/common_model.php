<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 通用model类
 * add by yyb5683@gmail.com
 * 2015年12月10日20:08:11
 */
class Common_model extends MY_Model{

	public function __construct(){
		parent::__construct();
	}
	
	/**
	 * 获取文章分类
	 * add by yyb5683@gmail.com
	 * 2017年6月18日13:39:58
	 */
	public function get_Classification(){
		$params = array (
			 'table' => 'classify',
			 'select' => 'id,aname',
			 'limit' => -1
		);
		//整理数据
		$list = $this->get_list($params);
		foreach ($list as $key => $val){
			$_list[$val['id']] = $val;
		}
		return $_list;
	}
	

	/**
	 * 获取用户
	 * add by yyb5683@gmail.com
	 * 2017年6月18日15:56:39
	 */
	public function get_UserList(){
		$params = array (
				'table' => 'auth',
				'select' => 'id,uname',
				'limit' => -1
		);
		$list = $this->get_list($params);
		//整理数据
		foreach ($list as $key => $val){
			$_list[$val['id']] =$val;
		}
		return $_list;
	}
}