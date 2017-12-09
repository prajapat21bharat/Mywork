<?php
	$this->load->view('includes/header_session');
?>
<script>
	function valid_category()
	{
		var category=document.getElementById("category").value;
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
		
		$where=array('id'=>$getcategory[0]['id']);
		$updatecategory= $this->user_model->get_sql_select_data('category',$where);
		//echo"<pre>";print_r($updatecategory);exit;
		///**---Email
		if(set_value('category'))
		{
			$category = set_value('category');
		}
		else
		{
			$category = $updatecategory[0]['id'];;
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
				<form method="post" id="category-form" onsubmit="return valid_category()"  class="form_category" >
						
					<div class="form-group">
						<label class="control-label col-sm-3 col-md-3"  for="username">Category Name <span title="This field is required." class=" mandetory form-required ">*</span></label>
						<div class="col-sm-9 col-md-9">
							<input type="hidden" value="<?php echo $category;?>" id="categoryid" name="categoryid"/>
							<input type="text" name="category" value="<?php echo $updatecategory[0]['categoryname'];?>" id="category" class="txt_popup  form-control" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Category Name'" placeholder="Category Name" />
							<span id="err_category" "display:none;" class="error" ></span>
						</div>
					</div>
					
					
					<div class="form-group">        
						<div class="col-sm-offset-3 col-sm-9 ">
							<input type="submit" class="form_btn" name="updatecategory" id="updatecategory" value="Update"/>
						</div>
					</div>
					
				</form>
			</div>
			
			<div class="col-sm-12 table-outer">
				
			<?php
					if(empty($getcategory))
					{
						echo "<div class='table-responsive'> <table align='center' class='grid table' ><tr><td><span style='color:red; margin:0px auto; font-size:16px;font-weight:bold;'>No Category Added Yet !!</span></td></tr></table>";
						//echo"<script>document.getElementById('datatable').style.display = 'none';</script>";
					}
					else
					{
						echo"<div class='table-responsive'> <table id='datatable' width='800px' class='grid table' align='center'>
						<tr class='td_center'>
							<th>S.No.</th><th>Category Name</th><th colspan='2'>Action</th>
						</tr>";
						$sno=0;
						foreach($getcategory as $row )
						{
							$sno++;
				?>
						<tr>
							<td class="td_center"><?php echo $sno;?></td><td><?php echo ucwords($row['categoryname']) ?></td>
							
							<td><a onClick="return doconfirm()" href="<?php echo site_url() ?>admin/delete_category/<?php echo $row['id'] ?>">
							<img src="<?php echo base_url();?>/assets/images/delete.png" >
							</a></td>
						</tr>
						
				<?php
						}
						echo"</table>";
					}
				?>
			</div>
	</div>
</div>
<?php
	$this->load->view('includes/footer_session');
?>
