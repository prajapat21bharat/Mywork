<?php
class Restaurant_Controller extends CI_Controller
{
   public $layout_view = 'layout/restaurant';
 
   function __construct() {
      parent::__construct();
      // Layout library loaded site wide
      $this->load->library('layout'); 
	  //error_reporting(0);
 
      // Site global resources
     // $this->layout->js('js/jquery.min.js');
      //$this->layout->css('css/site.css');
   }
   function redirect()
   {
	   redirect(site_url().'home');
   }
}
