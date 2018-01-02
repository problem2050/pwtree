<?php
header('Content-type: application/json;charset=utf-8');
//echo phpinfo();

require_once($_SERVER["Root_Path"]."/inc/bootstrap.php");
require_once($_SERVER["Root_Path"]."/html/api/checkApiLogin.php");
require_once($_SERVER["Root_Path"]."/inc/api_function.php");

require_once($_SERVER["Root_Path"]."/html/api/checkUserApiLogin.php");



$siteid= isset($_REQUEST['siteid'])?$_REQUEST['siteid']:'';
//$groupid= isset($_REQUEST['groupid'])?$_REQUEST['groupid']:'';
$groupid = '';


if($siteid=='' || intval($siteid)<=0)
{
	echo json_encode(array("CODE"=>"-10000","MSG"=>"参数错误,站点ID不能为空或者非法的站点ID","DATA"=>array()));
	exit;
}

if($userid=='' || intval($userid)<=0)
{
	echo json_encode(array("CODE"=>"-10000","MSG"=>"参数错误,USERID不能为空或者非法的USERID","DATA"=>array()));
	exit;
}
$grouprs = User_Group::getUserByGroupId($merid,$siteid,$userid);
if(isset($grouprs['groupid'])){
	$groupid = 	$grouprs['groupid'];
	$userid = '';
}



$treedata =  ApiGetUserBuildTree($siteid,$merid,$userid,$groupid);

echo json_encode(array("CODE"=>"10000","MSG"=>"SUCCESS","DATA"=>$treedata));

exit;



?>
