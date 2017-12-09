<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
$site = site_url() . 'exhibitions/';
$name = $this->uri->segment(2);
//print_r($next);
?>
<div class="main-content">
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
            <div class="span9"> 			
                <div class="inner-contents">
                    <?php
                    $date = '';
                    foreach ($past as $value) {
                        $Uid = explode(',', $value->user_id);
                        ?>										
                        <?php if ($date != date("Y", strtotime($value->start_date))) { ?>
                            <?php if ($date != '') { ?></div><div class="inner-contents"><?php } ?>
                            <div class="start-date"><?php echo $date = date("Y", strtotime($value->start_date)); ?></div>
                        <?php } ?>
                        <?php if ($imgs = explode(',', $value->image)) { ?>
                            <?php $thm = explode('.', $imgs[0]); ?>
                            <div class="ex-img"><a href="<?php echo site_url() . 'artist/exhibitions/' .$this->query_model->url(str_replace(',', '-', $value->user_id)); ?>"><img src="<?php echo base_url() . 'uploads/thumb_new/' . $thm[0] . '_thumb.' . $thm[1]; ?>" alt="" width="100" height="90" /></a></div>				  
                        <?php } ?>
                        <div class="n-title"><?php echo '<u>' . $value->title . '</u>' ?></div>	
                        <div class="ex-art"><u class="start-date"><a href="<?php echo site_url() . 'artist/exhibitions/' . $this->query_model->url(str_replace(',', '-', $value->user_id)); ?>">
                                    <?php
                                    $obj = new Exhibitions;
                                    echo $obj->name($value->user_id);
                                    ?></a></u>
                        </div>								
                    <?php } ?>	
                </div>       	    
            </div> 	
        </div>
    </div>
</div>
