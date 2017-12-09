<?php
	$this->load->view('includes/loggedin_header');
//	echo"<pre>";print_r($favorite_style);exit;
?>
        
<div class="contentpanel" >
<?php
	//$this->load->view('Stylist/include/subscribe_block');
?>
	<div class="container clear_both padding_fix top_space">
		<div class="row">
			<div class="col-lg-9 col-md-12 col-sm-12 col-xs-12 left-space-r">
				<div class="block-web">
					
                	<?php
                    	$sessionid=$this->session->userdata('id');
						$data['username']=$this->user_model->get_joins('tbl_user', array('id'=>$sessionid));
						//print_r($data['username']);
					?>
					<h2>Hello, <?php print $data['username'][0]['firstname'].' '.$data['username'][0]['lastname']?></h2>
					 <div class="col-md-12">
						<?php
							if (isset($message))
							{
								echo $message;
							}
							
						?>
					</div>
					<div class="panel-body">
						<?php $this->load->view('Stylist/include/tabbedmenu'); ?>
                        
						<div class="diff_top">
							<h3>Client > <?php @print $clientinfo[0]['firstname'].' '.$clientinfo[0]['lastname']; ?></h3>
							<a href="<?php echo site_url()?>stylist/viewclient">Back to Clients</a>
						</div>
						
						<div id="myTabContent" class="tab-content">
							<!----Section for Main content start ---->
							<div class="message" style="margin:0px auto;">
								<?php  if($this->session->flashdata('Logmsg'))   echo  $this->session->flashdata('Logmsg'); ?>
							</div>
                             <div class="sprate-D"></div>
								<form method="post" action="<?php echo site_url()?>stylist/manageclient/<?php  @print $clientinfo[0]['user_id']; ?>"  accept="image/*" enctype="multipart/form-data" >
							<a href="javascript:void(0)"  class="a-client-info" data-display='block' id="client-info">
								<h4>Client Information</h4>
							</a>
							<div class="accordian-content accordian" id="container-client-info">
								<div class="form-group col-md-3 col-sm-3">
									<label for="inputEmail">First Name <span class="mandetory"> *</span></label>
								</div>
								
								<div class="form-group  col-md-9 col-sm-6">
									<input type="text" placeholder="First Name" id="firstname" class="form-control" value="<?php @print $clientinfo[0]['firstname']; ?>" name="firstname" onblur="this.placeholder = 'First Name'" onfocus="this.placeholder = ''">
								</div>
							<div class="clearfix"></div>
								<div class="form-group col-md-3 col-sm-3">
									<label for="inputEmail">Last Name <span class="mandetory"> *</span></label>
								</div>
								
								<div class="form-group  col-md-9 col-sm-6">
									<input type="text" placeholder="Last Name" id="lastname" class="form-control" value="<?php  @print $clientinfo[0]['lastname']; ?>" name="lastname" onblur="this.placeholder = 'Last Name'" onfocus="this.placeholder = ''">
								</div>
							<div class="clearfix"></div>
								<div class="form-group col-md-3 col-sm-3">
									<label for="inputEmail">Email <span class="mandetory"> *</span></label>
								</div>
								
								<div class="form-group  col-md-9 col-sm-6">
									<input type="text" placeholder="Email" id="email" class="form-control" value="<?php  @print $clientinfo[0]['email']; ?>" name="email" onblur="this.placeholder = 'Email'" onfocus="this.placeholder = ''">
									<input type="hidden" id="uid" class="form-control" value="<?php  @print $clientinfo[0]['user_id']; ?>" name="uid" >
								</div>
<div class="clearfix"></div>
								<div class="form-group col-md-3 col-sm-3">
									<label for="inputEmail">Phone Number<span class="mandetory"> *</span></label>
								</div>
								
								<div class="form-group  col-md-9 col-sm-6">
									<input type="text" placeholder="Phone Number" id="contactno" class="form-control" value="<?php  @print $clientinfo[0]['contactno']; ?>" name="contactno" onblur="this.placeholder = 'Phone Number'" onfocus="this.placeholder = ''"  onkeyup="GetPhoneFormat('contactno')"   maxlength="14">
								</div>
								<div class="clearfix"></div>
								<div class="form-group col-md-3 col-sm-3">
									<label for="inputEmail">Ethnicity <span class="mandetory"> *</span></label>
								</div>
								
								<div class="form-group  col-md-9 col-sm-6">
									<select class="form-control" name="ethnicity">
										<option value="">Select Ethnicity</option>
										<?php
											//echo"<pre>";print_r($allethnicity);exit;
											foreach($allethnicity as $ethnicity)
											{
												if($clientinfo[0]['ethnicity']==$ethnicity['id'])
												{
													$select="selected";
												}
												else
												{
													$select="";
												}
										?>
										<option value="<?php print $ethnicity['id'];?>" <?php @print $select;?> ><?php print $ethnicity['ethnicity'];?></option>
										<?php
											}
										?>
									</select>
								</div>
							<div class="clearfix"></div>
								<div class="form-group col-md-3 col-sm-3">
									<label for="inputEmail">Gender <span class="mandetory"> *</span></label>
								</div>
								
								<div class="form-group  col-md-9 col-sm-6">
									<select class="form-control" name="gender">
										<option value="">Select Gender</option>
										<?php
												if($clientinfo[0]['gender']=="Male")
												{
													$gender1="selected";
												}
												elseif($clientinfo[0]['gender']=="Female")
												{
													$gender2="selected";
												}
												else
												{
													$gender="";
												}
										?>
										<option value="Male" <?php @print $gender1; ?>  >Male</option>
										<option value="Female" <?php @print $gender2; ?>  >Female</option>
									</select>
								</div>
							<div class="clearfix"></div>
								<div class="form-group col-md-3 col-sm-3">
									<label for="inputEmail">Age Range <span class="mandetory"> *</span></label>
								</div>
								
								<div class="form-group  col-md-9 col-sm-6">
									<select class="form-control" name="age" id="age_range">
									<?php	
										if($clientinfo[0]['age']=="0-5")
										{
											$age1="selected";
										}
										elseif($clientinfo[0]['age']=="6-15")
										{
											$age2="selected";
										}
										elseif($clientinfo[0]['age']=="16-25")
										{
											$age3="selected";
										}
										elseif($clientinfo[0]['age']=="26-35")
										{
											$age4="selected";
										}
										elseif($clientinfo[0]['age']=="36-45")
										{
											$age5="selected";
										}
										elseif($clientinfo[0]['age']=="46-55")
										{
											$age6="selected";
										}
										elseif($clientinfo[0]['age']=="56-65")
										{
											$age7="selected";
										}
										elseif($clientinfo[0]['age']=="66-75")
										{
											$age8="selected";
										}
										elseif($clientinfo[0]['age']=="76-85")
										{
											$age9="selected";
										}
										elseif($clientinfo[0]['age']=="86-95")
										{
											$age10="selected";
										}
										elseif($clientinfo[0]['age']=="96-100+")
										{
											$age="selected";
										}
										else
										{
											$age=$age1=$age2=$age3=$age4=$age5=$age6=$age7=$age8=$age9=$age10='';
										}
									?>
										<option value="">Select Age</option>
										<option value="0-5" <?php @print $age1; ?> >0-5</option>
										<option value="6-15" <?php @print $age2; ?>>6-15</option>
										<option value="16-25" <?php @print $age3; ?>>16-25</option>
										<option value="26-35" <?php @print $age4; ?>>26-35</option>
										<option value="36-45" <?php @print $age5; ?>>36-45</option>
										<option value="46-55" <?php @print $age6; ?>>46-55</option>
										<option value="56-65" <?php @print $age7; ?>>56-65</option>
										<option value="66-75" <?php @print $age8; ?>>66-75</option>
										<option value="76-85" <?php @print $age9; ?>>76-85</option>
										<option value="86-95" <?php @print $age10; ?>>86-95</option>
										<option value="96-100+" <?php @print $age; ?> >96-100+</option>
									</select>
								</div>
							<div class="clearfix"></div>
						<!-- Part-I Ends-->
						
								<div class=" row information-form-wrap right-padder">
									<div class="col-md-3 col-sm-3">
										<div class="form-group">
											<label for="">Natural Hair Color</label>
										</div>
									</div>
									
									<div class="col-md-9 col-sm-6">
										<div class="form-group">
											<select name="hair_color" id="hair_color" class="ajax_field form-control">
												<option value="">Select Hair Color</option>
												<?php
												
													foreach($allcolor as $color)
													{
														if($color['name']==$clientinfo[0]['hair_color'])
														{
															$select_color="selected";
														}
														else
														{
															$select_color="";
														}
												?>
														<option  <?php echo set_select('color', @$color['name']); ?> value="<?php print $color['name']; ?>"  <?php @print $select_color; ?>  ><?php print $color['name']; ?></option>
												<?php
													}
												?>
											</select>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="col-md-3 col-sm-3">
										<label for="">Natural Texture</label>
									</div>
									<div class="col-md-9 col-sm-6">
										<div class="form-group">
											<select name="hair_texture" id="hair_texture" class="ajax_field form-control">
												<option value="">Select Texture</option>
												<?php
													foreach($alltexture as $texture)
													{
														if($texture['id']==$clientinfo[0]['hair_texture'])
														{
															$select_texture="selected";
														}
														else
														{
															$select_texture="";
														}
												?>
													<option value="<?php print $texture['id']?>" <?php @print $select_texture; ?> ><?php print $texture['texture']; ?></option>
											<?php			//echo"<pre>";print_r($density);
													}
												?>
											</select>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="col-md-3 col-sm-3">
										<label for="">Natural Density</label>
									</div>
									<div class="col-md-5 col-sm-3">
										<div class="form-group">
											<select name="hair_density" id="hair_density" class="ajax_field form-control">
												<option value="">Select Density</option>
												<?php
													foreach($alldensity as $density)
													{
														if($density['density']==$clientinfo[0]['hair_density'])
														{
															$select_density="selected";
														}
														else
														{
															$select_density="";
														}
												?>
														<option value="<?php print $density['density']; ?>"  <?php @print $select_density; ?>  ><?php print $density['density'] ?></option>
												<?php		//echo"<pre>";print_r($density);
													}
												?>
											</select>
										</div>
									</div>

									<div class="col-md-4">
                                    <div class="addclient-space">
										<div class="form-group">
											<input type="submit" value="Save" class="btn-black-small square-btn-adjust" id="add_client" name="add">
										</div>
                                        </div>
									</div>
								</div>
								</div>

<div class="clearfix"></div>


<div class="sprate-D"></div>
							<a href="javascript:void(0)"  class="a-search" id="search" data-display='block'>
								<h4>Search all Photos</h4>
							</a>
							
								<div class="accordian" id="container-search-info" >
									<?php
								if (isset($message_search))
								{
									echo $message_search;
								}
							?>
									<div class="row UL-btn">
										<div class="border-btm">
											<div class="col-md-12">
												<div class="col-md-4">
													<div class="form-group">
														<input type="submit" name="load" id="load" value="Load Suggested Styles" class="btn-black" />
													</div>
												</div>
												<ul class="information-btn">
													<li><input type="submit" name="allstyle" id="allstyle" value="All" class="btn-black-small square-btn-adjust" /></li>
									<?php /* ?>			<li><input type="submit" name="suggested_style" id="suggested_style" value="Suggested" class="btn-black-small square-btn-adjust" /></li>	<?php */?>
													<li><input type="submit" name="favorite_style" id="favorite_style" value="Favorites" class="btn-black-small square-btn-adjust" /></li>
												</ul>
											</div>
										</div>
									</div>

						<!-- Part-I Ends-->
						
						<!-- Search part I Start-->

									<div class="client-search row">
										<div class=" border-btm">
											<div class="col-md-12">
												<div class="row row-first">
													<h4 class="col-md-2">Search</h4>

													<div class="col-md-3 col-sm-6 form-group">
														<select class="form-control" name="ethnicity_s" id="ethnicity_s">
															<option value="">Select Ethnicity</option>
															<?php
																//echo"<pre>";print_r($allethnicity);exit;	
																foreach($allethnicity as $ethnicity)
																{
																	if($clientinfo[0]['ethnicity']==$ethnicity['id'])
																	{
																		$select="selected";
																	}
																	else
																	{
																		$select="";
																	}
															?>
																<option value="<?php print $ethnicity['id'];?>"  <?php echo set_select('ethnicity_s', $ethnicity['id']); ?> > <?php print $ethnicity['ethnicity'];?></option>
															<?php
																}
															?>
														</select>
													</div>
													<div class="col-md-3 col-sm-6 form-group">
														<select class="form-control" name="gender_s" id="gender_s">
															<option value="">Select Gender</option>
															<?php
																	if($clientinfo[0]['gender']=="Male")
																	{
																		$gender1="selected";
																	}
																	elseif($clientinfo[0]['gender']=="Female")
																	{
																		$gender2="selected";
																	}
																	else
																	{
																		$gender="";
																	}
															?>
															<option value="Male"  <?php echo set_select('gender_s', 'Male'); ?>  >Male</option>
															<option value="Female"  <?php echo set_select('gender_s', 'Female'); ?> >Female</option>
														</select>
													</div>
													<div class="col-md-3 col-sm-6">
														<select class="form-control" name="age_range_s" id="age_range_s">
															<option value="">Select Age</option>
															<?php	
																if($clientinfo[0]['age']=="0-5")
																{
																	$age1="selected";
																}
																elseif($clientinfo[0]['age']=="6-15")
																{
																	$age2="selected";
																}
																elseif($clientinfo[0]['age']=="16-25")
																{
																	$age3="selected";
																}
																elseif($clientinfo[0]['age']=="26-35")
																{
																	$age4="selected";
																}
																elseif($clientinfo[0]['age']=="36-45")
																{
																	$age5="selected";
																}
																elseif($clientinfo[0]['age']=="46-55")
																{
																	$age6="selected";
																}
																elseif($clientinfo[0]['age']=="56-65")
																{
																	$age7="selected";
																}
																elseif($clientinfo[0]['age']=="66-75")
																{
																	$age8="selected";
																}
																elseif($clientinfo[0]['age']=="76-85")
																{
																	$age9="selected";
																}
																elseif($clientinfo[0]['age']=="86-95")
																{
																	$age10="selected";
																}
																elseif($clientinfo[0]['age']=="96-100+")
																{
																	$age="selected";
																}
																else
																{
																	$age=$age1=$age2=$age3=$age4=$age5=$age6=$age7=$age8=$age9=$age10='';
																}
															?>
															<option value="0-5" <?php echo set_select('age_range_s', '0-5'); ?> >0-5</option>
															<option value="6-15" <?php echo set_select('age_range_s', '6-15'); ?> >6-15</option>
															<option value="16-25" <?php echo set_select('age_range_s', '16-25'); ?> >16-25</option>
															<option value="26-35" <?php echo set_select('age_range_s', '26-35'); ?> >26-35</option>
															<option value="36-45" <?php echo set_select('age_range_s', '36-45'); ?> >36-45</option>
															<option value="46-55" <?php echo set_select('age_range_s', '46-55'); ?> >46-55</option>
															<option value="56-65" <?php echo set_select('age_range_s', '56-65'); ?> >56-65</option>
															<option value="66-75" <?php echo set_select('age_range_s', '66-75'); ?> >66-75</option>
															<option value="76-85" <?php echo set_select('age_range_s', '76-85'); ?> >76-85</option>
															<option value="86-95" <?php echo set_select('age_range_s', '86-95'); ?> >86-95</option>
															<option value="96-100+" <?php echo set_select('age_range_s', '96-100+'); ?> >96-100+</option>

														</select>
													</div>
													<div class="col-md-4"> </div>
												</div>
												<div class="row row-second">
													<div class="col-md-3 col-sm-6 col-md-offset-2 form-group">
														<select name="hair_color_s" id="hair_color_s" class="form-control selectpicker">
															<option value="">Select Hair Color</option>
															<?php
																foreach($allcolor as $color)
																{
																	if($color['name']==$clientinfo[0]['hair_color'])
																	{
																		$select_color="selected";
																	}
																	else
																	{
																		$select_color="";
																	}
																?>
																	<option value="<?php print $color['name']?>" <?php echo set_select('hair_color_s', $color['name']);?> ><?php print $color['name']; ?></option>
																<?php
																}
															?>
														</select>
													</div>
													
													<div class="col-md-3 col-sm-6 form-group">
														<select name="hair_texture_s" id="hair_texture_s" class="form-control selectpicker ">
															<option value="">Select Texture</option>
															<?php
																foreach($alltexture as $texture)
																{
																	if($texture['id']==$clientinfo[0]['hair_texture'])
																	{
																		$select_texture="selected";
																	}
																	else
																	{
																		$select_texture="";
																	}
															?>
																	<option value="<?php print $texture['id']?>" <?php echo set_select('hair_texture_s', $texture['id']);?> ><?php print $texture['texture'];?></option>
																<?php	//echo"<pre>";print_r($density);
																}
															?>
														</select>
													</div>

													<div class="col-md-3 col-sm-6 form-group">
														<select name="hair_density_s" id="hair_density_s" class="form-control selectpicker ">
															<option value="">Select Density</option>
															<?php
																foreach($alldensity as $density)
																{
																	if($density['density']==$clientinfo[0]['hair_density'])
																	{
																		$select_density="selected";
																	}
																	else
																	{
																		$select_density="";
																	}
																?>
																<option value="<?php print $density['density'];?>" <?php echo set_select('hair_density_s', $density['density']);?> ><?php print $density['density']; ?></option>
															<?php		//echo"<pre>";print_r($density);
																}
															?>
														</select>
													</div>
                                                    <div class="col-md-2"></div>
													<div class="col-md-6 col-sm-6 form-group">
															<select name="tags_s[]" id="tags_s" class="form-control selectpicker" multiple="">
																<option value="">Select Tags</option>
																<?php
																	foreach($alltags as $tag)
																	{
																		if($clientinfo[0]['tagid']="")
																		{
																			$select_tag="selected";
																		}
																		else
																		{
																			$select_tag="";
																		}
																?>
																<option value="<?php print $tag['id']?>" <?php echo set_select('tags_s[]', $tag['id']);?> ><?php print $tag['tagname']?></option>
																<?php
																	}
																?>
															</select>
															<!--<span>Tags</span> <span class="glyphicon glyphicon-tags" aria-hidden="true"></span>-->
													</div>
													<div class="col-md-3 form-group">
														<input type="submit" name="search_style" id="search_style" value="Search" class="btn-black-small square-btn-adjust" />
													</div>
												</div><!---->
										</div>
									</div>
						<!-- Search part I End-->
						
						
						<!------------Slider Section Start--------------->                          
				<div class="col-md-12" id="find_photos">
					<?php
						if (isset($message_slider))
						{
							echo $message_slider;
						}
					?>
					<div class="message" style="margin:0px auto;">
						
					</div>
					<div class="wrapper">
						<div class="jcarousel-wrapper">
							<div class="jcarousel">
								<ul id="suggestion_container" class="">
									<?php
									//echo"<pre>";print_r($favorite_style);exit;
								if(@$searchdata)
								{
										if(!empty($searchdata))
										{
											foreach($searchdata as $search)
											{
												//echo"<pre>";print_r($search);exit;
												$image=explode(',',$search['photos']);
												$newimg =preg_replace('/\s+/', '_', $image[0]);
									?>
													<li class="suggestion <?php print $search['ethnicity'].' '.$search['hair_color'].' '.$search['hair_texture'].' '.$search['hair_density'].' '.$search['tagid'].' '.$search['age'].' '.$search['gender']; ?>" >
														<?php
													$pathToimg=base_url().'assets/uploads/thumbnails/244x244/'.$newimg;
												?>
														<a class="button slide-img-popup" href="#popup1" data-id="<?php print $search['id'] ?>">
															<!-- <img src="<?php // print $search['photos'] ?>"/> -->
															<img src="<?php print $pathToimg ?>" class="img-responsive"/>
														</a>
														<label>
															<input type="checkbox" name="select_suggest" value="<?php print $search['id'] ?>" class="setfavorite"  />
															<span class="checkbox"></span>
														</label>
													</li>
									<?php
											}
										}
								}
								elseif(@$favorite_style)
								{
										if(!empty($favorite_style))
										{
											//echo"<pre>";print_r($favorite_style);
											$i=0;
											foreach($favorite_style as $favorite)
											{
												//echo"<pre>";print_r($favorite);
												$image=explode(',',@$favorite[0]['photos']);
												$newimg =preg_replace('/\s+/', '_', $image[0]);
									?>
											<li class="suggestion " >
													<a class="button slide-img-popup" href="#popup1" data-id="<?php print $favorite[0]['id'] ?>">
														<?php
															$pathToimg=base_url().'assets/uploads/thumbnails/244x244/'.$newimg;
														?>
														<img src="<?php print $pathToimg; ?>" class="img-responsive"/>
													</a>
												<label>
													<input type="checkbox" name="select_suggest" value="<?php print @$favorite[0]['id'] ?>" class="setfavorite" checked="" />
													<span class="checkbox"></span>
												</label>
											</li>
									<?php	
											$i++;	
											}
										}
									}
									elseif(@$sliderdata)
									{
										if(!empty($sliderdata))
											{	
												//echo"<pre>";print_r($sliderdata);exit;
												foreach($sliderdata as $slide)
												{
													//echo"<pre>";print_r($slide);exit;
													$image=explode(',',$slide['photos']);
													$newimg =preg_replace('/\s+/', '_', $image[0]);
													
										?>
													<li class="suggestion " >
														<!-- <img src="<?php // print $slide['photos'] ?>"/> -->
														<a class="button slide-img-popup" href="#popup1" data-id="<?php print $slide['id'] ?>">
														<?php
															$pathToimg=base_url().'assets/uploads/thumbnails/244x244/'.$newimg;
														?>
															<img src="<?php print $pathToimg; ?>" class="img-responsive"/>
														</a>
														<label>
															<input type="checkbox" name="select_suggest" value="<?php print $slide['id'] ?>" class="setfavorite"  />
															<span class="checkbox"></span>
														</label>
													</li>
											<?php
												}
											}
											else
											{
											?>
											<li>
												<p>No Matching data found</p>
											</li>
											<?php	
											}
										}
									
									else
									{
								?>	
									<li>
										<p>No Matching data found</p>
									</li>
								<?
									}
										?>
								</ul>

							</div>
								<a href="#" class="jcarousel-control-prev"><i class="fa fa-arrow-circle-o-left"></i></a>
								<a href="#" class="jcarousel-control-next"><i class="fa fa-arrow-circle-o-right"></i></a>
								<!--<p class="jcarousel-pagination"></p>-->
						</div>
					</div>
				 </div>						
				<!------------Slider Section End--------------->
 
								</div><!--accordian end-->
								
								</div>

								<!-- Part-II Ends-->
                                <div class="sprate-D"></div>
							<a href="javascript:void(0)"  class="a-client-photos" id="photos" data-display='block'>
							<h4>Client Photos</h4>
							</a>
							
							<div class="accordian" id="container-client-photos" >
								<?php
								if(isset($photo_msg))
								{
									echo $photo_msg;
								}
							?>
							<?php  if($this->session->flashdata('del_msg'))   echo  $this->session->flashdata('del_msg'); ?>
								<div class="photos-part" id="photos-part">
									<div class="row">
										<div class="col-md-8 col-sm-8">
											<!--<h4>Client Photos</h4>-->
										</div>
										<div class="col-md-4 col-sm-4 col-xs-12 spc-bottom"> 
											<a class="btn-black-small pull-right upload_images-popup" href="#upload_images" data-id=""> + Add Photos</a>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-12">
											<div class="message" style="margin:0px auto;">
												<?php  if($this->session->flashdata('email_pic_msg'))   echo  $this->session->flashdata('email_pic_msg'); ?>
												
											</div>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="row">
										<div class="col-md-12">
										</div>
									</div>
									<div class="row" id="three_photos_wrapper">
									<?php
										if(isset($clientphotos))
										{
											//echo"<pre>";print_r($clientphotos);exit;
											if(!empty($clientphotos))
											{
											foreach($clientphotos as $photos)
											{
												$time=strtotime($photos['createdate']);												
												$date=date("d",$time);
												$month=date("F",$time);
												$year=date("Y",$time);
												
												$allphotos=explode(',',$photos['photos']);
												$photo_order=explode(',',$photos['photo_order']);
												
												$imgcount=count($allphotos);
												
												$i=0;
												$j=1;
												$k=2;
												
												if($photos['public']==1)
												{
													$public_select="checked";
												}
												else
												{
													$public_select="";
												}

												if($photos['featured']==1)
												{
													$featured_select="checked";
												}
												else
												{
													$featured_select="";
												}
												//echo"<pre>";print_r($photos);
											$defaultimg='find_user.png';
												//echo"<pre>";print_r($defaultimg);
											if(empty($allphotos[$photo_order[$i]]))
											{
												$allphotos[$photo_order[$i]]=$defaultimg;
											}
											//if($j<0)
											if(empty($allphotos[$photo_order[$j]]))
											{
												@$allphotos[$photo_order[$j]]=$defaultimg;
											}
											//if($k<0)
											if(empty($allphotos[$photo_order[$k]]))
											{
												$allphotos[$photo_order[$k]]=$defaultimg;
											}
											
									?>
									
										<div class="col-md-4 col-sm-4 col-xs-12 three_photos" id="three_photos-<?php echo $photos['id']; ?>" >
											<div class="date"><?php print $month.' '.$date.', '.$year; ?></div>
											<div class="image-section">
												<div class="client-img" data-id="<?php echo $photos['id']; ?>">
												 
												
												 <?php 
													// fix for space in image name
													$all_photos[0] =preg_replace('/\s+/', '_', $allphotos[$photo_order[$i]]);
													if($j<0)
													{
														$all_photos[1]	=	$defaultimg;
													}
													else
													{
														$all_photos[1] =preg_replace('/\s+/', '_', $allphotos[$photo_order[$j]]);
														
													}
													if($k<=0)
													{
														$all_photos[2] =	$defaultimg;
													}
													else
													{
														$all_photos[2] =preg_replace('/\s+/', '_', $allphotos[$photo_order[$k]]);
													}
													$pathToimg=base_url().'assets/uploads/thumbnails';
												 ?>
													<a class="fancybox" rel="group" href="<?php print $pathToimg.'/600x600/'.$all_photos[0];?>" />
														<img src="<?php print $pathToimg.'/130x130/'.$all_photos[0];?>" class="img-responsive" id="main_three_set">
													</a>
													

													
												</div>
												
												<ul class="client-img-no clickable_imgs" id="clickable_imgs">
													<li class="first">
														<img src="<?php print @$pathToimg.'/130x130/'.$all_photos[0];?>" data-id="<?php @print $photos['id']; ?>" class="img-responsive img_set_mini">
													</li>
													<li>
														<img src="<?php print @$pathToimg.'/130x130/'.$all_photos[1];?>" data-id="<?php @print $photos['id']; ?>" class="img-responsive img_set_mini">
													</li>
													<li class="last">
														<img src="<?php print @$pathToimg.'/130x130/'.$all_photos[2];?>" data-id="<?php @print $photos['id']; ?>" class="img-responsive img_set_mini">
													</li>
												</ul>
												
											</div>
											<div class="clearfix"></div>
											<div class="edit-section">
												<div class="btn-part">
													<!--<a class="btn-black-x-small black-btn" href="#">Edit</a>-->
													<a class="btn-black-x-small purple-btn share_this" href="javascript:void(0)" data-id="<?php @print $photos['id']; ?>">Share</a>
													<a class="btn-black-x-small purple-btn ajax_edit_photo_set" href="#upload_images"  data-id="<?php @print $photos['id']; ?>">Edit</a>
													<a class="btn-black-x-small purple-btn ajax_delete_photo_set" href="javascript:void(0)"  data-id="<?php @print $photos['id']; ?>">Delete</a>
												</div>
												
												<div class="share_media" id="share_media-<?php @print $photos['id']; ?>">
														<?php
															$base_url=base_url().'';
															
														?>
														<a id="fbshare_link_<?php @print $photos['id']; ?>" href="http://www.facebook.com/sharer/sharer.php?u=<?php @print $pathToimg.'/600x600/'.$all_photos[0];?>" target="_blank"><i class="fa fa-facebook"></i></a>
														<a id="twitshare_link_<?php @print $photos['id']; ?>" href="http://twitter.com/share?text=Description <?php @print $pathToimg.'/600x600/'.$all_photos[0];?>" target="_blank"><i class="fa fa-twitter"></i></a>
														
														<a id="pinshare_link_<?php @print $photos['id']; ?>" href="https://pinterest.com/pin/create/button/?url=<?php @print $pathToimg.'/600x600/'.$all_photos[0]?>&media=&description=" target="_blank"><i class="fa fa-pinterest"></i></a>
														
															<a id="emailshare_link_<?php @print $photos['id']; ?>" href="<?php echo site_url('stylist/email_photos/'.$photos['id'].'/'.$clientinfo[0]['user_id']);?>">
																<i class="fa fa-envelope"></i>
															</a>
														<?php ?>
													</div>
												<div class="feature-part">
													<?php // @print $clientinfo[0]['user_id']; ?>
														<label>
															<input type="checkbox" data-id="<?php @print $photos['id']; ?>" name="img_set_featured" id="img_set_featured" <?php print $featured_select;?> class="ajax_set_featued_public" data-column="featured" >
															<span class="checkbox"></span>Featured
														</label>
													
													
														<label>
															<input type="checkbox" data-id="<?php @print $photos['id']; ?>" name="img_set_public" id="img_set_public" <?php print $public_select;?> class="ajax_set_featued_public" data-column="public" >
															<span class="checkbox"></span>Public
														</label>
													
												</div>
											
											</div>
										</div>
										
										<?php
												}
											echo '<div class="clearfix"></div>';
											}
										if(!empty($clientphotos))
										{
										?>
										<div class="show_more_main" id="show_more_main<?php echo $photos['id']; ?>">
											<span id="<?php echo $photos['id']; ?>" data-id="<?php echo $photos['c_id']; ?>" class="show_more" title="Load more posts">Show more</span>
											<span class="loding" style="display: none;"><span class="loding_txt">Loading...</span></span>
										</div>
										<?php
										}
									}
									?>
									</div>
								</div>
								<div class="loadmore_photos"></div>
							<!-------------------Three photos end------------------->
							</div>
							
								<!---------appoinment start----->
                                 <div class="sprate-D"></div>
							 <a href="javascript:void(0)"  class="a-upcoming-appoints" data-display='block' id="appoinments">
								<h4>Upcoming Appointments</h4>
							</a>
							<div class="accordian" id="container-upcoming-appoints" >
									<div class="row" id="apoinments">
										<div class="col-md-8 col-sm-8">
											<!--<h4>Upcoming Appointments</h4>-->
										</div>
										<div class="col-md-4 col-sm-4 spc-bottom">
											<a href="<?php echo site_url('stylist/add_booking');?>" class="btn-black-small pull-right" id="add_a_schedule">+ Schedule</a>
											<input type="hidden" name="mail_appoinment" id="mail_appoinment" class="mail_appoinment" value="" />
										</div>
									</div>
								
								
								<?php
									if(@$upcoming_appoints)
									{
										foreach($upcoming_appoints as $appoinment)
										{
											$datetime=strtotime($appoinment['booking_start_date']);												
											$day=date("l",$datetime);
											$date=date("d",$datetime);
											$month=date("F",$datetime);
											$year=date("Y",$datetime);
											
											//echo"<pre>";print_r($appoinment);
								?>
								
								<div class="row schedule-wrap spc-bottom">
									<div class="col-md-4 col-sm-5 schedule-date">
										<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
										<span class="date-title"><?php @print $day.' '.$month.' '.$date.', '.$year;?></span>
									</div>
									<div class="col-md-3 col-sm-5">
										<?php @print $appoinment['service_offer']; ?>
									</div>
									<div class="col-md-3 col-sm-5">
										
											<p><span>From : </span><?php @print $appoinment['day_start_time']; ?>
											<span>To : </span><?php @print $appoinment['day_end_time']; ?></p>
										
									</div>
									<div class="col-md-2 schedule">
										<a class="edit" href="<?php echo site_url('stylist/edit_booking/'.$appoinment['id'])?>">
											<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
											<input type="hidden" name="c_Uid" id="c_Uid" value="<?php echo $appoinment['user_id'];?>" />
										</a>
										<a class="remove" href="<?php echo site_url('stylist/cancel_booking/'.$appoinment['id'].'/'.$appoinment['user_id']);?>" onClick="return doconfirm()" >
											<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
										</a>
									</div>
								</div>
								
								<?php	
										}
									}
								?>
								</div>
								<!---------appoinment end----------------->
			<?php
				/*Hiding menu as per package*/
				if($this->session->userdata('package')=="DELUXE")
				{
					$style="display:none";
				}
				else
				{
					$style="";
				}								
			?>
						<!----------------Product----------------->
					 <div class="sprate-D" style="<?php print $style; ?>"></div>
				<a href="javascript:void(0)"  class="a-search-products" id="product" data-display='block' style="<?php print $style; ?>">
					<h4>Suggested Products</h4>
				</a>
				
				<div class="accordian" id="container-search-products" >
					<?php
					if (isset($message_product))
					{
						echo $message_product;
					}
					
				?>
					<div class="row"  style="<?php print $style; ?>">
						<div class="col-sm-8" id="suggest_a_pro">
							<!--<h4>Suggested Products</h4>-->
						</div>
						<div class="col-sm-4 spc-bottom">
							<input type="submit" name="build_product" id="build_product" value="+ Build Package" class="btn-black-small pull-right" />
						</div>
					</div>										
					<div class="row spc-bottom"  style="<?php print $style; ?>">
						<div class="col-sm-12">
							<input type="submit" name="email_pack" id="email_pack" value="+ Email Package" class="btn-black-small pull-right" />
						</div>
					</div>

					<div class="row spc-bottom"  style="<?php print $style; ?>">
						<div class="col-md-2 col-sm-12">
							<h4>Search</h4>
						</div>
						<div class="col-md-10 col-sm-12">
							<ul class="information-btn">
								<li>
									<input type="submit" name="all_product" id="all_product" value="All" class="btn-black-small pull-right" />
								</li>
								<li>
									<input type="submit" name="suggested_product" id="suggested_product" value="Suggested" class="btn-black-small pull-right" />
								</li>
								<li>
									<input type="submit" name="selected_product" id="selected_product" value="Selected" class="btn-black-small pull-right" />
								</li>
							</ul>
						</div>
					</div>
				<div class="row spc-bottom"  style="<?php print $style; ?>">
					<div class="col-md-3 col-sm-6 form-group">
						<select class="selectpicker suggest_pro_ form-control custom-select" id="suggest_pro_category" name="suggest_pro_category_post">
							<option value="">Category</option>
						<?php
							foreach($allcategory as $category)
							{
						?>
							<option value="<?php @print $category['id'];?>"  <?php echo set_select('suggest_pro_category_post', $category['id']); ?> ><?php @print $category['name'];?></option>
						<?php		
							}
						?>
						</select>
					</div>
					<div class="col-md-3 col-sm-6 form-group">
						<select class="selectpicker suggest_pro_ form-control custom-select" id="suggest_pro_brand" name="suggest_pro_brand_post">
							<option value="">Brand</option>
						<?php
							foreach($allbrands as $brand)
							{
						?>
							<option value="<?php @print $brand['id'];?>" <?php echo set_select('suggest_pro_brand_post', $brand['id']); ?> ><?php @print $brand['name'];?></option>
						<?php		
							}
						?>
						</select>
					</div>
					<div class="col-md-3 col-sm-6 form-group">
						<select class="selectpicker suggest_pro_ form-control" multiple="multiple" id="suggest_pro_tag" name="suggest_pro_tag_post[]">
							<option value="">Tags</option>
						<?php
							foreach($alltags as $tag)
							{
						?>
							<option value="<?php print $tag['id']?>"  <?php echo set_select('suggest_pro_tag_post[]', $tag['id']); ?>  ><?php print $tag['tagname']?></option>
						<?php		
							}
						?>
						</select>
					</div>
					<div class="col-md-3 col-sm-6 form-group">
						<input type="text" name="filter_product" value="<?php echo set_value('filter_product');?>" id="filter_product" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Search'" placeholder="Search" class="form-control" />
					</div>
					
					<div class="col-sm-9"></div>
					
					<div class="col-sm-3">
						<input type="submit" value="Search" name="search" class="btn-black-small pull-right">
					</div>
					<!--<div class="col-sm-4">
						<div class="tag"> <span>Tags</span> <span aria-hidden="true" class="glyphicon glyphicon-tags"></span> </div>
						<div class="search-btn"><a class="btn-black-small" href="#">Search</a></div>
						<div class="reset-btn"><a class="" href="#">Reset</a></div>
					</div>-->
				</div>
				<?php
						if (isset($product_message))
						{
							echo $product_message;
						}
					?>
				<div class="products-wrap"  style="<?php print $style; ?>">
					<div class="row">
						<div class="products">
                        
							<div id="suggest_pro_container">
							<!---------------------------- Selected Product Data  ----------------------------->
								<?php

									if(@$selected_product)
									{
										if(!empty($selected_product))
										{
										//	echo"<pre>";
											//print_r($selected_product);
										//	print_r($stylists_products);
											$items=array();
											foreach($stylists_products as $stylist_item)
											{
												array_push($items,$stylist_item['brand_id']);
											}

											$i=4;
											foreach($selected_product as $product)
											{
												$baseurl=base_url();
												if($i % 4 == 0)
												{
													if($i==4)
													{
														$class="fisrt_product_li";
													}
													else
													{
														$class="last_product_li";
													}
												}
												else
												{
													$class="";
												}
												
												//if($product['brand_id'])
												if(in_array($product['brand_id'], $items))
												{
												//echo"<pre>";print_r($product);
										?>
                                        
											<div class="col-md-3 col-sm-4  <?php print $class;?>">
												<div class="product-cont mychoised">
													<label for="product-<?php @print $product['product_id']?>">
													<div class="product-img">
														<img src="<?php @print $baseurl.'assets/product/thumbnails/150x150/'.$product['image']?>" class="img_product img-responsive" />
														
													</div>
													<div class="procuct-detail">
														<input type="checkbox" name="product-<?php @print $product['product_id']?>" id="product-<?php @print $product['product_id']?>" class="setselected " value="<?php @print $product['product_id']?>" checked=""  />
														<span class="checkbox"></span>
														<span><?php @print $product['name']; ?></span>
														<i><?php @print $product['brand_name']; ?></i>
														<span><?php @print $product['category_name']; ?></span>
													</div>
													</label>
												</div>
											</div>

										<?php
											$i++;
											}
										}
									}
									}
									
									elseif(@$productsearch)
									{
										if(!empty($productsearch))
										{
											$items=array();
											foreach($stylists_products as $stylist_item)
											{
												array_push($items,$stylist_item['brand_id']);
											}
											
											$i=4;
											foreach($productsearch as $product)
											{
												$baseurl=base_url();
												if($i % 4 == 0)
												{
													if($i==4)
													{
														$class="fisrt_product_li";
													}
													else
													{
														$class="last_product_li";
													}
												}
												else
												{
													$class="";
												}
												if(in_array($product['brandid'], $items))
												{
												//echo"<pre>";print_r($product);
										?>
																				
										<div class="col-md-3 col-sm-4 <?php print $class;?>">
											<div class="product-cont">
												<label for="product-<?php @print $product['id']?>">
												<div class="product-img">
													<img src="<?php @print $baseurl.'assets/product/thumbnails/150x150/'.$product['image']?>" class="img_product img-responsive" />
												</div>
												<div class="procuct-detail">
													<input type="checkbox" name="product-<?php @print $product['id']?>" id="product-<?php @print $product['id']?>" class="setselected" value="<?php @print $product['id']?>" />
													<span class="checkbox"></span>
													<span><?php @print $product['productname']; ?></span>
													<i><?php @print $product['brandname']; ?></i>
													<span><?php @print $product['categoryname']; ?></span>
												</div>
												</label>
											</div>
										</div>

										<?php
											$i++;
											}
																						
										}
									}
									}
								
									elseif(@$suggestedproduct)
									{
										if(!empty($suggestedproduct))
										{
											$i=4;
											foreach($suggestedproduct as $product)
											{
												$baseurl=base_url();
												if($i % 4 == 0)
												{
													if($i==4)
													{
														$class="fisrt_product_li";
													}
													else
													{
														$class="last_product_li";
													}
												}
												else
												{
													$class="";
												}
												//echo"<pre>";print_r($product);
										?>
																				
										<div class="col-md-3 col-sm-4 <?php print $class;?>">
											<div class="product-cont">
												<label for="product-<?php @print $product['product_id']?>">
												<div class="product-img">
												<img src="<?php @print $baseurl.'assets/product/thumbnails/150x150/'.$product['image']?>" class="img_product img-responsive" />
												   
												</div>
												<div class="procuct-detail">
													<input type="checkbox" name="product-<?php @print $product['product_id']?>" id="product-<?php @print $product['product_id']?>" class="setselected" value="<?php @print $product['product_id']?>" />
													<span class="checkbox"></span>
													<span><?php @print $product['name']; ?></span>
													<i><?php @print $product['brand_name']; ?></i>
													<span><?php @print $product['category_name']; ?></span>
												</div>
												</label>
											</div>
										</div>

										<?php
											$i++;
											}
										}
									}
							
							/*
									else
									{
										echo"<li><p>No Data Found</p></li>";
									}*/
								?>
							</div>
					</div>
				</div>
			</div>
				<!-----------Email-------->
				</div>
                 <div class="sprate-D"></div>
                 
				<a href="javascript:void(0)"  class="a-client-communication" data-display='block'>
					<h4>Client Communication</h4>
				</a>
					  <div class="accordian" id="container-client-communication" >
							<div class="row">
								<div class="col-sm-8 ">
									<!--<h4>Client Communication</h4>-->
								</div>
								<div class="col-sm-4 spc-bottom">
									<a href="<?php echo site_url('stylist/sendmail/'.$clientinfo[0]['id']); ?>" class="btn-black-small pull-right" id="emailclient_end">Email Client</a>
								</div>
							</div>
							<?php
								if(!empty($recent_communications))
								{
									foreach($recent_communications as $communication)
									{
							?>
							<div class="row">
								<div class="col-sm-6">
									<h6><?php print $communication['title']?></h6>
								</div>
								<div class="col-sm-6">
									<strong>
										<?php
											$Datetime=strtotime($communication['createdate']);
											$sent_date=date("l, d F Y", $Datetime);
											echo $sent_date
										?>
									</strong>
								</div>
							</div>
							<div class="clearfix"></div>
							<?php
									}
								}
								else
								{
							?>
								<div class="row">
									<div class="col-sm-12">
										<strong>
											No Communication Sent Yet !!
										</strong>
									</div>
								</div>
							<?php		
								}
							?>
						</div>
					
				<!----------------Product End----------------->
				
				<!------------------------Image Popup start---------------------->
					<div id="upload_images" class="overlay upload_images_overley">
						<div class="popup upload_images_popup">
							<a class="close" href="#three_photos_wrapper"><i class="fa fa-times-circle" style="font-size:20px;"></i></a>
							<div class="content upload_images-popup-content " id="upload_images-popup-content">
								
								<div class="data_content col-md-12">
									<div class="col-md-12">
										<input type="file" name="pic[]" id="pic" multiple value="" accept="image/*"  >
										<span>( Maximum 3 photos are allowed )</span>
									</div>
									<!--<img id="uploadPreview" style="width: 100px; height: 100px;" /> -->

									<div id="gallery"><ul id="sortable"></ul></div>
									<input type="hidden" name="sortdiv" id="sortdiv" value="0,1,2" />
									<input type="hidden" name="de_order" value="" id="de_order"/>
									<!--<output id="sortable"></output>-->
								
								<div class="col-md-12">
									<div style="clear:both;">
										<label for="chk_featured">
											<input type="checkbox" name="chk_featured" id="chk_featured" value="1">
											<span class="checkbox"></span>
											Make Set Featured
										</label>
									</div>
									<div>
										<label for="chk_public">
											<input type="checkbox" name="chk_public" id="chk_public" value="1">
											<span class="checkbox"></span>
											Make Set Public
										</label>
									</div>
									
									
								</div>
								<div class="col-md-12">
									<h3 class="tag_head">Tags</h3>
									<ul class="tag_list">
									
									
									<?php
									if(@$alltags)
									{
										$i=4;
										foreach(@$alltags as $tag)
										{
											if($i % 4 == 0)
											{
												if($i==4)
												{
													$class="fisrt_li";
												}
												else
												{
													$class="last_li";
												}
												
											}
											else
											{
												$class="";
											}
									?>
									<li class="<?php print $class; ?>">
										<label for="tagids-<?php print $tag['id']?>">
											<input type="checkbox" name="tagids[]" id="tagids-<?php print $tag['id']?>" value="<?php print $tag['id']?>" class="tabids" />
											<span class="checkbox"></span>
											<?php print $tag['tagname']?>
										</label>
									</li>
									<?php
											$i++;
										}
									}
									?>
									</ul>
								</div>
								<div class="col-md-12">
									<input type="submit" name="upload" id="upload"  onclick="set_degree() ; set_order();" value="Save" class="btn-black-small square-btn-adjust">
								</div>
							</div>
						
							</div>
							<input type="hidden" name="hidden_uId" id="hidden_uId" value="<?php @print $clientinfo[0]['user_id']; ?>" >
						</div>
					</div>
					<!------------------------Image Popup end---------------------->
					<?php
					
					if($this->session->flashdata('section'))
					{
						$section=$this->session->flashdata('section');
					}
					if(!empty($section))
					{
						
					}
					else
					{
						$section="";
					}
					?>
					<input type="hidden" name="section" id="section" class="section" value="<?php echo $section; ?>" />
					
							</form>
		<!------------------------Image Popup start---------------------->
<div id="popup1" class="overlay img_slide_overley">
	<div class="popup img_slide_popup">
		<a class="close" href="#find_photos"><i class="fa fa-times-circle" style="font-size:20px;"></i></a>
		<div class="content slide-img-popup-content " id="slide-img-popup-content">
		</div>
	</div>
</div>
		<!------------------------Image Popup end---------------------->
							<!----Section for Main content start ---->
						</div>
						
						
						<!----------------Upload pic------------------>
						<!---------------------------------->
							
					</div>
<?php  
		if($this->session->flashdata('reload'))
		{
			echo"<script>location.reload()</script>";
		}
		?>
				
				
				</div>
			</div>
			<!-- /. ROW  -->
<?php
	$this->load->view('Stylist/include/right_bar');
?>
		</div>
	</div>

<!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER  -->
<!------ Fancybox ------->
<script src="<?php echo base_url();?>assets/js/fancybox/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/js/fancybox/jquery.fancybox.js"></script>
		
<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery(".fancybox").fancybox();
	});
</script>

<?php
	$this->load->view('includes/footer');
?>

<script type="text/javascript" src="<?php  echo base_url();?>assets/js/jquery-ui.js"></script>

<!--Filter load Suggestion Start-->


<script type="text/javascript">

$('.setfavorite').on('change',function () {
	
	var email=encodeURIComponent($('#email').val());
	var fieldVal = encodeURIComponent($(this).val());

	if(this.checked)
	{
		var url = '<?php echo site_url('stylist/setfavorite');?>/1/'+fieldVal+'/'+email;
		
		 $.ajax({
                type: "POST",
                url: url,
                success: function(data) {
					$('#find_photos .message').html("<b style='color:green'> Image Set To Favorite </b>");
                },
           });
	}
	else
	{
		var url = '<?php echo site_url('stylist/setfavorite');?>/0/'+fieldVal+'/'+email;
		//alert(fieldVal);
		 $.ajax({
                type: "POST",
                url: url,
                success: function(data){
					$('#find_photos .message').html("<b style='color:green'> Image Unset from Favorite </b>");
                },
           });
	}
	
});

</script>

<script type="text/javascript">

$('.setselected').on('change',function () {
	
	var email=encodeURIComponent($('#email').val());
	var fieldVal = encodeURIComponent($(this).val());
	
	if(this.checked)
	{
		//$(this).parent().parent().parent().addClass('mychoised');
		$(this).parent().parent().parent().addClass('mychoised');
		var url = '<?php echo site_url('stylist/setselected');?>/1/'+fieldVal+'/'+email;
		
		 $.ajax({
                type: "POST",
                url: url,
                success: function(data) {
					//alert("Image Set to Selected");
                },
           });
	}
	else
	{
		$(this).parent().parent().parent().removeClass('mychoised');
		var url = '<?php echo site_url('stylist/setselected');?>/0/'+fieldVal+'/'+email;
		//alert(fieldVal);
		 $.ajax({
                type: "POST",
                url: url,
                success: function(data){
					//alert("Image Unset from favorite");
                },
           });
	}
	
});

</script>

<script type="text/javascript">

$('.ajax_set_featued_public').on('change',function () {
	
	var id=$(this).attr('data-id');
	var column=$(this).attr('data-column');
	
	if(this.checked)
	{
		var url = '<?php echo site_url('stylist/set_featued_public');?>/1/'+id+'/'+column;
		
		 $.ajax({
                type: "POST",
                url: url,
                success: function(data) {
					$('#photos-part .message').html("<b style='color:green'> Image Set to Featured </b>");
					//alert("Image Set to Featured");
                },
           });
	}
	else
	{
		var url = '<?php echo site_url('stylist/set_featued_public');?>/0/'+id+'/'+column;
		//alert(fieldVal);
		 $.ajax({
                type: "POST",
                url: url,
                success: function(data){
					$('#photos-part .message').html("<b style='color:green'> Image Unset from Featured </b>");
					//alert("Image Unset from Featured");
                },
           });
	}
	
});

</script>


<script>
/*Setting For appoinment*/
$(document).ready(function(){
	var email=$("#email").val();
	$("#mail_appoinment").val(email);
})

$("#email").blur(function(){
  var email=$(this).val();
  $("#mail_appoinment").val(email);
})

$("#add_a_schedule").click(function(){
	
  var toappend=encodeURIComponent($("#email").val());
   $(this).attr('href', $(this).attr('href') + '/'+toappend);
})

/* For showing share media*/
$(".share_this").on('click',function(){
  var id=$(this).attr('data-id');
  console.log(id);
  $('#share_media-'+id).toggle();
})

/*attaching email on click*/
$("#emailclient_end").click(function(){
	
  var toappend=encodeURIComponent($("#email").val());
   $(this).attr('href', $(this).attr('href') + '/'+toappend);
})
</script>

<!--Confir before cancel-->
<script>
	function doconfirm()
	{
		contact=confirm("Are you sure you want to delete?");
		if(contact!=true)
		{
			return false;
		}
	}
</script>

<script>
	/*setting format for contact no keyup*/
	function GetPhoneFormat(id)
	{
		var str = document.getElementById(id).value;
		if (str.length == 3) {
		var ind = str.substring(0,3);
		document.getElementById(id).value = '('+ind+') ';
		}
		if (str.length == 9) {
		var ind = str.substring(0, 9);
		document.getElementById(id).value = ind+'-';
		}
	}
</script>


<script>
	/*Clickable img start*/
	$('#clickable_imgs li img').on('click',function(){
		var src= $(this).attr('src');
		var id= $(this).attr('data-id');
		var fileNameIndex = src.lastIndexOf("/") + 1;
		var filename = src.substr(fileNameIndex);
		var host=$(location).attr('hostname');
		var newsrc='http://'+host+'/inhairent/assets/uploads/thumbnails/600x600/'+filename;
		var newsrc_thumb='http://'+host+'/inhairent/assets/uploads/thumbnails/130x130/'+filename;
		console.log(host);
		var newhtml='<a class="fancybox" href='+newsrc+'><img src='+newsrc_thumb+' class="img-responsive" id="main_three_set"></a>';
		var main_img=$(this).parent().parent().prev().html(newhtml);
		$('#fbshare_link_'+id).attr('href','http://www.facebook.com/sharer/sharer.php?u='+newsrc);
		//alert(newhtml);
	});

/*Clickable img start*/

</script> 


<!--Load More Images-->
<script type="text/javascript">
	/*Get 3 image sets on load more click*/
$(document).ready(function(){
	$(document).on('click','.show_more',function(){
		var ID = $(this).attr('id');
		var c_id = $(this).attr('data-id');
		$('.show_more').hide();
		$('.loding').show();
		var url = '<?php echo site_url('stylist/loadmore_photos');?>/'+ID+'/'+c_id;
		//alert(ID);
		$.ajax({
			type:'POST',
			url:url,
			data:'photoid='+ID,
			success:function(html){
				$('#show_more_main'+ID).hide();
				$('.loadmore_photos').append(html);
			}
		});
		
	});
});
</script>

<script type="text/javascript">
/*Get 3 image on image click on slider*/

$('.slide-img-popup').on('click',function () {
	
	var id=$(this).attr('data-id');
	
	if(id!='')
	{
		var url = '<?php echo site_url('stylist/getimg_tags');?>/'+id;
		//alert(url);
		 $.ajax({
                type: "POST",
                url: url,
                success: function(data) {
					$('#slide-img-popup-content').html(data);
                },
           });
	}
	else
	{
		//alert('test');
	}
	
});

</script>

<script type="text/javascript">
/*Delete 3 image Set */

$('.ajax_delete_photo_set').on('click',function (event) {
	
	var id=$(this).attr('data-id');
	var uid=$("#uid").val();
	var btn = this;
//	var url      = window.location.href;	three_photos
	console.log(id);
	if(id!='')
	{
		var url = '<?php echo site_url('stylist/delete_photo_set');?>/'+id+'/'+uid;
		var htm =$("#three_photos_wrapper").html();
		//alert(url);
		 $.ajax({
                type: "POST",
                url: url,
                success: function(data) {
					
					$(btn).closest('.three_photos').fadeOut("slow");
					//$('#slide-img-popup-content').html(data);
					//$("#three_photos_wrapper").load(location.href + " #three_photos_wrapper");
				//	location.reload();
					$('#photos-part .message').html('<b style="color:green;">Image Set Deleted Successfully </b>');

					 //$('#three_photos_wrapper').load('#'); //note: the space before #div1 is very important 
				}
           });
	}
	else
	{
		//alert('test');
	}
	event.preventDefault();
});

</script>



<script type="text/javascript">
/*Edit Photos*/

$('.ajax_edit_photo_set').on('click',function () {
	
	var id=$(this).attr('data-id');
	console.log(id);
	if(id!='')
	{
		var url = '<?php echo site_url('stylist/edit_photo_set');?>/'+id;
		//alert(url);
		 $.ajax({
                type: "POST",
                url: url,
                success: function(data) {
					$('#upload_images-popup-content').html(data);
                },
           });
	}
	else
	{
		//alert('test');
	}
	
});

</script>

<script>
	/*Setting images browse null or empty*/
	$('.upload_images-popup').on('click', function(){
		$('#sortable').html('');
		$('#pic').val('');
	})
	
	/*Setting images browse null or empty*/
	function remove_img()
	{
		var li_size=$('#sortable li').size();
		if(li_size=0)
		{
			$('#sortable').html('');
			$('#pic').val('');
		}
	}
</script>


<script>
$('#pic').change(function () {
	 var c=0;
    for (var i=0, len = this.files.length; i < len; i++) {
        (function (j, self) {
            var reader = new FileReader()
            reader.onload = function (e) {
				var fn= "+rotate";
				 var li = document.createElement('li');
				    li.setAttribute('id',+c);
				    li.setAttribute('class',"ui-sortable-handle rotable");
				    li.setAttribute('style',"");
				    li.innerHTML = '<input type="hidden" value="'+c+'" name="img_order[]"><img data-id="'+c+'" style="width: 200px;height: 200px;" src="' + e.target.result + '" class="img-responsive" ><input  name="liname[]" type="hidden" value="' + self.files[j].name + '"/><a href="#upload_images" onclick="var li = this.parentNode; var ul = li.parentNode; ul.removeChild(li); remove_img()" class="remove_this">Remove</a><p class="btn rotate_me" onclick = "Rotateimage()" >Rotate</p><span style="display:none;" id="r_angle">90</span><input class="degree" id="txt_degree" type="hidden" name="cropbox[]" value="0">';
					document.getElementById('sortable').appendChild(li);
               c++;
            };
            reader.readAsDataURL(self.files[j])
        })(i, this);
    }
   
});

</script>
  
  <script>
	  
	   $(function() {
        $("#sortable" ).sortable({
            placeholder: "ui-state-highlight",
            cursor: 'crosshair',
            update: function(event, ui) {
                var order = $("#sortable").sortable("toArray");
                $('#sortdiv').val(order.join(","));
              $('#sortdiv').val();
                
            }
    });
        $( "#sortable" ).disableSelection();
});

</script>

<script>
/*Rotate image on click*/

	function Rotateimage()
	{
		$('.rotate_me').on('click',function(){
			var angle = $(this).next('span').html();
			var new_angle =  $(this).next('span').html(parseInt(angle)+90);
			$(this).next('span').next('input').val(parseInt(angle));
			var rotate_angle = angle+'deg';
			var i_data =  $(this).parent().attr('id');
			$('#'+i_data+'> img').css({ 'transform':'rotate('+rotate_angle+')'})
			if(angle>270)
			{
				$(this).next('span').html('90');
				angle=90;
			}
			})
	}

/*Setting rotate angle value */
function set_degree()
{
	  var values = [];
	  var final_degree='';
	  var id=0;
	  $('#sortable li').each(function() {
		var deg_value=$('#sortable li#'+id+' .degree').val();
		values.push(deg_value);
		final_degree=values.join(',');
		console.log(final_degree);
		id=id+1
	  });
	  $('#de_order').val(final_degree);
}


/*Add dynamic id to li*/
function add_ids()
{
	//alert('0');
	$('#sortable li').each(function(i,el){
			el.id = i+1-1;
		});
}
/*Setting order on button click*/
function set_order()
{
	
	  var values = [];
	  var final_order='';
	  var id=0;
	  $('#sortable li').each(function() {
		var order_value=$(this).attr('id');
		values.push(order_value);
		final_order=values.join(',');
		console.log(final_order);
		id=id+1
	  });
	//  alert(final_order);
	  $('#sortdiv').val(final_order);
}

</script>



<script>
	/*	Toggle accordian div */
	$('.a-client-info').on('click',function(){
		$(this).attr('data-display',$(this).attr('data-display')==='block'?'none':'block' );
		//set_display(a,b)
		$('#container-client-info').slideToggle('slow');
		$('#container-client-info').toggleClass('off');
	})
	$('.a-search').on('click',function(){
		$('#container-search-info').slideToggle('slow');
		$('#container-search-info').toggleClass('off');
		
	})
	$('.a-client-photos').on('click',function(){
		$('#container-client-photos').slideToggle('slow');
		$('#container-client-photos').toggleClass('off');
		
	})
	$('.a-upcoming-appoints').on('click',function(){
		$('#container-upcoming-appoints').slideToggle('slow');
		$('#container-upcoming-appoints').toggleClass('off');
		
	})
	
	$('.a-search-products').on('click',function(){
		$('#container-search-products').slideToggle('slow');
		$('#container-search-products').toggleClass('off');
		
	})
	$('.a-client-communication').on('click',function(){
		$('#container-client-communication').slideToggle('slow');		
		$('#container-client-communication').toggleClass('off');
	})
	
	$('#myTabContent a').on('click',function(){
		$(this).toggleClass('down-arrow');
		
	})
</script>

<script>
	/*	Changing Url & redirection to sections */
	
	$(document).ready(function(){
		var section=$('#section').val();
		//console.log(section);
		var currentUrl = window.location;
		var hash=$(location).attr('hash');
		
		if(hash=='')
		{
			var newUrl= currentUrl+"#"+section;
		}
		else
		{
			var newUrl= currentUrl;
		}
		location.href = newUrl;
	
	})
</script>

<script>
	$(document).ready(function(){
		var section=$('#section').val();
		
		if($(location).attr('hash')=='#product')
		{
			section='product';
		}
		
		if($(location).attr('hash')=='#appoinments')
		{
			section='appoinments';
		}
		$('#'+section).next('.accordian').css('display','block');
		console.log($(location).attr('hash'));
	});
</script>


<script>
      $(function() {
        $(".custom-select").customselect();
      });
</script>
