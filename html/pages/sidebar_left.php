<?php


?>
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

												<li	class="nav-item	<?=(in_array(basename($_SERVER["SCRIPT_NAME"]),array("sites.php","treelist.php","treemanage.php"))?" active open":" start")?>	">
														<a href="javascript:;" class="nav-link nav-toggle">
																<i class="icon-home"></i>
																<span	class="title">目录树管理</span>
																<span	class="arrow open"></span>
														</a>
														<ul	class="sub-menu">
																<li	class="nav-item		 <?=(basename($_SERVER["SCRIPT_NAME"])=="sites.php")?"active open":"" ?>">
																		<a href="sites.php"	class="nav-link	">
																				<i class="icon-bar-chart"></i>
																				<span	class="title">添加新站点</span>
																		</a>
																</li>
																<li	class="nav-item		 <?=(basename($_SERVER["SCRIPT_NAME"])=="treelist.php")?"active open":"" ?>">
																		<a href="treelist.php"	class="nav-link	">
																				<i class="icon-bar-chart"></i>
																				<span	class="title">站点列表</span>
																		</a>
																</li>																
																<li	class="nav-item	 <?=(basename($_SERVER["SCRIPT_NAME"])=="treemanage.php")?"active open":"" ?>">
																		<a href="treemanage.php"	class="nav-link	">
																				<i class="icon-graph"></i>
																				<span	class="title">添加权限ID</span>
																		</a>
																</li>
														</ul>
												</li>
											<li	class="nav-item	<?=(in_array(basename($_SERVER["SCRIPT_NAME"]),array("grantpower_user.php",
											                                                                      "treepreview_user.php",
																												  "adduserinfo.php",
																												  "userinfo.php",
																												  "grouplist.php",
																												  "grantpower_group.php",
																												  "treepreview_group.php",
																												  "dept.php","user_togroup.php"))?" active open":"start")?>	">
														<a href="javascript:;" class="nav-link nav-toggle">
																<i class="icon-user"></i>
																<span	class="title">用户与角色管理</span>
												<span	class="selected"></span>
																<span	class="arrow open"></span>
														</a>
														<ul	class="sub-menu">
																<li	class="nav-item	 <?=(basename($_SERVER["SCRIPT_NAME"])=="adduserinfo.php")?"active open":"" ?>">
																		<a href="adduserinfo.php"	class="nav-link	">
																				<i class="icon-bar-chart"></i>
																				<span	class="title">添加新用户</span>
																		</a>
																</li>

								             <li	class="nav-item	<?=(basename($_SERVER["SCRIPT_NAME"])=="userinfo.php")?"active open":"" ?>">
																		<a href="userinfo.php"	class="nav-link	">
																				<i class="icon-bar-chart"></i>
																				<span	class="title">用户列表</span>
																		</a>
																</li>

																<li	class="nav-item	 <?=(in_array(basename($_SERVER["SCRIPT_NAME"]),array("grantpower_user.php","treepreview_user.php"))?"active open":"") ?>">
																		<a href="grantpower_user.php"	class="nav-link	">
																				<i class="icon-bulb"></i>
																				<span	class="title">用户授权</span>
																		</a>
																</li>
																<li	class="nav-item	 <?=(in_array(basename($_SERVER["SCRIPT_NAME"]),array("grantpower_group.php","grouplist.php","treepreview_group.php"))?"active open":"") ?>">
																		<a href="grouplist.php"	class="nav-link	">
																				<i class="icon-bulb"></i>
																				<span	class="title">角色管理</span>
																		</a>
																</li>	
																<li	class="nav-item	 <?=(basename($_SERVER["SCRIPT_NAME"])=="dept.php")?"active open":"" ?>">
																		<a href="dept.php"	class="nav-link	">
																				<i class="icon-graph"></i>
																				<span	class="title">部门管理</span>
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