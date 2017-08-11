<?php
header('Content-Type: text/html; charset=utf-8');
require_once($_SERVER["Root_Path"]."/lib/Db/Mysqli.php");


$re =  ConnMysqli::getIntance()->queryOne("select * from test");

var_dump($re);

//var_dump(ConnMysqli::getIntance()->getInsertid());


?>

 