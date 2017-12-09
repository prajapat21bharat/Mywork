<?php
	$this->load->view('includes/loggedin_header');
?>
        
<div class="contentpanel" >
<?php
	//$this->load->view('Stylist/include/subscribe_block');
?>
	<div class="container clear_both padding_fix top_space">
		<div class="row">
			<div class="col-lg-9 col-md-12 col-sm-12 col-xs-12 left-space-r">
				<div class="block-web">
					<h2><?php $this->load->view('Stylist/include/user'); ?></h2>
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
						
						<div id="myTabContent" class="tab-content">
						<!----Section for Main content start ---->
							<h3 class="my_prof">My Portfolio</h3>
							<div id="home" class="tab-pane fade in active">
								<div class="form-group col-md-3 col-sm-6 col-xs-12">
									<?php
										$getavtar=$this->user_model->get_sql_select_data('tbl_user', array('id'=>$this->session->userdata('id')));
										$imgpath=base_url().'assets/avtars/thumbnail/113x113/'.$getavtar[0]['image'];
									?>
									<img src="<?php echo $imgpath; ?>" class="user-image img-responsive" id="img_avtar"/>
									<div class="message col-md-12 col-sm-12" style="margin:0px auto;"><?php  if($this->session->flashdata('imageMsg'))   echo  $this->session->flashdata('imageMsg'); ?></div>
									<div class="clearfix"></div>
									<div class="form-group" style="width: 188px;">
										<div class="clearfix"></div>
										<form method="post" action="<?php echo site_url('uploads/');?>" enctype="multipart/form-data" class="upload-form" id="upload_img_form" >
<div class="col-md-4">
	<input id="filestyle-4" name="pic" class="filestyle" type="file" data-size="sm" style="position: absolute; clip: rect(0px, 0px, 0px, 0px);" tabindex="-1">
	<!--<input type="file" name="pics" id="pic" accept="image/*" class="form-control" data-size="sm"  style="display:none;"/>-->
	<div class="bootstrap-filestyle input-group">
	<!--<input class="form-control input-sm" type="text" disabled="" placeholder="">-->
		<span class="group-span-filestyle input-group-btn" tabindex="0">
		<label class="btn btn-success btn-sm" for="filestyle-4">
			<span class="icon-span-filestyle glyphicon glyphicon-folder-open"></span>
			<span class="buttonText">&nbsp;Choose file</span>
		</label>
		</span>
	</div>
</div>
						
							<input type="submit" id="upload" name="upload" class="btn-black-small square-btn-adjust btn_upload" Value="Change Picture" />
						
											
											
										</form>
									</div>
								</div>
								<div class="col-md-9 col-xs-12" id="ajax_container">
									<div class="message col-md-9  form-group" style="margin:0px auto;"><?php  if($this->session->flashdata('Logmsg'))   echo  $this->session->flashdata('Logmsg'); ?></div>
									<form action="<?php echo site_url()?>stylist/editprofile" method="post">							
										<div class="form-group  col-md-4">
											<label for="inputEmail" class="lbl_fname">First Name <span class="mandetory"> *</span></label>
										</div>
										<div class="form-group  col-md-8">
											<input type="text" placeholder="First Name" id="firstname" class="form-control ajax_field" value="<?php @print $profile[0]['firstname'];// echo set_value('productname'); ?>" name="firstname" onblur="this.placeholder = 'First Name'" onfocus="this.placeholder = ''"><span id="fname_verify" class="verify"></span>
										</div>
										
										
										<div class="form-group  col-md-4">
											<label for="inputEmail" class="lbl_lname">Last Name <span class="mandetory"> *</span></label>
										</div>
										<div class="form-group  col-md-8">
											<input type="text" placeholder="Last Name" id="lastname" class="form-control ajax_field" value="<?php @print $profile[0]['lastname'];// echo set_value('productname'); ?>" name="lastname" onblur="this.placeholder = 'Last Name'" onfocus="this.placeholder = ''">
										</div>
										
										
										<div class="form-group  col-md-4">
											<label for="inputEmail" class="lbl_emaildd">Email Address <span class="mandetory"> *</span></label>
										</div>
										<div class="form-group  col-md-8">
											<input type="text" placeholder="Email Address" id="email" class="form-control ajax_field" value="<?php @print $profile[0]['email'];// echo set_value('productname'); ?>" name="email" onblur="this.placeholder = 'Email Address'" onfocus="this.placeholder = ''"><span id="email_verify" class="verify"></span>
										</div>
										<div class="clearfix"></div>
										<div class="form-group  col-md-4">
											<label for="inputEmail" class="lbl_add">Address <span class="mandetory"> *</span></label>
										</div>
										<div class="form-group  col-md-8">
											<input type="text" placeholder="Address-1" id="address1" class="form-control ajax_field" value="<?php @print $profile[0]['address1'];// echo set_value('productname'); ?>" name="address1" onblur="this.placeholder = 'Address-1'" onfocus="this.placeholder = ''">
										</div>
										
										<div class="form-group  col-md-4">
											<label for="inputEmail" class="lbl_add2">Address 2 <span class="mandetory"> *</span></label>
										</div>
										<div class="form-group  col-md-8">
											<input type="text" placeholder="Address-2" id="address2" class="form-control ajax_field" value="<?php @print $profile[0]['address2'];// echo set_value('productname'); ?>" name="address2" onblur="this.placeholder = 'Address-2'" onfocus="this.placeholder = ''">
										</div>
										
										
										<div class="form-group  col-md-4">
											<label for="inputEmail"  class="lbl_state">State <span class="mandetory"> *</span></label>
										</div>
										<div class="form-group  col-md-8">
											<select class="form-control ajax_field satename" name="state">
											<option value="">State</option>
											
										<?php
												foreach($states as $state)
												{                                                                  
                                                                                                    ?>
													<option value='<?php echo @$state[id] ?>' <?php if(@$state[id]== $profile[0]['state']) { echo 'selected=selected'; } ?>><?php @print $state[state_name]; ?></option>
												<?php }
											?>
										</select>
										</div>
										
										<div class="form-group  col-md-4">
											<label for="inputEmail" class="lbl_zipcde">Zip Code <span class="mandetory"> *</span></label>
										</div>
										<div class="form-group  col-md-8">
											<input type="text" placeholder="Zipcode" id="zipcode" class="form-control ajax_field" value="<?php @print $profile[0]['zipcode'];// echo set_value('productname'); ?>" name="zipcode" onblur="this.placeholder = 'Address-2'" onfocus="this.placeholder = ''">
										</div>
									</form>
								</div>
								

								<div class="clearfix"></div>
								
								<div class="col-md-12"><h3 class="updt_pass">Update Password</h3></div>
								<form method="post" action="<?php echo site_url('stylist/changepassword');?>">
								<div class="col-lg-3 col-sm-4">               
									
										<div class="form-group">
										<label class="crnt_pwd">Current Password</label>
										<input type="password" placeholder="Current Password" id="currentpassword" class="form-control" value="<?php echo set_value('currentpassword'); ?>" name="currentpassword" onblur="this.placeholder = 'Current Password'" onfocus="this.placeholder = ''" disabled="" />
										</div>
									
								</div>
								
								<div class="col-lg-3 col-sm-4">               
									
										<div class="form-group">
											<label class="crnt_pwd">New Password</label>
											<input type="password" placeholder="New Password" id="newpassword" class="form-control" value="<?php echo set_value('newpassword'); ?>" name="newpassword" onblur="this.placeholder = 'New Password'" onfocus="this.placeholder = ''" disabled="" />
										</div>
									
								</div>
								
								<div class="col-lg-3 col-sm-4">               
									
										<div class="form-group">
											<label class="crnt_pwd">Re-Type Password</label>
											<input type="password" placeholder="Confirm Password" id="confirmpassword" class="form-control" value="<?php echo set_value('confirmpassword'); ?>" name="confirmpassword" onblur="this.placeholder = 'Confirm Password'" onfocus="this.placeholder = ''" disabled="" />
										</div>
									
								</div>
								
								<div class="col-lg-3 col-sm-4 spc-top-2">
									<input type="submit" style="display:none !important;" value="Change Password" class="btn btn-danger square-btn-adjust" name="change" id="btn_changepassword">
									<button class="btn btn-danger square-btn-adjust" id="show_field_change" style="display:none;">Change Password</button>
								</div>
								</form>
							</div>




<div class="col-md-12">
		<div class="wrapper">
			<h3 class="Featured-heading">Featured Images</h3>
			<span class="pull_right">Your portfolio images are the ones you set as "featured" images. They can be managed in that client's profile. Click the photo below to view it in the client's profile.</span>
		<div class="jcarousel-wrapper">
			<div class="jcarousel">
				<ul id="suggestion_container" class="">
					
					<?php
						if(@$myfeaturedimage)
						{
							if(!empty($myfeaturedimage))
							{
								foreach($myfeaturedimage as $featuredimage)
								{
									
									$feature_images=explode(',',$featuredimage['photos']);
									//echo"<pre>";print_r($feature_images);
									if(!empty($feature_images[0]))
									{
										$pathToimg=base_url().'assets/uploads/thumbnails';
					?>
								<li>
									<label>
										<a href="<?php echo site_url('stylist/manageclient/'.$featuredimage['user_id']);?>">
										<img style="max-width:100%;" alt="Image" class="img-responsive" src="<?php @print $pathToimg.'/130x130/'.$feature_images[0];?>"></a>
									</label>
								</li>
					<?php				//echo"<pre>";print_r($featuredimage);
									}
								}
							}
							else
							{
					?>
								<li>
									<p>You have no featured image</p>
								</li>
					<?php
							}
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
								
							<!----Section for Main content start ---->	
							
						</div>
					</div>
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
<?php
	$this->load->view('includes/footer');
?>

<script type="text/javascript">

$('.ajax_field').on('blur',function () {
	var fieldVal = encodeURIComponent($(this).val()),
	column = $(this).attr('name');
	var url = '<?php echo site_url('stylist/editprofile');?>/'+fieldVal+'/'+column;
	//alert(id);
		$.ajax({
		type: "POST",
		url: url,
		//data: {bio:fieldVal , id:id},
		success: function(msg) {
				if(msg==1)
				{
					//$("#fname_verify").css({ "background-image": "url('<?php echo base_url();?>assets/img/yes.png')" });
				}
			}
		})
});

$(document).ready(function(){$('#upload').hide();})
$('#filestyle-4').on('change',function(){
	$('#filestyle-4').hide();
	$('.bootstrap-filestyle').hide();
	$('#upload').show()
})

</script>
