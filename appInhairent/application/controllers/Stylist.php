<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stylist extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('id') == "" || $this->session->userdata('role_id') == "" || $this->session->userdata('email') == "" || $this->session->userdata('firstname') == "" || $this->session->userdata('lastname') == "" || $this->session->userdata('isLogin') == "" || $this->session->userdata('subs_end_date') == "" || $this->session->userdata('package') == "")
		{
            redirect(site_url().'account/');
        }
       // echo"<pre>";print_r($this->session->userdata());exit;
		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',true);
		//$this->output->set_header('Cache-Control: max-age=900');
		$this->output->set_header('Pragma: no-cache');
		date_default_timezone_set('America/Los_Angeles');
		
		/*Check Subscrfiption is over or not*/
		$current_period_end=$this->session->userdata('subs_end_date');
		$subsid=$this->session->userdata('subsid');
		//$datetime_now='1475324415';		//	date 01/10/2016		//dd/mm/yyyy 
		$datetime_now=strtotime(date("Y-m-d H:i:s"));
        if($datetime_now > $current_period_end)
		{
			$this->session->set_userdata('plan_expired', 1);
			$this->session->set_flashdata('Logmsg', '<b style="color:red;">Your Subscription is Expired Please Renew & Login</b>');
			redirect('plan/planchange/'.$subsid);
			
		}
		
		/*$CI =& get_instance();
		echo"<pre>";print_r($CI);*/
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

	//***************************************	Add Appoinment			***************************************************//
	
	function add_booking()
	{
		$data='';
		
		/************   For getting stylist & client data   *************/
		@$s_user_id=$this->session->userdata('id');
		
		$join_s=array(
				array('table'=>'stylist','condition'=>'`tbl_user`.`id` = `stylist`.`user_id`','jointype'=>'inner')
				);
		$data['stylistdata']=$this->user_model->get_joins('tbl_user', array('stylist.user_id'=>$s_user_id),$join_s);
		//echo"<pre>";print_r($data['stylistdata']);exit;
		
		$email=urldecode($this->uri->segment(3));
		if(!empty($email))
		{
			$chkclient=array('email'=>$email);
			$join=array(
					array('table'=>'client','condition'=>'`tbl_user`.`id` = `client`.`user_id`','jointype'=>'inner')
					);
			$data['clientdata']=$this->user_model->get_joins('tbl_user', $chkclient,$join);
			@$c_id=$data['clientdata'][0]['id'];
			@$s_user_id=$this->session->userdata('id');
			
			$join_s=array(
					array('table'=>'tbl_user','condition'=>'`tbl_user`.`id` = `stylist`.`user_id`','jointype'=>'inner')
					);
			$data['stylistdata']=$this->user_model->get_joins('stylist', array('stylist.user_id'=>$s_user_id),$join_s);
		}
		

		/*******************   For Adding Client booking   *************/
		if(isset($_POST['book']))
		{
			
			$clientid=$this->input->post('clientid');
			$stylistid=$this->input->post('stylistid');
			
			$service=$this->input->post('service[]');
			@$service_offer=implode(',',$service);
			
			$app_length=$this->input->post('app_length[]');
			@$booking_time=implode(',',$app_length);
			
			$booking_start_date=$this->input->post('booking_start_date');
			$booking_end_date=$this->input->post('booking_end_date');
			
			$booking_start_time=$this->input->post('booking_start_time');
			//$booking_end_time=$this->input->post('booking_end_time');

			$extra='';
			foreach($app_length as $length)
			{
				@$str_size=strlen($length);
				@$splitedvalue=str_split($length,$str_size-1);
				@$extra[]=$splitedvalue[0];
			}
			//echo"<pre>";print_r($extra);
			
			$extra_time=array_sum($extra);
			//echo $extra_time;
			
			$timestamp = strtotime($booking_start_time) + $extra_time*60;
			$time = date('g:ia', $timestamp);
			$booking_end_time=$time;
			/*echo $time;//11:09
			exit;
			*/
			$clieint_list=$this->input->post('clieint_list');
			if(!empty($clieint_list))
			{
				$clientid = $clieint_list;
			}
			else
			{
				$clientid = $clientid;
			}
			
			$this->form_validation->set_error_delimiters('<div class="text-error">', '<span class="text-error-close">x</span></div>');
			$this->form_validation->set_rules('clientid', 'Client Name', 'trim|required');
			$this->form_validation->set_rules('service[]', 'Service', 'trim|required');
			//$this->form_validation->set_rules('app_length[]', 'Duration', 'trim|required');
			
			$this->form_validation->set_rules('booking_start_date', 'Booking Start Date', 'trim|required');
		//	$this->form_validation->set_rules('booking_end_date', 'Booking End Date', 'trim|required');
			$this->form_validation->set_rules('booking_start_time', 'Booking Start Time', 'trim|required');
		//	$this->form_validation->set_rules('booking_end_time', 'Booking End Time', 'trim|required');
		
			
			$a2=array("0"=>"45a","1"=>"60a","2"=>"90a","3"=>"120a","4"=>"150a","5"=>"180a","6"=>"240a","7"=>"45b","8"=>"60b","9"=>"90b","10"=>"120b","11"=>"150b","12"=>"180b","13"=>"240b","14"=>"45c","15"=>"60c","16"=>"90c","17"=>"120c","18"=>"150c","19"=>"180c","20"=>"240c","21"=>"45d","22"=>"60d","23"=>"90d","24"=>"120d","25"=>"150d","26"=>"180d","27"=>"240d","28"=>"45e","29"=>"60e","30"=>"90e","31"=>"120e","32"=>"150e","33"=>"180e","34"=>"240e","35"=>"45f","36"=>"60f","37"=>"90f","38"=>"120f","39"=>"150f","40"=>"180f","41"=>"240f",);
			if(array_intersect($app_length,$a2))
			{
			}
			else
			{
				$this->form_validation->set_rules('app_length[]', 'Duration', 'trim|required');
			}
			
			$chkclient=array('client.id'=>$clientid);
			$join=array(
					array('table'=>'client','condition'=>'`tbl_user`.`id` = `client`.`user_id`','jointype'=>'inner')
					);
			$data['clientdata']=$this->user_model->get_joins('tbl_user', $chkclient,$join);
			@$c_id=$data['clientdata'][0]['id'];
			@$s_user_id=$stylistid;
			//echo"<pre>";print_r($data['stylistdata']);exit;
			$join_s=array(
					array('table'=>'tbl_user','condition'=>'`tbl_user`.`id` = `stylist`.`user_id`','jointype'=>'inner')
					);
			$data['stylistdata']=$this->user_model->get_joins('stylist', array('stylist.user_id'=>$s_user_id),$join_s);
			//echo"<pre>";print_r($data['stylistdata']);exit;
			if ($this->form_validation->run() == FALSE)
			{
				$data['message'] = validation_errors();
			}
			else
			{
				@$start_date=strtotime($booking_start_date);
				@$starttime=strtotime($booking_start_time);
				
				@$startday=date("l",$start_date);
				
				@$startdate=date("d",$start_date);
				@$startmonth=date("m",$start_date);
				@$startyear=date("Y",$start_date);
				@$starthour=date("h",$starttime);
				@$startmin=date("i",$starttime);
				
				$booking_start_date=$startyear.'-'.$startmonth.'-'.$startdate.' '.$starthour.':'.$startmin.':00';			
				
				$chk_appoint=array('c_id'=>$clientid,'booking_start_date'=>$booking_start_date, 'day_start_time'=>$booking_start_time, 'service_offer'=>$service_offer, );
				
				$exist_appoint=$this->user_model->get_joins('booking', $chk_appoint);

				if(!empty($exist_appoint))
				{
					$data['message'] ='<div class="text-error">On '.$this->input->post('booking_start_date').' Client already has booking on Time Slot '.$booking_start_time.' <span class="text-error-close">x</span></div>';
				}
				else
				{
					$end_date=strtotime($booking_start_date);
					$endtime=strtotime($booking_end_time);

					$enddate=date("d",$end_date);
					$endmonth=date("m",$end_date);
					$endyear=date("Y",$end_date);
					$endhour=date("h",$endtime);
					$endmin=date("i",$endtime);
					$createdate=date("Y-m-d H:i:s");
					
					$booking_end_date=$endyear.'-'.$endmonth.'-'.$enddate.' '.$endhour.':'.$endmin.':00';

					$booking_data=array('s_id'=>$this->input->post('stylistid'), 'c_id'=>$clientid, 'service_offer'=>$service_offer, 'booking_time'=>$booking_time, 'day_start_time'=>$booking_start_time, 'day_end_time'=>$booking_end_time, 'booking_day'=>$startday, 'createdate'=>$createdate, 'booking_start_date'=>$booking_start_date, 'booking_end_date'=>$booking_end_date, );
					
					$add_booking=$this->user_model->INSERTDATA('booking',$booking_data);
					if(@$add_booking)
					{
						$this->session->set_flashdata('Logmsg', '<b style="color:green;">Booking Added Successfully</b>');
						redirect(site_url().'stylist/add_booking/#calendar');
						//$data['message'] ='<div class="text-success-wrapper">Booking Scheduled Successfully<span class="text-success-close">x</span></div>';
					}
				}
			}
		}
		/**For showing current stylist bookings start*/
		$stylistid=$this->session->userdata('id');
		$whereid=array('`tbl_user`.`id`'=>$stylistid);
		$fields=array('tbl_user.firstname','tbl_user.email','stylist.user_id','stylist.id');
		$join=array(
					array('table'=>'tbl_user','condition'=>'`tbl_user`.`id` = `stylist`.`user_id`','jointype'=>'inner')
					);
		$data['rawdata']=$this->user_model->get_joins('stylist', $whereid,$join,$fields);
		@$s_id=$data['rawdata'][0]['id'];
		$currentdate=date("Y-m-d H:i:s");
		$join_1=array(
					array('table'=>'client','condition'=>'`booking`.`c_id` = `client`.`id`','jointype'=>'inner'),
					array('table'=>'tbl_user','condition'=>'`tbl_user`.`id` = `client`.`user_id`','jointype'=>'inner')
					);
             //  $where_create = date("Y-m-d H:i:s");
		
		$client_fields=array('tbl_user.id as user_id', 'tbl_user.email', 'tbl_user.firstname', 'tbl_user.lastname', 'client.user_id as uid', 'client.id as clientid', 'stylist.id as sId',);
		$join_clients=array(
						array('table'=>'tbl_user','condition'=>'`tbl_user`.`id` = `client`.`user_id`','jointype'=>'inner'),
						array('table'=>'stylist','condition'=>'`client`.`s_id` = `stylist`.`id`','jointype'=>'inner'),
						);
		
		$data['allclientlist']=$this->user_model->get_joins('client', array('stylist.user_id'=>$stylistid),$join_clients,$client_fields,'','','`tbl_user`.`firstname` ASC');
		//echo"<pre>";print_r($data['allclientlist']);exit;
		
		$data['allbookingdata']=$this->user_model->get_joins('booking', array('booking.s_id'=>$s_id), $join_1,array('client.id','client.user_id','tbl_user.firstname','tbl_user.lastname','tbl_user.email','booking.id','booking.s_id','booking.c_id','booking.service_offer','booking.booking_time','booking.day_start_time','booking.day_end_time','booking.booking_day','booking.createdate','booking.booking_start_date','booking.booking_end_date'),'','','`booking`.`day_start_time` ASC');

		/**For showing current stylist bookings end*/
		
		$this->load->view('Stylist/add_booking',$data);
	}


	//***************************************	view Profie				***************************************************//

	function viewprofile()
	{
		
		$data='';
		//echo"<pre>";print_r($this->session->userdata());exit;
		$loggedinid=$this->session->userdata('id');
		$where=array('id'=>$loggedinid);
		
		$data['profile']=$this->user_model->get_sql_select_data('tbl_user', $where);
		$sid=$this->user_model->get_sql_select_data('stylist',array('user_id'=>$loggedinid));
		$data['states']=$this->user_model->get_sql_select_data('tbl_state');		
		$fields=array('client_photos.id as c_photo_id', 'client_photos.photos', 'client_photos.c_id', 'client.user_id');
		$join=array(
					array('table'=>'client','condition'=>'`client`.`id` = `client_photos`.`c_id`','jointype'=>'inner'),
					array('table'=>'tbl_user','condition'=>'`tbl_user`.`id` = `client`.`user_id`','jointype'=>'inner')
					);
		
		$data['myfeaturedimage']=$this->user_model->get_joins('client_photos', array('client_photos.featured'=>1,'client_photos.s_id'=>@$sid[0]['id'],),$join,$fields,'','','client_photos.createdate DESC');
		/*echo $this->db->last_query();
		echo"<pre>" ;print_r($data['myfeaturedimage']);exit;*/
		$this->load->view('Stylist/update_profile_view',$data);
	}

	//***************************************	view All Clients		***************************************************//

	function viewclient()
	{

		$data='';
		
		$loggedinid=$this->session->userdata('id');
		$where=array('user_id'=>$loggedinid);
		
		$stylistid=$this->user_model->get_sql_select_data('stylist', $where,'','','id');
		@$whereid=array('client.s_id'=>$stylistid[0]['id']); 
		
		$fields=array('tbl_user.id as tbl_user_id', 'tbl_user.firstname','tbl_user.lastname','tbl_user.email', 'tbl_user.contactno', 'client.photos as image', 'stylist.id AS stylist_id', 'stylist.user_id AS stylist_uid', 'client.id AS clientid' ,'client.user_id AS client_uid' ,'client.s_id AS client_sid' ,'client.ethnicity' ,'client.hair_texture' ,'client.hair_density' ,'client.hair_color');
		$join=array(
					array('table'=>'stylist','condition'=>'`client`.`s_id` = `stylist`.`id`','jointype'=>'inner'),
					array('table'=>'tbl_user','condition'=>'`tbl_user`.`id` = `client`.`user_id`','jointype'=>'inner')
					);
		
		$data['allclients']=$this->user_model->get_joins('client', $whereid,$join,$fields,'','',' `tbl_user`.`id` DESC ');
		//echo $this->db->last_query();
		//echo"<pre>";print_r($data['allclients']);exit;
		@$createdate=date("Y-m-d H:i:s");
		$joins=array(
			array('table'=>'stylist','condition'=>'`booking`.`s_id` = `stylist`.`id`','jointype'=>'inner'),
			);
		@$data['allbookings']=$this->user_model->get_joins('booking',array('s_id'=>$stylistid[0]['id'],'booking_start_date >='=>$createdate),$joins);
		//echo"<pre>";print_r($data['allbookings']);exit;

		$this->load->view('Stylist/viewclient_view',$data);
	}


	//***************************************	view All Products		***************************************************//

	function viewproducts()
	{
		if($this->session->userdata('package')=="DELUXE")
		{
			$data['message']='<div class="text-error">You Are Not Authorized To Access This Page<span class="text-error-close">x</span></div>';
		}
		else
		{
			$data='';
			
			$data['allbrands']=$this->user_model->get_joins('brand',array('status'=>1));
			//echo"<pre>";print_r($data);exit;
			
			$sessionid=$this->session->userdata('id');
			$join=array(
						array('table'=>'stylist','condition'=>'`stylist`.`user_id` = `tbl_user`.`id`','jointype'=>'inner'),
				);
			$data['stylist']=$this->user_model->get_joins('tbl_user',array('tbl_user.id'=>$sessionid),$join);
			@$s_id=$data['stylist'][0]['id'];
			
			$data['stylist_uses']=$this->user_model->get_joins('stylist_product',array('stylist_product.s_id'=>$s_id));
			
			//echo"<pre>";print_r($data['stylist_uses']);exit;
		}
		$this->load->view('Stylist/viewproduct_view',$data);
	}


	//***************************************	Edit Profie	(Ajax)		***************************************************//

	function editprofile()
	{
		$data='';
	
		$loggedinid=$this->session->userdata('id');
		$where=array('id'=>$loggedinid);
		$datafield=urldecode($this->uri->segment(3));
		$datacolumn=$this->uri->segment(4);
		
		$updatedata=array($datacolumn=>$datafield);
		if(!empty($datafield))
		{
			$data['profile']=$this->user_model->UPDATEDATA('tbl_user', $where,$updatedata);
			if($data['profile'])
			{
				//echo site_url().'stylist/viewprofile';
			}
		}
		else
		{
			$data['message'] ='<div class="text-error">Current Password Does not Found<span class="text-error-close">x</span></div>';
		}
		
	}
	

	//***************************************	Add My Brands (Ajax)	***************************************************//

	function mybrands()
	{
		if($this->session->userdata('package')=="DELUXE")
		{
			$data['message']='<div class="text-error">You Are Not Authorized To Access This Page<span class="text-error-close">x</span></div>';
		}
		else
		{
			$data='';
		
			$brandid=urldecode($this->uri->segment(4));
			$value=urldecode($this->uri->segment(3));
			
			$loggedinid=$this->session->userdata('id');
			
			$where=array('tbl_user.id'=>$loggedinid);
			$join=array(
				array('table'=>'stylist','condition'=>'`stylist`.`user_id` = `tbl_user`.`id`','jointype'=>'inner'),
				);
			$data['stylist']=$this->user_model->get_joins('tbl_user',$where,$join);
			$s_id=$data['stylist'][0]['id'];
			
			$isdata=array('s_id'=>$s_id,'brand_id'=>$brandid,'value'=>$value);
			if($value==1)
			{
				$data['isInsert']=$this->user_model->INSERTDATA('stylist_product',$isdata);
				if($data['isInsert'])
				{
					echo "Inserted";
				}
			}
			if($value==0)
			{
				$del_data=array('s_id'=>$s_id,'brand_id'=>$brandid);
				$data['isdel']=$this->user_model->DELETEDATA('stylist_product',$del_data);
				//echo $this->db->last_query();
				if($data['isdel'])
				{
					echo "deleted";
				}
			}
		}
	}
	
	
	//**************************************	Change Password			********************************************//
	
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
							//echo $this->db->last_query();exit('update');
							$this->session->set_flashdata('Logmsg', '<b style="color:green;">Password Updated Successfully</b>');
							if($this->session->userdata('role_id')==3)
							{
								redirect(site_url().'stylist/viewprofile');
							}
							if($this->session->userdata('role_id')==2)
							{
								redirect(site_url().'/changepassword');
							}
						}
						else
						{
							//echo $this->db->last_query();exit('u Fails');
							$this->session->set_flashdata('Logmsg', '<b style="color:red;">Error Occured ! Password Not Updated</b>');
							if($this->session->userdata('role_id')==3)
							{
								redirect(site_url().'stylist/viewprofile');
							}
							if($this->session->userdata('role_id')==2)
							{
								redirect(site_url().'/changepassword');
							}
						}
					}
					else
					{
						$data['message'] ='<div class="text-error">Current Password incorrect<span class="text-error-close">x</span></div>';
					}
				}
			}
		}
		$this->load->view('Stylist/update_profile_view',$data);
	}


	//***************************************	Edit Client (Ajax)		***************************************************//

	function editclient()
	{
		$data='';
		
		$loggedinid=$this->session->userdata('id');
		$where=array('id'=>$loggedinid);
		$email=urldecode($this->uri->segment(3));
		$datafield=urldecode($this->uri->segment(4));
		
		$datacolumn=$this->uri->segment(5);
		$chkclient=array('email'=>$email);
		$clientid=$this->user_model->get_sql_select_data('tbl_user',$chkclient);
		if($clientid)
		{
			$where_clientid=array('user_id'=>$clientid[0]['id']);
			$updatedata=array($datacolumn=>$datafield);
			if(!empty($datafield))
			{
				$data['profile']=$this->user_model->UPDATEDATA('client', $where_clientid,$updatedata);
				if($data['profile'])
				{
					//echo site_url().'stylist/viewprofile';
				}
			}
		}
		
		else
		{
			$data['message'] ='<div class="text-error">Details Not Updated<span class="text-error-close">x</span></div>';
		}
	}
	

	//***************************************	Edit public / featured (Ajax)		***************************************************//

	function set_featued_public()
	{
		$data='';
		
		$column=$this->uri->segment(5);
		$id=$this->uri->segment(4);
		$value=$this->uri->segment(3);
		$data['update']=$this->user_model->UPDATEDATA('client_photos',array('id'=>$id),array($column=>$value));
		if($data['update'])
		{
			//echo $this->db->last_query();exit;
			echo "Updated Successfully";
		}
		else
		{
			$data['message'] ='<div class="text-error">Details Not Updated<span class="text-error-close">x</span></div>';
		}
	}
	

	//***************************************	Edit Client Set Favorite(Ajax)		***************************************************//

	function setselected()
	{
		$data='';
		
		$session_id =	$this->session->userdata('id');
		$stylistid=$this->user_model->get_joins('stylist',array('user_id'=>$session_id),'','id');
		$s_id=$stylistid[0]['id'];
		
		
		$selected_id=urldecode($this->uri->segment(4));
		$value=urldecode($this->uri->segment(3));
		$email=urldecode($this->uri->segment(5));
		
		$where=array('email'=>$email);
		
		$fields=array('tbl_user.id','tbl_user.firstname','tbl_user.email', 'client.id as client_id', 'client.user_id');
		$join=array(array('table'=>'tbl_user','condition'=>'`client`.`user_id` = `tbl_user`.`id`','jointype'=>'inner'));
		
		$data['allclientinfo']=$this->user_model->get_joins('client', $where,$join,$fields);
		//echo"<pre>";print_r($data['allclientinfo']);exit;
		
		@$user_id=$data['allclientinfo'][0]['user_id'];
		$client_id=$data['allclientinfo'][0]['client_id'];
		if(!empty($client_id))
		{
			$insertdata=array('c_id'=>$client_id,'selected_id'=>$selected_id,'s_id'=>$s_id,'value'=>$value);
			
			$data['isexists']=$this->user_model->get_joins('tbl_selected_products', $insertdata);
			if($data['isexists'])
			{
				$data['message'] ='<div class="text-error">Already set favorited<span class="text-error-close">x</span></div>';
			}
			else
			{
				if($value==1)
				{
					$data['isinsert']=$this->user_model->INSERTDATA('tbl_selected_products', $insertdata);
					if($data['isinsert'])
					{
						echo "Data Inserted";
					}
				}
				else
				{
					$deldata=array('c_id'=>$client_id,'selected_id'=>$selected_id,'s_id'=>$s_id,'value'=>1);
					$data['isDel']=$this->user_model->DELETEDATA('tbl_selected_products',$deldata);
					if($data['isDel'])
					{
						echo "Data Deleted";
					}
				}
			}
		}
		else
		{
			$data['message'] ='<div class="text-error">No Data Found Regarding the user<span class="text-error-close">x</span></div>';
		}
		
	}
	
	
	//***************************************	Edit Client Set Favorite(Ajax)		***************************************************//

	function setfavorite()
	{
		$data='';
		
		$session_id =	$this->session->userdata('id');
		$stylistid=$this->user_model->get_joins('stylist',array('user_id'=>$session_id),'','id');
		$s_id=$stylistid[0]['id'];
		
		
		$selected_id=urldecode($this->uri->segment(4));
		$value=urldecode($this->uri->segment(3));
		$email=urldecode($this->uri->segment(5));
		
		$where=array('email'=>$email);
		
		$fields=array('tbl_user.id','tbl_user.firstname','tbl_user.email', 'client.id as client_id', 'client.user_id');
		$join=array(array('table'=>'tbl_user','condition'=>'`client`.`user_id` = `tbl_user`.`id`','jointype'=>'inner'));
		
		$data['allclientinfo']=$this->user_model->get_joins('client', $where,$join,$fields);
		//echo"<pre>";print_r($data['allclientinfo']);exit;
		
		$user_id=$data['allclientinfo'][0]['user_id'];
		$client_id=$data['allclientinfo'][0]['client_id'];
		if(!empty($client_id))
		{
			$insertdata=array('client_id'=>$client_id,'favorite'=>$selected_id,'s_id'=>$s_id,'value'=>$value);
			
			$data['isexists']=$this->user_model->get_joins('tbl_favorite', $insertdata);
			if($data['isexists'])
			{
				$data['message'] ='<div class="text-error">Already set favorited<span class="text-error-close">x</span></div>';
			}
			else
			{
				if($value==1)
				{
					$data['isinsert']=$this->user_model->INSERTDATA('tbl_favorite', $insertdata);
					if($data['isinsert'])
					{
						echo "Inserted";
					}
				}
				else
				{
					$deldata=array('client_id'=>$client_id,'favorite'=>$selected_id,'s_id'=>$s_id,'value'=>1);
					$data['del']=$this->user_model->DELETEDATA('tbl_favorite',$deldata);
					if($data['del'])
					{
						echo "Deleted";
					}
					echo $this->db->last_query();
				}
			}
		}
		else
		{
			$data['message'] ='<div class="text-error">No Data Found Regarding the user<span class="text-error-close">x</span></div>';
		}
	}
	
	
	//**************************************	Add New Client			***********************************************//
	
	function addclient()
	{
		$data='';
		//echo"<pre>";print_r($_SERVER);exit;
		$data['alldensity']=$this->user_model->getalldensity();
		$data['allcolor']=$this->user_model->getallcolor();
		$data['alltexture']=$this->user_model->getalltexture();
		$data['allethnicity']=$this->user_model->getallethnicity();
		$data['alltags']=$this->user_model->getalltag();
		$data['allcategory']=$this->user_model->getallcategory();
		$data['allbrands']=$this->user_model->getallbrands();
		
		$sessionid=$this->session->userdata('id');
		$join_stylist=array(
							array('table'=>'stylist','condition'=>'`stylist`.`id` = `stylist_product`.`s_id`','jointype'=>'inner'),
							array('table'=>'tbl_user','condition'=>'`tbl_user`.`id` = `stylist`.`user_id`','jointype'=>'inner'),
							array('table'=>'brand','condition'=>'`brand`.`id` = `stylist_product`.`brand_id`','jointype'=>'inner'),
							array('table'=>'product','condition'=>'`product`.`brand_id` = `stylist_product`.`brand_id`','jointype'=>'inner'),
							array('table'=>'category','condition'=>'`category`.`id` = `product`.`categoryid`','jointype'=>'inner'),
							);
		//$fields=array('tbl_user.id as user_id', 'product.id as product_id', 'product.name as product_name', 'product.image as image', 'product.price as price', 'product.description as product_desc', 'brand.id as brand_id', 'brand.name as brand_name', 'category.id as category_id', 'category.name as category_name', 'stylist_product.s_id as s_id', );
		$fields=array('category.name as category_name','brand.name as brand_name', 'product.id as product_id', 'product.name', 'product.description', 'product.price', 'product.tagid', 'product.image');
		$data['suggestedproduct'] = $this->user_model->get_joins('stylist_product',array('tbl_user.id'=>$sessionid),$join_stylist,$fields);
		
				
		$firstname=ucwords(trim($this->input->post('firstname')));
		$lastname=ucwords(trim($this->input->post('lastname')));
		$email=trim($this->input->post('email'));
		$contactno=trim($this->input->post('contactno'));
		$ethnicity=trim($this->input->post('ethnicity'));
		$gender=trim($this->input->post('gender'));
		$age=$this->input->post('age');
		
		$hair_color=$this->input->post('hair_color');
		$hair_texture=$this->input->post('hair_texture');
		$hair_density=$this->input->post('hair_density');
		
		$field_=array('client.id', 'client.user_id', 'client.s_id', 'client_photos.photos','client_photos.id');
		$join=array(
				array('table'=>'client','condition'=>'`client`.`id` = `client_photos`.`c_id`','jointype'=>'inner'),
				array('table'=>'tbl_user','condition'=>'`tbl_user`.`id` = `client`.`user_id`','jointype'=>'inner'),
			);
		$data['allpublicimgs']=$this->user_model->get_joins('client_photos',array('client_photos.public'=>1),$join,$field_);
		
		$data['section']='clientsinfo';
		//echo"<pre>";print_r($data['allpublicimgs']);exit;
		if(!empty($email))
		{
			$where_c=array('email'=>$email);
			$field_c=array('client_photos.id as id','client_photos.c_id', 'client_photos.photos',  'client_photos.photo_order', 'client_photos.featured', 'client_photos.public', 'client_photos.s_id', 'client.user_id', 'client_photos.createdate',);
			$join_c=array(array('table'=>'client','condition'=>'`client`.`user_id` = `tbl_user`.`id`','jointype'=>'inner'));
			$data['rawdata']=$this->user_model->get_joins('tbl_user',$where_c,$join_c);
			
			@$userid=$data['rawdata'][0]['user_id'];
			
			$where=array('client.user_id'=>$userid);
		
			$join =array(
						array('table'=>'client','condition'=>'`tbl_user`.`id` = `client`.`user_id`','jointype'=>'inner'),
						);
			$data['clientinfo']=$this->user_model->get_joins('tbl_user',$where,$join);
			
			
			$join_ct=array(
							array('table'=>'client','condition'=>'`client_photos`.`c_id` = `client`.`id`','jointype'=>'inner'),
						);
			$data['clientoldPhotos']=$this->user_model->get_joins('client_photos',array('user_id'=>$userid),$join_ct,$field_c,'','','`client_photos`.`createdate` DESC','3');
			
			$sessionId=$this->session->userdata('id');
			$field_communication=array('client_communications.id as communicationId', 'client_communications.s_id',  'client_communications.c_id', 'client_communications.title', 'client_communications.content', 'client_communications.createdate', 'clientinfo.firstname as clientFname', 'clientinfo.lastname as clientLname', 'stylistinfo.firstname as clientFname', 'stylistinfo.lastname as clientLname', );
			$join_communication=array(
						array('table'=>'client','condition'=>'`client_communications`.`c_id` = `client`.`id`','jointype'=>'inner'),
						array('table'=>'stylist','condition'=>'`client_communications`.`s_id` = `stylist`.`id`','jointype'=>'inner'),
						array('table'=>'tbl_user as stylistinfo','condition'=>'`stylist`.`user_id` = `stylistinfo`.`id`','jointype'=>'inner'),
						array('table'=>'tbl_user as clientinfo','condition'=>'`client`.`user_id` = `clientinfo`.`id`','jointype'=>'inner'),
						
						);
			$data['recent_communications']=$this->user_model->get_joins('client_communications',array('stylistinfo.id'=>$sessionId,'clientinfo.email'=>$email),$join_communication,$field_communication,'','','client_communications.createdate DESC','5');
			/*
			echo $this->db->last_query();
			echo"<pre>";print_r($data['recent_communications']);
			exit;
			*/
		
		}
		
		if(isset($_POST['add']))
		{
			
			$data['alldensity']=$this->user_model->getalldensity();
			$data['allcolor']=$this->user_model->getallcolor();
			$data['alltexture']=$this->user_model->getalltexture();
			$data['allethnicity']=$this->user_model->getallethnicity();
			$data['alltags']=$this->user_model->getalltag();
			$data['allcategory']=$this->user_model->getallcategory();
			$data['allbrands']=$this->user_model->getallbrands();
			
			$this->form_validation->set_error_delimiters('<div class="text-error">', '<span class="text-error-close">x</span></div>');
			$this->form_validation->set_rules('firstname', 'Firstname', 'trim|required|alpha');
			$this->form_validation->set_rules('lastname', 'Lastname', 'trim|required|alpha');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
			$this->form_validation->set_rules('contactno', 'Contact Number', 'trim|required');			
			$this->form_validation->set_rules('ethnicity', 'Ethnicity', 'trim|required');			
			$this->form_validation->set_rules('gender', 'Gender', 'required');
			$this->form_validation->set_rules('age', 'Age', 'required');
			
			$this->form_validation->set_rules('hair_color', 'Hair Color', 'required');
			$this->form_validation->set_rules('hair_texture', 'Hair Texture', 'required');
			$this->form_validation->set_rules('hair_density', 'Hair Density', 'required');
			//$this->form_validation->set_message('alpha_space', 'Only Characters and space is allowed');

			if ($this->form_validation->run() == FALSE)
			{
				$data['section']="clientsinfo";
				$data['message'] = validation_errors();
			}
			else
			{
				$Session_id=$this->session->userdata('id');
				$s_id=$this->user_model->get_sql_select_data('stylist', array('user_id'=>$this->session->userdata('id')));
				//$checkdata=array('email'=>$email,);
				$checkdata=array('client.s_id'=>$s_id[0]['id'],'email'=>$email,);
				$join_s=array(
					array('table'=>'tbl_user','condition'=>'`tbl_user`.`id` = `client`.`user_id`','jointype'=>'inner')
				);
				$checkexisting=$this->user_model->get_joins('client', $checkdata,$join_s);
				/*
				echo $this->db->last_query();
				echo"<pre>";
				print_r($checkexisting);
				*///exit;
				if(empty($checkexisting))
				{
					$currentdate=date("Y-m-d H:i:s");
					$default_img=site_url().'assets/img/find_user.png';
					$insertdata=array(
									'firstname'=>$firstname,
									'lastname'=>$lastname,
									'email'=>$email,
									'contactno'=>$contactno,
									//'ethnicity'=>$ethnicity,
									'gender'=>$gender,
									'age'=>$age,
									'role_id'=>4,
									'image'=>$default_img,
									'createdate'=>$currentdate,
									);
					$isadded=$this->user_model->INSERTDATA('tbl_user',$insertdata);
					if($isadded)
					{
						$where=array('email'=>$email,'role_id'=>4,'createdate'=>$currentdate);
						$clientid=$this->user_model->get_sql_select_data('tbl_user', $where);
						
						//echo"<pre>";print_r($this->session->userdata('id'));exit;
						$client_data=	array(
											'user_id'=>$clientid[0]['id'],
											's_id'=>$s_id[0]['id'],
											'ethnicity'=>$ethnicity,
											'photos'=>$default_img,
											);
						$isadded=$this->user_model->INSERTDATA('client',$client_data);
						if($isadded)
						{
							$chkclient=array('email'=>$email);
							$clientid=$this->user_model->get_sql_select_data('tbl_user',$chkclient);
							
							$updatedata=array('hair_color'=>$hair_color,'hair_texture'=>$hair_texture,'hair_density'=>$hair_density,);
							
							if($clientid)
							{
								$where_clientid=array('user_id'=>$clientid[0]['id']);
								$data['profile']=$this->user_model->UPDATEDATA('client', $where_clientid,$updatedata);
								if($data['profile'])
								{
									$data['UserId']=$clientid[0]['id'];
									$data['section']="clientsinfo";
									$data['message'] ='<div class="text-success-wrapper">Client Added Successfully<span class="text-success-close">x</span></div>';
								}
							}
						}
					}
					else
					{
						$data['section']="clientsinfo";
						$data['message'] ='<div class="text-error">Error occured Try Again<span class="text-error-close">x</span></div>';
					}
				}
				else
				{
					$data['section']="clientsinfo";
					$data['message'] ='<div class="text-error">Client Already Exists<span class="text-error-close">x</span></div>';
				}
			}
		}
		
		/*End of 1st Isset*/
		
		if( (isset($_POST['load'])) || (isset($_POST['suggested_style'])) )
		{
			$data['sliderdata'] = $this->user_model->get_select_data_($ethnicity,$hair_color,$hair_texture,$hair_density);
			$data['section']="search";
			
			//echo $this->db->last_query();
			if(empty($data['sliderdata']))
			{
				$data['section']="search";
				
				$data['message_search'] ='<div class="text-error">No Match found<span class="text-error-close">x</span></div>';
			}
		}
		
		
		if(isset($_POST['allstyle']))
		{
			$where=array('client_photos.public'=>1);
			$field_=array('client.id', 'client.user_id', 'client.s_id', 'client_photos.photos','client_photos.id');
			$join =array(
						array('table'=>'client','condition'=>'`client`.`id` = `client_photos`.`c_id`','jointype'=>'inner'),
						//array('table'=>'tbl_user','condition'=>'`tbl_user`.`id` = `client`.`user_id`','jointype'=>'inner'),
						);
			$data['sliderdata'] = $this->user_model->get_joins('client_photos',$where,$join,$field_);
			$data['section']="search";
			
			if(empty($data['sliderdata']))
			{
				$data['section']="search";
				
				$data['message_search'] ='<div class="text-error">No Data found<span class="text-error-close">x</span></div>';
			}
		}
		
		
		if(isset($_POST['favorite_style']))
		{
			//echo"Favor ";exit;
			$data['alldensity']=$this->user_model->getalldensity();
			$data['allcolor']=$this->user_model->getallcolor();
			$data['alltexture']=$this->user_model->getalltexture();
			$data['allethnicity']=$this->user_model->getallethnicity();
			$data['alltags']=$this->user_model->getalltag();
			$data['allcategory']=$this->user_model->getallcategory();
			$data['allbrands']=$this->user_model->getallbrands();
			
			$chkclient=array('email'=>$email);
			$join_c =array(
						array('table'=>'client','condition'=>'`tbl_user`.`id` = `client`.`user_id`','jointype'=>'inner'),
						);
			$data['c_user_id'] = $this->user_model->get_joins('tbl_user',$chkclient,$join_c);
			
			@$c_id=$data['c_user_id'][0]['id'];
			if(!empty($c_id))
			{
			
				$join =array(
							array('table'=>'client','condition'=>'`client`.`id` = `tbl_favorite`.`client_id`','jointype'=>'inner'),
							array('table'=>'tbl_user','condition'=>'`tbl_user`.`id` = `client`.`user_id`','jointype'=>'inner'),
							);
				$data['favorite'] = $this->user_model->get_joins('tbl_favorite',array('client_id'=>$c_id),$join);
				
				if(!empty($data['favorite']))
				{
					$favorite_ids='';
					foreach($data['favorite'] as $favoriteid)
					{
						$favorite_ids[]=$favoriteid['favorite'];
					}
					$field_=array('client.id', 'client.user_id', 'client.s_id', 'client_photos.photos','client_photos.id');
					$join_favorite=array(
										array('table'=>'client','condition'=>'`client`.`id` = `client_photos`.`c_id`','jointype'=>'inner'),
										array('table'=>'tbl_user','condition'=>'`tbl_user`.`id` = `client`.`user_id`','jointype'=>'inner'),
										);
					$f_styles='';
					foreach($favorite_ids as $favorite)
					{
						
						$where_or=array('`client_photos`.`id`'=>$favorite);
						$f_styles[]=$this->user_model->get_joins('client_photos','',$join_favorite,$field_,'','','','','','', $where_or);
						//echo $this->db->last_query();echo"<br>";
					}
					$data['favorite_style']=$f_styles;
					$data['section']="search";
					
					//echo"<pre>";print_r($data['favorite_style']);exit;
					if(empty($data['favorite_style']))
					{
						$data['section']="search";
						
						$data['message_search'] ='<div class="text-error">You have no favorite style<span class="text-error-close">x</span></div>';
					}
				}
				else
				{
					$data['section']="search";
					
					$data['message_search'] ='<div class="text-error">You have no favorite style<span class="text-error-close">x</span></div>';
				}
			}
			else
			{
				$data['section']="search";
				
				$data['message_search'] ='<div class="text-error">Client details not found<span class="text-error-close">x</span></div>';
			}	
		}
		

		if(isset($_POST['search_style']))
		{
			$gender_s=$this->input->post('gender_s');
			$age_range_s=$this->input->post('age_range_s');
			
			$ethnicity_s=$this->input->post('ethnicity_s');
			$hair_color_s=$this->input->post('hair_color_s');
			$hair_texture_s=$this->input->post('hair_texture_s');
			$hair_density_s=$this->input->post('hair_density_s');
			$tags_s=$this->input->post('tags_s');
			if( (empty($ethnicity_s)) && (empty($gender_s)) && (empty($age_range_s)) && (empty($hair_color_s)) && (empty($hair_texture_s)) && (empty($hair_density_s)) && (empty($tags_s)) )
			{
				$data['section']="search";
				
				$data['message_search'] ='<div class="text-error">Please Select atleast one Search field <span class="text-error-close">x</span></div>';
			}
			else
			{
				if(!empty($tags_s))
				{
					$productsearch='';
					foreach($tags_s as $tagid)
					{
						$where=array('client.tagid'=>$tagid, 'client.hair_color'=>$hair_color_s, 'client.hair_texture'=>$hair_texture_s, 'client.hair_density'=>$hair_density_s);
						$join =array(
								array('table'=>'tbl_user','condition'=>'`tbl_user`.`id` = `client`.`user_id`','jointype'=>'inner'),
								array('table'=>'client_photos','condition'=>'`client`.`id` = `client_photos`.`c_id`','jointype'=>'inner'),
								);
						$productsearch=$this->user_model->get_joins('client','',$join,'','','','','','','',$where);
					}
					$data['searchdata']=$productsearch;	
					$data['section']="search";
					
				}
				else
				{
				//	$field=array('client.id', 'client.user_id', 'client.s_id', 'client.hair_color', 'client.hair_texture', 'client.hair_density', 'client.photos', );
					$where=array('client.hair_color'=>$hair_color_s, 'client.hair_texture'=>$hair_texture_s, 'client.hair_density'=>$hair_density_s);
					$join =array(
								array('table'=>'tbl_user','condition'=>'`tbl_user`.`id` = `client`.`user_id`','jointype'=>'inner'),
								array('table'=>'client_photos','condition'=>'`client`.`id` = `client_photos`.`c_id`','jointype'=>'inner'),
								);
					$data['searchdata']=$this->user_model->get_joins('client','',$join,'','','','','','','',$where);
					$data['section']="search";
					
				}
				
				//echo "<pre>";print_r($data['searchdata']);exit;
				if(empty($data['searchdata']))
				{
					$data['section']="search";
					
					$data['message_search'] ='<div class="text-error">No Match Found <span class="text-error-close">x</span></div>';
				}
			}
		}
		
		
		if(isset($_POST['suggested_style']))
		{
			$data['alldensity']=$this->user_model->getalldensity();
			$data['allcolor']=$this->user_model->getallcolor();
			$data['alltexture']=$this->user_model->getalltexture();
			$data['allethnicity']=$this->user_model->getallethnicity();
			$data['alltags']=$this->user_model->getalltag();
			$data['allcategory']=$this->user_model->getallcategory();
			$data['allbrands']=$this->user_model->getallbrands();
			
			$chkclient=array('email'=>$email);
			if(!empty($email))
			{
				//echo $hair_color;
				$where=array('ethnicity'=>$ethnicity,'client.hair_texture'=>$hair_texture,'hair_color'=>$hair_color,'hair_density'=>$hair_density);

				//$fields=array('category.name as category_name','brand.name as brand_name', 'product.id as product_id', 'product.name', 'product.description', 'product.price', 'product.tagid', 'product.image');
				$join=array(
							array('table'=>'client','condition'=>'`client`.`user_id` = `tbl_user`.`id`','jointype'=>'inner'),
							);
				
				$data['suggested_style']=$this->user_model->get_joins('tbl_user',$where,$join);
				$data['section']="search";
				
			}
			else
			{
				$data['message_search'] ='<div class="text-error">Client details not found<span class="text-error-close">x</span></div>';
				$data['section']="search";
				
			}
			//echo"<pre>";print_r($data['suggested_style']);exit;
		}
				
		
		/*End of 2nd Isset*/
		if(isset($_POST['upload']))
		{
			
			$data['alldensity']=$this->user_model->getalldensity();
			$data['allcolor']=$this->user_model->getallcolor();
			$data['alltexture']=$this->user_model->getalltexture();
			$data['allethnicity']=$this->user_model->getallethnicity();
			$data['alltags']=$this->user_model->getalltag();
			$data['allcategory']=$this->user_model->getallcategory();
			$data['allbrands']=$this->user_model->getallbrands();
			
			$liname=$this->input->post('liname[]');
			$degree=$this->input->post('cropbox[]');
			$sortdiv=$this->input->post('sortdiv');
			$de_order=$this->input->post('de_order');
			
			$img_odrers=explode(',',$sortdiv);
			$rotation_angle=explode(',',$de_order);
			
			if(count($img_odrers)==2)
			{
				$nexval=max($img_odrers)+1;
				$sortdiv=$sortdiv.','.$nexval;
			}
			if(count($img_odrers)==1)
			{
				$sortdiv=$sortdiv.',0,0';
			}
			
			$uId=$this->input->post('hidden_uId');
			
			$tagids[]=$this->input->post('tagids');
			$chk_featured=$this->input->post('chk_featured');
			$chk_public=$this->input->post('chk_public');
			//print_r($degree);exit;
			
			if($chk_public=="")
			{
				$chk_public=0;
			}
			else
			{
				$chk_public=$chk_public;
			}
			if($chk_featured=="")
			{
				$chk_featured=0;
			}
			else
			{
				$chk_featured==$chk_featured;
			}
			
			if (!is_dir('./assets/uploads/'))
			{
				mkdir('./assets/uploads/', 0777, true);
			}
			
			if(!empty($degree))
			{
				$newArray='';
				foreach( $degree as $origKey => $value )
				{
					// New key that we will insert into $newArray with
					@$newKey = $img_odrers[$origKey];
					@$newArray[$newKey] = $value;
				}
			}
			
			$config = array();
			$config['upload_path'] = './assets/uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			//$config['overwrite']     = true;
			
			$this->load->library('upload');
			$this->load->library('image_lib');						//library for resizing the image
			
			$count = count ($_FILES['pic']['name']);
             
			if($count>3)
			{
				$data['section']="photos";
				
				$data['photo_msg'] ='<div class="text-error">Maximum 3 Photos are allowed<span class="text-error-close">x</span></div>';
			}
			else
			{
				
				$this->load->library('upload', $config);
				$files = $_FILES['pic'];
				$images = array();
				$i=0;
			/*	echo"<pre>";
				print_r($sortdiv);
				print_r($degree);
				print_r($newArray);
				print_r($files['name']);
			*///	exit;
				foreach ($files['name'] as $key => $image)
				{
					$_FILES['pic[]']['name']= $files['name'][$key];
					$_FILES['pic[]']['type']= $files['type'][$key];
					$_FILES['pic[]']['tmp_name']= $files['tmp_name'][$key];
					$_FILES['pic[]']['error']= $files['error'][$key];
					$_FILES['pic[]']['size']= $files['size'][$key];
					
					$fileName = $image;
					$config['file_name'] = $fileName;
					
					$this->upload->initialize($config);
					$is_upload=$this->upload->do_upload('pic[]');
					if($is_upload)
					{
						$base_url=base_url();
						$uploaded_img_name=$this->upload->data('file_name');

						$img_full_url[]=$uploaded_img_name;
						$client_image=implode(',',$img_full_url);
						
						$config['image_library'] = 'gd2';
						$config['source_image'] = $this->upload->data('full_path');
						$config['width']     = 600;
						$config['height']   = 600;
						@$config['rotation_angle'] = 360-$newArray[$i];
						
						$this->image_lib->clear();
						$this->image_lib->initialize($config);
						
						$res=$this->image_lib->resize();
						$rotate=$this->image_lib->rotate();
						
						
						/*	For Water Mark	*/
						$this->image_lib->clear();
						$config['wm_text'] = 'Inhairent';
						$config['wm_type'] = 'text';
						$config['wm_font_size'] = '12';
					//	$config['wm_font_path'] = './assets/fonts/glyphicons-halflings-regular.ttf';
						$config['wm_font_color'] = '68268a';
						$config['wm_vrt_alignment'] = 'bottom';
						$config['wm_hor_alignment'] = 'center';
						//$config['wm_padding'] = '20';
						
						$this->image_lib->initialize($config);
						$this->image_lib->watermark();
						
						$this->_createThumbnails($uploaded_img_name);
					}
					else
					{
						$data['section']="photos";
						
						$data['photo_msg'] ='<div class="text-error">Images Not Uploaded<span class="text-error-close">x</span></div>';
					}
				$i++;
				}
					
				//print_r($degree);exit;
					$currentdate=date("Y-m-d H:i:s");
					
					$hidden_mail=$this->input->post('hidden_mail');

					
					
					@$client_profile=explode(',',$client_image);
					$client_profile_pic=$client_profile[$img_odrers[0]];
					//$isupdate = $this->user_model->UPDATEDATA('tbl_user',$where,array('image'=>$client_profile_pic));
					/*
					$join=array(
								array('table'=>'client','condition'=>'`client`.`user_id` = `tbl_user`.`id`','jointype'=>'inner')
								);
					
					$data['allclientinfo']=$this->user_model->get_joins('tbl_user', $where,$join,'');
					@$c_id=$data['allclientinfo'][0]['id'];
					*/
					
					$sessionid=array('tbl_user.id'=>$this->session->userdata('id'));
					$s_join=array(array('table'=>'stylist','condition'=>'`tbl_user`.`id` = `stylist`.`user_id`','jointype'=>'inner'));
					$data['stylistinfo']=$this->user_model->get_joins('tbl_user', $sessionid,$s_join,'');
					$s_id=$data['stylistinfo'][0]['id'];
					
						
					$where=array('tbl_user.email'=>$hidden_mail,'tbl_user.role_id'=>4,'client.s_id'=>$s_id);
						
					$join=array(
								array('table'=>'tbl_user','condition'=>'`client`.`user_id` = `tbl_user`.`id`','jointype'=>'inner')
								);
					
					$data['allclientinfo']=$this->user_model->get_joins('client', $where,$join,array('client.id as id','client.user_id as user_id','client.s_id as s_id','tbl_user.email'));
					@$c_id=$data['allclientinfo'][0]['id'];
					
					@$user_id=$data['allclientinfo'][0]['user_id'];
					@$tags=implode(',',$tagids[0]);
					if(empty($tags))
					{
						$tags='';
						//echo"empty";exit;
					}
					else
					{
						$tags=$tags;
						//echo"not empty";exit;
					}
					
					$isupdate_client = $this->user_model->UPDATEDATA('client',array('id'=>$c_id),array('photos'=>$client_profile_pic,'tagid'=>$tags,'featured'=>$chk_featured,'public'=>$chk_public));
					if(!empty($c_id))
					{
						$insertdata=array('c_id'=>$c_id,'s_id'=>$s_id,'tagid'=>$tags,'featured'=>$chk_featured,'public'=>$chk_public,'photos'=>$client_image, 'photo_order'=>$sortdiv, 'createdate'=>$currentdate);
						
						$data['isinsert']=$this->user_model->INSERTDATA('client_photos', $insertdata);
						if($data['isinsert'])
						{
							//redirect(site_url().'stylist/viewclient');
							$where_c=array('email'=>$email);
							$field_c=array('tbl_user.id as id','client.id as ClientId','tbl_user.email', 'client.user_id as user_id', 'client.s_id');
							$join_c=array(array('table'=>'client','condition'=>'`client`.`user_id` = `tbl_user`.`id`','jointype'=>'inner'));
							$data['rawdata']=$this->user_model->get_joins('tbl_user',$where_c,$join_c);
							
							@$userid=$data['rawdata'][0]['user_id'];
							
							$join_ct=array(array('table'=>'client_photos','condition'=>'`client_photos`.`c_id` = `client`.`id`','jointype'=>'inner'));
							$data['clientoldPhotos']=$this->user_model->get_joins('client',array('user_id'=>$userid),$join_ct,'','','',' `client_photos`.`id` DESC');
							
							$data['section']="photos";
							
							$data['photo_msg'] ='<div class="text-success-wrapper">Client Photos Added Successfully<span class="text-success-close">x</span></div>';
							//redirect(site_url().'stylist/addclient/'.$user_id);
						}
					}
					
			}
		}


		
		if(isset($_POST['edit_image']))
		{
			$client_photo_id=$this->input->post('client_photo_id');
			$old_pic=$this->input->post('old_pic[]');
			
			//print($old_pic);exit('-');
			$liname=$this->input->post('liname[]');
			$degree=$this->input->post('cropbox[]');
			$sortdiv=$this->input->post('sortdiv');
			$de_order=$this->input->post('de_order');
			
			$img_odrers=explode(',',$sortdiv);
			$rotation_angle=explode(',',$de_order);
		
			if(count($img_odrers)==2)
			{
				$nexval=max($img_odrers)+1;
				$sortdiv=$sortdiv.','.$nexval;
			}
			if(count($img_odrers)==1)
			{
				$sortdiv=$sortdiv.',0,0';
			}
			
			$uId=$this->input->post('hidden_uId');
			
			$tagids[]=$this->input->post('tagids');
			$chk_featured=$this->input->post('chk_featured');
			$chk_public=$this->input->post('chk_public');
			//print_r($degree);exit;
			if($chk_public=="")
			{
				$chk_public=0;
			}
			else
			{
				$chk_public=$chk_public;
			}
			if($chk_featured=="")
			{
				$chk_featured=0;
			}
			else
			{
				$chk_featured==$chk_featured;
			}
			
			if (!is_dir('./assets/uploads/'))
			{
				mkdir('./assets/uploads/', 0777, true);
				//chmod('/assets', 0777);
				//chmod('/assets/uploads', 0777);
			}
			
			if(!empty($tagids))
			{
				@$tags=implode(',',$tagids[0]);
			}
			else
			{
				$tags='';
			}
			
			if(!empty($_FILES['pic']['name'][0]))
			{
				$config = array();
				$config['upload_path'] = './assets/uploads/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				//$config['overwrite']     = true;
				
				$this->load->library('upload');
				$this->load->library('image_lib');
				
				$browse_count= count($_FILES['pic']['name']);
				$old_pic_count=count($old_pic);
				
				if(($old_pic_count+$browse_count)>3)
				{
					$data['photo_msg'] ='<div class="text-error">Only Three Images are allowed<span class="text-error-close">x</span></div>';
					$data['section'] ="photos";
				}
				else
				{
					if(empty($old_pic))
					{
						$old_pic=[];
					}
					
					$this->load->library('upload', $config);
					$files = $_FILES['pic'];
					$images = array();
					$i=0;
					foreach ($files['name'] as $key => $image)
					{
						$_FILES['pic[]']['name']= $files['name'][$key];
						$_FILES['pic[]']['type']= $files['type'][$key];
						$_FILES['pic[]']['tmp_name']= $files['tmp_name'][$key];
						$_FILES['pic[]']['error']= $files['error'][$key];
						$_FILES['pic[]']['size']= $files['size'][$key];
						
						$fileName = $image;
						$config['file_name'] = $fileName;
						
						$this->upload->initialize($config);
						$is_upload=$this->upload->do_upload('pic[]');
						
						$base_url=base_url();
						$uploaded_img_name=$this->upload->data('file_name');
						
						array_push($old_pic,$uploaded_img_name);
						
				/*		
						$config['image_library'] = 'gd2';
						$config['source_image'] = $this->upload->data('full_path');
						$config['width']     = 600;
						$config['height']   = 600;
						
						$this->image_lib->clear();
						$this->image_lib->initialize($config);
						
						$res=$this->image_lib->resize();
					*/	
						$this->image_lib->clear();
						$config['wm_text'] = 'Inhairent';
						$config['wm_type'] = 'text';
						$config['wm_font_size'] = '12';
					//	$config['wm_font_path'] = './assets/fonts/glyphicons-halflings-regular.ttf';
						$config['wm_font_color'] = '68268a';
						$config['wm_vrt_alignment'] = 'bottom';
						$config['wm_hor_alignment'] = 'center';
						//$config['wm_padding'] = '20';
						
						$this->image_lib->initialize($config);
						$this->image_lib->watermark();
						
						$this->_createThumbnails($uploaded_img_name);
					}
					$newArray='';
					foreach( $degree as $origKey => $value )
					{
						// New key that we will insert into $newArray with
						$newKey = $img_odrers[$origKey];
						$newArray[$newKey] = $value;
					}
					/*
					echo"<pre>";
					print_r($img_odrers);
					print_r($degree);
					print_r($old_pic);
					print_r($newArray);
					print_r($this->upload->data());
					exit;*/
					if($this->upload->do_upload('pic[]'))
					{

						$i=0;
						$client_image='';
						foreach($old_pic as $pic)
						{
							$dir= getcwd().'/assets/uploads/';
							//echo $dir;exit;
							$url = $pic;
							$client_image[]=$url;
							$basename = basename($url);
				
							$degrees = 360-$newArray[$i];
							$info = new SplFileInfo($basename);
							$extention=strtolower($info->getExtension());
							
							switch ($extention)
							{
								case 'jpg':

						/**			// Load
									$source = imagecreatefromjpeg($dir.'/'.$basename);
									// Rotate
									$rotate = imagerotate($source, $degrees, imageColorAllocateAlpha($source, 0, 0, 0, 127));
									// Output
									imagejpeg($rotate, $dir.'/'.$basename, 90);
									chmod($dir.'/'.$basename, 0777);
*/
									// Load
									$source_113x113 = imagecreatefromjpeg($dir.'thumbnails/113x113/'.$basename);
									// Rotate
									$rotate_113x113 = imagerotate($source_113x113, $degrees, imageColorAllocateAlpha($source_113x113, 0, 0, 0, 127));
									// Output
									imagejpeg($rotate_113x113, $dir.'thumbnails/113x113/'.$basename, 90);
									chmod($dir.'thumbnails/113x113/'.$basename, 0777);

									// Load
									$source_130x130 = imagecreatefromjpeg($dir.'thumbnails/130x130/'.$basename);
									// Rotate
									$rotate_130x130 = imagerotate($source_130x130, $degrees, imageColorAllocateAlpha($source_130x130, 0, 0, 0, 127));
									// Output
									imagejpeg($rotate_130x130, $dir.'thumbnails/130x130/'.$basename, 90);
									chmod($dir.'thumbnails/130x130/'.$basename, 0777);

									// Load
									$source_150x150 = imagecreatefromjpeg($dir.'thumbnails/150x150/'.$basename);
									// Rotate
									$rotate_150x150 = imagerotate($source_150x150, $degrees, imageColorAllocateAlpha($source_150x150, 0, 0, 0, 127));
									// Output
									imagejpeg($rotate_150x150, $dir.'thumbnails/150x150/'.$basename, 90);
									chmod($dir.'thumbnails/150x150/'.$basename, 0777);

									// Load
									$source_244x244 = imagecreatefromjpeg($dir.'thumbnails/244x244/'.$basename);
									// Rotate
									$rotate_244x244 = imagerotate($source_244x244, $degrees, imageColorAllocateAlpha($source_244x244, 0, 0, 0, 127));
									// Output
									imagejpeg($rotate_244x244, $dir.'thumbnails/244x244/'.$basename, 90);
									chmod($dir.'thumbnails/244x244/'.$basename, 0777);

									// Load
									$source_600x600 = imagecreatefromjpeg($dir.'thumbnails/600x600/'.$basename);
									// Rotate
									$rotate_600x600 = imagerotate($source_600x600, $degrees, imageColorAllocateAlpha($source_600x600, 0, 0, 0, 127));
									// Output
									imagejpeg($rotate_600x600, $dir.'thumbnails/600x600/'.$basename, 90);
									chmod($dir.'thumbnails/600x600/'.$basename, 0777);
		/*echo $dir;
		echo $basename;exit;*/
									break;
								case 'jpeg':
			/*						
														
									// Load
									$source = imagecreatefromjpeg($dir.'/'.$basename);
									// Rotate
									$rotate = imagerotate($source, $degrees, imageColorAllocateAlpha($source, 0, 0, 0, 127));
									// Output
									imagejpeg($rotate, $dir.'/'.$basename, 90);
									chmod($dir.'/'.$basename, 0777);
*/
									// Load
									$source_113x113 = imagecreatefromjpeg($dir.'thumbnails/113x113/'.$basename);
									// Rotate
									$rotate_113x113 = imagerotate($source_113x113, $degrees, imageColorAllocateAlpha($source_113x113, 0, 0, 0, 127));
									// Output
									imagejpeg($rotate_113x113, $dir.'thumbnails/113x113/'.$basename, 90);
									chmod($dir.'thumbnails/113x113/'.$basename, 0777);

									// Load
									$source_130x130 = imagecreatefromjpeg($dir.'thumbnails/130x130/'.$basename);
									// Rotate
									$rotate_130x130 = imagerotate($source_130x130, $degrees, imageColorAllocateAlpha($source_130x130, 0, 0, 0, 127));
									// Output
									imagejpeg($rotate_130x130, $dir.'thumbnails/130x130/'.$basename, 90);
									chmod($dir.'thumbnails/130x130/'.$basename, 0777);

									// Load
									$source_150x150 = imagecreatefromjpeg($dir.'thumbnails/150x150/'.$basename);
									// Rotate
									$rotate_150x150 = imagerotate($source_150x150, $degrees, imageColorAllocateAlpha($source_150x150, 0, 0, 0, 127));
									// Output
									imagejpeg($rotate_150x150, $dir.'thumbnails/150x150/'.$basename, 90);
									chmod($dir.'thumbnails/150x150/'.$basename, 0777);

									// Load
									$source_244x244 = imagecreatefromjpeg($dir.'thumbnails/244x244/'.$basename);
									// Rotate
									$rotate_244x244 = imagerotate($source_244x244, $degrees, imageColorAllocateAlpha($source_244x244, 0, 0, 0, 127));
									// Output
									imagejpeg($rotate_244x244, $dir.'thumbnails/244x244/'.$basename, 90);
									chmod($dir.'thumbnails/244x244/'.$basename, 0777);

									// Load
									$source_600x600 = imagecreatefromjpeg($dir.'thumbnails/600x600/'.$basename);
									// Rotate
									$rotate_600x600 = imagerotate($source_600x600, $degrees, imageColorAllocateAlpha($source_600x600, 0, 0, 0, 127));
									// Output
									imagejpeg($rotate_600x600, $dir.'thumbnails/600x600/'.$basename, 90);
									chmod($dir.'thumbnails/600x600/'.$basename, 0777);
		/*echo $dir."<br>";
		echo $basename;exit;*/
									break;
								case 'png':

			/*						// Load
									@$source = imageCreateFromPNG($dir.'/'.$basename);
									imagealphablending($source, false);
									imagesavealpha($source, true);
									// Rotate
									@$rotate = imagerotate($source, $degrees, imageColorAllocateAlpha($source, 0, 0, 0, 127));
									imagealphablending($rotate, false);
									imagesavealpha($rotate, true);
									// Output
									@imagepng($rotate, $dir.'/'.$basename);
									@chmod($dir.'/'.$basename, 0777);
*/
									// Load
									@$source_113x113 = imageCreateFromPNG($dir.'thumbnails/113x113/'.$basename);
									imagealphablending($source_113x113, false);
									imagesavealpha($source_113x113, true);
									// Rotate
									@$rotate_113x113 = imagerotate($source_113x113, $degrees, imageColorAllocateAlpha($source_113x113, 0, 0, 0, 127));
									imagealphablending($rotate_113x113, false);
									imagesavealpha($rotate_113x113, true);
									// Output
									@imagepng($rotate_113x113, $dir.'thumbnails/113x113/'.$basename);
									@chmod($dir.'thumbnails/113x113/'.$basename, 0777);

									// Load
									@$source_130x130 = imageCreateFromPNG($dir.'thumbnails/130x130/'.$basename);
									imagealphablending($source_130x130, false);
									imagesavealpha($source_130x130, true);
									// Rotate
									@$rotate_130x130 = imagerotate($source_130x130, $degrees, imageColorAllocateAlpha($source_130x130, 0, 0, 0, 127));
									imagealphablending($rotate_130x130, false);
									imagesavealpha($rotate_130x130, true);
									// Output
									@imagepng($rotate_130x130, $dir.'thumbnails/130x130/'.$basename);
									@chmod($dir.'thumbnails/130x130/'.$basename, 0777);

									// Load
									@$source_150x150 = imageCreateFromPNG($dir.'thumbnails/150x150/'.$basename);
									imagealphablending($source_150x150, false);
									imagesavealpha($source_150x150, true);
									// Rotate
									@$rotate_150x150 = imagerotate($source_150x150, $degrees, imageColorAllocateAlpha($source_150x150, 0, 0, 0, 127));
									imagealphablending($rotate_150x150, false);
									imagesavealpha($rotate_150x150, true);
									// Output
									@imagepng($rotate_150x150, $dir.'thumbnails/150x150/'.$basename);
									@chmod($dir.'thumbnails/150x150/'.$basename, 0777);

									// Load
									@$source_244x244 = imageCreateFromPNG($dir.'thumbnails/244x244/'.$basename);
									imagealphablending($source_244x244, false);
									imagesavealpha($source_244x244, true);
									// Rotate
									@$rotate_244x244 = imagerotate($source_244x244, $degrees, imageColorAllocateAlpha($source_244x244, 0, 0, 0, 127));
									imagealphablending($rotate_244x244, false);
									imagesavealpha($rotate_244x244, true);
									// Output
									@imagepng($rotate_244x244, $dir.'thumbnails/244x244/'.$basename);
									@chmod($dir.'thumbnails/244x244/'.$basename, 0777);

									// Load
									@$source_600x600 = imageCreateFromPNG($dir.'thumbnails/600x600/'.$basename);
									imagealphablending($source_600x600, false);
									imagesavealpha($source_600x600, true);
									// Rotate
									@$rotate_600x600 = imagerotate($source_600x600, $degrees, imageColorAllocateAlpha($source_600x600, 0, 0, 0, 127));
									imagealphablending($rotate_600x600, false);
									imagesavealpha($rotate_600x600, true);
									// Output
									@imagepng($rotate_600x600, $dir.'thumbnails/600x600/'.$basename);
									@chmod($dir.'thumbnails/600x600/'.$basename, 0777);
		/*echo $dir;
		echo $basename;exit;*/
									break;
								case 'gif':
									
				/*					
									// Load
									@$source = imagecreatefromgif($dir.'/'.$basename);
									// Rotate
									@$rotate = imagerotate($source, $degrees, imageColorAllocateAlpha($source, 0, 0, 0, 127));
									// Output
									@imagegif($rotate, $dir.'/'.$basename);
									@chmod($dir.'/'.$basename, 0777);
				*/					
									// Load
									@$source_113x113 = imagecreatefromgif($dir.'thumbnails/113x113/'.$basename);
									// Rotate
									@$rotate_113x113 = imagerotate($source_113x113, $degrees, imageColorAllocateAlpha($source_113x113, 0, 0, 0, 127));
									// Output
									@imagegif($rotate_113x113, $dir.'thumbnails/113x113/'.$basename);
									@chmod($dir.'thumbnails/113x113/'.$basename, 0777);
									
									// Load
									@$source_130x130 = imagecreatefromgif($dir.'thumbnails/130x130/'.$basename);
									// Rotate
									@$rotate_130x130 = imagerotate($source_130x130, $degrees, imageColorAllocateAlpha($source_130x130, 0, 0, 0, 127));
									// Output
									@imagegif($rotate_130x130, $dir.'thumbnails/130x130/'.$basename);
									@chmod($dir.'thumbnails/130x130/'.$basename, 0777);
									
									// Load
									@$source_150x150 = imagecreatefromgif($dir.'thumbnails/150x150/'.$basename);
									// Rotate
									@$rotate_150x150 = imagerotate($source_150x150, $degrees, imageColorAllocateAlpha($source_150x150, 0, 0, 0, 127));
									// Output
									@imagegif($rotate_150x150, $dir.'thumbnails/150x150/'.$basename);
									@chmod($dir.'thumbnails/150x150/'.$basename, 0777);
									
									// Load
									@$source_244x244 = imagecreatefromgif($dir.'thumbnails/244x244/'.$basename);
									// Rotate
									@$rotate_244x244 = imagerotate($source_244x244, $degrees, imageColorAllocateAlpha($source_244x244, 0, 0, 0, 127));
									// Output
									@imagegif($rotate_244x244, $dir.'thumbnails/244x244/'.$basename);
									@chmod($dir.'thumbnails/244x244/'.$basename, 0777);
									
									// Load
									@$source_600x600 = imagecreatefromgif($dir.'thumbnails/600x600/'.$basename);
									// Rotate
									@$rotate_600x600 = imagerotate($source_600x600, $degrees, imageColorAllocateAlpha($source_600x600, 0, 0, 0, 127));
									// Output
									@imagegif($rotate, $dir.'thumbnails/600x600/'.$basename);
									@chmod($dir.'thumbnails/600x600/'.$basename, 0777);
		/*							
		echo $dir;
		echo $basename;exit;*/
									break;
									
								default:
							}
				
							$i++;
						}
							$client_images=implode(',',$client_image);
							//echo $client_images;
							//echo $sortdiv;exit;
							$updatedata=array('tagid'=>$tags, 'featured'=>$chk_featured, 'public'=>$chk_public, 'photos'=>$client_images, 'photo_order'=>$sortdiv);
							$isupdate=$this->user_model->UPDATEDATA('client_photos', array('id'=>$client_photo_id),$updatedata);
							if($isupdate)
							{
								$this->session->set_flashdata('reload', 'reload');
								$data['photo_msg'] ='<div class="text-success-wrapper">Client Photos Added Successfully<span class="text-success-close">x</span></div>';
								$data['reload'] ="reload";
								$data['section'] ="photos-part";
							}
							else
							{
								$data['photo_msg'] ='<div class="text-error">Image Update Failed<span class="text-error-close">x</span></div>';
								$data['section'] ="photos";
							}
					}
					else
					{
						$data['photo_msg'] ='<div class="text-error">Image Update Failed<span class="text-error-close">x</span></div>';
						$data['section'] ="photos";
					}
					
				}
			}
			else
			{
				if(($old_pic_count+$browse_count)>3)
				{
					$data['photo_msg'] ='<div class="text-error">Only Three Images are allowed<span class="text-error-close">x</span></div>';
					$data['section'] ="photos";
				}
				else
				{
				$i=0;
				$client_image='';
				foreach($old_pic as $pic)
				{
					$dir= getcwd().'/assets/uploads/';
					//echo $dir;exit;
					$url = $pic;
					$client_image[]=$url;
					$basename = basename($url);

					$degrees = 360-$degree[$i];
					$info = new SplFileInfo($basename);
					$extention=strtolower($info->getExtension());
					
					//echo $uploadpath.$basename;exit;
					//echo $extention;exit;
					switch ($extention)
					{
								case 'jpg':
/*
									// Load
									$source = imagecreatefromjpeg($dir.'/'.$basename);
									// Rotate
									$rotate = imagerotate($source, $degrees, imageColorAllocateAlpha($source, 0, 0, 0, 127));
									// Output
									imagejpeg($rotate, $dir.'/'.$basename, 90);
									chmod($dir.'/'.$basename, 0777);
*/
									// Load
									$source_113x113 = imagecreatefromjpeg($dir.'thumbnails/113x113/'.$basename);
									// Rotate
									$rotate_113x113 = imagerotate($source_113x113, $degrees, imageColorAllocateAlpha($source_113x113, 0, 0, 0, 127));
									// Output
									imagejpeg($rotate_113x113, $dir.'thumbnails/113x113/'.$basename, 90);
									chmod($dir.'thumbnails/113x113/'.$basename, 0777);

									// Load
									$source_130x130 = imagecreatefromjpeg($dir.'thumbnails/130x130/'.$basename);
									// Rotate
									$rotate_130x130 = imagerotate($source_130x130, $degrees, imageColorAllocateAlpha($source_130x130, 0, 0, 0, 127));
									// Output
									imagejpeg($rotate_130x130, $dir.'thumbnails/130x130/'.$basename, 90);
									chmod($dir.'thumbnails/130x130/'.$basename, 0777);

									// Load
									$source_150x150 = imagecreatefromjpeg($dir.'thumbnails/150x150/'.$basename);
									// Rotate
									$rotate_150x150 = imagerotate($source_150x150, $degrees, imageColorAllocateAlpha($source_150x150, 0, 0, 0, 127));
									// Output
									imagejpeg($rotate_150x150, $dir.'thumbnails/150x150/'.$basename, 90);
									chmod($dir.'thumbnails/150x150/'.$basename, 0777);

									// Load
									$source_244x244 = imagecreatefromjpeg($dir.'thumbnails/244x244/'.$basename);
									// Rotate
									$rotate_244x244 = imagerotate($source_244x244, $degrees, imageColorAllocateAlpha($source_244x244, 0, 0, 0, 127));
									// Output
									imagejpeg($rotate_244x244, $dir.'thumbnails/244x244/'.$basename, 90);
									chmod($dir.'thumbnails/244x244/'.$basename, 0777);

									// Load
									$source_600x600 = imagecreatefromjpeg($dir.'thumbnails/600x600/'.$basename);
									// Rotate
									$rotate_600x600 = imagerotate($source_600x600, $degrees, imageColorAllocateAlpha($source_600x600, 0, 0, 0, 127));
									// Output
									imagejpeg($rotate_600x600, $dir.'thumbnails/600x600/'.$basename, 90);
									chmod($dir.'thumbnails/600x600/'.$basename, 0777);
		/*echo $dir;
		echo $basename;exit;*/
									break;
								case 'jpeg':
	/*								
														
									// Load
									$source = imagecreatefromjpeg($dir.'/'.$basename);
									// Rotate
									$rotate = imagerotate($source, $degrees, imageColorAllocateAlpha($source, 0, 0, 0, 127));
									// Output
									imagejpeg($rotate, $dir.'/'.$basename, 90);
									chmod($dir.'/'.$basename, 0777);
*/
									// Load
									$source_113x113 = imagecreatefromjpeg($dir.'thumbnails/113x113/'.$basename);
									// Rotate
									$rotate_113x113 = imagerotate($source_113x113, $degrees, imageColorAllocateAlpha($source_113x113, 0, 0, 0, 127));
									// Output
									imagejpeg($rotate_113x113, $dir.'thumbnails/113x113/'.$basename, 90);
									chmod($dir.'thumbnails/113x113/'.$basename, 0777);

									// Load
									$source_130x130 = imagecreatefromjpeg($dir.'thumbnails/130x130/'.$basename);
									// Rotate
									$rotate_130x130 = imagerotate($source_130x130, $degrees, imageColorAllocateAlpha($source_130x130, 0, 0, 0, 127));
									// Output
									imagejpeg($rotate_130x130, $dir.'thumbnails/130x130/'.$basename, 90);
									chmod($dir.'thumbnails/130x130/'.$basename, 0777);

									// Load
									$source_150x150 = imagecreatefromjpeg($dir.'thumbnails/150x150/'.$basename);
									// Rotate
									$rotate_150x150 = imagerotate($source_150x150, $degrees, imageColorAllocateAlpha($source_150x150, 0, 0, 0, 127));
									// Output
									imagejpeg($rotate_150x150, $dir.'thumbnails/150x150/'.$basename, 90);
									chmod($dir.'thumbnails/150x150/'.$basename, 0777);

									// Load
									$source_244x244 = imagecreatefromjpeg($dir.'thumbnails/244x244/'.$basename);
									// Rotate
									$rotate_244x244 = imagerotate($source_244x244, $degrees, imageColorAllocateAlpha($source_244x244, 0, 0, 0, 127));
									// Output
									imagejpeg($rotate_244x244, $dir.'thumbnails/244x244/'.$basename, 90);
									chmod($dir.'thumbnails/244x244/'.$basename, 0777);

									// Load
									$source_600x600 = imagecreatefromjpeg($dir.'thumbnails/600x600/'.$basename);
									// Rotate
									$rotate_600x600 = imagerotate($source_600x600, $degrees, imageColorAllocateAlpha($source_600x600, 0, 0, 0, 127));
									// Output
									imagejpeg($rotate_600x600, $dir.'thumbnails/600x600/'.$basename, 90);
									chmod($dir.'thumbnails/600x600/'.$basename, 0777);
		/*echo $dir."<br>";
		echo $basename;exit;*/
									break;
								case 'png':
/*
									// Load
									@$source = imageCreateFromPNG($dir.'/'.$basename);
									imagealphablending($source, false);
									imagesavealpha($source, true);
									// Rotate
									@$rotate = imagerotate($source, $degrees, imageColorAllocateAlpha($source, 0, 0, 0, 127));
									imagealphablending($rotate, false);
									imagesavealpha($rotate, true);
									// Output
									@imagepng($rotate, $dir.'/'.$basename);
									@chmod($dir.'/'.$basename, 0777);
*/
									// Load
									@$source_113x113 = imageCreateFromPNG($dir.'thumbnails/113x113/'.$basename);
									imagealphablending($source_113x113, false);
									imagesavealpha($source_113x113, true);
									// Rotate
									@$rotate_113x113 = imagerotate($source_113x113, $degrees, imageColorAllocateAlpha($source_113x113, 0, 0, 0, 127));
									imagealphablending($rotate_113x113, false);
									imagesavealpha($rotate_113x113, true);
									// Output
									@imagepng($rotate_113x113, $dir.'thumbnails/113x113/'.$basename);
									@chmod($dir.'thumbnails/113x113/'.$basename, 0777);

									// Load
									@$source_130x130 = imageCreateFromPNG($dir.'thumbnails/130x130/'.$basename);
									imagealphablending($source_130x130, false);
									imagesavealpha($source_130x130, true);
									// Rotate
									@$rotate_130x130 = imagerotate($source_130x130, $degrees, imageColorAllocateAlpha($source_130x130, 0, 0, 0, 127));
									imagealphablending($rotate_130x130, false);
									imagesavealpha($rotate_130x130, true);
									// Output
									@imagepng($rotate_130x130, $dir.'thumbnails/130x130/'.$basename);
									@chmod($dir.'thumbnails/130x130/'.$basename, 0777);

									// Load
									@$source_150x150 = imageCreateFromPNG($dir.'thumbnails/150x150/'.$basename);
									imagealphablending($source_150x150, false);
									imagesavealpha($source_150x150, true);
									// Rotate
									@$rotate_150x150 = imagerotate($source_150x150, $degrees, imageColorAllocateAlpha($source_150x150, 0, 0, 0, 127));
									imagealphablending($rotate_150x150, false);
									imagesavealpha($rotate_150x150, true);
									// Output
									@imagepng($rotate_150x150, $dir.'thumbnails/150x150/'.$basename);
									@chmod($dir.'thumbnails/150x150/'.$basename, 0777);

									// Load
									@$source_244x244 = imageCreateFromPNG($dir.'thumbnails/244x244/'.$basename);
									imagealphablending($source_244x244, false);
									imagesavealpha($source_244x244, true);
									// Rotate
									@$rotate_244x244 = imagerotate($source_244x244, $degrees, imageColorAllocateAlpha($source_244x244, 0, 0, 0, 127));
									imagealphablending($rotate_244x244, false);
									imagesavealpha($rotate_244x244, true);
									// Output
									@imagepng($rotate_244x244, $dir.'thumbnails/244x244/'.$basename);
									@chmod($dir.'thumbnails/244x244/'.$basename, 0777);

									// Load
									@$source_600x600 = imageCreateFromPNG($dir.'thumbnails/600x600/'.$basename);
									imagealphablending($source_600x600, false);
									imagesavealpha($source_600x600, true);
									// Rotate
									@$rotate_600x600 = imagerotate($source_600x600, $degrees, imageColorAllocateAlpha($source_600x600, 0, 0, 0, 127));
									imagealphablending($rotate_600x600, false);
									imagesavealpha($rotate_600x600, true);
									// Output
									@imagepng($rotate_600x600, $dir.'thumbnails/600x600/'.$basename);
									@chmod($dir.'thumbnails/600x600/'.$basename, 0777);
		/*echo $dir;
		echo $basename;exit;*/
									break;
								case 'gif':
				/*					
									
									// Load
									@$source = imagecreatefromgif($dir.'/'.$basename);
									// Rotate
									@$rotate = imagerotate($source, $degrees, imageColorAllocateAlpha($source, 0, 0, 0, 127));
									// Output
									@imagegif($rotate, $dir.'/'.$basename);
									@chmod($dir.'/'.$basename, 0777);
				*/					
									// Load
									@$source_113x113 = imagecreatefromgif($dir.'thumbnails/113x113/'.$basename);
									// Rotate
									@$rotate_113x113 = imagerotate($source_113x113, $degrees, imageColorAllocateAlpha($source_113x113, 0, 0, 0, 127));
									// Output
									@imagegif($rotate_113x113, $dir.'thumbnails/113x113/'.$basename);
									@chmod($dir.'thumbnails/113x113/'.$basename, 0777);
									
									// Load
									@$source_130x130 = imagecreatefromgif($dir.'thumbnails/130x130/'.$basename);
									// Rotate
									@$rotate_130x130 = imagerotate($source_130x130, $degrees, imageColorAllocateAlpha($source_130x130, 0, 0, 0, 127));
									// Output
									@imagegif($rotate_130x130, $dir.'thumbnails/130x130/'.$basename);
									@chmod($dir.'thumbnails/130x130/'.$basename, 0777);
									
									// Load
									@$source_150x150 = imagecreatefromgif($dir.'thumbnails/150x150/'.$basename);
									// Rotate
									@$rotate_150x150 = imagerotate($source_150x150, $degrees, imageColorAllocateAlpha($source_150x150, 0, 0, 0, 127));
									// Output
									@imagegif($rotate_150x150, $dir.'thumbnails/150x150/'.$basename);
									@chmod($dir.'thumbnails/150x150/'.$basename, 0777);
									
									// Load
									@$source_244x244 = imagecreatefromgif($dir.'thumbnails/244x244/'.$basename);
									// Rotate
									@$rotate_244x244 = imagerotate($source_244x244, $degrees, imageColorAllocateAlpha($source_244x244, 0, 0, 0, 127));
									// Output
									@imagegif($rotate_244x244, $dir.'thumbnails/244x244/'.$basename);
									@chmod($dir.'thumbnails/244x244/'.$basename, 0777);
									
									// Load
									@$source_600x600 = imagecreatefromgif($dir.'thumbnails/600x600/'.$basename);
									// Rotate
									@$rotate_600x600 = imagerotate($source_600x600, $degrees, imageColorAllocateAlpha($source_600x600, 0, 0, 0, 127));
									// Output
									@imagegif($rotate, $dir.'thumbnails/600x600/'.$basename);
									@chmod($dir.'thumbnails/600x600/'.$basename, 0777);
		/*							
		echo $dir;
		echo $basename;exit;*/
									break;
									
								default:
							}
				
					$i++;
				}
					$client_images=implode(',',$client_image);
				//	echo"<pre>";print_r($client_images);exit;
					$updatedata=array('tagid'=>$tags, 'featured'=>$chk_featured, 'public'=>$chk_public, 'photos'=>$client_images, 'photo_order'=>'0,1,2');
					$isupdate=$this->user_model->UPDATEDATA('client_photos', array('id'=>$client_photo_id),$updatedata);
					if($isupdate)
					{
						
						$data['photo_msg'] ='<div class="text-success-wrapper">Client Photos Updated Successfully<span class="text-success-close">x</span></div>';
						$data['section'] ="photos";
					}
					else
					{
						$data['photo_msg'] ='<div class="text-error">Image Update Failed<span class="text-error-close">x</span></div>';
						$data['section'] ="photos";
						//$this->session->set_flashdata('email_pic_msg', '<b style="color:red;">Image Update Failed</b>');
						//redirect(site_url().'stylist/addclient/'.$uId.'#photos-part');
					}
				}
			}
		}

		
		/*End of 3rd Isset*/
		
		if(isset($_POST['suggested_product']))
		{
			if($this->session->userdata('package')=="DELUXE")
			{
				$data['message_product']='<div class="text-error">You Are Not Authorized To Access This Page<span class="text-error-close">x</span></div>';
				$data['section']="product";
			}
			else
			{
				$sessionid=$this->session->userdata('id');
				$data['alldensity']=$this->user_model->getalldensity();
				$data['allcolor']=$this->user_model->getallcolor();
				$data['alltexture']=$this->user_model->getalltexture();
				$data['allethnicity']=$this->user_model->getallethnicity();
				$data['alltags']=$this->user_model->getalltag();
				$data['allcategory']=$this->user_model->getallcategory();
				$data['allbrands']=$this->user_model->getallbrands();
				
				$ethnicity=trim($this->input->post('ethnicity'));
				$hair_color=$this->input->post('hair_color');
				$hair_texture=$this->input->post('hair_texture');
				$hair_density=$this->input->post('hair_density');
				
				$where=array('tbl_ethnicity.id'=>$ethnicity,'tbl_texture.id'=>$hair_texture,'tbl_color.name'=>$hair_color,'tbl_density.density'=>$hair_density);

				$fields=array('category.name as category_name','brand.name as brand_name', 'product.id as product_id', 'product.name', 'product.description', 'product.price', 'product.tagid', 'product.image');
				$join=array(
							array('table'=>'stylist','condition'=>'`stylist`.`id` = `stylist_product`.`s_id`','jointype'=>'inner'),
						array('table'=>'tbl_user','condition'=>'`tbl_user`.`id` = `stylist`.`user_id`','jointype'=>'inner'),
						array('table'=>'brand','condition'=>'`brand`.`id` = `stylist_product`.`brand_id`','jointype'=>'inner'),
						
						array('table'=>'product','condition'=>'`product`.`brand_id` = `stylist_product`.`brand_id`','jointype'=>'inner'),
						array('table'=>'category','condition'=>'`category`.`id` = `product`.`categoryid`','jointype'=>'inner'),
						
						array('table'=>'pro_color','condition'=>'`product`.`id` = `pro_color`.`product_id`','jointype'=>'inner'),
						array('table'=>'tbl_color','condition'=>'`tbl_color`.`id` = `pro_color`.`color_id`','jointype'=>'inner'),
						
						array('table'=>'pro_density','condition'=>'`product`.`id` = `pro_density`.`product_id`','jointype'=>'inner'),
						array('table'=>'tbl_density','condition'=>'`tbl_density`.`id` = `pro_density`.`density_id`','jointype'=>'inner'),
					
						array('table'=>'pro_ethnicity','condition'=>'`product`.`id` = `pro_ethnicity`.`product_id`','jointype'=>'inner'),
						array('table'=>'tbl_ethnicity','condition'=>'`tbl_ethnicity`.`id` = `pro_ethnicity`.`ethnicity_id`','jointype'=>'inner'),
					
						array('table'=>'pro_texture','condition'=>'`product`.`id` = `pro_texture`.`product_id`','jointype'=>'inner'),
						array('table'=>'tbl_texture','condition'=>'`tbl_texture`.`id` = `pro_texture`.`texture_id`','jointype'=>'inner'),
						);
				
				$data['suggestedproduct']=$this->user_model->get_joins('stylist_product',array('tbl_user.id'=>$sessionid),$join,$fields,$where,'product.id','brand.name');
				$data['section']="product";
				if(empty($data['suggestedproduct']))
				{
					$data['message_product'] ='<div class="text-error">No Matching Product found<span class="text-error-close">x</span></div>';
					$data['section']="product";
				}
			}

		}
		
		/*End of 4th Isset*/
		
		if(isset($_POST['all_product']))
		{
			if($this->session->userdata('package')=="DELUXE")
			{
				$data['message_product']='<div class="text-error">You Are Not Authorized To Access This Page<span class="text-error-close">x</span></div>';
				$data['section']="product";

			}
			else
			{

				$data['alldensity']=$this->user_model->getalldensity();
				$data['allcolor']=$this->user_model->getallcolor();
				$data['alltexture']=$this->user_model->getalltexture();
				$data['allethnicity']=$this->user_model->getallethnicity();
				$data['alltags']=$this->user_model->getalltag();
				$data['allcategory']=$this->user_model->getallcategory();
				$data['allbrands']=$this->user_model->getallbrands();

				$sessionid=$this->session->userdata('id');
				
				$join_stylist=array(
							array('table'=>'stylist','condition'=>'`stylist`.`id` = `stylist_product`.`s_id`','jointype'=>'inner'),
							array('table'=>'tbl_user','condition'=>'`tbl_user`.`id` = `stylist`.`user_id`','jointype'=>'inner'),
							array('table'=>'brand','condition'=>'`brand`.`id` = `stylist_product`.`brand_id`','jointype'=>'inner'),
							array('table'=>'product','condition'=>'`product`.`brand_id` = `stylist_product`.`brand_id`','jointype'=>'inner'),
							array('table'=>'category','condition'=>'`category`.`id` = `product`.`categoryid`','jointype'=>'inner'),
							);
				//$fields=array('tbl_user.id as user_id', 'product.id as product_id', 'product.name as product_name', 'product.image as image', 'product.price as price', 'product.description as product_desc', 'brand.id as brand_id', 'brand.name as brand_name', 'category.id as category_id', 'category.name as category_name', 'stylist_product.s_id as s_id', );
				$fields=array('category.name as category_name','brand.name as brand_name', 'product.id as product_id', 'product.name', 'product.description', 'product.price', 'product.tagid', 'product.image');
				$data['suggestedproduct'] = $this->user_model->get_joins('stylist_product',array('tbl_user.id'=>$sessionid),$join_stylist,$fields,'','product.id','brand.name');
				$data['section']="product";
				if(empty($data['suggestedproduct']))
				{
					$data['message_product'] ='<div class="text-error">You Have Not Selected any Brand <span class="text-error-close">x</span></div>';
					$data['section']="product";
					
				}
			}
		}
		
		/*End of 5th Isset*/
		
		if(isset($_POST['selected_product']))
		{
			if($this->session->userdata('package')=="DELUXE")
			{
				$data['message_product']='<div class="text-error">You Are Not Authorized To Access This Page<span class="text-error-close">x</span></div>';
				$data['section']="product";
			}
			else
			{

				$sessionid=$this->session->userdata('id');
				
				$data['alldensity']=$this->user_model->getalldensity();
				$data['allcolor']=$this->user_model->getallcolor();
				$data['alltexture']=$this->user_model->getalltexture();
				$data['allethnicity']=$this->user_model->getallethnicity();
				$data['alltags']=$this->user_model->getalltag();
				$data['allcategory']=$this->user_model->getallcategory();
				$data['allbrands']=$this->user_model->getallbrands();
				
				$where_email=array('email'=>$email);
				
				$join=array(
							array('table'=>'client','condition'=>'`tbl_user`.`id` = `client`.`user_id`','jointype'=>'inner')
							);
				$data['clientinfo']=$this->user_model->get_joins('tbl_user',$where_email,$join);
				if(empty($data['clientinfo']))
				{
					$data['message_product'] ='<div class="text-error">Client Details Not Found<span class="text-error-close">x</span></div>';
					$data['section']="product";
					
				}
				else
				{					
					@$c_id=$data['clientinfo'][0]['id'];
					@$s_id=$data['clientinfo'][0]['s_id'];
					$where_sel=array('tbl_selected_products.c_id'=>$c_id,'tbl_selected_products.s_id'=>$s_id);
					
					$fields=array('category.name as category_name','brand.id as brand_id', 'brand.name as brand_name', 'product.id as product_id', 'product.name', 'product.description', 'product.price', 'product.tagid', 'product.image', 'client.id as c_id', 'client.s_id as s_id', 'client.user_id as user_id');
					$join=array(
								array('table'=>'client','condition'=>'`tbl_selected_products`.`c_id` = `client`.`id`','jointype'=>'inner'),
								array('table'=>'tbl_user','condition'=>'`tbl_user`.`id` = `client`.`user_id`','jointype'=>'inner'),
								array('table'=>'product','condition'=>'`product`.`id` = `tbl_selected_products`.`selected_id`','jointype'=>'inner'),
								array('table'=>'brand','condition'=>'`product`.`brand_id` = `brand`.`id`','jointype'=>'inner'),
								array('table'=>'category','condition'=>'`product`.`categoryid` = `category`.`id`','jointype'=>'inner'),
								);
					
					$data['selected_product']=$this->user_model->get_joins('tbl_selected_products',$where_sel,$join,$fields);
					
					$join_p=array(
							array('table'=>'stylist','condition'=>'`stylist`.`id` = `stylist_product`.`s_id`','jointype'=>'inner'),
							array('table'=>'tbl_user','condition'=>'`tbl_user`.`id` = `stylist`.`user_id`','jointype'=>'inner'),
							array('table'=>'product','condition'=>'`product`.`brand_id` = `stylist_product`.`brand_id`','jointype'=>'inner'),
							array('table'=>'category','condition'=>'`product`.`categoryid` = `category`.`id`','jointype'=>'inner'),
							array('table'=>'brand','condition'=>'`product`.`brand_id` = `brand`.`id`','jointype'=>'inner'),
							);
				
					$data['stylists_products']=$this->user_model->get_joins('stylist_product',array('stylist.user_id'=>$sessionid),$join_p,array('stylist_product.id','stylist_product.brand_id',),'','brand.id');
					$data['section']="product";
					
					if(empty($data['selected_product']))
					{
						$data['message_product'] ='<div class="text-error">You have not selected any Product<span class="text-error-close">x</span></div>';
						$data['section']="product";
						
					}
				}
			}
		}
		
		/*End of 6th Isset*/
		
		if(isset($_POST['build_product']))
		{
			if($this->session->userdata('package')=="DELUXE")
			{
				$data['message_product']='<div class="text-error">You Are Not Authorized To Access This Page<span class="text-error-close">x</span></div>';
				$data['section']="product";
				
			}
			else
			{

				$data['alldensity']=$this->user_model->getalldensity();
				$data['allcolor']=$this->user_model->getallcolor();
				$data['alltexture']=$this->user_model->getalltexture();
				$data['allethnicity']=$this->user_model->getallethnicity();
				$data['alltags']=$this->user_model->getalltag();
				$data['allcategory']=$this->user_model->getallcategory();
				$data['allbrands']=$this->user_model->getallbrands();
				
				$ethnicity=$this->input->post('ethnicity');
				$hair_color=$this->input->post('hair_color');
				$hair_texture=$this->input->post('hair_texture');
				$hair_density=$this->input->post('hair_density');
				
				$sessionid=$this->session->userdata('id');
				$where=array('tbl_user.id'=>$sessionid, 'tbl_ethnicity.id'=>$ethnicity, 'tbl_color.name'=>$hair_color, 'tbl_texture.id'=>$hair_texture, 'tbl_density.density'=>$hair_density);
			
			$join_stylist=array(
						array('table'=>'stylist','condition'=>'`stylist`.`id` = `stylist_product`.`s_id`','jointype'=>'inner'),
						array('table'=>'tbl_user','condition'=>'`tbl_user`.`id` = `stylist`.`user_id`','jointype'=>'inner'),
						array('table'=>'brand','condition'=>'`brand`.`id` = `stylist_product`.`brand_id`','jointype'=>'inner'),
						
						array('table'=>'product','condition'=>'`product`.`brand_id` = `stylist_product`.`brand_id`','jointype'=>'inner'),
						array('table'=>'category','condition'=>'`category`.`id` = `product`.`categoryid`','jointype'=>'inner'),
						
						array('table'=>'pro_color','condition'=>'`product`.`id` = `pro_color`.`product_id`','jointype'=>'inner'),
						array('table'=>'tbl_color','condition'=>'`tbl_color`.`id` = `pro_color`.`color_id`','jointype'=>'inner'),
						
						array('table'=>'pro_density','condition'=>'`product`.`id` = `pro_density`.`product_id`','jointype'=>'inner'),
						array('table'=>'tbl_density','condition'=>'`tbl_density`.`id` = `pro_density`.`density_id`','jointype'=>'inner'),
					
						array('table'=>'pro_ethnicity','condition'=>'`product`.`id` = `pro_ethnicity`.`product_id`','jointype'=>'inner'),
						array('table'=>'tbl_ethnicity','condition'=>'`tbl_ethnicity`.`id` = `pro_ethnicity`.`ethnicity_id`','jointype'=>'inner'),
					
						array('table'=>'pro_texture','condition'=>'`product`.`id` = `pro_texture`.`product_id`','jointype'=>'inner'),
						array('table'=>'tbl_texture','condition'=>'`tbl_texture`.`id` = `pro_texture`.`texture_id`','jointype'=>'inner'),
						);
			//$fields=array('tbl_user.id as user_id', 'product.id as product_id', 'product.name as product_name', 'product.image as image', 'product.price as price', 'product.description as product_desc', 'brand.id as brand_id', 'brand.name as brand_name', 'category.id as category_id', 'category.name as category_name', 'stylist_product.s_id as s_id', );
				$fields=array('category.name as category_name','brand.name as brand_name', 'product.id as product_id', 'product.name', 'product.description', 'product.price', 'product.tagid', 'product.image');
				$data['suggestedproduct'] = $this->user_model->get_joins('stylist_product',$where,$join_stylist,$fields,'','product.id','brand.name');
				$data['section']="product";
				
				if($data['suggestedproduct'])
				{}
				else
				{
					$data['message_product'] ='<div class="text-error">No Match Found<span class="text-error-close">x</span></div>';
					$data['section']="product";
					
				}
			}
		}
		

		if(isset($_POST['search']))
   		{
			if($this->session->userdata('package')=="DELUXE")
			{
				$data['message_product']='<div class="text-error">You Are Not Authorized To Access This Page<span class="text-error-close">x</span></div>';
				$data['section']="product";
				
			}
			else
			{

				$sessionid=$this->session->userdata('id');
				
				$suggest_pro_category_post=$this->input->post('suggest_pro_category_post');
				$suggest_pro_brand_post=$this->input->post('suggest_pro_brand_post');
				$suggest_pro_tag_post=$this->input->post('suggest_pro_tag_post[]');
				$filter_product=ucwords($this->input->post('filter_product'));
				if( (empty($suggest_pro_category_post)) && (empty($suggest_pro_brand_post)) && (empty($suggest_pro_tag_post)) && (empty($filter_product)) )
				{
					$data['message_product'] ='<div class="text-error">Please Select atleast one Search field <span class="text-error-close">x</span></div>';
					$data['section']="product";
					
				}
				else
				{
					
					$field=array('category.id as categoryid', 'category.name as categoryname', 'brand.id as brandid', 'brand.name as brandname', 'product.id as id', 'product.name as productname', 'product.description', 'product.price', 'product.color', 'product.density', 'product.image', 'tags.id as tagid', 'tags.tagname as tagname', );
					if(!empty($suggest_pro_tag_post))
					{
						//print_r($suggest_pro_tag_post);
						$productsearch='';
						foreach($suggest_pro_tag_post as $tagid)
						{
							
							$where=array('`product`.`brand_id`'=>$suggest_pro_brand_post, '`product`.`categoryid`'=>$suggest_pro_category_post,);
							if(!empty($filter_product))
							{
								$like=array('`product`.`tagid`'=>$tagid, '`product`.`name`'=>$filter_product,  '`brand`.`name`'=>$filter_product, '`category`.`name`'=>$filter_product, '`product`.`description`'=>$filter_product, '`product`.`color`'=>$filter_product, '`product`.`density`'=>$filter_product, '`product`.`price`'=>$filter_product, );
							}
							elseif((!empty($suggest_pro_brand_post)) || (!empty($suggest_pro_category_post)) )
							{
								$like='';
							}
							else
							{
								
								$like=array('`product`.`tagid`'=>$tagid);
							}

							$join =array(
									array('table'=>'brand','condition'=>'`product`.`brand_id` = `brand`.`id`','jointype'=>'inner'),
									array('table'=>'category','condition'=>'`product`.`categoryid` = `category`.`id`','jointype'=>'inner'),
									array('table'=>'tags','condition'=>'`product`.`tagid` = `tags`.`id`','jointype'=>'inner'),
									);
							$productsearch=$this->user_model->get_joins('product','',$join,$field,$like,'','','','','',$where);
							//print $this->db->last_query();
						}
						$data['productsearch']=$productsearch;					
						$data['section']="product";
						
					}
					else
					{

						$where=array('`product`.`brand_id`'=>$suggest_pro_brand_post, '`product`.`categoryid`'=>$suggest_pro_category_post,);
						if((!empty($suggest_pro_brand_post)) || (!empty($suggest_pro_category_post)) )
						{
							$like='';
						}
						else
						{
							$like=array( '`product`.`name`'=>$filter_product,  '`brand`.`name`'=>$filter_product, '`category`.`name`'=>$filter_product, '`product`.`description`'=>$filter_product, '`product`.`color`'=>$filter_product, '`product`.`density`'=>$filter_product, '`product`.`price`'=>$filter_product, );
						}
						
						$join =array(
									array('table'=>'brand','condition'=>'`product`.`brand_id` = `brand`.`id`','jointype'=>'inner'),
									array('table'=>'category','condition'=>'`product`.`categoryid` = `category`.`id`','jointype'=>'inner'),
									array('table'=>'tags','condition'=>'`product`.`tagid` = `tags`.`id`','jointype'=>'inner'),
									);
						$data['productsearch']=$this->user_model->get_joins('product','',$join,$field,$like,'','','','','',$where);
						$data['section']="product";
						
					}
					
					$join_p=array(
							array('table'=>'stylist','condition'=>'`stylist`.`id` = `stylist_product`.`s_id`','jointype'=>'inner'),
							array('table'=>'tbl_user','condition'=>'`tbl_user`.`id` = `stylist`.`user_id`','jointype'=>'inner'),
							array('table'=>'product','condition'=>'`product`.`brand_id` = `stylist_product`.`brand_id`','jointype'=>'inner'),
							array('table'=>'category','condition'=>'`product`.`categoryid` = `category`.`id`','jointype'=>'inner'),
							array('table'=>'brand','condition'=>'`product`.`brand_id` = `brand`.`id`','jointype'=>'inner'),
							);
				
					$data['stylists_products']=$this->user_model->get_joins('stylist_product',array('stylist.user_id'=>$sessionid),$join_p,array('stylist_product.id','stylist_product.brand_id',),'','brand.id');
					$data['section']="product";
					
				
					if(empty($data['productsearch']))
					{
						$data['message_product'] ='<div class="text-error">No Match Found <span class="text-error-close">x</span></div>';
						$data['section']="product";
						
					}
				}
			}
		}
		
		
		/*End of 9th isset*/
				//*****************************send the email and the client data and description to the client*****************//
		if(isset($_POST['email_pack']))
		{
			if($this->session->userdata('package')=="DELUXE")
			{
				$data['message_product']='<div class="text-error">You Are Not Authorized To Access This Page<span class="text-error-close">x</span></div>';
				$data['section']="product";
				
			}
			else
			{

				$client_email=$this->input->post('email');
				$join=array(
							array('table'=>'client','condition'=>'`client`.`id` = `tbl_selected_products`.`c_id`','jointype'=>'inner'),
							array('table'=>'stylist','condition'=>'`stylist`.`id` = `tbl_selected_products`.`s_id`','jointype'=>'inner'),
							array('table'=>'tbl_user','condition'=>'`client`.`user_id` = `tbl_user`.`id`','jointype'=>'inner'),
							array('table'=>'tbl_user as stylist_details','condition'=>'`stylist_details`.`id` = `stylist`.`user_id`','jointype'=>'inner'),
							array('table'=>'product','condition'=>'`product`.`id` = `tbl_selected_products`.`selected_id`','jointype'=>'inner'),
							array('table'=>'brand','condition'=>'`brand`.`id` = `product`.`brand_id`','jointype'=>'inner'),
							array('table'=>'category','condition'=>'`category`.`id` = `product`.`categoryid`','jointype'=>'inner'),
							);
				$emaild_fields=array('tbl_user.firstname', 'tbl_user.lastname', 'tbl_user.email', 'stylist_details.firstname as stylist_fname', 'stylist_details.lastname as stylist_lname', 'stylist_details.email as stylist_email', 'stylist.id as s_id', 'client.id as c_id', 'product.name as p_name', 'product.description as p_description', 'product.id as p_id', 'product.image as p_image', 'brand.id as brand_id', 'brand.name as b_name',  'category.id as cate_id', 'category.name as cate_name', );
				$data['all_email_data']=$this->user_model->get_joins('tbl_selected_products',array('tbl_user.email'=>$client_email),$join,$emaild_fields);
				
				if(!empty($data['all_email_data']))
				{
					$message='<h3>Hi '.$data['all_email_data'][0]['firstname'].' '.$data['all_email_data'][0]['lastname'].',</h3><br>Thank You for selecting products. <br><br> Details of Product You have selected is :<br><br><br>';
					
					$headers = "From: " . $data['all_email_data'][0]['stylist_email'] . "\n"; //from address
					//$headers .= "Content-type: text/html; charset=iso-8859-1 \n";
					$headers .= "MIME-Version: 1.0\r\n";
					$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
					
					$message.=	'<table cellspacing="0" cellpadding="0" border="0" width="600" padding:3px;>
									<thead style="border-bottom:1px solid #68268A !important; text-align: left !important;">
										<tr>
											<th>S. No.</th><th>Product</th><th>Brand</th><th>Image</th>
										</tr>
									</thead>';
								$i=1;
								foreach($data['all_email_data'] as $emaildata)
								{
									$message.=	'<tr style="border-bottom:1px solid #68268A !important;">
													<td>'.$i.'</td>
													<td>'.$emaildata['p_name'].'</td>
													<td>'.$emaildata['b_name'].'</td>
													<td><img src='.$emaildata['p_image'].' style="height:80px;width:80px;" /></td>
												</tr>';
									$i++;
								}
					$message.=	'</table><br><br><h4>Thanks & Regards<br>Inhairent</h4>';
					$emailto=$data['all_email_data'][0]['email'];
					$subject="My Selected Products";
					$mailsent= mail($emailto, $subject, $message, $headers);
					if($mailsent)
					{
						$data['message_product'] ='<div class="text-success-wrapper">Package details sent Successfully to '.$emailto.'<span class="text-success-close">x</span></div>';
						$data['section']="product";
						
					}
					else
					{
						$data['message_product'] ='<div class="text-error">Email Not Sent Try again<span class="text-error-close">x</span></div>';
						$data['section']="product";
						
					}
				}
				else
				{
					$data['message_product'] ='<div class="text-error">You Have not Selected any Product<span class="text-error-close">x</span></div>';
					$data['section']="product";
					
				}
			}
		}
		
		/*End of 10th isset*/
		
	
		
		$this->load->view('Stylist/addclient',$data);
	}
	

	
	//**************************************	Manage Client			********************************************//

	function manageclient()
	{
		$data='';
		
		$data['alldensity']=$this->user_model->getalldensity();
		$data['allcolor']=$this->user_model->getallcolor();
		$data['alltexture']=$this->user_model->getalltexture();
		$data['allethnicity']=$this->user_model->getallethnicity();
		$data['alltags']=$this->user_model->getalltag();
		$data['allcategory']=$this->user_model->getallcategory();
		$data['allbrands']=$this->user_model->getallbrands();
		
		$clientid=$this->uri->segment(3);
		//echo $clientid;
		$where=array('client.user_id'=>$clientid);
		
		$join =array(
					array('table'=>'client','condition'=>'`tbl_user`.`id` = `client`.`user_id`','jointype'=>'inner'),
					);
		$data['clientinfo']=$this->user_model->get_joins('tbl_user',$where,$join);
		@$ethnicity=$data['clientinfo'][0]['ethnicity'];
		@$hair_color=$data['clientinfo'][0]['hair_color'];
		@$hair_texture=$data['clientinfo'][0]['hair_texture'];
		@$hair_density=$data['clientinfo'][0]['hair_density'];
		
		$data['sliderdata'] = $this->user_model->get_select_data_($ethnicity,$hair_color,$hair_texture,$hair_density);
		
		$field_c=array('client_photos.id as id','client_photos.c_id', 'client_photos.photo_order', 'client_photos.photos', 'client_photos.featured', 'client_photos.public', 'client_photos.s_id', 'client.user_id', 'client_photos.createdate',);
		$joins =array(
					array('table'=>'client','condition'=>'`client_photos`.`c_id` = `client`.`id`','jointype'=>'inner'),
					);
		$data['clientphotos']=$this->user_model->get_joins('client_photos',$where,$joins,$field_c,'','','`client_photos`.`createdate` DESC','3');
		
		$createdate=date("Y-m-d H:i:s");
		$where_appoint=array('client.user_id'=>$clientid,'booking_start_date>='=>$createdate);
		$upcoming_appoint =array(
					array('table'=>'booking','condition'=>'`booking`.`c_id` = `client`.`id`','jointype'=>'inner'),
					);
		
		$data['upcoming_appoints']=$this->user_model->get_joins('client',$where_appoint,$upcoming_appoint);
		
		$sessionId=$this->session->userdata('id');
		$field_communication=array('client_communications.id as communicationId', 'client_communications.s_id',  'client_communications.c_id', 'client_communications.title', 'client_communications.content', 'client_communications.createdate', 'clientinfo.firstname as clientFname', 'clientinfo.lastname as clientLname', 'stylistinfo.firstname as clientFname', 'stylistinfo.lastname as clientLname', );
		$join_communication=array(
					array('table'=>'client','condition'=>'`client_communications`.`c_id` = `client`.`id`','jointype'=>'inner'),
					array('table'=>'stylist','condition'=>'`client_communications`.`s_id` = `stylist`.`id`','jointype'=>'inner'),
					array('table'=>'tbl_user as stylistinfo','condition'=>'`stylist`.`user_id` = `stylistinfo`.`id`','jointype'=>'inner'),
					array('table'=>'tbl_user as clientinfo','condition'=>'`client`.`user_id` = `clientinfo`.`id`','jointype'=>'inner'),
					
					);
		$data['recent_communications']=$this->user_model->get_joins('client_communications',array('stylistinfo.id'=>$sessionId,'clientinfo.id'=>$clientid),$join_communication,$field_communication,'','','client_communications.createdate DESC','5');

			$sessionid=$this->session->userdata('id');
			
			$join_=array(
						array('table'=>'stylist','condition'=>'`stylist`.`id` = `stylist_product`.`s_id`','jointype'=>'inner'),
						array('table'=>'tbl_user','condition'=>'`tbl_user`.`id` = `stylist`.`user_id`','jointype'=>'inner'),
						array('table'=>'brand','condition'=>'`brand`.`id` = `stylist_product`.`brand_id`','jointype'=>'inner'),
						array('table'=>'product','condition'=>'`product`.`brand_id` = `stylist_product`.`brand_id`','jointype'=>'inner'),
						array('table'=>'category','condition'=>'`category`.`id` = `product`.`categoryid`','jointype'=>'inner'),
						);
			//$fields=array('tbl_user.id as user_id', 'product.id as product_id', 'product.name as product_name', 'product.image as image', 'product.price as price', 'product.description as product_desc', 'brand.id as brand_id', 'brand.name as brand_name', 'category.id as category_id', 'category.name as category_name', 'stylist_product.s_id as s_id', );
			$fields=array('category.name as category_name','brand.name as brand_name', 'product.id as product_id', 'product.name', 'product.description', 'product.price', 'product.tagid', 'product.image');
			$data['suggestedproduct'] = $this->user_model->get_joins('stylist_product',array('tbl_user.id'=>$sessionid),$join_,$fields);
			
	
		@$uid=$this->input->post('uid');
			@$firstname=ucwords($this->input->post('firstname'));
			@$lastname=ucwords($this->input->post('lastname'));
			@$email=$this->input->post('email');
			@$contactno=$this->input->post('contactno');
			@$ethnicity=$this->input->post('ethnicity');
			@$gender=$this->input->post('gender');
			@$age=$this->input->post('age');
			@$hair_color=$this->input->post('hair_color');
			@$hair_texture=$this->input->post('hair_texture');
			@$hair_density=$this->input->post('hair_density');
	
		//echo"<pre>";print_r($data['sliderdata']);exit;
		
		if(isset($_POST['add']))
		{
			$this->form_validation->set_error_delimiters('<div class="text-error">', '<span class="text-error-close">x</span></div>');
			$this->form_validation->set_rules('firstname', 'Firstname', 'trim|required|alpha');
			$this->form_validation->set_rules('lastname', 'Lastname', 'trim|required|alpha');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
			$this->form_validation->set_rules('contactno', 'Contact Number', 'trim|required');			
			$this->form_validation->set_rules('ethnicity', 'Ethnicity', 'trim|required');			
			$this->form_validation->set_rules('gender', 'Gender', 'required');
			$this->form_validation->set_rules('age', 'Age', 'required');
			
			$this->form_validation->set_rules('hair_color', 'Hair Color', 'required');
			$this->form_validation->set_rules('hair_texture', 'Hair Texture', 'required');
			$this->form_validation->set_rules('hair_density', 'Hair Density', 'required');
			//$this->form_validation->set_message('alpha_space', 'Only Characters and space is allowed');

			if ($this->form_validation->run() == FALSE)
			{
				$data['message'] = validation_errors();
				$data['section']="client-info";
			}
			else
			{
				@$where=array('id'=>$uid);
				$update_user_data	=array(
									'firstname'=>$firstname,
									'lastname'=>$lastname,
									'email'=>$email,
									'contactno'=>$contactno,
									'gender'=>$gender,
									'age'=>$age,
									);
				$update_clinet_data= array(
										'ethnicity'=>$ethnicity,
										'hair_color'=>$hair_color,
										'hair_texture'=>$hair_texture,
										'hair_density'=>$hair_density,
										);
				
				$is_user_update = $this->user_model->UPDATEDATA('tbl_user',$where, $update_user_data);
				$is_client_update=$this->user_model->UPDATEDATA('client',array('user_id'=>$uid), $update_clinet_data);
				
				if($is_client_update || $is_client_update)
				{
					$data['message'] ='<div class="text-success-wrapper">Client info updated Successfully<span class="text-success-close">x</span></div>';
					$data['section']="client-info";
				}
				else
				{
					$data['message'] ='<div class="text-error">Profile Not Updated<span class="text-error-close">x</span></div>';
					$data['section']="client-info";
				}
			}
		}
		
		/*End of 1st isset*/
		
		if( (isset($_POST['load'])) || (isset($_POST['suggested_style'])) )
		{
			$data['sliderdata'] = $this->user_model->get_select_data_($ethnicity,$hair_color,$hair_texture,$hair_density);
			$data['section']="search";
			//echo $this->db->last_query();
			if(empty($data['sliderdata']))
			{
				$data['message_slider'] ='<div class="text-error">No Match found<span class="text-error-close">x</span></div>';
				$data['section']="search";
			}
		}
		
		/*End of 2nd isset*/
		
		if(isset($_POST['allstyle']))
		{
			$where=array('client_photos.public'=>1);
			$field_=array('client.id', 'client.user_id', 'client.s_id', 'client_photos.photos','client_photos.id');
			$join =array(
						array('table'=>'client','condition'=>'`client`.`id` = `client_photos`.`c_id`','jointype'=>'inner'),
						//array('table'=>'tbl_user','condition'=>'`tbl_user`.`id` = `client`.`user_id`','jointype'=>'inner'),
						);
			$data['sliderdata'] = $this->user_model->get_joins('client_photos',$where,$join,$field_,'','',' `client_photos`.`createdate` DESC ');
			$data['section']="search";
			if(empty($data['sliderdata']))
			{
				$data['message_slider'] ='<div class="text-error">No Match found<span class="text-error-close">x</span></div>';
				$data['section']="search";
			}
			//echo $this->db->last_query();
			//echo"<pre>";print_r($data['sliderdata']);exit;
		}
		
		/*End of 3rd isset*/
		
		if(isset($_POST['favorite_style']))
		{
			$sessionid=$this->session->userdata('id');
			
			$stylist=$this->user_model->get_joins('stylist',array('user_id'=>$sessionid));
			$sid=$stylist[0]['id'];
			
			$client=$this->user_model->get_joins('client',array('user_id'=>$uid));
			$cid=$client[0]['id'];

			$join_c =array(
						array('table'=>'client','condition'=>'`client`.`id` = `tbl_favorite`.`client_id`','jointype'=>'inner'),
						);
			$data['client_favorite'] = $this->user_model->get_joins('tbl_favorite',array('tbl_favorite.client_id'=>$cid, 'tbl_favorite.s_id'=>$sid, ),$join_c,array('favorite'));

			$clients_favorite='';
			$join_cl =array(
						array('table'=>'client','condition'=>'`client`.`id` = `client_photos`.`c_id`','jointype'=>'inner'),
						array('table'=>'stylist','condition'=>'`stylist`.`id` = `client`.`s_id`','jointype'=>'inner'),
						);
			$field_=array('client.id', 'client.user_id', 'client.s_id', 'client_photos.photos','client_photos.id');
			foreach($data['client_favorite'] as $favorites)
			{
				$clients_favorite[]=$this->user_model->get_joins('client_photos',array('client_photos.id'=>$favorites['favorite']),$join_cl,$field_,'','',' `client_photos`.`createdate` DESC ');
			}
			$data['favorite_style']=$clients_favorite;
			$data['section']="search";
			if(empty($data['favorite_style']))
			{
				$data['section']="search";
				$data['message_slider'] ='<div class="text-error">You have not selected any style <span class="text-error-close">x</span></div>';
			}
			//echo"<pre>";print_r($data['favorite_style']); exit;
		}
		
		
		if(isset($_POST['search_style']))
		{
			$ethnicity_s=$this->input->post('ethnicity_s');
			$gender_s=$this->input->post('gender_s');
			$age_range_s=$this->input->post('age_range_s');
			$hair_color_s=$this->input->post('hair_color_s');
			$hair_texture_s=$this->input->post('hair_texture_s');
			$hair_density_s=$this->input->post('hair_density_s');
			$tags_s=$this->input->post('tags_s[]');
			
			if( (empty($ethnicity_s)) && (empty($gender_s)) && (empty($age_range_s)) && (empty($hair_color_s)) && (empty($hair_texture_s)) && (empty($hair_density_s)) && (empty($tags_s)) )
			{
				$data['section']="search";
				$data['message_search'] ='<div class="text-error">Please Select atleast one Search field <span class="text-error-close">x</span></div>';
			}
			else
			{
				if(!empty($tags_s))
				{
					$productsearch=[];
					foreach($tags_s as $tagid)
					{
						$where=array('client_photos.tagid'=>$tagid, 'client.hair_color'=>$hair_color_s, 'client.hair_texture'=>$hair_texture_s, 'client.hair_density'=>$hair_density_s);
						$join =array(
								array('table'=>'tbl_user','condition'=>'`tbl_user`.`id` = `client`.`user_id`','jointype'=>'inner'),
								array('table'=>'client_photos','condition'=>'`client`.`id` = `client_photos`.`c_id`','jointype'=>'inner'),
								);
						$productsearch=$this->user_model->get_joins('client','',$join,'',$where,'','','','','','');
						//echo $this->db->last_query();echo"<br>";
						//echo"<pre>";print_r($productsearch);echo"<br>";
					}
					$data['searchdata']=$productsearch;
					$data['section']="search";
					//echo"<pre>";print_r($productsearch);echo"<br>";
				}
				else
				{
				//	$field=array('client.id', 'client.user_id', 'client.s_id', 'client.hair_color', 'client.hair_texture', 'client.hair_density', 'client.photos', );
					$where=array('client.hair_color'=>$hair_color_s, 'client.hair_texture'=>$hair_texture_s, 'client.hair_density'=>$hair_density_s);
					$join =array(
								array('table'=>'tbl_user','condition'=>'`tbl_user`.`id` = `client`.`user_id`','jointype'=>'inner'),
								array('table'=>'client_photos','condition'=>'`client`.`id` = `client_photos`.`c_id`','jointype'=>'inner'),
								);
					$data['searchdata']=$this->user_model->get_joins('client','',$join,'','','','','','','',$where);
					$data['section']="search";
				}
				
				//echo "<pre>";print_r($data['searchdata']);exit;
				if(empty($data['searchdata']))
				{
					$data['message_search'] ='<div class="text-error">No Match Found <span class="text-error-close">x</span></div>';
					$data['section']="search";
				}
			}
		}
		
		/*End of 4th isset*/
		
		if(isset($_POST['upload']))
		{
			
			$data='';
			
			$data['alldensity']=$this->user_model->getalldensity();
			$data['allcolor']=$this->user_model->getallcolor();
			$data['alltexture']=$this->user_model->getalltexture();
			$data['allethnicity']=$this->user_model->getallethnicity();
			$data['alltags']=$this->user_model->getalltag();
			$data['allcategory']=$this->user_model->getallcategory();
			$data['allbrands']=$this->user_model->getallbrands();
			
			$liname=$this->input->post('liname[]');
			$degree=$this->input->post('cropbox[]');
			$sortdiv=$this->input->post('sortdiv');
			$de_order=$this->input->post('de_order');
			
			$img_odrers=explode(',',$sortdiv);
			$rotation_angle=explode(',',$de_order);
			
			if(count($img_odrers)==2)
			{
				$nexval=max($img_odrers)+1;
				$sortdiv=$sortdiv.','.$nexval;
			}
			if(count($img_odrers)==1)
			{
				$sortdiv=$sortdiv.',1,2';
			}
			
			

			$uId=$this->input->post('hidden_uId');
			
			$tagids[]=$this->input->post('tagids');
			$chk_featured=$this->input->post('chk_featured');
			$chk_public=$this->input->post('chk_public');
			
			$newArray='';
			foreach( $degree as $origKey => $value )
			{
				// New key that we will insert into $newArray with
				$newKey = $img_odrers[$origKey];
				$newArray[$newKey] = $value;
			}
			
						
			if($chk_public=="")
			{
				$chk_public=0;
			}
			else
			{
				$chk_public=$chk_public;
			}
			if($chk_featured=="")
			{
				$chk_featured=0;
			}
			else
			{
				$chk_featured==$chk_featured;
			}
			
			if (!is_dir('./assets/uploads/'))
			{
				mkdir('./assets/uploads/', 0777, true);
				//chmod('/assets', 0777);
				//chmod('/assets/uploads', 0777);
			}
			
			$config = array();
			$config['upload_path'] = './assets/uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			//$config['overwrite']     = true;
			
			$this->load->library('upload');
			$this->load->library('image_lib');							//library for resizing the image
			
			$count = count ($_FILES['pic']['name']);

			if($count>3)
			{
				$this->session->set_flashdata('email_pic_msg', '<b style="color:red;">Maximum 3 Photos are allowed</b>');
				$this->session->set_flashdata('section','photos');
				//$data['message'] ='<div class="text-success-wrapper">Client Photos Added Successfully<span class="text-success-close">x</span></div>';
				redirect(site_url().'stylist/manageclient/'.$uId);
				//$data['message'] ='<div class="text-error">Maximum 3 Photos are allowed<span class="text-error-close">x</span></div>';
				//redirect(site_url().'stylist/viewclient');
			}
			else
			{

				$this->load->library('upload', $config);
				$files = $_FILES['pic'];
				$images = array();
				$i=0;
				foreach ($files['name'] as $key => $image)
				{
					$_FILES['pic[]']['name']= $files['name'][$key];
					$_FILES['pic[]']['type']= $files['type'][$key];
					$_FILES['pic[]']['tmp_name']= $files['tmp_name'][$key];
					$_FILES['pic[]']['error']= $files['error'][$key];
					$_FILES['pic[]']['size']= $files['size'][$key];
					
					$fileName = $image;
					$config['file_name'] = $fileName;
					
					$this->upload->initialize($config);
					$is_upload=$this->upload->do_upload('pic[]');
					if($is_upload)
					{
						$base_url=base_url();
						$uploaded_img_name=$this->upload->data('file_name');
						
						
						//$img_full_url[]=$base_url.'assets/uploads/'.$uploaded_img_name;
						$img_full_url[]=$uploaded_img_name;
						$client_image=implode(',',$img_full_url);
						
						$config['image_library'] = 'gd2';
						$config['source_image'] = $this->upload->data('full_path');
						$config['width']     = 600;
						$config['height']   = 600;
						@$config['rotation_angle'] = 360-$newArray[$i];
						
						$this->image_lib->clear();
						$this->image_lib->initialize($config);
						
						$res=$this->image_lib->resize();
						$rotate=$this->image_lib->rotate();
						
						/*	For Water Mark	*/
						$this->image_lib->clear();
						$config['wm_text'] = 'Inhairent';
						$config['wm_type'] = 'text';
						$config['wm_font_size'] = '12';
					//	$config['wm_font_path'] = './assets/fonts/glyphicons-halflings-regular.ttf';
						$config['wm_font_color'] = '68268a';
						$config['wm_vrt_alignment'] = 'bottom';
						$config['wm_hor_alignment'] = 'center';
						//$config['wm_padding'] = '20';
						
						$this->image_lib->initialize($config);
						$this->image_lib->watermark();
						
						$this->_createThumbnails($uploaded_img_name);
					}
					else
					{
						$this->session->set_flashdata('section','photos');
						$this->session->set_flashdata('email_pic_msg', '<b style="color:red;">Images Not Uploaded</b>');
						redirect(site_url().'stylist/manageclient/'.$uId);
						//$data['message'] ='<div class="text-error">Images Not Uploaded<span class="text-error-close">x</span></div>';
					}
				$i++;
				}
				
				if ($this->upload->do_upload('pic[]'))
				{
					
					$where=array('tbl_user.id'=>$uId);		
					
					$join =array(
								array('table'=>'client','condition'=>'`tbl_user`.`id` = `client`.`user_id`','jointype'=>'inner'),
								);
					$data['userdata'] = $this->user_model->get_joins('tbl_user',$where,$join);
					$c_id=$data['userdata'][0]['id'];
					$user_id=$data['userdata'][0]['user_id'];
					//echo"<pre>";print_r($data['userdata']);exit;
					$join_s =array(
								array('table'=>'stylist','condition'=>'`tbl_user`.`id` = `stylist`.`user_id`','jointype'=>'inner'),
								);
					$data['stylist_data'] = $this->user_model->get_joins('tbl_user',array('`tbl_user`.`id`'=>$this->session->userdata('id')),$join_s);
					$s_id=$data['stylist_data'][0]['id'];
					
					$currentdate=date("Y-m-d H:i:s");
					@$tags=implode(',',$tagids[0]);
					
					if(empty($tags))
					{
						$tags='';
					}
					else
					{
						$tags=$tags;
					}
					$insertdata=array('s_id'=>$s_id, 'c_id'=>$c_id, 'tagid'=>$tags, 'featured'=>$chk_featured, 'public'=>$chk_public, 'photos'=>$client_image, 'photo_order'=>$sortdiv, 'createdate'=>$currentdate);
					$C_image=explode(',',$client_image);
					$data['isinsert']=$this->user_model->INSERTDATA('client_photos', $insertdata);
					$data['isupdate']=$this->user_model->UPDATEDATA('client', array('s_id'=>$s_id,'id'=>$c_id),array('tagid'=>$tags, 'featured'=>$chk_featured, 'public'=>$chk_public,'photos'=>$C_image[$img_odrers[0]]));
					$data['isupdate-tbl']=$this->user_model->UPDATEDATA('tbl_user', array('id'=>$uId),array('image'=>$C_image[$img_odrers[0]]));
					if($data['isinsert'])
					{
						$this->session->set_flashdata('section','photos');
						$this->session->set_flashdata('email_pic_msg', '<b style="color:green;">Client Photos Added Successfully</b>');
						//$data['message'] ='<div class="text-success-wrapper">Client Photos Added Successfully<span class="text-success-close">x</span></div>';
						redirect(site_url().'stylist/manageclient/'.$user_id);
					}						
				}
				else
				{
					$this->session->set_flashdata('section','photos');
					$this->session->set_flashdata('email_pic_msg', '<b style="color:red;">Images Not Uploaded</b>');
					redirect(site_url().'stylist/manageclient/'.$uId);
					//echo"<pre>";print_r(array('error' => $this->upload->display_errors()));
					//$data['message'] ='<div class="text-error">Images Not Uploaded<span class="text-error-close">x</span></div>';
				}
			}
		}
				
		/*End of 5th isset*/
			
			if(isset($_POST['edit_image']))
		{
			$client_photo_id=$this->input->post('client_photo_id');
			$old_pic=$this->input->post('old_pic[]');
			
			//print($old_pic);exit('-');
			$liname=$this->input->post('liname[]');
			$degree=$this->input->post('cropbox[]');
			$sortdiv=$this->input->post('sortdiv');
			$de_order=$this->input->post('de_order');
			
			$img_odrers=explode(',',$sortdiv);
			$rotation_angle=explode(',',$de_order);
		
			if(count($img_odrers)==2)
			{
				$nexval=max($img_odrers)+1;
				$sortdiv=$sortdiv.','.$nexval;
			}
			if(count($img_odrers)==1)
			{
				$sortdiv=$sortdiv.',0,0';
			}
			
			$uId=$this->input->post('hidden_uId');
			
			$tagids[]=$this->input->post('tagids');
			$chk_featured=$this->input->post('chk_featured');
			$chk_public=$this->input->post('chk_public');
			//print_r($degree);exit;
			if($chk_public=="")
			{
				$chk_public=0;
			}
			else
			{
				$chk_public=$chk_public;
			}
			if($chk_featured=="")
			{
				$chk_featured=0;
			}
			else
			{
				$chk_featured==$chk_featured;
			}
			
			if (!is_dir('./assets/uploads/'))
			{
				mkdir('./assets/uploads/', 0777, true);
				//chmod('/assets', 0777);
				//chmod('/assets/uploads', 0777);
			}
			
			if(!empty($tagids))
			{
				@$tags=implode(',',$tagids[0]);
			}
			else
			{
				$tags='';
			}
			
			if(!empty($_FILES['pic']['name'][0]))
			{
				$config = array();
				$config['upload_path'] = './assets/uploads/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				//$config['overwrite']     = true;
				
				$this->load->library('upload');
				$this->load->library('image_lib');
				
				$browse_count= count($_FILES['pic']['name']);
/*if($browse_count=="")
{
	$browse_count=0;
}
*/
				$old_pic_count=count($old_pic);
				
				if(($old_pic_count+$browse_count)>3)
				{
					$data['photo_msg'] ='<div class="text-error">Only Three Images are allowed<span class="text-error-close">x</span></div>';
					$data['section'] ="photos";
				}
				else
				{
					if(empty($old_pic))
					{
						$old_pic=[];
					}
					
					$this->load->library('upload', $config);
					$files = $_FILES['pic'];
					$images = array();
					$i=0;
					foreach ($files['name'] as $key => $image)
					{
						$_FILES['pic[]']['name']= $files['name'][$key];
						$_FILES['pic[]']['type']= $files['type'][$key];
						$_FILES['pic[]']['tmp_name']= $files['tmp_name'][$key];
						$_FILES['pic[]']['error']= $files['error'][$key];
						$_FILES['pic[]']['size']= $files['size'][$key];
						
						$fileName = $image;
						$config['file_name'] = $fileName;
						
						$this->upload->initialize($config);
						$is_upload=$this->upload->do_upload('pic[]');
						
						$base_url=base_url();
						$uploaded_img_name=$this->upload->data('file_name');
						
						array_push($old_pic,$uploaded_img_name);
						
				/*		
						$config['image_library'] = 'gd2';
						$config['source_image'] = $this->upload->data('full_path');
						$config['width']     = 600;
						$config['height']   = 600;
						
						$this->image_lib->clear();
						$this->image_lib->initialize($config);
						
						$res=$this->image_lib->resize();
					*/	
						$this->image_lib->clear();
						$config['wm_text'] = 'Inhairent';
						$config['wm_type'] = 'text';
						$config['wm_font_size'] = '12';
					//	$config['wm_font_path'] = './assets/fonts/glyphicons-halflings-regular.ttf';
						$config['wm_font_color'] = '68268a';
						$config['wm_vrt_alignment'] = 'bottom';
						$config['wm_hor_alignment'] = 'center';
						//$config['wm_padding'] = '20';
						
						$this->image_lib->initialize($config);
						$this->image_lib->watermark();
						
						$this->_createThumbnails($uploaded_img_name);
					}
					$newArray='';
					foreach( $degree as $origKey => $value )
					{
						// New key that we will insert into $newArray with
						$newKey = $img_odrers[$origKey];
						$newArray[$newKey] = $value;
					}
					/*
					echo"<pre>";
					print_r($img_odrers);
					print_r($degree);
					print_r($old_pic);
					print_r($newArray);
					print_r($this->upload->data());
					exit;*/
					if($this->upload->do_upload('pic[]'))
					{

						$i=0;
						$client_image='';
						foreach($old_pic as $pic)
						{
							$dir= getcwd().'/assets/uploads/';
							//echo $dir;exit;
							$url = $pic;
							$client_image[]=$url;
							$basename = basename($url);
				
							$degrees = 360-$newArray[$i];
							$info = new SplFileInfo($basename);
							$extention=strtolower($info->getExtension());
							
							switch ($extention)
							{
								case 'jpg':

/*									// Load
									$source = imagecreatefromjpeg($dir.'/'.$basename);
									// Rotate
									$rotate = imagerotate($source, $degrees, imageColorAllocateAlpha($source, 0, 0, 0, 127));
									// Output
									imagejpeg($rotate, $dir.'/'.$basename, 90);
									chmod($dir.'/'.$basename, 0777);
*/
									// Load
									$source_113x113 = imagecreatefromjpeg($dir.'thumbnails/113x113/'.$basename);
									// Rotate
									$rotate_113x113 = imagerotate($source_113x113, $degrees, imageColorAllocateAlpha($source_113x113, 0, 0, 0, 127));
									// Output
									imagejpeg($rotate_113x113, $dir.'thumbnails/113x113/'.$basename, 90);
									chmod($dir.'thumbnails/113x113/'.$basename, 0777);

									// Load
									$source_130x130 = imagecreatefromjpeg($dir.'thumbnails/130x130/'.$basename);
									// Rotate
									$rotate_130x130 = imagerotate($source_130x130, $degrees, imageColorAllocateAlpha($source_130x130, 0, 0, 0, 127));
									// Output
									imagejpeg($rotate_130x130, $dir.'thumbnails/130x130/'.$basename, 90);
									chmod($dir.'thumbnails/130x130/'.$basename, 0777);

									// Load
									$source_150x150 = imagecreatefromjpeg($dir.'thumbnails/150x150/'.$basename);
									// Rotate
									$rotate_150x150 = imagerotate($source_150x150, $degrees, imageColorAllocateAlpha($source_150x150, 0, 0, 0, 127));
									// Output
									imagejpeg($rotate_150x150, $dir.'thumbnails/150x150/'.$basename, 90);
									chmod($dir.'thumbnails/150x150/'.$basename, 0777);

									// Load
									$source_244x244 = imagecreatefromjpeg($dir.'thumbnails/244x244/'.$basename);
									// Rotate
									$rotate_244x244 = imagerotate($source_244x244, $degrees, imageColorAllocateAlpha($source_244x244, 0, 0, 0, 127));
									// Output
									imagejpeg($rotate_244x244, $dir.'thumbnails/244x244/'.$basename, 90);
									chmod($dir.'thumbnails/244x244/'.$basename, 0777);

									// Load
									$source_600x600 = imagecreatefromjpeg($dir.'thumbnails/600x600/'.$basename);
									// Rotate
									$rotate_600x600 = imagerotate($source_600x600, $degrees, imageColorAllocateAlpha($source_600x600, 0, 0, 0, 127));
									// Output
									imagejpeg($rotate_600x600, $dir.'thumbnails/600x600/'.$basename, 90);
									chmod($dir.'thumbnails/600x600/'.$basename, 0777);
		/*echo $dir;
		echo $basename;exit;*/
									break;
								case 'jpeg':
									
	/*													
									// Load
									$source = imagecreatefromjpeg($dir.'/'.$basename);
									// Rotate
									$rotate = imagerotate($source, $degrees, imageColorAllocateAlpha($source, 0, 0, 0, 127));
									// Output
									imagejpeg($rotate, $dir.'/'.$basename, 90);
									chmod($dir.'/'.$basename, 0777);
*/
									// Load
									$source_113x113 = imagecreatefromjpeg($dir.'thumbnails/113x113/'.$basename);
									// Rotate
									$rotate_113x113 = imagerotate($source_113x113, $degrees, imageColorAllocateAlpha($source_113x113, 0, 0, 0, 127));
									// Output
									imagejpeg($rotate_113x113, $dir.'thumbnails/113x113/'.$basename, 90);
									chmod($dir.'thumbnails/113x113/'.$basename, 0777);

									// Load
									$source_130x130 = imagecreatefromjpeg($dir.'thumbnails/130x130/'.$basename);
									// Rotate
									$rotate_130x130 = imagerotate($source_130x130, $degrees, imageColorAllocateAlpha($source_130x130, 0, 0, 0, 127));
									// Output
									imagejpeg($rotate_130x130, $dir.'thumbnails/130x130/'.$basename, 90);
									chmod($dir.'thumbnails/130x130/'.$basename, 0777);

									// Load
									$source_150x150 = imagecreatefromjpeg($dir.'thumbnails/150x150/'.$basename);
									// Rotate
									$rotate_150x150 = imagerotate($source_150x150, $degrees, imageColorAllocateAlpha($source_150x150, 0, 0, 0, 127));
									// Output
									imagejpeg($rotate_150x150, $dir.'thumbnails/150x150/'.$basename, 90);
									chmod($dir.'thumbnails/150x150/'.$basename, 0777);

									// Load
									$source_244x244 = imagecreatefromjpeg($dir.'thumbnails/244x244/'.$basename);
									// Rotate
									$rotate_244x244 = imagerotate($source_244x244, $degrees, imageColorAllocateAlpha($source_244x244, 0, 0, 0, 127));
									// Output
									imagejpeg($rotate_244x244, $dir.'thumbnails/244x244/'.$basename, 90);
									chmod($dir.'thumbnails/244x244/'.$basename, 0777);

									// Load
									$source_600x600 = imagecreatefromjpeg($dir.'thumbnails/600x600/'.$basename);
									// Rotate
									$rotate_600x600 = imagerotate($source_600x600, $degrees, imageColorAllocateAlpha($source_600x600, 0, 0, 0, 127));
									// Output
									imagejpeg($rotate_600x600, $dir.'thumbnails/600x600/'.$basename, 90);
									chmod($dir.'thumbnails/600x600/'.$basename, 0777);
		/*echo $dir."<br>";
		echo $basename;exit;*/
									break;
								case 'png':
/*
									// Load
									@$source = imageCreateFromPNG($dir.'/'.$basename);
									imagealphablending($source, false);
									imagesavealpha($source, true);
									// Rotate
									@$rotate = imagerotate($source, $degrees, imageColorAllocateAlpha($source, 0, 0, 0, 127));
									imagealphablending($rotate, false);
									imagesavealpha($rotate, true);
									// Output
									@imagepng($rotate, $dir.'/'.$basename);
									@chmod($dir.'/'.$basename, 0777);
*/
									// Load
									@$source_113x113 = imageCreateFromPNG($dir.'thumbnails/113x113/'.$basename);
									imagealphablending($source_113x113, false);
									imagesavealpha($source_113x113, true);
									// Rotate
									@$rotate_113x113 = imagerotate($source_113x113, $degrees, imageColorAllocateAlpha($source_113x113, 0, 0, 0, 127));
									imagealphablending($rotate_113x113, false);
									imagesavealpha($rotate_113x113, true);
									// Output
									@imagepng($rotate_113x113, $dir.'thumbnails/113x113/'.$basename);
									@chmod($dir.'thumbnails/113x113/'.$basename, 0777);

									// Load
									@$source_130x130 = imageCreateFromPNG($dir.'thumbnails/130x130/'.$basename);
									imagealphablending($source_130x130, false);
									imagesavealpha($source_130x130, true);
									// Rotate
									@$rotate_130x130 = imagerotate($source_130x130, $degrees, imageColorAllocateAlpha($source_130x130, 0, 0, 0, 127));
									imagealphablending($rotate_130x130, false);
									imagesavealpha($rotate_130x130, true);
									// Output
									@imagepng($rotate_130x130, $dir.'thumbnails/130x130/'.$basename);
									@chmod($dir.'thumbnails/130x130/'.$basename, 0777);

									// Load
									@$source_150x150 = imageCreateFromPNG($dir.'thumbnails/150x150/'.$basename);
									imagealphablending($source_150x150, false);
									imagesavealpha($source_150x150, true);
									// Rotate
									@$rotate_150x150 = imagerotate($source_150x150, $degrees, imageColorAllocateAlpha($source_150x150, 0, 0, 0, 127));
									imagealphablending($rotate_150x150, false);
									imagesavealpha($rotate_150x150, true);
									// Output
									@imagepng($rotate_150x150, $dir.'thumbnails/150x150/'.$basename);
									@chmod($dir.'thumbnails/150x150/'.$basename, 0777);

									// Load
									@$source_244x244 = imageCreateFromPNG($dir.'thumbnails/244x244/'.$basename);
									imagealphablending($source_244x244, false);
									imagesavealpha($source_244x244, true);
									// Rotate
									@$rotate_244x244 = imagerotate($source_244x244, $degrees, imageColorAllocateAlpha($source_244x244, 0, 0, 0, 127));
									imagealphablending($rotate_244x244, false);
									imagesavealpha($rotate_244x244, true);
									// Output
									@imagepng($rotate_244x244, $dir.'thumbnails/244x244/'.$basename);
									@chmod($dir.'thumbnails/244x244/'.$basename, 0777);

									// Load
									@$source_600x600 = imageCreateFromPNG($dir.'thumbnails/600x600/'.$basename);
									imagealphablending($source_600x600, false);
									imagesavealpha($source_600x600, true);
									// Rotate
									@$rotate_600x600 = imagerotate($source_600x600, $degrees, imageColorAllocateAlpha($source_600x600, 0, 0, 0, 127));
									imagealphablending($rotate_600x600, false);
									imagesavealpha($rotate_600x600, true);
									// Output
									@imagepng($rotate_600x600, $dir.'thumbnails/600x600/'.$basename);
									@chmod($dir.'thumbnails/600x600/'.$basename, 0777);
		/*echo $dir;
		echo $basename;exit;*/
									break;
								case 'gif':
									
	/*								
									// Load
									@$source = imagecreatefromgif($dir.'/'.$basename);
									// Rotate
									@$rotate = imagerotate($source, $degrees, imageColorAllocateAlpha($source, 0, 0, 0, 127));
									// Output
									@imagegif($rotate, $dir.'/'.$basename);
									@chmod($dir.'/'.$basename, 0777);
*/									
									// Load
									@$source_113x113 = imagecreatefromgif($dir.'thumbnails/113x113/'.$basename);
									// Rotate
									@$rotate_113x113 = imagerotate($source_113x113, $degrees, imageColorAllocateAlpha($source_113x113, 0, 0, 0, 127));
									// Output
									@imagegif($rotate_113x113, $dir.'thumbnails/113x113/'.$basename);
									@chmod($dir.'thumbnails/113x113/'.$basename, 0777);
									
									// Load
									@$source_130x130 = imagecreatefromgif($dir.'thumbnails/130x130/'.$basename);
									// Rotate
									@$rotate_130x130 = imagerotate($source_130x130, $degrees, imageColorAllocateAlpha($source_130x130, 0, 0, 0, 127));
									// Output
									@imagegif($rotate_130x130, $dir.'thumbnails/130x130/'.$basename);
									@chmod($dir.'thumbnails/130x130/'.$basename, 0777);
									
									// Load
									@$source_150x150 = imagecreatefromgif($dir.'thumbnails/150x150/'.$basename);
									// Rotate
									@$rotate_150x150 = imagerotate($source_150x150, $degrees, imageColorAllocateAlpha($source_150x150, 0, 0, 0, 127));
									// Output
									@imagegif($rotate_150x150, $dir.'thumbnails/150x150/'.$basename);
									@chmod($dir.'thumbnails/150x150/'.$basename, 0777);
									
									// Load
									@$source_244x244 = imagecreatefromgif($dir.'thumbnails/244x244/'.$basename);
									// Rotate
									@$rotate_244x244 = imagerotate($source_244x244, $degrees, imageColorAllocateAlpha($source_244x244, 0, 0, 0, 127));
									// Output
									@imagegif($rotate_244x244, $dir.'thumbnails/244x244/'.$basename);
									@chmod($dir.'thumbnails/244x244/'.$basename, 0777);
									
									// Load
									@$source_600x600 = imagecreatefromgif($dir.'thumbnails/600x600/'.$basename);
									// Rotate
									@$rotate_600x600 = imagerotate($source_600x600, $degrees, imageColorAllocateAlpha($source_600x600, 0, 0, 0, 127));
									// Output
									@imagegif($rotate, $dir.'thumbnails/600x600/'.$basename);
									@chmod($dir.'thumbnails/600x600/'.$basename, 0777);
		/*							
		echo $dir;
		echo $basename;exit;*/
									break;
									
								default:
							}
				
							$i++;
						}
							$client_images=implode(',',$client_image);
							//echo $client_images;
							//echo $sortdiv;exit;
							$updatedata=array('tagid'=>$tags, 'featured'=>$chk_featured, 'public'=>$chk_public, 'photos'=>$client_images, 'photo_order'=>$sortdiv);
							$isupdate=$this->user_model->UPDATEDATA('client_photos', array('id'=>$client_photo_id),$updatedata);
							if($isupdate)
							{
								$this->session->set_flashdata('section','photos');
								$this->session->set_flashdata('email_pic_msg', '<b style="color:green;">Client Photos Updated Successfully</b>');
								//$data['message'] ='<div class="text-success-wrapper">Client Photos Added Successfully<span class="text-success-close">x</span></div>';
								redirect(site_url().'stylist/manageclient/'.$uId.'#photos');
								/*
								$this->session->set_flashdata('reload', 'reload');
								$data['photo_msg'] ='<div class="text-success-wrapper">Client Photos Added Successfully<span class="text-success-close">x</span></div>';
								$data['reload'] ="reload";
								*/
							}
							else
							{
								$this->session->set_flashdata('section','photos');
								$this->session->set_flashdata('email_pic_msg', '<b style="color:red;">Image Update Failed</b>');
								//$data['message'] ='<div class="text-success-wrapper">Client Photos Added Successfully<span class="text-success-close">x</span></div>';
								redirect(site_url().'stylist/manageclient/'.$uId.'#photos');
								
							}
					}
					else
					{
						$this->session->set_flashdata('section','photos');
						$this->session->set_flashdata('email_pic_msg', '<b style="color:red;">Image Update Failed</b>');
								//$data['message'] ='<div class="text-success-wrapper">Client Photos Added Successfully<span class="text-success-close">x</span></div>';
								redirect(site_url().'stylist/manageclient/'.$uId.'#photos');
						
					}
					
				}
			}
			else
			{
				if(($old_pic_count+$browse_count)>3)
				{
					$data['photo_msg'] ='<div class="text-error">Only Three Images are allowed<span class="text-error-close">x</span></div>';
					$data['section'] ="photos";
				}
				else
				{
				$i=0;
				$client_image='';
				foreach($old_pic as $pic)
				{
					$dir= getcwd().'/assets/uploads/';
					//echo $dir;exit;
					$url = $pic;
					$client_image[]=$url;
					$basename = basename($url);

					$degrees = 360-$degree[$i];
					$info = new SplFileInfo($basename);
					$extention=strtolower($info->getExtension());
					
					//echo $uploadpath.$basename;exit;
					//echo $extention;exit;
					switch ($extention)
					{
								case 'jpg':
/*
									// Load
									$source = imagecreatefromjpeg($dir.'/'.$basename);
									// Rotate
									$rotate = imagerotate($source, $degrees, imageColorAllocateAlpha($source, 0, 0, 0, 127));
									// Output
									imagejpeg($rotate, $dir.'/'.$basename, 90);
									chmod($dir.'/'.$basename, 0777);
*/
									// Load
									$source_113x113 = imagecreatefromjpeg($dir.'thumbnails/113x113/'.$basename);
									// Rotate
									$rotate_113x113 = imagerotate($source_113x113, $degrees, imageColorAllocateAlpha($source_113x113, 0, 0, 0, 127));
									// Output
									imagejpeg($rotate_113x113, $dir.'thumbnails/113x113/'.$basename, 90);
									chmod($dir.'thumbnails/113x113/'.$basename, 0777);

									// Load
									$source_130x130 = imagecreatefromjpeg($dir.'thumbnails/130x130/'.$basename);
									// Rotate
									$rotate_130x130 = imagerotate($source_130x130, $degrees, imageColorAllocateAlpha($source_130x130, 0, 0, 0, 127));
									// Output
									imagejpeg($rotate_130x130, $dir.'thumbnails/130x130/'.$basename, 90);
									chmod($dir.'thumbnails/130x130/'.$basename, 0777);

									// Load
									$source_150x150 = imagecreatefromjpeg($dir.'thumbnails/150x150/'.$basename);
									// Rotate
									$rotate_150x150 = imagerotate($source_150x150, $degrees, imageColorAllocateAlpha($source_150x150, 0, 0, 0, 127));
									// Output
									imagejpeg($rotate_150x150, $dir.'thumbnails/150x150/'.$basename, 90);
									chmod($dir.'thumbnails/150x150/'.$basename, 0777);

									// Load
									$source_244x244 = imagecreatefromjpeg($dir.'thumbnails/244x244/'.$basename);
									// Rotate
									$rotate_244x244 = imagerotate($source_244x244, $degrees, imageColorAllocateAlpha($source_244x244, 0, 0, 0, 127));
									// Output
									imagejpeg($rotate_244x244, $dir.'thumbnails/244x244/'.$basename, 90);
									chmod($dir.'thumbnails/244x244/'.$basename, 0777);

									// Load
									$source_600x600 = imagecreatefromjpeg($dir.'thumbnails/600x600/'.$basename);
									// Rotate
									$rotate_600x600 = imagerotate($source_600x600, $degrees, imageColorAllocateAlpha($source_600x600, 0, 0, 0, 127));
									// Output
									imagejpeg($rotate_600x600, $dir.'thumbnails/600x600/'.$basename, 90);
									chmod($dir.'thumbnails/600x600/'.$basename, 0777);
		/*echo $dir;
		echo $basename;exit;*/
									break;
								case 'jpeg':
									
		/*												
									// Load
									$source = imagecreatefromjpeg($dir.'/'.$basename);
									// Rotate
									$rotate = imagerotate($source, $degrees, imageColorAllocateAlpha($source, 0, 0, 0, 127));
									// Output
									imagejpeg($rotate, $dir.'/'.$basename, 90);
									chmod($dir.'/'.$basename, 0777);
*/
									// Load
									$source_113x113 = imagecreatefromjpeg($dir.'thumbnails/113x113/'.$basename);
									// Rotate
									$rotate_113x113 = imagerotate($source_113x113, $degrees, imageColorAllocateAlpha($source_113x113, 0, 0, 0, 127));
									// Output
									imagejpeg($rotate_113x113, $dir.'thumbnails/113x113/'.$basename, 90);
									chmod($dir.'thumbnails/113x113/'.$basename, 0777);

									// Load
									$source_130x130 = imagecreatefromjpeg($dir.'thumbnails/130x130/'.$basename);
									// Rotate
									$rotate_130x130 = imagerotate($source_130x130, $degrees, imageColorAllocateAlpha($source_130x130, 0, 0, 0, 127));
									// Output
									imagejpeg($rotate_130x130, $dir.'thumbnails/130x130/'.$basename, 90);
									chmod($dir.'thumbnails/130x130/'.$basename, 0777);

									// Load
									$source_150x150 = imagecreatefromjpeg($dir.'thumbnails/150x150/'.$basename);
									// Rotate
									$rotate_150x150 = imagerotate($source_150x150, $degrees, imageColorAllocateAlpha($source_150x150, 0, 0, 0, 127));
									// Output
									imagejpeg($rotate_150x150, $dir.'thumbnails/150x150/'.$basename, 90);
									chmod($dir.'thumbnails/150x150/'.$basename, 0777);

									// Load
									$source_244x244 = imagecreatefromjpeg($dir.'thumbnails/244x244/'.$basename);
									// Rotate
									$rotate_244x244 = imagerotate($source_244x244, $degrees, imageColorAllocateAlpha($source_244x244, 0, 0, 0, 127));
									// Output
									imagejpeg($rotate_244x244, $dir.'thumbnails/244x244/'.$basename, 90);
									chmod($dir.'thumbnails/244x244/'.$basename, 0777);

									// Load
									$source_600x600 = imagecreatefromjpeg($dir.'thumbnails/600x600/'.$basename);
									// Rotate
									$rotate_600x600 = imagerotate($source_600x600, $degrees, imageColorAllocateAlpha($source_600x600, 0, 0, 0, 127));
									// Output
									imagejpeg($rotate_600x600, $dir.'thumbnails/600x600/'.$basename, 90);
									chmod($dir.'thumbnails/600x600/'.$basename, 0777);
		/*echo $dir."<br>";
		echo $basename;exit;*/
									break;
								case 'png':
/*
									// Load
									@$source = imageCreateFromPNG($dir.'/'.$basename);
									imagealphablending($source, false);
									imagesavealpha($source, true);
									// Rotate
									@$rotate = imagerotate($source, $degrees, imageColorAllocateAlpha($source, 0, 0, 0, 127));
									imagealphablending($rotate, false);
									imagesavealpha($rotate, true);
									// Output
									@imagepng($rotate, $dir.'/'.$basename);
									@chmod($dir.'/'.$basename, 0777);
*/
									// Load
									@$source_113x113 = imageCreateFromPNG($dir.'thumbnails/113x113/'.$basename);
									imagealphablending($source_113x113, false);
									imagesavealpha($source_113x113, true);
									// Rotate
									@$rotate_113x113 = imagerotate($source_113x113, $degrees, imageColorAllocateAlpha($source_113x113, 0, 0, 0, 127));
									imagealphablending($rotate_113x113, false);
									imagesavealpha($rotate_113x113, true);
									// Output
									@imagepng($rotate_113x113, $dir.'thumbnails/113x113/'.$basename);
									@chmod($dir.'thumbnails/113x113/'.$basename, 0777);

									// Load
									@$source_130x130 = imageCreateFromPNG($dir.'thumbnails/130x130/'.$basename);
									imagealphablending($source_130x130, false);
									imagesavealpha($source_130x130, true);
									// Rotate
									@$rotate_130x130 = imagerotate($source_130x130, $degrees, imageColorAllocateAlpha($source_130x130, 0, 0, 0, 127));
									imagealphablending($rotate_130x130, false);
									imagesavealpha($rotate_130x130, true);
									// Output
									@imagepng($rotate_130x130, $dir.'thumbnails/130x130/'.$basename);
									@chmod($dir.'thumbnails/130x130/'.$basename, 0777);

									// Load
									@$source_150x150 = imageCreateFromPNG($dir.'thumbnails/150x150/'.$basename);
									imagealphablending($source_150x150, false);
									imagesavealpha($source_150x150, true);
									// Rotate
									@$rotate_150x150 = imagerotate($source_150x150, $degrees, imageColorAllocateAlpha($source_150x150, 0, 0, 0, 127));
									imagealphablending($rotate_150x150, false);
									imagesavealpha($rotate_150x150, true);
									// Output
									@imagepng($rotate_150x150, $dir.'thumbnails/150x150/'.$basename);
									@chmod($dir.'thumbnails/150x150/'.$basename, 0777);

									// Load
									@$source_244x244 = imageCreateFromPNG($dir.'thumbnails/244x244/'.$basename);
									imagealphablending($source_244x244, false);
									imagesavealpha($source_244x244, true);
									// Rotate
									@$rotate_244x244 = imagerotate($source_244x244, $degrees, imageColorAllocateAlpha($source_244x244, 0, 0, 0, 127));
									imagealphablending($rotate_244x244, false);
									imagesavealpha($rotate_244x244, true);
									// Output
									@imagepng($rotate_244x244, $dir.'thumbnails/244x244/'.$basename);
									@chmod($dir.'thumbnails/244x244/'.$basename, 0777);

									// Load
									@$source_600x600 = imageCreateFromPNG($dir.'thumbnails/600x600/'.$basename);
									imagealphablending($source_600x600, false);
									imagesavealpha($source_600x600, true);
									// Rotate
									@$rotate_600x600 = imagerotate($source_600x600, $degrees, imageColorAllocateAlpha($source_600x600, 0, 0, 0, 127));
									imagealphablending($rotate_600x600, false);
									imagesavealpha($rotate_600x600, true);
									// Output
									@imagepng($rotate_600x600, $dir.'thumbnails/600x600/'.$basename);
									@chmod($dir.'thumbnails/600x600/'.$basename, 0777);
		/*echo $dir;
		echo $basename;exit;*/
									break;
								case 'gif':
					/*				
									
									// Load
									@$source = imagecreatefromgif($dir.'/'.$basename);
									// Rotate
									@$rotate = imagerotate($source, $degrees, imageColorAllocateAlpha($source, 0, 0, 0, 127));
									// Output
									@imagegif($rotate, $dir.'/'.$basename);
									@chmod($dir.'/'.$basename, 0777);
				*/					
									// Load
									@$source_113x113 = imagecreatefromgif($dir.'thumbnails/113x113/'.$basename);
									// Rotate
									@$rotate_113x113 = imagerotate($source_113x113, $degrees, imageColorAllocateAlpha($source_113x113, 0, 0, 0, 127));
									// Output
									@imagegif($rotate_113x113, $dir.'thumbnails/113x113/'.$basename);
									@chmod($dir.'thumbnails/113x113/'.$basename, 0777);
									
									// Load
									@$source_130x130 = imagecreatefromgif($dir.'thumbnails/130x130/'.$basename);
									// Rotate
									@$rotate_130x130 = imagerotate($source_130x130, $degrees, imageColorAllocateAlpha($source_130x130, 0, 0, 0, 127));
									// Output
									@imagegif($rotate_130x130, $dir.'thumbnails/130x130/'.$basename);
									@chmod($dir.'thumbnails/130x130/'.$basename, 0777);
									
									// Load
									@$source_150x150 = imagecreatefromgif($dir.'thumbnails/150x150/'.$basename);
									// Rotate
									@$rotate_150x150 = imagerotate($source_150x150, $degrees, imageColorAllocateAlpha($source_150x150, 0, 0, 0, 127));
									// Output
									@imagegif($rotate_150x150, $dir.'thumbnails/150x150/'.$basename);
									@chmod($dir.'thumbnails/150x150/'.$basename, 0777);
									
									// Load
									@$source_244x244 = imagecreatefromgif($dir.'thumbnails/244x244/'.$basename);
									// Rotate
									@$rotate_244x244 = imagerotate($source_244x244, $degrees, imageColorAllocateAlpha($source_244x244, 0, 0, 0, 127));
									// Output
									@imagegif($rotate_244x244, $dir.'thumbnails/244x244/'.$basename);
									@chmod($dir.'thumbnails/244x244/'.$basename, 0777);
									
									// Load
									@$source_600x600 = imagecreatefromgif($dir.'thumbnails/600x600/'.$basename);
									// Rotate
									@$rotate_600x600 = imagerotate($source_600x600, $degrees, imageColorAllocateAlpha($source_600x600, 0, 0, 0, 127));
									// Output
									@imagegif($rotate, $dir.'thumbnails/600x600/'.$basename);
									@chmod($dir.'thumbnails/600x600/'.$basename, 0777);
		/*							
		echo $dir;
		echo $basename;exit;*/
									break;
									
								default:
							}
				
					$i++;
				}
					$client_images=implode(',',$client_image);
				//	echo"<pre>";print_r($client_images);exit;
					$updatedata=array('tagid'=>$tags, 'featured'=>$chk_featured, 'public'=>$chk_public, 'photos'=>$client_images, 'photo_order'=>'0,1,2');
					$isupdate=$this->user_model->UPDATEDATA('client_photos', array('id'=>$client_photo_id),$updatedata);
					if($isupdate)
					{
						$this->session->set_flashdata('section','photos');
						$this->session->set_flashdata('email_pic_msg', '<b style="color:green;">Client Photos Updated Successfully</b>');
						//$data['message'] ='<div class="text-success-wrapper">Client Photos Added Successfully<span class="text-success-close">x</span></div>';
						redirect(site_url().'stylist/manageclient/'.$uId.'#photos');
						
						
					}
					else
					{
						$this->session->set_flashdata('section','photos');
						$this->session->set_flashdata('email_pic_msg', '<b style="color:red;">Image Update Failed</b>');
								//$data['message'] ='<div class="text-success-wrapper">Client Photos Added Successfully<span class="text-success-close">x</span></div>';
								redirect(site_url().'stylist/manageclient/'.$uId.'#photos');
							
					}
				}
			}
		}

		/*End of 5th isset*/
		
		if(isset($_POST['build_product']))
		{
			
			$join_client=array(
						array('table'=>'client','condition'=>'`client`.`user_id` = `tbl_user`.`id`','jointype'=>'inner'),
						);
			$data['clients'] = $this->user_model->get_joins('tbl_user',array('tbl_user.id'=>$uid),$join_client);
			$ethnicity=$data['clients'][0]['ethnicity'];
			$hair_color=$data['clients'][0]['hair_color'];
			$hair_texture=$data['clients'][0]['hair_texture'];
			$hair_density=$data['clients'][0]['hair_density'];
			
			$sessionid=$this->session->userdata('id');
			$where=array('tbl_user.id'=>$sessionid, 'tbl_ethnicity.id'=>$ethnicity, 'tbl_color.name'=>$hair_color, 'tbl_texture.id'=>$hair_texture, 'tbl_density.density'=>$hair_density);
			
			$join_stylist=array(
						array('table'=>'stylist','condition'=>'`stylist`.`id` = `stylist_product`.`s_id`','jointype'=>'inner'),
						array('table'=>'tbl_user','condition'=>'`tbl_user`.`id` = `stylist`.`user_id`','jointype'=>'inner'),
						array('table'=>'brand','condition'=>'`brand`.`id` = `stylist_product`.`brand_id`','jointype'=>'inner'),
						
						array('table'=>'product','condition'=>'`product`.`brand_id` = `stylist_product`.`brand_id`','jointype'=>'inner'),
						array('table'=>'category','condition'=>'`category`.`id` = `product`.`categoryid`','jointype'=>'inner'),
						
						array('table'=>'pro_color','condition'=>'`product`.`id` = `pro_color`.`product_id`','jointype'=>'inner'),
						array('table'=>'tbl_color','condition'=>'`tbl_color`.`id` = `pro_color`.`color_id`','jointype'=>'inner'),
						
						array('table'=>'pro_density','condition'=>'`product`.`id` = `pro_density`.`product_id`','jointype'=>'inner'),
						array('table'=>'tbl_density','condition'=>'`tbl_density`.`id` = `pro_density`.`density_id`','jointype'=>'inner'),
					
						array('table'=>'pro_ethnicity','condition'=>'`product`.`id` = `pro_ethnicity`.`product_id`','jointype'=>'inner'),
						array('table'=>'tbl_ethnicity','condition'=>'`tbl_ethnicity`.`id` = `pro_ethnicity`.`ethnicity_id`','jointype'=>'inner'),
					
						array('table'=>'pro_texture','condition'=>'`product`.`id` = `pro_texture`.`product_id`','jointype'=>'inner'),
						array('table'=>'tbl_texture','condition'=>'`tbl_texture`.`id` = `pro_texture`.`texture_id`','jointype'=>'inner'),
						);
			//$fields=array('tbl_user.id as user_id', 'product.id as product_id', 'product.name as product_name', 'product.image as image', 'product.price as price', 'product.description as product_desc', 'brand.id as brand_id', 'brand.name as brand_name', 'category.id as category_id', 'category.name as category_name', 'stylist_product.s_id as s_id', );
			$fields=array('category.name as category_name','brand.name as brand_name', 'product.id as product_id', 'product.name', 'product.description', 'product.price', 'product.tagid', 'product.image');
			$data['suggestedproduct'] = $this->user_model->get_joins('stylist_product',$where,$join_stylist,$fields);
			$data['section']="product";
			if(empty($data['suggestedproduct']))
			{
				$data['message_product'] ='<div class="text-error">No Match Found<span class="text-error-close">x</span></div>';
				$data['section']="product";
			}
		/*	echo $this->db->last_query();
			echo"<pre>";print_r($data['suggestedproduct']); exit;*/
		}
				
		/*End of 6th isset*/
		
		if(isset($_POST['all_product']))
		{
			$sessionid=$this->session->userdata('id');
			
			$join_=array(
						array('table'=>'stylist','condition'=>'`stylist`.`id` = `stylist_product`.`s_id`','jointype'=>'inner'),
						array('table'=>'tbl_user','condition'=>'`tbl_user`.`id` = `stylist`.`user_id`','jointype'=>'inner'),
						array('table'=>'brand','condition'=>'`brand`.`id` = `stylist_product`.`brand_id`','jointype'=>'inner'),
						array('table'=>'product','condition'=>'`product`.`brand_id` = `stylist_product`.`brand_id`','jointype'=>'inner'),
						array('table'=>'category','condition'=>'`category`.`id` = `product`.`categoryid`','jointype'=>'inner'),
						);
			//$fields=array('tbl_user.id as user_id', 'product.id as product_id', 'product.name as product_name', 'product.image as image', 'product.price as price', 'product.description as product_desc', 'brand.id as brand_id', 'brand.name as brand_name', 'category.id as category_id', 'category.name as category_name', 'stylist_product.s_id as s_id', );
			$fields=array('category.name as category_name','brand.name as brand_name', 'product.id as product_id', 'product.name', 'product.description', 'product.price', 'product.tagid', 'product.image');
			$data['suggestedproduct'] = $this->user_model->get_joins('stylist_product',array('tbl_user.id'=>$sessionid),$join_,$fields);
			$data['section']="product";
			if(empty($data['suggestedproduct']))
			{
				$data['message_product'] ='<div class="text-error">You Have Not Selected any Brand <span class="text-error-close">x</span></div>';
				$data['section']="product";
			}
			//echo $this->db->last_query();
		}
				
		/*End of 7th isset*/
		
		if(isset($_POST['suggested_product']))
		{
			$sessionid=$this->session->userdata('id');
			$where=array('ethnicity'=>$ethnicity,'texture'=>$hair_texture,'color'=>$hair_color,'density'=>$hair_density);

			$fields=array('category.name as category_name','brand.name as brand_name', 'product.id as product_id', 'product.name', 'product.description', 'product.price', 'product.tagid', 'product.image');
			
			$join=array(
						array('table'=>'stylist','condition'=>'`stylist`.`id` = `stylist_product`.`s_id`','jointype'=>'inner'),
						array('table'=>'tbl_user','condition'=>'`tbl_user`.`id` = `stylist`.`user_id`','jointype'=>'inner'),
						array('table'=>'product','condition'=>'`product`.`brand_id` = `stylist_product`.`brand_id`','jointype'=>'inner'),
						array('table'=>'category','condition'=>'`product`.`categoryid` = `category`.`id`','jointype'=>'inner'),
						array('table'=>'brand','condition'=>'`product`.`brand_id` = `brand`.`id`','jointype'=>'inner'),
						);
			
			$data['suggestedproduct']=$this->user_model->get_joins('stylist_product',array('tbl_user.id'=>$sessionid),$join,$fields,$where,'product.id','product.name');
			$data['section']="product";
			//echo $this->db->last_query();
			if(empty($data['suggestedproduct']))
			{
				$data['message_product'] ='<div class="text-error">No Matching Product found<span class="text-error-close">x</span></div>';
				$data['section']="product";
			}

		}
		
		/*End of 8th isset*/
		
		if(isset($_POST['selected_product']))
		{
			$sessionid=$this->session->userdata('id');
			$where=array('client.user_id'=>$clientid);
			
			$fields=array('category.name as category_name','brand.id as brand_id', 'brand.name as brand_name', 'product.id as product_id', 'product.name', 'product.description', 'product.price', 'product.tagid', 'product.image', 'client.id as c_id', 'client.s_id as s_id', 'client.user_id as user_id');
			$join=array(
						array('table'=>'client','condition'=>'`tbl_selected_products`.`c_id` = `client`.`id`','jointype'=>'inner'),
						array('table'=>'tbl_user','condition'=>'`tbl_user`.`id` = `client`.`user_id`','jointype'=>'inner'),
						array('table'=>'product','condition'=>'`product`.`id` = `tbl_selected_products`.`selected_id`','jointype'=>'inner'),
						array('table'=>'brand','condition'=>'`product`.`brand_id` = `brand`.`id`','jointype'=>'inner'),
						array('table'=>'category','condition'=>'`product`.`categoryid` = `category`.`id`','jointype'=>'inner'),
						);
			
			$data['selected_product']=$this->user_model->get_joins('tbl_selected_products',$where,$join,$fields);
			 //echo $this->db->last_query();exit;
			$join_p=array(
						array('table'=>'stylist','condition'=>'`stylist`.`id` = `stylist_product`.`s_id`','jointype'=>'inner'),
						array('table'=>'tbl_user','condition'=>'`tbl_user`.`id` = `stylist`.`user_id`','jointype'=>'inner'),
						array('table'=>'product','condition'=>'`product`.`brand_id` = `stylist_product`.`brand_id`','jointype'=>'inner'),
						array('table'=>'category','condition'=>'`product`.`categoryid` = `category`.`id`','jointype'=>'inner'),
						array('table'=>'brand','condition'=>'`product`.`brand_id` = `brand`.`id`','jointype'=>'inner'),
						);
			
			$data['stylists_products']=$this->user_model->get_joins('stylist_product',array('stylist.user_id'=>$sessionid),$join_p,array('stylist_product.id','stylist_product.brand_id',),'','brand.id');
			$data['section']="product";
			
			//echo $this->db->last_query();
			if(empty($data['selected_product']))
			{
				$data['message_product'] ='<div class="text-error">You have not selected any Product<span class="text-error-close">x</span></div>';
				$data['section']="product";
			}

		}
		
		
		if(isset($_POST['search']))
		{
			$sessionid=$this->session->userdata('id');
			
			$suggest_pro_category_post=$this->input->post('suggest_pro_category_post');
			$suggest_pro_brand_post=$this->input->post('suggest_pro_brand_post');
			$suggest_pro_tag_post=$this->input->post('suggest_pro_tag_post');
			$filter_product=ucwords($this->input->post('filter_product'));
			if( (empty($suggest_pro_category_post)) && (empty($suggest_pro_brand_post)) && (empty($suggest_pro_tag_post)) && (empty($filter_product)) )
			{
				$data['message_product'] ='<div class="text-error">Please Select atleast one Search field <span class="text-error-close">x</span></div>';
				$data['section']="product";
			}
			else
			{
				
				$field=array('category.id as categoryid', 'category.name as categoryname', 'brand.id as brandid', 'brand.name as brandname', 'product.id as id', 'product.name as productname', 'product.description', 'product.price', 'product.color', 'product.density', 'product.image', 'tags.id as tagid', 'tags.tagname as tagname', );
				if(!empty($suggest_pro_tag_post))
				{
					//print_r($suggest_pro_tag_post);
					$productsearch='';
					foreach($suggest_pro_tag_post as $tagid)
					{
						$where=array('`product`.`brand_id`'=>$suggest_pro_brand_post, '`product`.`categoryid`'=>$suggest_pro_category_post,);
						if(!empty($filter_product))
						{
							$like=array('`product`.`tagid`'=>$tagid, '`product`.`name`'=>$filter_product,  '`brand`.`name`'=>$filter_product, '`category`.`name`'=>$filter_product, '`product`.`description`'=>$filter_product, '`product`.`color`'=>$filter_product, '`product`.`density`'=>$filter_product, '`product`.`price`'=>$filter_product, );
						}
						elseif((!empty($suggest_pro_brand_post)) || (!empty($suggest_pro_category_post)) )
						{
							$like='';
						}
						else
						{
							
							$like=array('`product`.`tagid`'=>$tagid);
						}

						
						$join =array(
								array('table'=>'brand','condition'=>'`product`.`brand_id` = `brand`.`id`','jointype'=>'inner'),
								array('table'=>'category','condition'=>'`product`.`categoryid` = `category`.`id`','jointype'=>'inner'),
								array('table'=>'tags','condition'=>'`product`.`tagid` = `tags`.`id`','jointype'=>'inner'),
								);
						$productsearch=$this->user_model->get_joins('product','',$join,$field,$like,'','','','','',$where);
					}
				//	echo $this->db->last_query();
					$data['productsearch']=$productsearch;	
								
				}
				else
				{
					$where=array('`product`.`brand_id`'=>$suggest_pro_brand_post, '`product`.`categoryid`'=>$suggest_pro_category_post,);
					if((!empty($suggest_pro_brand_post)) || (!empty($suggest_pro_category_post)) )
					{
						$like='';
					}
					else
					{
						$like=array( '`product`.`name`'=>$filter_product,  '`brand`.`name`'=>$filter_product, '`category`.`name`'=>$filter_product, '`product`.`description`'=>$filter_product, '`product`.`color`'=>$filter_product, '`product`.`density`'=>$filter_product, '`product`.`price`'=>$filter_product, );
					}
					
					$join =array(
								array('table'=>'brand','condition'=>'`product`.`brand_id` = `brand`.`id`','jointype'=>'inner'),
								array('table'=>'category','condition'=>'`product`.`categoryid` = `category`.`id`','jointype'=>'inner'),
								array('table'=>'tags','condition'=>'`product`.`tagid` = `tags`.`id`','jointype'=>'inner'),
								);
					$data['productsearch']=$this->user_model->get_joins('product','',$join,$field,$like,'','','','','',$where);
					//echo $this->db->last_query();
				}
				
				$join_p=array(
						array('table'=>'stylist','condition'=>'`stylist`.`id` = `stylist_product`.`s_id`','jointype'=>'inner'),
						array('table'=>'tbl_user','condition'=>'`tbl_user`.`id` = `stylist`.`user_id`','jointype'=>'inner'),
						array('table'=>'product','condition'=>'`product`.`brand_id` = `stylist_product`.`brand_id`','jointype'=>'inner'),
						array('table'=>'category','condition'=>'`product`.`categoryid` = `category`.`id`','jointype'=>'inner'),
						array('table'=>'brand','condition'=>'`product`.`brand_id` = `brand`.`id`','jointype'=>'inner'),
						);
			
				$data['stylists_products']=$this->user_model->get_joins('stylist_product',array('stylist.user_id'=>$sessionid),$join_p,array('stylist_product.id','stylist_product.brand_id',),'','brand.id');
				$data['section']="product";
			
				if(empty($data['productsearch']))
				{
					$data['section']="product";
					$data['message_product'] ='<div class="text-error">No Match Found <span class="text-error-close">x</span></div>';
				}
			}
		}
		
		//*****************************send the email and the client data and description to the client*****************//
		
		if(isset($_POST['email_pack']))
		{
			//$client_email=$this->input->post('email');
			$join=array(
						array('table'=>'client','condition'=>'`client`.`id` = `tbl_selected_products`.`c_id`','jointype'=>'inner'),
						array('table'=>'stylist','condition'=>'`stylist`.`id` = `tbl_selected_products`.`s_id`','jointype'=>'inner'),
						array('table'=>'tbl_user','condition'=>'`client`.`user_id` = `tbl_user`.`id`','jointype'=>'inner'),
						array('table'=>'tbl_user as stylist_details','condition'=>'`stylist_details`.`id` = `stylist`.`user_id`','jointype'=>'inner'),
						array('table'=>'product','condition'=>'`product`.`id` = `tbl_selected_products`.`selected_id`','jointype'=>'inner'),
						array('table'=>'brand','condition'=>'`brand`.`id` = `product`.`brand_id`','jointype'=>'inner'),
						array('table'=>'category','condition'=>'`category`.`id` = `product`.`categoryid`','jointype'=>'inner'),
						);
			$emaild_fields=array('tbl_user.firstname', 'tbl_user.lastname', 'tbl_user.email', 'stylist_details.firstname as stylist_fname', 'stylist_details.lastname as stylist_lname', 'stylist_details.email as stylist_email', 'stylist.id as s_id', 'client.id as c_id', 'product.name as p_name', 'product.description as p_description', 'product.id as p_id', 'product.image as p_image', 'brand.id as brand_id', 'brand.name as b_name',  'category.id as cate_id', 'category.name as cate_name', );
			$data['all_email_data']=$this->user_model->get_joins('tbl_selected_products',array('tbl_user.id'=>$uid),$join,$emaild_fields);
			
			
			$join_p=array(
							array('table'=>'stylist','condition'=>'`stylist`.`id` = `stylist_product`.`s_id`','jointype'=>'inner'),
							array('table'=>'tbl_user','condition'=>'`tbl_user`.`id` = `stylist`.`user_id`','jointype'=>'inner'),
							array('table'=>'product','condition'=>'`product`.`brand_id` = `stylist_product`.`brand_id`','jointype'=>'inner'),
							array('table'=>'category','condition'=>'`product`.`categoryid` = `category`.`id`','jointype'=>'inner'),
							array('table'=>'brand','condition'=>'`product`.`brand_id` = `brand`.`id`','jointype'=>'inner'),
							);
				
			$data['stylists_products']=$this->user_model->get_joins('stylist_product',array('stylist.user_id'=>$sessionid),$join_p,array('stylist_product.id','stylist_product.brand_id',),'','brand.id');
			
			$items=array();
			foreach($data['stylists_products'] as $stylist_item)
			{
				array_push($items,$stylist_item['brand_id']);
			}
			
			$pathtoimg=base_url().'assets/product/thumbnails/150x150/';
			//echo "<pre>";print_r($items);exit;
			if(!empty($data['all_email_data']))
			{
				$message='<h3>Hi '.$data['all_email_data'][0]['firstname'].' '.$data['all_email_data'][0]['lastname'].',</h3><br>Thank You for selecting products. <br><br> Details of Product You have selected is :<br><br><br>';
				
				$headers = "From: " . $data['all_email_data'][0]['stylist_email'] . "\n"; //from address
				//$headers .= "Content-type: text/html; charset=iso-8859-1 \n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
				
				$message.=	'<table cellspacing="0" cellpadding="0" border="0" width="600" padding:3px;>
								<thead style="border-bottom:1px solid #68268A !important; text-align: left !important;">
									<tr>
										<th>S. No.</th><th>Product</th><th>Brand</th><th>Image</th>
									</tr>
								</thead>';
							$i=1;
							foreach($data['all_email_data'] as $emaildata)
							{
								if(in_array($emaildata['brand_id'], $items))
								{
									$message.=	'<tr style="border-bottom:1px solid #68268A !important;">
													<td>'.$i.'</td>
													<td>'.$emaildata['p_name'].'</td>
													<td>'.$emaildata['b_name'].'</td>
													<td><img src='.$pathtoimg.$emaildata['p_image'].' style="height:80px;width:80px;" /></td>
												</tr>';
									$i++;
								}
							}
				$message.=	'</table><br><br><h4>Thanks & Regards<br>Inhairent</h4>';
				$emailto=$data['all_email_data'][0]['email'];
				$subject="My Selected Products";
				$mailsent= mail($emailto, $subject, $message, $headers);
				if($mailsent)
				{
					$currentdate=date("Y-m-d H:i:s");
					$communication_data=array('s_id'=>$data['all_email_data'][0]['s_id'], 'c_id'=>$data['all_email_data'][0]['c_id'], 'title'=>$subject, 'content'=>$message, 'createdate'=>$currentdate, );
					$this->user_model->INSERTDATA('client_communications',$communication_data);
					$data['section']="product";
					$data['message_product'] ='<div class="text-success-wrapper">Package details sent Successfully to '.$emailto.'<span class="text-success-close">x</span></div>';
				}
				else
				{
					$data['section']="product";
					$data['message_product'] ='<div class="text-error">Email Not Sent Try again<span class="text-error-close">x</span></div>';
				}
			}
			else
			{
				$data['section']="product";
				$data['message_product'] ='<div class="text-error">You Have not Selected any Product<span class="text-error-close">x</span></div>';
			}
		}
		
		$this->load->view('Stylist/manageclient',$data);
	}

	//**************************************	Cancel Booking			********************************************//
	
	function cancel_booking()
	{
		$data='';
		$deleteid = $this->uri->segment(3);
		$Uid = $this->uri->segment(4);
		//$c_Uid=$this->input->post('c_Uid');
		$where=array('id'=>$deleteid);
		$cancel_booking = $this->user_model->DELETEDATA('booking', $where);
		if($cancel_booking)
		{
			$data['message'] ='<div class="text-success-wrapper">Booking Cancelled<span class="text-success-close">x</span></div>';
			
			redirect(site_url().'stylist/manageclient/'.$Uid.'#apoinments');
		}
		else
		{
			$data['message'] ='<div class="text-error">Booking Not Cancelled<span class="text-error-close">x</span></div>';
		}
	}
	

	//**************************************	Send Email Template		********************************************//
	
	function sendmail()
	{
		// client list drop down
		$sessionid=$this->session->userdata('id');
		$data['s_id']=$this->user_model->get_sql_select_data('stylist',array('user_id'=>$sessionid));
		$s_Id= @$data['s_id'][0]['id'];
		
		$client_fields=array('tbl_user.id as user_id', 'tbl_user.firstname', 'tbl_user.lastname','tbl_user.email', 'client.user_id as uid', 'client.id as clientid',);
		$join_clients=array(
						array('table'=>'tbl_user','condition'=>'`tbl_user`.`id` = `client`.`user_id`','jointype'=>'inner'),
						);

		$data['allclientlist']=$this->user_model->get_joins('client', array('client.s_id'=>$s_Id),$join_clients,$client_fields,'','','`tbl_user`.`lastname` ASC');
		//echo"<pre>";print_r($data['allclientlist']);exit;

		// Search mail drop down

		$data['alldensity']=$this->user_model->getalldensity();
		$data['allcolor']=$this->user_model->getallcolor();
		$data['alltexture']=$this->user_model->getalltexture();
		$data['allethnicity']=$this->user_model->getallethnicity();
		$data['alltags']=$this->user_model->getalltag();
		$data['allcategory']=$this->user_model->getallcategory();
		$data['allbrands']=$this->user_model->getallbrands();

		// predefind email template
		$data['pre_email']=$this->user_model->get_sql_select_data('email_template',array('status'=>'1'));
		
		// previous sent mails

		
		$stylist_joins=array(
			array('table'=>'stylist','condition'=>'`stylist`.`id` = `sent_emails`.`s_id`','jointype'=>'inner'),
			array('table'=>'tbl_user','condition'=>'`tbl_user`.`id` = `stylist`.`user_id`','jointype'=>'inner'),
			//array('table'=>'email_template','condition'=>'`email_template`.`id` = `sent_emails`.`email_temp_id`','jointype'=>'inner'),
			);
		$mail_field=array('sent_emails.*');
		$data['sent_emails']=$this->user_model->get_joins('sent_emails', array('sent_emails.s_id'=>$s_Id), $stylist_joins, $mail_field,'','sent_emails.sent_subject','`sent_emails`.`sentdate` DESC');
		/*echo $this->db->last_query();
		echo "<pre>";print_r($data['sent_emails']);exit;*/
		
		$ethnicity_s = trim($this->input->post('ethnicity_s'));
		$gender_s = trim($this->input->post('gender_s'));
		$age_range_s = trim($this->input->post('age_range_s'));
		$hair_color_s = trim($this->input->post('hair_color_s'));
		$hair_texture_s = trim($this->input->post('hair_texture_s'));
		$hair_density_s = trim($this->input->post('hair_density_s'));
		
		$pre_email_template=trim($this->input->post('pre_email_template'));
		$email_content=trim($this->input->post('email_content'));
		
		$recipient_email_ids[]=$this->input->post('recipient_email_ids[]');
		
		$recipient_options[]=$this->input->post('recipient_options[]');
		
	//	echo $pre_email_template;exit;
		
		/* For Group Matching Load Recipients*/
		if(isset($_POST['filter_client']))
		{
			if(empty($ethnicity_s)&&empty($hair_color_s)&&empty($hair_density_s)&&empty($hair_texture_s)&&empty($age_range_s)&&empty($gender_s))
			{
				$data['message'] ='<div class="text-error">Atleast One Field is Required for Group Matching <span class="text-error-close">x</span></div>';
			}
			else
			{
				$id_session=$this->session->userdata('id');
				$stylist_Id=$this->user_model->get_joins('stylist',array('stylist.user_id'=>$id_session));
				//echo"<pre>";print_r($stylist_Id);exit;
				//$clientlist_email=array('tbl_user.id as user_id', 'tbl_user.firstname', 'tbl_user.lastname','tbl_user.email', 'client.user_id as uid', 'client.id as clientid','client.s_id',);
				$where_fc=array('ethnicity'=>$ethnicity_s, 'hair_color'=>$hair_color_s, 'hair_density'=>$hair_density_s, 'hair_texture'=>$hair_texture_s, 'age'=>$age_range_s, 'gender'=>$gender_s, );
				
				$join_fc=array(
								array('table'=>'tbl_user','condition'=>'`tbl_user`.`id` = `client`.`user_id`','jointype'=>'inner'),
							);
				//$data['filtered_c']=$this->user_model->get_joins('client',array('client.s_id'=>$stylist_Id[0]['id']),$join_fc,'',$where_fc,'','','','','','');
				$data['clientlist_email']=$this->user_model->filterclient($stylist_Id[0]['id'],$gender_s,$age_range_s,$ethnicity_s,$hair_color_s,$hair_density_s,$hair_texture_s);
			/*	
				echo $this->db->last_query();
				echo"<pre>";print_r($data['clientlist_email']);
				exit;
				*/if(empty($data['clientlist_email']))
				{
					$data['message'] ='<div class="text-error">No Matching data found<span class="text-error-close">x</span></div>';
				}
			}
			//echo $this->db->last_query();
			//echo"<pre>";print_r($data['clientlist_email']);exit;
		}
		
		if(isset($_POST['send_mail']))
		{
			//$recipient_options=$recipient_email_ids;
			$blank_mail=$this->input->post('blankmail');
			$sent_mail_id=$this->input->post('pre_sent_mails');
			
			if( (empty($blank_mail)) && (empty($pre_email_template)) && (empty($sent_mail_id)) )
			{
				$data['mandetory']='checked';
				$this->form_validation->set_rules('template_subject', 'Template Subject', 'required');
			}
			if(!empty($blank_mail))
			{
				//print_r($blank_mail);
				$this->form_validation->set_rules('template_subject', 'Template Subject', 'required');
				$template_subject=ucwords(trim($this->input->post('template_subject')));
			}
			else
			{
				
			}
			
			$this->form_validation->set_error_delimiters('<div class="text-error">', '<span class="text-error-close">x</span></div>');
			$this->form_validation->set_rules('recipient_email_ids[]', 'Recipient', 'required');
			$this->form_validation->set_rules('email_content', 'Content', 'required');
			
			if ($this->form_validation->run() == FALSE)
			{
				
				$data['message'] = validation_errors();
				$data['recipient_options']=$recipient_options;
			}
			else
			{
				$sty_field=array('tbl_user.*','stylist.id as s_id','stylist.user_id as user_id',);
				$join_sty=array(
								array('table'=>'tbl_user','condition'=>'`tbl_user`.`id` = `stylist`.`user_id`','jointype'=>'inner'),
								);

				$data['stylistdetails']=$this->user_model->get_joins('stylist', array('`tbl_user`.`id`'=>$sessionid),$join_sty,$sty_field);
				//echo"<pre>";print_r($data['stylistdetails']);exit;	
				$stylist_emaildId=$data['stylistdetails'][0]['email'];
				$stylist_id=$data['stylistdetails'][0]['s_id'];
				$stylist_name=$data['stylistdetails'][0]['firstname'].' '.$data['stylistdetails'][0]['lastname'];
				
				$email_to_ids='';
				
				$field=array('tbl_user.email');
				$join_clients=array(
							array('table'=>'tbl_user','condition'=>'`tbl_user`.`id` = `client`.`user_id`','jointype'=>'inner'),
							);
				foreach(@$recipient_email_ids[0] as $e_id)
				{				
					$where_or=array('`client`.`id`'=>$e_id);
					$email_to_ids[]=$this->user_model->get_joins('client','',$join_clients,$field,'','','','','','', $where_or);
				}

				foreach(@$email_to_ids as $emd)
				{
					$email_arr[]=implode(',',$emd[0]);
				}
				
				$emailto=implode(',',$email_arr);

				$data['templ_subject']=$this->user_model->get_sql_select_data('email_template',array('id'=>$pre_email_template));
				@$subject=$data['templ_subject'][0]['template_name'];
				
				if(empty($subject))
				{
					//echo $pre_email_template;exit;
					$data['sent_subject']=$this->user_model->get_sql_select_data('sent_emails',array('id'=>$sent_mail_id));
					@$subject=$data['sent_subject'][0]['sent_subject'];
				}
				$path = './assets/uploads/';
				$message=$email_content;
				
				if(!empty($blank_mail))
				{
					$subject=$template_subject;
				}

				$headers = "From: " . $stylist_emaildId . "\n"; //from address
				//$headers = "From: admin@server.ntftechnologies.com \n";  //from address
				
				
				//$headers .= "Reply To: .$stylist_emaildId.";
				//$headers .= "MIME-Version: 1.0\n";
				$headers .= "Content-type: text/html; charset=iso-8859-1 \n";
				
				//$this->email->attach($path . 'newsletter1.txt');
				$ifsent= mail($emailto, $subject, $message, $headers);
				if(@$ifsent)
				{
					foreach($recipient_email_ids[0] as $e_id)
					{
						$sent_date=date("Y-m-d H:i:s");
						//echo	$e_id.'_'.$stylist_id;		exit;
						$insertdata=array('c_id'=>$e_id,'s_id'=>$stylist_id,'sentdate'=>$sent_date,'email_temp_id'=>$pre_email_template,'sent_content'=>$email_content,'sent_subject'=>$subject);
						$data['isinsert']=$this->user_model->INSERTDATA('sent_emails',$insertdata);
						
						/*Client Communication*/
						$communication_data=array('s_id'=>$stylist_id, 'c_id'=>$e_id, 'title'=>$subject, 'content'=>$email_content, 'createdate'=>$sent_date, );
						$this->user_model->INSERTDATA('client_communications',$communication_data);

						//$add_template_data=array('status'=>1,'createdate'=>$sent_date,'content'=>$email_content,'subject'=>$subject,'template_name'=>$subject,'emailfrom'=>$stylist_emaildId);
						//$data['add_template']=$this->user_model->INSERTDATA('sent_emails',$insertdata);
					}

					$data['message'] ='<div class="text-success-wrapper">Communication Sent Successfully <span class="text-success-close">x</span></div>';
				}
				else
				{
					//echo $this->email->print_debugger();    

				}
			}
		}
		
		$this->load->view('Stylist/email_view',$data);
	}


	//**************************************	Get Template Content(ajax)		********************************************//
	
	function gettemplate_content()
	{
		$data='';
		$templateId=$this->uri->segment(3);
		//echo $templateId;exit;
		$data['email_template']=$this->user_model->get_joins('email_template',array('id'=>$templateId));
		//echo"<pre>";print_r($data['templatedata']);exit;
		$this->load->view('Stylist/ajaxdata',$data);
	}
	

	//**************************************	Get Template Content From Sent mails(ajax)		********************************************//
	
	function get_sent_template_content()
	{
		$data='';
		$templateId=$this->uri->segment(3);
		$data['sent_emails']=$this->user_model->get_joins('sent_emails',array('id'=>$templateId));
		$this->load->view('Stylist/ajaxdata',$data);
	} 
	
	
	//**************************************	Get All Sent mails		********************************************//
	
	function sent_mails()
	{
		$sessionid=$this->session->userdata('id');
        $sid=$this->user_model->get_joins('stylist',array('stylist.user_id'=>$sessionid));
        //echo"<pre>";print_r($sid);exit;
		$where=array('sent_emails.s_id'=>$this->session->userdata('id'));
		$fields=array('stylist.id as s_id', 'client_details.email as email', 'client_details.firstname', 'client_details.lastname', 'client_details.id as user_id', 'client.id as c_id', 'sent_emails.id as sent_id',  'sent_emails.sentdate',  'sent_emails.sent_content',  'sent_emails.sent_subject', );
		$join_s=array(
					array('table'=>'client','condition'=>'`client`.`id` = `sent_emails`.`c_id`','jointype'=>'inner'),
					array('table'=>'stylist','condition'=>'`stylist`.`id` = `sent_emails`.`s_id`','jointype'=>'inner'),
					array('table'=>'tbl_user','condition'=>'`tbl_user`.`id` = `stylist`.`user_id`','jointype'=>'inner'),
					array('table'=>'tbl_user as client_details','condition'=>'`client_details`.`id` = `client`.`user_id`','jointype'=>'inner'),
					);
		$data['email_archive']=$this->user_model->get_joins('sent_emails',array('sent_emails.s_id'=>$sid[0]['id']),$join_s,$fields,'','','`sent_emails`.`sentdate` DESC');
		if(empty($data['email_archive']))
		{
			$data['message'] ='<div class="text-error">No Data Fetched <span class="text-error-close">x</span></div>';
		}
		$this->load->view('Stylist/view_sentmails',$data);
	}
	
	//**************************************	Get Sent mails Messages	********************************************//
	
	function message()
	{
		$sessionid=$this->session->userdata('id');
		$messageid=$this->uri->segment(3);
		
		$data['sent_message']=$this->user_model->get_joins('sent_emails',array('id'=>$messageid),'','','','','`sent_emails`.`sentdate` DESC');
		/*echo $this->db->last_query();
		echo"<pre>";print_r($data['email_archive']);exit;*/
		
		$this->load->view('Stylist/view_sentmails',$data);
	}
	
	
	//**************************************	Update Booking			********************************************//
	
	function edit_booking()
	{
		$data='';
		$sessionid=$this->session->userdata('id');
		$booking_id=$this->uri->segment(3);
		$join_b=array(
					array('table'=>'client','condition'=>'`client`.`id` = `sent_emails`.`c_id`','jointype'=>'inner'),
					);
		$data['current_bookings']=$this->user_model->get_joins('booking',array('id'=>$booking_id));
		
		//echo"<pre>";print_r($data['current_bookings']);exit;
		/*Getting Stylist Id*/
		$join_s=array(
					array('table'=>'tbl_user','condition'=>'`stylist`.`user_id` = `tbl_user`.`id`','jointype'=>'inner'),
					);
		$data['stylist']=$this->user_model->get_joins('stylist',array('tbl_user.id'=>$sessionid),$join_s,array('stylist.id'));
		$stylistid=$data['stylist'][0]['id'];
		
		/*All Client list*/
		$client_fields=array('tbl_user.id as user_id', 'tbl_user.email', 'tbl_user.firstname', 'tbl_user.lastname', 'client.user_id as uid', 'client.id as clientid', 'stylist.id as sId',);
		$join_clients=array(
						array('table'=>'tbl_user','condition'=>'`tbl_user`.`id` = `client`.`user_id`','jointype'=>'inner'),
						array('table'=>'stylist','condition'=>'`client`.`s_id` = `stylist`.`id`','jointype'=>'inner'),
						);
		
		$data['allclientlist']=$this->user_model->get_joins('client', array('stylist.id'=>$stylistid),$join_clients,$client_fields,'','','`tbl_user`.`firstname` ASC');
		//echo"<pre>";print_r($data['allclientlist']);exit;
		
		/*All Bookings of stylist*/
		$join_s=array(
					array('table'=>'stylist','condition'=>'`stylist`.`id` = `booking`.`s_id`','jointype'=>'inner'),
					array('table'=>'tbl_user','condition'=>'`stylist`.`user_id` = `tbl_user`.`id`','jointype'=>'inner'),
					array('table'=>'client','condition'=>'`client`.`id` = `booking`.`c_id`','jointype'=>'inner'),
					array('table'=>'tbl_user as client_details','condition'=>'`client_details`.`id` = `client`.`user_id`','jointype'=>'inner'),
					);
		
		$data['allbookingdata']=$this->user_model->get_joins('booking',array('tbl_user.id'=>$sessionid),$join_s,array('client.id','client.user_id','client_details.firstname','client_details.lastname','client_details.email','booking.id','booking.s_id','booking.c_id','booking.service_offer','booking.booking_time','booking.day_start_time','booking.day_end_time','booking.booking_day','booking.createdate','booking.booking_start_date','booking.booking_end_date'));
		
		if(isset($_POST['book']))
		{
			$c_id=$this->input->post('clieint_list');
			$booking_id=$this->input->post('bookingId');
			
			$service=$this->input->post('service[]');
			$app_length=$this->input->post('app_length[]');
			
			$booking_start_date=$this->input->post('booking_start_date');
			$booking_end_date=$this->input->post('booking_end_date');
			
			$booking_start_time=$this->input->post('booking_start_time');
			//$booking_end_time=$this->input->post('booking_end_time');
			
			$extra='';
			foreach($app_length as $length)
			{
				@$str_size=strlen($length);
				@$splitedvalue=str_split($length,$str_size-1);
				@$extra[]=$splitedvalue[0];
			}
			//echo"<pre>";print_r($extra);
			
			$extra_time=array_sum($extra);
			//echo $extra_time;
			
			$timestamp = strtotime($booking_start_time) + $extra_time*60;
			$time = date('g:ia', $timestamp);
			$booking_end_time=$time;
		
		
			$this->form_validation->set_error_delimiters('<div class="text-error">', '<span class="text-error-close">x</span></div>');
			$this->form_validation->set_rules('clieint_list', 'Client Name', 'trim|required');
			$this->form_validation->set_rules('service[]', 'Service', 'trim|required');
			
			$this->form_validation->set_rules('booking_start_date', 'Booking Date', 'trim|required');
			$this->form_validation->set_rules('booking_start_time', 'Booking Time', 'trim|required');
			$a2=array("0"=>"45a","1"=>"60a","2"=>"90a","3"=>"120a","4"=>"150a","5"=>"180a","6"=>"240a","7"=>"45b","8"=>"60b","9"=>"90b","10"=>"120b","11"=>"150b","12"=>"180b","13"=>"240b","14"=>"45c","15"=>"60c","16"=>"90c","17"=>"120c","18"=>"150c","19"=>"180c","20"=>"240c","21"=>"45d","22"=>"60d","23"=>"90d","24"=>"120d","25"=>"150d","26"=>"180d","27"=>"240d","28"=>"45e","29"=>"60e","30"=>"90e","31"=>"120e","32"=>"150e","33"=>"180e","34"=>"240e","35"=>"45f","36"=>"60f","37"=>"90f","38"=>"120f","39"=>"150f","40"=>"180f","41"=>"240f",);
			if(array_intersect($app_length,$a2))
			{
			}
			else
			{
				$this->form_validation->set_rules('app_length[]', 'Duration', 'trim|required');
			}
			if ($this->form_validation->run() == FALSE)
			{
				$data['message'] = validation_errors();
			}
			else
			{
				$extra_time=array_sum($app_length);
				
				//echo $new_endtime;
				$timestamp = strtotime($booking_start_time) + $extra_time*60;
				$time = date('g:ia', $timestamp);
				$booking_end_time=$time;

				$start_date=strtotime($booking_start_date);
				$start_time=strtotime($booking_start_time);

				$booked_day=date("l",$start_date);
				
				$startdate=date("d",$start_date);
				$startmonth=date("m",$start_date);
				$startyear=date("Y",$start_date);
				$starthour=date("h",$start_time);
				$startmin=date("i",$start_time);
				
				$date_today=date("Y-m-d H:i:s");
				
				$booking_start_date_time=$startyear.'-'.$startmonth.'-'.$startdate.' '.$starthour.':'.$startmin.':00';
				
				$end_date=strtotime($booking_end_date);
				$end_time=strtotime($booking_end_time);

				$enddate=date("d",$end_date);
				$endmonth=date("m",$end_date);
				$endyear=date("Y",$end_date);
				$endhour=date("h",$end_time);
				$endmin=date("i",$end_time);
				
				$booking_end_date_time=$endyear.'-'.$endmonth.'-'.$enddate.' '.$endhour.':'.$endmin.':00';
				
				$service_offer=implode(',',$service);
				$booking_time=implode(',',$app_length);
				
				//echo $booking_time;exit;
				$data['check_exists']=$this->user_model->get_joins('booking',array('c_id'=>$c_id,'booking_time'=>$booking_time, 'day_start_time'=>$booking_start_time, 'day_end_time'=>$booking_end_time, 'booking_start_date'=>$booking_start_date_time, 'booking_end_date'=>$booking_end_date_time, 'service_offer'=>$service_offer,));
				if(!empty($data['check_exists']))
				{
					$data['message'] ='<div class="text-error">On '.$this->input->post('booking_start_date').' Client already has booking on Time Slot '.$booking_start_time.' <span class="text-error-close">x</span></div>';
				}
				else
				{
					//echo $stylistid;exit;
					$udatedata=array('s_id'=>$stylistid, 'c_id'=>$c_id, 'booking_day'=>$booked_day, 'booking_time'=>$booking_time, 'day_start_time'=>$booking_start_time, 'day_end_time'=>$booking_end_time, 'booking_start_date'=>$booking_start_date_time, 'booking_end_date'=>$booking_end_date_time, 'createdate'=>$date_today);
					$data['isupdate']=$this->user_model->UPDATEDATA('booking', array('id'=>$booking_id),$udatedata);
					//echo $this->db->last_query();
					if($data['isupdate'])
					{
						$this->session->set_flashdata('Logmsg', '<b style="color:green;">Booking Updated Successfully</b>');
						//$data['message'] ='<div class="text-success-wrapper">Booking Updated Successfully <span class="text-success-close">x</span></div>';
						redirect(site_url().'stylist/edit_booking/'.$booking_id.'/#calendar');
					}
				}
			}
		}
		
		/*	Add Another booking	*/
		
		if(isset($_POST['add_another']))
		{
			$c_id=$this->input->post('clieint_list');
			$booking_id=$this->input->post('bookingId');
			
			$service=$this->input->post('service[]');
			$app_length=$this->input->post('app_length[]');
			
			$booking_start_date=$this->input->post('booking_start_date');
			$booking_end_date=$this->input->post('booking_end_date');
			
			$booking_start_time=$this->input->post('booking_start_time');
			//$booking_end_time=$this->input->post('booking_end_time');
			
			$extra='';
			foreach($app_length as $length)
			{
				@$str_size=strlen($length);
				@$splitedvalue=str_split($length,$str_size-1);
				@$extra[]=$splitedvalue[0];
			}
			//echo"<pre>";print_r($extra);
			
			$extra_time=array_sum($extra);
			//echo $extra_time;
			
			$timestamp = strtotime($booking_start_time) + $extra_time*60;
			$time = date('g:ia', $timestamp);
			$booking_end_time=$time;
		
		
			$this->form_validation->set_error_delimiters('<div class="text-error">', '<span class="text-error-close">x</span></div>');
			$this->form_validation->set_rules('clieint_list', 'Client Name', 'trim|required');
			$this->form_validation->set_rules('service[]', 'Service', 'trim|required');
			
			$this->form_validation->set_rules('booking_start_date', 'Booking Date', 'trim|required');
			$this->form_validation->set_rules('booking_start_time', 'Booking Time', 'trim|required');
			$a2=array("0"=>"45a","1"=>"60a","2"=>"90a","3"=>"120a","4"=>"150a","5"=>"180a","6"=>"240a","7"=>"45b","8"=>"60b","9"=>"90b","10"=>"120b","11"=>"150b","12"=>"180b","13"=>"240b","14"=>"45c","15"=>"60c","16"=>"90c","17"=>"120c","18"=>"150c","19"=>"180c","20"=>"240c","21"=>"45d","22"=>"60d","23"=>"90d","24"=>"120d","25"=>"150d","26"=>"180d","27"=>"240d","28"=>"45e","29"=>"60e","30"=>"90e","31"=>"120e","32"=>"150e","33"=>"180e","34"=>"240e","35"=>"45f","36"=>"60f","37"=>"90f","38"=>"120f","39"=>"150f","40"=>"180f","41"=>"240f",);
			if(array_intersect($app_length,$a2))
			{
			}
			else
			{
				$this->form_validation->set_rules('app_length[]', 'Duration', 'trim|required');
			}
			if ($this->form_validation->run() == FALSE)
			{
				$data['message'] = validation_errors();
			}
			else
			{
				$extra_time=array_sum($app_length);
				
				//echo $new_endtime;
				$timestamp = strtotime($booking_start_time) + $extra_time*60;
				$time = date('g:ia', $timestamp);
				$booking_end_time=$time;

				$start_date=strtotime($booking_start_date);
				$start_time=strtotime($booking_start_time);

				$booked_day=date("l",$start_date);
				
				$startdate=date("d",$start_date);
				$startmonth=date("m",$start_date);
				$startyear=date("Y",$start_date);
				$starthour=date("h",$start_time);
				$startmin=date("i",$start_time);
				
				$date_today=date("Y-m-d H:i:s");
				
				$booking_start_date_time=$startyear.'-'.$startmonth.'-'.$startdate.' '.$starthour.':'.$startmin.':00';
				
				$end_date=strtotime($booking_end_date);
				$end_time=strtotime($booking_end_time);

				$enddate=date("d",$end_date);
				$endmonth=date("m",$end_date);
				$endyear=date("Y",$end_date);
				$endhour=date("h",$end_time);
				$endmin=date("i",$end_time);
				
				$booking_end_date_time=$endyear.'-'.$endmonth.'-'.$enddate.' '.$endhour.':'.$endmin.':00';
				
				$service_offer=implode(',',$service);
				$booking_time=implode(',',$app_length);
				
				//echo $booking_time;exit;
				$data['check_exists']=$this->user_model->get_joins('booking',array('c_id'=>$c_id,'booking_time'=>$booking_time, 'day_start_time'=>$booking_start_time, 'day_end_time'=>$booking_end_time, 'booking_start_date'=>$booking_start_date_time, 'booking_end_date'=>$booking_end_date_time, 'service_offer'=>$service_offer,));
		/*		if(!empty($data['check_exists']))
				{
					$data['message'] ='<div class="text-error">On '.$this->input->post('booking_start_date').' Client already has booking on Time Slot '.$booking_start_time.' <span class="text-error-close">x</span></div>';
				}
				else
				{
		*/			//echo $stylistid;exit;
					$insertdata=array('s_id'=>$stylistid, 'c_id'=>$c_id, 'booking_day'=>$booked_day, 'booking_time'=>$booking_time, 'day_start_time'=>$booking_start_time, 'day_end_time'=>$booking_end_time, 'booking_start_date'=>$booking_start_date_time, 'booking_end_date'=>$booking_end_date_time, 'service_offer'=>$service_offer, 'createdate'=>$date_today);
					$data['isupdate']=$this->user_model->INSERTDATA('booking', $insertdata);
					//echo $this->db->last_query();
					if($data['isupdate'])
					{
						$this->session->set_flashdata('Logmsg', '<b style="color:green;">Booking Added Successfully</b>');
						//$data['message'] ='<div class="text-success-wrapper">Booking Updated Successfully <span class="text-success-close">x</span></div>';
						redirect(site_url().'stylist/edit_booking/'.$booking_id.'/#calendar');
					}
			//	}
			}
		}
		
		
		$this->load->view('Stylist/update_booking',$data);
	}
	
	
	/***************************************	Email Photo Sets		**************************************/
	
	function email_photos()
	{
		$data='';
		$photoid=$this->uri->segment(3);
		$user_id=$this->uri->segment(4);
		
		$stylist_userid=$this->session->userdata('id');
		
		$base_url=base_url().'';
		
		/*Getting imasges according to img-id*/
		$data['clientphotos']=$this->user_model->get_joins('client_photos',array('id'=>$photoid));
		$photos=explode(',', $data['clientphotos'][0]['photos']);
		
		$images='';
		$message='';
		$headers='';
		
		$dirname=getcwd();
		
		/*Getting client email id*/
		$join_c=array(
				array('table'=>'client','condition'=>'`client`.`user_id` = `tbl_user`.`id`','jointype'=>'inner'),
				);
		$data['clientinfo']=$this->user_model->get_joins('tbl_user',array('tbl_user.id'=>$user_id),$join_c);
		$client_emailid=$data['clientinfo'][0]['email'];
		$client_fullname=$data['clientinfo'][0]['firstname'].' '.$data['clientinfo'][0]['lastname'];
		$c_id=$data['clientinfo'][0]['id'];
		/*Getting stylist email id*/
		
		$join_s=array(
				array('table'=>'stylist','condition'=>'`stylist`.`user_id` = `tbl_user`.`id`','jointype'=>'inner'),
				);
		$data['stylistinfo']=$this->user_model->get_joins('tbl_user',array('tbl_user.id'=>$stylist_userid),$join_s);
		$stylist_emailid=$data['stylistinfo'][0]['email'];
		$stylist_fullname=$data['stylistinfo'][0]['firstname'].' '.$data['stylistinfo'][0]['lastname'];
		$s_id=$data['stylistinfo'][0]['id'];
	
		$files='';
		foreach($photos as $photo)	
		{
			$image=str_replace(' ','_',$photo);
			$image_name=basename($image);
			$files[]=$image_name;
		}
		
		
		$html_content="<h3>Hi ".$client_fullname.",</h3><br>";
		$html_content.="Here are the images of you. ";
		$html_content.="<br><br><br>--<br>Thanks<br>Team Inhairent";
		
		$subject="Image Set of You";

	
		/*	Client Communications start	*/
		$currentdate=date("Y-m-d H:i:s");
		$communication_msg=$html_content;
		foreach($files as $comm_img)
		{
			$path=base_url().'assets/uploads/'.$comm_img;
			$communication_msg.="<br><br><img src='$path' height='400px' width='400px' />";
		}
		
		$communication_data=array('s_id'=>$s_id, 'c_id'=>$c_id, 'title'=>$subject, 'content'=>$communication_msg, 'createdate'=>$currentdate, );
		$this->user_model->INSERTDATA('client_communications',$communication_data);
		
		/*	Client Communications end	*/
		
		$this->multi_attach_mail($client_emailid,$subject,$html_content,$stylist_emailid,$stylist_fullname,$files, $user_id);


		
	}
	
	/*Sending Multiple images in email attachment*/
	
	function multi_attach_mail($to, $subject, $message, $senderMail, $senderName, $files, $c_id)
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
					$fp =    @fopen($dirname.'/assets/uploads/'.$files[$i],"rb");
					$data =  @fread($fp,filesize($dirname.'/assets/uploads/'.$files[$i]));
					@fclose($fp);
					print_r($fp);
					$data = chunk_split(base64_encode($data));
					$message .= "Content-Type: image/jpg; name=\"".$files[$i]."\"\n" . 
					"Content-Description: ".$files[$i]."\n" .
					"Content-Disposition: attachment;\n" . " filename=\"".$files[$i]."\"; size=".filesize($dirname.'/assets/uploads/'.$files[$i]).";\n" . 
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
			$this->session->set_flashdata('section','photos');
			$this->session->set_flashdata('email_pic_msg', '<b style="color:green;">Image Set Mailed Successfully to '.$to.' </b>');
			//$data['message'] ='<div class="text-success-wrapper">Booking Updated Successfully <span class="text-success-close">x</span></div>';
			redirect(site_url().'stylist/manageclient/'.$c_id.'#photos');
		}
		else
		{
			$this->session->set_flashdata('section','photos');
			$this->session->set_flashdata('email_pic_msg', '<b style="color:red;">Image Set Mail Failed to '.$to.' </b>');
			//$data['message'] ='<div class="text-success-wrapper">Booking Updated Successfully <span class="text-success-close">x</span></div>';
			redirect(site_url().'stylist/manageclient/'.$c_id.'#photos');
		}
	}
	
	/********************************* 		Change Subscription Plan 	**************************************/
	
	function planchange()
	{
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
								/*$shortlist = $this->session->userdata('shortlist');
								unset($shortlist[0]);
								$this->session->set_userdata('shortlist',$shortlist);
								$this->session->set_userdata('uid', 'New user');
								*/
							//echo $this->db->last_query();exit;
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
							
							$subs_data=array('subs_type'=>$subs_type, 'plan'=>$packages, 'package'=>$pack_name, 'confirm_planchange'=>$confirm_planchange, 'stripe_cust_id'=>$new_stripe_cust_id, 'stripe_plan_id'=>$new_stripe_plan_id, 'recuring_sub_id'=>$new_recuring_sub_id, 'update_date'=>$update_date,);
							$update_subs=$this->user_model->UPDATEDATA('subscription',array('id'=>$newid), $subs_data);
							//echo $this->db->last_query();exit;
							if($update_subs)
							{
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
		
		$this->load->view('Stylist/planchange_view',$data);
	}
	
	/********************************* 		Autocomplete				**************************************/
	
	function autocomplete()
	{
		$keyword=$_GET['term'];
		//echo $keyword;exit;
		$field=array('firstname','lastname','email','id');
		$where_or=array('firstname'=>$keyword,'lastname'=>$keyword,'email'=>$keyword);
		$data['complete']=$this->user_model->get_joins('tbl_user','','',$field,$where_or,'','','','','','');
		echo json_encode($data);
	}

	
	/********************************* 		Ajax Load more img set		****************************/
	
	function loadmore_photos()
	{
		$data='';
		$photoid=$this->uri->segment(3);
		$c_id=$this->uri->segment(4);
		$user_id=$this->session->userdata('id');
		
		$data['stylist']=$this->user_model->get_joins('stylist', array('user_id'=>$user_id));
		
		$data['clientinfo']=$this->user_model->get_joins('client', array('client.id'=>$c_id),'','client.user_id');

		$s_id=$data['stylist'][0]['id'];
		$data['loadmore']=$this->user_model->loadmore_photos('client_photos',$photoid,$s_id,$c_id);

		$this->load->view('Stylist/ajaxdata',$data);
	}
	
	/********************************* Ajax get three images & its tags on slider ****************************/
	
	function getimg_tags()
	{
		$imgid=$this->uri->segment(3);
		$data['images_tags']=$this->user_model->get_joins('client_photos',array('id'=>$imgid));
		if(!empty($data['images_tags']))
		{
			//echo "<pre>";print_r($data['images_tags']);exit;
			$allimgs=explode(',',$data['images_tags'][0]['tagid']);
			$tags=array();
			foreach($allimgs as $img_tags)
			{
				$tags[]=$this->user_model->get_joins('tags',array('id'=>$img_tags));
			}
			$data['tags']=$tags;
			$this->load->view('Stylist/ajaxdata',$data);
		}
		else
		{
			$data['message']="No Data Found";
		}
	}
	
	
	/************************		Test mail	************************/
	function testmail()
      {
		$configs = array(
				'protocol'  =>  'smtp',
				'smtp_host' =>  'ssl://smtp.gmail.com',
				'smtp_user' =>  'bharat.prajapat@newtechfusion.com',
				'smtp_pass' =>  'ntf12345',
				'smtp_port' =>  '465'
			);
        $this->load->library("email", $configs);
        $this->email->set_newline("\r\n");
        $this->email->from('bharat.prajapat@newtechfusion.com', 'Bharat Prajapat');
		$this->email->to('bharat.prajapat@newtechfusion.com');		
        $this->email->subject("Mail Sent From Localhost");
        
        $path = './assets/uploads/';
		$message="Body of the Message";
        $message.=$path;
        
		$this->email->message($message);
		$this->email->attach($path . 'newsletter1.txt');
        
        if($this->email->send())
        {
            echo "Done!";   
        }
        else
        {
            echo $this->email->print_debugger();    
        }
      }
      
      /********************************* Ajax get three images & Edit ****************************/
	
	function edit_photo_set()
	{
		$imgid=$this->uri->segment(3);
		$data['edit_img_set']=$this->user_model->get_joins('client_photos',array('id'=>$imgid));
		$data['alltags']=$this->user_model->getalltag();
		//echo"<pre>";print_r($data['edit_img_set']);exit;
		if(!empty($data['edit_img_set']))
		{
			//echo "<pre>";print_r($data['images_tags']);exit;
			if(!empty($data['edit_img_set'][0]['tagid']))
			{
				$allimgs=explode(',',$data['edit_img_set'][0]['tagid']);
				$tags=array();
				foreach($allimgs as $img_tags)
				{
					$tags[]=$this->user_model->get_joins('tags',array('id'=>$img_tags));
				}
				$data['photo_tags']=$tags;
			}
			//echo "<pre>";print_r($data);exit;
			$this->load->view('Stylist/ajaxdata',$data);
		}
		else
		{
			$data['message']="No Data Found";
		}
	}
      
      /********************************* Ajax Delete three images Set ****************************/
	
	function delete_photo_set()
	{
		$del_id=$this->uri->segment(3);
		$uid=$this->uri->segment(4);
		
		$where=array('id'=>$del_id);
		$getuserimgs=$this->user_model->get_joins('client_photos', $where,'','photos');

		$images=explode(',',$getuserimgs[0]['photos']);
		$base_path=getcwd().'/assets/uploads/';
		
		/*
		foreach($images as $image)
		{
			unlink($base_path.$image);
			unlink($base_path.'thumbnails/113x113/'.$image);
			unlink($base_path.'thumbnails/130x130/'.$image);
			unlink($base_path.'thumbnails/150x150/'.$image);
			unlink($base_path.'thumbnails/244x244/'.$image);
			unlink($base_path.'thumbnails/600x600/'.$image);
			//unlink($base_path.'thumbnails//'.$image);
		}
		*/
				
		$delete_set = $this->user_model->DELETEDATA('client_photos', $where);
		if($delete_set)
		{
			$this->session->set_flashdata('email_pic_msg', '<b style="color:green;">Image Set Deleted Successfully </b>');
			redirect(site_url().'stylist/manageclient/'.$uid.'#photos');
			//redirect(base_url().'news-and-events');
		}
		else
		{
			$this->session->set_flashdata('del_msg', '<b style="color:Red;">Image Set Not Deleted </b>');
			redirect(site_url().'stylist/manageclient/'.$uid.'#photos');
		}
	}

      /********************************* View Client Communications send ****************************/
      
	function communications()
	{
		$sessionid=$this->session->userdata('id');
	
		$fields=array('stylist.id as s_id', 'client_details.email as email', 'client_details.firstname', 'client_details.lastname', 'client_details.id as user_id', 'client.id as c_id', 'client_communications.id as communication_id',  'client_communications.createdate',  'client_communications.content',  'client_communications.title', );
		$join=array(
					array('table'=>'client','condition'=>'`client`.`id` = `client_communications`.`c_id`','jointype'=>'inner'),
					array('table'=>'stylist','condition'=>'`stylist`.`id` = `client_communications`.`s_id`','jointype'=>'inner'),
					array('table'=>'tbl_user','condition'=>'`tbl_user`.`id` = `stylist`.`user_id`','jointype'=>'inner'),
					array('table'=>'tbl_user as client_details','condition'=>'`client_details`.`id` = `client`.`user_id`','jointype'=>'inner'),
					);
					
		$data['communications']=$this->user_model->get_joins('client_communications',array('tbl_user.id'=>$sessionid),$join,$fields,'','','`client_communications`.`createdate` DESC');
		
		$this->load->view('Stylist/view_communications',$data);
	}

      /********************************* View Client Communication Content send ****************************/
      
	function communication()
	{
		$sessionid=$this->session->userdata('id');
		$messageid=$this->uri->segment(3);
		
		$data['sent_message']=$this->user_model->get_joins('client_communications',array('id'=>$messageid),'','','','','`client_communications`.`createdate` DESC');

		$this->load->view('Stylist/view_communications',$data);
	}
	
      /********************************* Create image Thumbnails ****************************/
      	
	function _createThumbnails($filename)
	{
		/*	Creating Thumb of 600x600	*/
		$foldername='./assets/uploads/thumbnails/600x600/';
		// echo $foldername;exit;
		$this->createDir($foldername);
		
		$this->load->library('image_lib');
		// Set your config up
		$config['new_image']   =   $foldername;
		$config['image_library']    = "gd2";      
		$config['source_image']     = './assets/uploads/'.$filename;      
		//$config['create_thumb']     = TRUE;      
		$config['overwrite']   = 0;
		$config['maintain_ratio']   = TRUE;
		$config['master_dim'] = 'height';      
		$config['width'] = '600';
		$config['height'] = '600';

		$this->image_lib->initialize($config);
		// Do your manipulation

		if(!$this->image_lib->resize())
		{
		echo $this->image_lib->display_errors();
		} 
		$this->image_lib->clear();     

		/*	Creating Thumb of 244x244	*/
		$foldername='./assets/uploads/thumbnails/244x244/';
		// echo $foldername;exit;
		$this->createDir($foldername);
		
		$this->load->library('image_lib');
		// Set your config up
		$config['new_image']   =   $foldername;
		$config['image_library']    = "gd2";      
		$config['source_image']     = './assets/uploads/'.$filename;      
		//$config['create_thumb']     = TRUE;
		$config['overwrite']   = 0;
		$config['maintain_ratio']   = TRUE;
		$config['master_dim'] = 'height';      
		$config['width'] = '244';
		$config['height'] = '244';

		$this->image_lib->initialize($config);
		// Do your manipulation

		if(!$this->image_lib->resize())
		{
		echo $this->image_lib->display_errors();
		} 
		$this->image_lib->clear();     

		/*	Creating Thumb of 113x113	*/
		$foldername='./assets/uploads/thumbnails/113x113/';
		// echo $foldername;exit;
		$this->createDir($foldername);
		
		$this->load->library('image_lib');
		// Set your config up
		$config['new_image']   =   $foldername;
		$config['image_library']    = "gd2";      
		$config['source_image']     = './assets/uploads/'.$filename;      
		//$config['create_thumb']     = TRUE;      
		$config['overwrite']   = 0;
		$config['maintain_ratio']   = TRUE;
		$config['master_dim'] = 'height';      
		$config['width'] = '113';
		$config['height'] = '113';

		$this->image_lib->initialize($config);
		// Do your manipulation

		if(!$this->image_lib->resize())
		{
		echo $this->image_lib->display_errors();
		} 
		$this->image_lib->clear();     

		/*	Creating Thumb of 130x130	*/
		$foldername='./assets/uploads/thumbnails/130x130/';
		// echo $foldername;exit;
		$this->createDir($foldername);
		
		$this->load->library('image_lib');
		// Set your config up
		$config['new_image']   =   $foldername;
		$config['image_library']    = "gd2";      
		$config['source_image']     = './assets/uploads/'.$filename;      
		//$config['create_thumb']     = TRUE;      
		$config['overwrite']   = 0;
		$config['maintain_ratio']   = TRUE;
		$config['master_dim'] = 'height';      
		$config['width'] = '130';
		$config['height'] = '130';

		$this->image_lib->initialize($config);
		// Do your manipulation

		if(!$this->image_lib->resize())
		{
		echo $this->image_lib->display_errors();
		} 
		$this->image_lib->clear();


		/*	Creating Thumb of 150x150 for viewclient page	*/
		$foldername='./assets/uploads/thumbnails/150x150/';
		// echo $foldername;exit;
		$this->createDir($foldername);
		
		$this->load->library('image_lib');
		// Set your config up
		$config['new_image']   =   $foldername;
		$config['image_library']    = "gd2";      
		$config['source_image']     = './assets/uploads/'.$filename;      
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
		unlink('./assets/uploads/'.$filename);

	}
	
	function createDir($foldername)
	{
		if (!is_dir($foldername))
		{
			mkdir($foldername, 0777, true);
		}
	}
	
	function getuseridbyemail()
	{
		$email=urldecode($this->uri->segment(3));
		$clientdata=$this->user_model->get_joins('tbl_user',array('email'=>$email));
		//print_r($clientdata);exit;
		echo $clientdata[0]['id'];//exit;
	}
	//==================see all resources list===================//
	function resources()
	{
		$where=array('status'=>'1');
		$data['resources']=$this->user_model->get_joins('resource', $where,'','','','','id DESC');
		$this->load->view('Stylist/view_resources',$data);
		
	}
	//=====================================================//
	//===================view resource=====================// 
	function resourcesdisplay()
	{
		$sessionid=$this->session->userdata('id');
		$messageid=$this->uri->segment(3);
		
		$data['resources']=$this->user_model->get_joins('resource',array('id'=>$messageid));

		$this->load->view('Stylist/view_resourcesdisplay',$data);
	}
	//===================view resource=====================// 
	
}
