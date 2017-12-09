<?php
$this->load->view('includes/header_session');
?>
<script>
	
	function mentor_detail()
		{
			var a = 0;
			
			var prefered_day = document.getElementById("prefered_day").value;
			if(prefered_day == "") 	
			{
			document.getElementById("prefered_dayError").style.display = "block";
			document.getElementById("prefered_dayError").innerHTML="Please select prefered day.";
			
			a = 1;

			}
			else
			{
			document.getElementById("prefered_dayError").style.display = "none";
			document.getElementById("prefered_dayError").innerHTML="";

			}
			
			var prefered_from_time = document.getElementById("prefered_from_time").value;
			if(prefered_from_time == "") 	
			{
			document.getElementById("prefered_from_timeError").style.display = "block";
			document.getElementById("prefered_from_timeError").innerHTML="Please select prefered start time.";
			
			a = 1;

			}
			else
			{
			document.getElementById("prefered_from_timeError").style.display = "none";
			document.getElementById("prefered_from_timeError").innerHTML="";

			}
			
			var prefered_to_time = document.getElementById("prefered_to_time").value;
			var prefered_from_time = document.getElementById("prefered_from_time").value;

			if(prefered_to_time == "") 	
			{
			document.getElementById("prefered_to_timeError").style.display = "block";
			document.getElementById("prefered_to_timeError").innerHTML="Please select prefered  end time.";
			
			 a = 1;

			}
			else
			{
				if(prefered_to_time == prefered_from_time)
				{
				document.getElementById("prefered_to_timeError").style.display = "block";
				document.getElementById("prefered_to_timeError").innerHTML="Prefered start time & prefered end time can't be same.";
				a = 1;

				}
				else
				{
					if(prefered_to_time < prefered_from_time)
					{
					document.getElementById("prefered_to_timeError").style.display = "block";
					document.getElementById("prefered_to_timeError").innerHTML="Please select valid timing (Ex:-6-7).";
					a= 1;
					}
					else
					{
					document.getElementById("prefered_to_timeError").style.display = "none";
					document.getElementById("prefered_to_timeError").innerHTML="";
	
					}

				}
			}
			
			var skype_id = document.getElementById("skype_id").value;
			if(skype_id == "") 	
			{
			document.getElementById("skype_idError").style.display = "block";
			document.getElementById("skype_idError").innerHTML="Please enter your skype-id.";
			
			 a = 1;

			}
			else
			{
			document.getElementById("skype_idError").style.display = "none";
			document.getElementById("skype_idError").innerHTML="";

			}
			
			var cost_charges = document.getElementById("cost_charges").value;
			if(cost_charges == "") 	
			{
			document.getElementById("cost_chargesError").style.display = "block";
			document.getElementById("cost_chargesError").innerHTML="Please enter cost charges.";
			
			 a = 1;

			}
			else
			{
			document.getElementById("cost_chargesError").style.display = "none";
			document.getElementById("cost_chargesError").innerHTML="";

			}
				
			if(a == 0)
			{
			return true;
				
			}
			else{
				return false;
				}
		}
		
</script>


<div class ="container">
	
	<div class="innr_container" style=" width:724px; margin:40px auto;">
			<div class = "data_content">

<?php
						if(set_value('prefered_day')){
							$prefered_day = set_value('prefered_day');
						}
						else{
							$prefered_day = '';
						}
												
						if(set_value('prefered_from_time')){
							$prefered_from_time = set_value('prefered_from_time');
						}
						else{
							$prefered_from_time = '';
						}
						if(set_value('prefered_to_time')){
							$prefered_to_time = set_value('prefered_to_time');
						}
						else{
							$prefered_to_time = '';
						}
						if(set_value('skype_id')){
							$skype_id = set_value('skype_id');
						}
						else{
							$skype_id = '';
							}

						if(set_value('cost_charges')){
							$cost_charges = set_value('cost_charges');
						}
						else{
							$cost_charges = '';
							}

?>						

<fieldset style="width:670px">
	
<legend> Mentor Detail </legend>
	
<form method = "post" onsubmit = "return mentor_detail()" action="<?php  echo site_url('mentor/add_appoinment');  ?>">
<table>
<tr>

<td>Prefered Time <span class="mandetory"> *</span></td>

<span id="prefered_dayError" style="display: none; font-size:14px;color:red;"></span>
<span id="prefered_from_timeError" style="display: none; font-size:14px;color:red;"></span>
<span id="prefered_to_timeError" style="display: none; font-size:14px;color:red;"></span>

<td><select name="prefered_day" class = "popup_select" id ="prefered_day" value="<?php echo $prefered_day?>" >
<option value='' selected>Day</option>
<option value="Monday" <?php  if(set_value('prefered_day') == "Monday") {echo "selected";} ?> >Monday</option>
<option value="Tuesday" <?php  if(set_value('prefered_day') == "Tuesday") {echo "selected";} ?> >Tuesday</option>
<option value="Wednesday" <?php  if(set_value('prefered_day') == "Wednesday") {echo "selected";} ?> >Wednesday</option>
<option value="Thursday" <?php  if(set_value('prefered_day') == "Thursday") {echo "selected";} ?>>Thursday</option>
<option value="Friday" <?php  if(set_value('prefered_day') == "Friday") {echo "selected";} ?>>Friday</option>
<option value="Saturday" <?php  if(set_value('prefered_day') == "Saturday") {echo "selected";} ?>>Saturday</option>
<option value="Sunday" <?php  if(set_value('prefered_day') == "Sunday") {echo "selected";} ?>>Sunday</option>

</select> 
From 
<select name="prefered_from_time" class = "popup_select" id = "prefered_from_time" value="<?php echo $prefered_from_time ?>">	
<option value ='' selected> Time </option>
<?php
$i=1;

while($i<=24)
{ ?>
<option value = "<?php echo $i ?>"><?php echo $i ?> </option>
<?php

$i++;
	
	
}

?>
</select>
To
<select name="prefered_to_time" class = "popup_select" id = "prefered_to_time" value="<?php echo $prefered_to_time ?>">	
<option value ='' selected> Time </option>
<?php
$i=1;

while($i<=24)
{ ?>
<option value = "<?php echo $i ?>"><?php echo $i ?> </option>
<?php

$i++;
	
	
}

?>
</select>
</td>
</tr>

<tr>
<td>Skype-ID <span class="mandetory"> *</span></td>
<td><input type ="text" class="txt_popup" name = "skype_id" id ="skype_id" value ="<?php echo $skype_id?>">
<span id="skype_idError" style="display: none; font-size:14px;color:red;"></span>

</td>
</tr>

<tr>
<td>Cost Charges <span class="mandetory"> *</span></td>
<td><input type ="text" class="txt_popup" name = "cost_charges" id ="cost_charges" value ="<?php echo $cost_charges?>"> 
<span id="cost_chargesError" style="display: none; font-size:14px;color:red;"></span>

</td>
</tr>

<td class="button" align="left"><input type="submit" name="submit_mentor_detail" value="Save" >

</table>
</form> 	

</fieldset>
</div>
</div>
</div>


<?php
$this->load->view('includes/footer_session');
?>
