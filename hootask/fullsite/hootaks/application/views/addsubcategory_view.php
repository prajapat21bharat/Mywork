<?php
	$this->load->view('includes/header_session');
?>

<script>
   
  function valid_card_details()
{
	var main_category = document.getElementById("main_category").value;
	var sub_categoryname = document.getElementById("sub_categoryname").value;
	var a=0;
	if(main_category=="")
	{
		document.getElementById("err_main_category").style.display = "block";
		document.getElementById("err_main_category").innerHTML = "Please Select Category Name";
		a=1;
		//alert('Invalid file Format. Only ' + allowedExtensions.join(', ') + ' are allowed.');
	}
	else
	{
		document.getElementById("err_main_category").innerHTML = "";
	}
	
	if(sub_categoryname=="")
	{
		document.getElementById("err_sub_categoryname").style.display = "block";
		document.getElementById("err_sub_categoryname").innerHTML = "Please Enter Sub-Category Name";
		a=1;
		//alert('Invalid file Format. Only ' + allowedExtensions.join(', ') + ' are allowed.');
	}
	else
	{
		document.getElementById("err_sub_categoryname").innerHTML = "";
	}
	if(a==0)
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
<?php
									
									//echo $this->db->last_query();
									/*echo"<pre>";
									print_r($getdata);
									exit;*/
								?>
<div class="container">
	<!----------------- Content Start from Here --------------->
		<div class="content-data">
			<div class="message" style="margin:0px auto;"><?php  if($this->session->flashdata('Logmsg'))   echo  $this->session->flashdata('Logmsg'); ?></div>
			<form method="post" action="" id="subcategory-form" novalidate="novalidate" onsubmit="return valid_card_details()"  >
				<table cellspacing="5px" cellpadding="5px" align="center" style="background:#EEEEEE;margin-bottom:15px"
					<tr>
						<td><p>Category</p></td>
						<td>
							<select id="main_category" name="main_category" class="popup_select">
								<option value="" >Select Category</option>
								<?php foreach($getdata as $row ){ ?>
								<option  value="<?php echo $row['id']?>"><?php echo $row['categoryname']?></option>
								<?php }?>
							</select>
							<span id="err_main_category" "display:none;" class="error" ></span>
						</td>
					</tr>
					<tr>
						<td><p>Sub-Category</p></td>
						<td>
							<input type="text" placeholder="Sub-Category Name" onblur="this.placeholder = 'Sub-Category Name'" onfocus="this.placeholder = ''" class="txt_popup" value="" name="sub_categoryname" id="sub_categoryname" >
							<span id="err_sub_categoryname" "display:none;" class="error" ></span>
						</td>
					</tr>
					<tr>
						<td colspan="2" align="right">
							<input type="submit" name="addsubcategory" value="Add" class="bttn_popup"></td>
					</tr>
				</table>
			</form>
		</div>
		
			<?php
					if(empty($getsubcategory))
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
						foreach($getsubcategory as $row )
						{
							$sno++;
				?>
						<tr>
							<td class="td_center"><?php echo $sno;?></td><td><?php echo ucwords($row['name']) ?></td>
							<td><a href="<?php echo site_url() ?>/admin/edit_subcategory/<?php echo $row['id'] ?>">Edit</a></td>
							<td><a onClick="return doconfirm()" href="<?php echo site_url() ?>/admin/delete_subcategory/<?php echo $row['id'] ?>">Delete</a></td>
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

