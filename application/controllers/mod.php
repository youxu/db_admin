<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 模块
 *
 */

class Mod extends CI_Controller {
	public $mod_m;
	public function __construct(){
		parent::__construct();
		$this->load->model('mod_m');
		if(!is_have_power('mod',se_item('user_mod_list'))){
			showmessage('您没有权限访问这个页面,请重新登录');
		}
	}
	/**
	 * 模块列表
	 *
	 */
	public function index(){
		$where=array();
		$num=$this->mod_m->getModListNum($where);
		if($_POST){
			$post=$this->input->post();
			$page=$post['post_page'];
		}
		else{
			$page=$this->uri->segment(3);
		}
		$this->load->library('pagination');
		$config['base_url'] = site_url().'/mod';
		$config['total_rows'] = $num;
		$config['per_page'] = 10; 
		$config['uri_segment'] = 3;
		//$config['page_query_string'] = true;
		$config['is_ajax'] = true;
		$config['script_fun'] = 'pagejump';
		$this->pagination->initialize($config); 
		$pager=$this->pagination->create_links();
		$modList=$this->mod_m->getModList($where,$config['per_page'],$page);
		if($_POST){
			$html='';
			$html_data[0]['modList']=$modList;
			$html_data[0]['pager']=$pager;
			echo json_encode($html_data);
			exit;
		}
		$data['modList']=$modList;
		$data['pager']=$pager;
		$data['css']=$this->config->item('admin_css');		
		$data['js']=$this->config->item('admin_js');
		$js_view=$this->config->item('view_js_url');
		array_push($data['css'],'/admin_style/css/Skins/Blue/jbox.css');
		array_push($data['js'],'/admin_style/js/jquery.jBox-2.3.min.js','/admin_style/js/i18n/jquery.jBox-zh-CN.js',$js_view.'mod/mod_list.js');
		$this->load->view('admin/header',$data);
		$this->load->view('mod/mod_list');
		$this->load->view('admin/footer');
	}
	/**
	 * 添加模块
	 *
	 */
	public function add_mod(){	
		if($_POST){
			$post=$this->input->post();
			//检测项目名称是否为空
			if(!isset($post['name']) || empty($post['name'])){
				$return_array[0]['status']='0';
				$return_array[0]['message']='添加失败,项目名不能为空';
				echo json_encode($return_array);
				exit;
			}
			//项目名称是否重复
			$nums=$this->mod_m->isSameName($post['name']);
			if($nums>0){
				$return_array[0]['status']='0';
				$return_array[0]['message']='添加失败,项目名重复';
				echo json_encode($return_array);
				exit;
			}
			$return_array=array();
			$a=array();
			$a['name']=$post['name'];
			$a['model']=$post['model'];
			$return=$this->mod_m->addMod($a);			
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
			array_push($data['js'],'/admin_style/js/jquery.jBox-2.3.min.js','/admin_style/js/i18n/jquery.jBox-zh-CN.js','/admin_style/js/jquery.validate.js','/admin_style/js/jquery.metadata.js',$js_view.'mod/add_mod.js');
			$this->load->view('admin/header',$data);
			$this->load->view('mod/add_mod');
			$this->load->view('admin/footer');
		}
	}
	
	public function update_mod($id=''){
		$where=array();
		if($_POST){
			$post=$this->input->post();
			$a=array();
			$return_array=array();
			$id=$post['mod_id'];
			$where['id']=$id;
			$a['name']=$post['name'];
			$a['model']=$post['model'];
			$return=$this->mod_m->updateMod($a,$where);
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
			$mod_info=$this->mod_m->getModInfoById($id);
			$data['mod_info']=$mod_info;
			$data['css']=$this->config->item('admin_css');		
			$data['js']=$this->config->item('admin_js');
			$js_view=$this->config->item('view_js_url');
			array_push($data['css'],'/admin_style/css/Skins/Blue/jbox.css');
			array_push($data['js'],'/admin_style/js/jquery.jBox-2.3.min.js','/admin_style/js/i18n/jquery.jBox-zh-CN.js','/admin_style/js/jquery.validate.js','/admin_style/js/jquery.metadata.js',$js_view.'mod/update_mod.js');
			$this->load->view('admin/header',$data);
			$this->load->view('mod/update_mod');
			$this->load->view('admin/footer');
		}
	}
	public function del_mod(){
		if($_POST){
			$post=$this->input->post();
			if(empty($post['id']))
			{
				return false;
			} 
			$return_array=array();
			$id=$post['id'];
			$query=$this->mod_m->delMod($id);
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