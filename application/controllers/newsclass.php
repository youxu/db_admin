<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Newsclass extends CI_Controller {
	public $newsclass_m;
	public function __construct(){
		parent::__construct();
		$this->load->model('newsclass_m');
		if(!is_have_power('newsclass',se_item('user_mod_list'))){
			showmessage('您没有权限访问这个页面,请重新登录');
		}
	}
	/**
	 * 项目列表
	 *
	 */
	public function index(){

		$where=array();
		$num=$this->newsclass_m->getProjectListNum($where);
		if($_POST){
			$post=$this->input->post();
			$page=$post['post_page'];
		}
		else{
			$page=$this->uri->segment(3);
		}
		$this->load->library('pagination');
		$config['base_url'] = site_url().'/newsclass';
		$config['total_rows'] = $num;
		$config['per_page'] = 10; 
		$config['uri_segment'] = 3;
		//$config['page_query_string'] = true;
		$config['is_ajax'] = true;
		$config['script_fun'] = 'pagejump';
		$this->pagination->initialize($config); 
		$pager=$this->pagination->create_links();
		$userList=$this->newsclass_m->getProjetList($where,$config['per_page'],$page);
		if($_POST){
			$html='';
			$html_data[0]['userList']=$userList;
			$html_data[0]['pager']=$pager;
			echo json_encode($html_data);
			exit;
		}
		
		$data['userList']=$userList;
		$data['pager']=$pager;
		$data['css']=$this->config->item('admin_css');		
		$data['js']=$this->config->item('admin_js');
		$js_view=$this->config->item('view_js_url');
		array_push($data['css'],'/admin_style/css/Skins/Blue/jbox.css');
		array_push($data['js'],'/admin_style/js/jquery.jBox-2.3.min.js','/admin_style/js/i18n/jquery.jBox-zh-CN.js',$js_view.'newsclass_list.js');
		$this->load->view('admin/header',$data);
		$this->load->view('newsclass/newsclass_list');
		$this->load->view('admin/footer');
	}
	
	/**
	 * 添加分类信息
	 *
	 */
	public function add_newsclass(){	
		if($_POST){
			$post=$this->input->post();
			//检测分类名称是否为空
			if(!isset($post['name']) || empty($post['name'])){
				$return_array[0]['status']='0';
				$return_array[0]['message']='添加失败,项目名不能为空';
				echo json_encode($return_array);
				exit;
			}
			//分类是否重复
			$nums=$this->newsclass_m->isSameName($post['name']);
			if($nums>0){
				$return_array[0]['status']='0';
				$return_array[0]['message']='添加失败,项目名重复';
				echo json_encode($return_array);
				exit;
			}
			$return_array=array();
			$a=array();
			$a['name']=$post['name'];
			$a['pid']=$post['pid'];
			$return=$this->newsclass_m->add_newsclass_m($a);			
			if($return>0){	
				$return_array[0]['status']='1';
				$return_array[0]['message']='添加成功';
				echo json_encode($return_array);
				exit;
			}
			else{
				$return_array[0]['status']='0';
				$return_array[0]['message']='添加失败,请检查数据';
				echo json_encode($return_array);
				exit;
			}
		}
		else{
			$all_class=$this->newsclass_m->getNewsclassP();
			$this->load->library('newsclass_l');
			$new_all_class=$this->newsclass_l->newArrForClass($all_class,'','1');
			$data['new_all_class']=$new_all_class;
			$data['css']=$this->config->item('admin_css');		
			$data['js']=$this->config->item('admin_js');
			$js_view=$this->config->item('view_js_url');
			array_push($data['css'],'/admin_style/css/Skins/Blue/jbox.css');
			array_push($data['js'],'/admin_style/js/jquery.jBox-2.3.min.js','/admin_style/js/i18n/jquery.jBox-zh-CN.js','/admin_style/js/jquery.validate.js','/admin_style/js/jquery.metadata.js',$js_view.'add_newsclass.js');
			$this->load->view('admin/header',$data);
			$this->load->view('newsclass/add_newsclass');
			$this->load->view('admin/footer');
		}
	}
	/**
	 * 更新分类
	 *
	 * @param unknown_type $id
	 * @return unknown
	 */
		public function update_newsclass($id=''){
		$where=array();
		if($_POST){
			$post=$this->input->post();
			
			$a=array();
			$return_array=array();
			
			$id=$post['id'];
			$where['id']=$id;
			$a['name']=$post['name'];
			$a['pid']=$post['pid'];
			$return=$this->newsclass_m->update_project($a,$where);
			if($return){
				$return_array[0]['status']='1';
				$return_array[0]['message']='更新成功';
				echo json_encode($return_array);
				exit;
			}
			else{
				$return_array[0]['status']='0';
				$return_array[0]['message']='更新失败,请检查数据';
				echo json_encode($return_array);
				exit;
			}
		}
		else{
			if (empty($id)) {
				return false;
			}
			

			$newsclass_info=$this->newsclass_m->getProject($id);
			$all_class=$this->newsclass_m->getNewsclassP();
			$this->load->library('newsclass_l');
			$new_all_class=$this->newsclass_l->newArrForClass($all_class,$newsclass_info['pid'],'1');
			$data['newsclass_info']=$newsclass_info;
			$data['new_all_class']=$new_all_class;
			$data['css']=$this->config->item('admin_css');		
			$data['js']=$this->config->item('admin_js');
			$js_view=$this->config->item('view_js_url');
			array_push($data['css'],'/admin_style/css/Skins/Blue/jbox.css');
			array_push($data['js'],'/admin_style/js/jquery.jBox-2.3.min.js','/admin_style/js/i18n/jquery.jBox-zh-CN.js','/admin_style/js/jquery.validate.js','/admin_style/js/jquery.metadata.js',$js_view.'update_newsclass.js');
			$this->load->view('admin/header',$data);
			$this->load->view('newsclass/update_newsclass');
			$this->load->view('admin/footer');
		}
	}
	/**
	 * 添加项目详细信息
	 *
	 * @param unknown_type $pid
	 */
	public function add_project_info($pid=''){
		if(!empty($pid)){
			$data['h_pid']=$pid;
			$where['pid']=$pid;
			$project_info=$this->newsclass_m->getProjectInfoByPid($pid);
			$data['project_info']=$project_info;
		}
		if($_POST){
			
			$post=$this->input->post();
			
			//检测项目名称是否为空
			if(empty($post['project_info_name']) || empty($post['ma_group']) || empty($post['d_port']) || empty($post['d_name']) || empty($post['d_psd']) || empty($post['database'])){
				$return_array[0]['status']='0';
				$return_array[0]['message']='添加失败,名称,机器组,端口,数据库用户名,数据库密码,数据库名都不能为空';
				echo json_encode($return_array);
				exit;
			}
			//项目名称是否重复
			$nums=$this->newsclass_m->isSameProInfoName($post['project_name'],$post['pid']);
			if($nums>0){
				$return_array[0]['status']='0';
				$return_array[0]['message']='添加失败,名称重复';
				echo json_encode($return_array);
				exit;
			}
			$return_array=array();
			$a=array();
			$a['name']=$post['project_info_name'];
			$a['pid']=$post['pid'];
			$a['ma_group']=$post['ma_group'];
			$a['d_port']=$post['d_port'];
			$a['database']=$post['database'];
			$a['d_name']=$post['d_name'];
			$a['d_psd']=$post['d_psd'];
			$a['status']=$post['status'];
			$return=$this->newsclass_m->addProjectInfo($a,$is_have_id='1');			
			if($return>0){	
				$return_array[0]['status']='1';
				$return_array[0]['message']='添加成功';
				$return_array[0]['insert_id']=$return;
				echo json_encode($return_array);
				exit;
			}
			else{
				$return_array[0]['status']='0';
				$return_array[0]['message']='添加失败,请检查数据';
				echo json_encode($return_array);
				exit;
			}
		}
		else{
			//获得项目列表
			$where=array('status'=>1);
			$project_list=$this->newsclass_m->getProjetList($where);
			$this->load->model('ma_group_m');
			$ma_group_where['is_del'] ='1';
			$ma_group_where['status'] ='1';
			$ma_group_list=$this->ma_group_m->getMaGroupList($ma_group_where);
			$data['project_list']=$project_list;
			$data['ma_group_list']=$ma_group_list;
			$data['css']=$this->config->item('admin_css');		
			$data['js']=$this->config->item('admin_js');
			$js_view=$this->config->item('view_js_url');
			array_push($data['css'],'/admin_style/css/Skins/Blue/jbox.css');
			array_push($data['js'],'/admin_style/js/jquery.jBox-2.3.min.js','/admin_style/js/i18n/jquery.jBox-zh-CN.js','/admin_style/js/jquery.validate.js','/admin_style/js/jquery.metadata.js',$js_view.'add_project_info.js');
			$this->load->view('admin/header',$data);
			$this->load->view('project/add_project_info');
			$this->load->view('admin/footer');
		}
	}
	public function update_project_info($id=''){
		if($_POST){
			$post=$this->input->post();	
			$a=array();
			$return_array=array();
			$id=$post['id'];
			$where['id']=$id;
			$a['name']=$post['name'];
			$a['ma_group']=$post['ma_group'];
			$a['d_port']=$post['d_port'];
			$a['d_name']=$post['d_name'];
			$a['d_psd']=$post['d_psd'];
			$a['database']=$post['database'];
			$a['status']=$post['status'];
			$return=$this->newsclass_m->update_project_info($a,$where);
			if($return){
				$return_array[0]['status']='1';
				$return_array[0]['message']='更新成功';
				echo json_encode($return_array);
				exit;
			}
			else{
				$return_array[0]['status']='0';
				$return_array[0]['message']='更新失败,请检查数据';
				echo json_encode($return_array);
				exit;
			}
		}
		else{
			if(empty($id)){
				return false;
			}
			//获得项目列表
			$where=array('id'=>$id);
			$project_info_list=$this->newsclass_m->getProjectInfoById($where);
			$this->load->model('ma_group_m');
			$ma_group_where['is_del'] ='1';
			$ma_group_where['status'] ='1';
			$ma_group_list=$this->ma_group_m->getMaGroupList($ma_group_where);

			//print_r($project_list);
			$data['project_info_list']=$project_info_list['0'];
			$data['ma_group_list']=$ma_group_list;
			$data['css']=$this->config->item('admin_css');		
			$data['js']=$this->config->item('admin_js');
			$js_view=$this->config->item('view_js_url');
			array_push($data['css'],'/admin_style/css/Skins/Blue/jbox.css');
			array_push($data['js'],'/admin_style/js/jquery.jBox-2.3.min.js','/admin_style/js/i18n/jquery.jBox-zh-CN.js','/admin_style/js/jquery.validate.js','/admin_style/js/jquery.metadata.js',$js_view.'update_project_info.js');
			$this->load->view('admin/header',$data);
			$this->load->view('project/update_project_info');
			$this->load->view('admin/footer');
		}
	}
	public function del_newsclass(){
		if($_POST){
			$post=$this->input->post();
			if(empty($post['id']))
			{
				return false;
			}
			$return_array=array();
			$id=$post['id'];
			$is_have_son=$this->newsclass_m->is_have_son($id);
			if(!$is_have_son){
				$return_array[0]['status']='0';
				$return_array[0]['message']='删除失败,该类别下面还有子类，不能删除';
				echo json_encode($return_array);
				exit();
			}
			$query=$this->newsclass_m->delProject($id);
			if($query){
				$return_array[0]['status']='1';
				$return_array[0]['message']='删除成功';
				echo json_encode($return_array);
				exit;
			}
			else{
				$return_array[0]['status']='0';
				$return_array[0]['message']='删除失败,请检查数据';
				echo json_encode($return_array);
				exit;
			}
		}
		else{
			$return_array[0]['status']='0';
			$return_array[0]['message']='数据错误';
			echo json_encode($return_array);
			exit;
		}
	}
	
}