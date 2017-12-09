<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	
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
		date_default_timezone_set('America/Los_Angeles');
	}

	//******************************************************************************************//
	
	function index()
	{
		if($this->session->userdata('role_id') == "2")
		{
            redirect(site_url().'admin/dashboard');
        }
        elseif($this->session->userdata('role_id') == "3")
        {
			redirect(site_url().'stylist/viewprofile');
		}
        else
        {
			$this->load->view('login_view');
        }
	}

	//******************************************************************************************//
	
	function dashboard()
	{
		//echo"<pre>";print_r($this->session->userdata());exit;
		$this->load->view('Admin/dashboard_view');
	}

	//*******************************************	Add New Category	***********************************************//
	
	function addcategory()
	{
		$data='';
		if(isset($_POST['add']))
		{
			$categoryname=ucwords(trim($this->input->post('category')));
			$categorystatus=$this->input->post('status[]');
		
			$this->form_validation->set_error_delimiters('<div class="text-error">', '<span class="text-error-close">x</span></div>');
			$this->form_validation->set_rules('category', 'Category', 'trim|required|callback_alpha_space');
			$this->form_validation->set_rules('status', 'Status', 'required');
			$this->form_validation->set_message('alpha_space', 'Only Characters and space is allowed');

			if ($this->form_validation->run() == FALSE)
			{
				$data['message'] = validation_errors();
			}
			else
			{
				$checkcategory=array('name'=>$categoryname);
				$checkexisting=$this->user_model->get_sql_select_data('category', $checkcategory);
				if(empty($checkexisting))
				{
					$insertdata=array('name'=>$categoryname,'status'=>$categorystatus);
					$isadded=$this->user_model->INSERTDATA('category',$insertdata);
					if($isadded)
					{
						$data['message'] ='<div class="text-success-wrapper">Category Added Successfully<span class="text-success-close">x</span></div>';
					}
					else
					{
						$data['message'] ='<div class="text-error">Error occured Try Again<span class="text-error-close">x</span></div>';
					}
				}
				else
				{
					$data['message'] ='<div class="text-error">Category Already Exists<span class="text-error-close">x</span></div>';
				}
			}
		}
		
		$this->load->view('Admin/addcategory_view',$data);
	}

	//*******************************************	Add New Brand 		***********************************************//
	
	function addbrand()
	{
		$data='';
		if(isset($_POST['add']))
		{
			$brandname=ucwords(trim($this->input->post('brand')));
			$brandstatus=$this->input->post('status[]');
		
			$this->form_validation->set_error_delimiters('<div class="text-error">', '<span class="text-error-close">x</span></div>');
			$this->form_validation->set_rules('brand', 'Brand', 'trim|required|callback_alpha_space');
			$this->form_validation->set_rules('status', 'Status', 'required');
			$this->form_validation->set_message('alpha_space', 'Only Characters and space is allowed');

			if ($this->form_validation->run() == FALSE)
			{
				$data['message'] = validation_errors();
			}
			else
			{
				$checkdata=array('name'=>$brandname);
				$checkexisting=$this->user_model->get_sql_select_data('brand', $checkdata);
				if(empty($checkexisting))
				{
					$insertdata=array('name'=>$brandname,'status'=>$brandstatus);
					$isadded=$this->user_model->INSERTDATA('brand',$insertdata);
					if($isadded)
					{
						$data['message'] ='<div class="text-success-wrapper">Brand Added Successfully<span class="text-success-close">x</span></div>';
					}
					else
					{
						$data['message'] ='<div class="text-error">Error occured Try Again<span class="text-error-close">x</span></div>';
					}
				}
				else
				{
					$data['message'] ='<div class="text-error">Brand Name Already Exists<span class="text-error-close">x</span></div>';
				}
			}
		}
		
		$this->load->view('Admin/addbrand_view',$data);
	}

	
	//*******************************************	Add New Tag			***********************************************//
	
	function addtag()
	{
		$data='';
		if(isset($_POST['add']))
		{
			$tagname=ucwords(trim($this->input->post('tag')));
			$status=$this->input->post('status');
		
			$this->form_validation->set_error_delimiters('<div class="text-error">', '<span class="text-error-close">x</span></div>');
			$this->form_validation->set_rules('tag', 'Tag', 'trim|required|callback_alpha_space');
			$this->form_validation->set_rules('status', 'Status', 'required');
			$this->form_validation->set_message('alpha_space', 'Only Characters and space is allowed');

			if ($this->form_validation->run() == FALSE)
			{
				$data['message'] = validation_errors();
			}
			else
			{
				$checkdata=array('tagname'=>$tagname);
				$checkexisting=$this->user_model->get_sql_select_data('tags', $checkdata);
				if(empty($checkexisting))
				{
					$insertdata=array('tagname'=>$tagname,'status'=>$status);
					$isadded=$this->user_model->INSERTDATA('tags',$insertdata);
					if($isadded)
					{
						$data['message'] ='<div class="text-success-wrapper">Photo Tag Added Successfully<span class="text-success-close">x</span></div>';
					}
					else
					{
						$data['message'] ='<div class="text-error">Error occured Try Again<span class="text-error-close">x</span></div>';
					}
				}
				else
				{
					$data['message'] ='<div class="text-error">Photo Tag Already Exists<span class="text-error-close">x</span></div>';
				}
			}
		}
		
		$this->load->view('Admin/addtag_view',$data);
	}

	
	//*******************************************	Add New Ethnicity			***********************************************//
	
	function add_ethnicity()
	{
		$data='';
		if(isset($_POST['add']))
		{
			$ethnicity=ucwords(trim($this->input->post('ethnicity')));
			$status=$this->input->post('status');
		
			$this->form_validation->set_error_delimiters('<div class="text-error">', '<span class="text-error-close">x</span></div>');
			$this->form_validation->set_rules('ethnicity', 'Ethnicity', 'trim|required');
			$this->form_validation->set_rules('status', 'Status', 'required');
			//$this->form_validation->set_message('alpha_space', 'Only Characters and space is allowed');

			if ($this->form_validation->run() == FALSE)
			{
				$data['message'] = validation_errors();
			}
			else
			{
				$checkdata=array('ethnicity'=>$ethnicity);
				$checkexisting=$this->user_model->get_sql_select_data('tbl_ethnicity', $checkdata);
				if(empty($checkexisting))
				{
					$insertdata=array('ethnicity'=>$ethnicity,'status'=>$status);
					$isadded=$this->user_model->INSERTDATA('tbl_ethnicity',$insertdata);
					if($isadded)
					{
						$data['message'] ='<div class="text-success-wrapper">Ethnicity Added Successfully<span class="text-success-close">x</span></div>';
					}
					else
					{
						$data['message'] ='<div class="text-error">Error occured Try Again<span class="text-error-close">x</span></div>';
					}
				}
				else
				{
					$data['message'] ='<div class="text-error">Ethnicity Name Already Exists<span class="text-error-close">x</span></div>';
				}
			}
		}
		
		$this->load->view('Admin/addethnicity_view',$data);
	}


	//*******************************************	Add Color			***********************************************//
	
	function addcolor()
	{
		$data='';
		if(isset($_POST['add']))
		{
			$color=ucwords(trim($this->input->post('color')));
			
			$status=$this->input->post('status');
		
			$this->form_validation->set_error_delimiters('<div class="text-error">', '<span class="text-error-close">x</span></div>');
			$this->form_validation->set_rules('color', 'Color', 'trim|required');
			$this->form_validation->set_rules('status', 'Status', 'required');
			//$this->form_validation->set_message('alpha_space', 'Only Characters and space is allowed');

			if ($this->form_validation->run() == FALSE)
			{
				$data['message'] = validation_errors();
			}
			else
			{
				$checkdata=array('name'=>$color);
				$checkexisting=$this->user_model->get_sql_select_data('tbl_color', $checkdata);
				if(empty($checkexisting))
				{
					$insertdata=array('name'=>$color,'status'=>$status);
					$isadded=$this->user_model->INSERTDATA('tbl_color',$insertdata);
					if($isadded)
					{
						$data['message'] ='<div class="text-success-wrapper">Color Added Successfully<span class="text-success-close">x</span></div>';
					}
					else
					{
						$data['message'] ='<div class="text-error">Error occured Try Again<span class="text-error-close">x</span></div>';
					}
				}
				else
				{
					$data['message'] ='<div class="text-error">Color Already Exists<span class="text-error-close">x</span></div>';
				}
			}
		}
		
		$this->load->view('Admin/addcolor_view',$data);
	}
	
	
	//*******************************************	Add Texture			***********************************************//
	
	function addtexture()
	{
		$data='';
		if(isset($_POST['add']))
		{
			$texture=ucwords(trim($this->input->post('texture')));
			$status=$this->input->post('status');
		
			$this->form_validation->set_error_delimiters('<div class="text-error">', '<span class="text-error-close">x</span></div>');
			$this->form_validation->set_rules('texture', 'Texture', 'trim|required');
			$this->form_validation->set_rules('status', 'Status', 'required');
			//$this->form_validation->set_message('alpha_space', 'Only Characters and space is allowed');

			if ($this->form_validation->run() == FALSE)
			{
				$data['message'] = validation_errors();
			}
			else
			{
				$checkdata=array('texture'=>$texture);
				$data['checkexisting']=$this->user_model->get_sql_select_data('tbl_texture', $checkdata);
				//echo"<pre>";print_r($data['checkexisting']);exit;
				if(empty($data['checkexisting']))
				{
					$insertdata=array('texture'=>$texture,'status'=>$status);
					$isadded=$this->user_model->INSERTDATA('tbl_texture',$insertdata);
					if($isadded)
					{
						$data['message'] ='<div class="text-success-wrapper">Texture Added Successfully<span class="text-success-close">x</span></div>';
					}
					else
					{
						$data['message'] ='<div class="text-error">Error occured Try Again<span class="text-error-close">x</span></div>';
					}
				}
				else
				{
					$data['message'] ='<div class="text-error">Texture Already Exists<span class="text-error-close">x</span></div>';
				}
			}
		}
		
		$this->load->view('Admin/addtexture_view',$data);
	}
	
	
	//*******************************************	Add density			***********************************************//
	
	function adddensity()
	{
		$data='';
		if(isset($_POST['add']))
		{
			$density=ucwords(trim($this->input->post('density')));
			$status=$this->input->post('status');
		
			$this->form_validation->set_error_delimiters('<div class="text-error">', '<span class="text-error-close">x</span></div>');
			$this->form_validation->set_rules('density', 'Density', 'trim|required');
			$this->form_validation->set_rules('status', 'Status', 'required');
			//$this->form_validation->set_message('alpha_space', 'Only Characters and space is allowed');

			if ($this->form_validation->run() == FALSE)
			{
				$data['message'] = validation_errors();
			}
			else
			{
				$checkdata=array('density'=>$density);
				$checkexisting=$this->user_model->get_sql_select_data('tbl_density', $checkdata);
				if(empty($checkexisting))
				{
					$insertdata=array('density'=>$density,'status'=>$status);
					$isadded=$this->user_model->INSERTDATA('tbl_density',$insertdata);
					if($isadded)
					{
						$data['message'] ='<div class="text-success-wrapper">Density Added Successfully<span class="text-success-close">x</span></div>';
					}
					else
					{
						$data['message'] ='<div class="text-error">Error occured Try Again<span class="text-error-close">x</span></div>';
					}
				}
				else
				{
					$data['message'] ='<div class="text-error">Density Already Exists<span class="text-error-close">x</span></div>';
				}
			}
		}
		
		$this->load->view('Admin/adddensity_view',$data);
	}

	
	//*******************************************	Add New Measurement	***********************************************//
	
	function measurement()
	{
		$data='';
		if(isset($_POST['add']))
		{
			$measurement=trim($this->input->post('measurement'));
			//$brandstatus=$this->input->post('status[]');
		
			$this->form_validation->set_error_delimiters('<div class="text-error">', '<span class="text-error-close">x</span></div>');
			$this->form_validation->set_rules('measurement', 'Measurement', 'trim|required|decimal');
			//$this->form_validation->set_rules('status', 'Status', 'required');
			//$this->form_validation->set_message('alpha_space', 'Only Characters and space is allowed');

			if ($this->form_validation->run() == FALSE)
			{
				$data['message'] = validation_errors();
			}
			else
			{
				$checkdata=array('value'=>$measurement.'"');
				$checkexisting=$this->user_model->get_sql_select_data('tbl_measurement', $checkdata);
				if(empty($checkexisting))
				{
					$insertdata=array('value'=>$measurement.'"');
					$isadded=$this->user_model->INSERTDATA('tbl_measurement',$insertdata);
					if($isadded)
					{
						$data['message'] ='<div class="text-success-wrapper">Measurement Added Successfully<span class="text-success-close">x</span></div>';
					}
					else
					{
						$data['message'] ='<div class="text-error">Error occured Try Again<span class="text-error-close">x</span></div>';
					}
				}
				else
				{
					$data['message'] ='<div class="text-error">Measurement Already Exists<span class="text-error-close">x</span></div>';
				}
			}
		}
		
		$this->load->view('Admin/addmeasurement_view',$data);
	}


	//**************************************	Add New Product			***********************************************//
	
	function addproduct()
	{
		$data='';
		$data['allcategory']=$this->user_model->getallcategory();
		$data['allbrands']=$this->user_model->getallbrands();
		$data['alltags']=$this->user_model->getalltags();
		
		$data['alltexture']=$this->user_model->getalltexture();
		$data['alldensity']=$this->user_model->getalldensity();
		$data['allcolor']=$this->user_model->getallcolor();
		$data['allethnicity']=$this->user_model->getallethnicity();
		//echo"<pre>";print_r($data['allcolor']);exit;
		
		if(isset($_POST['add']))
		{
			
			$category=trim($this->input->post('category'));
			$brand=trim($this->input->post('brand'));
			$productname=trim($this->input->post('productname'));
			
			@$tags=implode(',',$this->input->post('tags[]'));
			
			$description=trim($this->input->post('description'));
			$price=trim($this->input->post('price'));
			$status=$this->input->post('status[]');
			@$ethnicity=implode(',',$this->input->post('ethnicitys[]'));
			@$texture=implode(',',$this->input->post('textures[]'));
			@$color=implode(',',$this->input->post('colors[]'));
			@$density=implode(',',$this->input->post('densitys[]'));
			
			$this->form_validation->set_error_delimiters('<div class="text-error">', '<span class="text-error-close">x</span></div>');
			$this->form_validation->set_rules('category', 'Category', 'trim|required');
			$this->form_validation->set_rules('brand', 'Brand', 'trim|required');
			$this->form_validation->set_rules('productname', 'Product Name', 'trim|required');
			
			$this->form_validation->set_rules('tags[]', 'Tags', 'trim|required');
			$this->form_validation->set_rules('ethnicitys[]', 'Ethnicity', 'trim|required');
			$this->form_validation->set_rules('textures[]', 'Texture', 'trim|required');
			$this->form_validation->set_rules('colors[]', 'Color', 'trim|required');
			$this->form_validation->set_rules('densitys[]', 'Density', 'trim|required');
				
		//	$this->form_validation->set_rules('price', 'Price', 'trim|required|numeric');			
			$this->form_validation->set_rules('status', 'Status', 'required');
			$this->form_validation->set_message('alpha_space', 'Only Characters and space is allowed');

			if ($this->form_validation->run() == FALSE)
			{
				$data['message'] = validation_errors();
			}
			else
			{
				if (!is_dir('./assets/product/'))
				{
					mkdir('./assets/product/', 0777, true);
				}
				$this->load->library('image_lib');
				$config['upload_path'] = './assets/product/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['overwrite'] = TRUE;
				
				$this->load->library('upload');		
				$this->upload->initialize($config); ///***------
				if( ! $this->upload->do_upload('pic'))    ///***------userfile
				{
					$data['message'] = array('error' => $this->upload->display_errors());
				}
				
				$data = array('upload_data' => $this->upload->data());
				
				$path=$data['upload_data']['full_path'];
				$imagename=$data['upload_data']['file_name'];					
				//*********** create new file
					/*$rand_no =  date('Y-m-d H-i-s');
					$rand_no = str_replace(' ', '', $rand_no);
					$raw_name=$data['upload_data']['raw_name'];
					$file_ext=$data['upload_data']['file_ext'];*/
					
					$file_name=$data['upload_data']['file_name'];
					
					$this->_createThumbnails($file_name);
					
					$base_url=base_url();
					$newfile=$file_name;

					//echo"<pre>";print_r($data); exit;
					if(!empty($file_name))
					{
						$file_name=$newfile;
					}
					else
					{
						$file_name='default/noproduct.png';
					}
			
					$checkdata=array('categoryid'=>$category,'brand_id'=>$brand,'name'=>$productname,'description'=>$description,'price'=>$price,);
					$checkexisting=$this->user_model->get_sql_select_data('product', $checkdata);
					if(empty($checkexisting))
					{
						$insertdata=array(
										'categoryid'=>$category,
										'brand_id'=>$brand,
										'name'=>$productname,
										'tagid'=>$tags,
										'description'=>$description,
										'price'=>$price,
										'image'=>$file_name,
										'status'=>$status,
										'ethnicity'=>$ethnicity,
										'texture'=>$texture,
										'color'=>$color,
										'density'=>$density,
										);
						$isadded=$this->user_model->INSERTDATA('product',$insertdata);
						if($isadded)
						{
							$lastinsert = $this->user_model->getlastinsertedrow('product');
							$product_id=$lastinsert[0]['MAX(id)'];
							$ethnicity=$this->input->post('ethnicitys[]');
							if(!empty($ethnicity))
							{
								foreach($ethnicity as $value)
								{
									echo $value;
									$this->user_model->INSERTDATA('pro_ethnicity',array('product_id'=>$product_id,'ethnicity_id'=>$value));
								}
							}
							$textures=$this->input->post('textures[]');
							if(!empty($textures))
							{
								foreach($textures as $value)
								{
									echo $value;
									$this->user_model->INSERTDATA('pro_texture',array('product_id'=>$product_id,'texture_id'=>$value));
								}
							}
							$densitys=$this->input->post('densitys[]');
							if(!empty($densitys))
							{
								foreach($densitys as $value)
								{
									echo $value;
									$this->user_model->INSERTDATA('pro_density',array('product_id'=>$product_id,'density_id'=>$value));
								}
							}
							$colors=$this->input->post('colors[]');
							if(!empty($colors))
							{
								foreach($colors as $value)
								{
									echo $value;
									$this->user_model->INSERTDATA('pro_color',array('product_id'=>$product_id,'color_id'=>$value));
								}
							}
							
							redirect(site_url().'admin/viewproduct');
							$data['message'] ='<div class="text-success-wrapper">Product Added Successfully<span class="text-success-close">x</span></div>';
						}
						else
						{
							$data['message'] ='<div class="text-error">Error occured Try Again<span class="text-error-close">x</span></div>';
						}
					}
					else
					{
						$data['allcategory']=$this->user_model->getallcategory();
						$data['allbrands']=$this->user_model->getallbrands();
						$data['alltags']=$this->user_model->getalltags();
						
						$data['alltexture']=$this->user_model->getalltexture();
						$data['alldensity']=$this->user_model->getalldensity();
						$data['allcolor']=$this->user_model->getallcolor();
						$data['allethnicity']=$this->user_model->getallethnicity();
						$data['message'] ='<div class="text-error">Product Already Exists<span class="text-error-close">x</span></div>';
					}
			}
		}
		
		$this->load->view('Admin/addproduct_view',$data);
	}
	


	//******************************************	View Categories		************************************************//
	
	function viewcategory()
	{
		$data['allcategory'] = $this->user_model->get_sql_select_data('category','','id DESC');
		$this->load->view('Admin/viewcategory_view',$data);
	}

	//*******************************************	View Brands			***********************************************//
	
	function viewbrand()
	{
		$data['allcategory'] = $this->user_model->get_sql_select_data('brand','','id DESC');
		$this->load->view('Admin/viewbrand_view',$data);
	}

	//******************************************	View Tags			************************************************//
	
	function viewtag()
	{
		$data['alltag'] = $this->user_model->get_sql_select_data('tags','','id DESC');
		$this->load->view('Admin/viewtag_view',$data);
	}

	//*******************************************	View Products		***********************************************//
	
	function viewproduct()
	{
		$data['allproduct'] = $this->user_model->get_sql_select_data('product','','id DESC');
		$this->load->view('Admin/viewproduct_view',$data);
	}

	//*******************************************	View Stylists		***********************************************//
	
	function viewstylist()
	{
		$where	=	array('role_id'=>3);
		$data['allstylist'] = $this->user_model->get_sql_select_data('tbl_user',$where,'id DESC');
		$this->load->view('Admin/viewstylist',$data);
	}

	//*******************************************	View Stylists Billing info		***********************************************//
	
	function viewsubscription()
	{
		$where	=	array('role_id'=>3); //id DESC
		$join_s=array(
				array('table'=>'stylist','condition'=>'`tbl_user`.`id` = `stylist`.`user_id`','jointype'=>'inner'),
				array('table'=>'subscription','condition'=>'`subscription`.`s_id` = `stylist`.`id`','jointype'=>'inner'),
				array('table'=>'tbl_state','condition'=>'`subscription`.`billing_state` = `tbl_state`.`id`','jointype'=>'inner'),
				);
		$field=array('subscription.*','tbl_user.id as user_id', 'tbl_user.firstname', 'tbl_user.lastname','tbl_state.state_name' );
		$data['allstylist'] = $this->user_model->get_joins('tbl_user',$where,$join_s,$field);
		$this->load->view('Admin/viewsubscription',$data);
	}

	//*******************************************	View Templates		***********************************************//
	
	function viewtemplate()
	{
		//$where	=	array('role_id'=>3);
		$data['alltemplates'] = $this->user_model->get_sql_select_data('email_template','','id DESC');
		$this->load->view('Admin/viewtemplates',$data);
	}

	//******************************************	View Ethnicity			************************************************//
	
	function viewethnicity()
	{
		$data['allethnicity'] = $this->user_model->get_sql_select_data('tbl_ethnicity','','id DESC');
		$this->load->view('Admin/viewethnicity_view',$data);
	}

	//******************************************	View Density			************************************************//
	
	function viewdensity()
	{
		$data['alldensity'] = $this->user_model->get_sql_select_data('tbl_density','','id DESC');
		$this->load->view('Admin/viewdensity_view',$data);
	}

	//******************************************	View Texture			************************************************//
	
	function viewtexture()
	{
		$data['alltexture'] = $this->user_model->get_sql_select_data('tbl_texture','','id DESC');
		$this->load->view('Admin/viewtexture_view',$data);
	}

	//******************************************	View Color			************************************************//
	
	function viewcolor()
	{
		$data['allcolors'] = $this->user_model->get_sql_select_data('tbl_color','','id DESc');
		$this->load->view('Admin/viewcolor_view',$data);
	}


	//***************************************** 	Edit Ethnicity		*************************************************//
	
	function editethnicity()
	{
		$data='';
		
		$ethnicity=ucwords(trim($this->input->post('ethnicity')));
		$ethnicity_status=$this->input->post('status[]');
		
		$editid = $this->uri->segment(3);
		$where=array('id'=>$editid);
		
		$data['getethnicity'] = $this->user_model->get_sql_select_data('tbl_ethnicity',$where);
		
		$updatedata=array('ethnicity'=>$ethnicity,'status'=>$ethnicity_status,);
		
		//echo"<pre>";print_r($getcategory);exit;
		if(isset($_POST["update"]))
		{
			$newid=$this->input->post('ethnicityid');
		
			$this->form_validation->set_error_delimiters('<div class="text-error">', '<span class="text-error-close">x</span></div>');
			$this->form_validation->set_rules('ethnicity', 'Ethnicity', 'trim|required|callback_alpha_space');
			$this->form_validation->set_rules('status', 'Status', 'required');
			$this->form_validation->set_message('alpha_space', 'Only Characters and space is allowed');

			if ($this->form_validation->run() == FALSE)
			{
				$data['message'] = validation_errors();
				$data['getethnicity'] = $this->user_model->get_sql_select_data('tbl_ethnicity',array('id'=>$newid));
			}
			else
			{
				/*$chk_brand_exist = $this->user_model->get_sql_select_data('tbl_ethnicity',$updatedata);
				if($chk_brand_exist)
				{
					$this->session->set_flashdata('Logmsg', '<b style="color:Red;">Ethnicity Details Already Exist </b>');
					redirect( site_url('admin/editethnicity/'.$newid));
				}
				else
				{*/
					$updateid=array('id'=>$newid);
					$isupdate = $this->user_model->UPDATEDATA('tbl_ethnicity',$updateid, $updatedata);
					if($isupdate)
					{
						//echo $this->db->last_query();exit('update');
						$this->session->set_flashdata('Logmsg', '<b style="color:green;">Ethnicity Updated Successfully</b>');
						redirect(site_url().'admin/viewethnicity');
					}
					else
					{
						//echo $this->db->last_query();exit('u Fails');
						$this->session->set_flashdata('Logmsg', '<b style="color:red;">Error Occured ! Ethnicity Not Updated</b>');
						redirect(site_url().'admin/viewbrand');
					}
				//}
			}
		}

			$this->load->view('Admin/update_ethnicity_view',$data);
	}
	
	//***************************************** 	Edit Texture		*************************************************//
	
	function edittexture()
	{
		$data='';
		
		$texture=trim($this->input->post('texture'));
		$texture_status=$this->input->post('status[]');
		
		$editid = $this->uri->segment(3);
		$where=array('id'=>$editid);
		
		$data['gettexture'] = $this->user_model->get_sql_select_data('tbl_texture',$where);
		
		$updatedata=array('texture'=>$texture,'status'=>$texture_status,);
		
		//echo"<pre>";print_r($getcategory);exit;
		if(isset($_POST["update"]))
		{
			$newid=$this->input->post('textureid');
		
			$this->form_validation->set_error_delimiters('<div class="text-error">', '<span class="text-error-close">x</span></div>');
			$this->form_validation->set_rules('texture', 'Texture', 'trim|required');
			$this->form_validation->set_rules('status', 'Status', 'required');

			if ($this->form_validation->run() == FALSE)
			{
				$data['message'] = validation_errors();
				$data['gettexture'] = $this->user_model->get_sql_select_data('tbl_texture',array('id'=>$newid));
			}
			else
			{
				/*$chk_texture_exist = $this->user_model->get_sql_select_data('tbl_texture',$updatedata);
				if($chk_texture_exist)
				{
					$this->session->set_flashdata('Logmsg', '<b style="color:Red;">Texture Details Already Exist </b>');
					redirect( site_url('admin/edittexture/'.$newid));
				}
				else
				{*/
					$updateid=array('id'=>$newid);
					$isupdate = $this->user_model->UPDATEDATA('tbl_texture',$updateid, $updatedata);
					if($isupdate)
					{
						//echo $this->db->last_query();exit('update');
						$this->session->set_flashdata('Logmsg', '<b style="color:green;">Texture Updated Successfully</b>');
						redirect(site_url().'admin/viewtexture');
					}
					else
					{
						//echo $this->db->last_query();exit('u Fails');
						$this->session->set_flashdata('Logmsg', '<b style="color:red;">Error Occured ! Texture Not Updated</b>');
						redirect(site_url().'admin/viewtexture');
					}
				//}
			}
		}

			$this->load->view('Admin/update_texture_view',$data);
	}
	
	//***************************************** 	Edit Density		*************************************************//
	
	function editdensity()
	{
		$data='';
		
		$density=ucwords(trim($this->input->post('density')));
		$density_status=$this->input->post('status[]');
		
		$editid = $this->uri->segment(3);
		$where=array('id'=>$editid);
		
		$data['getdensity'] = $this->user_model->get_sql_select_data('tbl_density',$where);
		
		$updatedata=array('density'=>$density,'status'=>$density_status,);
		
		//echo"<pre>";print_r($getcategory);exit;
		if(isset($_POST["update"]))
		{
			$newid=$this->input->post('densityid');
		
			$this->form_validation->set_error_delimiters('<div class="text-error">', '<span class="text-error-close">x</span></div>');
			$this->form_validation->set_rules('density', 'Density', 'trim|required');
			$this->form_validation->set_rules('status', 'Status', 'required');

			if ($this->form_validation->run() == FALSE)
			{
				$data['message'] = validation_errors();
				$data['getdensity'] = $this->user_model->get_sql_select_data('tbl_density',array('id'=>$newid));
			}
			else
			{
				/*$chk_texture_exist = $this->user_model->get_sql_select_data('tbl_density',$updatedata);
				if($chk_texture_exist)
				{
					$this->session->set_flashdata('Logmsg', '<b style="color:Red;">Density Details Already Exist </b>');
					redirect( site_url('admin/editdensity/'.$newid));
				}
				else
				{*/
					$updateid=array('id'=>$newid);
					$isupdate = $this->user_model->UPDATEDATA('tbl_density',$updateid, $updatedata);
					if($isupdate)
					{
						//echo $this->db->last_query();exit('update');
						$this->session->set_flashdata('Logmsg', '<b style="color:green;">Density Updated Successfully</b>');
						redirect(site_url().'admin/viewdensity');
					}
					else
					{
						//echo $this->db->last_query();exit('u Fails');
						$this->session->set_flashdata('Logmsg', '<b style="color:red;">Error Occured ! Density Not Updated</b>');
						redirect(site_url().'admin/viewdensity');
					}
				//}
			}
		}

			$this->load->view('Admin/update_density_view',$data);
	}
	
	//***************************************** 	Edit Color		*************************************************//
	
	function editcolor()
	{
		$data='';
		
		$color=ucwords(trim($this->input->post('color')));
		$color_status=$this->input->post('status[]');
		
		$editid = $this->uri->segment(3);
		$where=array('id'=>$editid);
		
		$data['getcolor'] = $this->user_model->get_sql_select_data('tbl_color',$where);
		
		$updatedata=array('name'=>$color,'status'=>$color_status,);
		
		//echo"<pre>";print_r($getcategory);exit;
		if(isset($_POST["update"]))
		{
			$newid=$this->input->post('colorid');
		
			$this->form_validation->set_error_delimiters('<div class="text-error">', '<span class="text-error-close">x</span></div>');
			$this->form_validation->set_rules('color', 'Color', 'trim|required');
			$this->form_validation->set_rules('status', 'Status', 'required');

			if ($this->form_validation->run() == FALSE)
			{
				$data['message'] = validation_errors();
				$data['getcolor'] = $this->user_model->get_sql_select_data('tbl_color',array('id'=>$newid));
			}
			else
			{
				/*$chk_color_exist = $this->user_model->get_sql_select_data('tbl_color',$updatedata);
				if($chk_color_exist)
				{
					$this->session->set_flashdata('Logmsg', '<b style="color:Red;">Color Details Already Exist </b>');
					redirect( site_url('admin/editcolor/'.$newid));
				}
				else
				{*/
					$updateid=array('id'=>$newid);
					$isupdate = $this->user_model->UPDATEDATA('tbl_color',$updateid, $updatedata);
					if($isupdate)
					{
						//echo $this->db->last_query();exit('update');
						$this->session->set_flashdata('Logmsg', '<b style="color:green;">Color Updated Successfully</b>');
						redirect(site_url().'admin/viewcolor');
					}
					else
					{
						//echo $this->db->last_query();exit('u Fails');
						$this->session->set_flashdata('Logmsg', '<b style="color:red;">Error Occured ! Color Not Updated</b>');
						redirect(site_url().'admin/viewcolor');
					}
				//}
			}
		}

			$this->load->view('Admin/update_color_view',$data);
	}

	//***************************************** 	Edit Categories		*************************************************//
	
	function editcategory()
	{
		$data='';
		
		$categoryname=ucwords(trim($this->input->post('category')));
		$categorystatus=$this->input->post('status[]');
		
		
		$editid = $this->uri->segment(3);
		$where=array('id'=>$editid);
		
		$data['getcategory'] = $this->user_model->get_sql_select_data('category',$where);
		
		$updatedata=array('name'=>$categoryname,'status'=>$categorystatus,);
		
		//echo"<pre>";print_r($getcategory);exit;
		if(isset($_POST["update"]))
		{
			$newid=$this->input->post('categoryid');
			
			$categoryname=trim($this->input->post('category'));
			$categorystatus=$this->input->post('status[]');
		
			$this->form_validation->set_error_delimiters('<div class="text-error">', '<span class="text-error-close">x</span></div>');
			$this->form_validation->set_rules('category', 'Category', 'trim|required|callback_alpha_space');
			$this->form_validation->set_rules('status', 'Status', 'required');
			$this->form_validation->set_message('alpha_space', 'Only Characters and space is allowed');

			if ($this->form_validation->run() == FALSE)
			{
				$data['message'] = validation_errors();
				$data['getcategory'] = $this->user_model->get_sql_select_data('category',array('id'=>$newid));
			}
			else
			{
				/*$chk_cate_exist = $this->user_model->get_sql_select_data('category',$updatedata);
				if($chk_cate_exist)
				{
					$this->session->set_flashdata('Logmsg', '<b style="color:Red;">Category Details Already Exist </b>');
					redirect( site_url('admin/editcategory/'.$newid));
				}
				else
				{*/
					$updateid=array('id'=>$newid);
					$isupdate = $this->user_model->UPDATEDATA('category',$updateid, $updatedata);
					if($isupdate)
					{
						//echo $this->db->last_query();exit('update');
						$this->session->set_flashdata('Logmsg', '<b style="color:green;">Category Updated Successfully</b>');
						redirect(site_url().'admin/viewcategory');
					}
					else
					{
						//echo $this->db->last_query();exit('u Fails');
						$this->session->set_flashdata('Logmsg', '<b style="color:red;">Error Occured ! Category Not Updated</b>');
						redirect(site_url().'admin/viewcategory');
					}
				//}
			}
		}
	
			$this->load->view('Admin/update_category_view',$data);
	
	}
	
	//***************************************** 	Edit Brand		*************************************************//
	
	function editbrand()
	{
		$data='';
		
		$brandname=ucwords(trim($this->input->post('brand')));
		$brandstatus=$this->input->post('status[]');
		
		
		$editid = $this->uri->segment(3);
		$where=array('id'=>$editid);
		
		$data['getbrand'] = $this->user_model->get_sql_select_data('brand',$where);
		
		$updatedata=array('name'=>$brandname,'status'=>$brandstatus,);
		
		//echo"<pre>";print_r($getcategory);exit;
		if(isset($_POST["update"]))
		{
			$newid=$this->input->post('brandid');
			
			$brandname=trim($this->input->post('brand'));
			$brandstatus=$this->input->post('status[]');
		
			$this->form_validation->set_error_delimiters('<div class="text-error">', '<span class="text-error-close">x</span></div>');
			$this->form_validation->set_rules('brand', 'Brand', 'trim|required|callback_alpha_space');
			$this->form_validation->set_rules('status', 'Status', 'required');
			$this->form_validation->set_message('alpha_space', 'Only Characters and space is allowed');

			if ($this->form_validation->run() == FALSE)
			{
				$data['message'] = validation_errors();
				$data['getbrand'] = $this->user_model->get_sql_select_data('brand',array('id'=>$newid));
			}
			else
			{
				/*$chk_brand_exist = $this->user_model->get_sql_select_data('brand',$updatedata);
				if($chk_brand_exist)
				{
					$this->session->set_flashdata('Logmsg', '<b style="color:Red;">Brand Details Already Exist </b>');
					redirect( site_url('admin/editbrand/'.$newid));
				}
				else
				{*/
					$updateid=array('id'=>$newid);
					$isupdate = $this->user_model->UPDATEDATA('brand',$updateid, $updatedata);
					if($isupdate)
					{
						//echo $this->db->last_query();exit('update');
						$this->session->set_flashdata('Logmsg', '<b style="color:green;">Brand Updated Successfully</b>');
						redirect(site_url().'admin/viewbrand');
					}
					else
					{
						//echo $this->db->last_query();exit('u Fails');
						$this->session->set_flashdata('Logmsg', '<b style="color:red;">Error Occured ! Brand Not Updated</b>');
						redirect(site_url().'admin/viewbrand');
					}
				//}
			}
		}

			$this->load->view('Admin/update_brand_view',$data);

	}
	
	//****************************************** 	Edit Product		************************************************//
	
	function editproduct()
	{
		$data='';
		$data['allcategory']=$this->user_model->getallcategory();
		$data['allbrands']=$this->user_model->getallbrands();
		$data['alltags']=$this->user_model->getalltags();
		$data['alltexture']=$this->user_model->getalltexture();
		$data['alldensity']=$this->user_model->getalldensity();
		$data['allcolor']=$this->user_model->getallcolor();
		$data['allethnicity']=$this->user_model->getallethnicity();
			
		$editid = $this->uri->segment(3);
		$where=array('id'=>$editid);
		
		$data['getproduct'] = $this->user_model->get_sql_select_data('product',$where);
		
		
		
		//echo"<pre>";print_r($getcategory);exit;
		if(isset($_POST["update"]))
		{
			$newid=$this->input->post('productid');
			
			$category=trim($this->input->post('category'));
			$brand=trim($this->input->post('brand'));
			$productname=trim($this->input->post('productname'));
			
			$tags=$this->input->post('tags[]');
			$ethnicity=$this->input->post('ethnicitys[]');
			$texture=$this->input->post('textures[]');
			$color=$this->input->post('colors[]');
			$density=$this->input->post('densitys[]');
			
			$old_img=$this->input->post('old_img');
			
			$description=trim($this->input->post('description'));
			$price=trim($this->input->post('price'));
			$status=$this->input->post('status[]');
			
			$this->form_validation->set_error_delimiters('<div class="text-error">', '<span class="text-error-close">x</span></div>');
			$this->form_validation->set_rules('category', 'Category', 'trim|required');
			$this->form_validation->set_rules('brand', 'Brand', 'trim|required');
			$this->form_validation->set_rules('productname', 'Product Name', 'trim|required');
			
			$this->form_validation->set_rules('tags[]', 'Tags', 'trim|required');
			$this->form_validation->set_rules('ethnicitys[]', 'Ethnicity', 'trim|required');
			$this->form_validation->set_rules('textures[]', 'Texture', 'trim|required');
			$this->form_validation->set_rules('colors[]', 'Color', 'trim|required');
			$this->form_validation->set_rules('densitys[]', 'Density', 'trim|required');
				
			//$this->form_validation->set_rules('price', 'Price', 'trim|required');			
			$this->form_validation->set_rules('status', 'Status', 'required');
			$this->form_validation->set_message('alpha_space', 'Only Characters and space is allowed');

			if ($this->form_validation->run() == FALSE)
			{
				$data['message'] = validation_errors();
				$data['getproduct'] = $this->user_model->get_sql_select_data('product',array('id'=>$newid));
			}
			else
			{
				if (!is_dir('./assets/product/'))
				{
					mkdir('./assets/product/', 0777, true);
				}
				$config['upload_path'] = './assets/product/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				//$config['overwrite'] = TRUE;
				
				$this->load->library('upload');	
				$this->load->library('image_lib');		
				$this->upload->initialize($config); ///***------
				if( ! $this->upload->do_upload('pic'))    ///***------userfile
				{
					$data['message'] = array('error' => $this->upload->display_errors());
				}
				
				$data = array('upload_data' => $this->upload->data());
				
				$path=$data['upload_data']['full_path'];
				$imagename=$data['upload_data']['file_name'];					
				//*********** create new file
					/*$rand_no =  date('Y-m-d H-i-s');
					$rand_no = str_replace(' ', '', $rand_no);
					$raw_name=$data['upload_data']['raw_name'];
					$file_ext=$data['upload_data']['file_ext'];*/
					
					$file_name=$data['upload_data']['file_name'];
					$this->_createThumbnails($file_name);
					$base_url=base_url();
					$newfile=$file_name;

					//echo"<pre>";print_r($data); exit;
					if(!empty($file_name))
					{
						$file_name=$newfile;
					}
					elseif(!empty($old_img))
					{
						$file_name=$old_img;
					}
					else
					{
						$file_name=$base_url.'assets/product/noproduct.png';
					}
					
					//echo $file_name;exit;
				$tag=implode(',',$tags);
				$ethnicitys=implode(',',$ethnicity);
				$textures=implode(',',$texture);
				$colors=implode(',',$color);
				$densitys=implode(',',$density);
					$updatedata=array(
								'name'=>$productname,
								'description'=>$description,
								'brand_id'=>$brand,
								'tagid'=>$tag,
								'ethnicity'=>$ethnicitys,
								'texture'=>$textures,
								'color'=>$colors,
								'density'=>$densitys,
								'status'=>$status,
								'price'=>$price,
								'image'=>$file_name,
								'categoryid'=>$category,
							);
			
					$updateid=array('id'=>$newid);
					$isupdate = $this->user_model->UPDATEDATA('product',$updateid, $updatedata);
					if($isupdate)
					{
						//echo $this->db->last_query();exit('update');
						$this->session->set_flashdata('Logmsg', '<b style="color:green;">Product Updated Successfully</b>');
						//$data['message'] ='<div class="text-success-wrapper">Product Updated Successfully<span class="text-success-close">x</span></div>';
						redirect(site_url().'admin/viewproduct');
					}
					else
					{
						//echo $this->db->last_query();exit('u Fails');
						$this->session->set_flashdata('Logmsg', '<b style="color:red;">Error Occured ! Product Not Updated</b>');
						//$data['message'] ='<div class="text-error">Product Not Updated<span class="text-error-close">x</span></div>';
						redirect(site_url().'admin/viewproduct');
					}
	
			}
		}

			$this->load->view('Admin/update_product_view',$data);

	}
	
	//***************************************** 	Edit Tag		*************************************************//
	
	function edittag()
	{
		$data='';
		$tagname=ucwords(trim($this->input->post('tag')));
		$status=$this->input->post('status[]');
		
		$editid = $this->uri->segment(3);
		
		$where=array('id'=>$editid);
		
		$data['gettag'] = $this->user_model->get_sql_select_data('tags',$where);
		
		$updatedata=array('tagname'=>$tagname,'status'=>$status);
		
		//echo"<pre>";print_r($getcategory);exit;
		if(isset($_POST["update"]))
		{
			$newid=$this->input->post('tagid');
			$this->form_validation->set_error_delimiters('<div class="text-error">', '<span class="text-error-close">x</span></div>');
			$this->form_validation->set_rules('tag', 'Tag', 'trim|required|callback_alpha_space');
			//$this->form_validation->set_rules('status', 'Status', 'required');
			$this->form_validation->set_message('alpha_space', 'Only Characters and space is allowed');

			if ($this->form_validation->run() == FALSE)
			{
				
				$data['message'] = validation_errors();
				$data['gettag'] = $this->user_model->get_sql_select_data('tags',array('id'=>$newid));
			}
			else
			{
				
				/*$chk_tag_exist = $this->user_model->get_sql_select_data('tags',$updatedata);
				if($chk_tag_exist)
				{
					$this->session->set_flashdata('Logmsg', '<b style="color:Red;">Tag Details Already Exist </b>');
					redirect( site_url('admin/edittag/'.$newid));
				}
				else
				{*/
					$updateid=array('id'=>$newid);
					$isupdate = $this->user_model->UPDATEDATA('tags',$updateid, $updatedata);
					if($isupdate)
					{
						//echo $this->db->last_query();exit('update');
						$this->session->set_flashdata('Logmsg', '<b style="color:green;">Tag Updated Successfully</b>');
						redirect(site_url().'admin/viewtag');
					}
					else
					{
						//echo $this->db->last_query();exit('u Fails');
						$this->session->set_flashdata('Logmsg', '<b style="color:red;">Error Occured ! Tag Not Updated</b>');
						redirect(site_url().'admin/viewtag');
					}
				//}
			}
		}
		
			$this->load->view('Admin/update_tag_view',$data);
		
	}

	//***************************************** 	Edit Template		*************************************************//
	
	function edittemplate()
	{
		$data='';
		
		$email_name=ucwords(trim($this->input->post('email_name')));
		$email_subject=ucwords(trim($this->input->post('email_subject')));
		$contentn=$this->input->post('contentn');
		$status=$this->input->post('status[]');
		
		$editid = $this->uri->segment(3);
		$where=array('id'=>$editid);
		
		$data['gettemplate'] = $this->user_model->get_sql_select_data('email_template',$where);
		
		$chk_data=array('template_name'=>$email_name,'subject'=>$email_subject,'content'=>$contentn,'status'=>$status,);
		
		//echo"<pre>";print_r($getcategory);exit;
		if(isset($_POST["update_temp"]))
		{
			$newid=$this->input->post('templateid');
			
			$this->form_validation->set_error_delimiters('<div class="text-error">', '<span class="text-error-close">x</span></div>');
			$this->form_validation->set_rules('email_name', 'Template Name', 'trim|required');
			$this->form_validation->set_rules('email_subject', 'Subject', 'trim|required');
			$this->form_validation->set_rules('contentn', 'Content', 'trim|required');
			$this->form_validation->set_rules('status', 'Status', 'required');

			if ($this->form_validation->run() == FALSE)
			{
				$data['message'] = validation_errors();
				$data['gettemplate'] = $this->user_model->get_sql_select_data('email_template',array('id'=>$newid));
			}
			else
			{
				/*$chk_template_exist = $this->user_model->get_sql_select_data('email_template',$chk_data);
				if($chk_template_exist)
				{
					$this->session->set_flashdata('Logmsg', '<b style="color:Red;">Template Details Already Exist </b>');
					redirect( site_url('admin/edittemplate/'.$newid));
				}
				else
				{*/
					$updateid=array('id'=>$newid);
					$updatedate=date("Y-m-d H:i:s");
					
					$updatedata=array('template_name'=>$email_name,'subject'=>$email_subject,'content'=>$contentn,'status'=>$status,'createdate'=>$updatedate);
					$isupdate = $this->user_model->UPDATEDATA('email_template',$updateid, $updatedata);
					if($isupdate)
					{
						//echo $this->db->last_query();exit('update');
						$this->session->set_flashdata('Logmsg', '<b style="color:green;">Template Updated Successfully</b>');
						redirect(site_url().'admin/viewtemplate');
					}
					else
					{
						//echo $this->db->last_query();exit('u Fails');
						$this->session->set_flashdata('Logmsg', '<b style="color:red;">Error Occured ! Template Not Updated</b>');
						redirect(site_url().'admin/viewtemplate');
					}
				//}
			}
		}

			$this->load->view('Admin/update_template_view',$data);
	}

	//***************************************** 	Change Status		*************************************************//
	
	function changeuserstatus()
	{
		$data='';
		
		$where=array('id'=>$this->uri->segment(3));
		$data['userdata']=$this->user_model->get_sql_select_data('tbl_user',$where);
		//echo"<pre>";print_r($data);exit;
		if($data['userdata'][0]['status']==1)
		{
			$status=0;
		}
		else
		{
			$status=1;
		}
		$updatedata=array('status'=>$status);
		$isUpdate	=	$this->user_model->UPDATEDATA('tbl_user',$where,$updatedata);
		if($isUpdate)
		{
			$this->session->set_flashdata('Logmsg', '<b style="color:Green;font-size: 13px">User Status Changed</b>');
			redirect(site_url() . 'admin/viewstylist');
		}
		else
		{
			$this->session->set_flashdata('Logmsg', '<b style="color:red;font-size: 13px">Status Not Changed</b>');
			redirect(site_url() . 'admin/viewstylist');
		}
		//$this->load->view('Admin/update_tag_view',$data);
		
	}
	
	//***************************************** 	Delete Categories		*************************************************//
	
	function deletecategory()
	{
		$deleteid = $this->uri->segment(3);
		$where=array('id'=>$deleteid);
		$deletecategory = $this->user_model->DELETEDATA('category', $where);
		if($deletecategory)
		{
			$this->session->set_flashdata('Logmsg', '<b style="color:green;">Category Deleted Successfully</b>');
			redirect(site_url().'admin/viewcategory');
		}
		else
		{
			$this->session->set_flashdata('Logmsg', '<b style="color:Red;">Category Not Deleted </b>');
			redirect(site_url().'admin/viewcategory');
		}
	}
	
	//****************************************** 	Delete Brand		************************************************//
	
	function deletebrand()
	{
		$deleteid = $this->uri->segment(3);
		$where=array('id'=>$deleteid);
		$deletebrand = $this->user_model->DELETEDATA('brand', $where);
		if($deletebrand)
		{
			$this->session->set_flashdata('Logmsg', '<b style="color:green;">Brand Deleted Successfully</b>');
			redirect(site_url().'admin/viewbrand');
		}
		else
		{
			$this->session->set_flashdata('Logmsg', '<b style="color:Red;">Brand Not Deleted </b>');
			redirect(site_url().'admin/viewbrand');
		}
	}

	//***************************************** 	Delete Tag		*************************************************//
	
	function deletetag()
	{
		$deleteid = $this->uri->segment(3);
		$where=array('id'=>$deleteid);
		$deletebrand = $this->user_model->DELETEDATA('tags', $where);
		if($deletebrand)
		{
			$this->session->set_flashdata('Logmsg', '<b style="color:green;">Tag Deleted Successfully</b>');
			redirect(site_url().'admin/viewtag');
		}
		else
		{
			$this->session->set_flashdata('Logmsg', '<b style="color:Red;">Tag Not Deleted </b>');
			redirect(site_url().'admin/viewtag');
		}
	}

	//****************************************** 	Delete Product		************************************************//
	
	function deleteproduct()
	{
		$deleteid = $this->uri->segment(3);
		$where=array('id'=>$deleteid);
		$deletebrand = $this->user_model->DELETEDATA('product', $where);
		if($deletebrand)
		{
			$this->session->set_flashdata('Logmsg', '<b style="color:green;">Product Deleted Successfully</b>');
			redirect(site_url().'admin/viewproduct');
		}
		else
		{
			$this->session->set_flashdata('Logmsg', '<b style="color:Red;">Product Not Deleted </b>');
			redirect(site_url().'admin/viewproduct');
		}
	}

	//****************************************** 	Delete Product		************************************************//
	
	function delete_ethnicity()
	{
		$deleteid = $this->uri->segment(3);
		$where=array('id'=>$deleteid);
		$deleteethnicity = $this->user_model->DELETEDATA('tbl_ethnicity', $where);
		if($deleteethnicity)
		{
			$this->session->set_flashdata('Logmsg', '<b style="color:green;">Ethnicity Deleted Successfully</b>');
			redirect(site_url().'admin/viewethnicity');
		}
		else
		{
			$this->session->set_flashdata('Logmsg', '<b style="color:Red;">Ethnicity Not Deleted </b>');
			redirect(site_url().'admin/viewethnicity');
		}
	}
	
	//****************************************** 	Delete Product		************************************************//
	
	function delete_texture()
	{
		$deleteid = $this->uri->segment(3);
		$where=array('id'=>$deleteid);
		$deletetexture = $this->user_model->DELETEDATA('tbl_texture', $where);
		if($deletetexture)
		{
			$this->session->set_flashdata('Logmsg', '<b style="color:green;">Texture Deleted Successfully</b>');
			redirect(site_url().'admin/viewtexture');
		}
		else
		{
			$this->session->set_flashdata('Logmsg', '<b style="color:Red;">Texture Not Deleted </b>');
			redirect(site_url().'admin/viewtexture');
		}
	}
	
	//****************************************** 	Delete Product		************************************************//
	
	function delete_density()
	{
		$deleteid = $this->uri->segment(3);
		$where=array('id'=>$deleteid);
		$deletedensity = $this->user_model->DELETEDATA('tbl_density', $where);
		if($deletedensity)
		{
			$this->session->set_flashdata('Logmsg', '<b style="color:green;">Density Deleted Successfully</b>');
			redirect(site_url().'admin/viewdensity');
		}
		else
		{
			$this->session->set_flashdata('Logmsg', '<b style="color:Red;">Density Not Deleted </b>');
			redirect(site_url().'admin/viewdensity');
		}
	}
	
	//****************************************** 	Delete Product		************************************************//
	
	function delete_color()
	{
		$deleteid = $this->uri->segment(3);
		$where=array('id'=>$deleteid);
		$deletecolor = $this->user_model->DELETEDATA('tbl_color', $where);
		if($deletecolor)
		{
			$this->session->set_flashdata('Logmsg', '<b style="color:green;">Color Deleted Successfully</b>');
			redirect(site_url().'admin/viewcolor');
		}
		else
		{
			$this->session->set_flashdata('Logmsg', '<b style="color:Red;">Color Not Deleted </b>');
			redirect(site_url().'admin/viewcolor');
		}
	}
 
	//****************************************** 	Delete Template		************************************************//
	
	function deletetemplate()
	{
		$deleteid = $this->uri->segment(3);
		$where=array('id'=>$deleteid);

		$check_sent	=	$this->user_model->get_joins('sent_emails',array('email_temp_id'=>$deleteid));
		if(!empty($check_sent))
		{
			$deletebrand = $this->user_model->DELETEDATA('sent_emails', array('email_temp_id'=>$deleteid));
			$deletebrand = $this->user_model->DELETEDATA('email_template', $where);
			if($deletebrand)
			{
				$this->session->set_flashdata('Logmsg', '<b style="color:green;">Product Deleted Successfully</b>');
				redirect(site_url().'admin/viewtemplate');
			}
			else
			{
				$this->session->set_flashdata('Logmsg', '<b style="color:Red;">Product Not Deleted </b>');
				redirect(site_url().'admin/viewtemplate');
			}
		}
		else
		{
			$deletebrand = $this->user_model->DELETEDATA('email_template', $where);
			if($deletebrand)
			{
				$this->session->set_flashdata('Logmsg', '<b style="color:green;">Product Deleted Successfully</b>');
				redirect(site_url().'admin/viewtemplate');
			}
			else
			{
				$this->session->set_flashdata('Logmsg', '<b style="color:Red;">Product Not Deleted </b>');
				redirect(site_url().'admin/viewtemplate');
			}
		}
		
	}


	//*************************************** 	Add Template	**************************************************//

	function add_template()
	{
	   $data='';
	   
		if(isset($_POST['addemail']))
		{
			$email_name = trim($this->input->post('email_name'));
			$email_subject = trim($this->input->post('email_subject'));
			$contentn = trim($this->input->post('contentn'));
			$emailfrom = 'narendra.thakur@newtechfusion.com';

			$status = $this->input->post('status');
			$currentdate=date("Y-m-d H:i:s");
			$this->form_validation->set_error_delimiters('<div class="text-error">', '<span class="text-error-close">x</span></div>');
			$this->form_validation->set_rules('email_name', 'Email Name','trim|required');
			$this->form_validation->set_rules('email_subject', 'Email Subject','trim|required');
			$this->form_validation->set_rules('contentn', 'Email Content','trim|required');
			$this->form_validation->set_rules('status', 'Email Status','trim|required');
			if ($this->form_validation->run() == FALSE)
			{
				$data['message'] = validation_errors();
			}
			else
			{
				$emaildata=array(
				'template_name'=>$email_name,
				'subject'=>$email_subject,
				'content'=>$contentn,
				'status'=>$status,
				'createdate'=>$currentdate,
				'emailfrom'=>$emailfrom,
				);
				
				$this->user_model->INSERTDATA('email_template',$emaildata);         
				$data['message'] ='<div class="text-success-wrapper">Email Template Added<span class="text-success-close">x</span></div>';
			}    
		}
		$this->load->view('Admin/add_emailtemplate_view',$data);
	}
     
     //************************************************* Change Password***************************************************************/
     
	function changepassword()
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
								$this->session->set_flashdata('Logmsg', '<b style="color:green;">Password Updated Successfully</b>');
								redirect(site_url().'admin/changepassword');
							}
							else
							{
								$this->session->set_flashdata('Logmsg', '<b style="color:red;">Error Occured ! Password Not Updated</b>');
								redirect(site_url().'admin/changepassword');
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

     
	
	//*************************************** 	Change Stylist Password	**************************************************//

	function stylist_password()
	{
		$data='';		
		$stlistid=$this->input->post('stylistId');
		$newpassword=md5($this->input->post('newpassword[]'));
		$re_password=md5($this->input->post('re_password[]'));
		
		$this->form_validation->set_error_delimiters('<div class="text-error">', '<span class="text-error-close">x</span></div>');
		$this->form_validation->set_rules('newpassword', 'New Password', 'trim|required|md5');
		$this->form_validation->set_rules('re_password', 'Confirm Password', 'trim|required|md5|matches[newpassword]');
		if ($this->form_validation->run() == FALSE)
		{
			$data['message'] = validation_errors();
			$this->session->set_flashdata('popup_Logmsg', $data['message']);
			redirect(site_url().'admin/viewstylist/#popup1'.$stlistid);
		}
		else
		{
			$isupdate = $this->user_model->UPDATEDATA('tbl_user',array('id'=>$stlistid),array('password'=>$newpassword));
			if($isupdate)
			{
				$this->session->set_flashdata('Logmsg', '<b style="color:green;">Password Updated Successfully</b>');
				redirect(site_url().'admin/viewstylist');
			}
			else
			{
				$this->session->set_flashdata('Logmsg', '<b style="color:red;">Error Occured ! Password Not Updated</b>');
				redirect(site_url().'admin/viewstylist');
			}
		}
		
		
		
		//echo $stlistid.'_'.$newpassword.'_'.$re_password;exit;
	}
	
	//*************************************** 	To check name with space like(firstname lastname)	**************************************************//

	function alpha_space($str)
	{
		return ( ! preg_match("/^([a-z_ '-])+$/i", $str)) ? FALSE : TRUE;		//it will allow a-z letters, space, underscore, oppostrope, and hyphen
	}
	
		//*************************************** Add Stylist ***************************************************//
	
	function addstylist()
	{
		$data='';
		
		$data['states']	=	$this->user_model->get_sql_select_data('tbl_state');
		
		if(isset($_POST['add']))
		{
			$firstname=ucwords(trim($this->input->post('firstname')));
			$lastname=ucwords(trim($this->input->post('lastname')));
			$email=trim($this->input->post('email'));
			$contactno=trim($this->input->post('contactno'));
			$password=md5(trim($this->input->post('password')));
			
		//	$usertype=$this->input->post('usertype');
			$salon_name=trim($this->input->post('salon_name'));
		//	$no_of_stylist=trim($this->input->post('no_of_stylist'));
		
			$packages=$this->input->post('packages');
			$address_a=ucwords($this->input->post('address_a'));
			$address_b=ucwords($this->input->post('address_b'));
			$city=ucwords($this->input->post('city'));
			$state=$this->input->post('state');
			$zipcode=$this->input->post('zipcode');
			
			$pack_name=ucwords($this->input->post('pack_name'));
			$subs_type=ucwords($this->input->post('subs_type'));
			
			$status=trim($this->input->post('status'));
			
			$this->form_validation->set_error_delimiters('<div class="text-error">', '<span class="text-error-close">x</span></div>');
			
			$this->form_validation->set_rules('firstname', 'First name','trim|required|alpha');
			$this->form_validation->set_rules('lastname', 'Last name','trim|required|alpha');
			$this->form_validation->set_rules('contactno', 'Phone No.','trim|required');
			$this->form_validation->set_rules('email', 'Email Address','trim|required|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[12]|md5');
			$this->form_validation->set_rules('confirmpassword', 'Confirm Password', 'trim|required|max_length[12]|md5|matches[password]');
			//$this->form_validation->set_rules('usertype', 'Stylist Type','trim|required');
			$this->form_validation->set_rules('salon_name', 'Name of Salon','trim|required');
			$this->form_validation->set_rules('packages', 'Package','trim|required');
			$this->form_validation->set_rules('address_a', 'Address','trim|required');
			$this->form_validation->set_rules('city', 'City','trim|required');
			$this->form_validation->set_rules('state', 'State','trim|required');
			$this->form_validation->set_rules('zipcode', 'Zipcode','trim|required');
		/*	if($usertype=="SALON")
			{
				$this->form_validation->set_rules('no_of_stylist', 'Number of Stylist','trim|required');
			}
		*/	
			$this->form_validation->set_rules('status', 'Status','trim|required');
			if ($this->form_validation->run() == FALSE)
			{
				$data['message'] = validation_errors();
			}
			else
			{
				$checkuser=array(
						'email'=>$email,
						);
				@$isregistered = $this->user_model->get_sql_select_data('tbl_user', $checkuser);
				if(!empty($isregistered))
				{
					$data['message'] ='<div class="text-error">Email already exists<span class="text-error-close">x</span></div>';
				}
				else
				{
					$currentdate=date("Y-m-d H:i:s");
					$default_img=site_url().'assets/img/find_user.png';
					$userdata=array(
						'firstname'=>$firstname,
						'lastname'=>$lastname,
						'contactno'=>$contactno,
						'email'=>$email,
						'status'=>$status,
						'role_id'=>3,
						'password'=>$password,
						'usertype'=>'INDEPENDENT STYLIST',
						'address1'=>$address_a,
						'address2'=>$address_b,
						'salon_name'=>$salon_name,
						'city'=>$city,
						'state'=>$state,
						'zipcode'=>$zipcode,
						//'no_of_stylist'=>$no_of_stylist,
						'admin_added'=>1,
						'createdate'=>$currentdate,
						'update_date'=>$currentdate,
						'image'=>$default_img,
						);
					$isadded=$this->user_model->INSERTDATA('tbl_user',$userdata);
					if($isadded)
					{
						$whereId=array('email'=>$email);
						
						$joinId=$this->user_model->get_sql_select_data('tbl_user', $whereId);
						$joinId[0]['id'];
						//$joinroleId[0]['role_id'];
						
						$stylistdata=array(
									'user_id'=>$joinId[0]['id'],
									);
						$this->user_model->INSERTDATA('stylist',$stylistdata);
						
						$styledata=array('user_id'=>$joinId[0]['id']);
						$styleid=$this->user_model->get_sql_select_data('stylist', $styledata);
						$styleid[0]['id'];
						
						$data['subscription']=$this->user_model->get_sql_select_data('subscription', array('s_id'=>$styleid[0]['id']));
						
						if(empty($data['subscription']))
						{
							$insertdata=array('s_id'=>$styleid[0]['id'], 'plan'=>$packages, 'package'=>$pack_name, 'subs_type'=>$subs_type, 'billing_address'=>$address_a, 'billing_address_b'=>$address_b, 'billing_city'=>$city, 'billing_state'=>$state, 'billing_zipcode'=>$zipcode, 'createdate'=>$currentdate,'update_date'=>$currentdate);
							$isupdate = $this->user_model->INSERTDATA('subscription',$insertdata);
						}
						else
						{
							$update_data=array('plan'=>$packages, 'package'=>$pack_name, 'subs_type'=>$subs_type, 'billing_address'=>$address_a, 'billing_address_b'=>$address_b, 'billing_city'=>$city, 'billing_state'=>$state, 'billing_zipcode'=>$zipcode,'update_date'=>$currentdate,);
							$this->user_model->UPDATEDATA('subscription',array('s_id'=>$styleid[0]['id']),$update_data);
						}
						//echo "<pre>"; print_r($data['subscription']);exit;
						$this->session->set_flashdata('Logmsg', '<b style="color:green;">Stylist Added Successfully</b>');
						redirect(site_url().'admin/viewstylist');
						//$data['message'] ='<div class="text-success-wrapper">Stylist Added Successfully<span class="text-success-close">x</span></div>';
					}
					else
					{
						$data['message'] ='<div class="text-error">Error occured Try Again<span class="text-error-close">x</span></div>';
					}
				}
			}
		}
		
		$this->load->view('Admin/addstylist_view',$data);
	}

	//*************************************** Add Stylist Billing info***************************************************//

	function addsubscription()
	{
		$data='';
		
		$data['allstylist']=$this->user_model->get_sql_select_data('tbl_user',array('role_id'=>3));
		//echo $this->db->last_query();
		$data['states']	=	$this->user_model->get_sql_select_data('tbl_state');
		
		if(isset($_POST['add']))
		{
			$stylistid=$this->input->post('stylist_list');
			$packages=$this->input->post('packages');
			$address_a=ucwords($this->input->post('address_a'));
			$address_b=ucwords($this->input->post('address_b'));
			$city=ucwords($this->input->post('city'));
			$state=$this->input->post('state');
			$zipcode=$this->input->post('zipcode');
			
			$pack_name=ucwords($this->input->post('pack_name'));
			$subs_type=ucwords($this->input->post('subs_type'));
			
			$this->form_validation->set_error_delimiters('<div class="text-error">', '<span class="text-error-close">x</span></div>');
			
			$this->form_validation->set_rules('stylist_list', 'Stylist Name','trim|required');
			$this->form_validation->set_rules('packages', 'Package','trim|required');
			$this->form_validation->set_rules('address_a', 'Address','trim|required');
			$this->form_validation->set_rules('city', 'City','trim|required');
			$this->form_validation->set_rules('state', 'State','trim|required');
			$this->form_validation->set_rules('zipcode', 'Zipcode','trim|required');
			if ($this->form_validation->run() == FALSE)
			{
				$data['message'] = validation_errors();
			}
			else
			{
				$updatedata=array('address1'=>$address_a,'address2'=>$address_b,'city'=>$city,'state'=>$state,'zipcode'=>$zipcode, 'createdate'=>$currentdate);
				$updateid=array('id'=>$stylistid);
				$isupdate = $this->user_model->UPDATEDATA('tbl_user',$updateid, $updatedata);
				if($isupdate)
				{
					//echo $this->db->last_query();exit('update');
					$data['getstylist'] = $this->user_model->get_sql_select_data('stylist',array('user_id'=>$stylistid));
					$s_id=$data['getstylist'][0]['id'];
					$createdate=date("Y-m-d H:i:s");
					
					$data['chk_subs'] = $this->user_model->get_sql_select_data('subscription',array('s_id'=>$s_id));
					if($data['chk_subs'])
					{
						$update_data=array('plan'=>$packages, 'package'=>$pack_name, 'subs_type'=>$subs_type, 'billing_address'=>$address_a, 'billing_address_b'=>$address_b, 'billing_city'=>$city, 'billing_state'=>$state, 'billing_zipcode'=>$zipcode);
						$this->user_model->UPDATEDATA('subscription',array('s_id'=>$s_id),$update_data);
					}
					else
					{
						$insertdata=array('s_id'=>$s_id, 'plan'=>$packages, 'package'=>$pack_name, 'subs_type'=>$subs_type, 'billing_address'=>$address_a, 'billing_address_b'=>$address_b, 'billing_city'=>$city, 'billing_state'=>$state, 'billing_zipcode'=>$zipcode, 'createdate'=>$createdate);
						$isupdate = $this->user_model->INSERTDATA('subscription',$insertdata);
					}
					$this->session->set_flashdata('Logmsg', '<b style="color:green;">Details Updated Successfully</b>');
					redirect(site_url().'admin/viewsubscription');
				}
				else
				{
					//echo $this->db->last_query();exit('u Fails');
					$this->session->set_flashdata('Logmsg', '<b style="color:red;">Error Occured ! Details Not Updated</b>');
					redirect(site_url().'admin/viewsubscription');
				}
			}
			
		}
		
		$this->load->view('Admin/addsubscription_view',$data);
	}	
	
	//***************************************** 	Edit Stylist		*************************************************//
	
	function editstylist()
	{
		
		$data='';
		
		$editid = $this->uri->segment(3);
		$where=array('tbl_user.id'=>$editid);
		
		$data['states']	=	$this->user_model->get_sql_select_data('tbl_state');
		
		$join_s=array(
				array('table'=>'stylist','condition'=>'`stylist`.`id` = `subscription`.`s_id`','jointype'=>'inner'),
				array('table'=>'tbl_user','condition'=>'`tbl_user`.`id` = `stylist`.`user_id`','jointype'=>'inner'),
				array('table'=>'tbl_state as user_state','condition'=>'`user_state`.`id` = `tbl_user`.`state`','jointype'=>'inner'),
				array('table'=>'tbl_state','condition'=>'`tbl_state`.`id` = `subscription`.`billing_state`','jointype'=>'inner'),
				);
		$field=array('subscription.*','tbl_user.id as user_id', 'tbl_user.firstname', 'tbl_user.lastname', 'tbl_user.email', 'tbl_user.contactno', 'tbl_user.usertype', 'tbl_user.salon_name', 'tbl_user.status', 'tbl_user.contactno','tbl_state.state_name', 'tbl_state.id as state_id' );
		$data['subscription'] = $this->user_model->get_joins('subscription',$where,$join_s,$field);
		
		$data['getuser'] = $this->user_model->get_joins('tbl_user',$where);
		
		
		$firstname=ucwords(trim($this->input->post('firstname')));
		$lastname=ucwords(trim($this->input->post('lastname')));
		$email=trim($this->input->post('email'));
		$contactno=trim($this->input->post('contactno'));
		//$password=md5(trim($this->input->post('password')));
		
		//$usertype=trim($this->input->post('usertype'));
		$salon_name=trim($this->input->post('salon_name'));
		//$no_of_stylist=trim($this->input->post('no_of_stylist'));
		
		$address_a=ucwords($this->input->post('address_a'));
		$address_b=ucwords($this->input->post('address_b'));
		$city=ucwords($this->input->post('city'));
		$state=$this->input->post('state');
		$zipcode=$this->input->post('zipcode');
		
		$packages=$this->input->post('packages');
		$pack_name=ucwords($this->input->post('pack_name'));
		$subs_type=ucwords($this->input->post('subs_type'));
		
		$status=$this->input->post('status');
		
		$stripe_cust_id=$this->input->post('stripe_cust_id');
		$stripe_plan_id=$this->input->post('stripe_plan_id');
		$recuring_sub_id=$this->input->post('recuring_sub_id');		
		
		//echo"<pre>";print_r($data['getuser']);exit;
		if(isset($_POST["update"]))
		{
			/*Stripe payment Start*/
				//print_r($_POST['stripeToken']);exit('__ok');
				$amount=$packages;
				if($subs_type=='Yearly')						// setting interval for stripe account
				{
					$interval='year';
				}
				elseif($subs_type=='Monthly')
				{
					$interval='month';
				}
				
				/*Checking Plan Exist or not Start*/
				$customer_list=json_decode($this->stripe->customer_list());
				
				$stripe_cust_exists='';
				if(!empty($customer_list))
				{
					$allcustomers=$customer_list->data;
					
					foreach($allcustomers as $customer)
					{
						if($customer->id==$stripe_cust_id)
						{
							$stripe_cust_exists['id']=$customer->id;
							$stripe_cust_exists['name']=$customer->subscriptions->data[0]->plan->name;
						}
					}
				}
				/*Checking Client Exist or not end*/
				

				/*Checking Plan Exist or not Start*/
				$plan_list=json_decode($this->stripe->plan_list());
				$chk_plan='';
				if(!empty($plan_list))
				{
					@$last_plan_id=$plan_list->data[0]->id;
					$allplans=$plan_list->data;
					
					foreach($allplans as $plans)
					{
						if($plans->name==$pack_name.' '.$subs_type)
						{
							$chk_plan['id']=$plans->id;
							$chk_plan['plan_name']=$plans->name;
							$chk_plan['interval']=$plans->interval;
							$chk_plan['amount']=$plans->amount;
						}
					}
				}
				else
				{
					$last_plan_id=0;
				}
				
				/*Checking Client Exist or not end*/
				
				
				/*Creating new plan if plan not exists (Plan id not found) start*/
				if(empty($chk_plan))
				{
					$create_plan=json_decode($this->stripe->plan_create($last_plan_id+1, $amount, $pack_name.' '.$subs_type, $interval, $trial_days = FALSE ));
					$insertplanid=$create_plan->id;
					$up_planid=$last_plan_id+1;
					$up_plan_name=$pack_name.' '.$subs_type;
					$up_plan_interval=$interval;
					$up_plan_amount=$amount;
				}
				else
				{
					$insertplanid=$chk_plan['id'];
					$up_planid=$chk_plan['id'];
					$up_plan_name=$chk_plan['plan_name'];
					$up_plan_interval=$chk_plan['interval'];
					$up_plan_amount=$chk_plan['amount'];
				}
				/*Creating new plan if plan not exists (Plan id not found) end*/
				
				if(empty($stripe_cust_exists))
				{
					//echo"Empty";
				}
				else
				{
					//echo"not empty";
					//echo"<pre>";print_r($stripe_cust_exists);
				}

				$newdata=array(	"card" => array(
								//"number" => "4242424242424242",		//	card no. is mandetory without card no it will not work
								//"exp_month" => 5,
								//"exp_year" => date('Y') + 3,
								//"cvc" => "314",
								"Name" => "314",
								"address_line1" =>'ok',
								"address_line2" =>'city',
								"city" =>'bharat',
							));
				
				$customer_unsubscribe=json_decode($this->stripe->customer_unsubscribe($stripe_cust_id));				//	unsubscribing old plan
				$desc='Inhairent Subscription Changed';
				$charge_cust=json_decode($this->stripe->charge_customer($amount, $stripe_cust_id,$desc));				//	charging amount
				$cust_subs=json_decode($this->stripe->customer_subscribe($stripe_cust_id, $up_planid,$options=''));		//	subscribing new plan
		//		$cust_info=json_decode($this->stripe->customer_info($stripe_cust_id));
				
		//		$update_cust=json_decode($this->stripe->customer_update($stripe_cust_id,$newdata));
				
				/*
				echo"<pre>";
				
				print_r($cust_subs);exit;
				print_r($newdata);
				print_r($update_cust);
				print_r($customer_unsubscribe);
				exit;*/
			
				
				/*Stripe payment Ends*/

			$newid=$this->input->post('stylistid');
		
			$this->form_validation->set_error_delimiters('<div class="text-error">', '<span class="text-error-close">x</span></div>');
			$this->form_validation->set_rules('firstname', 'First name','trim|required|alpha');
			$this->form_validation->set_rules('lastname', 'Last name','trim|required|alpha');
			$this->form_validation->set_rules('contactno', 'Phone No.','trim|required');
			$this->form_validation->set_rules('email', 'Email Address','trim|required|valid_email');
			//$this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[12]|md5');
			//$this->form_validation->set_rules('usertype', 'Stylist Type','trim|required');
			$this->form_validation->set_rules('salon_name', 'Name of Salon','trim|required');
			$this->form_validation->set_rules('packages', 'Package','trim|required');
			
			/*if($usertype=="SALON")
			{
				$this->form_validation->set_rules('no_of_stylist', 'Number of Stylist','trim|required');
			}*/
			$this->form_validation->set_rules('status', 'Status','trim|required');
			
			if ($this->form_validation->run() == FALSE)
			{
				$data['states']	=	$this->user_model->get_sql_select_data('tbl_state');
		
				$join_s=array(
						array('table'=>'stylist','condition'=>'`stylist`.`id` = `subscription`.`s_id`','jointype'=>'inner'),
						array('table'=>'tbl_user','condition'=>'`tbl_user`.`id` = `stylist`.`user_id`','jointype'=>'inner'),
						array('table'=>'tbl_state as user_state','condition'=>'`user_state`.`id` = `tbl_user`.`state`','jointype'=>'inner'),
						array('table'=>'tbl_state','condition'=>'`tbl_state`.`id` = `subscription`.`billing_state`','jointype'=>'inner'),
						);
				$field=array('subscription.*','tbl_user.id as user_id', 'tbl_user.firstname', 'tbl_user.lastname', 'tbl_user.email', 'tbl_user.contactno', 'tbl_user.usertype', 'tbl_user.salon_name', 'tbl_user.status', 'tbl_user.contactno','tbl_state.state_name', 'tbl_state.id as state_id' );
				$data['subscription'] = $this->user_model->get_joins('subscription',$where,$join_s,$field);
				
				$data['getuser'] = $this->user_model->get_joins('tbl_user',$where);
				
				$data['message'] = validation_errors();
			}
			else
			{
				$currentdate=date("Y-m-d H:i:s");
				$updateid=array('id'=>$newid);
				$updatedata=array('firstname'=>$firstname,'lastname'=>$lastname,'email'=>$email,'contactno'=>$contactno,'address1'=>$address_a,'address2'=>$address_b,'city'=>$city,'state'=>$state,'zipcode'=>$zipcode,'status'=>$status,'usertype'=>$usertype, 'salon_name'=>$salon_name,'update_date'=>$currentdate,);
				$isupdate = $this->user_model->UPDATEDATA('tbl_user',$updateid, $updatedata);
				$data['stylist'] = $this->user_model->get_joins('stylist',array('user_id'=>$newid));
				$s_id=$data['stylist'][0]['id'];
				
				$data['subscription']=$this->user_model->get_sql_select_data('subscription', array('s_id'=>$s_id));
				
				if(empty($data['subscription']))
				{
					$currentdate=date("Y-m-d H:i:s");
					$insertdata=array('s_id'=>$s_id, 'subs_type'=>$subs_type, 'plan'=>$packages, 'package'=>$pack_name, 'billing_address'=>$address_a, 'billing_address_b'=>$address_b, 'billing_city'=>$city, 'billing_state'=>$state, 'billing_zipcode'=>$zipcode, 'createdate'=>$currentdate,'update_date'=>$currentdate,);
					$isupdate = $this->user_model->INSERTDATA('subscription',$insertdata);
				}
				else
				{
					$subs_data=array('subs_type'=>$subs_type, 'plan'=>$packages, 'package'=>$pack_name, 'billing_address'=>$address_a, 'billing_address_b'=>$address_b, 'billing_city'=>$city, 'billing_state'=>$state, 'billing_zipcode'=>$zipcode, );
					$update_subs=$this->user_model->UPDATEDATA('subscription',array('s_id'=>$s_id), $subs_data);
				}
				if($isupdate || $update_subs)
				{
					//echo $this->db->last_query();exit('update');
					$this->session->set_flashdata('Logmsg', '<b style="color:green;">Details Updated Successfully</b>');
					redirect(site_url().'admin/viewstylist');
				}
				else
				{
					//echo $this->db->last_query();exit('u Fails');
					$this->session->set_flashdata('Logmsg', '<b style="color:red;">Error Occured ! Details Not Updated</b>');
					redirect(site_url().'admin/viewstylist');
				}
			}
		}
			
			$this->load->view('Admin/update_stylist_view',$data);
	}
	
	//***************************************** 	Edit Stylist Billing info		*************************************************//
	/*
	function editsubscription()
	{
		$data='';
		
		$editid = $this->uri->segment(3); //get_joins
		$where=array('subscription.id'=>$editid);
		
		$data['allstylist']=$this->user_model->get_sql_select_data('tbl_user',array('role_id'=>3));
		$data['states']	=	$this->user_model->get_sql_select_data('tbl_state');
		
		$join_s=array(
				array('table'=>'stylist','condition'=>'`tbl_user`.`id` = `stylist`.`user_id`','jointype'=>'inner'),
				array('table'=>'subscription','condition'=>'`subscription`.`s_id` = `stylist`.`id`','jointype'=>'inner'),
				array('table'=>'tbl_state','condition'=>'`subscription`.`billing_state` = `tbl_state`.`id`','jointype'=>'inner'),
				);
		$field=array('subscription.*','tbl_user.id as user_id', 'tbl_user.firstname', 'tbl_user.lastname','tbl_state.state_name', 'tbl_state.id as state_id' );
		$data['getuser'] = $this->user_model->get_joins('tbl_user',$where,$join_s,$field);
		
		if(isset($_POST["update"]))
		{
			$newid=$this->input->post('subs_id');
		
			$stylistid=$this->input->post('stylist_list');
			$packages=$this->input->post('packages');
			$address_a=ucwords($this->input->post('address_a'));
			$address_b=ucwords($this->input->post('address_b'));
			$city=ucwords($this->input->post('city'));
			$state=$this->input->post('state');
			$zipcode=$this->input->post('zipcode');
			
			$pack_name=ucwords($this->input->post('pack_name'));
			$subs_type=ucwords($this->input->post('subs_type'));
			
			$this->form_validation->set_error_delimiters('<div class="text-error">', '<span class="text-error-close">x</span></div>');
			
			$this->form_validation->set_rules('stylist_list', 'Stylist Name','trim|required');
			$this->form_validation->set_rules('packages', 'Package','trim|required');
			$this->form_validation->set_rules('address_a', 'Address','trim|required');
			$this->form_validation->set_rules('city', 'City','trim|required');
			$this->form_validation->set_rules('state', 'State','trim|required');
			$this->form_validation->set_rules('zipcode', 'Zipcode','trim|required');
			if ($this->form_validation->run() == FALSE)
			{
				$data['message'] = validation_errors();
			}
			else
			{
				$updateid=array('id'=>$newid);
				$updatedata=array('address1'=>$address_a,'address2'=>$address_b,'city'=>$city,'state'=>$state,'zipcode'=>$zipcode);
				$updateid=array('id'=>$stylistid);
				$isupdate = $this->user_model->UPDATEDATA('tbl_user',$updateid, $updatedata);
				if($isupdate)
				{
					//echo $this->db->last_query();exit('update');
					$data['getstylist'] = $this->user_model->get_sql_select_data('stylist',array('user_id'=>$stylistid));
					$s_id=$data['getstylist'][0]['id'];					
					
					$update_data=array('plan'=>$packages, 'package'=>$pack_name, 'subs_type'=>$subs_type, 'billing_address'=>$address_a, 'billing_address_b'=>$address_b, 'billing_city'=>$city, 'billing_state'=>$state, 'billing_zipcode'=>$zipcode);
					$this->user_model->UPDATEDATA('subscription',array('s_id'=>$s_id),$update_data);
					
					$this->session->set_flashdata('Logmsg', '<b style="color:green;">Details Updated Successfully</b>');
					redirect(site_url().'admin/viewsubscription');
				}
				else
				{
					//echo $this->db->last_query();exit('u Fails');
					$this->session->set_flashdata('Logmsg', '<b style="color:red;">Error Occured ! Details Not Updated</b>');
					redirect(site_url().'admin/viewsubscription');
				}
			}
		}
			$this->load->view('Admin/update_subscription_view',$data);
	}
	*/
	
	function clients()
	{
		$s_user_id=$this->uri->segment(3);
		$where	=	array('stylist.user_id'=>$s_user_id);
		$fields=array('stylist.user_id as s_user_id', 'stylist.id as s_id', 'stylist_details.firstname as s_fname',  'stylist_details.lastname as s_lname', 'tbl_user.firstname', 'tbl_user.lastname', 'tbl_user.email', 'tbl_user.contactno', 'tbl_user.gender', 'tbl_user.age', 'client.id as c_id', 'client.photos', 'client.user_id as c_userid', 'client.hair_color', 'client.hair_density', 'tbl_texture.id as texture_id', 'tbl_texture.texture', 'tbl_ethnicity.id as ethnicity_id', 'tbl_ethnicity.ethnicity');
		$join=array(
					array('table'=>'stylist','condition'=>'`stylist`.`id` = `client`.`s_id`','jointype'=>'inner'),
					array('table'=>'tbl_user as stylist_details','condition'=>'`stylist_details`.`id` = `stylist`.`user_id`','jointype'=>'inner'),
					array('table'=>'tbl_user','condition'=>'`tbl_user`.`id` = `client`.`user_id`','jointype'=>'inner'),
					array('table'=>'tbl_ethnicity','condition'=>'`tbl_ethnicity`.`id` = `client`.`ethnicity`','jointype'=>'inner'),
					array('table'=>'tbl_texture','condition'=>'`tbl_texture`.`id` = `client`.`hair_texture`','jointype'=>'inner'),
				);
		$field=array('');
		$data['allclients'] = $this->user_model->get_joins('client',$where,$join,$fields,'','','tbl_user.firstname');

		if(empty($data['allclients']))
		{
			$data['message'] ='<div class="text-error">No Data Found<span class="text-error-close">x</span></div>';
		}
		$this->load->view('Admin/viewclients_view',$data);
	}
	
	
	function featuredimage()
	{
		$s_user_id=$this->uri->segment(3);
		$where	=	array('role_id'=>3,'stylist.user_id'=>$s_user_id,'client_photos.featured'=>1);
		$fields=array('client_photos.*','stylist.user_id','tbl_user.firstname','tbl_user.lastname');
		$join=array(
					array('table'=>'stylist','condition'=>'`stylist`.`id` = `client_photos`.`s_id`','jointype'=>'inner'),
					array('table'=>'tbl_user','condition'=>'`tbl_user`.`id` = `stylist`.`user_id`','jointype'=>'inner'),
				);
		$field=array('');
		$data['allimages'] = $this->user_model->get_joins('client_photos',$where,$join,$fields);
		/*echo"<pre>";
		print_r($data['allimages']);
		exit;*/
		if(empty($data['allimages']))
		{
			$data['message'] ='<div class="text-error">No Data Found<span class="text-error-close">x</span></div>';
		}
		$this->load->view('Admin/viewfeatured',$data);
	}
	
	function publicimages()
	{
		$s_user_id=$this->uri->segment(3);
		$where	=	array('role_id'=>3,'stylist.user_id'=>$s_user_id,'client_photos.public'=>1);
		$fields=array('client_photos.*','stylist.user_id','tbl_user.firstname','tbl_user.lastname');
		$join=array(
					array('table'=>'stylist','condition'=>'`stylist`.`id` = `client_photos`.`s_id`','jointype'=>'inner'),
					array('table'=>'tbl_user','condition'=>'`tbl_user`.`id` = `stylist`.`user_id`','jointype'=>'inner'),
				);
		$field=array('');
		$data['all_p_images'] = $this->user_model->get_joins('client_photos',$where,$join,$fields);
		/*echo"<pre>";
		print_r($data['allimages']);
		exit;*/
		if(empty($data['all_p_images']))
		{
			$data['message'] ='<div class="text-error">No Data Found<span class="text-error-close">x</span></div>';
		}
		$this->load->view('Admin/viewpublic',$data);
	}

	function delete_public()
	{
		if(isset($_POST['delete_public']))
		{
			$del_ids=$this->input->post('del_pic');
			$s_uid=$this->input->post('s_uid');
			if(!empty($del_ids))
			{
				$raw_data='';
				$i=0;
			//	echo"<pre>";
				foreach($del_ids as $ids)
				{
					$raw_data[]=explode('^',$ids);
					$i++;
				}
				//print_r($raw_data);
				foreach($raw_data as $data)
				{
					$where=array('id'=>$data[0]);
					$allimages = $this->user_model->get_joins('client_photos',$where,'','client_photos.photos');
					$images=explode(',',$allimages[0]['photos']);

					$delimg=array('0'=>$data[2]);
					$diff=array_diff($images,$delimg);
					if(count($images)==1)
					{
						$isDel=$this->user_model->DELETEDATA('client_photos',$where);
					}
					else
					{
						$updatedate=array('photos'=>implode(',',$diff));
						$isUpdate=$this->user_model->UPDATEDATA('client_photos',$where,$updatedate);
					}
				//	print_r($diff);
				}
				$this->session->set_flashdata('Logmsg', '<b style="color:green;">Image Deleted Sucessfully. </b>');
				redirect('admin/publicimages/'.$s_uid);
			}
			else
			{
				$this->session->set_flashdata('Logmsg', '<b style="color:red;">Atleast one image is required. </b>');
				redirect('admin/publicimages/'.$s_uid);
			}
		}
		//$this->load->view('Admin/viewpublic',$data);
		
	}

	function delete_featured()
	{
		if(isset($_POST['delete_public']))
		{
			$del_ids=$this->input->post('del_pic');
			$s_uid=$this->input->post('s_uid');
			if(!empty($del_ids))
			{
				$raw_data='';
				$i=0;
			//	echo"<pre>";
				foreach($del_ids as $ids)
				{
					$raw_data[]=explode('^',$ids);
					$i++;
				}
				//print_r($raw_data);
				foreach($raw_data as $data)
				{
					$where=array('id'=>$data[0]);
					$allimages = $this->user_model->get_joins('client_photos',$where,'','client_photos.photos');
					$images=explode(',',$allimages[0]['photos']);

					$delimg=array('0'=>$data[2]);
					$diff=array_diff($images,$delimg);
					if(count($images)==1)
					{
						$isDel=$this->user_model->DELETEDATA('client_photos',$where);
					}
					else
					{
						$updatedate=array('photos'=>implode(',',$diff));
						$isUpdate=$this->user_model->UPDATEDATA('client_photos',$where,$updatedate);
					}
				//	print_r($diff);
				}
				$this->session->set_flashdata('Logmsg', '<b style="color:green;">Image Deleted Sucessfully. </b>');
				redirect('admin/featuredimage/'.$s_uid);
			}
			else
			{
				$this->session->set_flashdata('Logmsg', '<b style="color:red;">Atleast one image is required. </b>');
				redirect('admin/featuredimage/'.$s_uid);
			}
		}
	}

	function _createThumbnails($filename)
	{
		/*	Creating Thumb of 150x150 for viewclient page	*/
		$foldername='./assets/product/thumbnails/150x150/';
		// echo $foldername;exit;
		$this->createDir($foldername);
		
		$this->load->library('image_lib');
		// Set your config up
		$config['new_image']   =   $foldername;
		$config['image_library']    = "gd2";      
		$config['source_image']     = './assets/product/'.$filename;      
		//$config['create_thumb']     = TRUE;      
		$config['overwrite']   = 0;
		$config['maintain_ratio']   = TRUE;
		$config['master_dim'] = 'height';      
		$config['width'] = '150';
		$config['height'] = '150';

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

	function profile()
	{
		$id=$this->session->userdata('id');
		
		$data['profiledata']=$this->user_model->get_joins('tbl_user',array('id'=>$id));
		if(isset($_POST['update']))
		{
			$firstname=ucwords(trim($this->input->post('firstname')));
			$lastname=ucwords(trim($this->input->post('lastname')));
			$email=trim($this->input->post('email'));
			
			$this->form_validation->set_error_delimiters('<div class="text-error">', '<span class="text-error-close">x</span></div>');
			$this->form_validation->set_rules('firstname', 'Firstname', 'trim|required|alpha');
			$this->form_validation->set_rules('lastname', 'Lastname', 'trim|required|alpha');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
			if ($this->form_validation->run() == FALSE)
			{
				$data['message'] = validation_errors();
			}
			else
			{
				$updatedata=array('firstname'=>$firstname,'lastname'=>$lastname,'email'=>$email,);
				$data['profile']=$this->user_model->UPDATEDATA('tbl_user', array('id'=>$id),$updatedata);
				if($data['profile'])
				{
					$data['message'] ='<div class="text-success-wrapper">Profile Updated Successfully<span class="text-success-close">x</span></div>';
				}
				
				//$checkdata=array('email'=>$email,);
				
			}
			
		}
		$this->load->view('Admin/profile_view',$data);
	}

	function avtar()
	{
		$id=$this->session->userdata('id');

		$data['profiledata']=$this->user_model->get_joins('tbl_user',array('id'=>$id));
		if(isset($_POST['update']))
		{
			if (!is_dir('./assets/avtars/thumbnail/113x113/'))
			{
				mkdir('./assets/avtars/thumbnail/113x113/', 0777, true);
			}
			$config['upload_path'] = './assets/avtars/thumbnail/113x113/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload');			
			$this->upload->initialize($config); ///***------
			if( ! $this->upload->do_upload('userfile'))    ///***------userfile
			{
				$this->session->set_flashdata('Logmsg', '<b style="color:red;">'.$this->upload->display_errors().'</b>');
				redirect(site_url().'/admin/avtar');
			}
			else
			{
				$data = array('upload_data' => $this->upload->data());
				//$this->_createThumbnails($data['upload_data']['file_name']);
				$updatedata=array('image'=>$data['upload_data']['file_name']);

				$data['profile']=$this->user_model->UPDATEDATA('tbl_user', array('id'=>$id),$updatedata);
				if($data['profile'])
				{
					$this->session->set_flashdata('Logmsg', '<b style="color:green;">Profile Updated Successfully</b>');
					redirect(site_url().'/admin/avtar');
				}
			}
		}
		$this->load->view('Admin/profile_pic_view',$data);
	}
	
	
		//*******************************************	Add New Resource Category	***********************************************//
	
	function resource_category()
	{
		$data='';
		if(isset($_POST['add']))
		{
			$categoryname=ucwords(trim($this->input->post('category')));
			$categorystatus=$this->input->post('status[]');
		
			$this->form_validation->set_error_delimiters('<div class="text-error">', '<span class="text-error-close">x</span></div>');
			$this->form_validation->set_rules('category', 'Category', 'trim|required');
			$this->form_validation->set_rules('status', 'Status', 'required');

			if ($this->form_validation->run() == FALSE)
			{
				$data['message'] = validation_errors();
			}
			else
			{
				$checkcategory=array('name'=>$categoryname);
				$checkexisting=$this->user_model->get_sql_select_data('resource_category', $checkcategory);
				if(empty($checkexisting))
				{
					$insertdata=array('name'=>$categoryname,'status'=>$categorystatus);
					$isadded=$this->user_model->INSERTDATA('resource_category',$insertdata);
					if($isadded)
					{
						$data['message'] ='<div class="text-success-wrapper">Category Added Successfully<span class="text-success-close">x</span></div>';
					}
					else
					{
						$data['message'] ='<div class="text-error">Error occured Try Again<span class="text-error-close">x</span></div>';
					}
				}
				else
				{
					$data['message'] ='<div class="text-error">Category Already Exists<span class="text-error-close">x</span></div>';
				}
			}
		}
		
		$this->load->view('Admin/add_resource_category_view',$data);
	}

	//******************************************	View Resource Categories		************************************************//
	
	function view_resource_category()
	{
		$data['allcategory'] = $this->user_model->get_sql_select_data('resource_category','','id DESC');
		$this->load->view('Admin/view_resource_category_view',$data);
	}

	//***************************************** 	Delete Categories		*************************************************//
	
	function delete_resource_category()
	{
		$deleteid = $this->uri->segment(3);
		$where=array('id'=>$deleteid);
		$deletecategory = $this->user_model->DELETEDATA('resource_category', $where);
		if($deletecategory)
		{
			$this->session->set_flashdata('Logmsg', '<b style="color:green;">Category Deleted Successfully</b>');
			redirect(site_url().'admin/view_resource_category');
		}
		else
		{
			$this->session->set_flashdata('Logmsg', '<b style="color:Red;">Category Not Deleted </b>');
			redirect(site_url().'admin/view_resource_category');
		}
	}
	

//***************************************** 	Edit Categories		*************************************************//
	
	function edit_resource_category()
	{
		$data='';
		
		$categoryname=ucwords(trim($this->input->post('category')));
		$categorystatus=$this->input->post('status[]');
		
		
		$editid = $this->uri->segment(3);
		$where=array('id'=>$editid);
		
		$data['getcategory'] = $this->user_model->get_sql_select_data('resource_category',$where);
		
		$updatedata=array('name'=>$categoryname,'status'=>$categorystatus,);
		
		//echo"<pre>";print_r($getcategory);exit;
		if(isset($_POST["update"]))
		{
			$newid=$this->input->post('categoryid');
			
			$categoryname=trim($this->input->post('category'));
			$categorystatus=$this->input->post('status[]');
		
			$this->form_validation->set_error_delimiters('<div class="text-error">', '<span class="text-error-close">x</span></div>');
			$this->form_validation->set_rules('category', 'Category', 'trim|required');
			$this->form_validation->set_rules('status', 'Status', 'required');

			if ($this->form_validation->run() == FALSE)
			{
				$data['message'] = validation_errors();
				$data['getcategory'] = $this->user_model->get_sql_select_data('resource_category',array('id'=>$newid));
			}
			else
			{
				$updateid=array('id'=>$newid);
				$isupdate = $this->user_model->UPDATEDATA('resource_category',$updateid, $updatedata);
				if($isupdate)
				{
					//echo $this->db->last_query();exit('update');
					$this->session->set_flashdata('Logmsg', '<b style="color:green;">Category Updated Successfully</b>');
					redirect(site_url().'admin/view_resource_category');
				}
				else
				{
					//echo $this->db->last_query();exit('u Fails');
					$this->session->set_flashdata('Logmsg', '<b style="color:red;">Error Occured ! Category Not Updated</b>');
					redirect(site_url().'admin/resource_category');
				}
			}
		}
			$this->load->view('Admin/update_resource_category_view',$data);
	}
	
			//*******************************************	Add New Resource ***********************************************//
	
	function add_resource()
	{
		$data['allresource_categories']	=	$this->user_model->get_sql_select_data('resource_category',array('status'=>1));
		if(isset($_POST['add']))
		{
			$title=ucwords(trim($this->input->post('title')));
			$resource_type=ucwords(trim($this->input->post('resource_type')));
			$description=ucwords(trim($this->input->post('description')));
			$res_cate_id=ucwords(trim($this->input->post('res_cate_id')));
			
			$status=$this->input->post('status[]');
		
			$this->form_validation->set_error_delimiters('<div class="text-error">', '<span class="text-error-close">x</span></div>');
			$this->form_validation->set_rules('title', 'Title', 'trim|required');
			$this->form_validation->set_rules('res_cate_id', 'Resource Category', 'required');
			$this->form_validation->set_rules('resource_type', 'Resource Type', 'trim|required');
			$this->form_validation->set_rules('status', 'Status', 'required');
			//$this->form_validation->set_rules('userfile', 'dd', 'required');

			if ($this->form_validation->run() == FALSE)
			{
				$data['message'] = validation_errors();
				$data['allresource_categories']	=	$this->user_model->get_sql_select_data('resource_category',array('status'=>1));
			}
			else
			{
				if (!is_dir('./assets/resources/'.$resource_type))
				{
					mkdir('./assets/resources/'.$resource_type, 0777, true);
				}
				$config['upload_path'] = './assets/resources/'.$resource_type;
				$config['allowed_types'] = '*';
				$this->load->library('upload');			
				$this->upload->initialize($config); ///***------
				if( ! $this->upload->do_upload('userfile'))    ///***------userfile
				{

					$data['message'] ='<div class="text-error">'.$this->upload->display_errors().'<span class="text-error-close">x</span></div>';
				}
				else
				{
					$data = array('upload_data' => $this->upload->data());
				
					//$data = array('upload_data' => $this->upload->data());
					$insertdata=array('title'=>$title,'description'=>$description,'res_cate_id'=>$res_cate_id,'resource_type'=>$resource_type,'resource_file'=>$data['upload_data']['file_name'],'status'=>$status,'createdon'=>date('Y-m-d H:i:s'));
					$isadded=$this->user_model->INSERTDATA('resource',$insertdata);
					if($isadded)
					{
						$this->session->set_flashdata('Logmsg', '<b style="color:green;dipslay:block">Resource Added Successfully</b>');
						redirect(site_url().'admin/add_resource');
						//$data['message'] ='<div class="text-success-wrapper"><b style="color:green;">Resource Added Successfully</b><span class="text-success-close">x</span></div>';
					}
					else
					{
						$data['message'] ='<div class="text-error">Error occured Try Again<span class="text-error-close">x</span></div>';
					}
				}
				
			}
		}
		
		$this->load->view('Admin/add_resource_view',$data);
	}

	
	//******************************************	View All Resource 	************************************************//
	
	function resources()
	{
		$data['allresources'] = $this->user_model->get_sql_select_data('resource','','id DESC');
		$this->load->view('Admin/view_resources',$data);
	}
	

	//***************************************** 	Delete Categories		*************************************************//
	
	function delete_resources()
	{
		$deleteid = $this->uri->segment(3);
		$where=array('id'=>$deleteid);
		$deleteresource = $this->user_model->DELETEDATA('resource', $where);
		if($deleteresource)
		{
			$this->session->set_flashdata('Logmsg', '<b style="color:green;">Resource Deleted Successfully</b>');
			redirect(site_url().'admin/resources');
		}
		else
		{
			$this->session->set_flashdata('Logmsg', '<b style="color:Red;">Resource Not Deleted </b>');
			redirect(site_url().'admin/resources');
		}
	}
	

	//***************************************** 	Edit Brand		*************************************************//
	
	function editresource()
	{
		$data='';
		
		$title=ucwords(trim($this->input->post('title')));
		$description=ucwords(trim($this->input->post('description')));
		$res_cate_id=ucwords(trim($this->input->post('res_cate_id')));
		$resource_type=ucwords(trim($this->input->post('resource_type')));
		$old_resource=$this->input->post('old_resource');
		$status=$this->input->post('status');
		
		
		$editid = $this->uri->segment(3);
		$where=array('id'=>$editid);
		
		$data['getresource'] = $this->user_model->get_sql_select_data('resource',$where);
		$data['allresource_cate'] = $this->user_model->get_sql_select_data('resource_category');
		
		
		
		//echo"<pre>";print_r($getcategory);exit;
		if(isset($_POST["update"]))
		{
			$newid=$this->input->post('resourceid');
			$title=trim($this->input->post('title'));
			$status=$this->input->post('status');
		    $this->form_validation->set_error_delimiters('<div class="text-error">', '<span class="text-error-close">x</span></div>');
			$this->form_validation->set_rules('title', 'Title', 'trim|required');
			$this->form_validation->set_rules('status', 'Status', 'required');

			if ($this->form_validation->run() == FALSE)
			{
				$data['message'] = validation_errors();
				$data['allresource_cate'] = $this->user_model->get_sql_select_data('resource_category');
				$data['getresource'] = $this->user_model->get_sql_select_data('resource',array('id'=>$newid));
			}
			else
			{
				if (!is_dir('./assets/resources/'.$resource_type))
				{
					mkdir('./assets/resources/'.$resource_type, 0777, true);
				}
					$config['upload_path'] = './assets/resources/'.$resource_type;
					$config['allowed_types'] = '*';
					$this->load->library('upload');			
					$this->upload->initialize($config); ///***------

if( ! $this->upload->do_upload('userfile'))    ///***------userfile
				{
					$data['message'] = array('error' => $this->upload->display_errors());
				}
				
				$data = array('upload_data' => $this->upload->data());

if(empty($data['upload_data']['file_name']))
{
	$userfile=$old_resource;
	//echo "empty";
}
else
{
	$userfile=$data['upload_data']['file_name'];
	//echo "not empty";
}

                $updateid=array('id'=>$newid);
				$updatedata=array('title'=>$title,'description'=>$description,'resource_type'=>$resource_type,'res_cate_id'=>$res_cate_id,'status'=>$status,'resource_file'=>$userfile);
				$isupdate = $this->user_model->UPDATEDATA('resource',$updateid, $updatedata);
				if($isupdate)
				{
					//echo $this->db->last_query();exit('update');
					$this->session->set_flashdata('Logmsg', '<b style="color:green;">Resource Updated Successfully</b>');
					redirect(site_url().'admin/resources');
				}
				else
				{
					//echo $this->db->last_query();exit('u Fails');
					$this->session->set_flashdata('Logmsg', '<b style="color:red;">Error Occured ! Resource Not Updated</b>');
					redirect(site_url().'admin/editresource'.$newid);
				}
			}
		}

			$this->load->view('Admin/update_resource_view',$data);
	}
	
	
}

