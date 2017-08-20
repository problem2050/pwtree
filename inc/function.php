<?php


$merid = 100001;

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
	// var_dump('qqqq',$navPer);exit;
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
							$navPerId = $navPer[$row['id']];
							//$xml .= '<row at_id="'.$row['id'].'" at_showname="'.$row['showname'].'" at_fatherid="'.$row['fatherid'].'" at_show="1" p_type="isNid" nodetype="node" ck_show="navshow">';
							for($i=0;$i<count($navPerId);$i++){	
								//$xml .= '<row at_id="'.$navPerId[$i]['id'].'" at_showname="'.$navPerId[$i]['name'].'['.$navPerId[$i]['id'].']" at_fatherid="'.$row['id'].'" at_show="1" deltype="1" p_type="isPid" nodetype="page"></row>';
								 array_push($child_arr,array('id'=>$navPerId[$i]['id'],'text'=>$navPerId[$i]['name'],'nodetype'=>'child'));
							}
							array_push($tree_arr ,array("id"=>$row['id'],'text'=>$row['showname'],'nodetype'=>'nodes','children'=>$child_arr) );
						}else{
							//$xml .= '<row at_id="'.$row['id'].'" at_showname="'.$row['showname'].'" at_fatherid="'.$row['fatherid'].'" at_show="1" p_type="isNid" nodetype="page" ck_show="navshow">';
							//var_dump($tree_arr);
							array_push($tree_arr,array('id'=>$row['id'],'text'=>$row['showname'],'nodetype'=>'child'));
						}
					}else{
						//$xml .= '<row at_id="'.$row['id'].'" at_showname="'.$row['showname'].'" at_fatherid="'.$row['fatherid'].'" at_show="1"  p_type="isNid" nodetype="node">';
						$node_arr =  array("id"=>$row['id'],'text'=>$row['showname'],'nodetype'=>'nodes','children'=>buildXml($source, $row['id'],$navPer)) ;
						
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
