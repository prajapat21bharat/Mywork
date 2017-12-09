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

$(function() {
    $('#popupDatepicker').datepick();
});

function toggleContent() { 
  
	var contentId = document.getElementById("form-data");  
	contentId.style.display == "block" ? contentId.style.display = "none" : 
	contentId.style.display = "block"; 
	
	var content = document.getElementById("work-data");  
	content.style.display == "none" ? content.style.display = "block" : 
	content.style.display = "none"; 
}

function works_delete(id){	
	var r=confirm('Are Sure Delete This News');
	if (r==true)
	{
		var form_data = {work_id:id};
		$.ajax({
			url:'<?php echo $site.'delete';?>',
			data:form_data,    
			datatype:'json',
			success:function(data){ 
				$('#'+id).hide();
				location.reload();  
			}
		});
	}

}

function img_delete(name){ 
	var a = name.split(".");
	$("#userimg option[value='"+name+"']").remove();
	$("#"+a).remove(); 
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

function goBack() {
    window.location.href = '<?php echo $site.'add/'.$this->uri->segment(4) ?>';
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

<!---its is a Profile EDIT Div---> 
<div class="menu_itemshow show-form">	
	<a class="login-btn" href="javascript:void(0)" onclick="toggleContent()">Add Works</a>
</div>
<?php $form_error = validation_errors(); ?>
<?php if(empty($works)){$block = 'block';}else{ if(!$form_error) $block = 'none'; else $block = 'block';}?>
<div class="form-data" id="form-data" style="display:<?php echo $block; ?>;">  
  <?php $edit=array('class'=>'edit_form white_bg'); 
    echo form_open_multipart(site_url().'admin/works/add/'.$this->uri->segment(4),$edit);?> 
	<div class="wit">
		<label>Title :</label>
		<input type="text" name="title" id="title" value="<?php echo set_value('title'); ?>" />
		<?php  echo form_error('title'); ?>			
    </div>
    <div class="wit">
		<label> Dimension (cm) :</label>
		<input type="text" name="dimension" id="title" value="<?php echo set_value('dimension'); ?>" />
		<?php  echo form_error('dimension'); ?>			
    </div>
    <div class="wit">
		<label>Edition :</label>
		<input type="text" name="edition" id="title" value="<?php echo set_value('edition'); ?>" />
		<?php  echo form_error('edition'); ?>			
    </div>
    <div class="wit">
		<label>Market Price(euro) :</label>
		<input type="text" name="market_price" id="market_price" value="<?php echo set_value('market_price'); ?>" />
		<?php  echo form_error('market_price'); ?>			
    </div>
    <div class="wit">
		<label>Remark :</label>
		<input type="text" name="remark" id="remark" value="<?php echo set_value('remark'); ?>" />
		<?php  echo form_error('remark'); ?>			
    </div>
    <div class="wit">
		<div>
          <label>Date :</label>
          <span class="datepair" data-language="javascript">
			<input type="text" value="<?php echo set_value('start_date'); ?>" name="start_date" class="date start ">		
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
		<label>Description :</label>
		<textarea name="workdes" id="content" /><?php echo set_value('workdes'); ?></textarea>
		<?php  echo form_error('workdes'); ?>
		<?php echo display_ckeditor($ckeditor); ?>
    </div>
	<div class="wit">
		<label>Works Image :</label>
		<input type="button" value="uploadfile" id="mulitplefileuploader"/>
		<!--<input  value="<?php //echo set_value('userimg'); ?>"  class="userimg" name="userimg">-->
		<select class="hide" multiple name="userimg[]" id="userimg">
			<?php 
			if($imgs){ 
				foreach($imgs as $img){ ?>							
					<option selected value='<?php echo $img; ?>' ><?php echo $img; ?></option>							
				<?php }
			} ?>
		</select>
		<!-- For crop postion -->
		<input type="hidden" id="x" name="x" />
		<input type="hidden" id="y" name="y" />
		<input type="hidden" id="w" name="w" />
		<input type="hidden" id="h" name="h" />
		<!-- For crop postion end-->
		<?php 
		if($imgs){ 
			foreach($imgs as $img1){ ?>				
					<div class="edit-img" id="<?php $a = explode('.',$img1); echo $a[0]; ?>">
						<div class="s-image"><img height='80' width='80' src="<?php echo base_url()."uploads/".$img1; ?>" /></div>
						<div class="b-delete"><a href="javascript:void(0)" onclick="img_delete('<?php echo $img1; ?>')">Delete</a></div>
					</div>				
			<?php }
		}
		?>	
		<p id="files" class="cropfile">
			<?php 
				if(set_value('userimg[]'))
					echo "<img height='80' width='80' src='".base_url()."uploads/".set_value('userimg[]')."'/>";
			?>
		</p>
		<p>After Browse Select the part on your image that needs cropping, and press 'Save' when done to crop.</p>
		<?php echo form_error('userimg[]'); ?>
    </div> 
    <!--<img width="600" height="auto" src="http://www.gallery-feizi.com/uploads/4141845731448347354.jpg" class="crop-img" id="cropbox">-->
    <input type="hidden" name="id" value="<?php echo $this->uri->segment(4)?>">	 
   <div class="login_button">
	    <input type="button" value="Cancel" class="login-btn" onclick="goBack()" />
		<input type="submit" value="Save" name=" " class="login-btn " />
   </div>
   <?php echo  form_close();?>          
 </div>   
 <div class="work-data" id="work-data" <?php if($form_error) echo 'style="display:none;"'; ?>>
	 <?php foreach($works as $val){ ?>
		 <div class="content">	
			 <div class="up-img">				 
				 <?php 
					if(!empty($val->image)){
						$imgarr=explode(',',$val->image);
						foreach($imgarr as $imgarr){ ?>				 
							<img src="<?php echo base_url()."uploads/".$imgarr ?>" width="100" height="60" alt=""/>
						<?php }
					} ?>
			 </div>
			 <div class="up-data">
				 <div class="artist-type"><span>Title :</span><span class="artist-contant"><?php echo $val->title ?></span></div>
				 <div class="artist-type"><span>Date :</span><span class="artist-contant"><?php echo $val->work_date ?></span></div>
				 <div class="artist-type"><span>Category :</span><span class="artist-contant"><?php echo $art[$val->cat_id - 1] ?></span></div>
				 <div class="artist-type"><span>Edition :</span><span class="artist-contant"><?php echo $val->edition ?></span></div>
				 <div class="artist-type"><span>Market Price :</span><span class="artist-contant"><?php echo $val->market_price ?></span></div>
				 <div class="artist-type"><span>Description :</span><span class="artist-contant"><?php echo $val->description ?></span></div>
				 <div class="edit-del">
					 <span><a href="<?php echo $site.'edit/'.$this->uri->segment(4).'/'.$val->id;?>" >Edit |</a></span> 
					 <span><a href="javascript:void(0)" onclick="works_delete('<?php echo $val->id ?>')">Delete</a></span>
				 </div>
			 </div>
		 </div>
	<?php } ?>
</div>
       
   </div>      
 </div>
 
 <script>
$(document).ready(function(){

var settings = {
	url: "<?php echo site_url() ?>admin/works/upload_photo_vedio",
	method: "POST",
	allowedTypes:"jpeg,jpg,png,gif,swf,wmv,mp4,ogg",
	fileName: "myfile",
	multiple: true,
	onSuccess:function(data,files,xhr){ 
		var str = '"'+files+'"';		
		$("#files").append("<div class='edit-img' id='"+parseInt(files)+"'><div class='s-image'><img id='cropbox' class='cropbox' width='500' class='crop-img' src='<?php echo base_url() ?>uploads/"+files+"'/></div><div class='b-delete'><a href='javascript:void(0)' onclick='img_delete("+str+")'>Delete</a></div></div><div id='preview-pane'><div class='preview-container'><img src='<?php echo base_url() ?>uploads/"+files+"' class='jcrop-preview' alt='Preview' id='preview'/></div></div>");
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
