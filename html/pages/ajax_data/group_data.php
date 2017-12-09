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

if($act =='getpidinuserorgroup'){
	$pemid    = isset($_REQUEST['pemid'])?$_REQUEST['pemid']:'';
	$siteid   = isset($_REQUEST['siteid'])?$_REQUEST['siteid']:'';
  $out_arr  = array();
  
	if($siteid!='' && intval($siteid)>0 && intval($pemid)>0){
		$pms =  User_Group::getPemidInUserorGroup($pemid,$merid,$siteid);;
		if($pms){
			foreach($pms as $k=>$v)
			{
				$tmp_arr  = array("userid"=>'',"groupid"=>'',"groupname"=>'',"username"=>'',"truename"=>'');
				
				$tmp_arr['userid'] = $v['userid'];
				
				if($v['userid']>0 && $v['groupid']<=0)
				  {
				  	$uinfo = User_Userinfo::getUserinfoOne($v['userid'],$merid);
				  	if($uinfo){
				  	 $tmp_arr['username'] = $uinfo['username'];
				  	 $tmp_arr['truename'] = $uinfo['truename'];
				  	}
				  }
				  
				 if($v['userid']<=0 && $v['groupid']>0)
				 {
				 	 $gss = User_Group::getGroupName($merid,$siteid,$v['groupid']);
				 	 if($gss){
				 	  $tmp_arr['groupname'] = $gss[0]['groupname'];	
				 	 }
				 }
				
				$out_arr [] = $tmp_arr;
				 
			}
		}
		echo json_encode(array("STATE"=>count($pms)>0?"1":"-1","MSG"=>'',"DATA"=>$out_arr));
    exit;
	}else{
		  echo json_encode(array("STATE"=>"-1","MSG"=>'站点ID错误',"DATA"=>array()));
		  exit;
	}
}

if($act =='killgroupid'){
	$siteid    = isset($_REQUEST['siteid'])?$_REQUEST['siteid']:'';
	$groupid    = isset($_REQUEST['groupid'])?$_REQUEST['groupid']:'';
	
	if($groupid==''){
	   echo json_encode(array("STATE"=>"-1","MSG"=>'未选择角色',"DATA"=>array()));
	   exit;	
	}
	
	if($siteid!='' && intval($siteid)>0){
		$pms =  User_Group::delGroupid($merid,$siteid,$groupid);;
		echo json_encode(array("STATE"=>($pms)?"1":"-1","MSG"=>'',"DATA"=>array()));
        exit;
	}else{
		  echo json_encode(array("STATE"=>"-1","MSG"=>'站点ID错误',"DATA"=>array()));
		  exit;
	}
}
?>


