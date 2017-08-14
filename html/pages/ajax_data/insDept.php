<?php
require_once($_SERVER["Root_Path"]."/inc/bootstrap.php");
require_once($_SERVER["Root_Path"]."/inc/function.php");

$deptname= isset($_REQUEST['deptname'])?$_REQUEST['deptname']:'';
$about= isset($_REQUEST['about'])?$_REQUEST['about']:'';
$act= isset($_REQUEST['act'])?$_REQUEST['act']:'';
$fid= isset($_REQUEST['fid'])?$_REQUEST['fid']:'';

$res = false;
if($act=='ad'){
	if($deptname!='')
	{
	  $res = User_Userinfo::insertDept($merid,$deptname,$about);      
	}
}else if($act=='ed'){	 
	$res = User_Userinfo::updateDept($merid,$fid,$deptname,$about);  
 }

echo json_encode(array("STATE"=>$res));

?>


