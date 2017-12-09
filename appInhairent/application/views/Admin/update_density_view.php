<?php
	$this->load->view('includes/admin_header');
	//echo "<pre>";print_r($getbrand);
	//echo"<pre>";print_r($this->session->userdata());
?>
        
        
<div class="contentpanel" >
	<div class="container clear_both padding_fix">
		<div class="row">
			<div class="col-sm-12 col-xs-12 left-space-r">
				<div class="breadcrums">
					<span>Densities > </span>
					<a href="<?php echo site_url('admin/viewdensity') ?>">View Densities ></a>
					<a href="<?php echo site_url()?>admin/editdensity/<?php print $getdensity[0]['id'];?>">Edit Density </a>
				</div>
				<div class="ad-haeding">
                     <h2>Edit Density</h2>
                     <?php
						if (isset($message))
						{
							echo $message;
						}
                     ?>
                     <div class="message" style="margin:0px auto;"><?php  if($this->session->flashdata('Logmsg'))   echo  $this->session->flashdata('Logmsg'); ?></div>
				</div>
                    </div>
                </div>
                 <!-- /. ROW  -->
                
                 <div class="row">
					<div class="col-md-12">
						 
						<form action="<?php echo site_url()?>admin/editdensity/<?php print $getdensity[0]['id'];?>" method="post">
							
								
							<div class="col-md-2">
							  <div class="form-group">
								<label for="inputEmail">Density Name <span class="mandetory"> *</span></label>
							  </div>
							</div>
							<div class="col-md-10">
							  <div class="form-group">
									<input type="text" placeholder="Density" id="density" class="form-control" value="<?php print $getdensity[0]['density'];?>" name="density" onblur="this.placeholder = 'Density'" onfocus="this.placeholder = ''">
									<input type="hidden" id="densityid" class="form-control" value="<?php print $getdensity[0]['id'];?>" name="densityid" >
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
										<input type="radio" value="1" <?php if($getdensity[0]['status']==1)echo "checked";?> name="status">
										Active
									</label>
										&nbsp; &nbsp; &nbsp; &nbsp;
									<label class="radio-inline">
										<input type="radio" value="0" <?php if($getdensity[0]['status']==0)echo "checked";?> name="status">
										InActive
									</label>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<input type="submit" value="Update" class="btn-black-small square-btn-adjust" name="update">
								</div>
							</div>
							
							<?php  /*?>
							
							<div class="form-group">
								<label for="density">Density Name <span class="mandetory"> *</span></label>
								<input type="text" placeholder="Density" id="density" class="form-control" value="<?php print $getdensity[0]['density'];?>" name="density" onblur="this.placeholder = 'Density'" onfocus="this.placeholder = ''">
								<input type="hidden" id="densityid" class="form-control" value="<?php print $getdensity[0]['id'];?>" name="densityid" >
							</div>
							
							<div class="form-group">
								<label for="inputEmail">Status <span class="mandetory"> *</span></label>
								<label class="radio-inline">
									<input type="radio" value="1" <?php if($getdensity[0]['status']==1)echo "checked";?> name="status">
									Active
                                </label>
								<label class="radio-inline">
									<input type="radio" value="0" <?php if($getdensity[0]['status']==0)echo "checked";?> name="status">
									InActive
                                </label>
							</div>
							<input type="submit" value="Update" class="btn-black-small square-btn-adjust" name="update">
							 
							<?php  */?>
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
