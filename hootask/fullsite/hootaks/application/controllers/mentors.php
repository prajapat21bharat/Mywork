<?php 

class Mentors extends CI_Controller   //	(Main Class) Define in config/routes => $route['default_controller'] = "start";


{
	
	public function index()  
	
	{ 
		$this->load->view('mentor_view');
	}
	
}
