<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('user_m');
		$this->load->model('login_m');
		$this->login_m->isLogin();
	}
	public function index(){
		$username=se_item('username');
		if(isset($username) && !empty($username)){
			$userInfo=$this->user_m->getUserInfoByName($username);
			if(isset($userInfo['id']) && !empty($userInfo['id'])){			
				$s_arr=array();
				$s_arr['userInfo']=$userInfo;
				//获得用户项目组信息
				/*$project_group_list=$this->project_group_m->getUserListFUserproject('',$userInfo['id']);
				if(!empty($project_group_list)){
					foreach ($project_group_list as $pk=>$pv){
						$project_group_info=$this->project_group_m->getProjectGroupInfo($pv['project_id']);			
						if(!empty($project_group_info)){
							//用户所在项目组的项目列表
							$project_arr[]=$project_group_info['project_list'];
						}
					}
					$project_arrs='';
					$project_arrs=implode(',',$project_arr);//项目组项目组合在一起用,连接
					
					$this->load->model('project_m');
					
				}
				if(!empty($userInfo['project_id'])){
					$project_ids=$userInfo['project_id'].','.$project_arrs;//如果用户项目和所在项目组项目不为空，组合起来
				}
				else{
					$project_ids=$userInfo['project_id'];//否则为空
				}
				$project_list=$this->project_m->getProjetList(array('status'=>'1'));//获得所有项目
				while (list($key, $val) = each($project_list)) {
				  $new_project_list[$val['id']]=$val['name'];
				}
				
				$project_ids_arr=explode(',',$project_ids);
				$project_ids_arr=array_flip($project_ids_arr) ;//去重

				foreach ($project_ids_arr as $k=>&$v){
					//如果项目存在，保存项目id=>项目名称
					if(isset($new_project_list[$k])){
						$v=$new_project_list[$k];
					}
					else{
						unset($project_ids_arr[$k]);
					}
					
				}
				
				$data['user_project_list']=$project_ids_arr;
				*/
				//获得用户项目组信息 end
				//用户模块权限 begin	
				if(!empty($userInfo['mod_ids'])){
						$user_mod_arr=explode(',',$userInfo['mod_ids']);
						$this->load->model('mod_m');
						$mod_list=$this->mod_m->getModList(array());
						
						foreach ($mod_list as $mdk=>$mdv){
							$new_mod_list[$mdv['id']]=$mdv['model'];
						}
		
						foreach ($user_mod_arr as $mk=>$mv){
							if(isset($new_mod_list[$mv])){
								$user_mod_list[]=$new_mod_list[$mv];
							}
							else{
								unset($user_mod_arr[$mk]);
							}
						}
					$data['user_mod_list']=$s_arr['user_mod_list']=$user_mod_list;
					
				}
				//用户模块权限 end
			
				se_create($s_arr);//记录session
				$data['userInfo']=$userInfo;
				$data['css']=$this->config->item('admin_css');		
				$data['js']=$this->config->item('admin_js');
				//$this->load->view('admin/header',$data);
				$this->load->view('admin_index',$data);
				//$this->load->view('admin/footer');
			}
			else{
				//当用户可以通过cas验证，但是系统中不存在时
				$data['admin_email']=$this->config->item('admin_email');
				$data['css']=$this->config->item('admin_css');		
				$data['js']=$this->config->item('admin_js');
				//$this->load->view('admin/header',$data);
				$this->load->view('no_user',$data);
	
				//$this->load->view('admin/footer');
			}
			
		}
		else{
			showmessage('未登录，3秒之后跳转到登陆页','/index.php/login');
		}
		//$this->load->view('admin/index');
	}
	public function admin_index(){
			//用户模块权限 begin	
			
			$userInfo=se_item('userInfo');
			$this->user_m->update_logintime($userInfo['name']);
			if(!empty($userInfo['mod_ids'])){
					$user_mod_arr=explode(',',$userInfo['mod_ids']);
					$this->load->model('mod_m');
					$mod_list=$this->mod_m->getModList(array());
					
					foreach ($mod_list as $mdk=>$mdv){
						$new_mod_list[$mdv['id']]=$mdv['model'];
					}
	
					foreach ($user_mod_arr as $mk=>$mv){
						if(isset($new_mod_list[$mv])){
							$user_mod_list[]=$new_mod_list[$mv];
						}
						else{
							unset($user_mod_arr[$mk]);
						}
					}
				$data['user_mod_list']=$s_arr['user_mod_list']=$user_mod_list;
				se_create($s_arr);
			}
			//用户模块权限 end
			$user_mod_list=se_item('user_mod_list');
			$userInfo=se_item('userInfo');
			$data['user_mod_list']=$user_mod_list;
			$data['userInfo']=$userInfo;
			$this->load->view('admin/index',$data);
			
		
		
	}
}
?>