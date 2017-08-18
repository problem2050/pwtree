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
			$xml = "";
			foreach($source as $row)
			{	
				if ($row['fatherid'] == $fatherid)
				{			
					if(!empty($row['url'])){	
						if(!empty($navPer)&&in_array($row['id'],array_keys($navPer))){
							$navPerId = $navPer[$row['id']];
							//var_dump($navPerId);
							$xml .= '<ul><li>'.$row['showname'].'</li>';
							for($i=0;$i<count($navPerId);$i++){	
								$xml .= '<ul><li>'.$navPerId[$i]['name'].'</li></ul>';
							}
						$xml .= '</ul>';	
						}else{
							$xml .= '<ul> '.$row['showname'].'</ul>';
						}
					}else{
						$xml .= '<li>'.$row['showname']."</li>";
						$xml .= buildXml($source, $row['id'],$navPer);
					}
					//$xml .= '</ul>';
				}
			}
			return $xml;
		}
		
   $xml .= buildXml($rs, $siteid,$navPer);	
   $xml .= '</ul></div></div>';
 	echo ($xml);exit;
 	
}
