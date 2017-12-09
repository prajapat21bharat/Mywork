<style>
	.error{color:red;}
</style>

<?php
	if(isset($_POST['send']))
	{
		$fullname=$_POST['fullname'];
		$email=$_POST['email'];
		$contactno=$_POST['contactno'];
		$subject=$_POST['subject'];
		$message=$_POST['message'];

		/*	Code for upload file	*/
		$upload_dir="uploads/attachment/";
		if (!is_dir($upload_dir))
		{
			mkdir($upload_dir, 0777, true);
		}
		$filename=$_FILES["upload"]["name"];
		move_uploaded_file($_FILES["upload"]["tmp_name"], $upload_dir . $filename);
		
		/*	Code for mail	*/
		
		$from = $email;
		$to='bharat.prajapat@newtechfusion.com';
		$mail_msg='<table>
			<tr>
				<td>Full Name :</td>
				<td>'.$fullname.'</td>
			</tr>
			<tr>
				<td>Email :</td>
				<td>'.$email.'</td>
			</tr>
			<tr>
				<td>Contactno :</td>
				<td>'.$contactno.'</td>
			</tr>
			<tr>
				<td>Subject :</td>
				<td>'.$subject.'</td>
			</tr>
			<tr>
				<td>Message :</td>
				<td>'.$message.'</td>
			</tr>
		</table>';

		$file = file_get_contents($upload_dir.$filename);

		$content = chunk_split(base64_encode($file));

		$uid = md5(uniqid(time()));
		$replyto='youremailid@gmail.com';

		
		// header
		$header = "From: ".$fullname." <".$email.">\r\n";
		$header .= "Reply-To: ".$replyto."\r\n";
		$header .= "MIME-Version: 1.0\r\n";
		$header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";

		// message & attachment
		$nmessage = "--".$uid."\r\n";
		$nmessage .= "Content-type:text/html; charset=iso-8859-1\r\n";
		$nmessage .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
		$nmessage .= $mail_msg."\r\n\r\n";
		$nmessage .= "--".$uid."\r\n";
		$nmessage .= "Content-Type: application/octet-stream; name=\"".$filename."\"\r\n";
		$nmessage .= "Content-Transfer-Encoding: base64\r\n";
		$nmessage .= "Content-Disposition: attachment; filename=\"".$filename."\"\r\n\r\n";
		$nmessage .= $content."\r\n\r\n";
		$nmessage .= "--".$uid."--";
		
		$isSent=mail($to, $subject, $nmessage, $header);
		if($isSent)
		{
			echo "<p style='color:green'>Mail Sent Successfuly Check your Inbox or Spam</p>";
		}
		else
		{
			echo "<p style='color:red'>Mail Sent Failed</p>";
		}
	}
?>

<form method="post"  action="" enctype="multipart/form-data" id="sendmail">
		<table>
			<tr>
				<td>Full Name :</td>
				<td><input type="text" name="fullname" /></td>
			</tr>
			<tr>
				<td>Email :</td>
				<td><input type="text" name="email" /></td>
			</tr>
			<tr>
				<td>Contactno :</td>
				<td><input type="text" name="contactno" maxlength="13" /></td>
			</tr>
			<tr>
				<td>Subject :</td>
				<td><input type="text" name="subject" required="" /></td>
			</tr>
			<tr>
				<td>Message :</td>
				<td><textarea name="message"   style="height: 80px; resize: none; width: 235px;" ></textarea></td>
			</tr>
			<tr>
				<td>Attachment  :</td>
				<td><input type="file" name="upload" id="upload"   /></td>
			</tr>
			<tr>
				<td colspan="2"><input type="submit" name="send" value="Send" /></td>
			</tr>
		</table>
</form>

<script src="jQuery/jquery.min.js"></script>
<script src="jQuery/jquery.validate.min.js"></script>

  <script>
  $(function() {
    // Setup form validation on the #register-form element
    $("#sendmail").validate({
    
    
    if(!$('#upload').val())
            {
                alert("empty");
            }
            else
            {
				 alert("NO empty");
			}

    }); 
        // Specify the validation rules
        rules: {
             fullname: "required",
             contactno:{
				  required:true,
				  minlength:10,
				  maxlength:10,
				  number: true
				  },
            email: {
                required: true,
                email: true
            },
             subject: "required",
             message: "required",
             upload: "required",
        },
        
        
        // Specify the validation error messages
        messages: {
			 fullname: "Please enter your name!",
			 contactno:{
					required:"Please enter your phone no!",
					minlength:"Min. 10 Digits are allowed ",
					maxlength:"Max. 10 Digits are allowed ",
					number:"Only Digits are allowed ",
				 },
			 email:{
					required:"Please enter your Email",
					email:"Please enter a valid email address",
				 },
			 subject: "Please enter Subject",
			 message: "Please enter Message",
			 upload: "Please enter Attahment",
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });
    });
  </script>
