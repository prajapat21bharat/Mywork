<?php
	/*	Hiding Menu if Subscription if expired	start	*/
	$plan_expired=$this->session->userdata('plan_expired');
	if(!$plan_expired==1)
	{
?>

<div class="col-lg-3 col-md-12 col-xs-12 col-sm-12 right-space-r">
   <div class="panel panel-primary">
      <div class="panel-heading">
         <h4>My Subscription</h4>
      </div>
      <div class="panel-body">
         <div class="graph" id="hero-donut">
            <div class="col-md-12">
				<?php
					@$session_id=$this->session->userdata('id');
					$fields=array('tbl_user.id as user_id', 'stylist.id as s_id', 'subscription.id as subscription_id', 'subscription.stripe_cust_id', 'subscription.recuring_sub_id', 'subscription.subs_type', 'subscription.plan', 'subscription.stripe_plan_id', 'subscription.package', );
					$join_s=array(
							array('table'=>'stylist','condition'=>'`stylist`.`id` = `subscription`.`s_id`','jointype'=>'inner'),
							array('table'=>'tbl_user','condition'=>'`tbl_user`.`id` = `stylist`.`user_id`','jointype'=>'inner'),
							);
					@$data['subscription']=$this->user_model->get_joins('subscription', array('stylist.user_id'=>$session_id),$join_s,$fields);
		//			echo"<pre>";print_r($data['subscription']);
					if(!empty($data['subscription']))
					{
				?>
				<?php
					if($data['subscription'][0]['plan']=='2500')
					{
				?>
				<!-- Delux Monthly Package Start-->
				<div class="tiny">
					<div class="pricing-table-header-tiny">
						<h2 align="center">DELUXE</h2>
					</div>
					<div class="pricing-table-features">
						<div class="form-group">
							<div class="package">
								<p class="strong-font_L">
									<p class="PLUS-plan"><label>$25 / month</label></p>
								</p>
								<div class="package-option">
									<p>30 days FREE</p>
									<p>Client Profiles</p>
									<p>Stylist Showcase</p>
									<p>Lookbook Access</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php
					}
					if($data['subscription'][0]['plan']=='27000')
					{
				?>
				<!-- Delux Yearly Package Start-->
				<div class="tiny">
					<div class="pricing-table-header-tiny">
						<h2 align="center">DELUXE</h2>
					</div>
					<div class="pricing-table-features">
						<div class="form-group">
							<div class="package">
								<p class="strong-font_L">
									<p class="PLUS-plan"><label>$270 / year (10% off!)</label></p>
								</p>
								<div class="package-option">
									<p>30 days FREE</p>
									<p>Client Profiles</p>
									<p>Stylist Showcase</p>
									<p>Lookbook Access</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php
					}
					if($data['subscription'][0]['plan']=='4000')
					{
				?>
				<!-- Premium Monthly Package Start-->
				<div class="small">
					<div class="pricing-table-header-small">
						<h2 align="center">PREMIUM</h2>
					</div>
					<div class="pricing-table-features">
						<div class="form-group">
							<div class="package">
								<p class="strong-font_L">
									<p class="DELEUX-PLUS"><label>$40 / month</label></p>
								</p>
								<div class="package-option">
									<!--<p class="DELEUX-PLUS">Everything from DELUXE + PLUS</p>-->
									<p>30 days FREE</p>
								   <p>Client Profiles</p>
								   <p>Stylist Showcase</p>
								   <p>Lookbook Access</p>
									<p>Text reminders to clients</p>
									<p>Products</p>
									<p>Priority Platform Support</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php
					}
					if($data['subscription'][0]['plan']=='41000')
					{
				?>
				<!-- Premium Yearly Package Start-->
				<div class="small">
					<div class="pricing-table-header-small">
						<h2 align="center">PREMIUM</h2>
					</div>
					<div class="pricing-table-features">
						<div class="form-group">
							<div class="package">
								<p class="strong-font_L">
									<p class="DELEUX-PLUS"><label>	$410 / year (15% off!)</label></p>
								</p>
								<div class="package-option">
<!--									<p class="DELEUX-PLUS">Everything from DELUXE + PLUS</p>-->
									<p>30 days FREE</p>
								   <p>Client Profiles</p>
								   <p>Stylist Showcase</p>
								   <p>Lookbook Access</p>
									<p>Text reminders to clients</p>
									<p>Products</p>
									<p>Priority Platform Support</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php
					}
					if($data['subscription'][0]['plan']=='6000')
					{
				?>
				<!-- Elite Monthly Package Start-->
				<div class="medium">
				   <div class="pricing-table-header-medium">
					  <h2 align="center">ELITE</h2>
				   </div>
				   <div class="pricing-table-features">
					  <div class="form-group">
						 <div class="package">
							<p class="strong-font_L">
							  <p class="PREMIUM-PLUS"><label>$60 / month</label></p>
							</p>
							<div class="package-option">
							  <!-- <p class="PREMIUM-PLUS">Everything from PREMIUM + PLUS</p>-->
							   <p>30 days FREE</p>
							   <p>Client Profiles</p>
							   <p>Stylist Showcase</p>
							   <p>Lookbook Access</p>
							   <p>Text reminders to clients</p>
							   <p>Products</p>
							   <p>Priority Platform Support</p>
							   <p>Elite Stylist Badge</p>
							   <p>FREE 1-Year Subscription to hairstylistdesign.com ($97 value!)</p>
							</div>
						 </div>
					  </div>
				   </div>
				</div>
				<?php
					}
					if($data['subscription'][0]['plan']=='62000')
					{
				?>
				<!-- Elite Yearly Package Start-->
				<div class="medium">
				   <div class="pricing-table-header-medium">
					  <h2 align="center">ELITE</h2>
				   </div>
				   <div class="pricing-table-features">
					  <div class="form-group">
						 <div class="package">
							<p class="strong-font_L">
							   <p class="PREMIUM-PLUS"><label>$620 / year (15+% off!)</label></p>
							</p>
							<div class="package-option">
							   <!--<p class="PREMIUM-PLUS">Everything from PREMIUM + PLUS</p>-->
							   <p>30 days FREE</p>
							   <p>Client Profiles</p>
							   <p>Stylist Showcase</p>
							   <p>Lookbook Access</p>
							   <p>Text reminders to clients</p>
							   <p>Products</p>
							   <p>Priority Platform Support</p>
							   <p>Elite Stylist Badge</p>
							   <p>FREE 1-Year Subscription to hairstylistdesign.com ($97 value!)</p>
							</div>
						 </div>
					  </div>
				   </div>
				</div>
				<?php
					}
					if($data['subscription'][0]['plan']=='')
					{
						echo "<h4 class='pdding-buttom no-subscription'>Subscription Details Not Found</h4>";
					}
				}
				else
				{
			?>
				<div class="row">
					<div class="col-md-12">
						<h5> Subscription Information not available</h5>
					</div>
				</div>
			<?php
				}
			?>
				<!--Package Ends Here-->
				
			<p class="btnright-sidebar">
				   <a class="btn-black btn_subs" href="<?php echo site_url('stylist/planchange/'.@$data['subscription'][0]['subscription_id']);?>">Change Subscription</a>
			</p>
            </div>
            <div class="clearfix"></div>
            <h4 class="pdding-buttom">&nbsp;&nbsp;&nbsp;Training Resouces</h4>
            <?php
            $where=array('resource_type'=>'Multimedia');
            $data['resources']=$this->user_model->get_joins('resource', $where,'','','','1','id DESC');
            $media=$data['resources'][0]['resource_file'];
            ?>
            <div class="col-md-12">
            <video style="width:100%" class="img-responsive" controls>
				<source src="<?php echo base_url();?>/assets/resources/Multimedia/<?php echo $media; ?>" type="video/mp4">
				Your browser does not support the video tag.
			</video>
			</div>
            <div class="col-md-12 space-div"><img style="width:100%" class="img-responsive" src="<?php echo base_url();?>assets/images/training.jpg"></div>
            <div class="clearfix"></div>
            <div class="col-md-12">
               <p class="btnright-sidebar"><a class="btn-black all_resource" href="<?php echo site_url('stylist/resources');?>">See All Resources</a></p>
            </div>
         </div>
      </div>
   </div>
</div>



<?php
	/*	Hiding Menu if Subscription if expired	end	*/
	}
?>
