<?php
$this->load->view('includes/loggedin_header');
//echo"<pre>";print_r($allbookingdata);exit;


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
			//editable: false,
			//eventOverlap:true,
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
							
							$url=site_url().'stylist/manageclient/'.$bookings['user_id'].'/#apoinments';
					?>
							{
								title: '<?php print $bookings['firstname'].' '.$bookings['lastname']; ?>',
								start:'<?php echo $event_start_date.'T'.$event_start_time; ?>',
								//end:'<?php echo $event_end_date.'T'.$event_end_time; ?>',
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
						if (isset($message))
						{
							echo $message;
						}

						if (isset($appt_message))
						{
							foreach ($appt_message as $message)
							{
								echo $message;
							}
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
                                <form method="post" action="<?php echo site_url() ?>stylist/edit_booking/<?php print $current_bookings[0]['id']; ?>">						
                                    <div class="service-offer">
                                        <h4>Services I offer</h4>
										<div class="row">
											<div class="col-md-4"></div><div class="col-md-4"><div class="message" style="margin:0px auto;"><?php  if($this->session->flashdata('Logmsg'))   echo  $this->session->flashdata('Logmsg'); ?></div></div><div class="col-md-4"></div>
											
										</div>
										<div class="row spc-bottom">
                                            <div class="col-md-4">
                                                <label for="clieint_list">Client List</label>
                                            </div>
                                            <div class="col-md-6">
												<!--<input type="text" name="autocomplete" id="autocomplete" class="autocomplete form-control" />-->
												<input type="hidden" name="bookingId" id="bookingId" value="<?php print $current_bookings[0]['id']; ?>" />
												<select name="clieint_list" id="clieint_list" class="selectpicker custom-select">
													<option value="">Select Client</option>
													<?php
														if(@$allclientlist)
														{
															$services=explode(',',$current_bookings[0]['service_offer']);
															$booking_time=explode(',',$current_bookings[0]['booking_time']);
															
															foreach($allclientlist as $clientlist)
															{
																if($clientlist['clientid']==$current_bookings[0]['c_id'])
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
                                            <div class="col-md-4">
                                                <input type="hidden" name="stylistid" id="stylistid" value="<?php if(!empty($rawdata)){ print @$rawdata[0]['id'];}else{@print $stylistdata[0]['id'];} ?>" class="" />
                                                <input type="hidden" name="clientid" id="clientid" value="<?php @print $clientdata[0]['id'] ?>" class="" />
                                                <label for="haircut">
													<input type="checkbox" name="service[]" value="Hair Cut" id="haircut" <?php echo set_checkbox('service[]', 'Hair Cut'); ?>  <?php foreach($services as $service) { if($service=="Hair Cut") { echo "checked"; } } ?>/>
													<span class="checkbox"></span>
													Hair Cut
                                                </label>
                                                
                                                
                                            </div>
                                            <div class="col-md-6">
                                                <select name="app_length[]" class="selectpicker app_length" id="time_haircut">
                                                    <option value="">Select</option>
                                                    <option value="45a" <?php if($booking_time[0]=="45a") { echo "selected"; } ?>>45 Minutes</option>
                                                    <option value="60a" <?php if($booking_time[0]=="60a") { echo "selected"; } ?> > 1 Hour</option>
                                                    <option value="90a" <?php if($booking_time[0]=="90a") { echo "selected"; } ?> > 1.5 Hour</option>
                                                    <option value="120a" <?php if($booking_time[0]=="120a") { echo "selected"; } ?> > 2 Hour</option>
                                                    <option value="150a" <?php if($booking_time[0]=="150a") { echo "selected"; } ?> > 2.5 Hour</option>
                                                    <option value="180a" <?php if($booking_time[0]=="180a") { echo "selected"; } ?> > 3 Hour</option>
                                                    <option value="240a" <?php if($booking_time[0]=="240a") { echo "selected"; } ?> > 4 Hour</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="row spc-bottom">
                                            <div class="col-md-4">
												<label for="hair_color">
													<input type="checkbox" name="service[]" value="Hair Color" id="hair_color" <?php echo set_checkbox('service[]', 'Hair Color'); ?> <?php foreach($services as $service) { if($service=="Hair Color") { echo "checked"; } } ?> />
													<span class="checkbox"></span>
													Hair Color
                                                </label>
                                            </div>
                                            <div class="col-md-6">
                                                <select name="app_length[]" class="selectpicker app_length" id="time_hair_color">
                                                    <option value="">Select</option>
                                                    <option value="45b" <?php if($booking_time[1]=="45b") { echo "selected"; } ?>>45 Minutes</option>
                                                    <option value="60b" <?php if($booking_time[1]=="60b") { echo "selected"; } ?>>1 Hour</option>
                                                    <option value="90b" <?php if($booking_time[1]=="90b") { echo "selected"; } ?>>1.5 Hour</option>
                                                    <option value="120b" <?php if($booking_time[1]=="120b") { echo "selected"; } ?>>2 Hour</option>
                                                    <option value="150b" <?php if($booking_time[1]=="150b") { echo "selected"; } ?>>2.5 Hour</option>
                                                    <option value="180b" <?php if($booking_time[1]=="180b") { echo "selected"; } ?>>3 Hour</option>
                                                    <option value="240b" <?php if($booking_time[1]=="240b") { echo "selected"; } ?>>4 Hour</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row spc-bottom">
                                            <div class="col-md-4">
												<label for="hair_cut_color">
													<input type="checkbox" name="service[]" value="Hair Cut & Color" id="hair_cut_color" <?php echo set_checkbox('service[]', 'Hair Cut & Color'); ?> <?php foreach($services as $service) { if($service=="Hair Cut & Color") { echo "checked"; } } ?> />
													<span class="checkbox"></span>
													Hair Cut & Color
                                                </label>
                                            </div>
                                            <div class="col-md-6">
                                                <select name="app_length[]" class="selectpicker app_length" id="time_hair_cut_color">
                                                    <option value="">Select</option>
                                                    <option value="45c" <?php if($booking_time[2]=="45c") { echo "selected"; } ?>>45 Minutes</option>
                                                    <option value="60c" <?php if($booking_time[2]=="60c") { echo "selected"; } ?>>1 Hour</option>
                                                    <option value="90c" <?php if($booking_time[2]=="90c") { echo "selected"; } ?>>1.5 Hour</option>
                                                    <option value="120c" <?php if($booking_time[2]=="120c") { echo "selected"; } ?>>2 Hour</option>
                                                    <option value="150c" <?php if($booking_time[2]=="150c") { echo "selected"; } ?>>2.5 Hour</option>
                                                    <option value="180c" <?php if($booking_time[2]=="180c") { echo "selected"; } ?>>3 Hour</option>
                                                    <option value="240c" <?php if($booking_time[2]=="240c") { echo "selected"; } ?>>4 Hour</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="row spc-bottom">
                                            <div class="col-md-4">
												<label for="blow_out">
                                                <input type="checkbox" name="service[]" value="Blow Out" id="blow_out"  <?php echo set_checkbox('service[]', 'Blow Out'); ?>  <?php foreach($services as $service) { if($service=="Blow Out") { echo "checked"; } } ?> />
                                                <span class="checkbox"></span>Blow Out
                                                </label>
                                            </div>
                                            <div class="col-md-6">
                                                <select name="app_length[]" class="selectpicker app_length" id="time_blow_out">
                                                    <option value="">Select</option>
                                                    <option value="45d" <?php if($booking_time[3]=="45d") { echo "selected"; } ?>> 45 Minutes</option>
                                                    <option value="60d" <?php if($booking_time[3]=="60d") { echo "selected"; } ?>> 1 Hour</option>
                                                    <option value="90d" <?php if($booking_time[3]=="90d") { echo "selected"; } ?>> 1.5 Hour</option>
                                                    <option value="120d" <?php if($booking_time[3]=="120d") { echo "selected"; } ?>> 2 Hour</option>
                                                    <option value="150d" <?php if($booking_time[3]=="150d") { echo "selected"; } ?>> 2.5 Hour</option>
                                                    <option value="180d" <?php if($booking_time[3]=="180d") { echo "selected"; } ?>> 3 Hour</option>
                                                    <option value="240d" <?php if($booking_time[3]=="240d") { echo "selected"; } ?>> 4 Hour</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="row spc-bottom">
                                            <div class="col-md-4">
												<label for="styling">
                                                <input type="checkbox" name="service[]" value="Up do(Styling)" id="styling" <?php echo set_checkbox('service[]', 'Up do(Styling)'); ?> <?php foreach($services as $service) { if($service=="Up do(Styling)") { echo "checked"; } } ?> />
                                                <span class="checkbox"></span>Up do(Styling)
                                                </label>
                                            </div>
                                            <div class="col-md-6">
                                                <select name="app_length[]" class="selectpicker app_length" id="time_styling">
                                                    <option value="">Select</option>
                                                    <option value="45e" <?php if($booking_time[4]=="45e") { echo "selected"; } ?>> 45 Minutes</option>
                                                    <option value="60e" <?php if($booking_time[4]=="60e") { echo "selected"; } ?>> 1 Hour</option>
                                                    <option value="90e" <?php if($booking_time[4]=="90e") { echo "selected"; } ?>> 1.5 Hour</option>
                                                    <option value="120e" <?php if($booking_time[4]=="120e") { echo "selected"; } ?>> 2 Hour</option>
                                                    <option value="150e" <?php if($booking_time[4]=="150e") { echo "selected"; } ?>> 2.5 Hour</option>
                                                    <option value="180e" <?php if($booking_time[4]=="180e") { echo "selected"; } ?>> 3 Hour</option>
                                                    <option value="240e" <?php if($booking_time[4]=="240e") { echo "selected"; } ?>> 4 Hour</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row spc-bottom">
                                            <div class="col-md-4">
												<label for="other">
													<input type="checkbox" name="service[]" value="Other" id="other" <?php echo set_checkbox('service[]', 'Other'); ?>  <?php foreach($services as $service) { if($service=="Other") { echo "checked"; } } ?> />
													<span class="checkbox"></span>Other
                                                </label>
                                            </div>
                                            <div class="col-md-6">
                                                <select name="app_length[]" class="selectpicker app_length" id="time_other">
                                                    <option value="">Select</option>
                                                    <option value="45f" <?php if($booking_time[5]=="45f") { echo "selected"; } ?>>45 Minutes</option>
                                                    <option value="60f" <?php if($booking_time[5]=="60f") { echo "selected"; } ?>>1 Hour</option>
                                                    <option value="90f" <?php if($booking_time[5]=="90f") { echo "selected"; } ?>>1.5 Hour</option>
                                                    <option value="120f" <?php if($booking_time[5]=="120f") { echo "selected"; } ?>>2 Hour</option>
                                                    <option value="150f" <?php if($booking_time[5]=="150f") { echo "selected"; } ?>>2.5 Hour</option>
                                                    <option value="180f" <?php if($booking_time[5]=="180f") { echo "selected"; } ?>>3 Hour</option>
                                                    <option value="240f" <?php if($booking_time[5]=="240f") { echo "selected"; } ?>>4 Hour</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
									<div id="eventsExample">
										<div class="row">
											
											<div class="col-md-3">
												<label for="booking_start_date">Booking Start Date</label>
											</div>
											<div class="col-md-3">
												<?php
													$booking_start_date=strtotime($current_bookings[0]['booking_start_date']);
													$book_start_date=date("m/j/Y",$booking_start_date);
												?>
												<input name="booking_start_date"  id="booking_start_date" type="text" class="date start form-control" value="<?php print $book_start_date;?>" autocomplete="off"/>
											</div>
											
											<div class="col-md-3">
												<label for="booking_start_time">Booking Start Time</label>
											</div>
											<div class="col-md-3">
												<input name="booking_start_time" id="booking_start_time" type="text" class="time start form-control" value="<?php print $current_bookings[0]['day_start_time']; ?>" autocomplete="off"/>
											</div>
										</div>
										
										<div class="row" style="display:none">
											
											<div class="col-md-3">
												<label for="booking_end_date">Booking End Date</label>
											</div>
											<div class="col-md-3">
												<?php
													$booking_end_date=strtotime($current_bookings[0]['booking_end_date']);
													$book_end_date=date("m/j/Y",$booking_end_date);
												?>
												<input name="booking_end_date" id="booking_end_date" type="text" class="date end form-control" value="<?php print $book_end_date;?>" />
											</div>
											
											<div class="col-md-3">
												<label for="booking_end_time">Booking End Time</label>
											</div>
											<div class="col-md-3">
												<input name="booking_end_time" id="booking_end_time" type="text" class="time end form-control" value="<?php print $current_bookings[0]['day_end_time']; ?>"/>
											</div>
											
										</div>
									</div>
									<hr>
                                   
			
					<div class="col-sm-3 col-xs-3  blk_book">
						
					</div>
					<div class="col-sm-3 col-xs-3 col-xs-3 blk_book">
						<input type="submit" name="book" value="Update" id="btn_book" class="btn-black-small square-btn-adjust">
					</div>
					<div class="col-sm-3 col-xs-3 col-xs-3 blk_book">
						<input type="submit" name="add_another" value="Schedule Another" id="add_another" class="btn-black-small square-btn-adjust">
					</div>
					<div class="col-sm-3 col-xs-3 ">
						<label for="clear-form">
							<input type="checkbox" name="clear-form" value="1" id="clear-form" <?php echo set_checkbox('clear-form', '1'); ?>  />
							<span class="checkbox"></span><strong>Clear Form</strong>
						</label>
					</div>
					
				</form>

                                <!-----------------Booking weekly details----------------->
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
       
</script>
<!---------------------------------For Event Calendar----------------------------------->

<script>
	/*clear form on checkbox checked*/
	$(document).ready(function(){
		clearform();
	})
	
	$('#clear-form').on('change', function(){
		clearform();
	})
	
	function clearform()
	{
		//var ischecked=$('');
		if($('#clear-form').is(':checked'))
		{
			$('#booking_start_date').val('');
			$('#booking_start_time').val('');
			$("input[name='service[]']:checkbox").prop('checked', false); // Unchecks it
			$('select[name^="app_length[]"] option:selected').attr("selected",null);
			//$('select[name="line_item_fields[field_birth_country][und]"]')
			//$('select[name=""]').
		}
	}
</script>

	<script>
      $(function() {
        $("#clieint_list").customselect();
      });
    </script>

<script>
$("#add_a_schedule").click(function(){
	
  var toappend=encodeURIComponent($("#email").val());
   $(this).attr('href', $(this).attr('href') + '/'+toappend);
})

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

$('#add_another').click(function(){
   
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
