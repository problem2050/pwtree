<?php
require_once($_SERVER["Root_Path"]."/inc/bootstrap.php");
require_once($_SERVER["Root_Path"]."/inc/function.php");

$siteid= isset($_REQUEST['siteid'])?$_REQUEST['siteid']:'';
 
if($siteid!='' && intval($siteid)>0){
	echo  getBuildTree2($siteid);
}else{
	
	echo json_encode(array());
}

?>


