/**
	 * 获取目录树xml
	 * @author zouyi
	 * @param	$siteid站点ID
	 * @param	$pIds权限ID
	 * @param	$nIds节点ID
	 */
	public static function getEditTreeXml($siteid, $nIds = array(), $pIds = array())
	{
		/*
		$sql = "select at_id as id,
				       at_name as showname,
				       nvl(at_path, '') as url,
				       at_name as \"RENAME\",
				       at_divno as \"LEVEL\",
				       at_parentid as fatherid,
				       '' as tip,
				       at_displayorderno as \"ORDER\"
				  from pw_treenav
				 where at_isshow = 1 ";
		if (!empty($nIds)){
			$nIdList = implode(',',$nIds);
			$sql .= " and at_id in ({$nIdList})";	
		}else{
			$sql .= " Start With at_id = ".$siteid." Connect By Prior at_id = at_parentid";
		}
		$sql .= " order by fatherid, \"ORDER\" desc, url, id";
		$rs = Db_DBbase::getInstance()->ExecuteQuery($sql, null, OCI_ASSOC + OCI_RETURN_NULLS + OCI_RETURN_LOBS);
		if (empty($rs)) return false;
		*/
		
		$args = array("ids"=> empty($nIds)?'':implode(',',$nIds),"siteid"=>$siteid);
		$ret =  Eas_Eas::getInstance('useradmin')->invoke("getMenuTreeXml", $args);
		$rs =  isset($ret['LIST']) && count($ret['LIST'])>0 ? $ret['LIST']: '';
                if (empty($rs))
                   return false;
                
		$navPer = array();
		$pIdTreeArr = self::getPermissionByNavid($siteid);
		if($pIdTreeArr){
			foreach($pIdTreeArr as $val){
				if($pIds){
					if(in_array($val['ID'],$pIds)){
						$navPer[$val['TREENAVID']][] = $val;
					}
				}else{
					$navPer[$val['TREENAVID']][] = $val;
				}
			}
		}
		//var_dump($pIds,$nIds,$navPer);exit;
		$xml = '<?xml version="1.0" encoding="gb2312"?><xml>';
		// 内嵌递归无限级
		function buildXml($source,$fatherid, $navPer){		
			$xml = "\n";
			foreach($source as $row)
			{	
				if ($row['FATHERID'] == $fatherid)
				{			
					if(!empty($row['URL'])){	
						if(!empty($navPer)&&in_array($row['ID'],array_keys($navPer))){
							$navPerId = $navPer[$row['ID']];
							$xml .= '<row at_id="'.$row['ID'].'" at_showname="'.$row['SHOWNAME'].'" at_fatherid="'.$row['FATHERID'].'" at_show="1" p_type="isNid" nodetype="node" ck_show="navshow">';
							for($i=0;$i<count($navPerId);$i++){	
								$xml .= '<row at_id="'.$navPerId[$i]['ID'].'" at_showname="'.$navPerId[$i]['NAME'].'['.$navPerId[$i]['ID'].']" at_fatherid="'.$row['ID'].'" at_show="1" deltype="1" p_type="isPid" nodetype="page"></row>';
							}
						}else{
							$xml .= '<row at_id="'.$row['ID'].'" at_showname="'.$row['SHOWNAME'].'" at_fatherid="'.$row['FATHERID'].'" at_show="1" p_type="isNid" nodetype="page" ck_show="navshow">';
						}
					}else{
						$xml .= '<row at_id="'.$row['ID'].'" at_showname="'.$row['SHOWNAME'].'" at_fatherid="'.$row['FATHERID'].'" at_show="1"  p_type="isNid" nodetype="node">';
						$xml .= buildXml($source, $row['ID'],$navPer);
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
