<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $site=site_url().'admin/contact/'; ?>
<link rel="stylesheet" href="<?php echo base_url('assets/css/jquery.datepick.css') ?>">
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.datepick.js') ?>"></script>
<style>
textarea#content {
    height: 300px;
    width: 55%;
}
</style>
<div class="container-fluid content-wrapper cluster_container mob-right-part span10">
  <div class="hero-unit">   
      <h3 class="title">Update Contact</h3>     
	  <div class="success_msg"> 
		 <?php echo $this->session->flashdata('work_msg');?>      
	  </div>
<!---its is a Profile EDIT Div--->   
  <?php  $edit=array('class'=>'edit_form white_bg'); 
    echo form_open_multipart( $site.'edit/1',$edit);?> 
    <div class="wit">
        <label>Contact Data :</label>
        <textarea name="contact_data" id="content" ><?php if(set_value('contact_data')) echo set_value('contact_data'); else echo $contact_data[0]->contact_data; ?></textarea>
        <?php //echo display_ckeditor($ckeditor); ?> <br />
        <?php echo form_error('contact_data'); ?>
    </div>	
    
   <div class="login_button">
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
