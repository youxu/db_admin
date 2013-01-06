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
function secho($array, $eixt=1) {
	if(is_array($array)) {
		echo '<pre>';
		print_r($array);
		echo '</pre>';
	} else {
		echo '<br>';
		echo $array;
		echo '<br>';
	}
	if($eixt) exit();
}
function showmessage($msg='数据错误',$nurl='/index.php/admin',$sec='3'){
	$html ='';
	$html .= '
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>提示</title>
	<link href="/admin_style/style.css" rel="stylesheet" type="text/css" />
	<link href="/admin_style/css/Skins/Blue/jbox.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="/admin_style/js/jquery.js"></script>
	<script type="text/javascript" src="/admin_style/js/jquery.jBox-2.3.min.js"></script>
	<script type="text/javascript" src="/admin_style/js/i18n/jquery.jBox-zh-CN.js"></script>
	</head>
	<body>
	<script>
	';
	$sec0=$sec*1000;
	$msg = $msg.','.$sec.'秒之后跳转';
	$html  .= '
	$.jBox.tip("'.$msg.'", "error");
	window.setTimeout(function () { window.location.href="'.$nurl.'"  }, '.$sec0.');
	';
	$html .= '</script></body></html>';
	echo $html;
	exit;
}
function print_n($n){
	echo '<pre>';
	print_r($n);
	echo '</pre>';
}
//检查权限
function is_have_power($mod_name,$arr){
	
	if(empty($mod_name) || !is_array($arr)){
		return false;
	}
	if(in_array($mod_name,$arr)){
		return true;
	}
	else{
		return false;
	}
	
}
function test_js($a){
	echo '<script>console.log("'.$a.'")</script>';
}
?>