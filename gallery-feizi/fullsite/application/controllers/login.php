<?php if (!defined('BASEPATH')) die();
class Login extends MY_Controller {
	
	public function __construct()
	{
		parent::__construct();
	 			$this->load->model('query_model');
				$this->load->library('email');
				$this->load->helper('string');
				$this->load->helper('cookie');
				$this->load->helper('url');
				$this->load->library('session');
	}

   public function index()
	{ 
	 $cookie=array('user_name'=>$this->input->cookie('username'),
	               'password'=>$this->input->cookie('password'));
				   
	 $this->load->view('login',$cookie);
	  
 	}
	 
	 
	/***** EXISTING fbUSER LOGIN CHECKING**********/ 
	 public function fb_session(){
		 
		   $username = $this->input->post('username');
		
		 $this->session->set_userdata(array('user_name'=>$username));
		 }
	 
	 
 	public function facebook_login()
			{

			 	 $username=$this->input->post('id');
				 $uname=$this->input->post('fname');
			 	 $fname=$this->input->post('firstname');
				 $lname=$this->input->post('lastname');
				 $uimage=$this->input->post('uimage');
		         $gender=$this->input->post('gender');
		         $birthday=$this->input->post('birthday');
				 $email=$this->input->post('email');
			 	 $current_url=$this->input->post('current_url');
	
				$this->session->set_userdata(array('user_name'=>$username,'f_name'=>$uname,'user_image'=>$uimage));
				$where = array('user_name'=>$username);
				
					
				$user_info=$this->query_model->get_sql_select_data('user',$where);
				if(empty($user_info)){
  				$data = array('user_name' =>$username,
			                'email '=>$email,
							'password'=>md5('123456'),
							'group_id'=>'3');
						$this->load->model('query_model');
					 
						$last_id=$this->query_model->insertdata('user',$data); 
					    $data_profile = array('user_id' =>$last_id,  
							 'first_name'=>$fname,	
							 'last_name'=>$lname,
							 'gender'=>$gender,  
							 'date'=>$birthday
					         );
						$this->query_model->insertdata('user_profile',$data_profile); 
				}
						
			
				
	 	}
		
		
/*** EXISTING USER LOGIN CHECKING******/		
		public function check_login()
			{
				$this->load->library('session');

				 $username=$this->input->post('user_name');
				 $password=$this->input->post('password');
				 $reminder=$this->input->post('reminder');
				 
			   $this->form_validation->set_rules('user_name', 'Username', 'required');
				$this->form_validation->set_rules('password', 'Password', 'required');
				
		
				if ($this->form_validation->run() == FALSE)
				{
 							$this->layout->view('login');
 				}else{
					
					$where = array('user_name'=>$username,
								  'password'=>md5($password),
								  'active'=>'1',
								  'group_id'=>'3'
								  );
					 if($reminder==1){
						setcookie('username',$username);
						setcookie('password',$password);
					}
					   $user_info=$this->query_model->get_sql_select_data('user',$where);
  						if(!empty($user_info))
						{
						 $where_image= array('user_name'=>$user_info[0]->user_name);
					     $user_info=$this->query_model->user_info($where_image,NULL);
						 $data=array('f_name'=>$user_info[0]->first_name,
									 'l_name'=>$user_info[0]->last_name,
									 'user_image'=>site_url()."uploadimages/user/".$user_info['0']->userfile);
						 $this->session->set_userdata($data);
						 $this->session->set_userdata($user_info[0]);
						 echo '0';
								  
						}else{
						 echo '1';
						}
				}
				
	  	}
/********LOG OUT********/

 		public function logout()
		{
			
			$this->session->unset_userdata('user_name');
			$this->session->unset_userdata('id');
			$this->session->unset_userdata('f_name');
			$this->session->unset_userdata('l_name');
			$this->session->unset_userdata('user_image');
			$this->session->unset_userdata('user_id');
		  		 
		    $ref = str_replace(";","",$this->input->server('HTTP_REFERER', TRUE));
			 redirect($ref, 'location');  
			 
	
		
		}
 /********FORGET PASSWORD***********/
 
 	public function forgetpassword()
		{
			 $this->load->view('forgetpassword');
		}


	public function chk_update_pass(){
			$where= array('email'=>$this->input->post('email'));
			$user_info=$this->query_model->get_sql_select_data('user',$where);
			if(!empty($user_info))
			{ 
				 $random = random_string('alnum', 16);
				 $field = array('activation_code'=>$random) ;
				 $link=$this->query_model->updatedata('user',$where,$field);
								
				$this->email->initialize($config);
				$this->email->from('info@apetizr.com', 'Apetizr');
				$this->email->to($user_info[0]->email);
				 				
				$this->email->subject('Forget Password');
				
				$this->email->message('uesr name :'.$user_info[0]->user_name. '  Click This link '. site_url().'login/updatepassword/'.$random.' now rest your password' );
				$this->email->send();
			
			    $user_data= array('error'=>"You'll receive an email in a few minutes containing a link that will allow you to reset your password. If you don't see the email in your inbox shortly, check your spam folder !");
			     echo '1';
			}
			else
			{echo '0';
			}
	
		
		
		
		}
	
/****UPDATE PASSWORD************/

 		public function updatepassword()
		{ 
		
		 
			$where= array('activation_code' => $this->uri->segment(3));
			if(!($this->query_model->get_sql_select_data('user',$where))) $this->redirect();
 
			$this->form_validation->set_rules('password', 'New Password', 'trim|required');
			$this->form_validation->set_rules('confirm_password', 'Confrim Password', 'trim|required|matches[confirm_password]|greater_than[3]|alpha_numeric|md5');
			
			if ($this->form_validation->run() == FALSE){
			    $this->load->view('updatepassword');
	      	}else{
			     $uri_link= array('activation_code' => $this->uri->segment(3));
			      $password=$this->input->post('password');
		          $confirm_password=$this->input->post('confirm_password');
		          $data = array('password'=>md5($password));
			      $this->query_model->updatedata('user',$uri_link,$data);
				  $data['success_msg']="Congratulations! You've successfully changed your Apetizr account's password !";
     			  $this->load->view('updatepassword',$data);
			
		}
	}
}

 