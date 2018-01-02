<?php
header('Content-type: application/json;charset=utf-8');

require_once($_SERVER["Root_Path"]."/inc/bootstrap.php");
require_once($_SERVER["Root_Path"]."/inc/api_function.php");
require_once($_SERVER["Root_Path"]."/html/api/checkApiLogin.php");


$page = 1;
$pagesize = 10;


$page= isset($_REQUEST['page'])?$_REQUEST['page']:1;
$pagesize= isset($_REQUEST['pagesize'])?$_REQUEST['pagesize']:10;
$depname = isset($_REQUEST['depname'])?$_REQUEST['depname']:'';
//var_dump($res);


$res = User_Userinfo::getDepmlist($merid,$depname,$page,$pagesize);

echo json_encode(array("CODE"=>"10000","MSG"=>"SUCCESS","DATA"=>$res));


exit;


?>