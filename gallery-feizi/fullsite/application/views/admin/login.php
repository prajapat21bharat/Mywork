<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<script>
$(function(){
	$('body').addClass('bg_image');
	});
</script>
<div class="container">
  <div class="hero-unit" id="log_in">
   <div class="chang-pass">
    <h3>Admin Login</h3>
   </div>
    <?php echo form_open('admin/login/check_login');
 if(!empty($error)){
   ?> <div id="disp"><?php echo $error;?></div><?php }?>

 <div id="" class="log_in">
    <label>User Name </label>
    <input type="text" id="user_name" name="user_name" value="<?php echo set_value('user_name'); ?>"/>
    <p><span id="txtFirstName"> <?php echo form_error('user_name'); ?></span></p>
    <label>Password</label>
    <input type="password" name="password" value="<?php echo set_value('password'); ?>" />
    <p><span id="password"> <?php echo form_error('password'); ?> </span></p>
    </td>
        <div class="login_button">
        <input type="submit" name="login" value="Login" class="login-btn"  />
        </div>
    </div>
    <?php echo form_close();
  ?> </div>
</div>

