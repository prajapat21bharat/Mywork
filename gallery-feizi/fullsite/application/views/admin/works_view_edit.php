<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $site=site_url().'admin/works/'; ?>
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
<script type="text/javascript">
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
      <h3 class="title">Works Information</h3>
      <?php $this->load->view('admin/nav');?>	    
   
  <div class="success_msg"> 
    <?php if(!empty($success)){
           echo $success;
	       } ?>
	 <?php echo $this->session->flashdata('work_msg');?>      
  </div>               

<div class="form-data" id="form-data" style="display:block !important;">  
  <?php $edit=array('class'=>'edit_form white_bg'); 
    echo form_open_multipart('',$edit);?> 
	<div class="wit">
		<label>Title :</label>
		<input type="text" name="title" id="title" value="<?php if(set_value('title')) echo set_value('title'); else echo $work_data[0]->title; ?>" />
		<?php  echo form_error('title'); ?>
    </div>
    <div class="wit">
		<label> Dimension (cm) :</label>
		<input type="text" name="dimension" id="dimension" value="<?php if(set_value('dimension')) echo set_value('dimension'); else echo $work_data[0]->dimension; ?>" />
		<?php  echo form_error('dimension'); ?>			
    </div>
    <div class="wit">
		<label>Edition :</label>
		<input type="text" name="edition" id="edition" value="<?php if(set_value('edition')) echo set_value('edition'); else echo $work_data[0]->edition; ?>" />
		<?php  echo form_error('edition'); ?>			
    </div>
    <div class="wit">
		<label>Market Price(euro) :</label>
		<input type="text" name="market_price" id="market_price" value="<?php if(set_value('market_price')) echo set_value('market_price'); else echo $work_data[0]->market_price; ?>" />
		<?php  echo form_error('market_price'); ?>			
    </div>
    <div class="wit">
		<label>Remark :</label>
		<input type="text" name="remark" id="remark" value="<?php if(set_value('remark')) echo set_value('remark'); else echo $work_data[0]->remark; ?>" />
		<?php  echo form_error('remark'); ?>			
    </div>
    <div class="wit">
		<div>
          <label>Date :</label>
          <span class="datepair" data-language="javascript">
			<input type="text" value="<?php if(set_value('start_date')) echo set_value('start_date'); else echo $work_data[0]->work_date; ?>" name="start_date" class="date start ">		
			<?php  echo form_error('start_date').' '; ?>
          </span>     
       </div>
    </div>
	<div class="wit">
		<label>Category Type :</label>
		<select name="category_type" id="category_type">
			<option value="">Select Category Type</option>
            <?php 
				foreach($cat as $value){ 
					$art[] = $value->cat_name;
					if($value->cat_id==set_value('category_type' ) || $value->cat_id==$work_data[0]->cat_id){	?>				
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
		<label>Description :</label>
		<textarea name="workdes" id="content" /><?php echo $work_data[0]->description; ?></textarea>
		<?php  echo form_error('workdes'); ?>
		<?php echo display_ckeditor($ckeditor); ?>
    </div> 	
	<div class="wit">
    <label>Works Image :</label>
    <input type="button" value="uploadfile" id="mulitplefileuploader"/>
    
    <select class="hide" multiple name="userimg[]" id="userimg"></select>	
	<?php  echo form_error('userimg[]'); ?>
    <?php 
		if($work_img){ 
			foreach($work_img as $img){ ?>	
				<div class="edit-img">
					<div class="s-image"><img  width='80' src="<?php echo base_url()."uploads/".$img->image ?>" /></div>
					<div class="b-delete"><a href="javascript:void(0)" onclick="works_img_delete(<?php echo $img->id ?>)">Delete</a></div>
				</div>
			<?php }
		}
	?>
	<!-- For crop postion -->
		<input type="hidden" id="x" name="x" />
		<input type="hidden" id="y" name="y" />
		<input type="hidden" id="w" name="w" />
		<input type="hidden" id="h" name="h" />
		<!-- For crop postion end-->
    <p id="files"> </p>
    
    </div> 
	<p>After Browse Select the part on your image that needs cropping, and press 'Save' when done to crop.</p>
	
	
    <input type="hidden" name="id" value="<?php echo $this->uri->segment(5)?>">	 
   <div class="login_button">
	   <input type="button" value="Cancl" onclick="goBack()" class="login-btn " />
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
$(document).ready(function(){

var settings = {
	url: "<?php echo site_url() ?>admin/works/upload_photo_vedio",
	method: "POST",
	allowedTypes:"jpeg,jpg,png,gif,swf,wmv,mp4,ogg",
	fileName: "myfile",
	multiple: true,
	onSuccess:function(data,files,xhr){
		var str = '"'+files+'"'
		$("#files").append("<div class='edit-img' id='"+parseInt(files)+"'><div class='s-image'><img id='cropbox' width='500' src='<?php echo base_url() ?>uploads/"+files+"'/></div><div class='b-delete'><a href='javascript:void(0)' onclick='img_delete("+str+")'>Delete</a></div></div><div id='preview-pane'><div class='preview-container'><img src='<?php echo base_url() ?>uploads/"+files+"' class='jcrop-preview' alt='Preview' id='preview'/></div></div>");
		//$("#userimg").(files); 
		$("#userimg").append("<option selected value='"+files+"' >"+files+"</option>");
		crop_selection();
	},
	onError: function(files,status,errMsg){		
		$("#status").append("<font color='red'>Upload is Failed</font>");
	}
}
$("#mulitplefileuploader").uploadFile(settings);

});
</script>
 
  
<link rel="stylesheet" href="<?php echo base_url('assets/js/image_crop/jquery.Jcrop.css') ?>" type="text/css" />
<script type="text/javascript">

function crop_selection()
{
     var jcrop_api,
        boundx,
        boundy,

        // Grab some information about the preview pane
        $pcnt = $('#preview-pane .preview-container'),
        $pimg = $('#preview-pane .preview-container img'),

        xsize = $pcnt.width(),
        ysize = $pcnt.height();
    
    console.log('init',[xsize,ysize]);
    $('#cropbox').Jcrop({
      onChange: updatePreview,
      onSelect: updatePreview,
      onSelect: updateCoords,
      aspectRatio: xsize / ysize
    },function(){
      // Use the API to get the real image size
      var bounds = this.getBounds();
      boundx = bounds[0];
      boundy = bounds[1];
      // Store the API in the jcrop_api variable
      jcrop_api = this;

    });

    function updatePreview(c)
    {
      if (parseInt(c.w) > 0)
      {
        var rx = xsize / c.w;
        var ry = ysize / c.h;

        $('#preview').css({
          width: Math.round(rx * boundx) + 'px',
          height: Math.round(ry * boundy) + 'px',
          marginLeft: '-' + Math.round(rx * c.x) + 'px',
          marginTop: '-' + Math.round(ry * c.y) + 'px'
        });
      }
    };


}

  function updateCoords(c)
  {
    $('#x').val(c.x);
    $('#y').val(c.y);
    $('#w').val(c.w);
    $('#h').val(c.h);
  };


</script>

<style type="text/css">



/* The Javascript code will set the aspect ratio of the crop
   area based on the size of the thumbnail preview,
   specified here */
#preview-pane .preview-container {
  width: 250px;
  height: 170px;
  overflow: hidden;
}

</style>
