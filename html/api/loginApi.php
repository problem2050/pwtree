<?php
header('Content-type: application/json;charset=utf-8');
//echo phpinfo();

require_once($_SERVER["Root_Path"]."/inc/bootstrap.php");
require_once($_SERVER["Root_Path"]."/inc/api_function.php");
require_once($_SERVER["Root_Path"]."/inc/public_function.php");

$username= isset($_REQUEST['username'])?$_REQUEST['username']:'';
$password= isset($_REQUEST['password'])?$_REQUEST['password']:'';

if($username=='')
{
	echo json_encode(array("CODE"=>"-10000","MSG"=>"用户名不能为空！","DATA"=>array()));
	exit;
}

if($password=='')
{
	echo json_encode(array("CODE"=>"-10000","MSG"=>"密码不能为空!","DATA"=>array()));
	exit;
}

_loginMe($username,$password);

function _loginMe($username,$password){
	
	$pms = User_Login::getMerinfoUserId($username,md5($password));
   
  if($pms){
  	
  	$userid = $pms['fid'];
  	$username = $pms['username'];
  	$randstr = getRandStr(6);
  	
  	$token = strtoupper(md5($userid."-".$username."-".$randstr));
  	
  	$m = new Memcache();
  	$m->connect('127.0.0.1', 11211);
 
    $m->set("apitokenid:".$token,$pms,0,time() + 30*60); //30分钟
        
    User_Login::insertMerinfoLoginLog($username,getIp());
    
    echo json_encode(array("STATE"=>"10000","MSG"=>'登录成功',"DATA"=>array("token"=>$token)));
    exit;
      
  }else{
   echo json_encode(array("STATE"=>"-10000","MSG"=>'登录失败',"DATA"=>array()));
   exit;
  }
  
}


?>
