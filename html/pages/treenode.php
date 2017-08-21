<?php
require_once($_SERVER["Root_Path"]."/inc/bootstrap.php");
require_once($_SERVER["Root_Path"]."/inc/function.php");


$page = 1;
$pagesize = 10;


$page= isset($_REQUEST['page'])?$_REQUEST['page']:1;

$act= isset($_REQUEST['act'])?$_REQUEST['act']:'';

//var_dump($res);
$res = User_Userinfo::getSiteslist($merid,$page,$pagesize);

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
                <div class="top-menu">
                    <ul class="nav navbar-nav pull-right">
                        <!-- BEGIN NOTIFICATION DROPDOWN -->
                         
                        <!-- END NOTIFICATION DROPDOWN -->
                        <!-- BEGIN INBOX DROPDOWN -->
                        
                        <!-- END INBOX DROPDOWN -->
                        
                        <!-- BEGIN USER LOGIN DROPDOWN -->
                        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                        <li class="dropdown dropdown-user">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <img alt="" class="img-circle" src="../assets/layouts/layout/img/avatar3_small.jpg" />
                                <span class="username username-hide-on-mobile"> Nick </span>
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-default">
                                <li>
                                    <a href="adduserinfo.php">
                                        <i class="icon-user"></i> My Profile </a>
                                </li>
                                <li>
                                    <a href="app_calendar.html">
                                        <i class="icon-calendar"></i> My Calendar </a>
                                </li>
                                <li>
                                    <a href="app_inbox.html">
                                        <i class="icon-envelope-open"></i> My Inbox
                                        <span class="badge badge-danger"> 3 </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="app_todo.html">
                                        <i class="icon-rocket"></i> My Tasks
                                        <span class="badge badge-success"> 7 </span>
                                    </a>
                                </li>
                                <li class="divider"> </li>
                                <li>
                                    <a href="page_user_lock_1.html">
                                        <i class="icon-lock"></i> Lock Screen </a>
                                </li>
                                <li>
                                    <a href="page_user_login_1.html">
                                        <i class="icon-key"></i> Log Out </a>
                                </li>
                            </ul>
                        </li>
                        <!-- END USER LOGIN DROPDOWN -->
                        <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                        <li class="dropdown dropdown-quick-sidebar-toggler">
                            <a href="javascript:;" class="dropdown-toggle">
                                <i class="icon-logout"></i>
                            </a>
                        </li>
                       
                    </ul>
                </div>
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
                                <li class="nav-item  ">
                                    <a href="adduserinfo.php" class="nav-link ">
                                        <i class="icon-bar-chart"></i>
                                        <span class="title">添加新用户</span>
                                    </a>
                                </li>
							  
							  <li class="nav-item active open ">
                                    <a href="#" class="nav-link ">
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
					      <br>
              <div class="col-md-6">
              <div class="portlet light bordered" style="width:100%">
                <div class="portlet-title"> 								 
								<div class="caption">								
               <select class="form-control" id="site_list" onchange="droplistChange()">
									<?php
									$site_rs = Pwtree_Nodes::getSites($merid);
									 
									 if($site_rs){
                             foreach($site_rs as $k=>$v){                                                	 
                                                echo "<option value=\"".$v['id']."\">".$v['sitename']."</option>";
                                          }
                                        }
                                                ?>
									</select>  
									
								</div>	
                                    <div class="actions">
                                                                           
                                         <button type="button" class="btn red" id="addlink">添加 </a>
                                    </div>
                                </div>
                                
                    <!-- END PAGE TITLE-->
                    <!-- END PAGE HEADER-->
        
                            <!-- BEGIN SAMPLE TABLE PORTLET-->
                            <?php

										//$res = getBuildTree2('1000012000');
										//echo $res;
										//exit;
										?>


                           <div class="portlet-body">
                             <div id="tree_1111" class="tree-demo">
                           </div>
                             </div>
                            <!-- END SAMPLE TABLE PORTLET-->
						 
                        </div>
                      
                      </div>
                       <!-- END SAMPLE  COL-->
                       <div class="col-md-6">
                       
						<div class="portlet light bordered" >                                
                                <div class="form-horizontal" >
                                    <div class="form-body">
										<div class="form-group">
                                                        <label class="control-label col-md-3">权限ID                                                        
                                                        </label>
                                                        <div class="col-md-8">
                                                           <input type="text" disabled id="show_pemid" data-required="1" class="form-control" /> 
			                                </div>
									   </div>
  										<div class="form-group">
                                                        <label class="control-label col-md-3">权限名称：                                                        
                                                        </label>
                                                        <div class="col-md-8">
                                                 <input type="text" id="show_pemname" data-required="1" class="form-control" /> 
			                                </div>
						              </div>
						                    <div class="form-group">
                                                        <label class="control-label col-md-3">权限描述：                                                        
                                                        </label>
                                                        <div class="col-md-8">
                                                 <input type="text" id="show_about" data-required="1" class="form-control" /> 
			                                      </div>
											</div>
							        <div class="form-group">
                                                        <label class="control-label col-md-3">分类：
                                                      
                                                        </label>
                                                        <div class="col-md-8">
                                                            <select class="form-control select2me" name="options2">
                                                                <option value="">Select...</option>
                                                                <option value="Option 1">Option 1</option>
                                                                <option value="Option 2">Option 2</option>
                                                                <option value="Option 3">Option 3</option>
                                                                <option value="Option 4">Option 4</option>
                                                            </select>
                                                        </div>
                                                    </div>
                             			                                      
                                   
                                        <div class="form-actions">
                                            <button type="submit" class="btn blue">保存</button>
                                            <button type="button" class="btn default">取消</button>
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
           <div id="pemaddform" class="modal fade" tabindex="-1" data-width="400">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h4 class="modal-title">添加新的权限ID</h4>
                                                </div>
                                                <div class="modal-body">
                                        <div class="form-group">
                                                <label>权限ID:</label>
                                                <div class="input-group ">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-user"></i>
                                                    </span>
                                                    <input type="text" class="form-control" placeholder="手工输入全数字的权限ID" id="pemid" value=""> </div>
                                                    
                                            </div>    
                                           <div class="form-group">
                                                <label>权限ID名称:</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-user"></i>
                                                    </span>
                                                    <input type="text" class="form-control" placeholder="权限名称" id="pemname" value=""> </div>
                                            </div>                                                                                     
                                           <div class="form-group">
                                                <label>权限ID描述:</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-user"></i>
                                                    </span>
                                                    <input type="text" class="form-control" placeholder="简单描述权限ID" id="pemabout" value=""> </div>
                                            </div> 
                                       <div class="form-group">
                                               <label>权限类别:</label>
                                        <select class="form-control" id="categorytype">
																					
										  </select>																					
				                                   <span id="addresult"></span>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" data-dismiss="modal" class="btn dark btn-outline">关闭</button>
                                                    <button type="button" class="btn red" id="addpemid">添加</button>													
													<input type="hidden" id="treenavid" value="" />
                                                </div>
                                            </div>
                                        </div>
                             </div>
                             
            
                                    
			              <!--END MODAL-DIALOG -->
        </div>
        <!-- END CONTAINER -->
        <!-- BEGIN FOOTER -->
        <div class="page-footer">
            <div class="page-footer-inner"> 2017 &copy; pwtree.
                <a href="http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes" title="Purchase Metronic just for 27$ and get lifetime updates for free" target="_blank">Purchase Metronic!</a>
            </div>
            <div class="scroll-to-top">
                <i class="icon-arrow-up"></i>
            </div>
        </div>
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
        <script src="../assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="../assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
        <script src="../assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <script src="../assets/pages/scripts/ui-tree.min.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->
        
        
<script type="text/javascript">
 
 $("#addpemid").click(function(){
     
 	pemid = $("#pemid").val();
 	siteid = $("#site_list").val();
 	pemname = $("#pemname").val();
 	categorytype = $("#categorytype").val();
 	pemabout = $("#pemabout").val();
 	
  inst =$("#tree_1111").jstree(true);  
  console.log(inst._data);
  
  if(inst._data.core.selected=='')
	{
			  $("#addresult").html("未选择节点!");
			  return;
	}
	if(inst._data.core.last_clicked.original.nodetype!='page')
	{
			  $("#addresult").html("选择节点不对!");
			  return;
	}
 	treenavid = parseInt(inst._data.core.last_clicked.original.id);
 	
 	 $.ajax({
					  url: "ajax_data/pemid_data.php",
					  type: 'post',
					  data:{"pemid":pemid,"siteid":siteid,"treenavid":treenavid,"pemname":pemname,"pemabout":pemabout,"categorytype":categorytype,"about":pemabout,"rnd":Math.random(),"act":"adpemid"},
					  dataType: 'json',
					  timeout: 1000,
					  success: function (data, status) {					   
					 if (data.STATE==true) {
					 	  $("#addresult").css("color","blue");
					 	  $("#addresult").html("添加成功!");	
					 	  createId(data.MSG,pemname); 		 	  
					   }else{					   	 
					   	 $("#addresult").css("color","red");
					     $("#addresult").html("添加失败!");
					   }
					  },
					  fail: function (err, status) {
					    console.log(err)
					  }
					})
					
		   // window.location.reload();
		 	
		 		
		 			
		});
		
	$("#addlink").click(function(){
			 //$("#adddept").hide();
			 			  
			 $("#pemaddform").modal('show');			 
  
			 siteid = $("#site_list").val();
			 $.ajax({
					  url: "ajax_data/pemid_data.php",
					  type: 'post',
					  data:{"siteid":siteid,"act":"category","rnd": Math.random()},
					  dataType: 'json',
					  timeout: 1000,
					  success: function (data, status) {					   
					  $.each(data, function (index, item) {
					     
					    $("#categorytype").append("<option value=\'"+item.id+"\'>"+item.category+"</option>"); 
					   });
					  },
					  fail: function (err, status) {
					    console.log(err)
					  }
					})
			
		});
   

$(function() {
	//Siteid = $("#site_list").val();
	$('#tree_1111').jstree({
	'core' : {
			'check_callback': true,
			"data" : function (obj, callback){
							$.ajax({
								url : "ajax_data/tree_data.php?siteid="+$("#site_list").val()+ "&rnd=" + Math.random(),
								dataType : "json",
								type : "POST",
								success : function(data) {
									console.info(data);
									if(data) {
										callback.call(this, data);
									}else{
										$("#tree_1111").html("暂无数据！");
									}
								}
							});
					}
				},
			//	"plugins" : [ "sort" ]
			}).on("changed.jstree", function(event, data) {
			 
				var inst = data.instance;							
			
				var selectedNode = inst.get_node(data.selected);
				
			if(selectedNode){				
				$("#treenavid").val(selectedNode.original.id);
			 
				console.info(selectedNode.original);
				//var level = $("#"+selectedNode.id).attr("text");
				if(selectedNode.original.nodetype=='page'){
					//addTreePemid(inst, selectedNode);				 					
					$("#addlink").removeAttr("disabled");
				}else if(selectedNode.original.nodetype=='nodes'){
				  $("#addlink").attr("disabled",true);
				}else if(selectedNode.original.nodetype=='pemid'){
					$("#show_pemid").val(selectedNode.original.id);
					$("#show_pemname").val(selectedNode.original.showname);
					$("#show_about").val(selectedNode.original.about);
					//$("#show_about").val(selectedNode.original.about);
				}
			} 
			
			});
		});


function droplistChange(){
	var tree1111 = jQuery.jstree.reference("#tree_1111");
   tree1111.refresh();
}		

$("#addlink").click(function(){
			 //$("#adddept").hide();
			 			  
			 $("#pemaddform").modal('show');			 
  
			 siteid = $("#site_list").val();
			 $.ajax({
					  url: "ajax_data/pemid_data.php",
					  type: 'post',
					  data:{"siteid":siteid,"act":"category","rnd": Math.random()},
					  dataType: 'json',
					  timeout: 1000,
					  success: function (data, status) {
                         $("#categorytype").empty();						  
					  $.each(data, function (index, item) {
					     
					    $("#categorytype").append("<option value=\'"+item.id+"\'>"+item.category+"</option>"); 
					   });
					  },
					  fail: function (err, status) {
					    console.log(err)
					  }
					})
			
		});
		
function delpemid (pemid){
	
	 siteid = $("#site_list").val();	
	 $.ajax({
					  url: "ajax_data/pemid_data.php",
					  type: 'post',
					  data:{"siteid":siteid,"pemid":pemid,"act":"killpemid","rnd": Math.random()},
					  dataType: 'json',
					  timeout: 1000,
					  success: function (data, status){					   
              if(data.STATE==1){
              	
              	deleteId();
              	
              }else{
              	
              }
					  },
					  fail: function (err, status) {
					    console.log(err)
					  }
					})
					
}

$("#pemid").change(function(){
	 pemid=$("#pemid").val();
	 siteid = $("#site_list").val();
	 
	 $.ajax({
					  url: "ajax_data/pemid_data.php",
					  type: 'post',
					  data:{"siteid":siteid,"pemid":pemid,"act":"querypemid","rnd": Math.random()},
					  dataType: 'json',
					  timeout: 1000,
					  success: function (data, status){					   
              if(data.STATE==1){
              	$("#addresult").css("color","green");
              	$("#addresult").html("ID可用");
              }else{
              	$("#addresult").css("color","red");
              	$("#addresult").html("权限ID已经存在!");
              }
					  },
					  fail: function (err, status) {
					    console.log(err)
					  }
					})					
	});

	
function createId(pemid,pemname) {
	
			var ref = $('#tree_1111').jstree(true);
			sel = ref.get_selected();
			if(!sel.length) { return false; }
			sel = sel[0];
			sel = ref.create_node(sel, {"id":pemid,"text":"["+pemid+"]"+pemname+"[<a href=\"#\" onclick=\"delpemid('"+pemid+"')\">删除</a>]","icon":"fa fa-cube icon-state-danger"});
			if(sel) {
				ref.edit(sel);
			}
}
	
function deleteId() {
		var ref = $('#tree_1111').jstree(true);
		console.info(ref);		
		sel = ref.get_selected();
			if(!sel.length) { return false; }
					ref.delete_node(sel);	
	};
						
</script>
                        
    </body>
</html>

