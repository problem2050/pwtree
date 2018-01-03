<?php
header('Content-type: application/json;charset=utf-8');
//echo phpinfo();

require_once($_SERVER["Root_Path"]."/inc/bootstrap.php");
require_once($_SERVER["Root_Path"]."/inc/api_function.php");
require_once($_SERVER["Root_Path"]."/inc/public_function.php");

$token= isset($_REQUEST['usertoken'])?$_REQUEST['usertoken']:'';

if($token=='')
{
	echo json_encode(array("CODE"=>"-10000","MSG"=>"Token不能为空！","DATA"=>array()));
	exit;
}

$m = new Memcache();
$m->connect('127.0.0.1', 11211);  	
$m->delete('userapitokenid:'.$token);	  

echo json_encode(array("CODE"=>"10000","MSG"=>"退出成功","DATA"=>array()));
exit;

?>
