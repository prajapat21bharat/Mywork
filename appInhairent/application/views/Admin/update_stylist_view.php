<?php
	$this->load->view('includes/admin_header');
//	echo "<pre>";print_r($subscription[0]['plan']);exit;
	//echo"<pre>";print_r($this->session->userdata());
?>

<div class="contentpanel" >
	<div class="container clear_both padding_fix">
		<div class="row">
			<div class="col-sm-12 col-xs-12 left-space-r">
				<div class="breadcrums">
					<span>Stylists > </span>
					<a href="<?php echo site_url('admin/viewstylist') ?>">All Stylist ></a>
					<a href="<?php echo site_url()?>admin/editstylist/<?php print $getuser[0]['id'];?>">Edit Stylist </a>
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
                    </div>
                </div>
                 <!-- /. ROW  -->
                
                 <div class="row">
					<div class="col-md-12">
						 
						<form action="<?php echo site_url()?>admin/editstylist/<?php print $getuser[0]['id'];?>" method="post" id="payment-form">
						<div class="col-md-6">
							<div class="form-group">
								<label for="inputEmail">First Name <span class="mandetory"> *</span></label>
								<input type="text" placeholder="First Name" id="firstname" class="form-control" value="<?php print $getuser[0]['firstname'];?>" name="firstname" onblur="this.placeholder = 'First Name'" onfocus="this.placeholder = ''">
								<input type="hidden" id="stylistid" class="form-control" value="<?php print $getuser[0]['id'];?>" name="stylistid" >
							</div>
						</div>
							
							<div class="col-md-6">
								<div class="form-group">
									<label for="inputEmail">Last Name <span class="mandetory"> *</span></label>
									<input type="text" placeholder="Last Name" id="lastname" class="form-control" value="<?php print $getuser[0]['lastname'];?>" name="lastname" onblur="this.placeholder = 'Last Name'" onfocus="this.placeholder = ''">
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group">
									<label for="inputEmail">Email Address <span class="mandetory"> *</span></label>
									<input type="text" placeholder="Email Address" id="email" class="form-control" value="<?php print $getuser[0]['email'];?>" name="email" onblur="this.placeholder = 'Email Address'" onfocus="this.placeholder = ''">
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group">
									<label for="inputEmail">Phone Number <span class="mandetory"> *</span></label>
									<input type="text" placeholder="Phone Number" id="contactno" class="form-control" value="<?php print $getuser[0]['contactno'];?>" name="contactno" onblur="this.placeholder = 'Phone Number'" onfocus="this.placeholder = ''"  onkeyup="GetPhoneFormat('contactno')"   maxlength="14" onkeypress="return validatealphanumeric(event)" >
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="salon_name">Name of Salon <span class="mandetory"> *</span></label>
									<input type="text" name="salon_name" value="<?php echo $getuser[0]['salon_name']; ?><?php echo set_value('salon_name'); ?>" class="form-control" id="salon_name" placeholder="Name of Salon" onblur="this.placeholder = 'Name of Salon'" onfocus="this.placeholder = ''">
								</div>
							</div>
							<?php /*?>
							<div class="form-group">
								<label for="inputEmail">Password <span class="mandetory"> *</span></label>
								<input type="password" placeholder="Last Name" id="password" class="form-control" value="<?php print $getuser[0]['password'];?>" name="password" onblur="this.placeholder = 'Password'" onfocus="this.placeholder = ''">
							</div> 
							
							
							<div class="col-md-2">
								<div class="form-group">
									<label>
										Stylist Type <span class="mandetory"> *</span>
									</label>
								</div>
							</div>
							
							<?php
								if($getuser[0]['usertype']=='INDEPENDENT STYLIST')
								{
									$user_type_i="checked";
								}
								else
								{
									$user_type_i="";
								}
								if($getuser[0]['usertype']=='SALON')
								{
									$user_type_s="checked";
								}
								else
								{
									$user_type_s="";
								}
							?>
							<div class="col-md-4">
								<div class="form-group">
									<label>
										<input type="radio" name="usertype" value="INDEPENDENT STYLIST" <?php echo set_radio('usertype', 'INDEPENDENT STYLIST'); ?> <?php print $user_type_i; ?> id="independent_stylist">
										INDEPENDENT STYLIST
									</label>
							
									<label>
										<input type="radio" name="usertype" value="SALON" <?php echo set_radio('usertype', 'SALON'); ?> <?php print $user_type_s; ?> id="salon">
										SALON OWNER
									</label>
									
								</div>
							</div>
							<?php */?>
							
              
							
						
              
              <?php /* ?>
							<div class="col-md-2">
								<div class="form-group">
									<label for="no_of_stylist">Number of Stylist <span class="mandetory"> *</span></label>
								</div>
							</div>
              
							<div class="col-md-4">
								<div class="form-group">
								<select name="no_of_stylist" id="no_of_stylist" class="form-control">
									<option value="">Number of Stylist</option>
										<?php
										$i = 1;
										for ($i = 1; $i <= 25; $i++)
										{
											if($getuser[0]['no_of_stylist']==$i)
											{
												$selected="selected";
											}
											else
											{
												$selected='';
											}
											echo"<option value='$i'" . set_select('no_of_stylist', $i) . " $selected>$i</option>";
										}
										?>
									</select>
								</div>
							</div>
				<?php */ ?>
				
				
				
											<!------------------------------------------------Package-------------------------------------------------------->
							<div class="col-md-12"></div>
							<div class="col-md-4">
								<div class="form-group">
									<div class="tiny">
										<div class="pricing-table-header-tiny">
											<h2 align="center">DELUXE</h2>
										</div>
											<?php
											if(!empty($subscription))
											{
												if($subscription[0]['plan']=='2500')
												{
													$delux_m='checked';
												}
												else
												{
													$delux_m='';
												}
												if($subscription[0]['plan']=='27000')
												{
													$delux_y='checked';
												}
												else
												{
													$delux_y='';
												}
											}
											else
											{
												$delux_m='';
												$delux_y='';
											}
											?>
										<div class="pricing-table-features">
											<p class="strong-font_L">
												<label>
													<input type="radio" name="packages" value="2500" <?php echo set_radio('packages', '2500'); ?> id="deluxe_month" class="sty_package" data-name="DELUXE" data-value="Monthly" <?php print $delux_m;?> >
													$25 / month
												</label>
											</p>
											<p class="strong-font_L">
												<label>
													<input type="radio" name="packages" value="27000" <?php echo set_radio('packages', '27000'); ?> id="deluxe_year" class="sty_package" data-name="DELUXE" data-value="Yearly" <?php print $delux_y;?> >
													$270 / year (10% off!)
												</label>
											</p>
										</div>
									</div>
								</div>
							</div>
							
							<div class="col-md-4">
								<div class="form-group">
									<div class="small">
										<div class="pricing-table-header-small">
											<h2 align="center">PREMIUM</h2>
										</div>
										<div class="pricing-table-features">
										<?php
										if(!empty($subscription))
										{
											if($subscription[0]['plan']=='4000')
											{
												$premium_m='checked';
											}
											else
											{
												$premium_m='';
											}
											if($subscription[0]['plan']=='41000')
											{
												$premium_y='checked';
											}
											else
											{
												$premium_y='';
											}
										}
										else
										{
											$premium_m='';
											$premium_y='';
										}
										?>
										<p class="strong-font_L">
											<label>
												<input type="radio" name="packages" value="4000" <?php echo set_radio('packages', '4000'); ?> id="premium_month" class="sty_package" data-name="PREMIUM" data-value="Monthly" <?php print $premium_m;?> >
												$40 / month
											</label>
										</p>
										<p class="strong-font_L">
											<label>
												<input type="radio" name="packages" value="41000" <?php echo set_radio('packages', '41000'); ?> id="premium_year"  class="sty_package" data-name="PREMIUM" data-value="Yearly" <?php print $premium_y;?> >
												$410 / year (15% off!)
											</label>
										</p>
									</div>
									</div>
								</div>
							</div>
							
							<div class="col-md-4">
								<div class="form-group">
									<div class="medium">
										<div class="pricing-table-header-medium">
											<h2 align="center">ELITE</h2>
										</div>
										<div class="pricing-table-features">
										<?php
											if(!empty($subscription))
											{
												if($subscription[0]['plan']=='6000')
												{
													$elite_m='checked';
												}
												else
												{
													$elite_m='';
												}
												if($subscription[0]['plan']=='62000')
												{
													$elite_y='checked';
												}
												else
												{
													$elite_y='';
												}
											}
											else
											{
												$elite_m='';
												$elite_y='';
											}
											
										?>
										<p class="strong-font_L">
											<label>
												<input type="radio" name="packages" value="6000" <?php echo set_radio('packages', '6000'); ?> id="elite_month" class="sty_package" data-name="ELITE" data-value="Monthly" <?php print $elite_m;?> >
												$60 / month
											</label>
											</p>
										<p class="strong-font_L">
											<label>
												<input type="radio" name="packages" value="62000" <?php echo set_radio('packages', '62000'); ?> id="elite_year" class="sty_package" data-name="ELITE" data-value="Yearly" <?php print $elite_y;?> >
												$620 / year (15+% off!)
											</label>
										</p>
										<input type="hidden" name="pack_name" id="pack_name" value="" />
										<input type="hidden" name="subs_type" id="subs_type" value="" />
										
										<input type="hidden" name="stripe_cust_id" id="stripe_cust_id" value="<?php @print $subscription[0]['stripe_cust_id']; ?>" />
										<input type="hidden" name="stripe_plan_id" id="stripe_plan_id" value="<?php @print $subscription[0]['stripe_plan_id']; ?>" />
										<input type="hidden" name="recuring_sub_id" id="recuring_sub_id" value="<?php @print $subscription[0]['recuring_sub_id']; ?>" />
									</div>
									</div>
								</div>
							</div>
							
							<!------------------------------------------------Billing Address---------------------------------------------->
							
							<div class="col-md-6">
							  <div class="form-group">
								  <label for="address_a">Address <span class="mandetory"> *</span></label>
								<input type="text" name="address_a" value="<?php print $getuser[0]['address1']; ?>" class="form-control" id="address_a" placeholder="Address" onblur="this.placeholder = 'Address'" onfocus="this.placeholder = ''">
							  </div>
							</div>
							
			
							<div class="col-md-6">
							  <div class="form-group">
								  <label for="address_b">Address 2</label>
								<input type="text" name="address_b" value="<?php  print $getuser[0]['address2']; ?>" class="form-control" id="address_b" placeholder="Address 2" onblur="this.placeholder = 'Address 2'" onfocus="this.placeholder = ''">
							  </div>
							</div>
							
				
							<div class="col-md-6">
							  <div class="form-group">
								  <label for="city">City <span class="mandetory"> *</span></label>
								<input type="text" name="city" value="<?php print $getuser[0]['city']; ?>" class="form-control" id="city" placeholder="City" onblur="this.placeholder = 'City'" onfocus="this.placeholder = ''">
							  </div>
							</div>
							
							<div class="col-md-6">
							  <div class="form-group">
								  <label for="state">State <span class="mandetory"> *</span></label>
								<select class="form-control" name="state">
								  <option value="">State</option>
								  <?php
									foreach ($states as $state)
									{
										if($getuser[0]['state']==$state['id']
										)
										{
											$selected_state='selected';
										}
										else
										{
											$selected_state='';
										}
										echo "<option $selected_state value='$state[id]' " . set_select('state', $state['id']) . " >$state[state_name]</option>";
									}
									?>
								</select>
							  </div>
							</div>

							<div class="col-md-6">
							  <div class="form-group">
								  <label for="zipcode">Zip Code <span class="mandetory"> *</span></label>
								<input type="text" name="zipcode" value="<?php print $getuser[0]['zipcode']; ?>" class="form-control" id="zipcode" placeholder="Zip Code" onblur="this.placeholder = 'Zip Code'" onfocus="this.placeholder = ''" maxlength='6' onkeypress="return validatealphanumeric(event)" >
							  </div>
							</div>
				
							<div class="col-md-6">
								<div class="form-group">
									<label for="inputEmail">Status <span class="mandetory"> *</span></label>
									
										<input type="radio" value="1" <?php if($getuser[0]['status']==1)echo "checked";?> name="status" id="status_a">
										<label for="status_a" class="radio-inline">Active</label>
										
										<input type="radio" value="0" <?php if($getuser[0]['status']==0)echo "checked";?> name="status" id="status_b">
										<label for="status_b" class="radio-inline">InActive</label>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<input type="submit" value="Update" class="btn-black-small square-btn-adjust" name="update">
								</div>
							</div>
						</form>
					</div>
				</div>
			
			</div>
             <!-- /. PAGE INNER  -->
		</div>
         <!-- /. PAGE WRAPPER  -->
<?php
	$this->load->view('includes/footer');
?>

<script>
	/*setting format for contact no keyup*/
	function GetPhoneFormat(id)
	{
		var str = document.getElementById(id).value;
		if (str.length == 3) {
		var ind = str.substring(0,3);
		document.getElementById(id).value = '('+ind+') ';
		}
		if (str.length == 9) {
		var ind = str.substring(0, 9);
		document.getElementById(id).value = ind+'-';
		}
	}
</script>

	<script>
		/*autocomplete for client list*/
      $(function() {
        $("#stylist_list").customselect();
      });
	</script>

<script>
	$(document).ready(function(){
		$('#pack_name').val($('input[name=packages]:checked').attr('data-name'));
		$('#subs_type').val($('input[name=packages]:checked').attr('data-value'));
	})
	
	$('.sty_package').change(function(){
		var pack_name=$(this).attr('data-name');
		$('#pack_name').val(pack_name);
		$('#subs_type').val($(this).attr('data-value'));
	})
</script>

<!-- The  script for Stripe lib -->
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>


<script type="text/javascript">
	// This identifies your website in the createToken call below
	Stripe.setPublishableKey('pk_test_u4gDKpRI7LO8qgx26y3IzLgl');
	var stripeResponseHandler = function(status, response) {
	var $form = $('#payment-form');
	   
	// token contains id, last4, and card type
	var token = response.id;
	// Insert the token into the form so it gets submitted to the server
	$form.append($('<input type="hidden" name="stripeToken" />').val(token));
	// and re-submit
	$form.get(0).submit();

	};
	/*jQuery(function($) {
		$('#payment-form').submit(function(e) {
			var $form = $(this);
			// Disable the submit button to prevent repeated clicks
			$form.find('button').prop('disabled', true);
			Stripe.card.createToken($form, stripeResponseHandler);
			// Prevent the form from submitting with the default action
			return false;
		});
	});*/
</script>
