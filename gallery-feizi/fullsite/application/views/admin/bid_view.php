<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $site=site_url().'admin/bid/'; ?>
<script type="text/javascript">

function togglebid() {
  
	var contentId = document.getElementById("form-data");  
	contentId.style.display == "block" ? contentId.style.display = "none" : 
	contentId.style.display = "block"; 
	
	var content = document.getElementById("work-data");  
	content.style.display == "none" ? content.style.display = "block" : 
	content.style.display = "none"; 
}

function bid_delete(id)
{
	var r=confirm('Are Sure Delete This Bio');
	if (r==true)
		{
		var form_data = {
			 work_id:id
			  };
		$.ajax({
		   url:'<?php echo $site.'delete';?>',
		   data:form_data,    
		   datatype:'json',
		   success:function(data){
			  $('#'+id).hide();
				location.reload();
			//  $('.msg').html('User Successfully Deleted !');
			  
		   }
		 });
	}
}
function goBack() {
    window.location.href = '<?php echo $site.'add/'.$this->uri->segment(4) ?>';
}
</script>
<div class="container-fluid content-wrapper cluster_container mob-right-part span10">
  <div class="hero-unit">   
      <h3 class="title">Bio Information</h3>
	    <?php $this->load->view('admin/nav');?>	    
   
  <div class="success_msg"> 
    <?php if(!empty($success)){
           echo $success;
	       } ?>
	 <?php echo $this->session->flashdata('work_msg');?>      
  </div>               

<!---its is a Profile EDIT Div---> 
<div class="menu_itemshow show-form">	
	<a class="login-btn" href="javascript:void(0)" onclick="togglebid()">Add Bio</a>
</div>
<?php $form_error = validation_errors(); ?>
<?php if(empty($news)){$block = 'block';}else{ if(!$form_error) $block = 'none'; else $block = 'block';} ?>

<div class="form-data" id="form-data" style="display:<?php echo $block; ?>;">	  
  <?php $edit=array('class'=>'edit_form white_bg');
    echo form_open_multipart(site_url().'admin/bid/add/'.$this->uri->segment(4),$edit);?> 

	<div class="wit">
		<label>Category Type :</label>
		<select name="category_type" id="category_type">
			<option value="">Select Category Type</option>
            <?php 
				foreach($cat as $value){ 
					$art[] = $value->cat_name;
					if($value->cat_id==set_value('category_type')){	?>				
					   <option <?php echo set_select('category_type', $value->cat_id , TRUE); ?> value='<?php echo $value->cat_id?>'><?php echo  $value->cat_name ?></option>
				 <?php } else { ?>
					   <option <?php echo set_select('category_type', $value->cat_id); ?> value='<?php echo $value->cat_id?>'><?php echo  $value->cat_name ?></option>					
				 <?php }				
				}
            ?>
        </select>
        <?php  echo form_error('category_type'); ?>
    </div>
    <div class="wit">
		<label>News :</label>
		<textarea name="bid_des" id="content" /><?php echo set_value('bid_des'); ?></textarea>
		<?php  echo form_error('bid_des'); ?>
		<?php echo display_ckeditor($ckeditor); ?>
    </div>
    	 
   <div class="login_button">
	   <input type="button" value="Cancel" class="login-btn" onclick="goBack()" />
		<input type="submit" value="Save" name=" " class="login-btn " />
   </div>
   <?php echo  form_close();?>          
</div>
<div class="work-data" id="work-data" <?php if($form_error) echo 'style="display:none;"'; ?>>
	 <?php foreach($news as $val){ ?>
		 <div class="content">			 
			 <div class="up-data">
				 <div class="artist-type"><span>Category :</span><span class="artist-contant"><?php echo $art[$val->cat_id - 1] ?></span></div>
				 <div class="artist-type"><span>Description :</span><span class="artist-contant"><?php echo $val->description ?></span></div>
				 <div class="edit-del">
					 <span><a href="<?php echo $site.'edit/'.$this->uri->segment(4).'/'.$val->id;?>" >Edit |</a></span> 
					 <span><a href="javascript:void(0)" onclick="bid_delete('<?php echo $val->id ?>')">Delete</a></span>
				 </div>
			 </div>
		 </div>
	<?php } ?>
</div>
         
	</div>      
</div>
 
