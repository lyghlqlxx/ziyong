<?php if (!defined('THINK_PATH')) exit();?><div class="row">
    
<article class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
                    <div id="wid-id-1" data-widget-editbutton="false" class=" jarviswidget jarviswidget-color-green ">
                        <header class=" ">
                        <h2><?php echo ($model["title"]); ?></h2><div id="modelObj-header" role="menu" class="widget-toolbar"><a class="btn btn-primary" href="#<?php echo ($addUrl); ?>" >新增</a>
        <a grid-edit class="btn btn-info disabled" href="#<?php echo ($editUrl); ?>" >修改</a>
        <a grid-delete data-ajax class="btn btn-danger disabled" href="<?php echo ($delUrl); ?>" >删除</a></div>
                    </header>
                        <div><div class="widget-body no-padding">
                            
    <div class="table-responsive">
        <table id="modelObj" class="table table-bordered">
            <thead>
            <?php if(is_array($model[fields])): $i = 0; $__LIST__ = $model[fields];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$f): $mod = ($i % 2 );++$i; if(($f[showList]) == "1"): ?><th w_index="<?php echo ($f["name"]); ?>"><?php echo ($f["label"]); ?></th><?php endif; endforeach; endif; else: echo "" ;endif; ?>
            </thead>
        </table>
    </div>
    <div id="modelObj-footer" class="widget-footer">
          
    </div>
                        </div>
                        </div>
                    </div>
                </article>


<link rel="stylesheet" type="text/css" href="assets/js/bsgrid/css/bsgrid.all.css" />
<script type="text/javascript">
pageSetUp();
var modelObj;
var pagefunction = function() {
    loadScript("assets/js/bsgrid/bsgrid.all.js", run);
    function run(){
        modelObj = $.fn.bsgrid.init('modelObj', {
            url: '<?php echo U($con."/index");?>',
            pageSizeSelect: false,
            // pageAll:true,
            // displayBlankRows:false,
            // pagingLittleToolbar: true,
            pageSize: 10
        });
    }
}
pagefunction();

</script>

</div>