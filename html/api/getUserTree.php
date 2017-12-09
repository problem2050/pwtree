<?php
header('Content-type: application/json;charset=utf-8');
//echo phpinfo();

require_once($_SERVER["Root_Path"]."/inc/bootstrap.php");
require_once($_SERVER["Root_Path"]."/inc/api_function.php");


$token = isset($_REQUEST['token'])?$_REQUEST['token']:'';
//$merid = isset($_REQUEST['merid'])?$_REQUEST['merid']:'';


$userid= isset($_REQUEST['userid'])?$_REQUEST['userid']:'';
$siteid= isset($_REQUEST['siteid'])?$_REQUEST['siteid']:'';
//$groupid= isset($_REQUEST['groupid'])?$_REQUEST['groupid']:'';

if($siteid=='' || intval($siteid)<=0)
{
	echo json_encode(array("CODE"=>"-10000","MSG"=>"参数错误,站点ID不能为空或者非法的站点ID"));
	exit;
}

if($userid=='' || intval($userid)<=0)
{
	echo json_encode(array("CODE"=>"-10000","MSG"=>"参数错误,USERID不能为空或者非法的USERID"));
	exit;
}

echo ApiGetUserBuildTree($siteid,$merid,$userid,$groupid='');

exit;
/*
$memcache_obj = new Memcache;
$memcache_obj->connect('localhost', 11211);
$ret = $memcache_obj->set("test001", "value001");
var_dump($ret);
echo $memcache_obj->get("test001");*/


?>
