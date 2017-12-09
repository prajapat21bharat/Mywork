<?php
	$this->load->view('includes/header_session');
?>
</style>
<script type="text/javascript" src="jquery-1.8.2.js"></script>

<!-- Work Details -->
<script type='text/javascript'>
$(function(){
var overlay = $('<div id="overlay"></div>');
$('.close').click(function(){
$('.popup_work').hide();
overlay.appendTo(document.body).remove();
return false;
});

$('.x').click(function(){
$('.popup_work').hide();
overlay.appendTo(document.body).remove();
return false;
});

$('.click_work').click(function(){
overlay.show();
overlay.appendTo(document.body);
$('.popup_work').show();
return false;
});
});
</script>
<!-- Work Details -->

<!-- Education -->
<script type='text/javascript'>
$(function(){
var overlay = $('<div id="overlay"></div>');
$('.close').click(function(){
$('.popup_edu').hide();
overlay.appendTo(document.body).remove();
return false;
});

$('.x').click(function(){
$('.popup_edu').hide();
overlay.appendTo(document.body).remove();
return false;
});

$('.click_edu').click(function(){
overlay.show();
overlay.appendTo(document.body);
$('.popup_edu').show();
return false;
});
});
</script>
<!-- Education -->

<!-- Profile Pic -->
<script type='text/javascript'>
$(function(){
var overlay = $('<div id="overlay"></div>');
$('.close').click(function(){
$('.popup_pic').hide();
overlay.appendTo(document.body).remove();
return false;
});

$('.x').click(function(){
$('.popup_pic').hide();
overlay.appendTo(document.body).remove();
return false;
});

$('.click_pic').click(function(){
overlay.show();
overlay.appendTo(document.body);
$('.popup_pic').show();
return false;
});
});
</script>
<!-- Profile Pic -->

<!-- Personal Info -->
<script type='text/javascript'>
$(function(){
var overlay = $('<div id="overlay"></div>');
$('.close').click(function(){
$('.popup_personal').hide();
overlay.appendTo(document.body).remove();
return false;
});

$('.x').click(function(){
$('.popup_personal').hide();
overlay.appendTo(document.body).remove();
return false;
});

$('.click_personal').click(function(){
overlay.show();
overlay.appendTo(document.body);
$('.popup_personal').show();
return false;
});
});
</script>
<!-- Personal Info -->

<script>
function valid_file()
{
	var res_field = document.myform.elements["userfile"].value;   
	var extension = res_field.substr(res_field.lastIndexOf('.') + 1).toLowerCase();
	var allowedExtensions = ['jpg', 'jpeg', 'png', 'bmp'];
	if(res_field=="")
	{
		document.getElementById("invalidfile").style.display = "block";
		document.getElementById("invalidfile").innerHTML = "Please Select a File to Upload";
		//alert('Invalid file Format. Only ' + allowedExtensions.join(', ') + ' are allowed.');
		return false;
	}
	if(res_field.length > 0)
	{
		if (allowedExtensions.indexOf(extension) === -1) 
		{
			document.getElementById("invalidfile").style.display = "block";
			document.getElementById("invalidfile").innerHTML = "The filetype you are attempting to upload is not allowed.";
			//alert('Invalid file Format. Only ' + allowedExtensions.join(', ') + ' are allowed.');
			return false;
		}
	}
}
</script>
<!------------------------Form Validation-------------------------------->
<script>
	function valid_edu_detail()
	{
		var institute_name=document.getElementById("school_college_name").value;
		if(institute_name=="")
		{
			document.getElementById("err_institute_name").style.display = "block";
			document.getElementById("err_institute_name").innerHTML = "Please Enter Institution Name";
			return false;
		}
		else
		{
			document.getElementById("err_institute_name").style.display = "none";
			document.getElementById("err_institute_name").innerHTML = "";
		}
	}
	
	function no_edu_error()
	{
		document.getElementById("err_institute_name").style.display = "none";
		/*document.getElementById("school_college_name").style.value = "";
		document.getElementById("fromyear").style.value = "";
		document.getElementById("toyear").style.value = "";
		document.getElementById("degree_board").style.value = "";
		document.getElementById("study_field").style.value = "";
		document.getElementById("grade").style.value = "";
		document.getElementById("description").style.value = "";*/
	}
</script>
<script>
function current_work()
	{
		var working=document.getElementById("currentjob").checked;
		if(working)
		{
			document.getElementById("to_month").style.display = "none";
			document.getElementById("toyear").style.display = "none";
			document.getElementById("to").innerHTML = "Present";
		}
		else
		{
			document.getElementById("to_month").style.display = "block";
			document.getElementById("toyear").style.display = "block";
			document.getElementById("to").innerHTML = "To";
		}
	}
</script>
<!------------------------Form Validation-------------------------------->

<?php
	//$this->load->view('includes/mentor_menu');
?>
<?php
	
			///**---Email
						
						if(set_value('school_college_name')){
							$school_college_name = set_value('school_college_name');
						}
						else{
							$school_college_name = '';
						}
?>
<div class="container">
	<!----------------- Content Start from Here --------------->
		<div class="outercontent">
			<div class="profilepic sideview">
					<img src="" style="height:80px; width:80px;"><h5>profilepic</h5>
				<a href="" class='click_pic'><span class="edit_bttn">Edit</span></a>
			</div>
			<div class="personaldetails sideview">
				<h3>personaldetails</h3>
				<a href="" class='click_personal'><span class="edit_bttn">Edit</span></a>
			</div>
			<div class="education sideview">
				<h3>education</h3>
				<a href="" class='click_edu'><span class="edit_bttn">Edit</span></a>
			</div>
			<div class="workexperience sideview">
				<h3>workexperience</h3>
					
				<a href="" class='click_work'><span class="edit_bttn">Edit</span></a>
			</div>
		</div>


			<!---------------Popup profilepic --------------->
			<div class='popup_pic'>
				<div class='popcontent'>
				<img src='<?php echo base_url()?>/ast/images/x.png' style="border-radius:50%" alt='quit' class='x' id='x' />
				<p>
					<div class="form">
						<div class="form-header"><span class="popup_heading"><h5>Profile Pic</h5></span></div>
							<div class="form-data-pic">
								<form name="myform" action="<?php echo site_url()?>/mentor/fileupload" method="post" accept="image/*" id="myform" onsubmit="return valid_file()" enctype="multipart/form-data">
									<table cellspacing="10px" cellpadding="5px" class="tbl_pic">
										<tr><th colspan="2" style="color:red; font-size:12px;">
											<span id="invalidfile" "display:none;"></span>
											<?php 
											if(isset($_FILES['userfile']))
											{
												//echo $error;
											}
											?>
										</th></tr>
										<tr>
											<td style="padding-right:15px;">Browse Pic</td>
											<td>
												<input type="file" name="userfile" multiple />
											</td>
										</tr>
										<tr>
											<td></td>
											<td align="left">
												<input type="submit" value="Upload" name="submit" />
											</td>
										</tr>
									<?php //echo form_open_multipart('logged_in_contol/fileupload');   ?>
									</table>
								</form>
							</div>
					</div>
				</p>
				</div>
			</div>
			<!---------------Popup profilepic --------------->
			
			
			<!---------------Popup Personal Info --------------->
			<div class='popup_personal'>
				<div class='popcontent'>
				<img src='<?php echo base_url()?>/ast/images/x.png' style="border-radius:50%" alt='quit' class='x' id='x' />
				<p>
					<div class="form">
						<div class="form-header"><span class="popup_heading"><h5>Personal Details</h5></span></div>
							<div class="form-data">
								<form method="post">
								
								</form>
							</div>
					</div>
				</p>
				</div>
			</div>
			<!---------------Popup Personal Info --------------->
						
			<!---------------Popup Education --------------->
			<div class='popup_edu'>
				<div class='popcontent'>
				<img src='<?php echo base_url()?>/ast/images/x.png' style="border-radius:50%" alt='quit' class='x' id='x' onclick="return no_edu_error()" />
				<p>
					<div class="form">
						<div class="form-header"><span class="popup_heading"><h5>Education Details</h5></span></div>
							<div class="form-data">
								<form method="post" onsubmit="return valid_edu_detail()">
									<table cellpadding="25px" cellspacing="25px">
										<tr>
											<td>College / School Name <span class="mandetory"> *</span></td>
										</tr>
										<tr>
											<td><input type="text" name="school_college_name" id="school_college_name" value="<?php echo $school_college_name; ?>" class="txt_popup" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Institution name'" placeholder="Institution name" /><span id="err_institute_name" "display:none;" class="error" ></span></td>
										</tr>
										<tr>
											<td>Completion Year</td>
										</tr>
										<tr>
											<td>
												<select name="fromyear" id="fromyear" class="popup_select">
													<option value="" selected>Select</option>
												<?php 	$i=1900; $today=date("Y");
																while($today>=$i)
																{ 
													?>
													<option value="<?php echo $today; ?>">
														<?php
																echo $today;$today--;
														} ?>
													</option>
												</select>
												To
												<select name="toyear" id="toyear" class="popup_select">
													<option value="" selected>Select</option>
												<?php 	$i=1900; $today=date("Y");
																while($today>=$i)
																{ 
													?>
													<option value="<?php echo $today; ?>">
														<?php
																echo $today;$today--;
														} ?>
													</option>
												</select>
												</td>
										</tr>
										<tr>
											<td>Degree / Board</td>
										</tr>
										<tr>
											<td><input type="text" name="degree_board" id="degree_board" value="" class="txt_popup" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Degree / Board'" placeholder="Degree / Board" /></td>
										</tr>
										
										<tr>
											<td>Field of Study</td>
										</tr>
										<tr>
											<td><input type="text" name="study_field" id="study_field" value="" class="txt_popup" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Field of Study'" placeholder="Field of Study" /></td>
										</tr>
										
										<tr>
											<td>Grade</td>
										</tr>
										<tr>
											<td><input type="text" name="grade" id="grade" value="" class="txt_popup" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Grade or Marks'" placeholder="Grade or Marks" /></td>
										</tr>
										
										<tr>
											<td>Description</td>
										</tr>
										<tr>
											<td><textarea name="description" id="description" value="" class="textarea_popup" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Description'" placeholder="Description"  ></textarea></td>
										</tr>
										<tr>
											<td align="right"><input type="submit" name="addeducation" id="addeducation" value="Add" class="bttn_popup" /></td>
										</tr>
									</table>
								</form>
							</div>
					</div>
				</p>
				</div>
			</div>
			<!---------------Popup Education --------------->
			
			<!---------------Popup Work Details--------------->
			<div class='popup_work'>
				<div class='popcontent'>
				<img src='<?php echo base_url()?>/ast/images/x.png' style="border-radius:50%" alt='quit' class='x' id='x' />
				<p>
					<div class="form">
						<div class="form-header"><span class="popup_heading"><h5>Work Details</h5></span></div>
							<div class="form-data">
								<form method="post">
									<table cellpadding="25px" cellspacing="25px">
										<tr>
											<td>Company Name <span class="mandetory"> *</span></td>
										</tr>
										<tr>
											<td><input type="text" name="company_name" id="company_name" value="" class="txt_popup" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Company Name'" placeholder="Company Name" /><span id="err_company_name" "display:none;" class="error" ></span></td>
										</tr>
										<tr>
											<td>Designation <span class="mandetory"> *</span></td>
										</tr>
										<tr>
											<td><input type="text" name="designation" id="designation" value="" class="txt_popup" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Designation'" placeholder="Designation" /><span id="err_designation_name" "display:none;" class="error" ></span></td>
										</tr>
										
										<tr>
											<td>Time Period <span class="mandetory"> *</span></td>
										</tr>
										<tr>
											<td>
											<select name="from_month" class="popup_select">
												<option value="">Select</option>
												<option value="January">January</option>
												<option value="February">February</option>
												<option value="March">March</option>
												<option value="April">April</option>
												<option value="May">May</option>
												<option value="June">June</option>
												<option value="July">July</option>
												<option value="August">August</option>
												<option value="September">September</option>
												<option value="October">October</option>
												<option value="November">November</option>
												<option value="December">December</option>
											</select>
											<span id="err_from_month_name" "display:none;" class="error" ></span>
											<select name="fromyear" id="fromyear" class="popup_select">
													<option value="" selected>Select</option>
												<?php 	$i=1900; $today=date("Y");
																while($today>=$i)
																{ 
													?>
													<option value="<?php echo $today; ?>">
														<?php
																echo $today;$today--;
														} ?>
													</option>
												</select>
											<span id="err_fromyear_name" "display:none;" class="error" ></span>	
											 <label for="" id="to" value="">To</label>
											 <select name="to_month" class="popup_select">
												<option value="">Select</option>
												<option value="January">January</option>
												<option value="February">February</option>
												<option value="March">March</option>
												<option value="April">April</option>
												<option value="May">May</option>
												<option value="June">June</option>
												<option value="July">July</option>
												<option value="August">August</option>
												<option value="September">September</option>
												<option value="October">October</option>
												<option value="November">November</option>
												<option value="December">December</option>
											</select>
											<span id="err_to_month_name" "display:none;" class="error" ></span>
											<select name="toyear" id="toyear" class="popup_select">
													<option value="" selected>Select</option>
												<?php 	$i=1900; $today=date("Y");
																while($today>=$i)
																{ 
													?>
													<option value="<?php echo $today; ?>">
														<?php
																echo $today;$today--;
														} ?>
													</option>
												</select>
											<span id="err_toyear_name" "display:none;" class="error" ></span>	
											</td>
										</tr>
										<tr>
											<td><input type="checkbox" name="currentjob" id="currentjob" onclick="return current_work()"> <label for="currentjob" onclick="return current_work()">I am Currently Working Here</label></td>
										</tr>
										<tr>
											<td>Location</td>
										</tr>
										<tr>
											<td><input type="text" name="location" id="location" value="" class="txt_popup" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Location'" placeholder="Location" /></td>
										</tr>
										
										<tr>
											<td>Description</td>
										</tr>
										<tr>
											<td><textarea name="description" id="description" value="" class="textarea_popup" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Description'" placeholder="Description"  ></textarea></td>
										</tr>
										<tr>
											<td align="right"><input type="submit" name="addeducation" id="addeducation" value="Add" class="bttn_popup" /></td>
										</tr>
									</table>
								</form>
							</div>
					</div>
				</p>
				</div>
			</div>
			<!---------------Popup Work Details --------------->

</div>

<?php
	$this->load->view('includes/footer_session');
?>

