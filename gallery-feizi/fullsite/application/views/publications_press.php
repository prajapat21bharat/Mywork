<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	$site=site_url().'publications/';
	$name = $this->uri->segment(2);
	//print_r($current);
?>
<?php $this->load->view('js_link');?>
<script>
  $(function() {
    /* initiate plugin */
    $("div.holder").jPages({
        containerID: "itemContainer",
        perPage: 10,
        midRange: 100,
        startRange: 1,
        endRange: 1,
        links: false,
        animation: false,
    });
});	 
</script>
<div class="main-content">
  <div class="row">
   <div class="span3 left-side">
   </div>
   <div class="span9 inner-content">	
		<div class="span3">
		    <div class="red-bg"><a href="<?php echo $site; ?>" alt="" >PUBLICATIONS/<div>PRESS</div></a></div>
		    <div class="link"><a href="<?php echo $site; ?>" class="<?php if($name=='') echo 'active';?>" alt="" >PUBLICATIONS ></a></div>
			<div class="link"><a href="<?php echo $site.'press/'; ?>" class="<?php if($name=='press') echo 'active';?>" alt="" >PRESS ></a></div>
		</div>
		
        <div class="span9"> 
			<div id="itemContainer" class="evt">
				
				<?php $date=''; foreach($press as $value){  
					$a = strtolower(str_replace(' ','_',$value->title)); 
					$title = preg_replace('/[^A-Za-z0-9_\-]/', '', $a); ?>	 
					<div class="inner-contents">					
						<?php $ims = explode(',',$value->image); ?>	
								<div class="start-date"><u><a href="<?php echo $site.'pdf/'.$title.'/'.$ims[0]; ?>"><?php echo $value->title; ?></a></u></div>
							    <div class="current-title"><?php echo $value->sub_title; ?></div>
					</div>								
				<?php } ?>	
				
			</div><div class="holder"></div> 
		</div>        
   </div>
   </div>
</div>
