<?php
	$this->load->view('includes/header_session');
?>

<script>
	function valid_category()
	{
		var category=document.getElementById("categoryname").value;
		if(category=="")
		{
			document.getElementById("err_category").style.display = "block";
			document.getElementById("err_category").innerHTML = "Please Enter a Category";
			return false;
		}
		else
		{
			document.getElementById("err_category").style.display = "none";
			document.getElementById("err_category").innerHTML = "";
		}
		
	}
</script>

<?php
	$this->load->view('includes/admin_menu');
?>

<div class="message" style="margin:0px auto;">
				<?php  if($this->session->flashdata('Logmsg'))   echo  $this->session->flashdata('Logmsg'); ?>
			</div>
			<div style="clear:both"></div>
			
<div class="container">
	<!----------------- Content Start from Here --------------->
		<div class="content-data">
			
			<form method="post" action="" id="subcategory-form" novalidate class="form_category"  onsubmit="return valid_category()" >
				
				 <div class="form-group">
					<label class="control-label col-sm-3 col-md-3"  for="username">Category Name <span title="This field is required." class=" mandetory form-required ">*</span></label>
					<div class="col-sm-9 col-md-9">
						<input type="text"  name="categoryname" id="categoryname"  placeholder="Category Name" onblur="this.placeholder = 'Category Name'" onfocus="this.placeholder = ''" class="txt_popup form-control" value="">
						<span id="err_category" "display:none;" class="error" ></span>
					</div>
				</div>
				
				
				<div class="form-group">        
					<div class="col-sm-offset-3 col-sm-9 ">
						<input type="submit" name="addcategory" value="Add" class="form_btn">
					</div>
				</div>
				
			</form>
		</div>
		
		
			<div class="col-sm-12 table-outer">
				<?php
					if(empty($getdata))
					{
						echo "<table align='center' class='grid table' id='pagination'><tr><td><span style='color:red; margin:0px auto; font-size:16px;font-weight:bold;'>No Category Added Yet !!</span></td></tr></table>";
						//echo"<script>document.getElementById('datatable').style.display = 'none';</script>";
					}
					else
					{
						echo"<div class='table-responsive'><table id='pagination' width='800px' class='grid table' align='center'>
						<tr class='td_center'>
							<th>S.No.</th><th>Category Name</th><th colspan='2'>Action</th>
						</tr>";
						$sno=0;
						foreach($getdata as $row )
						{
							$sno++;
				?>
						<tr>
							<td class="td_center"><?php echo $sno;?></td><td><?php echo ucwords($row['categoryname']) ?></td>
							<td>
								<a href="<?php echo site_url() ?>admin/edit_category/<?php echo $row['id'] ?>" class="a-edit">
									<img src="<?php echo base_url();?>/assets/images/edit.png" >
								</a>
								<a onClick="return doconfirm()" href="<?php echo site_url() ?>admin/delete_category/<?php echo $row['id'] ?>" class="a-delete">
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

