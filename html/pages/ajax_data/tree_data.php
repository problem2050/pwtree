<?php
require_once($_SERVER["Root_Path"]."/inc/bootstrap.php");
require_once($_SERVER["Root_Path"]."/inc/function.php");
require_once($_SERVER["Root_Path"]."/html/pages/public/checkLogin.php");

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
}else if($treetype=='tree4'){
	$userid= isset($_REQUEST['userid'])?$_REQUEST['userid']:'';
	$groupid= isset($_REQUEST['groupid'])?$_REQUEST['groupid']:'';

   
	if($siteid!='' && intval($siteid)>0){
		echo  getBuildTree4($siteid,$merid,$userid,$groupid);
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
	
 }else if($treetype=='killtreenode')
{
   $treenodeid= isset($_REQUEST['treenodeid'])?$_REQUEST['treenodeid']:'';
   
 
   if($treenodeid!='' ){
		$res =   Pwtree_Nodes::delTreenode($merid,$treenodeid);
		echo json_encode(array("STATE"=>($res==true)?1:-1,"MSG"=>'删除出错',"DATA"=>array()));
		exit;
	}else{		
	  echo json_encode(array("STATE"=>-1,"MSG"=>'节点没选择',"DATA"=>array()));
      exit;	
	}
}else{
    if($siteid!='' && intval($siteid)>0){
		echo  getBuildTree2($siteid,'','',$merid);
	}else{
		
		echo json_encode(array());
	}
}


?>


