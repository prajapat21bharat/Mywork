<?php
	$this->load->view('includes/admin_header');
	
?>

<div class="contentpanel" >
	<div class="container clear_both padding_fix">
		<div class="row">
			<div class="col-sm-12 col-xs-12 left-space-r">
				<div class="breadcrums">
					<span>Products > </span><a href="<?php echo site_url('admin/addproduct') ?>">Add Product</a>
				</div>
				<div class="ad-haeding addpro">
                     <h2>Add Product</h2>
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
					<div class="col-md-12 col-xs-12">
						 
						<form action="<?php echo site_url()?>admin/addproduct" method="post" enctype="multipart/form-data">
							<div class="form-group col-md-3  col-xs-12">
								<label for="inputEmail">Product Categories <span class="mandetory"> *</span></label>
							</div>
							
							<div class="form-group  col-md-9  col-xs-12">
								<select id="category" name="category"  class="form-control">
									<option value="">Select Category</option>
								<?php
									if(!empty($allcategory))
									{
										$i=0;
										foreach($allcategory as $category)
										{
									?>
										<option value="<?php print $category['id']; ?>" <?php echo set_select('category', $category['id']); ?>><?php print $category['name'];?></option>
									<?php
											$i++;
										}
									}
									//else{echo"no";}
								?>
								</select>
							</div>
							
							<div class="form-group col-md-3  col-xs-12">
								<label for="inputEmail">Brands <span class="mandetory"> *</span></label>
							</div>
							
							<div class="form-group  col-md-9  col-xs-12">
								<select id="brand" name="brand" class="form-control">
									<option value="">Select Category</option>
								<?php
									if(!empty($allbrands))
									{
										$i=0;
										foreach($allbrands as $brand)
										{
									?>
										<option value="<?php print $brand['id']; ?>" <?php echo set_select('brand', $brand['id']); ?>><?php print $brand['name'];?></option>
									<?php
											$i++;
										}
										
									}
									//else{echo"no";}
								?>
								</select>
							</div>
							
							
							<div class="form-group col-md-3  col-xs-12 ">
								<label for="inputEmail">Product Name <span class="mandetory"> *</span></label>
							</div>
							
							<div class="form-group  col-md-9  col-xs-12">
								<input type="text" placeholder="Product Name" id="productname" class="form-control" value="<?php echo set_value('productname'); ?>" name="productname" onblur="this.placeholder = 'Product Name'" onfocus="this.placeholder = ''">
							</div>
								
							<div class="form-group col-md-3  col-xs-12">
								<label for="inputEmail">Product Description <span class="mandetory"></span></label>
							</div>
							
							<div class="form-group  col-md-9  col-xs-12">
								<textarea placeholder="Product Description" id="description" class="form-control" name="description" onblur="this.placeholder = 'Product Description'" onfocus="this.placeholder = ''"><?php echo set_value('description'); ?></textarea>
							</div>
							
							<div class="form-group col-md-3  col-xs-12">
								<label for="inputEmail">Photo Tags <span class="mandetory"> *</span></label>
							</div>
							
							<div class="form-group  col-md-9  col-xs-12 separator">
								<label class="col-md-6 col-sm-6" for="all_tags">
									<input type="checkbox" name="all_tags" value="1" id="all_tags"  <?php echo set_checkbox('all_tags', '1'); ?>  data-none="none_tags" data-class="sel_tags" />
									<span class="checkbox"></span>
									<strong>Select All </strong>
								</label>
								
								<label class="col-md-6 col-sm-6" for="none_tags">
									<input type="checkbox" name="none_tags" value="0" id="none_tags" <?php echo set_checkbox('none_tags', '0'); ?>  data-all="all_tags" data-class="sel_tags" />
									<span class="checkbox"></span>
									<strong>Deselect All </strong>
								</label>
								
								<?php
									foreach($alltags as $tag)
									{
								?>
										<label class="col-md-4 col-sm-4" for="tag-<?php print $tag['id']; ?>">
											<input type="checkbox" id="tag-<?php print $tag['id']; ?>" <?php echo set_checkbox('tags[]', $tag['id']); ?> name="tags[]" class="form-control select_tag sel_tags" value="<?php print $tag['id']; ?>"  />
											<span class="checkbox"></span>
											<?php print $tag['tagname'];?>
										</label>
								<?php
									}
								?>
							</div>
						
							
							<div class="form-group col-md-3  col-xs-12">
								<label for="inputEmail">Ethnicity <span class="mandetory"> *</span></label>
							</div>
							
							
							<div class="form-group  col-md-9  col-xs-12 separator">
								<label class="col-md-6 col-sm-6" for="all_ethnicity">
									<input type="checkbox" name="all_ethnicity" value="" id="all_ethnicity" <?php echo set_checkbox('all_ethnicity', ''); ?>  data-none="none_ethnicity" data-class="sel_ethnicity" />
									<span class="checkbox"></span>
									<strong>Select All </strong>
								</label>
								
								<label class="col-md-6 col-sm-6" for="none_ethnicity">
									<input type="checkbox" name="none_ethnicity" value="" id="none_ethnicity" <?php echo set_checkbox('none_ethnicity', ''); ?>  data-all="all_ethnicity" data-class="sel_ethnicity" />
									<span class="checkbox"></span>
									<strong>Deselect All </strong>
								</label>
									
								<?php
									foreach($allethnicity as $ethnicity)
									{
								?>
										<label class="col-md-4 col-sm-4" for="ethnicity-<?php print $ethnicity['id']; ?>">
											<input type="checkbox" id="ethnicity-<?php print $ethnicity['id']; ?>" <?php echo set_checkbox('ethnicitys[]', $ethnicity['id']); ?> name="ethnicitys[]" class="form-control select_tag sel_ethnicity" value="<?php print $ethnicity['id']; ?>"  />
											<span class="checkbox"></span>
											<?php print $ethnicity['ethnicity'];?>
										</label>
								<?php
									}
								?>
							</div>
							
							
						<?php /* ?>	
						
							<div class="form-group  col-md-9  col-xs-12">
								<select id="ethnicity" name="ethnicity"  class="form-control">
									<option value="">Select Ethnicity</option>
								<?php
									if(!empty($allethnicity))
									{
										$i=0;
										foreach($allethnicity as $ethnicity)
										{
									?>
										<option value="<?php print $ethnicity['id']; ?>" <?php echo set_select('ethnicity', $ethnicity['id']); ?>><?php print $ethnicity['ethnicity'];?></option>
									<?php
											$i++;
										}
									}
								?>
								</select>
							</div>
						<?php */ ?>
						
							<div class="form-group col-md-3  col-xs-12">
								<label for="inputEmail">Texture <span class="mandetory"> *</span></label>
							</div>
							
							
							<div class="form-group  col-md-9  col-xs-12 separator">
								<label class="col-md-6 col-sm-6" for="all_texture">
									<input type="checkbox" name="all_texture" value="" id="all_texture" <?php echo set_checkbox('all_texture', ''); ?> data-none="none_texture" data-class="sel_texture" />
									<span class="checkbox"></span>
									<strong>Select All </strong>
								</label>
								
								<label class="col-md-6 col-sm-6" for="none_texture">
									<input type="checkbox" name="none_texture" value="" id="none_texture" <?php echo set_checkbox('none_texture', ''); ?>  data-all="all_texture" data-class="sel_texture" />
									<span class="checkbox"></span>
									<strong>Deselect All </strong>
								</label>
										
								<?php
									foreach($alltexture as $texture)
									{
								?>
										<label class="col-md-4 col-sm-4" for="texture-<?php print $texture['id']; ?>">
											<input type="checkbox" id="texture-<?php print $texture['id']; ?>" <?php echo set_checkbox('textures[]', $texture['id']); ?> name="textures[]" class="form-control select_tag sel_texture" value="<?php print $texture['id']; ?>"  />
											<span class="checkbox"></span>
											<?php print $texture['texture'];?>
										</label>
								<?php
									}
								?>
							</div>
							
							<?php /*?>
							<div class="form-group  col-md-9  col-xs-12">
								<select id="texture" name="texture"  class="form-control">
									<option value="">Select Texture</option>
								<?php
									if(!empty($alltexture))
									{
										$i=0;
										foreach($alltexture as $texture)
										{
									?>
										<option value="<?php print $texture['id']; ?>" <?php echo set_select('texture', $texture['id']); ?>><?php print $texture['texture'];?></option>
									<?php
											$i++;
										}
									}
								?>
								</select>
							</div>
						
						<?php */?>
							<div class="form-group col-md-3  col-xs-12">
								<label for="inputEmail">Color <span class="mandetory"> *</span></label>
							</div>
							
							<div class="form-group  col-md-9  col-xs-12 separator">
								<label class="col-md-6 col-sm-6" for="all_color">
									<input type="checkbox" name="all_color" value="" id="all_color" <?php echo set_checkbox('all_color', ''); ?> data-none="none_color" data-class="sel_color" />
									<span class="checkbox"></span>
									<strong>Select All </strong>
								</label>
								
								<label class="col-md-6 col-sm-6" for="none_color">
									<input type="checkbox" name="none_color" value="" <?php echo set_checkbox('none_color', ''); ?>  id="none_color" data-all="all_color" data-class="sel_color" />
									<span class="checkbox"></span>
									<strong>Deselect All </strong>
								</label>
										
								<?php
									foreach($allcolor as $color)
									{
								?>
										<label class="col-md-4 col-sm-4" for="color-<?php print $color['id']; ?>">
											<input type="checkbox" id="color-<?php print $color['id']; ?>" <?php echo set_checkbox('colors[]', $color['id']); ?> name="colors[]" class="form-control select_tag sel_color" value="<?php print $color['id']; ?>"  />
											<span class="checkbox"></span>
											<?php print $color['name'];?>
										</label>
								<?php
									}
								?>
							</div>
							
							<?php /*?>
							<div class="form-group  col-md-9  col-xs-12">
								<select id="color" name="color"  class="form-control">
									<option value="">Select Color</option>
								<?php
									if(!empty($allcolor))
									{
										$i=0;
										foreach($allcolor as $color)
										{
									?>
										<option value="<?php print $color['name']; ?>" <?php echo set_select('color', $color['name']); ?>><?php print $color['name'];?></option>
									<?php
											$i++;
										}
									}
								?>
								</select>
							</div>
							<?php */?>
						
							<div class="form-group col-md-3  col-xs-12">
								<label for="inputEmail">Density <span class="mandetory"> *</span></label>
							</div>
							
							<div class="form-group  col-md-9  col-xs-12">
								<label class="col-md-6 col-sm-6" for="all_density">
									<input type="checkbox" name="all_density" value="" id="all_density" <?php echo set_checkbox('all_density', ''); ?>  data-none="none_density" data-class="sel_density" />
									<span class="checkbox"></span>
									<strong>Select All </strong>
								</label>
										
								<label class="col-md-6 col-sm-6" for="none_density">
									<input type="checkbox" name="none_density" value="" <?php echo set_checkbox('none_density', ''); ?>  id="none_density" data-all="all_density" data-class="sel_density" />
									<span class="checkbox"></span>
									<strong>Deselect All </strong>
								</label>
										
								<?php
									foreach($alldensity as $density)
									{
								?>
										<label class="col-md-4 col-sm-4" for="density-<?php print $density['id']; ?>">
											<input type="checkbox" id="density-<?php print $density['id']; ?>" <?php echo set_checkbox('densitys[]', $density['id']); ?> name="densitys[]" class="form-control select_tag sel_density" value="<?php print $density['id']; ?>"  />
											<span class="checkbox"></span>
											<?php print $density['density'];?>
										</label>
								<?php
									}
								?>
							</div>
							
							<?php /*?>
								<div class="form-group  col-md-9  col-xs-12">
									<select id="density" name="density"  class="form-control">
										<option value="">Select Density</option>
									<?php
										if(!empty($alldensity))
										{
											$i=0;
											foreach($alldensity as $density)
											{
										?>
											<option value="<?php print $density['density']; ?>" <?php echo set_select('density', $density['density']); ?>><?php print $density['density'];?></option>
										<?php
												$i++;
											}
										}
									?>
									</select>
								</div>
							<?php */?>
						
							<div class="form-group col-md-3  col-xs-12">
								<label for="inputEmail">Price </label>
							</div>
							
							<div class="form-group  col-md-9  col-xs-12">
								<input type="text" placeholder="Price" id="price" class="form-control" value="<?php echo set_value('price'); ?>" name="price" onblur="this.placeholder = 'Price'" onfocus="this.placeholder = ''">
							</div>
							
							<div class="form-group col-md-3  col-xs-12">
								<label for="inputEmail">Product Image </label>
							</div>
							
							<div class="form-group  col-md-9  col-xs-12">
								<input type="file" id="pic" class="form-control" value="<?php echo set_value('pic'); ?>" name="pic"  >
							</div>
							
							
							<div class="clearfix"></div>
							<div class="form-group col-md-3  col-xs-12">
								<label for="inputEmail">Status <span class="mandetory"> *</span></label>
							</div>
							
							<!--<div class="form-group  col-md-9  col-xs-12">
								<label class="radio-inline">
									<input type="radio"  value="1" <?php //echo set_radio('status', '1'); ?> name="status">
									Active
                                </label>
								<label class="radio-inline">
									<input type="radio"  value="0" <?php //echo set_radio('status', '0'); ?> name="status">
									InActive
                                </label>
							</div>-->
							
							<div class="col-md-9  col-xs-12">
								<div class="form-group">
									
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
							
						<div class="form-group col-md-12  col-xs-12">
							<input type="submit" value="Add" class="btn-black-small square-btn-adjust add_submit" name="add">
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

<script>
	$(document).ready(function(){
		
	});
	
	$('#all_density, #all_color, #all_texture, #all_ethnicity, #all_tags').on('change',function(){
		var id=$(this).attr('id');
		var data_class=$(this).attr('data-class');
		var data_none=$(this).attr('data-none');
		if(this.checked)
		{
			$('#'+data_none).prop('checked',false);
			check_all(data_class);
		}
		else
		{
			uncheck_all(data_class);
		}
	})
	
	$('#none_density, #none_color, #none_texture, #none_ethnicity, #none_tags').on('change',function(){
		var id=$(this).attr('id');
		var data_class=$(this).attr('data-class');
		var data_all=$(this).attr('data-all');
		if(this.checked)
		{
			uncheck_all(data_class);
			$('#'+data_all).prop('checked',false);
		}
	});
	
	function check_all(ele_class)
	{
		$('.'+ele_class).each(function() { //loop through each checkbox
			this.checked = true;  //select all checkboxes with class "del_pic"              
		});
	}
	
	
	function uncheck_all(ele_class)
	{
		$('.'+ele_class).each(function() { //loop through each checkbox
			this.checked = false; //deselect all checkboxes with class "del_pic"                      
		});
	}
	

</script>
