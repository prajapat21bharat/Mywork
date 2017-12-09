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
					<span>Resource > </span>
					<a href="<?php echo site_url('admin/resources') ?>">View Resources </a>
					<a href="<?php echo site_url()?>admin/editresource/<?php print $getresource[0]['id'];?>"> > Edit Resource </a>
				</div>
				<div class="ad-haeding">
                     <h2>Edit Resource</h2>
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
						 
						<form action="<?php echo site_url()?>admin/editresource/<?php print $getresource[0]['id'];?>" method="post" enctype="multipart/form-data">
							
							<div class="col-md-2">
							  <div class="form-group">
									<label class="title" for="inputEmail">Title <span class="mandetory"> *</span></label>
							  </div>
							</div>
							<div class="col-md-10">
							  <div class="form-group">
								<input type="text" placeholder="Title" id="title" class="form-control" value="<?php print $getresource[0]['title'];?>" name="title" onblur="this.placeholder = 'Title'" onfocus="this.placeholder = ''">
								<input type="hidden" id="resourceid" class="form-control" value="<?php print $getresource[0]['id'];?>" name="resourceid" >
							  </div>
							</div>
						
							<div class="col-md-2">
							  <div class="form-group">
								<label class="title" for="inputEmail">Description </label>
							  </div>
							</div>
							<div class="col-md-10">
							  <div class="form-group">
								  <textarea placeholder="Description" id="description" class="form-control" value="" name="description" onblur="this.placeholder = 'Description'" onfocus="this.placeholder = ''" ><?php print $getresource[0]['description'];?></textarea>
							  </div>
							</div>
							
							<div class="col-md-2">
							  <div class="form-group">
								<label class="title" for="inputEmail">Resource File <span class="mandetory"> *</span></label>
							  </div>
							</div>
							<div class="col-md-7">
							  <div class="form-group">
									<input type="file" name="userfile" id="file"  class="form-control" />
									<input type="hidden" name="old_resource" id="old_resource" value="<?php print $getresource[0]['resource_file']; ?>" />
									
							  </div>
							</div>
							<div class="col-md-3">
								<span><?php print $getresource[0]['resource_file']; ?></span>
							</div>
							<div class="clearfix"></div>
							
							<div class="form-group col-md-2">
								<label for="inputEmail">Resource Category <span class="mandetory"> *</span></label>
							</div>
							
							<div class="form-group  col-md-10">
								<select id="res_cate_id" name="res_cate_id"  class="form-control">
									<option value="">Select Category</option>
								<?php
									if(!empty($allresource_cate))
									{
										$i=0;
										foreach($allresource_cate as $category)
										{
									?>
										<option <?php if($getresource[0]['res_cate_id']==$category['id']){echo "selected";} ?> value="<?php print $category['id']; ?>" <?php echo set_select('res_cate_id', $category['id']); ?>><?php print $category['name'];?></option>
									<?php
											$i++;
										}
									}
								?>
								</select>
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
										<option value="multimedia" <?php if($getresource[0]['resource_type']=='Multimedia'){echo "selected";} ?>  >Multimedia (Video/Audio)</option>
										<option value="doc" <?php if($getresource[0]['resource_type']=='Doc'){echo "selected";} ?> >Document (Word/PDF/PPt)</option>
										<option value="image" <?php if($getresource[0]['resource_type']=='Image'){echo "selected";} ?> >Image</option>
									</select>
							  </div>
							</div>
						
							
							
							<div class="col-md-2">
								<div class="form-group">
									<label for="inputEmail">Status <span class="mandetory"> *</span></label>
								</div>
							</div>
							<div class="col-md-10">
								<div class="form-group">
									 &nbsp; &nbsp;
									<label class="radio-inline">
										<input type="radio" value="1" <?php if($getresource[0]['status']==1)echo "checked";?> name="status">
										Active
									</label>
										&nbsp; &nbsp; &nbsp; &nbsp;
									<label class="radio-inline">
										<input type="radio" value="0" <?php if($getresource[0]['status']==0)echo "checked";?> name="status">
										InActive
									</label>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<input type="submit" value="Update" class="btn-black-small square-btn-adjust" name="update">
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
