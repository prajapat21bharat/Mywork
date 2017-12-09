<?php
	$this->load->view('includes/header_session');
?>
  <script>
	function valid_password()
	{
		var no_error=0;
		var oldpassword=document.getElementById("oldpassword").value;
		var newpassword=document.getElementById("newpassword").value;
		var confirmpassword=document.getElementById("confirmpassword").value;
		if(oldpassword=="")
		{
			document.getElementById("err_oldpassword").style.display = "block";
			document.getElementById("err_oldpassword").innerHTML = "Please Enter Old Password";
			no_error=1;
			
		}
		else
		{
			
		if((oldpassword.length<4)||(oldpassword.length>10))
			{
				document.getElementById("err_oldpassword").style.display = "block";
				document.getElementById("err_oldpassword").innerHTML = "Password Min. length is 4 & Max. Length is 10 Character";
				no_error=1;
			}
			else
			{
				document.getElementById("err_oldpassword").style.display = "none";
				document.getElementById("err_oldpassword").innerHTML = "";
			}
		}

		if(newpassword=="")
		{
			document.getElementById("err_newpassword").style.display = "block";
			document.getElementById("err_newpassword").innerHTML = "Please Enter New Password";
			no_error=1;
		}
		else
		{
			if((newpassword.length<4)||(newpassword.length>10))
			{
				document.getElementById("err_newpassword").style.display = "block";
				document.getElementById("err_newpassword").innerHTML = "Password Min. length is 4 & Max. Length is 10 Character";
				no_error=1;
			}
			else
			{
				document.getElementById("err_newpassword").style.display = "none";
				document.getElementById("err_newpassword").innerHTML = "";
			}
		}
		if(confirmpassword=="")
		{
			document.getElementById("err_confirmpassword").style.display = "block";
			document.getElementById("err_confirmpassword").innerHTML = "Please Enter Confirm Password";
			no_error=1;
		}
		else
		{
			if(confirmpassword!==newpassword)
			{
				document.getElementById("err_confirmpassword").style.display = "block";
				document.getElementById("err_confirmpassword").innerHTML = "Password & Confirm Password Does Not Matched";
				no_error=1;
			}
			else
			{
				document.getElementById("err_confirmpassword").style.display = "none";
				document.getElementById("err_confirmpassword").innerHTML = "";
			}
		}
		if(no_error==0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
  </script>
<script language="javascript" type="text/javascript">
        function OnlyValues(event) {

            //alert("Test"); 
            var Key = event.keyCode ? event.keyCode : event.charCode ? event.charCode : event.which;

          
             if (Key == 32) { return false; }

           else {
                return true;
            }

        }
    </script>
    <?php 
						if(set_value('oldpassword'))
						{
							$oldpassword = set_value('oldpassword');
						}
						else
						{
							$oldpassword = '';
						}
						
						if(set_value('newpassword'))
						{
							$newpassword = set_value('newpassword');
						}
						else
						{
							$newpassword = '';
						}
						
						if(set_value('confirmpassword'))
						{
							$confirmpassword = set_value('confirmpassword');
						}
						else
						{
							$confirmpassword = '';
						}
						
    ?>
<?php
	$this->load->view('includes/admin_menu');
?>
<div class="container">
	<div class="message" action="<?php echo site_url()?>/admin/changepassword" style="margin:0px auto;"><?php  if($this->session->flashdata('Logmsg'))   echo  $this->session->flashdata('Logmsg'); ?></div>
	<form method="post" onsubmit="return valid_password()">
	<table align="center" cellspacing="5px" cellpadding="5px" style="background:#EEEEEE;margin-bottom:15px">
			<tr>
				<td class="tbl_add_cate">Current Password <span class="mandetory"> *</span></td>
				<td class="tbl_add_cate">
					<input type="hidden" id="databasepassword" name="databasepassword" value="<?php echo $getpassword[0]['password']?>" />
					<input type="password" name="oldpassword" id="oldpassword" value="<?php echo $oldpassword?>" onkeypress="return OnlyValues(event);" class="txt_popup" value="" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Old Password'" placeholder="Old Password" />
					<span id="err_oldpassword" class="error"></span>
				</td>
			</tr>
			<tr>
				<td class="tbl_add_cate">New Password <span class="mandetory"> *</span></td>
				<td class="tbl_add_cate">
					<input type="password" name="newpassword" id="newpassword" value="<?php echo $newpassword?>" onkeypress="return OnlyValues(event);"  class="txt_popup" value="" onfocus="this.placeholder = ''" onblur="this.placeholder = 'New Password'" placeholder="New Password" />
					<span id="err_newpassword" class="error"></span>
				</td>
			</tr>
			<tr>
				<td class="tbl_add_cate">Confirm Password <span class="mandetory"> *</span></td>
				<td class="tbl_add_cate">
					<input type="password" name="confirmpassword" id="confirmpassword" value="<?php echo $confirmpassword?>" onkeypress="return OnlyValues(event);"  class="txt_popup" value="" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Confirm Password'" placeholder="Confirm Password" />
					<span id="err_confirmpassword" class="error"></span>
				</td>
			</tr>
			<tr>
				<td class="tbl_add_cate" align="right" colspan="2">
					<input type="submit" name="changepassword" id="changepassword" class="bttn_popup" value="Reset"/>
				</td>			
	</table>
	</form>
</div>
