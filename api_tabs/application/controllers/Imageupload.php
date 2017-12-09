<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Imageupload extends CI_Controller {

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
		if($_SERVER['REQUEST_METHOD']=='POST')
		{
 
			 $image = $_POST['image'];
			 
			define('HOST','localhost');
			define('USER','root');
			define('PASS','');
			define('DB','app_tabs_db');
			 
			 $con = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect');
			 
			 
			 $sql = "INSERT INTO images (image) VALUES (?)";
			 
			 $stmt = mysqli_prepare($con,$sql);
			 
			 mysqli_stmt_bind_param($stmt,"s",$image);
			 mysqli_stmt_execute($stmt);
			 
			 $check = mysqli_stmt_affected_rows($stmt);
			 
			 if($check == 1)
			 {
				echo "Image Uploaded Successfully";
			 }
			 else
			 {
				echo "Error Uploading Image";
			 }
				mysqli_close($con);
		}
		else
		{
			echo "Error";
		}
	}
	
	function upload()
	{
		$this->load->view('testupload');
	}
	
	function android_image()
	{
		$name=$_POST['name'];
		$image=$_POST['image'];
		$decodeImage=base64_decode("$image");
		
		//$rand_no =  date('Y-m-d H-i-s');
		$rand_no =  microtime();
		$rand_no = str_replace(' ', '', $rand_no);
		$foldername="./assets/android/";
		if (!is_dir($foldername))
		{
			mkdir($foldername, 0777, true);
		}
		
		$isfile=file_put_contents("$foldername".$rand_no.".jpg",$decodeImage);
		if($isfile)
		{
			//echo "ok";
			$insertdata=array(
									'firstname'=>$name,
									'lastname'=>$name,
									'email'=>'bharat@'.$name.'.com',
									'contactno'=>'123456',
									'image'=>$image,
									'reg_date'=>date('Y-m-d h:i:s')
								);
				
				
				$is_insert=$this->user_model->INSERTDATA('registration',$insertdata);
				
				if($is_insert)
				{
					$this->response(array('status'=>'true','message'=>'Inserted'));
					echo"Inserted";
				}
				else
				{
					$this->response(array('status'=>'true','message'=>'Not Inserted'));
					echo"Not Inserted";
				}
		}
		else
		{
			$this->response(array('status'=>'true','message'=>'invalid file'));
			echo "not";
		}
	}
}
