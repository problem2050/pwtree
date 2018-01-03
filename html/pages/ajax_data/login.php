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
    
  $pms = User_Login::insertMerinfo($username,$truename,md5($regpassword),$email,getIp(),getRandStr(12));
  
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


if($act =='modifypassword'){
		
  $fid=isset($_REQUEST['fid'])?$_REQUEST['fid']:'';
	$username=isset($_REQUEST['username'])?$_REQUEST['username']:'';
	$oldpassword=isset($_REQUEST['oldpassword'])?$_REQUEST['oldpassword']:'';
	$newpassword=isset($_REQUEST['newpassword'])?$_REQUEST['newpassword']:'';
	$renewpassword=isset($_REQUEST['renewpassword'])?$_REQUEST['renewpassword']:'';

 if($username==''){
   echo json_encode(array("STATE"=>"-1","MSG"=>"用户名不能为空","DATA"=>array()));
   exit;  	
  }  
    
 if($oldpassword==''){
   echo json_encode(array("STATE"=>"-1","MSG"=>"旧密码不能为空","DATA"=>array()));
   exit;  	
  }  

 if($newpassword !=$renewpassword){
   echo json_encode(array("STATE"=>"-1","MSG"=>"新密码不一致","DATA"=>array()));
   exit;  	
  }  
  
  $pms = User_Login::getMerinfoUserId($username,md5($oldpassword));
   
  if(!$pms){
    echo json_encode(array("STATE"=>"-1","MSG"=>"旧密码不正确！","DATA"=>array()));
    exit; 
  }
  
  $res = User_Login::updateMerinfoPassWord($fid,$username,md5($newpassword));
  
  if($res){
  	echo json_encode(array("STATE"=>"1","MSG"=>"密码修改成功","DATA"=>array()));
    exit; 
  }else{
  	echo json_encode(array("STATE"=>"-1","MSG"=>"密码修改失败","DATA"=>array()));
    exit; 
  }
 
}

if($act =='modifysecuritycode'){
		
  $fid=isset($_REQUEST['fid'])?$_REQUEST['fid']:'';
	$username=isset($_REQUEST['username'])?$_REQUEST['username']:'';
	$securitycode=isset($_REQUEST['securitycode'])?$_REQUEST['securitycode']:'';

 if($username==''){
   echo json_encode(array("STATE"=>"-1","MSG"=>"用户名不能为空","DATA"=>array()));
   exit;  	
  }  
    
 if($securitycode==''){
   echo json_encode(array("STATE"=>"-1","MSG"=>"安全码不能为空","DATA"=>array()));
   exit;  	
 }  

 
  
  $res = User_Login::updateMerinfoSecurityCode($fid,$username,$securitycode);
  
  if($res){
  	echo json_encode(array("STATE"=>"1","MSG"=>"安全码修改成功","DATA"=>array()));
    exit; 
  }else{
  	echo json_encode(array("STATE"=>"-1","MSG"=>"安全码修改失败","DATA"=>array()));
    exit; 
  }
 
}

if($act =='getnewsecuritycode'){
		
   echo json_encode(array("STATE"=>"1","MSG"=>"","DATA"=>getRandStr(12)));
   exit;  
  
}

if($act =='modifymyinfo'){
		
  $fid=isset($_REQUEST['fid'])?$_REQUEST['fid']:'';
	$username=isset($_REQUEST['username'])?$_REQUEST['username']:'';
	$truename=isset($_REQUEST['truename'])?$_REQUEST['truename']:'';
	$address=isset($_REQUEST['address'])?$_REQUEST['address']:'';
	$mobile=isset($_REQUEST['mobile'])?$_REQUEST['mobile']:'';
	$email=isset($_REQUEST['email'])?$_REQUEST['email']:'';

 if($username==''){
   echo json_encode(array("STATE"=>"-1","MSG"=>"用户名不能为空","DATA"=>array()));
   exit;  	
  }  
    
 if($email==''){
   echo json_encode(array("STATE"=>"-1","MSG"=>"EMAIL不能为空","DATA"=>array()));
   exit;  	
  }  

 if($fid ==''){
   echo json_encode(array("STATE"=>"-1","MSG"=>"错误的参数！","DATA"=>array()));
   exit;  	
  }  
  
  
  $res = User_Login::updateMerinfo($fid,$username,$truename,$mobile,$email,$address);
  
  if($res){
  	echo json_encode(array("STATE"=>"1","MSG"=>"信息修改成功","DATA"=>array()));
    exit; 
  }else{
  	echo json_encode(array("STATE"=>"-1","MSG"=>"信息修改失败","DATA"=>array()));
    exit; 
  }
 
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
    
    User_Login::insertMerinfoLoginLog($username,getIp(),99,1);
    
    echo json_encode(array("STATE"=>"1","MSG"=>'登录成功',"DATA"=>array()));
    exit;

  }else{
   User_Login::insertMerinfoLoginLog($username,getIp(),99,-1);
   echo json_encode(array("STATE"=>"-1","MSG"=>'登录失败',"DATA"=>array()));
   exit;
  }
  
}

?>


