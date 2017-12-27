<?php

class User_Login{

public static function  insertMerinfo($username,$truename,$password,$email,$ip){
	
	$sql = "insert into pw_merinfo(f_username,f_truename,f_userpwd,f_email,f_lastip)values(?,?,?,?,?)";
	$args = [$username,$truename,$password,$email,$ip];
	$res = Db_Mysqli::getIntance()->execPrepared($sql,$args);
	return $res;	
}

public static function  updateMerinfoPassWord($fid,$username,$password){
	
	$sql = "update pw_merinfo set f_userpwd=? where f_id=? and f_username = ? ";
	$args = [$password,$fid,$username];
	$res = Db_Mysqli::getIntance()->execPrepared($sql,$args);
	return $res;
	
}

public static function  updateMerinfo($fid,$username,$truename,$mobile,$email,$address){
	
	$sql = "update pw_merinfo set f_truename=?,f_address=?,f_mobile=?,f_email=? where f_id=? and f_username = ? ";
	$args = [$truename,$address,$mobile,$email,$fid,$username];

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
  $sql = "select f_id,f_username,f_truename,f_valid,f_usertype,f_email,f_mobile,f_address  from pw_merinfo where  f_username = ? and f_userpwd= ? and f_valid = 0 "; 
  $conn =  Db_Mysqli::getIntance()->getConnection();
  $stmt= $conn->prepare($sql);
  $stmt->bind_param('ss', $username,$password);  
  $result = $stmt->execute() ;
  $stmt->bind_result($fid,$username,$truename,$valid,$usertype,$email,$mobile,$address);
  while ($stmt->fetch()) {
	     	$listArr = array("fid"=>$fid,"username"=>$username,"truename"=>$truename,
	     	                   "usertype"=>$usertype,"email"=>$email,"valid"=>$valid,
	     	                   "mobile"=>$mobile,"address"=>$address);
   }
  
  if($stmt){$stmt->close();}
  
  return $listArr;
  
}

public static function getMerinfoUserIdByid($fid){
  
  $listArr = array();
  $sql = "select f_id,f_username,f_truename,f_valid,f_usertype,f_email,f_mobile,f_address  from pw_merinfo where  f_id = ?  "; 
  $conn =  Db_Mysqli::getIntance()->getConnection();
  $stmt= $conn->prepare($sql);
  $stmt->bind_param('i', $fid);  
  $result = $stmt->execute() ;
  $stmt->bind_result($fid,$username,$truename,$valid,$usertype,$email,$mobile,$address);
  while ($stmt->fetch()) {
	     	$listArr = array("fid"=>$fid,"username"=>$username,"truename"=>$truename,
	     	                   "usertype"=>$usertype,"email"=>$email,"valid"=>$valid,
	     	                   "mobile"=>$mobile,"address"=>$address);
   }
  
  if($stmt){$stmt->close();}
  
  return $listArr;
  
}



}
