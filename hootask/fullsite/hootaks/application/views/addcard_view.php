<?php
	$this->load->view('includes/header_session');
?>
<?php
				///**---Email
						
						if(set_value('card')){
							$card = set_value('card');
						}
						else{
							$card = '';
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
function valid_card_details()
{
	var cardname = document.getElementById("cardname").value;
	var pic = document.getElementById("pic").value;
	var category = document.getElementById("category").value;
	var subcategory = document.getElementById("sub_category").value;
	var a=0;
	if(cardname=="")
	{
		document.getElementById("err_cardname").style.display = "block";
		document.getElementById("err_cardname").innerHTML = "Please Enter Card Title";
		a=1;
		//alert('Invalid file Format. Only ' + allowedExtensions.join(', ') + ' are allowed.');
	}
	else
	{
		document.getElementById("err_cardname").innerHTML = "";
	}
	if(pic=="")
	{
		document.getElementById("err_pic").style.display = "block";
		document.getElementById("err_pic").innerHTML = "Please Select Card Image";
		a=1;
		//alert('Invalid file Format. Only ' + allowedExtensions.join(', ') + ' are allowed.');
	}
	else
	{
		document.getElementById("err_cardname").innerHTML = "";
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
	if(subcategory=="")
	{
		document.getElementById("err_subcategory").style.display = "block";
		document.getElementById("err_subcategory").innerHTML = "Please Select Category";
		a=1;
		//alert('Invalid file Format. Only ' + allowedExtensions.join(', ') + ' are allowed.');
	}
	else
	{
		document.getElementById("err_subcategory").innerHTML = "";		
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
				<form method="post" action="<?php echo site_url()?>/admin/card" id="card-form" onsubmit="return valid_card_details()" onsubmit="return valid_file()" enctype="multipart/form-data" >
					<table align="center" cellspacing="5px" cellpadding="5px" style="background:#EEEEEE;margin-bottom:15px">
						<tr>
							<td class="tbl_add_cate">Pack Name <span class="mandetory"> *</span></td>
							<td class="tbl_add_cate">
								<input type="text" name="cardname" value="<?php echo $card;?>" id="cardname" class="txt_popup" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Title Of The Pack'" placeholder="Title Of The Pack" />
								<span id="err_cardname" "display:none;" class="error" ></span>
							</td>
						</tr>
						
						<tr>
							<td class="tbl_add_cate">Pack Image</td>
							<td class="tbl_add_cate">
								<input id="pic" type="file" name="userfile[]" multiple />
								<span id="err_pic" "display:none;" class="error" ></span>
								<div id="gallery"><ul id="sortable"></ul></div>
								
							</td>
						</tr>
                                                
                                                
                                               <tr>
							<td class="tbl_add_cate">Field Category <span class="mandetory"> *</span></td>
							<td class="tbl_add_cate">
								<select id="category" name="category" class="popup_select" >
										<option value="" selected>Select Category</option>
										<?php foreach($getcategory as $row ){ ?>
										<option value="<?php echo $row['id']; ?>"><?php echo $row['categoryname'];?></option>
										<?php }?>
									</select>
									<span id="err_category" "display:none;" class="error" ></span>
							</td>
						</tr>
                                                
                                                 <tr>
							<td class="tbl_add_cate">Field Sub-category <span class="mandetory"> *</span></td>
							<td class="tbl_add_cate">
								<select id="sub_category" name="sub_category" class="popup_select" >
										<option value="" selected>Select Sub Category</option>
										<?php foreach($get_sub_category as $row ){ ?>
										<option value="<?php echo $row['name']?>"><?php echo $row['name']?></option>
										<?php }?>
									</select>
									<span id="err_subcategory" "display:none;" class="error" ></span>
							</td>
						</tr>
                                                
						<tr>
							<td class="tbl_add_cate" colspan="2" align="right"><input type="submit" class="bttn_popup" name="addcard" id="addcard" value="Submit"/></td>
						</tr>
					</table>
				</form>
			</div>
			
			
			<?php
					if(empty($getcard))
					{
						echo "<table align='center'><tr><td><span style='color:red; margin:0px auto; font-size:16px;font-weight:bold;'>No Card Added Yet !!</span></td></tr></table>";
						//echo"<script>document.getElementById('datatable').style.display = 'none';</script>";
					}
					else
					{
						echo"<table id='datatable' width='800px' class='grid' align='center'>
						<tr class='td_center'>
							<th>S.No.</th><th>Pack Name</th><th>Images</th><th>Category</th><th colspan='2'>Action</th>
						</tr>";
						$sno=0;
						foreach($getcard as $row )
						{
							$sno++;
				?>
						<tr>
							<td class="td_center"><?php echo $sno;?></td>
							<td><?php echo ucwords($row['title']) ?></td>
							<td>
								<?php 
									$pack_imgs=explode(',',$row['pack_image']);
									foreach($pack_imgs as $img)
									{
								?>
									<img src="<?php echo $img;?>" class="" style="height:50px; width:50px;" />
								<?php
									}
								?>
							</td>
							<td><?php echo ucwords($row['category']) ?></td>
							<td><a href="<?php echo site_url() ?>/admin/update_card/<?php echo $row['id'] ?>">Edit</a></td>
							<td><a onClick="return doconfirm()" href="<?php echo site_url() ?>/admin/delete_card/<?php echo $row['id'] ?>">Delete</a></td>
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
<script>
$('#pic').change(function () {
	 var c=0;
    for (var i=0, len = this.files.length; i < len; i++) {
        (function (j, self) {
            var reader = new FileReader()
            reader.onload = function (e) {
				
				 var li = document.createElement('li');
				    li.setAttribute('id',+c);
				    li.setAttribute('class',"ui-sortable-handle rotable");
				    li.setAttribute('style',"");
				    li.innerHTML = '<img data-id="'+c+'" style="width: 80px;height: 80px;" src="' + e.target.result + '" class="img-responsive" >';
					document.getElementById('sortable').appendChild(li);
               c++;
            };
            reader.readAsDataURL(self.files[j])
        })(i, this);
    }
   
});

</script>
