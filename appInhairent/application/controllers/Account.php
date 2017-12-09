<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		
		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
		date_default_timezone_set('America/Los_Angeles');
		//$this->session->unset_userdata('role');
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
	
	function login()
	{
		$data='';
		
		if(isset($_POST['signin']))
		{
			
			$email = trim($this->input->post('email'));
			$password = md5(trim($this->input->post('password')));
			
			$this->form_validation->set_error_delimiters('<div class="text-error">', '<span class="text-error-close">x</span></div>');
			$this->form_validation->set_rules('email', 'Email','trim|required|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[12]|md5');
			if ($this->form_validation->run() == FALSE)
			{
				$data['message'] = validation_errors();
			}
			else
			{
				$checkuser=array(
						'email'=>$email,
						'password'=>$password
						);
				@$isLogin = $this->user_model->get_sql_select_data('tbl_user', $checkuser);
				if(!empty($isLogin))
				{
					if($isLogin[0]['status']==0)
					{
						$data['message'] ='<div class="text-error">Account is Disabled Please contact Administrator<span class="text-error-close">x</span></div>';
					}
					else
					{
						if($isLogin[0]['role_id']==1)
						{
							$role="Super Admin";
							$current_period_end='';
							$adminAdded=0;
							$subsid=0;
						}
						if($isLogin[0]['role_id']==2)
						{
							$role="Admin";
							$current_period_end='';
							$adminAdded=0;
							$subsid=0;
						}
						if($isLogin[0]['role_id']==3)
						{
							$field=array('stylist.id as s_id', 'stylist.user_id', 'subscription.id as subsid', 'subscription.stripe_cust_id', 'subscription.recuring_sub_id', 'subscription.subs_type', 'subscription.plan', 'subscription.stripe_plan_id', 'subscription.package', 'subscription.createdate' , 'subscription.update_date' );
							$join=array(
										array('table'=>'stylist','condition'=>'`stylist`.`id` = `subscription`.`s_id`','jointype'=>'inner'),
										array('table'=>'tbl_user','condition'=>'`tbl_user`.`id` = `stylist`.`user_id`','jointype'=>'inner'),
										);
							$data['stylist_subs_data']=$this->user_model->get_joins('subscription',array('stylist.user_id'=>$isLogin[0]['id']),$join,$field);
							
//							echo"<pre>";print_r($data['stylist_subs_data']);exit;
							if(!$isLogin[0]['admin_added']=1)
							{
								$adminAdded=0;
								$customer_info=json_decode($this->stripe->customer_info($data['stylist_subs_data'][0]['stripe_cust_id']));
							
								//echo"<pre>";
								$current_period_start=$customer_info->subscriptions->data[0]->current_period_start;
								$current_period_end=$customer_info->subscriptions->data[0]->current_period_end;
								$package=$data['stylist_subs_data'][0]['package'];
								$subsid=$data['stylist_subs_data'][0]['subsid'];
							}
							else
							{
							
							
								$adminAdded=$isLogin[0]['admin_added'];
								$subsid=$data['stylist_subs_data'][0]['subsid'];
								$subs_type=$data['stylist_subs_data'][0]['subs_type'];
								$add_date=$data['stylist_subs_data'][0]['createdate'];
								if($subs_type=="Monthly")
								{
									$days="+30 days";
								}
								elseif($subs_type=="Yearly")
								{
									$days="+365 days";
								}
								$subs_start_date=strtotime($data['stylist_subs_data'][0]['update_date']);
								
								$subs_end_date=date('Y-m-d H:i:s', strtotime($days, $subs_start_date));
								$current_period_end=strtotime($subs_end_date);
								$package=$data['stylist_subs_data'][0]['package'];
							}
						//	exit;
						/*	$datetime_now=strtotime(date("Y-m-d H:i:s"));
							
							$_period_start= gmdate("Y-m-d H:i:s", $current_period_start);
							$_period_end= gmdate("Y-m-d H:i:s", $current_period_end);
							
							//print_r($_period_end);
							
							$timestamp = $datetime_now;
							for ($i = 0 ; $i < 7 ; $i++)
							{
								echo date('Y-m-d', $timestamp) . '<br />';
								$timestamp -= 24 * 3600;
							}*/
						
							$role="Stylist";
						}
						/*if($isLogin[0]['role_id']==4)
						{
							$role="Client";
							$adminAdded=0;
						}*/
						
						
							$sessionArr = array(
										'id'=>$isLogin[0]['id'],
										'role_id'=>$isLogin[0]['role_id'],
										'role'=>$role,
										'firstname'=>$isLogin[0]['firstname'],
										'lastname'=>$isLogin[0]['lastname'],
										'email'=>$isLogin[0]['email'],
										'subsid'=>$subsid,
										'subs_end_date'=>$current_period_end,
										'package'=>$package,
										'adminAdded'=>$adminAdded,
										'isLogin'=>TRUE
										);
						$this->session->set_userdata($sessionArr);
						/*
						echo"<pre>";
						print_r($sessionArr);
						exit;
						*/
						if($isLogin[0]['role_id']==1)
						{
							redirect(site_url().'superadmin/');
						}
						if($isLogin[0]['role_id']==2)
						{
							redirect(site_url().'admin/viewstylist');
						}
						if($isLogin[0]['role_id']==3)
						{
							redirect(site_url().'stylist/viewprofile');
						}
						if($isLogin[0]['role_id']==4)
						{
							redirect(site_url().'client/');
						}
					}
					//echo"<pre>";print_r($this->session->userdata());exit;
				}
				else
				{
					$data['message'] ='<div class="text-error">Invalid Email & Password<span class="text-error-close">x</span></div>';
				}
			}
		}
		$this->load->view('login_view',$data);
	}

	//******************************************************************************************//
	
	function register()
	{
		$data='';
                
		$data['states']	=	$this->user_model->get_sql_select_data('tbl_state');
		 if ($_POST)
		 {

			$firstname = ucwords(trim($this->input->post('firstname')));
			$lastname = ucwords(trim($this->input->post('lastname')));
			$email = strtolower(trim($this->input->post('email')));
			$password = trim($this->input->post('password'));

			$phoneno = trim($this->input->post('phoneno'));

			$salon_name = trim($this->input->post('salon_name'));
		//	$no_of_stylist = trim($this->input->post('no_of_stylist'));
			
			$pak_amount = trim($this->input->post('packages'));
			$pack_name = trim($this->input->post('pack_name'));
			$subs_type = trim($this->input->post('subs_type'));

			$address_a = trim($this->input->post('address_a'));
			$address_b = trim($this->input->post('address_b'));
			$state = trim($this->input->post('state'));
			$city = trim($this->input->post('city'));
			$zipcode = trim($this->input->post('zipcode'));
			
			$status = trim($this->input->post('status'));
			$term_of_use = trim($this->input->post('term_of_use'));
			
			
			$this->form_validation->set_error_delimiters('<div class="text-error">', '<span class="text-error-close">x</span></div>');
			$this->form_validation->set_rules('firstname', 'Firstname','trim|required|alpha');
			$this->form_validation->set_rules('lastname', 'Lastname','trim|required|alpha');
			$this->form_validation->set_rules('phoneno', 'Phone No.','trim|required');
			
			$this->form_validation->set_rules('email', 'Email','trim|required|valid_email');
			$this->form_validation->set_rules('confirmemail', 'Confirm Email','trim|required|valid_email|matches[email]');
						
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[12]|md5');
			$this->form_validation->set_rules('confirmpassword', 'Confirm Password', 'trim|required|min_length[5]|max_length[12]|md5|matches[password]');
			
		//	$this->form_validation->set_rules('usertype', 'Subscription Type','trim|required');
			$this->form_validation->set_rules('salon_name', 'Name of Salon','trim|required');
		//	$this->form_validation->set_rules('no_of_stylist', 'Number of Stylist','trim|required');
                      
			$this->form_validation->set_rules('packages', 'Package','trim|required');
			
			$this->form_validation->set_rules('name_on_card', 'Name on Card','trim|required|callback_alpha_space');
			$this->form_validation->set_rules('card_number', 'Card Number','trim|required|is_natural');
			$this->form_validation->set_rules('exp_month', 'Expiration Month','trim|required');
			$this->form_validation->set_rules('exp_year', 'Expiration Year','trim|required');
			$this->form_validation->set_rules('cvc', 'CVC Code','trim|required');
			
			$this->form_validation->set_rules('address_a', 'Address','trim|required');
			$this->form_validation->set_rules('city', 'City','trim|required');
			$this->form_validation->set_rules('state', 'State','trim|required');
			$this->form_validation->set_rules('zipcode', 'Zipcode','trim|required|is_natural');
			$this->form_validation->set_rules('term_of_use', 'Terms of Service','trim|required');
			
			$this->form_validation->set_message('alpha_space', 'Only Characters and space is allowed');
			
			if ($this->form_validation->run() == FALSE)
			{
				$data['message'] = validation_errors();
			}
			else
			{
				$now=date("Y-m-d H:i:s");
				$datenow = strtotime($now);
				$Atfer_a_month = strtotime("+30 day", $datenow);
				$dateAtfer_a_month=strtotime(date('Y-m-d H:i:s',$Atfer_a_month));
				
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
					/*For stripe payment start */
				$amount = $pak_amount;
			//	$amount = $pak_amount*$no_of_stylist;
				
				if($subs_type=='Yearly')
				{
					$interval='year';
				}
				elseif($subs_type=='Monthly')
				{
					$interval='month';
				}
				
				$plan_list=json_decode($this->stripe->plan_list());
				$chk_plan='';
				if(!empty($plan_list))
				{
					@$last_plan_id=$plan_list->data[0]->id;
					$allplans=$plan_list->data;
					
					foreach($allplans as $plans)
					{
						//if($plans->name==$usertype.' '.$pack_name.' '.$subs_type.' '.$no_of_stylist)
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
				if(empty($chk_plan))
				{
					$create_plan=json_decode($this->stripe->plan_create($last_plan_id+1, $amount, $pack_name.' '.$subs_type, $interval, $trial_days = 30 ));		//creating plan on stripe
					//$create_plan=json_decode($this->stripe->plan_create($last_plan_id+1, $amount, $usertype.' '.$pack_name.' '.$subs_type.' '.$no_of_stylist, $interval, $trial_days = FALSE ));		//creating plan on stripe
					$insertplanid=$create_plan->id;
				}
				else
				{
					$insertplanid=$chk_plan['id'];
				}
				
				$card = $_POST['stripeToken'];
				$desc = 'Inhairent Subscription';
				$plan = $insertplanid;
				
				$customer_create = json_decode($this->stripe->customer_create($card, $email, $desc , $plan ));		// for creating sut on stripe
				if(!empty($customer_create))
				{
					$customer_id=$customer_create->id;
					$customer_planid=$customer_create->subscriptions->data[0]->id;
				}
				//$delete_cust=$this->stripe->customer_delete('cus_6s7f5x4XNclz66');
				/*$newdata=array(	"card" => array(
								"number" => "4242424242424242",
								"exp_month" => 5,
								"exp_year" => date('Y') + 3,
								"cvc" => "314"
							));
				$update_cust=$this->stripe->customer_update($customer_id,$newdata);
				*/
				//$cust_info=json_decode($this->stripe->customer_info('cus_6wIxdC0qAwmoVn'));
			//	$charge_cust=json_decode($this->stripe->charge_customer($amount, $customer_id,$desc));				// for charging cust plan amount
				
				$cust_subs=json_decode($this->stripe->customer_subscribe($customer_id, $plan,$options=''));				// for reccuring payment
				$recuring_sub_id=$cust_subs->id;
				
				/*For stripe payment end */
				
				
					$currentdate=date("Y-m-d H:i:s");
					$default_img=site_url().'assets/img/find_user.png';
					$userdata=array(
						'firstname'=>$firstname,
						'lastname'=>$lastname,
						'contactno'=>$phoneno,
						'email'=>$email,
						'status'=>1,
						'role_id'=>3,
						'password'=>md5($password),
						'term_of_use'=>$term_of_use,
						'usertype'=>'INDEPENDENT STYLIST',
					//	'usertype'=>$usertype,
						'salon_name'=>$salon_name,
						
						'address1'=>$address_a,
						'address2'=>$address_b,
						'state'=>$state,
						'city'=>$city,
						'zipcode'=>$zipcode,
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
							
							$stylistdata=array('user_id'=>$joinId[0]['id']);
							$this->user_model->INSERTDATA('stylist',$stylistdata);
							
							$styledata=array('user_id'=>$joinId[0]['id']);
							$styleid=$this->user_model->get_sql_select_data('stylist', $styledata);
							$styleid[0]['id'];
							
							$subscriptiondata=array(
								'subs_type'=>$subs_type,
								'stripe_cust_id'=>$customer_id,
								'stripe_plan_id'=>$customer_planid,
								'recuring_sub_id'=>$recuring_sub_id,
								'plan'=>$pak_amount,
								'package'=>$pack_name,
								'billing_address'=>$address_a,
								'billing_address_b'=>$address_b,
								'billing_state'=>$state,
								's_id'=>$styleid[0]['id'],
								'billing_city'=>$city,
								'billing_zipcode'=>$zipcode,
								'createdate'=>$currentdate,
								'update_date'=>$currentdate,
								);
								
							$this->user_model->INSERTDATA('subscription',$subscriptiondata);
							$mail_pass=$this->input->post('password');
							
						//	echo $password;exit;
							$link= "http://server.ntftechnologies.com/inhairent/account/";
							$mail_msg="Welcome to your new Inhairent account, we're excited to have you part of the Inhairent community! We know you'll love all the great features that will help you build stronger relationships with all your clients! 

Login to your account here $link to get started! \n\n

Username: $email
Password: ".$password;

							$headers = 'From: admin@inhairent.com' . "\r\n" .
								'Reply-To: admin@inhairent.com' . "\r\n" .
								'X-Mailer: PHP/' . phpversion();
							$headers .= "MIME-Version: 1.0" . "\r\n";
							$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
							$headers .= "Content-Transfer-Encoding: 8bit";
/*$headers = 'From: YourLogoName info@domain.com' . "\r\n" ;
    $headers .='Reply-To: '. $email . "\r\n" ;
    $headers .='X-Mailer: PHP/' . phpversion();
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; */
							mail($email,'Welcome to Inhairent',$mail_msg,$headers);
							$this->session->set_flashdata('Logmsg', '<b style="color:green;">Registration Successfull</b>');
							//$data ='<div class="text-success-wrapper">Registration Successfull<span class="text-success-close">x</span></div>';
							redirect(site_url().'account/');
							//echo"<pre>";print_r($this->user_model->get_sql_select_data('tbl_user', $whereId,'','','id'));exit;;
						}
						else
						{
							$data['message'] ='<div class="text-error">Error occured Try Again<span class="text-error-close">x</span></div>';
						}
				}
			}
                        
                        
		}
		$this->load->view('register_view',$data);
	}

	//******************************************************************************************//
	
	function logout()
	{
		$sessionArr = array(
							'id'=>'',
							'role_id'=>'',
							'role'=>'',
							'firstname'=>'',
							'lastname'=>'',
							'email'=>'',
							'subs_end_date'=>'',
							'adminAdded'=>'',
							'package'=>'',
							'isLogin'=>FALSE
						);
						
						
		$this->session->set_userdata($sessionArr);	
		redirect(site_url().'account/');
	}
	
	//******************************************************************************************//	
	
	function alpha_space($str)
	{
		return ( ! preg_match("/^([a-z_ ])+$/i", $str)) ? FALSE : TRUE;
	}

}
