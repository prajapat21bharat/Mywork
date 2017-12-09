<!DOCTYPE html>
<html lang="en">
		<head>
		<meta http-equiv="Content-Type" content="text/html" charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="keywords" content="">
		<meta name="author" content="">
		<title>Owner</title>
        <link rel="shortcut icon" href="<?php echo base_url().'assets/images/favicon.ico';?>" type="image/x-icon" />
<link rel="apple-touch-icon" href="<?php echo base_url().'assets/images/favicon.ico';?>"/>
		<link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
		<link href="<?php echo base_url('assets/css/bootstrap-responsive.min.css') ?>" rel="stylesheet">
		<link href="<?php echo base_url('assets/css/font-awesome.css') ?>" rel="stylesheet">
		<link href="<?php echo base_url('assets/css/custom.css') ?>" rel="stylesheet">
		<link href="<?php echo base_url('assets/css/jquery.fancybox.css');?>"  rel="stylesheet" />
        <link href="<?php echo base_url('assets/css/admin_owner.css') ?>" rel="stylesheet"/>
		<link href="<?php echo base_url('assets/css/apetizer-admin.css') ?>" rel="stylesheet"/>
        <?php /*?><link href="<?php echo base_url('assets/css/toltip.css') ?>" rel="stylesheet"/><?php */?>
       
		<!--------------Date and Time ---------------->
		<link href="<?php echo base_url('assets/css/jquery.timepicker.css') ?>" rel="stylesheet" />
		<link href="<?php echo base_url('assets/css/base.css') ?>" rel="stylesheet"/>
        
		<!--------------END Date and Time ---------------->
		
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/lodash.js/1.2.1/lodash.min.js"></script>
        
		<script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
		<script src="<?php echo base_url('assets/js/custom.js') ?>"></script>
		<script  src="<?php echo base_url('assets/js/jquery.mousewheel-3.0.6.pack.js') ?>"></script>
		<script  src="<?php echo base_url('assets/js/jquery.fancybox.js?v=2.1.5') ?>"></script>

		<!--------------Slider Image ---------------->
        <?php 
		 $slider=base_url().'assets/slider/'?>
		
		<link rel="stylesheet" type="text/css" href="<?=$slider?>index_data/preview.css" media="screen">
		<link rel="stylesheet" type="text/css" href="<?=$slider?>index_data/settings.css" media="screen">
        <link rel="stylesheet" href="<?=$slider?>index_data/jquery.css" type="text/css" media="screen">
        <link href="<?=$slider?>index_data/css.css" rel="stylesheet" type="text/css">
		<link href="<?=$slider?>index_data/css_002.css" rel="stylesheet" type="text/css">
        <?php if($this->uri->segment('2')!='subscribe' && $this->uri->segment('3')!='menu_sort'){ ?>
       <? $last = end($this->uri->segments);
		  
		 if($last!='add_event' && $last!='add_offer') 
		 { ?>
        <script type="text/javascript" src="<?=$slider?>index_data/jquery_004.js"></script>
		<script type="text/javascript" src="<?=$slider?>index_data/jquery_003.js"></script>
		<script type="text/javascript" src="<?=$slider?>index_data/jquery.js"></script>
		<script type="text/javascript" src="<?=$slider?>index_data/jquery_002.js"></script>
		<script type="text/javascript">

	jQuery(document).ready(function() {

		jQuery('#example1').showbizpro({
			dragAndScroll:"on",
			visibleElementsArray:[4,3,2,1],
			carousel:"off",
			entrySizeOffset:0,
			allEntryAtOnce:"off",
			speed:500,
			autoPlay:"on",
			rewindFromEnd:"on",
			delay:3000
		});

  jQuery(".fancybox").fancybox();

           });
      </script>
	<?php } ?>
		    
		<!--------------END Slider Image ---------------->
		
		<script type="text/javascript">
		$(document).ready(function() {
			$('.fancybox').fancybox();
			
		});
		
		</script>
    <?php /*?> <script type="text/javascript" src="<?php echo base_url('assets/js/toltip.js') ?>"></script><?php */?>
		<!--------------Date and Time ---------------->
		<script src="<?php echo base_url('assets/js/date_time.js') ?>"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.timepicker.js') ?>"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/js/base.js') ?>"></script>
		<!--------------END Date and Time ---------------->
        
        <? } ?>
		</head>
		<body>
        
        <div class="container-fluid top-header owner">
            <a class="btn btn-navbar hidden-desktop mob_btn" data-toggle="collapse" data-target=".nav-collapse"> 
            <span class="icon-bar"></span> 
            <span class="icon-bar"></span> 
            <span class="icon-bar"></span> 
            </a>
            
          <div class="subnav nav-collapse collapse">
            <ul class="nav nav-pills">
              <?php $site=site_url().'owner/';?>
              <?php if($this->session->userdata('group')=='2'){?>
              <li <? if(is_active()): ?>class="active"<? endif; ?>><a href="<?=$site.'home/' ?>">Dashboard</a></li>
              <?php } ?>
             
              <ul class="nav nav-pills pull-right">
                <?php if($this->session->userdata('group')=='2'){?>
                 <li><a href="<?=$site.'changepassword' ?>">Change Password</a></li>
                <li><a href="<?=$site.'/login/logout' ?>">Logout</a></li>
                <?php } ?>
              </ul>
            </ul>
          </div>
    </div>
              
           <div class="row-fluid">
      <div class="span12">&nbsp;</div>
    </div>
          <?=$content_for_layout?>
        
        
        
   
</body>
</html>
