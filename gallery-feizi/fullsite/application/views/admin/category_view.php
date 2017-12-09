<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $site=site_url().'admin/category/'; ?>


<script type="text/javascript">
function togglepublication() {
  
	var contentId = document.getElementById("form-data");  
	contentId.style.display == "block" ? contentId.style.display = "none" : 
	contentId.style.display = "block"; 
	
	var content = document.getElementById("work-data");  
	content.style.display == "none" ? content.style.display = "block" : 
	content.style.display = "none"; 
}

function category_delete(id){
	
var r=confirm('Are Sure Delete This Category');
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
    window.location.href = '<?php echo $site ?>';
}
</script>
<div class="container-fluid content-wrapper cluster_container mob-right-part span10">
  <div class="hero-unit">   
      <h3 class="title">Category Information</h3>
	    <?php //$this->load->view('admin/nav');?>	    
   
  <div class="success_msg"> 
    <?php if(!empty($success)){
           echo $success;
	       } ?>
	 <?php echo $this->session->flashdata('work_msg');?>      
  </div>               

<!---its is a Profile EDIT Div---> 

<?php $form_error = validation_errors(); ?>
<?php if(empty($category)){
		$block = 'block';
		echo "<div class='menu_itemshow show-form'><a class='login-btn' href='javascript:void(0)'>Add Category</a></div>";
		}else{ 
			if(!$form_error) $block = 'none'; else $block = 'block';
			echo "<div class='menu_itemshow show-form'><a class='login-btn' href='javascript:void(0)' onclick='togglepublication()'>Add Category</a></div>";
		} ?>

<div class="form-data" id="form-data" style="display:<?php echo $block; ?>;">	 
  <?php $edit=array('class'=>'edit_form white_bg');
    echo form_open_multipart(site_url().'admin/category/add/',$edit);?>   
    
    <div class="wit">
		<label>Category Name :</label>
		<input type="text" name="cat" id="cat" value="<?php echo set_value('cat'); ?>" />
		<?php  echo form_error('cat'); ?>			
    </div>
     	 
   <div class="login_button">
	   <input type="button" value="Cancel" class="login-btn" onclick="goBack()" />
     <input type="submit" value="Save" name=" " class="login-btn " />
   </div>
   <?php echo  form_close();?>          
</div>           
 <div class="work-data" id="work-data" <?php if($form_error) echo 'style="display:none;"'; ?>>
	<?php if(!empty($category)){ ?>
		 <?php foreach($category as $val){ ?>
			 <div class="content">			 
				 <div class="up-data">				 
					 <div class="artist-type"><span>Category Name :</span><span class="artist-contant"><?php echo $val->cat_name ?></span></div>
					 <div class="edit-del">
						 <span><a href="<?php echo $site.'edit/'.$val->cat_id;?>" >Edit |</a></span> 
						 <span><a href="javascript:void(0)" onclick="category_delete('<?php echo $val->cat_id ?>')">Delete</a></span>
					 </div>
				 </div>
			 </div>
		<?php } ?>
	<?php } ?>
</div>             
   </div>      
 </div>
