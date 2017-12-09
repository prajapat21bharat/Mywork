<?php 
	$site=site_url().'publications/';
	$name = $this->uri->segment(2);
	//print_r($publications);
?>
<?php //$this->load->view('js_link');?><!--
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
<style>
.span4:nth-child(3n+1) {
    margin-left: 0 !important;
}	
</style>
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
		
        <div class="span9" > 	
            <div id="itemContainer" class="publ">
			<?php foreach($publications as $value){ ?>	
			<?php $im = explode('.',$value->image);?>
			<?php $url = site_url().'artist/publications/'.$this->query_model->url($value->user_id); ?>
			<?php if($im[0]){ ?>
				<div class="inner-contents span4">					
					<div class="pub-img"><a href="<?php echo $url ?>"><img src="<?php echo base_url().'uploads/thumb_new/'.$im[0].'_thumb.'.$im[1]; ?>" width="100" height="150" alt="" /></a></div>
					<div class="start-date"><a href="<?php echo $url ?>"><?php echo $value->titre ?></a></div>							  
					<div class="n-title"><?php echo $value->title ?></div>
					<div class="n-title">Prix : <?php echo $value->prix.' &euro;' ?></div>					
				</div>
			<?php } ?>
			<?php } ?>	
			</div>
			<!--<div class="holder"></div>-->
		</div>        
   </div>
   </div>
</div>
