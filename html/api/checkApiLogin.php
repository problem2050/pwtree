<?php
require_once($_SERVER["Root_Path"]."/inc/bootstrap.php");
require_once($_SERVER["Root_Path"]."/inc/api_function.php");

$token = isset($_REQUEST['mertoken'])?$_REQUEST['mertoken']:'';

$m = new Memcache();
$m->connect('127.0.0.1', 11211);

$userInfo = $m->get('apitokenid:'.$token);

if(!$userInfo){
	 echo json_encode(array("STATE"=>"-99999","MSG"=>'商户未登录',"DATA"=>array()));
   exit;
}
$merid = isset($userInfo['fid'])?$userInfo['fid']:"";

$m->set("apitokenid:".$token,$userInfo,0,time() + 30*60);

?>
