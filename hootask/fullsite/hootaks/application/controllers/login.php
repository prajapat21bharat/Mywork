<?php 

class Login extends CI_Controller   
{

	
	public function index()  // This function index() automaticaly called when class Account is called

	{
		// --- First Validation Define in config/autoload => $autoload['libraries'] = array('database','session','form_validation','upload');

		//---   ---   Setting Validation rule   ------
		
		
	/*	$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[5]|max_length[15]');
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		if($this->form_validation->run() == TRUE)
		{*/
		
			if(isset($_POST["login"]))
			{				
					$checkdata=array(
					'email'=>$this->input->post('email'),
					'password'=>$this->input->post('password')
					);
					$isLogin = $this->user_model->get_sql_select_data('registration', $checkdata);
				if(!empty($isLogin))
				{
						$sessionArr = array(
										'id'=>$isLogin[0]['id'],
										'firstname'=>$isLogin[0]['firstname'],
										'isLogin'=>TRUE
										);
					$this->session->set_userdata($sessionArr);
					$role=trim(ucwords(strtolower($isLogin[0]['user_type'])));
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
							redirect(site_url().'/mentor/');
						}
						if($role=="Jobseeker")
						{
							redirect(site_url().'/user/');
						}
						if($role=="Admin")
						{
							redirect(site_url().'/admin/');
						}
					}
					//echo "Success";
				}
				else
				{
					$this->session->set_flashdata('Logmsg', '<b style="color:red;font-size: 13px">Invalid Email address and Password</b>');
					redirect(site_url().'/login/');
				}
			}
			else
			{
				$this->load->view('login_view');
			}
	/*	}
		else
		{
			$this->load->view('login_view');
			//echo"Failed";
		}
*/

	} //--- Public function index Ends here ------
	
  public function logout()
	{
		$sessionArr = array(
							'id'=>'',
							'firstname'=>'',
							'isLogin'=>FALSE
					);
		$this->session->unset_userdata($sessionArr);
	//	$this->session->sess_destroy();
		//$this->index();
		redirect(site_url().'/login/');
	}   
	

} //--------- Class Account Ends here -----
