<?php
	$this->load->view('includes/admin_header');
?>
        
	        
<div class="contentpanel changepass">
	<div class="container clear_both padding_fix">
		<div class="row">
			<div class="col-sm-12 col-xs-12 left-space-r">
				<div class="breadcrums">
					<span>Change Password > </span><a href="<?php echo site_url('admin/changepassword') ?>">Change Password</a>
				</div>
				<div class="block-web UpPword">
                     <h3>Update Password</h3>
                     <?php
						if (isset($message))
						{
							echo $message;
						}
                     ?>
								<div class="message" style="margin:0px auto;"><?php  if($this->session->flashdata('Logmsg'))   echo  $this->session->flashdata('Logmsg'); ?></div>
								<div class="clearfix"></div>
								
								<form method="post" action="<?php echo site_url('admin/changepassword');?>">
								<div class="col-md-3 col-xs-12">               
									
										<div class="form-group">
										<label class="cpwd">Current Password</label>
										<input type="password" placeholder="Current Password" id="currentpassword" class="form-control" value="<?php echo set_value('currentpassword'); ?>" name="currentpassword" onblur="this.placeholder = 'Current Password'" onfocus="this.placeholder = ''" disabled="" />
										</div>
									
								</div>
								
								<div class="col-md-3 col-xs-12">               
									
										<div class="form-group">
											<label class="cpwd">New Password</label>
											<input type="password" placeholder="New Password" id="newpassword" class="form-control" value="<?php echo set_value('newpassword'); ?>" name="newpassword" onblur="this.placeholder = 'New Password'" onfocus="this.placeholder = ''" disabled="" />
										</div>
									
								</div>
								
								<div class="col-md-3 col-xs-12">               
									
										<div class="form-group">
											<label class="cpwd">Re-Type Password</label>
											<input type="password" placeholder="Confirm Password" id="confirmpassword" class="form-control" value="<?php echo set_value('confirmpassword'); ?>" name="confirmpassword" onblur="this.placeholder = 'Confirm Password'" onfocus="this.placeholder = ''" disabled="" />
										</div>
									
								</div>
								
								<div class="col-md-3 col-xs-12 spc-top-2">
									<input type="submit" style="display:none !important;" value="Change Password" class="btn btn-danger square-btn-adjust" name="change" id="btn_changepassword">
									<button class="btn btn-danger square-btn-adjust Change_Pword" id="show_field_change" style="display:none;">Change Password</button>
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
