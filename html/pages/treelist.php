<?php
require_once($_SERVER["Root_Path"]."/inc/bootstrap.php");
require_once($_SERVER["Root_Path"]."/inc/function.php");
require_once($_SERVER["Root_Path"]."/html/pages/public/checkLogin.php");

$parentid= isset($_REQUEST['parentid'])?$_REQUEST['parentid']:0;


//var_dump($res);
$res = Pwtree_Nodes::getTreeNavList($merid,$parentid);



$treelistlink = isset($_REQUEST['treelistlink'])?$_REQUEST['treelistlink'].",".$parentid:$parentid;

$nes = Pwtree_Nodes::getTreeNavigation( $parentid,$merid);


$linkstr = '';
if($nes){
	$linkstr ="<a href='treelist.php?parentid=0'>Root</a>";
	foreach($nes as $k=>$nv)
	{
	  $linkstr .="-><a href='treelist.php?parentid=".$nv['id']."' >".$nv['name']."</a>";
	}
}
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
 function editshow(fid,nodename,fpath,sortid){
   $("#nodename").val(nodename);
 	 $("#urlpath").val(fpath);
 	 $("#sortid").val(sortid); 	 
	 $("#fid").val(fid);
	 
	 $("#addsite").hide();
	 $("#editsite").show();
	 
	 $("#siteaddform").modal('show');
	 
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
                                 <span>目录树管理 </span>
                                <i class="fa fa-circle"></i>
                            </li>
                            <li>
                                <span><?=$linkstr?></span>
                            </li>
                        </ul>
                        <div class="page-toolbar">
                            
                        </div>
                    </div>
                    <!-- END PAGE BAR -->
                    <!-- BEGIN PAGE TITLE-->
					        
                   <br>
                   <div class="portlet light bordered"  >                   	 	
                                <div class="portlet-title">     
                                	<span style="color:#a0a0a0">点击添加树枝和叶子节点，URL为空的是树枝，URL不为空的是树叶</span>	                               
                                    <div class="actions">			
                                    					
                                          <input type="hidden" value="<?=$parentid?>" id="hiparentid" />  
                                          <?php
                                          if(intval($parentid)>0){ 								  
											echo "<a class=\"btn red btn-outline sbold\" data-toggle=\"modal\" href=\"\" id=\"addlink\">添加 </a>";
										   }?>
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
                                                        <i class="fa "></i>节点名称</th>
                                                    <th >
                                                        <i class="fa "></i>节点属性</th>
                                                    <th >
                                                        <i class="fa "></i>URL地址</th>      	 	
                                                    <th>
                                                        <i class="fa"></i>排列顺序</th>
                                                     		
												 <th> 		
													<i class="fa"></i>操作</th>	
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php											
											if($res['LIST']){
												foreach($res['LIST'] as $k=>$v){													
												?>
                                                <tr>
												    <td ><input type="checkbox" name="treeid" value="<?=$v['id']?>" /></td>
                                                    <td>
                                                    	<?php                                                   	
                                                    if($v['path']==''){
                                                    		echo  "<a href=\"treelist.php?parentid=".$v['id']."\">".$v['name']."</a>";
                                                    	}else{
                                                    	  echo $v['name'];	
                                                    	}                                                    		
                                                    ?>
                                                    </td>                                                     
                                                   <td>
                                                     <?=($v['path']!='')?"叶子":"树枝"?>
                                                    </td>  
                                                 <td>
                                                     <?=($v['path']!='')?$v['path']:""?>
                                                    </td>    
                                                    <td ><?=$v['orderno']?></td>                                                  
													<td>
													<button type="button" class="btn blue btn-sm" onclick="editshow('<?=$v['id']?>','<?=$v['name']?>','<?=$v['path']?>','<?=$v['orderno']?>')">修改</button>&nbsp;&nbsp;
													
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
						 						
							<ul class="pagination" style="visibility: visible;">
							 <button type="button" class="btn red btn-sm" id="deletenode">删除</button>&nbsp;&nbsp;
							</ul>
						 
                        </div>
                    </div>
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->         
           
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
                                                    <button type="button" class="btn red" id="addsite">添加</button>
													<button type="button" class="btn red" id="editsite">修改</button>
													<input type="hidden" id="fid" value="" />
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
 
 $("#addsite").click(function(){
 	nodename = $("#nodename").val();
 	urlpath = $("#urlpath").val();
 	sortid = $("#sortid").val();
	hiparentid = $("#hiparentid").val();	
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
			 $("#editsite").hide();
			 $("#siteaddform").modal('show');
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

$("#deletenode").click(function(){
	
    var	treenodeid = "";
	 $("input[name='treeid']").each(function(){
				 if($(this).is(":checked"))
				 {
				   treenodeid +=	","	+	$(this).val();
				  }
			 });
			 
	  if(treenodeid=='')return	;
	  
	bootbox.confirm({   
    message: "<span style='color:red'>将会删除节点以及节点下面的子节点,以及节点下面的所有权限ID。<br><br>以及用户所属权限ID将失去并且全部清空。<br><br>&nbsp;&nbsp;确定要删除??<span>",
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
				  url: "ajax_data/tree_data.php",
				  type: 'post',					  
				  data:{"treenodeid":treenodeid,"treetype":"killtreenode"},
				  dataType: 'json',
				  timeout: 1000,
				  success: function (data, status) {					   
				 if (data.STATE==true) {
                     location.href="treelist.php?parentid=<?=$parentid?>"					 	  
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

