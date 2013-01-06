<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class User extends CI_Controller {
	public $user_m;
	public function __construct(){
		parent::__construct();
		$this->load->model('user_m');
		if(!is_have_power('user',se_item('user_mod_list'))){
			showmessage('您没有权限访问这个页面,请重新登录');
		}
	}
	public function index(){
		$where=array();
		$where['is_del']='1';
		$num=$this->user_m->getUserListNum($where);
		if($_POST){
			$post=$this->input->post();
			$page=$post['post_page'];
		}
		else{
			$page=$this->uri->segment(3);
		}
		$this->load->library('pagination');
		$config['base_url'] = site_url().'/user/index';
		$config['total_rows'] = $num;
		$config['per_page'] = 10; 
		$config['uri_segment'] = 3;
		//$config['page_query_string'] = true;
		$config['is_ajax'] = true;
		$config['script_fun'] = 'pagejump';
		$this->pagination->initialize($config); 
		$pager=$this->pagination->create_links();
		$userList=$this->user_m->getUserList($where,$config['per_page'],$page);
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
		array_push($data['js'],'/admin_style/js/jquery.jBox-2.3.min.js','/admin_style/js/i18n/jquery.jBox-zh-CN.js',$js_view.'user/user_list.js');
		$this->load->view('admin/header',$data);
		$this->load->view('user/user_list');
		$this->load->view('admin/footer');
	}
	public function add_user(){
		$post=$this->input->post();
		if($post){
			//检测项目名称是否为空
			if(!isset($post['name']) || empty($post['name'])){
				$return_array[0]['status']='0';
				$return_array[0]['message']='添加失败,用户名不能为空';
				echo json_encode($return_array);
				exit;
			}
			//项目名称是否重复
			$nums=$this->user_m->isSameName($post['name']);
			if($nums>0){
				$return_array[0]['status']='0';
				$return_array[0]['message']='添加失败,用户名重复';
				echo json_encode($return_array);
				exit;
			}
			$return_array=array();
			$a=array();
			$a['name']=$post['name'];
			$a['chname']=$post['chname'];
			$a['status']=$post['status'];
			$return=$this->user_m->add_user_m($a);			
			if($return){	
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
			$data['css']=$this->config->item('admin_css');		
			$data['js']=$this->config->item('admin_js');
			$js_view=$this->config->item('view_js_url');
			array_push($data['css'],'/admin_style/css/Skins/Blue/jbox.css');
			array_push($data['js'],'/admin_style/js/jquery.jBox-2.3.min.js','/admin_style/js/i18n/jquery.jBox-zh-CN.js','/admin_style/js/jquery.validate.js','/admin_style/js/jquery.metadata.js',$js_view.'user/add_user.js');
			$this->load->view('admin/header',$data);
			$this->load->view('user/add_user');
			$this->load->view('admin/footer');
		}
	}
	public function update_user($id=''){
		$where=array();
		if($_POST){
			$post=$this->input->post();
			$a=array();
			$return_array=array();
			$id=$post['id'];
			$where['id']=$id;
			$a['name']=$post['name'];
			$a['chname']=$post['chname'];
			$a['status']=$post['status'];
			$return=$this->user_m->updateUser($a,$where);
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
			$userInfo=$this->user_m->getUserInfoById($id);
			
			$data['userInfo']=$userInfo['0'];
			$data['css']=$this->config->item('admin_css');		
			$data['js']=$this->config->item('admin_js');
			$js_view=$this->config->item('view_js_url');
			array_push($data['css'],'/admin_style/css/Skins/Blue/jbox.css');
			array_push($data['js'],'/admin_style/js/jquery.jBox-2.3.min.js','/admin_style/js/i18n/jquery.jBox-zh-CN.js','/admin_style/js/jquery.validate.js','/admin_style/js/jquery.metadata.js',$js_view.'user/update_user.js');
			$this->load->view('admin/header',$data);
			$this->load->view('user/update_user');
			$this->load->view('admin/footer');
		}
	}
	public function del_user(){
		if($_POST){
			$post=$this->input->post();
			if(empty($post['id']))
			{
				return false;
			}
			$return_array=array();
			$id=$post['id'];
			$query=$this->user_m->delUser($id);
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
	/**
	 * 分配用户项目
	 *
	 */
	public function user_project($id=''){
		$post=$this->input->post();
		if($post){
			$a=array();
			$return_array=array();
			$u_id=$post['u_id'];
			$where['id']=$u_id;
			$project_id=substr($post['project_id'],0,-1);
			$a['project_id']=$project_id;
			$return=$this->user_m->updateUser($a,$where);
			if($return){
				$return_array[0]['status']='1';
				$return_array[0]['message']='分配项目成功';
				echo json_encode($return_array);
				exit;
			}
			else{
				$return_array[0]['status']='0';
				$return_array[0]['message']='失败,请检查数据';
				echo json_encode($return_array);
				exit;
			}
		}
		else{
			if(empty($id)){
				showmessage('数据错误');
			}
			$data['project_id_list']=array();
			$user_info=$this->user_m->getUserInfoById($id);
			if(!empty($user_info['0'])){
				$project_id=$user_info['0']['project_id'];
				$project_id_list=explode(',',$project_id);
				$data['project_id_list']=$project_id_list;
			}
			else{
				showmessage('没有这个用户','/index.php/user/');
			}
			$this->load->model('project_m');
			$where_project['status']='1';
			$where_project['is_del']='1';
			$project_list=$this->project_m->getProjetList($where_project);
			$data['user_info']=$user_info['0'];
			$data['project_list']=$project_list;
			$data['css']=$this->config->item('admin_css');		
			$data['js']=$this->config->item('admin_js');
			$js_view=$this->config->item('view_js_url');
			array_push($data['css'],'/admin_style/css/Skins/Blue/jbox.css');
			array_push($data['js'],'/admin_style/js/jquery.jBox-2.3.min.js','/admin_style/js/i18n/jquery.jBox-zh-CN.js','/admin_style/js/jquery.validate.js','/admin_style/js/jquery.metadata.js',$js_view.'user/user_project.js');
			$this->load->view('admin/header',$data);
			$this->load->view('user/user_project');
			$this->load->view('admin/footer');
		}
	}
	/**
	 * 分配权限
	 *
	 */
	public function user_root($id=''){
		$post=$this->input->post();
		if($post){
			$a=array();
			$return_array=array();
			$u_id=$post['u_id'];
			$where['id']=$u_id;
			$mod_ids=substr($post['mod_ids'],0,-1);
			$a['mod_ids']=$mod_ids;
			$return=$this->user_m->updateUser($a,$where);
			if($return){
				$return_array[0]['status']='1';
				$return_array[0]['message']='分配权限成功';
				echo json_encode($return_array);
				exit;
			}
			else{
				$return_array[0]['status']='0';
				$return_array[0]['message']='失败,请检查数据';
				echo json_encode($return_array);
				exit;
			}
		}
		else{
			if(empty($id)){
				showmessage('数据错误');
			}
			$data['project_id_list']=array();
			$user_info=$this->user_m->getUserInfoById($id);
			if(!empty($user_info['0'])){
				$mod_ids=$user_info['0']['mod_ids'];
				$mod_ids_list=explode(',',$mod_ids);
				$data['mod_ids_list']=$mod_ids_list;
			}
			else{
				showmessage('没有这个用户','/index.php/user/');
			}
			$this->load->model('mod_m');
			$mod_list=$this->mod_m->getModList(array());
			$data['user_info']=$user_info['0'];
			$data['mod_list']=$mod_list;
			$data['css']=$this->config->item('admin_css');		
			$data['js']=$this->config->item('admin_js');
			$js_view=$this->config->item('view_js_url');
			array_push($data['css'],'/admin_style/css/Skins/Blue/jbox.css');
			array_push($data['js'],'/admin_style/js/jquery.jBox-2.3.min.js','/admin_style/js/i18n/jquery.jBox-zh-CN.js','/admin_style/js/jquery.validate.js','/admin_style/js/jquery.metadata.js',$js_view.'user/user_root.js');
			$this->load->view('admin/header',$data);
			$this->load->view('user/user_root');
			$this->load->view('admin/footer');
		}
	}
}