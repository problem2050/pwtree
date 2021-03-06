<?php

class Pwtree_Grant{
	
  public static function insertPermissionTreeNav($useridList,$siteid,$merid,$groupid,$pemidList)
	{
	 
	  $temp_pemidList = explode(",",$pemidList);
	  foreach($temp_pemidList as $k=>$v){
		  if ($v=='')continue;
		  if(intval($v)<=0) return;
	  }
	  
	  if($groupid==''){
		  foreach(explode(",",$useridList) as $k=>$v){
			  if ($v=='') continue;
				if(intval($v)<=0) return;
		  }
		}
	  
	  $conn =  Db_Mysqli::getIntance()->getConnection();
	  
	  $qsql = "select f_id,f_treenavid,f_siteid,f_merid from pw_permission where f_merid=? and f_siteid=? and f_id in ($pemidList)";
	  
	  $stmt= $conn->prepare($qsql);
	  $stmt->bind_param('ii', $merid,$siteid);  	  	    
	  
	  $result = $stmt->execute() ;	   
			  
	  if($result==false)
		{
		  SeasLog::log(SEASLOG_ERROR,mysqli_error($conn));
		  return false;
		}
		
	  $stmt->bind_result($fid,$treenavid,$siteid,$merid);
	  $listArr = array();
	 
	  while ($stmt->fetch()) {
				$listArr[$fid] = array("id"=>$fid,"treenavid"=>$treenavid,
				"siteid"=>$siteid,"merid"=>$merid);
	   }
	  $stmt->close();
	  
	  $stmt2='';
	  $res2 ='';
	  //var_dump($listArr);exit;
	 
		$conn->autocommit(false);  
		if($groupid!='' && $groupid>0){
		  $delold = "delete from pw_permission_treenav where  f_groupid=? and f_merid = ? and f_siteid = ?";
			$stmt2 = $conn->prepare($delold); 
			$stmt2->bind_param('iii',$groupid,$merid,$siteid);		
			$res2 = $stmt2->execute() ;	
			if($res2==false)
				{
				  $conn->rollback();
				  SeasLog::log(SEASLOG_ERROR,mysqli_error($conn));
				  return false;
				}
			
			$treesql = "insert into pw_permission_treenav(f_userid,f_treenavid,f_siteid,f_permissionid,f_merid,f_groupid)values(?,?,?,?,?,?)";
			foreach($temp_pemidList as $k=>$v){	 
			$stmt2 = $conn->prepare($treesql); 
			if(array_key_exists($v,$listArr)){
				 $stmt2->bind_param('iiiiii',$userid=0 ,$listArr[$v]['treenavid'],$siteid,$listArr[$v]['id'],$merid,$groupid);
				}else{			 
					$stmt2->bind_param('iiiiii',$userid=0 ,$v,$siteid,$pid=-1,$merid,$groupid);	
				}
				$res2 = $stmt2->execute() ;	
		       //var_dump($res2);
			  if($res2==false)
				{
				  $conn->rollback();
				  SeasLog::log(SEASLOG_ERROR,mysqli_error($conn));
				  return;
				 }
				} 		
				
		}else if ($groupid=='' &&  $useridList !=''){	
			foreach(explode(",",$useridList) as $uk=>$uv){
				 if(intval($uv)<=0)continue;			  
				 $delold = '';		 
				 $delold = "delete from pw_permission_treenav where  f_userid=? and f_merid = ? and f_siteid = ?";
				 $stmt2 = $conn->prepare($delold); 
				 $stmt2->bind_param('iii',$uv,$merid,$siteid);		
				 $res2 = $stmt2->execute() ;	
				 if($res2==false)
					{
					  $conn->rollback();
					  SeasLog::log(SEASLOG_ERROR,mysqli_error($conn));
					  return false;
					}
				
			$treesql = "insert into pw_permission_treenav(f_userid,f_treenavid,f_siteid,f_permissionid,f_merid,f_groupid)values(?,?,?,?,?,?)";
			 foreach($temp_pemidList as $k=>$v){	   				
				$stmt2 = $conn->prepare($treesql); 
				
		    if(array_key_exists($v,$listArr)){
				 $stmt2->bind_param('iiiiii',$uv ,$listArr[$v]['treenavid'],$siteid,$listArr[$v]['id'],$merid,$groupid);
				}else{			 
					$stmt2->bind_param('iiiiii',$uv ,$v,$siteid,$pid=-1,$merid,$groupid);	
				}
				$res2 = $stmt2->execute() ;	
		       //var_dump($res2);
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
    if($stmt2){		$stmt2->close();}
		return $res2;
	}
	
 public static function getPermissiongroup($groupid,$siteid,$merid)
	{
								
	  $conn =  Db_Mysqli::getIntance()->getConnection();							 

	  $treesql = "select pgroup.f_id,pgroup.f_userid,pgroup.f_siteid,pgroup.f_groupid,uinfo.f_username,uinfo.f_truename
					from pw_permissiongroup  as pgroup inner join pw_userinfo as uinfo on pgroup.f_userid=uinfo.f_id where pgroup.f_groupid=? 
					and  pgroup.f_siteid=? and pgroup.f_merid=?";
	  $stmt = $conn->prepare($treesql);	 	 
	  $stmt->bind_param('iii',$groupid,$siteid,$merid);
	  $result = $stmt->execute();
          
	  if($result==false)
		{
		  SeasLog::log(SEASLOG_ERROR,mysqli_error($conn));
		}
	
	  $stmt->bind_result($fid,$userid,$siteid,$groupid,$username,$truename);
	  $listArr = array();
 
	  while ($stmt->fetch()) {
		     	$listArr[] = array("id"=>$fid,"userid"=>$userid,"siteid"=>$siteid,"groupid"=>$groupid,"username"=>$username,"truename"=>$truename);
	   }
	      
		return $listArr;   		
		
	}

}

?>