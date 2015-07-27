<?php if (!defined('THINK_PATH')) exit();?>
<form method="post" data-ajax action="<?php echo ($insertUrl); ?>">
    <input name="id" type="hidden" value="<?php echo ($id); ?>" />
    <div class=" col-md-6 col-sm-6 col-xs-6 col-lg-6">
                    <div class="form-group">
                    <label for="field_name">字段名称</label>
                <input  value=""  name="name" type="text" placeholder="" id="field_name" class="form-control ">
                </div>
            </div>
    <div class=" col-md-6 col-sm-6 col-xs-6 col-lg-6">
                    <div class="form-group">
                    <label for="field_label">标签</label>
                <input  value=""  name="label" type="text" placeholder="" id="field_label" class="form-control ">
                </div>
            </div>
</form>