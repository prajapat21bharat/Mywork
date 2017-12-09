<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="container-fluid content-wrapper mob-right-part password_wrap span10">
  <div class="hero-unit login_form">
    <h4 class="title">Password change</h4>
    <div class="">
      <div id="hide_form" >
        <div class="update_pass">
		 <?php if(!empty($success)){
            echo $success;
          }?>
        </div>
        <?php
	$attr=array('class'=>'edit_form white_bg');
     echo form_open(site_url().'admin/changepassword/', $attr);?>
     
       
        <input type="hidden" id="user_name" name="user_name" value="<?php echo $this->session->userdata('admin_user_name');?>"/>
        <div class="wit">
        <label>Old Password</label>
        <input type="password" id="old_password" name="old_password" value="" />
        </div>
        <?php echo form_error('old_password'); ?>
        
        <div class="wit">
        <label>New Password</label>
        <input type="password" id="new_password" name="new_password" value="" />
        </div>
         <?php echo form_error('new_password'); ?>
        
        <div class="wit">
        <label>Confirm Password</label>
        <input type="password" id="confirm_password" name="confirm_password" value="" />
        </div>
        <?php echo form_error('confirm_password'); ?>
         
      	<div id="sub_btn">
        <input type="submit"  name="change_password" value="Change" class="login-btn" />
        </div>
        <?php echo form_close();
 	   ?> </div>
    </div>
  </div>
</div>
