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
<?php
									$getdata=$this->user_model->get_sql_select_data('category','','categoryname');
									//echo $this->db->last_query();
									/*echo"<pre>";
									print_r($getdata);
									exit;*/
								?>
<div class="container">
	<!----------------- Content Start from Here --------------->
		<div class="content-data">
			<div class="message" style="margin:0px auto;"><?php  if($this->session->flashdata('Logmsg'))   echo  $this->session->flashdata('Logmsg'); ?></div>
			<form method="post" action="" id="subcategory-form" novalidate="novalidate" >
				<table>
					<tr>
						<td><p>Category</p></td>
						<td>
							<select style="height:50px;width:200px;" id="main_category" name="main_category" >
								<option value="" style="height:50px;width:180px;line-height:15px">Select Category</option>
								<?php foreach($getdata as $row ){ ?>
								<option  style="height:50px;width:180px;line-height:15px" value="<?php echo $row['id']?>"><?php echo $row['categoryname']?></option>
								<?php }?>
							</select>
						</td>
					</tr>
					<tr>
						<td><p>Sub-Category</p></td>
						<td><input type="text" name="subcategory" id="subcategory" class="input_txt" placeholder="Sub-Category" />
					</tr>
					<tr>
						<td colspan="2" align="right"><input type="submit" name="addsubcategory" value="Add" class="submitbutton"></td>
					</tr>
				</table>
			</form>
		</div>
</div>
<?php
	$this->load->view('includes/footer_session');
?>

