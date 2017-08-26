<?php

class User_Group{


public static function getGrouplist($merid,$siteid,$groupname='',$page,$pagesize){
     
   $retArr=array('CNT'=>0,'LIST'=>'');
  
  $sqlcount = "select count(*) as cnt from pw_user_group where f_merid=? and (f_siteid=? or ?=-1) and (f_groupname=? or ?='')";
  
  
  $sql  = "select f_id,f_groupname,f_about from pw_user_group where f_merid=? and (f_siteid=? or ?=-1) and (f_groupname=? or ?='') ORDER BY f_id LIMIT ?,?";
  
  $conn =  Db_Mysqli::getIntance()->getConnection();
  $stmt= $conn->prepare($sqlcount);
  $stmt->bind_param('iiiss', $merid,$siteid,$siteid,$groupname,$groupname);  
  $result = $stmt->execute() ;
  $stmt->bind_result($cnt);
  while ($stmt->fetch()) {
	     	$retArr['CNT'] = $cnt;        
   }
  
  // echo "$merid,$depid,$depid,$username,$username";
  $stmt= $conn->prepare($sql);
  $limit_page = ($page-1)*$pagesize;
  $stmt->bind_param('iiissii',$merid,$siteid,$siteid,$groupname,$groupname,$limit_page,$pagesize);  
  $result = $stmt->execute() ;
  $stmt->bind_result($fid,$groupname,$about);
  $listArr = array();
  while ($stmt->fetch()) {
	     	$listArr[] = array("gid"=>$fid,"groupname"=>$groupname,"about"=>$about);
   }
   
   $retArr['LIST'] =  $listArr;
   
   $stmt->close();
   
   return $retArr;  
}

 public static function  insertGroupUser($merid,$siteid,$groupname,$groupabout){
	
	
	$sql = "insert into pw_user_group(f_groupname,f_about,f_merid,f_siteid)values(?,?,?,?)";
	$conn =  Db_Mysqli::getIntance()->getConnection();
	$stmt = $conn->prepare($sql); 
	$stmt->bind_param('ssii',$groupname,$groupabout ,$merid,$siteid);		
	$res = $stmt->execute() ;		
	if($res==false)
	{
	  SeasLog::log(SEASLOG_ERROR,mysqli_error($conn));
	  $conn->rollback();
	  return false;
	}
	
	return $res;
		
 }
 
 public static function  updateGroupUser($fid,$merid,$siteid,$groupname,$groupabout){		
	$sql = "update pw_user_group set f_about=? ,f_groupname=?  where f_id = ? and f_siteid = ? and f_merid=?";
	$conn =  Db_Mysqli::getIntance()->getConnection();
	$stmt = $conn->prepare($sql); 
	$stmt->bind_param('ssiii',$groupabout,$groupname ,$fid,$siteid,$merid);
	$res = $stmt->execute();
	if($res==false)
	{
	  SeasLog::log(SEASLOG_ERROR,mysqli_error($conn));
	  $conn->rollback();
	  return false;
	}
	
	return $res;
		
 }
 
	public static function getGroupName($merid,$siteid,$groupid){
  
  $sql  = "select f_id,f_groupname,f_about,f_siteid from pw_user_group where f_merid=? and (f_siteid=? or ?=-1) and f_id = ? ";
  $listArr=array();
  $conn =  Db_Mysqli::getIntance()->getConnection();
  $stmt= $conn->prepare($sql);
  $stmt->bind_param('iiii', $merid,$siteid,$siteid,$groupid);  
  $result = $stmt->execute() ;
  $stmt->bind_result($gid,$groupname,$about,$siteid);
  while ($stmt->fetch()) {
	     $listArr[] = array("gid"=>$gid,"groupname"=>$groupname,"about"=>$about,"siteid"=>$siteid);
   }    
   
   $stmt->close();
   
   return $listArr;  
  }
  
 public static function  insertPermissionGroup($merid,$siteid,$userid,$groupid){
	
	
	$sql = "insert into pw_permissiongroup(f_userid,f_siteid,f_merid,f_groupid)values(?,?,?,?)";
	$conn =  Db_Mysqli::getIntance()->getConnection();
	 
    if(self::checkPermissionGroup($merid,$siteid,$userid,$groupid)==true)
	{
		return true;
	}
	
	$stmt = $conn->prepare($sql); 
	$stmt->bind_param('iiii',$userid,$siteid ,$merid,$groupid);		
	$res = $stmt->execute() ;		
	if($res==false)
	{
	  SeasLog::log(SEASLOG_ERROR,mysqli_error($conn));
	  $conn->rollback();
	  return false;
	}	
	return $res;		
 }
 
 public static function checkPermissionGroup($merid,$siteid,$userid,$groupid)
 {
	 $query = "select count(*) cnt from  pw_permissiongroup where  f_userid=? and f_siteid=? and f_merid=? and f_groupid=? ";
	 $conn =  Db_Mysqli::getIntance()->getConnection();
	
	$stmt = $conn->prepare($query); 
	$stmt->bind_param('iiii',$userid,$siteid ,$merid,$groupid);		
	$res = $stmt->execute() ;
	$stmt->bind_result($cnt);
	$qcnt = 0 ;
    while ($stmt->fetch()) {
	     $qcnt = $cnt;
	}    
	if ($qcnt>0){
	   $stmt->close();
	   return true;
	}
	
	return false;
 }
 
 public static function checkUserinOtherGroup($merid,$siteid,$userid,$groupid)
 {
	 $query = "select count(*) cnt from  pw_permissiongroup where  f_userid=? and f_siteid=? and f_merid=? and f_groupid!=? ";
	 $conn =  Db_Mysqli::getIntance()->getConnection();
	
	$stmt = $conn->prepare($query); 
	$stmt->bind_param('iiii',$userid,$siteid ,$merid,$groupid);		
	$res = $stmt->execute() ;
	$stmt->bind_result($cnt);
	$qcnt = 0 ;
    while ($stmt->fetch()) {
	     $qcnt = $cnt;
	}    
	if ($qcnt>0){
	   $stmt->close();
	   return true;
	}
	
	return false;
 }
 
 
 public static function  delPermissionGroup($merid,$siteid,$userid,$groupid){
	
	$sql = "delete from  pw_permissiongroup where  f_userid=? and f_siteid=? and f_merid=? and f_groupid=? ";
	$conn =  Db_Mysqli::getIntance()->getConnection();
	$stmt = $conn->prepare($sql); 
	$stmt->bind_param('iiii',$userid,$siteid ,$merid,$groupid);		
	$res = $stmt->execute() ;		
	if($res==false)
	{
	  SeasLog::log(SEASLOG_ERROR,mysqli_error($conn));
	  $conn->rollback();
	  return false;
	}	
	return $res;		
 }
 
}
