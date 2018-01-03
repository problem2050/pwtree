<?php
require_once($_SERVER["Root_Path"]."/inc/bootstrap.php");
require_once($_SERVER["Root_Path"]."/inc/function.php");
require_once($_SERVER["Root_Path"]."/html/pages/public/checkLogin.php");

$username=$MER_USER_INFO['username'];
$fid = $MER_USER_INFO['fid'];
$securitycode = $MER_USER_INFO['securitycode'];

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
        <title>Pwtree | API安全码</title>
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

<!-- END HEAD	-->

		<body	class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
				<!-- BEGIN HEADER	-->
				<div class="page-header	navbar navbar-fixed-top">
						<!-- BEGIN HEADER	INNER	-->
						<div class="page-header-inner	">
								<!-- BEGIN LOGO	-->
								<div class="page-logo">
										<a href="/index.html">
												<img src="../assets/layouts/layout/img/logo.png" alt="logo"	class="logo-default" />	</a>
										<div class="menu-toggler sidebar-toggler">
												<span></span>
										</div>
								</div>
								<!-- END LOGO	-->
								<!-- BEGIN RESPONSIVE	MENU TOGGLER -->
								<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse"	data-target=".navbar-collapse">
										<span></span>
								</a>
								<!-- END RESPONSIVE	MENU TOGGLER -->
								<!-- BEGIN TOP NAVIGATION	MENU -->
								<?=include 'top_navigation_menu.php' ?>
								<!-- END TOP NAVIGATION	MENU -->
						</div>
						<!-- END HEADER	INNER	-->
				</div>
				<!-- END HEADER	-->
				<!-- BEGIN HEADER	&	CONTENT	DIVIDER	-->
				<div class="clearfix"> </div>
				<!-- END HEADER	&	CONTENT	DIVIDER	-->
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
                                 <span>API安全码 </span>
                                <i class="fa fa-circle"></i>
                            </li>
                            <li>
                                <span>安全码管理</span>
                            </li>
                        </ul>
                        <div class="page-toolbar">
                             
                        </div>
                    </div>
                    <!-- END PAGE BAR -->
                    <!-- BEGIN PAGE TITLE-->
				<br>
                    <!-- END PAGE TITLE-->
                    <!-- END PAGE HEADER-->
        
                            <!-- BEGIN SAMPLE TABLE PORTLET-->
                             <div class="portlet light bordered" style="width:70%">                                
                                <div class="portlet-body form" >
                                    <form role="form" method="post" action="?act=subbb">
                                        <div class="form-body">
										  <div class="form-group">
                                                <label>API安全码:</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-lock"></i>
                                                    </span>
                                                    <input type="text" class="form-control" readonly style="width:50%" name="securitycode" id="securitycode" value="<?=$securitycode?>" >
                                                    </div>                                                    
                                      </div>										   										   									 
                                        </div>
                                        <div class="form-actions">
                                            <button type="button" class="btn blue" id="submit-securitycode">提交</button>
                                             <button type="button" class="btn red" id="get-new-securitycode">重新生成安全码</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- END SAMPLE TABLE PORTLET-->
							 
                        </div>
                    </div>
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
            <!-- BEGIN QUICK SIDEBAR -->
           
			
        </div>
        <!-- END CONTAINER -->
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
    </body>
    
<script	type="text/javascript">   
 	
  $("#submit-securitycode").click(function(){
		 securitycode	=	$("#securitycode").val();
		 
		 fid = "<?=$fid?>";
		 username = "<?=$username?>";
		 
		 $.ajax({
						url: "ajax_data/login.php",
						type:	'post',
						data:{"fid":fid,"username":username,"securitycode":securitycode,"act":"modifysecuritycode","rnd": Math.random()},
						dataType:	'json',
						timeout: 1000,
						success: function	(data, status) {
												if(data.STATE==1){
							bootbox.alert({message:	"修改安全码成功!",
											size:	'small'});
							 
						}else{
							bootbox.alert({message:	"修改失败!<br>"+data.MSG,
											size:	'small'});
						 }
						},
						fail:	function (err, status) {
							bootbox.alert({message:	"修改失败!",
										 size: 'small'});
							console.log(err)
						}
					})

		});
	
	 $("#get-new-securitycode").click(function(){
		 
	 $.ajax({
						url: "ajax_data/login.php",
						type:	'post',
						data:{"act":"getnewsecuritycode","rnd": Math.random()},
						dataType:	'json',
						timeout: 1000,
						success: function	(data, status) {
						 if(data.STATE==1 && data.DATA!=""){
							 $("#securitycode").val(data.DATA);
							 
						}else{
							bootbox.alert({message:	"获取安全码失败!<br>"+data.MSG,
											size:	'small'});
						 }
						},
						fail:	function (err, status) {
							bootbox.alert({message:	"请求失败!",
										 size: 'small'});
							console.log(err)
						}
					})

		});	
</script>		

</html>