<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 模块
 *
 */

class Menu extends CI_Controller {
	public $menu_m;
	public function __construct(){
		parent::__construct();
		$this->load->model('menu_m');
		if(!is_have_power('menu',se_item('user_mod_list'))){
			showmessage('您没有权限访问这个页面,请重新登录');
		}
	}
	/**
	 * 模块列表
	 *
	 */
	public function index($pid='0'){
		$where=array();
		$num=$this->menu_m->getModListNum($where,$pid);
		if($_POST){
			$post=$this->input->post();
			$page=$post['post_page'];
		}
		else{
			$page=$this->uri->segment(4);
		}
		$data['pid']=$pid;
		$this->load->library('pagination');
		$config['base_url'] = site_url().'/menu/'.$pid.'/';
		$config['total_rows'] = $num;
		$config['per_page'] = 10; 
		$config['uri_segment'] = 4;
		//$config['page_query_string'] = true;
		$config['is_ajax'] = true;
		$config['script_fun'] = 'pagejump';
		$this->pagination->initialize($config); 
		$pager=$this->pagination->create_links();
		$where['menu.pid']=$pid;
		$modList=$this->menu_m->getModList($where,$config['per_page'],$page);
		if($_POST){
			$html='';
			$html_data[0]['modList']=$modList;
			$html_data[0]['pager']=$pager;
			echo json_encode($html_data);
			exit;
		}
		$data['url']=site_url().'/menu/index/'.$pid.'/'.$page;
		$data['modList']=$modList;
		$data['pager']=$pager;
		$data['css']=$this->config->item('admin_css');		
		$data['js']=$this->config->item('admin_js');
		$js_view=$this->config->item('view_js_url');
		array_push($data['css'],'/admin_style/css/Skins/Blue/jbox.css');
		array_push($data['js'],'/admin_style/js/jquery.jBox-2.3.min.js','/admin_style/js/i18n/jquery.jBox-zh-CN.js',$js_view.'menu/menu_list.js');
		$this->load->view('admin/header',$data);
		$this->load->view('menu/menu_list');
		$this->load->view('admin/footer');
	}
	/**
	 * 添加模块
	 *
	 */
	public function add_menu(){	
		if($_POST){
			$post=$this->input->post();
			//检测项目名称是否为空
			if(!isset($post['name']) || empty($post['name'])){
				$return_array[0]['status']='0';
				$return_array[0]['message']='添加失败,导航名不能为空';
				echo json_encode($return_array);
				exit;
			}
			//项目名称是否重复
			$nums=$this->menu_m->isSameName($post['name']);
			if($nums>0){
				$return_array[0]['status']='0';
				$return_array[0]['message']='添加失败,导航名重复';
				echo json_encode($return_array);
				exit;
			}
			$return_array=array();
			$a=array();
			$a['name']=$post['name'];
			$a['menu_url']=$post['menu_url'];
			$a['status']=$post['status'];
			$a['pid']=$post['pid'];
			$return=$this->menu_m->addMod($a);			
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
			$all_class=$this->menu_m->getMenuTree();
			$this->load->library('newsclass_l');
			$menu_tree=$this->newsclass_l->newArrForClass($all_class,'','1');
			$data['menu_tree']=$menu_tree;
			$data['css']=$this->config->item('admin_css');		
			$data['js']=$this->config->item('admin_js');
			$js_view=$this->config->item('view_js_url');
			array_push($data['css'],'/admin_style/css/Skins/Blue/jbox.css');
			array_push($data['js'],'/admin_style/js/jquery.jBox-2.3.min.js','/admin_style/js/i18n/jquery.jBox-zh-CN.js','/admin_style/js/jquery.validate.js','/admin_style/js/jquery.metadata.js',$js_view.'menu/add_menu.js');
			$this->load->view('admin/header',$data);
			$this->load->view('menu/add_menu');
			$this->load->view('admin/footer');
		}
	}
	
	public function update_menu($id=''){
		$where=array();
		if($_POST){
			$post=$this->input->post();
			$a=array();
			$return_array=array();
			$id=$post['mod_id'];
			$where['id']=$id;
			$a['name']=$post['name'];
			$a['menu_url']=$post['menu_url'];
			$a['status']=$post['status'];
			$a['pid']=$post['pid'];
			$return=$this->menu_m->updateMenu($a,$where);
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
			$menu_info=$this->menu_m->getModInfoById($id);
			$data['menu_info']=$menu_info;
			$all_class=$this->menu_m->getMenuTree();
			$this->load->library('newsclass_l');

			$menu_tree=$this->newsclass_l->newArrForClass($all_class,$menu_info['pid'],'1');
			$data['menu_tree']=$menu_tree;
			
			$data['css']=$this->config->item('admin_css');		
			$data['js']=$this->config->item('admin_js');
			$js_view=$this->config->item('view_js_url');
			array_push($data['css'],'/admin_style/css/Skins/Blue/jbox.css');
			array_push($data['js'],'/admin_style/js/jquery.jBox-2.3.min.js','/admin_style/js/i18n/jquery.jBox-zh-CN.js','/admin_style/js/jquery.validate.js','/admin_style/js/jquery.metadata.js',$js_view.'menu/update_menu.js');
			$this->load->view('admin/header',$data);
			$this->load->view('menu/update_menu');
			$this->load->view('admin/footer');
		}
	}
	public function del_menu(){
		if($_POST){
			$post=$this->input->post();
			if(empty($post['id']))
			{
				return false;
			} 
			$return_array=array();
			$id=$post['id'];
			$is_have_son=$this->menu_m->isHaveSon($id);
			if(!$is_have_son){
				$return_array[0]['status']='0';
				$return_array[0]['message']='删除失败,该导航含有子集不能删除';
				echo json_encode($return_array);
				exit;
			}
			$query=$this->menu_m->delMenu($id);
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
			 	$return=$this->menu_m->orderNum($new_arr);
			 	header("Location:".$post['url']);
			 }
		}else{
			return false;
		}
	}
}
?>