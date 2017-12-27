<?php

class User_Login{

public static function  insertMerinfo($username,$truename,$password,$email){
	
	$sql = "insert into pw_merinfo(f_username,f_truename,f_userpwd,f_email)values(?,?,?,?)";
	$args = [$username,$truename,$password,$email];
	$res = Db_Mysqli::getIntance()->execPrepared($sql,$args);
	return $res;	
}

public static function  updateUserinfo($fid,$merid,$username,$truename,$password,$email,$phone,$dep,$isvalid){
	
	$sql = "update pw_userinfo set f_merid=?,f_username=?,f_truename=?,f_userpwd=?,f_email=?,f_mobile=?,f_department=?,f_valid=? where f_id=?";
	$args = [$merid,$username,$truename,$password,$email,$phone,$dep,$isvalid,$fid,];
	$res = Db_Mysqli::getIntance()->execPrepared($sql,$args);
	return $res;
	
}

public static function  insertMerinfoLoginLog($username,$ip){
	
	$sql = "insert into pw_loginlog(f_username,f_ip)values(?,?)";
	$args = [$username,$ip];
	$res = Db_Mysqli::getIntance()->execPrepared($sql,$args);
	return $res;	
}


public static function getMerinfoUserId($username,$password){
  
  $listArr = array();
  $sql = "select f_id,f_username,f_truename,f_valid,f_usertype,f_email  from pw_merinfo where  f_username = ? and f_userpwd= ? and f_valid = 0 "; 
  $conn =  Db_Mysqli::getIntance()->getConnection();
  $stmt= $conn->prepare($sql);
  $stmt->bind_param('ss', $username,$password);  
  $result = $stmt->execute() ;
  $stmt->bind_result($fid,$username,$truename,$valid,$usertype,$email);
  while ($stmt->fetch()) {
	     	$listArr = array("fid"=>$fid,"username"=>$username,"truename"=>$truename,
	     	                   "usertype"=>$usertype,"email"=>$email,"valid"=>$valid);
   }
  
  if($stmt){$stmt->close();}
  
  return $listArr;
  
}




}
