<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$site=site_url().'news/';
$name = $this->uri->segment(2);
//print_r($next);
 ?>

<div class="main-content">
  <div class="row">
   <div class="span3 left-side"></div>
   <div class="span9 inner-content">	
		<div class="span3">
		    <div class="red-bg"><a href="<?php echo $site; ?>" alt="" >NEWS/EVENTS</a></div>
		    <div class="link"><a href="<?php echo $site; ?>" class="<?php if($name=='') echo 'active';?>" alt="" >CURRENT ></a></div>
			<div class="link"><a href="<?php echo $site.'upcoming/'; ?>" class="<?php if($name=='upcoming') echo 'active';?>" alt="" >UPCOMING ></a></div>
			<div class="link"><a href="<?php echo $site.'past/'; ?>" class="<?php if($name=='past') echo 'active';?>" alt="" >PAST ></a></div>
		        <div class="link"><a href="<?php echo $site.'newsDetail'; ?>" class="<?php if($name=='newsDetail') echo 'active';?>" alt="" >NEWS ></a></div>
                </div>
		
        <div class="span9"> 
			<div id="itemContainer" class="evt">							
				<?php $date='';
				 foreach($artist_news as $value){ 
					
					
					 ?>										
					<?php if($date != date("Y", strtotime($value->start_date))){ ?>
						<?php if($date!=''){ ?></div><div class="inner-contents"><?php } ?>
						<div class="start-date"><?php echo $date = date("Y", strtotime($value->start_date)); ?></div>
					<?php } ?>					  
						<div class="n-title"><?php echo '<b>'.$value->title1.'</b>'.$value->description?></div>									
				<?php } ?>
			</div>	<!--<div class="holder"></div> -->   
		</div>        
     </div>
   </div>
</div>
