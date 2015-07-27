<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>ApiCloud云端管理平台</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description"/>
<meta content="" name="author"/>
<link rel="stylesheet" type="text/css" href="assets/font-awesome/css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="assets/simple-line-icons/simple-line-icons.min.css" />
<link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="assets/css/login.css" />
<link rel="stylesheet" type="text/css" href="assets/css/components-md.css" />
<link rel="stylesheet" type="text/css" href="assets/uniform/css/uniform.default.css" />
<link rel="stylesheet" type="text/css" href="assets/css/plugins-md.css" />


<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>

</head>
<body class="page-md login">
<div class="menu-toggler sidebar-toggler">
</div>
<div class="logo">
	<a href="index.html">
	<img src="assets/img/logo-big.png" alt=""/>
	</a>
</div>
<div class="content">
	<form class="login-form" action="<?php echo U('Public/ckLogin');?>" method="post">
		<h3 class="form-title">用户登录</h3>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">登录账号</label>
			<input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="登录账号" name="account"/>
		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">登录密码</label>
			<input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="登录密码" name="password"/>
		</div>
		<div class="form-actions">
			<button type="submit" class="btn btn-success uppercase">登录</button>
			<label class="rememberme check">
			<input type="checkbox" name="remember" value="1"/>保持登录</label>
			<a href="javascript:;" id="forget-password" class="forget-password">忘记密码?自己想办法</a>
		</div>
		<div class="create-account">
			<p>
				QQ 讨论群:196578969,
				<a href="https://git.oschina.net/anyhome/AcAdmin">主页</a>
			</p>
		</div>
	</form>
</div>
<div class="copyright">
	 2015 © 本程序由<a href="mailto:ayhome@foxmail.com">ayhome</a>强力驱动.
</div>
<!--[if lt IE 9]>
<load href="assets/js/respond.min.js"></script>
<load href="assets/js/excanvas.min.js"></script>
<![endif]-->
<script type="text/javascript" src="assets/js/bootstrap-confirmation.js"></script>
<script type="text/javascript" src="assets/nprogress/nprogress.js"></script>
<link rel="stylesheet" type="text/css" href="assets/nprogress/nprogress.css" />
<script type="text/javascript" src="assets/js/jquery.bootstrap-growl.js"></script>
<script type="text/javascript" src="assets/js/bootstrap-dialog.js"></script>

<script type="text/javascript" src="assets/uniform/jquery.uniform.min.js"></script>
<script type="text/javascript" src="assets/js/jquery.pjax.js"></script>
<script type="text/javascript" src="assets/js/metronic.js"></script>
<script type="text/javascript" src="assets/js/layout.js"></script>
<script>
jQuery(document).ready(function() {

	$(document).on('submit','form',function(){
        var f = $(this);
        var url = f.attr('action');
        NProgress.start();
        var data = f.serialize();
        $.post(url,data,function(req){
            $.bootstrapGrowl(req.info);
            NProgress.done();
            var st = req.status;
            if (st == 1) {
				window.location.href = 'index.php';
            }
        })
        return false;
    })
});
</script>
</body>
</html>