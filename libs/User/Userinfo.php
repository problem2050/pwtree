<?php

class User_Userinfo{


public static function getUserinfo($merid,$username,$page,$pagesize){

  $retArr=array('CNT'=>0,'LIST'=>'');
  
  $sqlcount = "select count(*) as cnt from pw_userinfo as uinfo left join pw_dept as dept on uinfo.f_merid=dept.f_merid and uinfo.f_department=dept.f_id where uinfo.f_merid=".$merid;
  
  $sql = "select uinfo.*,dept.f_department from pw_userinfo as uinfo left join pw_dept as dept on uinfo.f_merid=dept.f_merid and uinfo.f_department=dept.f_id where uinfo.f_merid = ".$merid." ORDER BY uinfo.f_id  LIMIT ".($page-1)*$pagesize.",".$pagesize;
  
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

public static function  updateUserinfo($fid,$merid,$username,$truename,$password,$email,$phone,$dep,$isvalid){
	
	$sql = "update pw_userinfo set f_merid=?,f_username=?,f_truename=?,f_userpwd=?,f_email=?,f_mobile=?,f_department=?,f_valid=? where f_id=?";
	$args = [$merid,$username,$truename,$password,$email,$phone,$dep,$isvalid,$fid,];
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


public static function getDepmlist($merid,$depname,$page,$pagesize){

  $retArr=array('CNT'=>0,'LIST'=>'');
  
  $sqlcount = "select count(*) as cnt from pw_dept where f_merid=".$merid;
  
  $sql = "select *from pw_dept where f_merid=".$merid." ORDER BY f_id  LIMIT ".($page-1)*$pagesize.",".$pagesize;
  
  $rcnt = Db_Mysqli::getIntance()->queryOne($sqlcount);
  
  $res = Db_Mysqli::getIntance()->queryfetch($sql);
   
  $retArr['CNT'] = isset($rcnt)?$rcnt['cnt']:0;
  $retArr['LIST'] = $res;
  return $retArr;  
}

public static function  insertDept($merid,$deptname,$about){	
	$sql = "insert into pw_dept(f_merid,f_department,f_about)values(?,?,?)";
	$args = [$merid,$deptname,$about];
	$res = Db_Mysqli::getIntance()->execPrepared($sql,$args);
	return $res;
	
	}


public static function  updateDept($merid,$fid,$deptname,$about){	
	$sql = "update pw_dept set f_department=?,f_about = ? where f_merid=? and f_id = ?";
	$args = [$deptname,$about,$merid,$fid];
	$res = Db_Mysqli::getIntance()->execPrepared($sql,$args);
	return $res;
	
	}
	
}
