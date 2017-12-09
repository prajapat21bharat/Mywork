<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
$site = site_url() . 'exhibitions/';
$name = $this->uri->segment(2);
//print_r($current[0]);
$ex = array();
$ex[] = $current[0];
?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/slider/css/style.css" />		
<script type="text/javascript" src="<?php echo base_url() ?>assets/slider/js/jquery.aw-showcase.js"></script>
<script type="text/javascript">
    $(document).ready(function()
    {
        $("#showcase").awShowcase(
                {
                    content_width: 610,
                    content_height: 367,
                    fit_to_parent: false,
                    auto: false,
                    interval: 3000,
                    continuous: false,
                    loading: true,
                    tooltip_width: 200,
                    tooltip_icon_width: 32,
                    tooltip_icon_height: 32,
                    tooltip_offsetx: 18,
                    tooltip_offsety: 0,
                    arrows: true,
                    buttons: true,
                    btn_numbers: true,
                    keybord_keys: true,
                    mousetrace: false, /* Trace x and y coordinates for the mouse */
                    pauseonover: true,
                    stoponclick: true,
                    transition: 'hslide', /* hslide/vslide/fade */
                    transition_delay: 300,
                    transition_speed: 500,
                    show_caption: 'onhover', /* onload/onhover/show */
                    thumbnails: true,
                    thumbnails_position: 'outside-last', /* outside-last/outside-first/inside-last/inside-first */
                    thumbnails_direction: 'horizontal', /* vertical/horizontal */
                    thumbnails_slidex: 0, /* 0 = auto / 1 = slide one thumbnail / 2 = slide two thumbnails / etc. */
                    dynamic_height: false, /* For dynamic height to work in webkit you need to set the width and height of images in the source. Usually works to only set the dimension of the first slide in the showcase. */
                    speed_change: false, /* Set to true to prevent users from swithing more then one slide at once. */
                    viewline: false /* If set to true content_width, thumbnails, transition and dynamic_height will be disabled. As for dynamic height you need to set the width and height of images in the source. */
                });
    });
</script>
<div class="main-content" id="block">
    <div class="row">
        <div class="span3 left-side">
        </div>
        <div class="span9 inner-content">	
            <div class="span3">
                <div class="red-bg"><a href="<?php echo $site; ?>" alt="" >EXHIBITIONS</a></div>
                <div class="link"><a href="<?php echo $site; ?>" class="<?php if ($name == '') echo 'active'; ?>" alt="" >CURRENT ></a></div>
                <div class="link"><a href="<?php echo $site . 'upcoming/'; ?>" class="<?php if ($name == 'upcoming') echo 'active'; ?>" alt="" >UPCOMING ></a></div>
                <div class="link"><a href="<?php echo $site . 'past/'; ?>" class="<?php if ($name == 'past') echo 'active'; ?>" alt="" >PAST ></a></div>
            </div>

            <div class="span9 right-side"> 			
                <?php foreach ($ex as $value) { ?>
                    <?php if ($value->title) { ?>						
                        <div class="" >
                            <div id="showcase" class="showcase">						  
                                <?php if ($imgs = explode(',', $value->image)) { ?>
                                    <?php foreach ($imgs as $img) { ?>
                                        <div class="showcase-slide" >
                                            <div class="showcase-content" >
                                                <img src="<?php echo base_url() . 'uploads/' . $img; ?>" alt="" width="566" height="367"  />
                                            </div>
                                        </div>
                                    <?php } ?>
                                <?php } ?>						  
                            </div>

                            <div class="ex-des"><?php echo $value->description ?></div>
                        </div>					
                    <?php } ?>			
                <?php } ?>		    
            </div>        
        </div>
    </div>
</div>

