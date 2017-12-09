<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html" charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="author" content="">
<title><?php 
echo $title= 'Feizi';
?>
</title>
<link rel="shortcut icon" href="<?php //echo base_url().'assets/images/favicon.ico';?>" type="image/x-icon" />
<link rel="apple-touch-icon" href="<?php //echo base_url().'assets/images/favicon.ico';?>"/>
<link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
<link href="<?php echo base_url('assets/css/bootstrap.css') ?>" rel="stylesheet">
<link href="<?php echo base_url('assets/css/bootstrap-responsive.min.css') ?>" rel="stylesheet">
<link href="<?php echo base_url('assets/css/font-awesome.css') ?>" rel="stylesheet">
<link href="<?php echo base_url('assets/css/custom.css') ?>" rel="stylesheet">
<link href="<?php echo base_url('assets/css/flages.css') ?>" rel="stylesheet">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/respond.js') ?>"></script>
<script type="text/javascript">
        function ClearPlaceHolder (input) {
            if (input.value == input.defaultValue) {
                input.value = "";
            }
        }
        function SetPlaceHolder (input) {
            if (input.value == "") {
                input.value = input.defaultValue;
            }
        }
    </script>

</head>


<body >  
<!--page--> 
<div id="page"> 
  <!--top border-->
  <div id="top-border"> </div>
  <!--end top border--> 
  <!--header-->
  <div id="header">

      <div class="row-fluid top">
        <div class="container">
          <div class="span12">
            <div class="span2">
              <div class="logo"> <a href="<?=site_url()?>"><img src="<?php echo base_url().'assets/images/logo.png'; ?>" alt="" border="0" /></a> </div>
            </div>   
            <?php /*?><div class="top-navigation span10">
              <ul class="top-links">
                  <li class="<?php if($this->uri->segment(1) == '' || $this->uri->segment(1) == 'home') echo 'active'?>" ><a href="<?=site_url()?>" >HOME</a></li>
                  <li class="<?php if($this->uri->segment(1) == 'artist') echo 'active'?>" ><a href="<?=site_url().'artist/'?>" >ARTISTS</a></li>
                  <li class="<?php if($this->uri->segment(1) == 'exhibitions') echo 'active'?>" ><a href="<?=site_url().'exhibitions/'?>" >EXHIBITIONS</a></li>
                  <li class="<?php if($this->uri->segment(1) == 'news') echo 'active'?>" ><a href="<?=site_url().'news/' ?>" >NEWS/EVENTS</a></li>
                  <li class="<?php if($this->uri->segment(1) == 'publications') echo 'active'?>" ><a href="<?=site_url().'publications/'?>" >PUBLICATIONS/PRESS</a></li>
                  <li class="<?php if($this->uri->segment(1) == 'contact') echo 'active'?>" ><a href="<?=site_url()?>" >CONTACT</a></li>
              </ul>
          </div><?php */?>   
          
          <div class="top-navigation span10">
            
            
            <div class="navbar navbar-inverse">
      <div class="navbar-inner">
  
          <button data-target=".nav-collapse" data-toggle="collapse" class="btn btn-navbar" type="button">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <div class="nav-collapse collapse">
              <ul class="top-links nav">
                  <li class="first<?php if($this->uri->segment(1) == '' || $this->uri->segment(1) == 'home') echo 'active'?>" ><a href="<?=site_url()?>" >HOME</a></li>
                  <li class="<?php if($this->uri->segment(1) == 'artist') echo 'active'?>" ><a href="<?=site_url().'artist/'?>" >ARTISTS</a></li>
                  <li class="<?php if($this->uri->segment(1) == 'exhibitions') echo 'active'?>" ><a href="<?=site_url().'exhibitions/'?>" >EXHIBITIONS</a></li>
                  <li class="<?php if($this->uri->segment(1) == 'news') echo 'active'?>" ><a href="<?=site_url().'news/' ?>" >NEWS/EVENTS</a></li>
                  <li class="<?php if($this->uri->segment(1) == 'publications') echo 'active'?>" ><a href="<?=site_url().'publications/'?>" >PUBLICATIONS/PRESS</a></li>
                  <li class="<?php if($this->uri->segment(1) == 'contact') echo 'active'?>" ><a href="<?=site_url().'contact/'?>" >CONTACT</a></li>
              </ul>
              
              </div>
      
      </div>
                   

    </div>

     <ul class="header-search">
		         <form method="post" action="<?php echo site_url("home/search")?>">
                        <li class="top_search"><input type="test" name="search" id="search" value="SEARCH" onfocus="ClearPlaceHolder(this)" onblur="SetPlaceHolder(this)" />
                        <input class="search_btn" type="submit" name="go"  value="Go"/>
                        </li>
                  
                       </form>
                      </ul>
              
              
              
          </div>
             
          </div>
         </div>
     </div>
     
          
     
 
  </div>
  <!--end header--> 
<script>

 function search() {


      var search = $('#search').val();
     
     if(search=="") {
     
     $("#disp").html("");
     
     }else {
     
     $.ajax({
     type: "POST",
     url: "<?php echo site_url("home/search");     ?>",
     data: { search:search}
     }).done(function(msg) {
     $("#error_msg").html(msg);
     if(msg!=""){
     $("#sem").val("");
     }
     });
     return false;
     }
 
    }

</script>
