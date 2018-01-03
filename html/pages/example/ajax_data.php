<?php
header('Content-type: application/json;charset=utf-8');

require_once($_SERVER["Root_Path"]."/inc/bootstrap.php");
require_once($_SERVER["Root_Path"]."/inc/public_function.php");

$apiname = isset($_REQUEST['apiname'])?$_REQUEST['apiname']:'';
$version = isset($_REQUEST['version'])?$_REQUEST['version']:'';

$merid  = isset($_REQUEST['merid'])?$_REQUEST['merid']:'';

$securitycode  = isset($_REQUEST['securitycode'])?$_REQUEST['securitycode']:'';
$username  = isset($_REQUEST['username'])?$_REQUEST['username']:'';
$password  = isset($_REQUEST['password'])?$_REQUEST['password']:'';
$apiname  = isset($_REQUEST['apiname'])?$_REQUEST['apiname']:'';
$expiretime  = isset($_REQUEST['expiretime'])?$_REQUEST['expiretime']:'';

if($apiname=='')
{
	    echo json_encode(array("CODE"=>"-99990","MSG"=>"无效的接口名!","DATA"=>array()));
	    exit;
}
if($apiname=='userLogin')
 {
 	 $signStr = $merid.$apiname.$version.$username.$password.$expiretime.$securitycode;
 	            
 	 $sign = md5($signStr);
 	 $postdata=array("merid"=>$merid,
 	                 "apiname"=>$apiname,
 	                 "version"=>$version,
 	                 "username"=>$username,
 	                 "password"=>$password,
 	                 "expiretime"=>$expiretime,
 	                 "sign"=>$sign
 	                 );
   $ret = getHttpResponsePOST("http://www.pwtree.com/api/userLoginApi.php",$postdata);
   echo $ret;
   exit;
 }

if(in_array($apiname,array('getUserList','getDeptList','getMerInfo','getSiteList')))
 {
 	 $getUrl = array("getUserList"=>"http://www.pwtree.com/api/getUserList.php",
 	                 "getDeptList"=>"http://www.pwtree.com/api/getDeptList.php",
 	                 "getMerInfo"=>"http://www.pwtree.com/api/getMerinfo.php",
 	                 "getSiteList"=>"http://www.pwtree.com/api/getSiteList.php",);
 	                 
 	 $signStr = $merid.$apiname.$version.$securitycode; 	  	            
 	 $sign = md5($signStr);
 	 $url = $getUrl[$apiname];
 	 
 	 $postdata=array("merid"=>$merid,
 	                 "apiname"=>$apiname,
 	                 "version"=>$version,
 	                 "sign"=>$sign
 	                 );
   $ret = getHttpResponsePOST($url,$postdata);
   echo $ret;
   exit;
 }
 
if(in_array($apiname,array('getUserTreeNode','getUserTreeNodeNoPid','getPermidList','userLoginOut')))
 {
 	 $getUrl = array("getUserTreeNode"=>"http://www.pwtree.com/api/getUserTree.php",
 	                 "getUserTreeNodeNoPid"=>"http://www.pwtree.com/api/getUserTreeNoPid.php",
 	                 "getPermidList"=>"http://www.pwtree.com/api/getPermidList.php",
 	                 "userLoginOut"=>"http://www.pwtree.com/api/userLogoutApi.php",);
   
   $usertoken  = isset($_REQUEST['usertoken'])?$_REQUEST['usertoken']:''; 
   $siteid  = isset($_REQUEST['siteid'])?$_REQUEST['siteid']:''; 
   
 	 $signStr = $merid.$apiname.$version.$siteid.$usertoken.$securitycode;            
 	 //var_dump($merid.$apiname.$version.$siteid.$usertoken.$securitycode);
 	 $sign = md5($signStr);
 	 $url = $getUrl[$apiname];
 	 
 	 $postdata=array("merid"=>$merid,
 	                 "apiname"=>$apiname,
 	                 "version"=>$version,
 	                 "sign"=>$sign,
 	                 "siteid"=>$siteid,
 	                 "usertoken"=>$usertoken
 	                 );
   $ret = getHttpResponsePOST($url,$postdata);
   echo $ret;
   exit;
 }
