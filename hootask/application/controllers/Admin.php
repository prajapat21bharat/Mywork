<?php 

class Admin extends CI_Controller   
{	
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('id') == "" || $this->session->userdata('user_type') == "" || $this->session->userdata('name') == "" || $this->session->userdata('isLogin') == "")
		{
            redirect(site_url().'account/');
        }
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
	
	

	public function users()
	{
		$not=array('user_type'=>'admin');
		$getusers['getusers'] = $this->user_model->get_sql_select_data('registration','','firstname ASC',$not);
		//echo $this->db->last_query();
		$this->load->view('view_users',$getusers);
	}
	
	
	function getsubcategorybyCateId()
	{
		$cate_id = $_POST['cate_id'];
		
		$fields_imgs=array('');
		$join_imgs=array(
				array('table'=>'card_images','condition'=>'card_images.card_id = tbl_cards.id', 'jointype'=>'inner'),
				array('table'=>'category','condition'=>'category.id = tbl_cards.category', 'jointype'=>'inner'),
				);
		$data['subcategory'] = $this->user_model->get_joins('subcategory',array('subcategory.category_id'=>$cate_id),'');
		if(!empty($data['subcategory']))
		{
			echo"<option value=''>Select Sub Category</option>";
			foreach($data['subcategory'] as $subcategory)
			{
				echo "<option value='$subcategory[id]'>$subcategory[name]</option>";
				//print_r($subcategory);
			}
		}
		else
		{
			echo"<option value=''>Select Sub Category</option>";
		}
	}
	
	function getchildcategorybySub_cateId()
	{
		$sub_cate_id = $_POST['sub_cate_id'];
		
		$fields_imgs=array('');
		$join_imgs=array(
				array('table'=>'card_images','condition'=>'card_images.card_id = tbl_cards.id', 'jointype'=>'inner'),
				array('table'=>'category','condition'=>'category.id = tbl_cards.category', 'jointype'=>'inner'),
				);
		$data['child_sub_category'] = $this->user_model->get_joins('child_sub_category',array('child_sub_category.sub_cate_id'=>$sub_cate_id),'');
		if(!empty($data['child_sub_category']))
		{
			echo"<option value=''>Select Child Category</option>";
			foreach($data['child_sub_category'] as $childcategory)
			{
				echo "<option value='$childcategory[id]'>$childcategory[child_name]</option>";
				//print_r($subcategory);
			}
		}
		else
		{
			echo"<option value=''>Select Child Category</option>";
		}
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
								'name'=>trim(ucwords(strtolower($this->input->post('name')))),
								'image'=>$logo,
							);
			$where_data=array(
								'name'=>trim(ucwords(strtolower($this->input->post('name')))),
								'image'=>$logo,
							);
			$where_id=array('id'=>$this->session->userdata('id'));
			if($chkdetails=$this->user_model->get_sql_select_data('registration',$where_data))
			{
				$this->session->set_flashdata('Logmsg', '<b style="color:red;">Profile Updated With Existing Details</b>');
				redirect(site_url().'admin/profile');
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
					redirect(site_url().'admin/profile');
				}
				else
				{
					$this->session->set_flashdata('Logmsg', '<b style="color:red;">Please Try Again</b>');
					redirect(site_url().'admin/profile');
				}
			}
		}
		else
		{
			$this->load->view('Admin/profile_admin',$getprofile);
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
			$oldpassword=md5(trim($this->input->post('oldpassword')));
			$databasepassword=$this->input->post('databasepassword');
			$newpassword=md5(trim($this->input->post('newpassword')));
			$updatedata=array('password'=>$newpassword);
			$where=array('id'=>$this->session->userdata('id'),);
			//echo"<pre>";print_r($getpassword);print_r($oldpassword)."<br>";print_r($newpassword);exit;
			if($oldpassword==$databasepassword)
			{
				//echo"hello";exit;
				$isadded = $this->user_model->UPDATEDATA('registration',$where, $updatedata);
				$this->session->set_flashdata('Logmsg', '<b style="color:green;">Password Changed Successfully</b>');
				redirect(site_url().'admin/changepassword');
			}
			else
			{
				$this->session->set_flashdata('Logmsg', '<b style="color:red;">Invalid Old Password</b>');
				redirect(site_url().'admin/changepassword');
			}
		}
		else
		{
			$this->load->view('Admin/changepassword',$getpassword);
		}
		
	}
	
//*********************** Add Dashboard *****************************************	

	function dashboard()
	{
		$this->load->view('Admin/d_admin');
	}


	
//*********************** Add Cards *****************************************	

	public function card()
	{
		
		$fields=array('tbl_cards.id as id', 'tbl_cards.title', 'tbl_cards.title_img', 'tbl_cards.description', 'tbl_cards.card_type', 'tbl_cards.category', 'tbl_cards.subcategory', 'tbl_cards.pack_image', 'category.categoryname', );
		$join=array(
				array('table'=>'category','condition'=>'category.id = tbl_cards.category', 'jointype'=>'inner'),
				);
		$data['getcard'] = $this->user_model->get_joins('tbl_cards','', $join,$fields,'','','tbl_cards.createdate DESC');
		
		$fields_imgs=array('card_images.*');
		$join_imgs=array(
				array('table'=>'card_images','condition'=>'card_images.card_id = tbl_cards.id', 'jointype'=>'inner'),
				array('table'=>'category','condition'=>'category.id = tbl_cards.category', 'jointype'=>'inner'),
				);
		$data['getcardimages'] = $this->user_model->get_joins('tbl_cards','', $join_imgs,$fields_imgs);
		
		//echo"<pre>";print_r($data['getcard_images']);exit;
		
		$data['getcategory'] = $this->user_model->get_sql_select_data('category','', 'categoryname  ASC');
		$data['get_sub_category'] = $this->user_model->get_sql_select_data('subcategory','', 'name  ASC');

		if(isset($_POST["addcard"]))
		{
			$title=trim(ucwords(strtolower($this->input->post('cardname'))));
			
			$category=$this->input->post('category');
			$sub_category=$this->input->post('sub_category');
			
			$child_category=$this->input->post('child_category');
			
			$pack_type=$this->input->post('pack_type');
			
			$title_img=$this->input->post('title_img');
			$description=$this->input->post('description');
			$createdate=date("Y-m-d H:i:s");
			
			$foldername=$category;
			if (!is_dir('./assets/uploads/'.$foldername.'/'))
			{
				mkdir('./assets/uploads/'.$foldername.'/', 0777, true);
				//chmod('/assets', 0777);
				//chmod('/assets/uploads', 0777);
			}
			
			$this->form_validation->set_error_delimiters('<div class="text-error"></div>');
			$this->form_validation->set_rules('cardname', 'Title', 'trim|required');
			//$this->form_validation->set_rules('userfile', 'Pack Image', 'trim|required');
			$this->form_validation->set_rules('category', 'Category', 'trim|required');
			$this->form_validation->set_rules('sub_category', 'Sub Category', 'trim|required');
			$this->form_validation->set_rules('child_category', 'Child Category', 'trim|required');
			if ($this->form_validation->run() == FALSE)
			{
				$message=validation_errors();
				$this->session->set_flashdata('Logmsg', '<b style="color:red;">'.$message.'</b>');
				redirect(site_url().'admin/card');
			}
			else
			{
			
			if (!is_dir('./assets/uploads/'.$foldername.'/title_img/'))
			{
				mkdir('./assets/uploads/'.$foldername.'/title_img/', 0777, true);
				//chmod('/assets', 0777);
				//chmod('/assets/uploads', 0777);
			}
			$config = array(
						'upload_path' => './assets/uploads/'.$foldername.'/title_img/',
						'allowed_types' => 'jpg|jpeg|gif|png|bmp',
						'overwrite' => 0,
						);
			$this->load->library('upload');			
			$this->upload->initialize($config); ///***------
			if( ! $this->upload->do_upload('title_img'))    ///***------userfile
			{
				$data = array('error' => $this->upload->display_errors());
			//	$this->load->view('profile_mentor');
			}
		
			$data = array('upload_data' => $this->upload->data());
			$file=$data['upload_data']['file_name'];
			$title_image=base_url().'assets/uploads/'.$foldername.'/title_img/'.$file;
			$this->_createThumbnails($file,'assets/uploads/'.$foldername.'/title_img/','150','150');
			

			$config = array(
						'upload_path' => './assets/uploads/'.$foldername.'/',
						'allowed_types' => 'jpg|jpeg|gif|png|bmp',
						'overwrite' => 0,
						);

			$this->load->library('upload', $config);

			$base_url=base_url();
			$path=$base_url.'assets/uploads/'.$foldername.'/';
			
			$files = $_FILES['userfile'];

				$images='';
				foreach ($files['name'] as $key => $image)
				{
					$_FILES['userfile[]']['name']= $files['name'][$key];
					$_FILES['userfile[]']['type']= $files['type'][$key];
					$_FILES['userfile[]']['tmp_name']= $files['tmp_name'][$key];
					$_FILES['userfile[]']['error']= $files['error'][$key];
					$_FILES['userfile[]']['size']= $files['size'][$key];
				
					$config['file_name'] = $image;
					
					$this->upload->initialize($config);
					$is_upload=$this->upload->do_upload('userfile[]');
					
					if ($is_upload)
					{
						$gal_Data = $this->upload->data();
						$images[]=$path.$gal_Data['file_name'];
						$this->_createThumbnails($gal_Data['file_name'],'assets/uploads/'.$foldername.'/','725','485');
					}
					else
					{
						echo $this->upload->display_errors();
					}
				}/* -----foreach ends here------ */
				if($this->upload->data())
				{
				
					$pack_imgs=implode(',',$images);
					$chkdata=array('title'=>$title, 'description'=>$description, 'title_img'=>$title_image, 'card_type'=>$pack_type, 'category'=>$category, 'subcategory'=>$sub_category, 'child_cate_id'=>$child_category, );
					$chkcard=$this->user_model->get_sql_select_data('tbl_cards',$chkdata);
					if(!empty($chkcard))
					{
						$this->session->set_flashdata('Logmsg', '<b style="color:red;">Card Already Exists</b>');
						redirect(site_url().'admin/card');
					//	print_r($this->db->last_query());
					}
					else
					{
						$insertdata=array('title'=>$title, 'description'=>$description, 'title_img'=>$title_image, 'card_type'=>$pack_type, 'category'=>$category, 'subcategory'=>$sub_category, 'child_cate_id'=>$child_category, 'createdate'=>$createdate, );
						
						$isadded = $this->user_model->INSERTDATA('tbl_cards', $insertdata);
						if($isadded)
						{
							$inserteddata=$this->user_model->get_sql_select_data('tbl_cards',$insertdata);
							$insertId=$inserteddata[0]['id'];
							$card_images=explode(',',$inserteddata[0]['pack_image']);
							foreach($images as $card_image)
							{
								$card_data=array('card_id'=>$insertId, 'card_image'=>$card_image, 'createdate'=>$createdate, );
								$this->user_model->INSERTDATA('card_images', $card_data);
							}
							$this->session->set_flashdata('Logmsg', '<b style="color:green;">Cards Added Successfully</b>');
							redirect(site_url().'admin/card');
						}
						else
						{
							$this->session->set_flashdata('Logmsg', '<b style="color:red;">Please Try Again</b>');
							redirect(site_url().'admin/card');
						}
					}
				}
				else
				{
					$this->session->set_flashdata('Logmsg', '<b style="color:red;">'.$this->upload->display_errors().'</b>');
					redirect(site_url().'admin/card');
				}
			}
		}

		else
		{
			$this->load->view('Admin/addcard_view',$data);
		}

	}



//*********************** Edit Card *****************************************
	function update_card()
	{
		$editid = $this->uri->segment(3);
		$where=array('tbl_cards.id'=>$editid);
		
		$fields=array('tbl_cards.id as id', 'tbl_cards.title', 'tbl_cards.description', 'tbl_cards.title_img', 'tbl_cards.pack_image', 'tbl_cards.card_type', 'tbl_cards.category', 'tbl_cards.subcategory', 'tbl_cards.pack_image', 'category.id as cate_id', 'category.categoryname', 'subcategory.id as sub_cate_id', 'subcategory.name', 'child_sub_category.id as child_id', 'child_sub_category.child_name');
		$join=array(
				array('table'=>'category','condition'=>'category.id = tbl_cards.category', 'jointype'=>'inner'),
				array('table'=>'subcategory','condition'=>'subcategory.id = tbl_cards.subcategory', 'jointype'=>'inner'),
				array('table'=>'child_sub_category','condition'=>'child_sub_category.id = tbl_cards.child_cate_id', 'jointype'=>'inner'),
				);
		$data['getcard'] = $this->user_model->get_joins('tbl_cards',$where, $join,$fields);
		/*
		echo $this->db->last_query();
		echo"<pre>";
		print_r($data['getcard']);
		exit;
		*/
		$fields_imgs=array('card_images.*');
		$join_imgs=array(
				array('table'=>'card_images','condition'=>'card_images.card_id = tbl_cards.id', 'jointype'=>'inner'),
				array('table'=>'category','condition'=>'category.id = tbl_cards.category', 'jointype'=>'inner'),
				);
		$data['getcardimages'] = $this->user_model->get_joins('tbl_cards',$where, $join_imgs,$fields_imgs);
		
		$data['getcategory'] = $this->user_model->get_sql_select_data('category','', 'categoryname  ASC');
		$data['get_sub_category'] = $this->user_model->get_sql_select_data('subcategory','', 'name  ASC');		
		$data['get_child_sub_category'] = $this->user_model->get_sql_select_data('child_sub_category','', 'child_name  ASC');		
						
		//echo"<pre>";print_r($data['getcardimages']);exit;
		if(isset($_POST["updatecard"]))
		{
			$updateidid=$this->input->post('updateidid');
			
			$cardname=$this->input->post('cardname');
			$category=$this->input->post('category');
			$subcategory=$this->input->post('sub_category');
			$child_category=$this->input->post('child_category');
			
			$pack_type=$this->input->post('pack_type');
			
			$description=$this->input->post('description');
			
			$old_title_img=$this->input->post('old_title_img');
			
			$old_pack_image=$this->input->post('old_pack_image');
			
			$foldername=$category;
			
			if (!is_dir('./assets/uploads/'.$foldername.'/title_img/'))
			{
				mkdir('./assets/uploads/'.$foldername.'/title_img/', 0777, true);
				//chmod('/assets', 0777);
				//chmod('/assets/uploads', 0777);
			}
			$config = array(
						'upload_path' => './assets/uploads/'.$foldername.'/title_img/',
						'allowed_types' => 'jpg|jpeg|gif|png|bmp',
						'overwrite' => 0,
						);
			$this->load->library('upload');			
			$this->upload->initialize($config); ///***------
			if( ! $this->upload->do_upload('title_img'))    ///***------userfile
			{
				$data = array('error' => $this->upload->display_errors());
			//	$this->load->view('profile_mentor');
			}
		
			$data = array('upload_data' => $this->upload->data());
			$file=$data['upload_data']['file_name'];
			
			$this->_createThumbnails($file,'assets/uploads/'.$foldername.'/title_img/','150','150');
			if(empty($file))
			{
				$title_image=$old_title_img;
			}
			else
			{
				$title_image=base_url().'assets/uploads/'.$foldername.'/title_img/'.$file;
			}
			

			$config = array(
						'upload_path' => './assets/uploads/'.$foldername.'/',
						'allowed_types' => 'jpg|jpeg|gif|png|bmp',
						'overwrite' => 0,
						);

			$this->load->library('upload', $config);

			$base_url=base_url();
			$path=$base_url.'assets/uploads/'.$foldername.'/';
			$createdate=date("Y-m-d H:i:s");
			
			$files = $_FILES['userfile'];

				$images='';
				foreach ($files['name'] as $key => $image)
				{
					$_FILES['userfile[]']['name']= $files['name'][$key];
					$_FILES['userfile[]']['type']= $files['type'][$key];
					$_FILES['userfile[]']['tmp_name']= $files['tmp_name'][$key];
					$_FILES['userfile[]']['error']= $files['error'][$key];
					$_FILES['userfile[]']['size']= $files['size'][$key];
				
					$config['file_name'] = $image;
					
					$this->upload->initialize($config);
					$is_upload=$this->upload->do_upload('userfile[]');
					
					if ($is_upload)
					{
						$gal_Data = $this->upload->data();
						$images[]=$path.$gal_Data['file_name'];
						$this->_createThumbnails($gal_Data['file_name'],'assets/uploads/'.$foldername.'/','725','485');
						$card_data=array('card_id'=>$updateidid, 'card_image'=>$path.$gal_Data['file_name'], 'createdate'=>$createdate, );
						$this->user_model->INSERTDATA('card_images', $card_data);
					}
					/*else
					{
						$this->session->set_flashdata('Logmsg', '<b style="color:green;">'.$this->upload->display_errors().'</b>');
						redirect(site_url().'admin/update_card');
						//echo $this->upload->display_errors();
					}*/
					
					
					
					
				}/* -----foreach ends here------ */
				@$pack_imgs=implode(',',$images);
				if(empty($pack_imgs))
				{
					$pack_imgs=$old_pack_image;
				}
				else
				{
					$pack_imgs=$pack_imgs;
				}
				
				
//echo $pack_imgs;exit;
			
			$updatedata=array('title'=>$cardname, 'description'=>$description, 'card_type'=>$pack_type, 'category'=>$category, 'subcategory'=>$subcategory, 'child_cate_id'=>$child_category, 'title_img'=>$title_image, );
			
			$isupdate = $this->user_model->UPDATEDATA('tbl_cards',array('tbl_cards.id'=>$updateidid), $updatedata);
			if($isupdate)
			{
				$this->session->set_flashdata('Logmsg', '<b style="color:green;">Card Updated Successfully</b>');
				redirect(site_url().'admin/card');
			}
			else
			{
				$this->session->set_flashdata('Logmsg', '<b style="color:red;">Error Occured ! Category Not Updated</b>');
				redirect(site_url().'admin/update_card');
			}

		}
		else
		{
			$this->load->view('Admin/edit_card_view',$data);
		}
	}
	


//*********************** Delete Category *****************************************	

	function delete_card()
	{
		
		$deleteid = $this->uri->segment(3);
		$where=array('id'=>$deleteid);
		$delcards = $this->user_model->DELETEDATA('tbl_cards', $where);
		$delcards_imgs = $this->user_model->DELETEDATA('card_images', array('card_id'=>$deleteid));
		if($delcards)
		{
			$this->session->set_flashdata('Logmsg', '<b style="color:green;">Pack Deleted Successfully</b>');
			redirect(site_url().'admin/card');
		}
		else
		{
			$this->session->set_flashdata('Logmsg', '<b style="color:Red;">Pack Not Deleted </b>');
			redirect(site_url().'admin/card');
		}

	}

	function delete_card_imgs()
	{
		
		$deleteid = $this->uri->segment(3);
		$where=array('id'=>$deleteid);
		$delcards = $this->user_model->DELETEDATA('card_images', $where);
		if($delcards)
		{
			$this->session->set_flashdata('Logmsg', '<b style="color:green;">Deleted Successfully</b>');
			//redirect(site_url().'admin/card');
		}
		else
		{
			$this->session->set_flashdata('Logmsg', '<b style="color:Red;">Not Deleted </b>');
			//redirect(site_url().'admin/card');
		}

	}


//*********************** Add New Category *****************************************	
	public function addcategory()
	{
		$data['getdata']=$this->user_model->get_sql_select_data('category','','categoryname');
		
		if(isset($_POST['addcategory']))
		{
			$this->form_validation->set_error_delimiters('<div class="text-error"></div>');
			$this->form_validation->set_rules('categoryname', 'Category Name', 'trim|required');
			if ($this->form_validation->run() == FALSE)
			{
				$message=validation_errors();
				$this->session->set_flashdata('Logmsg', '<b style="color:red;">'.$message.'</b>');
				redirect(site_url().'admin/addcategory');
			}
			else
			{
					$categoryname=trim(ucwords($this->input->post('categoryname')));
				$insertdata=array('categoryname'=>$categoryname,);
				$where=array('categoryname'=>$categoryname) ;
				if($chkuser=$this->user_model->get_sql_select_data('category',$where))
				{
					$this->session->set_flashdata('Logmsg', '<b style="color:red;">Category Already Exists</b>');
					redirect(site_url().'admin/addcategory');
				//	print_r($this->db->last_query());
				}
				else
				{
					$isadded = $this->user_model->INSERTDATA('category', $insertdata);
					if($isadded)
					{
						//	echo"Data Inserted";
						$this->session->set_flashdata('Logmsg', '<b style="color:green;">Category Added Successfully</b>');
						redirect(site_url().'admin/addcategory');
					}
					else
					{
						$this->session->set_flashdata('Logmsg', '<b style="color:red;">Please Try Again</b>');
						redirect(site_url().'admin/addcategory');
					}
				}
			}
		}
		else
		{
			$this->load->view('Admin/addcategory_view',$data);
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
			/*$chk_cate_exist = $this->user_model->get_sql_select_data('category',$updatedata);
			if($chk_cate_exist)
			{
				$newid=$this->input->post('categoryid');
				$this->session->set_flashdata('Logmsg', '<b style="color:Red;">Company Details Already Exist </b>');
				redirect( site_url('admin/edit_category/'.$newid));
			}
			else
			{
			*/
				$isupdate = $this->user_model->UPDATEDATA('category',$where, $updatedata);
				if($isupdate)
				{
					$this->session->set_flashdata('Logmsg', '<b style="color:green;">Category Updated Successfully</b>');
                    redirect(site_url().'admin/addcategory');
				}
				else
				{
					$this->session->set_flashdata('Logmsg', '<b style="color:red;">Error Occured ! Category Not Updated</b>');
					redirect(site_url().'admin/addcategory');
				}
		//	}
		}
		else
		{
			$this->load->view('Admin/update_category_view',$getcategory);
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
			redirect(site_url().'admin/addcategory');
		}
		else
		{
			$this->session->set_flashdata('Logmsg', '<b style="color:Red;">Category Not Deleted </b>');
			redirect(site_url().'admin/addcategory');
		}

	}

//*********************** Add Sub Category *****************************************

	function subcategory()
	{
		
		$data['getdata']=$this->user_model->get_sql_select_data('category','','categoryname');
		$data['getsubcategory']=$this->user_model->get_sql_select_data('subcategory','','name');		//getting all sub cate
		
		
		if(isset($_POST['addsubcategory']))
		{
			$this->form_validation->set_error_delimiters('<div class="text-error"></div>');
			$this->form_validation->set_rules('main_category', 'Category Name', 'trim|required');
			$this->form_validation->set_rules('sub_categoryname', 'Sub-Category Name', 'trim|required');
			if ($this->form_validation->run() == FALSE)
			{
				$message=validation_errors();
				$this->session->set_flashdata('Logmsg', '<b style="color:red;">'.$message.'</b>');
				redirect(site_url().'admin/subcategory');
			}
			else
			{
				$insertdata=array(
									'category_id'=>$this->input->post('main_category'),
									'name'=>trim(ucwords($this->input->post('sub_categoryname'))),
								);
				$where=array(	'category_id'=>$this->input->post('main_category'),
								'name'=>trim(ucwords($this->input->post('sub_categoryname'))),
							);
				if($chkuser=$this->user_model->get_sql_select_data('subcategory',$where))
				{
					$this->session->set_flashdata('Logmsg', '<b style="color:red;">Category Already Exists</b>');
					redirect(site_url().'admin/subcategory');
				//	print_r($this->db->last_query());
				}
				else
				{
					$isadded = $this->user_model->INSERTDATA('subcategory', $insertdata);
					if($isadded)
					{
						//	echo"Data Inserted";
						$this->session->set_flashdata('Logmsg', '<b style="color:green;">Category Added Successfully</b>');
						redirect(site_url().'admin/subcategory');
					}
					else
					{
						$this->session->set_flashdata('Logmsg', '<b style="color:red;">Please Try Again</b>');
						redirect(site_url().'admin/subcategory');
					}
				}
			}
		}
		else
		{
			$this->load->view('Admin/addsubcategory_view',$data);
		}
	}

	

//*********************** Edit Sub Category *****************************************

	function edit_subcategory()
	{
		$editid = $this->uri->segment(3);
		$where=array('id'=>$editid);
		
		$data['getcategory'] = $this->user_model->get_sql_select_data('category','', 'categoryname  ASC');
		$data['getsubcategory'] = $this->user_model->get_sql_select_data('subcategory',$where, 'name  ASC');
		
		
		//echo"<pre>";print_r($getcategory);exit;
		if(isset($_POST["updatecategory"]))
		{
			$updatedata=array('category_id'=>$this->input->post('main_category'),'name'=>$this->input->post('sub_categoryname'),);
			$newid=$this->input->post('updateidid');
			/*
			$chk_cate_exist = $this->user_model->get_sql_select_data('subcategory',$updatedata);
			if($chk_cate_exist)
			{
				
				$this->session->set_flashdata('Logmsg', '<b style="color:Red;">Category Details Already Exist </b>');
				redirect( site_url('admin/edit_subcategory/'.$newid));
			}
			else
			{
				*/
				$isupdate = $this->user_model->UPDATEDATA('subcategory',array('id'=>$newid), $updatedata);
				if($isupdate)
				{
					$this->session->set_flashdata('Logmsg', '<b style="color:green;">Category Updated Successfully</b>');
                    redirect(site_url().'admin/subcategory');
				}
				else
				{
					$this->session->set_flashdata('Logmsg', '<b style="color:red;">Error Occured ! Category Not Updated</b>');
					redirect(site_url().'admin/edit_subcategory/'.$newid);
				}
		//	}
		}
		else
		{
			$this->load->view('Admin/edit_subcategory_view',$data);
		}
	}
	

//*********************** Delete Category *****************************************	

	function delete_subcategory()
	{
		
		$deleteid = $this->uri->segment(3);
		$where=array('id'=>$deleteid);
		$subcategory = $this->user_model->DELETEDATA('subcategory', $where);
		if($subcategory)
		{
			$this->session->set_flashdata('Logmsg', '<b style="color:green;">Category Deleted Successfully</b>');
			redirect(site_url().'admin/subcategory');
		}
		else
		{
			$this->session->set_flashdata('Logmsg', '<b style="color:Red;">Category Not Deleted </b>');
			redirect(site_url().'admin/subcategory');
		}

	}

/********************************* Create image Thumbnails ****************************/
      	
	function _createThumbnails($filename,$foldername,$height,$width)
	{
		
		if (!is_dir($foldername))
		{
			mkdir($foldername, 0777, true);
			//chmod('/assets', 0777);
			//chmod('/assets/uploads', 0777);
		}
		
		/*	Creating Thumb of 600x600	*/
//		$foldername='./assets/uploads/thumbnails/600x600/';
		// echo $foldername;exit;
//		$this->createDir($foldername);
		
		$this->load->library('image_lib');
		// Set your config up
		$config['new_image']   =   $foldername;
		$config['image_library']    = "gd2";      
		$config['source_image']     = $foldername.$filename;      
		//$config['create_thumb']     = TRUE;      
		$config['overwrite']   = 0;
		$config['maintain_ratio']   = FALSE;
		//$config['master_dim'] = 'height';      
		
		$config['height'] = $height;
		$config['width'] = $width;

		$this->image_lib->initialize($config);
		// Do your manipulation

		if(!$this->image_lib->resize())
		{
		echo $this->image_lib->display_errors();
		} 
		$this->image_lib->clear();     

	}
	
	function createDir($foldername)
	{
		if (!is_dir($foldername))
		{
			mkdir($foldername, 0777, true);
		}
	}
//*********************** Add Child Category *****************************************

	function childcategory()
	{
		
		$data['getdata']=$this->user_model->get_sql_select_data('subcategory','','name');
		$data['getchildcategory']=$this->user_model->get_sql_select_data('child_sub_category','','child_name');		//getting all child cate
		
		
		if(isset($_POST['addchildcategory']))
		{
			$this->form_validation->set_error_delimiters('<div class="text-error"></div>');
			$this->form_validation->set_rules('sub_category', 'Sub-Category Name', 'trim|required');
			$this->form_validation->set_rules('child_categoryname', 'Child-Category Name', 'trim|required');
			if ($this->form_validation->run() == FALSE)
			{
				$message=validation_errors();
				$this->session->set_flashdata('Logmsg', '<b style="color:red;">'.$message.'</b>');
				redirect(site_url().'admin/childcategory');
			}
			else
			{
				$insertdata=array(
									'sub_cate_id'=>$this->input->post('sub_category'),
									'child_name'=>trim(ucwords($this->input->post('child_categoryname'))),
								);
				$where=array(	'sub_cate_id'=>$this->input->post('sub_category'),
								'child_name'=>trim(ucwords($this->input->post('child_categoryname'))),
							);
				if($chkuser=$this->user_model->get_sql_select_data('child_sub_category',$where))
				{
					$this->session->set_flashdata('Logmsg', '<b style="color:red;">Child-Category Already Exists</b>');
					redirect(site_url().'admin/childcategory');
				//	print_r($this->db->last_query());
				}
				else
				{
					$isadded = $this->user_model->INSERTDATA('child_sub_category', $insertdata);
					if($isadded)
					{
						//	echo"Data Inserted";
						$this->session->set_flashdata('Logmsg', '<b style="color:green;">Child-Category Added Successfully</b>');
						redirect(site_url().'admin/childcategory');
					}
					else
					{
						$this->session->set_flashdata('Logmsg', '<b style="color:red;">Please Try Again</b>');
						redirect(site_url().'admin/childcategory');
					}
				}
			}
		}
		else
		{
			$this->load->view('Admin/add_child_category',$data);
		}
	}
//*********************** Delete Category *****************************************	

	function delete_childcategory()
	{
		
		$deleteid = $this->uri->segment(3);
		$where=array('id'=>$deleteid);
		$subcategory = $this->user_model->DELETEDATA('child_sub_category', $where);
		if($subcategory)

		{
			$this->session->set_flashdata('Logmsg', '<b style="color:green;">Child-Category Deleted Successfully</b>');
			redirect(site_url().'admin/childcategory');
		}
		else
		{
			$this->session->set_flashdata('Logmsg', '<b style="color:Red;">Child-Category Not Deleted </b>');
			redirect(site_url().'admin/childcategory');
		}

	}
	

//*********************** Edit Child Category *****************************************

	function edit_childcategory()
	{
		$editid = $this->uri->segment(3);
		$where=array('id'=>$editid);
		
		$data['getsubcategory'] = $this->user_model->get_sql_select_data('subcategory','', 'name  ASC');
		$data['getchildcategory'] = $this->user_model->get_sql_select_data('child_sub_category',$where, 'child_name  ASC');
		
		
		//echo"<pre>";print_r($getcategory);exit;
		if(isset($_POST["updatechildcategory"]))
		{
			$updatedata=array('sub_cate_id'=>$this->input->post('sub_category'),'child_name'=>$this->input->post('child_categoryname'),);
			$newid=$this->input->post('updateidid');
			/*
			$chk_cate_exist = $this->user_model->get_sql_select_data('subcategory',$updatedata);
			if($chk_cate_exist)
			{
				
				$this->session->set_flashdata('Logmsg', '<b style="color:Red;">Category Details Already Exist </b>');
				redirect( site_url('admin/edit_subcategory/'.$newid));
			}
			else
			{
				*/
				$isupdate = $this->user_model->UPDATEDATA('child_sub_category',array('id'=>$newid), $updatedata);
				if($isupdate)
				{
					$this->session->set_flashdata('Logmsg', '<b style="color:green;">Child Category Updated Successfully</b>');
                    redirect(site_url().'admin/childcategory');
				}
				else
				{
					$this->session->set_flashdata('Logmsg', '<b style="color:red;">Error Occured !Child Category Not Updated</b>');
					redirect(site_url().'admin/edit_child_category_view/'.$newid);
				}
		//	}
		}
		else
		{
			$this->load->view('Admin/edit_child_category_view',$data);
		}
	}






}
