<?php if (!defined('THINK_PATH')) exit();?><div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
                    <div class="portlet box blue-hoki">
                        <div class="portlet-title ">
                        <span class="caption"><?php echo ($cm["title"]); ?></span><div id='modelObj-action' class="actions"><a grid-btn class="btn btn-primary" href="<?php echo ($addUrl); ?>&model=<?php echo ($model); ?>" >新增</a>
        <a grid-btn class="btn btn-info disabled" href="<?php echo ($editUrl); ?>&model=<?php echo ($model); ?>" >修改</a>
        <a grid-btn data-delete class="btn btn-danger disabled" href="<?php echo ($delUrl); ?>&model=<?php echo ($model); ?>" >删除</a></div>
                    </div>
                        <div class="portlet-body no-padding">
                            
    <div class="table-responsive">
        <table id="modelObj" class="table table-bordered">
            <thead>
            <?php if(is_array($cm[fields])): $i = 0; $__LIST__ = $cm[fields];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$f): $mod = ($i % 2 );++$i; if(($f[showList]) == "1"): ?><th w_index="<?php echo ($f["name"]); ?>"><?php echo ($f["label"]); ?></th><?php endif; endforeach; endif; else: echo "" ;endif; ?>
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



})
</script>