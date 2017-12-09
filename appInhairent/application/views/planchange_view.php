<?php
	$this->load->view('includes/loggedin_header');
//	echo"<pre>";print_r($subscription);
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
					<?php
						if (isset($message))
						{
							echo $message;
						}
					?>
					<div class="panel-body">
						
						<?php // $this->load->view('Stylist/include/tabbedmenu'); ?>
						
						<div id="myTabContent" class="tab-content">
						<!----Section for Main content start ---->
							<h3 class="my_prof">Change My Subscription</h3>
							<div id="home" class="tab-pane fade in active">
								<form method="post" action="<?php echo site_url('plan/planchange/'.$subscription[0]['subscription_id']); ?>" class="left_form" id="payment-form">
									<!-- Package Start Here-->
									  <div class="row-fluid">
										<?php
											if($subscription[0]['plan']==2500)
											{
												$delux_m="checked";
											}
											else
											{
												$delux_m="";
											}
											if($subscription[0]['plan']==27000)
											{
												$delux_y="checked";
											}
											else
											{
												$delux_y="";
											}
											if($subscription[0]['plan']==4000)
											{
												$premium_m="checked";
											}
											else
											{
												$premium_m="";
											}
											if($subscription[0]['plan']==41000)
											{
												$premium_y="checked";
											}
											else
											{
												$premium_y="";
											}
											if($subscription[0]['plan']==6000)
											{
												$elite_m="checked";
											}
											else
											{
												$elite_m="";
											}
											if($subscription[0]['plan']==62000)
											{
												$elite_y="checked";
											}
											else
											{
												$elite_y="";
											}
										?>
									   <!--Delux Start-->
										<div class="col-md-4">
										  <div class="tiny">
											<div class="pricing-table-header-tiny">
											  <h2 align="center">DELUXE</h2>
											</div>
											<div class="pricing-table-features">
											  <div class="form-group">
												<div class="package">
												  <p class="strong-font_L">
													<label>
													  <input type="radio" name="packages" value="2500" <?php echo set_radio('packages', '2500'); ?> id="deluxe_month"  data-name="DELUXE" data-value="Monthly" class="sty_package" <?php print $delux_m; ?> />
													   $25 / month</label>
												  </p>
												  <p class="strong-font_L">
													<label>
													  <input type="radio" name="packages" value="27000" <?php echo set_radio('packages', '27000'); ?> id="deluxe_year"  data-name="DELUXE" data-value="Yearly" class="sty_package" <?php print $delux_y; ?> />
													  $270 / year (10% off!)</label>
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
										</div>
									   <!--Premium Start-->
										<div class="col-md-4">
										  <div class="small">
											<div class="pricing-table-header-small">
											  <h2 align="center">PREMIUM</h2>
											</div>
											<div class="pricing-table-features">
											  <div class="form-group">
												<div class="package">
												  <p class="strong-font_L">
													<label>
													  <input type="radio" name="packages" value="4000" <?php echo set_radio('packages', '4000'); ?> id="premium_month"  data-name="PREMIUM" data-value="Monthly"  class="sty_package" <?php print $premium_m; ?> />
													  $40 / month</label>
												  </p>
												  <p class="strong-font_L">
													<label>
													  <input type="radio" name="packages" value="41000" <?php echo set_radio('packages', '41000'); ?> id="premium_year"  data-name="PREMIUM" data-value="Yearly"  class="sty_package" <?php print $premium_y; ?> />
													  $410 / year (15% off!)</label>
												  </p>
												  <div class="package-option">
													<p class="DELEUX-PLUS">Everything from DELUXE + PLUS</p>
													<p>Text reminders to clients</p>
													<p>Products</p>
													<p>Priority Platform Support</p>
												  </div>
												</div>
											  </div>
											</div>
										  </div>
										</div>
										<!--Elite Start-->
										<div class="col-md-4">
										  <div class="medium">
											<div class="pricing-table-header-medium">
											  <h2 align="center">ELITE</h2>
											</div>
											<div class="pricing-table-features">
											  <div class="form-group">
												<div class="package">
												  <p class="strong-font_L">
													<label>
													  <input type="radio" name="packages" value="6000" <?php echo set_radio('packages', '6000'); ?> id="elite_month"  data-name="ELITE" data-value="Monthly" class="sty_package" <?php print $elite_m; ?> />
													  $60 / month</label>
												  </p>
												  <p class="strong-font_L">
													<label>
													  <input type="radio" name="packages" value="62000" <?php echo set_radio('packages', '62000'); ?> id="elite_year"  data-name="ELITE" data-value="Yearly" class="sty_package" <?php print $elite_y; ?> />
													  $620 / year (15+% off!)</label>
												  </p>
												  <div class="package-option">
													<p class="PREMIUM-PLUS">Everything from PREMIUM + PLUS</p>
													<p>Elite Stylist Badge</p>
													<p>FREE 1-Year Subscription to hairstylistdesign.com ($97 value!)</p>
													
													<input type="hidden" name="pack_name" id="pack_name" value="" />
													<input type="hidden" name="subs_type" id="subs_type" value="" />
													
													<input type="hidden" name="stripe_cust_id" id="stripe_cust_id" value="<?php @print $subscription[0]['stripe_cust_id']; ?>" />
													<input type="hidden" name="stripe_plan_id" id="stripe_plan_id" value="<?php @print $subscription[0]['stripe_plan_id']; ?>" />
													<input type="hidden" name="recuring_sub_id" id="recuring_sub_id" value="<?php @print $subscription[0]['recuring_sub_id']; ?>" />
													<input type="hidden" name="subscriptionid" id="subscriptionid" value="<?php @print $subscription[0]['subscription_id']; ?>" />
													
													<input type="hidden" name="email" id="email" value="<?php @print $subscription[0]['email']; ?>" />
													<input type="hidden" name="email" id="email" value="<?php @print $subscription[0]['s_id']; ?>" />
												  </div>
												</div>
											  </div>
											</div>
										  </div>
										</div>
									  </div>
									<!-- Package Ends Here-->
								<div class="clearfix"></div>
								<div class="form-group">
									<label for="carddetail">
										<input type="checkbox" name="carddetails" value="1" id="carddetail" <?php echo set_checkbox('carddetails', '1'); ?>  />
										<span class="checkbox"></span>
											Use my same card and billing information
									</label>
								</div>
								
								<div class="conditional_elements">
									<div class="form-group">
										<label for="name_on_card">Name on Card <span class="mandetory"> *</span></label>
										<input type="text" name="name_on_card" data-stripe="name"  maxlength="30" value="<?php echo set_value('name_on_card'); ?>" class="form-control" id="name_on_cards" placeholder="Name on Card" onblur="this.placeholder = 'Name on Card'" onfocus="this.placeholder = ''" />
									</div>
							
									<div class="form-group">
										<label for="card_number">Card Number <span class="mandetory"> *</span></label>
										<input type="text" size="16" data-stripe="number" name="card_number" maxlength="16" value="<?php echo set_value('card_number'); ?>"  class="form-control"  placeholder="Card Number" onblur="this.placeholder = 'Card Number'" onfocus="this.placeholder = ''"  onkeypress="return validatealphanumeric(event)" />
									</div>
							
									<div class="form-group">
										<label for="expiration_month">Exp. Month<span class="mandetory"> *</span></label>
										<input type="text" size="2" data-stripe="exp-month" name="exp_month" value="<?php echo set_value('exp_month'); ?>" maxlength="2"class="form-control"  placeholder="Exp. Month" onblur="this.placeholder = 'Exp. Month'" onfocus="this.placeholder = ''"  onkeypress="return validatealphanumeric(event)" />
									</div>
							
									<div class="form-group">
										<label for="expiration_month">Exp. Year<span class="mandetory"> *</span></label>
										<input type="text" size="4" data-stripe="exp-year" name="exp_year" value="<?php echo set_value('exp_year'); ?>" maxlength="4" class="form-control" placeholder="Exp. Year" onblur="this.placeholder = 'Exp. Year'" onfocus="this.placeholder = ''"  onkeypress="return validatealphanumeric(event)" />
									</div>
							
									<div class="form-group">
										<label for="cvc">CVC Code <span class="mandetory"> *</span></label>
										<input type="password" size="4" data-stripe="cvc"  name="cvc" value="<?php echo set_value('cvc'); ?>" maxlength="4" class="form-control" placeholder="••••" onblur="this.placeholder = '••••'" onfocus="this.placeholder = ''"  onkeypress="return validatealphanumeric(event)" />
									</div>
								</div>
								
								<div class="form-group">
									<label for="confirm_planchange">
										<input type="checkbox" name="confirm_planchange" value="1" id="confirm_planchange" <?php echo set_checkbox('confirm_planchange', '1'); ?>  />
										<span class="checkbox"></span>
											I understand that by changing my subscription I will be billed immediately for the new subscription amount, and any credits or prorated amounts will be reflected on this and, as applicable, the next billing cycle
									</label>
								</div>
								
								<div class="form-group">
									<input type="submit" value="Change" class="btn-black-small square-btn-adjust sign_up" name="change">
								</div>
							
								</form>
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
				   /* if (response.error) {
						// Show the errors on the form
						$form.find('.payment-errors').text(response.error.message);
						$form.find('button').prop('disabled', false);
					} else {*/
						// token contains id, last4, and card type
						var token = response.id;
						// Insert the token into the form so it gets submitted to the server
						$form.append($('<input type="hidden" name="stripeToken" />').val(token));
						// and re-submit
						$form.get(0).submit();
				   // }
				};
				jQuery(function($) {
					$('#payment-form').submit(function(e) {
						var $form = $(this);
						// Disable the submit button to prevent repeated clicks
						$form.find('button').prop('disabled', true);
						Stripe.card.createToken($form, stripeResponseHandler);
						// Prevent the form from submitting with the default action
						return false;
					});
				});
</script>

<script>
	/*Hiding & showing conditional element of checkbox click*/

/*On Click*/

	$('#carddetail').on('click',function(){
	  if($('#carddetail').is(':checked'))
	  {
		$('.conditional_elements').hide();
	  }
	  else
	  {
		$('.conditional_elements').show();
	  }
	});
	
/*On Ready*/
	$(document).ready(function(){
	  if($('#carddetail').is(':checked'))
	  {
		$('.conditional_elements').hide();
	  }
	  else
	  {
		$('.conditional_elements').show();
	  }
	});
</script>
