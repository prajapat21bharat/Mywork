<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $site=site_url().'admin/category/'; ?>

<div class="container-fluid content-wrapper cluster_container mob-right-part span10">
  <div class="hero-unit">   
      <h3 class="title">Update Category</h3>     
	  <div class="success_msg"> 
		 <?php echo $this->session->flashdata('work_msg');?>      
	  </div>
<!---its is a Profile EDIT Div--->   
  <?php  $edit=array('class'=>'edit_form white_bg'); 
    echo form_open_multipart('',$edit);?> 
    	
    <div class="wit">
		<label>Category Name :</label>
		<input type="text" name="cat" id="cat" value="<?php if(set_value('cat')) echo set_value('cat'); else echo $category_data[0]->cat_name; ?>" />
		<?php  echo form_error('cat'); ?>			
    </div> 
   <div class="login_button">
	    <input type="button" value="Cancel" onclick="goBack()" class="login-btn " />
		<input type="submit" value="Save" name=" " class="login-btn " />
   </div>
   <?php echo  form_close();?>                    
   </div>      
 </div>
<script type="text/javascript">
function goBack() {
    window.location.href = '<?php echo $site ?>';
}
</script>
