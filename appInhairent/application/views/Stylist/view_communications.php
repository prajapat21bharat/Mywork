<?php
	$this->load->view('includes/loggedin_header');
//	echo"<pre>";print_r($email_archive);

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
								<?php
										if(!empty($communications))
										{
									?>
									<div class="row">
										<div class="col-md-12">
											<a href="<?php echo site_url().'stylist/sendmail'; ?>">Back to Email</a>
										</div>
									</div>
								
								<div class="row">								
									<div class="table-responsive" id="view-mails">
										<div role="grid" class="dataTables_wrapper form-inline" id="dataTables-example_wrapper">
											<table id="dataTables-example" class="table table-striped table-bordered table-hover dataTable no-footer" aria-describedby="dataTables-example_info">
											<thead>
												<tr role="row">
													<th class="sorting_asc" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 171px;" >S. No.</th>
													<th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 227px;" aria-label="Browser: activate to sort column ascending">Client Name</th>
													<th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 227px;" aria-label="Browser: activate to sort column ascending">Title</th>
													<!--<th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 227px;" aria-label="Browser: activate to sort column ascending">Message</th> -->
													<th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 227px;" aria-label="Browser: activate to sort column ascending">Sent Date</th>
													<th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 227px;" aria-label="Browser: activate to sort column ascending">View</th>
												</tr>
											</thead>
											<tbody>
												<?php
													$i=0;
													foreach($communications as $archive)
													{
														if($i%2==0)
														{
															$class="even";
														}
														else
														{
															$class="odd";
														}
														$i++;
														
															$datetime=strtotime($archive['createdate']);
															$date=date("d F Y",$datetime);
												?>
												<tr class="gradeA <?php echo $class; ?>">
													<td class=""><?php print $i;?></td>
													<td class=""><?php print $archive['firstname'].' '.$archive['lastname'];?></td>
													<td class=""><?php print $archive['title'];?></td>
													<!--<td class="template_content_row"><?php // print $archive['sent_content'];?></td>  -->
													<td class=""><?php print $date; ?></td>
													<td class=""><a href="<?php echo site_url().'stylist/communication/'.$archive['communication_id']; ?>"><i class="fa fa-eye"></i> View</a></td>
												</tr>
												<?php
													}
												?>
												</tbody>
										</table>
									</div>
								</div>
							</div>
									<?php
										}
									?>
									
									
									<?php
										if(!empty($sent_message))
										{
											//echo"<pre>";print_r($sent_message);
									?>
									<div class="row">
										<div class="col-md-12">
											<a href="<?php echo site_url().'stylist/communications'; ?>">Back to Communication</a>
										</div>
									</div>
									
									<div class="row top-padder">
											<div class="col-md-12 template_content_row "><?php print $sent_message[0]['content']; ?></div>
									</div>
									<?php
										}
									?>
									
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
