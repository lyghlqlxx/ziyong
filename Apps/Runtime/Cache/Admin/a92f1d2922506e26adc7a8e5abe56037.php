<?php if (!defined('THINK_PATH')) exit();?><div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
                    <div class="portlet box blue-hoki">
                        <div class="portlet-title ">
                        <span class="caption">后台登陆用户管理</span><div id='modelObj-action' class="actions"><a grid-btn data-add class="btn btn-primary" href="<?php echo ($addUrl); ?>" >新增</a>
        <a grid-btn data-add class="btn btn-info disabled" href="<?php echo ($editUrl); ?>" >修改</a>
        <a grid-btn data-delete class="btn btn-danger disabled" href="<?php echo ($delUrl); ?>&model=<?php echo ($model); ?>" >删除</a></div>
                    </div>
                        <div class="portlet-body no-padding">
                            
    <div class="table-responsive">
        <table id="modelObj" class="table table-bordered">
            <thead>
                <th w_index="id">id</th>
                <th w_index="account">登陆账号</th>
                <th w_index="email">用户邮箱</th>
                <th w_index="password">登陆密码(已加密)</th>
            </thead>
        </table>
    </div>
    <div id="modelObj-pager" class="widget-footer">

    </div>
                        </div>
                    </div>
                </div>
<script type="text/javascript">
var modelObj;
$(function(){
	var pageSize = 10;
	if (!pageSize) pageSize = 10
	modelObj = $.fn.bsgrid.init('modelObj', {
		url: window.location.href,
    	pageSize: pageSize,
    	// autoLoad:false,
    	displayBlankRows:false,
    	event: {
            selectRowEvent: function (record, rowIndex, trObj, options) {
            	//
            	var id = modelObj.getRecordIndexValue(record, 'id');
            	$('#modelObj-action').find('a[grid-btn]').each(function(idx,it){
            		$(this).removeClass('disabled');
            		var u = $(this).attr('href');
            		u = U('id',id,u);
            		$(this).attr('href',u);
            	})
            },
            unselectRowEvent: function (record, rowIndex, trObj, options) {
            	var id = modelObj.getRecordIndexValue(record, 'id');
            	$('#modelObj-action').find('a[grid-btn]').each(function(idx,it){
            		$(this).addClass('disabled');
            		var u = $(this).attr('href');
            		u = U('id','',u);
            		$(this).attr('href',u);
            	})
            }
        },
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
                modelObj.refreshPage();
            })
        }
    });

	$('[data-add]').on('click',function(event){
        event.preventDefault();
        var box = $('<div style="max-height:500px;overflow-y: auto;" class="row"></div>');
        var size = $(this).attr('dialog-size');
        if (!size) size = 'size-wide';
        var url = $(this).attr('href');
        var title = $(this).attr('dialog-title');
        box.load(url);
        BootstrapDialog.show({
            message: box,
            size:size,
            title:title,
            buttons: [{
                label: '确定',
                action: function(dialogRef) {
                    var form = dialogRef.getModalBody().find('form');
                    if (form.length > 0) {
                        var url = form.attr('action');
                        var data = form.serialize();
                        $.post(url,data,function(req){
                            $.bootstrapGrowl(req.info);
                            if (req.status == 1) {
                                dialogRef.close();
								modelObj.refreshPage();
                            }
                        })
                    }else{
                        dialogRef.close();
                    }
                }
            },{
                label: '取消',
                action: function(dialogRef){
                    dialogRef.close();
                }
            }]
        });
    })



})
</script>