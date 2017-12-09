<?php
	$this->load->view('includes/admin_header');
	
	
//	echo "<pre>";print_r($getproduct);
	//echo"<pre>";print_r($this->session->userdata());
?>
        
        
<div class="contentpanel" >
	<div class="container clear_both padding_fix">
		<div class="row">
			<div class="col-sm-12 col-xs-12 left-space-r">
				<div class="breadcrums">
					<span>Products > </span>
					<a href="<?php echo site_url('admin/viewproduct') ?>">View Products ></a>
					<a href="<?php echo site_url()?>admin/editproduct/<?php print $getproduct[0]['id'];?>">Edit Product </a>
				</div>
				<div class="ad-haeding">
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
					<div class="col-md-12">
						 
						<form action="<?php echo site_url().'admin/editproduct/'.@$getproduct[0]['id']?>"method="post"  enctype="multipart/form-data">
							<div class="form-group col-md-3">
								<label for="inputEmail">Product Categories <span class="mandetory"> *</span></label>
							</div>
							
							<div class="form-group  col-md-9">
								<select id="category" name="category"  class="form-control">
									<option value="">Select Category</option>
								<?php
									if(!empty($allcategory))
									{
										$tagarray=explode(',',$getproduct[0]['tagid']);
										
										$i=0;
										foreach($allcategory as $category)
										{
										
									?>
										<option <?php if($getproduct[0]['categoryid']==$category['id']){echo "selected";} ?> value="<?php print $category['id']; ?>" <?php echo set_select('category', $category['id']); ?>><?php print $category['name'];?></option>
									<?php
											$i++;
										}
									}
									//else{echo"no";}
								?>
								</select>
							</div>
							
							<div class="form-group col-md-3">
								<label for="inputEmail">Brands <span class="mandetory"> *</span></label>
							</div>
							
							<div class="form-group  col-md-9">
								<select id="brand" name="brand"  class="form-control">
									<option value="">Select Brand</option>
								<?php
									if(!empty($allbrands))
									{
										$i=0;
										foreach($allbrands as $brand)
										{
									?>
										<option <?php if($getproduct[0]['brand_id']==$brand['id']){echo "selected";} ?> value="<?php print $brand['id']; ?>" <?php echo set_select('brand', $brand['id']); ?>><?php print $brand['name'];?></option>
									<?php
											$i++;
										}
										
									}
									//else{echo"no";}
								?>
								</select>
							</div>
							
							
							<div class="form-group col-md-3">
								<label for="inputEmail">Product Name <span class="mandetory"> *</span></label>
							</div>
							
							<div class="form-group  col-md-9">
								<input type="text" placeholder="Product Name" id="productname" class="form-control" value="<?php @print $getproduct[0]['name'];// echo set_value('productname'); ?>" name="productname" onblur="this.placeholder = 'Product Name'" onfocus="this.placeholder = ''">
								<input type="hidden" id="productid" class="form-control" value="<?php @print $getproduct[0]['id'];?>" name="productid" >
							</div>
							
							<div class="form-group col-md-3">
								<label for="inputEmail">Product Description <span class="mandetory"></span></label>
							</div>
							
							<div class="form-group  col-md-9">
								<textarea placeholder="Product Description" id="description" class="form-control" name="description" onblur="this.placeholder = 'Product Description'" onfocus="this.placeholder = ''"> <?php @print $getproduct[0]['description'];?> <?php echo set_value('description'); ?></textarea>
							</div>
							
												
							<div class="form-group col-md-3">
								<label for="inputEmail">Photo Tags <span class="mandetory"> *</span></label>
							</div>
							
							<div class="form-group  col-md-9 separator">
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
									if(!empty($alltags))
									{
										$tagarray=explode(',',$getproduct[0]['tagid']);
										//echo"<pre>";print_r($tagarray);
										$i=0;
										foreach($alltags as $tag)
										{
											$e_array=array();
											foreach($tagarray as $value)
											{
												if(!in_array($value,$e_array))
												{
													array_push($e_array,$value);
												}
											}
											
											if(in_array($tag['id'],$e_array))
											{
												$checked="checked";
											}
											else
											{
												$checked='';
											}
								?>
										<label class="col-md-4 col-sm-4" for="tag-<?php print $tag['id']; ?>">
											<input type="checkbox" id="tag-<?php print $tag['id']; ?>" <?php echo set_checkbox('tags[]', $tag['id']); ?> name="tags[]" class="form-control select_tag sel_tags" value="<?php print $tag['id']; ?>" <?php @print $checked;?> />
											<span class="checkbox"></span>
											<?php print $tag['tagname'];?>
										</label>
								<?php	
											$i++;
										}
									}
								?>
							</div>
							
														
							<div class="form-group col-md-3">
								<label for="inputEmail">Ethnicity <span class="mandetory"> *</span></label>
							</div>
							
							<div class="form-group  col-md-9 separator">
								
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
									if(!empty($allethnicity))
									{
										$ethnicityarray=explode(',',$getproduct[0]['ethnicity']);
										//echo"<pre>";print_r($ethnicityarray);
										$i=0;
										foreach($allethnicity as $ethnicity)
										{
											$e_array=array();
											foreach($ethnicityarray as $value)
											{
												if(!in_array($value,$e_array))
												{
													array_push($e_array,$value);
												}
											}
											
											if(in_array($ethnicity['id'],$e_array))
											{
												$checked="checked";
											}
											else
											{
												$checked='';
											}
								?>
										<label class="col-md-4 col-sm-4" for="ethnicity-<?php print $ethnicity['id']; ?>">
											<input type="checkbox" id="ethnicity-<?php print $ethnicity['id']; ?>" <?php echo set_checkbox('ethnicitys[]', $ethnicity['id']); ?> name="ethnicitys[]" class="form-control select_tag sel_ethnicity" value="<?php print $ethnicity['id']; ?>" <?php @print $checked;?> />
											<span class="checkbox"></span>
											<?php print $ethnicity['ethnicity'];?>
										</label>
								<?php		
										$i++;
									
										}
									}
								?>
							</div>
							
							<?php /*?>
							<div class="form-group  col-md-9">
								<select id="ethnicity" name="ethnicity"  class="form-control">
									<option value="">Select Ethnicity</option>
								<?php
									if(!empty($allethnicity))
									{
										foreach($allethnicity as $ethnicity)
										{
									?>
										<option <?php if(@$getproduct[0]['ethnicity']==@$ethnicity['id']){echo "selected";} ?> value="<?php print $ethnicity['id']; ?>" <?php echo set_select('ethnicity', @$ethnicity['id']); ?>><?php print $ethnicity['ethnicity'];?></option>
									<?php
										}
									}
								?>
								</select>
							</div>
							<?php */?>
							
							<div class="form-group col-md-3">
								<label for="inputEmail">Texture <span class="mandetory"> *</span></label>
							</div>
							
							<div class="form-group  col-md-9 separator">
								
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
									if(!empty($alltexture))
									{
										$texturearray=explode(',',$getproduct[0]['texture']);
										//echo"<pre>";print_r($ethnicityarray);
										$i=0;
										foreach($alltexture as $texture)
										{
											$e_array=array();
											foreach($texturearray as $value)
											{
												if(!in_array($value,$e_array))
												{
													array_push($e_array,$value);
												}
											}
											
											if(in_array($texture['id'],$e_array))
											{
												$checked="checked";
											}
											else
											{
												$checked='';
											}
								?>
										<label class="col-md-4 col-sm-4" for="texture-<?php print $texture['id']; ?>">
											<input type="checkbox" id="texture-<?php print $texture['id']; ?>" <?php echo set_checkbox('textures[]', $texture['id']); ?> name="textures[]" class="form-control select_tag sel_texture" value="<?php print $texture['id']; ?>" <?php @print $checked;?> />
											<span class="checkbox"></span>
											<?php print $texture['texture'];?>
										</label>
								<?php		
										$i++;
									
										}
									}
								?>
							</div>
							
							
							<?php /*?>
							<div class="form-group  col-md-9">
								<select id="texture" name="texture"  class="form-control">
									<option value="">Select Texture</option>
								<?php
									if(!empty($alltexture))
									{
										foreach($alltexture as $texture)
										{
									?>
										<option <?php if(@$getproduct[0]['texture']==@$texture['id']){echo "selected";} ?> value="<?php print $texture['id']; ?>" <?php echo set_select('texture', @$texture['id']); ?>><?php print $texture['texture'];?></option>
									<?php
										}
									}
								?>
								</select>
							</div>
							<?php */?>
							
							<div class="form-group col-md-3">
								<label for="inputEmail">Color <span class="mandetory"> *</span></label>
							</div>
									
							<div class="form-group  col-md-9 separator">
								
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
									if(!empty($allcolor))
									{
										$colorarray=explode(',',$getproduct[0]['color']);
										//echo"<pre>";print_r($ethnicityarray);
										$i=0;
										foreach($allcolor as $color)
										{
											$e_array=array();
											foreach($colorarray as $value)
											{
												if(!in_array($value,$e_array))
												{
													array_push($e_array,$value);
												}
											}
											
											if(in_array($color['id'],$e_array))
											{
												$checked="checked";
											}
											else
											{
												$checked='';
											}
								?>
										<label class="col-md-4 col-sm-4" for="color-<?php print $color['id']; ?>">
											<input type="checkbox" id="color-<?php print $color['id']; ?>" <?php echo set_checkbox('colors[]', $color['id']); ?> name="colors[]" class="form-control select_tag sel_color" value="<?php print $color['id']; ?>" <?php @print $checked;?> />
											<span class="checkbox"></span>
											<?php print $color['name'];?>
										</label>
								<?php		
										$i++;
									
										}
									}
								?>
							</div>
							
							<?php /*?>
							<div class="form-group  col-md-9">
								<select id="color" name="color"  class="form-control">
									<option value="">Select Color</option>
								<?php
									if(!empty($allcolor))
									{
										foreach($allcolor as $color)
										{
											
									?>
										<option <?php if(@$getproduct[0]['color']==@$color['name']){echo "selected";} ?> value="<?php print $color['name']; ?>" <?php echo set_select('color', @$color['name']); ?>><?php print $color['name'];?></option>
									<?php
										}
									}
								?>
								</select>
							</div>
							<?php */?>
							
							<div class="form-group col-md-3">
								<label for="inputEmail">Density <span class="mandetory"> *</span></label>
							</div>
											
							<div class="form-group  col-md-9">
								
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
									if(!empty($alldensity))
									{
										$densityarray=explode(',',$getproduct[0]['density']);
										//echo"<pre>";print_r($ethnicityarray);
										$i=0;
										foreach($alldensity as $density)
										{
											$e_array=array();
											foreach($densityarray as $value)
											{
												if(!in_array($value,$e_array))
												{
													array_push($e_array,$value);
												}
											}
											
											if(in_array($density['id'],$e_array))
											{
												$checked="checked";
											}
											else
											{
												$checked='';
											}
								?>
										<label class="col-md-4 col-sm-4" for="density-<?php print $density['id']; ?>">
											<input type="checkbox" id="density-<?php print $density['id']; ?>" <?php echo set_checkbox('densitys[]', $density['id']); ?> name="densitys[]" class="form-control select_tag sel_density" value="<?php print $density['id']; ?>" <?php @print $checked;?> />
											<span class="checkbox"></span>
											<?php print $density['density'];?>
										</label>
								<?php		
										$i++;
									
										}
									}
								?>
							</div>
							
							<?php /*?>
							<div class="form-group  col-md-9">
								<select id="density" name="density"  class="form-control">
									<option value="">Select Density</option>
								<?php
									if(!empty($alldensity))
									{
										foreach($alldensity as $density)
										{
											
									?>
										<option <?php if(@$getproduct[0]['density']==@$density['density']){echo "selected";} ?> value="<?php print $density['density']; ?>" <?php echo set_select('density', @$density['density']); ?>><?php print $density['density'];?></option>
									<?php
										}
									}
								?>
								</select>
							</div>
							<?php */?>
							
							<div class="form-group col-md-3">
								<label for="inputEmail">Price </label>
							</div>
							
							<div class="form-group  col-md-9">
								<input type="text" placeholder="Price" id="price" class="form-control" value="<?php @print $getproduct[0]['price']; //echo set_value('price'); ?>" name="price" onblur="this.placeholder = 'Price'" onfocus="this.placeholder = ''">
							</div>
							
							<div class="form-group col-md-3  col-xs-12">
								<label for="inputEmail">Product Image </label>
							</div>
							
							<div class="form-group  col-md-9  col-xs-12">
								<input type="file" id="pic" class="form-control" value="" name="pic" >
								<input type="hidden" name="old_img" id="old_img" value="<?php @print $getproduct[0]['image'];?>" />
							</div>
							
							<div class="clearfix"></div>
							<div class="form-group col-md-3">
								<label for="inputEmail">Status <span class="mandetory"> *</span></label>
							</div>
							
							<div class="form-group  col-md-9">
								<label class="radio-inline">
									<input type="radio" value="1" <?php if(@$getproduct[0]['status']==1)echo "checked";?> name="status">
									Active
                                </label>
								<label class="radio-inline">
									<input type="radio" value="0" <?php if(@$getproduct[0]['status']==0)echo "checked";?> name="status">
									InActive
                                </label>
							</div>
							
						<div class="form-group col-md-12">
							<input type="submit" value="Update" class="btn-black-small square-btn-adjust" name="update">
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
