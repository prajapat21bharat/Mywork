<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<link rel="stylesheet" href="<?php echo base_url('assets/css/jquery.datepick.css') ?>">
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.datepick.js') ?>"></script>
<script type="text/javascript">

$(function() {
    $('#popupDatepicker').datepick();
});
</script>
<div class="container-fluid content-wrapper cluster_container mob-right-part span10">
  <div class="hero-unit">   
      <h3 class="title">Exhibitions Information</h3>
	    <?php $this->load->view('admin/nav');?>	    
   
  <div class="success_msg"> 
    <?php if(!empty($success)){
           echo $success;
	       } ?>
	 <?php echo $this->session->flashdata('work_msg');?>      
  </div>               

<!---its is a Profile EDIT Div---> 
  
  <?php $edit=array('class'=>'edit_form white_bg');
    echo form_open_multipart(site_url().'admin/exhibitions/add_exhibitions/'.$this->uri->segment(4),$edit);?> 
	
	<div class="wit">
		<label>Category Type :</label>
		<select name="category_type" id="category_type">
			<option value="">Select Category Type</option>
            <?php 
				foreach($cat as $value){ 
					if($value->cat_id==set_value('category_type')){	?>				
					   <option <?php echo set_select('category_type', $value->cat_id , TRUE); ?> value='<?php echo $value->cat_id?>'><?php echo  $value->cat_name ?></option>
				 <?php } else { ?>
					   <option <?php echo set_select('category_type', $value->cat_id); ?> value='<?php echo $value->cat_id?>'><?php echo  $value->cat_name ?></option>					
				 <?php }				
				}
            ?>
        </select>
        <?php  echo form_error('category_type'); ?>
    </div>
    <div class="wit">
		<label>Description :</label>
		<textarea name="work_des" id="work_des" /><?php echo set_value('work_des'); ?></textarea>
		<?php  echo form_error('work_des'); ?>
    </div>
    	 
   <div class="login_button">
     <input type="submit" value="Save" name=" " class="login-btn " />
   </div>
   <?php echo  form_close();?>          
            
   </div>      
 </div>
 </body>
</html>
