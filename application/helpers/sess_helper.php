<?php 

function se_create($params) {		
		if(!isset($_SESSION))
		{
			session_start ();
		}
		foreach ( $params as $k => $v ) {
			if ($v) {
				$_SESSION [$k] = $v;
			}
		}
	}
function se_unset($sesarray) {
if(!isset($_SESSION))
		{
			session_start ();
		}
	foreach ( $sesarray as $k => $v ) {
		if (is_my_session ( $k )) {
			unset($_SESSION[$K]);
		}
	}
}

function se_item($name){
if(!isset($_SESSION))
		{
			session_start ();
		}
	return (!isset($_SESSION[$name])) ? FALSE : $_SESSION[$name];
}

/**
 * �????SESSION
 *
 */
function se_destroy(){
if(!isset($_SESSION))
		{
			session_start ();
		}
	session_destroy();
}

?>