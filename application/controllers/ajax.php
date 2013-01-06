<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller {
	function __construct(){
		parent::__construct();
	}
	function index(){
	
	}
	/**
	 * 检查用户名和是否相同
	 *
	 */
	function is_same_username(){
		$post=$this->input->post();
		if(isset($post['old_name'])){
			if($post['name'] == $post['old_name']){
				echo "true";
				exit;
			}
		}
		
		if(isset($post['name']) && !empty($post['name'])){
			$this->load->model('user_m');
			$nums=$this->user_m->isSameName($post['name']);
			if($nums>0){
				echo "false";
			}
			else{
				echo "true";
			}
		}
	}
	/**
	 * 检查模块名重复
	 *
	 */
	function is_same_mod_name(){
		$post=$this->input->post();
		if(isset($post['old_name'])){
			if($post['name'] == $post['old_name']){
				echo "true";
				exit;
			}
		}
		
		if(isset($post['name']) && !empty($post['name'])){
			$this->load->model('mod_m');
			$nums=$this->mod_m->isSameName($post['name']);
			if($nums>0){
				echo "false";
			}
			else{
				echo "true";
			}
		}
	}
	/**
	 * 检查模块名重复
	 *
	 */
	function is_same_menu_name(){
		$post=$this->input->post();
		if(isset($post['old_name'])){
			if($post['name'] == $post['old_name']){
				echo "true";
				exit;
			}
		}
		
		if(isset($post['name']) && !empty($post['name'])){
			$this->load->model('menu_m');
			$nums=$this->menu_m->isSameName($post['name']);
			if($nums>0){
				echo "false";
			}
			else{
				echo "true";
			}
		}
	}
	/**
	 * 检查是否有相同的项目组名称
	 *
	 */
	function is_same_pgroupname(){
		$post=$this->input->post();
		if(isset($post['old_name'])){
			if($post['name'] == $post['old_name']){
				echo "true";
				exit;
			}
		}
		if(isset($post['name']) && !empty($post['name'])){
			$this->load->model('link_m');
			$nums=$this->link_m->isSameName($post['name']);
			if($nums>0){
				echo "false";
			}
			else{
				echo "true";
			}
		}
	}
	/**
	 * 检查项目名和是否相同
	 *
	 */
	function is_same_pro_name(){
		$post=$this->input->post();
		if(isset($post['name']) && !empty($post['name'])){
			$this->load->model('newsclass_m');
			//更新操作的时候，如果old_name不为空，那么当oldname == name 时候不验证，不判重
			if(isset($post['old_name']) && !empty($post['old_name'])){
				if($post['old_name'] == $post['name']){
					echo "true";
					exit;
				}
				else{
					$nums=$this->newsclass_m->isSameName($post['name']);
					if($nums>0){
						echo "false";
						exit;
					}
					else{
						echo "true";
						exit;
					}
				}
				
			}
			else{
				$nums=$this->newsclass_m->isSameName($post['name']);
				if($nums>0){
					echo "false";
					exit;
				}
				else{
					echo "true";
					exit;
				}
			}
				
		}
	}
	
	/**
	 * 检查机器组名是否相同
	 *
	 */
	function is_same_ma_group_name(){
		$post=$this->input->post();
		if(isset($post['name']) && !empty($post['name'])){
			$this->load->model('ma_group_m');
			//更新操作的时候，如果old_name不为空，那么当oldname == name 时候不验证，不判重
			if(isset($post['old_name']) && !empty($post['old_name'])){
				if($post['old_name'] == $post['name']){
					echo "true";
					exit;
				}
				else{
					$nums=$this->ma_group_m->isSameName($post['name']);
					if($nums>0){
						echo "false";
						exit;
					}
					else{
						echo "true";
						exit;
					}
				}
				
			}
			else{
				$nums=$this->ma_group_m->isSameName($post['name']);
				if($nums>0){
					echo "false";
					exit;
				}
				else{
					echo "true";
					exit;
				}
			}
				
		}
	}
	
	/**
	 * 检测项目详细内容名称是否相同
	 *
	 */
	public function is_same_pro_info_name(){
		$post=$this->input->post();
		if(isset($post['old_name']) && !empty($post['old_name'])){
			if($post['name'] == $post['old_name']){
				echo "true";
				exit;
			}
			else{
				$this->load->model('project_m');
				$nums=$this->project_m->isSameProInfoName($post['name'],$post['pid']);
				if($nums>0){
					echo "false";
					exit;
				}
				else{
					echo "true";
					exit;
				}
			}
			
		}
		else{
			$this->load->model('project_m');
				$nums=$this->project_m->isSameProInfoName($post['name'],$post['pid']);
				if($nums>0){
					echo "false";
					exit;
				}
				else{
					echo "true";
					exit;
				}
		}
	}
	/**
	 * 获得项目详细信息
	 */
	public function get_project_info_bypid(){
		$post=$this->input->post();
		if(isset($post['id']) && !empty($post['id'])){
			$this->load->model('project_m');
			$info=$this->project_m->getProjectInfoByPid($post['id']);
			if($info){
				echo json_encode($info);
			}
			else{
				echo -1;

			}
		}
	}
	/**
	 * 获得项目详细信息通过id
	 */
	public function get_project_info_by_id(){
		$post=$this->input->post();
		if(isset($post['id']) && !empty($post['id'])){
			$this->load->model('project_m');
			$where['id']=$post['id'];
			$info=$this->project_m->getProjectInfoById($where);
			if($info){
				echo json_encode($info['0']);
			}
			else{
				echo -1;

			}
		}
	}
	/**
	 * 获得用户列表
	 *
	 * @return unknown
	 */
	public function get_username(){
		$get=$this->input->get();
		if(!isset($get['q']) || empty($get['q'])){
			return false;
		}
		$sql="SELECT id,name,chname FROM user where (name like '%".$get['q']."%' or chname like '%".$get['q']."%') and status ='1' and is_del='1' limit ".$get['limit']."";
		$query=$this->db->query($sql);
		
		$user_list=$query->result_array();

		echo json_encode($user_list);
	}
}
?>