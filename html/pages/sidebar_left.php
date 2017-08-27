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

								             <li	class="nav-item	<?=(basename($_SERVER["SCRIPT_NAME"])=="userinfo.php")?"active open":"" ?>">
																		<a href="userinfo.php"	class="nav-link	">
																				<i class="icon-bar-chart"></i>
																				<span	class="title">用户列表</span>
																		</a>
																</li>

																<li	class="nav-item	 <?=(basename($_SERVER["SCRIPT_NAME"])=="grouplist.php")?"active open":"" ?>">
																		<a href="grouplist.php"	class="nav-link	">
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