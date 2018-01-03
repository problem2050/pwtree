<?php
require_once($_SERVER["Root_Path"]."/inc/bootstrap.php");
require_once($_SERVER["Root_Path"]."/inc/api_function.php");

$apiname = isset($_REQUEST['apiname'])?$_REQUEST['apiname']:'';
$version = isset($_REQUEST['version'])?$_REQUEST['version']:'';

$sign  = isset($_REQUEST['sign'])?$_REQUEST['sign']:'';
$merid  = isset($_REQUEST['merid'])?$_REQUEST['merid']:'';

if($merid==''){
	  echo json_encode(array("STATE"=>"-99995","MSG"=>'商户号错误',"DATA"=>array()));
    exit;
}

if($sign==''){
	  echo json_encode(array("STATE"=>"-99995","MSG"=>'签名不能为空',"DATA"=>array()));
    exit;
}

if($apiname==''){
	  echo json_encode(array("STATE"=>"-99995","MSG"=>'apiname不能为空',"DATA"=>array()));
    exit;
}

if($version==''){
	  echo json_encode(array("STATE"=>"-99995","MSG"=>'version不能为空',"DATA"=>array()));
    exit;
}


$m = new Memcache();
$m->connect('127.0.0.1', 11211);

$securitydata = $m->get('mersecuritycode:'.$merid);

if($securitydata==''){
	 $rs = User_Login::getMerinfoUserIdByid($merid);
   if($rs){
   	
   	 $securitydata = $rs['securitycode'];
   	 if($securitydata==''){
   	 	echo json_encode(array("STATE"=>"-99996","MSG"=>'安全码检验错误！',"DATA"=>array()));
      exit;
     }
     $m->set("mersecuritycode:".$merid,$rs['securitycode'],0,time() + 120*60);//缓存2小时 
   }else{
    echo json_encode(array("STATE"=>"-99996","MSG"=>'无效的商户号',"DATA"=>array()));
    exit;
  }
}

verifySign($_REQUEST,$securitydata);


function verifySign($request,$securitycode){
	
$apiname = isset($request['apiname'])? $request['apiname']:'';
$version = isset($request['version'])? $request['version']:'';

$sign  = isset($request['sign'])? $request['sign']:'';
$merid  = isset($request['merid'])? $request['merid']:'';

if($apiname=='userLogin'){
	
	$username= isset($request['username'])? $request['username']:'';
	$password= isset($request['password'])? $request['password']:'';
	$expiretime= isset($request['expiretime'])? $request['expiretime']:'';
	
	$verifyStr = $merid.$apiname.$version.$username.$password.$expiretime.$securitycode;
	//var_dump($merid,$apiname,$version,$username,$password,$expiretime,$securitycode);
	//exit;
	
	if(md5($verifyStr)!=$sign)
	 {
	 		echo json_encode(array("CODE"=>"-99990","MSG"=>"检验签名失败!","DATA"=>array()));
	    exit;
	 }	 
 }

if(in_array($apiname,array('getUserTreeNode','getUserTreeNodeNoPid','getPermidList',"userLoginOut"))){
	
	$siteid= isset($request['siteid'])? $request['siteid']:'';
	$usertoken = isset($request['usertoken'])? $request['usertoken']:'';
	
	$verifyStr = $merid.$apiname.$version.$siteid.$usertoken.$securitycode;
  //var_dump($merid,$apiname,$version,$siteid,$usertoken,$securitycode);exit;
	if(md5($verifyStr)!=$sign)
	 {
	 		echo json_encode(array("CODE"=>"-99990","MSG"=>"检验签名失败!","DATA"=>array()));
	    exit;
	 }
 }
 
if(in_array($apiname,array('getUserList','getDeptList','getMerInfo','getSiteList'))){
	
	$verifyStr = $merid.$apiname.$version.$securitycode;
	if(md5($verifyStr)!=$sign)
	 {
	 		echo json_encode(array("CODE"=>"-99990","MSG"=>"检验签名失败!","DATA"=>array()));
	    exit;
	 }
 }
}

?>
