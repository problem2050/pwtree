<?php
require_once($_SERVER["Root_Path"]."/inc/bootstrap.php");
require_once($_SERVER["Root_Path"]."/inc/api_function.php");

$token = isset($_REQUEST['usertoken'])?$_REQUEST['usertoken']:'';

$m = new Memcache();
$m->connect('127.0.0.1', 11211);

$userInfo = $m->get('userapitokenid:'.$token);

if(!$userInfo){
	 echo json_encode(array("STATE"=>"-99996","MSG"=>'有户未登录',"DATA"=>array()));
   exit;
}
$userid = isset($userInfo['fid'])?$userInfo['fid']:"";

$m->set("userapitokenid:".$token,$userInfo,0,time() + 30*60);

?>
