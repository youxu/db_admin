<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Login extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('login_m');
		$this->load->model('user_m');
		//$this->load->library('epmlogin');
	}
	/**
	 * 登录模块主函数
	
	 * @author youxu
	 * @param null
	 * @return null
	 */
	public function index(){
		$post=$this->input->post();
		$data['username']='';
		$data['error']='';
		if (!empty($post['captcha'])) {
			$check_cap=$this->login_m->check_cap($post['captcha']);
			if($check_cap){
				$db_password=$this->user_m->getUserPassword($post['username']);
				if(!$db_password){
					$data['error']='登录名错误';
				}
				else{
					if(md5($post['password']) == $db_password){
						$username=$se_arr['username']=$post['username'];
						if(isset($username) && !empty($username)){
							$userInfo=$this->user_m->getUserInfoByName($username);
							if(isset($userInfo['id']) && !empty($userInfo['id'])){			
								$s_arr=array();
								$s_arr['userInfo']=$userInfo;
								se_create($s_arr);
								showmessage('登录成功','/index.php/admin/admin_index','1');
							}
							else{
								$data['error']='无用户信息';
							}
						}
					}
					else{
						$data['error']='密码错误';
					}
				}
			}
			else{
				$data['error']='验证码错误';
			}
		}
		$this->load->helper('captcha');
		$vals = array(
			'word' => rand(1000, 10000),
		    'img_path' => './captcha/',
		    'img_url' => base_url().'captcha/',
		    'img_width' => '150',
    		'img_height' => '30',
		    );
		
		$cap = create_captcha($vals);
		$cap_arr = array(
		    'captcha_time' => $cap['time'],
		    'ip_address' => $this->input->ip_address(),
		    'word' => $cap['word']
	    );
	    $this->login_m->new_cap($cap_arr);
		
		$data['cap']=$cap;
		$data['css']=$this->config->item('admin_css');		
		$data['js']=$this->config->item('admin_js');
		$js_view=$this->config->item('view_js_url');
			array_push($data['css'],'/admin_style/css/Skins/Blue/jbox.css');
			array_push($data['js'],'/admin_style/js/jquery.jBox-2.3.min.js','/admin_style/js/i18n/jquery.jBox-zh-CN.js','/admin_style/js/jquery.validate.js','/admin_style/js/jquery.metadata.js',$js_view.'login/login.js');
		$this->load->view('admin/header',$data);
		$this->load->view('admin/login');
		$this->load->view('admin/footer');
		
		
	}
	/**
	 * 退出系统
	 * @author youxu
	 * @param null
	 * @return null
	 */
	public function logout(){
		se_destroy();
		showmessage('退出登录，将跳转到登陆页','/index.php/login');
		#header('location:'.$this->config->item('logouturl'));
		
	}
	
}
?>