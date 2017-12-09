<?php

 class Sendmail extends CI_Controller {
	 
	 function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('id') == "" || $this->session->userdata('role_id') == "" || $this->session->userdata('email') == "" || $this->session->userdata('firstname') == "" || $this->session->userdata('lastname') == "" || $this->session->userdata('isLogin') == "")
		{
            redirect(site_url().'account/');
        }
		 $this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',true);
		//$this->output->set_header('Cache-Control: max-age=900');
		$this->output->set_header('Pragma: no-cache');
		date_default_timezone_set('America/Los_Angeles');
	}

	//******************************************************************************************//
	

      function index()
      {
		$configs = array(
				'protocol'  =>  'smtp',
				'smtp_host' =>  'ssl://smtp.gmail.com',
				'smtp_user' =>  'bharat.prajapat@newtechfusion.com',
				'smtp_pass' =>  'ntf12345',
				'smtp_port' =>  '465'
			);
        $this->load->library("email", $configs);
        $this->email->set_newline("\r\n");
        $this->email->from('bharat.prajapat@newtechfusion.com', 'Bharat Prajapat');
		$this->email->to('bharat.prajapat@newtechfusion.com');		
        $this->email->subject("Mail Sent From Localhost");
        
        $path = './assets/uploads/';
		$message="Body of the Message";
        $message.=$path;
        
		$this->email->message($message);
		//$this->email->attach($path . 'newsletter1.txt');
        
        if($this->email->send())
        {
            echo "Done!";   
        }
        else
        {
            echo $this->email->print_debugger();    
        }
      }
 }
?>
