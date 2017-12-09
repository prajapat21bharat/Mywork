<?php 

class Dashboard extends CI_Controller   
{	
	function __construct()
	{
		parent::__construct();
		if($this->session->userdata('isLogin') === FALSE)
		{
		redirect(site_url().'/login/');
		}
	//	  error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

	}
	
	public function index()
	{
		$this->load->view('dashboard_view');
		
	}
	
	public function profile()
	{
		
		$this->session->userdata('firstname');
			  
		if($id = $this->session->userdata('id'))
		{
                
                $where=array(
                        'id'=>$this->session->userdata('id')
							);
                        
                $data['userdata'] = $this->user_model->get_sql_select_data('registration', $where);
				
				 $where=array(
                        'uid'=>$this->session->userdata('id')
							);
				
				$data['edu_data'] = $this->user_model->get_sql_select_data('education', $where);	
				$data['work_data'] = $this->user_model->get_sql_select_data('workexperience', $where);
				$data['summarydata'] = $this->user_model->get_sql_select_data('user_summary', $where);
				$data['skill_data'] = $this->user_model->get_sql_select_data('skills', $where);
				$data['cert_data'] = $this->user_model->get_sql_select_data('certification', $where); 


				$this->load->view('profile_view',$data);
		


		}
		
	}	
	
	
	public function profile_update()
	{
		
	$this->session->userdata('firstname');
			  
		$id = $this->session->userdata('id');
                
                $where=array(
                        'id'=>$this->session->userdata('id')
							);
                        
              $data['userdata'] = $this->user_model->get_sql_select_data('registration', $where);
          
							
				if (isset($_POST["submit_per"]))
				{
					
					$config['upload_path'] = './ast/images/uploads/userpic/';
					$config['allowed_types'] = 'gif|jpg|png|';
					
					$this->load->library('upload', $config);
					
					$this->upload->initialize($config);

					if ( ! $this->upload->do_upload())
					{
						$error = array('error' => $this->upload->display_errors());
			  
				//		$this->load->view('upload_form', $error);
					}
					
					

				$data = array('upload_data' => $this->upload->data());

				$imgname=$data['upload_data']['file_name'];
				
				$fullpath=$data['upload_data']['full_path'];
				
				//$filepath =$data['upload_data']['upload_path'];
				
				$ext = $data['upload_data']['file_ext'];
				
				$existing_img = $this->input->post('existing_img');
				echo $existing_img;
			//	exit;
				$rand_no = time().rand();
				$newname = $rand_no.$ext;
					
								$existing_image=$this->input->post('existingimage');
			//$default_logo = "no_logo.jpg";
			if($newname==$rand_no)
			{
				$logo=$existing_image;
			}
			else
			{
				$logo=$newname;
			}
				//$rename = $fullpath.$ext.$newname ;	
				
				$rename = rename($config['upload_path'] . $imgname , $config['upload_path'] . $logo);

					
				 $field=array(
				 
				'firstname' => $this->input->post('firstname'),
				'lastname' => $this->input->post('lastname'),
				'gender' => $this->input->post('gender'),
				'email' => $this->input->post('email'),
				'country' => $this->input->post('country'),
				'dob' => $this->input->post('dob'),
				'language' => $this->input->post('language'),
				'contact' => $this->input->post('contact'),
				 'image' => $logo 
		
							  );
							  					
				$where=array(
								'id'=>$this->session->userdata('id')
							);
							
				$update = $this->user_model->UPDATEDATA('registration',$where,$field);  //--- --- UPDATE query Fire here ------
							
							if($update)
							{
							
						//	$this->session->set_flashdata('Update successfull', 'UPDATE DONE');
							
							$this->session->set_flashdata('updatemsg', '<b style="color:green;">Profile Updated</b>');
							redirect(site_url('dashboard/profile'));

							}
								
							else
							{
							//$this->session->set_flashdata('Update not successfull', 'UPDATE NOT DONE');
							
							$this->session->set_flashdata('updatemsg', '<b style="color:red;">Error Occured ! Profile Not Updated</b>');

							redirect(site_url('dashboard/profile_edit'));

							}
						

					
				} 		 //--- Main if Close here-----

           
				else
					{
					//$this->load->view('profile_update',$data);
					}
	
	}
	
	// ---------------------------------------------------Update Summary---------------------------------------------------				

	public function summary_update()
	{
	
				$where=array(
								'uid'=>$this->session->userdata('id')
									);
				
				$data['summarydata'] = $this->user_model->get_sql_select_data('user_summary', $where);
				
				
				if (isset($_POST["submit_summary"]))
				{
					 $field=array(
				'uid'=>$this->session->userdata('id'),
				'summary' => $this->input->post('summary')
							  );
											
							$update = $this->user_model->UPDATEDATA('user_summary',$where,$field);  //--- --- UPDATE query Fire here ------
							
							if($update)
							{
													
							$this->session->set_flashdata('updatemsg', '<b style="color:green;">Profile Updated</b>');
							redirect(site_url('dashboard/profile'));

							}
					
						}
				
				else
					{
				//	$this->load->view('profile_update',$data);
				/*	echo "<pre>";
					print_r($data);
					exit; */
					}
				

	
	}
	

// -------------------------------------------Update education-----------------------------------------------------------				

	
	public function edu_update()
	{
									$edit=$this->uri->segment(3);

						$where=array(
								'uid'=>$this->session->userdata('id')
									);
				
				$data['edu_data'] = $this->user_model->get_sql_select_data('education', $where);
				
				

				if (isset($_POST["submit_edu"]))
				{
					 $field=array(
				'uid'=>$this->session->userdata('id'),
				'school' => $this->input->post('school'),
				's_date' => $this->input->post('s_date'),
				'e_date' => $this->input->post('e_date'),
				'degree' => $this->input->post('degree'),
				'field_of_study' => $this->input->post('field_of_study'),
				'grade' => $this->input->post('grade'),
				'description' => $this->input->post('description_edu')
							  );
											
							$update = $this->user_model->UPDATEDATA('education',$where,$field);  //--- --- UPDATE query Fire here ------
							
							if($update)
							{
													
							redirect(site_url('dashboard/profile'));

							}
					
						}
				
				else
					{
				//	$this->load->view('profile_update',$data);
				/*	echo "<pre>";
					print_r($data);
					exit; */
					}
	
	}
	
	
	
	// --------------------------------------- Add education---------------------------------------------------------------				
	
			public function edu_add()
			{	
				if (isset($_POST["submit_add_edu"]))
				{
					 $field=array(
				'uid'=>$this->session->userdata('id'),
				'school' => $this->input->post('school'),
				's_date' => $this->input->post('s_date'),
				'e_date' => $this->input->post('e_date'),
				'degree' => $this->input->post('degree'),
				'field_of_study' => $this->input->post('field_of_study'),
				'grade' => $this->input->post('grade'),
				'description' => $this->input->post('description_edu')
							  );
											
				$where=array('uid'=>$this->session->userdata('id'),'school' =>$this->input->post('school'), 'degree' =>$this->input->post('degree')); 
			
				$isLogin=$this->user_model->get_sql_select_data('education', $where); 
			
			
					if($isLogin == TRUE)
					{
					 echo"Error";	
				//	$this->session->set_flashdata('error', '<b style="color:red; font-size:20px;">Certification already Added. Please Try Again..</b>');
				//	redirect(site_url('dashboard/profile'));		
					}
					
					else
					{	
								   
					$r = $this->user_model->INSERTDATA('education',$field);  //--- --- INSERT Query fire here -----//
							redirect(site_url('dashboard/profile'));
					}					
				}
				
				else
					{
				//	$this->load->view('profile_update',$data);
				/*	echo "<pre>";
					print_r($data);
					exit; */
					}

		}
		// ------------------------------------ Update Work------------------------------------------------------------------				

		public function work_update()
		{
			$where=array(
						'uid'=>$this->session->userdata('id')
						);
			
			$data['work_data'] = $this->user_model->get_sql_select_data('workexperience', $where);
		/*	echo"<pre>";
			print_r($data);
			exit; */
				if (isset($_POST["submit_work"]))
				{
					 $field=array(
				'uid'=>$this->session->userdata('id'),
				'company_name' => $this->input->post('company_name'),
				'jobtitle' => $this->input->post('jobtitle'),
				'location' => $this->input->post('location'),
				'from_month' => $this->input->post('from_month'),
				's_year' => $this->input->post('s_year'),
				'to_month' => $this->input->post('to_month'),
				'e_year' => $this->input->post('e_year'),
				'description' => $this->input->post('description_work')

				
							  );
					
							$where = array('uid'=>$this->session->userdata('id'));
							
							$update = $this->user_model->UPDATEDATA('workexperience',$where,$field);  //--- --- UPDATE query Fire here ------
							
							if($update)
							{
							
						//	$this->session->set_flashdata('Update successfull', 'UPDATE DONE');
							
							$this->session->set_flashdata('updatemsg', '<b style="color:green;">Profile Updated</b>');
							redirect(site_url('dashboard/profile'));

							}
					
						}
				
				else
					{
				//	$this->load->view('profile_update',$data);
				/*	echo "<pre>";
					print_r($data);
					exit; */
					}
				
			}
			
			
		// ---------------------------------------------- Add Work--------------------------------------------------------				
		public function work_add()

			{	
				if (isset($_POST["submit_add_work"]))
				{
					 $field=array(
				'uid'=>$this->session->userdata('id'),
				'company_name' => $this->input->post('company_name'),
				'jobtitle' => $this->input->post('jobtitle'),
				'location' => $this->input->post('location'),
				'from_month' => $this->input->post('from_month'),
				's_year' => $this->input->post('s_year'),
				'to_month' => $this->input->post('to_month'),
				'e_year' => $this->input->post('e_year'),
				'description' => $this->input->post('description_work')

				
							  );
					
			$where=array('uid'=>$this->session->userdata('id'),'company_name' =>$this->input->post('company_name'), 'jobtitle' =>$this->input->post('jobtitle'),'s_year'=>$this->session->userdata('s_year')); 
			
			$isLogin=$this->user_model->get_sql_select_data('workexperience', $where); 
			
			
					if($isLogin == TRUE)
					{
					 	
					$this->session->set_flashdata('error_addwork', '<b style="color:red; font-size:15px;">Experience already Added. Please Try Again..</b>');
					redirect(site_url('dashboard/profile'));		
					}
					
					else
					{	
								   
					$r = $this->user_model->INSERTDATA('workexperience',$field);  //--- --- INSERT Query fire here -----//
							redirect(site_url('dashboard/profile'));
					}					
				}
					
		}				
				
			
	// --------------------------------------------Update skill---------------------------------------------------------------				

	
		public function skill_update()
			
			{
				$where=array(
							'uid'=>$this->session->userdata('id')
							);
				
				$data['skill_data'] = $this->user_model->get_sql_select_data('skills', $where);
				
				

				if (isset($_POST["submit_edit_skill"]))
				{
					 $field=array(
				'uid'=>$this->session->userdata('id'),
				'skill' => $this->input->post('skill')
							  );
											
							$update = $this->user_model->UPDATEDATA('skills',$where,$field);  //--- --- UPDATE query Fire here ------
							
							if($update)
							{
													
							$this->session->set_flashdata('updatemsg', '<b style="color:green;">Profile Updated</b>');
							redirect(site_url('dashboard/profile'));

							}
					
						}
				
				else
					{
				//	$this->load->view('profile_update',$data);
				/*	echo "<pre>";
					print_r($data);
					exit; */
					}

	}		
			
// ---------------------------------------Update Certification---------------------------------------------------------------				

	
	    public function cert_update()
		{
			 
	
						$where=array(
								'uid'=>$this->session->userdata('id')
									);
				
				$data['cert_data'] = $this->user_model->get_sql_select_data('certification', $where);
				
				

				if (isset($_POST["submit_edit_cert"]))
				{ 
					/*	echo $this->input->post('checkbox_date');
					print_r($this->input->post('checkbox_date'));
					exit; */
					
					 $field=array(
				'uid'=>$this->session->userdata('id'),
				'cert_name' => $this->input->post('cert_name'),
				'cert_authority' => $this->input->post('cert_authority'),
				'license_number' => $this->input->post('license_number'),
				'cert_url' => $this->input->post('cert_url'),
				's_date' => $this->input->post('s_date'),
				'from_month' => $this->input->post('from_month'),
				'e_date' => $this->input->post('e_date'),
				'to_month' => $this->input->post('to_month')
							  );
											
							$update = $this->user_model->UPDATEDATA('certification',$where,$field);  //--- --- UPDATE query Fire here ------
							
							if($update)
							{
													
							$this->session->set_flashdata('updatemsg', '<b style="color:green;">Profile Updated</b>');
							redirect(site_url('dashboard/profile'));

							}
					
						}
				
				
				else
					{
				//	$this->load->view('profile_update',$data);
					 
					}

		}
	     
	// --------------------------------------- Add Certification---------------------------------------------------------------				
   
	    
		public function cert_add()
		
		{		
				if (isset($_POST["submit_add_cert"]))
				{ 
					 $field=array(
				'uid'=>$this->session->userdata('id'),
				'cert_name' => $this->input->post('cert_name'),
				'cert_authority' => $this->input->post('cert_authority'),
				'license_number' => $this->input->post('license_number'),
				'cert_url' => $this->input->post('cert_url'),
				's_date' => $this->input->post('s_date'),
				'from_month' => $this->input->post('from_month'),
				'e_date' => $this->input->post('e_date'),
				'to_month' => $this->input->post('to_month')
							  );
											
						$where=array('uid'=>$this->session->userdata('id'),'cert_name' => $this->input->post('cert_name'),'license_number' => $this->input->post('license_number')); 
			
						$isLogin=$this->user_model->get_sql_select_data('certification', $where); 
						
						
			
					if($isLogin == TRUE)
					{ 
						echo"error found.";
				//	redirect(site_url('dashboard/profile'));		
					}
					
					else
					{	
						
											   
					$r = $this->user_model->INSERTDATA('certification',$field);  //--- --- INSERT Query fire here -----//
							redirect(site_url('dashboard/profile'));
					}					
				}
				
				
				else
					{
				//		$this->load->view('profile_update',$data);
					 
					}
	
			}
	// -------------------------------------------- Delete Education----------------------------------------------------------				
		
		
		public function delete_edu()
		{
				
			
				$edit=$this->uri->segment(3);
			//	echo $edit;
			//	exit;
					
				$where=array('id'=>$edit); 
			
				$isLogin=$this->user_model->DELETEDATA('education', $where); 
				redirect(site_url('dashboard/profile'));

		}
	
	
	// ----------------------------------------------- Delete work-------------------------------------------------------				
            
         	
		public function delete_work()
		{
				
			
				$edit=$this->uri->segment(3);
					
					
				$where=array('id'=>$edit); 
			
				$isLogin=$this->user_model->DELETEDATA('workexperience', $where); 
				redirect(site_url('dashboard/profile'));

		}
		
		// -------------------------------------------- Delete Certification----------------------------------------------------------				
		
		
		public function delete_cert()
		{
				
			
				$edit=$this->uri->segment(3);
					
				$where=array('id'=>$edit); 
			
				$isLogin=$this->user_model->DELETEDATA('certification', $where); 
				redirect(site_url('dashboard/profile'));

		}
	


	public function search_mentors()
		
	{
		$this->load->view('search_mentors_view');
		
	}
	
	public function addcompany()
		
	{
		
	
		if (isset($_POST["submit_company"]))  
			{  
		
			 $fields=array(                             
			'company_name' => $this->input->post('company_name'),
			'category' => $this->input->post('category')
							);	
				$where=array('company_name' =>$this->input->post('company_name')); 
				
				$isLogin=$this->user_model->get_sql_select_data('company', $where); //---- SELECT Query Fire Here for Checking email if already exist -----
				
				if($isLogin == TRUE)
				{
				echo "already added";
				redirect(site_url('dashboard/addcompany'));		
				}
				
				else
				{				   		   
				$r = $this->user_model->INSERTDATA('company',$fields);  //--- --- INSERT Query fire here -----//
				echo"Done";

				}
		
	
		    }
		    
					else
					{
						
							$this->load->view('addcompany_view');
			
					}
	}
	
	public function become_mentor()
	{
		$profile_percent = $this->uri->segment(3);
		
		if($profile_percent == 100)
		{   
			$field=array(
				 
						 'user_type' => 'Mentor' 
		
							  );
							  					
				$where=array(
								'id'=>$this->session->userdata('id')
							);
							
				$update = $this->user_model->UPDATEDATA('registration',$where,$field);  //--- --- UPDATE query Fire here ------
				if($update)
				{
				$this->session->set_flashdata('Logmsg', '<b style="color:green;">Congratulation!! You successfully become Mentor. </b>');
				redirect(site_url('mentor/'));

				}
				
			
			}
			else
			{
				$this->session->set_flashdata('Logmsg', '<b style="color:red;">Not eligible to become mentor.Please complete profile 100% </b>');
				redirect(site_url('dashboard/profile'));

			}	
		
	$this->load->view('become_mentor');

	}
	
	
	
}
