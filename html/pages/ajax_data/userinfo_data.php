<?php
require_once($_SERVER["Root_Path"]."/inc/bootstrap.php");
require_once($_SERVER["Root_Path"]."/inc/function.php");
require_once($_SERVER["Root_Path"]."/html/pages/public/checkLogin.php");
 
$act = isset($_REQUEST['act'])?$_REQUEST['act']:'';

if($act =='killuserid'){
	
	$userid = isset($_REQUEST['userid'])?$_REQUEST['userid']:'';	
	if($userid!=''){
		$pms =  User_Userinfo::delUserinfoid($merid,$userid);
		echo json_encode(array("STATE"=>($pms)?"1":"-1","MSG"=>'',"DATA"=>array()));
        exit;
	}else{
		  echo json_encode(array("STATE"=>"-1","MSG"=>'未选择用户',"DATA"=>array()));
		  exit;
	}
}
if($act =='killdepid'){
	
	$depid = isset($_REQUEST['depid'])?$_REQUEST['depid']:'';	
	if($depid!=''){
		$pms =  User_Userinfo::delDepid($merid,$depid);
		 
		echo json_encode(array("STATE"=>($pms)?"1":"-1","MSG"=>'',"DATA"=>array()));
        exit;
	}else{
		  echo json_encode(array("STATE"=>"-1","MSG"=>'未选择',"DATA"=>array()));
		  exit;
	}
}

if($act =='adduserid'){
	
	$username = isset($_REQUEST['username'])?$_REQUEST['username']:'';	
	$truename = isset($_REQUEST['truename'])?$_REQUEST['truename']:'';	
	$password = isset($_REQUEST['password'])?$_REQUEST['password']:'';	
	$email = isset($_REQUEST['email'])?$_REQUEST['email']:'';	
	$phone = isset($_REQUEST['phone'])?$_REQUEST['phone']:'';		
	$dep = isset($_REQUEST['dep'])?$_REQUEST['dep']:'';
	
	if($username!=''){
		$pms = $res = User_Userinfo::insertUserinfo($merid,$username,$truename,$password,$email,$phone,$dep);
		//var_dump($pms);
		echo json_encode(array("STATE"=>($pms)?"1":"-1","MSG"=>'',"DATA"=>array()));
        exit;
	}else{
		  echo json_encode(array("STATE"=>"-1","MSG"=>'未填写信息',"DATA"=>array()));
		  exit;
	}
}
?>


