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
	$xml = ' <div class="portlet-body"><div id="tree_1" class="tree-demo"><ul>';
	
	function buildXml($source,$fatherid, $navPer){		
			$xml = "\n";
			foreach($source as $row)
			{	
				if ($row['fatherid'] == $fatherid)
				{			
					if(!empty($row['url'])){	
						if(!empty($navPer)&&in_array($row['id'],array_keys($navPer))){
							$navPerId = $navPer[$row['id']];
							//var_dump($navPerId);
							$xml .= '<li at_id="'.$row['id'].'" at_showname="'.$row['showname'].'" at_fatherid="'.$row['fatherid'].'" at_show="1" p_type="isNid" nodetype="node" ck_show="navshow"></li>';
							for($i=0;$i<count($navPerId);$i++){	
								$xml .= '<li at_id="'.$navPerId[$i]['id'].'" at_showname="'.$navPerId[$i]['name'].'['.$navPerId[$i]['id'].']" at_fatherid="'.$row['id'].'" at_show="1" deltype="1" p_type="isPid" nodetype="page"></li>';
							}
						}else{
							$xml .= '<li at_id="'.$row['id'].'" at_showname="'.$row['showname'].'" at_fatherid="'.$row['fatherid'].'" at_show="1" p_type="isNid" nodetype="page" ck_show="navshow"></li>';
						}
					}else{
						$xml .= '<li at_id="'.$row['id'].'" at_showname="'.$row['showname'].'" at_fatherid="'.$row['fatherid'].'" at_show="1"  p_type="isNid" nodetype="node"></li>';
						$xml .= buildXml($source, $row['id'],$navPer);
					}
					$xml .= '</ul>';
				}
			}
			return $xml;
		}
		
   $xml .= buildXml($rs, $siteid,$navPer);	
   $xml .= '</ul></div></div>';
 	echo ($xml);exit;
 	
}
