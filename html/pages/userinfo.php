<?php
require_once($_SERVER["Root_Path"]."/inc/bootstrap.php");
require_once($_SERVER["Root_Path"]."/inc/function.php");
require_once($_SERVER["Root_Path"]."/html/pages/public/checkLogin.php");

$page = 1;
$pagesize = 8;


$username = '';
$page= isset($_REQUEST['page'])?$_REQUEST['page']:1;

$act= isset($_REQUEST['act'])?$_REQUEST['act']:'';
$fid= isset($_REQUEST['fid'])?$_REQUEST['fid']:'';
$username= isset($_REQUEST['username'])?$_REQUEST['username']:'';
$depid= isset($_REQUEST['depid'])?$_REQUEST['depid']:'';

if($act=='del' && $fid!=''){
	
	$res = User_Userinfo::delUserinfo($merid,$fid);

}
//var_dump($res);

$res = User_Userinfo::getUserinfo($merid,$username,$page,$pagesize,$depid);

$deptrs = User_Userinfo::getDepmlist($merid,$depname='',1,1000);
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        <title>Pwtree | 用户列表</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="" width=device-width, initial-scale=1" name="viewport" />
        <meta content="Pwtree管理平台,为您是提供一个简单的目录树管理编辑功能，可以帮您管理用户的权限和需要的树型结构数据，通过API可以轻松获取目录树结构数据" name="description" />
        <meta content="Pwtree,Tree,目录树，树，权限管理树，TreeNode,Node,管理后台,PowerTree" name="Keywords" />
        <meta content="pwtree" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="../assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="../assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="../assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="../assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> </head>
    <!-- END HEAD -->

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
        <!-- BEGIN HEADER -->
        <div class="page-header navbar navbar-fixed-top">
            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner ">
                <!-- BEGIN LOGO -->
                <div class="page-logo">
                    <a href="index.html">
                        <img src="../assets/layouts/layout/img/logo.png" alt="logo" class="logo-default" /> </a>
                    <div class="menu-toggler sidebar-toggler">
                        <span></span>
                    </div>
                </div>
                <!-- END LOGO -->
                <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                    <span></span>
                </a>
                <!-- END RESPONSIVE MENU TOGGLER -->
                <!-- BEGIN TOP NAVIGATION MENU -->
                <?=include 'top_navigation_menu.php' ?>
                <!-- END TOP NAVIGATION MENU -->
            </div>
            <!-- END HEADER INNER -->
        </div>
        <!-- END HEADER -->
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
           <?=include 'sidebar_left.php' ?>
            <!-- BEGIN CONTENT -->
         <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEADER-->
                    <!-- BEGIN THEME PANEL -->
                   
                    <!-- END THEME PANEL -->
                    <!-- BEGIN PAGE BAR -->
					
                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                 <span>用户与角色管理 </span>
                                <i class="fa fa-circle"></i>
                            </li>
                            <li>
                                <span>用户列表</span>
                            </li>
                        </ul>
                        <div class="page-toolbar">
                             
                        </div>
                    </div>
                    <!-- END PAGE BAR -->
                    <!-- BEGIN PAGE TITLE-->
					
                    
                    <!-- END PAGE TITLE-->
                    <!-- END PAGE HEADER-->
					<br>
          <div class="portlet light bordered"  >
                            <!-- BEGIN SAMPLE TABLE PORTLET-->
							 <div class="portlet-title">                                    
                                    <div class="actions">									                                                               
                                         <a class="btn red btn-inline sbold" data-toggle="modal" href="" id="deleteuserid">删除用户 </a>
                                         <a class="btn blue btn-inline sbold" data-toggle="modal" href="" id="adduserlink">添加用户 </a>
                                    </div>
                           </div>
								
                            <div class="portlet">                               
                                <div class="portlet-body">                                								
                                    <div class="table-scrollable">
                                        <table class="table table-striped table-bordered table-advance table-hover">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <i class="fa "></i>ID</th>
                                                    <th >
                                                        <i class="fa "></i>用户名</th>
                                                    <th>
                                                        <i class="fa"></i>真实姓名</th>
                                                    <th>
													<i class="fa"></i>添加时间</th>
													 <th>
													<i class="fa"></i>手机</th>
													 <th>
													<i class="fa"></i>邮箱</th>
												<th>
													<i class="fa"></i>部门</th>	
												<th>
													<i class="fa"></i>状态</th>	
												<th>
													<i class="fa"></i>最后登录时间</th>														 
												 <th>
													<i class="fa"></i>最后登录IP</th>		
												 <th> 		
													<i class="fa"></i>操作</th>	
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php
											//var_dump($res);
											if($res['LIST']){
												foreach($res['LIST'] as $k=>$v){
													$groupname=array();
												?>
                         <tr>
						   <td ><input type="checkbox" name="uid" value="<?=$v['id']?>" /> </td>
												    
                            <td>
                             <?=$v['username']?>
                            </td>
                            <td ><?=$v['truename']?></td>
                            <td><?=$v['date']?> </td>
                            <td><?=$v['mobile']?></td>
													<td><?=$v['email']?></td>
													<td><?=$v['department']?></td>
													
													<td><?=($v['valid']==0)?"有效":"<span style=\"color:blue\">禁用</span>"?></td>
													<td><?=$v['lastdate']?></td>
													<td><?=$v['lastip']?></td>
													<td><a href="edituserinfo.php?fid=<?=$v['id']?>">修改</a>&nbsp;&nbsp; [<a href="view_userinfo.php?fid=<?=$v['id']?>">查看/授权</a>]</td>
                           </tr>
                                                
                          <?php
												}
											}
										?>
                                                
                                            </tbody>
                                        </table>
										
                                    </div>
                                </div>
                            </div>
                            <!-- END SAMPLE TABLE PORTLET-->
							 
							<ul class="pagination" style="visibility: visible;">
							<?php
							 
							if($res['CNT']>0){
								echo getPageHtml($res['CNT'],$page,$pagesize);
							}
							?>
							</ul>
						</div>
                        </div>
                    </div>
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
			
            <!-- BEGIN QUICK SIDEBAR -->
           
			
        </div>
        <!-- END CONTAINER -->
		 <!--BEGIN MODAL-DIALOG -->
		  
           <div id="useraddform" class="modal fade" tabindex="-1" data-width="400">
               <div class="modal-dialog">
                     <div class="modal-content">
                       <div class="col-md-12">
					   
						<div class="portlet light bordered" >   
						  <div class="modal-header">
                                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                     <h4 class="modal-title">添加新用户</h4>
                           </div>						
                                <div class="form-horizontal" >
                                    <div class="form-body">
									<br>
										<div class="form-group">
                                               <label class="control-label col-md-3">用户名：                                                       
                                                 </label>
                                            <div class="col-md-6">											
                                                  <input type="text"  id="add_username" data-required="1" class="form-control " /> 
			                                </div>
									   </div>
										<div class="form-group">
                                               <label class="control-label col-md-3">真实姓名：                                                       
                                                 </label>
                                            <div class="col-md-6">
                                                  <input type="text"  id="add_truename" data-required="1" class="form-control" /> 
			                                </div>
									   </div>
										<div class="form-group">
                                               <label class="control-label col-md-3">密码：                                                       
                                                 </label>
                                            <div class="col-md-6">
                                                  <input type="password"  id="add_password" data-required="1" class="form-control" /> 
			                                </div>
									   </div>
										<div class="form-group">
                                               <label class="control-label col-md-3">邮箱地址：                                                       
                                                 </label>
                                            <div class="col-md-6">
                                                  <input type="text"  id="add_email" data-required="1" class="form-control" /> 
			                                </div>
									   </div>									   
										<div class="form-group">
                                               <label class="control-label col-md-3">手机号：                                                       
                                                 </label>
                                            <div class="col-md-6">
                                                  <input type="text"  id="add_phone" data-required="1" class="form-control" /> 
			                                </div>
									   </div>
										<div class="form-group">
                                               <label class="control-label col-md-3">是否有效：                                                       
                                                 </label>
                                                  <div class="col-md-6">
                                                 <div class="mt-radio-inline">
                                                    <label class="mt-radio">
                                                        <input type="radio" name="add_isvalid" id="optionsRadios4" value="0"  checked >有效
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-radio">
                                                        <input type="radio" name="add_isvalid" id="optionsRadios5" value="1" >禁用
                                                        <span></span>
                                                    </label>                                                   
                                                </div>
			                                </div>
									   </div>									   
										<div class="form-group">
                                               <label class="control-label col-md-3">所属部门：                                                       
                                                 </label>
                                            <div class="col-md-6">
                                             <select class="form-control" name="add_dep">
												 <?php
																							
											if($deptrs['LIST']){
                                                foreach($deptrs['LIST'] as $k=>$v){
                                                	 
                                                	echo "<option value=\"".$v['id']."\">".$v['department']."</option>";
                                                }
                                              }
                                                ?>
											 </select>
			                                </div>
									   </div>
									   
                                          <div class="modal-footer">
										      <label id="addresult"></label>
                                              <button type="button" data-dismiss="modal" class="btn dark btn-outline">关闭</button>
                                              <button type="button" class="btn red"  id="addusersubmit">添加</button>
										 	 
                                          </div>
										  
                                       </div>
									   
									 </div>	
								   </div>
                                </div>
								
                             </div>
						</div>
				</div>		
			              <!--END MODAL-DIALOG -->
						  
        <!-- BEGIN FOOTER -->
        <?=include 'page_footer.php' ?>
        <!-- END FOOTER -->
        <!--[if lt IE 9]>
<script src="../assets/global/plugins/respond.min.js"></script>
<script src="../assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="../assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
		<script	src="../assets/global/plugins/bootbox/bootbox.min.js"	type="text/javascript"></script>						
        <!-- END CORE PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="../assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="../assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
        <script src="../assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
        <script src="../assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
	    <script src="../assets/pages/scripts/ui-bootbox.min.js" type="text/javascript"></script>		
		
        <!-- END THEME LAYOUT SCRIPTS -->
<script type="text/javascript">		
$("#deleteuserid").click(function(){
	
    var	uidstr = "";
	 $("input[name='uid']").each(function(){
				 if($(this).is(":checked"))
				 {
				   uidstr +=	","	+	$(this).val();
				  }
			 });
			 
	 if(uidstr=='')return	;
	
 	
	bootbox.confirm({   
    message: "<span style='color:red'>【删除用户】，用户下面的权限和所属角色将全部清空。<br><br><br><br>&nbsp;&nbsp;确定要删除??<span>",
    buttons: {
        cancel: {
            label: 'Yes',
            className: 'btn-success'
        },
        confirm: {
             label: 'No',
            className: 'btn-danger'
        }
    },
    callback: function (result) {		
		if(result==false){		
			 
	  $.ajax({
				  url: "ajax_data/userinfo_data.php",
				  type: 'post',					  
				  data:{"userid":uidstr,"act":"killuserid"},
				  dataType: 'json',
				  timeout: 1000,
				  success: function (data, status) {					   
				 if (data.STATE==true) {
                     location.href="userinfo.php?page=<?=$page?>";
				   }else{					   	 
					alert(data.MSG);					 
				   }
				  },
				  fail: function (err, status) {
					console.log(err)
				  }
				}) 
		   }
		 console.log('This was logged in the callback: ' + result);
	   }
	});
	
});	

$("#adduserlink").click(function(){
	 $("#useraddform").modal('show');
});

$("#addusersubmit").click(function(){
	 username = $("#add_username").val();
	 truename =$("#add_truename").val();
	 password =$("#add_password").val();
	 email=$("#add_email").val();
	 phone = $("#add_phone").val();
	 dep = $("#add_dep").val();
	 
	 $.ajax({
			 url: "ajax_data/userinfo_data.php",
			 type: 'post',					  
			 data:{"username":username,"truename":truename,"password":password,"email":email,"phone":phone,"dep":dep,"act":"adduserid"},
			 dataType: 'json',
			 timeout: 1000,
			 success: function (data, status) {					   
				 if (data.STATE==true) {
                    $("#addresult").html("添加成功!");					 	  
				   }else{		
                     $("#addresult").html("添加失败!");					   
					//alert(data.MSG);					 
				   }
				  },
				  fail: function (err, status) {
					console.log(err)
				  }
		 })
				
});

</script>		
    </body>
</html>