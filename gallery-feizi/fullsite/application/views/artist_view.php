<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	$site=site_url().'artist/';
	//print_r($artist_data);
if($error_msg != 'error_msg'){
?>
<?php 
	$ids = array(); 
	$check_id = $artist_data[0]->ID;
	foreach($artist_id as $id){
		$ids[] = $id->ID;
	}
	$posiotion = array_search($check_id, $ids);
	$lastValue = end($ids);
	$lastKey = key($ids);
	if($lastValue == $check_id){
		$next = 0;
		$pre  = $posiotion-1;
	}elseif($ids[0] == $check_id){
		$next = $posiotion+1;
		$pre  = $lastKey;
	}else{
		$next = $posiotion+1;
		$pre  = $posiotion-1;
	}
        
        $next= $this->query_model->url($ids[$next]);
        $pre= $this->query_model->url($ids[$pre]);
?>
<style>
	/*
.span4.artist-img:nth-child(3n+1) {
    margin-left: 0 !important;
}	*/
</style>
<div class="main-content">
  <div class="row">
   <div class="span3 left-side">
	<div class="slider">
		<h5>NEXT/PREVIOUS ARTISTS
         <span class="nex"><a href="<?php echo $site.'works/'.$next; ?>" ><img src="<?php echo base_url()."assets/images/next-icon.png"; ?>" alt="" width="10" height="13" /></a></span>
         <span class="pre"><a href="<?php echo $site.'works/'.$pre; ?>" ><img src="<?php echo base_url()."assets/images/pre-icon.png"; ?>" alt="" width="10" height="13" /></a></span>
       
       </h5>
	</div>
	<div class="artist-cat">
		<?php foreach($cat as $val){?>
			<div class="block">
				<span class="name"><?php echo $val->cat_name; ?></span>
				<!--<span class="input"><label class="check-button" id="<?php //echo $val->cat_id; ?>"></label></span>-->
				<span class="input"><input type="checkbox" class="check-button1" id="<?php echo $val->cat_id; ?>"><label class="check-button" id="<?php echo 'chkb_'.$val->cat_id; ?>"></label></span>
			</div>
		<?php } ?>
	</div>
   </div>
   <div class="span9 inner-content">	
		<div class="span3">
		   <?php $this->load->view('artist_link');?>		   
		</div>
		<div class="span9 right-side-container">
        <div class="row">           
			<?php $chk=array(); ?>
			<?php foreach($artist_works as $img){  //print_r($img->image); ?> 				
			    <?php $imgs = explode(',',$img->image); if($imgs[0]){ ?>		    			                    
				<div class="span4 artist-img <?php //echo $class; ?>" id="imgCat_<?php echo $img->cat_id; ?>">
					<a href="<?php echo $site.'detail/'.$artist_data[0]->ID.'/'.$img->id; ?>" ><img src="<?php echo base_url()."uploads/crop/".$imgs[0]; ?>" alt="" width="159" height="159" /></a>
				</div>
			<?php } } ?> 
        </div>
		</div>

   </div>
   </div>
</div>
<script type="text/javascript"> 
$(document).ready(function(){
	//img_show_hide();
	chk_box();
	addCss();
	$('.check-button1').click(function(){ 		
		//img_show_hide();
		checked();
		addCss();
				
	});	
});	

function chk_box(){
	$('.check-button1').each(function () {			
		var id = $(this).attr("id");
		if($("div#imgCat_" + id).length != 0) {
			$("label#chkb_"+id).addClass('active');
			$('#'+id).prop("checked", true );
		 } 
	});
}

function addCss(){
	var counter = 1;
	$(".artist-img").each(function(){
		if($(this).css('display') == 'block'){
			if(counter == 4){
				$(this).css('margin-left','0px');
				counter = 1; 
			}else if(counter == 1){
				$(this).css('margin-left','0px');
			}else{
				$(this).css('margin-left','');
			}
			counter++;
		}
	});
}

function checked(){ 
	$(".check-button1").each(function(){
		var id = $(this).attr("id");
		
		if ($('#'+id).prop('checked')==true){ 
			$("div#imgCat_"+id).show();
			$("label#chkb_"+id).addClass('active');
		}else{
			$("div#imgCat_"+id).hide();
			$("label#chkb_"+id).removeClass('active');
		}
	});
}

</script>
<?php }else{ echo '<div class="msg_err">The page you requested was not found.</div>'; }?> 
