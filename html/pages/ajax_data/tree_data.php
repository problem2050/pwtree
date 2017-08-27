<?php
require_once($_SERVER["Root_Path"]."/inc/bootstrap.php");
require_once($_SERVER["Root_Path"]."/inc/function.php");

$siteid= isset($_REQUEST['siteid'])?$_REQUEST['siteid']:'';
$treetype= isset($_REQUEST['treetype'])?$_REQUEST['treetype']:'';

if($treetype=='tree3'){
	$userid= isset($_REQUEST['userid'])?$_REQUEST['userid']:'';
	$groupid= isset($_REQUEST['groupid'])?$_REQUEST['groupid']:'';

   
	if($siteid!='' && intval($siteid)>0){
		echo  getBuildTree3($siteid,$merid,$userid,$groupid);
	}else{
		
		echo json_encode(array());
		exit;
	}
}else if($treetype=='usertree'){
	 $userid= isset($_REQUEST['userid'])?$_REQUEST['userid']:'';
   $groupid= isset($_REQUEST['groupid'])?$_REQUEST['groupid']:'';
	if($siteid!='' && intval($siteid)>0){
		echo  getUserBuildTree($siteid,$merid,$userid,$groupid);
	}else{
		
		echo json_encode(array());
	}
	
 }else{
    if($siteid!='' && intval($siteid)>0){
		echo  getBuildTree2($siteid);
	}else{
		
		echo json_encode(array());
	}
}


?>


