<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 模块
 */
class menu_m extends CI_Model{
	public $tab;
	public function __construct(){
		parent::__construct();
		$this->tab='menu';
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
		$path=$this->_getPath($a['pid']);
		$a['path']=$path;
		//$a['time']=date('Y-m-d H:i:s',time());
		$return=$this->db->insert($this->tab,$a);
		return $return;
	}
	/**
	 * 模块列表数目
	 */
	public function getModListNum($where,$pid='0',$limit='')
	{
		if(!empty($limit)){
			$this->db->limit($limit);
		}

		$where['is_del']='1';
		$where['pid']=$pid;
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
		$this->db->select('menu.id,menu.name,menu.status,menu.is_del,menu.pid,menu.order_num,menu.menu_url,a.name as pid_name');
		$this->db->join('menu as a', 'menu.pid = a.id','left');
		$where['menu.is_del']='1';
		$this->db->order_by('menu.order_num','asc');
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
	public function updateMenu($a,$where){
		//$a['time']=date('Y-m-d H:i:s',time());
		$query=$this->db->update($this->tab,$a,$where);
		if($query){
			return true;
		}
		else {
			return false;
		}
	}
	public function isHaveSon($id){
		if(empty($id)){
			return false;
		}
		$this->db->select('id');
		$query=$this->db->get_where($this->tab,array('pid'=>$id));
		if($query->num_rows()>0){
			return false;
		}
		else{
			return true;
		}
	}
	public function delMenu($id){
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
	public function orderNum($new_arr){
			foreach ($new_arr as $k=>$v){
				$this->db->update($this->tab,array('order_num'=>$v),array('id'=>$k));
			}			
	}
	public function getMenuTree(){
		$sql="SELECT  `id` ,  `name` ,  `pid` , `path` ,CONCAT( path,  '-', id ) AS abspath
		FROM (
		`menu`
		)
		WHERE  `status` =  '1'
		AND  `is_del` =  '1'
		ORDER BY  `abspath` 
		";
		$query=$this->db->query($sql);
		return $query->result_array();
	}
	public function _getPath($pid){
		if($pid == '0'){
			$path='0';
		}
		else{
			$pathinfo=$this->getProject($pid);
			if(!empty($pathinfo)){
				$path=$pathinfo['path'].'-'.$pathinfo['id'];
			}
			else{
				$path='0';
			}
		}
		return $path;
	}
	/**
	 * 获得分类信息
	 *
	 * @param unknown_type $id
	 * @return unknown
	 */
	public function getProject($id){
		if(!empty($id)){
			$where['id']=$id;
			$this->db->limit('1');
			$query=$this->db->get_where($this->tab,$where);
			if($query->num_rows()>0){
				return $query->row_array();
			}
			else{
				return false;
			}
		}
		else{
			return false;
		}
	}
}
?>