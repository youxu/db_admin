<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 新闻分类
 */
class Newsclass_m extends CI_Model{
	public $tab;
	public $info_tab;
	public function __construct(){
		parent::__construct();
		$this->tab='newsclass';
		//$this->info_tab='project_info';
	}
	/**
	 *添加分类
	 */
	public function add_newsclass_m($a){
		if(!is_array($a)){
			return false;
		}
		$path=$this->_getPath($a['pid']);
		$a['path']=$path;
		//$a['time']=date('Y-m-d H:i:s',time());
		$return=$this->db->insert($this->tab,$a);
		return $return;
	}
	public function update_project($a,$where){
		$path=$this->_getPath($a['pid']);
		$a['path']=$path;
		$query=$this->db->update($this->tab,$a,$where);
		if($query){
			return true;
		}
		else {
			return false;
		}
	}
	public function update_project_info($a,$where){
		$a['time']=date('Y-m-d H:i:s',time());
		$query=$this->db->update($this->info_tab,$a,$where);
		if($query){
			return true;
		}
		else {
			return false;
		}
	}
	/**
	 * 添加项目详细信息
	 */
	public function addProjectInfo($a,$is_re_id='0'){
		if(!is_array($a)){
			return false;
		}
		$a['time']=date('Y-m-d H:i:s',time());
		$return=$this->db->insert($this->info_tab,$a);
		if($is_re_id!='0'){
			return $this->db->insert_id();
		}
		else{
			return $return;
		}
		
	}
	public function getNewsclassP(){
		$sql="SELECT  `id` ,  `name` ,  `pid` , `path` ,CONCAT( path,  '-', id ) AS abspath
		FROM (
		`newsclass`
		)
		WHERE  `status` =  '1'
		AND  `is_del` =  '1'
		ORDER BY  `abspath` 
		";
		$query=$this->db->query($sql);
		return $query->result_array();
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
	 * 检查项目详细名重复
	 *
	 * @param unknown_type $name
	 * @return unknown
	 */
	public function isSameProInfoName($name,$pid){
		if (isset($name) && !empty($name)) {
			$post['name']=$name;
			$post['pid']=$pid;
			$this->db->select('id');
			$query=$this->db->get_where($this->info_tab,$post);
			$num=$query->num_rows();
			return $num;
		}
		else{
			return false;
		}
		
	}
	/**
	 * 获得分类列表
	 *
	 */
	public function getProjetList($where,$num='0',$offer='0'){
		if($num!='0'){
			$this->db->limit($num,$offer);
		}
		$where['is_del']='1';
		$this->db->order_by('path','desc');
		
		$query=$this->db->get_where($this->tab,$where);
		$return=$query->result_array();
		return $return;
	}
	/**
	 * 通过id获得分类详细信息
	 *
	 * @param unknown_type $id
	 * @param unknown_type $where
	 * @return unknown
	 */
	public function getProjectInfoByPid($pid,$where=array()){
		if(!empty($pid) && is_numeric($pid)){
			$where['pid']=$pid;
			$query=$this->db->get_where($this->tab,$where);
			$return=$query->result_array();
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
	/**
	 * 通过id获得项目详细信息内容
	 *
	 * @param unknown_type $id
	 * @param unknown_type $where
	 * @return unknown
	 */
	public function getProjectInfoById($where=array()){
		$query=$this->db->get_where($this->info_tab,$where);
		$return=$query->result_array();
		if($query->num_rows()>0){
			return $return;
		}
		else{
			return  false;
		}
	}
	/**
	 * 分类列表数目
	 */
	public function getProjectListNum($where,$limit='')
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
	public function delProject($id){
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
	public function is_have_son($id){
		if(empty($id)){
			return false;
		}
		else{
			$where['pid']=$id;
			$query=$this->db->get_where($this->tab,$where);

			if($query->num_rows()>0){
				return false;
			}
			else{
				return true;
			}
		}
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
	public function getTree($pid){
		if($pid=='source'){
			$pid='0';
		}
		$query=$this->db->get_where($this->tab,array('pid'=>$pid));
		
		return $query->result_array();
	}
}