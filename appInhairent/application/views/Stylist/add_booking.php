<?php
$this->load->view('includes/loggedin_header');
 /*foreach ($allbookingdata as $bookings)
                      {
						$FirstDay = date("Y-m-d", strtotime('sunday last week'));
						$LastDay = date("Y-m-d", strtotime('sunday this week'));
						$Date = $bookings['booking_start_date'];
						$today=date("Y-m-d");
						echo"<pre>";
						print_r($FirstDay);
						print_r($today);
						exit;
					}*/
?>

<script>
	
	$(document).ready(function() {

		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			defaultDate: '<?php echo date("Y-m-d"); ?>',
			editable: false,
			defaultView: 'agendaWeek',
		    
			eventLimit: true, // allow "more" link when too many events
			events: [
				  <?php
                    
                      foreach ($allbookingdata as $bookings)
                      {
						$FirstDay = date("Y-m-d", strtotime('sunday last week'));
						$LastDay = date("Y-m-d", strtotime('sunday this week'));
						$Date = $bookings['booking_start_date'];
						$today=date("Y-m-d");
						
						if( ($Date > $today) || ($Date = $today)	)
						{
							$bookings['email'];
							$datetime_start= strtotime($bookings['booking_start_date']);
							$event_start_date=date("Y-m-d",$datetime_start);
							
							$datetime_end= strtotime($bookings['booking_end_date']);
							$event_end_date=date("Y-m-d",$datetime_end);
							
							$time_start= strtotime($bookings['day_start_time']);
							$event_start_time=date('H:i:s',$time_start);
							
							$time_end= strtotime($bookings['day_end_time']);
							$event_end_time=date('H:i:s',$time_end);
							
							$url=site_url().'stylist/manageclient/'.$bookings['user_id'].'/#appoinments';
					?>
							{
								title: '<?php print $bookings['firstname'].' '.$bookings['lastname']; ?>',
								start:'<?php echo $event_start_date.'T'.$event_start_time; ?>',
								end:'<?php echo $event_end_date.'T'.$event_end_time; ?>',
								url:'<?php echo $url; ?>',
								description:'<?php $bookings['day_start_time'];?>',
							},
				<?php
						}
					}
					
				?>
			],
		});
	});

</script>

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
							if (isset($message)) {
								echo $message;
							}

							if (isset($appt_message))
							{
								foreach ($appt_message as $message)
								{
									echo $message;
								}
							}
							if(isset($errors))
							{
								echo $errors;
							}
							?>
							

                    </div>
					<div class="panel-body">
                    <?php $this->load->view('Stylist/include/tabbedmenu'); ?>
                        <div id="myTabContent" class="tab-content">
                            <!----Section for Main content start ---->
                            <div class="row spc-bottom">
                                <div class="col-md-12">
                                    <h3 class="book_add">Booking</h3>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12 col-sm-12">
                                <form method="post" action="<?php echo site_url() ?>stylist/add_booking" id="form1">						
                                    <div class="service-offer">
                                        <h4>Services I offer</h4>
										
										<div class="message col-md-12" style="margin:0px auto;"><?php  if($this->session->flashdata('Logmsg'))   echo  $this->session->flashdata('Logmsg'); ?></div>
										<div class="row spc-bottom">
                                            <div class="col-md-4 col-sm-3">
                                                <label for="clieint_list">Client List</label>
                                            </div>
                                            <div class="col-md-6 col-sm-8">
												<!--<input type="text" name="autocomplete" id="autocomplete" class="autocomplete form-control" />-->
												<select name="clieint_list" id="clieint_list" class="form-control selectpicker custom-select">
													<option value="">Select Client</option>
													<?php
														if(@$allclientlist)
														{
															$uri_email=urldecode($this->uri->segment(3));

															foreach($allclientlist as $clientlist)
															{
																if($clientlist['email']==$uri_email)
																{
																	$selected="selected";
																}
																else
																{
																	$selected="";
																}
													?>
															<option value="<?php @print $clientlist['clientid'] ?>" <?php echo set_select('clieint_list', $clientlist['clientid']); print $selected;?> ><?php @print $clientlist['firstname'].' '.$clientlist['lastname'];?></option>
													<?php
															}
														}
													?>
												</select>
                                            </div>
                                        </div>
                                        

                                        <div class="row spc-bottom">
                                            <div class="col-md-4 col-sm-3">
                                                <input type="hidden" name="stylistid" id="stylistid" value="<?php if(!empty($rawdata)){ print @$rawdata[0]['id'];}else{@print $stylistdata[0]['id'];} ?>" class="" />
                                                <input type="hidden" name="clientid" id="clientid" value="<?php @print $clientdata[0]['id'] ?>" class="" />
                                                <label for="haircut">
													<input type="checkbox" name="service[]" value="Hair Cut" id="haircut" <?php echo set_checkbox('service[]', 'Hair Cut'); ?> />
													<span class="checkbox"></span>
													Hair Cut
                                                </label>
                                                
                                            </div>
                                            <div class="col-md-6 col-sm-8">
                                                <select name="app_length[]" class="form-control selectpicker app_length" id="time_haircut">
                                                    <option value="">Select</option>
                                                    <option value="45a" <?php echo set_select('app_length[]', '45a'); ?> >45 Minutes</option>
                                                    <option value="60a" <?php echo set_select('app_length[]', '60a'); ?> >1 Hour</option>
                                                    <option value="90a" <?php echo set_select('app_length[]', '90a'); ?> >1.5 Hour</option>
                                                    <option value="120a" <?php echo set_select('app_length[]', '120a'); ?> >2 Hour</option>
                                                    <option value="150a" <?php echo set_select('app_length[]', '150a'); ?> >2.5 Hour</option>
                                                    <option value="180a" <?php echo set_select('app_length[]', '180a'); ?> >3 Hour</option>
                                                    <option value="240a" <?php echo set_select('app_length[]', '240a'); ?> >4 Hour</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="row spc-bottom">
                                            <div class="col-md-4 col-sm-3">
												<label for="hair_color">
													<input type="checkbox" name="service[]" value="Hair Color" id="hair_color" <?php echo set_checkbox('service[]', 'Hair Color'); ?> />
													<span class="checkbox"></span>
													Hair Color
                                                </label>
                                            </div>
                                            <div class="col-md-6 col-sm-8">
                                                <select name="app_length[]" class="form-control selectpicker app_length" id="time_hair_color">
                                                    <option value="">Select</option>
                                                    <option value="45b" <?php echo set_select('app_length[]', '45b'); ?> >45 Minutes</option>
                                                    <option value="60b" <?php echo set_select('app_length[]', '60b'); ?> >1 Hour</option>
                                                    <option value="90b" <?php echo set_select('app_length[]', '90b'); ?> >1.5 Hour</option>
                                                    <option value="120b" <?php echo set_select('app_length[]', '120b'); ?> >2 Hour</option>
                                                    <option value="150b" <?php echo set_select('app_length[]', '150b'); ?> >2.5 Hour</option>
                                                    <option value="180b" <?php echo set_select('app_length[]', '180b'); ?> >3 Hour</option>
                                                    <option value="240b" <?php echo set_select('app_length[]', '240b'); ?> >4 Hour</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row spc-bottom">
                                            <div class="col-md-4 col-sm-3">
												<label for="hair_cut_color">
													<input type="checkbox" name="service[]" value="Hair Cut & Color" id="hair_cut_color" <?php echo set_checkbox('service[]', 'Hair Cut & Color'); ?> />
													<span class="checkbox"></span>
													Hair Cut & Color
                                                </label>
                                            </div>
                                            <div class="col-md-6 col-sm-8">
                                                <select name="app_length[]" class="form-control selectpicker app_length" id="time_hair_cut_color">
                                                    <option value="">Select</option>
                                                    <option value="45c" <?php echo set_select('app_length[]', '45c'); ?> >45 Minutes</option>
                                                    <option value="60c" <?php echo set_select('app_length[]', '60c'); ?> >1 Hour</option>
                                                    <option value="90c" <?php echo set_select('app_length[]', '90c'); ?> >1.5 Hour</option>
                                                    <option value="120c" <?php echo set_select('app_length[]', '120c'); ?> >2 Hour</option>
                                                    <option value="150c" <?php echo set_select('app_length[]', '150c'); ?> >2.5 Hour</option>
                                                    <option value="180c" <?php echo set_select('app_length[]', '180c'); ?> >3 Hour</option>
                                                    <option value="240c" <?php echo set_select('app_length[]', '240c'); ?> >4 Hour</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="row spc-bottom">
                                            <div class="col-md-4 col-sm-3">
												<label for="blow_out">
                                                <input type="checkbox" name="service[]" value="Blow Out" id="blow_out"  <?php echo set_checkbox('service[]', 'Blow Out'); ?>  />
                                                <span class="checkbox"></span>Blow Out
                                                </label>
                                            </div>
                                            <div class="col-md-6 col-sm-8">
                                                <select name="app_length[]" class="form-control selectpicker app_length" id="time_blow_out">
                                                    <option value="">Select</option>
                                                    <option value="45d" <?php echo set_select('app_length[]', '45d'); ?> >45 Minutes</option>
                                                    <option value="60d" <?php echo set_select('app_length[]', '60d'); ?> >1 Hour</option>
                                                    <option value="90d" <?php echo set_select('app_length[]', '90d'); ?> >1.5 Hour</option>
                                                    <option value="120d" <?php echo set_select('app_length[]', '120d'); ?> >2 Hour</option>
                                                    <option value="150d" <?php echo set_select('app_length[]', '150d'); ?> >2.5 Hour</option>
                                                    <option value="180d" <?php echo set_select('app_length[]', '180d'); ?> >3 Hour</option>
                                                    <option value="240d" <?php echo set_select('app_length[]', '240d'); ?> >4 Hour</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="row spc-bottom">
                                            <div class="col-md-4 col-sm-3">
												<label for="styling">
                                                <input type="checkbox" name="service[]" value="Up do(Styling)" id="styling" <?php echo set_checkbox('service[]', 'Up do(Styling)'); ?> />
                                                <span class="checkbox"></span>Up do(Styling)
                                                </label>
                                            </div>
                                            <div class="col-md-6 col-sm-8">
                                                <select name="app_length[]" class="form-control selectpicker app_length" id="time_styling">
                                                    <option value="">Select</option>
                                                    <option value="45e" <?php echo set_select('app_length[]', '45e'); ?> >45 Minutes</option>
                                                    <option value="60e" <?php echo set_select('app_length[]', '60e'); ?> >1 Hour</option>
                                                    <option value="90e" <?php echo set_select('app_length[]', '90e'); ?> >1.5 Hour</option>
                                                    <option value="120e" <?php echo set_select('app_length[]', '120e'); ?> >2 Hour</option>
                                                    <option value="150e" <?php echo set_select('app_length[]', '150e'); ?> >2.5 Hour</option>
                                                    <option value="180e" <?php echo set_select('app_length[]', '180e'); ?> >3 Hour</option>
                                                    <option value="240e" <?php echo set_select('app_length[]', '240e'); ?> >4 Hour</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row spc-bottom">
                                            <div class="col-md-4 col-sm-3">
												<label for="other">
													<input type="checkbox" name="service[]" value="Other" id="other" <?php echo set_checkbox('service[]', 'Other'); ?> <?php if(!empty($Other)){echo "checked";} ?>  />
													<span class="checkbox"></span>Other
                                                </label>
                                            </div>
                                            <div class="col-md-6 col-sm-8">
                                                <select name="app_length[]" class="form-control selectpicker app_length" id="time_other">
                                                    <option value="">Select</option>
                                                    <option value="45f" <?php echo set_select('app_length[]', '45f'); ?> >45 Minutes</option>
                                                    <option value="60f" <?php echo set_select('app_length[]', '60f'); ?> >1 Hour</option>
                                                    <option value="90f" <?php echo set_select('app_length[]', '90f'); ?> >1.5 Hour</option>
                                                    <option value="120f" <?php echo set_select('app_length[]', '120f'); ?> >2 Hour</option>
                                                    <option value="150f" <?php echo set_select('app_length[]', '150f'); ?> >2.5 Hour</option>
                                                    <option value="180f" <?php echo set_select('app_length[]', '180f'); ?> >3 Hour</option>
                                                    <option value="240f" <?php echo set_select('app_length[]', '240f'); ?> >4 Hour</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
									<div id="eventsExample">
										<div class="row">
											
											<div class="col-lg-3 col-sm-3">
												<label for="booking_start_date">Booking Start Date</label>
											</div>
											<div class="col-lg-3 col-sm-3">
												<input name="booking_start_date"  id="booking_start_date" type="text" class="date start form-control" value="<?php echo set_value('booking_start_date'); ?>" />
											</div>
											<div class="col-lg-3 col-sm-3">
												<label for="booking_start_time">Booking Start Time</label>
											</div>
											<div class="col-lg-3 col-sm-3">
												<input name="booking_start_time" id="booking_start_time" type="text" class="time start form-control" value="<?php echo set_value('booking_start_time'); ?>" />
											</div>
											
										</div>
										
										<div class="row" style="display:none">
											<div class="col-lg-3 col-sm-3">
												<label for="booking_end_date">Booking End Date</label>
											</div>
											<div class="col-lg-3 col-sm-3">
												<input name="booking_end_date" id="booking_end_date" type="text" class="date end form-control" />
											</div>
											
											<div class="col-lg-3 col-sm-3">
												<label for="booking_end_time">Booking End Date</label>
											</div>
											<div class="col-lg-3 col-sm-3">
												<input name="booking_end_time" id="booking_end_time" type="text" class="time end form-control" />
											</div>
										</div>
									</div>
									<hr>
                                   
			
					<div class="col-sm-12 col-xs-12 col-xs-12 blk_book">
						<input type="submit" name="book" value="Schedule It" id="btn_book" class="btn-black-small square-btn-adjust">
					</div>
				

                                </form>

							</div>
                                
                                <div class="service-offer scedule-table">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h4>My schedule</h4>
                                        </div>
									</div>
								</div>
                                        
                            <div id='calendar'></div>
                           


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
	$("#clieint_list").on('change',function(){
	  $("#clientid").val($("#clieint_list").val());
	})	
</script>



<script>



// HTML not shown for brevity

// initialize input widgets first
$('#eventsExample .time').timepicker({
	'scrollDefault': 'now',
    //'showDuration': true,
    'timeFormat': 'g:ia',
    'minTime': '10:00am',
    'maxTime': '10:00pm',
});


$('#eventsExample .date').datepicker({
    'format': 'm/d/yyyy',
    'autoclose': true,
    'startDate': new Date()
});

/*
var eventsExampleEl = document.getElementById('eventsExample');
var eventsExampleDatepair = new Datepair(eventsExampleEl);

// some sample handlers
$('#eventsExample').on('rangeSelected', function(){
    $('#eventsExampleStatus').text('Valid range selected');
}).on('rangeIncomplete', function(){
    $('#eventsExampleStatus').text('Incomplete range');
}).on('rangeError', function(){
    $('#eventsExampleStatus').text('Invalid range');
});
    */   
</script>
<!---------------------------------For Event Calendar----------------------------------->


	<script>
      $(function() {
        $("#clieint_list").customselect();
      });
    </script>


<script>
/*for checkbox checked on applength select*/


$('#btn_book').click(function(){
   
    if($('#haircut').is(':checked'))
    {
         
        if($('#time_haircut').val().length < 1)
        {
            
            alert('Please select Time for Service Hair Cut');
            return false;
        } 
    } 
    
     if($('#hair_color').is(':checked'))
    {
         
        if($('#time_hair_color').val().length < 1)
        {
            
            alert('Please select Time for Service Hair Color');
            return false;
        } 
    }
    if($('#hair_cut_color').is(':checked'))
    {
         
        if($('#time_hair_cut_color').val().length < 1)
        {
            
            alert('Please select Time for Service Hair Cut Color');
            return false;
        } 
    }
    
    if($('#blow_out').is(':checked'))
    {
         
        if($('#time_blow_out').val().length < 1)
        {
            
            alert('Please select Time for Service Blow Out');
            return false;
        } 
    }
    
    if($('#styling').is(':checked'))
    {
         
        if($('#time_styling').val().length < 1)
        {
            
            alert('Please select Time for Service Up do(Styling) ');
            return false;
        } 
    }
    if($('#other').is(':checked'))
    {
         
        if($('#time_other').val().length < 1)
        {
            
            alert('Please select Time for Service other ');
            return false;
        } 
    }
     return true;
    
});
</script>
