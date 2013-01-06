<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 登录模块
 */
class Login_m extends CI_Model{
	public $tab;
	public function __construct(){
		parent::__construct();
		$this->tab='captcha';
	}
	public function isLogin(){
		$userinfo=se_item('userInfo');
		if(isset($userinfo) && !empty($userinfo)){
			return true;
		}
		else{
			showmessage('未登录,3秒后返回登陆页','/index.php/login');
		}
	}
	/**
	 * 建立验证码
	 *
	 * @param unknown_type $cap_arr
	 * @return unknown
	 */
	public function new_cap($cap_arr){
		if(!is_array($cap_arr)){
			return false;
		}
		$query = $this->db->insert_string($this->tab, $cap_arr);
		$db_query=$this->db->query($query);	
	}
	/**
	 * 检测验证码
	 *
	 * @param unknown_type $captcha
	 * @return unknown
	 */
	public function check_cap($captcha){
		if(empty($captcha) || !is_numeric($captcha) || $captcha<'1000' || $captcha >'10000'){
			return false;
		}
		// 首先删除旧的验证码
		$expiration = time()-7200; // 2小时限制
		$this->db->query("DELETE FROM captcha WHERE captcha_time < ".$expiration); 
		
		// 然后再看是否有验证码存在:
		$sql = "SELECT COUNT(*) AS count FROM captcha WHERE word = ? AND ip_address = ? AND captcha_time > ?";
		$binds = array($captcha, $this->input->ip_address(), $expiration);
		$query = $this->db->query($sql, $binds);
		$row = $query->row();

		if ($row->count == 0)
		{
		    return false;
		}
		else{
			return true;
		}
	}
}
?>