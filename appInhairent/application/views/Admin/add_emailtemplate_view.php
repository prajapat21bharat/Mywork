<?php
	$this->load->view('includes/admin_header');
?>
        
<div class="contentpanel" >
<?php
	//$this->load->view('Stylist/include/subscribe_block');
?>
	<div class="container clear_both padding_fix top_space">
		<div class="row">
			<div class="col-md-9 col-sm-12 col-xs-12 left-space-r">
				<div class="breadcrums">
					<span>Email Templates > </span><a href="<?php echo site_url('admin/add_template') ?>">Add Template</a>
				</div>
				<div class="ad-haeding">
					<h2>Add Template</h2>
					<?php
						if (isset($message))
						{
							echo $message;
						}
					?>
					<div class="panel-body">
						

							<!----Section for Main content start ---->
							
						
							<!--<div class="col-md-3">
								<p>
									<a href="<?php //echo site_url()?>admin/sendmail" class="btn-black-small">Email Archive</a>
								</p>
							</div>-->
							<!------------->
							<div class="col-md-12 col-lg-12 col-sm-12">
								<form method="post" action="<?php echo site_url()?>admin/add_template">
								<div class="form-group">
								<label for="inputEmail">Email Name <span class="mandetory"> *</span></label>
								<input type="text" placeholder="Email Name" id="email-name" class="form-control" value="<?php echo set_value('email_name'); ?>" name="email_name" onblur="this.placeholder = 'Email Name'" onfocus="this.placeholder = ''">
							</div>
							
							<div class="form-group">
								<label for="inputEmail">Subject <span class="mandetory"> *</span></label>
								
								<input type="text" placeholder="Subject" id="email-subject" class="form-control" value="<?php echo set_value('email_subject'); ?>" name="email_subject" onblur="this.placeholder = 'Subject'" onfocus="this.placeholder = ''">
												
							</div>
                                                                    <div class="form-group">
								<label for="inputEmail">Content <span class="mandetory"> *</span></label>
								

								<textarea name="contentn" id="contentn" class="contentn" ></textarea>

									<?php  //echo form_ckeditor(array('id'=>'contentn')); ?>												
								</div>
							<div class="form-group">
								<div class="col-md-2">
									<label for="inputstatus">Status</label>
								</div>
								<div class="col-md-10">
									<input type="radio" checked="checked" <?php echo set_radio('status', '1'); ?> id="status" class="form-control"  value="1" name="status">
									<label for="status">Enable</label>
									<input type="radio"  id="status1" <?php echo set_radio('status', '0'); ?> class="form-control"  value="0" name="status"><label for="status1">Disable</label>
								</div>
							</div> 
                                                                   
                                                                    
							<input type="submit" value="Add" class="btn-black-small square-btn-adjust" name="addemail">
								</form>
							</div>
							<!----Section for Main content start ---->
						</div>
					
				</div>
			</div>
			<!-- /. ROW  -->
		</div>
	</div>

<!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER  -->
<?php
	$this->load->view('includes/footer');
?>

	<!--<script src="//tinymce.cachefly.net/4.2/tinymce.min.js"></script> -->
	 <script type="text/javascript" src="<?php echo base_url();?>assets/js/tinymce/tinymce.min.js"></script>
	 
	 
<script type="text/javascript">
 
tinymce.init({
  selector: ".contentn",
  height : 250,
  relative_urls: false,
  convert_urls : false,

  // ===========================================
  // INCLUDE THE PLUGIN
  // ===========================================
	
  plugins: [
    "advlist autolink lists link charmap print preview anchor",
    "searchreplace visualblocks code fullscreen",
    "insertdatetime  table contextmenu paste jbimages"
  ],
	
  // ===========================================
  // PUT PLUGIN'S BUTTON on the toolbar
  // ===========================================
	
  toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | jbimages code",
	
  // ===========================================
  // SET RELATIVE_URLS to FALSE (This is required for images to display properly)
  // ===========================================
  	
});
 
</script>
