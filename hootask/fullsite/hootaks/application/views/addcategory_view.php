<?php
	$this->load->view('includes/header_session');
?>

<script>
  
  // When the browser is ready...
  $(function() {
  
    // Setup form validation on the #register-form element
    $("#subcategory-form").validate({
    
        // Specify the validation rules
        rules: {
            main_category: {
                required: true,
            },
             subcategory: {
                required: true,
            },
        },
        
        // Specify the validation error messages
        messages: {
          
            main_category: {
                required: "Please Select Category",
            },
            subcategory: {
                required: "Please Enter Sub-Category",
            },
            
        },
        submitHandler: function(form) {
            form.submit();
        }
    });

  });
  
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
			
			<form method="post" action="" id="subcategory-form" novalidate="novalidate" >
				<table cellspacing="5px" cellpadding="5px" align="center" style="background:#EEEEEE;margin-bottom:15px"
					<tr>
						<td><p>Category Name</p></td>
						<td>
						<input type="text"  name="categoryname" id="categoryname"  placeholder="Category Name" onblur="this.placeholder = 'Category Name'" onfocus="this.placeholder = ''" class="txt_popup" value="">
					</tr>
					<tr>
						<td colspan="2" align="right">
							<input type="submit" name="addcategory" value="Add" class="bttn_popup">
							
						</td>
					</tr>
				</table>
			</form>
		</div>
		
			<?php
					if(empty($getdata))
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
						foreach($getdata as $row )
						{
							$sno++;
				?>
						<tr>
							<td class="td_center"><?php echo $sno;?></td><td><?php echo ucwords($row['categoryname']) ?></td>
							<td><a href="<?php echo site_url() ?>/admin/edit_category/<?php echo $row['id'] ?>">Edit</a></td>
							<td><a onClick="return doconfirm()" href="<?php echo site_url() ?>/admin/delete_category/<?php echo $row['id'] ?>">Delete</a></td>
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

