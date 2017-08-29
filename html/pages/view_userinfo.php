<?php
require_once($_SERVER["Root_Path"]."/inc/bootstrap.php");
require_once($_SERVER["Root_Path"]."/inc/function.php");

$fid=isset($_REQUEST['fid'])?$_REQUEST['fid']:'';
$result = User_Userinfo::getUserinfoOne($fid,$merid);

$deptrs = User_Userinfo::getDepmlist($merid,$depname='',1,1000);
var_dump($result);
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
                                <span>查看用户</span>
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
                        <div class="page-content-inner">  
                             	<!-- BEGIN ROW -->                              
                                <div class="row">
                                	<div class="col-md-5">
                                		<div class="form-horizontal">
                                       <div class="form-body">
										                     <div class="form-group">
                                                <label class="control-label col-md-3">用户名:</label>
                                                <div class="col-md-8">                                                    
                                                    <input type="text" disabled class="form-control"   value="<?=isset($result['username'])?$result['username']:''?>" > 
                                                 </div>
                                            </div>
										   
										                    <div class="form-group">
                                                <label class="control-label col-md-3">真实姓名:</label>
                                                <div class="col-md-8">                                                      
                                                    <input type="text" disabled class="form-control" placeholder="请输入真实户名" name="truename" value="<?=isset($result['truename'])?$result['truename']:''?>"> 
                                                 </div>
                                         </div>
                                         
										                    <div class="form-group">
                                                <label class="control-label col-md-3">密码:</label>
                                                 <div class="col-md-8">                                                     
                                                    <input type="password" disabled class="form-control" placeholder="请输入8-16位密码" name="password" value="<?=isset($result['userpwd'])?$result['userpwd']:''?>" >
                                                  </div>
                                          </div>
                                          
										                      <div class="form-group">
                                                <label class="control-label col-md-3">所属部门:</label>
                                                 <div class="col-md-8">                                                   
                                         <?php																							
																						if($deptrs['LIST']){
                                                foreach($deptrs['LIST'] as $k=>$v){
                                                	
                                                	if($result['department']==$v['f_id']){ 
                                                		 $department = $v['f_department'];
                                                	}else{
                                                	    $department = "--";
                                                	 }
                                                }
                                              }
																					?>
																				  <input class="form-control" disabled name="dep" value="<?=$department?>">
                                         </div>
                                       </div>
                                            
                                       <div class="form-group">
                                             <label class="control-label col-md-3">是否禁用: </label>
                                                <div class="col-md-8"> 
                                                	 <input class="form-control" disabled name="dep"  value="<?=($result['valid']==0)?"有效":"无效"?>" >
                                                </div>                                                 	
                                         </div>
                                                                 
										                <div class="form-group">
                                          <label class="control-label col-md-3">手机号码:</label>
                                             <div class="col-md-8">
                                                    <input type="text" disabled class="form-control"   name="phone" value="<?=isset($result['mobile'])?$result['mobile']:''?>" >
                                              </div>
                                     </div>											
                                      <div class="form-group">
                                               <label class="control-label col-md-3">邮箱地址:</label>
                                               <div class="col-md-8">
                                                    <input type="text" disabled class="form-control"  name="email" value="<?=isset($result['email'])?$result['email']:''?>" > 
                                               </div>                                            							                           
                                        </div>                                       
                                  </div>
                                </div>
                            </div>
                        <!-- END SAMPLE TABLE PORTLET-->
                        <div class="col-md-5">
                             <div class="form-horizontal">
                               <div class="form-body">
										            <div class="form-group">
                                   <table class="table table-hover" id ="usergrouplist">
                                     <thead>
                                     		<tr>
		                                     	<td>Site Name</td>
		                                     	<td>Site domain</td>
		                                     	<td>User Type</td>
		                                     	<td>Role Name</td>
		                                     	<td>View</td>
                                     		</tr>                                     	
                                     	</thead>	
                                     	
                                     <tbody>
                                      <?php
																      $site_rs = Pwtree_Nodes::getSites($merid);									 
									 								     if($site_rs){
                             				  	foreach($site_rs as $k=>$v){
                             				  		  $crs = User_Userinfo::checkUserinPemid($result['fid'],$v['id'],$merid);
                             				  		  $grs = User_Group::checkUserinPermissionGroup($merid,$v['id'],$result['fid']);
                             				  		  $link1 = '--';
                             				  		  $link2 = "--";
                             				  		  
                             				  		  if($crs==true)
                             				  		  {
                             				  		  	$link1 = "<a href=\"#\" >独立授权用户</a>";
                             				  		  }
                             				  		  if($grs==true){
                             				  		  	$link2 = "<a href=\"#\" >角色用户</a>";
                             				  		  }
                                            echo "<tr><td>".$v['sitename']."</td><td>".$v['sitedomain']."</td><td>$link1</td><td>$link2</td><td>view</td></tr>";
                                          }
                                        }
                                      ?>  
                                     </tbody>
                                   </table>
                                 </div>  										            
										          </div>
										        </div>
                        </div>
                        
                    </div>
                    <!-- END ROW -->
                        
                      </div>
                <!-- END CONTENT BODY -->            
            <!-- END CONTENT -->            
			   </div>
       </div>
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