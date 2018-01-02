<?php
require_once($_SERVER["Root_Path"]."/inc/bootstrap.php");
require_once($_SERVER["Root_Path"]."/inc/function.php");
require_once($_SERVER["Root_Path"]."/html/pages/public/checkLogin.php");

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
        <title>Pwtree | 添加站点权限ID</title>
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
                                <span>添加权限ID</span>
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
              <div class="col-md-7">
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
                                         <button type="button" class="btn red" disabled id="addnode">添加目录树</button>                                  
                                         <button type="button" class="btn red" disabled id="addlink">添加权限ID </a>
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
                       <div class="col-md-5">
                       
						<div class="portlet light bordered" >                                
                                <div class="form-horizontal" >
                                    <div class="form-body">
										<div class="form-group">
                                                        <label class="control-label col-md-3">权限ID                                                        
                                                        </label>
                                                        <div class="col-md-9">
                                                           <input type="text" disabled id="show_pemid" data-required="1" class="form-control" /> 
			                                </div>
									   </div>
  										<div class="form-group">
                                                        <label class="control-label col-md-3">名称：                                                        
                                                        </label>
                                                        <div class="col-md-9">
                                                 <input type="text" id="show_pemname" data-required="1" class="form-control" /> 
			                                </div>
						              </div>
									  <!--
						                    <div class="form-group">
                                                        <label class="control-label col-md-3">描述：                                                        
                                                        </label>
                                                        <div class="col-md-9">
                                                 <input type="text" id="show_about" data-required="1" class="form-control" /> 
			                                      </div>
											</div>
							        <div class="form-group">
                                                        <label class="control-label col-md-3">分类：
                                                      
                                                        </label>
                                                        <div class="col-md-9">
                                                            <select class="form-control select2me" id="show_cateid">
                                                                
                                                            </select>
                                                        </div>
                                                    </div>
                             			          -->                          
                                   
                                        <div class="form-actions">
                                            <button type="submit" class="btn blue" id="saveapembout">保存</button>
                                            <label id="saveresult"></label>
                                        </div>
                                    </div>
                                </div>                                
                          <br>
                                <div class="form-horizontal" >
																		<div class="form-body">
																			 <div class="form-group">                                                      
                                               <li class="list-group-item bg-yellow bg-font-yellow"> 拥有此权限ID的用户和角色： </li>                                                   
											                   </div>
																				 <table	class="table table-hover" id="pemid_inuserorgroup">
																										<thead>
																												<tr>																													
																														<th>用户名</th>
																														<th>真实姓名</th>
																														<th>角色名</th>
																														
																												</tr>
																										</thead>
																										<tbody id="tbody_inuserorgroup">
																												 
																										</tbody>
																								</table>

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
                                                <label>权限ID名称:</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-file"></i>
                                                    </span>
                                                    <input type="text" class="form-control" placeholder="权限名称" id="pemname" value=""> </div>
                                            </div>                                                                                     
                                           <div class="form-group">
                                                <label>权限ID描述:</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-file"></i>
                                                    </span>
                                                    <input type="text" class="form-control" placeholder="简单描述权限ID" id="pemabout" value=""> </div>
                                            </div> 
                                       <div class="form-group">
                                        <!--<label>权限类别:</label>
                                        <select class="form-control" id="categorytype">
																					
										  </select>							-->														
				                                   <span id="addresult"></span>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" data-dismiss="modal" class="btn dark btn-outline">关闭</button>
														
                                                    <button type="button" class="btn red" id="addpemid">添加权限ID</button>													
													<input type="hidden" id="treenavid" value="" />
                                                </div>
                                            </div>
                                        </div>
                             </div> 
        </div>
		 <!--END MODAL-DIALOG -->
		  <!--BEGIN MODAL-DIALOG -->
           <div id="siteaddform" class="modal fade" tabindex="-1" data-width="400">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h4 class="modal-title">添加新站点</h4>
                                                </div>
                                                <div class="modal-body">
                                        <div class="form-group">
                                                <label>节点名称:</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa icon-docs"></i>
                                                    </span>
                                                    <input type="text" class="form-control" placeholder="请输入节点名称" id="nodename" value=""> </div>
                                            </div>                                            
                                           <div class="form-group">
                                                <label>URL地址:</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa icon-link"></i>
                                                    </span>
                                                    <input type="text" class="form-control" placeholder="URL地址,相对或绝对URL" id="urlpath" value=""> </div>
                                            </div> 
                                       <div class="form-group">
                                                <label>排序ID:</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa icon-arrow-up"></i>
                                                    </span>
                                                    <input type="text" class="form-control" placeholder="排序ID，按升序排列" id="sortid" value=""> </div>
                                            </div> 
                                             <span id="addresult"></span>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" data-dismiss="modal" class="btn dark btn-outline">关闭</button>
                                                    <button type="button" class="btn red"  id="addsite">添加</button>
													<button type="button" class="btn red" id="editsite">修改</button>
													<input type="hidden" id="fid" value="" />
                                                </div>
                                            </div>
                                        </div>
                             </div>
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
		<script	src="../assets/global/plugins/bootbox/bootbox.min.js"	type="text/javascript"></script>
        <script src="../assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="../assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
        <script src="../assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <script src="../assets/pages/scripts/ui-tree.min.js" type="text/javascript"></script>
	    <script src="../assets/pages/scripts/ui-bootbox.min.js" type="text/javascript"></script>

        <!-- END THEME LAYOUT SCRIPTS -->
        
        
<script type="text/javascript">
 
 $("#addpemid").click(function(){
     
 	//pemid = $("#pemid").val();
 	siteid = $("#site_list").val();
 	pemname = $("#pemname").val();
 	categorytype = $("#categorytype").val();
 	pemabout = $("#pemabout").val();
 	
  inst =$("#tree_1111").jstree(true);  
   console.log(inst);
  //console.log(inst._model.data[inst._data.core.selected].original.nodetype);
  if(pemname ==''){
  	 $("#addresult").css("color","red");
  	 $("#addresult").html("权限名称需要填写!");
			   return;
  }
  
  if(inst._data.core.selected=='')
	{
		    $("#addresult").css("color","red");
			  $("#addresult").html("未选择节点!");
			   return;
	}
	 
	if(inst._model.data[inst._data.core.selected].original.nodetype!='page')
	{
		    $("#addresult").css("color","red");
			  $("#addresult").html("选择节点不对!");
			  return;
	} 
 	treenavid = parseInt(inst._data.core.selected);
 	
 	 $.ajax({
					  url: "ajax_data/pemid_data.php",
					  type: 'post',
					  data:{"siteid":siteid,"treenavid":treenavid,"pemname":pemname,"pemabout":pemabout,"categorytype":categorytype,"about":pemabout,"rnd":Math.random(),"act":"adpemid"},
					  dataType: 'json',
					  timeout: 1000,
					  success: function (data, status) {					   
					 if (data.STATE==true) {
					 	  $("#addresult").css("color","blue");
					 	  $("#addresult").html("添加成功!");	
					 	  //createId(data.MSG,pemname); 
					 	   	 droplistChange(); 	  
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
   
$("#saveapembout").click(function(){
   
 	pemname = $("#show_pemname").val();
 	pemcateid = $("#show_cateid").val();
 	pemabout = $("#show_about").val();
 	pemid = $("#show_pemid").val();
 	
     $.ajax({
					  url: "ajax_data/pemid_data.php",
					  type: 'post',
					  data:{ "pemid":pemid,"pemname":pemname,"pemabout":pemabout,"pemcateid":pemcateid,"pemabout":pemabout,"rnd":Math.random(),"act":"uppemabout"},
					  dataType: 'json',
					  timeout: 1000,
					  success: function (data, status) {					   
							 if (data.STATE==true) {
							 	  $("#saveresult").css("color","blue");
							 	  $("#saveresult").html("保存成功!");	
							 	   	 	  
							   }else{					   	 
							   	 $("#saveresult").css("color","red");
							     $("#saveresult").html("保存失败!");
							   }
							   droplistChange();
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
			//	"plugins" : [ "sort" ]
			}).on("changed.jstree", function(event, data) {
			 
				var inst = data.instance;							
			
				var selectedNode = inst.get_node(data.selected);
				
			if(selectedNode){				
				$("#treenavid").val(selectedNode.original.id);
			 
				console.info(inst);
			
				if(selectedNode.original.nodetype=='page'){									
					$("#addlink").removeAttr("disabled");
					$("#addnode").attr("disabled",true);
				}else if(selectedNode.original.nodetype=='nodes'){
				  $("#addlink").attr("disabled",true);
				  $("#addnode").removeAttr("disabled");
				}else if(selectedNode.original.nodetype=='pemid'){
					$("#addnode").attr("disabled",true);
					$("#addlink").attr("disabled",true);
					
					$("#show_pemid").val(selectedNode.original.id);
					$("#show_pemname").val(selectedNode.original.showname);
					$("#show_about").val(selectedNode.original.about);
					cateid = selectedNode.original.cateid;
					siteid = $("#site_list").val();
			    $.ajax({
					  url: "ajax_data/pemid_data.php",
					  type: 'post',
					  data:{"siteid":siteid,"act":"category","rnd": Math.random()},
					  dataType: 'json',
					  timeout: 1000,
					  success: function (data, status) {
						  $("#show_cateid").empty();					   
						  $.each(data, function (index, item) {
						    if (item.id==cateid){
						    	$("#show_cateid").append("<option value=\'"+item.id+"\' selected>"+item.category+"</option>"); 
						    }else{
						    		$("#show_cateid").append("<option value=\'"+item.id+"\'>"+item.category+"</option>"); 
						    }
					      
					   });
					  },
					  fail: function (err, status) {
					    console.log(err)
					  }
					});
					
					//加载用户列表
					getpemidinuserorgroup(siteid,selectedNode.original.id);
					
				}
			} 
			
			//
			
			
			//函数结束的地方
			});
		});

$("#addsite").click(function(){
 	nodename = $("#nodename").val();
 	urlpath = $("#urlpath").val();
 	sortid = $("#sortid").val();
	inst =$("#tree_1111").jstree(true); 
	hiparentid =  parseInt(inst._data.core.selected);;	
 	$.ajax({
					  url: "ajax_data/treelist.php",
					  type: 'post',
					  data:{"nodename":nodename,"urlpath":urlpath,"hiparentid":hiparentid,"sortid":sortid,"act":"ad"},
					  dataType: 'json',
					  timeout: 1000,
					  success: function (data, status) {					   
					 if (data.STATE==true) {
					 	  $("#addresult").css("color","blue");
					 	  $("#addresult").html("添加成功!");	
                          droplistChange(); 						  
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
$("#editsite").click(function(){
 	nodename = $("#nodename").val();
 	urlpath = $("#urlpath").val();
 	sortid = $("#sortid").val();
 	 
	fid = $("#fid").val();
	
 	$.ajax({
					  url: "ajax_data/treelist.php",
					  type: 'post',					  
					  data:{"fid":fid,"nodename":nodename,"urlpath":urlpath,"sortid":sortid,"act":"ed"},
					  dataType: 'json',
					  timeout: 1000,
					  success: function (data, status) {					   
					 if (data.STATE==true) {
					 	  $("#addresult").css("color","blue");
					 	  $("#addresult").html("添加成功!");					 	  
					   }else{					   	 
					   	 $("#addresult").css("color","red");
					     $("#addresult").html("添加失败!");
					     
					   }
					  },
					  fail: function (err, status) {
					    console.log(err)
					  }
					})
					
		  //  window.location.reload();
		 			
		});			
function droplistChange(){
	var tree1111 = $.jstree.reference("#tree_1111");
   tree1111.refresh();
  
  // tree1111.select_node(selectid);
}	
	
function getpemidinuserorgroup(siteid,pemid){
	 $.ajax({
					  url: "ajax_data/group_data.php",
					  type: 'post',					  
					  data:{"pemid":pemid,"siteid":siteid,"act":"getpidinuserorgroup"},
					  dataType: 'json',
					  timeout: 1000,
					  success: function (data, status) {					   
					 if (data.STATE==true) {
					 	 console.info(data);
					 	 //var table_userandgroup = $('#pemid_inuserorgroup'); 
					 	 $("#tbody_inuserorgroup").html("");
					 	 $.each(data.DATA, function (index, item) {
						    	$("#tbody_inuserorgroup").append("<tr><td>"+item.username+"</td><td>"+item.truename+"</td><td>"+item.groupname+"</td></tr>"); 						     
					      
					   });
					   			 	  
					   }else{	
					   	 $("#tbody_inuserorgroup").html("");				   	 
					   	 console.info(data);
					   }
					  },
					  fail: function (err, status) {
					    console.log(err)
					  }
					})
	
}

$("#addnode").click(function(){
			 //$("#adddept").hide();
			 $("#editsite").hide();
			 $("#siteaddform").modal('show');
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
	
	bootbox.confirm({   
    message: "页面和用户所属权限ID将失效，确定要删除?",
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
								
							  }else{}
					  },
					  fail: function (err, status) {
					    console.log(err)
					  }
					})
		   }
		 console.log('This was logged in the callback: ' + result);
	   }
	});

	 	
}


	
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

