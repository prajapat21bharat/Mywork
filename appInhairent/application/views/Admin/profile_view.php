<?php
	$this->load->view('includes/admin_header');
	//echo"<pre>";print_r($profiledata);exit;
?>
        
	        
<div class="contentpanel changepass">
	<div class="container clear_both padding_fix">
		<div class="row">
			<div class="col-sm-12 col-xs-12 left-space-r">
				<div class="breadcrums">
					<span>Setting > </span><a href="<?php echo site_url('admin/profile') ?>">Profile</a>
				</div>
				<div class="block-web UpPword">
                     <h3>Update Profile</h3>
                     <?php
						if (isset($message))
						{
							echo $message;
						}
                     ?>
								<div class="message" style="margin:0px auto;"><?php  if($this->session->flashdata('Logmsg'))   echo  $this->session->flashdata('Logmsg'); ?></div>
								<div class="clearfix"></div>
								
								<form method="post" action="<?php echo site_url('admin/profile');?>">
									
									<div class="form-group col-md-3  col-xs-12">
										<label class="firstname" for="firstname">First Name <span class="mandetory"> *</span></label>
									</div>
									
									<div class="form-group  col-md-9  col-xs-12">
										<input type="text" placeholder="First Name" id="firstname" class="form-control" value="<?php echo set_value('firstname');?>" name="firstname" onblur="this.placeholder = 'First Name'" onfocus="this.placeholder = ''">
									</div>
									
									<div class="form-group col-md-3  col-xs-12">
										<label class="lastname" for="lastname">Last Name <span class="mandetory"> *</span></label>
									</div>
									
									<div class="form-group  col-md-9  col-xs-12">
										<input type="text" placeholder="Last Name" id="lastname" class="form-control" value="<?php echo set_value('lastname');?>" name="lastname" onblur="this.placeholder = 'Last Name'" onfocus="this.placeholder = ''">
									</div>
									
									
									<div class="form-group col-md-3  col-xs-12">
										<label class="email" for="email">Email <span class="mandetory"> *</span></label>
									</div>
									
									<div class="form-group  col-md-9  col-xs-12">
										<input type="text" placeholder="Email" id="email" class="form-control" value="<?php echo set_value('email');?>" name="email" onblur="this.placeholder = 'Email'" onfocus="this.placeholder = ''">
									</div>
									
									<div class="col-md-3 col-xs-12 spc-top-2">
										<input type="submit"  value="Update" class="btn btn-danger square-btn-adjust" name="update" id="update">
									</div>
								</form>
                </div>
           </div>
                 <!-- /. ROW  -->
                 
		</div>
             <!-- /. PAGE INNER  -->
	</div>
</div>
         <!-- /. PAGE WRAPPER  -->
<?php
	$this->load->view('includes/footer');
?>
