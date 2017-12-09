<?php 

class User extends CI_Controller   
{	
	function __construct()
	{
		parent::__construct();
		if($this->session->userdata('isLogin') === FALSE)
		{
		redirect(site_url().'/login/');
		}
	}
	
	public function index()
	{
		$this->load->view('d_user');
	}
	
	public function profile()
	{
		$this->load->view('viewprofile');
	}
}
