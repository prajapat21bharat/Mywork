<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $site=site_url().'admin/'; ?>

<div class="container-fluid content-wrapper cluster_container mob-right-part span10">
  <div class="hero-unit">   
      <h3 class="title">User Update</h3>     
	  <div class="success_msg"> 
		 <?php echo $this->session->flashdata('work_msg');?>      
	  </div>
<!---its is a Profile EDIT Div--->   
  <?php $edit=array('class'=>'edit_form white_bg');  
    echo form_open_multipart('',$edit);?> 	
    
    
	<div class="wit">
		<label>Name :</label>
		<input type="text" name="name" id="name" value="<?php if(set_value('name')) echo set_value('name'); else echo $user[0]->real_name; ?>" />
		<?php  echo form_error('name'); ?>
    </div>
    <div class="wit">
        <label>User Name :</label>
        <input type="text" name="user_name" id="user_name" value="<?php if(set_value('user_name')) echo set_value('user_name'); else echo $user[0]->user_name; ?>" />
		<?php  echo form_error('user_name'); ?>
    </div>
    <div class="wit">
        <label>E-Mail :</label>
        <input type="text" name="email" id="email" value="<?php if(set_value('email')) echo set_value('email'); else echo $user[0]->email; ?>" />
		<?php  echo form_error('email'); ?>
    </div>
   <div class="login_button">
	    <input type="button" value="Cancel" onclick="goBack()" class="login-btn " />
		<input type="submit" value="Save" name=" " class="login-btn " />
   </div>
   <?php echo  form_close();?>                    
   </div>      
 </div>
<script>
function goBack() {
    window.location.href = '<?php echo $site.'home/'; ?>';
}
</script>
