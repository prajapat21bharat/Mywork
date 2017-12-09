<?php if (!defined('BASEPATH')) die();
class Changepassword extends MY_Controller {

	function __construct() {
      parent::__construct();
       $this->load->model('query_model');
	  }
	
public function index(){
	
	 if($this->session->userdata('user_name')=='') redirect(site_url()."home");
		
		if ($this->form_validation->run('change_pass') == FALSE){
			$this->load->view('user_passchange');
		}else{
         
	   $user_name=$this->input->post('user_name');
	   $user=array('user_name'=>$this->session->userdata('user_name'));
	   $old= md5($this->input->post('old_password'));
	   $new= md5($this->input->post('new_password'));
	   $data=$this->query_model->get_sql_select_data('user',$user);
	   $data_res= $data[0]->password;
	   $data_name=$data[0]->user_name;
	  
	  if($data_res!=$old || $data_name!=$user_name)
	  { 
		  $data['invaild']='Old password is invalid';
		  $this->load->view('user_passchange',$data);
		  
		  }
	   else{
		$feild = array('password' =>$new);
			 $where=array('password'=>$old,'user_name'=>$user_name);
			$this->query_model->UPDATEDATA('user',$where,$feild);
			$data['success']='Password Successfully updated';
			$this->load->view('user_passchange',$data);
	   }
		}
		}
	}