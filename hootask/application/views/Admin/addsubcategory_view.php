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
			<form method="post" action="" id="subcategory-form" class="form_subcategory" novalidate onsubmit="return valid_card_details()"  >
				
				<div class="form-group">
				<label class="control-label col-sm-3 col-md-3" for="userlist">Category <span title="This field is required." class="mandetory form-required">*</span></label>
				<div class="col-sm-9 col-md-9">
					<select id="main_category" name="main_category"  class="form-control required popup_select">
						<option value="" >Select Category</option>
						<?php foreach($getdata as $row ){ ?>
						<option  value="<?php echo $row['id']?>"><?php echo $row['categoryname']?></option>
						<?php }?>
					</select>
					<span id="err_main_category" "display:none;" class="error" ></span>
				</div>
			</div>
			
				<div class="form-group">
					<label class="control-label col-sm-3 col-md-3"  for="username">Sub-Category <span title="This field is required." class=" mandetory form-required ">*</span></label>
					<div class="col-sm-9 col-md-9">
						<input type="text" placeholder="Sub-Category Name" onblur="this.placeholder = 'Sub-Category Name'" onfocus="this.placeholder = ''" class="txt_popup form-control" value="" name="sub_categoryname" id="sub_categoryname" >
						<span id="err_sub_categoryname" "display:none;" class="error" ></span>
					</div>
				</div>
				
				
			
				<div class="form-group">        
					<div class="col-sm-offset-3 col-sm-9 ">
						<input type="submit" name="addsubcategory" value="Add" class="form_btn">
					</div>
				</div>
			
			</form>
		</div>
			<div class="col-sm-12 table-outer">
			<?php
					if(empty($getsubcategory))
					{
						echo "<div class='table-responsive'><table align='center' id='pagination' class='grid table'><tr><td><span style='color:red; margin:0px auto; font-size:16px;font-weight:bold;'>No Category Added Yet !!</span></td></tr></table></div>";
						//echo"<script>document.getElementById('datatable').style.display = 'none';</script>";
					}
					else
					{
						echo"<div class='table-responsive'><table id='pagination' width='800px' class='grid table' align='center'>
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
							<td>
								<a href="<?php echo site_url() ?>admin/edit_subcategory/<?php echo $row['id'] ?>" class="a-edit">
									<img src="<?php echo base_url();?>/assets/images/edit.png" >
								</a>
								<a onClick="return doconfirm()" href="<?php echo site_url() ?>admin/delete_subcategory/<?php echo $row['id'] ?>" class="a-delete">
									<img src="<?php echo base_url();?>/assets/images/delete.png" >
								</a>
							</td>
							
						</tr>
						
				<?php
						}
						echo"</table></div>";
					}
				?>
		</div>
</div>
<?php
	$this->load->view('includes/footer_session');
?>

