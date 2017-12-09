<?php 

class Account extends CI_Controller   

{
		
	public function index()  // This function index() automaticaly called when class Account is called

	{

		if (isset($_POST["submit"]))  // --Checking Validation ----
		{  
			$default_img ='user_unknown.jpg';
			
		 $fields=array(                             
		'firstname' => trim($this->input->post('fname')),
		'lastname' => trim($this->input->post('lname')),
		'gender' => trim($this->input->post('gender')),
		'email' => trim($this->input->post('email')),
		'password' => trim($this->input->post('password')),
		'reg_date' => date('Y-m-d H:i:s'),
		'user_type' =>$this->input->post('role'),
		'active_state' => 1	,
		'image' => $default_img	
		
					 );	
			$where=array('email' =>$this->input->post('email')); 
			
			$isLogin=$this->user_model->get_sql_select_data('registration', $where); //---- SELECT Query Fire Here for Checking email if already exist -----
			
			
			
			if($isLogin == TRUE)
			{
			$this->session->set_flashdata('error', '<b style="color:red; font-size:20px;">User Already Exist. Please Try Again..</b>');
			redirect(site_url('account'));		
			}
			
			else
			{	
				
							   		   
			$r = $this->user_model->INSERTDATA('registration',$fields);  //--- --- INSERT Query fire here -----//
				
			}
			
				if(!empty($r))
						{
							
					$isLogin = $this->user_model->get_sql_select_data('registration', $where);
					
					$getid = $isLogin[0]['id'];
							
										$fields = array('uid' =>$getid); 

						$edu = $this->user_model->INSERTDATA('education',$fields);  
						$wrk = $this->user_model->INSERTDATA('workexperience',$fields);  
						$cert =	$this->user_model->INSERTDATA('certification',$fields);
						$skill = $this->user_model->INSERTDATA('skills',$fields);
						$user_summary =	$this->user_model->INSERTDATA('user_summary',$fields);  
			

								$sessionArr = array(
										'id'=>$isLogin[0]['id'],
										'firstname'=>$isLogin[0]['firstname'],
										'isLogin'=>TRUE
										);
										
					$this->session->set_userdata($sessionArr);
					$role=$isLogin[0]['user_type'];
					$activestate=$isLogin[0]['active_state'];
					if($activestate==0)
					{
						$this->session->set_flashdata('Logmsg', '<b style="color:red;font-size: 13px">Please Activate Account First</b>');
						redirect(site_url().'/login/');
					}
					else
					{
							
							if($role=="Mentor")
						{
						$this->session->set_flashdata('regsucc', '<b style="color:green; font-size:20px;">Please Go to  your account: and verify your Email Address </b>');

							redirect(site_url().'/mentor/');
						}
						if($role=="Jobseeker")
						{
						$this->session->set_flashdata('regsucc', '<b style="color:green; font-size:20px;">Please Go to  your account: and verify your Email Address </b>');

							redirect(site_url().'/dashboard/');

						}
						else
						{
							$this->session->set_flashdata('regsucc', '<b style="color:green; font-size:20px;">Please Go to  your account: and verify your Email Address </b>');

							redirect(site_url().'/dashboard/');
						}
					
					}		
							$getid = $isLogin[0]['id'];
							
										$fields = array('uid' =>$getid); 

	
						} 
				/*	else
						{
							echo "Please Try Again";
						}  */

		//$this->load->view('account_view');
	}  //--Main if ends here ---  
		
	
	
	else
			
		{	   
			$this->load->view('account_view');  
			
		}   


	} //--- Public function index Ends here ------
	
     


} //--------- Class Account Ends here -----
