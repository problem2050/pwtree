<?php
require_once($_SERVER["Root_Path"]."/inc/bootstrap.php");
require_once($_SERVER["Root_Path"]."/inc/function.php");

$username=isset($_REQUEST['username'])?$_REQUEST['username']:'';
$truename=isset($_REQUEST['truename'])?$_REQUEST['truename']:'';
$password=isset($_REQUEST['password'])?$_REQUEST['password']:'';
$email=isset($_REQUEST['email'])?$_REQUEST['email']:'';
$phone=isset($_REQUEST['phone'])?$_REQUEST['phone']:'';
$dep=isset($_REQUEST['dep'])?$_REQUEST['dep']:'';


$act=isset($_REQUEST['act'])?$_REQUEST['act']:'';

if($act=='subbb'){
//var_dump($merid,$username,$truename,$password,$email,$phone,$dep);
$res = User_Userinfo::insertUserinfo($merid,$username,$truename,$password,$email,$phone,$dep);

}

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

<!-- END HEAD	-->

		<body	class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
				<!-- BEGIN HEADER	-->
				<div class="page-header	navbar navbar-fixed-top">
						<!-- BEGIN HEADER	INNER	-->
						<div class="page-header-inner	">
								<!-- BEGIN LOGO	-->
								<div class="page-logo">
										<a href="index.html">
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
				<br>
                    <!-- END PAGE TITLE-->
                    <!-- END PAGE HEADER-->
        
                            <!-- BEGIN SAMPLE TABLE PORTLET-->
                             <div class="portlet light bordered" style="width:60%">
                                
                                <div class="portlet-body form" >
                                    <form role="form" method="post" action="?act=subbb">
                                        <div class="form-body">
										  <div class="form-group">
                                                <label>用户名:</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-user-plus"></i>
                                                    </span>
                                                    <input type="text" class="form-control" placeholder="请输入用户名" name="username" value="<?=isset($result['f_username'])?$result['f_username']:''?>" > </div>
                                            </div>
										   
										   <div class="form-group">
                                                <label>真实姓名:</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-user"></i>
                                                    </span>
                                                    <input type="text" class="form-control" placeholder="请输入真实户名" name="truename" value="<?=isset($result['f_truename'])?$result['f_truename']:''?>"> </div>
                                            </div>
										 <div class="form-group">
                                                <label>密码:</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-user font-red"></i>
                                                    </span>
                                                    <input type="password" class="form-control" placeholder="请输入8-16位密码" name="password" value="<?=isset($result['f_userpwd'])?$result['f_userpwd']:''?>" > </div>
                                            </div>
																				 <div class="form-group">
                                                <label>所属部门:</label>
                                                <select class="form-control" name="dep">
																								<?php
																							
																						if($deptrs['LIST']){
                                                foreach($deptrs['LIST'] as $k=>$v){
                                                	 
                                                	echo "<option value=\"".$v['f_id']."\">".$v['f_department']."</option>";
                                                }
                                              }
                                                ?>
																									</select>
                                         </div>	
                             			 <div class="form-group">
                                         <label>所属角色:</label>
                                           <select class="form-control" name="dep">
												<option value="100">研发部</option>
												<option value="101">财务部</option>
												<option value="102">产品部</option>
												<option value="103">设计部</option>
												<option value="104">运营部</option>
										   </select>
                                         </div>	            
                                  <div class="form-group">
                                                <label>是否禁用</label>
                                                <div class="mt-radio-inline">
                                                    <label class="mt-radio">
                                                        <input type="radio" name="isvalid" id="optionsRadios4" value="0"  checked >有效
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-radio">
                                                        <input type="radio" name="isvalid" id="optionsRadios5" value="1" >禁用
                                                        <span></span>
                                                    </label>                                                   
                                                </div>
                                            </div>                       
										              <div class="form-group">
                                                <label>手机号码:</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-phone"></i>
                                                    </span>
                                                    <input type="text" class="form-control" placeholder="请输入有效的手机号码" name="phone" value="<?=isset($result['f_mobile'])?$result['f_mobile']:''?>" > </div>
                                            </div>
											
                                            <div class="form-group">
                                                <label>邮箱地址:</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-envelope"></i>
                                                    </span>
                                                    <input type="text" class="form-control" placeholder="请输入有效的EMAIL地址" name="email" value="<?=isset($result['f_email'])?$result['f_email']:''?>" > </div>
                                            </div>
											
                                             
                                           
                                         
                           
                                        </div>
                                        <div class="form-actions">
                                            <button type="submit" class="btn blue">提交</button>
                                            <button type="button" class="btn default">取消</button>
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