<?php
header('Content-type: application/json;charset=utf-8');

require_once($_SERVER["Root_Path"]."/inc/bootstrap.php");
require_once($_SERVER["Root_Path"]."/inc/api_function.php");
require_once($_SERVER["Root_Path"]."/inc/public_function.php");
require_once($_SERVER["Root_Path"]."/html/api/checkApiLogin.php");


$rs = User_Login::getMerinfoUserIdByid($merid);
echo json_encode(array("STATE"=>"10000","MSG"=>'',"DATA"=>$rs));
		
?>
