<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $site=site_url().'admin/'; ?>
<div class="container-fluid content-wrapper mob-right-part span10">
<div class="hero-unit">
  <h3 class="title">Artist Registration</h3>
  <div class="">
    <?php
 	$attr=array('class'=>'edit_form white_bg');
    echo form_open('admin/register/',$attr);
	if(!empty($error))
 echo $error;
 
 if(!empty($success))echo $success;
	?>
	<?php echo $this->session->flashdata('work_msg');?>      
    <div class="wit">
    <label>English Name :</label>
    <input type="text" id="first_name" name="first_name" value="<?php echo set_value('first_name'); ?>"/>
    <?php echo form_error('first_name'); ?>
    </div>
    
    <div class="wit">
    <label>Chinese Name :</label>
    <input type="text" id="last_name" name="last_name" value="<?php echo set_value('last_name'); ?>"/>
    <?php echo form_error('last_name'); ?>
    </div>
    <!--
    <div class="wit">
    <label>Phone Number :</label>
    <input type="text" id="user_phone" name="user_phone" value="<?php echo set_value('user_phone'); ?>"/>

    
    <?php //echo form_error('user_phone'); ?>
    </div>
        -->
     <div class="wit">
    <label>Type of Representation :</label>
    <input type="radio" name="typeOfRep" value="rep" <?php if(set_value('typeOfRep')=='rep'){ echo 'checked="checked"';}?> />
    <span class="radio-active">Represented</span>    
    
     <input type="radio" name="typeOfRep" value="ini" <?php if(set_value('typeOfRep')=='ini'){ echo 'checked="checked"';}?> />
     <span class="radio-active">Exhibited</span>
    <?php echo form_error('typeOfRep'); ?>
    </div>    
        
    <div class="wit">
    <label>Gender :</label>
    <input type="radio" name="gender" value="male" <?php if(set_value('gender')=='male'){ echo 'checked="checked"';}?> />
    <span class="radio-active">Male</span>    
    
     <input type="radio" name="gender" value="female" <?php if(set_value('gender')=='female'){ echo 'checked="checked"';}?> />
     <span class="radio-active">Female</span>
    <?php echo form_error('gender'); ?>
    </div> 

       
    <div class="wit">
		<label>Sort images by :</label>
			<select name="order_type" id="order_type">
				<option value="">Select Sort Type</option>
				<option value="title">Alphabetical Order</option>
				<option value="work_date">Date</option>
			</select>
		<?php echo form_error('order_type'); ?>
    </div>
    
    <div class="wit">
    <label>Profile Image :</label>
    <input type="button" value="uploadfile" id="mulitplefileuploader"/>
    <input type="hidden" value="<?php echo set_value('userimg'); ?>" id="userimg" class="userimg" name="userimg">
    <p id="files">
    <?php 
    if(set_value('userimg'))
	echo "<img height='80' width='80' src='".base_url()."uploads/".set_value('userimg')."'/>";
    ?>
    </p>
    <?php echo form_error('userimg'); ?>
    </div> 
    

    
    
    <div class="login_button">
		<input type="button" value="Cancel" class="login-btn" onclick="goBack()" />
    <input type="submit" name="register" value="Register" class="login-btn" />
    </div>
    <?php
    echo form_close();
 ?>
  </div>
</div>
</div>
<script>
$(document).ready(function(){

var settings = {
	url: "<?php echo site_url() ?>admin/register/upload_photo_vedio",
	method: "POST",
	allowedTypes:"jpeg,jpg,png,gif,swf,wmv,mp4,ogg",
	fileName: "myfile",
	multiple: true,
	onSuccess:function(data,files,xhr){
		$("#files").html("<span class='image_show'><img height='80' width='80' src='<?php echo base_url() ?>uploads/"+files+"'/></span>");
		$("#userimg").val(files); 
	},
	onError: function(files,status,errMsg){		
		$("#status").html("<font color='red'>Upload is Failed</font>");
	}
}
$("#mulitplefileuploader").uploadFile(settings);

});
function goBack() {
    window.location.href = '<?php echo $site.'home/user_profile' ?>';
}
</script>
