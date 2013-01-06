<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 模块
 */
class mod_m extends CI_Model{
	public $tab;
	public function __construct(){
		parent::__construct();
		$this->tab='model';
	}
	/**
	 * 检查模块名重复
	 *
	 * @param unknown_type $name
	 * @return unknown
	 */
	public function isSameName($name){
		if (isset($name) && !empty($name)) {
			$post['name']=$name;
			$this->db->select('id');
			$post['is_del']='1';
			$query=$this->db->get_where($this->tab,$post);
			$num=$query->num_rows();
			return $num;
		}
		else{
			return false;
		}
		
	}
	/**
	 * 添加模块
	 */
	public function addMod($a){
		if(!is_array($a)){
			return false;
		}
		$a['time']=date('Y-m-d H:i:s',time());
		$return=$this->db->insert($this->tab,$a);
		return $return;
	}
	/**
	 * 模块列表数目
	 */
	public function getModListNum($where,$limit='')
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
	 * 获得模块列表
	 *
	 */
	public function getModList($where,$num='0',$offer='0'){
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
	 * 通过id获得模块详细信息内容
	 *
	 * @param unknown_type $id
	 * @param unknown_type $where
	 * @return unknown
	 */
	public function getModInfoById($id){
		if(!empty($id) && is_numeric($id)){
			$where['id']=$id;
			$where['is_del']='1';
			$query=$this->db->get_where($this->tab,$where);
			$return=$query->row_array();
			if($query->num_rows()>0){
				return $return;
			}
			else{
				return  false;
			}
		}
		else{
			return false;
		}
	}
	public function updateMod($a,$where){
		$a['time']=date('Y-m-d H:i:s',time());
		$query=$this->db->update($this->tab,$a,$where);
		if($query){
			return true;
		}
		else {
			return false;
		}
	}
	public function delMod($id){
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
	
	
}
?>