<?php
class Admin_Controller extends CI_Controller
{
   public $layout_view = 'layout/admin';
 
   function __construct() {
      parent::__construct();
      // Layout library loaded site wide
      $this->load->library('layout');
	  //error_reporting(0);
 
     
   }
   function redirect()
   {
	   redirect(site_url().'admin/login');
   }
}
