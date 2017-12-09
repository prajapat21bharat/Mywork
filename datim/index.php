<!DOCTYPE html>
<html>
	<head>
		<title>Datim | Support Registration</title>
		<script src="js/jquery-1.9.1.js"></script>
		<script src="js/jquery.validate.min.js"></script>
		<script src="js/validation.js"></script>
		<link rel="stylesheet" href="css/styles.css">
	</head>
	<body>
		<div class="registration-form">
			<div class="header">
				<img src="image/logo.png">
				<h3>NEW USER REQUEST FORM</h3>
			</div>
			<form id="registrration-form" method="post">
				<span class="success-msg" align="center">Registration Successfull</span>
				<p id="heading">Please enter your details below to request a user account on DATIM.</p>
				<table>
					<tr>
						<td>
							First Name<span class="mandetory error">*</span>
						</td>
					</tr>
					<tr>
						<td>
							<input type="text" name="firstname" id="firstname" class="input-text" />
						</td>
					</tr>
					
					<tr>
						<td>
							Last Name<span class="mandetory error">*</span>
						</td>
					</tr>
					<tr>
						<td>
							<input type="text" name="lastname" id="lastname" class="input-text" />
						</td>
					</tr>
					
					<tr>
						<td>
							Email Address<span class="mandetory error">*</span>
						</td>
					</tr>
					<tr>
						<td>
							<input type="text" name="email" id="email" class="input-text" />
						</td>
					</tr>
					
					<tr>
						<td>
							Country<span class="mandetory error">*</span>
						</td>
					</tr>
					<tr>
						<td>
							<select class="input-select" id="country" name="country">
																<option value="">Select Country</option>
								<option value="United States (HQ)">United&nbsp;States&nbsp;(HQ)</option>
								<option value="Angola">Angola</option>
								<option value="Asia Regional Program">Asia&nbsp;Regional&nbsp;Program</option>
								<option value="Botswana">Botswana</option>
								<option value="Burundi">Burundi</option>
								<option value="Cambodia">Cambodia</option>
								<option value="Cameroon">Cameroon</option>
								<option value="Caribbean Regional">Caribbean&nbsp;Regional</option>
								<option value="Central America Regional">Central&nbsp;America&nbsp;Regional</option>
								<option value="Central Asia Region">Central&nbsp;Asia&nbsp;Region</option>
								<option value="Côte d'Ivoire">Côte&nbsp;d'Ivoire</option>
								<option value="Dem. Rep. of Congo">Dem.&nbsp;Rep.&nbsp;of&nbsp;Congo</option>
								<option value="Dominican Republic">Dominican&nbsp;Republic</option>
								<option value="Ethiopia">Ethiopia</option>
								<option value="Ghana">Ghana</option>
								<option value="Guyana">Guyana</option>
								<option value="Haiti">Haiti</option>
								<option value="India">India</option>
								<option value="Indonesia">Indonesia</option>
								<option value="Kenya">Kenya</option>
								<option value="Lesotho">Lesotho</option>
								<option value="Malawi">Malawi</option>
								<option value="Mozambique">Mozambique</option>
								<option value="Namibia">Namibia</option>
								<option value="Nigeria">Nigeria</option>
								<option value="Papua New Guinea">Papua&nbsp;New&nbsp;Guinea</option>
								<option value="Rwanda">Rwanda</option>
								<option value="South Africa">South&nbsp;Africa</option>
								<option value="South Sudan">South&nbsp;Sudan</option>
								<option value="Swaziland">Swaziland</option>
								<option value="Tanzania">Tanzania</option>
								<option value="Uganda">Uganda</option>
								<option value="Ukraine">Ukraine</option>
								<option value="Vietnam">Vietnam</option>
								<option value="Zambia">Zambia</option>
								<option value="Zimbabwe">Zimbabwe</option>
								<option>Other</option>
							</select>
						</td>
					</tr>
					
					<tr>
						<td>
							Participating Organization (USG or IP)<span class="mandetory error">*</span>
						</td>
					</tr>
					<tr>
						<td>
							<select class="input-select" id="participating-org" name="participating_org">
								<option value="">Select Organization</option>
								<option value="PEPFAR Coordinators Office">PEPFAR&nbsp;Coordinator's&nbsp;Office</option>
								<option value="CDC">CDC</option>
								<option value="Census">Census</option>
								<option value="DoD">DoD</option>
								<option value="HRSA">HRSA</option>
								<option value="NIH">NIH</option>
								<option value="OGHA/OGA">OGHA/OGA</option>
								<option value="Peace Corps">Peace&nbsp;Corps</option>
								<option value="State/AF">State/AF</option>
								<option value="USAID">USAID</option>
								<option value="Implementing Partner">Implementing&nbsp;Partner</option>
							</select>
						</td>
					</tr>
					
					<tr class="implementing-partner-hide">
						<td>
							Implementing Partner Name:<span class="mandetory error">*</span>
						</td>
					</tr>
					<tr class="implementing-partner-hide">
						<td>
							<input type="text" name="implementing_partner" id="implementing_partner" class="input-text" />
						</td>
					</tr>
					
					<tr>
						<td>
							Preferred Language<span class="mandetory error">*</span>
						</td>
					</tr>
					<tr>
						<td>
							<select class="input-select" id="language" name="language">
								<option value="">Select Language</option>
								<option value="Arabic">Arabic</option>
								<option value="Bengali">Bengali</option>
								<option value="Bislama">Bislama</option>
								<option value="Burmese">Burmese</option>
								<option value="Chinese">Chinese</option>
								<option value="Dzongkha">Dzongkha</option>
								<option value="English">English</option>
								<option value="French">French</option>
								<option value="Indonesian">Indonesian</option>
								<option value="Khmer">Khmer</option>
								<option value="Kinyarwanda">Kinyarwanda</option>
								<option value="Lao">Lao</option>
								<option value="Nepali">Nepali</option>
								<option value="Portuguese">Portuguese</option>
								<option value="Russian">Russian</option>
								<option value="Spanish">Spanish</option>
								<option value="Tajik">Tajik</option>
								<option value="Vietnamese">Vietnamese</option>
							</select>
						</td>
					</tr>
					
					<tr>
						<td>
							Data stream(s) you need access to:<span class="mandetory error">*</span>
						</td>
					</tr>
					<tr>
						<td>
							<ul class="data-stream-list">
								<li><input type="checkbox" name="data_stream[]" class="input-checkbox one_required" id="data-stream-mer" value="MER" />
								<label name="data_stream" for="data-stream-mer">MER</label></li>
								<li>
									<input type="checkbox" name="data_stream[]" class="input-checkbox one_required" id="data-stream-sims" value="SIMS" />
									<label name="data_stream" for="data-stream-sims">SIMS</label>
								</li>
							</ul>							
						</td>
					</tr>
					
					<tr>
						<td>
							Access Type<span class="mandetory error">*</span>
						</td>
					</tr>
					<tr>
						<td>
							<ul class="data-access-type-list">
								<li>
									<input type="checkbox" class="input-checkbox one_required" id="access-type-sims" name="access_type[]" value="Data Entry SIMS" />
									<label for="access-type-sims">Data Entry SIMS</label>								
								</li>
							
								<li>
									<input type="checkbox" class="input-checkbox one_required" id="access-type-mer" name="access_type[]" value="Data Entry MER" />
									<label for="access-type-mer">Data Entry MER</label>
								</li>
						
								<li>
									<input type="checkbox" class="input-checkbox one_required" id="access-type-accept-data" name="access_type[]" value="Accept Data" />
									<label for="access-type-accept-data">Accept Data</label>
								</li>
							
								<li>
									<input type="checkbox" class="input-checkbox one_required" id="access-type-submit-data" name="access_type[]" value="Submit Data" />
									<label for="access-type-submit-data">Submit Data</label>
								</li>
							
								<li>
									<input type="checkbox" class="input-checkbox one_required" id="access-type-read-data" name="access_type[]" value="Read Data" />
									<label for="access-type-read-data">Read Data</label>
								</li>
							</ul>							
						</td>
					</tr>
					
					<tr>
						<td>
							<label for="acc-someone-else">Are you requesting this account on behalf of someone else?</label>
						</td>
					</tr>
					<tr>
						<td>
							<ul class="account-behalf-list">
								<li>
									<input type="radio" name="account" id="account-yes" class="input-radio account-behalf " value="1" /><label for="account-yes">Yes</label>
								</li>
								<li>
									<input type="radio" name="account" id="account-no" class="input-radio account-behalf" value="0" /><label for="account-no">No</label>
								</li>
							</ul>
						</td>
					</tr>
					
					<tr class="conditional-hide">
						<td>
							Account Requestor Full Name<span class="mandetory error">*</span>
						</td>
					</tr>
					<tr class="conditional-hide">
						<td>
							<input type="text" name="acc_full_name" id="acc-full-name" class="input-text" />
						</td>
					</tr>
					
					<tr class="conditional-hide">
						<td>
							Account Requestor E-mail Address<span class="mandetory error">*</span>
						</td>
					</tr>
					<tr class="conditional-hide">
						<td>
							<input type="text" name="acc_email" id="acc-email" class="input-text" />
						</td>
					</tr>
					
					<tr class="conditional-hide">
						<td>
							Account Requestor Organization<span class="mandetory error">*</span>
						</td>
					</tr>
					<tr class="conditional-hide">
						<td>
							<input type="text" name="acc_org" id="acc-org" class="input-text" />
						</td>
					</tr>
					<tr>
						<td>
							Justification for request<span class="mandetory error">*</span>
						</td>
					</tr>
					<tr>
						<td>
							<input type="text" name="justification" id="justification" class="input-text" />
						</td>
					</tr>
				</table>
				<div class="form-bottom"><input type="submit" name="submit"  value="Submit" class="input-submit" id="submit" /></div>
			</form>
		</div>
		<?php
		
			@$con=	mysql_connect("localhost","root","");
					mysql_select_db("datim_support_db",$con);
		?>
		<?php 
			if(isset($_POST["submit"]))
			{
				$firstname=$_POST['firstname'];
				$lastname=$_POST['lastname'];
				$email=$_POST['email'];
				$country=$_POST['country'];
				$participating_org=$_POST['participating_org'];
				if($participating_org=="Implementing Partner")
				{
					//echo"yes";
					$implementing_partner=$_POST['implementing_partner'];
				}
				else
				{
					//echo"no";
					$implementing_partner="";
				}
				$language=$_POST['language'];
				//$data_stream=$_POST['data_stream'];
				@$all_data_stream = implode(",",$_POST['data_stream']);
				@$all_access_type= implode(",",$_POST['access_type']);
				$account_behalf=$_POST['account'];
				if($account_behalf==1)
				{
					$acc_full_name=$_POST['acc_full_name'];
					$acc_email=$_POST['acc_email'];
					$acc_org=$_POST['acc_org'];
				}
				else
				{
					$acc_full_name="";
					$acc_email="";
					$acc_org="";
				}
				$justification=$_POST['justification'];
				$sql1="SELECT * FROM `registration` where email='$email'";
				$result1=mysql_query($sql1);
				if($result1)
				{
					if(mysql_num_rows($result1)<=0)
					{
						$sql="INSERT INTO `registration`(`firstname`, `lastname`, `email`, `country`, `participating_org`, `implementing_partner`, `language`, `data_stream`, `access_type`, `acc_full_name`, `acc_email`, `acc_org`, `justification`) VALUES (trim('$firstname'), trim('$lastname'), trim('$email'), '$country', '$participating_org', '$implementing_partner', '$language', '$all_data_stream', '$all_access_type', '$acc_full_name', '$acc_email', '$acc_org', trim('$justification') )";
						//echo $sql;exit;
						$result=mysql_query($sql);
						if(($result) or die(mysql_error()))
						{
							if($participating_org=="Implementing Partner")
							{
								$select="SELECT * FROM `email_country` where pid='11' and country='$country'";
								//echo $select;exit;
								$result_=mysql_query($select);
								if($result_)
								{
									while($data=mysql_fetch_array($result_))
									{								
										echo $data['email'];
										$to=$data['email'];
										$from = 'Datim Support <stengesdal@gmail.com>';
										$subject="User Registration on DATIM";
										$message="<p>The following user has requested access to DATIM. <br> Please review their details below and setup an account using the User Management App if the user is authorized to access DATIM. <br> If there are questions or clarifications needed from the user, please contact them directly. <br> Responding to this email will not be possible and questions should be routed through the DATIM Help Desk by clicking on Apps, then DATIM Support from within DATIM</p>";
										$message.="Firstname : ".$firstname." Lastname : ".$lastname."<br/>";
										$message.="Email : ".$email."<br/>";
										$message.="Country :".$country."<br/>";
										$message.="Participating Organization :".$participating_org."<br/>";
										$message.="Implementing Partner Name :".$implementing_partner."<br/>";
										$message.="Language :".$language."<br/>";
										$message.="Data stream :".$all_data_stream."<br/>";
										$message.="Access Type :".$all_access_type."<br/>";
										$message.="Account Requestor Full Name :".$acc_full_name."<br/>";
										$message.="Account Requestor E-mail Address :".$acc_email."<br/>";
										$message.="Account Requestor Organization :".$acc_org."<br/>";
										$message.="Justification for request :".$justification."<br/>";
										$message.="Thanks & Regards<br/>".$from;
										
										$headers = "MIME-Version: 1.0\r\n";
										$headers.= "Content-type: text/html; charset=iso-8859-1\r\n";
										$headers.= "From: $from\r\n";

										mail($to,$subject,$message,$headers);
										echo "<script type='text/javascript'> document.location='success.php';</script>";
										
									}
								}
							}
							else
							{
								$select="SELECT * FROM `email_partner` where partnername='$participating_org'";
								//echo $select;exit;
								$result_=mysql_query($select);
								if($result_)
								{
									while($data=mysql_fetch_array($result_))
									{								
										echo $data['email'];
										$to=$data['email'];
										$from = 'Datim Support <stengesdal@gmail.com>';
										$subject="User Registration on DATIM";
										$message="<p>The following user has requested access to DATIM. <br> Please review their details below and setup an account using the User Management App if the user is authorized to access DATIM. <br> If there are questions or clarifications needed from the user, please contact them directly. <br> Responding to this email will not be possible and questions should be routed through the DATIM Help Desk by clicking on Apps, then DATIM Support from within DATIM</p>";
										$message.="Firstname : ".$firstname." Lastname : ".$lastname."<br/>";
										$message.="Email : ".$email."<br/>";
										$message.="Country :".$country."<br/>";
										$message.="Participating Organization :".$participating_org."<br/>";
										$message.="Implementing Partner Name :".$implementing_partner."<br/>";
										$message.="Language :".$language."<br/>";
										$message.="Data stream :".$all_data_stream."<br/>";
										$message.="Access Type :".$all_access_type."<br/>";
										$message.="Account Requestor Full Name :".$acc_full_name."<br/>";
										$message.="Account Requestor E-mail Address :".$acc_email."<br/>";
										$message.="Account Requestor Organization :".$acc_org."<br/>";
										$message.="Justification for request :".$justification."<br/>";
										$message.="Thanks & Regards<br/>".$from;
										
										$headers = "MIME-Version: 1.0\r\n";
										$headers.= "Content-type: text/html; charset=iso-8859-1\r\n";
										$headers.= "From: $from\r\n";

										mail($to,$subject,$message,$headers);
										echo "<script type='text/javascript'> document.location='success.php';</script>";
									}
								}
							}
							echo "<script type='text/javascript'> document.location='success.php';</script>";
												
							//echo"<script>jQuery('.success-msg').css('display','block')</script>";
						}
					}
					else
					{
						echo"<script>jQuery('.success-msg').css('color','red');jQuery('.success-msg').css('display','block');jQuery('.success-msg').html('User Already Exists');</script>";
					}
				}
			}
		?>
	</body>
</html> 
