<?php
	$this->load->view('includes/admin_header');
	//echo"<pre>";print_r($allcategory);
?>
        
        
<div class="contentpanel" >
	<div class="container clear_both padding_fix">
		<div class="row">
			<div class="col-sm-12 col-xs-12 left-space-r">
				<div class="breadcrums">
					<span>Product Tags > </span><a href="<?php echo site_url('admin/viewtag') ?>">View Tags</a>
				</div>
				<div class="ad-haeding">
						<h2>View Tags</h2>
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
											<th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 227px;" aria-label="Browser: activate to sort column ascending">Tag Name</th>
											<th class="" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 227px;" aria-label="Browser: activate to sort column ascending">Status</th>
											<th class="" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 227px;" aria-label="Browser: activate to sort column ascending">Edit</th>
											<th class="" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 227px;" aria-label="Browser: activate to sort column ascending">Delete</th>
											<!--<th class="" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="3" style="width: 209px;" aria-label="Platform(s): activate to sort column ascending">Action</th>-->
										</tr>
									</thead>
									<tbody>
										<?php
											$i=0;
											
											foreach($alltag as $tag)
											{
												if($i%2==0)
												{
													$class="even";
												}
												else
												{
													$class="odd";
												}
												if($tag['status']==1)
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
												//echo"<pre>";print_r($category);
										?>
										<tr class="gradeA <?php echo $class; ?>">
											<td class=""><?php print $i;?></td>
											<td class=""><?php print $tag['tagname'];?></td>
											<td class=""><a href="#"><?php print $status;?></a></td>
											<td class=""><a href="<?php echo site_url('admin/edittag').'/'.$tag['id']?>">Edit</a></td>
											<td class=""><a href="<?php echo site_url('admin/deletetag').'/'.$tag['id']?>" onclick="return doconfirm()">Delete</a></td>
										</tr>
										<?php
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
