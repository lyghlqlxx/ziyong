<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en-us" id="extr-page">
<head>
<meta charset="utf-8">
<title>ApiCloud云端后台管理平台</title>
<meta name="description" content="AcAdmin,ApiCloud,ApiCloud云端,ApiCloud云端后台管理平台">
<meta name="author" content="ayhome,ayhome@foxamil.com">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="assets/css/smartadmin-production-plugins.min.css" />
<link rel="stylesheet" type="text/css" href="assets/css/smartadmin-production.min.css" />
<link rel="stylesheet" type="text/css" href="assets/css/smartadmin-skins.min.css" />
<link rel="stylesheet" type="text/css" href="assets/css/smartadmin-rtl.min.css" />
<link rel="stylesheet" type="text/css" href="assets/css/demo.min.css" />
</head>

<body class="animated fadeInDown">
<header id="header">
	<div id="logo-group">
		<span id="logo"> <h4>AcAdmin</h4> </span>
	</div>
</header>

<div id="main" role="main">
	<div id="content" class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-7 col-lg-8 hidden-xs hidden-sm">
				<h1 class="txt-color-red login-header-big">ApiCloud云端管理平台</h1>
				<div class="hero">

					<div class="pull-left login-desc-box-l">
						<h4 class="paragraph-header">基于ThinkPHP 3.2.3 开发的用于管理ApiCloud云端数据的可视化
                            管理平台，可以帮助管理数据云、统计云、推送云。
                            <br />QQ 讨论群:196578969
                        </h4>
						<div class="login-app-icons">
							<a href="#" class="btn btn-danger btn-sm">了解更多</a>
                            <a href="#" class="btn btn-danger btn-sm">下载安装</a>
						</div>
					</div>

					<img src="img/demo/iphoneview.png" class="pull-right display-image" alt="" style="width:210px">

				</div>

				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						<h5 class="about-heading"> 收费吗 ?</h5>
						<p>
							AcAdmin完全免费，并且开源提供下载，方向使用。
						</p>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						<h5 class="about-heading">赞助我 ?</h5>
						<p>
							如果您有能力请赞助小弟一下，生活艰难，需要动力。
						</p>
					</div>
				</div>

			</div>
			<div class="col-xs-12 col-sm-12 col-md-5 col-lg-4">
				<div class="well no-padding">
					<form data-ajax action="<?php echo U('Public/ckLogin');?>" method="post" id="login-form" class="smart-form client-form">
						<header>用户登陆</header>
						<fieldset>
							<section>
								<label class="label">登陆账号</label>
								<label class="input"> <i class="icon-append fa fa-user"></i>
									<input required type="text" name="account">
									<b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> 请输入登陆账号</b></label>
							</section>
							<section>
								<label class="label">登陆密码</label>
								<label class="input"> <i class="icon-append fa fa-lock"></i>
									<input required type="password" name="password">
									<b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i> 请输入登陆密码</b> </label>
								<div class="note">
									<a href="#">忘记密码？我也没有记住，要不...您再想想。</a>
								</div>
							</section>

							<section>
								<label class="checkbox">
									<input type="checkbox" name="remember" checked="">
									<i></i>保存登陆</label>
							</section>
						</fieldset>
						<footer>
							<button type="submit" class="btn btn-primary">
								登陆
							</button>
						</footer>
					</form>

				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="assets/js/libs/jquery-2.1.1.min.js"></script>
<script>
	if (!window.jQuery) {
		document.write('<load href="assets/assets/js/libs/jquery-2.1.1.min.js"><\/script>');
	}
</script>

<script type="text/javascript" src="assets/js/libs/jquery-ui-1.10.3.min.js"></script>
<script>
	if (!window.jQuery.ui) {
		document.write('<load href="assets/assets/js/libs/jquery-ui-1.10.3.min.js"><\/script>');
	}
</script>
<script type="text/javascript" src="assets/js/plugin/pace/pace.min.js"></script>
<script type="text/javascript" src="assets/js/app.config.js"></script>
<script type="text/javascript" src="assets/js/bootstrap/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/plugin/jquery-validate/jquery.validate.min.js"></script>
<script type="text/javascript" src="assets/js/plugin/masked-input/jquery.maskedinput.min.js"></script>
<script type="text/javascript" src="assets/js/notification/SmartNotification.min.js"></script>

<script type="text/javascript" src="assets/js/app.min.js"></script>

<script type="text/javascript">
runAllForms();
$(function() {
	$("#login-form").validate();

    $(document).on('submit','[data-ajax]',function(e){
        e.preventDefault();
        var $form = $(this);
        var url = $form.attr('action');
        var form_data = $form.triggerHandler('submitForm');
        if ( form_data || typeof form_data == "undefined") {


            var post_data = $form.serialize();
            $.post(url,post_data,function(req){
                if (req['info']) {

                    $.smallBox({
						title : '提示',
                		content : req['info'],
                		color : "#C79121",
                		iconSmall : "fa fa-info",
                		timeout : 5000
                	});
                }

                if (req['status'] == '1' && req['url']) {
                    window.location.href = req['url'];
                };
            })
        }
    })
});
</script>


</body>
</html>