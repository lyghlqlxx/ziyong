<?php if (!defined('THINK_PATH')) exit();?><div class="row">
    
<article class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
                    <div id="wid-id-1" data-widget-editbutton="false" class=" jarviswidget jarviswidget-color-green ">
                        <header class=" ">
                        <h2>模型设计</h2>
                    </header>
                        <div><div class="widget-body no-padding">
                            <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <th>字段名称</th>
                <th>标题</th>
                <th>类型</th>
                <th>col长度</th>
                <th>列表</th>
                <th>新增</th>
                <th>编辑</th>
            </thead>
            <tbody>
            <?php if(is_array($vo[fields])): $i = 0; $__LIST__ = $vo[fields];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr>
                <td><?php echo ($v["name"]); ?></td>
                <td><a data-editable data-name="label" data-value="<?php echo ($v["label"]); ?>" data-pk="<?php echo ($v["name"]); ?>" href="#"><?php echo ($v["label"]); ?></a></td>
                <td><a data-type="select" data-editable-ipttype data-name="type" data-value="<?php echo ($v["type"]); ?>" data-pk="<?php echo ($v["name"]); ?>" href="#"></a> </td>
                <td><a data-editable data-name="col" data-value="<?php echo ($v["col"]); ?>" data-pk="<?php echo ($v["name"]); ?>" href="#"><?php echo ($v["col"]); ?></a></td>
                <td><a data-type="select" data-editable-isshow data-name="showList" data-value="<?php echo ($v["showList"]); ?>" data-pk="<?php echo ($v["name"]); ?>" href="#"></a></td>
                <td><a data-type="select" data-editable-isshow data-name="showAdd" data-value="<?php echo ($v["showAdd"]); ?>" data-pk="<?php echo ($v["name"]); ?>" href="#"></a></td>
                <td><a data-type="select" data-editable-isshow data-name="showEdit" data-value="<?php echo ($v["showEdit"]); ?>" data-pk="<?php echo ($v["name"]); ?>" href="#"></a></td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
        </table>
    </div>
                        </div>
                        </div>
                    </div>
                </article>
<script type="text/javascript">
pageSetUp();
var pagefunction = function() {

    $("select[name=model]").on('change',function(){
        var hash  = window.location.hash;
        var name = $(this).val();
        hash = U('name',name,hash);
        window.location.hash = hash;
        console.log(hash);
    })


    loadScript("assets/js/plugin/x-editable/moment.min.js", loadMockJax);
    
    function loadMockJax() {
        loadScript("assets/js/plugin/x-editable/jquery.mockjax.min.js", loadXeditable);
    }

    function loadXeditable() {
        loadScript("assets/js/plugin/x-editable/x-editable.min.js", loadTypeHead);
    }

    function loadTypeHead() {
        loadScript("assets/js/plugin/typeahead/typeahead.min.js", loadTypeaheadjs);
    }

    function loadTypeaheadjs() {
        loadScript("assets/js/plugin/typeahead/typeaheadjs.min.js", runXEditDemo);
    }

    function runXEditDemo() {
        $.fn.editable.defaults.url = "<?php echo U('Admin/updateField');?>&mName=<?php echo ($_GET['name']); ?>";
        $('[data-editable]').editable();

        $('[data-editable-isshow]').editable({
            prepend: "隐藏",
            source: [
                {value: '1', text: '显示'},
                {value: '0', text: '隐藏'},
            ]
        });


        $('[data-editable-ipttype]').editable({
            prepend: "请选择",
            source: [
                {value: 'input', text: 'input'},
                {value: 'text', text: 'text'},
                {value: 'password', text: 'password'},
                {value: 'select', text: 'select'},
                {value: 'number', text: 'number'},
                {value: 'date', text: 'date'},
                {value: 'time', text: 'time'},
                {value: 'datetime', text: 'datetime'},
                {value: 'hidden', text: 'hidden'},
                {value: 'checkbox', text: 'checkbox'},
                {value: 'textarea', text: 'textarea'},
                {value: 'umeditor', text: 'umeditor'},
                {value: 'file', text: 'file'},
                {value: 'fileinput', text: 'fileinput'},
                {value: 'upimg', text: 'upimg'},
            ]
        });
    }



}
pagefunction();
</script>


</div>