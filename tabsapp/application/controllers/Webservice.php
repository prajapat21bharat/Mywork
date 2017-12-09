<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'libraries/REST_Controller.php';

class Webservice extends REST_Controller
{
	
	
	/*	1.	User Registrations*/
	/*
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
			
		}
		else
		{
			$this->response(array('status'=>'false','message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
		}
	}
*/
	
	/*	2.	User Contact*/
	
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
	
	
	/*	3.	User Contact*/
	
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

					mail('bharat.prajapat@newtechfusion.com','Request Form Submission by '.$name.'',$html,$headers);
					
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
	
	
	/*	4.	Get all Countries */
	
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
	
	/*	5.	User Registration */
	
	function register_get()
	{
		$firstname=ucwords(trim($this->get('firstname')));
		$lastname=ucwords(trim($this->get('lastname')));
		$email=trim($this->get('email'));
		$contactno=trim($this->get('contactno'));
		$password=md5(trim($this->get('password')));
		$this->form_validation->set_data(array(
									'firstname'=>$firstname,
									'lastname'=>$lastname,
									'email'=>$email,
									'contactno'=>$contactno,
									'password'=>$password,
									));
		if($this->form_validation->run('register_get')!==false)
		{
			$chk_user=array('contactno'=>$contactno);

			$is_exists=$this->user_model->get_joins('tbl_users',$chk_user);
			if(empty($is_exists))
			{
				$insertdata=array(
									'r_id'=>1,
									'firstname'=>$firstname,
									'lastname'=>$lastname,
									'email'=>$email,
									'contactno'=>$contactno,
									'password'=>$password,
									'registarationdate'=>date('Y-m-d h:i:s')
								);
				$is_insert=$this->user_model->INSERTDATA('tbl_users',$insertdata);
				if($is_insert)
				{
					$country=$this->user_model->get_joins('tbl_countries',array('country_code'=>$country_from),'',array('country_name'));
					$this->response(array('status'=>'true','message'=>'Registration Successfull'));

				}
				else
				{
					$this->response(array('status'=>'false','message'=>'Error Occured '),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
				}
			}
			else
			{
				$this->response(array('status'=>'false','message'=>'User Already Exists'),REST_Controller::HTTP_BAD_REQUEST);
			}
		}
		else
		{
			$this->response(array('status'=>'false','message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
		}
	}
	
	
	/*	6.	Get All Menus */
	
	function menus_get()
	{
		$menus=$this->user_model->get_joins('tbl_menu');
		if(empty($menus))
		{
			$this->response(array('status'=>'false','message'=>array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
		}
		else
		{
			$this->response(array('status'=>'true','message'=>$menus));
		}
	}
	
	
	/*	7.	Get Contents by menu id */
	
	function content_get()
	{
		$mid=$this->get('mid');
		$page=$this->get('page');
		$menus=$this->user_model->get_joins('tbl_menu');
				
		$this->form_validation->set_data(array('mid'=>$mid));
		if($this->form_validation->run('content_get')!==false)
		{
			if($page=='')
			{
				$page=0;
			}
			else
			{
				$page=$page*5-5;
			}
			
			$joins=array(
						array('table'=>'tbl_menu','condition'=>'`tbl_menu`.`id` = `content`.`mid`','jointype'=>'inner'),
					);
			$fields=array('content.id','mid','title','content');
			$contents=$this->user_model->get_joins('content',array('mid'=>$mid),$joins,$fields,'','','','5' ,$page);
			//$contents=$this->user_model->get_joins('content',array('mid'=>$mid),$joins,$fields,'','','');
			//echo $this->db->last_query();
			//exit;
			if(empty($contents))
			{
				$this->response(array('status'=>'false','message'=>array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
			}
			else
			{
				$this->response(array('status'=>'true','message'=>$contents));
			}
		}
		else
		{
			$this->response(array('status'=>'false','message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
		}
	}
	
	/*	8.	*/
	
	function login_get()
	{
		$contactno=$this->get('contactno');
		$password=md5(trim($this->get('password')));
		$this->form_validation->set_data(array('contactno'=>$contactno, 'password'=>$password,));
		if($this->form_validation->run('login_get')!==false)
		{
			$isuser=$this->user_model->get_joins('tbl_users',array('contactno'=>$contactno, 'password'=>$password));
			if(empty($isuser))
			{
				$this->response(array('status'=>'false','message'=>array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
			}
			else
			{
				//print_r($isuser);exit;
				$this->response(array('status'=>'true','message'=>$isuser));
			}
		}
		else
		{
			$this->response(array('status'=>'false','message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
		}
		
	}
	
	
	
	/*	9.	test image upload*/
	function visa_post()
	{
		$firstname=ucwords($_POST['firstname']);
		$lastname=ucwords($_POST['lastname']);
		$email=$_POST['email'];
		$contactno=$_POST['contactno'];
		$t_journey_date=$_POST['t_journey_date'];
		$country_from=$_POST['country_from'];
		$image=$_POST['image'];
		$decodeImage=base64_decode("$image");
		
		//$rand_no =  date('Y-m-d H-i-s');
			$rand_no =  microtime();
			$rand_no = str_replace(' ', '', $rand_no);
			$foldername="./assets/androids/uploads/";
			if (!is_dir($foldername))
			{
				mkdir($foldername, 0777, true);
			}
		
		$isfile=file_put_contents("$foldername".$rand_no.".jpg",$decodeImage);
		$this->form_validation->set_data(array(
									'firstname'=>$firstname,
									'lastname'=>$lastname,
									'email'=>$email,
									'contactno'=>$contactno,
									't_journey_date'=>$t_journey_date,
									'country_from'=>$country_from
									));
		if($this->form_validation->run('visa_post')!==false)
		{
			//echo "ok";
			
			$visaformdata=array(
									'firstname'=>$firstname,
									'lastname'=>$lastname,
									'email'=>$email,
									'contactno'=>$contactno,
									't_journey_date'=>$t_journey_date,
									'country_from'=>$country_from,
									'createdate'=>date('Y-m-d h:i:s')
								);
								
			$insertdata=array(
								'firstname'=>$firstname,
								'lastname'=>$lastname,
								'email'=>$email,
								'contactno'=>$contactno,
								'image'=>$image,
								'reg_date'=>date('Y-m-d h:i:s')
							);
				
				$imagedata=array(
								'contactno'=>$contactno,
								'image'=>$rand_no.".jpg",
								'base64image'=>$image,
								'date'=>date('Y-m-d h:i:s')
							);
				$is_insert=$this->user_model->INSERTDATA('visaform',$visaformdata);
				$is_imageinsert=$this->user_model->INSERTDATA('visaform_images',$imagedata);
				
				//$is_inserrt=$this->user_model->INSERTDATA('registration',$insertdata);
				
				if($is_insert)
				{
					$this->response(array('status'=>'true','message'=>'Thank you for Submission'));
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
	
	
	
	function sendmail_post()
	{
		//	date_default_timezone_set("Asia/Bangkok");
			
		$contactno=$_POST['contactno'];
		$count=$_POST['count'];
		
		$is_insert=$this->user_model->INSERTDATA('test',array('contact'=>$contactno,'count'=>$count));
		/*		
		if($is_insert)
		{
			$this->response(array('status'=>'true','message'=>'OK Inserted'));
		}
		else
		{
			$this->response(array('status'=>'true','message'=>'Not Inserted'));
		}
		*/
		
		
		$this->form_validation->set_data(array('contactno'=>$contactno));
		if($this->form_validation->run('sendmail_get')!==false)
		{
			//$fields=array('visaform.firstname, visaform.lastname, visaform.email, visaform.contactno, visaform.t_journey_date, visaform.country_from, visaform_images.image');
			$joins=array(
						array('table'=>'visaform','condition'=>'`visaform`.`contactno` = `visaform_images`.`contactno`','jointype'=>'inner'),
					);
			$fields=array('visaform.firstname', 'visaform.lastname',  'visaform.email',  'visaform.contactno', 'visaform.t_journey_date', 'visaform.country_from', 'visaform_images.image', );
			$isuser=$this->user_model->get_joins('visaform_images',array('visaform_images.contactno'=>$contactno),$joins,$fields,'','visaform_images.image','visaform_images.id DESC',$count);
			//echo $this->db->last_query();exit;
			if(empty($isuser))
			{
				$this->response(array('status'=>'false','message'=>array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
			}
			else
			{
				$country=$this->user_model->get_joins('tbl_countries',array('country_code'=>$isuser[0]['country_from']),'',array('country_name'));
					$html='<table>
						<tr>
							<td>Name</td>
							<td>'.$isuser[0]['firstname'].' '.$isuser[0]['lastname'].'</td>
						</tr>
						<tr>
							<td>Email</td>
							<td>'.$isuser[0]['email'].'</td>
						</tr>
						<tr>
							<td>Contact No</td>
							<td>'.$isuser[0]['contactno'].'</td>
						</tr>
						<tr>
							<td>Tentative Journey Date</td>
							<td>'.$isuser[0]['t_journey_date'].'</td>
						</tr>
						<tr>
							<td>Country From</td>
							<td>'.$country[0]['country_name'].'</td>
						</tr>
					</table>';
					$files='';
						foreach($isuser as $userfile)				
							{
								$basepath=base_url('/assets/androids/uploads/');
								$html.="<img src='$basepath.$userfile[image]'/>";
								///print_r($userfile);
								
								$files[]=$userfile['image'];
							}
				$this->multi_attach_mail('bharat.prajapat@newtechfusion.com','Visa Form Submission by '.$isuser[0]['firstname'].' '.$isuser[0]['lastname'].'',$html,$isuser[0]['email'],$isuser[0]['firstname'].' '.$isuser[0]['lastname'],$files);
				
				/*
										
					// Always set content-type when sending HTML email
					$headers = "MIME-Version: 1.0" . "\r\n";
					$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

					// More headers
					$headers .= 'From: <'.$isuser[0]['email'].'>' . "\r\n";
					//$headers .= 'Cc: myboss@example.com' . "\r\n";

					mail('bharat.prajapat@newtechfusion.com','Visa Form Submission by '.$isuser[0]['firstname'].' '.$isuser[0]['lastname'].'',$html,$headers);
					
					$this->response(array('status'=>'true','message'=>$isuser));
					*/
			}
		}
		else
		{
			$this->response(array('status'=>'false','message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
		}
	}
	
	
	// /*	Mail with attachment	*/
	
	function multi_attach_mail($to, $subject, $message, $senderMail, $senderName, $files)
	{

		$base_url=base_url();
		$dirname=getcwd();

		$from = $senderName." <".$senderMail.">"; 
		$headers = "From: $from";

		// boundary 
		$semi_rand = md5(time()); 
		$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 

		// headers for attachment 
		$headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 

		// multipart boundary 
		$message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" .
		"Content-Transfer-Encoding: 7bit\n\n" . $message . "\n\n"; 

		// preparing attachments
		if(count($files) > 0)
		{
			
			for($i=0;$i<count($files);$i++)
			{
				/*if(is_file($files[$i]))
				{*/
					
					$message .= "--{$mime_boundary}\n";
					$fp =    @fopen($dirname.'/assets/androids/uploads/'.$files[$i],"rb");
					$data =  @fread($fp,filesize($dirname.'/assets/androids/uploads/'.$files[$i]));
					@fclose($fp);
					print_r($fp);
					$data = chunk_split(base64_encode($data));
					$message .= "Content-Type: image/jpg; name=\"".$files[$i]."\"\n" . 
					"Content-Description: ".$files[$i]."\n" .
					"Content-Disposition: attachment;\n" . " filename=\"".$files[$i]."\"; size=".filesize($dirname.'/assets/androids/uploads/'.$files[$i]).";\n" . 
					"Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
				//}
			}
		}
		//print_r($message);exit;
		$message .= "--{$mime_boundary}--";
		$returnpath = "-f" . $senderMail;
		
		//send email
		$mail = @mail($to, $subject, $message, $headers, $returnpath); 
		//function return true, if email sent, otherwise return fasle
		if($mail)
		{
			$this->response(array('status'=>'true','message'=>'Sent Ok'));
		}
		else
		{
			$this->response(array('status'=>'true','message'=>'Not Sent'));
		}
	}
	
	function slider_get()
	{
		$images=$this->user_model->get_joins('tbl_slider');
		if(empty($images))
		{
			$this->response(array('status'=>'false','message'=>array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
		}
		else
		{
			$this->response(array('status'=>'true','message'=>$images));
		}
	}

	
	function visainsert_post()
	{
		$firstname=ucwords(trim($this->get('firstname')));
		$lastname=ucwords(trim($this->get('lastname')));
		$email=trim($this->get('email'));
		$contactno=trim($this->get('contactno'));
		$t_journey_date=$this->get('t_journey_date');
		$country_from=$this->get('country_from');
		
		$image=$this->get('image');
		$decodeImage=base64_decode("$image");
				
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
			
				$insertdata=array(
									'firstname'=>$firstname,
									'lastname'=>$lastname,
									'email'=>$email,
									'contactno'=>$contactno,
									't_journey_date'=>$t_journey_date,
									'country_from'=>$country_from,
									'reg_date'=>date('Y-m-d h:i:s')
								);
				$rand_no =  microtime();
				$rand_no = str_replace(' ', '', $rand_no);
				$foldername="./assets/android/test";
				if (!is_dir($foldername))
				{
					mkdir($foldername, 0777, true);
				}
				
				file_put_contents("$foldername".$rand_no.".jpg",$decodeImage);
				
				$imagedata=array(
								'contactno'=>$contactno,
								'image'=>$rand_no.".jpg",
								'base64image'=>$image,
								'date'=>date('Y-m-d h:i:s')
							);
				$is_insert=$this->user_model->INSERTDATA('registration',$insertdata);
				$is_imageinsert=$this->user_model->INSERTDATA('visaform_images',$imagedata);
				if($is_insert)
				{
					
					/*$country=$this->user_model->get_joins('tbl_countries',array('country_code'=>$country_from),'',array('country_name'));
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
					*/
					$this->response(array('status'=>'true','message'=>'Thank you for Submission'));

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

		
	/*	6.	Get All Service Menus */
	
	function m_services_get()
	{
		$menus=$this->user_model->get_joins('tbl_service',array('status'=>1),'','id,service');
		if(empty($menus))
		{
			$this->response(array('status'=>'false','message'=>array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
		}
		else
		{
			$this->response(array('status'=>'true','message'=>$menus));
		}
	}
		
	/*	6.	Get All Sub-Service Menus */
	
	function m_sub_services_get()
	{
		$s_id=$this->get('s_id');
		$this->form_validation->set_data(array(
									's_id'=>$s_id,
									));
		if($this->form_validation->run('m_sub_services_get')!==false)
		{
			$joins=array(
						array('table'=>'tbl_service','condition'=>'`tbl_service`.`id` = `tbl_sub_service`.`s_id`','jointype'=>'inner'),
					);
			$menus=$this->user_model->get_joins('tbl_sub_service',array('tbl_service.status'=>1,'tbl_service.id'=>$s_id,'tbl_sub_service.status'=>1),$joins,'tbl_sub_service.id, tbl_service.id as s_id,name,');
			if(empty($menus))
			{
				$this->response(array('status'=>'false','message'=>array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
			}
			else
			{
				$this->response(array('status'=>'true','message'=>$menus));
			}
		}
		else
		{
			$this->response(array('status'=>'false','message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
		}
		
	}
	
	
		
	/*	7.	Get Contents by menu id */
	
	function service_content_get()
	{
		$ss_id=$this->get('ss_id');
		$page=$this->get('page');
		$menus=$this->user_model->get_joins('tbl_menu');
				
		$this->form_validation->set_data(array('ss_id'=>$ss_id));
		if($this->form_validation->run('service_content_get')!==false)
		{
			if($page=='')
			{
				$page=0;
			}
			else
			{
				$page=$page*5-5;
			}
			
			$joins=array(
						array('table'=>'tbl_sub_service','condition'=>'`tbl_sub_service`.`id` = `tbl_service_content`.`ss_id`','jointype'=>'inner'),
					);
			$fields=array('tbl_service_content.id','ss_id','title','content');
			$contents=$this->user_model->get_joins('tbl_service_content',array('ss_id'=>$ss_id),$joins,$fields,'','','','5' ,$page);
			//$contents=$this->user_model->get_joins('content',array('mid'=>$mid),$joins,$fields,'','','');
			//echo $this->db->last_query();
			//exit;
			if(empty($contents))
			{
				$this->response(array('status'=>'false','message'=>array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
			}
			else
			{
				$this->response(array('status'=>'true','message'=>$contents));
			}
		}
		else
		{
			$this->response(array('status'=>'false','message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
		}
	}
	
}
