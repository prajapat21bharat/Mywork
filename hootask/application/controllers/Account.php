<?php 

class Account extends CI_Controller   
{

	function __construct()
	{
		parent::__construct();
		
		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
		date_default_timezone_set('America/Los_Angeles');
	}
	

function index()
	{
		if($this->session->userdata('user_type') == "Admin")
		{
            redirect(site_url().'admin/dashboard');
        }
        elseif($this->session->userdata('user_type') == "User")
        {
			redirect(site_url().'stylist/viewprofile');
		}
        else
        {
			$this->load->view('login_view');
        }
	}
	
	public function login()  // This function index() automaticaly called when class Account is called
	{
		
		
			if(isset($_POST["login"]))
			{				
					$checkdata=array(
					'email'=>$this->input->post('email'),
					'password'=>md5($this->input->post('password'))
					);
					$isLogin = $this->user_model->get_sql_select_data('registration', $checkdata);
				if(!empty($isLogin))
				{
					$role=trim(ucwords(strtolower($isLogin[0]['user_type'])));
						$sessionArr = array(
										'id'=>$isLogin[0]['id'],
										'name'=>$isLogin[0]['name'],
										'user_type'=>$role,
										'isLogin'=>TRUE
										);
					$this->session->set_userdata($sessionArr);
					
					$activestate=$isLogin[0]['active_state'];
					if($activestate==0)
					{
						$this->session->set_flashdata('Logmsg', '<b style="color:red;font-size: 13px">Please Activate Account First</b>');
						redirect(site_url().'account/login/');
					}
					else
					{
						if($role=="User")
						{
							redirect(site_url().'user/');
						}
						if($role=="Admin")
						{
							redirect(site_url().'admin/');
						}
					}
					//echo "Success";
				}
				else
				{
					$this->session->set_flashdata('Logmsg', '<b style="color:red;font-size: 13px">Invalid Email address and Password</b>');
					redirect(site_url().'account/login/');
				}
			}
			else
			{
				$this->load->view('login_view');
			}
	

	} //--- Public function index Ends here ------
	
	function logout()
	{
		$sessionArr = array(
							'id'=>'',
							'name'=>'',
							'user_type'=>'',
							'isLogin'=>FALSE
						);
						
						
		$this->session->set_userdata($sessionArr);	
		redirect(site_url().'account/');
	} 

} //--------- Class Account Ends here -----
