<?php

class Pwtree_Grant{
	
 
	
	
public static function insertPermissionTreeNav($useridList,$siteid,$merid,$groupid,$pemidList)
{
 
  foreach(explode(",",$pemidList) as $k=>$v){
	  if(intval($v)<=0) return;
  }
  
  foreach(explode(",",$useridList) as $k=>$v){
	  if(intval($v)<=0) return;
  }
  
  $conn =  Db_Mysqli::getIntance()->getConnection();
  
  $qsql = "select f_id,f_treenavid,f_siteid,f_merid from pw_permission where f_merid=? and f_siteid=? and f_id in ($pemidList)";
  
  $stmt= $conn->prepare($qsql);
  $stmt->bind_param('ii', $merid,$siteid);  	  	    
  
  $result = $stmt->execute() ;	   
          
  if($result==false)
	{
	  SeasLog::log(SEASLOG_ERROR,mysqli_error($conn));
	}
	
  $stmt->bind_result($fid,$treenavid,$siteid,$merid);
  $listArr = array();
 
  while ($stmt->fetch()) {
	     	$listArr[] = array("id"=>$fid,"treenavid"=>$treenavid,
	     	"siteid"=>$siteid,"merid"=>$merid);
   }
   
  $stmt2='';
  if($listArr && $useridList){
	$conn->autocommit(false);  
    foreach(explode(",",$useridList) as $uk=>$uv){
		foreach($listArr as $k=>$v){
   
		$treesql = "insert into pw_permission_treenav(f_userid,f_treenavid,f_siteid,f_permissionid,f_merid,f_groupid)values(?,?,?,?,?,?)";
 
		$stmt2 = $conn->prepare($treesql); 
  
	    $stmt2->bind_param('iiiiii',$uv ,$v['treenavid'],$siteid,$v['id'],$merid,$groupid);		
	    $res2 = $stmt2->execute() ;	
 
	   if($res2==false)
		{
	      $conn->rollback();
		  SeasLog::log(SEASLOG_ERROR,mysqli_error($conn));
		  return;
		} 
	  }
	 }		
   }
	$conn->commit();	 
	$stmt2->close();
	return $res2;
}
	
 

}

?>