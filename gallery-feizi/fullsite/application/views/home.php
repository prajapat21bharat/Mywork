<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$site=site_url()."home/index/";
//print_r($next);
 ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/slider/css/style.css" />		
<script type="text/javascript" src="<?php echo base_url() ?>assets/slider/js/jquery.aw-showcase.js"></script>
<script type="text/javascript">
$(document).ready(function()
{
	$("#showcase").awShowcase(
	{
		content_width:			792,
		content_height:			600,
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
</script>
<div class="main-content" id="front"> 
  <div class="inner-content home">
  <div class="current-exhibition">
	  <div class="title"><?php echo $hometext->c_exhibition ?></div>
	  <div class="current-title"><?php echo htmlentities($hometext->c_title) ?></div>
	  <div class="current-date"><?php echo $hometext->c_date ; ?></div>
  </div>
    
	<div id="showcase" class="showcase" style="height: 600px;">
		<?php foreach($images as $img){ ?>
			<div class="showcase-slide" >
				<div class="showcase-content" >
					<img src="<?php echo base_url().'uploads/profile/'.$img->slide_image; ?>" alt="" width="792" height="600" id="block" />
				</div>
			</div>
		<?php } ?>
	</div>
  
  <div class="upcoming-exhibition">
	  <div class="up-title"><?php echo $hometext->u_exhibition ?></div>
          <div class="upcoming-title"><?php echo htmlentities($hometext->u_title) ?></div>
	  <div class="upcoming-date"><?php echo $hometext->u_date ?></div>
  </div>
</div>
</div>

