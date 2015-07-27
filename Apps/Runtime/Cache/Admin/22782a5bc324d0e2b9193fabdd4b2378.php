<?php if (!defined('THINK_PATH')) exit();?><div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
                    <div class="portlet box blue-hoki">
                        <div class="portlet-title ">
                        <span class="caption">表单说明</span>
                    </div>
                        <div class="portlet-body">
                            <ol>
		<li>每个表单对应一个ApiCloud的对象</li>
		<li>表单名称就是ApiCloud的class name,必须为全英文</li>
		<li>表单标题请使用中文</li>
	</ol>
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

<div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
                    <div class="portlet box blue-hoki">
                        <div class="portlet-title ">
                        <span class="caption">表单列表</span><div id='gridObj-action' class="actions"><a ajax-dialog class="btn blue" href="<?php echo ($addUrl); ?>">新建</a>
		<a grid-btn data-pjax class="btn blue disabled" href="<?php echo U("AcFormField/index");?>">字段设计</a>
		<a grid-btn ajax-dialog class="btn blue disabled" href="<?php echo ($editUrl); ?>">修改</a>
		<a grid-btn data-ajax class="btn red disabled" href="<?php echo ($delUrl); ?>">删除</a></div>
                    </div>
                        <div class="portlet-body">
                            
	<div class="table-scrollable">
		<table id="gridObj" class="table table-striped table-bordered table-advance table-hover">
			<th w_index="id">id</th>
			<th w_index="name">表单名称</th>
			<th w_index="title">表单标题</th>
		</table>
	</div>
	<div id="gridObj-pager"></div>
                        </div>
                    </div>
                </div>
<script type="text/javascript">
var gridObj;
$(function(){
	var pageSize = 10;
	if (!pageSize) pageSize = 10
	gridObj = $.fn.bsgrid.init('gridObj', {
		url: window.location.href,
    	pageSize: pageSize,
    	// autoLoad:false,
    	displayBlankRows:false,
    	event: {
            selectRowEvent: function (record, rowIndex, trObj, options) {
            	//
            	var id = gridObj.getRecordIndexValue(record, 'id');
            	$('#gridObj-action').find('a[grid-btn]').each(function(idx,it){
            		$(this).removeClass('disabled');
            		var u = $(this).attr('href');
            		u = U('id',id,u);
            		$(this).attr('href',u);
            	})
            },
            unselectRowEvent: function (record, rowIndex, trObj, options) {
            	var id = gridObj.getRecordIndexValue(record, 'id');
            	$('#gridObj-action').find('a[grid-btn]').each(function(idx,it){
            		$(this).addClass('disabled');
            		var u = $(this).attr('href');
            		u = U('id','',u);
            		$(this).attr('href',u);
            	})
            }
        },
	});
})
</script>