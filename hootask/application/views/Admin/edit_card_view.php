<?php
	$this->load->view('includes/header_session');
?>

<script>
function valid_card_details()
{
	var cardname = document.getElementById("cardname").value;
	var title_img = document.getElementById("title_img").value;
	var pic = document.getElementById("pic").value;
	var category = document.getElementById("category").value;
	var subcategory = document.getElementById("sub_category").value;
	var child_category = document.getElementById("child_category").value;
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
	
	if(child_category=="")
	{
		document.getElementById("err_child_category").style.display = "block";
		document.getElementById("err_child_category").innerHTML = "Please Select Child-Category";
		a=1;
		//alert('Invalid file Format. Only ' + allowedExtensions.join(', ') + ' are allowed.');
	}
	else
	{
		document.getElementById("err_child_category").innerHTML = "";		
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
				<div class="message" style="margin:0px auto;"><?php if(isset($msg)){echo $msg;}?><?php  if($this->session->flashdata('Logmsg'))   echo  $this->session->flashdata('Logmsg'); ?></div>
				<form method="post" action="<?php echo site_url()?>/admin/update_card" id="card-form" class="form_pack" onsubmit="return valid_card_details()" onsubmit="return valid_file()" enctype="multipart/form-data" >
				<div class="form-group">
				<label class="control-label col-sm-3 col-md-3"  for="username">Pack Name <span title="This field is required." class=" mandetory form-required ">*</span></label>
				<div class="col-sm-9 col-md-9">
					<input type="text" name="cardname" value="<?php echo $getcard[0]['title'];?>" id="cardname" class="txt_popup form-control" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Title of The Pack'" placeholder="Title of The Pack" />
					<input type="hidden" value="<?php echo $getcard[0]['id'];?>" id="updateidid" name="updateidid"/>
					<span id="err_cardname" "display:none;" class="error" ></span>
				</div>
			</div>
				
			<div class="form-group">
				<label class="control-label col-sm-3 col-md-3"  for="username">Title Image <span title="This field is required." class=" mandetory form-required ">*</span></label>
				<div class="col-sm-9 col-md-9">
					<!--<img src="<?php // print $getcard[0]['title_img'];?>" height="50px" width="50px" />-->
					<input id="title_img" type="file" name="title_img" accept="image/*" class="file"/>
					<input type="hidden" name="old_title_img" value="<?php print $getcard[0]['title_img'];?>" />
					<span id="err_title_img" "display:none;" class="error" ></span>
				</div>
			</div>
				
			<div class="form-group">
				<label class="control-label col-sm-3 col-md-3"  for="username">Pack Images <span title="This field is required." class=" mandetory form-required ">*</span></label>
				<div class="col-sm-9 col-md-9">
					<!--<img src="<?php // print $getcard[0]['pack_image'];?>" height="50px" width="50px" />-->
					
					<input id="pic" type="file" name="userfile[]" multiple accept="image/*" class="file" />
					<input type="hidden" name="old_pack_image" value="<?php print $getcard[0]['pack_image'];?>" />
					<span id="err_pic" "display:none;" class="error" ></span>
					<div id="gallery"><ul id="sortable"></ul></div>
				</div>
			</div>
			<div class="form-group clearfix">
				<?php
					if(!empty($getcardimages))
					{
						foreach($getcardimages as $card_image)
						{
				?>
				
				<div class="col-sm-2">
					<div class="ajax_del_img">
						<img src="<?php echo $card_image['card_image'];?>" class="" style="height:50px; width:50px;" />
						<a href="javascript:void(0)" onclick="delete_card_img(<?php echo $card_image['id'];?>)">Delete</a>
					</div>
				</div>
				<?php			
						}
					}
				?>
			</div>
			
			<div class="form-group desc">
				<label class="control-label col-sm-3 col-md-3" for="userlist">Description <span title="This field is required." class=" mandetory form-required">*</span></label>
				<div class="col-sm-9 col-md-9">
					<textarea name="description" id="description" class="description form-control" ><?php print $getcard[0]['description'];?></textarea>
				</div>
			</div>
			
			
			<div class="form-group">
				<label class="control-label col-sm-3 col-md-3" for="userlist">Category <span title="This field is required." class="mandetory form-required">*</span></label>
				<div class="col-sm-9 col-md-9">
					
					<select id="category" name="category" class="form-control required popup_select">
						<option value="" >Select Category</option>
							<?php
								foreach($getcategory as $row )
								{ 	
									if($getcard[0]['category']==$row['id'])
									{
										$select="selected";
									}
									else
									{
										$select="";
									}
							?>
								<option  value="<?php echo $row['id']?>" <?php echo $select; ?> > <?php echo $row['categoryname']?></option>
						<?php }?>
					</select>
					
					<span id="err_category" "display:none;" class="error" ></span>
				</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-sm-3 col-md-3" for="userlist">Sub-category <span title="This field is required." class=" mandetory form-required">*</span></label>
				<div class="col-sm-9 col-md-9">
					<select id="sub_category" name="sub_category"  class="form-control required popup_select">
						<option value="" >Select Category</option>
							<?php
								foreach($get_sub_category as $row )
								{ 	
									if($getcard[0]['sub_cate_id']==$row['id'])
									{
										$select="selected";
									}
									else
									{
										$select="";
									}
							?>
								<option  value="<?php echo $row['id']?>" <?php echo $select; ?> > <?php echo $row['name']?></option>
						<?php }?>
					</select>
					<span id="err_subcategory" "display:none;" class="error" ></span>
				</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-sm-3 col-md-3" for="userlist">Child Category <span title="This field is required." class="mandetory form-required">*</span></label>
				<div class="col-sm-9 col-md-9">
					
					<select id="child_category" name="child_category" class="form-control required popup_select">
						<option value="" >Select Child Category</option>
							<?php
								foreach($get_child_sub_category as $row )
								{ 	
									if($getcard[0]['child_id']==$row['id'])
									{
										$select="selected";
									}
									else
									{
										$select="";
									}
							?>
								<option  value="<?php echo $row['id']?>" <?php echo $select; ?> > <?php echo $row['child_name']?></option>
						<?php }?>
					</select>
					
					<span id="err_child_category" "display:none;" class="error" ></span>
				</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-sm-3 col-md-3" for="userlist">Pack Type <span title="This field is required." class=" mandetory form-required">*</span></label>
				<div class="col-sm-9 col-md-9">
					<?php
						if($getcard[0]['card_type']=="pack")
						{
							$pack='selected';
						}
						else
						{
							$pack='';
						}
						if($getcard[0]['card_type']=="questions")
						{
							$questions='selected';
						}
						else
						{
							$questions='';
						}
					?>
					<select id="pack_type" name="pack_type"  class="form-control required popup_select">
						<option value="">Select Type</option>
						<option value="pack" <?php echo $pack;?> >Pack</option>
						<option value="questions" <?php echo $questions;?> >Questions</option>
					</select>
					<span id="err_pack_type" "display:none;" class="error" ></span>
				</div>
			</div>

				
				<div class="form-group">        
					<div class="col-sm-offset-3 col-sm-9 ">
						<input type="submit" class="form_btn" name="updatecard" id="updatecard" value="Update"/>
					</div>
				</div>
		            
				</form>
			
			</div>
			
			<div class="col-sm-12 table-outer">
			<?php
					if(empty($getcard))
					{
						echo "<div class='table-responsive'> <table align='center' id=cards' class='grid table'><tr><td><span style='color:red; margin:0px auto; font-size:16px;font-weight:bold;'>No Card Added Yet !!</span></td></tr></table></div>";
						//echo"<script>document.getElementById('datatable').style.display = 'none';</script>";
					}
					else
					{
						echo"<div class='table-responsive'> <table id='cards' width='800px' class='grid table' align='center'>
						<tr class='td_center'>
							<th>S.No.</th><th>Pack Name</th><th>Category</th><th>Sub-Category</th><th>Type</th><th colspan='2'>Action</th>
						</tr>";
						$sno=0;
						foreach($getcard as $row )
						{
							$sno++;
				?>
						<tr>
							<td class="td_center"><?php echo $sno;?></td>
							<td><?php echo $row['title']; ?></td>
							<td><?php echo $row['categoryname']; ?></td>
							<td><?php echo $row['subcategory']; ?></td>
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
								<a onClick="return doconfirm()" href="<?php echo site_url() ?>admin/delete_card/<?php echo $row['id'] ?>">
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
				    li.innerHTML = '<img data-id="'+c+'" style="width: 80px;height: 80px;" src="' + e.target.result + '" class="img-responsive" >';
					document.getElementById('sortable').appendChild(li);
               c++;
            };
            reader.readAsDataURL(self.files[j])
        })(i, this);
    }
   
});

</script>

<script>
function delete_card_img(id){	
	var r=confirm('Are Sure Delete This Image');
	if (r==true)
	{
		url='<?php echo site_url('admin/delete_card_imgs'); ?>/'+id;
		$.ajax({
			url:url,
			success:function(data){
				location.reload();  
			}
		});
	}

}
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
