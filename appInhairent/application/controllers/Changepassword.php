<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Changepassword extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('id') == "" || $this->session->userdata('role_id') == "" || $this->session->userdata('email') == "" || $this->session->userdata('firstname') == "" || $this->session->userdata('lastname') == "" || $this->session->userdata('isLogin') == "")
		{
            redirect(site_url().'account/');
        }
		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
	}

	//******************************************************************************************//
	
	

	//**************************************	Change Password		********************************************//
	
	function index()
	{
		
		$data='';
		if(isset($_POST['change']))
		{
			$currentpassword=md5(trim($this->input->post('currentpassword')));
			$newpassword=md5(trim($this->input->post('newpassword')));
			$confirmpassword=md5(trim($this->input->post('confirmpassword')));
			
			$userid=$this->session->userdata('id');
			
			$this->form_validation->set_error_delimiters('<div class="text-error">', '<span class="text-error-close">x</span></div>');
			$this->form_validation->set_rules('currentpassword', 'Current Password', 'trim|required|md5');
			$this->form_validation->set_rules('newpassword', 'New Password', 'trim|required|md5');
			$this->form_validation->set_rules('confirmpassword', 'Confirm Password', 'trim|required|md5|matches[newpassword]');
			
			$where=array('id'=>$userid);
			$updatedata=array('password'=>$newpassword);
			if ($this->form_validation->run() == FALSE)
			{
				$data['message'] = validation_errors();
			}
			else
			{
				$chkpassword=$this->user_model->get_sql_select_data('tbl_user',$where,'','','password');
				//echo"<pre>";print_r($chkpassword[0]['password']);exit;
				if(!empty($chkpassword))
				{
					if($currentpassword==$chkpassword[0]['password'])
					{
						$isupdate = $this->user_model->UPDATEDATA('tbl_user',$where, $updatedata);
						if($isupdate)
						{
							//echo $this->db->last_query();exit('update');
							$this->session->set_flashdata('Logmsg', '<b style="color:green;">Password Updated Successfully</b>');
							if($this->session->userdata('role_id')==3)
							{
								redirect(site_url().'stylist/viewprofile');
							}
							if($this->session->userdata('role_id')==2)
							{
								redirect(site_url().'/changepassword');
							}
						}
						else
						{
							//echo $this->db->last_query();exit('u Fails');
							$this->session->set_flashdata('Logmsg', '<b style="color:red;">Error Occured ! Password Not Updated</b>');
							if($this->session->userdata('role_id')==3)
							{
								redirect(site_url().'stylist/viewprofile');
							}
							if($this->session->userdata('role_id')==2)
							{
								redirect(site_url().'/changepassword');
							}
						}
					}
					else
					{
						$data['message'] ='<div class="text-error">Current Password Does not Found<span class="text-success-close">x</span></div>';
					}
				}
			}
		}
		$this->load->view('Common/changepassord_view',$data);
	}
}
