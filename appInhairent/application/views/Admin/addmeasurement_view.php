<?php
	$this->load->view('includes/admin_header');
	//echo"<pre>";print_r($this->session->userdata());
?>
        
        
<div class="contentpanel" >
	<div class="container clear_both padding_fix">
		<div class="row">
			<div class="col-sm-12 col-xs-12 left-space-r">
				<div class="breadcrums">
					<span>Measurement > </span><a href="<?php echo site_url('admin/measurement') ?>">Add Measurement</a>
				</div>
				<div class="block-web">
                     <h2>Add Measurement</h2>
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
						 
						<form action="<?php echo site_url()?>admin/measurement" method="post">
							<div class="form-group">
								<label for="inputEmail">Measurement <span class="mandetory"> *</span></label>
								<input type="text" placeholder="Measurement" id="measurement" class="form-control" value="<?php echo set_value('measurement'); ?>" name="measurement" onblur="this.placeholder = 'Measurement'" onfocus="this.placeholder = ''">
							</div>
							
							<!--<div class="form-group">
								<label for="inputEmail">Status <span class="mandetory"> *</span></label>
								<label class="radio-inline">
									<input type="radio" checked="" value="1" name="status">
									Active
                                </label>
								<label class="radio-inline">
									<input type="radio" checked="" value="0" name="status">
									InActive
                                </label>
							</div>-->
							<input type="submit" value="Add" class="btn-black-small square-btn-adjust" name="add">
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
