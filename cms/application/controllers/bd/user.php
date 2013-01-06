<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class User extends CI_Controller {
	public $user_m;
	public function __construct(){
		parent::__construct();
		$this->load->model('user_m');
	}
	public function index(){
		$where=array();
		$num=$this->user_m->getUserListNum($where);
		if($_POST){
			$post=$this->input->post();
			$page=$post['post_page'];
		}
		else{
			$page=$this->uri->segment(4);
		}
		$this->load->library('pagination');
		$config['base_url'] = site_url().'/bd/user/index/';
		$config['total_rows'] = $num;
		$config['per_page'] = 10; 
		$config['uri_segment'] = 4;
		//$config['page_query_string'] = true;
		$config['is_ajax'] = true;
		$config['script_fun'] = 'pagejump';
		$this->pagination->initialize($config); 
		$pager=$this->pagination->create_links();
		$userList=$this->user_m->getUserList($where,$config['per_page'],$page);
		file_put_contents('e:/1.txt',$pager);
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
		array_push($data['css'],'/admin_style/css/Skins/Blue/jbox.css');
		array_push($data['js'],'/admin_style/js/jquery.jBox-2.3.min.js','/admin_style/js/i18n/jquery.jBox-zh-CN.js');
		$this->load->view('admin/header',$data);
		$this->load->view('user/userlist');
		$this->load->view('admin/footer');
	}
	public function add_user(){	
		if($_POST){
			$post=$this->input->post();
			$return_array=array();
			if($post['psd'] != $post['repsd']){
				$return_array[0]['status']='0';
				$return_array[0]['message']='添加失败,两次输入的密码不一致';
				echo json_encode($return_array);
				exit;
			}
			$a=array();
			$a['name']=$post['name'];
			$a['chname']=$post['chname'];
			$a['psd']=md5($post['psd']);
			$a['status']=$post['status'];
			$a['is_admin']=$post['is_admin'];
			$return=$this->user_m->add_user_m($a);
			
			if($return){	
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
			$data['css']=$this->config->item('admin_css');		
			$data['js']=$this->config->item('admin_js');
			$js_view=$this->config->item('view_js_url');
			array_push($data['css'],'/admin_style/css/Skins/Blue/jbox.css');
			array_push($data['js'],'/admin_style/js/jquery.jBox-2.3.min.js','/admin_style/js/i18n/jquery.jBox-zh-CN.js','/admin_style/js/jquery.validate.js','/admin_style/js/jquery.metadata.js',$js_view.'add_user.js');
			$this->load->view('admin/header',$data);
			$this->load->view('user/add_user');
			$this->load->view('admin/footer');
		}
		
		
	}
	public function update_user($id=''){
		if($_POST){
			$post=$this->input->post();
			$return_array=array();
			if($post['psd'] != $post['repsd']){
				$return_array[0]['status']='0';
				$return_array[0]['message']='添加失败,两次输入的密码不一致';
				echo json_encode($return_array);
				exit;
			}
			if(empty($post['name']) || empty($post['chname'])){
				$return_array[0]['status']='0';
				$return_array[0]['message']='添加失败,姓名，中文姓名，密码不能为空';
				echo json_encode($return_array);
				exit;
			}
			$a=array();
			$where=array();
			$a['name']=$post['name'];
			$a['chname']=$post['chname'];
			//$a['psd']=md5($post['psd']);
			$a['status']=$post['status'];
			$a['is_admin']=$post['is_admin'];
			$where['id']=$id;
			
			$return=$this->user_m->updateUserInfo($a,$where);
			if($return){	
				$return_array[0]['status']='1';
				$return_array[0]['message']='修改成功';
				echo json_encode($return_array);
				exit;
			}
			else{
				$return_array[0]['status']='0';
				$return_array[0]['message']='修改失败,请检查数据';
				echo json_encode($return_array);
				exit;
			}
		}
		else{
			if(is_numeric($id)){
				$data['css']=$this->config->item('admin_css');		
				$data['js']=$this->config->item('admin_js');
				$js_view=$this->config->item('view_js_url');
				array_push($data['css'],'/admin_style/css/Skins/Blue/jbox.css');
			array_push($data['js'],'/admin_style/js/jquery.jBox-2.3.min.js','/admin_style/js/i18n/jquery.jBox-zh-CN.js','/admin_style/js/jquery.validate.js','/admin_style/js/jquery.metadata.js',$js_view.'update_user.js');
				$userInfo=$this->user_m->getUserInfoById($id);
				$data['userInfo']=$userInfo[0];
				$this->load->view('admin/header',$data);
				$this->load->view('user/update_user');
				$this->load->view('admin/footer');
			}
		}
	}
}
?>