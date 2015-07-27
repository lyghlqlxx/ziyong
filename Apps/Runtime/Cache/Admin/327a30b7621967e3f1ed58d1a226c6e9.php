<?php if (!defined('THINK_PATH')) exit();?>
<div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
                    <form method="post" data-ajax action="<?php echo ($updateUrl); ?>">
<input type="hidden" name="id" value="<?php echo ($vo["id"]); ?>">
    <div class=" col-md-6 col-sm-6 col-xs-6 col-lg-6">
                    <div class="form-group">
                    <label for="field_title">表单名称</label>
                <input  value="<?php echo ($vo["name"]); ?>"  name="title" type="text" placeholder="" id="field_title" class="form-control ">
                </div>
            </div>
    <div class=" col-md-6 col-sm-6 col-xs-6 col-lg-6">
                    <div class="form-group">
                    <label for="field_title">表单标题</label>
                <input  value="<?php echo ($vo["title"]); ?>"  name="title" type="text" placeholder="" id="field_title" class="form-control ">
                </div>
            </div>
</form>
            </div>