<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
function get_list($arr){
	if(!is_array($arr)){
		return false;
	}
	$ci = & get_instance();
	if(isset($arr['sql']) && !empty($arr['limit'])){
		$sql=$ci->db->query($arr['sql']);
		return $sql->result_array();
	}
	if(isset($arr['select']) && !empty($arr['select'])){
		$ci->db->select($arr['select']);
	}
	if(isset($arr['tab']) && !empty($arr['tab'])){
		$ci->db->from($arr['tab']);
	}
	if(isset($arr['order']) && !empty($arr['order'])){
		$ci->db->order_by($arr['order']);
	}
	if(isset($arr['where']) && !empty($arr['where'])){
		$ci->db->where($arr['where']);
	}
	if(isset($arr['like']) && !empty($arr['like'])){
		$ci->db->like($arr['like']);
	}
	if(isset($arr['group_by']) && !empty($arr['group_by'])){
		$ci->db->group_by($arr['group_by']);
	}
	if(isset($arr['limit']) && !empty($arr['limit'])){
		$ci->db->limit($arr['limit']);
	}
	if(isset($arr['join']) && !empty($arr['join'])){
		$ci->db->join($arr['join'],'left');
	}
	
	$query = $ci->db->get();
	if(isset($arr['num_rows']) && !empty($arr['num_rows'])){
		return $query->num_rows();
	}
	return $query->result_array();
	
}

?>
