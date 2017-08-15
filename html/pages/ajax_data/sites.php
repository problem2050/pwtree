<?php
require_once($_SERVER["Root_Path"]."/inc/bootstrap.php");
require_once($_SERVER["Root_Path"]."/inc/function.php");

$nodename= isset($_REQUEST['nodename'])?$_REQUEST['nodename']:'';
$sortid= isset($_REQUEST['sortid'])?$_REQUEST['sortid']:'';
$urlpath= isset($_REQUEST['urlpath'])?$_REQUEST['urlpath']:'';
$parentid= isset($_REQUEST['hiparentid'])?$_REQUEST['hiparentid']:'';

$act= isset($_REQUEST['act'])?$_REQUEST['act']:'';
$fid= isset($_REQUEST['fid'])?$_REQUEST['fid']:'';

$res = false;
if($act=='ad'){
	if($nodename!='' && $parentid!='')
	{
	  $res = Pwtree_Nodes::insertTreeNav($parentid,$nodename,$urlpath,$rootid=0,$divno=0,$sortid,$classpath='',$merid);      
	}
}else if($act=='ed'){	 
	$res = User_Userinfo::updateSites($merid,$fid,$sitename,$about);  
 }

echo json_encode(array("STATE"=>$res));

?>


