<?php
$this->load->view('includes/header');
?>

<div class="contentpanel" >
  <div class="container clear_both padding_fix">
    <div class="row">
      <div class="col-sm-12 col-xs-12 left-space-r">
        <div class="block-web">
          <h3 class="sign_upp">Sign Up</h3>
          <?php
                    if (isset($message))
                    {
                        echo $message;
                    }
                    ?>
          <form method="post" action="<?php echo site_url('account/register'); ?>" class="left_form" id="payment-form">
            <div class="col-md-2">
              <div class="form-group">
                <label for="inputEmail">First Name <span class="mandetory"> *</span></label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <input type="text" name="firstname" value="<?php echo set_value('firstname'); ?>" class="form-control" id="firstname" placeholder="First Name" onblur="this.placeholder = 'First Name'" onfocus="this.placeholder = ''">
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label for="inputEmail">Last Name <span class="mandetory"> *</span></label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <input type="text" name="lastname" value="<?php echo set_value('lastname'); ?>" class="form-control" id="lastname" placeholder="Last Name" onblur="this.placeholder = 'Last Name'" onfocus="this.placeholder = ''">
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label for="inputEmail">Email <span class="mandetory"> *</span></label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <input type="text" name="email" value="<?php echo set_value('email'); ?>" class="form-control" id="email" placeholder="Email" onblur="this.placeholder = 'Email'" onfocus="this.placeholder = ''">
                <input type="hidden" disabled="" name="status" value="1" class="form-control" id="status" />
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label for="inputEmail">Confirm Email <span class="mandetory"> *</span></label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <input type="text" name="confirmemail" value="<?php echo set_value('confirmemail'); ?>" class="form-control" id="confirmemail" placeholder="Confirm Email" onblur="this.placeholder = 'Confirm Email'" onfocus="this.placeholder = ''">
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label for="password">Password <span class="mandetory"> *</span></label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <input type="password" name="password" value="" class="form-control" id="password" placeholder="Password" onblur="this.placeholder = 'Password'" onfocus="this.placeholder = ''">
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label for="confirmpassword">Confirm Password <span class="mandetory"> *</span></label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <input type="password" name="confirmpassword" value="" class="form-control" id="confirmpassword" placeholder="Confirm Password" onblur="this.placeholder = 'Confirm Password'" onfocus="this.placeholder = ''">
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-2">
              <div class="form-group">
                <label for="inputEmail">Phone Number <span class="mandetory"> *</span></label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <input type="text" name="phoneno" maxlength="14" value="<?php echo set_value('phoneno'); ?>" class="form-control" id="phoneno" placeholder="Phone Number" onblur="this.placeholder = 'Phone Number'" onfocus="this.placeholder = ''" onkeyup="GetPhoneFormat('phoneno')"  onkeypress="return validatealphanumeric(event)" />
              </div>
            </div>
            
            <div class="col-md-2">
                <div class="form-group">
                  <label for="salon_name">Name of Salon <span class="mandetory"> *</span></label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <input type="text" name="salon_name" value="<?php echo set_value('salon_name'); ?>" class="form-control" id="salon_name" placeholder="Name of Salon" onblur="this.placeholder = 'Name of Salon'" onfocus="this.placeholder = ''">
                </div>
              </div>
            
            <!------------------------------------------------Subscription Information-------------------------------------------------------->
          <?php /*?>
            <div class="col-md-12">
              <div class="form-group">
                <h3 class="sub_info">Subscription Information <span class="mandetory"> *</span> </h3>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>
                  <input type="radio" name="usertype" value="INDEPENDENT STYLIST" <?php echo set_radio('usertype', 'INDEPENDENT STYLIST'); ?> id="independent_stylist">
                  I am registering as a INDEPENDENT STYLIST</label>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>
                  <input type="radio" name="usertype" value="SALON" <?php echo set_radio('usertype', 'SALON'); ?> id="salon">
                  I am registering as an SALON</label>
              </div>
            </div>
            
            <?php */?>
            <!------------------------------------------------Conditional Field-------------------------------------------------------->
            <div class="conditionali-field" id="if-salon" >
              
              
         <?php /*?>     
              <div class="col-md-2">
                <div class="form-group">
                  <label for="no_of_stylist">Number of Stylist</label>
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
							echo"<option value='$i'" . set_select('no_of_stylist', $i) . ">$i</option>";
						}
					?>
                  </select>
                </div>
              </div>
              <?php */?>
              
              <div class="row-fluid">
                <div class="col-md-12">
                  <h3 class="Packages">Packages</h3>
                </div>
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
                              <input type="radio" name="packages" value="2500" <?php echo set_radio('packages', '2500'); ?> id="deluxe_month"  data-name="DELUXE" data-value="Monthly" class="sty_package" />
                               $25 / month</label>
                          </p>
                          <p class="strong-font_L">
                            <label>
                              <input type="radio" name="packages" value="27000" <?php echo set_radio('packages', '27000'); ?> id="deluxe_year"  data-name="DELUXE" data-value="Yearly" class="sty_package" />
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
                    <!--<div class="pricing-table-signup-tiny">
                  <p><a href="#">Sign Up</a></p>
                </div>--> 
                  </div>
                </div>
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
                              <input type="radio" name="packages" value="4000" <?php echo set_radio('packages', '4000'); ?> id="premium_month"  data-name="PREMIUM" data-value="Monthly"  class="sty_package" />
                              $40 / month</label>
                          </p>
                          <p class="strong-font_L">
                            <label>
                              <input type="radio" name="packages" value="41000" <?php echo set_radio('packages', '41000'); ?> id="premium_year"  data-name="PREMIUM" data-value="Yearly"  class="sty_package" />
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
                              <input type="radio" name="packages" value="6000" <?php echo set_radio('packages', '6000'); ?> id="elite_month"  data-name="ELITE" data-value="Monthly" class="sty_package" />
                              $60 / month</label>
                          </p>
                          <p class="strong-font_L">
                            <label>
                              <input type="radio" name="packages" value="62000" <?php echo set_radio('packages', '62000'); ?> id="elite_year"  data-name="ELITE" data-value="Yearly" class="sty_package" />
                              $620 / year (15+% off!)</label>
                          </p>
                          <div class="package-option">
                            <p class="PREMIUM-PLUS">Everything from PREMIUM + PLUS</p>
                            <p>Elite Stylist Badge</p>
                            <p>FREE 1-Year Subscription to hairstylistdesign.com ($97 value!)</p>
                            
                            <input type="hidden" name="pack_name" id="pack_name" value="" />
							<input type="hidden" name="subs_type" id="subs_type" value="" />
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <!------------------------------------------------Conditional field--------------------------------------------------------> 
            
            <!------------------------------------------------Payment Information--------------------------------------------------------> 
           
            <div class="col-md-12">
                 <span class="payment-errors" style="color: #000;"></span>
              <div class="form-group">
                <h3 class="pay_info">Payment Information</h3>
              </div>
            </div>
            
            <div class="col-md-2">
                
              <div class="form-group">
                <label for="name_on_card">Name on Card <span class="mandetory"> *</span></label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <input type="text" name="name_on_card" data-stripe="name"  maxlength="30" value="<?php echo set_value('name_on_card'); ?>" class="form-control" id="name_on_cards" placeholder="Name on Card" onblur="this.placeholder = 'Name on Card'" onfocus="this.placeholder = ''" />
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label for="card_number">Card Number <span class="mandetory"> *</span></label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <input type="text" size="16" data-stripe="number" name="card_number" maxlength="16" value="<?php echo set_value('card_number'); ?>"  class="form-control"  placeholder="Card Number" onblur="this.placeholder = 'Card Number'" onfocus="this.placeholder = ''"  onkeypress="return validatealphanumeric(event)" />
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label for="expiration_month">Exp. Month / Year<span class="mandetory"> *</span></label>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <input type="text" size="2" data-stripe="exp-month" name="exp_month" value="<?php echo set_value('exp_month'); ?>" maxlength="2"class="form-control"  placeholder="Exp. Month" onblur="this.placeholder = 'Exp. Month'" onfocus="this.placeholder = ''"  onkeypress="return validatealphanumeric(event)" />
              </div>
            </div>
            
            <div class="col-md-2">
              <div class="form-group">
                <input type="text" size="4" data-stripe="exp-year" name="exp_year" value="<?php echo set_value('exp_year'); ?>" maxlength="4" class="form-control" placeholder="Exp. Year" onblur="this.placeholder = 'Exp. Year'" onfocus="this.placeholder = ''"  onkeypress="return validatealphanumeric(event)" />
              </div>
            </div>
            
            <div class="col-md-2">
              <div class="form-group">
                <label for="cvc">CVC Code <!--<span class="mandetory"> *</span>--></label>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <input type="password" size="4" data-stripe="cvc"  name="cvc" value="<?php echo set_value('cvc'); ?>" maxlength="4" class="form-control" placeholder="••••" onblur="this.placeholder = '••••'" onfocus="this.placeholder = ''"  onkeypress="return validatealphanumeric(event)" />
              </div>
            </div>
            <div class="col-md-3"></div>
            <!------------------------------------------------Billing Address-------------------------------------------------------->
            
            <div class="col-md-12">
              <div class="form-group">
                <h3 class="bill_info">Billing Address</h3>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label for="address_a">Address <span class="mandetory"> *</span></label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <input type="text" name="address_a" data-stripe="address_line1" value="<?php echo set_value('address_a'); ?>" class="form-control" id="address_a" placeholder="Address" onblur="this.placeholder = 'Address'" onfocus="this.placeholder = ''">
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label for="address_b">Address 2</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <input type="text" name="address_b" data-stripe="address_line2" value="<?php echo set_value('address_b'); ?>" class="form-control" id="address_b" placeholder="Address 2" onblur="this.placeholder = 'Address 2'" onfocus="this.placeholder = ''">
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label for="city">City <span class="mandetory"> *</span></label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <input type="text" name="city" data-stripe="address_city" value="<?php echo set_value('city'); ?>" class="form-control" id="city" placeholder="City" onblur="this.placeholder = 'City'" onfocus="this.placeholder = ''">
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label for="state">State <span class="mandetory"> *</span></label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <select class="form-control" name="state" data-stripe="address_state">
                  <option value="">State</option>
					<?php
						foreach ($states as $state)
						{
					?>
						<option value="<?php print $state['id']; ?>" <?php echo set_select('state', $state['id']); ?> ><?php print $state['state_name']; ?> </option>";
					<?php
						}
					?>
                </select>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label for="zipcode">Zip Code <span class="mandetory"> *</span></label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <input type="text" name="zipcode" data-stripe="address_zip" maxlength="6" value="<?php echo set_value('zipcode'); ?>" class="form-control" id="zipcode" placeholder="Zip Code" onblur="this.placeholder = 'Zip Code'" onfocus="this.placeholder = ''"   onkeypress="return validatealphanumeric(event)" >
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>
                  <input type="checkbox" name="term_of_use" id="term_of_use" value="1" <?php echo set_checkbox('term_of_use', '1'); ?>>
                  <span class="checkbox"></span> I have read and agreed to </label>
                <a href="<?php echo base_url(); ?>assets/files/Inhairent_terms_of_use.pdf" target="_blank" > Terms of Service <span class="mandetory"> *</span></a> </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <input type="submit" name="signup" class="btn-black-small square-btn-adjust sign_up" value="Sign Up">
              </div>
            </div>
            <!-- The  script for Stripe lib --> 
       
          </form>
        </div>
      </div>
      <!-- /. ROW  --> 
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




<script type="text/javascript">
	$('#independent_stylist').click(function()
	{
		if ($('#independent_stylist').is(':checked'))
		{
			$('#no_of_stylist option:eq(1)').attr('selected','selected');
			var rbAccount = document.getElementById('no_of_stylist');
			rbAccount.disabled = true;
		}
	});

      
	$('#salon').click(function()
	{
		var rbAccount = document.getElementById('no_of_stylist');
		rbAccount.disabled = false;
	});

</script>

