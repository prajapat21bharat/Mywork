<?php
	$this->load->view('includes/admin_header');
	//echo"<pre>";print_r($this->session->userdata());
?>
        
<div class="contentpanel" >
	<div class="container clear_both padding_fix">
		<div class="row">
			<div class="col-sm-12 col-xs-12 left-space-r">
				<div class="breadcrums">
					<span>Stylists > </span><a href="<?php echo site_url('admin/addstylist') ?>">Add Stylist</a>
				</div>
				<div class="ad-haeding">
					
                     <h2>Add Stylist</h2>
                     <?php
						if (isset($message))
						{
							echo $message;
						}
                     ?>
                     
                    </div>
                    
             </div>
           </div>
                 <!-- /. ROW  -->
                
                 <div class="row">
					<div class="col-md-12">
						 
						<form action="<?php echo site_url()?>admin/addstylist" method="post">
							<div class="col-md-6">
								<div class="form-group">
									<label for="inputEmail">First Name <span class="mandetory"> *</span></label>
									<input type="text" placeholder="First Name" id="firstname" class="form-control" value="<?php echo set_value('firstname'); ?>" name="firstname" onblur="this.placeholder = 'First Name'" onfocus="this.placeholder = ''">
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group">
									<label for="inputEmail">Last Name <span class="mandetory"> *</span></label>
									<input type="text" placeholder="Last Name" id="lastname" class="form-control" value="<?php echo set_value('lastname'); ?>" name="lastname" onblur="this.placeholder = 'Last Name'" onfocus="this.placeholder = ''">
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group">
									<label for="inputEmail">Email Address <span class="mandetory"> *</span></label>
									<input type="text" placeholder="Email Address" id="email" class="form-control" value="<?php echo set_value('email'); ?>" name="email" onblur="this.placeholder = 'Email Address'" onfocus="this.placeholder = ''">
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group">
									<label for="inputEmail">Phone Number <span class="mandetory"> *</span></label>
									<input type="text" placeholder="Phone Number " id="contactno" class="form-control" value="<?php echo set_value('contactno'); ?>" name="contactno" onblur="this.placeholder = 'Phone Number '" onfocus="this.placeholder = ''" onkeyup="GetPhoneFormat('contactno')"   maxlength="14" onkeypress="return validatealphanumeric(event)" >
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group">
									<label for="inputEmail">Password <span class="mandetory"> *</span></label>
									<input type="password" placeholder="Password " id="password" class="form-control" value="" name="password" onblur="this.placeholder = 'Password '" onfocus="this.placeholder = ''">
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group">
									<label for="inputEmail">Confirm Password <span class="mandetory"> *</span></label>
									<input type="password" placeholder="Confirm Password " id="confirmpassword" class="form-control" value="" name="confirmpassword" onblur="this.placeholder = 'Confirm Password '" onfocus="this.placeholder = ''">
								</div>
							</div>
							<?php /* ?>
							<div class="col-md-2">
								<div class="form-group">
									<label>
										Stylist Type <span class="mandetory"> *</span>
									</label>
								</div>
							</div>
	
							<div class="col-md-4">
								<div class="form-group">
									<label>
										<input type="radio" name="usertype" value="INDEPENDENT STYLIST" <?php echo set_radio('usertype', 'INDEPENDENT STYLIST'); ?> id="independent_stylist">
										INDEPENDENT STYLIST
									</label>
									&nbsp; &nbsp; &nbsp; &nbsp;
									<label>
										<input type="radio" name="usertype" value="SALON" <?php echo set_radio('usertype', 'SALON'); ?> id="salon">
										SALON OWNER
									</label>
									
								</div>
							</div>
						<?php */ ?>
							<div class="col-md-6">
								<div class="form-group">
									<label for="salon_name">Name of Salon <span class="mandetory"> *</span></label>
									<input type="text" name="salon_name" value="<?php echo set_value('salon_name'); ?>" class="form-control" id="salon_name" placeholder="Name of Salon" onblur="this.placeholder = 'Name of Salon'" onfocus="this.placeholder = ''">
								</div>
							</div>
							
						
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
											echo"<option value='$i'" . set_select('no_of_stylist', $i) . ">$i</option>";
										}
										?>
									</select>
								</div>
							</div>
				<?php */ ?>	
				
<!------------------------------------------------Package-------------------------------------------------------->							
							
							<!--<div class="col-md-12">
								<div class="form-group">
									<h3 class="bill_info">Packages</h3>
								</div>
							</div>-->
							<div class="clearfix"></div>
							<div class="col-md-4">
                            <div class="tiny">
                            <div class="pricing-table-header-tiny">
                                <h2 align="center">DELUXE</h2>
                                 </div>
                                 <div class="pricing-table-features">
								<div class="form-group">
									<!--<h5 align="left">DELUXE</h5>-->
									<p class="strong-font_L">
										<label>
											<input type="radio" name="packages" value="2500" <?php echo set_radio('packages', '2500'); ?> id="deluxe_month" class="sty_package" data-name="DELUXE" data-value="Monthly">
											$25 / month
										</label>
									</p>
									<p class="strong-font_L">
										<label>
											<input type="radio" name="packages" value="27000" <?php echo set_radio('packages', '27000'); ?> id="deluxe_year" class="sty_package" data-name="DELUXE" data-value="Yearly">
											$270 / year (10% off!)
										</label>
									</p>
								</div>
                                </div>
                                </div>
							</div>
							
							<div class="col-md-4">
                             <div class="small">
                             <div class="pricing-table-header-small">
                                <h2 align="center">PREMIUM</h2>
                                 </div>
                                 <div class="pricing-table-features">
								<div class="form-group">
									
									<p class="strong-font_L">
										<label>
											<input type="radio" name="packages" value="4000" <?php echo set_radio('packages', '4000'); ?> id="premium_month" class="sty_package" data-name="PREMIUM" data-value="Monthly">
											$40 / month
										</label>
									</p>
									<p class="strong-font_L">
										<label>
											<input type="radio" name="packages" value="41000" <?php echo set_radio('packages', '41000'); ?> id="premium_year"  class="sty_package" data-name="PREMIUM" data-value="Yearly">
											$410 / year (15% off!)
										</label>
									</p>
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
									
									<p class="strong-font_L">
										<label>
											<input type="radio" name="packages" value="6000" <?php echo set_radio('packages', '6000'); ?> id="elite_month" class="sty_package" data-name="ELITE" data-value="Monthly">
											$60 / month
										</label>
										</p>
									<p class="strong-font_L">
										<label>
											<input type="radio" name="packages" value="62000" <?php echo set_radio('packages', '62000'); ?> id="elite_year" class="sty_package" data-name="ELITE" data-value="Yearly">
											$620 / year (15+% off!)
										</label>
									</p>
									<input type="hidden" name="pack_name" id="pack_name" value="" />
									<input type="hidden" name="subs_type" id="subs_type" value="" />
								</div>
                                </div>
                                </div>
							</div>
							
						<!------------------------------------------------Billing Address---------------------------------------------->
            				
							<div class="col-md-2">
							  <div class="form-group">
								<label for="address_a">Address <span class="mandetory"> *</span></label>
							  </div>
							</div>
							<div class="col-md-4">
							  <div class="form-group">
								<input type="text" name="address_a" value="<?php echo set_value('address_a'); ?>" class="form-control" id="address_a" placeholder="Address" onblur="this.placeholder = 'Address'" onfocus="this.placeholder = ''">
							  </div>
							</div>
							<div class="col-md-2">
							  <div class="form-group">
								<label for="address_b">Address 2</label>
							  </div>
							</div>
							<div class="col-md-4">
							  <div class="form-group">
								<input type="text" name="address_b" value="<?php echo set_value('address_b'); ?>" class="form-control" id="address_b" placeholder="Address 2" onblur="this.placeholder = 'Address 2'" onfocus="this.placeholder = ''">
							  </div>
							</div>
							<div class="col-md-2">
							  <div class="form-group">
								<label for="city">City <span class="mandetory"> *</span></label>
							  </div>
							</div>
							<div class="col-md-4">
							  <div class="form-group">
								<input type="text" name="city" value="<?php echo set_value('city'); ?>" class="form-control" id="city" placeholder="City" onblur="this.placeholder = 'City'" onfocus="this.placeholder = ''">
							  </div>
							</div>
							<div class="col-md-2">
							  <div class="form-group">
								<label for="state">State <span class="mandetory"> *</span></label>
							  </div>
							</div>
							<div class="col-md-4">
							  <div class="form-group">
								<select class="form-control" name="state">
								  <option value="">State</option>
								  <?php
									foreach ($states as $state)
									{
										echo "<option value='$state[id]' " . set_select('state', $state[id]) . ">$state[state_name]</option>";
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
								<input type="text" name="zipcode" value="<?php echo set_value('zipcode'); ?>" class="form-control" id="zipcode" placeholder="Zip Code" onblur="this.placeholder = 'Zip Code'" onfocus="this.placeholder = ''" maxlength='6' onkeypress="return validatealphanumeric(event)" >
							  </div>
							</div>
						
					
							<div class="col-md-2">
								<div class="form-group">
									<label for="inputEmail">Status <span class="mandetory"> *</span></label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									
									<label class="radio-inline">
										<input type="radio" value="1" name="status" <?php echo set_radio('status', '1'); ?>>
										Active
									</label>
									&nbsp; &nbsp; &nbsp; &nbsp;
									<label class="radio-inline">
										<input type="radio" value="0" name="status" <?php echo set_radio('status', '0', TRUE); ?>>
										InActive
									</label>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<input type="submit" value="Add" class="btn-black-small square-btn-adjust" name="add">
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


<script type="text/javascript">
    $('#independent_stylist').click(function(){
		if ($('#independent_stylist').is(':checked'))
		{
            $('#no_of_stylist option:eq(1)').attr('selected','selected');
			var rbAccount = document.getElementById('no_of_stylist');
			rbAccount.disabled = true;
		}
	});

	$('#salon').click(function(){
		var rbAccount = document.getElementById('no_of_stylist');
		rbAccount.disabled = false;
   });

	$(document).ready(function(){
		if($('input[name=usertype]:checked'))
		{
			if($('input[name=usertype]:checked').val()=="INDEPENDENT STYLIST")
			{
				$('#no_of_stylist option:eq(1)').attr('selected','selected');
				var rbAccount = document.getElementById('no_of_stylist');
				rbAccount.disabled = true;
			}
		}
	})
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
