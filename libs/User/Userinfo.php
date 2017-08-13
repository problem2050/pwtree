<?php

class User_Userinfo{


public static function getUserinfo($merid,$username,$page,$pagesize){

  $retArr=array('CNT'=>0,'LIST'=>'');
  
  $sqlcount = "select count(*) as cnt from pw_userinfo";
  
  $sql = "select *from pw_userinfo ORDER BY f_id  LIMIT ".($page-1)*$pagesize.",".$pagesize;
  
  $rcnt = Db_Mysqli::getIntance()->queryOne($sqlcount);
  
  $res = Db_Mysqli::getIntance()->queryfetch($sql);
   
  $retArr['CNT'] = isset($rcnt)?$rcnt['cnt']:0;
  $retArr['LIST'] = $res;
  return $retArr;
  
}


}
