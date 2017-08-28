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
        <link href="../assets/global/plugins/jquery-multi-select/css/multi-select.css" rel="stylesheet" type="text/css" />
       
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
		<style>
		input.search-input{
		  box-sizing: border-box;
		  -moz-box-sizing:border-box;
		  width: 100%;
		  margin-bottom: 5px;
		  height: auto;
		}
	.ms-container{
	  background: transparent url('../img/switch.png') no-repeat 50% 50%;
	  width: 570px;
	}
		</style>
<script type="text/javascript">


 
 </script>
    <!-- END HEAD -->
<?php
require_once($_SERVER["Root_Path"]."/inc/bootstrap.php");
require_once($_SERVER["Root_Path"]."/inc/function.php");

$groupid= isset($_REQUEST['groupid'])?$_REQUEST['groupid']:-1;
$siteid = isset($_REQUEST['siteid'])?$_REQUEST['siteid']:-1;
$page = 1;
$pagesize =1000;



//$grs = User_Group::getGrouplist($merid,$siteid,$groupname='',$page,$pagesize);
//var_dump($grs,$merid,$siteid,$groupname='',$page,$pagesize);
$urs = User_Userinfo::getUserinfo($merid,$username='',$page,$pagesize,$depid='');

//$gurs = Pwtree_Grant::getPermissiongroup($groupid=1,$siteid=1000,$merid=10001);
?>
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
                                <span>角色管理</span>
                            </li>
                        </ul>
                        <div class="page-toolbar">
                             
                        </div>
                    </div>
                    <!-- END PAGE BAR -->
                    <!-- BEGIN PAGE TITLE-->
					        
                   <br>
                   <div class="portlet light bordered" style="width:60%" >
                                <div class="portlet-title">                                                                      										 
										<div class="row">
										<div class="col-md-6">
										 <label   class="control-label">站点:</label>
                                           <input type="hidden" id="groupid" value="<?=$groupid?>" />									
							               <select class="form-control" id="site_list" onchange="droplistChange()">
																<?php
																$site_rs = Pwtree_Nodes::getSites($merid);
																 
															 if($site_rs){
															 	
															 	   if($siteid<=0){
															 	    	$siteid = $site_rs[0]['id'];
															 	    }
															 	    
							                      foreach($site_rs as $k=>$v){							                      	  
                                      if($siteid==$v['id']){														 
							                           echo "<option value=\"".$v['id']."\" selected >".$v['sitename']."</option>";
																	}else{
																		echo "<option value=\"".$v['id']."\">".$v['sitename']."</option>";
																     	}
							                      }
							                 }
							                                                ?>
											    </select>  
											</div>
								 
								 <div class="col-md-6">
								 <label   class="control-label">角色:</label>
									<select class="form-control" id="grouplist">
									 <?php
									 $grs = User_Group::getGrouplist($merid,$siteid,$groupname='',$page,$pagesize);
									  
									 if($grs['LIST']){
									 	if($groupid<=0)
									 	{
									 		$groupid=$grs['LIST'][0]['gid'];
									 	}
							            foreach($grs['LIST'] as $k=>$v){  
                                if($groupid==$v['gid']){														 
							                echo "<option value=\"".$v['gid']."\" selected >".$v['groupname']."</option>";
											}else{
												echo "<option value=\"".$v['gid']."\">".$v['groupname']."</option>";
										     	}
							                 }
							              }
									 ?>
									</select>
								 </div>
								  
							 </div><br> 	                                
                            </div>
                                         

                    <!-- END PAGE TITLE-->
                    <!-- END PAGE HEADER-->
        
                            <!-- BEGIN SAMPLE TABLE PORTLET-->
                            <div class="portlet">
                               
                                <div class="portlet-body">
                                    <div class="ms-container" >
									<div class="ms-selectable" >
									 <select id='custom-headers'   class="searchable" multiple='multiple'>
									  <?php
									  if($urs['LIST']){
										  foreach($urs['LIST'] as $k=>$v){
											  
											if(User_Group::checkUserinOtherGroup($merid,$siteid,$v['f_id'],$groupid)){
												continue;
											}
											
											$ischeck = User_Group::checkPermissionGroup($merid,$siteid,$v['f_id'],$groupid);
											
											if($ischeck){
												echo "<option value='".$v['f_id']."' selected >".$v['f_username']."(".$v['f_truename'].")"."</option>";  
											}else{
												echo "<option value='".$v['f_id']."'  >".$v['f_username']."(".$v['f_truename'].")"."</option>";  
											}
										  }
									  }
									  ?>
									</select>
									</div>
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
        <script src="../assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <script src="../assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/jquery.quicksearch.js" type="text/javascript"></script>

        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="../assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
        <script src="../assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
        <script src="../assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
		<script	src="../assets/global/plugins/bootbox/bootbox.min.js"	type="text/javascript"></script>
		<script src="../assets/pages/scripts/ui-bootbox.min.js" type="text/javascript"></script>

        <!-- END THEME LAYOUT SCRIPTS -->
        
        
<script type="text/javascript">
 
 $('#custom-headers').multiSelect({
 // selectableHeader: "<div class='custom-header'>用户列表:</div>",
  //selectionHeader: "<div class='custom-header'>属于角色的用户: </div>",
  selectableHeader: "<input type='text' class='search-input' autocomplete='off' placeholder='用户列表'>",
  selectionHeader: "<input type='text' class='search-input' autocomplete='off' placeholder='属于角色的用户'>",
  afterSelect: function(values){
	this.qs1.cache();
    this.qs2.cache();
	userid = values.toString();
	siteid = $("#site_list").val();
	groupid = $("#groupid").val();
	 
	if(groupid<=0)
		return;
	
	$.ajax({
		  url: "ajax_data/group_data.php",
		  type: 'post',					  
		  data:{"siteid":siteid,"userid":userid,"groupid":groupid,"act":"insusertogroup"},
		  dataType: 'json',
		  timeout: 1000,
		  success: function (data, status) {					   
		 if (data.STATE==true) {
			  
		   }else{					   	 
			bootbox.alert({message:	"操作失败!",
											size:	'small'});
		   }
		  },
		  fail: function (err, status) {
			console.log(err)
		  }
		})
					
    console.info("Select value: "+values);
  },
  afterDeselect: function(values){
	this.qs1.cache();
    this.qs2.cache();
    console.info("Deselect value: "+values);
	userid = values.toString();
	siteid = $("#site_list").val();
	groupid = $("#groupid").val();
	 
	if(groupid<=0)
		return;
	
	$.ajax({
		  url: "ajax_data/group_data.php",
		  type: 'post',					  
		  data:{"siteid":siteid,"userid":userid,"groupid":groupid,"act":"delusertogroup"},
		  dataType: 'json',
		  timeout: 1000,
		  success: function (data, status) {					   
		 if (data.STATE==true) {
			  
		   }else{					   	 
			bootbox.alert({message:	"操作失败!",
											size:	'small'});
		   }
		  },
		  fail: function (err, status) {
			console.log(err)
		  }
		})
   },
    afterInit: function(ms){
    var that = this,
        $selectableSearch = that.$selectableUl.prev(),
        $selectionSearch = that.$selectionUl.prev(),
        selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
        selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

    that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
    .on('keydown', function(e){
      if (e.which === 40){
        that.$selectableUl.focus();
        return false;
      }
    });

    that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
    .on('keydown', function(e){
      if (e.which == 40){
        that.$selectionUl.focus();
        return false;
      }
    });
  },
});	
	
$(".ms-list").css("height","300px");

$("#site_list").change(function(){		
	location.href="user_togroup.php?siteid="+$("#site_list").val();
});

$("#grouplist").change(function(){		
	location.href="user_togroup.php?siteid="+$("#site_list").val()+"&groupid="+$("#grouplist").val();
});

</script>


    </body>
</html>

