<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'libraries/REST_Controller.php';

class Webservice extends REST_Controller
{
	
	/*User Registrations*/
	
	function visa_get()
	{
		$firstname=ucwords(trim($this->get('firstname')));
		$lastname=ucwords(trim($this->get('lastname')));
		$email=trim($this->get('email'));
		$contactno=trim($this->get('contactno'));
		$t_journey_date=$this->get('t_journey_date');
		$country_from=$this->get('country_from');
		$image=$this->get('image');
		
		$this->form_validation->set_data(array(
									'firstname'=>$firstname,
									'lastname'=>$lastname,
									'email'=>$email,
									'contactno'=>$contactno,
									't_journey_date'=>$t_journey_date,
									'country_from'=>$country_from
									));
		if($this->form_validation->run('visa_get')!==false)
		{
			$chk_user=array('firstname'=>$firstname,'lastname'=>$lastname,'email'=>$email);
			
			/*
			$is_exists=$this->user_model->get_joins('visaform',$chk_user);
			if(empty($is_exists))
			{*/
				$insertdata=array(
									'firstname'=>$firstname,
									'lastname'=>$lastname,
									'email'=>$email,
									'contactno'=>$contactno,
									't_journey_date'=>$t_journey_date,
									'country_from'=>$country_from,
									'image'=>$image,
									'createdate'=>date('Y-m-d h:i:s')
								);
				$is_insert=$this->user_model->INSERTDATA('visaform',$insertdata);
				if($is_insert)
				{
					$country=$this->user_model->get_joins('tbl_countries',array('country_code'=>$country_from),'',array('country_name'));
					$html='<table>
						<tr>
							<td>Name</td>
							<td>'.$firstname.' '.$lastname.'</td>
						</tr>
						<tr>
							<td>Email</td>
							<td>'.$email.'</td>
						</tr>
						<tr>
							<td>Contact No</td>
							<td>'.$contactno.'</td>
						</tr>
						<tr>
							<td>Tentative Journey Date</td>
							<td>'.$t_journey_date.'</td>
						</tr>
						<tr>
							<td>Country From</td>
							<td>'.$country[0]['country_name'].'</td>
						</tr>						
					</table>';
										
					// Always set content-type when sending HTML email
					$headers = "MIME-Version: 1.0" . "\r\n";
					$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

					// More headers
					$headers .= 'From: <'.$email.'>' . "\r\n";
					//$headers .= 'Cc: myboss@example.com' . "\r\n";

					mail('bharat.prajapat@newtechfusion.com','Visa Form Submission by '.$firstname.' '.$lastname.'',$html,$headers);
					$this->response(array('status'=>'true','message'=>'Thank you for Submission'));

				}
				else
				{
					$this->response(array('status'=>'false','message'=>'Error Occured '),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
				}
				/*
			}
			else
			{
				$this->response(array('status'=>'false','message'=>'User Already Exists'),REST_Controller::HTTP_BAD_REQUEST);
			}*/
		}
		else
		{
			$this->response(array('status'=>'false','message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
		}
	}

	
	/*User Contact*/
	
	function contact_get()
	{
		$name=ucwords($this->get('name'));
		$email=$this->get('email');
		$contactno=$this->get('contactno');
		$message=$this->get('message');
		
		$this->form_validation->set_data(array(
									'name'=>$name,
									'email'=>$email,
									'contactno'=>$contactno,
									'message'=>$message,
									));
		if($this->form_validation->run('contact_get')!==false)
		{
			/*
			$chk_user=array('name'=>$name,'email'=>$email,'contactno'=>$contactno);
			
			$is_exists=$this->user_model->get_joins('contactform',$chk_user);
			if(empty($is_exists))
			{*/
				$insertdata=array(
									'name'=>$name,
									'email'=>$email,
									'contactno'=>$contactno,
									'message'=>$message,
									'createdate'=>date('Y-m-d h:i:s')
								);
				$is_insert=$this->user_model->INSERTDATA('contactform',$insertdata);
				if($is_insert)
				{
					$html='<table>
						<tr>
							<td>Name</td>
							<td>'.$name.'</td>
						</tr>
						<tr>
							<td>Email</td>
							<td>'.$email.'</td>
						</tr>
						<tr>
							<td>Contact No</td>
							<td>'.$contactno.'</td>
						</tr>
						<tr>
							<td>Message</td>
							<td>'.$message.'</td>
						</tr>					
					</table>';
										
					// Always set content-type when sending HTML email
					$headers = "MIME-Version: 1.0" . "\r\n";
					$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

					// More headers
					$headers .= 'From: <'.$email.'>' . "\r\n";
					//$headers .= 'Cc: myboss@example.com' . "\r\n";

					mail('bharat.prajapat@newtechfusion.com','Contact Form Submission by '.$name.'',$html,$headers);
					$this->response(array('status'=>'true','message'=>'Thank you for contacting us.'));
				}
				else
				{
					$this->response(array('status'=>'false','message'=>'Error Occured '),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
				}
				/*
			}
			else
			{
				$this->response(array('status'=>'false','message'=>'User Already Exists'),REST_Controller::HTTP_BAD_REQUEST);
			}*/
		}
		else
		{
			$this->response(array('status'=>'false','message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
		}
	}
	
	
	/*User Contact*/
	
	function request_get()
	{
		$name=ucwords($this->get('name'));
		$email=$this->get('email');
		$contactno=$this->get('contactno');
		$country=$this->get('country');
		
		$this->form_validation->set_data(array(
									'name'=>$name,
									'email'=>$email,
									'contactno'=>$contactno,
									'country'=>$country,
									));
		if($this->form_validation->run('request_get')!==false)
		{
			/*
			$chk_user=array('name'=>$name,'email'=>$email,'contactno'=>$contactno);
			
			$is_exists=$this->user_model->get_joins('requestform',$chk_user);
			if(empty($is_exists))
			{*/
				$insertdata=array(
									'name'=>$name,
									'email'=>$email,
									'contactno'=>$contactno,
									'country'=>$country,
									'createdate'=>date('Y-m-d h:i:s')
								);
				$is_insert=$this->user_model->INSERTDATA('requestform',$insertdata);
				if($is_insert)
				{
					
					$country=$this->user_model->get_joins('tbl_countries',array('country_code'=>$country),'',array('country_name'));
					
					$html='<table>
						<tr>
							<td>Name</td>
							<td>'.$name.'</td>
						</tr>
						<tr>
							<td>Email</td>
							<td>'.$email.'</td>
						</tr>
						<tr>
							<td>Contact No</td>
							<td>'.$contactno.'</td>
						</tr>
						<tr>
							<td>Country</td>
							<td>'.$country[0]['country_name'].'</td>
						</tr>					
					</table>';
								
					// Always set content-type when sending HTML email
					$headers = "MIME-Version: 1.0" . "\r\n";
					$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

					// More headers
					$headers .= 'From: <'.$email.'>' . "\r\n";
					//$headers .= 'Cc: myboss@example.com' . "\r\n";

					mail('bharat.prajapat@newtechfusion.com','Contact Form Submission by '.$name.'',$html,$headers);
					
					$this->response(array('status'=>'true','message'=>'Thank you for Submission.'));
				}
				else
				{
					$this->response(array('status'=>'false','message'=>'Error Occured '),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
				}
				/*
			}
			else
			{
				$this->response(array('status'=>'false','message'=>'User Already Exists'),REST_Controller::HTTP_BAD_REQUEST);
			}*/
		}
		else
		{
			$this->response(array('status'=>'false','message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
		}
	}
	
	
	/* Get all Countries */
	
	function countries_get()
	{
		$fields=array('country_code','country_name');
		$countries=$this->user_model->get_joins('tbl_countries','','',$fields);
		if(empty($countries))
		{
			$this->response(array('status'=>'false','message'=>array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
		}
		else
		{
			$this->response(array('status'=>'true','message'=>$countries));
		}
	}
	
	
	
	function image_get()
	{
		$name=$this->get('name');
		$image=$this->get('image');
		$image2=urldecode($this->get('image'));
		$this->form_validation->set_data(array('name'=>$name,'image'=>$image));
		if($this->form_validation->run('image_get')!==false)
		{
			$insertdata=array(
									'firstname'=>'bharat',
									'lastname'=>'prajapat',
									'email'=>'bharat@imagetest.com',
									'contactno'=>'9632587410',
									'image'=>$image,
									'image2'=>$image2,
									'reg_date'=>date('Y-m-d h:i:s')
								);
				$is_insert=$this->user_model->INSERTDATA('registration',$insertdata);
				if($is_insert)
				{
/*					$imageData = base64_decode($image);
$source = imagecreatefromstring($imageData);
$rotate = imagerotate($source, $angle, 0); // if want to rotate the image
$imageSave = imagejpeg($rotate,$imageName,100);
imagedestroy($source);
*/
					$this->response(array('status'=>'true','message'=>'Registration Successfull'));
				}
				else
				{
					$this->response(array('status'=>'false','message'=>'Error Occured '),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
				}
			
		}
		else
		{
			$this->response(array('status'=>'false','message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
		}
	}
	
	/*Post Method*/
	function image_post()
	{
		$name=$this->post('name');
		$image=$this->post('image');
		$imgnames[]=$this->post('imgnames');
		$image2=urldecode($this->post('image'));
		$this->form_validation->set_data(array('name'=>$name,'image'=>$image));
		if($this->form_validation->run('image_get')!==false)
		{
			$insertdata=array(
									'firstname'=>'bharat',
									'lastname'=>'prajapat',
									'email'=>'bharat@imagetest.com',
									'contactno'=>'9632587410',
									'image'=>$image,
									'image2'=>$image2,
									'reg_date'=>date('Y-m-d h:i:s')
								);
				
				
				$is_insert=$this->user_model->INSERTDATA('registration',$insertdata);
				
				if($is_insert)
				{
			
			
			if(!empty($imgnames))
				{
					foreach($imgnames as $imagename)
					{
						print_r($imgnames);
			
					}
				}
			exit;
/*					$imageData = base64_decode($image);
$source = imagecreatefromstring($imageData);
$rotate = imagerotate($source, $angle, 0); // if want to rotate the image
$imageSave = imagejpeg($rotate,$imageName,100);
imagedestroy($source);
*/
					$this->response(array('status'=>'true','message'=>'Registration Successfull'));
				}
				else
				{
					$this->response(array('status'=>'false','message'=>'Error Occured '),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
				}
			
		}
		else
		{
			$this->response(array('status'=>'false','message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
		}
	}
	
}
