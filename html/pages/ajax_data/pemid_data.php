<?php
require_once($_SERVER["Root_Path"]."/inc/bootstrap.php");
require_once($_SERVER["Root_Path"]."/inc/function.php");

$siteid= isset($_REQUEST['siteid'])?$_REQUEST['siteid']:'';
$act = isset($_REQUEST['act'])?$_REQUEST['act']:'';

if($act =='category'){	
	if($siteid!='' && intval($siteid)>0){
		$pms =  Pwtree_Nodes::getCategory($merid,$siteid);
		echo json_encode($pms);
	}else{
		
		echo json_encode(array());
	}
}

if($act =='adpemid'){		
	$treenavid = isset($_REQUEST['treenavid'])?$_REQUEST['treenavid']:0;
	$pemid = isset($_REQUEST['pemid'])?$_REQUEST['pemid']:0;
	$siteid = isset($_REQUEST['siteid'])?$_REQUEST['siteid']:'';
	$categorytype = isset($_REQUEST['categorytype'])?$_REQUEST['categorytype']:'';
	$pemabout =  isset($_REQUEST['pemabout'])?$_REQUEST['pemabout']:'';
 	$pemname =  isset($_REQUEST['pemname'])?$_REQUEST['pemname']:'';

 if($treenavid=='' or intval($treenavid)<=0){
   echo json_encode(array("STATE"=>"-1","MSG"=>"未选择节点错误","DATA"=>array()));
   exit;  	
  }
  
 if($pemid =='' or $pemid <=0 ){
   echo json_encode(array("STATE"=>"-1","MSG"=>"权限ID错误","DATA"=>array()));
   exit;  	
  }
  
 if(strlen($pemid)>5){
   echo json_encode(array("STATE"=>"-1","MSG"=>"权限ID超出5位","DATA"=>array()));
   exit;  	
  }
  
  if($siteid=='' or $siteid<=0){
   echo json_encode(array("STATE"=>"-1","MSG"=>"站点ID错误","DATA"=>array()));
   exit;  	
  }
  $pemid = $merid.$pemid; //权限ID，由商户ID拼上做前缀
  $pms = Pwtree_Nodes::insertPemid($pemid,$pemname,$pemabout,$siteid,$categorytype,$treenavid,$merid);
  echo json_encode(array("STATE"=>($pms)?"1":"-1","MSG"=>$pemid,"DATA"=>array()));
  exit;
}

if($act =='querypemid'){	
	$siteid = isset($_REQUEST['siteid'])?$_REQUEST['siteid']:'';
	$pemid = isset($_REQUEST['pemid'])?$_REQUEST['pemid']:'';
	$pms = Pwtree_Nodes::queryPemidexistent($merid,$siteid,$pemid);
	
	echo json_encode(array("STATE"=>(count($pms)<=0)?"1":"-1","MSG"=>"无数据","DATA"=>$pms));
  exit;
}

if($act =='killpemid'){
	$siteid = isset($_REQUEST['siteid'])?$_REQUEST['siteid']:'';
	$pemid = isset($_REQUEST['pemid'])?$_REQUEST['pemid']:'';
	$pms = Pwtree_Nodes::delPemid($merid,$pemid,$siteid);
	echo json_encode(array("STATE"=>$pms?"1":"-1","MSG"=>"无数据","DATA"=>array()));
  exit;
}


?>


