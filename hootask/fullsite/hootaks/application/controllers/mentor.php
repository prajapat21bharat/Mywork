<?php 

class Mentor extends CI_Controller   
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
		$this->load->view('d_mentor');
	}
	
	public function profile()
	{
		$getdata=array(
				'id'=>$this->session->userdata('id'),
				);
		$getprofile['getprofile'] = $this->user_model->get_sql_select_data('registration', $getdata);
		$this->load->view('profile_mentor',$getprofile);
		
	}
	
	public function dashboard()
	{
		$this->load->view('d_mentor');
	}
	
	function fileupload()
	{
		$getdata=array(
				'id'=>$this->session->userdata('id'),
				);
		$getprofile = $this->user_model->get_sql_select_data('registration', $getdata);
		
		//$this->load->view('profilepic');
		
	//************************* image Upload 
		
		$config['upload_path'] = './ast/uploads/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$this->load->library('upload');		
		
		$this->upload->initialize($config); ///***------
		
		if( ! $this->upload->do_upload('userfile'))    ///***------userfile
		{
			$data = array('error' => $this->upload->display_errors());
			$this->load->view('profile_mentor');
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			$path=$data['upload_data']['full_path'];
			$imagename=$data['upload_data']['file_name'];
			
	//*********** create new file
		
		$rand_no =  date('Y-m-d-H-i-s');
		$rand_no = str_replace(' ', '', $rand_no);
		
		$raw_name=$data['upload_data']['raw_name'];
		$file_ext=$data['upload_data']['file_ext'];
		$newfile=$rand_no."".$file_ext;
	//		$config['base_url']	= 'http://localhost/bharat/codeigniter/my_ci/';

		$updatedata=array(
							'image'=>$newfile
							);
							$where=$getdata;
							$isupdate = $this->user_model->UPDATEDATA('registration',$where, $updatedata);
							if($isupdate)
							{
								rename($config['upload_path'] . $imagename, $config['upload_path'] .$newfile);
								$this->session->set_flashdata('updatemsg', '<b style="color:green;">Profile Updated Successfully</b>'); 
								redirect(site_url().'/mentor/fileupload');	
							}
							else
							{
								$this->session->set_flashdata('updatemsg', '<b style="color:red;">Error Occured ! Profile No Updated</b>');
								redirect(site_url().'/mentor/fileupload');
							}
		}
	}
	
	
	//******************************************************************************
	function addeducation()
	{
		$where=array($this->session->userdata('id'));
		$getprofile = $this->user_model->get_sql_select_data('education', $getdata);
		$updatedata=array();
	}

	public function add_appoinment()
		
	{
		if (isset($_POST["submit_mentor_detail"]))
				{ 
					 $field=array(
				'uid'=>$this->session->userdata('id'),
				'prefered_day' => $this->input->post('prefered_day'),
				'prefered_from_time' => $this->input->post('prefered_from_time'),
				'prefered_to_time' => $this->input->post('prefered_to_time'),
				'skype_id' => $this->input->post('skype_id'),
				'cost_charges' => $this->input->post('cost_charges')
							  );
											
						$where=array('uid'=>$this->session->userdata('id'),'prefered_day' => $this->input->post('prefered_day'),'prefered_from_time' => $this->input->post('prefered_from_time')); 
			
						$isLogin=$this->user_model->get_sql_select_data('appoinment', $where); 
						
						
			
					if($isLogin == TRUE)
					{ 
						echo"error found.";
				//	redirect(site_url('dashboard/profile'));		
					}
					
					else
					{	
						
											   
					$r = $this->user_model->INSERTDATA('appoinment',$field);  //--- --- INSERT Query fire here -----//
							redirect(site_url('mentor/add_appoinment'));
					}					
				}
				
			$this->load->view('become_mentor');		
	}


	//******************************************************************************
}


