<?php
	$this->load->view('includes/admin_header');
	//echo"<pre>";print_r($profiledata);exit;
?>
        
	        
<div class="contentpanel changepass">
	<div class="container clear_both padding_fix">
		<div class="row">
			<div class="col-sm-12 col-xs-12 left-space-r">
				<div class="breadcrums">
					<span>Setting > </span><a href="<?php echo site_url('admin/avtar') ?>">Profile Pic</a>
				</div>
				<div class="block-web UpPword">
                     <!--<h3>Update Profile</h3>-->
                     <?php
						if (isset($message))
						{
							echo $message;
						}
                     ?>
								<div class="message" style="margin:0px auto;"><?php  if($this->session->flashdata('Logmsg'))   echo  $this->session->flashdata('Logmsg'); ?></div>
								<div class="clearfix"></div>
								
								<form method="post" action="<?php echo site_url('admin/avtar');?>" enctype="multipart/form-data">
									
									<div class="form-group col-md-3  col-xs-12">
									</div>
									
									<div class="form-group  col-md-9  col-xs-12">
										<?php
											if(!empty($profiledata[0]['image']))
											{
												$src=$profiledata[0]['image'];
											}
											else
											{
												$src='';
											}
										?>
										<img src="<?php echo base_url('assets/avtars/thumbnail/113x113/'.$src);?>" height="80px" />
									</div>
									
									<div class="form-group col-md-3  col-xs-12">
										<label class="pic" for="pic">Picture <span class="mandetory"> *</span></label>
									</div>
									
									<div class="form-group  col-md-9  col-xs-12">
										<input type="file" name="userfile" id="pic"  class="form-control" />
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
