<?php
require_once($_SERVER["Root_Path"]."/inc/bootstrap.php");
require_once($_SERVER["Root_Path"]."/inc/function.php");
require_once($_SERVER["Root_Path"]."/html/pages/public/checkLogin.php");

$username=isset($_REQUEST['username'])?$_REQUEST['username']:'';
$truename=isset($_REQUEST['truename'])?$_REQUEST['truename']:'';
$password=isset($_REQUEST['password'])?$_REQUEST['password']:'';
$email=isset($_REQUEST['email'])?$_REQUEST['email']:'';
$phone=isset($_REQUEST['phone'])?$_REQUEST['phone']:'';
$dep=isset($_REQUEST['dep'])?$_REQUEST['dep']:'';
$isvalid = isset($_REQUEST['isvalid'])?$_REQUEST['isvalid']:'';

$fid=isset($_REQUEST['fid'])?$_REQUEST['fid']:'';
$act=isset($_REQUEST['act'])?$_REQUEST['act']:'';

$result = '';

if($act=='editinfo'){
  $res = User_Userinfo::updateUserinfo($fid,$merid,$username,$truename,$password,$email,$phone,$dep,$isvalid);
}

$result = User_Userinfo::getUserinfoOne($fid,$merid);


$deptrs = User_Userinfo::getDepmlist($merid,$depname='',1,1000);
//var_dump($deptrs);
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
        <title>Pwtree | 编辑用户信息</title>
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
                    <a href="/index.html">
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
            <!-- BEGIN SIDEBAR -->
            <div class="page-sidebar-wrapper">
                <!-- BEGIN SIDEBAR -->
                <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                <div class="page-sidebar navbar-collapse collapse">
                    <!-- BEGIN SIDEBAR MENU -->
                    <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                    <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                    <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                    <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                    <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                    <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                        <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
                        <li class="sidebar-toggler-wrapper hide">
                            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                            <div class="sidebar-toggler">
                                <span></span>
                            </div>
                            <!-- END SIDEBAR TOGGLER BUTTON -->
                        </li>
                        <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
                     
                        <li class="nav-item start ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-home"></i>
                                <span class="title">目录树管理</span>
                                <span class="arrow open"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item start ">
                                    <a href="#" class="nav-link ">
                                        <i class="icon-bar-chart"></i>
                                        <span class="title">添加新站点</span>
                                    </a>
                                </li>
                                <li class="nav-item start ">
                                    <a href="#" class="nav-link ">
                                        <i class="icon-bulb"></i>
                                        <span class="title">添加目录树</span>                                        
                                    </a>
                                </li>
                                <li class="nav-item start ">
                                    <a href="permission.html" class="nav-link ">
                                        <i class="icon-graph"></i>
                                        <span class="title">添加权限ID</span>                                        
                                    </a>
                                </li>
                            </ul>
                        </li>                                                           
                <li class="nav-item active open ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-user"></i>
                                <span class="title">用户与角色管理</span>
								<span class="selected"></span>
                                <span class="arrow open"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item  active open">
                                    <a href="#" class="nav-link ">
                                        <i class="icon-bar-chart"></i>
                                        <span class="title">添加新用户</span>
                                    </a>
                                </li>
							  
							  <li class="nav-item  ">
                                    <a href="userinfo.php" class="nav-link ">
                                        <i class="icon-bar-chart"></i>
                                        <span class="title">用户列表</span>
                                    </a>
                                </li>
								
                                <li class="nav-item  ">
                                    <a href="#" class="nav-link ">
                                        <i class="icon-bulb"></i>
                                        <span class="title">角色管理</span>                                        
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="#" class="nav-link ">
                                        <i class="icon-graph"></i>
                                        <span class="title">修改商户信息</span>                                        
                                    </a>
                                </li>
                            </ul>
                        </li>
						
                    </ul>
                    
                    <!-- END SIDEBAR MENU -->
                </div>
                <!-- END SIDEBAR -->
            </div>
            <!-- END SIDEBAR -->
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
					
                    <h3 class="page-title"> 新增用户
                        <small></small>
                    </h3>
                    <!-- END PAGE TITLE-->
                    <!-- END PAGE HEADER-->
        
                            <!-- BEGIN SAMPLE TABLE PORTLET-->
                             <div class="portlet light bordered" style="width:60%">
                                
                                <div class="portlet-body form" >
                                    <form role="form" method="post" action="?act=editinfo&fid=<?=$fid?>">
                                        <div class="form-body">
										  <div class="form-group">
                                                <label>用户名:</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-user-plus"></i>
                                                    </span>
                                                    <input type="text" class="form-control" placeholder="请输入用户名" name="username" value="<?=isset($result['username'])?$result['username']:''?>" > </div>
                                            </div>
										   
										                    <div class="form-group">
                                                <label>真实姓名:</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-user"></i>
                                                    </span>
                                                    <input type="text" class="form-control" placeholder="请输入真实户名" name="truename" value="<?=isset($result['truename'])?$result['truename']:''?>"> </div>
                                            </div>
										                    <div class="form-group">
                                                <label>密码:</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-user font-red"></i>
                                                    </span>
                                                    <input type="password" class="form-control" placeholder="请输入8-16位密码" name="password" value="<?=isset($result['userpwd'])?$result['userpwd']:''?>" > </div>
                                            </div>
										                      <div class="form-group">
                                                <label>所属部门:</label>
                                                <select class="form-control" name="dep">
                                               <?php
																							
																						if($deptrs['LIST']){
                                                foreach($deptrs['LIST'] as $k=>$v){
                                                	
                                                	if($result['department']==$v['id']){ 
                                                		echo "<option value=\"".$v['id']."\" selected>".$v['department']."</option>";
                                                	}else{
                                                	echo "<option value=\"".$v['id']."\">".$v['department']."</option>";
                                                	 }
                                                }
                                              }
																					?>
																								</select>
                                            </div>	
                                            
                                       <div class="form-group">
                                                <label>是否禁用</label>
                                                <div class="mt-radio-inline">
                                                    <label class="mt-radio">
                                                        <input type="radio" name="isvalid" id="optionsRadios4" value="0" <?=($result['valid']==0)?"checked":""?> >有效
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-radio">
                                                        <input type="radio" name="isvalid" id="optionsRadios5" value="1" <?=($result['valid']==1)?"checked":""?> >禁用
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
                                                    <input type="text" class="form-control" placeholder="请输入有效的手机号码" name="phone" value="<?=isset($result['mobile'])?$result['mobile']:''?>" > </div>
                                            </div>
											
                                            <div class="form-group">
                                                <label>邮箱地址:</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-envelope"></i>
                                                    </span>
                                                    <input type="text" class="form-control" placeholder="请输入有效的EMAIL地址" name="email" value="<?=isset($result['email'])?$result['email']:''?>" > </div>
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