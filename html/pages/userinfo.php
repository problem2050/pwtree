<?php
require_once($_SERVER["Root_Path"]."/inc/bootstrap.php");
require_once($_SERVER["Root_Path"]."/inc/function.php");


$page = 1;
$pagesize = 10;


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
        <title>Metronic | Basic Datatables</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
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
         
                            <!-- BEGIN SAMPLE TABLE PORTLET-->
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
													<i class="fa"></i>角色</th>				
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
												    <td ><?=$v['f_id']?></td>
                            <td>
                             <?=$v['f_username']?>
                            </td>
                            <td ><?=$v['f_truename']?></td>
                            <td><?=$v['f_date']?> </td>
                            <td><?=$v['f_mobile']?></td>
													<td><?=$v['f_email']?></td>
													<td><?=$v['f_department']?></td>
													<td><?=(isset($groupname[0]['groupname'])?$groupname[0]['groupname']:'--')?></td>
													<td><?=($v['f_valid']==0)?"有效":"<span style=\"color:blue\">禁用</span>"?></td>
													<td><?=$v['f_lastdate']?></td>
													<td><?=$v['f_lastip']?></td>
													<td><a href="edituserinfo.php?fid=<?=$v['f_id']?>">修改</a>&nbsp;&nbsp;<a href="userinfo.php?act=del&fid=<?=$v['f_id']?>&page=<?=$page?>">删除</a> <a href="view_userinfo.php?fid=<?=$v['f_id']?>">查看</a></td>
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
        <!-- END CORE PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="../assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="../assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
        <script src="../assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
        <script src="../assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->
    </body>
</html>