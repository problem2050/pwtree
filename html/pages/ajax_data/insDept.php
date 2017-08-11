<?php
require_once($_SERVER["Root_Path"]."/inc/bootstrap.php");
require_once($_SERVER["Root_Path"]."/inc/function.php");

$deptname= isset($_REQUEST['deptname'])?$_REQUEST['deptname']:'';
$about= isset($_REQUEST['about'])?$_REQUEST['about']:'';


$res = false;
if($deptname!='')
{
  $res = User_Userinfo::insertDept($merid,$deptname,$about);      
}


echo json_encode(array("STATE"=>$res));

?>


