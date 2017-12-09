<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $site=site_url().'admin/publication/'; ?>
<link rel="stylesheet" href="<?php echo base_url('assets/css/jquery.datepick.css') ?>">
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.datepick.js') ?>"></script>
<script type="text/javascript">
function toggleContent() {  
	var contentId = document.getElementById("form-data");  
	contentId.style.display == "none" ? contentId.style.display = "block" : 
	contentId.style.display = "none"; 
}
function works_img_delete(id){ 
var r=confirm('Are Sure Delete This Publications');
if (r==true)
	{
	var form_data = {
		 work_id:id
		  };
    $.ajax({
       url:'<?php echo $site.'delete_img';?>',
       data:form_data,    
       datatype:'json',
       success:function(data){ alert(data);
		  $('#'+id).hide();
		    location.reload();
		//  $('.msg').html('User Successfully Deleted !');
		  
       }
     });
}

}

function img_delete(name){ 
	$("#userimg option[value='"+name+"']").remove();
	$("#"+parseInt(name)).remove();
	var form_data = {
		 work_id:name
		  };
    $.ajax({
       url:'<?php echo $site.'img_delete';?>',
       data:form_data,    
       datatype:'json',
       success:function(data){ 
		  $('#'+id).hide();
		    location.reload();		  
       }
     });
}
</script>
<div class="container-fluid content-wrapper cluster_container mob-right-part span10">
  <div class="hero-unit">   
      <h3 class="title">Publications Information</h3>
      <?php //$this->load->view('admin/nav');?>	    
   
  <div class="success_msg"> 
    <?php if(!empty($success)){
           echo $success;
	       } ?>
	 <?php echo $this->session->flashdata('work_msg');?>      
  </div>               

<div class="form-data" id="form-data" style="display:block !important;">  
  <?php $edit=array('class'=>'edit_form white_bg'); 
    echo form_open_multipart('',$edit);?>   
    <?php $ids = explode(',',$des[0]->user_id); ?>
    <div class="wit">
		<label>Artists :</label>
		<select name="category_type[]" id="category_type" multiple>
			<option value="">Select Artists Type</option>
            <?php 
				foreach($artist as $value){ 
					if($value->ID==set_value('category_type[]') || in_array($value->ID, $ids) == 1){	?>				
					   <option <?php echo set_select('category_type[]', $value->ID , TRUE); ?> value='<?php echo $value->ID ?>'><?php echo  $value->first_name ?></option>
				 <?php } else { ?>
					   <option <?php echo set_select('category_type[]', $value->ID); ?> value='<?php echo $value->ID ?>'><?php echo  $value->first_name ?></option>					
				 <?php }				
				}
            ?>
        </select>
        <?php  echo form_error('category_type[]'); ?>
    </div>  
     
    <div class="wit">
		<label>Artist/Titre :</label>
		<input type="text" name="titre" id="titre" value="<?php if(set_value('titre')) echo set_value('titre'); else echo $des[0]->titre; ?>" />
		<?php  echo form_error('titre'); ?>			
    </div>
    <div class="wit">
		<label>Title :</label>
		<input type="text" name="title" id="title" value="<?php if(set_value('title')) echo set_value('title'); else echo $des[0]->title; ?>" />
		<?php  echo form_error('title'); ?>			
    </div>
    <div class="wit">
		<label>Prix :</label>
		<input type="text" name="prix" id="prix" value="<?php if(set_value('prix')) echo set_value('prix'); else echo $des[0]->prix; ?>" />
		<?php  echo form_error('prix'); ?>			
    </div><!--
    <div class="wit">
		<label>ISBN :</label>
		<input type="text" name="isbn" id="isbn" value="<?php //if(set_value('isbn')) echo set_value('isbn'); else echo $des[0]->isbn; ?>" />
		<?php  //echo form_error('isbn'); ?>			
    </div>	-->

    <div class="wit">
		<label>Publications Image :</label>
		<input type="button" value="uploadfile" id="mulitplefileuploader"/>
		<select class="hide" multiple name="userimg[]" id="userimg"></select>	
		<?php  //echo form_error('userimg[]'); ?>
		
		<?php 
			if($publications_img){ 
				foreach($publications_img as $img){ ?>	
					<div class="edit-img">
						<div class="s-image"><img height='80' width='80' src="<?php echo base_url()."uploads/".$img->image ?>" /></div>
						<div class="b-delete"><a href="javascript:void(0)" onclick="works_img_delete(<?php echo $img->id ?>)">Delete</a></div>
					</div>
				<?php }
			}
		?>
		
		
		<p id="files"> </p>   
    </div> 	 
    <input type="hidden" name="id" value="<?php echo $this->uri->segment(4)?>">	 
   <div class="login_button">
	   <input type="button" value="Cancel" onclick="goBack()" class="login-btn " />
       <input type="submit" value="Save" name=" " class="login-btn " />
   </div>
   <?php echo  form_close();?>          
 </div>   
      
   </div>      
 </div>
 
<script>
function goBack() {
    window.location.href = '<?php echo $site.'add/'.$this->uri->segment(4) ?>';
}	 
</script>
<script>
$(document).ready(function(){

var settings = {
	url: "<?php echo site_url() ?>admin/publication/upload_photo_vedio",
	method: "POST",
	allowedTypes:"jpeg,jpg,png,gif,swf,wmv,mp4,ogg",
	fileName: "myfile",
	multiple: true,
	onSuccess:function(data,files,xhr){
		var str = '"'+files+'"'
		$("#files").append("<div class='edit-img' id='"+parseInt(files)+"'><div class='s-image'><img height='80' width='80' src='<?php echo base_url() ?>uploads/"+files+"'/></div><div class='b-delete'><a href='javascript:void(0)' onclick='img_delete("+str+")'>Delete</a></div></div>");
		//$("#userimg").(files); 
		$("#userimg").append("<option selected value='"+files+"' >"+files+"</option>");
	},
	onError: function(files,status,errMsg){		
		$("#status").append("<font color='red'>Upload is Failed</font>");
	}
}
$("#mulitplefileuploader").uploadFile(settings);

});
</script>
