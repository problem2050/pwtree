<?php
require_once($_SERVER["Root_Path"]."/inc/bootstrap.php");
require_once($_SERVER["Root_Path"]."/inc/function.php");
require_once($_SERVER["Root_Path"]."/html/pages/public/checkLogin.php");

$rolename= isset($_REQUEST['rolename'])?$_REQUEST['rolename']:'';
$siteid = isset($_REQUEST['siteid'])?$_REQUEST['siteid']:-1;
$page = 1;
$pagesize =10;


//var_dump($grs,$merid,$siteid,$groupname='',$page,$pagesize);

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
        <title>Pwtree | 角色管理</title>
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
<script type="text/javascript">

function editgroup(obj){
	 var thisObj=$(obj);
	 var gid = thisObj.attr("edgroupId");
   $("#groupname").val($("#groupname_"+gid).html());
 	 $("#groupabout").val($("#groupabout_"+gid).html());
	 $("#fid").val(gid);	 
	 $("#addgroup").hide();
	 $("#editgroup").show();	 
	 $("#groupaddform").modal('show');	
}
 
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
                                <span>角色管理</span>
                            </li>
                        </ul>
                        <div class="page-toolbar">
                             
                        </div>
                    </div>
                    <!-- END PAGE BAR -->
                    <!-- BEGIN PAGE TITLE-->
					        
                   <br>
                   <div class="portlet light bordered" style="width:90%" >
                                <div class="portlet-title">                                    
                                   	<div class="caption">								
							               <select class="form-control" id="site_list" onchange="droplistChange()">
																<?php
																$site_rs = Pwtree_Nodes::getSites($merid);
																 
																 if($site_rs){
																	 if($siteid<=0){
																		 $siteid=$site_rs[0]['id'];
																	 }
							                                    foreach($site_rs as $k=>$v){
																	  if($siteid==$v['id']){
							                                                echo "<option value=\"".$v['id']."\" selected>".$v['sitename']."</option>";
																	  }else{
																		   echo "<option value=\"".$v['id']."\">".$v['sitename']."</option>";
																	  }
							                                         }
							                                     }
							                                                ?>
																</select>  
									
													</div>	
									
                                   
                                    <div class="actions">									
                                          <input type="hidden" value="<?=$parentid?>" id="hiparentid" />                        
                                         <a class="btn red btn-inline sbold" data-toggle="modal" href="" id="deletegroupid">删除角色 </a>
                                         <a class="btn blue btn-inline sbold" data-toggle="modal" href="" id="addlink">添加角色 </a>
                                    </div>
                                </div>
                                
                    <!-- END PAGE TITLE-->
                    <!-- END PAGE HEADER-->
        
                            <!-- BEGIN SAMPLE TABLE PORTLET-->
                            <div class="portlet">
                               
                                <div class="portlet-body">
                                    <div class="table-scrollable">
                                        <table class="table table-striped table-bordered table-advance table-hover">
                                            <thead>
                                                <tr>
                                                    <th width="5%">
                                                        <i class="fa "></i>选择</th>
                                                    <th >
                                                        <i class="fa "></i>角色名称</th>
                                                    <th >
                                                        <i class="fa "></i>角色描述</th>
                                                    <th >
                                                        <i class="fa "></i>操作</th>
													           
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php			
                                          $grs = User_Group::getGrouplist($merid,$siteid,$groupname='',$page,$pagesize);											
											if($grs['LIST']){
												foreach($grs['LIST'] as $k=>$v){													
												?>
                                                <tr>
												    <td ><input type="checkbox" name="groupid" value="<?=$v['gid']?>" /></td>
                                                    <td>
                                                    	<span id="groupname_<?=$v['gid']?>"><?=$v['groupname']?></span>
                                                    </td>                                                     
                                                   <td>
                                                     <span id="groupabout_<?=$v['gid']?>"><?=$v['about']?></span>
                                                    </td>                                                                                             
													<td>
													[<a href="grantpower_group.php?groupid=<?=$v['gid']?>&siteid=<?=$siteid?>">角色授权</a>]&nbsp;&nbsp;&nbsp;
                                                    [<a href="treepreview_group.php?groupid=<?=$v['gid']?>&siteid=<?=$siteid?>"> 查看角色权限</a>] &nbsp;&nbsp;&nbsp;
													[<a href="user_togroup.php?groupid=<?=$v['gid']?>&siteid=<?=$siteid?>"> 为角色添加用户</a>] &nbsp;&nbsp;&nbsp;
                                                    [<a href="javascript:void(0);" onclick="editgroup(this)" edgroupId="<?=$v['gid']?>" >修改</a>]
                                                    </td>  
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
							 
                        </div>
                    </div>
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->         
           
           <!--BEGIN MODAL-DIALOG -->
           <div id="groupaddform" class="modal fade" tabindex="-1" data-width="400">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h4 class="modal-title">添加新角色</h4>
                                                </div>
                                                <div class="modal-body">
                                        <div class="form-group">
                                                <label>角色名称:</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa icon-docs"></i>
                                                    </span>
                                                    <input type="text" class="form-control" placeholder="请输入角色名称" id="groupname" value=""> </div>
                                            </div>                                            
                                           <div class="form-group">
                                                <label>角色描述:</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa icon-link"></i>
                                                    </span>
                                                    <input type="text" class="form-control" placeholder="角色描述" id="groupabout" value=""> </div>
                                            </div> 
                                       
                                             <span id="addresult"></span>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" data-dismiss="modal" class="btn dark btn-outline">关闭</button>
                                                    <button type="button" class="btn red" id="addgroup">添加</button>
													<button type="button" class="btn red" id="editgroup">修改</button>
													<input type="hidden" id="fid" value="" />
                                                </div>
                                            </div>
                                        </div>
                             </div>
                             
            
                                    
			              <!--END MODAL-DIALOG -->
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
        
        
<script type="text/javascript">
 
 $("#addgroup").click(function(){
 	groupname = $("#groupname").val();
 	siteid = $("#site_list").val();
 	groupabout = $("#groupabout").val();
 	$.ajax({
					  url: "ajax_data/group_data.php",
					  type: 'post',
					  data:{"groupname":groupname,"groupabout":groupabout,"siteid":siteid,"act":"addgroup"},
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
					
		   // window.location.reload();
		 			
		});
		
	$("#addlink").click(function(){
			 //$("#adddept").hide();
			 $("#editgroup").hide();
			 $("#groupaddform").modal('show');
		});


 
 $("#editgroup").click(function(){
 	groupname = $("#groupname").val();
 	siteid = $("#site_list").val();
 	groupabout = $("#groupabout").val();
 	 
	fid = $("#fid").val();
	
 	$.ajax({
					  url: "ajax_data/group_data.php",
					  type: 'post',					  
					  data:{"fid":fid,"groupname":groupname,"siteid":siteid,"groupabout":groupabout,"act":"editgroup"},
					  dataType: 'json',
					  timeout: 1000,
					  success: function (data, status) {					   
					 if (data.STATE==true) {
					 	  $("#addresult").css("color","blue");
					 	  $("#addresult").html("修改成功!");
					 	  $("#groupname_"+fid).html(groupname);
					 	  $("#groupabout_"+fid).html(groupabout);
					   }else{					   	 
					   	 $("#addresult").css("color","red");
					     $("#addresult").html("修改失败!");
					     
					   }
					  },
					  fail: function (err, status) {
					    console.log(err)
					  }
					})
					
		  //  window.location.reload();
		 			
		});	
		
 $("#site_list").change(function(){
		
	location.href="grouplist.php?siteid="+$("#site_list").val()
});


$("#deletegroupid").click(function(){
	
    var	groupidstr = "";
	 $("input[name='groupid']").each(function(){
				 if($(this).is(":checked"))
				 {
				   groupidstr +=	","	+	$(this).val();
				  }
			 });
			 
	 if(groupidstr=='')return	;
	
	selsiteid  = $("#site_list").val();
	
	bootbox.confirm({   
    message: "<span style='color:red'>删除角色，角色下面所属用户将全部失去权限，权限数据将清空。<br><br><br><br>&nbsp;&nbsp;确定要删除??<span>",
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
				  url: "ajax_data/group_data.php",
				  type: 'post',					  
				  data:{"groupid":groupidstr,siteid:selsiteid,"act":"killgroupid"},
				  dataType: 'json',
				  timeout: 1000,
				  success: function (data, status) {					   
				 if (data.STATE==true) {
                     location.href="grouplist.php?siteid="+$("#site_list").val();
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

</script>


    </body>
</html>

