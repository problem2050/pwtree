<?php
require_once($_SERVER["Root_Path"]."/inc/bootstrap.php");
require_once($_SERVER["Root_Path"]."/inc/function.php");

$groupname = isset($_REQUEST['groupname'])?$_REQUEST['groupname']:'';
$groupabout = isset($_REQUEST['groupabout'])?$_REQUEST['groupabout']:'';
$siteid    = isset($_REQUEST['siteid'])?$_REQUEST['siteid']:'';
$fid    = isset($_REQUEST['fid'])?$_REQUEST['fid']:'';
$act = isset($_REQUEST['act'])?$_REQUEST['act']:'';

if($act =='addgroup'){
	if($siteid!='' && intval($siteid)>0){
		$pms =  User_Group::insertGroupUser($merid,$siteid,$groupname,$groupabout);
		echo json_encode(array("STATE"=>($pms)?"1":"-1","MSG"=>'',"DATA"=>array()));
    exit;
	}else{
		  echo json_encode(array("STATE"=>"-1","MSG"=>'站点ID错误',"DATA"=>array()));
		  exit;
	}
}
if($act =='editgroup'){
	if($siteid!='' && intval($siteid)>0 && intval($fid)>0){
		$pms =  User_Group::updateGroupUser($fid,$merid,$siteid,$groupname,$groupabout);
		echo json_encode(array("STATE"=>($pms)?"1":"-1","MSG"=>'',"DATA"=>array()));
    exit;
	}else{
		  echo json_encode(array("STATE"=>"-1","MSG"=>'站点ID错误',"DATA"=>array()));
		  exit;
	}
}
if($act =='insusertogroup'){
	$siteid    = isset($_REQUEST['siteid'])?$_REQUEST['siteid']:'';
	$userid    = isset($_REQUEST['userid'])?$_REQUEST['userid']:'';
	$groupid    = isset($_REQUEST['groupid'])?$_REQUEST['groupid']:'';
	
	if($siteid!='' && intval($siteid)>0 && intval($groupid)>0){
		$pms=false;
		$pms =  User_Group::insertPermissionGroup($merid,$siteid,$userid,$groupid);
		echo json_encode(array("STATE"=>($pms)?"1":"-1","MSG"=>'',"DATA"=>array()));
        exit;
	}else{
		  echo json_encode(array("STATE"=>"-1","MSG"=>'站点ID错误',"DATA"=>array()));
		  exit;
	}
}
if($act =='delusertogroup'){
	$siteid    = isset($_REQUEST['siteid'])?$_REQUEST['siteid']:'';
	$userid    = isset($_REQUEST['userid'])?$_REQUEST['userid']:'';
	$groupid    = isset($_REQUEST['groupid'])?$_REQUEST['groupid']:'';
	
	if($siteid!='' && intval($siteid)>0 && intval($groupid)>0){
		$pms =  User_Group::delPermissionGroup($merid,$siteid,$userid,$groupid);;
		echo json_encode(array("STATE"=>($pms)?"1":"-1","MSG"=>'',"DATA"=>array()));
    exit;
	}else{
		  echo json_encode(array("STATE"=>"-1","MSG"=>'站点ID错误',"DATA"=>array()));
		  exit;
	}
}
?>


