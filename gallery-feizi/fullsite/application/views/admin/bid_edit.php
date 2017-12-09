<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $site=site_url().'admin/bid/'; ?>
<script type="text/javascript">
function toggleContent() {  
	var contentId = document.getElementById("form-data");  
	contentId.style.display == "none" ? contentId.style.display = "block" : 
	contentId.style.display = "none"; 
}
</script>
<div class="container-fluid content-wrapper cluster_container mob-right-part span10">
  <div class="hero-unit">   
      <h3 class="title">Bio Information</h3>
      <?php $this->load->view('admin/nav');?>	    
   
  <div class="success_msg"> 
    <?php if(!empty($success)){
           echo $success;
	       } ?>
	 <?php echo $this->session->flashdata('work_msg');?>      
  </div>               

<div class="form-data" id="form-data" style="display:block !important;">  
  <?php $edit=array('class'=>'edit_form white_bg'); 
    echo form_open_multipart('',$edit);?> 
	
	<div class="wit">
		<label>Category Type :</label>
		<select name="category_type" id="category_type">
			<option value="">Select Category Type</option>
            <?php 
				foreach($cat as $value){ 					
					if($value->cat_id==set_value('category_type' ) || $value->cat_id==$cat_id){	?>				
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
		<label>News :</label>
		<textarea name="bid" id="content" /><?php if(set_value('bid'))  echo set_value('bid'); else echo $des; ?></textarea>
		<?php  echo form_error('bid'); ?>
		<?php echo display_ckeditor($ckeditor); ?>
    </div> 
	
    <input type="hidden" name="id" value="<?php echo $this->uri->segment(5)?>">	 
   <div class="login_button">
	   <input type="button" value="Cancel" onclick="goBack()" class="login-btn " />
       <input type="submit" value="Save" name=" " class="login-btn " />
   </div>
   <?php echo  form_close();?>          
 </div>   
      
   </div>      
 </div>
 
<script>
function goBack() {
    window.location.href = '<?php echo $site.'add/'.$this->uri->segment(4) ?>';
}	 
</script>
