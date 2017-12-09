<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script>
$(document).ready(function() {
$("#datepicker").datepicker();
$("#datepick").datepicker();


});
 </script>

<div class="hero-unit">
  <?php
$this->load->helper('form');
$this->load->library('form_validation');
$this->load->helper('url');
 
 echo form_open_multipart('admin/register/profile');
?>
  <label>First Name </label>
  <input type="text" id="firstName" name="first_name" value="<?php echo set_value('first_name'); ?>"/>
  <p><span id="txtFirstName"> <?php echo form_error('first_name'); ?></span></p>
  <label>Last Name </label>
  <input type="text"  id="lastName" name="last_name" value="<?php echo set_value('last_name'); ?>"/>
  <p><span id="txtLastName"> <?php echo form_error('last_name'); ?> </span></p>
  <label>Profile Image </label>
  <input type="file" name="userfile" value="" />
  <?php if(!empty($error)) echo $error; ?>
  <p><span id="userfile"> <?php echo form_error('userfile'); ?> </span></p>
  <label>Gender </label>
  <input type="radio" name="gender" value="Male"    <?php if(set_value('gender')=='Male') echo 'checked="checked"';?> />
  Male
  <input type="radio" name="gender" value="Female" <?php if(set_value('gender')=='Female') echo 'checked="checked"';?>  />
  Female
  <label>Date of Birth </label>
  <input type="text" id="datepicker" value="" name="date"/>
  <p><span id="txtAge"> <?php echo form_error('date'); ?> </span></p>
  <label>Address </label>
  <textarea rows="4" cols="50" name="user_address"  id="address"><?php echo set_value('user_address'); ?></textarea>
  <p><span id="txtAddress"><?php echo form_error('user_address'); ?></span></p>
  <label>Contact No </label>
  <input type="text" name="user_phone" value="<?php echo set_value('user_phone'); ?>"  />
  <p><span id="txtTelephone"><?php echo form_error('user_phone'); ?> </span></p>
  <input type="submit" value="Register" name=" " class="btn btn-primary btn-large"/>
  <?php
echo  form_close();
?>
</div>
