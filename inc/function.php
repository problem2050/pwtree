<?php


$merid = 10001;

GLOBAL $merid;

function getPageHtml($allcnt,$page,$pagesize){

  $pagehtml = '';

  $maxpage = (int)($allcnt / $pagesize) + 1;

  $pagehtml = "<li class=\"prev \" ><a href=\"?page=1&pagesize=".$pagesize."\"><i class=\"fa fa-angle-left\"></i></a></li>";

  for($i=1;$i<= $maxpage;$i++)
  {
   if ($page==$i)
    {
      $pagehtml .="<li class=\"active\" ><a href=\"?page=".$i."&pagesize=".$pagesize."\">".$i."</a></li>";
    }else{

      $pagehtml .="<li><a href=\"?page=".$i."&pagesize=".$pagesize."\">".$i."</a></li>";
     }
  }

   $pagehtml .= "<li class=\"next\" ><a href=\"?page=".$maxpage."&pagesize=".$pagesize."\"><i class=\"fa fa-angle-right\"></i></a></li>";

  return $pagehtml;
}


function getBuildTree($siteid,$nids ='', $pids = array()){
	
	$rs = Pwtree_Nodes::getMenuTreeXml($siteid);	 		
	//var_dump($rs);
	$navPer = array();
	$pIdTreeArr = Pwtree_Nodes::getPermissionByNavid($siteid);
		if($pIdTreeArr){
			foreach($pIdTreeArr as $val){
				if($pids){
					if(in_array($val['id'],$pids)){
						$navPer[$val['treeid']][] = $val;
					}
				}else{
					$navPer[$val['treeid']][] = $val;
				}
			}
		}
	 //var_dump($siteid,$pIdTreeArr);
	//$xml = ' <div class="portlet-body"><div id="tree_1" class="tree-demo"><ul>';
	$xml = '<?xml version="1.0" encoding="utf8"?><xml>';
	$tree_arr=array();
	
	function buildXml($source,$fatherid, $navPer){		
			 	
			$xml = "\n";
			foreach($source as $row)
			{	
				if ($row['fatherid'] == $fatherid)
				{			
					if(!empty($row['url'])){	
						if(!empty($navPer)&&in_array($row['id'],array_keys($navPer))){
							$navPerId = $navPer[$row['id']];
							$xml .= '<row at_id="'.$row['id'].'" at_showname="'.$row['showname'].'" at_fatherid="'.$row['fatherid'].'" at_show="1" p_type="isNid" nodetype="node" ck_show="navshow">';
							for($i=0;$i<count($navPerId);$i++){	
								$xml .= '<row at_id="'.$navPerId[$i]['id'].'" at_showname="'.$navPerId[$i]['name'].'['.$navPerId[$i]['id'].']" at_fatherid="'.$row['id'].'" at_show="1" deltype="1" p_type="isPid" nodetype="page"></row>';
							}
						}else{
							$xml .= '<row at_id="'.$row['id'].'" at_showname="'.$row['showname'].'" at_fatherid="'.$row['fatherid'].'" at_show="1" p_type="isNid" nodetype="page" ck_show="navshow">';
						}
					}else{
						$xml .= '<row at_id="'.$row['id'].'" at_showname="'.$row['showname'].'" at_fatherid="'.$row['fatherid'].'" at_show="1"  p_type="isNid" nodetype="node">';
						$xml .= buildXml($source, $row['id'],$navPer);
					}
					$xml .= '</row>';
				}
			}
			return $xml;
		}
   
     //生成站点xml
		$xml .= buildXml($rs, $siteid,$navPer);
		$xml .= '</xml>';
		$xml = str_replace('&', '&amp;', $xml);
		 
		return $xml;
 	 
  }
  
function getBuildTree2($siteid,$nids ='', $pids = array()){
	
	$rs = Pwtree_Nodes::getMenuTreeXml($siteid);	 		
	//var_dump($rs);
	$navPer = array();
	$tree_arr = array();
	
	$pIdTreeArr = Pwtree_Nodes::getPermissionByNavid($siteid);
		if($pIdTreeArr){
			foreach($pIdTreeArr as $val){
				if($pids){
					if(in_array($val['id'],$pids)){
						$navPer[$val['treeid']][] = $val;
					}
				}else{
					$navPer[$val['treeid']][] = $val;
				}
			}
		}
	 //var_dump($siteid,$pIdTreeArr);
	//$xml = ' <div class="portlet-body"><div id="tree_1" class="tree-demo"><ul>';
	//var_dump('qqqq',$navPer);exit;
	//$tree_arr=array();
	//$tree_arr=array();
	// global $tree_arr;
	function buildXml($source,$fatherid, $navPer){		
			$tree_arr=array();		
      $child_arr=array();
			foreach($source as $row)
			{	
				if ($row['fatherid'] == $fatherid)
				{			
					if(!empty($row['url'])){	
						if(!empty($navPer)&&in_array($row['id'],array_keys($navPer))){
							$child_arr=array();
							$navPerId = $navPer[$row['id']];							 
							for($i=0;$i<count($navPerId);$i++){								
								 array_push($child_arr,array('id'=>$navPerId[$i]['id'],'showname'=>$navPerId[$i]['name'],'cateid'=>$navPerId[$i]['cateid'],'about'=>$navPerId[$i]['about'],'text'=>'['.$navPerId[$i]['id'].']'.$navPerId[$i]['name'].'[<a href="#" onclick="delpemid(\''.trim($navPerId[$i]['id']).'\')">删除</a>]','nodetype'=>'pemid',"icon"=>"fa fa-cube icon-state-danger"));
								 }
							array_push($tree_arr ,array("id"=>$row['id'],'text'=>$row['showname'],'nodetype'=>'page',"icon"=>"fa fa-file icon-state-warning",'children'=>$child_arr) );
						}else{
							//$xml .= '<row at_id="'.$row['id'].'" at_showname="'.$row['showname'].'" at_fatherid="'.$row['fatherid'].'" at_show="1" p_type="isNid" nodetype="page" ck_show="navshow">';
							//var_dump($tree_arr);
							array_push($tree_arr,array('id'=>$row['id'],'text'=>$row['showname'],'nodetype'=>'page',"icon"=>"fa fa-file icon-state-warning"));
						}
					}else{
						//$xml .= '<row at_id="'.$row['id'].'" at_showname="'.$row['showname'].'" at_fatherid="'.$row['fatherid'].'" at_show="1"  p_type="isNid" nodetype="node">';
						$node_arr =  array("id"=>$row['id'],'text'=>$row['showname'],'nodetype'=>'nodes',"icon"=>"fa fa-folder icon-state-success",'children'=>buildXml($source, $row['id'],$navPer)) ;
						
						//$node_arr['children']=array(buildXml($source, $row['id'],$navPer))
						 array_push($tree_arr ,$node_arr );			 
						 //array_push($tree_arr,buildXml($source, $row['id'],$navPer));
					}
					//$xml .= '</row>';
				}
			}
			return $tree_arr;
		}
   
     //生成站点xml
	 $tree_json= buildXml($rs, $siteid,$navPer);
	 
	 return json_encode($tree_json);
 	 
  } 

  
 function getBuildTree3($siteid,$merid , $userid,$groupid=''){
	
	$rs = Pwtree_Nodes::getMenuTreeXml($siteid);	 		
	//var_dump($rs);
	$navPer = array();
	$tree_arr = array();
	
	$pIdTreeArr = Pwtree_Nodes::getPermissionByNavid($siteid);
	 if($pIdTreeArr){
			foreach($pIdTreeArr as $val){
					$navPer[$val['treeid']][] = $val;
			}
		}
		
	 $selectNodeIdArr = Pwtree_Nodes::getPermissionTreenavList($siteid,$merid,$userid,$groupid);	
	 $pemidArr = isset($selectNodeIdArr['pemid'])?$selectNodeIdArr['pemid']:array();
	 $treeNodeidArr = isset($selectNodeIdArr['treenodeid'])?$selectNodeIdArr['treenodeid']:array();
	 
	 //var_dump($pemidArr,$treeNodeidArr,$rs);exit;
	//$xml = ' <div class="portlet-body"><div id="tree_1" class="tree-demo"><ul>';
	//var_dump('qqqq',$navPer);exit;
	//$tree_arr=array();
	//$tree_arr=array();
	// global $tree_arr;
	 
	function buildXml($source,$fatherid, $navPer,$pemidArr,$treeNodeidArr){		
			$tree_arr=array();		
            $child_arr=array();
			foreach($source as $row)
			{	
				if ($row['fatherid'] == $fatherid)
				{			
					if(!empty($row['url'])){	
						if(!empty($navPer)&&in_array($row['id'],array_keys($navPer))){
							$child_arr=array();
							$navPerId = $navPer[$row['id']];							 
							for($i=0;$i<count($navPerId);$i++){	
                                  if(in_array($navPerId[$i]['id'],$pemidArr)){							
								    array_push($child_arr,array('id'=>$navPerId[$i]['id'],"state"=>array("opened"=>"boolean","selected"=>"boolean"),'showname'=>$navPerId[$i]['name'],'cateid'=>$navPerId[$i]['cateid'],'about'=>$navPerId[$i]['about'],'text'=>'['.$navPerId[$i]['id'].']'.$navPerId[$i]['name'].'[<a href="#" onclick="delpemid(\''.trim($navPerId[$i]['id']).'\')">删除</a>]','nodetype'=>'pemid',"icon"=>"fa fa-cube icon-state-danger"));
								  }else{
									array_push($child_arr,array('id'=>$navPerId[$i]['id'],'showname'=>$navPerId[$i]['name'],'cateid'=>$navPerId[$i]['cateid'],'about'=>$navPerId[$i]['about'],'text'=>'['.$navPerId[$i]['id'].']'.$navPerId[$i]['name'].'[<a href="#" onclick="delpemid(\''.trim($navPerId[$i]['id']).'\')">删除</a>]','nodetype'=>'pemid',"icon"=>"fa fa-cube icon-state-danger"));
								   } 
								 }
						    //if(in_array($row['id'],$treeNodeidArr)){
							//	array_push($tree_arr ,array("id"=>$row['id'],'text'=>$row['showname'],"state"=>array("opened"=>"boolean","selected"=>"boolean"),'nodetype'=>'page',"icon"=>"fa fa-file icon-state-warning",'children'=>$child_arr) );
							//}else{
								array_push($tree_arr ,array("id"=>$row['id'],'text'=>$row['showname'],'nodetype'=>'page',"icon"=>"fa fa-file icon-state-warning",'children'=>$child_arr) );
							//}
						}else{
							 //var_dump($row['id'],$treeNodeidArr);exit;
                if(in_array($row['id'],$treeNodeidArr)){
							    array_push($tree_arr,array('id'=>$row['id'],'text'=>$row['showname'],"state"=>array("opened"=>"boolean","selected"=>"boolean"),'nodetype'=>'page',"icon"=>"fa fa-file icon-state-warning"));
							}else{
								array_push($tree_arr,array('id'=>$row['id'],'text'=>$row['showname'],'nodetype'=>'page',"icon"=>"fa fa-file icon-state-warning"));
							}
						}
					}else{
						 if(in_array($row['id'],$treeNodeidArr)){
							$node_arr =  array("id"=>$row['id'],'text'=>$row['showname'],"state"=>array("opened"=>"boolean","selected"=>""),'nodetype'=>'nodes',"icon"=>"fa fa-folder icon-state-success",'children'=>buildXml($source, $row['id'],$navPer,$pemidArr,$treeNodeidArr)) ;
						 }else{
							$node_arr =  array("id"=>$row['id'],'text'=>$row['showname'],'nodetype'=>'nodes',"icon"=>"fa fa-folder icon-state-success",'children'=>buildXml($source, $row['id'],$navPer,$pemidArr,$treeNodeidArr)) ;
						 }
						 array_push($tree_arr ,$node_arr );			 
					}
				}
			}
			return $tree_arr;
		}
   
	 $tree_json= buildXml($rs, $siteid,$navPer,$pemidArr,$treeNodeidArr);
	 
	 return json_encode($tree_json);
 	 
  } 
  

  function getUserBuildTree($siteid,$merid,$userid,$groupid=''){
	
	$rs = Pwtree_Nodes::getMenuTreeXml($siteid);	 		
	//var_dump($rs);
	$navPer = array();
	$tree_arr = array();
	
	$pIdTreeArr = Pwtree_Nodes::getPermissionByNavid($siteid);
	 if($pIdTreeArr){
			foreach($pIdTreeArr as $val){
					$navPer[$val['treeid']][] = $val;
			}
		}
		
	 $selectNodeIdArr = Pwtree_Nodes::getPermissionTreenavList($siteid,$merid,$userid,$groupid);	
	 $pemidArr = isset($selectNodeIdArr['pemid'])?$selectNodeIdArr['pemid']:array();
	 $treeNodeidArr = isset($selectNodeIdArr['treenodeid'])?$selectNodeIdArr['treenodeid']:array();
	 
	 //var_dump($pemidArr,$treeNodeidArr);exit;
	//$xml = ' <div class="portlet-body"><div id="tree_1" class="tree-demo"><ul>';
	//var_dump('qqqq',$navPer);exit;
	//$tree_arr=array();
	//$tree_arr=array();
	// global $tree_arr;
	 
	function buildXml($source,$fatherid, $navPer,$pemidArr,$treeNodeidArr){		
			$tree_arr=array();		
            $child_arr=array();
			foreach($source as $row)
			{	
				if ($row['fatherid'] == $fatherid)
				{			
					if(!empty($row['url'])){	
						if(!empty($navPer)&&in_array($row['id'],array_keys($navPer))){
							$child_arr=array();
							$navPerId = $navPer[$row['id']];							 
							for($i=0;$i<count($navPerId);$i++){	
                                  if(in_array($navPerId[$i]['id'],$pemidArr)){							
								    array_push($child_arr,array('id'=>$navPerId[$i]['id'],"state"=>array("opened"=>"boolean","selected"=>""),'showname'=>$navPerId[$i]['name'],'cateid'=>$navPerId[$i]['cateid'],'about'=>$navPerId[$i]['about'],'text'=>'['.$navPerId[$i]['id'].']'.$navPerId[$i]['name'],'nodetype'=>'pemid',"icon"=>"fa fa-cube icon-state-danger"));
								  } 
								 }
						    if(in_array($row['id'],$treeNodeidArr)){
								array_push($tree_arr ,array("id"=>$row['id'],'text'=>$row['showname'],"state"=>array("opened"=>"boolean","selected"=>""),'nodetype'=>'page',"icon"=>"fa fa-file icon-state-warning",'children'=>$child_arr) );
							}
						}else{
							 
                if(in_array($row['id'],$treeNodeidArr)){
							    array_push($tree_arr,array('id'=>$row['id'],'text'=>$row['showname'],"state"=>array("opened"=>"boolean","selected"=>""),'nodetype'=>'page',"icon"=>"fa fa-file icon-state-warning"));
							} 
						}
					}else{
						 if(in_array($row['id'],$treeNodeidArr)){
							$node_arr =  array("id"=>$row['id'],'text'=>$row['showname'],"state"=>array("opened"=>"boolean","selected"=>""),'nodetype'=>'nodes',"icon"=>"fa fa-folder icon-state-success",'children'=>buildXml($source, $row['id'],$navPer,$pemidArr,$treeNodeidArr)) ;
						   array_push($tree_arr ,$node_arr );	
						 }						 
					}
				}
			}
			return $tree_arr;
		}
   
	 $tree_json= buildXml($rs, $siteid,$navPer,$pemidArr,$treeNodeidArr);
	 
	 return json_encode($tree_json);
 	 
  } 