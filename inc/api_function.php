<?php

 
function ApiGetUserBuildTree($siteid,$merid,$userid,$groupid=''){
	
	$rs = Pwtree_Nodes::getMenuTreeXml($merid,$siteid);	 		
	
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
								    array_push($child_arr,array('id'=>$navPerId[$i]['id'],'showname'=>$navPerId[$i]['name'],'cateid'=>$navPerId[$i]['cateid'],'about'=>$navPerId[$i]['about'],'text'=>'['.$navPerId[$i]['id'].']'.$navPerId[$i]['name'],'nodetype'=>'pemid'));
								  } 
								 }
						    if(in_array($row['id'],$treeNodeidArr)){
								array_push($tree_arr ,array("id"=>$row['id'],'text'=>$row['showname'],'nodetype'=>'page','children'=>$child_arr) );
							}
						}else{
							 
                if(in_array($row['id'],$treeNodeidArr)){
							    array_push($tree_arr,array('id'=>$row['id'],'text'=>$row['showname'],'nodetype'=>'page'));
							} 
						}
					}else{
						 if(in_array($row['id'],$treeNodeidArr)){
							$node_arr =  array("id"=>$row['id'],'text'=>$row['showname'],'nodetype'=>'nodes','children'=>buildXml($source, $row['id'],$navPer,$pemidArr,$treeNodeidArr)) ;
						   array_push($tree_arr ,$node_arr );	
						 }						 
					}
				}
			}
			return $tree_arr;
		}
   
	 $tree_json= buildXml($rs, $siteid,$navPer,$pemidArr,$treeNodeidArr);
	 
	 return $tree_json;
 	 
  } 