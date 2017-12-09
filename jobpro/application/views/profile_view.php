
<!----- ----------------------------Add DOB Calander----------------------------  ------------------>






<!----- -------------------------------edit Profile----------------------------  ------------------>

<?php
$this->load->view('includes/header_session');
?>

<script type='text/javascript'>

$(function(){
var overlay = $('<div id="overlay"></div>');
$('.close').click(function(){
$('.popup_edit_profile').hide();
overlay.appendTo(document.body).remove();
return false;
});

$('.x').click(function(){
$('.popup_edit_profile').hide();
overlay.appendTo(document.body).remove();
return false;
});

$('.click_edit_profile').click(function(){
overlay.show();
overlay.appendTo(document.body);
$('.popup_edit_profile').show();
return false;
});
});

</script>

<!----- ------------------------------edit Photo----------------------------  ------------------>


<script type='text/javascript'>

$(function(){
var overlay = $('<div id="overlay"></div>');
$('.close').click(function(){
$('.popup_edit_photo').hide();
overlay.appendTo(document.body).remove();
return false;
});

$('.x').click(function(){
$('.popup_edit_photo').hide();
overlay.appendTo(document.body).remove();
return false;
});

$('.click_edit_photo').click(function(){
overlay.show();
overlay.appendTo(document.body);
$('.popup_edit_photo').show();
return false;
});
});

</script>

<!----- ----------------------------edit education----------------------------  ------------------>

<script type='text/javascript'>

$(function(){
 var overlay = $('<div id="overlay"></div>'); 
/* var edu_id = $('<div id ="<?php echo $edu_id?>"></div>'); */ 
$('.close').click(function(){
$('.popup_edit_edu').hide();
overlay.appendTo(document.body).remove();
return false;
});

$('.x').click(function(){
$('.popup_edit_edu').hide();
overlay.appendTo(document.body).remove();
return false;
});

$('.click_edit_edu').click(function(){
overlay.show();
overlay.appendTo(document.body);
$('.popup_edit_edu'<?php $edu_id?>).show();
return false;
});
});
</script>


<!----- ------------------edit work----------------------------------- -->

<script type='text/javascript'>

$(function(){
var overlay = $('<div id="overlay"></div>');
$('.close').click(function(){
$('.popup_edit_work').hide();
overlay.appendTo(document.body).remove();
return false;
});

$('.x').click(function(){
$('.popup_edit_work').hide();
overlay.appendTo(document.body).remove();
return false;
});

$('.click_edit_work').click(function(){
overlay.show();
overlay.appendTo(document.body);
$('.popup_edit_work').show();
return false;
});
});
</script>

<!----- ------------------add education----------------------------------- -->

<script>
$(function(){
var overlay = $('<div id="overlay"></div>');
$('.close').click(function(){
$('.popup_add_edu').hide();
overlay.appendTo(document.body).remove();
return false;
});

$('.x').click(function(){
$('.popup_add_edu').hide();
overlay.appendTo(document.body).remove();
return false;
});

$('.click_add_edu').click(function(){
overlay.show();
overlay.appendTo(document.body);
$('.popup_add_edu').show();
return false;
});
});

</script>


<!----- ------------------------------Add work--------------------------  ------------------>
<script type='text/javascript'>

$(function(){
var overlay = $('<div id="overlay"></div>');
$('.close').click(function(){
$('.popup_add_work').hide();
overlay.appendTo(document.body).remove();
return false;
});

$('.x').click(function(){
$('.popup_add_work').hide();
overlay.appendTo(document.body).remove();
return false;
});

$('.click_add_work').click(function(){
overlay.show();
overlay.appendTo(document.body);
$('.popup_add_work').show();
return false;
});
});

</script>

<!----- ------------------------------edit summary--------------------------  ------------------>
<script type='text/javascript'>

$(function(){
var overlay = $('<div id="overlay"></div>');
$('.close').click(function(){
$('.popup_edit_summary').hide();
overlay.appendTo(document.body).remove();
return false;
});

$('.x').click(function(){
$('.popup_edit_summary').hide();
overlay.appendTo(document.body).remove();
return false;
});

$('.click_edit_summary').click(function(){
overlay.show();
overlay.appendTo(document.body);
$('.popup_edit_summary').show();
return false;
});
});

</script>


<!----- ------------------------------edit skill--------------------------  ------------------>
<script type='text/javascript'>

$(function(){
var overlay = $('<div id="overlay"></div>');
$('.close').click(function(){
$('.popup_edit_skill').hide();
overlay.appendTo(document.body).remove();
return false;
});

$('.x').click(function(){
$('.popup_edit_skill').hide();
overlay.appendTo(document.body).remove();
return false;
});

$('.click_edit_skill').click(function(){
overlay.show();
overlay.appendTo(document.body);
$('.popup_edit_skill').show();
return false;
});
});

</script>



<!----- ------------------------------Edit Certification--------------------------  ------------------>
<script type='text/javascript'>

$(function(){
var overlay = $('<div id="overlay"></div>');
$('.close').click(function(){
$('.popup_edit_certificate').hide();
overlay.appendTo(document.body).remove();
return false;
});

$('.x').click(function(){
$('.popup_edit_certificate').hide();
overlay.appendTo(document.body).remove();
return false;
});

$('.click_edit_certificate').click(function(){
overlay.show();
overlay.appendTo(document.body);
$('.popup_edit_certificate').show();
return false;
});
});

</script>


<!----- ------------------------------Add New Certification--------------------------  ------------------>
<script type='text/javascript'>

$(function(){
var overlay = $('<div id="overlay"></div>');
$('.close').click(function(){
$('.popup_add_certificate').hide();
overlay.appendTo(document.body).remove();
return false;
});

$('.x').click(function(){
$('.popup_add_certificate').hide();
overlay.appendTo(document.body).remove();
return false;
});

$('.click_add_certificate').click(function(){
overlay.show();
overlay.appendTo(document.body);
$('.popup_add_certificate').show();
return false;
});
});



function no_edu_error()
	{
		document.getElementById("firstnameError").style.display = "none";
		document.getElementById("lastnameError").style.display = "none";
	}

</script>

<script>
		
		
		function valid()
		{
			var a = 0;
			
			var firstname = document.getElementById("firstname").value;
			if(firstname == "") 	
			{
			document.getElementById("firstnameError").style.display = "block";
			document.getElementById("firstnameError").innerHTML="Please enter first name";
			
			a = 1;
			}
			else 
			{
				if(!isNaN(firstname)) 	
					{
					document.getElementById("firstnameError").style.display = "block";
					document.getElementById("firstnameError").innerHTML="Please enter valid first name";
					
					a = 1;
						
					}
				else
					{
						
					document.getElementById("firstnameError").style.display = "block";
					document.getElementById("firstnameError").innerHTML="";

					}
			}

			var lastname = document.getElementById("lastname").value;
			if(lastname == "") 
			{
			document.getElementById("lastnameError").style.display = "block";
			document.getElementById("lastnameError").innerHTML="Please enter last name";
			a = 1;

			}
		
			else 
			{
				if(!isNaN(lastname)) 	
					{
					document.getElementById("lastnameError").style.display = "block";
					document.getElementById("lastnameError").innerHTML="Please enter valid last name ";
					
					a = 1;
						
					}
				else
					{
						
					document.getElementById("lastnameError").style.display = "block";
					document.getElementById("lastnameError").innerHTML="";

					}
			}		
			
			var contact = document.getElementById("contact").value;
			if(contact == "")
			{
			document.getElementById("contactError").style.display = "none";
			document.getElementById("contactError").innerHTML="";
			
		//	a = 0;
	
			}
			else{
	
			if(isNaN(contact)) 
			{
			document.getElementById("contactError").style.display = "block";
			document.getElementById("contactError").innerHTML="Please enter valid contact detail.";
			
			a = 1;

			}
			else {
				
					if(contact.length != 10)  
					{
					document.getElementById("contactError").style.display = "block";
					document.getElementById("contactError").innerHTML="Valid length 10 Digits";
					
					a = 1;

					}
					else
					{
					document.getElementById("contactError").style.display = "block";
					document.getElementById("contactError").innerHTML="";

					}
				
			    } 
				
				
			}  
			
			if(a == 0)
				{
					return true;
				}
				else
				{
				return false;
				}

		}
		
	

		</script>
<! ------------------------------------------Show Validation---------------------------------------------------------- ->		

<script>

		function show()
		{
			var sum = document.getElementById("summary").value = <?php echo $summarydata[0]['summary'];?>
			if(sum == "") 	
			{
				
			document.getElementById("click_edit_summary").display = "block";
			
			return false;
	
		}
			


</script>
<!-- ----------------------------------------Education edit Validation-------------------------------------------------------- -->	

<script>


		function education()
		{
			var school = document.getElementById("school").value;
			if(school == "") 	
			{
			document.getElementById("schoolError").style.display = "block";
			document.getElementById("schoolError").innerHTML="Please enter the name of the school you attended.";
			return false;
			}
			else
			{
			document.getElementById("schoolError").innerHTML="";
	
			}
			
			
		}
		
		
</script>

<!-- ----------------------------------------Education Add Validation-------------------------------------------------------- -->	


<script>


		function education_add()
		{
			var school = document.getElementById("school_add").value;
			if(school == "") 	
			{
			document.getElementById("school_addError").style.display = "block";
			document.getElementById("school_addError").innerHTML="Please enter the name of the school you attended.";
			return false;
			}
			else
			{
			document.getElementById("school_addError").innerHTML="";
	
			}
		
			
		}
		
		
</script>

 <!------------------------------------------Edit Work Validation--------------------------------------------------------- -->	

<script>
	
		function work()
		{  var a = 0;
		
			var companyname = document.getElementById("company_name").value;
			if(companyname == "") 	
			{
			document.getElementById("company_nameError").style.display = "block";
			document.getElementById("company_nameError").innerHTML="Please enter a company name.";
			
			a = 1;
			}
			else
			{
			document.getElementById("company_nameError").style.display = "none";
			document.getElementById("company_nameError").innerHTML="";
			
			}
			
			
			var jobtitle = document.getElementById("jobtitle").value;
			if(jobtitle == "") 	
			{
			document.getElementById("jobtitleError").style.display = "block";
			document.getElementById("jobtitleError").innerHTML="Please enter a title.";
			
			a = 1;
			}
			else
			{
			document.getElementById("jobtitleError").style.display = "none";
			document.getElementById("jobtitleError").innerHTML="";
			
			}
			
			var s_year = document.getElementById("s_year").value;
			if(s_year == "") 	
			{
			document.getElementById("s_yearError").style.display = "block";
			document.getElementById("s_yearError").innerHTML="Please select a year for the start date.";
			
			 a = 1;

			}
			else
			{
			document.getElementById("s_yearError").style.display = "none";
			document.getElementById("s_yearError").innerHTML="";

			}
			
			var e_year = document.getElementById("e_year").value;
			if(e_year == "") 	
			{
			document.getElementById("e_yearError").style.display = "block";
			document.getElementById("e_yearError").innerHTML="Please select a year for the end date.";
			
			a = 1;

			}
			else{
			document.getElementById("e_yearError").style.display = "none";
			document.getElementById("e_yearError").innerHTML="";
				}

			if(a == 0)
			{
			return true;
				
			}else{
				return false;
				}
		
		}
		
</script>


<!------------------------------------------Add Work Validation--------------------------------------------------------- -->	

<script>
	
		function add_work()
		{
			var a = 0;
			
			var companyname = document.getElementById("company_name_add").value;
			if(companyname == "") 	
			{
			document.getElementById("company_name_addError").style.display = "block";
			document.getElementById("company_name_addError").innerHTML="Please enter a company name.";
			
			a = 1;

			}
			
			var jobtitle = document.getElementById("jobtitle_add").value;
			if(jobtitle == "") 	
			{
			document.getElementById("jobtitle_addError").style.display = "block";
			document.getElementById("jobtitle_addError").innerHTML="Please enter a title.";
			
			a = 1;

			}
			
			var s_year = document.getElementById("add_s_year").value;
			if(s_year == "") 	
			{
			document.getElementById("add_s_yearError").style.display = "block";
			document.getElementById("add_s_yearError").innerHTML="Please select a year for the start date.";
			
			 a = 1;

			}
			else
			{
			document.getElementById("add_s_yearError").style.display = "none";
			document.getElementById("add_s_yearError").innerHTML="";

			}
			
			var e_year = document.getElementById("add_e_year").value;
			if(e_year == "") 	
			{
			document.getElementById("add_e_yearError").style.display = "block";
			document.getElementById("add_e_yearError").innerHTML="Please select a year for the end date.";
			
			 a = 1;

			}
			else
			{
			document.getElementById("add_e_yearError").style.display = "none";
			document.getElementById("add_e_yearError").innerHTML="";

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

		 <!------------------------------------------Update certification Validation--------------------------------------------------------- -->	
		
<script>		
		function Certification()
		{
			var a = 0;
		
			var cert = document.getElementById("cert_name").value;
			if(cert == "") 	
			{
			document.getElementById("cert_nameError").style.display = "block";
			document.getElementById("cert_nameError").innerHTML="Please enter certificate name.";
			a = 1;

			}
			
			var s_year = document.getElementById("cert_edit_s_date").value;
			if(s_year == "") 	
			{
			document.getElementById("cert_edit_s_dateError").style.display = "block";
			document.getElementById("cert_edit_s_dateError").innerHTML="Please select a year for the start date.";
			
			 a = 1;

			}
			else
			{
			document.getElementById("cert_edit_s_dateError").style.display = "none";
			document.getElementById("cert_edit_s_dateError").innerHTML="";

			} 
			
			var e_year = document.getElementById("cert_edit_e_date").value;
			if(e_year == "") 	
			{
			document.getElementById("cert_edit_e_dateError").style.display = "block";
			document.getElementById("cert_edit_e_dateError").innerHTML="Please select a year for the end date.";
			
			 a = 1;

			}
			else
			{
			document.getElementById("cert_edit_e_dateError").style.display = "none";
			document.getElementById("cert_edit_e_dateError").innerHTML="";

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

	 <!------------------------------------------Add certification Validation--------------------------------------------------------- -->	
		
<script>		
		function add_Certification()
		{
			var a = 0;
			
			var cert = document.getElementById("certadd_name").value;
			if(cert == "") 	
			{
			document.getElementById("certadd_nameError").style.display = "block";
			document.getElementById("certadd_nameError").innerHTML="Please enter certificate name.";
			
			a = 1;

			}
			
			var s_year = document.getElementById("cert_add_s_date").value;
			if(s_year == "") 	
			{
			document.getElementById("cert_add_s_dateError").style.display = "block";
			document.getElementById("cert_add_s_dateError").innerHTML="Please select a year for the start date.";
			
			 a = 1;

			}
			else
			{
			document.getElementById("cert_add_s_dateError").style.display = "none";
			document.getElementById("cert_add_s_dateError").innerHTML="";

			} 
			
			var e_year = document.getElementById("cert_add_e_date").value;
			if(e_year == "") 	
			{
			document.getElementById("cert_add_e_dateError").style.display = "block";
			document.getElementById("cert_add_e_dateError").innerHTML="Please select a year for the end date.";
			
			 a = 1;

			}
			else
			{
			document.getElementById("cert_add_e_dateError").style.display = "none";
			document.getElementById("cert_add_e_dateError").innerHTML="";

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

		 <!------------------------------------------checkbox Cert click Validation--------------------------------------------------------- -->	

<script>
 
 function check()
	{
	 
	 var chk = document.getElementById("present_date");
	 if(chk.checked == true)
		{
			<?php  $xyz == "present"?>
			document.getElementById("month").style.display = "none";
			document.getElementById("e_date").style.display = "none";
			document.getElementById("lbel_present").style.display = "inline";

		}
	 if(chk.checked == false)
		{
			<?php  $xyz == ""?>
			document.getElementById("month").style.display="inline";
			document.getElementById("e_date").style.display="inline";
			document.getElementById("lbel_present").style.display = "none";

		}
	}


</script>

<script>
 
 function check_work()
	{
	 
	 var chk = document.getElementById("presentdate");
	 if(chk.checked == true)
		{
			
			document.getElementById("to_month").style.display = "none";
			document.getElementById("e_year").style.display = "none";
			document.getElementById("lbl_present").style.display = "inline";
		}
		
		if(chk.checked == false)
		{
			document.getElementById("to_month").style.display="inline";
			document.getElementById("e_year").style.display ="inline";
			document.getElementById("lbl_present").style.display = "none";

		}
	}


</script>

<!-- ------------------------------  Skill Tagger Start-------------------------- --> 
<script type="text/javascript">
    $('#textarea').textext({ plugins: 'tags' });

    $('#addtag').bind('click', function(e)
    {
        $('#textarea').textext()[0].tags().addTags([ $('#tagname').val() ]);
        $('#tagname').val('');
    });
</script>
<!-- ------------------------------  Skill Tagger End-------------------------- --> 

		
<script type ="text/javascript">
	
function Delete()
{
	contact=confirm("Are you sure you want to delete ?");
    if(contact!=true)
    {
        return false;
    }	

}	
</script>
		
	<?php
		
		$maximumpoints = 100;
		$max = 20;
	
	
	foreach($userdata as $row)

		{
				
				$userdata_Points = 20;

				$userdata_point = 0;

				if($row['image'] != 'user_unknown.jpg')
				{
				$userdata_point+=4;
				}
				if($row['firstname'] != '')
				{
				$userdata_point+=4;
				}
				if($row['lastname'] != '')
				{
				$userdata_point+=4;
				}
				if($row['gender'] != '')
				{
				$userdata_point+=0;
				}
				if($row['language'] != '')
				{
				$userdata_point+=4;
				}
				if($row['contact'] != '')
				{
				$userdata_point+=4;
				}
		}
		
		
		foreach($summarydata as $row)

		{
				
				$summarydata_Points = 10;

				$summarydata_Point = 0;

				if($row['summary'] != '')
				{
				$summarydata_Point+=10;
				}
				
		}
		
		
			foreach($edu_data as $row)

			{
				
				$edu_data_Points = 20;

				$edu_data_Point = 0;

				if($row['school'] != '')
				{
				$edu_data_Point+=5;
				}
				if($row['s_date'] != '')
				{
				$edu_data_Point+=3;
				}
				if($row['e_date'] != '')
				{
				$edu_data_Point+=2;
				}
				if($row['degree'] != '')
				{
				$edu_data_Point+=5;
				}
				if($row['field_of_study'] != '')
				{
				$edu_data_Point+=5;
				}
				
		}

		foreach($work_data as $row)

		{
				
				$work_data_Points = 20;

				$work_data_Point = 0;

				if($row['company_name'] != '')
				{
				$work_data_Point+=5;
				}
				if($row['jobtitle'] != '')
				{
				$work_data_Point+=5;
				}
				if($row['location'] != '')
				{
				$work_data_Point+=5;
				}
				if($row['s_year'] != '')
				{
				$work_data_Point+=3;
				}
				if($row['e_year'] != '')
				{
				$work_data_Point+=2;
				}
				
		}
		

		foreach($skill_data as $row)

		{
				
				$skill_data_Points = 10;

				$skill_data_Point = 0;

				if($row['skill'] != '')
				{
				$skill_data_Point+=10;
				}

		}

		foreach($cert_data as $row)

		{
				
				$cert_data_Points = 20;

				$cert_data_Point = 0;

				if($row['cert_name'] != '')
				{
				$cert_data_Point+=4;
				}
				if($row['cert_authority'] != '')
				{
				$cert_data_Point+=4;
				}
				if($row['license_number'] != '')
				{
				$cert_data_Point+=4;
				}
				if($row['s_date'] != '')
				{
				$cert_data_Point+=4;
				}
				if($row['e_date'] != '')
				{
				$cert_data_Point+=4;
				}

			
			
		}
		
		$total_points = $userdata_point + $summarydata_Point + @$edu_data_Point + @$work_data_Point + @$skill_data_Point + @$cert_data_Point ;
			
			$percentage = ($total_points*$maximumpoints)/100;

		
		?>
		
		
		<?php if($percentage <= 40)
				{	
					$class="least";
				}
				else
				{
					if(($percentage>=40)&&($percentage<90))
					{
						$class="moderate";
					}
					else
					{
						if($percentage >=90 )
						{
							$class="complete";
						}
					  }
				 }
			?>
			
		 		
<div class ="container">
	<div class="innr_container" style="width:1024px; margin:40px auto;">
		<div class="message" style="margin:0px auto;"><?php  if($this->session->flashdata('Logmsg'))   echo  $this->session->flashdata('Logmsg'); ?></div>
<fieldset style="width:770px">
	
<legend> Profile Detail </legend>
	
	<div class="percentbar" style="width: 502px; ">
			<div class ="<?php echo $class ?>" style="width:<?php echo round($percentage * $maximumpoints)/$max; ?>px;">
			 <label for = "Percentage " class ="<?php echo $class ?>" style = "width:80%;">Percentage:<?php echo $percentage."%" ?></label>
			 </div>
	</div> 

<?php   $where=array(
                        'id'=>$this->session->userdata('id')
							);
                        
                $data['userdata'] = $this->user_model->get_sql_select_data('registration', $where);
				$rolee = ucwords(strtolower($data['userdata'][0]['user_type']));
			/*	echo"<pre>";
				print_r($rolee);
				exit; */
				if($rolee == 'Mentor')
				{
					$m_class = 'becomementor';
				}
				else
				{
				$m_class = '';
				}
				 ?>
				 
<p align = "right"><a class="<?php echo $m_class ;?>" href="<?php echo site_url().'/dashboard/become_mentor/'.$percentage?>">Become a Mentor</a></p>

<div class = "data_content">
			
<fieldset>
	
	<legend> <b> Personal Detail </b>
	<div class="edit">
		<ul>
			<li><a href="" class='click_edit_profile' >Edit Profile </a></li>
		</ul>
		</div> </legend>
	



<div class = "personalinfo">
<img style="height:200px; width:200px;border:1px solid #CCCCCC; " src="<?php echo $base = base_url().'/ast/images/uploads/userpic/'.$userdata[0]['image'] ?>">

</div>

<div class = "personalinfo">
<table align="left">
	
	
<tr>
	<td> <h4><b><?php echo $userdata[0]['firstname']?>&nbsp;<?php echo $userdata[0]['lastname']?></b> </h4></td>
</tr>

<tr>
	<td>Gender : <?php echo $userdata[0]['gender']?></td>
</tr>

<!--
<tr>
	<td> DOB : <?php echo $userdata[0]['dob']?></td>

</tr>  -->



<tr>
	<td>Email Address : <?php echo $userdata[0]['email']?></td>
</tr>


<tr>
	<td>Languages Known : <?php echo $userdata[0]['language']?></td>
</tr>


<tr>
	<td>Contact info : <?php echo $userdata[0]['contact']?></td>
</tr>



</table>
</div>
</form>

</fieldset>

</div>
<! -----------------------------------   Edit Profile    -------------------------------------- -->


<div class='popup_edit_profile'>
<div class='content'>
<img src='<?php echo base_url().'/ast/images/x.png'?>' style="border-radius:50%" alt='quit' class='x' onclick="return no_edu_error()" id='x' />
<p>
	
	<div class="form">
	<div class="form-header">
		<span class="popup_heading"><h3>Edit Profile</h3></span></div>
	<div class="form-data">
	
<form method="post" onsubmit="return valid()" enctype="multipart/form-data" action="<?php  echo site_url('dashboard/profile_update');  ?>">

		
<table align="left">

<tr>	
<td> Profile Image </td>
<td class="tdd"><input type="hidden" name ="existingimage" id ="existingimage" value="<?php echo $userdata[0]['image']; ?>"><img style="height:100px; width:100px;border:1px solid #CCCCCC; " src="<?php echo $base = base_url().'/ast/images/uploads/userpic/'.$userdata[0]['image'] ?>"class="user_login_img"/>
<input type="file" name="userfile" size="20" /></td>
</tr>
			
<tr>
<td>First Name</td>
<td><input type="text" name="firstname" class = "txt_popup" id="firstname" title="first name" value=<?php echo $userdata[0]['firstname']?>>
<span id="firstnameError" style="display: none; font-size:14px;color:red;"></span>
</td>
</tr>

</tr>

<tr>
<td>Last Name</td>
<td><input type="text" name="lastname" id="lastname" class = "txt_popup" title="last name" value=<?php echo $userdata[0]['lastname']?>>
<span id="lastnameError" style="display: none; font-size:14px;color:red;"></span></td>

</tr>

<tr>
<td>Gender</td>
<td><input type="radio" name="gender" title="gender" value="Male" <?php if($userdata[0]['gender'] == "Male") { echo "checked"; } ?> id="male">
<label for="male" class="lbl_radio">Male</label>
<input type="radio" name="gender" value="Female"  <?php if($userdata[0]['gender'] == "Female") { echo "checked"; } ?>id="female">
<label for="female" class="lbl_radio">Female</label>
</td>
<td><span id="err_gender" style="display: none; font-size:14px;color:red;" ></span></td>
</tr>

<tr>
<td>Email Address</td>
<td><input type="text" name="email" class = "txt_popup" title="Email address" id="email" readonly value=<?php echo $userdata[0]['email']?>></td>
</tr>

<!--
<tr>
<td>Date of Birth</td>
<td><input type="text" name="dob" id="datepicker" value = "<?php echo $userdata[0]['dob']?>"></td>
</tr>  -->

<tr>
<td>Languages</td>

<td> <select name="language" class = "popup_select"  multiple value="<?php echo $userdata[0]['language']?>" >
<option value =''>-Select-</option>
<?php
foreach($language_data as $row)
{
$language = $row['language'];	

?>
<option value = '<?php echo $language; ?>'><?php echo $language; ?></option>
<?php
}
?>
</td>

</tr>


<tr>
<td>Contact</td>
<td><input type="text" class="txt_popup"name="contact" class = "txt_popup" id="contact" value="<?php echo $userdata[0]['contact']?>">
<span id="contactError" style="display: none; font-size:14px;color:red;"></span></td>
</tr>

<tr>
<td colspan="2" align="right"> <input type="submit" name="submit_per" value="Save" > </td>
</tr>

</table>

</form>
</div>
</div>

</p>

</div>
</div>         





<! -----------------------------------   Summary Detail    -------------------------------------- -->



<br>
<br>
<div class = "data_content">

<fieldset>
	
	<legend> <b>Summary</b> 
	<div class="edit">
		<ul>
			<li><a href="" class='click_edit_summary' id ="click_edit_summary"  onclick ="show()">Edit  </a></li>
		</ul>
		</div> </legend>


<form method="post">
<table align="left">



<tr>
	<td> <?php echo $summarydata[0]['summary']?> </td>
</tr>


</table>

</form>


</fieldset>

</div>
<! -----------------------------------  Edit Summary Detail    -------------------------------------- -->


<div class='popup_edit_summary'>
<div class='content'>
	
<img src='<?php echo base_url().'/ast/images/x.png'?>' style="border-radius:50%" alt='quit' class='x' id='x' />
<p>	

	<div class="form">
	<div class="form-header"><span class="popup_heading"><h3>Edit Summary</h3></span></div>
	<div class="form-data">


<form method="post" onsubmit="return summary()" action="<?php  echo site_url('dashboard/summary_update');  ?>" >
<table align="left">


<tr>
<td>Summary : </td>
&nbsp;&nbsp;
<td class = "tdd"><textarea rows="4" cols="50"  id="summary" name="summary"> <?php echo $summarydata[0]['summary']?> </textarea></td>
<td><span id="summaryError" style="display: none; font-size:14px;color:red;"></span></td>

</tr>

<tr>
<td colspan="4" align="right"><input type="submit" name="submit_summary" value="Save" > </td>
</tr>    
</table>

</form>

</div>
</div>

</p>

</div>
</div>         

<! -----------------------------------   Education Detail    -------------------------------------- -->

<br>
<br>
<div class = "data_content">

<fieldset>
	
	<legend><b> Education Detail </b>
	
	<div class="edit">
		<ul>
			<li><a href="" class='click_add_edu' >Add Education </a></li>
		</ul>
		</div> </legend>
	
<?php 

foreach ($edu_data as $row){
	
	$edu_id = $row['id'];
	
if($row['field_of_study']){
  $field_of_study = ','.$row['field_of_study'];
}else{
	  $field_of_study = '';
	
}

if($row['grade']){
$grade = ','.$row['grade'];	
}else{
	  $grade = '';
	
}
if($row['e_date']){
$e_date = '-'.$row['e_date'];	
}
else{
$e_date = '';	
}
?>
	<div class="edit">
		<ul>
			<li><a href=""class='click_edit_edu'<?php echo $edu_id?> >Edit <?php echo $row['id']?> </a></li>
			<div id = "<?php echo $edu_id?>"></div>
		</ul>
		</div> 
	
<form method="post">
<div class ="edu">

<table>
				
<tr>
	<td>
	<h4><b><?php echo $row['school']?></b></h4>
	</td>
</tr>

<tr>
	<td><?php echo $row['degree'] ; ?> <?php echo $field_of_study; ?> <?php echo $grade ;?> </td>

</tr>

<tr>
<td><?php echo $row['s_date']?><?php echo $e_date?></td>
</tr>


</table>

</div>
</form>

<?php
}
?>


</fieldset>
</div>
<! -----------------------------------   Edit Education Detail    -------------------------------------- -->


<div class='popup_edit_edu'>
<div class='content'>
<img src='<?php echo base_url().'/ast/images/x.png'?>' style="border-radius:50%" alt='quit' class='x' id='x' />
<p>	

	<div class="form">
	<div class="form-header"><span class="popup_heading"><h3>Edit Education <?php echo  $edu_data[0]['id']?></h3></span></div>
	<div class="form-data">


<form method="post" onsubmit="return education()" action="<?php  echo site_url('dashboard/edu_update');  ?>">
<table align="center">

<?php

				$where=array(
                        'id'=> $row['id']
							);
				
				$d['education'] = $this->user_model->get_sql_select_data('education', $where);
				//echo"<pre>";print_r($d);exit;
foreach ($edu_data as $row)
{
$id = $row['id'];	
/* $school =$row['school'];
$s_date =$row['s_date'];
$e_date =$row['id'];
$degree =$row['id'];
$field_of_study =$row['id'];
$grade =$row['id']; */

}
?>

<tr>
<td><b>College/School name  <span class="mandetory"> *</span></b></td>
</tr>

<tr>
<td><span id = "schoolError" style="display: none; font-size:14px;color:red;"></span></td>
</tr>

<tr>
<td><input type="text" class="txt_popup" name="school" id="school" placeholder="Institution name" value="<?php echo $edu_data[0]['school']?>"></td>
</tr>


<tr>
<td><b>Date Attended </b></td>
</tr>

<tr>
<td><span id="dates_attendedError" style="display: none; font-size:14px;color:red;"></span></td>
</tr>


<tr>
<td><select name="s_date" class = "popup_select"  value="<?php echo $edu_data[0]['s_date']?>">	
<option value =''> Year </option>

<?php 	$i=1900; $s_date=date("Y");
while($s_date>=$i)
	{ 
	?>
<option value="<?php echo $s_date; ?>">
<?php
		echo $s_date;$s_date--;
} ?>

</option>
</select>

To

<select name="e_date" class = "popup_select" value="<?php echo $edu_data[0]['e_date']?>">	
<option value =''> Year </option>

<?php 	$i=1900; $e_date=date("Y");
while($e_date>=$i)
	{ 
	?>
<option value="<?php echo $e_date; ?>">
<?php
		echo $e_date;$e_date--;
} ?>
</option>
</select> Or expected graduation year
</td>
</tr>


<tr>
<td><b>Degree/Board </b></td>
</tr>

<tr>
<td><span id = "degreeError" style="display: none; font-size:14px;color:red;"></span></td>
</tr>


<tr>
<td><input type="text" class="txt_popup"name="degree" id ="degree" placeholder="Degree" value="<?php echo $edu_data[0]['degree']?>"></td>
</tr>

<tr>
<td><b>Field Of study </b></td>
</tr>

<tr>
<td><span id = "field_of_studyError" style="display: none; font-size:14px;color:red;"></span></td>
</tr>


<tr>
<td><input type="text" class="txt_popup"id="field_of_study" name="field_of_study"  placeholder="field of study" value="<?php echo $edu_data[0]['field_of_study']?>"></td>
</tr>

<tr>
<td><b>Grade </b></td>
</tr>

<tr>
<td><input type="text" class="txt_popup" name="grade" value="<?php echo $edu_data[0]['grade']?>"></td>
</tr>

<!--
<tr>
<td><b>Description </b></td>
</tr>

<tr>
<td><textarea rows="4" cols="50" name="description_edu" > <?php echo $edu_data[0]['description']?> </textarea></td>
</tr>
-->

<tr>
<td class="button" align="center"><input type="submit" name="submit_edu" value="Save" >
 &nbsp;&nbsp;<a href="<?php echo site_url().'/dashboard/delete_edu/'.$id ?>"onclick  = "return Delete()"  >Remove this education </a>

 </td>
</tr>

</table>

</form>

</div>
</div>

</p>

</div>
</div>         



    <! -----------------------------------   Add Education Detail    -------------------------------------- -->


<?php
						
						
						// ---For Set value  ----
						
						if(set_value('school')){
							$school = set_value('school');
						}
						else{
							$school = '';
						}
												
						if(set_value('s_date')){
							$s_date = set_value('s_date');
						}
						else{
							$s_date = '';
						}
						if(set_value('e_date')){
							$e_date = set_value('e_date');
						}
						else{
							$e_date = '';
						}
												
						if(set_value('degree')){
							$degree = set_value('degree');
						}
						else{
							$degree = '';
						}
						
						if(set_value('field_of_study')){
							$field_of_study = set_value('field_of_study');
						}
						else{
							$field_of_study = '';
						}
						
						if(set_value('grade')){
							$grade = set_value('grade');
						}
						else{
							$grade = '';
						}
						
						if(set_value('description_edu')){
							$description_edu = set_value('description_edu');
						}
						else{
							$description_edu = '';
						}					
						
						?>




<div class='popup_add_edu'>
<div class='content'>
<img src='<?php echo base_url().'/ast/images/x.png'?>' style="border-radius:50%" alt='quit' class='x' id='x' />
<p>	

<div class="form">
	<div class="form-header"><span class="popup_heading"><h3>Add Education</h3></span></div>
	<div class="form-data">


<form method="post" onsubmit="return education_add()" action="<?php echo site_url('dashboard/edu_add'); ?>">
<table align="center">

<tr>
<td><b>College/School name  <span class="mandetory"> *</span></b></td>
</tr>

<tr>
<td><span id="school_addError" style="display: none; font-size:14px;color:red;"></span></td>
</tr>

<tr>
<td><input type="text" class="txt_popup"id ="school_add" name="school" placeholder="Institution name"  value="<?php echo $school?>"></td>
</tr>


<tr>
<td><b>Date Attended</b></td>
</tr>

<tr>
<td><span id="summaryError" style="display: none; font-size:14px;color:red;"></span></td>
</tr>


<tr>
<td> <select name="s_date" class = "popup_select" value="<?php echo $s_date?>">	
<option value =''> Year </option>

<?php 	$i=1900; $s_date=date("Y");
while($s_date>=$i)
	{ 
	?>
<option value="<?php echo $s_date; ?>">
<?php
		echo $s_date;$s_date--;
} ?>
</option>
</select>


 To 

<select name="e_date" class = "popup_select" value="<?php echo $e_date?>">	
<option value =''> Year </option>

<?php 	$i=1900; $e_date=date("Y");
while($e_date>=$i)
	{ 
	?>
<option value="<?php echo $e_date; ?>">
<?php
		echo $e_date;$e_date--;
} ?>
</option>
</select> Or expected graduation year
</td>
</tr>


<tr>
<td><b>Degree/Board </b></td>
</tr>

<tr>
<td><input type="text" class="txt_popup"name="degree"  placeholder="Degree" value="<?php echo $degree?>"></td>
</tr>

<tr>
<td><b>Field Of study</b></td>
</tr>

<tr>
<td><input type="text" class="txt_popup"name="field_of_study"  placeholder="field of study" value="<?php echo $field_of_study?>"></td>
</tr>

<tr>
<td><b>Grade</b></td>
</tr>

<tr>
<td><input type="text" class="txt_popup"name="grade" value="<?php echo $grade?>"></td>
</tr>

<!--
<tr>
<td><b>Description</b></td>
</tr>

<tr>
<td><textarea rows="4" cols="50" name="description_edu" value="<?php echo $description_edu?>"> </textarea></td>
</tr>   -->


<tr>
<br><td colspan="4" align="right"><input type="submit" name="submit_add_edu" value="Add" > </td>
</tr>

</table>

</form>

</div>
</div>

</p>

</div>
</div>         



<! -----------------------------------   Work Detail    -------------------------------------- -->

<br>
<br>

<div class = "data_content">

<fieldset>


<legend> <b>Experience</b>
	<div class="edit">
		<ul>
			<li><a href="" class='click_add_work' >Add Experience </a></li>
		</ul>
		</div> </legend>

<?php 

foreach ($work_data as $row){


?>

<?php
if($row['location']){
$location = '|'.$row['location'];	
}
else{
$location ='';	
}

if($row['to_month']){
$to_month = '-' .$row['to_month'];	
}
else{
$to_month ='';	
}

if($row['s_year']){
$s_year = $row['s_year'];	
}
else{
$s_year ='';	
}

if($row['e_year']){
$e_year = $row['e_year'];	
}
else{
$e_year = '';	
}
?>

<div class="edit">
		<ul>
			<li><a href="" class='click_edit_work' >Edit  </a></li>
		</ul>
		</div>

<form method="post">
	
<div class="Workexp">
	
<table>



<tr>
	<td><h4><b><?php echo $row['jobtitle']?></b></h4></td>
</tr>


<tr>
	<td>
	<?php echo $row['company_name']?>
	</td>
</tr>


<tr>
	<td>
	<?php echo $row['from_month']?>&nbsp;<?php echo $s_year?>&nbsp; <?php echo $to_month?>&nbsp;<?php echo $e_year?> &nbsp;<?php echo $location?>
	</td>
</tr>


<tr>
	<td class="tdd">
    <?php echo $row['description']?>
    </td>
</tr> 



</table>

</div>

</form>

<?php
}
?>

</fieldset>

</div>

<! -----------------------------------   Edit Work Detail    -------------------------------------- -->


<div class='popup_edit_work'>
<div class='content'>
	
<img src='<?php echo base_url().'/ast/images/x.png'?>' style="border-radius:50%" alt='quit' class='x' id='x' />
<p>

<div class="form">
	<div class="form-header"><span class="popup_heading"><h3>Experience </h3></span></div>
	<div class="form-data">


<form method="post" onsubmit="return work()" action="<?php echo site_url('dashboard/work_update'); ?>">
<table align="center">
<?php 

foreach ($work_data as $row)
{
	$id = $row['id'];
}
?>




<tr>
<td><b>Company Name  <span class="mandetory"> *</span></b></td>
</tr>

<tr>
<td><span id="company_nameError" style="display: none; font-size:14px;color:red;"></span></td>
</tr>

<tr>
<td><input type="text" class="txt_popup"name="company_name" id ="company_name" placeholder="Company name" value="<?php echo $work_data[0]['company_name']?>"></td>
</tr>


<tr>
<td><b>Job title  <span class="mandetory"> *</span></b></td>
</tr>

<tr>
<td><span id="jobtitleError" style="display: none; font-size:14px;color:red;"></span></td>
<tr>

<tr>
<td><input type="text" class="txt_popup"name="jobtitle" id="jobtitle" placeholder="Job Title" value="<?php echo $work_data[0]['jobtitle']?>"></td>
</tr>



<tr>
<td><b>Location</b></td>
</tr>

<tr>
<td><input type="text" class="txt_popup"name="location" placeholder="Job Location" value="<?php echo $work_data[0]['location']?>"></td>
</tr>

<tr>
<td><b>Time period  <span class="mandetory"> *</span></b></td>
</tr>

<tr>
<td><span id="s_yearError" style="display: none; font-size:14px;color:red;"></span>
<span id="e_yearError" style="display: none; font-size:14px;color:red;"></span></td>

</tr>


<tr>
<td>
<select name="from_month" class = "popup_select" value="<?php echo $from_month?>" >
<option value=''>Month</option>
<option value="January" <?php  if(set_value('from_month') == "January") {echo "selected";} ?> >January</option>
<option value="February" <?php  if(set_value('from_month') == "February") {echo "selected";} ?> >February</option>
<option value="March" <?php  if(set_value('from_month') == "March") {echo "selected";} ?> >March</option>
<option value="April" <?php  if(set_value('from_month') == "April") {echo "selected";} ?>>April</option>
<option value="May" <?php  if(set_value('from_month') == "May") {echo "selected";} ?>>May</option>
<option value="June" <?php  if(set_value('from_month') == "June") {echo "selected";} ?>>June</option>
<option value="July" <?php  if(set_value('from_month') == "July") {echo "selected";} ?>>July</option>
<option value="August" <?php  if(set_value('from_month') == "August") {echo "selected";} ?>>August</option>
<option value="September" <?php  if(set_value('from_month') == "September") {echo "selected";} ?>>September</option>
<option value="October" <?php  if(set_value('from_month') == "October") {echo "selected";} ?>>October</option>
<option value="November" <?php  if(set_value('from_month') == "November") {echo "selected";} ?>>November</option>
<option value="December" <?php  if(set_value('from_month') == "December") {echo "selected";} ?>>December</option>

</select> 
	
<select name="s_year" class = "popup_select" id = "s_year" value="<?php echo $work_data[0]['s_year']?>">	
<option value =''> Year </option>

<?php 	$i=1900; $s_year=date("Y");
while($s_year>=$i)
	{ 
	?>
<option value="<?php echo $s_year; ?>">
<?php
		echo $s_year;$s_year--;
} ?>
</option>
</select>

-

<select name="to_month" class = "popup_select" id="to_month" value="<?php echo $to_month?>" >
<option value=''>Month</option>
<option value="January" <?php  if(set_value('to_month') == "January") {echo "selected";} ?> >January</option>
<option value="February" <?php  if(set_value('to_month') == "February") {echo "selected";} ?> >February</option>
<option value="March" <?php  if(set_value('to_month') == "March") {echo "selected";} ?> >March</option>
<option value="April" <?php  if(set_value('to_month') == "April") {echo "selected";} ?>>April</option>
<option value="May" <?php  if(set_value('to_month') == "May") {echo "selected";} ?>>May</option>
<option value="June" <?php  if(set_value('to_month') == "June") {echo "selected";} ?>>June</option>
<option value="July" <?php  if(set_value('to_month') == "July") {echo "selected";} ?>>July</option>
<option value="August" <?php  if(set_value('to_month') == "August") {echo "selected";} ?>>August</option>
<option value="September" <?php  if(set_value('to_month') == "September") {echo "selected";} ?>>September</option>
<option value="October" <?php  if(set_value('to_month') == "October") {echo "selected";} ?>>October</option>
<option value="November" <?php  if(set_value('to_month') == "November") {echo "selected";} ?>>November</option>
<option value="December" <?php  if(set_value('to_month') == "December") {echo "selected";} ?>>December</option>

</select> 

<select name="e_year" class = "popup_select" id="e_year" value="<?php echo $work_data[0]['e_year']?>">	
<option value =''> Year </option>

<?php 	$i=1900; $e_year=date("Y");
while($e_year>=$i)
	{ 
	?>
<option value="<?php echo $e_year; ?>">
<?php
		echo $e_year;$e_year--;
} ?>
</option>
</select>

<label name ="label" id ="lbl_present" style ="display:none"> Present </label>
<input type ="hidden" name ="present" value ="Present" id = "present">

</td>

</tr>

<tr>
<td><input type = "checkbox"  name = "present_date" id ="presentdate" value ="" onclick="return check_work()">
 <label for="presentdate">Currently I'm working.</label>
<span id="present_dateError" style="display: none; font-size:14px;color:black;"></span></td>

</tr>


<tr>
<td><b>Description</b></td>
</tr>

<tr>
<td><textarea rows="4" cols="50" name="description_work"><?php echo $work_data[0]['description']?> </textarea></td>
</tr

<tr>
<td colspan="4" align="center"><input type="submit" name="submit_work" value="Save" >
 &nbsp;&nbsp;<a href="<?php echo site_url().'/dashboard/delete_work/'.$id?>" onclick="return Delete()">  Remove this work </a></td>
</tr>

</table>

</form>

</div>
</div>

</p>
</div>
</div>         


<! -----------------------------------  Add New Work -------------------------------------- -->


<?php
						
						
						// ---For Set value  ----
						
						if(set_value('company_name')){
							$company_name = set_value('company_name');
						}
						else{
							$company_name = '';
						}
												
						if(set_value('jobtitle')){
							$jobtitle = set_value('jobtitle');
						}
						else{
							$jobtitle = '';
						}
						if(set_value('location')){
							$location = set_value('location');
						}
						else{
							$location = '';
						}
												
						if(set_value('s_year')){
							$s_year = set_value('s_year');
						}
						else{
							$s_year = '';
						}
						
						if(set_value('e_year')){
							$e_year = set_value('e_year');
						}
						else{
							$e_year = '';
						}
						
						
						if(set_value('description_work')){
							$description_work = set_value('description_work');
						}
						else{
							$description_work = '';
						}					
						
						?>


<div class='popup_add_work'>
<div class='content'>
	
<img src='<?php echo base_url().'/ast/images/x.png'?>' style="border-radius:50%" alt='quit' class='x' id='x' />
<p>

<div class="form">
	<div class="form-header"><span class="popup_heading"><h3>Add New Experience</h3></span></div>
	<div class="form-data">

<form method="post" onsubmit ="return add_work()" action="<?php echo site_url('dashboard/work_add'); ?>">
<table align="center">

  <td><?php  if($this->session->flashdata('error_addwork'))   echo  $this->session->flashdata('error_addwork'); ?></td>

<tr>
<td><b>Company Name  <span class="mandetory"> *</span></b></td>
</tr>

<tr>
<td><span id="company_name_addError" style="display: none; font-size:14px;color:red;"></span></td>
</tr>

<tr>
<td><input type="text" class="txt_popup"name="company_name" id ="company_name_add" placeholder="Company name" value="<?php echo $company_name?>"></td>
</tr>


<tr>
<td><b>Job title  <span class="mandetory"> *</span></b></td>
</tr>

<tr>
<td><span id="jobtitle_addError" style="display: none; font-size:14px;color:red;"></span></td>
</tr>


<tr>
<td><input type="text" class="txt_popup"name="jobtitle" id="jobtitle_add" placeholder="Job Title" value="<?php echo $jobtitle?>"></td>
</tr>



<tr>
<td><b>Location</b></td>
</tr>

<tr>
<td><input type="text" class="txt_popup"name="location" placeholder="Job Location" value="<?php echo $location?>"></td>
</tr>

<tr>
<td><b>Time period  <span class="mandetory"> *</span></b></td>
</tr>

<tr>
<td><span id="add_s_yearError" style="display: none; font-size:14px;color:red;"></span>
<span id="add_e_yearError" style="display: none; font-size:14px;color:red;"></span>
</td>
</tr>


<tr>
<td>
<select name="from_month" class = "popup_select" value="<?php echo $from_month?>" >
<option value=''>Month</option>
<option value="January" <?php  if(set_value('from_month') == "January") {echo "selected";} ?> >January</option>
<option value="February" <?php  if(set_value('from_month') == "February") {echo "selected";} ?> >February</option>
<option value="March" <?php  if(set_value('from_month') == "March") {echo "selected";} ?> >March</option>
<option value="April" <?php  if(set_value('from_month') == "April") {echo "selected";} ?>>April</option>
<option value="May" <?php  if(set_value('from_month') == "May") {echo "selected";} ?>>May</option>
<option value="June" <?php  if(set_value('from_month') == "June") {echo "selected";} ?>>June</option>
<option value="July" <?php  if(set_value('from_month') == "July") {echo "selected";} ?>>July</option>
<option value="August" <?php  if(set_value('from_month') == "August") {echo "selected";} ?>>August</option>
<option value="September" <?php  if(set_value('from_month') == "September") {echo "selected";} ?>>September</option>
<option value="October" <?php  if(set_value('from_month') == "October") {echo "selected";} ?>>October</option>
<option value="November" <?php  if(set_value('from_month') == "November") {echo "selected";} ?>>November</option>
<option value="December" <?php  if(set_value('from_month') == "December") {echo "selected";} ?>>December</option>

</select> 
	
<select name="s_year" id = "add_s_year" class = "popup_select" value="<?php echo $work_data[0]['s_year']?>">	
<option value =''> Year </option>

<?php 	$i=1900; $s_year=date("Y");
while($s_year>=$i)
	{ 
	?>
<option value="<?php echo $s_year; ?>">
<?php
		echo $s_year;$s_year--;
} ?>
</option>
</select>

-
<span id="error_month" style="display: none; font-size:14px;color:black;"></span>


<select name="to_month" class = "popup_select" id="to_month" value="<?php echo $to_month?>" >
<option value=''>Month</option>
<option value="January" <?php  if(set_value('to_month') == "January") {echo "selected";} ?> >January</option>
<option value="February" <?php  if(set_value('to_month') == "February") {echo "selected";} ?> >February</option>
<option value="March" <?php  if(set_value('to_month') == "March") {echo "selected";} ?> >March</option>
<option value="April" <?php  if(set_value('to_month') == "April") {echo "selected";} ?>>April</option>
<option value="May" <?php  if(set_value('to_month') == "May") {echo "selected";} ?>>May</option>
<option value="June" <?php  if(set_value('to_month') == "June") {echo "selected";} ?>>June</option>
<option value="July" <?php  if(set_value('to_month') == "July") {echo "selected";} ?>>July</option>
<option value="August" <?php  if(set_value('to_month') == "August") {echo "selected";} ?>>August</option>
<option value="September" <?php  if(set_value('to_month') == "September") {echo "selected";} ?>>September</option>
<option value="October" <?php  if(set_value('to_month') == "October") {echo "selected";} ?>>October</option>
<option value="November" <?php  if(set_value('to_month') == "November") {echo "selected";} ?>>November</option>
<option value="December" <?php  if(set_value('to_month') == "December") {echo "selected";} ?>>December</option>

</select> 

<select name="e_year" id="add_e_year" class = "popup_select" value="<?php echo $work_data[0]['e_year']?>">	
<option value =''> Year </option>

<?php 	$i=1900; $e_year=date("Y");
while($e_year>=$i)
	{ 
	?>
<option value="<?php echo $e_year; ?>">
<?php
		echo $e_year;$e_year--;
} ?>
</option>
</select>


<td>
<label name ="label" id ="lbl_present" style ="display:none"> Present </label>
<input type ="hidden" name ="present" value ="Present" id = "present">

</td>

</tr>

<tr>
<td><input type = "checkbox"  name = "present_date" id ="presentdate" onclick="return check_work()">
 <label for="presentdate_">Currently I'm working.</label><span id="present_dateError" style="display: none; font-size:14px;color:black;"></span></td>

</tr>


<tr>
<td><b>Description</b></td>
</tr>

<tr>
<td><textarea rows="4" cols="50" name="description_work" value="<?php echo $description_work?>"> </textarea></td>
</tr>  

<tr>
<td colspan="4" align="right"><input type="submit" name="submit_add_work" value="Add" > </td>
</tr>

</table>

</form>

</div>
</div>

</p>
</div>
</div>         


<! -----------------------------------  Skill Detail    -------------------------------------- -->


<br>
<br>

<div class = "data_content">

<fieldset>
	
	
	<legend> <b>Skill </b>
	<div class="edit">
		<ul>
			<li><a href="" class='click_edit_skill' >Edit  </a></li>
		</ul>
		</div> </legend>

	
<form method="post">
<table align="left">



<tr>
	<td>
	<h5><?php echo $skill_data[0]['skill']?></h5>
	</td>
</tr>



</table>

</form>
</fieldset>

</div>

<! -----------------------------------  Edit Skills Detail    -------------------------------------- -->

<div class='popup_edit_skill'>
<div class='content'>
<img src='<?php echo base_url().'/ast/images/x.png'?>' style="border-radius:50%" alt='quit' class='x' id='x' />
<p>

<div class="form">
	<div class="form-header"><span class="popup_heading"><h3>Edit Skills</h3></span></div>
	<div class="form-data">


 <textarea id="textarea" class="example" rows="1"></textarea>

<div style="margin-top: 20px">
	<input type="text" id="tagname" placeholder="tag name" />
	<button id="addtag" class="btn">Click to add tag</button>
	
</div>
<input type="submit"  name="submit_edit_skill" value="Save" > 


</div>
</div>

</p>

</div>
</div>
<! -----------------------------------  Edit Skills Detail    -------------------------------------- -->
<!--
<div class='popup_edit_skill'>
<div class='content'>
<img src='<?php echo base_url().'/ast/images/x.png'?>' style="border-radius:50%" alt='quit' class='x' id='x' />
<p>

<div class="form">
	<div class="form-header"><span class="popup_heading"><h3>Edit Skills</h3></span></div>
	<div class="form-data">

<form method="post" action="<?php echo site_url('dashboard/skill_update'); ?>">
<table align="left">


<tr>
<td>Skills :-</td>

<td><input type="text" class="txt_popup"name="skill" placeholder="Ex:-PHP,html etc." value="<?php echo $skill_data[0]['skill']?>"></td>
</tr>

<tr>
<td colspan="4" align="right"><input type="submit" name="submit_edit_skill" value="Save" > </td>
</tr>


</table>

</form>
</div>
</div>

</p>

</div>
</div>
 -->

<! -----------------------------------  Certification Detail    -------------------------------------- -->

<br>
<br>
<div class = "data_content">

<fieldset>	
	
	<legend> <b> Certifications </b>
	<div class="edit">
		<ul>
			<li><a href="" class='click_add_certificate' >Add Certification </a></li>
		</ul>
		</div> </legend>
		
<section>
<?php 

foreach ($cert_data as $row){
	
$id = $row['id'];
?>

<?php

if($row['license_number']){
$license_number =', License :'.$row['license_number'];
	
}
else
{
	$license_number = '';
}	

if($row['s_date']){
$s_date =$row['s_date'];	
}
else{
$s_date = '';	
}

if($row['to_month']){
	
$to_month = '-'.$row['to_month'];	
}
else{
$to_month = '';	
}
if($row['e_date']){
$e_date = $row['e_date'];	
}
else{
$e_date ='';	
}

?>
	<div class="edit">
		<ul>
			<li><a href="" class='click_edit_certificate' >Edit  </a></li>
		</ul>
		</div>

	
<form method="post">
<div class="certificates">
	<table>
		<tr>
			<td><h4><b> <?php echo $row['cert_name']?> </b></h4></td>
		</tr>
		<tr>
			<td>
			<?php echo $row['cert_authority']?><?php echo $license_number?>
			</td>
		</tr>
		<tr>
			<td>
		<?php echo $row['from_month']?>&nbsp; <?php echo $s_date?> &nbsp; <?php echo $to_month?> &nbsp;<?php echo $e_date?>
			</td>
		</tr>
	</table>
	
</div>
</form>



<?php 
}
?>
</section>

</fieldset>
</div>


<! -----------------------------------Edit Certification Detail    -------------------------------------- -->

<div class='popup_edit_certificate'>
<div class='content'>
<img src='<?php echo base_url().'/ast/images/x.png'?>' style="border-radius:50%" alt='quit' class='x' id='x' />
<p>

<div class="form">
	<div class="form-header"><span class="popup_heading"><h3>Edit Certification</h3></span></div>
	<div class="form-data">


<form method="post" onsubmit="return Certification()" action="<?php echo site_url('dashboard/cert_update'); ?>">
<table align="center">

<?php
foreach ($cert_data as $row)
{
	$id = $row['id'];
}
?>


<tr>
<td><b>Certification Name  <span class="mandetory"> *</span></b></td>
</tr>

<tr>
<td><span id="cert_nameError" style="display: none; font-size:14px;color:red;"></span></td>
</tr>

<tr>
<td><input type="text" class="txt_popup" name="cert_name" id="cert_name" placeholder="Certification Name" value="<?php echo $cert_data[0]['cert_name']?>"></td>

</tr>

<tr>
<td><b>Certification Authority </b></td>
</tr>

<tr>
<td><input type="text" class="txt_popup"name="cert_authority" placeholder="Authority name" value="<?php echo $cert_data[0]['cert_authority']?>"></td>
</tr>

<tr>
<td><b>License Number </b></td>
</tr>

<tr>
<td><input type="text" class="txt_popup"name="license_number" placeholder="License number" value="<?php echo $cert_data[0]['license_number']?>"></td>
</tr>
<!--
<tr>
<td><b>Certification URL</b> </td>
</tr>

<tr>
<td><input type="text" class="txt_popup"name="cert_url" placeholder="Certification URL" value="<?php echo $cert_data[0]['cert_url']?>">	
</td>
</tr>  -->

<tr>
<td><b>Dates </b></td>
</tr>

<tr>
<td>
<span id="cert_edit_s_dateError" style="display: none; font-size:14px;color:red;"></span>
<span id="cert_edit_e_dateError" style="display: none; font-size:14px;color:red;"></span>

</td>
</tr>

<tr>
<td>

<select name="from_month" class = "popup_select" id ="from_date" value="<?php echo $from_month?>" >
<option value=''>Month</option>
<option value="January" <?php  if(set_value('from_month') == "January") {echo "selected";} ?> >January</option>
<option value="February" <?php  if(set_value('from_month') == "February") {echo "selected";} ?> >February</option>
<option value="March" <?php  if(set_value('from_month') == "March") {echo "selected";} ?> >March</option>
<option value="April" <?php  if(set_value('from_month') == "April") {echo "selected";} ?>>April</option>
<option value="May" <?php  if(set_value('from_month') == "May") {echo "selected";} ?>>May</option>
<option value="June" <?php  if(set_value('from_month') == "June") {echo "selected";} ?>>June</option>
<option value="July" <?php  if(set_value('from_month') == "July") {echo "selected";} ?>>July</option>
<option value="August" <?php  if(set_value('from_month') == "August") {echo "selected";} ?>>August</option>
<option value="September" <?php  if(set_value('from_month') == "September") {echo "selected";} ?>>September</option>
<option value="October" <?php  if(set_value('from_month') == "October") {echo "selected";} ?>>October</option>
<option value="November" <?php  if(set_value('from_month') == "November") {echo "selected";} ?>>November</option>
<option value="December" <?php  if(set_value('from_month') == "December") {echo "selected";} ?>>December</option>

</select> 


<select name="s_date" class = "popup_select" id = "cert_edit_s_date" value="<?php echo $cert_data[0]['s_date']?>">	
<option value =''> Year </option>

<?php 	$i=1900; $s_date=date("Y");
while($s_date>=$i)
	{ 
	?>
<option value="<?php echo $s_date; ?>">
<?php
		echo $s_date;$s_date--;
} ?>
</option>
</select>



 - 

<select name="to_month" class = "popup_select" id ="month" value="<?php echo $to_month?>" >
<option value=''>Month</option>
<option value="January" <?php  if(set_value('to_month') == "January") {echo "selected";} ?> >January</option>
<option value="February" <?php  if(set_value('to_month') == "February") {echo "selected";} ?> >February</option>
<option value="March" <?php  if(set_value('to_month') == "March") {echo "selected";} ?> >March</option>
<option value="April" <?php  if(set_value('to_month') == "April") {echo "selected";} ?>>April</option>
<option value="May" <?php  if(set_value('to_month') == "May") {echo "selected";} ?>>May</option>
<option value="June" <?php  if(set_value('to_month') == "June") {echo "selected";} ?>>June</option>
<option value="July" <?php  if(set_value('to_month') == "July") {echo "selected";} ?>>July</option>
<option value="August" <?php  if(set_value('to_month') == "August") {echo "selected";} ?>>August</option>
<option value="September" <?php  if(set_value('to_month') == "September") {echo "selected";} ?>>September</option>
<option value="October" <?php  if(set_value('to_month') == "October") {echo "selected";} ?>>October</option>
<option value="November" <?php  if(set_value('to_month') == "November") {echo "selected";} ?>>November</option>
<option value="December" <?php  if(set_value('to_month') == "December") {echo "selected";} ?>>December</option>

</select> 


<select name="e_date" class = "popup_select" id = "cert_edit_e_date" value="<?php echo $cert_data[0]['e_date']?>">	
<option value =''> Year </option>

<?php 	$i=1900; $e_date=date("Y");
while($e_date>=$i)
	{ 
	?>
<option value="<?php echo $e_date; ?>">
<?php
		echo $e_date;$e_date--;
} ?>
</option>
</select>

<label name ="label" id ="lbel_present" style = "display:none"> Present </label>


</td> 

</tr>

<tr>
<td>
<input type ="hidden" name ="checkbox_date" id ="checkbox_date" value ="<?php if(isset($_POST['present_date'])){echo "present";}else{echo"";} ?>"	>
<input type = "checkbox"  name = "present_date" id ="present_date" value = "<?php if(isset($_POST['present_date'])){echo "present";}else{echo"";} ?>" onclick="return check()"> 
<label for="presentdate">This certificate does not expire.</label>
<span id="present_dateError" style="display: none; font-size:14px;color:black;"></span>
</td>

</tr>

<tr>
<td colspan="4" align="center"><input type="submit" name="submit_edit_cert" value="Save" >
 &nbsp;&nbsp;<a href="<?php echo site_url().'/dashboard/delete_cert/'.$id?>" onclick=" return Delete()" >Remove this certification </a></td>
</tr>

</table>

</div>
</div>

</form>

</p>
</div>
</div>



<! -----------------------------------Add New Certification   -------------------------------------- -->

<?php
						
						
						// ---For Set value  ----
						
						if(set_value('cert_name')){
							$cert_name = set_value('cert_name');
						}
						else{
							$cert_name = '';
						}
												
						if(set_value('cert_authority')){
							$cert_authority = set_value('cert_authority');
						}
						else{
							$cert_authority = '';
						}
						if(set_value('license_number')){
							$license_number = set_value('license_number');
						}
						else{
							$license_number = '';
						}
												
						if(set_value('cert_url')){
							$cert_url = set_value('cert_url');
						}
						else{
							$cert_url = '';
						}
						
						if(set_value('date')){
							$date = set_value('date');
						}
						else{
							$date = '';
						}
						
												
						?>



<div class='popup_add_certificate'>
<div class='content'>
<img src='<?php echo base_url().'/ast/images/x.png'?>' style="border-radius:50%" alt='quit' class='x' id='x' />
<p>

<div class="form">
	<div class="form-header"><span class="popup_heading"><h3>Add New Certification</h3></span></div>
	<div class="form-data">

<form method="post" onsubmit="return add_Certification()" action="<?php echo site_url('dashboard/cert_add'); ?>">
<table align="center">


<tr>
<td><b>Certification Name <span class="mandetory"> *</span></b></td>
</tr>

<tr>
<td><span id="certadd_nameError" style="display: none; font-size:14px;color:red;"></span></td>
</tr>

<tr>
<td><input type="text" class="txt_popup"name="cert_name" id="certadd_name" placeholder="Certification Name" value="<?php echo $cert_name?>"></td>
</tr>


<tr>
<td><b>Certification Authority  </b></td>
</tr>

<tr>
<td><input type="text" class="txt_popup"name="cert_authority" placeholder="Authority name" value="<?php echo $cert_authority?>"></td>
</tr>

<tr>
<td><b>License Number </b></td>
</tr>

<tr>
<td><input type="text" class="txt_popup"name="license_number" placeholder="License number" value="<?php echo $license_number?>"></td>
</tr>
<!--
<tr>
<td><b>Certification URL </b></td>
</tr>

<tr>
<td><input type="text" class="txt_popup"name="cert_url" placeholder="Certification URL" value="<?php echo $cert_url?>"></td>
</tr>    -->
 
<tr>
<td>Dates <span class="mandetory"> *</span></td>
</tr>

<tr>
<td>
<span id="cert_add_s_dateError" style="display: none; font-size:14px;color:red;"></span>
<span id="cert_add_e_dateError" style="display: none; font-size:14px;color:red;"></span>

</td>
</tr>

<tr>
<td>
<select name="from_month" class = "popup_select" id ="from_date" value="<?php echo $from_month?>" >
<option value=''>Month</option>
<option value="January" <?php  if(set_value('from_month') == "January") {echo "selected";} ?> >January</option>
<option value="February" <?php  if(set_value('from_month') == "February") {echo "selected";} ?> >February</option>
<option value="March" <?php  if(set_value('from_month') == "March") {echo "selected";} ?> >March</option>
<option value="April" <?php  if(set_value('from_month') == "April") {echo "selected";} ?>>April</option>
<option value="May" <?php  if(set_value('from_month') == "May") {echo "selected";} ?>>May</option>
<option value="June" <?php  if(set_value('from_month') == "June") {echo "selected";} ?>>June</option>
<option value="July" <?php  if(set_value('from_month') == "July") {echo "selected";} ?>>July</option>
<option value="August" <?php  if(set_value('from_month') == "August") {echo "selected";} ?>>August</option>
<option value="September" <?php  if(set_value('from_month') == "September") {echo "selected";} ?>>September</option>
<option value="October" <?php  if(set_value('from_month') == "October") {echo "selected";} ?>>October</option>
<option value="November" <?php  if(set_value('from_month') == "November") {echo "selected";} ?>>November</option>
<option value="December" <?php  if(set_value('from_month') == "December") {echo "selected";} ?>>December</option>

</select> 

<select name="s_date" class = "popup_select" id = "cert_add_s_date" value="<?php echo $cert_data[0]['s_date']?>">	
<option value =''> Year </option>

<?php 	$i=1900; $s_date=date("Y");
while($s_date>=$i)
	{ 
	?>
<option value="<?php echo $s_date; ?>">
<?php
		echo $s_date;$s_date--;
} ?>
</option>
</select>


 -
	
<select name="to_month" class = "popup_select" id ="month" value="<?php echo $to_month?>" >
<option value=''>Month</option>
<option value="January" <?php  if(set_value('to_month') == "January") {echo "selected";} ?> >January</option>
<option value="February" <?php  if(set_value('to_month') == "February") {echo "selected";} ?> >February</option>
<option value="March" <?php  if(set_value('to_month') == "March") {echo "selected";} ?> >March</option>
<option value="April" <?php  if(set_value('to_month') == "April") {echo "selected";} ?>>April</option>
<option value="May" <?php  if(set_value('to_month') == "May") {echo "selected";} ?>>May</option>
<option value="June" <?php  if(set_value('to_month') == "June") {echo "selected";} ?>>June</option>
<option value="July" <?php  if(set_value('to_month') == "July") {echo "selected";} ?>>July</option>
<option value="August" <?php  if(set_value('to_month') == "August") {echo "selected";} ?>>August</option>
<option value="September" <?php  if(set_value('to_month') == "September") {echo "selected";} ?>>September</option>
<option value="October" <?php  if(set_value('to_month') == "October") {echo "selected";} ?>>October</option>
<option value="November" <?php  if(set_value('to_month') == "November") {echo "selected";} ?>>November</option>
<option value="December" <?php  if(set_value('to_month') == "December") {echo "selected";} ?>>December</option>

</select> 
	
<select name="e_date" class = "popup_select" id = "cert_add_e_date" value="<?php echo $cert_data[0]['e_date']?>">	
<option value =''> Year </option>

<?php 	$i=1900; $e_date=date("Y");
while($e_date>=$i)
	{ 
	?>
<option value="<?php echo $e_date; ?>">
<?php
		echo $e_date;$e_date--;
} ?>
</option>
</select>

</td>
</tr>

<tr>
<td><input type = "checkbox"  name = "present_date" id ="present_date" value ="" onclick="return check()"> 
<label for="presentdate">This certificate does not expire.</label>
<span id="present_dateError" style="display: none; font-size:14px;color:black;"></span>
</td>

</tr>

<tr>
<td colspan="4" align="right"><input type="submit" name="submit_add_cert" value="Add" > </td>
</tr>

</table>

</div>
</div>

</form>

</p>
</div>
</div>

</fieldset>

</div>
</div>    

<?php
$this->load->view('includes/footer_session');
?>
