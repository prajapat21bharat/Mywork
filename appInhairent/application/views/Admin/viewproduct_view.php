<?php
	$this->load->view('includes/admin_header');
//	echo"<pre>";print_r($allproduct);
?>
        
        
<div class="contentpanel" >
	<div class="container clear_both padding_fix">
		<div class="row">
			<div class="col-sm-12 col-xs-12 left-space-r">
				<div class="breadcrums">
					<span>Products > </span><a href="<?php echo site_url('admin/viewproduct') ?>">View Products</a>
				</div>
				<div class="ad-haeding">
						<h2>View Products</h2>
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
											<th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 227px;" aria-label="Browser: activate to sort column ascending">Category</th>
											<th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 227px;" aria-label="Browser: activate to sort column ascending">Brand</th>
											<th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 227px;" aria-label="Browser: activate to sort column ascending">Description</th>
											<th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 227px;" aria-label="Browser: activate to sort column ascending">Price</th>
											<th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 227px;" aria-label="Browser: activate to sort column ascending">Image</th>
											<th class="" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 227px;" aria-label="Browser: activate to sort column ascending">Status</th>
											<th class="" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 227px;" aria-label="Browser: activate to sort column ascending">Edit</th>
											<th class="" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 227px;" aria-label="Browser: activate to sort column ascending">Delete</th>
											<!--<th class="" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="3" style="width: 209px;" aria-label="Platform(s): activate to sort column ascending">Action</th>-->
										</tr>
									</thead>
									<tbody>
										<?php
											$i=0;
											
											/*foreach($allproduct as $products)
											{
												$tagids=explode(',',$products['tagid']);							
												foreach($tagids as $tagid){
													$tagnames[]=$this->user_model->gettagnameById($tagid);
												}
												print_r($tagnames);
											}*/
											foreach($allproduct as $product)
											{
												$baseurl=base_url();
												if($i%2==0)
												{
													$class="even";
												}
												else
												{
													$class="odd";
												}
												if($product['status']==1)
												{
							
													$status = "<img class='status_img' src='$baseurl/assets/img/active.png'>";
												}
												else
												{
													
													$status = "<img class='status_img' src='$baseurl/assets/img/deactive.png'>";
												}
												$brandname=$this->user_model->getbrandnameById($product['brand_id']);
												$categoryname=$this->user_model->getcategorynameById($product['categoryid']);
												//$tagname=$this->user_model->gettagnameById($product['tagid']);
												$i++;
												//echo"<pre>";print_r($product['tagid']);
												
										?>
										<tr class="gradeA <?php echo $class; ?>">
											<td class=""><?php print $i;?></td>
											<td class=""><?php print $product['name'];?></td>
											<td class=""><?php print $categoryname[0]['name'];?></td>
											<td class=""><?php print $brandname[0]['name'];?></td>
											<td class=""><?php print $product['description'];?></td>
											<td class=""><?php print $product['price'];?></td>
											<td class=""><img src="<?php print $baseurl.'assets/product/thumbnails/150x150/'.$product['image'];?>" class="product_img" /></td>
											<td class=""><a href="#"><?php print $status;?></a></td>
											<td class=""><a href="<?php echo site_url('admin/editproduct').'/'.$product['id']?>">Edit</a></td>
											<td class=""><a href="<?php echo site_url('admin/deleteproduct').'/'.$product['id']?>" onclick="return doconfirm()">Delete</a></td>
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
