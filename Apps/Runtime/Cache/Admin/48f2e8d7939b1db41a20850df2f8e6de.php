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
                            <a href="javascript:;">数据云</a>
                           	<ul class="dropdown-menu dropdown-menu-fw">
                                <?php if(is_array($models)): $i = 0; $__LIST__ = $models;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$m): $mod = ($i % 2 );++$i;?><li>
                                  <a data-pjax href="<?php echo U("AcData/index?model=$m[name]");?>"><?php echo ($m["title"]); ?></a>
                                </li><?php endforeach; endif; else: echo "" ;endif; ?>
                                <li>
                                	<a data-pjax data-con="AcForm" href="<?php echo U('AcFile/index');?>">文件管理</a>
                                </li>
                                <li>
                                	<a data-pjax data-con="AcForm" href="<?php echo U('AcForm/index');?>">表单设计</a>
                                </li>

                                <li>
                                	<a data-pjax data-con="AcForm" href="<?php echo U('User/index');?>">后台登陆用户</a>
                                </li>
                                <li>
                                	<a data-pjax data-con="AcForm" href="<?php echo U('AcUser/index');?>">App用户</a>
                                </li>
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
                <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
                    <div class="portlet box blue-hoki">
                        <div class="portlet-title ">
                        <span class="caption">修改数据</span>
                    </div>
                        <div class="portlet-body no-padding">
                            <form method="post" submit-ajax action="<?php echo ($updateUrl); ?>">
<input type="hidden" name="id" value="<?php echo ($vo["id"]); ?>">
<input type="hidden" name="model" value="<?php echo ($model); ?>">
<table class="table table-bordered">
    <?php if(is_array($cm[fields])): $i = 0; $__LIST__ = $cm[fields];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$f): $mod = ($i % 2 );++$i;?><tr >
        <?php if(!in_array(($f[name]), explode(',',"id"))): if(($f[showAdd]) == "1"): ?><td width="180" style="text-align:right"><?php echo ($f["label"]); ?></td>
            <td >
            <?php echo ipt($f,$vo[$f['name']]);?>
            </td><?php endif; endif; ?>
    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    <tr>
        <td colspan="2">
        <button class="btn btn-primary" type="submit">保存</button>
    <a class="btn btn-default" href="<?php echo U("AcData/index?model=$model");?>">取消</a>
        </td>
    </tr>
</table>

</form>
                        </div>
                    </div>
                </div>

<script type="text/javascript">
var dialog;
var fileName = '';
$(function(){
    UM.getEditor('umeditor');

    var box = $('<div style="max-height:500px;overflow-y: auto;" class="row"></div>');
    var url = "<?php echo U('AcFile/upfile');?>";
    dialog = new BootstrapDialog({
        message: '',
        size:'size-wide',
        title:'文件上传',
        buttons: [{
            label: '首页',
            cssClass: 'blue',
            action: function(dg) {
                var obj = dg.getModalBody();
                obj.find('.frist').click();
            }
        },{
            label: '上一页',
            cssClass: 'blue',
            action: function(dg) {
                var obj = dg.getModalBody();
                obj.find('.prep').click();
            }
        },{
            label: '下一页',
            cssClass: 'blue',
            action: function(dg) {
                var obj = dg.getModalBody();
                obj.find('.next').click();
            }
        },{
            label: '取消',
            action: function(dialogRef){
                dialogRef.close();
            }
        }]
    });
    $('.btn-file').on('click',function(event){
        event.preventDefault();
        box.load(url,function(req){
            dialog.setMessage($(req));
            dialog.open();
        });
        fileName = $(this).data('file-name');
    })

    $('.btn-file-pre').on('click',function(event){
        event.preventDefault();
        var f = $(this).data('file-name');
        var src = $('[name='+f+'_ipt]').val();
        if (!src) {
            $.bootstrapGrowl('还没有选择文件');
        }else {
            BootstrapDialog.show({
                message: $('<img src>').attr('src',src),
            });
        }
    })
})

function selectFiled(url,id,name) {
    dialog.close();
    $('[name='+fileName+'_ipt]').val(url);
    $('.'+fileName+'_url').val(url);
    $('.'+fileName+'_id').val(id);
    $('.'+fileName+'_name').val(name);
    return false;
}

</script>

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

<link rel="stylesheet" type="text/css" href="assets/fileinput/css/fileinput.css" />
<script type="text/javascript" src="assets/fileinput/js/fileinput.js"></script>
<script type="text/javascript" src="assets/fileinput/js/fileinput_locale_chs.js"></script>

<script type="text/javascript" src="assets/js/arttemplate.js"></script>

<script type="text/javascript" src="assets/js/bootstrap-confirmation.js"></script>

<script type="text/javascript" src="assets/editable/js/bootstrap-editable.js"></script>
<script type="text/javascript" src="assets/editable/moment.min.js"></script>
<link rel="stylesheet" type="text/css" href="assets/editable/css/bootstrap-editable.css" />

<script type="text/javascript" src="assets/umeditor/umeditor.config.js"></script>
<script type="text/javascript" src="assets/umeditor/umeditor.min.js"></script>
<script type="text/javascript" src="assets/umeditor/lang/zh-cn/zh-cn.js"></script>
<link rel="stylesheet" type="text/css" href="assets/umeditor/themes/default/css/umeditor.css" />



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