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
         <span class="nex"><a href="<?php echo $site.'news/'.$next; ?>" ><img src="<?php echo base_url()."assets/images/next-icon.png"; ?>" alt="" width="10" height="13" /></a></span>
         <span class="pre"><a href="<?php echo $site.'news/'.$pre; ?>" ><img src="<?php echo base_url()."assets/images/pre-icon.png"; ?>" alt="" width="10" height="13" /></a></span>
       
       </h5>
	</div>
    </div>
	
	<div class="span9 inner-content">
		<div class="span3">
		   <?php $this->load->view('artist_link');?>
		</div>		
		<div class="span9"> 
			<div class="inner-contents">
				<?php $date='';
				 foreach($artist_news as $value){ 
					
					
					 ?>										
					<?php if($date != date("Y", strtotime($value->start_date))){ ?>
						<?php if($date!=''){ ?></div><div class="inner-contents"><?php } ?>
						<div class="start-date"><?php echo $date = date("Y", strtotime($value->start_date)); ?></div>
					<?php } ?>					  
						<div class="n-title"><?php echo '<b>'.$value->title1.'</b>'.$value->description?></div>									
				<?php } ?>	
			</div>	    
		</div>  		
	</div>
</div>
</div>
