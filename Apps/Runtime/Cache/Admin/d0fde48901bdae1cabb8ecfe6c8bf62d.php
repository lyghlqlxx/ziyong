<?php if (!defined('THINK_PATH')) exit();?>
<form method="post" data-ajax action="<?php echo ($insertUrl); ?>">
    <div class=" col-md-6 col-sm-6 col-xs-6 col-lg-6">
                    <div class="form-group">
                    <label for="field_name">模型名称</label>
                <input  value=""  name="name" type="text" placeholder="" id="field_name" class="form-control ">
                </div>
            </div>
    <div class=" col-md-6 col-sm-6 col-xs-6 col-lg-6">
                    <div class="form-group">
                    <label for="field_title">模型标题</label>
                <input  value=""  name="title" type="text" placeholder="" id="field_title" class="form-control ">
                </div>
            </div>
</form>