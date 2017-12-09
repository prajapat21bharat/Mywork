<?php
	$this->load->view('includes/header_session');
?>
<?php
				///**---Email
						
						if(set_value('company')){
							$company = set_value('company');
						}
						else{
							$company = '';
						}
						$getdata=$this->user_model->get_sql_select_data('category','','categoryname');
?>
<script>
function valid_file()
{
	var res_field = document.myform.elements["userfile"].value;   
	var extension = res_field.substr(res_field.lastIndexOf('.') + 1).toLowerCase();
	var allowedExtensions = ['jpg', 'jpeg', 'png', 'bmp'];
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

</script>
<script>
function valid_company_details()
{
	var companyname = document.getElementById("companyname").value;
	var category = document.getElementById("category").value;
	var a=0;
	if(companyname=="")
	{
		document.getElementById("err_companyname").style.display = "block";
		document.getElementById("err_companyname").innerHTML = "Please Enter Company Name";
		a=1;
		//alert('Invalid file Format. Only ' + allowedExtensions.join(', ') + ' are allowed.');
	}
	else
	{
		document.getElementById("err_companyname").innerHTML = "";
	}
	if(category=="")
	{
		document.getElementById("err_category").style.display = "block";
		document.getElementById("err_category").innerHTML = "Please Select Category";
		a=1;
		//alert('Invalid file Format. Only ' + allowedExtensions.join(', ') + ' are allowed.');
	}
	else
	{
		document.getElementById("err_category").innerHTML = "";		
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

<div class="container">
	<!----------------- Content Start from Here --------------->
		<div class="content-data">
			<div class="addcate">
				<div class="message" style="margin:0px auto;"><?php  if($this->session->flashdata('Logmsg'))   echo  $this->session->flashdata('Logmsg'); ?></div>
				<form method="post" action="<?php echo site_url()?>/admin/company" id="company-form" onsubmit="return valid_company_details()" onsubmit="return valid_file()" enctype="multipart/form-data" >
					<table align="center" cellspacing="5px" cellpadding="5px" style="background:#EEEEEE;margin-bottom:15px">
						<tr>
							<td class="tbl_add_cate">Company Name <span class="mandetory"> *</span></td>
							<td class="tbl_add_cate">
								<input type="text" name="companyname" value="<?php echo $company;?>" id="companyname" class="txt_popup" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Company Name'" placeholder="Company Name" />
								<span id="err_companyname" "display:none;" class="error" ></span>
							</td>
						</tr>
						<tr>
							<td class="tbl_add_cate">Field <span class="mandetory"> *</span></td>
							<td class="tbl_add_cate">
								<select id="category" name="category" class="popup_select" >
										<option value="" selected>Select Category</option>
										<?php foreach($getdata as $row ){ ?>
										<option value="<?php echo $row['categoryname']?>"><?php echo $row['categoryname']?></option>
										<?php }?>
									</select>
									<span id="err_category" "display:none;" class="error" ></span>
							</td>
						</tr>
						<tr>
							<td class="tbl_add_cate">Compnay Logo</td>
							<td class="tbl_add_cate">
								<input type="file" name="userfile" multiple />
								<span id="invalidfile" "display:none;"></span>
							</td>
						</tr>
						<tr>
							<td class="tbl_add_cate" colspan="2" align="right"><input type="submit" class="bttn_popup" name="addcompany" id="addcompany" value="Add"/></td>
						</tr>
					</table>
				</form>
			</div>
			<?php
					if(empty($getcompany))
					{
						echo "<table align='center'><tr><td><span style='color:red; margin:0px auto; font-size:16px;font-weight:bold;'>No Company Added Yet !!</span></td></tr></table>";
						//echo"<script>document.getElementById('datatable').style.display = 'none';</script>";
					}
					else
					{
						echo"<table id='datatable' width='800px' class='grid' align='center'>
						<tr class='td_center'>
							<th>S.No.</th><th>Company Name</th><th>Logo</th><th>Category</th><th colspan='2'>Action</th>
						</tr>";
						$sno=0;
						foreach($getcompany as $row )
						{
							$sno++;
				?>
						<tr>
							<td class="td_center"><?php echo $sno;?></td>
							<td><?php echo ucwords($row['company_name']) ?></td>
							<td><img src="<?php echo base_url().'ast/images/uploads/company_logos/'.$row['image'];?>" class="" style="height:50px; width:50px;" /></td>
							<td><?php echo ucwords($row['category']) ?></td>
							<td><a href="<?php echo site_url() ?>/admin/update_company/<?php echo $row['id'] ?>">Edit</a></td>
							<td><a onClick="return doconfirm()" href="<?php echo site_url() ?>/admin/delete_company/<?php echo $row['id'] ?>">Delete</a></td>
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
