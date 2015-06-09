<?php if (!defined('THINK_PATH')) exit();?><div class="row">
    
<form method="post" data-ajax action="<?php echo U('Admin/saveUser');?>">
    <input type="hidden" name="id" value="<?php echo ($vo["id"]); ?>">
    <div class=" col-md-6 col-sm-6 col-xs-6 col-lg-6">
                    <div class="form-group">
                    <label for="field_account">登陆账号</label>
                <input  value="<?php echo ($vo["account"]); ?>"  name="account" type="text" placeholder="" id="field_account" class="form-control ">
                </div>
            </div>
    <div class=" col-md-6 col-sm-6 col-xs-6 col-lg-6">
                    <div class="form-group">
                    <label for="field_password">登陆密码</label>
                <input  value=""  name="password" type="text" placeholder="" id="field_password" class="form-control ">
                </div>
            </div>
    <button class="btn btn-primary" type="submit">保存</button>
    <button data-close-dialog class="btn btn-default" type="button">取消</button>
</form>   

</div>