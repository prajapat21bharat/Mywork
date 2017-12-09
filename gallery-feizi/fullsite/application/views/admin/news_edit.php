<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $site=site_url().'admin/news/'; ?>
<link rel="stylesheet" href="<?php echo base_url('assets/css/jquery.datepick.css') ?>">
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.datepick.js') ?>"></script>
<!--------------Date and Time ---------------->
<link href="<?php echo base_url('assets/'); ?>/css/jquery.timepicker.css" rel="stylesheet" />
<link href="<?php echo base_url('assets/'); ?>/css/base.css" rel="stylesheet"/>
<!--------------END Date and Time ---------------->
<script type="text/javascript" src="<?php echo base_url('assets/js/toltip.js') ?>"></script>
<!--------------Date and Time ---------------->
<script src="<?php echo base_url('assets/js/date_time.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.timepicker.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/base.js') ?>"></script>
<!--------------END Date and Time ---------------->
<script type="text/javascript">
$(function() {
    $('#popupDatepicker').datepick();
});
function toggleContent() {
  
	var contentId = document.getElementById("form-data");  
	contentId.style.display == "none" ? contentId.style.display = "block" : 
	contentId.style.display = "none"; 
}
function works_img_delete(id){
	
var r=confirm('Are Sure Delete This News');
if (r==true)
	{
	var form_data = {
		 work_id:id
		  };
    $.ajax({
       url:'<?php echo $site.'delete_img';?>',
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
      <h3 class="title">News Information</h3>
      <?php //$this->load->view('admin/nav');?>	    
   
  <div class="success_msg"> 
    <?php if(!empty($success)){
           echo $success;
	       } ?>
	 <?php echo $this->session->flashdata('work_msg');?>      
  </div>               

<div class="form-data" id="form-data" style="display:block !important;">  
  <?php $edit=array('class'=>'edit_form white_bg');  //print_r($des);
    echo form_open_multipart('',$edit);?>   
    <div class="wit">
		<label>Title1 :</label>
		<input type="text" name="title1" id="title1" value="<?php if(set_value('title1'))  echo set_value('title1'); else echo $des[0]->title1; ?>" />
		<?php  echo form_error('title1'); ?>			
    </div>
    <div class="wit">
		<label>Title2 :</label>
		<input type="text" name="title2" id="title2" value="<?php if(set_value('title2'))  echo set_value('title2'); else echo $des[0]->title2; ?>" />
		<?php  echo form_error('title2'); ?>			
    </div>
    <div class="wit">
		<label>Title3 :</label>
		<input type="text" name="title3" id="title3" value="<?php if(set_value('title3'))  echo set_value('title3'); else echo $des[0]->title3; ?>" />
		<?php  echo form_error('title3'); ?>			
    </div>
    <div class="wit">
		<label>Palais :</label>
		<input type="text" name="palais" id="palais" value="<?php if(set_value('palais'))  echo set_value('palais'); else echo $des[0]->palais; ?>" />
		<?php  echo form_error('palais'); ?>			
    </div>
    <?php $ids = explode(',',$des[0]->user_id); ?>
    <div class="wit">
		<label>Artists :</label>
		<select name="category_type[]" id="category_type" multiple >
			<option value="">------ Select Artists ------</option>
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
        <div>
          <label>Date :</label>
          <span class="datepair" data-language="javascript">
			<input type="text" value="<?php if(set_value('start_date'))  echo set_value('start_date'); else echo $des[0]->start_date; ?>" name="start_date" class="date start ">			
			to
			<input type="text" name="end_date" value="<?php if(set_value('end_date'))  echo set_value('end_date'); else echo $des[0]->end_date; ?>" class="date end ">
			<?php  echo form_error('start_date').' '; ?> <?php  echo ' '.form_error('end_date'); ?>
          </span>     
       </div>
    </div>    
    
    <div class="wit">
		<label>Description :</label>
		<textarea name="new_des" id="content" /><?php if(set_value('new_des'))  echo set_value('new_des'); else echo $des[0]->description; ?></textarea>
		<?php  echo form_error('new_des'); ?>
		<?php echo display_ckeditor($ckeditor); ?>
    </div> 
	<div class="wit">
    <label>News/Events Image :</label>
    <input type="button" value="uploadfile" id="mulitplefileuploader"/>
    <select class="hide" multiple name="userimg[]" id="userimg"></select>	
	<?php  echo form_error('userimg[]'); ?>
    <?php 
		if($news_img){ 
			foreach($news_img as $img){ ?>	
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
	url: "<?php echo site_url() ?>admin/register/upload_photo_vedio",
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
