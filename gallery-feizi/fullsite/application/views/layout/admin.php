<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html" charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="author" content="">
<title>Admin</title>
<link rel="shortcut icon" href="<?php echo base_url().'assets/images/favicon.ico';?>" type="image/x-icon" />
<link rel="apple-touch-icon" href="<?php echo base_url().'assets/images/favicon.ico';?>"/>
<link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
<link href="<?php echo base_url('assets/css/bootstrap-responsive.min.css') ?>" rel="stylesheet">
<link href="<?php echo base_url('assets/css/font-awesome.css') ?>" rel="stylesheet">
<link href="<?php echo base_url('assets/css/custom.css') ?>" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url().'assets/slider/index_data/jquery.css'; ?>" type="text/css" media="screen">
<link href="<?php echo base_url('assets/css/admin_owner.css') ?>" rel="stylesheet"/>
<link href="<?php echo base_url('assets/css/apetizer-admin.css') ?>" rel="stylesheet"/>
<link href="<?php echo base_url('assets/css/uploadfile.css') ?>" rel="stylesheet"/>
<script src="<?php echo base_url('assets/js/1.9.1.jquery.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/image_crop/jquery.Jcrop.js') ?>"></script>
<script src="<?php echo base_url('assets/js/1.10.3_jquery-ui.js') ?>"></script>
<!--<script src="//cdnjs.cloudflare.com/ajax/libs/lodash.js/1.2.1/lodash.min.js1"></script>-->
<script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/custom.js') ?>"></script>
<script src="<?php echo base_url('assets/js/ajaxfileupload.js') ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.uploadfile.min.js') ?>"></script>
</head>
<body>
<!--top nav part start-->
<div class="container-fluid top-header"> <a class="btn btn-navbar hidden-desktop mob_btn" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </a>
  <div class="nav-collapse collapse">
    <?php $site=site_url().'admin/';?>
    <p class="navbar-text pull-right">
      <?php if($this->session->userdata('group')=='1'){?>
      <a id="user-popover" href="#" class="navbar-link user-info">
      <?php if($this->session->userdata('admin_mail')!='')
		echo $this->session->userdata('admin_mail');?>
      </a> <a href="<?=$site.'register/user_update' ?>" class="btn btn-mini btn-inverse navbar-link orange-btn">Update User</a> <a href="<?=$site.'changepassword' ?>" class="btn btn-mini btn-inverse navbar-link orange-btn">Change Password</a> <a href="<?=$site.'/login/logout' ?>" class="btn btn-mini btn-inverse navbar-link orange-btn">Logout</a>
      <?php } ?>
    </p>
  </div>
</div>

<div class="row-fluid">
  <div class="span12">&nbsp;</div>
</div>
<?php $site_segment3=$this->uri->segment(3);
      $site_segment2=$this->uri->segment(2);?>
<!--Subnav Left part -->
<div class="container-fluid main-container">
  <div class="row-fluid">
    <div class="span12">
      <div class="sidebar-nav mob-left-part span2">
        <ul class="nav nav-stacked left-menu">
          <?php if($this->session->userdata('group')=='1'){?>
          
          <li> 
              <a class="<?php if($site_segment3=="user_profile"|| $site_segment3=='user_profile_view' ||$site_segment2=="register" || $site_segment2=="bid" || $site_segment2=="works"){echo 'active';}?>" href="<?=$site.'home/user_profile' ?>">
              <span class="icon_box user_icon"></span>
              <span class="hidden-tablet hidden-phone">Artists</span>
              </a>
          </li>
          <li> 
              <a class="<?php if($site_segment3=="home_slider"){echo 'active';}?>" href="<?=$site.'home/home_slider' ?>">
              <span class="icon_box cluster_icon"></span>
              <span class="hidden-tablet hidden-phone">Home Slider</span>
              </a>
          </li>
          <li> 
              <a class="<?php if($site_segment3=="hometext"){echo 'active';}?>" href="<?=$site.'home/hometext' ?>">
              <span class="icon_box cluster_icon"></span>
              <span class="hidden-tablet hidden-phone">Home Text</span>
              </a>
          </li>
         <li>
              <a class="<?php if($site_segment2=="exhibitions"){echo 'active';}?>" href="<?=$site.'exhibitions' ?>">
              <span class="icon_box cluster_icon"></span>
              <span class="hidden-tablet hidden-phone">Exhibitions</span>
              </a>
          </li>
          <li>
              <a class="<?php if($site_segment2=="news"){echo 'active';}?>" href="<?=$site.'news' ?>">
              <span class="icon_box cluster_icon"></span>
              <span class="hidden-tablet hidden-phone">NEWS/EVENTS</span>
              </a>
          </li>
          <li>
              <a class="<?php if($site_segment2=="publication"){echo 'active';}?>" href="<?=$site.'publication' ?>">
              <span class="icon_box cluster_icon"></span>
              <span class="hidden-tablet hidden-phone">Publications</span>
              </a>
          </li>
          <li>
              <a class="<?php if($site_segment2=="press"){echo 'active';}?>" href="<?=$site.'press' ?>">
              <span class="icon_box cluster_icon"></span>
              <span class="hidden-tablet hidden-phone">Press</span>
              </a>
          </li>
          <li>
              <a class="<?php if($site_segment2=="category"){echo 'active';}?>" href="<?=$site.'category' ?>">
              <span class="icon_box cluster_icon"></span>
              <span class="hidden-tablet hidden-phone">Category</span>
              </a>
          </li>
          <li>
              <a class="<?php if($site_segment2=="contact"){echo 'active';}?>" href="<?=$site.'contact' ?>">
              <span class="icon_box cluster_icon"></span>
              <span class="hidden-tablet hidden-phone">Contact</span>
              </a>
          </li>
          
          <?php } ?>
        </ul>
      </div>
      <?=$content_for_layout?>
    </div>
  </div>
</div>
</body>
</html>
