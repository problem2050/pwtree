<?php
require_once($_SERVER["Root_Path"]."/inc/bootstrap.php");
require_once($_SERVER["Root_Path"]."/inc/api_function.php");
require_once($_SERVER["Root_Path"]."/inc/public_function.php");
require_once($_SERVER["Root_Path"]."/html/api/checkApiLogin.php");

		$m = new Memcache();
		$m->connect('127.0.0.1', 11211);
  	
		$userInfo = $m->get('apitokenid:'.$token);
		if(!$userInfo){
			 echo json_encode(array("STATE"=>"-10000","MSG"=>'未登录',"DATA"=>array()));
       exit;
		}	
		$m->set("apitokenid:".$token,$userInfo,0,time() + 30*60);
		
		echo json_encode(array("STATE"=>"10000","MSG"=>'',"DATA"=>$userInfo));
		
?>
