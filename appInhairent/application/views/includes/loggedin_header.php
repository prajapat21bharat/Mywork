<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <title>Inhairent</title>
      <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="shortcut icon" href="<?php echo base_url();?>assets/img/favicon.jpeg" type="image/jpeg" />
      <link href="<?php echo base_url();?>assets/css/font-awesome.css" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url();?>assets/css/bootstrap.css" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url();?>assets/css/animate.css" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url();?>assets/css/custom.css" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url();?>assets/css/admin.css" rel="stylesheet" type="text/css" />
      
      <link href="<?php echo base_url();?>assets/css/purple.css" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url();?>assets/css/jquery-ui.css" rel="stylesheet" type="text/css" />
      
      
      <link href="<?php echo base_url();?>assets/css/jquery-customselect.css" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url();?>assets/js/jcarosel/jcarousel.responsive.css" rel="stylesheet" type="text/css" />
      
      <!------ Full Calendar--------->
		<link href="<?php echo base_url();?>assets/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url();?>assets/fullcalendar/fullcalendar.print.css" rel="stylesheet"  media='print' />
		<script type="text/javascript" src="<?php echo base_url();?>assets/fullcalendar/moment.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery-2.1.0.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/fullcalendar/fullcalendar.min.js"></script>	
        
        <!------ Booking Date and Time--------->
		<script src="<?php echo base_url();?>assets/js/jquery.timepicker.js"></script>
		<script src="<?php echo base_url();?>assets/js/bootstrap-datepicker.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.datepair.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.datepair.js"></script>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap-datepicker.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/jquery.timepicker.css" />

        <!------ Popups--------->
		<link href="<?php echo base_url();?>assets/css/popup.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url();?>assets/css/popup1.css" rel="stylesheet" type="text/css" />
		
		<!------ Fancybox ------->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/js/fancybox/jquery.fancybox.css">
		
   </head>
   <body class="light_theme  fixed_header left_nav_fixed">
      <div class="wrapper">
      <!--\\\\\\\ wrapper Start \\\\\\-->
      <div class="header_bar">
         <!--\\\\\\\ header Start \\\\\\-->
         <div class="brand">
            <!--\\\\\\\ brand Start \\\\\\-->
            <div class="logo" style="display:block"><img src="<?php echo base_url();?>assets/images/logo.jpg" /></div>
            <?php /*?>
            <div class="small_logo" style="display:none"><img src="images/s-logo.png" width="50" height="47" alt="s-logo" /> <img src="images/r-logo.png" width="122" height="20" alt="r-logo" /></div>
            <?php */?>
         </div>
         <!--\\\\\\\ brand end \\\\\\-->
      <div class="header_top_bar">
      <!--\\\\\\\ header top bar start \\\\\\-->
      <a class="menutoggle" href="javascript:void(0);"> <i class="fa fa-bars"></i> </a>
      <div class="top_left">
        <div class="top_left_menu">
          <ul>
            <li> <a href="#"><i class="fa fa-facebook"></i></a> </li>
            <li> <a href="#"><i class="fa fa-twitter"></i></a> </li>
             <li> <a href="#"><i class="fa fa-google-plus"></i></a> </li>
               <li> <a href="#"><i class="fa fa-linkedin"></i></a> </li>
           
          </ul>
        </div>
      </div>
    
      <div class="top_right_bar">
        <div class="top_right">
          <div class="top_right_menu">
           
          </div>
        </div>
        <div class="user_admin dropdown"> <a data-toggle="dropdown" href="javascript:void(0);">
			<?php
					$getavtar=$this->user_model->get_sql_select_data('tbl_user', array('id'=>$this->session->userdata('id')));
				?>
				<img src="<?php echo base_url().'assets/avtars/thumbnail/113x113/'.$getavtar[0]['image']; ?>" class="user-image img-responsive" id="user_img_avtar"/>
				<span class="user_adminname"><?php echo $getavtar[0]['firstname']." ".$getavtar[0]['lastname']; ?></span> <b class="caret"></b> </a>
          <ul class="dropdown-menu">
            <div class="top_pointer"></div>
            <li> <a href="<?php echo site_url('stylist/viewprofile');?>"><i class="fa fa-cog"></i> Setting </a></li>
            <li> <a href="<?php echo site_url('account/logout');?>"><i class="fa fa-power-off"></i> Logout</a> </li>
          </ul>
        </div>
      </div>
    </div>
         <!--\\\\\\\ header top bar end \\\\\\-->
      </div>
      <!--\\\\\\\ header end \\\\\\-->
      <div class="inner">
      <!--\\\\\\\ inner start \\\\\\-->
      <div class="left_nav">
         <!--\\\\\\\left_nav start \\\\\\-->
         <div class="left_nav_slidebar">
			<?php
				$segment=$this->uri->segment(2);
				
				if($segment=="viewprofile")
				{
					$viewprofile="current";
				}
				else
				{
					$viewprofile="";
				}
				
				if($segment=="viewclient")
				{
					$viewclient="current";
				}
				else
				{
					$viewclient="";
				}
				
				if($segment=="addclient")
				{
					$addclient="current";
				}
				else
				{
					$addclient="";
				}
				
				if($segment=="manageclient")
				{
					$manageclient="current";
				}
				else
				{
					$manageclient="";
				}
				
				if($segment=="add_booking")
				{
					$add_booking="current";
				}
				else
				{
					$add_booking="";
				}
				
				if($segment=="edit_booking")
				{
					$edit_booking="current";
				}
				else
				{
					$edit_booking="";
				}
				
				if($segment=="viewproducts")
				{
					$viewproducts="current";
				}
				else
				{
					$viewproducts="";
				}
				
				if($segment=="sendmail")
				{
					$sendmail="current";
				}
				else
				{
					$sendmail="";
				}
				
				if($segment=="communications")
				{
					$communications="current";
				}
				else
				{
					$communications="";
				}
				
				if($segment=="communication")
				{
					$communication="current";
				}
				else
				{
					$communication="";
				}
				
				if($segment=="sent_mails")
				{
					$sent_mails="current";
				}
				else
				{
					$sent_mails="";
				}
				
				if($segment=="message")
				{
					$message="current";
				}
				else
				{
					$message="";
				}
				
				
				/*Hiding menu as per package*/
				if($this->session->userdata('package')=="DELUXE")
				{
					$style="display:none";
				}
				else
				{
					$style="";
				}
			?>
			
			<?php
				/*	Hiding Menu if Subscription if expired	start	*/
				$plan_expired=$this->session->userdata('plan_expired');
				if(!$plan_expired==1)
				{
			?>
            <ul>
			<?php /*	<li class="left_nav_active theme_border"><a href="javascript:void(0);"><i class="fa fa-home"></i> INHAIRENT <span class="left_nav_pointer"></span> <span class="plus"><i class="fa fa-plus"></i></span> </a>
					<ul>
					<li>
						<a href="index.html"><span>&nbsp;</span> <i class="fa fa-circle theme_color"></i> <b class="theme_color">Stylists</b></a>
					</li>
					<li>
						<a href="settings.html"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Individual Stylist Page</b> </a>
					</li>
					<li>
						<a href="layouts.html"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Gallery</b> </a>
					</li>
					<li>
						<a href="themes.html"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Training &amp; Technology</b> </a>
					</li>
					<li>
						<a href="widgets.html"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Blog</b> </a>
					</li>
					<li>
						<a href="animations.html"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>About</b> </a>
					</li>
					</ul>
				</li> */?>
				
				
				<li> <a href="javascript:void(0);"> <i class="fa fa-edit"></i> STYLIST ACCOUNT <span class="plus"><i class="fa fa-plus"></i></span></a>
					<ul  style="display:block" class="opened">
						<!--<li>
							<a href="<?php // echo site_url('stylist/');?>"> <span>&nbsp;</span> <i class="fa fa-user"></i> <b>Dashboard</b> </a>
						</li>-->
						<li>
							<a href="<?php echo site_url('stylist/viewprofile');?>" class="<?php print $viewprofile;?>"> <span>&nbsp;</span> <i class="fa fa-user"></i> <b>Profile</b> </a>
						</li>
						<li>
							<a href="<?php echo site_url('stylist/viewclient');?>" class="<?php print $viewclient; print $addclient; print $manageclient;?>"> <span>&nbsp;</span><i class="fa fa-users"></i> <b>Clients</b> </a>
						</li>
						<?php /*<li>
							<a href="<?php echo site_url('stylist/addclient');?>"> <span>&nbsp;</span> <i class="fa fa-edit"></i> <b>Manage client</b> </a>
						</li> */?>
						<li>
							<a href="<?php echo site_url('stylist/add_booking');?>" class="<?php print $add_booking; print $edit_booking;?>"> <span>&nbsp;</span> <i class="fa fa-bookmark"></i> <b>Booking</b> </a>
						</li>
						<li>
							<a href="<?php echo site_url('stylist/sendmail'); ?>" class="<?php print $sendmail; print $sent_mails; print $message; print $communications; print $communication;?>"> <span>&nbsp;</span><i class="fa fa-envelope-o"></i> <b>Email</b> </a>
						</li>
						<li style="<?php print $style; ?>">
							<a href="<?php echo site_url('stylist/viewproducts');?>" class="<?php print $viewproducts;?>"> <span>&nbsp;</span> <i class="fa fa-suitcase"></i> <b>Products</b> </a>
						</li>
					</ul>
				</li>
            </ul>
			<?php
				}
				
				/*	Hiding Menu if Subscription if expired	end	*/
			?>
         </div>
      </div>
      <!--\\\\\\\left_nav end \\\\\\-->

