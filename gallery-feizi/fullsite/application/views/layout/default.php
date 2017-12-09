<?php echo $this->load->view('layout/header.php') ?>
<link rel="stylesheet" href="<?php echo base_url().'assets/slider/'?>index_data/jquery.css" type="text/css" media="screen">
<link rel="stylesheet" href="<?php echo base_url('assets/css/responsiveslides.css') ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/demo.css') ?>">
<!--<script src="<?php echo base_url('assets/js/responsiveslides.min.js') ?>"></script>-->
  <!--main-->
  <div id="main"> 
    <div class="container"> 
      <!--row-fluid-->
      <div class="row-fluid">
        <div class="span12">
          <div class="main-content" id="main-content">
            <?=$content_for_layout?>
          </div>
        </div>
        
      </div>
      <!--end row-fluid--> 
    </div>
  </div>
  <!--end main--> 
   <!--footer--> 
  <? $this->load->view('layout/footer.php') ?>
  <!--end footer--> 
