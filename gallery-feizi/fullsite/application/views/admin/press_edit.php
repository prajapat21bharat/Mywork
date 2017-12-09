<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $site=site_url().'admin/press/'; ?>
<link rel="stylesheet" href="<?php echo base_url('assets/css/jquery.datepick.css') ?>">
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.datepick.js') ?>"></script>
<!--------------Date and Time ---------------->
<link href="<?php echo base_url('assets/'); ?>/css/jquery.timepicker.css" rel="stylesheet" />
<link href="<?php echo base_url('assets/'); ?>/css/base.css" rel="stylesheet"/>
<!--------------END Date and Time ---------------->
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
var r=confirm('Are Sure Delete This Press');
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

function imgDelete(name){ 
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
      <h3 class="title">Press Information</h3>
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
			<option value="">Select Category Type</option>
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
		<label>Title :</label>
		<input type="text" name="title" id="title" value="<?php if(set_value('title'))  echo set_value('title'); else echo $des[0]->title; ?>" />
		<?php  echo form_error('title'); ?>			
    </div>
    <div class="wit">
		<label>Sub Title :</label>
		<input type="text" name="sub_title" id="prix" value="<?php if(set_value('sub_title'))  echo set_value('sub_title'); else echo $des[0]->sub_title; ?>" />
		<?php  echo form_error('sub_title'); ?>			
    </div>
     <div class="wit">
        <div>
          <label>Date :</label>
          <span class="datepair" data-language="javascript">
			<input type="text" value="<?php if(set_value('start_date'))  echo set_value('start_date'); else echo $des[0]->start_date; ?>" name="start_date" class="date start ">			
          </span>     
       </div>
    </div>
	<div class="wit">
    <label>Upload File :</label>
    <input type="button" value="uploadfile" id="mulitplefileuploader"/>
    <select class="hide" multiple name="userimg[]" id="userimg"></select>	
	<?php  echo form_error('userimg[]'); ?>
    <?php 
		if($press_img){ 
			foreach($press_img as $img){ ?>	
				<div class="edit-img">
					<div class="pdf-image"><img height='80' width='80' src="<?php echo base_url()."uploads/pdf/pdf.jpeg"; ?>" /></div>
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
function goBack() {
    window.location.href = '<?php echo $site ?>';
}
$(document).ready(function(){

var settings = {
	url: "<?php echo site_url() ?>admin/press/upload_photo_vedio",
	method: "POST",
	allowedTypes:"pdf",
	fileName: "myfile",
	multiple: true,
	onSuccess:function(data,files,xhr){
		var str = '"'+files+'"'
		$("#files").append("<div class='edit-img' id='"+parseInt(files)+"'><div class='pdf-image'><img height='80' width='80' src='<?php echo base_url() ?>uploads/pdf/pdf.jpeg'/></div><div class='b-delete'><a href='javascript:void(0)' onclick='imgDelete("+str+")'>Delete</a></div></div>");
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
