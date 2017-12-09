<?php if (!defined('BASEPATH')) die();
class Register extends MY_Controller {
	 
	public function __construct()
	{
		 
		parent::__construct();
		$this->load->model('query_model');
		$this->load->library('session');
	 
	}

   public function index()
	{
      
      $this->load->view('register');
      
	}
	
	
	public function chk()
	{
		 $this->load->model('query_model');
          $user_name = $this->input->post('user_name');
		
		
	     $this->query_model->valid_data($user_name);
		
		
		
		}
		public function email_chk()
	{
		 $this->load->model('query_model');
          $user_email = $this->input->post('email');
		
		
	     $this->query_model->valid_email_data($user_email);
		
		
		
		}
/*** NEW USER LOGIN REGISTRATION******/
	public function registration(){
		
		 $this->form_validation->set_rules('user_name', 'Username', 'trim|required|is_unique[user.user_name]');
		 $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[user.email]');
		 $this->form_validation->set_rules('password', 'Password','trim|required|alpha_numeric|min_length[6]');
		$this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'trim|required|matches[password]');
 		if ($this->form_validation->run() == FALSE)
		{
			echo validation_errors();
			exit;
		}else{
			 
			 $username=$this->input->post('user_name');
			 $password=$this->input->post('password');
			 $email=$this->input->post('email');
			 $confirm_password=$this->input->post('confirm_password');
			 $data = array('user_name' =>$username,
									  'password'=>md5($password),
									  'email'=>$email,
									  'group_id'=>'3'
									  );
						$this->load->model('query_model');
					 
						$last_id=$this->query_model->insertdata('user',$data); 
						$data_profile['user_id']=$last_id;
						$this->query_model->insertdata('user_profile',$data_profile); 
						$this->session->set_userdata(array('user_name'=>$username,'id'=>$last_id,'f_name'=>$username));
						 echo '1';
			         
				}
	 	}
		
	  	

/**** NEW USER PERSONAL INFORMATION*******/		
		
public function profile(){
			if($this->session->userdata('user_name')=='') redirect(site_url()."home");
			 
			$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
			$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
			$this->form_validation->set_rules('gender', 'Gender', 'required');
		    $this->form_validation->set_rules('date', 'Date', 'required');
			$this->form_validation->set_rules('user_address', 'Address', 'trim|required');
			$this->form_validation->set_rules('user_phone', 'Contact Number', 'trim|required|numeric');
			 
			if ($this->form_validation->run() == FALSE){ 
			 				$this->layout->view('user_profile');
			}else{ 
			  	$first_name=$this->input->post('first_name');
						$last_name=$this->input->post('last_name');
						$gender=$this->input->post('gender');
						$date=$this->input->post('date');
						$user_phone=$this->input->post('user_phone');
						$user_address=$this->input->post('user_address');
				/****************file upload************/
						 
						 	$config['upload_path'] = './uploadimages/user/';
							$config['allowed_types'] = 'gif|jpg|png';
							 $this->load->library('upload');
							 $this->upload->initialize($config);
					
							if (!$this->upload->do_upload())
							{
								$error = array('error'=>$this->upload->display_errors());
								$this->layout->view('user_profile', $error);
							}
							else
							{
								//$this->upload->data();
								 $uploads = array($this->upload->data());
								foreach($uploads as $key => $value)
								{
									$randomcode = random_string('alnum', 16);
									$newimagename = $randomcode.$value['file_ext'];
									rename($value['full_path'],$uploads[0]['file_path'].$newimagename);
								}
								$userfile=$newimagename;
								$data = array('first_name' =>$first_name,
									  'last_name'=>$last_name,
									  'userfile'=>$userfile,
									  'gender'=>$gender,
									  'date'=>$date,
									  'user_address'=>$user_address,
									  'user_phone'=>$user_phone,
									  'user_id'=>$this->session->userdata('id')
									 );
								$this->query_model->insertdata('user_profile',$data);
								redirect(site_url().'home');
							}
						
						
 				}
		
		}
		
public function user_info(){
			
				if($this->session->userdata('user_name')=='') redirect(site_url()."home");	
				     $where = array('user_name'=>$this->session->userdata('user_name'));
				     $user_data['user_info']=$this->query_model->user_info($where,1);
					 if($this->uri->segment('3')==1)
					 $user_data['success']='Your Profile Successfully Updated!';
					 				 
				     $this->load->view('user_info',$user_data);
				
}

/*****CHANGE USER PROFILE *****/
public function change_profile(){
					
	if($this->session->userdata('user_name')=='') redirect(site_url()."home");	
	$where = array('user_name'=>$this->session->userdata('user_name'));
	$user_data = array('user_info'=>$this->query_model->user_info($where,1));
	if($this->uri->segment(3)==1){
	  $user_data['success']='Thanks for registering with Apetizr.com. You are moments away from…..';
	  }
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('gender', 'Gender', 'required');
		$this->form_validation->set_rules('date', 'Date', 'required');
		$this->form_validation->set_rules('city', 'City', 'trim|required');
		$this->form_validation->set_rules('state', 'State', 'trim|required');
		$this->form_validation->set_rules('zip', 'Zip', 'trim|required');
		$this->form_validation->set_rules('user_phone', 'Contact Number', 'trim|required|numeric');
					 
		if ($this->form_validation->run() == FALSE){ 
			$this->load->view('user_info',$user_data);
		}else{ 
			$user_id = $user_data['user_info'][0]->user_id;
			$first_name=$this->input->post('first_name');
			$last_name=$this->input->post('last_name');
			
			$gender=$this->input->post('gender');
			$date=$this->input->post('date');
			$user_phone=$this->input->post('user_phone');
			$city=$this->input->post('city');
			$state=$this->input->post('state');
			$zip=$this->input->post('zip');
			
			$where= array( 'user_id'=>$user_id);
			$data = array('first_name' =>$first_name,
						  'last_name'=>$last_name,
						  'gender'=>$gender,
						  'date'=>$date,
						  'city'=>$city,
						  'states'=>$state,
						  'zip'=>$zip,
						  'user_phone'=>$user_phone
						 );
			
								 
				$user_s=array('f_name'=>$first_name,
							  'l_name'=>$last_name);
					$this->session->set_userdata($user_s);
							 /******file upload*************/
			 
			$this->query_model->updatedata('user_profile',$where,$data);
			
			$config['upload_path'] = './uploadimages/user/';
			$config['allowed_types'] = 'gif|jpg|png';
			$this->load->library('upload');
			$this->upload->initialize($config);
			if($_FILES['userfile']['name']!=''){
				if (!$this->upload->do_upload()){
								$user_data['error'] = $this->upload->display_errors();
								$this->load->view('user_info',$user_data);
							}else{
								$uploads = array($this->upload->data());
								foreach($uploads as $key => $value)
								{
									$randomcode = random_string('alnum', 16);
									$newimagename = $randomcode.$value['file_ext'];
									rename($value['full_path'],$uploads[0]['file_path'].$newimagename);
								}
								$data['userfile']=$newimagename;
								
								$uimage_s=array('user_image'=>site_url()."uploadimages/user/".$data['userfile']);
								$this->session->set_userdata($uimage_s);
								
								$this->query_model->updatedata('user_profile',$where,$data);
								$where_user= array('user_name'=>$this->session->userdata('user_name'));
								
								$udata = array('user_info'=>$this->query_model->user_info($where_user,1));
								$udata['success']='Your Profile Success Fully Updated';
								redirect(site_url()."register/user_info/1");	
								
							}
						}else{		
								$where_user= array('user_name'=>$this->session->userdata('user_name'));
								$udata = array('user_info'=>$this->query_model->user_info($where_user,1));
								redirect(site_url()."register/user_info/1");
								
						}
					}
	}


}

 