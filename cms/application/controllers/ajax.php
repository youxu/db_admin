<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller {
	function __construct(){
		parent::__construct();
	}
	function index(){
	
	}
	function is_same_username(){
		$post=$this->input->post();
		if(isset($post['name']) && !empty($post['name'])){
			$this->load->model('user_m');
			$nums=$this->user_m->isSameName($post['name']);
			if($nums>0){
				echo "false";
			}
			else{
				echo "true";
			}
		}
	}
}
?>