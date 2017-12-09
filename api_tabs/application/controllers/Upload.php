<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{

	//echo $_FILES['image']['name'] . '<br/>';


	//ini_set('upload_max_filesize', '10M');
	//ini_set('post_max_size', '10M');
	//ini_set('max_input_time', 300);
	//ini_set('max_execution_time', 300);


	$target_path = "uploads/";

	if (!is_dir($target_path))
	{
		mkdir($target_path, 0777, true);
	}
	$target_path = $target_path . basename($_FILES['image']['name']);

	try
	{
		/*
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload');			
			$this->upload->initialize($config); ///***------
			if( ! $this->upload->do_upload('image'))    ///***------userfile
			{
				$data = array('error' => $this->upload->display_errors());
			//	$this->load->view('profile_mentor');
			}
		
			$data = array('upload_data' => $this->upload->data());
		*/
		
		//throw exception if can't move the file
		if (!move_uploaded_file($_FILES['image']['tmp_name'], $target_path))
		{
			throw new Exception('Could not move file');
		}

		echo "The file " . basename($_FILES['image']['name']) .
		" has been uploaded";
		
		
	}
	catch (Exception $e)
	{
		die('File did not upload: ' . $e->getMessage());
	}

		$this->load->view('fileUpload');
	}
}
