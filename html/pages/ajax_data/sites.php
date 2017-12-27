<?php
require_once($_SERVER["Root_Path"]."/inc/bootstrap.php");
require_once($_SERVER["Root_Path"]."/inc/function.php");
require_once($_SERVER["Root_Path"]."/html/pages/public/checkLogin.php");

$sitename= isset($_REQUEST['sitename'])?$_REQUEST['sitename']:'';
$about= isset($_REQUEST['about'])?$_REQUEST['about']:'';
$sitedomain= isset($_REQUEST['sitedomain'])?$_REQUEST['sitedomain']:'';

$act= isset($_REQUEST['act'])?$_REQUEST['act']:'';
$fid= isset($_REQUEST['fid'])?$_REQUEST['fid']:'';

$res = false;
if($act=='ad'){
	if($sitename!='' && $sitedomain!='')
	{
	  $res = User_Userinfo::insertSites($merid,$sitename,$sitedomain,$about);      
	}
}else if($act=='ed'){	 
	$res = User_Userinfo::updateSites($merid,$fid,$sitename,$about);  
 }

echo json_encode(array("STATE"=>$res));

?>


