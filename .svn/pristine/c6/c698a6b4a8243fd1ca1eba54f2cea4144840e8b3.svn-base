<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 用户模块
 */
class User_m extends CI_Model{
	public $tab;

	function __construct(){
		parent::__construct();
		$this->tab='user';

	}
	/**
	 * 添加用户
	 */
	public function add_user_m($a){
		if(!is_array($a)){
			return false;
		}
		$return=$this->db->insert($this->tab,$a);
		return $return;
	}
	/**
	 * 用户列表
	 *
	 * @param unknown_type $where
	 * @param unknown_type $limit
	 * @return unknown
	 */
	public function getUserList($where,$num,$offer='0')
	{
		$query=$this->db->get_where($this->tab,$where,$num,$offer);
		$return=$query->result_array();
		return $return;
	}
	/**
	 * 用户列表数目
	 */
	public function getUserListNum($where,$limit='')
	{
		if(!empty($limit)){
			$this->db->limit($limit);
		}
		$query=$this->db->get_where($this->tab,$where);
		$return=$query->num_rows();
		return $return;
	}
	/**
	 * 获得用户信息
	 *
	 * @param unknown_type $id
	 * @return unknown
	 */
	public function getUserInfoById($id){
		if(is_numeric($id) && $id>0){
			$where['id']=$id;
			$query=$this->db->get_where($this->tab,$where);
			return $query->result_array();
		}
		else{
			return false;
		}
	}
	public function updateUserInfo($a,$where=array()){
		if(is_array($where) && is_array($a)){
			$this->db->where($where);
			$query=$this->db->update($a);
			return $query;
		}else{
			return false;
		}
	}
	public function isSameName($name){
		if (isset($name) && !empty($name)) {
			$post['name']=$name;
			
			$this->db->select('id');

			$query=$this->db->get_where($this->tab,$post);
			$num=$query->num_rows();
			return $num;
		}
		else{
			return false;
		}
		
	}
	
	
	
}
?>