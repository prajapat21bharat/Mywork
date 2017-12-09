<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$site=site_url().'news/';
$name = $this->uri->segment(2);
//print_r($next);
 ?>
<?php //$this->load->view('js_link');?>
<!--
<script>
  $(function() {
    /* initiate plugin */
    $("div.holder").jPages({
        containerID: "itemContainer",
        perPage: 2,
        midRange: 100,
        startRange: 1,
        endRange: 1,
        links: false,
        animation: false,
    });
});	 
</script>-->
<div class="main-content">
  <div class="row">
   <div class="span3 left-side">
   </div>
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
			<?php $date=''; foreach($past as $value){ ?>
				<?php $im = explode(',',$value->image); ?>
				<div class="inner-contents" >
					<div class="pub-img">
						<img alt="" src="<?php echo base_url().'uploads/'.$im[0]; ?>">
					</div>
					<?php
						$sDate = strtotime($value->start_date);
						$nDate = strtotime($value->end_date);
					?>
					<?php if($date != date("Y", $sDate)){ ?>
                                       <?php if($value->palais !='-'){
                                           $urlPalais = $value->palais;
                                       }else{
                                            $urlPalais = 'javascript:void(0)';
                                       }
?>
                                    
						<?php if($date!=''){ ?></div><div class="inner-contents"><?php } ?>
						<div class="start-date"><a href="<?php echo $urlPalais; ?>"><u><?php echo $value->title1 ?></u></a></div>
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
								}
								echo ' '.date("F Y", $sDate); 
							?>
						</div>
					</div>	  									
			<?php } ?>	
			</div>   
			<!--<div class="holder"></div>-->
		</div>        
   </div>
   </div>
</div>
