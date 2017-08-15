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
  
  $sqlcount = "select count(*) as cnt from pw_dept where f_merid= ?";
  
  $sql = "select f_id,f_department,f_about from pw_dept where f_merid=? ORDER BY f_id  LIMIT ?,?";
  
  $conn =  Db_Mysqli::getIntance()->getConnection();
  $stmt= $conn->prepare($sqlcount);
  $stmt->bind_param('i', $merid);  
  $result = $stmt->execute() ;
  $stmt->bind_result($cnt);
  while ($stmt->fetch()) {
	     	$retArr['CNT'] = $cnt;        
   }
  
  $stmt= $conn->prepare($sql);
  $limit_page = ($page-1)*$pagesize;
  $stmt->bind_param('iii', $merid,$limit_page,$pagesize);  
  $result = $stmt->execute() ;
  $stmt->bind_result($co1,$co3,$co2);
  $listArr = array();
  while ($stmt->fetch()) {
	     	$listArr[] = array("f_id"=>$co1,"f_department"=>$co2,"f_about"=>$co3);
   }
   
   $retArr['LIST'] =  $listArr;
   
   $stmt->close();
   
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
	
 
	
public static function getSiteslist($merid,$page,$pagesize){

  $retArr=array('CNT'=>0,'LIST'=>'');
  
  $sqlcount = "select count(*) as cnt from pw_sites where f_merid= ?";
  
  $sql = "select f_id,f_sitename,f_sitdomain,f_merid,f_about from pw_sites where f_merid=? ORDER BY f_id  LIMIT ?,?";
  
  $conn =  Db_Mysqli::getIntance()->getConnection();
  $stmt= $conn->prepare($sqlcount);
  $stmt->bind_param('i', $merid);  
  $result = $stmt->execute() ;
  
  if($result==false)
	{
	  SeasLog::log(SEASLOG_ERROR,mysqli_error($conn));
	}
	
  $stmt->bind_result($cnt);
  while ($stmt->fetch()) {
	    $retArr['CNT'] = $cnt;        
   }
  
   
  $stmt= $conn->prepare($sql);
  $limit_page = ($page-1)*$pagesize;
  $stmt->bind_param('iii', $merid,$limit_page,$pagesize);  
  $result = $stmt->execute() ;
  if($result==false)
	{
	  SeasLog::log(SEASLOG_ERROR,mysqli_error($conn));
	}
	
  $stmt->bind_result($fid,$sitename,$sitedomain,$merid,$about);
  $listArr = array();
 
  while ($stmt->fetch()) {
	     	$listArr[] = array("id"=>$fid,"sitename"=>$sitename,"sitdomain"=>$sitedomain,"about"=>$about);
   }
   
   $retArr['LIST'] =  $listArr;
     
   $stmt->close();
   
  return $retArr;  
}

public static function  insertSites($merid,$sitename,$sitdomain,$about){
	
	$sqlcount = "select max(f_id) as fid from pw_sites where f_merid= ?";    
  
  $maxfid = '';
  $conn =  Db_Mysqli::getIntance()->getConnection();
  //$conn->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);
  
  $stmt= $conn->prepare($sqlcount);
  $stmt->bind_param('i', $merid);  
  $result = $stmt->execute() ;
  $stmt->bind_result($mid);
  
  while ($stmt->fetch()) {
	   $maxfid = $mid;        
   }
  
  if($maxfid=='')
   {
   	$maxfid = $merid."2000";
   }else{
   	$maxfid = intval($maxfid) + 1;
   }
   
	$sql = "insert into pw_sites(f_id,f_sitename,f_sitdomain,f_about,f_merid)values(?,?,?,?,?)";
	$stmt= $conn->prepare($sql);
	$stmt->bind_param('isssi',$maxfid,$sitename,$sitdomain,$about,$merid);
	$res = $stmt->execute() ;
	if($res==false)
	{
	  SeasLog::log(SEASLOG_ERROR,mysqli_error($conn));
	}
		 	 
	$treesql = "insert into pw_treenav(f_parentid,f_name,f_displayorderno,f_path,f_rootid,f_divno,f_orderno,f_classpath,f_merid)values(?,?,?,?,?,?,?,?,?)";
  $parentid = $displayno = $rootid = $divno = $orderno = 0;
  $fpath = $classpath = '';
  $stmt2 = $conn->prepare($treesql); 
	$stmt2->bind_param('isisiiisi',$parentid ,$sitename,$displayno,$fpath,$rootid,$divno,$orderno,$classpath,$merid);		
	$res2 = $stmt2->execute() ;		
	if($res2==false)
	{
	  SeasLog::log(SEASLOG_ERROR,mysqli_error($conn));
	}    
	//$conn->commit();
	 
	$stmt->close();
	$stmt2->close();
	
	return $res && $res2;
	
	}
	
	
	public static function  updateSites($merid,$fid,$sitename,$about){	
	$sql = "update pw_sites set f_sitename=?,f_about = ? where f_merid=? and f_id = ?";
	$args = [$sitename,$about,$merid,$fid];
	$res = Db_Mysqli::getIntance()->execPrepared($sql,$args);
	return $res;
	
	}
	
	
}
