<?php
	$this->load->view('includes/header_session');
?>
<script>
  
  // When the browser is ready...
  $(function() {
  
    // Setup form validation on the #register-form element
    $("#category-form").validate({
    
        // Specify the validation rules
        rules: {
            language: {
                required: true,
            },
        },
        
        // Specify the validation error messages
        messages: {
          
            category: {
                language: "Please Enter a Language",
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });

  });
  
  </script>
  <script>
	function valid_lang()
	{
		var language=document.getElementById("language").value;
		if(language=="")
		{
			document.getElementById("err_language").style.display = "block";
			document.getElementById("err_language").innerHTML = "Please Enter a Language";
			return false;
		}
		else
		{
			var letters = /^[A-Za-z]+$/;  
			if(!language.match(letters))  
			{
						//alert('Please Enter First Name in Alphabet Characters only Ex. A-Z or a-z');
				document.getElementById("err_language").style.display = "block";
				document.getElementById("err_language").innerHTML="Only A-Z or a-z Characters are allowed";  
				return false;  
			}
			else
			{
				document.getElementById("err_language").style.display = "none";
				document.getElementById("err_language").innerHTML = "";
			}
		}
	}
  </script>
  
	<script>
	function doconfirm()
	{
		contact=confirm("Are you sure you want to delete?");
		if(contact!=true)
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
	$this->load->view('includes/admin_menu');
?>
				<?php
						///**---For Set value
						
						if(set_value('language')){
							$language = set_value('language');
						}
						else{
							$language = '';
						}
				?>
<div class="container">
	<!----------------- Content Start from Here --------------->
		<div class="content-data">
			<div class="message" style="margin:0px auto;"><?php  if($this->session->flashdata('Logmsg'))   echo  $this->session->flashdata('Logmsg'); ?></div>
			<form method="post" onsubmit="return valid_lang()" action="<?php echo site_url().'/admin/add_language' ?>" id="category-form" novalidate="novalidate" >
				<table align="center" cellspacing="5px" cellpadding="5px" style="background:#EEEEEE;margin-bottom:15px">
					<tr>
						<td class="tbl_add_cate">Language <span class="mandetory"> *</span></td>
						<td class="tbl_add_cate"><input type="text" name="language" id="language" onkeypress="javascript:return OnlyValues(event);" class="txt_popup" value="<?php  echo $language ?>" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Language'" placeholder="Language" />
							<span id="err_language" "display:none;" class="error" ></span>
							<!--<label class="error" for="category">Please Enter Category</label>-->
						</td>
						<td class="tbl_add_cate" colspan="2" align="right"><input type="submit" name="addlanguage" value="Add" class="bttn_popup"></td>
					</tr>
				</table>
			</form>
		</div>
		<?php
					if(empty($getlang))
					{
						echo "<table align='center'><tr><td><span style='color:red; margin:0px auto; font-size:16px;font-weight:bold;'>No Language Added Yet !!</span></td></tr></table>";
						//echo"<script>document.getElementById('datatable').style.display = 'none';</script>";
					}
					else
					{
						echo"<table id='datatable' width='800px' class='grid' align='center'>
						<tr class='td_center'>
							<th>S.No.</th><th>Language</th><th colspan='2'>Action</th>
						</tr>";
						$sno=0;
						foreach($getlang as $row )
						{
							$sno++;
				?>
						<tr>
							<td class="td_center"><?php echo $sno;?></td><td><?php echo ucwords($row['language']) ?></td>
							<td><a href="<?php echo site_url() ?>/admin/edit_language/<?php echo $row['id'] ?>">Edit</a></td>
							<td><a onClick="return doconfirm()" href="<?php echo site_url() ?>/admin/delete_lang/<?php echo $row['id'] ?>">Delete</a></td>
						</tr>
						
				<?php
						}
						echo"</table>";
					}
				?>
</div>

<?php
	$this->load->view('includes/footer_session');
?>
