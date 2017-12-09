<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Plan extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		
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
	
	
	/********************************* 		Change Subscription Plan 	**************************************/
	
	function planchange()
	{
		//echo"<pre>";print_r($this->session->userdata());exit;
		$data='';
		$subscriptionid=$this->uri->segment(3);
		
		$carddetails=$this->input->post('carddetails');
		
		@$session_id=$this->session->userdata('id');
		$fields=array('tbl_user.email', 'tbl_user.id as user_id', 'stylist.id as s_id', 'subscription.id as subscription_id', 'subscription.stripe_cust_id', 'subscription.recuring_sub_id', 'subscription.subs_type', 'subscription.plan', 'subscription.stripe_plan_id', 'subscription.package', );
		$join_s=array(
				array('table'=>'stylist','condition'=>'`stylist`.`id` = `subscription`.`s_id`','jointype'=>'inner'),
				array('table'=>'tbl_user','condition'=>'`tbl_user`.`id` = `stylist`.`user_id`','jointype'=>'inner'),
				);
		$data['subscription']=$this->user_model->get_joins('subscription', array('subscription.id'=>$subscriptionid),$join_s,$fields);
		//echo"<pre>";print_r($data['subscription']);
		if(isset($_POST))
		{
			$email=$this->input->post('email');
			$s_id=$this->input->post('s_id');
			
			$name_on_cards=$this->input->post('name_on_cards');
			$card_number=$this->input->post('card_number');
			$exp_month=$this->input->post('exp_month');
			$exp_year=$this->input->post('exp_year');
			$cvc=$this->input->post('cvc');
		
			$recuring_sub_id=$this->input->post('recuring_sub_id');
			$stripe_plan_id=$this->input->post('stripe_plan_id');
			$stripe_cust_id=$this->input->post('stripe_cust_id');
			
			$packages=$this->input->post('packages');
			$pack_name=$this->input->post('pack_name');
			$subs_type=$this->input->post('subs_type');
			
			$newid=$this->input->post('subscriptionid');
			$confirm_planchange=$this->input->post('confirm_planchange');
		
			$amount=$packages;

				if($subs_type=='Yearly')						// setting interval for stripe account
				{
					$interval='year';
				}
				elseif($subs_type=='Monthly')
				{
					$interval='month';
				}
			
			$this->form_validation->set_error_delimiters('<div class="text-error">', '<span class="text-error-close">x</span></div>');										
			$this->form_validation->set_rules('confirm_planchange', 'Subscription Condition','trim|required');
			if ($this->form_validation->run() == FALSE)
			{
				$data['message'] = validation_errors();
			}
			else
			{
				$update_date=date("Y-m-d H:i:s");
				
				if(empty($carddetails))
				{
					$this->form_validation->set_rules('packages', 'Package','trim|required');
					$this->form_validation->set_rules('name_on_card', 'Name on Card','trim|required');
					$this->form_validation->set_rules('card_number', 'Card Number','trim|required|is_natural');
					$this->form_validation->set_rules('exp_month', 'Expiration Month','trim|required');
					$this->form_validation->set_rules('exp_year', 'Expiration Year','trim|required');
					$this->form_validation->set_rules('cvc', 'CVC Code','trim|required');
					
					$this->form_validation->set_message('alpha_space', 'Only Characters and space is allowed');
						
					if ($this->form_validation->run() == FALSE)
					{
						$data['message'] = validation_errors();
					}
					else
					{
						
						
						/*Stripe payment Start*/
							$stripeToken=$_POST['stripeToken'];
							
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
								$card = $stripeToken;
								$desc = 'Inhairent Subscription';
								$plan = $up_planid;
								
								$customer_create = json_decode($this->stripe->customer_create($card, $email, $desc , $plan ));		// for creating sut on stripe
								if(!empty($customer_create))
								{
									$customer_id=$customer_create->id;
									$customer_planid=$customer_create->subscriptions->data[0]->id;
								}

							//	$charge_cust=json_decode($this->stripe->charge_customer($amount, $customer_id,$desc));				// for charging cust plan amount
								
								$cust_subs=json_decode($this->stripe->customer_subscribe($customer_id, $plan,$options=''));				// for reccuring payment
								$recuring_sub_id=$cust_subs->id;
								
								$new_stripe_cust_id=$customer_create->id;
								$new_recuring_sub_id=$cust_subs->id;
								$new_stripe_plan_id=$customer_create->subscriptions->data[0]->id;;
							}
							else
							{
								$newdata=array(	"card" => array(
												"number" => $card_number,		//	card no. is mandetory without card no it will not work
												"exp_month" => $exp_month,
												"exp_year" => $exp_year,
												"cvc" => $cvc,
												"Name" => $name_on_cards,
											));
								
								$customer_unsubscribe=json_decode($this->stripe->customer_unsubscribe($stripe_cust_id));				//	unsubscribing old plan
								$desc='Inhairent Subscription Changed';
						//		$charge_cust=json_decode($this->stripe->charge_customer($amount, $stripe_cust_id,$desc));				//	charging amount
								$cust_subs=json_decode($this->stripe->customer_subscribe($stripe_cust_id, $up_planid,$options=''));		//	subscribing new plan
						//		$cust_info=json_decode($this->stripe->customer_info($stripe_cust_id));
								
								$update_cust=json_decode($this->stripe->customer_update($stripe_cust_id,$newdata));
								
								$new_stripe_cust_id=$update_cust->id;
								$new_recuring_sub_id=$cust_subs->id;
								$new_stripe_plan_id=$update_cust->subscriptions->data[0]->id;
							}
							
							
							/*Update Session Values Start*/
								if($subs_type=="Monthly")
								{
									$days="+30 days";
								}
								elseif($subs_type=="Yearly")
								{
									$days="+365 days";
								}
								$subs_start_date=strtotime($update_date);
								
								$subs_end_date=date('Y-m-d H:i:s', strtotime($days, $subs_start_date));
								$current_period_end=strtotime($subs_end_date);
								
							$sessionArr = array(
												'id'=>$this->session->userdata('id'),
												'role_id'=>$this->session->userdata('role_id'),
												'role'=>$this->session->userdata('role'),
												'firstname'=>$this->session->userdata('firstname'),
												'lastname'=>$this->session->userdata('lastname'),
												'email'=>$this->session->userdata('email'),
												'subs_end_date'=>$current_period_end,
												'adminAdded'=>$this->session->userdata('adminAdded'),
												'package'=>$pack_name,
												'subsid'=>$this->session->userdata('subsid'),
												'plan_expired'=>0,
												'isLogin'=>TRUE
											);
											
											
							$this->session->set_userdata($sessionArr);	
							
							/*Update Session Values End*/
							
							/*	Updating Details in database	*/
							$subs_data=array('subs_type'=>$subs_type, 'plan'=>$packages, 'package'=>$pack_name, 'stripe_cust_id'=>$new_stripe_cust_id, 'stripe_plan_id'=>$new_stripe_plan_id, 'recuring_sub_id'=>$new_recuring_sub_id, 'update_date'=>$update_date,);
							$update_subs=$this->user_model->UPDATEDATA('subscription',array('id'=>$newid), $subs_data);
							
							/*Unsetting old data & Setting new data*/
							
							
							if($update_subs)
							{
								$this->session->set_flashdata('Logmsg', '<b style="color:green;">Subscription Plan Changed Successfully</b>');
								redirect(site_url().'stylist/viewprofile');
							}
							/*Stripe payment Ends*/
					}
				}
				else
				{
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
						if(empty($stripeToken))
						{
							$data['message'] ='<div class="text-error">Card Detais Does not exists <span class="text-error-close">x</span></div>';
						}
						else
						{
							$card = $stripeToken;
							$desc = 'Inhairent Subscription';
							$plan = $up_planid;
							
							$customer_create = json_decode($this->stripe->customer_create($card, $email, $desc , $plan ));		// for creating sut on stripe
							if(!empty($customer_create))
							{
								$customer_id=$customer_create->id;
								$customer_planid=$customer_create->subscriptions->data[0]->id;
							}

							
							$cust_subs=json_decode($this->stripe->customer_subscribe($customer_id, $plan,$options=''));				// for reccuring payment
							$recuring_sub_id=$cust_subs->id;
							
							$new_stripe_cust_id=$customer_create->id;
							$new_recuring_sub_id=$cust_subs->id;
							$new_stripe_plan_id=$customer_create->subscriptions->data[0]->id;
						}
					}
					else
					{
						//echo "cust  exist";exit;
						$customer_unsubscribe=json_decode($this->stripe->customer_unsubscribe($stripe_cust_id));				//	unsubscribing old plan
						$desc='Inhairent Subscription Changed';
				//		$charge_cust=json_decode($this->stripe->charge_customer($amount, $stripe_cust_id,$desc));				//	charging amount
						$cust_subs=json_decode($this->stripe->customer_subscribe($stripe_cust_id, $up_planid,$options=''));		//	subscribing new plan
				//		$cust_info=json_decode($this->stripe->customer_info($stripe_cust_id));
						
				//		$update_cust=json_decode($this->stripe->customer_update($stripe_cust_id,$newdata));
						
						$new_stripe_cust_id=$stripe_cust_id;
						$new_recuring_sub_id=$cust_subs->id;
						$new_stripe_plan_id=$stripe_plan_id;
					}
					if(!empty($new_stripe_cust_id))
					{
						/*Unsetting old data & Setting new data*/
							$subs_data=array('subs_type'=>$subs_type, 'plan'=>$packages, 'package'=>$pack_name, 'confirm_planchange'=>$confirm_planchange, 'stripe_cust_id'=>$new_stripe_cust_id, 'stripe_plan_id'=>$new_stripe_plan_id, 'recuring_sub_id'=>$new_recuring_sub_id, 'update_date'=>$update_date,);
							$update_subs=$this->user_model->UPDATEDATA('subscription',array('id'=>$newid), $subs_data);
							//echo $this->db->last_query();exit;
							if($update_subs)
							{
								
								/*Update Session Values Start*/
								if($subs_type=="Monthly")
								{
									$days="+30 days";
								}
								elseif($subs_type=="Yearly")
								{
									$days="+365 days";
								}
								$subs_start_date=strtotime($update_date);
								
								$subs_end_date=date('Y-m-d H:i:s', strtotime($days, $subs_start_date));
								$current_period_end=strtotime($subs_end_date);
								
								$sessionArr = array(
														'id'=>$this->session->userdata('id'),
														'role_id'=>$this->session->userdata('role_id'),
														'role'=>$this->session->userdata('role'),
														'firstname'=>$this->session->userdata('firstname'),
														'lastname'=>$this->session->userdata('lastname'),
														'email'=>$this->session->userdata('email'),
														'subs_end_date'=>$current_period_end,
														'adminAdded'=>$this->session->userdata('adminAdded'),
														'package'=>$pack_name,
														'subsid'=>$this->session->userdata('subsid'),
														'plan_expired'=>0,
														'isLogin'=>TRUE
													);
													
													
									$this->session->set_userdata($sessionArr);	
									/*Update Session Values End*/
									
								$this->session->set_flashdata('Logmsg', '<b style="color:green;">Subscription Plan Changed Successfully</b>');
								redirect(site_url().'stylist/viewprofile');
							}
					}
					else
					{
						$data['message'] ='<div class="text-error">Card Detais Does not exists <span class="text-error-close">x</span></div>';
					}
				}
			}
		}
		
		$this->load->view('planchange_view',$data);
	}
	
}
