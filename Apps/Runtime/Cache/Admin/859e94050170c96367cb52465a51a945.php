<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>ApiCloud云端管理平台</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<link rel="stylesheet" type="text/css" href="assets/font-awesome/css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="assets/simple-line-icons/simple-line-icons.min.css" />
<link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="assets/css/login.css" />
<link rel="stylesheet" type="text/css" href="assets/css/components-md.css" />
<link rel="stylesheet" type="text/css" href="assets/uniform/css/uniform.default.css" />
<link rel="stylesheet" type="text/css" href="assets/css/plugins-md.css" />
<link rel="stylesheet" type="text/css" href="assets/css/layout.css" />
<link rel="stylesheet" type="text/css" href="assets/css/default.css" />
<link rel="stylesheet" type="text/css" href="assets/css/custom.css" />

<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
</head>

<body class="page-md page-header-fixed ">
<div class="wrapper">
    <header class="page-header">
        <nav class="navbar mega-menu" role="navigation">
            <div class="container-fluid">
                <div class="clearfix navbar-fixed-top">
	                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
	                    <span class="toggle-icon">
	                        <span class="icon-bar"></span>
	                        <span class="icon-bar"></span>
	                        <span class="icon-bar"></span>
	                    </span>
	                </button>


	                <div class="topbar-actions">
		                <div class="btn-group-img btn-group">
							<button type="button" class="btn btn-sm dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
								<img src="assets/avatar.png" alt="">
							</button>
							<ul class="dropdown-menu-v2" role="menu">
								<li>
									<a href="<?php echo U("Public/logout");?>">退出系统</a>
								</li>
							</ul>
						</div>
					</div>
                </div>
                <div class="nav-collapse collapse navbar-collapse navbar-responsive-collapse">
                    <ul class="nav navbar-nav text-uppercase">
                        <li class="dropdown dropdown-fw open">
                            <a href="javascript:;">数据管理</a>
                           	<ul class="dropdown-menu dropdown-menu-fw">
                                <li>
                                	<a data-pjax data-con="AcForm" href="<?php echo U('AcForm/index');?>">表单设计</a>
                                </li>
                                <?php if(is_array($models)): $i = 0; $__LIST__ = $models;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$m): $mod = ($i % 2 );++$i;?><li>
                                	<a data-pjax href="<?php echo U("AcData/index?model=$m[name]");?>"><?php echo ($m["title"]); ?></a>
                                </li><?php endforeach; endif; else: echo "" ;endif; ?>

                            </ul>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="container-fluid">
    	<div class="page-content">
    		<div data-pjax-container class="row">
                <div class="col-md-6">
	<!-- BEGIN Portlet PORTLET-->
	<div class="portlet light">
		<div class="portlet-title">
			<div class="caption font-dark">
				<span class="caption-subject bold uppercase">Distance</span>
				<span class="caption-helper">distance stats...</span>
			</div>
			<div class="actions">
				<a href="#" class="btn btn-circle btn-default btn-sm">
				<i class="fa fa-pencil"></i> Edit </a>
				<a href="#" class="btn btn-circle btn-default btn-sm">
				<i class="fa fa-plus"></i> Add </a>
				<a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#">
				</a>
			</div>
		</div>
		<div class="portlet-body">
			<div id="CSSAnimationChart" class="CSSAnimationChart"></div>
		</div>
	</div>
	<!-- END PORTLET-->
</div>
<div class="col-md-6">
	<!-- BEGIN PORTLET-->
	<div class="portlet light">
		<div class="portlet-title">
			<div class="caption">
				<span class="caption-subject bold uppercase font-red-sunglo">Map</span>
				<span class="caption-helper">flight stats...</span>
			</div>
			<div class="actions">
				<a class="btn btn-circle btn-icon-only btn-default" href="#">
				<i class="icon-cloud-upload"></i>
				</a>
				<a class="btn btn-circle btn-icon-only btn-default" href="#">
				<i class="icon-wrench"></i>
				</a>
				<a class="btn btn-circle btn-icon-only btn-default" href="#">
				<i class="icon-trash"></i>
				</a>
				<a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#">
				</a>
			</div>
		</div>
		<div class="portlet-body">
			<div id="mapChart" class="mapChart"></div>
		</div>
	</div>
</div>
    		</div>
    	</div>
		<p class="copyright">2015 © ayhome</p>
    </div>
</div>
<a href="#index" class="go2top"><i class="icon-arrow-up"></i></a>

<!--[if lt IE 9]>
<script type="text/javascript" src="assets/js/respond.min.js"></script>
<script type="text/javascript" src="assets/js/excanvas.min.js"></script>
<![endif]-->
<script type="text/javascript" src="assets/nprogress/nprogress.js"></script>
<link rel="stylesheet" type="text/css" href="assets/nprogress/nprogress.css" />
<script type="text/javascript" src="assets/js/jquery.bootstrap-growl.js"></script>
<script type="text/javascript" src="assets/js/bootstrap-dialog.js"></script>
<script type="text/javascript" src="assets/jquery-bsgrid/js/grid.all.js"></script>
<script type="text/javascript" src="assets/jquery-bsgrid/js/lang/grid.zh-CN.js"></script>
<link rel="stylesheet" type="text/css" href="assets/jquery-bsgrid/css/grid.css" />

<script type="text/javascript" src="assets/js/bootstrap-confirmation.js"></script>

<script type="text/javascript" src="assets/editable/js/bootstrap-editable.js"></script>
<script type="text/javascript" src="assets/editable/moment.min.js"></script>
<link rel="stylesheet" type="text/css" href="assets/editable/css/bootstrap-editable.css" />


<script type="text/javascript" src="assets/js/jquery.slimscroll.min.js"></script>
<script type="text/javascript" src="assets/uniform/jquery.uniform.min.js"></script>
<script type="text/javascript" src="assets/js/jquery.pjax.js"></script>
<script type="text/javascript" src="assets/js/metronic.js"></script>
<script type="text/javascript" src="assets/js/layout.js"></script>
<script>
$(document).ready(function() {
	if ($.support.pjax) {
		$('a[data-pjax]').on('click', function(event) {
	    	var container = $('[data-pjax-container]');
	    	$.pjax.click(event, {container: container});
	  	})
	}
   	Metronic.init();
   	Layout.init();

   	var con = "<?php echo ($con); ?>";
   	var ac = $('a[data-con='+con+']');
   	if (ac.length > 0) {
   		ac.parent().addClass('active');
   		ac.parent().parent().parent().addClass('selected open');
   	};

});
</script>
</body>
</html>