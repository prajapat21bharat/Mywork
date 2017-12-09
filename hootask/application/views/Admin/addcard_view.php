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
	var title_img = document.getElementById("title_img").value;
	var pic = document.getElementById("pic").value;
	var category = document.getElementById("category").value;
	var subcategory = document.getElementById("sub_category").value;
	var childcategory = document.getElementById("child_category").value;
	var pack_type = document.getElementById("pack_type").value;
	
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

	if(title_img=="")
	{
		document.getElementById("err_title_img").style.display = "block";
		document.getElementById("err_title_img").innerHTML = "Please Select Title Image";
		a=1;
		//alert('Invalid file Format. Only ' + allowedExtensions.join(', ') + ' are allowed.');
	}
	else
	{
		document.getElementById("err_title_img").innerHTML = "";
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
		document.getElementById("err_subcategory").innerHTML = "Please Select Sub-Category";
		a=1;
		//alert('Invalid file Format. Only ' + allowedExtensions.join(', ') + ' are allowed.');
	}
	else
	{
		document.getElementById("err_subcategory").innerHTML = "";		
	}
	
	if(childcategory=="")
	{
		document.getElementById("err_childcategory").style.display = "block";
		document.getElementById("err_childcategory").innerHTML = "Please Select Child-Category";
		a=1;
		//alert('Invalid file Format. Only ' + allowedExtensions.join(', ') + ' are allowed.');
	}
	else
	{
		document.getElementById("err_childcategory").innerHTML = "";		
	}
	
	if(pack_type=="")
	{
		document.getElementById("err_pack_type").style.display = "block";
		document.getElementById("err_pack_type").innerHTML = "Please Select Pack Type";
		a=1;
		//alert('Invalid file Format. Only ' + allowedExtensions.join(', ') + ' are allowed.');
	}
	else
	{
		document.getElementById("err_pack_type").innerHTML = "";		
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
				<form method="post" action="<?php echo site_url()?>/admin/card" id="card-form" class="form_pack" onsubmit="return valid_card_details()" onsubmit="return valid_file()" enctype="multipart/form-data" >
				
			<div class="form-group">
				<label class="control-label col-sm-3 col-md-3"  for="username">Pack Name <span title="This field is required." class=" mandetory form-required ">*</span></label>
				<div class="col-sm-9 col-md-9">
					<input type="text" name="cardname" value="<?php echo $card;?>" id="cardname" class="txt_popup form-control" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Title of The Pack'" placeholder="Title of The Pack" />
					<span id="err_cardname" "display:none;" class="error" ></span>
				</div>
			</div>
				
			<div class="form-group">
				<label class="control-label col-sm-3 col-md-3"  for="username">Title Image <span title="This field is required." class=" mandetory form-required ">*</span></label>
				<div class="col-sm-9 col-md-9">
					<input id="title_img" type="file" name="title_img" accept="image/*" class="file"/>
					<span id="err_title_img" "display:none;" class="error" ></span>			
				</div>
			</div>
				
			<div class="form-group">
				<label class="control-label col-sm-3 col-md-3"  for="username">Pack Images <span title="This field is required." class=" mandetory form-required ">*</span></label>
				<div class="col-sm-9 col-md-9">
					<input id="pic" type="file" name="userfile[]" multiple accept="image/*" class="file" />
					<span id="err_pic" "display:none;" class="error" ></span>
				</div>
				<div class="col-sm-12">
				<div id="gallery"><ul id="sortable"></ul></div>
				</div>
			</div>
			
			<div class="form-group desc">
				<label class="control-label col-sm-3 col-md-3" for="userlist">Description <span title="This field is required." class=" mandetory form-required">*</span></label>
				<div class="col-sm-9 col-md-9">
					<textarea name="description" id="description" class="description form-control" ></textarea>
				</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-sm-3 col-md-3" for="userlist">Category <span title="This field is required." class=" mandetory form-required">*</span></label>
				<div class="col-sm-9 col-md-9">
					<select id="category" name="category"  class="form-control required popup_select">
						<option value="" selected>Select Category</option>
						<?php foreach($getcategory as $row ){ ?>
						<option value="<?php echo $row['id']; ?>"><?php echo $row['categoryname'];?></option>
						<?php }?>
					</select>
					<span id="err_category" "display:none;" class="error" ></span>
				</div>
			</div>
			
			
			<div class="form-group">
				<label class="control-label col-sm-3 col-md-3" for="userlist">Sub-category <span title="This field is required." class=" mandetory form-required">*</span></label>
				<div class="col-sm-9 col-md-9">
					<select id="sub_category" name="sub_category"  class="form-control required popup_select">
						<option value="" selected>Select Sub Category</option>
					</select>
					<span id="err_subcategory" "display:none;" class="error" ></span>
				</div>
			</div>
			
			
			<div class="form-group">
				<label class="control-label col-sm-3 col-md-3" for="userlist">Child-category <span title="This field is required." class=" mandetory form-required">*</span></label>
				<div class="col-sm-9 col-md-9">
					<select id="child_category" name="child_category"  class="form-control required popup_select">
						<option value="" selected>Select Child Category</option>
					</select>
					<span id="err_childcategory" "display:none;" class="error" ></span>
				</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-sm-3 col-md-3" for="userlist">Pack Type <span title="This field is required." class=" mandetory form-required">*</span></label>
				<div class="col-sm-9 col-md-9">
					<select id="pack_type" name="pack_type"  class="form-control required popup_select">
						<option value="">Select Type</option>
						<option value="pack" selected>Pack</option>
						<option value="questions">Questions</option>
						
					</select>
					
					<span id="err_pack_type" "display:none;" class="error" ></span>
				</div>
			</div>

				
				<div class="form-group">        
					<div class="col-sm-offset-3 col-sm-9 ">
						<input type="submit" class="form_btn" name="addcard" id="addcard" value="Submit"/>
					</div>
				</div>
		                   
            

				</form>
			</div>
			
			
			<div class="col-sm-12 table-outer">
			
			<?php
					if(empty($getcard))
					{
						echo "<table align='center' id=pagination'><tr><td><span style='color:red; margin:0px auto; font-size:16px;font-weight:bold;'>No Card Added Yet !!</span></td></tr></table>";
						//echo"<script>document.getElementById('datatable').style.display = 'none';</script>";
					}
					else
					{
						echo"<div class='table-responsive'><table id='pagination' width='800px' class='grid table' align='center'>
						<tr class='td_center'>
							<th >S.No.</th>
							<th>Pack Name</th>
							<th>Title Image</th>
							<th>Images</th>
							<th>Description</th>
							<th>Category</th>
							<th>Type</th>
							<th>Action</th>
						</tr>";
						$sno=0;
						foreach($getcard as $row )
						{
							$sno++;
							//echo"<pre>";print_r($row);
				?>
						<tr>
							<td class="td_center"><?php echo $sno;?></td>
							<td><?php echo ucwords($row['title']) ?></td>
							<td><img src="<?php echo $row['title_img'];?>" class="" style="height:50px; width:50px;" /></td>
							<td>
								<div class="form-group clearfix">
								<?php
									if(!empty($getcardimages))
									{
										foreach($getcardimages as $card_image)
										{
											if($row['id']==$card_image['card_id'])
											{
												
								?>												
											<div class="col-sm-2">
												<div class="ajax_del_img">
													<img src="<?php echo $card_image['card_image'];?>" class="" style="height:50px; width:50px;" />
												</div>
											</div>
								<?php		
											}
										}
									}
								?>
							</div>
							
							</td>
							
							<?php /*?>
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
							<?php */?>
							
							<td><?php echo ucwords($row['description']) ?></td>
							
							<td><?php echo ucwords($row['categoryname']) ?></td>
							<td>
								<?php
									if($row['card_type']=="questions")
									{
										$card_type="Questions";
									}
									elseif($row['card_type']=="pack")
									{
										$card_type="Pack";
									}
									else
									{
										$card_type='';
									}
									echo $card_type;
								?>
							</td>
							<td>
								<a href="<?php echo site_url() ?>admin/update_card/<?php echo $row['id'] ?>" class="a-edit">
									<img src="<?php echo base_url();?>/assets/images/edit.png" >
								</a>
								<a onClick="return doconfirm()" href="<?php echo site_url() ?>admin/delete_card/<?php echo $row['id'] ?>" class="a-delete">
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
				    li.innerHTML = '<img data-id="'+c+'" style="width: 80px;height: 80px;" src="' + e.target.result + '" class="img-responsive col-sm-3" >';
					document.getElementById('sortable').appendChild(li);
               c++;
            };
            reader.readAsDataURL(self.files[j])
        })(i, this);
    }
   
});

</script>


<script type="text/javascript">
//$(document).ready(function(){
    $("select#category").change(function(){
        var id = $(this).val();
        if(!id=='')
        {
			$.ajax({
				type: "POST",
				url: "<?php echo site_url('admin/getsubcategorybyCateId');?>/"+id,
				data: { cate_id : id } 
			}).done(function(data){
				$("#sub_category").html(data);
			});
		}
    });
//});
</script>

<script type="text/javascript">
//$(document).ready(function(){
    $("select#sub_category").change(function(){
        var id = $(this).val();
        if(!id=='')
        {
			$.ajax({
				type: "POST",
				url: "<?php echo site_url('admin/getchildcategorybySub_cateId');?>/"+id,
				data: { sub_cate_id : id } 
			}).done(function(data){
				$("#child_category").html(data);
			});
		}
    });
//});
</script>
