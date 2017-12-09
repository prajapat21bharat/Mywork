<?php

class MY_Owner extends CI_Controller  {
   // Site global layout
   public $layout_view = 'layout/owner';
 
   function __construct() {
      parent::__construct();
      // Layout library loaded site wide
      $this->load->library('layout'); 
	// error_reporting(0);
 
      // Site global resources
      //$this->layout->js('js/jquery.min.js');
      //$this->layout->css('css/site.css');
   }
   
   function redirect()
   {
	   redirect(site_url().'owner/login');
   }
}

?>