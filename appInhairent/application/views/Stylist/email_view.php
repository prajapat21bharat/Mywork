<?php
	$this->load->view('includes/loggedin_header');
	//echo "<pre>";print_r($sent_emails);exit;
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
								<form method="post" action="<?php echo site_url() ?>stylist/sendmail" onsubmit="return formsubmit()" id="email-form">
								<!------------->
									<div class="row spc-bottom">
										<div class="col-md-6 col-sm-4">
											<h4 style="text-align:left;">Emails</h4>
										</div>
										<div class="col-md-3">
											<a href="<?php echo site_url() ?>stylist/sent_mails" class="btn-black-small pull-right" />View email archive</a>
										</div>
										<div class="col-md-3">
											<a href="<?php echo site_url() ?>stylist/communications" class="btn-black-small pull-right" />Communications</a>
										</div>
									</div>

				<div class="row spc-bottom">
                    <div class="col-md-12">
                      <h4> Who are you emailing ?</h4>
                      <div class="row">
                        <div class="col-md-4">
                          <h5>Client List</h5>
			<!-- <select name="clieint_list" id="clieint_list" class="selectpicker" onchange="select_cliented(this.value)">-->
							<select name="clieint_list" id="clieint_list" class="form-control selectpicker custom-select"  >
								<option value="">Select Client</option>
								<?php
									if($allclientlist)
									{
										foreach ($allclientlist as $clientlist)
										{
											if($clientlist['clientid']==$this->uri->segment(3))
											{
												$uri_selected="selected";
											}
											else
											{
												$uri_selected="";
											}
								?>
											<option value="<?php print $clientlist['clientid'] ?>" <?php echo set_select('clieint_list', $clientlist['clientid']); ?> <?php print $uri_selected; ?> ><?php print $clientlist['lastname'] . ' ' . $clientlist['firstname']; ?></option>
								<?php
										}
									}
								?>
							</select>
                        </div>
                        <div class="col-md-8">
                          <h5 class="grp-M">Group Matching</h5>
                          <div class="row spc-bottom">
                            <div class="col-md-4 col-sm-4 form-group">
                              <select class="form-control" name="ethnicity_s" id="ethnicity_s">
							<option value="">Select Ethnicity</option>
							<?php
							//echo"<pre>";print_r($allethnicity);exit;
								foreach ($allethnicity as $ethnicity)
								{
									if ($clientinfo[0]['ethnicity'] == $ethnicity['id'])
									{
										$select = "selected";
									}
									else
									{
										$select = "";
									}
									?>
										<option value="<?php print $ethnicity['id']; ?>" <?php print $select; ?> <?php echo set_select('ethnicity_s', $ethnicity['id']); ?> ><?php print $ethnicity['ethnicity']; ?></option>
										<?php
								}
							?>
						</select>
                            </div>
                            <div class="col-md-4 col-sm-4 form-group">
								 <select class="form-control" name="gender_s" id="gender_s">
									<option value="">Select Gender</option>
									<?php
									if ($clientinfo[0]['gender'] == "Male") {
										$gender = "selected";
									} elseif ($clientinfo[0]['gender'] == "Female") {
										$gender = "selected";
									} else {
										$gender = "";
									}
									?>
									<option value="Male" <?php print $gender; ?> <?php echo set_select('gender_s', 'Male'); ?> >Male</option>
									<option value="Female" <?php print $gender; ?> <?php echo set_select('gender_s', 'Female'); ?> >Female</option>
								</select>
                            </div>
                            <div class="col-md-4 col-sm-4 form-group">
                              <select class="form-control" name="age_range_s" id="age_range_s">
									<option value="">Select Age</option>
									<?php
									if ($clientinfo[0]['age'] == "0-5")
									{
										$age = "selected";
									} elseif ($clientinfo[0]['age'] == "6-15") {
										$age = "selected";
									} elseif ($clientinfo[0]['age'] == "16-25") {
										$age = "selected";
									} elseif ($clientinfo[0]['age'] == "26-35") {
										$age = "selected";
									} elseif ($clientinfo[0]['age'] == "36-45") {
										$age = "selected";
									} elseif ($clientinfo[0]['age'] == "46-55") {
										$age = "selected";
									} elseif ($clientinfo[0]['age'] == "56-65") {
										$age = "selected";
									} elseif ($clientinfo[0]['age'] == "66-75") {
										$age = "selected";
									} elseif ($clientinfo[0]['age'] == "76-85") {
										$age = "selected";
									} elseif ($clientinfo[0]['age'] == "86-95") {
										$age = "selected";
									} elseif ($clientinfo[0]['age'] == "96-100+") {
										$age = "selected";
									}
									?>
									<option value="0-5" <?php @print $age; ?> <?php echo set_select('age_range_s', '0-5'); ?> >0-5</option>
									<option value="6-15" <?php @print $age; ?> <?php echo set_select('age_range_s', '6-15'); ?> >6-15</option>
									<option value="16-25" <?php @print $age; ?> <?php echo set_select('age_range_s', '16-25'); ?> >16-25</option>
									<option value="26-35" <?php @print $age; ?> <?php echo set_select('age_range_s', '26-35'); ?> >26-35</option>
									<option value="36-45" <?php @print $age; ?> <?php echo set_select('age_range_s', '36-45'); ?> >36-45</option>
									<option value="46-55" <?php @print $age; ?> <?php echo set_select('age_range_s', '46-55'); ?> >46-55</option>
									<option value="56-65" <?php @print $age; ?> <?php echo set_select('age_range_s', '56-65'); ?> >56-65</option>
									<option value="66-75" <?php @print $age; ?> <?php echo set_select('age_range_s', '66-75'); ?> >66-75</option>
									<option value="76-85" <?php @print $age; ?> <?php echo set_select('age_range_s', '76-85'); ?> >76-85</option>
									<option value="86-95" <?php @print $age; ?> <?php echo set_select('age_range_s', '86-95'); ?> >86-95</option>
									<option value="96-100+" <?php @print $age; ?> <?php echo set_select('age_range_s', '96-100+'); ?> >96-100+</option>
								</select>
                            </div>
                          </div>
                          <div class="row spc-bottom">
                            <div class="col-md-4 col-sm-4 form-group">
								 <select name="hair_color_s" id="hair_color_s" class="form-control selectpicker">
									<option value="">Select Hair Color</option>
									<?php
									foreach ($allcolor as $color)
									{
										if($color['name'] == $clientinfo[0]['hair_color'])
										{
											$select_color = "selected";
										}
										else
										{
											$select_color = "";
										}
									?>
										<option value="<?php print $color['name']; ?>" <?php print $select_color; ?> <?php echo set_select('hair_color_s', $color['name']); ?> ><?php print $color['name']; ?></option>
									<?php
									}
									?>
							</select>
                            </div>
                            <div class="col-md-4 col-sm-4 form-group">
								  <select name="hair_texture_s" id="hair_texture_s" class="form-control selectpicker ">
									<option value="">Select Texture</option>
									<?php
									foreach ($alltexture as $texture)
									{
										if($texture['id'] == $clientinfo[0]['hair_texture'])
										{
											$select_texture = "selected";
										}
										else
										{
											$select_texture = "";
										}
									?>
										<option value="<?php print $texture['id'] ?>" <?php print $select_texture ?> <?php echo set_select('hair_texture_s', $texture['id']); ?> > <?php print $texture['texture'] ?></option>
								<?php		//echo"<pre>";print_r($density);
									}
									?>
								</select>
                            </div>
                            <div class="col-md-4 col-sm-4 form-group">
								<select name="hair_density_s" id="hair_density_s" class="form-control selectpicker ">
									<option value="">Select Density</option>
									<?php
									foreach ($alldensity as $density)
									{
										if ($density['density'] == $clientinfo[0]['hair_density'])
										{
											$select_density = "selected";
										}
										else
										{
											$select_density = "";
										}
									?>
										<option value="<?php print $density['density']; ?>" <?php print $select_density ?> <?php echo set_select('hair_density_s', $density['density']); ?> ><?php print $density['density'] ?></option>
									<?php
										//echo"<pre>";print_r($density);
									}
									?>
								</select>
                            </div>
                          </div>
                          <div class="row spc-bottom">
                            <input type="submit" name="filter_client" value="Load Recipients" id="btn_book" class="btn-black-small square-btn-adjust">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  
  <div class="col-md-12">
	<h4 class="spc-bottom"> What are you emailing ?</h4>
	<div class="row spc-bottom">
		<label class="col-md-4 col-sm-4 TEXT-L">Predefined template</label>
		<div class="col-md-5 col-sm-6">
			<select id="pre_email_template" name="pre_email_template" class="form-control ajax_pre_email_template">
				<option value="">Select Email Template</option>
				<?php
					foreach ($pre_email as $pre_emails)
					{
				?>	
						<option value="<?php @print $pre_emails['id']?>" <?php echo set_select('pre_email_template', $pre_emails['id']); ?> ><?php @print $pre_emails['template_name'] ?></option>
				<?php		//echo"<pre>";print_r($density);
					}
				?>
			</select>
		</div>
	</div>
	
	<div class="row spc-bottom">
		<label class="col-md-4 col-sm-4 TEXT-L">Previously sent email</label>
		<div class="col-md-5 col-sm-6">
			<select id="pre_sent_mails" name="pre_sent_mails" class="form-control ajax_pre_sent_mails">
				<option value="">Select Email Template</option>
				<?php
					foreach($sent_emails as $sent_mail)
					{
						if($sent_mail['email_temp_id']==0)
						{
							$sent_id=$sent_mail['id'];
						}
						else
						{
							$sent_id=$sent_mail['email_temp_id'];
						}
						//echo"<pre>";print_r($sent_mail);
				?>
					<option value="<?php print $sent_mail['id']; ?>"  <?php echo set_select('pre_sent_mails', $sent_mail['id']); ?>  myTag="<?php print $sent_mail['email_temp_id'];?>"><?php print $sent_mail['sent_subject']; ?></option>
				<?php		
					}
				?>
			</select>
		</div>
	</div>
	<div class="row">
		<div class="checkbox col-md-7">
			<?php
				if(!empty($mandetory))
				{
					$checked="checked";
				}
				else
				{
					$checked='';
				}
			?>
			<label for="blankmail">
				<input type="checkbox" name="blankmail" id="blankmail" <?php echo set_checkbox('blankmail', 'on'); ?>  <?php echo $checked; ?> />
				<span class="checkbox"></span>New Blank Email
			</label>
		</div>
		<div class="col-md-12" id="template_subject_container">
			<label for="hair_color">Template Subject</label>
			<input type="text" name="template_subject" id="template_subject" class="form-control" value="<?php echo set_value('template_subject'); ?>" />
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-12">
			<label for="inputEmail">Content <span class="mandetory"> *</span></label>
			<textarea name="email_content" id="email_content" class="email_content" placeholder="Content" ><?php echo set_value('email_content'); ?></textarea>
			<?php // echo form_ckeditor(array('id' => 'email_content')); ?>												
		</div>
	</div>
	
	<div class="row">
    <div class="col-md-6"></div>
		<div class="col-md-6">
			<label for="inputEmail">Recipient List</label>
				<select multiple="" id="recipient_email_ids" name="recipient_email_ids[]" class="form-control" ondblclick="remove_select_client(this.value)">
					<?php
						if(!empty($clientlist_email))
						{
							foreach($clientlist_email as $client)
							{
						?>
							<option <?php echo set_select('recipient_email_ids[]', $client['clientid']); ?> selected="" value="<?php print $client['clientid'];?>"><?php @print $client['lastname'].' '.$client['firstname'];?></option>
						<?php
							}
						}
						
						If(!empty($recipient_options))
						{
							if(isset($recipient_options))
							{
								foreach($recipient_options[0] as $options)
								{
									$option=explode(',',$options);
									print_r($option);echo"<br>";
							?>
								<option <?php echo set_select('recipient_email_ids[]', $option[0]); ?> value="<?php print $option[0];?>" selected=""><?php @print $option[1]; ?></option>
							<?php
								}
							}
						}
					?>
				</select>
				
				<?php
				
				/*To set receipnts when required fields missing error occurs */
						/*if(!empty($clientlist_email))
						{
							foreach($clientlist_email as $client)
							{
						?>
								<input type="hidden" name="recipient_options[]" value="<?php echo $client['clientid'].','.$client['lastname'].' '.$client['firstname']; ?> " <?php echo set_value('recipient_options[]', $client['clientid'].','.$client['lastname'].' '.$client['firstname']); ?> />
						<?php	
							}
						}*/
						?>
		</div>
	</div>
	<div class="clearfix"></div>
    <div class="space-email-btn"></div>
	<div class="row">
    <div class="col-md-6"></div>
		<div class="col-md-6">
			<input type="submit" name="send_mail" id="send_mail" value="Send Email" class="btn-black-small" />									
		</div>
	</div>
	
</div>
								</form>
								<!----Section for Main content end ---->
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

<!--
<script src="<?php // echo base_url();?>assets/js/chosen-select/chosen.jquery.js" type="text/javascript"></script>

  <script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config)
    {
      $(selector).chosen(config[selector]);
    }
  </script> 
  <link rel="stylesheet" href="<?php // echo base_url();?>assets/js/chosen-select/chosen.css">

  -->
  
  
  
<script>
	
$('#clieint_list').on('change',function(){
	var id=$('#clieint_list :selected').val();
	var value=$('#clieint_list :selected').text();
	console.log(id);
	if(id=='')
	{
	}
	else
	{
		if (!$('#recipient_email_ids option[value="' + id + '"]').length)
		{
		//	alert('No such option');
			//$('#recipient_email_ids').append($('<option></option>').val(id).text(value)); 
                        $('#recipient_email_ids').append($("<option selected='selected'></option>").attr("value",id) .text(value)); 


					/*Add option when error comes for manditory fields start*/

					$("#recipient_email_ids option:selected").each(function () {
					   var $this = $(this);
					   if ($this.length)
					   {
							var selText = $this.text();
							var selVal = $this.val();
							$('#recipient_email_ids').after('<input type="hidden" name="recipient_options[]" value="'+selVal+', '+selText+'">');
							console.log(selText);
					   }
					});
					/*Add option when error comes for manditory fields end*/                        
		}
		else
		{
			//alert('exists');
			console.log('exists');
		}
	}
})

	$(document).ready(function()
	{
		var recipientde = $("#clieint_list").val();
		var recipientdet = $( "#clieint_list option:selected" ).text();
		if(recipientde=='')
		{
		}
		else
		{	
			
			if (!$('#recipient_email_ids option[value="' + recipientde + '"]').length && recipientde!='')
			{
				$('#recipient_email_ids').append($("<option selected='selected'></option>").attr("value",recipientde) .text(recipientdet)); 
			}
		}
	});

function remove_select_client(value)
{
	$('#recipient_email_ids option:selected').appendTo('#clieint_list');
};  
</script>


<!----------- To get template data by template id ----------->
<script type="text/javascript">

$('.ajax_pre_email_template').on('change',function () {
	
	$('#pre_sent_mails').val('');
	$('#template_subject_container').hide();
	var id	=	$('#pre_email_template').val();
	if(id=='')
	{
		//alert('no');
	}
	else
	{
		var url = '<?php echo site_url('stylist/gettemplate_content');?>/'+id;
		
		var a=$.ajax({
                type: "POST",
                url: url,
                contentType: 'text/html',
                dataType: 'text',
                async: false,

                success: function(msg)
                {
                  //  $('#email_content').append(msg);
                 //   alert(msg);
                 tinyMCE.activeEditor.setContent(msg);
                },
                error: function (msg) 
                {
                }
                
           });
           
	}
});

$('.ajax_pre_sent_mails').on('change',function () {
	
	$('#pre_email_template').val('');
	$('#template_subject_container').hide();
	var id	=	$('#pre_sent_mails').val();
	if(id=='')
	{
		//alert('no');
	}
	else
	{
		var url = '<?php echo site_url('stylist/get_sent_template_content');?>/'+id;
		
		var a=$.ajax({
                type: "POST",
                url: url,
                contentType: 'text/html',
                dataType: 'text',
                async: false,

                success: function(msg)
                {
                  //  $('#email_content').append(msg);
                 //   alert(msg);
                 tinyMCE.activeEditor.setContent(msg);
                },
                error: function (msg) 
                {
                }
           });
	}
});


$('#blankmail').on('change', function(){
	if($(this).is(':checked'))
	{
		$('#pre_email_template').val('');
		$('#pre_sent_mails').val('');
		
		tinyMCE.activeEditor.setContent('');
		
		$('#template_subject_container').show();
		//alert('checked');  // checked
	}
	else
	{
		$('#template_subject_container').hide();
		//alert('not checked');  // unchecked
	}	
});

/*Set checkbox unchecked on select box change*/

	$('#pre_email_template, #pre_sent_mails').on('change',function(){
	  $('#blankmail').attr('checked', false);
	})

$(document).ready(function(){
	if($('#blankmail').is(':checked'))
	{
		$('#template_subject_container').show();
	}
})
</script>


<script>
      $(function() {
        $("#clieint_list").customselect();
      });
</script>


	<!--<script src="//tinymce.cachefly.net/4.2/tinymce.min.js"></script> -->
	 <script type="text/javascript" src="<?php echo base_url();?>assets/js/tinymce/tinymce.min.js"></script>
	 
<script type="text/javascript">
 
tinymce.init({
  selector: ".email_content",
  height : 250,
  relative_urls: false,
  convert_urls : false,

  // ===========================================
  // INCLUDE THE PLUGIN
  // ===========================================
	
  plugins: [
    "advlist autolink lists link charmap print preview anchor",
    "searchreplace visualblocks code fullscreen",
    "insertdatetime  table contextmenu paste jbimages"
  ],
	
  // ===========================================
  // PUT PLUGIN'S BUTTON on the toolbar
  // ===========================================
	
  toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | jbimages code",
	
  // ===========================================
  // SET RELATIVE_URLS to FALSE (This is required for images to display properly)
  // ===========================================
  	
});
 
</script>
