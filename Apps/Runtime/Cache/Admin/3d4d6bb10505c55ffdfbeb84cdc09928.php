<?php if (!defined('THINK_PATH')) exit();?><div class="row">
    
<article class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
                    <div id="wid-id-1" data-widget-editbutton="false" class=" jarviswidget jarviswidget-color-green ">
                        <header class=" ">
                        <h2>对象管理</h2><div id="modelObj-header" role="menu" class="widget-toolbar"><a class="btn btn-primary" ajax-dialog href="<?php echo U('Admin/addModel');?>" >新增</a>
        <a grid-delete data-ajax class="btn btn-danger disabled" href="<?php echo U('Admin/deleteModel');?>" >删除</a></div>
                    </header>
                        <div><div class="widget-body no-padding">
                            
    <div class="alert alert-info no-margin fade in">
        <i class="fa-fw fa fa-info"></i>
        请添加ApiCloud的所有对象模型。
    </div>
    <div class="table-responsive">
        <table id="modelObj" class="table table-bordered">
            <thead>
                <th w_index="id">id</th>
                <th w_index="name">对象名称</th>
                <th w_index="title">标题</th>
            </thead>
        </table>
    </div>
    <div id="modelObj-footer" class="widget-footer">
          
    </div>
                        </div>
                        </div>
                    </div>
                </article>



<article class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
                    <div id="wid-id-1" data-widget-editbutton="false" class=" jarviswidget jarviswidget-color-green ">
                        <header class=" ">
                        <h2>用户管理</h2><div id="userObj-header" role="menu" class="widget-toolbar"><a class="btn btn-primary" ajax-dialog href="<?php echo U('Admin/addUser');?>" >新增</a>
        <a grid-edit ajax-dialog class="btn btn-info disabled" href="<?php echo U('Admin/editUser');?>" >修改</a>
        <a grid-delete data-ajax class="btn btn-danger disabled" href="<?php echo U('Admin/deleteUser');?>" >删除</a></div>
                    </header>
                        <div><div class="widget-body no-padding">
                            
    <div class="alert alert-info no-margin fade in">
        <i class="fa-fw fa fa-info"></i>
        请添加ApiCloud的所有对象模型。
    </div>
    <div class="table-responsive">
        <table id="userObj" class="table table-bordered">
            <thead>
                <th w_index="id">id</th>
                <th w_index="account">登陆名</th>
                <th w_index="password">登陆密码</th>
            </thead>
        </table>
    </div>
    <div id="userObj-footer" class="widget-footer">
          
    </div>
                        </div>
                        </div>
                    </div>
                </article>


<link rel="stylesheet" type="text/css" href="assets/js/bsgrid/css/bsgrid.all.css" />
<script type="text/javascript">
pageSetUp();
var modelObj;
var userObj;
var pagefunction = function() {
    loadScript("assets/js/bsgrid/bsgrid.all.js", run);
    function run(){
        modelObj = $.fn.bsgrid.init('modelObj', {
            url: '<?php echo U('Admin/getAllModels');?>',
            pageSizeSelect: false,
            // pageAll:true,
            // displayBlankRows:false,
            // pagingLittleToolbar: true,
            pageSize: 6
        });

        userObj = $.fn.bsgrid.init('userObj', {
            url: '<?php echo U('Admin/getAllUsers');?>',
            pageSizeSelect: false,
            // pageAll:true,
            // displayBlankRows:false,
            // pagingLittleToolbar: true,
            pageSize: 6
        });

    }
}
pagefunction();

</script>

</div>