<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	$site=site_url().'artist/';	
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
<div class="main-content">
   <div class="row">
   <div class="span3 left-side">
	<div class="slider">
		<h5>NEXT/PREVIOUS ARTIST
         <span class="nex"><a href="<?php echo $site.'press/'.$next; ?>" ><img src="<?php echo base_url()."assets/images/next-icon.png"; ?>" alt="" width="10" height="13" /></a></span>
         <span class="pre"><a href="<?php echo $site.'press/'.$pre; ?>" ><img src="<?php echo base_url()."assets/images/pre-icon.png"; ?>" alt="" width="10" height="13" /></a></span>
       
       </h5>
	</div>
    </div>
	
	<div class="span9 inner-content">
		<div class="span3">
		   <?php $this->load->view('artist_link');?>
		</div>
		<div class="span9">
			<div class="inner-contents">
				<?php $date=''; foreach($artist_press as $value){
                                  
                                   $imageArr = array_shift($this->query_model->GetArtistImageId($value->id));
                                   
                                         $a = strtolower(str_replace(' ','_',$value->title)); 
					$title = preg_replace('/[^A-Za-z0-9_\-]/', '', $a);
                                        //$ims = explode(',',$value->image)
                                        
                                        ?>										
					<?php if($date != date("Y", strtotime($value->start_date))){ ?>
						<?php if($date!=''){ ?></div><div class="inner-contents"><?php } ?>
						<div class="start-date"><?php echo $date = date("Y", strtotime($value->start_date)); ?></div>
					<?php } ?>					  
                                                <div class="n-title"><a href="<?php echo site_url().'publications/pdf/'.$title.'/'.$imageArr->image; ?>"><?php echo '<u><strong>'.$value->title.'</strong></u> '.$value->sub_title.', '.date("d M Y", strtotime($value->start_date)); ?></a></div>								
				<?php } ?>	
			</div>	
		</div>		
	</div>
</div>
</div>
