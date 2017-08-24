<?php

class User_Group{


public static function getGrouplist($merid,$siteid,$groupname='',$page,$pagesize){
     
   $retArr=array('CNT'=>0,'LIST'=>'');
  
  $sqlcount = "select count(*) as cnt from pw_user_group where f_merid=? and f_siteid=? and (f_groupname=? or ?='')";
  
  
  $sql  = "select f_id,f_groupname,f_about from pw_user_group where f_merid=? and f_siteid=? and (f_groupname=? or ?='') ORDER BY f_id LIMIT ?,?";
  
  $conn =  Db_Mysqli::getIntance()->getConnection();
  $stmt= $conn->prepare($sqlcount);
  $stmt->bind_param('iiss', $merid,$siteid,$groupname,$groupname);  
  $result = $stmt->execute() ;
  $stmt->bind_result($cnt);
  while ($stmt->fetch()) {
	     	$retArr['CNT'] = $cnt;        
   }
  
  // echo "$merid,$depid,$depid,$username,$username";
  $stmt= $conn->prepare($sql);
  $limit_page = ($page-1)*$pagesize;
  $stmt->bind_param('iissii',$merid,$siteid,$groupname,$groupname,$limit_page,$pagesize);  
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
 
	
}