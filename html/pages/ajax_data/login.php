<?php
require_once($_SERVER["Root_Path"]."/inc/bootstrap.php");
require_once($_SERVER["Root_Path"]."/inc/public_function.php");

$act = isset($_REQUEST['act'])?$_REQUEST['act']:'';


if($act =='register'){
	$truename = isset($_REQUEST['fullname'])?$_REQUEST['fullname']:0;
	$email = isset($_REQUEST['email'])?$_REQUEST['email']:0;
	$username = isset($_REQUEST['username'])?$_REQUEST['username']:'';
	$regpassword = isset($_REQUEST['regpassword'])?$_REQUEST['regpassword']:'';
	$rpassword = isset($_REQUEST['rpassword'])?$_REQUEST['rpassword']:'';


 if ($truename==''){
	   echo json_encode(array("STATE"=>"-1","MSG"=>"真实姓名不能为空","DATA"=>array()));
	   exit;  	
	}

 if($email=='' || strstr($email, '@')==''){
   echo json_encode(array("STATE"=>"-1","MSG"=>"Email不合法","DATA"=>array()));
   exit;  	
  }
  
 if($username=='' || $regpassword==''){
   echo json_encode(array("STATE"=>"-1","MSG"=>"用户名或密码不能为空","DATA"=>array()));
   exit;  	
  }
  
 if($regpassword!=$rpassword ){
   echo json_encode(array("STATE"=>"-1","MSG"=>"两次密码不一致！","DATA"=>array()));
   exit;  	
  }
    
  $pms = User_Login::insertMerinfo($username,$truename,md5($regpassword),$email);
  
   _loginMe($username,$regpassword);
   
  //echo json_encode(array("STATE"=>($pms)?"1":"-1","MSG"=>'',"DATA"=>array()));
  //exit;
}

if($act =='login'){	
	$username = isset($_REQUEST['username'])?$_REQUEST['username']:'';
	$password = isset($_REQUEST['password'])?$_REQUEST['password']:'';
  
 if($username=='' || $password==''){
   echo json_encode(array("STATE"=>"-1","MSG"=>"用户名或密码不能为空","DATA"=>array()));
   exit;  	
  }  

  _loginMe($username,$password);
 
}


function _loginMe($username,$password){
	
	 $pms = User_Login::getMerinfoUserId($username,md5($password));
   
  if($pms){
  	$userid = $pms['fid'];
  	$username = $pms['username'];
  	$randstr = getRandStr(6);
  	
  	$token = strtoupper(md5($userid."-".$username."-".$randstr));
  	
  	$m = new Memcache();
  	$m->connect('127.0.0.1', 11211);
 
    $m->set("tokenid:".$token,$pms,0,time() + 30*60); //30分钟
    
    $HOST_COOKIEID = getHostCookie();
    
    $domain = getdomain();
       
    setcookie($HOST_COOKIEID,$token,null,'/',$domain);
    
    User_Login::insertMerinfoLoginLog($username,getIp());
    
    echo json_encode(array("STATE"=>"1","MSG"=>'登录成功',"DATA"=>array()));
    exit;
      
  }else{
 
   echo json_encode(array("STATE"=>($pms)?"1":"-1","MSG"=>'',"DATA"=>array()));
   exit;
  }
  
}

?>


