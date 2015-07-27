<?php if (!defined('THINK_PATH')) exit();?><style type="text/css">
.img{
    max-width: 64px;
    max-height: 64px;
}
</style>
<div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
                    <div class="portlet box blue-hoki">
                        <div class="portlet-title ">
                        <span class="caption">文件上传</span>
                    </div>
                        <div class="portlet-body no-padding">
                            <input id="upload" name="file" class="file-loading file" type="file" data-preview-file-type="text">
                        </div>
                    </div>
                </div>
<div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
                    <div class="portlet box blue-hoki">
                        <div class="portlet-title ">
                        <span class="caption">文件管理</span><div id='modelObj-action' class="actions"><a grid-btn data-delete class="btn btn-danger disabled" href="<?php echo ($delUrl); ?>&model=<?php echo ($model); ?>" >删除</a></div>
                    </div>
                        <div class="portlet-body no-padding">
                            
    <div class="table-responsive">
        <table id="modelObj" class="table table-bordered">
            <thead>
                <th w_index="id">id</th>
                <th w_index="name">文件名称</th>
                <th w_index="type">type</th>
                <th w_index="size">大小(byte)</th>
                <th w_render="showImg">图</th>
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
	if (!pageSize) pageSize = 10;
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


	$("#upload").fileinput({
		'showUpload':false,
		'previewFileType':'any',
		// 'uploadAsync': true,
		'maxFileCount': 5,
		'showUpload': true,
		// 'showPreview': false,

		'ajaxSettings':{
			headers: {
				'X-APICloud-AppId': 'A6986237580001',
				'X-APICloud-AppKey':'<?php echo ($appKey); ?>'
			},
		},
		'uploadUrl': 'http://d.apicloud.com/mcm/api/file',
	}).on('filebatchuploadcomplete',function (event, files, extra) {
		modelObj.refreshPage();
		$("#upload").fileinput('reset');
	});




})
function showImg(record, rowIndex, colIndex, options) {
	var url =  modelObj.getRecordIndexValue(record, 'url');
	if (url)
		return '<a target=_blank href='+url+'><img class="img img-responsive" src='+url+'></a>';
	else
		return '';
}
</script>