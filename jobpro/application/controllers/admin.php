<?php 

class Admin extends CI_Controller   
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
		$this->load->view('d_admin');
	}
	
	public function demo()
	{
		$config['total_rows'] = 200;
		$config['per_page'] = 5;

		$this->pagination->initialize($config);
		
		$getcompany['getcompany'] = $this->user_model->get_sql_select_data('company','', 'company_name  ASC');
		//print_r($this->db->last_query());
		//echo $where;
		//echo $category;
		//echo"<pre>";print_r($getcompany);exit("hello");
		if(isset($_POST["addcompany"]))
		{
			$config['upload_path'] = './ast/uploads/company_logos/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload');			
			$this->upload->initialize($config); ///***------
			if( ! $this->upload->do_upload('userfile'))    ///***------userfile
			{
				$data = array('error' => $this->upload->display_errors());
			//	$this->load->view('profile_mentor');
			}
		
			$data = array('upload_data' => $this->upload->data());
			$path=$data['upload_data']['full_path'];
			$imagename=$data['upload_data']['file_name'];					
			//*********** create new file
				$rand_no =  date('Y-m-d H-i-s');
				$rand_no = str_replace(' ', '', $rand_no);
				$raw_name=$data['upload_data']['raw_name'];
				$file_ext=$data['upload_data']['file_ext'];
				$newfile=$rand_no."".$file_ext;
			//		$config['base_url']	= 'http://localhost/bharat/codeigniter/my_ci/';
			//echo"<pre>";print_r($data);exit;
			
			$default_logo = "no_logo.jpg";
			if($newfile==$rand_no)
			{
				$logo=$default_logo;
			}
			else
			{
				$logo=$newfile;
			}
		//echo"<pre>";print_r($data);
			//echo"<pre>";print_r($logo); exit;
			$insertdata=array(
								'company_name'=>trim(ucwords(strtolower($this->input->post('companyname')))),
								'category'=>$this->input->post('category'),
								'image'=>$logo,
								
							);
			$where=array(
								'company_name'=>trim(ucwords(strtolower($this->input->post('companyname')))),
								'category'=>$this->input->post('category'),
							);
			if(!in_array($file_ext,$config['allowed_types']))
			{
				$this->session->set_flashdata('Logmsg', '<b style="color:green;">Invalid File</b>');
				redirect(site_url().'/admin/company');
			}
			else
			{
				if($chkcompany=$this->user_model->get_sql_select_data('company',$where))
				{
					$this->session->set_flashdata('Logmsg', '<b style="color:red;">Company Details Already Exists</b>');
					redirect(site_url().'/admin/company');
				//	print_r($this->db->last_query());
				}
				else
				{
					$isadded = $this->user_model->INSERTDATA('company', $insertdata);
					if($isadded)
					{
						rename($config['upload_path'] . $imagename, $config['upload_path'] .$logo);
						//	echo"Data Inserted";
						$this->session->set_flashdata('Logmsg', '<b style="color:green;">Company Details Added Successfully</b>');
						redirect(site_url().'/admin/company');
					}
					else
					{
						$this->session->set_flashdata('Logmsg', '<b style="color:red;">Please Try Again</b>');
						redirect(site_url().'/admin/company');
					}
				}
			}
		}
		else
		{
			$this->load->view('test2',$getcompany);
		}
	}
	
	
//*********************** Add Sub category *****************************************	
	
	public function subcategory()
	{
		if(isset($_POST['addsubcategory']))
		{
			$insertdata=array(
								'categoryid'=>$this->input->post('main_category'),
								'name'=>trim(ucwords(strtolower($this->input->post('subcategory')))),
							);
			$where=array(
								'categoryid'=>$this->input->post('main_category'),
								'name'=>trim(ucwords(strtolower($this->input->post('subcategory')))),
							);
			if($chkuser=$this->user_model->get_sql_select_data('subcategory',$where))
			{
				$this->session->set_flashdata('Logmsg', '<b style="color:red;">Category Already Exists</b>');
				redirect(site_url().'/admin/subcategory');
			//	print_r($this->db->last_query());
			}
			else
			{
				$isadded = $this->user_model->INSERTDATA('subcategory', $insertdata);
				if($isadded)
				{
					//	echo"Data Inserted";
					$this->session->set_flashdata('Logmsg', '<b style="color:green;">Category Added Successfully</b>');
					redirect(site_url().'/admin/subcategory');
				}
				else
				{
					$this->session->set_flashdata('Logmsg', '<b style="color:red;">Please Try Again</b>');
					redirect(site_url().'/admin/subcategory');
				}
			}
		}
		else
		{
			$this->load->view('addsubcategory_view');
		}
	}
	
//*********************** View Users *****************************************	
	
	public function users()
	{
		$not=array('user_type'=>'admin');
		$getusers['getusers'] = $this->user_model->get_sql_select_data('registration','','firstname ASC',$not);
		//echo $this->db->last_query();
		$this->load->view('view_users',$getusers);
	}
	

//*********************** Change Active State *****************************************	
	
	public function activestate()
	{
		$rawdata = $this->uri->segment(3);
		
		$idea=(explode("_",$rawdata));
		$editid = $idea[0];
		if(($idea[1])=="Deactive")
		{
			$state=1;
		}
		else
		{
			$state=0;
		}
		$where=array('id'=>$editid,);
		$updatestate=array('active_state'=>$state,);
		if($this->user_model->UPDATEDATA('registration',$where,$updatestate))
		{
			$this->session->set_flashdata('Logmsg', '<b style="color:green;">User Status Changed Successfully</b>');
			redirect(site_url().'/admin/users');
		}
		else
		{
			$this->session->set_flashdata('Logmsg', '<b style="color:red;">Please Try Again</b>');
			redirect(site_url().'/admin/users');
		}
		echo"<pre>";print_r($getstate);
	}
	
//*********************** Add Language *****************************************	


public function add_language()
	{
		$getlang['getlang'] = $this->user_model->get_sql_select_data('languages','', 'language  ASC');
		if(isset($_POST['addlanguage']))
		{
			$insertdata=array(
								'language'=>trim(ucwords(strtolower($this->input->post('language')))),
							);
			$where=array('language'=>trim(ucwords(strtolower($this->input->post('language')))));
			if($chkuser=$this->user_model->get_sql_select_data('languages',$where))
			{
				$this->session->set_flashdata('Logmsg', '<b style="color:red;">Language Already Exists</b>');
				redirect(site_url().'/admin/add_language');
			//	print_r($this->db->last_query());
			}
			else
			{
				$isadded = $this->user_model->INSERTDATA('languages', $insertdata);
				if($isadded)
				{
					//	echo"Data Inserted";
					$this->session->set_flashdata('Logmsg', '<b style="color:green;">Language Added Successfully</b>');
					redirect(site_url().'/admin/add_language');
				}
				else
				{
					$this->session->set_flashdata('Logmsg', '<b style="color:red;">Please Try Again</b>');
					redirect(site_url().'/admin/add_language');
				}
			}
		}
		else
		{
			$this->load->view('add_language_view',$getlang);
		}
	}

	

//*********************** Add Category *****************************************	
	
	public function newcategory()
	{
		$getcategory['getcategory'] = $this->user_model->get_sql_select_data('category','', 'categoryname  ASC');
		
		if(isset($_POST['addcategory']))
		{
			$insertdata=array(
								'categoryname'=>trim(ucwords(strtolower($this->input->post('category')))),
							);
			$where=array('categoryname'=>trim(ucwords(strtolower($this->input->post('category')))));
			if($chkuser=$this->user_model->get_sql_select_data('category',$where))
			{
				$this->session->set_flashdata('Logmsg', '<b style="color:red;">Category Already Exists</b>');
				redirect(site_url().'/admin/newcategory');
			//	print_r($this->db->last_query());
			}
			else
			{
				$isadded = $this->user_model->INSERTDATA('category', $insertdata);
				if($isadded)
				{
					//	echo"Data Inserted";
					$this->session->set_flashdata('Logmsg', '<b style="color:green;">Category Added Successfully</b>');
					redirect(site_url().'/admin/newcategory');
				}
				else
				{
					$this->session->set_flashdata('Logmsg', '<b style="color:red;">Please Try Again</b>');
					redirect(site_url().'/admin/newcategory');
				}
			}
		}
		else
		{
			$this->load->view('new_addcategory_view',$getcategory);
		}
	}
	
//*********************** Delete Category *****************************************	

	function delete_category()
			{
				
				$deleteid = $this->uri->segment(3);
				$where=array('id'=>$deleteid);
				$delcontacts = $this->user_model->DELETEDATA('category', $where);
				if($delcontacts)
				{
					$this->session->set_flashdata('Logmsg', '<b style="color:green;">Category Deleted Successfully</b>');
					redirect(site_url().'/admin/newcategory');
				}
				else
				{
					$this->session->set_flashdata('Logmsg', '<b style="color:Red;">Category Not Deleted </b>');
					redirect(site_url().'/admin/newcategory');
				}

			}

//*********************** Delete Language *****************************************	

	function delete_lang()
	{
		$deleteid = $this->uri->segment(3);
		$where=array('id'=>$deleteid);
		$delcontacts = $this->user_model->DELETEDATA('languages', $where);
		if($delcontacts)
		{
			$this->session->set_flashdata('Logmsg', '<b style="color:green;">Language Deleted Successfully</b>');
			redirect(site_url().'/admin/add_language');
		}
		else
		{
			$this->session->set_flashdata('Logmsg', '<b style="color:Red;">Language Not Deleted </b>');
			redirect(site_url().'/admin/add_language');
		}
	}

//*********************** Delete Company *****************************************	

	function delete_company()
	{
		$deleteid = $this->uri->segment(3);
		$where=array('id'=>$deleteid);
		$delcontacts = $this->user_model->DELETEDATA('company', $where);
		if($delcontacts)
		{
			$this->session->set_flashdata('Logmsg', '<b style="color:green;">Company Deleted Successfully</b>');
			redirect(site_url().'/admin/company');
		}
		else
		{
			$this->session->set_flashdata('Logmsg', '<b style="color:Red;">Company Not Deleted </b>');
			redirect(site_url().'/admin/company');
		}

	}


//*********************** Edit Category *****************************************
	function edit_category()
	{
		$editid = $this->uri->segment(3);
		$where=array('id'=>$editid);
		$getcategory['getcategory'] = $this->user_model->get_sql_select_data('category',$where, 'categoryname  ASC');
		$updatedata=array('categoryname'=>$this->input->post('category'),);
		//echo"<pre>";print_r($getcategory);exit;
		if(isset($_POST["updatecategory"]))
		{
			$chk_cate_exist = $this->user_model->get_sql_select_data('category',$updatedata);
			if($chk_cate_exist)
			{
				$newid=$this->input->post('categoryid');
				$this->session->set_flashdata('Logmsg', '<b style="color:Red;">Company Details Already Exist </b>');
				redirect( site_url('admin/edit_category/'.$newid));
			}
			else
			{
				$isupdate = $this->user_model->UPDATEDATA('category',$where, $updatedata);
				if($isupdate)
				{
					$this->session->set_flashdata('Logmsg', '<b style="color:green;">Category Updated Successfully</b>');
                    redirect(site_url().'/admin/newcategory');
				}
				else
				{
					$this->session->set_flashdata('Logmsg', '<b style="color:red;">Error Occured ! Category Not Updated</b>');
					redirect(site_url().'/admin/newcategory');
				}
			}
		}
		else
		{
			$this->load->view('update_category_view',$getcategory);
		}
	}


//*********************** Edit Language *****************************************
	function edit_language()
	{
		$editid = $this->uri->segment(3);
		$where=array('id'=>$editid);
		$getlanguage['getlanguage'] = $this->user_model->get_sql_select_data('languages',$where, 'language  ASC');
		$updatedata=array('language'=>$this->input->post('language'),);
		//echo"<pre>";print_r($getcategory);exit;
		if(isset($_POST["updatelanguage"]))
		{
			$chk_cate_exist = $this->user_model->get_sql_select_data('languages',$updatedata);
			if($chk_cate_exist)
			{
				$newid=$this->input->post('languageid');
				$this->session->set_flashdata('Logmsg', '<b style="color:Red;">Language Already Exist </b>');
				redirect( site_url('admin/edit_language/'.$newid));
			}
			else
			{
				$isupdate = $this->user_model->UPDATEDATA('languages',$where, $updatedata);
				if($isupdate)
				{
					$this->session->set_flashdata('Logmsg', '<b style="color:green;">Language Updated Successfully</b>');
                    redirect(site_url().'/admin/add_language');
				}
				else
				{
					$this->session->set_flashdata('Logmsg', '<b style="color:red;">Error Occured ! Language Not Updated</b>');
					redirect(site_url().'/admin/add_language');
				}
			}
		}
		else
		{
			$this->load->view('update_language_view',$getlanguage);
		}
	}
	
//*********************** Add Company *****************************************	

	public function company()
	{
		
		$config['total_rows'] = 200;
		$config['per_page'] = 5;

		$this->pagination->initialize($config);
		
		$getcompany['getcompany'] = $this->user_model->get_sql_select_data('company','', 'company_name  ASC');
		//print_r($this->db->last_query());
		//echo $where;
		//echo $category;
		//echo"<pre>";print_r($getcompany);exit("hello");
		if(isset($_POST["addcompany"]))
		{
			$config['upload_path'] = './ast/images/uploads/company_logos/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload');			
			$this->upload->initialize($config); ///***------
			if( ! $this->upload->do_upload('userfile'))    ///***------userfile
			{
				$data = array('error' => $this->upload->display_errors());
			//	$this->load->view('profile_mentor');
			}
		
			$data = array('upload_data' => $this->upload->data());
			$path=$data['upload_data']['full_path'];
			$imagename=$data['upload_data']['file_name'];					
			//*********** create new file
				$rand_no =  date('Y-m-d H-i-s');
				$rand_no = str_replace(' ', '', $rand_no);
				$raw_name=$data['upload_data']['raw_name'];
				$file_ext=$data['upload_data']['file_ext'];
				$newfile=$rand_no."".$file_ext;
			//		$config['base_url']	= 'http://localhost/bharat/codeigniter/my_ci/';
			//echo"<pre>";print_r($data);print_r($newfile);exit;
			
			$default_logo = "no_logo.jpg";
			if($newfile==$rand_no)
			{
				$logo=$default_logo;
			}
			else
			{
				$logo=$newfile;
			}
		//echo"<pre>";print_r($data);
			//echo"<pre>";print_r($logo); exit;
			$insertdata=array(
								'company_name'=>trim(ucwords(strtolower($this->input->post('companyname')))),
								'category'=>$this->input->post('category'),
								'image'=>$logo,
								
							);
			$where=array(
								'company_name'=>trim(ucwords(strtolower($this->input->post('companyname')))),
								'category'=>$this->input->post('category'),
								'image'=>$logo,
							);
			if($chkcompany=$this->user_model->get_sql_select_data('company',$where))
			{
				$this->session->set_flashdata('Logmsg', '<b style="color:red;">Company Details Already Exists</b>');
				redirect(site_url().'/admin/company');
				//print_r($this->db->last_query());
			}
			else
			{
				$isadded = $this->user_model->INSERTDATA('company', $insertdata);
				if($isadded)
				{
					rename($config['upload_path'] . $imagename, $config['upload_path'] .$logo);
					//	echo"Data Inserted";
					//print_r($this->db->last_query());exit;
					$this->session->set_flashdata('Logmsg', '<b style="color:green;">Company Details Added Successfully</b>');
					redirect(site_url().'/admin/company');
				}
				else
				{
					$this->session->set_flashdata('Logmsg', '<b style="color:red;">Please Try Again</b>');
					redirect(site_url().'/admin/company');
				}
			}
		}
		else
		{
			$this->load->view('addcompany_view',$getcompany);
		}
	}

	
//*********************** Edit Company *****************************************
	function update_company()
	{
		$editid = $this->uri->segment(3);
		$where=array('id'=>$editid);
		$getcompany['getcompany'] = $this->user_model->get_sql_select_data('company',$where, 'company_name ASC');
		
		//echo"<pre>";print_r($getcompany);exit;
		if(isset($_POST["updatecompany"]))
		{
			$config['upload_path'] = './ast/images/uploads/company_logos/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload');			
			$this->upload->initialize($config); ///***------
			if( ! $this->upload->do_upload('userfile'))    ///***------userfile
			{
				$data = array('error' => $this->upload->display_errors());
			//	$this->load->view('profile_mentor');
			}
		
			$data = array('upload_data' => $this->upload->data());
			$path=$data['upload_data']['full_path'];
			$imagename=$data['upload_data']['file_name'];					
			//*********** create new file
				$rand_no =  date('Y-m-d H-i-s');
				$rand_no = str_replace(' ', '', $rand_no);
				$raw_name=$data['upload_data']['raw_name'];
				$file_ext=$data['upload_data']['file_ext'];
				$newfile=$rand_no."".$file_ext;
			//		$config['base_url']	= 'http://localhost/bharat/codeigniter/my_ci/';
			//echo"<pre>";print_r($data);exit;
			$existing_image=$this->input->post('existingimage');
			//$default_logo = "no_logo.jpg";
			if($newfile==$rand_no)
			{
				$logo=$existing_image;
			}
			else
			{
				$logo=$newfile;
			}
		//echo"<pre>";print_r($data);
			//echo"<pre>";print_r($logo); exit;
			$updatedata=array(
								'company_name'=>trim(ucwords(strtolower($this->input->post('companyname')))),
								'category'=>$this->input->post('category'),
								'image'=>$logo,
								
							);
			$where_company=array(
								'company_name'=>trim(ucwords(strtolower($this->input->post('companyname')))),
								'category'=>$this->input->post('category'),
								'image'=>$logo,
							);
			$where_id=array('id'=>$this->input->post('companyid'));
			if($chkcompany=$this->user_model->get_sql_select_data('company',$where_company))
			{
				$this->session->set_flashdata('Logmsg', '<b style="color:red;">Company Details Already Exists</b>');
				redirect(site_url().'/admin/company');
			//	print_r($this->db->last_query());
			}
			else
			{
				$isadded = $this->user_model->UPDATEDATA('company',$where_id, $updatedata);
				if($isadded)
				{
					rename($config['upload_path'] . $imagename, $config['upload_path'] .$logo);
					//	echo"Data Inserted";
					$this->session->set_flashdata('Logmsg', '<b style="color:green;">Company Details Added Successfully</b>');
					redirect(site_url().'/admin/company');
				}
				else
				{
					$this->session->set_flashdata('Logmsg', '<b style="color:red;">Please Try Again</b>');
					redirect(site_url().'/admin/company');
				}
			}
		}
		else
		{
			$this->load->view('update_company_view',$getcompany);
		}
	}


//********************************* Add Profile *****************************************	

	function profile()
	{
		$getdata=array(
				'id'=>$this->session->userdata('id'),
				);
		$getprofile['getprofile'] = $this->user_model->get_sql_select_data('registration', $getdata);
		if(isset($_POST["change"]))
		{
			$config['upload_path'] = './ast/images/uploads/userpic/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload');			
			$this->upload->initialize($config); ///***------
			if( ! $this->upload->do_upload('userfile'))    ///***------userfile
			{
				$data = array('error' => $this->upload->display_errors());
			//	$this->load->view('profile_mentor');
			}
			$data = array('upload_data' => $this->upload->data());
			$path=$data['upload_data']['full_path'];
			$imagename=$data['upload_data']['file_name'];					
			//*********** create new file
				$rand_no =  date('Y-m-d H-i-s');
				$rand_no = str_replace(' ', '', $rand_no);
				$raw_name=$data['upload_data']['raw_name'];
				$file_ext=$data['upload_data']['file_ext'];
				$newfile=$rand_no."".$file_ext;
			//		$config['base_url']	= 'http://localhost/bharat/codeigniter/my_ci/';
			//echo"<pre>";print_r($data);print_r($newfile);exit;
			$existing_image=$this->input->post('existingimage');
			//$default_logo = "no_logo.jpg";
			if($newfile==$rand_no)
			{
				$logo=$existing_image;
			}
			else
			{
				$logo=$newfile;
			}

			//echo"<pre>";print_r($logo);
			//echo"<pre>";print_r($data); exit;
			$updatedata=array(
								'firstname'=>trim(ucwords(strtolower($this->input->post('firstname')))),
								'lastname'=>trim(ucwords(strtolower($this->input->post('lastname')))),
								'image'=>$logo,
							);
			$where_data=array(
								'firstname'=>trim(ucwords(strtolower($this->input->post('firstname')))),
								'lastname'=>$this->input->post('lastname'),
								'image'=>$logo,
							);
			$where_id=array('id'=>$this->session->userdata('id'));
			if($chkdetails=$this->user_model->get_sql_select_data('registration',$where_data))
			{
				$this->session->set_flashdata('Logmsg', '<b style="color:red;">Profile Updated With Existing Details</b>');
				redirect(site_url().'/admin/profile');
			//	print_r($this->db->last_query());
			}
			else
			{
				$isadded = $this->user_model->UPDATEDATA('registration',$where_id, $updatedata);
				if($isadded)
				{
					rename($config['upload_path'] . $imagename, $config['upload_path'] .$logo);
					//	echo"Data Inserted";
					$this->session->set_flashdata('Logmsg', '<b style="color:green;">Profile Updated Successfully</b>');
					redirect(site_url().'/admin/profile');
				}
				else
				{
					$this->session->set_flashdata('Logmsg', '<b style="color:red;">Please Try Again</b>');
					redirect(site_url().'/admin/profile');
				}
			}
		}
		else
		{
			$this->load->view('profile_admin',$getprofile);
		}
	}
	
	
//*********************** Add Change Password *****************************************	

	function changepassword()
	{
		$getdata=array('id'=>$this->session->userdata('id'),);
		$getpassword['getpassword'] = $this->user_model->get_sql_select_data('registration', $getdata);
			
		if(isset($_POST["changepassword"]))
		{
		//	echo"<pre>";print_r($getpassword);exit;
			$oldpassword=$this->input->post('oldpassword');
			$databasepassword=$this->input->post('databasepassword');
			$newpassword=$this->input->post('newpassword');
			$updatedata=array('password'=>$newpassword);
			$where=array('id'=>$this->session->userdata('id'),);
			//echo"<pre>";print_r($getpassword);print_r($oldpassword)."<br>";print_r($newpassword);exit;
			if($oldpassword==$databasepassword)
			{
				//echo"hello";exit;
				$isadded = $this->user_model->UPDATEDATA('registration',$where, $updatedata);
				$this->session->set_flashdata('Logmsg', '<b style="color:green;">Password Changed Successfully</b>');
				redirect(site_url().'/admin/changepassword');
			}
			else
			{
				$this->session->set_flashdata('Logmsg', '<b style="color:red;">Invalid Old Password</b>');
				redirect(site_url().'/admin/changepassword');
			}
		}
		else
		{
			$this->load->view('changepassword',$getpassword);
		}
		
	}
	
//*********************** Add Dashboard *****************************************	

	function dashboard()
	{
		$this->load->view('d_admin');
	}

}
