<?php
$site = site_url() . 'artist/';
?>
<?php
$ids = array();
$check_id = $artist_data[0]->ID;
foreach ($artist_id as $id) {
    $ids[] = $id->ID;
}
$posiotion = array_search($check_id, $ids);
$lastValue = end($ids);
$lastKey = key($ids);
if ($lastValue == $check_id) {
    $next = 0;
    $pre = $posiotion - 1;
} elseif ($ids[0] == $check_id) {
    $next = $posiotion + 1;
    $pre = $lastKey;
} else {
    $next = $posiotion + 1;
    $pre = $posiotion - 1;
}

$next= $this->query_model->url($ids[$next]);
$pre= $this->query_model->url($ids[$pre]);

?>
<div class="main-content">
    <div class="row">
        <div class="span3 left-side">
            <div class="slider">
                <h5>NEXT/PREVIOUS ARTIST
                    <span class="nex"><a href="<?php echo $site . 'exhibitions/' . $next; ?>" ><img src="<?php echo base_url() . "assets/images/next-icon.png"; ?>" alt="" width="10" height="13" /></a></span>
                    <span class="pre"><a href="<?php echo $site . 'exhibitions/' . $pre; ?>" ><img src="<?php echo base_url() . "assets/images/pre-icon.png"; ?>" alt="" width="10" height="13" /></a></span>

                </h5>
            </div>
        </div>

        <div class="span9 inner-content">
            <div class="span3">
                <?php $this->load->view('artist_link'); ?>
               <!--<div class="pdf-file nb"><a href="<?php //echo $site.'pdf/exhibition';          ?>" id="pdf">Download PDF file</a></div>-->
            </div>

            <div class="span9"> 
                <div class="inner-contents">
                    <?php if ($solo_exhibitions) { ?><div class="solo">Selected Solo Exhibitions</div><?php } ?>
                    <?php
                    $date = '';
                    foreach ($solo_exhibitions as $value) {
                        $imageArr = array_shift($this->query_model->GetImagesByUid($value->id));
                        ?>										
                        <?php
                        if ($date != date("Y", strtotime($value->start_date))) {
                            if (strip_tags($value->description) != '-') {
                                $description = strip_tags($value->description);
                            } else {
                                $description = '';
                            }
                            ?>
                            <?php if ($date != '') { ?></div><div class="inner-contents"><?php } ?>
                            <div class="solo"><?php echo $date = date("Y", strtotime($value->start_date)); ?></div>
                        <?php } ?>					  
                        <div class="block-content"><?php //echo '<p><strong>' . $value->title . '</strong>' . $description . '</p>'; ?></div>								
                        <div class="p-ImageTag"><img src="<?php echo base_url() . 'uploads/' . $imageArr->image; ?>" alt=""/></div>
                    <?php } ?>	
                </div>	
                <div class="inner-contents">
                    <?php if ($group_exhibitions) { ?><div class="group">Selected Group Exhibitions</div><?php } ?>
                    <?php
                    $date = '';
                    foreach ($group_exhibitions as $value) {
                        $Uid = explode(',', $value->user_id);
                        $imageArr = array_shift($this->query_model->GetImagesByUid($value->id));
                       // print_r($value->description); die;
                        if ($value->description != '-') {
                            $description = strip_tags($value->description);
                        } else {
                            $description = '';
                        }
                        
                        //print_r( $description); die;
                        
                        
                        ?>										
                        <?php if ($date != date("Y", strtotime($value->start_date))) { ?>
                            <?php if ($date != '') { ?></div><div class="inner-contents"><?php } ?>
                            <div class="date"><?php echo $date = date("Y", strtotime($value->start_date)); ?></div>
                        <?php } ?>					  
                        <div class="block-content"><?php echo '<p><strong>' . $value->title . '</strong>' . $description . '</p>'; ?></div>
                        <div class="p-ImageTag"><img src="<?php echo base_url() . 'uploads/' . @$imageArr->image; ?>" alt=""/></div>
                        <?php } ?>	
                </div>	    
            </div>  



        </div>
    </div>
</div>
