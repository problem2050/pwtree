<?php

class Pwtree_Nodes{
	
public static function getTreeNavList($merid,$parentid,$findstr=''){
     
  $conn =  Db_Mysqli::getIntance()->getConnection();
  
  $sql = "select f_id,f_parentid,f_name,f_path,f_rootid,f_divno,f_orderno,f_merid,f_displayorderno,f_classpath from pw_treenav where f_merid=?  and f_parentid = ?";
  
  if($findstr!=''){
  	
  	$sql .=" and f_name = ?  order by f_id,f_orderno";
  	$stmt= $conn->prepare($sql);
    $stmt->bind_param('iis', $merid,$parentid,$findstr);  	  	
  }else{  	
  	$sql .="  order by f_id,f_orderno";
  	$stmt= $conn->prepare($sql);
    $stmt->bind_param('ii', $merid,$parentid);  	  	    
  }
  
  $result = $stmt->execute() ;	   
          
  if($result==false)
	{
	  SeasLog::log(SEASLOG_ERROR,mysqli_error($conn));
	}
	
  $stmt->bind_result($fid,$parentid,$name,$path,$rootid,$divno,$orderno,$merid,$displayorderno,$classpath);
  $listArr = array();
 
  while ($stmt->fetch()) {
	     	$listArr[] = array("id"=>$fid,"parentid"=>$parentid,
	     	"name"=>$name,"path"=>$path,"rootid"=>$rootid,"divno"=>$divno,
	     	"orderno"=>$orderno,"merid"=>$merid,"displayorderno"=>$displayorderno,
	     	"classpath"=>$classpath);
   }
   
   $retArr['LIST'] =  $listArr;
     
   $stmt->close();
   
  	return $retArr;  
}
	
	
public static function insertTreeNav($parentid,$nodename,$fpath,$rootid,$divno,$orderno,$classpath,$merid)
{
 
  $conn =  Db_Mysqli::getIntance()->getConnection();
  $treesql = "insert into pw_treenav(f_parentid,f_name,f_displayorderno,f_path,f_rootid,f_divno,f_orderno,f_classpath,f_merid)values(?,?,?,?,?,?,?,?,?)";
  //$parentid = $displayno = $rootid = $divno = $orderno = 0;
  //$fpath = $classpath = '';
  $stmt2 = $conn->prepare($treesql); 
  
  $stmt2->bind_param('isisiiisi',$parentid ,$nodename,$displayno,$fpath,$rootid,$divno,$orderno,$classpath,$merid);		
  $res2 = $stmt2->execute() ;	
 
  if($res2==false)
	{
	  SeasLog::log(SEASLOG_ERROR,mysqli_error($conn));
	}    
	//$conn->commit();	 
	$stmt2->close();
	 return $res2;
}
	
public static function getTreeNavigation($ids = array())
	{
				
		if(!is_array($ids))return false;
		
		$conn =  Db_Mysqli::getIntance()->getConnection();
						
		$arg = array('ids'=>implode(",",$ids));	
		$listid = join(',', $ids);
						
	  $sql = 'select f_id ,f_name  from pw_treenav where f_id in (?) order by f_divno asc';
	  $stmt = $conn->prepare($treesql); 
	 	   
	  $stmt->bind_param('s',$listid);
	  $result = $stmt->execute() ;	   
          
	  if($result==false)
		{
		  SeasLog::log(SEASLOG_ERROR,mysqli_error($conn));
		}
	
	  $stmt->bind_result($fid,$name);
	  $listArr = array();
 
	  while ($stmt->fetch()) {
		     	$listArr[] = array("id"=>$fid,"name"=>$name);
	   }
	      
    return $listArr;   		
		
	}
	

	

}

?>