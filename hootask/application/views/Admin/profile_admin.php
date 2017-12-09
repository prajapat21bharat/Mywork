<?php
	$this->load->view('includes/header_session');
?>
<script>
	
		function valid_details()
		{
			var no_error=0;
			var name=document.getElementById("name").value;
			if(name=="")
			{
				document.getElementById("err_name").style.display = "block";
				document.getElementById("err_name").innerHTML = "Please Enter Your Name";
				//return false;
				no_error=1;
			}
			else
			{
				var letters = /^[A-Za-z ]+$/;  
				if(!name.match(letters))  
				{
							//alert('Please Enter First Name in Alphabet Characters only Ex. A-Z or a-z');
					document.getElementById("err_name").style.display = "block";
					document.getElementById("err_name").innerHTML="Only A-Z or a-z Characters are allowed";  
					//return false; 
					no_error=1; 
				}
				else
				{
					if((name.length<=2)||(name.length>=14))
					{
						document.getElementById("err_name").style.display = "block";
						document.getElementById("err_name").innerHTML="Min. 3 & Max. 14 Characters are Allowed";  
						//return false; 
						no_error=1;
 					}
					else
					{
						document.getElementById("err_name").style.display = "none";
						document.getElementById("err_name").innerHTML = "";
					}
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
<?php
	$this->load->view('includes/admin_menu');
?>
<div class="container">
	<div class="content-data">
		<div class="message" style="margin:0px auto;"><?php  if($this->session->flashdata('Logmsg'))   echo  $this->session->flashdata('Logmsg'); ?></div>
		<form action="<?php echo site_url()?>admin/profile" method="post" accept="image/*" id="profile_form" onsubmit="return valid_details()" enctype="multipart/form-data" class="form_subcategory">
			<div class="form-group">
				<label class="control-label col-sm-3 col-md-3"  for="username">Name <span title="This field is required." class=" mandetory form-required ">*</span></label>
				<div class="col-sm-9 col-md-9">
					<input type="text" name="name" id="name" class="txt_popup form-control" value="<?php echo $getprofile[0]['name']; ?>"/>
					<span id="err_name" "display:none;" class="error" ></span>
				</div>
			</div>
				
			<div class="form-group">
				<label class="control-label col-sm-3 col-md-3"  for="username">Profile Pic<span title="This field is required." class=" mandetory form-required ">*</span></label>
				<div class="col-sm-9 col-md-9">
					<input type="hidden" value="<? echo $getprofile[0]['image'] ;?>" name="existingimage" id="existingimage" />
					<img src="<?php echo base_url().'/ast/images/uploads/userpic/'.$getprofile[0]['image'];?>" id="oldpic" class="oldpic" style="height:50px; float:left; width:50px; border:1px solid #FFFFFF;" />
					<input type="file" name="userfile" id="userfile" class="p_file">
				</div>
			</div>
			
			<div class="form-group">        
				<div class="col-sm-offset-3 col-sm-9 ">
					<input type="submit" name="change" id="change" value="Change" class="bttn_popup" />
				</div>
			</div>
			
		</form>
	</div>
</div>
<?php
	$this->load->view('includes/footer_session');
?>
