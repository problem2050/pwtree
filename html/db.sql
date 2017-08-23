<?php
header('Content-Type: text/html; charset=utf-8');

//var_dump($_SERVER['Root_Path']);
require_once($_SERVER["Root_Path"]."/inc/bootstrap.php");


//$re =  Db_Mysqli::getIntance()->queryfetch("select * from test");

//var_dump($re);

//foreach($re as $k=>$v){
	
	//var_dump($k,$v);
//  echo $v['label'];
//}
//$re =  Db_Mysqli::getIntance()->query("insert into test(id,label)values(5,'vv')");
$re =  Db_Mysqli::getIntance()->queryfetch("select * from test");
var_dump($re);

//var_dump(ConnMysqli::getIntance()->getInsertid());
//var_dump(11);
//$re = Db_Mysqli::getIntance()->queryPrepared("select * from test where id = ?",[5]);
//var_dump($re);

//var_dump($SITE_CONFIGS);

?>

 