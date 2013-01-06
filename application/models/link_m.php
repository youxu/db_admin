<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 链接
 */
class Link_m extends CI_Model{
	public $tab;
	public function __construct(){
		parent::__construct();
		$this->tab='link';
	}
	/**
	 * 检查用户名重复
	 *
	 * @param unknown_type $name
	 * @return unknown
	 */
	public function isSameName($name){
		if (isset($name) && !empty($name)) {
			$post['name']=$name;
			
			$this->db->select('id');

			$query=$this->db->get_where($this->tab,$post);
			$num=$query->num_rows();
			return $num;
		}
		else{
			return false;
		}
		
	}
	/**
	 * 添加项目组
	 */
	public function addLink($a){
		if(!is_array($a)){
			return false;
		}
		$return=$this->db->insert($this->tab,$a);	
		return $return;
	}
	/**
	 * 编辑项目组
	 */
	public function updateLink($a,$where){
		if(!is_array($a) || !is_array($where)){
			return false;
		}
		$return=$this->db->update($this->tab,$a,$where);
		return $return;
	}
	/**
	 * 列表数目
	 */
	public function getProjectGListNum($where,$limit='')
	{
		if(!empty($limit)){
			$this->db->limit($limit);
		}
		$query=$this->db->get_where($this->tab,$where);
		$return=$query->num_rows();
		return $return;
	}
	/**
	 * 用户列表
	 *
	 * @param unknown_type $where
	 * @param unknown_type $limit
	 * @return unknown
	 */
	public function getProjectGList($where,$num,$offer='0')
	{
		$this->db->order_by('order_num','desc');
		$query=$this->db->get_where($this->tab,$where,$num,$offer);

		$return=$query->result_array();
		return $return;
	}
    /**
     *  通过id获得项目组信息
     * @param <type> $id
     * @return <type>
     */
        public function getProjectInfoById($id){
            $where['is_del']='1';
            $where['id']=$id;
            $query=$this->db->get_where($this->tab,$where);
            $return=$query->row_array();
            return $return;
        }
       /**
        * 删除项目组
        *
        * @param unknown_type $id
        * @return unknown
        */
      public function delProjectGroup($id){
		if(isset($id) && !empty($id)){
			$where['id']=$id;
			$a['is_del']='0';
			$query=$this->db->update($this->tab,$a,$where);
			return $query;
		}
		else{
			return false;
		}
	}  
	/**
	 * 更改顺序
	 *
	 * @param unknown_type $new_arr
	 */
	public function orderNum($new_arr){
			foreach ($new_arr as $k=>$v){
				$this->db->update($this->tab,array('order_num'=>$v),array('id'=>$k));
			}			
	}
	/**
	 * 通过id获得项目组详细信息
	 *
	 * @param unknown_type $id
	 * @return unknown
	 */
	public function getProjectGroupInfo($id){
		if(!empty($id)){
			$where['is_del']='1';
			$where['status']='1';
			$where['id']=$id;
			$query=$this->db->get_where($this->tab,$where);
			if($query){
				return $query->row_array();
			}
			else{
				return  false;
			}
		}
		else{
			return  false;
		}
	}
     /**
	 * 添加项目组成员
	 */
	public function addUserProjectGroup($a){
		if(!is_array($a)){
			return false;
		}
                foreach($a['user_list'] as $k=>$v){
                    $add_arr=array();
                    $add_arr['uid']=$v;
                    $add_arr['project_id']=$a['id'];
                    if(!$this->isHaveNumInUPtab($v,$a['id'])){
                        $return=$this->db->insert($this->pgu_tab,$add_arr);
                    }
                    
                }
		return true;
	}
	/**
	 * 分配项目给项目组
	 *
	 * @param unknown_type $a
	 * @param unknown_type $where
	 * @return unknown
	 */
	public function addProjectToProjectGroup($a,$where){
		$query=$this->db->update($this->tab,$a,$where);
		return $query;
	}
	/**
	 * 删除项目组成员
	 *
	 * @param unknown_type $a
	 * @return unknown
	 */
	public function delUserProjectGroup($pid,$ulist){
		if(!is_array($ulist) || empty($pid)){
			return false;
		}
        foreach($ulist as $k=>$v){
            $where=array();
            $where['project_id']=$pid;
            $where['uid']=$v;
            $query=$this->db->delete($this->pgu_tab,$where);
        }
		return true;
	}

        /**
         * 根据人员和项目组id查询是否存在
         * @param <type> $uid
         * @param <type> $pid
         * @return <type>
         */
        public function isHaveNumInUPtab($uid,$pid){
            $where['uid']=$uid;
            $where['project_id']=$pid;
            $query=$this->db->get_where($this->pgu_tab,$where);
            if($query->num_rows()>0){
                return true;
            }
            else{
                return false;
            }

        }
        /**
         * 通过项目组或人员查询对应列表
         * @param <type> $project_id
         * @param <type> $user_id
         * @return <type>
         */
        public function getUserListFUserproject($project_id='',$user_id=''){
            if(!empty($project_id)){
                $where['user_projectgroup.project_id']=$project_id;
            }
            if(!empty($user_id)){
                $where['user_projectgroup.uid']=$user_id;
            }
            if(!empty($project_id) || !empty($user_id)){
                $this->db->select('user_projectgroup.uid,user_projectgroup.project_id,user.chname');
                $this->db->join('user', 'user.id = user_projectgroup.uid','left');
                $query=$this->db->get_where($this->pgu_tab,$where);
                $return=$query->result_array();
                return $return;
            }
            else{
                return false;
            }
        }
}