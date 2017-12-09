<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<link rel="stylesheet" href="<?php echo base_url('assets/css/jquery.datepick.css') ?>">
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.datepick.js') ?>"></script>
<?php $site=site_url().'admin/exhibitions/'; ?>
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
      <h3 class="title">Update Exhibitions</h3>     
	  <div class="success_msg"> 
		 <?php echo $this->session->flashdata('work_msg');?>      
	  </div>
<!---its is a Profile EDIT Div--->   
  <?php $edit=array('class'=>'edit_form white_bg');  
    echo form_open_multipart('',$edit);?> 
    <?php $ids = explode(',',$exhibitions_data[0]->user_id); ?>	
    <div class="wit">
		<label>Artists :</label>
		<select name="category_type[]" id="category_type" multiple>
			<option value="">Select Artists Type</option>
            <?php 
				foreach($artist as $value){
					//$art[] = $value->first_name; 
					if($value->ID==set_value('category_type[]') || in_array($value->ID, $ids) == 1){	?>				
					   <option <?php echo set_select('category_type[]', $value->ID , TRUE); ?> value='<?php echo $value->ID?>'><?php echo  $value->first_name ?></option>
				 <?php } else { ?>
					   <option <?php echo set_select('category_type[]', $value->ID); ?> value='<?php echo $value->ID?>'><?php echo  $value->first_name ?></option>					
				 <?php }				
				}
            ?>
        </select>
        <?php  echo form_error('category_type[]'); ?>
    </div>
    <div class="wit">
		<label>Exhibitions Type :</label>
		<select name="ex_type" id="ex_type">
			<option value="">Select Exhibitions Type</option>
            <option <?php if($exhibitions_data[0]->ex_type =='Solo') echo 'selected'; ?> value='Solo'>Solo</option>
            <option <?php if($exhibitions_data[0]->ex_type =='Group') echo 'selected'; ?> value='Group'>Group</option>
        </select>
        <?php  echo form_error('ex_type'); ?>
    </div>
	<div class="wit">
		<label>Title :</label>
		<input type="text" name="title" id="title" value="<?php if(set_value('title')) echo set_value('title'); else echo $data[0]->title; ?>" />
		<?php  echo form_error('title'); ?>
    </div>
    
    <div class="wit">
        <div>
          <label>Date :</label>
          <span class="datepair" data-language="javascript">
			<input type="text" value="<?php if(set_value('start_date')) echo set_value('start_date'); else echo $data[0]->start_date; ?>" name="start_date" class="date start ">
			<input type="hidden" name="start_time" autocomplete="off" value="12:00am" class="time start ui-timepicker-input">
			
			to
			<input type="hidden" name="end_time" autocomplete="off" value="11:59pm" class="time end ui-timepicker-input">
			<input type="text" name="end_date" value="<?php if(set_value('end_date')) echo set_value('end_date'); else echo $data[0]->end_date; ?>" class="date end ">
			<?php  echo form_error('start_date').' '; ?> <?php  echo ' '.form_error('end_date'); ?>
          </span>     
       </div>
    </div>
    <div class="wit">
        <label>Description :</label>
        <textarea name="description" id="content" ><?php if(set_value('description')) echo set_value('description'); else echo $data[0]->description; ?></textarea>
        <?php echo display_ckeditor($ckeditor); ?> <br />
        <?php echo form_error('description'); ?>
    </div>
    <div class="wit">
        <label>Active</label>
        <span class="radio-active">Yes</span>
        <input type="radio" name="active" <?php if($data[0]->active == 1) echo 'checked="checked"';?> value="1" />
        <span class="radio-active">No</span>
        <input type="radio" name="active"  value="0" <?php if($data[0]->active == 0) echo 'checked="checked"';?> />
    </div>
    <div class="wit">
		<label>Exhibition Image :</label>
		<input type="button" value="uploadfile" id="mulitplefileuploader"/>
		<select class="hide" multiple name="userimg[]" id="userimg"></select>	
		<?php  //echo form_error('userimg[]'); ?>
		
		<?php 
			if($exhibitions_img){ 
				foreach($exhibitions_img as $img){ ?>	
					<div class="edit-img">
						<div class="s-image"><img height='80' width='80' src="<?php echo base_url()."uploads/".$img->image ?>" /></div>
						<div class="b-delete"><a href="javascript:void(0)" onclick="works_img_delete(<?php echo $img->id ?>)">Delete</a></div>
					</div>
				<?php }
			}
		?>
		
		
		<p id="files"> </p>   
    </div> 	 
   <div class="login_button">
	    <input type="button" value="Cancel" onclick="goBack()" class="login-btn " />
		<input type="submit" value="Save" name=" " class="login-btn " />
   </div>
   <?php echo  form_close();?>                    
   </div>      
 </div>
<script>
function goBack() {
    window.location.href = '<?php echo $site ?>';
}
$(document).ready(function(){

var settings = {
	url: "<?php echo site_url() ?>admin/exhibitions/upload_photo_vedio",
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
