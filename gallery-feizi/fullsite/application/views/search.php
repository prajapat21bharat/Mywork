<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$site=site_url()."home/index/";
//print_r($next);
 ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/slider/css/style.css" />		
<script type="text/javascript" src="<?php echo base_url() ?>assets/slider/js/jquery.aw-showcase.js"></script>
<!--<script type="text/javascript">
$(document).ready(function()
{
	$("#showcase").awShowcase(
	{
		content_width:			610,
		content_height:			367,
		fit_to_parent:			false,
		auto:					true,
		interval:				8000,
		continuous:				true,
		loading:				true,
		tooltip_width:			200,
		tooltip_icon_width:		32,
		tooltip_icon_height:	32,
		tooltip_offsetx:		18,
		tooltip_offsety:		0,
		arrows:					true,
		buttons:				true,
		btn_numbers:			true,
		keybord_keys:			true,
		mousetrace:				false, /* Trace x and y coordinates for the mouse */
		pauseonover:			true,
		stoponclick:			true,
		transition:				'hslide', /* hslide/vslide/fade */
		transition_delay:		300,
		transition_speed:		500,
		show_caption:			'onhover', /* onload/onhover/show */
		thumbnails:				true,
		thumbnails_position:	'outside-last', /* outside-last/outside-first/inside-last/inside-first */
		thumbnails_direction:	'horizontal', /* vertical/horizontal */
		thumbnails_slidex:		0, /* 0 = auto / 1 = slide one thumbnail / 2 = slide two thumbnails / etc. */
		dynamic_height:			false, /* For dynamic height to work in webkit you need to set the width and height of images in the source. Usually works to only set the dimension of the first slide in the showcase. */
		speed_change:			false, /* Set to true to prevent users from swithing more then one slide at once. */
		viewline:				false /* If set to true content_width, thumbnails, transition and dynamic_height will be disabled. As for dynamic height you need to set the width and height of images in the source. */
	});
});
</script>-->
<div class="main-content"> 
  <div id="beta" class="container isotope">
 <?php  if($search_data) {
'<pre>';
//print_r($search_data);
'</pre>';
	  }?>

        <div class="span6">
			<div id="itemContainer" class="evt">
				<div class="search-bg" style="background: none repeat scroll 0 0 #cf2027;"><a>Exhibitions</a> </div>
				<?php $date=''; foreach($search_data as $value){ 
					if($value->tableName=='exhibitions'){
					
					?>
					<?php $im = explode(',',$value->image); ?>
					<div class="inner-contents">
						<div class="pub-img">
							<img alt="" src="<?php echo base_url().'uploads/'.$im[0]; ?>">
						</div>
						<?php
					
						 $sDate = strtotime($value->start_date);
						 $nDate = strtotime($value->end_date);
						?>
						<?php if($date != date("Y", $sDate)){ ?>
                                            <?php if($value->palais !='-' ){
                                            $urlPalais = $value->palais;
                                                }else{
                                            $urlPalais = 'javascript:void(0)';
                                         }
                                         ?>
							<?php if($date!=''){ ?></div><div class="inner-contents"><?php } ?>
							<div class="start-date"><a href="<?php //echo $urlPalais; ?>"><u><?php echo $value->title ?></u></a></div>
						<?php } ?>
						<?php 						
							$startDate = new DateTime(date("Ymd", $sDate));
							$endDate = new DateTime(date("Ymd", $nDate));
							$interval = $startDate->diff($endDate);
							$diff = $interval->days;					
						 ?>
						<div class="current-title">
							<?php 
								if($diff == 0){
									echo date("d", $sDate);
								}else if($diff == 1){
									echo date("d", $sDate) .' & '. date("d", $nDate);
								}else{
									echo date("d", $sDate) .' > '. date("d", $nDate);
									
									//echo $value->start_date.' > '.$value->end_date;
								}
								echo ' '.date("F Y", $nDate); 
							?>
						</div>	
					</div>								
				 <?php } }?>
			</div>   
			</div>  

	<div class="span6">
			<div id="itemContainer" class="evt">
				<div class="search-bg" style="background: none repeat scroll 0 0 #cf2027;"><a>News/Events</a></div>
				<?php $date=''; foreach($search_data as $value){ 
					if($value->tableName=='news'){
					
					?>
					<?php $im = explode(',',$value->image); ?>
					<div class="inner-contents">
						<div class="pub-img">
							<img alt="" src="<?php echo base_url().'uploads/'.$im[0]; ?>">
						</div>
						<?php
					
						 $sDate = strtotime($value->start_date);
						 $nDate = strtotime($value->end_date);
						?>
						<?php if($date != date("Y", $sDate)){ ?>
                                            <?php if($value->palais !='-' ){
                                            $urlPalais = $value->palais;
                                                }else{
                                            $urlPalais = 'javascript:void(0)';
                                         }
                                         ?>
							<?php if($date!=''){ ?></div><div class="inner-contents"><?php } ?>
							<div class="start-date"><a href="<?php //echo $urlPalais; ?>"><u><?php echo $value->title ?></u></a></div>
						<?php } ?>
						<?php 						
							$startDate = new DateTime(date("Ymd", $sDate));
							$endDate = new DateTime(date("Ymd", $nDate));
							$interval = $startDate->diff($endDate);
							$diff = $interval->days;					
						 ?>
						<div class="current-title">
							<?php 
								if($diff == 0){
									echo date("d", $sDate);
								}else if($diff == 1){
									echo date("d", $sDate) .' & '. date("d", $nDate);
								}else{
									echo date("d", $sDate) .' > '. date("d", $nDate);
									
									//echo $value->start_date.' > '.$value->end_date;
								}
								echo ' '.date("F Y", $nDate); 
							?>
						</div>	
					</div>								
				 <?php } }?>
			</div>   
			</div>  
		
			
</div>
</div>
