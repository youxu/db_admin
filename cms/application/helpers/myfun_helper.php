<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
function admin_css($css=''){
	if(isset($css) && !empty($css)){
		if(is_array($css)){
			$new_css='';
			foreach ($css as $val){
				$new_css .= '<link href="'.$val.'" rel="stylesheet" type="text/css" />';
				$new_css .= "\n";
			}
		}
		else{
			$new_css  = '<link href="'.$val.'" rel="stylesheet" type="text/css" />';
			$new_css .= "\n";
		}
	}
	else{
		$new_css = '<link href="/admin_style/style.css" rel="stylesheet" type="text/css" />';
		$new_css .= "\n";
	}
	return $new_css;
}
function admin_js($js=''){
	if(isset($js) && !empty($js)){
		if(is_array($js)){
			$new_js='';
			foreach ($js as $jv){
				
				$new_js .= '<script type="text/javascript" src="'.$jv.'"></script>';
				$new_js .= "\n";
			}
		}
		else{
			$new_js = '<script type="text/javascript" src="'.$jv.'"></script>';
			$new_js .= "\n";
		}
	}
	else{
		$new_js  = '<script type="text/javascript" src="/admin_style/js/jquery.js"></script>';
		$new_js .= "\n";
	}
	
	return $new_js;
}

function my_alert($message,$url){
	echo '<script>alert("'.$message.'");window.location.href("'.$url.'")</script>';
}

?>