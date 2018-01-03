<?php

class User_Login{

public static function  insertMerinfo($username,$truename,$password,$email,$ip,$securitycode){
	
	$sql = "insert into pw_merinfo(f_username,f_truename,f_userpwd,f_email,f_lastip,f_securitycode)values(?,?,?,?,?,?)";
	$args = [$username,$truename,$password,$email,$ip,$securitycode];
	$res = Db_Mysqli::getIntance()->execPrepared($sql,$args);
	return $res;	
}

public static function  updateMerinfoPassWord($fid,$username,$password){
	
	$sql = "update pw_merinfo set f_userpwd=? where f_id=? and f_username = ? ";
	$args = [$password,$fid,$username];
	$res = Db_Mysqli::getIntance()->execPrepared($sql,$args);
	return $res;
	
}

public static function  updateMerinfoSecurityCode($fid,$username,$securitycode){
	
	$sql = "update pw_merinfo set f_securitycode=? where f_id=? and f_username = ? ";
	$args = [$securitycode,$fid,$username];
	$res = Db_Mysqli::getIntance()->execPrepared($sql,$args);
	return $res;
	
}

public static function  updateMerinfo($fid,$username,$truename,$mobile,$email,$address){
	
	$sql = "update pw_merinfo set f_truename=?,f_address=?,f_mobile=?,f_email=? where f_id=? and f_username = ? ";
	$args = [$truename,$address,$mobile,$email,$fid,$username];

	$res = Db_Mysqli::getIntance()->execPrepared($sql,$args);
	return $res;
	
}

public static function  insertMerinfoLoginLog($username,$ip,$usertype,$state){
	
	$sql = "insert into pw_loginlog(f_username,f_ip,f_usertype,f_state)values(?,?,?,?)";
	$args = [$username,$ip,$usertype,$state];
	$res = Db_Mysqli::getIntance()->execPrepared($sql,$args);
	return $res;	
}


public static function getMerinfoUserId($username,$password){
  
  $listArr = array();
  $sql = "select f_id,f_username,f_truename,f_valid,f_usertype,f_email,f_mobile,f_address,f_securitycode  from pw_merinfo where  f_username = ? and f_userpwd= ? and f_valid = 0 "; 
  $conn =  Db_Mysqli::getIntance()->getConnection();
  $stmt= $conn->prepare($sql);
  $stmt->bind_param('ss', $username,$password);  
  $result = $stmt->execute() ;
  $stmt->bind_result($fid,$username,$truename,$valid,$usertype,$email,$mobile,$address,$securitycode);
  while ($stmt->fetch()) {
	     	$listArr = array("fid"=>$fid,"username"=>$username,"truename"=>$truename,
	     	                   "usertype"=>$usertype,"email"=>$email,"valid"=>$valid,
	     	                   "mobile"=>$mobile,"address"=>$address,"securitycode"=>$securitycode);
   }
  
  if($stmt){$stmt->close();}
  
  return $listArr;
  
}

public static function getMerinfoUserIdByid($fid){
  
  $listArr = array();
  $sql = "select f_id,f_username,f_truename,f_valid,f_usertype,f_email,f_mobile,f_address,f_securitycode  from pw_merinfo where  f_id = ?  "; 
  $conn =  Db_Mysqli::getIntance()->getConnection();
  $stmt= $conn->prepare($sql);
  $stmt->bind_param('i', $fid);  
  $result = $stmt->execute() ;
  $stmt->bind_result($fid,$username,$truename,$valid,$usertype,$email,$mobile,$address,$securitycode);
  while ($stmt->fetch()) {
	     	$listArr = array("fid"=>$fid,"username"=>$username,"truename"=>$truename,
	     	                   "usertype"=>$usertype,"email"=>$email,"valid"=>$valid,
	     	                   "mobile"=>$mobile,"address"=>$address,"securitycode"=>$securitycode);
   }
  
  if($stmt){$stmt->close();}
  
  return $listArr;
  
}


public static function getUserLoginOne($merid,$username,$password){
  
  $password = md5(md5($password));
  $listArr = array();
  $sql = "select f_id,f_username,f_truename,f_department,f_valid,f_mobile,f_email  from pw_userinfo where  f_merid= ? and f_username = ? and f_userpwd = ? "; 
  $conn =  Db_Mysqli::getIntance()->getConnection();
  $stmt= $conn->prepare($sql);
  $stmt->bind_param('iss', $merid,$username,$password);  
  $result = $stmt->execute() ;
  $stmt->bind_result($fid,$username,$truename,$department,$valid,$mobile,$email);
  while ($stmt->fetch()) {
	     	$listArr = array("fid"=>$fid,"username"=>$username,"truename"=>$truename,
	     	                   "department"=>$department,"valid"=>$valid,
	     	                   "mobile"=>$mobile,"email"=>$email);
   }
  
  if($stmt){$stmt->close();}
  
  return $listArr;
  
}

}
