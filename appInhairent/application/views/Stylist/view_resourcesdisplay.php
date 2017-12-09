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
										if(!empty($resources))
										{
									?>
									<div class="row">
										<div class="col-md-12">
											<a href="<?php echo site_url().'stylist/resources'; ?>">Back to Resources</a>
										</div>
									</div>
								
								<div class="row">								
									<div class="table-responsive" style="f">
										<div>
											<table >
											<tbody>
												<?php
													$i=0;
													foreach($resources as $resource)
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
														
												?>
												<style>
												tr{height:40px;}td{width:300px}
												</style>
												<tr>
												<td><b>Title:</b></td><td><?php print $resource['title'];?></td>
												</tr>
												<tr>
												<td><b>Description:</b></td><td ><?php print $resource['description'];?></td>
												</tr>
												<tr>
												<td><b>Resource type:</b></td><td ><?php print $resource['resource_type'];?></td>
												</tr>
												<?php
													$category_id=$resource['res_cate_id'];
													$data1['category']=$this->user_model->get_joins('resource_category',array('id'=>$category_id));
												    $category_name=$data1['category'][0]['name'];
												?>
												<tr>
												<td><b>Resource category:</b></td><td ><?php print $category_name;?></td>
												</tr>
												<tr>
												<td><b>Resource file:</b></td><td ><?php print $resource['resource_file'];?></td>
												</tr>
												<tr>
												<?php
												if($resource['resource_type']=="Multimedia")
												{
													echo'<td colspan="2"><video style="width:100%" class="img-responsive" controls>
													<source src="'.base_url("/assets/resources/Multimedia/$resource[resource_file]").'" type="video/mp4">
													Your browser does not support the video tag.
													</video></td>';
												}
												if($resource['resource_type']=="Image")
												{
												   echo'<td colspan="2"><a href="'.base_url("/assets/resources/Image/$resource[resource_file]").'" target="_blank" download><img style="width:100%" class="img-responsive" src="'.base_url("/assets/resources/Image/$resource[resource_file]").'"></a></td>';
												}
													
												if($resource['resource_type']=="Doc")
												{
												   echo'<td></td><td><a href="'.base_url("/assets/resources/Doc/$resource[resource_file]").'" target="_blank" download><img style="width:50%" title="click to download" class="img-responsive" src="'.base_url("/assets/images/downloadbutton.png").'"></a></td>';
												}
												?>	
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
