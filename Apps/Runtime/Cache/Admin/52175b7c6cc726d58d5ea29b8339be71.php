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
                        <span class="caption">表单字段创建说明</span>
                    </div>
                        <div class="portlet-body">
                            1.默认情况下AcAdmin能自动创建ApiCloud对象现在有的字段
    2.如果ApiCloud对象内容为空则获取不了字段,需要手动添加
	3.表单设计完成后,请生成表单.
	<p>
		使用前请先创建ApiCloud对象<br />
		<code>
			对象名:ac_model
			字段:
			name,title,fields,cache;
		</code>
	</p>
                        </div>
                    </div>
                </div>

<div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
                    <div class="portlet box blue-hoki">
                        <div class="portlet-title ">
                        <span class="caption"><?php echo ($name); ?>,字段列表</span><div id='gridObj-action' class="actions"><a data-pjax class="btn blue" href="<?php echo U('AcForm/index');?>">返回</a>
        <a ajax-dialog class="btn blue" href="<?php echo ($addUrl); ?>&id=<?php echo ($id); ?>">新增字段</a>
        <a data-ajax class="btn blue" href="<?php echo U('AcFormField/create');?>&id=<?php echo ($id); ?>">生成表单</a></div>
                    </div>
                        <div class="portlet-body">
                            
	<div class="table-scrollable">
		<table id="gridObj" class="table table-striped table-bordered table-advance table-hover">
			<thead>
                <th w_index="name">字段名称</th>
                <th w_index="label">标签</th>
                <th w_index="type">表单类型</th>
    			<th w_index="actype">ApiCloud对象类型</th>
                <th w_index="showList">列表页显示</th>
                <th w_index="showAdd">新增页显示</th>
                <th w_index="showEdit">修改页显示</th>
    			<th ></th>
            </thead>
            <tbody>
            <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr>
                    <td><?php echo ($v["name"]); ?></td>
                    <td><a data-editable data-name="label" data-value="<?php echo ($v["label"]); ?>" data-pk="<?php echo ($v["name"]); ?>" href="#"><?php echo ($v["label"]); ?></a></td>
                    <td><a data-type="select" data-editable-ipttype data-name="type" data-value="<?php echo ($v["type"]); ?>" data-pk="<?php echo ($v["name"]); ?>" href="#"></a> </td>
                    <td><a data-type="select" data-editable-actype data-name="actype" data-value="<?php echo ($v["actype"]); ?>" data-pk="<?php echo ($v["name"]); ?>" href="#"></a> </td>

                    <td><a data-type="select" data-editable-isshow data-name="showList" data-value="<?php echo ($v["showList"]); ?>" data-pk="<?php echo ($v["name"]); ?>" href="#"></a></td>
                    <td><a data-type="select" data-editable-isshow data-name="showAdd" data-value="<?php echo ($v["showAdd"]); ?>" data-pk="<?php echo ($v["name"]); ?>" href="#"></a></td>
                    <td><a data-type="select" data-editable-isshow data-name="showEdit" data-value="<?php echo ($v["showEdit"]); ?>" data-pk="<?php echo ($v["name"]); ?>" href="#"></a></td>
                    <td>
                        <a data-delete class="btn btn-xs red" href="<?php echo U("AcFormField/delete?name=$v[name]&id=$id");?>">删除</a>
                    </td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>

		</table>
	</div>
                        </div>
                    </div>
                </div>
<script type="text/javascript">
$(function(){
    $.fn.editable.defaults.url = "<?php echo U('AcFormField/updateField');?>&mName=<?php echo ($mName); ?>";
    $('[data-editable]').editable();

    $('[data-editable-isshow]').editable({
        prepend: "隐藏",
        source: [
            {value: '1', text: '显示'},
            {value: '0', text: '隐藏'},
        ]
    });

    $('[data-delete]').confirmation({
        container: 'body',
        href:false,
        onConfirm:function(event, element){
            event.preventDefault();
            el  = $(element);
            var url = el.attr('href');
            $.get(url,function(req){
                $.bootstrapGrowl(req.info);
                var st = req.status;
                $.pjax.reload('[data-pjax-container]');
            })
        }
    });


    $('[data-editable-ipttype]').editable({
        prepend: "请选择",
        source: [
            {value: 'text', text: 'text'},
            {value: 'select', text: 'select'},
            {value: 'date', text: 'date'},
            {value: 'time', text: 'time'},
            {value: 'datetime', text: 'datetime'},
            {value: 'hidden', text: 'hidden'},
            {value: 'textarea', text: 'textarea'},
            {value: 'editor', text: 'editor'},
            {value: 'file', text: 'file'},
        ]
    });

    $('[data-editable-actype]').editable({
        prepend: "请选择",
        source: [
            {value: 'String', text: 'String'},
            {value: 'Number', text: 'Number'},
            {value: 'Boolean', text: 'Boolean'},
            {value: 'Date', text: 'Date'},
            {value: 'File', text: 'File'},
            {value: 'Array', text: 'Array'},
            {value: 'Object', text: 'Object'},
            {value: 'GeoPoint', text: 'GeoPoint'},
            {value: 'Pointer', text: 'Pointer'},
            {value: 'Relation', text: 'Relation'},
        ]
    });
})
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