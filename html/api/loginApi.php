<?php
header('Content-type: application/json;charset=utf-8');
//echo phpinfo();

require_once($_SERVER["Root_Path"]."/inc/bootstrap.php");
require_once($_SERVER["Root_Path"]."/inc/api_function.php");
require_once($_SERVER["Root_Path"]."/inc/public_function.php");

$mername= isset($_REQUEST['mername'])?$_REQUEST['mername']:'';
$password= isset($_REQUEST['password'])?$_REQUEST['password']:'';
$expiretime= isset($_REQUEST['expiretime'])?$_REQUEST['expiretime']:30;

if($mername=='')
{
	echo json_encode(array("CODE"=>"-10000","MSG"=>"用户名不能为空！","DATA"=>array()));
	exit;
}

if($password=='')
{
	echo json_encode(array("CODE"=>"-10000","MSG"=>"密码不能为空!","DATA"=>array()));
	exit;
}

_loginMe($mername,$password,$expiretime);

function _loginMe($mername,$password,$expiretime){
	
	$pms = User_Login::getMerinfoUserId($mername,md5($password));
   
  if($pms){
  	
  	$merid = $pms['fid'];
  	$mername = $pms['username'];
  	$randstr = getRandStr(6);
  	
  	$token = strtoupper(md5($merid."-".$mername."-".$randstr));
  	
  	$m = new Memcache();
  	$m->connect('127.0.0.1', 11211);
 
    $m->set("apitokenid:".$token,$pms,0,time() + $expiretime*60); //30分钟
        
    User_Login::insertMerinfoLoginLog($mername,getIp(),99,1);
    
    echo json_encode(array("STATE"=>"10000","MSG"=>'登录成功',"DATA"=>array("mertoken"=>$token)));
    exit;
      
  }else{
    User_Login::insertMerinfoLoginLog($mername,getIp(),99,-1);
   echo json_encode(array("STATE"=>"-10000","MSG"=>'登录失败',"DATA"=>array()));
   exit;
  }
  
}


?>
