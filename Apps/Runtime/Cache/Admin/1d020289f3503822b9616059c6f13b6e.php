<?php if (!defined('THINK_PATH')) exit();?><div class="row">
    
<article class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
                    <div id="wid-id-1" data-widget-editbutton="false" class=" jarviswidget jarviswidget-color-green ">
                        <header class=" ">
                        <h2>新增数据</h2>
                    </header>
                        <div><div class="widget-body no-padding">
                            <form method="post" data-ajax action="<?php echo ($insertUrl); ?>">
<table class="table table-bordered">
    <?php if(is_array($model[fields])): $i = 0; $__LIST__ = $model[fields];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$f): $mod = ($i % 2 );++$i;?><tr >
        <?php if(($f[showAdd]) == "1"): ?><td width="180" style="text-align:right"><?php echo ($f["label"]); ?></td>
            <td >
            <?php echo ipt($f);?>
            </td><?php endif; ?>
    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    <tr>
        <td colspan="2">
        <button class="btn btn-primary" type="submit">保存</button>
    <a class="btn btn-default" href="#<?php echo ($backUrl); ?>">取消</a>
        </td>
    </tr>
</table> 
    
</form>
                        </div>
                        </div>
                    </div>
                </article>

</div>