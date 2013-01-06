<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class Newsclass_l {

    /**
	 * 新闻类别处理函数
	 *
	 * @param unknown_type $arr
	 * @param unknown_type $id
	 * @param unknown_type $is_in_add
	 * @return unknown
	 */
	public function newArrForClass($arr,$id='',$is_in_add='0'){
		if(!is_array($arr) || empty($arr)){
			$html = '<select name="pid" id="pid"><option value="0">顶级</option></select>';
		}
		else{
			$select1='';
			$html = '<select name="pid" id="pid">';
			if($id == '0'){
					$select1='selected="selected"';
				}
			if($is_in_add == '1'){
				$html .= '<option value="">请选择</option>';
				$html .= '<option value="0" '.$select1.'>顶级</option>';
			}
			foreach ($arr as $k=>$v){
				$count='';
				$space='';				
				$select='';		
				$count=count(explode('-',$v['path']));
				$count=$count-1;
				for ($i=0;$i<$count;$i++){
					$space .= "--";
				}
				//echo $v['id'].','.$count.','.$v['path'].$v['name']."<br>";
				if($v['id'] == $id){
					$select='selected="selected"';
				}
				
				$html .='<option value='.$v['id'].' '.$select.' >' .$space.$v['name'].'</option>';
			}
			$html .= "<select>";
			
		}
		return $html;
	}
}