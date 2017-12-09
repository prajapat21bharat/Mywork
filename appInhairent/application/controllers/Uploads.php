<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Uploads extends CI_Controller {
	
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
	
	

	//**************************************	Upload Image		********************************************//
	
	function index()
	{
		//exit('helo');
		$data='';
		if(isset($_POST['upload']))
		{
			if (!is_dir('./assets/avtars/'))
			{
				mkdir('./assets/avtars/', 0777, true);
			}
			$config['upload_path'] = './assets/avtars/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['overwrite'] = 0;
			
			$this->load->library('upload',$config);			
			$this->upload->initialize($config); ///***------
			if( ! $this->upload->do_upload('pic'))    ///***------userfile
			{
				$data = array('error' => $this->upload->display_errors());
			}
			
			$data = array('upload_data' => $this->upload->data());
			
			$path=$data['upload_data']['full_path'];
			$imagename=$data['upload_data']['file_name'];
			
			$this->_createThumbnails($imagename);
			
				
			$file_name=$data['upload_data']['file_name'];
				
			//echo"<pre>";print_r($data); exit;
			if(!empty($file_name))
			{
				$updatedata=array(
									'image'=>$file_name,
								);
				$where_id=array('id'=>$this->session->userdata('id'));
			
					$isadded = $this->user_model->UPDATEDATA('tbl_user',$where_id, $updatedata);
					if($isadded)
					{
						if($this->session->userdata('role_id')==3)
						{
							$this->session->set_flashdata('imageMsg', '<b style="color:green;">Profile Updated Successfully</b>');
							redirect(site_url().'stylist/viewprofile');
						}
						if($this->session->userdata('role_id')==2)
						{
							$this->session->set_flashdata('Logmsg', '<b style="color:green;">Profile Updated Successfully</b>');
							redirect(site_url().'/admin/profile');
						}
					}
					else
					{
						if($this->session->userdata('role_id')==3)
						{
							$this->session->set_flashdata('imageMsg', '<b style="color:red;">Please Try Again</b>');
							redirect(site_url().'stylist/viewprofile');
						}
						if($this->session->userdata('role_id')==2)
						{
							$this->session->set_flashdata('Logmsg', '<b style="color:red;">Please Try Again</b>');
							redirect(site_url().'/admin/profile');
						}
					}
			}
			else
			{
				if($this->session->userdata('role_id')==3)
				{
					$this->session->set_flashdata('imageMsg', '<b style="color:red;"> Please Select an Image</b>');
					redirect(site_url().'stylist/viewprofile');
				}
				if($this->session->userdata('role_id')==2)
				{
					$this->session->set_flashdata('Logmsg', '<b style="color:red;"> Please Select an Image </b>');
					redirect(site_url().'changepassword');
				}
			}
		}
		$this->load->view('Common/changepassord_view',$data);
	}



	
      /********************************* Create image Thumbnails ****************************/
      	
	function _createThumbnails($filename)
	{
		/*	Creating Thumb of 600x600	*/
		$foldername='./assets/avtars/thumbnail/113x113/';
		// echo $foldername;exit;
		$this->createDir($foldername);
		
		$this->load->library('image_lib');
		// Set your config up
		$config['new_image']   =   $foldername;
		$config['image_library']    = "gd2";      
		$config['source_image']     = './assets/avtars/'.$filename;      
		//$config['create_thumb']     = TRUE;      
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
}
