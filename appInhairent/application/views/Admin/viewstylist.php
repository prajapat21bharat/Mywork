<?php
	$this->load->view('includes/admin_header');
//	echo"<pre>";print_r($allstylist);exit;
?>
        
        
<div class="contentpanel" >
	<div class="container clear_both padding_fix">
		<div class="row">
			<div class="col-sm-12 col-xs-12 left-space-r">
				<div class="breadcrums">
					<span>Stylists > </span><a href="<?php echo site_url('admin/viewstylist') ?>">All Stylists</a>
				</div>
				<div class="ad-haeding">
					
						<h2>Stylists</h2>
						<?php
							if (isset($message))
							{
								echo $message;
							}
						 ?>
						 <div class="message" style="margin:0px auto;"><?php  if($this->session->flashdata('Logmsg'))   echo  $this->session->flashdata('Logmsg'); ?></div>
                    </div>
                    </hr>
                </div>
                </div>
                 <!-- /. ROW  -->
               
			<!---->
			<div class="row">
				<div class="col-md-12">
					<!-- Advanced Tables -->
					<div class="panel panel-default">
						<div class="panel-body">
							<div class="table-responsive">
								<div role="grid" class="dataTables_wrapper form-inline" id="dataTables-example_wrapper">
									<table id="dataTables-example" class="table table-striped table-bordered table-hover dataTable no-footer" aria-describedby="dataTables-example_info">
									<thead>
										<tr role="row">
											<th class="sorting_asc" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 171px;" >S. No.</th>
											<th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 227px;" aria-label="Browser: activate to sort column ascending">Name</th>
											<th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 227px;" aria-label="Browser: activate to sort column ascending">Email Id</th>
											<th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 227px;" aria-label="Browser: activate to sort column ascending">Contact No</th>
											<!--<th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 227px;" aria-label="Browser: activate to sort column ascending">Age</th> -->
											<th class="" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 227px;" aria-label="Browser: activate to sort column ascending">Status</th>
											<th class="" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 227px;" aria-label="Browser: activate to sort column ascending">Password</th>
											<th class="" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 227px;" aria-label="Browser: activate to sort column ascending">Edit</th>
											<th class="" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 227px;" aria-label="Browser: activate to sort column ascending">Featured Images</th>
											<th class="" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 227px;" aria-label="Browser: activate to sort column ascending">Public Images</th>
											<th class="" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 227px;" aria-label="Browser: activate to sort column ascending">Clients</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$i=0;
											
											foreach($allstylist as $stylist)
											{
												if($i%2==0)
												{
													$class="even";
												}
												else
												{
													$class="odd";
												}
												if($stylist['status']==1)
												{
													$baseurl=base_url();
													$status = "<img class='status_img' src='$baseurl/assets/img/active.png'>";
												}
												else
												{
													$baseurl=base_url();
													$status = "<img class='status_img' src='$baseurl/assets/img/deactive.png'>";
												}

												$i++;
												
										?>
										<tr class="gradeA <?php echo $class; ?>">
											<td class=""><?php print $i;?></td>
											<td class=""><?php print $stylist['firstname']." ".$stylist['lastname'];?></td>
											<td class=""><?php print $stylist['email'];?></td>
											<td class=""><?php print $stylist['contactno'];?></td>
											<!--<td class=""><?php // print $stylist['age'];?></td> -->
											
											<td class=""><a href="<?php echo site_url('admin/changeuserstatus').'/'.$stylist['id'];?>"><?php print $status;?></a></td>
											<td class="">
												<a class="" href="#popup1<?php print $stylist['id'];?>">Change</a>
											</td>
											<td class=""><a href="<?php echo site_url('admin/editstylist').'/'.$stylist['id']?>">Edit</a></td>
											<td class=""><a href="<?php echo site_url('admin/featuredimage').'/'.$stylist['id']?>">View</a></td>
											<td class=""><a href="<?php echo site_url('admin/publicimages').'/'.$stylist['id']?>">View</a></td>
											<td class=""><a href="<?php echo site_url('admin/clients').'/'.$stylist['id']?>">View</a></td>
											<?php /*<td class=""><a href="<?php echo site_url('admin/deletestylist').'/'.$stylist['id']?>" onclick="return doconfirm()">Delete</a></td> */?>
										</tr>
										<?php
											}
										?>
										</tbody>
								</table>
								<?php
									foreach($allstylist as $stylist)
									{
								?>
								<div id="popup1<?php print $stylist['id'];?>" class="overlay ad_chng_pass">
											<div class="popup ad_chng_pass_inner">
												<a class="close" href="">&times;</a>
												<div class="content">
													<?php
														if (isset($message))
														{
															echo $message;
														}
														if (isset($_POST['newpassword']))
														{
															$newpassword=set_value('newpassword');
														}
														else
														{
															$newpassword='';
														}
													 ?>
													<div class="message" style="margin:0px auto;"><?php  if($this->session->flashdata('popup_Logmsg'))   echo  $this->session->flashdata('popup_Logmsg'); ?></div>
													<div id="ajax-pass-<?php print $stylist['id'];?>" class="ajax-pass ad_chng_pass_content">
														<div class="col-md-12 col-lg-12 col-sm-12 ">
															<form method="post" action="<?php echo site_url()?>admin/stylist_password" >
                                                                                                                             <label>Change password for <strong><?php print $stylist['firstname']." ".$stylist['lastname'];?></strong></label>
																<div class="form-group">
                                                                                                                                   
																	<input type="hidden" name="stylistId" id="stylistId" class="" value="<?php print $stylist['id'];?>" />
																	<input type="password" placeholder="Password" id="newpassword" class="form-control ajax_hidden" value="<?php echo $newpassword; ?>" name="newpassword" onblur="this.placeholder = 'Password'" onfocus="this.placeholder = ''">
																	<input type="password" placeholder="Confirm Password" id="re_password" class="form-control ajax_hidden" value="<?php echo set_value('re_password'); ?>" name="re_password" onblur="this.placeholder = 'Confirm Password'" onfocus="this.placeholder = ''">
																</div>
																<div class="form-group">
																	<input type="submit" name="update" id="update" value="Change" class="sp-btn btn-black-small square-btn-adjust"/>
																</div>
															</form>
														</div>
													</div>
												</div>
											</div>
										</div>
										
								<?php }?>
							</div>
						</div>
					</div>
				</div>
					<!--End Advanced Tables -->
			</div>
		</div>
			<!---->
	</div>
             <!-- /. PAGE INNER  -->
</div>
         <!-- /. PAGE WRAPPER  -->
<?php
	$this->load->view('includes/footer');
?>

<script>
	/* Toggle Change Password*/
	$(".ajax-pass-a").click(function(){
		var id=$(this).attr('id');
		//alert(id);
        $("#ajax-pass-"+id).toggle();
    });
    
</script>
