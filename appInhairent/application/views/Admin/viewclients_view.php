<?php
	//echo"<pre>";print_r($allclients);
	$this->load->view('includes/admin_header');
	
?>
        
        
<div class="contentpanel" >
	<div class="container clear_both padding_fix">
		<div class="row">
			<div class="col-sm-12 col-xs-12 left-space-r">
				<div class="breadcrums">
					<span>Stylists > </span>
					<a href="<?php echo site_url('admin/viewstylist') ?>">All Stylists > </a>
					<a href="<?php echo site_url()?>admin/clients/<?php print @$allclients[0]['s_user_id']; ?>">View Clients </a>
				</div>
				<div class="ad-haeding">
						<h2>All Clients  <?php if(!empty($allclients)){ echo 'of '.$allclients[0]['s_fname'].' '.$allclients[0]['s_lname'];} ?></h2>
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
											<!--<th class="sorting_asc" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 171px;" >S. No.</th>-->
											<th class="sorting" tabindex="0" style="" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 227px;" aria-label="Browser: activate to sort column ascending">S. No.</th>
											<th class="sorting" tabindex="0" style="" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 227px;" aria-label="Browser: activate to sort column ascending">Client Details</th>
										</tr>
									</thead>
									<tbody>
									<?php
										$i=0;
										if(!empty($allclients))	
										{
											foreach($allclients as $client)
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
												//echo"<pre>";print_r($category);
										?>
										<tr class="gradeA <?php echo $class; ?>">
											<td class=""><?php  print $i;?></td>
											<td>
												
												<div class="content">	
													<?php /*?>
													<div class="up-img">				 
														<img src="<?php echo base_url('assets/uploads/thumbnails/244x244/'.$client['photos']);?>">
													</div>
													<?php */?>
													
													 <div class="client-data">
														 <div class="col-sm-3">
															<span class="client-headings">Name :</span>
														 </div>
														 <div class="col-sm-9">
															<span class="client-contant"><?php print $client['firstname'].' '.$client['lastname']; ?></span>
														 </div>
														 
														 <div class="col-sm-3">
															<span class="client-headings">Contact No :</span>
														 </div>
														 <div class="col-sm-9">
															<span class="client-contant"><?php print $client['contactno']; ?></span>
														 </div>
														 
														 <div class="col-sm-3">
															<span class="client-headings">Email :</span>
														 </div>
														 <div class="col-sm-9">
															<span class="client-contant"><?php print $client['email']; ?></span>
														 </div>
														 
														 <div class="col-sm-3">
															<span class="client-headings">Gender :</span>
														 </div>
														 <div class="col-sm-9">
															<span class="client-contant"><?php print $client['gender']; ?></span>
														 </div>

													 </div>
												 </div>
											</td>
										</tr>
										<?php
											}
										}
									?>
										</tbody>
								</table>
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
