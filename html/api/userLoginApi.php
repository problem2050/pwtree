<?php
header('Content-type: application/json;charset=utf-8');
//echo phpinfo();

require_once($_SERVER["Root_Path"]."/inc/bootstrap.php");
require_once($_SERVER["Root_Path"]."/inc/api_function.php");
require_once($_SERVER["Root_Path"]."/inc/public_function.php");
require_once($_SERVER["Root_Path"]."/html/api/checkApiLogin.php");


$username= isset($_REQUEST['username'])?$_REQUEST['username']:'';
$password= isset($_REQUEST['password'])?$_REQUEST['password']:'';
$expiretime= isset($_REQUEST['expiretime'])?$_REQUEST['expiretime']:30;


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

_loginMe($merid,$username,$password,$expiretime);

function _loginMe($merid,$username,$password,$expiretime){
	
	$pms = User_Login::getUserLoginOne($merid,$username,$password);
  
  if($pms){
  	
  	if (intval($pms['valid'])==1){
      echo json_encode(array("STATE"=>"-99998","MSG"=>'用户禁用状态',"DATA"=>array()));
      exit;  			
  	}
  	
  	$userid = $pms['fid'];
  	$username = $pms['username'];
  	$randstr = getRandStr(6);
  	
  	$token = strtoupper(md5($userid."-".$username."-".$randstr));
  	
  	$m = new Memcache();
  	$m->connect('127.0.0.1', 11211);
 
    $m->set("userapitokenid:".$token,$pms,0,time() + $expiretime*60); //30分钟
        
    User_Login::insertMerinfoLoginLog($username,getIp(),1,1);
    
    echo json_encode(array("STATE"=>"10000","MSG"=>'登录成功',"DATA"=>array("usertoken"=>$token,"userinfo"=>$pms)));
    exit;
      
  }else{
  	User_Login::insertMerinfoLoginLog($username,getIp(),1,-1);
   echo json_encode(array("STATE"=>"-10000","MSG"=>'登录失败',"DATA"=>array()));
   exit;
  }
  
}


?>
