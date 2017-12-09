<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<link rel="stylesheet" href="<?php echo base_url('assets/css/jquery.datepick.css') ?>">
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.datepick.js') ?>"></script>
<script type="text/javascript">

$(function() {
    $('#popupDatepicker').datepick();
});

function toggleContent() {
  
	var contentId = document.getElementById("form-data");  
	contentId.style.display == "block" ? contentId.style.display = "none" : 
	contentId.style.display = "block";
	
	var contentId1 = document.getElementById("up");  
	contentId1.style.display == "none" ? contentId1.style.display = "block" : 
	contentId1.style.display = "none";  
}
</script>
<div class="container-fluid content-wrapper cluster_container mob-right-part span10">
  <div class="hero-unit">   
      <h3 class="title">Artist Information</h3>
	    <?php $this->load->view('admin/nav');?>	
   
  <div class="success_msg"> 
    <?php if(!empty($success)){
           echo $success;
	       } ?>
	 <?php echo $this->session->flashdata('message');?>      
  </div>  
  <?php if($user_info){
	  if(!empty($user_info[0]->userfile)){	
	  $image=site_url()."uploadimages/user/".$user_info[0]->userfile; 
	  }else{
		$image=$this->session->userdata('user_image');
		 }
   }?>
 
  <?php if(!empty($error)) echo $error; ?>

<!---its is a Profile EDIT Div---> 
<div class="menu_itemshow show-form">	
	<a class="login-btn" href="javascript:void(0)" onclick="toggleContent()">Update Profile</a>
</div>	
<div id="up">
	<div class="up-img"><img src="<?php if(!empty($user_info[0]->userfile)) echo base_url('uploads').'/'.$user_info[0]->userfile; ?>" width="100" height="100" alt=""></div>
	<div class="up-data">
		<div class="artist-type"><span>English Name: </span><span class="artist-contant"><?php echo $user_info[0]->first_name; ?></div>
		<div class="artist-type"><span>Chinese Name: </span><span class="artist-contant"><?php echo $user_info[0]->last_name; ?></div>
		<!--<div class="artist-type"><span>Phone Number: </span><span class="artist-contant"><?php echo $user_info[0]->user_phone; ?></div>-->
		<div class="artist-type"><span>Gender: </span><span class="artist-contant"><?php echo $user_info[0]->gender; ?></div>
	</div>
</div>	
<div class="form-data" id="form-data" >  
  <?php $edit=array('class'=>'edit_form white_bg');
    echo form_open_multipart(site_url().'admin/home/user_profile_view/'.$this->uri->segment(4),$edit);?>
  <div class="wit">
    <input type="hidden" name="ID" value="<?php if($user_info){echo $user_info[0]->ID;} ?>" />
    
    <label>English Name <sup>*</sup>:</label>
    <?php 
	if(set_value('first_name')!=''){
		$name=set_value('first_name');}
	else{
		if($user_info){$name=$user_info[0]->first_name;
		}else{$name='';}
	 }
	?>
    <input type="text" id="firstName" name="first_name" value="<?php echo $name?>"/>
    <?php echo form_error('first_name'); ?></span></p>
    
     <?php 
	if(set_value('last_name')!=''){
		$last_name=set_value('last_name');}
	else{
		if($user_info){$last_name=$user_info[0]->last_name;
		}else{$last_name='';}
	 }
	?>
    </div>
    
    <div class="wit">
    <label>Chinese Name <sup>*</sup>:</label>
    <input type="text"  id="lastName" name="last_name" value="<?php echo $last_name ?>"/>
   <?php echo form_error('last_name'); ?>
   </div>
    <!--    
    <div class="wit">
     <?php 
	if(set_value('user_phone')!=''){
		$user_phone=set_value('user_phone');}
	else{
		if($user_info){$user_phone=$user_info[0]->user_phone;
		}else{$user_phone='';}
	 }
	?> 
   <label>Phone Number<sup>*</sup>:</label>
    <input type="text" name="user_phone" value="<?php echo $user_phone; ?>"  />
     <?php echo form_error('user_phone');?>
    </div>
    -->
    
     <div class="wit">
     <?php 
	 $typeOfRep = '';
	if(set_value('typeOfRep')!=''){
		$typeOfRep=set_value('typeOfRep');}
	else{
		if($user_info){$typeOfRep = $user_info[0]->typeOfRep;
		}else{$typeOfRep='';}
	 }
	?>    
     <label>Type of Representation :</label>
    <input type="radio" name="typeOfRep" value="rep" <?php if($typeOfRep=='rep'){ echo 'checked="checked"';}?> />
    <span class="radio-active">Represented</span>    
    
     <input type="radio" name="typeOfRep" value="ini" <?php if($typeOfRep=='ini'){ echo 'checked="checked"';}?> />
     <span class="radio-active">Exhibited</span>
   
    </div>
    
    
    <div class="wit">
     <?php 
	if(set_value('gender')!=''){
		$gender=set_value('gender');}
	else{
		if($user_info){$gender=$user_info[0]->gender;
		}else{$gender='';}
	 }
	?>    
    <label>Gender :</label>
	
    <input type="radio" name="gender" value="male" <?php if($gender=='male'){ echo 'checked="checked"';}?> />
    <span class="radio-active">Male</span>    
    
     <input type="radio" name="gender" value="female" <?php if($gender=='female'){ echo 'checked="checked"';}?> />
     <span class="radio-active">Female</span>
     
    </div>
	
	       
    <div class="wit">
		<?php 
		if(set_value('order_type')!=''){
			$order_type=set_value('order_type');}
		else{
			if($user_info){$order_type=$user_info[0]->order_type;
			}else{$order_type='';}
		 }
		?>
		<label>Sort images by :</label>
			<select name="order_type" id="order_type">
				<option value="">Select Sort Type</option>
				<option value="title" <?php if($order_type=='title'){ echo 'selected="selected"';}?>>Alphabetical Order</option>
				<option value="work_date" <?php if($order_type=='work_date'){ echo 'selected="selected"';}?>>Date</option>
			</select>
		<?php echo form_error('order_type'); ?>
    </div>
	
	<div class="wit">
    <label>Profile Image :</label>
    <input type="button" value="uploadfile" id="mulitplefileuploader"/>
    <input type="hidden" value="<?php echo $user_info[0]->userfile; ?>" id="userimg" class="userimg" name="userimg">
    <p id="files">
    <?php 
    if($user_info[0]->userfile)
	echo "<img height='80' width='80' src='".base_url()."uploads/".$user_info[0]->userfile."'/>";
    ?>
    </p>
    <?php echo form_error('userimg'); ?>
    </div> 
	 
   <div class="login_button">
	  <input type="button" value="Cancel" onclick="goBack()" class="login-btn " />
    <input type="submit" value="Save" name=" " class="login-btn " />
    
    </div>
    <?php echo  form_close();?>         
 </div>           
      </div>      
 </div>
 </body>
 <script>
function goBack() {
	window.location.href = '<?php echo site_url().'admin/home/user_profile_view/'.$this->uri->segment(4) ?>';
}
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
</script>
</html>
