<?php
	$this->load->view('includes/loggedin_header');
//	echo"<pre>";print_r();exit;
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
						<div id="myTabContent" class="tab-content"  style="<?php print $style; ?>">
							<!----Section for Main content start ---->
							
							<div class="panel-heading">
								 <h3>Brands I Stock</h3>
							</div>
							
							<div class="ajax_msg">
								
							</div>
							
							<div class="row">
								<div class="col-sm-12">
									<ul class="stocked_brands">
										<?php
											if(@$allbrands)
											{
												$i=4;
												$j=0;
												foreach($allbrands as $brands)
												{
													if($i % 4 == 0)
													{
														if($i==4)
														{
															$lastclass="fisrt_product_li";
														}
														else
														{
															$lastclass="last_product_li";
														}
													}
													else
													{
														$lastclass="";
													}
													$B_ids=array();
													foreach($stylist_uses as $stylist_b_name)
													{
														if($stylist_b_name['brand_id']==$brands['id'])
														{
															array_push($B_ids,$stylist_b_name['brand_id']);
														}
													}
													//echo"<pre>";print_r($B_ids);
										?>											
											<li  class="<?php @print $lastclass;?>">
												<label for="stockbrands-<?php @print $brands['id']; ?>">
													<input type="checkbox" name="stockbrands" id="stockbrands-<?php @print $brands['id']; ?>" value="<?php @print $brands['id'];?>" class="ajax_stockbrand stylist_brands" <?php if(in_array($brands['id'],$B_ids)){echo "checked";}else{echo "";}?> />
													<span class="checkbox"></span>
													<?php @print $brands['name'];?>
												</label>
											</li>
										<?php		
												$i++;	
													
												}
											}
										?>
									</ul>
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

$('.ajax_stockbrand').on('change',function () {
	
	var id=$(this).val();
	
	if(this.checked)
	{
		var url = '<?php echo site_url('stylist/mybrands');?>/1/'+id;
		
		 $.ajax({
                type: "POST",
                url: url,
                success: function(data) {
					$('.ajax_msg').html('<p style="color:green"> Brand Added To My Stock Successfully </p>');
                },
           });
	}
	else
	{
		var url = '<?php echo site_url('stylist/mybrands');?>/0/'+id;
		//alert(fieldVal);
		 $.ajax({
                type: "POST",
                url: url,
                success: function(data){
					$('.ajax_msg').html('<p style="color:green"> Brand Removed From My Stock Successfully </p>');
                },
           });
	}
	
});

</script>

