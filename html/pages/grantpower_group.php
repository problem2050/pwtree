<?php
require_once($_SERVER["Root_Path"]."/inc/bootstrap.php");
require_once($_SERVER["Root_Path"]."/inc/function.php");


$page	=	1;
$pagesize	=	1000;

//echo getBuildTree3($siteid='10000',$merid,$userid='4');
//exit;
//$rtt = Pwtree_Nodes::getPermissionTreenavList($siteid='10000',$merid,$userid='4');
//var_dump($rtt);exit;

$page= isset($_REQUEST['page'])?$_REQUEST['page']:1;

$act=	isset($_REQUEST['act'])?$_REQUEST['act']:'';
$siteid= isset($_REQUEST['siteid'])?$_REQUEST['siteid']:'-1';

$groupid=	isset($_REQUEST['groupid'])?$_REQUEST['groupid']:'';
//var_dump($res);
$res = User_Userinfo::getSiteslist($merid,$page,$pagesize);

$grs = User_Group::getGrouplist($merid,$siteid,$groupname='',$page,$pagesize);

//var_dump($res);
?>
<!DOCTYPE	html>
<!--[if	IE 8]> <html lang="en" class="ie8	no-js">	<![endif]-->
<!--[if	IE 9]> <html lang="en" class="ie9	no-js">	<![endif]-->
<!--[if	!IE]><!-->
<html	lang="en">
		<!--<![endif]-->
		<!-- BEGIN HEAD	-->
		<head>
				<meta	charset="utf-8"	/>
				<title>Metronic	|	Basic	Datatables</title>
				<meta	http-equiv="X-UA-Compatible" content="IE=edge">
				<meta	content="width=device-width, initial-scale=1"	name="viewport"	/>
				<meta	content="" name="description"	/>
				<meta	content="" name="author" />
				<!-- BEGIN GLOBAL	MANDATORY	STYLES -->
				<link	href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet"	type="text/css"	/>
				<link	href="../assets/global/plugins/font-awesome/css/font-awesome.min.css"	rel="stylesheet" type="text/css" />
				<link	href="../assets/global/plugins/simple-line-icons/simple-line-icons.min.css"	rel="stylesheet" type="text/css" />
				<link	href="../assets/global/plugins/bootstrap/css/bootstrap.min.css"	rel="stylesheet" type="text/css" />
				<link	href="../assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css"	rel="stylesheet" type="text/css" />
				<!-- END GLOBAL	MANDATORY	STYLES -->
				 <link href="../assets/global/plugins/jstree/dist/themes/default/style.min.css"	rel="stylesheet" type="text/css" />
				<!-- BEGIN THEME GLOBAL	STYLES -->
				<link	href="../assets/global/css/components.min.css" rel="stylesheet"	id="style_components"	type="text/css"	/>
				<link	href="../assets/global/css/plugins.min.css"	rel="stylesheet" type="text/css" />
				<!-- END THEME GLOBAL	STYLES -->
				<!-- BEGIN THEME LAYOUT	STYLES -->
				<link	href="../assets/layouts/layout/css/layout.min.css" rel="stylesheet"	type="text/css"	/>
				<link	href="../assets/layouts/layout/css/themes/darkblue.min.css"	rel="stylesheet" type="text/css" id="style_color"	/>
				<link	href="../assets/layouts/layout/css/custom.min.css" rel="stylesheet"	type="text/css"	/>
				<!-- END THEME LAYOUT	STYLES -->
				<link	rel="shortcut	icon"	href="favicon.ico" />	</head>
<script	type="text/javascript">

 </script>
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
								<div class="top-menu">
										<ul	class="nav navbar-nav	pull-right">
												<!-- BEGIN NOTIFICATION	DROPDOWN -->

												<!-- END NOTIFICATION	DROPDOWN -->
												<!-- BEGIN INBOX DROPDOWN	-->

												<!-- END INBOX DROPDOWN	-->

												<!-- BEGIN USER	LOGIN	DROPDOWN -->
												<!-- DOC:	Apply	"dropdown-dark"	class	after	below	"dropdown-extended"	to change	the	dropdown styte -->
												<li	class="dropdown	dropdown-user">
														<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"	data-hover="dropdown"	data-close-others="true">
																<img alt=""	class="img-circle" src="../assets/layouts/layout/img/avatar3_small.jpg"	/>
																<span	class="username	username-hide-on-mobile">	Nick </span>
																<i class="fa fa-angle-down"></i>
														</a>
														<ul	class="dropdown-menu dropdown-menu-default">
																<li>
																		<a href="adduserinfo.php">
																				<i class="icon-user"></i>	My Profile </a>
																</li>
																<li>
																		<a href="app_calendar.html">
																				<i class="icon-calendar"></i>	My Calendar	</a>
																</li>
																<li>
																		<a href="app_inbox.html">
																				<i class="icon-envelope-open"></i> My	Inbox
																				<span	class="badge badge-danger">	3	</span>
																		</a>
																</li>
																<li>
																		<a href="app_todo.html">
																				<i class="icon-rocket"></i>	My Tasks
																				<span	class="badge badge-success"> 7 </span>
																		</a>
																</li>
																<li	class="divider"> </li>
																<li>
																		<a href="page_user_lock_1.html">
																				<i class="icon-lock"></i>	Lock Screen	</a>
																</li>
																<li>
																		<a href="page_user_login_1.html">
																				<i class="icon-key"></i> Log Out </a>
																</li>
														</ul>
												</li>
												<!-- END USER	LOGIN	DROPDOWN -->
												<!-- BEGIN QUICK SIDEBAR TOGGLER -->
												<!-- DOC:	Apply	"dropdown-dark"	class	after	below	"dropdown-extended"	to change	the	dropdown styte -->
												<li	class="dropdown	dropdown-quick-sidebar-toggler">
														<a href="javascript:;" class="dropdown-toggle">
																<i class="icon-logout"></i>
														</a>
												</li>

										</ul>
								</div>
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
						<!-- BEGIN SIDEBAR -->
						<div class="page-sidebar-wrapper">
								<!-- BEGIN SIDEBAR -->
								<!-- DOC:	Set	data-auto-scroll="false" to	disable	the	sidebar	from auto	scrolling/focusing -->
								<!-- DOC:	Change data-auto-speed="200" to	adjust the sub menu	slide	up/down	speed	-->
								<div class="page-sidebar navbar-collapse collapse">
										<!-- BEGIN SIDEBAR MENU	-->
										<!-- DOC:	Apply	"page-sidebar-menu-light"	class	right	after	"page-sidebar-menu"	to enable	light	sidebar	menu style(without borders)	-->
										<!-- DOC:	Apply	"page-sidebar-menu-hover-submenu"	class	right	after	"page-sidebar-menu"	to enable	hoverable(hover	vs accordion)	sub	menu mode	-->
										<!-- DOC:	Apply	"page-sidebar-menu-closed" class right after "page-sidebar-menu" to	collapse("page-sidebar-closed" class must	be applied to	the	body element)	the	sidebar	sub	menu mode	-->
										<!-- DOC:	Set	data-auto-scroll="false" to	disable	the	sidebar	from auto	scrolling/focusing -->
										<!-- DOC:	Set	data-keep-expand="true"	to keep	the	submenues	expanded -->
										<!-- DOC:	Set	data-auto-speed="200"	to adjust	the	sub	menu slide up/down speed -->
										<ul	class="page-sidebar-menu	page-header-fixed	"	data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200"	style="padding-top:	20px">
												<!-- DOC:	To remove	the	sidebar	toggler	from the sidebar you just	need to	completely remove	the	below	"sidebar-toggler-wrapper"	LI element -->
												<li	class="sidebar-toggler-wrapper hide">
														<!-- BEGIN SIDEBAR TOGGLER BUTTON	-->
														<div class="sidebar-toggler">
																<span></span>
														</div>
														<!-- END SIDEBAR TOGGLER BUTTON	-->
												</li>
												<!-- DOC:	To remove	the	search box from	the	sidebar	you	just need	to completely	remove the below "sidebar-search-wrapper"	LI element -->

												<li	class="nav-item	start	">
														<a href="javascript:;" class="nav-link nav-toggle">
																<i class="icon-home"></i>
																<span	class="title">目录树管理</span>
																<span	class="arrow open"></span>
														</a>
														<ul	class="sub-menu">
																<li	class="nav-item	start	">
																		<a href="#"	class="nav-link	">
																				<i class="icon-bar-chart"></i>
																				<span	class="title">添加新站点</span>
																		</a>
																</li>
																<li	class="nav-item	start	">
																		<a href="#"	class="nav-link	">
																				<i class="icon-bulb"></i>
																				<span	class="title">添加目录树</span>
																		</a>
																</li>
																<li	class="nav-item	start	">
																		<a href="permission.html"	class="nav-link	">
																				<i class="icon-graph"></i>
																				<span	class="title">添加权限ID</span>
																		</a>
																</li>
														</ul>
												</li>
								<li	class="nav-item	active open	">
														<a href="javascript:;" class="nav-link nav-toggle">
																<i class="icon-user"></i>
																<span	class="title">用户与角色管理</span>
								<span	class="selected"></span>
																<span	class="arrow open"></span>
														</a>
														<ul	class="sub-menu">
																<li	class="nav-item	 ">
																		<a href="adduserinfo.php"	class="nav-link	">
																				<i class="icon-bar-chart"></i>
																				<span	class="title">添加新用户</span>
																		</a>
																</li>

								<li	class="nav-item	active open	">
																		<a href="#"	class="nav-link	">
																				<i class="icon-bar-chart"></i>
																				<span	class="title">用户列表</span>
																		</a>
																</li>

																<li	class="nav-item	 ">
																		<a href="#"	class="nav-link	">
																				<i class="icon-bulb"></i>
																				<span	class="title">角色管理</span>
																		</a>
																</li>
																<li	class="nav-item	 ">
																		<a href="#"	class="nav-link	">
																				<i class="icon-graph"></i>
																				<span	class="title">修改商户信息</span>
																		</a>
																</li>
														</ul>
												</li>

										</ul>

										<!-- END SIDEBAR MENU	-->
								</div>
								<!-- END SIDEBAR -->
						</div>
						<!-- END SIDEBAR -->
						<!-- BEGIN CONTENT -->
						<div class="page-content-wrapper">
								<!-- BEGIN CONTENT BODY	-->
								<div class="page-content"	>
										<!-- BEGIN PAGE	HEADER-->
										<!-- BEGIN THEME PANEL -->

										<!-- END THEME PANEL -->
										<!-- BEGIN PAGE	BAR	-->

										<div class="page-bar">
												<ul	class="page-breadcrumb">
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
										<!-- END PAGE	BAR	-->
										<!-- BEGIN PAGE	TITLE-->
								<br>
							<div class="page-content-inner">
								<div class="row">

							<div class="col-md-8">
							<div class="portlet	light	bordered"	>
								<div class="portlet-title">
								<div class="caption">
							 <select class="form-control"	id="site_list" >
									<?php
									$site_rs = Pwtree_Nodes::getSites($merid);
									 
									 if($site_rs){
											 
											 foreach($site_rs	as $k=>$v){
											 	  if($siteid==$v['id']){
														 echo	"<option value=\"".$v['id']."\" selected>".$v['sitename']."</option>";
														}else{
															echo	"<option value=\"".$v['id']."\">".$v['sitename']."</option>";
														}
													 }
											 }
										?>
									</select>

								</div>

																		<div class="actions">
																				 <input	type="hidden"	id="groupid" value="<?=$groupid?>" />
																				 
																				 <button type="button" class="btn	red" id="savepemid">保存 </a>
																		</div>
																</div>

										<!-- END PAGE	TITLE-->
										<!-- END PAGE	HEADER-->

														<!-- BEGIN SAMPLE	TABLE	PORTLET-->


													 <div	class="portlet-body">
														 <div	id="tree_1111" class="tree-demo">
													 </div>
														 </div>
														<!-- END SAMPLE	TABLE	PORTLET-->

												</div>

											</div>
											 <!--	END	SAMPLE	COL-->
											 <div	class="col-md-4">
													<div class="portlet	light	bordered"	>
																<div class="form-horizontal" >
																		<div class="form-body">
																				 <table	class="table table-hover">
																										<thead>
																												<tr>
																														<th> # </th>
																														<th> User	Name </th>
																														<th> Role	Name </th>
																														<th> View	</th>
																												</tr>
																										</thead>
																										<tbody>
																											<?php		
																											 
																												if($grs['LIST']){
																															foreach($grs['LIST'] as $k=>$v){																																 
                                                         		   echo "<tr>";                                                         		 
                                                         			if ($groupid==$v['gid']){                                                         			 
                                                         		    echo "<td><input type='checkbox'  name=\"gid\" value=\"".$v['gid']."\" checked></td>";
                                                         		   }else{  
                                                         		  	echo "<td><input type='checkbox'  name=\"gid\" value=\"".$v['gid']."\" ></td>";
                                                         		  }
                                                         			echo "<td>".$v['groupname']."</td>";
                                                         			echo "<td><a href='treepreview_group.php?groupid=".$v['gid']."&siteid=".$siteid."'>预览</a></td>";
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
								<!-- END CONTENT BODY	-->
						</div>
						<!-- END CONTENT -->

					 <!--BEGIN MODAL-DIALOG	-->

		 <!--END MODAL-DIALOG	-->

				<!-- END CONTAINER -->
				<!-- BEGIN FOOTER	-->
				<div class="page-footer">
						<div class="page-footer-inner">	2017 &copy;	pwtree.
								<a href="http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes"	title="Purchase	Metronic just	for	27$	and	get	lifetime updates for free" target="_blank">Purchase	Metronic!</a>
						</div>
						<div class="scroll-to-top">
								<i class="icon-arrow-up"></i>
						</div>
				</div>
				<!-- END FOOTER	-->
				<!--[if	lt IE	9]>
<script	src="../assets/global/plugins/respond.min.js"></script>
<script	src="../assets/global/plugins/excanvas.min.js"></script>
<![endif]-->
				<!-- BEGIN CORE	PLUGINS	-->
				<script	src="../assets/global/plugins/jquery.min.js" type="text/javascript"></script>
				<script	src="../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
				<script	src="../assets/global/plugins/js.cookie.min.js"	type="text/javascript"></script>
				<script	src="../assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js"	type="text/javascript"></script>
				<script	src="../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js"	type="text/javascript"></script>
				<script	src="../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
				<script	src="../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
				<!-- END CORE	PLUGINS	-->
				<!-- BEGIN THEME GLOBAL	SCRIPTS	-->
				<script	src="../assets/global/plugins/jstree/dist/jstree.min.js" type="text/javascript"></script>
		<script	src="../assets/global/plugins/bootbox/bootbox.min.js"	type="text/javascript"></script>
				<script	src="../assets/global/scripts/app.min.js"	type="text/javascript"></script>
				<!-- END THEME GLOBAL	SCRIPTS	-->
				<!-- BEGIN THEME LAYOUT	SCRIPTS	-->
				<script	src="../assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
				<script	src="../assets/layouts/global/scripts/quick-sidebar.min.js"	type="text/javascript"></script>
				<script	src="../assets/pages/scripts/ui-tree.min.js" type="text/javascript"></script>
		 <script src="../assets/pages/scripts/ui-bootbox.min.js" type="text/javascript"></script>
				<!-- END THEME LAYOUT	SCRIPTS	-->


<script	type="text/javascript">

	$("#savepemid").click(function(){


				var	useridlist = "";
				$("input[name='userid']").each(function(){
						if($(this).is(":checked"))
						{
								useridlist +=	","	+	$(this).val();
						}
				});
				 pemidlist =$("#tree_1111").jstree().get_checked();
		 console.info(pemidlist.toString());

			 siteid	=	$("#site_list").val();
		 groupid = $("#groupid").val();

		 $.ajax({
						url: "ajax_data/grant_data.php",
						type:	'post',
						data:{"siteid":siteid,"act":"grantpemid","pemidlist":pemidlist.toString(),"groupid":groupid,"rnd": Math.random()},
						dataType:	'json',
						timeout: 1000,
						success: function	(data, status) {
												if(data.STATE==1){
							bootbox.alert({message:	"保存成功!",
											size:	'small'});
						}else{
							bootbox.alert({message:	"保存失败",
											size:	'small'});
						}
						},
						fail:	function (err, status) {
							bootbox.alert({message:	"保存失败!",
										 size: 'small'});
							console.log(err)
						}
					})

		});

$(function() {
	//Siteid = $("#site_list").val();
	$('#tree_1111').jstree({
	'core' : {
			'check_callback':	true,
			"data" : function	(obj,	callback){
							$.ajax({
								url	:	"ajax_data/tree_data.php?siteid="+$("#site_list").val()+"&treetype=tree3&groupid="+$("#groupid").val()+"&rnd="	+	Math.random(),
								dataType : "json",
								type : "POST",
								success	:	function(data) {
									//Console.info(data);
									if(data) {
										callback.call(this,	data);
									}else{
										$("#tree_1111").html("暂无数据！");
									}
								}
							});
					}
				},
				"plugins"	:	[	"checkbox" ]
			}).on("changed.jstree",	function(event,	data)	{

			var	inst = data.instance;

			var	selectedNode = inst.get_node(data.selected);
			console.log(data.selected);


			});
		});


$(":checkbox").change(function ()	{

		if($(this).is(':checked')){
				 console.info( $(this).val());
				$(this).parent().parent().addClass("warning");
		}else{
				$(this).parent().parent().removeClass("warning");
		}
});
/*
function droplistChange(selectid=''){
	var	tree1111 = $.jstree.reference("#tree_1111");
	 tree1111.refresh();

	// tree1111.select_node(selectid);
}*/

$("#site_list").change(function(){
		
	location.href="grantpower_group.php?siteid="+$("#site_list").val()+"&groupid=<?=$groupid?>"
});

</script>

		</body>
</html>

