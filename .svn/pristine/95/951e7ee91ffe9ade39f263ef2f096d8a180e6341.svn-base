<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 机器组模块
 */
class Ma_group_m extends CI_Model{
	public $tab;
	public function __construct(){
		parent::__construct();
		$this->tab='ma_group';
	}
	/**
	 * 添加机器组
	 */
	public function add_ma_group_m($a,$is_re_id='0'){
		if(!is_array($a)){
			return false;
		}
		$a['time']=date('Y-m-d H:i:s',time());
		$return=$this->db->insert($this->tab,$a);
		if($is_re_id!='0'){
			return $this->db->insert_id();
		}
		else{
			return $return;
		}
		
	}
	/**
	 * 项目列表数目
	 */
	public function getMaGroupListNum($where,$limit='')
	{
		if(!empty($limit)){
			$this->db->limit($limit);
		}
		$where['is_del']='1';
		$query=$this->db->get_where($this->tab,$where);
		$return=$query->num_rows();
		return $return;
	}
	/**
	 * 获得项目列表
	 *
	 */
	public function getMaGroupList($where,$num='0',$offer='0'){
		if($num!='0'){
			$this->db->limit($num,$offer);
		}
		$where['is_del']='1';
		$this->db->order_by('time','desc');
		$query=$this->db->get_where($this->tab,$where);
		$return=$query->result_array();
		return $return;
	}
	/**
	 * 检查项目名重复
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
	 * 更新机器组详情
	 *
	 * @param unknown_type $a
	 * @param unknown_type $where
	 * @return unknown
	 */
	public function updateMaGroup($a,$where){
		$a['time']=date('Y-m-d H:i:s',time());
		$query=$this->db->update($this->tab,$a,$where);
		if($query){
			return true;
		}
		else {
			return false;
		}
	}
	/**
	 * 删除
	 *
	 * @param unknown_type $id
	 * @return unknown
	 */
	public function delMaGroup($id){
		if(empty($id)){
			return false;
		}
		$where['id']=$id;
		$a['is_del']='0';
		$query=$this->db->update($this->tab,$a,$where);
		if($query){
			return true;
		}
		else {
			return false;
		}
	}
	/**
	 * 通过pid获得项目详细信息内容
	 *
	 * @param unknown_type $id
	 * @param unknown_type $where
	 * @return unknown
	 */
	public function getMaGroup($where=array()){
			$query=$this->db->get_where($this->tab,$where);
			$return=$query->result_array();
			if($query->num_rows()>0){
				return $return;
			}
			else{
				return  false;
			}
	}
	
}