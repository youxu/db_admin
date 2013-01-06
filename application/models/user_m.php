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
	public function updateUser($a,$where){
		if(is_array($a) && is_array($where)){
			$query=$this->db->update($this->tab,$a,$where);
			if($query){
				return true;
			}
			else {
				return false;
			}
		}
		else{
			return false;
		}
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
		$this->db->order_by('id','desc');
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
	 * 通过name获得password 为login验证
	 *
	 * @param unknown_type $username
	 * @return unknown
	 */
	public function getUserPassword($username){
		if(empty($username)){
			return false;
		}
		$query=$this->db->get_where($this->tab,array('name'=>$username));
		$row_arr=$query->row_array();
		if(empty($row_arr)){
			return false;
		}
		else{
			return $row_arr['password'];
		}
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
	/**
	 * 获得用户中文名通过id
	 *
	 * @param unknown_type $id
	 * @return unknown
	 */
	public function getUserChnameById($id){
		if(is_numeric($id) && $id>0){
			$where['id']=$id;
			$this->db->select('chname');
			$query=$this->db->get_where($this->tab,$where);
			$arr= $query->row_array();
			return $arr['chname'];
		}
		else{
			return false;
		}
	}
	/**
	 * 更新用户信息
	 *
	 * @param unknown_type $a
	 * @param unknown_type $where
	 * @return unknown
	 */
	public function updateUserInfo($a,$where=array()){
		if(is_array($where) && is_array($a)){
			$this->db->where($where);
			$query=$this->db->update($a);
			return $query;
		}else{
			return false;
		}
	}
	/**
	 * 检查用户名重复
	 *
	 * @param unknown_type $name
	 * @return unknown
	 */
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
	/**
	 * 通过username获得用户信息
	 *
	 * @param unknown_type $username
	 * @return unknown
	 */
	public function getUserInfoByName($username){
		if(!isset($username) || empty($username)){
			return false;
		}
		$where=array();
		$where['name']=$username;
		//$where['status']='1';
		$query=$this->db->get_where($this->tab,$where);
		return $query->row_array();
	}
	public function delUser($id){
		if(isset($id) && !empty($id)){
			$where['id']=$id;
			$a['is_del']='0';
			$query=$this->db->update($this->tab,$a,$where);
			return $query;
		}
		else{
			return false;
		}
	}
	public function update_logintime($name){
		$where['name']=$name;
		$time=date('Y-m-d H:i:s',time());
		$a['last_login']=$time;
		$this->db->update($this->tab,$a,$where);
	}
	
	
	
}
?>