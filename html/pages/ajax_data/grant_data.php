<?php
require_once($_SERVER["Root_Path"]."/inc/bootstrap.php");
require_once($_SERVER["Root_Path"]."/inc/function.php");

 $act = isset($_REQUEST['act'])?$_REQUEST['act']:'';


if($act =='grantpemid'){		
	$useridList = isset($_REQUEST['useridlist'])?$_REQUEST['useridlist']:0;
	$groupid = isset($_REQUEST['groupid'])?$_REQUEST['groupid']:0;
	$siteid = isset($_REQUEST['siteid'])?$_REQUEST['siteid']:'';
	$pemidList = isset($_REQUEST['pemidlist'])?$_REQUEST['pemidlist']:'';


 if($pemidList=='' or $useridList==''){
   echo json_encode(array("STATE"=>"-1","MSG"=>"未选择用户或者节点","DATA"=>array()));
   exit;  	
  }

  if($siteid=='' or $siteid<=0){
   echo json_encode(array("STATE"=>"-1","MSG"=>"站点ID错误","DATA"=>array()));
   exit;  	
  }
 
  $pms = Pwtree_Grant::insertPermissionTreeNav($useridList,$siteid,$merid,$groupid,$pemidList);
  echo json_encode(array("STATE"=>($pms)?"1":"-1","MSG"=>'',"DATA"=>array()));
  exit;
}
 
?>


