<?php if (!defined('BASEPATH')) die();
class Login extends Admin_Controller {
	
	public function __construct()
	{
		parent::__construct();
	 			$this->load->model('query_model');
				$this->session->unset_userdata('admin_user_name');
	}

   public function index()
	{ 
	    $this->session->sess_destroy();
      $this->layout->view('admin/login');
 	}
	 
/**** EXISTING USER LOGIN CHECKING*************/		
		public function check_login()
			{
				$username=$this->input->post('user_name');
				$password=$this->input->post('password');
				
		
				$this->form_validation->set_rules('user_name', 'Username', 'required');
				$this->form_validation->set_rules('password', 'Password', 'required');
				
		
				if ($this->form_validation->run() == FALSE)
				{
					$this->layout->view('admin/login');
					
				}
				else
				{
					$data = array('group_id'=>'1',
								  'user_name'=>$username,
								  'password'=>md5($password)
								  );
						
 						if($user_info=$this->query_model->get_sql_select_data('user',$data,NULL,NULL))
						{
							$user=array('admin_user_name'=>$user_info[0]->user_name,
										'admin_user_id'=>$user_info[0]->user_id,
										'group'=>'1',
										'admin_mail'=>$user_info[0]->email);
							$this->session->set_userdata($user);
						   redirect(site_url().'admin/home/user_profile');
						}
						else
						{
						 $data=array('error'=>'Authentication is not vaild');
						 $this->layout->view('admin/login',$data);
						}
				}
				
	  	}
/*****LOG OUT**********/

 		public function logout()
		{
			
			$this->session->sess_destroy();
		   redirect(site_url().'home');
		}
   
}

 
