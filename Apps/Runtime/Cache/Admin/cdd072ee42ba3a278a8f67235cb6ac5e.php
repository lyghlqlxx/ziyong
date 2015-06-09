<?php if (!defined('THINK_PATH')) exit();?><div class="row">
    
<form method="post" data-ajax action="<?php echo U('Admin/saveModel');?>">
    <input type="hidden" name="id" value="<?php echo ($vo["id"]); ?>">
    <div class=" col-md-12 col-sm-12 col-xs-12 col-lg-12">
                    <div class="form-group">
                    <label for="field_name">模型标题</label>
                <input  value="<?php echo ($vo["name"]); ?>"  name="name" type="text" placeholder="" id="field_name" class="form-control ">
                </div>
            </div>
    <div class=" col-md-12 col-sm-12 col-xs-12 col-lg-12">
                    <div class="form-group">
                    <label for="field_title">模型名称</label>
                <input  value="<?php echo ($vo["title"]); ?>"  name="title" type="text" placeholder="" id="field_title" class="form-control ">
                </div>
            </div>
    <button class="btn btn-primary" type="submit">保存</button>
    <button data-close-dialog class="btn btn-default" type="button">取消</button>
</form>   

</div>