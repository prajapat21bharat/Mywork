<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	$site=site_url().'artist/';
	//print_r($error_msg);
    //echo $this->db->last_query();
if($error_msg != 'error_msg'){	
?>
<?php // for user ids
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
?>
<?php // for works ids
	$work_ids = array(); 
	$works_check_id = $works_id;
	foreach($artist_works_ids as $works_id)
	{
		$works_ids[] = $works_id->works_id;
	}
	$works_posiotion = array_search($works_check_id, $works_ids);
	$works_lastValue = end($works_ids);
	$works_lastKey = key($works_ids);
	if($works_lastValue == $works_check_id)
	{
		$works_next = 0;
		$works_pre  = $works_posiotion-1;
	}
	elseif($works_ids[0] == $works_check_id)
	{
		$works_next = $works_posiotion+1;
		$works_pre  = $works_lastKey;
	}
	else
	{
		$works_next = $works_posiotion+1;
		$works_pre  = $works_posiotion-1;
	}	
	
	//$obj = New Artist;
	//$nid = $obj->img_works_ids($ids[$next]);
	//$pid = $obj->img_works_ids($ids[$pre]);
        
        $next= $this->query_model->url($ids[$next]);
        $pre= $this->query_model->url($ids[$pre]);
?>
<div class="main-content">
  <div class="row">
	  <div class="span3 left-side">
		<div class="slider">
			<h5>NEXT/PREVIOUS ARTIST
			<span class="nex"><a href="<?php echo $site.'works/'.$next; ?>" ><img src="<?php echo base_url()."assets/images/next-icon.png"; ?>" alt="" width="10" height="13" /></a></span>
			<span class="pre"><a href="<?php echo $site.'works/'.$pre; ?>" ><img src="<?php echo base_url()."assets/images/pre-icon.png"; ?>" alt="" width="10" height="13" /></a></span>       
			</h5>
		</div>
	  </div>
<div class="span9 inner-content">	
	<div class="span3">
		<div><?php $this->load->view('artist_link');?>
        <div class="art-lilnks">
		<?php //print_r($detail); 
			foreach($detail as $val){ ?>
				<div class="link art-des"><?php echo $val->title ?></div>
				<!--<div class="link art-des">NO. 2</a></div>-->
				<div class="link art-des"><?php echo $cat[$val->cat_id-1]->cat_name; ?></div>
				<div class="link art-des"><?php echo $val->dimension ?></div>
				<div class="link art-des"><?php //echo $val->edition ?></div>
				<div class="link art-des"><?php //echo $val->market_price ?></div>
				<div class="link art-des"><?php //echo $val->remark ?></div>
				<div class="link art-des"><?php echo date("Y", strtotime($val->work_date)); ?></div>
                                <div class="link art-des"><?php if($val->edition != '-'){echo $val->edition;}else{} ?></div>
                                <div class="link art-des"><?php if($val->market_price != '-'){echo $val->market_price; }else{}?></div>
                                <div class="link art-des"><?php if($val->description){echo 'Description :'.$val->description;}else{} ?></div>
                                
			<?php  }
		?>
                                
      
        </div>
        </div>
	</div>
  <div class="span9 slide-show">		
	<span class="nex">
		<a href="<?php echo $site.'detail/'.$check_id.'/'.$works_ids[$works_next]; ?>">
		</a>
	</span>
	<span class="pre">
		<a href="<?php echo @$site.'detail/'.$check_id.'/'.$works_ids[$works_pre]; ?>">
		</a>
	</span>
	<?php if($detail[0]->image){ ?>
	<?php if($imgs = explode(',',$detail[0]->image)){?>          
		<?php foreach($imgs as $img){ ?> 						
			<div class="works-content-img">
				<img src="<?php echo base_url()."uploads/".$img; ?>" style="width:100%; height:100%;" />
			</div>
		<?php } ?>			
	<?php } ?>		
	<?php } ?>
  </div>
  
  
</div> 
</div>
</div>
<?php }else{ echo '<div class="msg_err">The page you requested was not found.</div>'; }?> 

