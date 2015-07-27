<?php if (!defined('THINK_PATH')) exit();?>
<style type="text/css">
.thumbnail img{
    height: 120px;
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
                        <span class="caption">文件列表</span>
                    </div>
                        <div class="portlet-body no-padding">
                            <div class="row imglist" >
    <p>数据加载中。。。</p>
</div>
<div class="hide frist"></div>
<div class="hide next"></div>
<div class="hide prep"></div>
                        </div>
                    </div>
                </div>


<script id="img" type="text/html">
<%for(i = 0; i < data.length; i ++) {%>
<div class="col-sm-2 col-md-2">
    <a href="#" onclick="selectFiled('<%=data[i].url%>','<%=data[i].id%>','<%=data[i].name%>')" class="thumbnail">
        <img src="<%=data[i].url%>" />
    </a>
</div>
<%}%>
</script>
<script type="text/javascript">
$(function(){
	$("#upload").fileinput({
		'showUpload':false,
		'previewFileType':'any',
		'uploadAsync': true,
		'maxFileCount': 5,
		'showUpload': true,
		'showPreview': false,
		'ajaxSettings':{
			headers: {
				'X-APICloud-AppId': '<?php echo (C("API_ID")); ?>',
				'X-APICloud-AppKey':'<?php echo ($appKey); ?>'
			},
		},
		'uploadUrl': 'http://d.apicloud.com/mcm/api/file',
	}).on('filebatchuploadcomplete',function (event, files, extra) {
		$("#upload").fileinput('reset');
        getList(1);
	});
    var p = 1;
    $('.next').on('click',function(){
        p++;
        getList(p);
    })

    $('.prep').on('click',function(){
        p--;
        getList(p);
    })

    $('.frist').on('click',function(){
        getList(1);
    })

    getList(1);

    function getList(page) {
        if (!page) page = 1;
        var url = "<?php echo U('AcFile/index');?>";
        $.post(url,{curPage:page,pageSize:12},function(req){
            var html = template('img', req);
            $('.imglist').html(html);
        })
    }

})
</script>