<?php
	$this->load->view('includes/loggedin_header');
	//echo"<pre>";print_r($allbookings);exit;
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
							<div class="col-md-9 col-sm-9">
								<h4 style="text-align:left;">My Clients</h4>
							</div>
							<div class="col-md-3 col-sm-3"> <p><a class="btn-black-small" href="<?php echo site_url('stylist/addclient');?>">+ New Client</a></p></div>
							<div class=" col-md-12 space-div clear_both"></div>
							<div class="clearfix"></div>
							<div class="col-md-12">
								
							<div class="table-responsive manage_client">
								<div role="grid" class="dataTables_wrapper form-inline" id="dataTables-example_wrapper">

										<table id="advance_filter" class="display table table-striped table-bordered table-hover dataTable no-footer" cellspacing="0" width="100%">
											<thead id="table_client">
												<tr>
													<th>Image</th>
													<th>Details</th>
													<th>Product</th>
												</tr>
											</thead>
									 
										 <tfoot>
											<tr>
												<th rowspan="1" colspan="1">
													
												</th>
											</tr>
										</tfoot>
									 
											<tbody>
												<?php
											$i=0;
											
											foreach($allclients as $client)
											{
												//echo"<pre>";print_r($client);
												if($i%2==0)
												{
													$class="even";
												}
												else
												{
													$class="odd";
												}
												$i++;
												
												
												$client_ids=array();
												
												$newimg =preg_replace('/\s+/', '_', $client['image']);

										?>					
												<tr>
													<td>
														<a class="" href="<?php echo site_url('stylist/manageclient').'/'.$client['client_uid']?>">
															<?php
																if(!file_exists(getcwd().'/assets/uploads/thumbnails/150x150/'.$newimg))
																{
																	$newimg="find_user.png";
																}
																else
																{
																	$newimg=$newimg;
																}
																if(empty($newimg))
																{
																	$newimg="find_user.png";
																}
															?>
															<img class="img-responsive img-rounded image_search_medium" src="<?php print base_url().'assets/uploads/thumbnails/150x150/'.$newimg;?>">
														</a>
													</td>
													<td class="">

														<div class="">
															<ul class="search_li">
																<li><strong> Name : &nbsp;</strong><?php print $client['firstname'].' '.$client['lastname']?></li>
																<li><strong> Email : &nbsp;</strong><?php print $client['email'] ?></li>
																<li><strong> Phone : &nbsp;</strong><?php print $client['contactno'] ?></li>
															<?php
																foreach($allbookings as $bookings)
																{
																	if($bookings['c_id']==$client['clientid'])
																	{
																		@$datetime=strtotime($bookings['booking_start_date']);
																		@$date['day']=date("l",$datetime);
																		@$date['date']=date("d",$datetime);
																		@$date['month']=date("F",$datetime);
																		@$date['year']=date("Y",$datetime);
																		//echo"<pre>";print_r($date['day']);
																?>
																	<li><strong> Next Appointment : &nbsp;</strong><?php @print $date['day'].' '.$date['month'].' '.$date['date'].', '.$date['year']; ?>
															<?php
																	}
																}
															?>
																
																	<?php 
																		/*if($client['clientid']==$allbookings[@$i]['c_id'])
																		{
																			//print $allbookings[$i]['day_start_time'];
																		}*/// @print $day.' '.$month.' '.$date.', '.$year; ?></li>
															</ul>
															<a class="btn-black-small manage_client" href="<?php echo site_url('stylist/manageclient').'/'.$client['client_uid']?>">Manage Client</a>
														</div>
													</td>

														<td class="">
															
																
																<div class="col-md-12">
																	<div class="clear_both slign-btn-R">
																	<br><a class="btn-black-small" href="<?php echo site_url('stylist/manageclient').'/'.$client['client_uid']?>#product">Suggest Products</a>
																</div>
															</div>
                                                            
														</td>

													</tr>

												<?php } ?>
											</tbody>
										</table>
								
							<!------------------ search table --------------------->
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
<script>

/* For Data table on view client page*/
$(document).ready(function() {
 
    // DataTable
    var table = $('#advance_filter').DataTable();
 
    // Apply the search
    table.columns().every( function () {
        var that = this;
 
        $( '#search', this.footer() ).on( 'keyup change', function () {
            that
                .search( this.value )
                .draw();
        } );
    } );
} );
</script>
