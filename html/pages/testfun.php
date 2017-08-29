<?php
require_once($_SERVER["Root_Path"]."/inc/bootstrap.php");
require_once($_SERVER["Root_Path"]."/inc/function.php");

$rr = User_Group::getPemidInUserorGroup($pemid=1000029,$merid=10001,$siteid=10000);

var_dump($rr);

?>
