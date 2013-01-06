<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Link extends CI_Controller {
	public $link_m;
	public function __construct(){
		parent::__construct();
		$this->load->model('link_m');
		if(!is_have_power('link',se_item('user_mod_list'))){
			showmessage('您没有权限访问这个页面,请重新登录');
		}
	}
	public function index(){
		$where=array();
		$where['is_del']='1';
		$num=$this->link_m->getProjectGListNum($where);
		if($_POST){
			$post=$this->input->post();
			$page=$post['post_page'];
		}
		else{
			$page=$this->uri->segment(3);
		}
		$this->load->library('pagination');
		$config['base_url'] = site_url().'/link/index';
		$config['total_rows'] = $num;
		$config['per_page'] = 10; 
		$config['uri_segment'] = 3;
		//$config['page_query_string'] = true;
		$config['is_ajax'] = true;
		$config['script_fun'] = 'pagejump';
		$this->pagination->initialize($config); 
		$pager=$this->pagination->create_links();
		$list=$this->link_m->getProjectGList($where,$config['per_page'],$page);
		if($_POST){
			$html='';
			$html_data[0]['list']=$list;
			$html_data[0]['pager']=$pager;
			echo json_encode($html_data);
			exit;
		}
		$data['url']=$config['base_url'].'/'.$page;
		$data['list']=$list;
		$data['pager']=$pager;
		$data['css']=$this->config->item('admin_css');		
		$data['js']=$this->config->item('admin_js');
		$js_view=$this->config->item('view_js_url');
		array_push($data['css'],'/admin_style/css/Skins/Blue/jbox.css');
		array_push($data['js'],'/admin_style/js/jquery.jBox-2.3.min.js','/admin_style/js/i18n/jquery.jBox-zh-CN.js',$js_view.'link/link_list.js');
		$this->load->view('admin/header',$data);
		$this->load->view('link/link_list');
		$this->load->view('admin/footer');
	}
	/**
	 * 添加项目组
	 *
	 */
	public function add_link(){
		$post=$this->input->post();
		if($post){
			$img='';
			if(!empty($_FILES['img']['name'])){
				$today=date('Ymd',time());
				$config['upload_path'] = './ueditor/php/upload/link/'.$today."/";
				if(@!is_dir($config['upload_path'])){
					mkdir($config['upload_path'],'0777');
				}
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = '2000';
				$config['file_name'] = time();
				$config['overwrite'] = false;
				$config['remove_spaces'] = true;
				$config['max_width'] = '1024';
				$config['max_height'] = '768';
				
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('img'))
				  {
				   $error = $this->upload->display_errors();
				   $data['error']=$error;
				  }
				else{
					$file_data=$this->upload->data();
					$img='/ueditor/php/upload/link/'.$today.'/'.$file_data['file_name'];
					
				}
			}
			$a=array();
			$a['name']=$post['name'];
			$a['status']=$post['status'];
			$a['url']=$post['url'];
			$a['img']=$img;
			$return=$this->link_m->addLink($a);			
			if($return){	
				showmessage('添加成功','/index.php/link/index','1');
			}
			else{
				 $data['error']='添加失败，请检查数据';
			}	
		}
		$data['css']=$this->config->item('admin_css');		
		$data['js']=$this->config->item('admin_js');
		$js_view=$this->config->item('view_js_url');
		array_push($data['css'],'/admin_style/css/Skins/Blue/jbox.css','/admin_style/css/jquery.autocomplete.css');
		array_push($data['js'],'/admin_style/js/jquery.jBox-2.3.min.js','/admin_style/js/i18n/jquery.jBox-zh-CN.js','/admin_style/js/jquery.validate.js','/admin_style/js/jquery.metadata.js','/admin_style/js/jquery.autocomplete.js',$js_view.'link/add_link.js');
		$this->load->view('admin/header',$data);
		$this->load->view('link/add_link');
		$this->load->view('admin/footer');
	}
	/**
	 * 编辑项目组
	 *
	 */
	public function update_link($id=''){
		$post=$this->input->post();
		$data['error']='';
		if($post){
			$img=$post['old_img'];
			if(!empty($_FILES['img']['name'])){
				$today=date('Ymd',time());
				$config['upload_path'] = './ueditor/php/upload/link/'.$today."/";
				if(@!is_dir($config['upload_path'])){
					mkdir($config['upload_path'],'0777');
				}
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = '2000';
				$config['file_name'] = time();
				$config['overwrite'] = false;
				$config['remove_spaces'] = true;
				$config['max_width'] = '1024';
				$config['max_height'] = '768';
				
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('img'))
				  {
				   $error = $this->upload->display_errors();
				   $data['error']=$error;
				  }
				else{
					$file_data=$this->upload->data();
					$img='/ueditor/php/upload/link/'.$today.'/'.$file_data['file_name'];
					
				}
			}
			$a=array();
			$a['name']=$post['name'];
			$a['status']=$post['status'];
			$a['url']=$post['url'];
			$a['img']=$img;
			$where['id']=$post['link_id'];
			$return=$this->link_m->updateLink($a,$where);			
			if($return){	
				showmessage('修改成功','/index.php/link/index','1');
			}
			else{
				 $data['error']='添加失败，请检查数据';
			}
			
			$project_group_list=$this->link_m->getProjectInfoById($id);
			$data['project_group_list']=$project_group_list;
			$data['css']=$this->config->item('admin_css');		
			$data['js']=$this->config->item('admin_js');
			$js_view=$this->config->item('view_js_url');
			array_push($data['css'],'/admin_style/css/Skins/Blue/jbox.css','/admin_style/css/jquery.autocomplete.css');
			array_push($data['js'],'/admin_style/js/jquery.jBox-2.3.min.js','/admin_style/js/i18n/jquery.jBox-zh-CN.js','/admin_style/js/jquery.validate.js','/admin_style/js/jquery.metadata.js','/admin_style/js/jquery.autocomplete.js',$js_view.'link/update_link.js');
			$this->load->view('admin/header',$data);
			$this->load->view('link/update_link');
			$this->load->view('admin/footer');
			exit();
		}
		else{
			if(empty($id)){
				showmessage('数据错误','/index.php/link');
			}
			
			$project_group_list=$this->link_m->getProjectInfoById($id);
			$data['project_group_list']=$project_group_list;
			$data['css']=$this->config->item('admin_css');		
			$data['js']=$this->config->item('admin_js');
			$js_view=$this->config->item('view_js_url');
			array_push($data['css'],'/admin_style/css/Skins/Blue/jbox.css','/admin_style/css/jquery.autocomplete.css');
			array_push($data['js'],'/admin_style/js/jquery.jBox-2.3.min.js','/admin_style/js/i18n/jquery.jBox-zh-CN.js','/admin_style/js/jquery.validate.js','/admin_style/js/jquery.metadata.js','/admin_style/js/jquery.autocomplete.js',$js_view.'link/update_link.js');
			$this->load->view('admin/header',$data);
			$this->load->view('link/update_link');
			$this->load->view('admin/footer');
		}
	}
	
	public function del_link(){
		if($_POST){
			$post=$this->input->post();
			if(empty($post['id']))
			{
				return false;
			}
			$return_array=array();
			$id=$post['id'];
			$query=$this->link_m->delProjectGroup($id);
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
	public function order_num(){
		$post=$this->input->post();
		if($post){
			 if(isset($post['menu_id_list']) && !empty($post['menu_id_list'])){
			 	$menu_id_list=$post['menu_id_list'];
			 	$menu_num_list=$post['menu_num_list'];
			 	$menu_id_list_arr=explode(',',$menu_id_list);
			 	$menu_num_list_arr=explode(',',$menu_num_list);
			 	$new_arr=array_combine($menu_id_list_arr,$menu_num_list_arr);
			 	$new_arr=array_filter($new_arr);
			 	$return=$this->link_m->orderNum($new_arr);
			 	header("Location:".$post['url']);
			 }
		}else{
			return false;
		}
	}
      
}