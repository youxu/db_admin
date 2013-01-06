<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 机器组
 *
 */
class Ma_group extends CI_Controller {
	public $ma_group_m;
	public function __construct(){
		parent::__construct();
		$this->load->model('ma_group_m');
	}
	/**
	 * 机器组列表
	 *
	 */
	public function index(){

		$where=array();
		$num=$this->ma_group_m->getMaGroupListNum($where);
		if($_POST){
			$post=$this->input->post();
			$page=$post['post_page'];
		}
		else{
			$page=$this->uri->segment(3);
		}
		$this->load->library('pagination');
		$config['base_url'] = site_url().'/project';
		$config['total_rows'] = $num;
		$config['per_page'] = 10; 
		$config['uri_segment'] = 3;
		//$config['page_query_string'] = true;
		$config['is_ajax'] = true;
		$config['script_fun'] = 'pagejump';
		$this->pagination->initialize($config); 
		$pager=$this->pagination->create_links();
		$userList=$this->ma_group_m->getMaGroupList($where,$config['per_page'],$page);
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
		array_push($data['js'],'/admin_style/js/jquery.jBox-2.3.min.js','/admin_style/js/i18n/jquery.jBox-zh-CN.js',$js_view.'ma_group/ma_group_list.js');
		$this->load->view('admin/header',$data);
		$this->load->view('ma_group/ma_group_list');
		$this->load->view('admin/footer');
	}
	
	/**
	 * 添加机器组信息
	 *
	 */
	public function add_ma_group(){	
		if($_POST){
			$post=$this->input->post();
			//检测项目名称是否为空
			if(!isset($post['name']) || empty($post['name'])){
				$return_array[0]['status']='0';
				$return_array[0]['message']='添加失败,机器名不能为空';
				echo json_encode($return_array);
				exit;
			}
			//项目名称是否重复
			$nums=$this->ma_group_m->isSameName($post['name']);
			if($nums>0){
				$return_array[0]['status']='0';
				$return_array[0]['message']='添加失败,机器名重复';
				echo json_encode($return_array);
				exit;
			}
			$return_array=array();
			$a=array();
			if (strpos($_POST['ip'],"，")) {
				$ip=str_replace('，',',',$_POST['ip']);
			}
			else{
				$ip=$_POST['ip'];
			}
			if (strpos($_POST['ip_top'],"，")) {
				$ip_top=str_replace('，',',',$_POST['ip_top']);
			}
			else{
				$ip_top=$_POST['ip_top'];
			}
			$ip=trim($ip);
			$ip_top=trim($ip_top);
			$a['name']=$post['name'];
			$a['ip']=$ip;
			$a['ip_top']=$ip_top;
			$a['status']=$post['status'];
			$return=$this->ma_group_m->add_ma_group_m($a,$is_have_id='1');			
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
			$data['css']=$this->config->item('admin_css');		
			$data['js']=$this->config->item('admin_js');
			$js_view=$this->config->item('view_js_url');
			array_push($data['css'],'/admin_style/css/Skins/Blue/jbox.css');
			array_push($data['js'],'/admin_style/js/jquery.jBox-2.3.min.js','/admin_style/js/i18n/jquery.jBox-zh-CN.js','/admin_style/js/jquery.validate.js','/admin_style/js/jquery.metadata.js',$js_view.'ma_group/add_ma_group.js');
			$this->load->view('admin/header',$data);
			$this->load->view('ma_group/add_ma_group');
			$this->load->view('admin/footer');
		}
	}
	public function update_ma_group($id=''){
		$where=array();
		if($_POST){
			$post=$this->input->post();
			
			$a=array();
			$return_array=array();
			if (strpos($_POST['ip'],"，")) {
				$ip=str_replace('，',',',$_POST['ip']);
			}
			else{
				$ip=$_POST['ip'];
			}
			if (strpos($_POST['ip_top'],"，")) {
				$ip_top=str_replace('，',',',$_POST['ip_top']);
			}
			else{
				$ip_top=$_POST['ip_top'];
			}
			$ip=trim($ip);
			$ip_top=trim($ip_top);
			$a['name']=$post['name'];
			$a['ip']=$ip;
			$a['ip_top']=$ip_top;
			$a['status']=$post['status'];
			$where['id']=$post['id'];
			$return=$this->ma_group_m->updateMaGroup($a,$where);
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
			$where['id']=$id;
			$ma_group_info=$this->ma_group_m->getMaGroup($where);
		
			$data['ma_group_info']=$ma_group_info['0'];
			$data['css']=$this->config->item('admin_css');		
			$data['js']=$this->config->item('admin_js');
			$js_view=$this->config->item('view_js_url');
			array_push($data['css'],'/admin_style/css/Skins/Blue/jbox.css');
			array_push($data['js'],'/admin_style/js/jquery.jBox-2.3.min.js','/admin_style/js/i18n/jquery.jBox-zh-CN.js','/admin_style/js/jquery.validate.js','/admin_style/js/jquery.metadata.js',$js_view.'ma_group/update_ma_group.js');
			$this->load->view('admin/header',$data);
			$this->load->view('ma_group/update_ma_group');
			$this->load->view('admin/footer');
		}
	}
	public function del_ma_group(){
		if($_POST){
			$post=$this->input->post();
			if(empty($post['id']))
			{
				return false;
			}
			$where=array();
			$return_array=array();
			$id=$post['id'];
			$query=$this->ma_group_m->delMaGroup($id);
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
?>