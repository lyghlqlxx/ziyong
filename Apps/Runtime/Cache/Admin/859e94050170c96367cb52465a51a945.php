<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en-us">
	<head>
		<meta charset="utf-8">
		<title>ApiCloud云端后台 - AcAdmin </title>
		<meta name="description" content="ApiCloud云端后台,AcAdmin">
		<meta name="author" content="ayhome@foxmail.com">

		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css" />

		<link rel="stylesheet" type="text/css" href="assets/css/smartadmin-production-plugins.min.css" />
		<link rel="stylesheet" type="text/css" href="assets/css/smartadmin-production.min.css" />
		<link rel="stylesheet" type="text/css" href="assets/css/smartadmin-skins.min.css" />

		<link rel="stylesheet" type="text/css" href="assets/css/smartadmin-rtl.min.css" />

		<link rel="stylesheet" type="text/css" href="assets/css/demo.min.css" />
		<link rel="stylesheet" type="text/css" href="assets/js/nprogress/nprogress.css" />

		<script type="text/javascript" src="assets/js/libs/jquery-2.1.1.min.js"></script>
		<script>
			if (!window.jQuery) {
				document.write('<load href="assets/js/libs/jquery-2.1.1.min.js"><\/script>');
			}
		</script>

		<script type="text/javascript" src="assets/js/libs/jquery-ui-1.10.3.min.js"></script>
		<script>
			if (!window.jQuery.ui) {
				document.write('<load href="assets/js/libs/jquery-ui-1.10.3.min.js"><\/script>');
			}
		</script>

	</head>

	<body class="smart-style-4 fixed-header ">
		<header id="header">
			<div id="logo-group">
				<span id="logo">ApiCloud云端后台</span>

			    <span id="activity" class="activity-dropdown"> <i class="fa fa-user"></i> </span>

				<!-- AJAX-DROPDOWN : control this dropdown height, look and feel from the LESS variable file -->
				<div class="ajax-dropdown">

					<!-- the ID links are fetched via AJAX to the ajax container "ajax-notifications" -->
					<div class="btn-group btn-group-justified" data-toggle="buttons">
						<label class="btn btn-default">
							<input type="radio" name="activity" id="ajax/notify/mail.html">
							Msgs (14) </label>
						<label class="btn btn-default">
							<input type="radio" name="activity" id="ajax/notify/notifications.html">
							notify (3) </label>
						<label class="btn btn-default">
							<input type="radio" name="activity" id="ajax/notify/tasks.html">
							Tasks (4) </label>
					</div>

					<!-- notification content -->
					<div class="ajax-notifications custom-scroll">

						<div class="alert alert-transparent">
							<h4>Click a button to show messages here</h4>
							This blank page message helps protect your privacy, or you can show the first message here automatically.
						</div>

						<i class="fa fa-lock fa-4x fa-border"></i>

					</div>
					<!-- end notification content -->

					<!-- footer: refresh area -->
					<span> Last updated on: 12/12/2013 9:43AM
						<button type="button" data-loading-text="<i class='fa fa-refresh fa-spin'></i> Loading..." class="btn btn-xs btn-default pull-right">
							<i class="fa fa-refresh"></i>
						</button> </span>
					<!-- end footer -->

				</div>
				<!-- END AJAX-DROPDOWN -->
			</div>

			<!-- #PROJECTS: projects dropdown -->
			<div class="project-context hidden-xs">

				<span class="label">所有应用:</span>
				<span class="project-selector dropdown-toggle" data-toggle="dropdown">当前应用<i class="fa fa-angle-down"></i></span>

				<!-- Suggestion: populate this list with fetch and push technique -->
				<ul class="dropdown-menu">
					<li>
						<a href="javascript:void(0);">Online e-merchant management system - attaching integration with the iOS</a>
					</li>
					<li class="divider"></li>
                    <li>
						<a href="javascript:void(0);">Online e-merchant management system - attaching integration with the iOS</a>
					</li>
				</ul>
				<!-- end dropdown-menu-->

			</div>
			<!-- end projects dropdown -->

			<div class="pull-right">

				<div id="hide-menu" class="btn-header pull-right">
					<span> <a href="javascript:void(0);" data-action="toggleMenu" title="Collapse Menu"><i class="fa fa-reorder"></i></a> </span>
				</div>

				<div id="logout" class="btn-header transparent pull-right">
					<span> <a href="<?php echo U('Public/logout');?>" title="退出" data-action="userLogout" data-logout-msg="退出系统后将跳转到登陆页面"><i class="fa fa-sign-out"></i></a> </span>
				</div>

				<div id="search-mobile" class="btn-header transparent pull-right">
					<span> <a href="javascript:void(0)" title="Search"><i class="fa fa-search"></i></a> </span>
				</div>
			</div>
		</header>
		<!-- END HEADER -->

		<!-- #NAVIGATION -->
		<!-- Left panel : Navigation area -->
		<!-- Note: This width of the aside area can be adjusted through LESS/SASS variables -->
		<aside id="left-panel">

			<!-- User info -->
			<div class="login-info">
				<span> <!-- User image size is adjusted inside CSS, it should stay as is -->

					<a href="javascript:void(0);" id="show-shortcut" data-action="toggleShortcut">
						<img src="assets/img/avatars/sunny.png" class="online" />
						<span>管理员</span>
						<i class="fa fa-angle-down"></i>
					</a>

				</span>
			</div>
			<!-- end user info -->

			<!-- NAVIGATION : This navigation is also responsive

			To make this navigation dynamic please make sure to link the node
			(the reference to the nav > ul) after page load. Or the navigation
			will not initialize.
			-->
			<nav>
				<!--
				NOTE: Notice the gaps after each icon usage <i></i>..
				Please note that these links work a bit different than
				traditional href="" links. See documentation for details.
				-->

				<ul>
                    <?php if(($uid) == "1"): ?><li>
						<a href="#"><i class="fa fa-lg fa-fw fa-sitemap"></i> <span class="menu-item-parent">项目初始化</span></a>
						<ul>
							<li>
								<a href="<?php echo U('Admin/index');?>">项目管理</a>
							</li>
							<li>
								<a href="#"><i class="fa fa-lg fa-fw fa-sitemap"></i> <span class="menu-item-parent">模型设计</span></a>
								<ul>
									<?php if(is_array($models)): $i = 0; $__LIST__ = $models;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$m): $mod = ($i % 2 );++$i;?><li>
										<a href="<?php echo U("Admin/design?name=$m[name]");?>"><?php echo ($m["title"]); ?></a>
									</li><?php endforeach; endif; else: echo "" ;endif; ?>
								</ul>			
							</li>
						</ul>
					</li><?php endif; ?>
                    <?php if(is_array($models)): $i = 0; $__LIST__ = $models;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$m): $mod = ($i % 2 );++$i;?><li>
							<a href="<?php echo U(ucfirst($m[name])."/index");?>"><i class="fa fa-lg fa-fw fa-reorder"></i><span class="menu-item-parent"><?php echo ($m["title"]); ?></span></a>
						</li><?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
			</nav>
			<span class="minifyme" data-action="minifyMenu"> <i class="fa fa-arrow-circle-left hit"></i> </span>

		</aside>
		<div id="main" role="main">

			<!-- RIBBON -->
			<div id="ribbon">

				<span class="ribbon-button-alignment">
					<span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh" rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your widget settings." data-html="true" data-reset-msg="Would you like to RESET all your saved widgets and clear LocalStorage?"><i class="fa fa-refresh"></i></span>
				</span>

				<!-- breadcrumb -->
				<ol class="breadcrumb">
					<!-- This is auto generated -->
				</ol>
				<!-- end breadcrumb -->

				<!-- You can also add more buttons to the
				ribbon for further usability

				Example below:

				<span class="ribbon-button-alignment pull-right" style="margin-right:25px">
					<a href="#" id="search" class="btn btn-ribbon hidden-xs" data-title="search"><i class="fa fa-grid"></i> Change Grid</a>
					<span id="add" class="btn btn-ribbon hidden-xs" data-title="add"><i class="fa fa-plus"></i> Add</span>
					<button id="search" class="btn btn-ribbon" data-title="search"><i class="fa fa-search"></i> <span class="hidden-mobile">Search</span></button>
				</span> -->

			</div>
			<div id="content">
                
			</div>
		</div>
		<div class="page-footer">
			<div class="row">
				<div class="col-xs-12 col-sm-6">
					<span class="txt-color-white">AcAdmin 0.1 <span class="hidden-xs"> - ayhome 强力支持</span> © 2015 -</span>
					<a href="">项目地址</a>
				</div>
			</div>
		</div>

		<div id="shortcut">
			<ul>
				<li>
					<a href="#ajax/inbox.html" class="jarvismetro-tile big-cubes bg-color-blue"> <span class="iconbox"> <i class="fa fa-envelope fa-4x"></i> <span>Mail <span class="label pull-right bg-color-darken">14</span></span> </span> </a>
				</li>
				<li>
					<a href="#ajax/calendar2.html" class="jarvismetro-tile big-cubes bg-color-orangeDark"> <span class="iconbox"> <i class="fa fa-calendar fa-4x"></i> <span>Calendar</span> </span> </a>
				</li>
				<li>
					<a href="#ajax/gmap-xml.html" class="jarvismetro-tile big-cubes bg-color-purple"> <span class="iconbox"> <i class="fa fa-map-marker fa-4x"></i> <span>Maps</span> </span> </a>
				</li>
				<li>
					<a href="#ajax/invoice.html" class="jarvismetro-tile big-cubes bg-color-blueDark"> <span class="iconbox"> <i class="fa fa-book fa-4x"></i> <span>Invoice <span class="label pull-right bg-color-darken">99</span></span> </span> </a>
				</li>
				<li>
					<a href="#ajax/gallery.html" class="jarvismetro-tile big-cubes bg-color-greenLight"> <span class="iconbox"> <i class="fa fa-picture-o fa-4x"></i> <span>Gallery </span> </span> </a>
				</li>
				<li>
					<a href="#ajax/profile.html" class="jarvismetro-tile big-cubes selected bg-color-pinkDark"> <span class="iconbox"> <i class="fa fa-user fa-4x"></i> <span>My Profile </span> </span> </a>
				</li>
			</ul>
		</div>



		<script type="text/javascript" src="assets/js/app.config.js"></script>
		<script type="text/javascript" src="assets/js/plugin/jquery-touch/jquery.ui.touch-punch.min.js"></script>
		<script type="text/javascript" src="assets/js/bootstrap/bootstrap.min.js"></script>
		<script type="text/javascript" src="assets/js/notification/SmartNotification.min.js"></script>
		<script type="text/javascript" src="assets/js/smartwidgets/jarvis.widget.min.js"></script>
		<script type="text/javascript" src="assets/js/plugin/jquery-validate/jquery.validate.min.js"></script>
		<script type="text/javascript" src="assets/js/plugin/masked-input/jquery.maskedinput.min.js"></script>
		<script type="text/javascript" src="assets/js/plugin/select2/select2.min.js"></script>
		<script type="text/javascript" src="assets/js/plugin/bootstrap-slider/bootstrap-slider.min.js"></script>
		<script type="text/javascript" src="assets/js/plugin/msie-fix/jquery.mb.browser.min.js"></script>
		<script type="text/javascript" src="assets/js/plugin/fastclick/fastclick.min.js"></script>

		<script type="text/javascript" src="assets/js/nprogress/nprogress.js"></script>
		<script type="text/javascript" src="assets/js/jquery.bootstrap-growl.js"></script>

		<script type="text/javascript" src="assets/js/bootstrap-confirmation.js"></script>
		<script type="text/javascript" src="assets/js/bootstrap-dialog.js"></script>
		
		<script type="text/javascript" src="assets/js/app.min.js"></script>
		<script type="text/javascript" src="assets/js/tp.js"></script>

	</body>

</html>