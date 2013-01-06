<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 新闻模块
 *
 */

class News extends CI_Controller {
	public $user_m;
	public function __construct(){
		parent::__construct();
		$this->load->model('news_m');
		$this->load->model('newsclass_m');
		if(!is_have_power('news',se_item('user_mod_list'))){
			showmessage('您没有权限访问这个页面,请重新登录');
		}
	}
	public function index($cid=''){
		$post=$this->input->post();
		if(!empty($cid)){
			$where['cid']=$cid;
			$num=$this->news_m->getNewsNum($where);
			if($_POST){
				$post=$this->input->post();
				$page=$post['post_page'];
			}
			else{
				$page=$this->uri->segment(4);
			}
			$this->load->library('pagination');
			$config['base_url'] = site_url().'/news/index/'.$cid.'/';
			$config['total_rows'] = $num;
			$config['per_page'] = 10; 
			$config['uri_segment'] = 4;
			//$config['page_query_string'] = true;
			$config['is_ajax'] = true;
			$config['script_fun'] = 'pagejump';
			$this->pagination->initialize($config); 
			$pager=$this->pagination->create_links();
	
			$userList=$this->news_m->getNewsList($where,$config['per_page'],$page);
			if($_POST){
				$html='';
				$html_data[0]['userList']=$userList;
				$html_data[0]['pager']=$pager;
				echo json_encode($html_data);
				exit;
			}
			$data['css']=$this->config->item('admin_css');	
			$data['js']=$this->config->item('admin_js');
			$data['cid']=$cid;
			$data['userList']=$userList;
			$data['pager']=$pager;
			$js_view=$this->config->item('view_js_url');
			array_push($data['css'],'/admin_style/css/Skins/Blue/jbox.css','/admin_style/css/jquery.treeview.css');
			array_push($data['js'],'/admin_style/js/jquery.jBox-2.3.min.js','/admin_style/js/i18n/jquery.jBox-zh-CN.js','/admin_style/js/jquery.treeview.js','/admin_style/js/jquery.treeview.edit.js','/admin_style/js/jquery.treeview.async.js',$js_view.'news/news_list.js');
			$this->load->view('admin/header',$data);
			$this->load->view('news/news_list');
			$this->load->view('admin/footer');			
			
		}
		else{
			$data['css']=$this->config->item('admin_css');
			//unset($data['css']['0']);		
			$data['js']=$this->config->item('admin_js');
			$js_view=$this->config->item('view_js_url');
			array_push($data['css'],'/admin_style/css/Skins/Blue/jbox.css','/admin_style/css/jquery.treeview.css');
			array_push($data['js'],'/admin_style/js/jquery.jBox-2.3.min.js','/admin_style/js/i18n/jquery.jBox-zh-CN.js','/admin_style/js/jquery.treeview.js','/admin_style/js/jquery.treeview.edit.js','/admin_style/js/jquery.treeview.async.js',$js_view.'news/news_list.js');
			$this->load->view('admin/header',$data);
			$this->load->view('news/checkclass');
			$this->load->view('admin/footer');
		}
		
	}
	/**
	 *添加新闻
	 *
	 */
	public function add_news(){
		$post=$this->input->post();
		if($post){
			//检测新闻名称是否为空
			if(!isset($post['title']) || empty($post['title'])){
				$return_array[0]['status']='0';
				$return_array[0]['message']='添加失败,新闻不能为空';
				echo json_encode($return_array);
				exit;
			}			
			$return_array=array();
			$a=array();
			$a['title']=$post['title'];
			$a['cid']=$post['pid'];
			$a['status']=$post['status'];
			$a['is_top']=$post['is_top'];
			$a['img_url']=$post['img_url'];
			$a['news_detail']=$post['news_detail'];
			
			$return=$this->news_m->addNews($a);			
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
			$today=date('Ymd',time());
			$path='/ueditor/php/upload/'.$today.'/';
			$data['path']=$path;
			$data['css']=$this->config->item('admin_css');		
			$data['js']=$this->config->item('admin_js');
			$pid=$this->input->get('pid')? $this->input->get('pid') : '';
			$js_view=$this->config->item('view_js_url');
			$all_class=$this->newsclass_m->getNewsclassP();
			$this->load->library('newsclass_l');
			$pid_list=$this->newsclass_l->newArrForClass($all_class,$pid,'1');
			$data['pid_list']=$pid_list	;
			array_push($data['css'],'/admin_style/css/Skins/Blue/jbox.css','/admin_style/css/ajaxfileupload.css');
			array_push($data['js'],'/ueditor/editor_config.js','/ueditor/editor_all.js','/admin_style/js/jquery.jBox-2.3.min.js','/admin_style/js/i18n/jquery.jBox-zh-CN.js','/admin_style/js/jquery.validate.js','/admin_style/js/jquery.metadata.js','/admin_style/js/ajaxfileupload.js',$js_view.'news/add_news.js');
			$this->load->view('admin/header',$data);
			$this->load->view('news/add_news');
			$this->load->view('admin/footer');
		}
	}
	public function update_news($id='',$pid=''){
		$post=$this->input->post();
		if(empty($id) && empty($post)){
			showmessage('无效地址');
		}
		else{
			
			if(!empty($post)){
				
				$a=array();
				$where['id']=$post['newsid'];
				$a['title']=$post['title'];
				$a['cid']=$post['pid'];
				$a['status']=$post['status'];
				$a['is_top']=$post['is_top'];
				$a['img_url']=$post['img_url'];
				$a['news_detail']=$post['news_detail'];
				$return=$this->news_m->updateNews($a,$where);
				if($return){	
					$return_array[0]['status']='1';
					$return_array[0]['message']='修改成功';
					$return_array[0]['insert_id']=$return;
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
				
				$news_info=$this->news_m->getNewsInfoById($id);
				if(!$news_info){
					showmessage('没有这条新闻');
				}
				$today=date('Ymd',time());
				$path='/ueditor/php/upload/'.$today.'/';
				$data['path']=$path;
				$data['pid']=$pid;
				$data['newsid']=$id;
				$news_detail_info=$this->news_m->getNewsDetail($news_info['id']);
				$news_info['news_detail']=$news_detail_info == false ? '' : $news_detail_info['news_detail'];
				$data['news_info']=$news_info;
				$all_class=$this->newsclass_m->getNewsclassP();
				$this->load->library('newsclass_l');
				$pid=$news_info['cid'];
				$pid_list=$this->newsclass_l->newArrForClass($all_class,$pid,'1');
				$data['pid_list']=$pid_list;
				$data['css']=$this->config->item('admin_css');		
				$data['js']=$this->config->item('admin_js');
				$js_view=$this->config->item('view_js_url');
				array_push($data['css'],'/admin_style/css/Skins/Blue/jbox.css','/admin_style/css/ajaxfileupload.css');
				array_push($data['js'],'/ueditor/editor_config.js','/ueditor/editor_all.js','/admin_style/js/jquery.jBox-2.3.min.js','/admin_style/js/i18n/jquery.jBox-zh-CN.js','/admin_style/js/jquery.validate.js','/admin_style/js/jquery.metadata.js','/admin_style/js/ajaxfileupload.js',$js_view.'news/update_news.js');
				$this->load->view('admin/header',$data);
				$this->load->view('news/update_news');
				$this->load->view('admin/footer');
			}
			
			
		}
	}
	public function del_news(){
		if($_POST){
			$post=$this->input->post();
			if(empty($post['id']))
			{
				return false;
			} 
			$return_array=array();
			$id=$post['id'];
			$query=$this->news_m->delNews($id);
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
	 * 新闻分类树
	 *
	 */
	public function gettree(){
		$pid=$this->input->get('root');
		if($pid == 'source'){
			$pid='0';
		}
		//$pid=empty($this->input->get('pid'))? '0': $this->input->get('pid');
		$tree_list=$this->newsclass_m->getTree($pid);
		if(!empty($tree_list)){
			foreach ($tree_list as $k=>$v){
				if(!$this->newsclass_m->is_have_son($v['id'])){
					$new_array[$k]['hasChildren']='true';
					$new_array[$k]['id']=$v['id'];
					$new_array[$k]['text']=$v['name'];	
				}
				else{
					$new_array[$k]['text']='<input type="radio" value="'.$v['id'].'" name="newsclass"/>'.$v['name'];
				}
				
			}
			echo json_encode($new_array);
		}
		
	}
	/**
	 * 上传图片
	 *
	 */
	public function upload_url(){
		//上传文件开始

			$today=date('Ymd',time());
			
			$config['upload_path'] = './ueditor/php/upload/'.$today."/";
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
			if (!$this->upload->do_upload('userfile'))
			  {
			  	
			   $error = $this->upload->display_errors();
			   $return_array[0]['status']='fail';
			   $return_array[0]['message']='添加失败,'.$error;
			   echo json_encode($return_array);
			   exit;
			  }
			else{
				$file_data=$this->upload->data();
				$full_path=$file_data['file_name'];
				$return_array[0]['status']='1';
			    $return_array[0]['message']=$full_path;
			    echo json_encode($return_array);
			    exit();
			}
	}
}