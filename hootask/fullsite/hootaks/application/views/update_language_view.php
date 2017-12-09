<?php
	$this->load->view('includes/header_session');
?>
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
<?php
		
		$where=array('id'=>$getlanguage[0]['id']);
		$updatelanguage= $this->user_model->get_sql_select_data('languages',$where);
		//echo"<pre>";print_r($updatecategory);exit;
		///**---Email
		if(set_value('category'))
		{
			$category = set_value('category');
		}
		else
		{
			$category = $updatelanguage[0]['id'];;
		}
	?>
<?php
	$this->load->view('includes/admin_menu');
?>

<div class="container">
	<!----------------- Content Start from Here --------------->
		<div class="content-data">
			<div class="addcate">
				<div class="message" style="margin:0px auto;"><?php if(isset($msg)){echo $msg;}?><?php  if($this->session->flashdata('Logmsg'))   echo  $this->session->flashdata('Logmsg'); ?></div>
				<form method="post" id="category-form" onsubmit="return valid_lang()">
					<table align="center" cellspacing="5px" cellpadding="5px" style="background:#EEEEEE;margin-bottom:15px">
						<tr>
							<td class="tbl_add_cate">Language <span class="mandetory"> *</span></td>
							<td class="tbl_add_cate"><input type="hidden" value="<?php echo $updatelanguage[0]['id'];?>" id="languageid" name="languageid"/> <input type="text" name="language" value="<?php echo $updatelanguage[0]['language'];?>" id="language" class="txt_popup" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Language'" placeholder="Language" />
								<span id="err_language" "display:none;" class="error" ></span>
							</td>
							<td class="tbl_add_cate"><input type="submit" class="bttn_popup" name="updatelanguage" id="updatelanguage" value="Update"/></td>
						</tr>
					</table>
				</form>
			</div>
			<?php
					if(empty($getlanguage))
					{
						echo "<table align='center'><tr><td><span style='color:red; margin:0px auto; font-size:16px;font-weight:bold;'>No Category Added Yet !!</span></td></tr></table>";
						//echo"<script>document.getElementById('datatable').style.display = 'none';</script>";
					}
					else
					{
						echo"<table id='datatable' width='800px' class='grid' align='center'>
						<tr class='td_center'>
							<th>S.No.</th><th>Category Name</th><th colspan='2'>Action</th>
						</tr>";
						$sno=0;
						foreach($getlanguage as $row )
						{
							$sno++;
				?>
						<tr>
							<td class="td_center"><?php echo $sno;?></td><td><?php echo ucwords($row['language']) ?></td>
							
							<td><a onClick="return doconfirm()" href="<?php echo site_url() ?>/admin/delete_category/<?php echo $row['id'] ?>">Delete</a></td>
						</tr>
						
				<?php
						}
						echo"</table>";
					}
				?>
		</div>
</div>
<?php
	$this->load->view('includes/footer_session');
?>
