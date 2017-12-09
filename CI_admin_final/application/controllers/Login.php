<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	
	function __construct()
		{
			parent::__construct(); 
			if(($this->session->userdata('id')!='') || ($this->session->userdata('role')!='') || ($this->session->userdata('firstname')!='')||($this->session->userdata('IsLogin')===TRUE))
			{
				if($this->session->userdata('roleid')==1)
				{
					redirect(site_url('admin'));
				}
				if($this->session->userdata('roleid')==2)
				{
					redirect(site_url('user'));
				}
			}  
			$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
			$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
			$this->output->set_header('Pragma: no-cache');
			$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");    
		}
		
	public function index()
	{
		if(isset($_POST['login']))
		{
			$email=trim($this->input->post('email'));
			$password=$this->input->post('password');
			
			$this->form_validation->set_error_delimiters('<span style="color:red" class="text-error">', '</span>');
			if ($this->form_validation->run('login') == FALSE)
			{}
			else
			{
				$isUser=$this->user_model->get_joins('tbl_users',array('email'=>$email,'password'=>$password));
				
				//print_r($isUser);exit;
				if($isUser)
				{
					if($isUser[0]['active']==1)
					{
						$session_data=array(
										'id'=>$isUser[0]['id'],
										'firstname'=>$isUser[0]['firstname'],
										'lastname'=>$isUser[0]['lastname'],
										'roleid'=>$isUser[0]['roleid'],
										'email'=>$email,
										'islogin'=>True,
									);
						$this->session->set_userdata($session_data);
						if($isUser[0]['roleid']==1)
						{
							redirect('admin');
						}
						if($isUser[0]['roleid']==2)
						{
							redirect('user');
						}
						if($isUser[0]['roleid']==3)
						{
							redirect('users');
						}
					}
					else
					{
						$this->session->set_flashdata('Logmsg','Account is not activated');
					}
				}
				else
				{
					$this->session->set_flashdata('Logmsg','User Does not exists');
				}
			}
		}
		$this->load->view('login');
	}
}
