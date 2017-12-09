<?php
	$this->load->view('includes/header_session');
?>
<script>
	
</script>
<?php

		//********************** To Get Company Details *********************************
		$where=array('id'=>$getcompany[0]['id']);
		$updatecompany= $this->user_model->get_sql_select_data('company',$where);
		//echo"<pre>";print_r($updatecompany);
		
		//********************** To Get Select Dropdown Fields *********************************
		$getdata=$this->user_model->get_sql_select_data('category','','categoryname');
		//echo"<pre>";print_r($getdata);exit;
		
		///**---Email
		if(set_value('category'))
		{
			$company = set_value('company');
		}
		else
		{
			$company = $updatecompany[0]['id'];
		}
	?>
<?php
	$this->load->view('includes/admin_menu');
?>

<div class="container">
	<!----------------- Content Start from Here --------------->
		<div class="content-data">
			<div class="addcate">
				<div class="message" style="margin:0px auto;"><?php  if($this->session->flashdata('Logmsg'))   echo  $this->session->flashdata('Logmsg'); ?></div>
				<form method="post" action="<?php echo site_url()?>/admin/update_company" id="company-form" onsubmit="return valid_company_details()" onsubmit="return valid_file()" enctype="multipart/form-data" >
					<table align="center" cellspacing="5px" cellpadding="5px" style="background:#EEEEEE;margin-bottom:15px">
						<tr>
							<td class="tbl_add_cate">Company Name <span class="mandetory"> *</span></td>
							<td class="tbl_add_cate"><input type="hidden" value="<?php echo $company;?>" id="companyid" name="companyid"/> <input type="text" name="companyname" value="<?php echo $updatecompany[0]['company_name'];?>" id="companyname" class="txt_popup" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Company Name'" placeholder="Company Name" />
								<span id="err_company" "display:none;" class="error" ></span>
							</td>
						</tr>
						<tr>
							<td class="tbl_add_cate">Field <span class="mandetory"> *</span></td>
							<td class="tbl_add_cate">
								<select id="category" name="category" class="popup_select" >
										<option value="">Select Category</option>
										<?php foreach($getdata as $row ){ ?>
										<option value="<?php echo $row['categoryname']?>" <?php if($row['categoryname']==$updatecompany[0]['category']){echo $condition="selected";}  ?> ><?php echo $row['categoryname']?></option>
										<?php }?>
								</select>
								<span id="err_category" "display:none;" class="error" ></span>
							</td>
						</tr>
						<tr>
							<td class="tbl_add_cate">Current Logo</td>
							<td class="tbl_add_cate"><input type="hidden" value="<? echo $updatecompany[0]['image'] ;?>" name="existingimage" id="existingimage" />
							<img src="<?php echo base_url().'/ast/images/uploads/company_logos/'.$updatecompany[0]['image'];?>" class="" style="height:50px; width:50px; margin-left:10px; border:1px solid #FFFFFF;" /></td>
						</tr>
						<tr>
							<td class="tbl_add_cate">New Logo</td>
							<td class="tbl_add_cate"><input onblur="demo()" type="file" name="userfile" multiple /></td>
						</tr>
						<tr>
							<td class="tbl_add_cate" colspan="2" align="right"><input type="submit" class="bttn_popup" name="updatecompany" id="updatecompany" value="Update"/></td>
						</tr>
					</table>
				</form>
			</div>
			<?php
					if(empty($getcompany))
					{
						echo "<table align='center'><tr><td><span style='color:red; margin:0px auto; font-size:16px;font-weight:bold;'>No Category Added Yet !!</span></td></tr></table>";
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
