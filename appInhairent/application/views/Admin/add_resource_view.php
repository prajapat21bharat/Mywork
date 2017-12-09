<?php
	$this->load->view('includes/admin_header');
	//echo"<pre>";print_r($this->session->userdata());
?>
        
<div class="contentpanel" >
	<div class="container clear_both padding_fix">
		<div class="row">
			<div class="col-sm-12 col-xs-12 left-space-r">
				<div class="breadcrums">
					<span>Resource > </span><a href="<?php echo site_url('admin/add_resource') ?>">Add Resource</a>
				</div>
				<div class="ad-haeding">
                     <h2 class="">Add Resource</h2>
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
						 
						<form action="<?php echo site_url()?>admin/add_resource" method="post" enctype="multipart/form-data">
							
							
							<div class="col-md-2">
							  <div class="form-group">
								<label class="title" for="inputEmail">Title <span class="mandetory"> *</span></label>
							  </div>
							</div>
							<div class="col-md-10">
							  <div class="form-group">
									<input type="text" placeholder="Title" id="title" class="form-control" value="<?php echo set_value('title'); ?>" name="title" onblur="this.placeholder = 'Title'" onfocus="this.placeholder = ''">
							  </div>
							</div>
						
							
							<div class="col-md-2">
							  <div class="form-group">
								<label class="title" for="inputEmail">Description </label>
							  </div>
							</div>
							<div class="col-md-10">
							  <div class="form-group">
								  <textarea placeholder="Description" id="description" class="form-control" value="" name="description" onblur="this.placeholder = 'Description'" onfocus="this.placeholder = ''" ><?php echo set_value('description'); ?></textarea>
							  </div>
							</div>
						
							
							<div class="col-md-2">
							  <div class="form-group">
								<label class="title" for="inputEmail">Resource File <span class="mandetory"> *</span></label>
							  </div>
							</div>
							<div class="col-md-10">
							  <div class="form-group">
									<input type="file" name="userfile" id="pic"  class="form-control" />
							  </div>
							</div>
							<div class="clearfix"></div>
							
							<div class="col-md-2">
							  <div class="form-group">
								<label class="title" for="res_cate_id">Resource Category <span class="mandetory"> *</span></label>
							  </div>
							</div>
							
							<div class="col-md-10">
							  <div class="form-group">
									<select name="res_cate_id" id="res_cate_id"  class="form-control">
										<option value="">Select Category</option>
										<?php
											if(!empty($allresource_categories))
											{
												foreach($allresource_categories as $category)
												{
										?>
												<option <?php echo set_select('res_cate_id', $category['id']); ?> value="<?php echo $category['id']?>"><?php echo $category['name'];?></option>
										<?php			
												}
											}
										?>
									</select>
							  </div>
							</div>
						
							
							<div class="col-md-2">
							  <div class="form-group">
								<label class="title" for="resource_type">Resource Type <span class="mandetory"> *</span></label>
							  </div>
							</div>
							
							<div class="col-md-10">
							  <div class="form-group">
									<select name="resource_type" id="resource_type"  class="form-control">
										<option value="">Select Type</option>
										<option value="multimedia" <?php echo set_select('resource_type','multimedia'); ?>>Multimedia (Video/Audio)</option>
										<option value="doc" <?php echo set_select('resource_type','doc'); ?>>Document (Word/PDF/PPt)</option>
										<option value="image" <?php echo set_select('resource_type','image'); ?>>Image</option>
									</select>
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
									<input type="submit" value="Add" class="btn-black-small square-btn-adjust addcatgry_submit" name="add">
								</div>
							</div>
						
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
