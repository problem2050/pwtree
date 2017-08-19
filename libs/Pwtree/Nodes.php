<?php

class Pwtree_Nodes{
	
public static function getTreeNavList($merid,$parentid,$findstr=''){
     
  $conn =  Db_Mysqli::getIntance()->getConnection();
  
  $sql = "select f_id,f_parentid,f_name,f_path,f_rootid,f_divno,f_orderno,f_merid,f_displayorderno,f_classpath from pw_treenav where f_merid=?  and f_parentid = ?";
  
  if($findstr!=''){
  	
  	$sql .=" and f_name = ?  order by f_orderno";
  	$stmt= $conn->prepare($sql);
    $stmt->bind_param('iis', $merid,$parentid,$findstr);
  }else{  	
  	$sql .="  order by f_orderno";
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
	
public static function getTreeNavigation($parentid,$merid)
	{
								
		$conn =  Db_Mysqli::getIntance()->getConnection();							 

	  $treesql = 'select f_id as id,f_name as name from pw_treenav where FIND_IN_SET (f_id, queryChildrenForUp(?)) and f_merid=? order by f_id ';
	  $stmt = $conn->prepare($treesql);	 	 
	  $stmt->bind_param('ii',$parentid,$merid);
	  $result = $stmt->execute();
          
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
	
public static function updateTreeNav($fid,$nodename,$fpath,$orderno,$merid)
{
 
  $conn =  Db_Mysqli::getIntance()->getConnection();
  $treesql = "update pw_treenav set f_name=?,f_path=?,f_orderno=? where f_id = ? and f_merid = ?";
  //$parentid = $displayno = $rootid = $divno = $orderno = 0;
  //$fpath = $classpath = '';
  $stmt2 = $conn->prepare($treesql); 
  
  $stmt2->bind_param('ssiii',$nodename ,$fpath,$orderno,$fid,$merid);		
  $res2 = $stmt2->execute() ;	
 
  if($res2==false)
	{
	  SeasLog::log(SEASLOG_ERROR,mysqli_error($conn));
	}    
	//$conn->commit();	 
	$stmt2->close();
	 return $res2;
}

public static function getPermissionByNavid($siteid,$treenavid='')
	{
								
		$conn =  Db_Mysqli::getIntance()->getConnection();							 

	  $treesql = "SELECT f_id AS id,f_name AS name,f_about AS about,f_date AS createdate,f_siteid AS siteid, f_cateid AS cateid,f_treenavid AS treenavid FROM pw_permission where (f_siteid = ? or ?='') and (f_treenavid=? or ?='')";
	  $stmt = $conn->prepare($treesql);	 	 
	  $stmt->bind_param('iiii',$siteid,$siteid,$treenavid,$treenavid);
	  $result = $stmt->execute();
         
	  if($result==false)
		{
		  SeasLog::log(SEASLOG_ERROR,mysqli_error($conn));
		}
	
	  $stmt->bind_result($fid,$name,$about,$datestr,$siteid,$cateid,$treeid);
	 
	  $listArr = array();
 
	  while ($stmt->fetch()) {
		     	$listArr[] = array("id"=>$fid,"name"=>$name,"about"=>$about,"datestr"=>$datestr,"cateid"=>$cateid,"siteid"=>$siteid,"treeid"=>$treeid);
	   }
	      
    return $listArr;   		
		
	}
	
 
 public static function getMenuTreeXml($siteid,$ids='')
	{
								
		$conn =  Db_Mysqli::getIntance()->getConnection();							 

    $listArr = array();
    
  if ($ids==''){    	
	  $treesql = "SELECT f_id AS id,   f_name AS showname, ifnull(f_path, '') AS url,  f_name AS trrename,
                       f_divno AS level2,f_parentid AS fatherid,'' AS tip, f_displayorderno AS orderno
                       FROM pw_treenav WHERE  FIND_IN_SET(f_id, queryChildrenForDown(?))";
	  $stmt = $conn->prepare($treesql);	 	 
	  $stmt->bind_param('i',$siteid);
	  $result = $stmt->execute();
	  $stmt->bind_result($fid,$showname,$url,$trname,$level,$fatherid,$tip,$orderno); 
	  while ($stmt->fetch()) {
		     	$listArr[] = array("id"=>$fid,"showname"=>$showname,"url"=>$url,
		     	                   "trname"=>$trname,"level"=>$level,"fatherid"=>$fatherid,
		     	                   "tip"=>$tip,"orderno"=>$orderno,);
	   }
	   $stmt->close();
    }else{
    	$idlist = explode(',',$ids);
    	foreach($idlist as $k=>$v){
    		if (intval($v)<=0) {
    		 	return false;
    		}
    }    	
	    $treesql = "SELECT f_id AS id, f_name AS showname, ifnull(f_path, '') AS url, f_name AS trname,f_divno AS level2,f_parentid AS fatherid,'' AS tip,f_displayorderno AS dorder  FROM pw_treenav WHERE f_id IN (".$ids.")";
	    $stmt = $conn->prepare($treesql);       
	    $result = $stmt->execute();    
      $stmt->bind_result($fid,$showname,$url,$trname,$level,$fatherid,$tip,$orderno); 
	    while ($stmt->fetch()) {
		     	$listArr[] = array("id"=>$fid,"showname"=>$showname,"url"=>$url,
		     	                   "trname"=>$trname,"level"=>$level,"fatherid"=>$fatherid,
		     	                   "tip"=>$tip,"orderno"=>$orderno,);
	   }
	   
	   $stmt->close();
	   
    }
	  
	  
	       
    return $listArr;  	
		
	}
	
	
	public static function getSites($merid)
	{
								
		$conn =  Db_Mysqli::getIntance()->getConnection();							 

	  $treesql = "SELECT f_id AS id,f_sitename AS sitename,f_sitedomain AS sitedomain,f_about AS about  FROM pw_sites where f_merid = ? ";
	  $stmt = $conn->prepare($treesql);	 	 
	  $stmt->bind_param('i',$merid);
	  $result = $stmt->execute();
         
	  if($result==false)
		{
		  SeasLog::log(SEASLOG_ERROR,mysqli_error($conn));
		}
	
	  $stmt->bind_result($fid,$sitename,$sitedomain,$about);
	 
	  $listArr = array();
 
	  while ($stmt->fetch()) {
		     	$listArr[] = array("id"=>$fid,"sitename"=>$sitename,"sitedomain"=>$sitedomain,"about"=>$about);
	   }
	      
		return $listArr;   		
		
	}
	
	public static function getCategory($merid,$siteid)
	{
								
		$conn =  Db_Mysqli::getIntance()->getConnection();							 

	  $treesql = "SELECT f_id AS id,f_category AS category,f_about AS about  FROM pw_category where f_merid = ?  and f_siteid=?";
	  $stmt = $conn->prepare($treesql);	 	 
	  $stmt->bind_param('ii',$merid,$siteid);
	  $result = $stmt->execute();
         
	  if($result==false)
		{
		  SeasLog::log(SEASLOG_ERROR,mysqli_error($conn));
		}
	
	  $stmt->bind_result($fid,$category,$about);
	 
	  $listArr = array();
 
	  while ($stmt->fetch()) {
		     	$listArr[] = array("id"=>$fid,"category"=>$category,"about"=>$about);
	   }
	      
		return $listArr;   		
		
	}
	

public static function insertPemid($pemid,$pemname,$pemabout,$siteid,$category,$treenavid,$merid)
{
 
  $conn =  Db_Mysqli::getIntance()->getConnection();
  $treesql = "insert into pw_permission (f_id,f_name,f_about,f_siteid,f_cateid,f_treenavid,f_merid)values(?,?,?,?,?,?,?)";
  //$parentid = $displayno = $rootid = $divno = $orderno = 0;
  //$fpath = $classpath = '';
  $stmt2 = $conn->prepare($treesql); 
  
  $stmt2->bind_param('issiiii',$pemid ,$pemname,$pemabout,$siteid,$category,$treenavid,$merid);		
  $res2 = $stmt2->execute() ;	
 
  if($res2==false)
	{
	  SeasLog::log(SEASLOG_ERROR,mysqli_error($conn));
	}    
	//$conn->commit();	 
	$stmt2->close();
	 return $res2;
}


public static function queryPemidexistent($merid,$siteid,$pemid)
	{
								
		$conn =  Db_Mysqli::getIntance()->getConnection();							 
	  $treesql = "SELECT f_id AS id  FROM pw_permission where f_merid = ?  and f_siteid=? and f_id = ?";
	  $stmt = $conn->prepare($treesql);	 	 
	  $stmt->bind_param('iii',$merid,$siteid,$pemid);
	  $result = $stmt->execute();
         
	  if($result==false)
		{
		  SeasLog::log(SEASLOG_ERROR,mysqli_error($conn));
		}	
	  $stmt->bind_result($fid);	 
	  $listArr = array(); 
	  while ($stmt->fetch()) {
		     	$listArr[] = array("id"=>$fid);
	   }
	   
		 return $listArr;   		
		
	}
	
public static function delPemid($merid,$pemid,$siteid)
{
 
  $conn =  Db_Mysqli::getIntance()->getConnection();
  $treesql = "delete from pw_permission  where f_id = ? and f_siteid = ? and f_merid = ?";
  //$parentid = $displayno = $rootid = $divno = $orderno = 0;
  //$fpath = $classpath = '';
  $stmt2 = $conn->prepare($treesql); 
  
  $stmt2->bind_param('iii',$pemid ,$siteid,$merid);		
  $res2 = $stmt2->execute() ;	
 
  if($res2==false)
	{
	  SeasLog::log(SEASLOG_ERROR,mysqli_error($conn));
	}    
	//$conn->commit();	 
	$stmt2->close();
	 return $res2;
}

}

?>