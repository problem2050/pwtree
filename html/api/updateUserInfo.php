<?php
header('Content-type: application/json;charset=utf-8');
//echo phpinfo();

require_once($_SERVER["Root_Path"]."/inc/bootstrap.php");
require_once($_SERVER["Root_Path"]."/html/api/checkApiLogin.php");
require_once($_SERVER["Root_Path"]."/inc/api_function.php");

require_once($_SERVER["Root_Path"]."/html/api/checkUserApiLogin.php");

$username=isset($_REQUEST['username'])?$_REQUEST['username']:'';
$truename=isset($_REQUEST['truename'])?$_REQUEST['truename']:'';
$password=isset($_REQUEST['password'])?$_REQUEST['password']:'';
$email=isset($_REQUEST['email'])?$_REQUEST['email']:'';
$phone=isset($_REQUEST['phone'])?$_REQUEST['phone']:'';
$dep=isset($_REQUEST['dep'])?$_REQUEST['dep']:'';
$isvalid = isset($_REQUEST['isvalid'])?$_REQUEST['isvalid']:'';

$uid=isset($_REQUEST['uid'])?$_REQUEST['uid']:'';




if($uid=='' || intval($uid)<=0 )
{
	echo json_encode(array("CODE"=>"-10000","MSG"=>"UID不能为空","DATA"=>array()));
	exit;
}

if($username=='' )
{
	echo json_encode(array("CODE"=>"-10000","MSG"=>"用户名不能为空","DATA"=>array()));
	exit;
}

if($password=='' )
{
	echo json_encode(array("CODE"=>"-10000","MSG"=>"密码不能为空","DATA"=>array()));
	exit;
}

$res = User_Userinfo::updateUserinfo($uid,$merid,$username,$truename,$password,$email,$phone,$dep,$isvalid);

echo json_encode(array("CODE"=>"10000","MSG"=>"SUCCESS","DATA"=>$res));

exit;



?>
