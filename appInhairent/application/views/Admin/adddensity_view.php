<?php
	$this->load->view('includes/admin_header');
	//echo"<pre>";print_r($this->session->userdata());
?>
        
        
<div class="contentpanel" >
	<div class="container clear_both padding_fix">
		<div class="row">
			<div class="col-sm-12 col-xs-12 left-space-r">
				<div class="breadcrums">
					<span>Densities > </span><a href="<?php echo site_url('admin/adddensity') ?>">Add Density</a>
				</div>
				<div class="ad-haeding">
                     <h2>Add Density</h2>
                     <?php
						if (isset($message))
						{
							echo $message;
						}
                     ?>
                    </div>
                    </div>
                    
                </div>
                 <!-- /. ROW  -->
                
                 <div class="row">
					<div class="col-md-12">
						 
						<form action="<?php echo site_url()?>admin/adddensity" method="post">
							
								
							<div class="col-md-2">
							  <div class="form-group">
								<label for="inputEmail">Density Name <span class="mandetory"> *</span></label>
							  </div>
							</div>
							<div class="col-md-10">
							  <div class="form-group">
									<input type="text" placeholder="Density Name" id="density" class="form-control" value="<?php echo set_value('density'); ?>" name="density" onblur="this.placeholder = 'Density Name'" onfocus="this.placeholder = ''">
							  </div>
							</div>
						
							<div class="clearfix"></div>
							<div class="col-md-2">
								<div class="form-group">
									<label for="inputEmail">Status <span class="mandetory"> *</span></label>
								</div>
							</div>
							<div class="col-md-10">
								<div class="form-group">
									 &nbsp; &nbsp;
									<label class="radio-inline">
										<input type="radio" value="1" name="status" <?php echo set_radio('status', '1'); ?>>
										Active
									</label>
										&nbsp; &nbsp; &nbsp; &nbsp;
									<label class="radio-inline">
										<input type="radio" value="0" name="status" <?php echo set_radio('status', '0'); ?>>
										InActive
									</label>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<input type="submit" value="Add" class="btn btn-danger square-btn-adjust" name="add">
								</div>
							</div>
							
							
							
							<!--
							<div class="form-group">
								<label for="inputEmail">Density Name <span class="mandetory"> *</span></label>
								<input type="text" placeholder="Density Name" id="density" class="form-control" value="<?php //echo set_value('density'); ?>" name="density" onblur="this.placeholder = 'Density Name'" onfocus="this.placeholder = ''">
							</div>
							
							<div class="form-group">
								<label for="inputEmail">Status <span class="mandetory"> *</span></label>
								<label class="radio-inline">
									<input type="radio" value="1" name="status">
									Active
                                </label>
								<label class="radio-inline">
									<input type="radio" value="0" name="status">
									InActive
                                </label>
							</div>
							<input type="submit" value="Add" class="btn btn-danger square-btn-adjust" name="add">
							-->
						</form>
					</div>
				</div>
			
			</div>
             <!-- /. PAGE INNER  -->
		</div>
         <!-- /. PAGE WRAPPER  -->
<?php
	$this->load->view('includes/footer');
?>
