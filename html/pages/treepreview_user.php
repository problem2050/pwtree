<?php
require_once($_SERVER["Root_Path"]."/inc/bootstrap.php");
require_once($_SERVER["Root_Path"]."/inc/function.php");
require_once($_SERVER["Root_Path"]."/html/pages/public/checkLogin.php");

$page = 1;
$pagesize = 10;

//echo getBuildTree3($siteid='10000',$merid,$userid='4');
//exit;
//$rtt = Pwtree_Nodes::getPermissionTreenavList($siteid='10000',$merid,$userid='4');
//var_dump($rtt);exit;

$page= isset($_REQUEST['page'])?$_REQUEST['page']:1;

$act= isset($_REQUEST['act'])?$_REQUEST['act']:'';
$userid= isset($_REQUEST['userid'])?$_REQUEST['userid']:'';
$username= isset($_REQUEST['username'])?$_REQUEST['username']:'';
$siteid= isset($_REQUEST['siteid'])?$_REQUEST['siteid']:'';

//var_dump($res);


//var_dump($res);
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
        <title>Pwtree | 用户权限预览</title>
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
         <link href="../assets/global/plugins/jstree/dist/themes/default/style.min.css" rel="stylesheet" type="text/css" />
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
<script type="text/javascript">
 	
 </script>
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
                <?=include 'sidebar_left.php' ?>
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content" >
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
                                <span>用户授权预览</span>
                            </li>
                        </ul>
                        <div class="page-toolbar">
                             
                        </div>
                    </div>
                    <!-- END PAGE BAR -->
                    <!-- BEGIN PAGE TITLE-->
					      <br>
					    <div class="page-content-inner">
					    	<div class="row">
					    
              <div class="col-md-8">
              <div class="portlet light bordered" >
                <div class="portlet-title"> 								 
								<div class="caption">								
               <select class="form-control" id="site_list" onchange="droplistChange()">
									<?php
									 $site_rs = Pwtree_Nodes::getSites($merid);									 
									 if($site_rs){
                                              foreach($site_rs as $k=>$v){  
                                                if($siteid==$v['id']){													
                                                echo "<option value=\"".$v['id']."\" selected>".$v['sitename']."</option>";
												}else{
													echo "<option value=\"".$v['id']."\" >".$v['sitename']."</option>";
												}
                                         }
                                      }
                                                ?>
									</select>  
									
								</div>	
								
                                    <div class="actions">
                                         <input type="hidden" id="treeuserid" value="<?=$userid?>" />                                  
                                    </div>
                                </div>
                                
                    <!-- END PAGE TITLE-->
                    <!-- END PAGE HEADER-->
        
                            <!-- BEGIN SAMPLE TABLE PORTLET-->                   


                           <div class="portlet-body">
                             <div id="tree_1111" class="tree-demo">
                           </div>
                             </div>
                            <!-- END SAMPLE TABLE PORTLET-->
						 
                        </div>
                      
                      </div>
                       <!-- END SAMPLE  COL-->
                       <div class="col-md-4">
                       
													<div class="portlet light bordered" >                                
                                <div class="form-horizontal" >
                                    <div class="form-body">									                     
                                         <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th> # </th>
                                                            <th> User Name </th>
                                                            <th> True Name </th>                                                           
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                         <?php
                                                         $res = User_Userinfo::getUserinfo($merid,$username,$page=1,$pagesize=1000);
                                                         //var_dump($res);
                                                         if($res['LIST']){
                                                         		foreach($res['LIST'] as $k=>$v){
                                                         			echo "<tr>";
                                                         			if($userid==$v['id']){
                                                         			   echo "<td><input type='radio'  class='icheck' name='userid' value='".$v['id']."' checked></td>";
                                                         			}else{
                                                         				 echo "<td><input type='radio'  class='icheck' name='userid' value='".$v['id']."'></td>";
                                                         			}
                                                         			echo "<td>".$v['username']."</td>";
                                                         			echo "<td>".$v['truename']."</td>";
                                                         			echo "</tr>";
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
                    </div>
                      
                      
                    </div>
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->         
           
           <!--BEGIN MODAL-DIALOG -->           
           
		 <!--END MODAL-DIALOG -->
        
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
        <script src="../assets/global/plugins/jstree/dist/jstree.min.js" type="text/javascript"></script>
		<script src="../assets/global/plugins/bootbox/bootbox.min.js" type="text/javascript"></script>
        <script src="../assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="../assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
        <script src="../assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <script src="../assets/pages/scripts/ui-tree.min.js" type="text/javascript"></script>
		 <script src="../assets/pages/scripts/ui-bootbox.min.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->
        
        
<script type="text/javascript">

$(function() {
	userid = $("#treeuserid").val();
	$('#tree_1111').jstree({
	'core' : {
			'check_callback': true,
			"data" : function (obj, callback){
							$.ajax({
								url : "ajax_data/tree_data.php?siteid="+$("#site_list").val()+"&treetype=usertree&userid="+$("#treeuserid").val()+"&rnd=" + Math.random(),
								dataType : "json",
								type : "POST",
								success : function(data) {
									//Console.info(data);
									if(data) {
										callback.call(this, data);
									}else{
										$("#tree_1111").html("暂无数据！");
									}
								}
							});
					}
				},
				//"plugins" : [ "checkbox" ]
			}).on("changed.jstree", function(event, data) {
			 
			var inst = data.instance;		
												 			  
			var selectedNode = inst.get_node(data.selected);
			console.log(data.selected);
			 
			
			});
		});


$(":radio").change(function () {
	
    if($(this).is(':checked')){
    	 console.info( $(this).val());
		 $("#treeuserid").val($(this).val());
    	 //$(this).parent().parent().addClass("warning");
    }else{
        //$(this).parent().parent().removeClass("warning");
    }
	
	droplistChange();
	
});	

function droplistChange(selectid=''){
	var tree1111 = $.jstree.reference("#tree_1111");
   tree1111.refresh();
  
  // tree1111.select_node(selectid);
}	

$("#site_list").change(function(){
	 location.href="treepreview_user.php?siteid="+$("#site_list").val()+"&userid=<?=$userid?>"
	});
</script>
                        
    </body>
</html>

