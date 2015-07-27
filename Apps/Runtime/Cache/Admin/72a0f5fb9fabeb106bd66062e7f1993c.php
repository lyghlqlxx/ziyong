<?php if (!defined('THINK_PATH')) exit();?>
<form method="post" data-ajax action="<?php echo ($updateUrl); ?>">
    <input type="hidden" name="id" value="<?php echo ($vo["id"]); ?>"/>
    <div class=" col-md-4 col-sm-4 col-xs-4 col-lg-4">
                    <div class="form-group">
                    <label for="field_account">登陆账号</label>
                <input  value="<?php echo ($vo["account"]); ?>"  name="account" type="text" placeholder="" id="field_account" class="form-control ">
                </div>
            </div>
    <div class=" col-md-4 col-sm-4 col-xs-4 col-lg-4">
                    <div class="form-group">
                    <label for="field_password">登陆密码</label>
                <input  value=""  name="password" type="text" placeholder="" id="field_password" class="form-control ">
                </div>
            </div>
    <div class=" col-md-4 col-sm-4 col-xs-4 col-lg-4">
                    <div class="form-group">
                    <label for="field_email">用户邮箱</label>
                <input  value="<?php echo ($vo["email"]); ?>"  name="email" type="text" placeholder="" id="field_email" class="form-control ">
                </div>
            </div>
</form>