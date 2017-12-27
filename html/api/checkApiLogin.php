<?php
require_once($_SERVER["Root_Path"]."/inc/bootstrap.php");
require_once($_SERVER["Root_Path"]."/inc/api_function.php");

$token = isset($_REQUEST['token'])?$_REQUEST['token']:'';

$m = new Memcache();
$m->connect('127.0.0.1', 11211);

$userInfo = $m->get('apitokenid:'.$token);
if(!$userInfo){
	 echo json_encode(array("STATE"=>"-1","MSG"=>'未登录',"DATA"=>array()));
   exit;
}

$m->set("apitokenid:".$token,$userInfo,0,time() + 30*60);

?>
