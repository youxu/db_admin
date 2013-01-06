<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 模块
 */
class news_m extends CI_Model{
	public $tab;
	public function __construct(){
		parent::__construct();
		$this->tab='news';
		$this->tab_detail='news_detail';
	}
	

	/**
	 * 检查模块名重复
	 *
	 * @param unknown_type $name
	 * @return unknown
	 */
	public function isSameName($name){
		if (isset($name) && !empty($name)) {
			$post['name']=$name;
			$this->db->select('id');
			$post['is_del']='1';
			$query=$this->db->get_where($this->tab,$post);
			$num=$query->num_rows();
			return $num;
		}
		else{
			return false;
		}
		
	}
	/**
	 * 添加模块
	 */
	public function addNews($a){
		if(!is_array($a)){
			return false;
		}
		$insert_news=$news_detail_arr=array();
		$insert_news['title']=$a['title'];
		$insert_news['status']=$a['status'];
		$insert_news['is_top']=$a['is_top'];
		$insert_news['img_url']=$a['img_url'];
		$insert_news['cid']=$a['cid'];
		$insert_news['creat_time']=date('Y-m-d H:i:s',time());
		
		$return=$this->db->insert($this->tab,$insert_news);


		if($return){
			$news_id=$this->db->insert_id();
		
			$news_detail_arr['news_id']=$news_id;
			$news_detail_arr['news_detail']=$a['news_detail'];

			$news_detail=$this->db->insert($this->tab_detail,$news_detail_arr);
	
			return $news_detail;
		}
		else{
			return false;
		}
	}
	/**
	 * 新闻列表数目
	 */
	public function getNewsNum($where,$limit='')
	{
		if(!empty($limit)){
			$this->db->limit($limit);
		}
		$query=$this->db->get_where($this->tab,$where);
		$return=$query->num_rows();
		return $return;
	}
	/**
	 * 获得新闻列表
	 *
	 */
	public function getNewsList($where,$num='0',$offer='0'){
		if($num!='0'){
			$this->db->limit($num,$offer);
		}
		$where['news.is_del']='1';
		$this->db->select('news.id,news.title,news.status,news.is_del,news.cid,news.creat_time,news.is_top,newsclass.name as cname');
		$this->db->join('newsclass', 'news.cid = newsclass.id','left');
		$this->db->order_by('news.creat_time','desc');
		$query=$this->db->get_where($this->tab,$where);
		$return=$query->result_array();
		return $return;
	}
	/**
	 * 通过id获得新闻详细信息内容
	 *
	 * @param unknown_type $id
	 * @param unknown_type $where
	 * @return unknown
	 */
	public function getNewsInfoById($id){
		if(!empty($id) && is_numeric($id)){
			$where['id']=$id;
			$where['is_del']='1';
			$query=$this->db->get_where($this->tab,$where);
			$return=$query->row_array();
			if($query->num_rows()>0){
				return $return;
			}
			else{
				return  false;
			}
		}
		else{
			return false;
		}
	}
	public function getNewsDetail($id){
		if(empty($id)){
			return false;
		}
		$where['news_id']=$id;
		$where['is_del']='0';
		$this->db->select('news_detail');

		$query=$this->db->get_where($this->tab_detail,$where);
//	print_n($query);
		if($query->num_rows>0){
			return $query->row_array();
		}
		else{
			return false;
		}
	
	}
	public function updateNews($a,$where){
		//$a['time']=date('Y-m-d H:i:s',time());
		$c['title']=$a['title'];
		$c['cid']=$a['cid'];
		$c['img_url']=$a['img_url'];
		$c['status']=$a['status'];
		$c['is_top']=$a['is_top'];
		$b['news_detail']=$a['news_detail'];
		unset($a['news_detail']);
		$query=$this->db->update($this->tab,$a,$where);
		$news_id=$where['id'];
		$news_detail_where['news_id']=$news_id;
		$news_detail_query=$this->db->update($this->tab_detail,$b,$news_detail_where);
		if($query && $news_detail_query){
			return true;
		}
		else {
			return false;
		}
	}
	public function delNews($id){
		if(isset($id) && !empty($id)){
			$where['id']=$id;
			$a['is_del']='0';
			$query=$this->db->update($this->tab,$a,$where);
			//$query1=$this->db->update($this->tab_detail,$a,array('news_id'=>$where['id']));
			return $query;
		}
		else{
			return false;
		}
	}
	
	
}
?>