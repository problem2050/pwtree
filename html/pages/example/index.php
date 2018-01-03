<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        <title>Pwtree | 测试用例</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="" width=device-width, initial-scale=1" name="viewport" />
        <meta content="Pwtree管理平台,为您是提供一个简单的目录树管理编辑功能，可以帮您管理用户的权限和需要的树型结构数据，通过API可以轻松获取目录树结构数据" name="description" />
        <meta content="Pwtree,Tree,目录树，树，权限管理树，TreeNode,Node,管理后台,PowerTree" name="Keywords" />
        <meta content="pwtree" name="author" />        
        <!-- BEGIN GLOBAL MANDATORY STYLES -->                      
        <link href="/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
       <style  type="text/css">
       
        .labletext{
        	text-align:left;
        	margin-top:10px;  
        	margin-left:4px;  
        	position:absolute;      	        	
        }
        .rowclass{        	
        	height:45px;
        	width:360px;
        	background:#C0C0C0;
        	margin-left: 20px;
         
        	}
        .responsetext{
        width:600px;
        background:#C0C0C0;	
        margin-left: 20px;
        height:auto;
        }
        	
        .inputrow  {
					position: absolute;
					margin-left: 80px;
					margin-top: 10px;
					height:25px;
					width: 160px;
        	} 
        .subbutton  {
					position: absolute;
					width:400px;
					text-align: center;
        	}
        	        		
        </style>
        
      <script src="/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
      <script src="/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

 </head> 
 <body>

<div style="width:360px;height:30px;margin-left: 20px;font-size:16px;text-align:center;margin-top:10px;	">
<lable >登录接口</lable>
</div>
<div class="rowclass">	
	<div class="labletext">接口名:</div>
<input class="inputrow" type="text" id="apiname" name="apiname" value="userLogin"></input>
</div>
<div class="rowclass">
	<div class="labletext">商户号:</div>
<input class="inputrow" type="text" id="merid" name="merid" value="10006"></input>
</div>	

<div class="rowclass">
	<div class="labletext">用户名:</div>
<input class="inputrow" type="text" id="username" name="username" value="test001" ></input>
</div>
	
<div class="rowclass">
	<div class="labletext">密码:</div>
<input class="inputrow" type="text" id="password" name="password" value="123" ></input>
</div>	

<div class="rowclass">
	<div class="labletext">API安全码:</div>
<input class="inputrow" type="text" id="securitycode" name="securitycode" value="la2JXRg9Wdne" ></input>
</div>	

<div class="rowclass">
	<div class="labletext">版本号:</div>
<input class="inputrow" type="text" id="version" name="version" value="1.0.0"></input>
</div>
	
<div class="rowclass">
	<div class="labletext">过期时间:</div>
<input class="inputrow" type="text" id="expiretime" name="expiretime" value="30"></input>
</div>	

<div class="rowclass">
	<div class="subbutton">
<button   type="button" id="submit-login" name="submit-login" >提交</button>
</div>
</div>	
</br>
<div class="responsetext" id="responseid">
返回数据区：
</div>

<div style="width:360px;height:30px;margin-left: 20px;font-size:16px;text-align:center;margin-top:10px;	">
<lable >通用接口</lable>
</div>
<div class="rowclass">	
	<div class="labletext">接口名:</div>
<input class="inputrow" type="text" id="com_apiname" name="com_apiname" value=""></input>
</div>
<div class="rowclass">
	<div class="labletext">商户号:</div>
<input class="inputrow" type="text" id="com_merid" name="com_merid" value="10006"></input>
</div>	
<div class="rowclass">
	<div class="labletext">API安全码:</div>
<input class="inputrow" type="text" id="com_securitycode" name="com_securitycode" value="la2JXRg9Wdne" ></input>
</div>	

<div class="rowclass">
	<div class="labletext">版本号:</div>
<input class="inputrow" type="text" id="com_version" name="com_version" value="1.0.0"></input>
</div>

<div class="rowclass">
	<div class="subbutton">
<button   type="button" id="submit-common" name="submit-common" >提交</button>
</div>
</div>	
</br>
<div class="responsetext" id="com_responseid">
返回数据区：
</div>


<div style="width:360px;height:30px;margin-left: 20px;font-size:16px;text-align:center;margin-top:10px;	">
<lable >获取用户目录树</lable>
</div>
<div class="rowclass">	
	<div class="labletext">接口名:</div>
<input class="inputrow" type="text" id="user_apiname" name="user_apiname" value=""></input>
</div>
<div class="rowclass">
	<div class="labletext">商户号:</div>
<input class="inputrow" type="text" id="user_merid" name="user_merid" value="10006"></input>
</div>	
<div class="rowclass">
	<div class="labletext">API安全码:</div>
<input class="inputrow" type="text" id="user_securitycode" name="user_securitycode" value="la2JXRg9Wdne" ></input>
</div>	

<div class="rowclass">
	<div class="labletext">版本号:</div>
<input class="inputrow" type="text" id="user_version" name="user_version" value="1.0.0"></input>
</div>

<div class="rowclass">
	<div class="labletext">登录Token:</div>
<input class="inputrow" type="text" id="usertoken" name="usertoken" value=""></input>
</div>

<div class="rowclass">
	<div class="labletext">站点ID:</div>
<input class="inputrow" type="text" id="siteid" name="siteid" value=""></input>
</div>

<div class="rowclass">
	<div class="subbutton">
<button   type="button" id="submit-getusertree" name="submit-getusertree" >提交</button>
</div>
</div>	
</br>
<div class="responsetext" id="usertree_responseid">
返回数据区：
</div>

<script	type="text/javascript">  
 $("#submit-login").click(function(){
		 version	=	$("#version").val();
		 merid  = $("#merid").val();
		 securitycode  = $("#securitycode").val();
     apiname  = $("#apiname").val();
     expiretime = $("#expiretime").val();
     username = $("#username").val();
     password = $("#password").val();
		 $.ajax({
						url: "ajax_data.php",
						type:	'post',
						data:{"version":version,"expiretime":expiretime,"apiname":apiname,"merid":merid,"securitycode":securitycode,"username":username,"password":password,"act":"userlogin","rnd": Math.random()},
						dataType:	'json',
						timeout: 1000,
						success: function	(data, status) {
               $("#responseid").html(JSON.stringify( data ));
						},
						fail:	function (err, status) {

							console.log(err)
						}
					})

		});

 $("#submit-common").click(function(){
		 version	=	$("#com_version").val();
		 merid  = $("#com_merid").val();
		 securitycode  = $("#com_securitycode").val();
     apiname  = $("#com_apiname").val();

		 $.ajax({
						url: "ajax_data.php",
						type:	'post',
						data:{"version":version,"apiname":apiname,"merid":merid,"securitycode":securitycode,"rnd": Math.random()},
						dataType:	'json',
						timeout: 1000,
						success: function	(data, status) {
               $("#com_responseid").html(JSON.stringify( data ));
						},
						fail:	function (err, status) {

							console.log(err)
						}
					})

		});


 $("#submit-getusertree").click(function(){
		 version	=	$("#user_version").val();
		 merid  = $("#user_merid").val();
		 securitycode  = $("#user_securitycode").val();
     apiname  = $("#user_apiname").val();
     siteid  = $("#siteid").val();
     usertoken  = $("#usertoken").val();
     
		 $.ajax({
						url: "ajax_data.php",
						type:	'post',
						data:{"version":version,"apiname":apiname,"siteid":siteid,"usertoken":usertoken,"merid":merid,"securitycode":securitycode,"rnd": Math.random()},
						dataType:	'json',
						timeout: 1000,
						success: function	(data, status) {
               $("#usertree_responseid").html(JSON.stringify( data ));
						},
						fail:	function (err, status) {
						 
							console.log(err)
						}
					})

		});				
</script>	

</body>
</html>