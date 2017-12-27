<?php
require_once($_SERVER["Root_Path"]."/inc/bootstrap.php");
require_once($_SERVER["Root_Path"]."/inc/public_function.php");
require_once($_SERVER["Root_Path"]."/html/pages/public/checkLogin.php");
function LoginOut(){
		
		$HOST_COOKIEID = getHostCookie();		
		$userToken = isset($_COOKIE[$HOST_COOKIEID])?$_COOKIE[$HOST_COOKIEID]:false;
		if(!$userToken){
			return false;
		}
			 
		$m = new Memcache();
  	$m->connect('127.0.0.1', 11211);  	
		$m->delete('tokenid:'.$userToken);	  
	}

LoginOut();

$MER_USER_INFO = checkIsLogin();

if(!$MER_USER_INFO){		
	header('Location:/pages/login.php');
	exit;
}
