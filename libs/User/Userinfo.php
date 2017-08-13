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

public static function  insertUserinfo($merid,$username,$truename,$password,$email,$phone,$dep){
	
	$sql = "insert into pw_userinfo(f_merid,f_username,f_truename,f_userpwd,f_email,f_mobile,f_department)values(?,?,?,?,?,?,?)";
	$args = [$merid,$username,$truename,$password,$email,$phone,$dep];
	$res = Db_Mysqli::getIntance()->execPrepared($sql,$args);
	return $res;
	
}

public static function  updateUserinfo($fid,$merid,$username,$truename,$password,$email,$phone,$dep){
	
	$sql = "update pw_userinfo set f_merid=?,f_username=?,f_truename=?,f_userpwd=?,f_email=?,f_mobile=?,f_department=? where f_id=?";
	$args = [$merid,$username,$truename,$password,$email,$phone,$dep,$fid,];
	$res = Db_Mysqli::getIntance()->execPrepared($sql,$args);
	return $res;
	
}

public static function  delUserinfo($merid,$fid){
	
	$sql = "delete from  pw_userinfo where f_merid= ? and f_id= ?";
	$args = [$merid,$fid];
	$res = Db_Mysqli::getIntance()->execPrepared($sql,$args);
	return $res;
	
}

public static function getUserinfoOne($fid,$merid){
   
  $sql = "select *from pw_userinfo where  f_id =".$fid." and f_merid=".$merid;
 
  $res = Db_Mysqli::getIntance()->queryOne($sql);
    
  return $res;
  
}

}
