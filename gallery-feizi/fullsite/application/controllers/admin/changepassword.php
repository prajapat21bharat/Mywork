<?php if (!defined('BASEPATH')) die();
class Changepassword extends Admin_Controller {
	
	
	public $data 	= 	array();
	function __construct() {
      parent::__construct();
  
	  $this->load->model('query_model');
	  $this->load->library('pagination');
	  $this->load->library('table');
	   if($this->session->userdata('group')!='1')$this->redirect();
	}

 public function index(){
	
		 if ($this->form_validation->run('change_pass') == FALSE){
				$this->layout->view('admin/admin_passchange');
		 }else{
				$user_name=$this->input->post('user_name');
				
				$user=array('user_name'=>$this->session->userdata('admin_user_name'));
				$old= md5($this->input->post('old_password'));
				$new= md5($this->input->post('new_password'));
				$data=$this->query_model->get_sql_select_data('user',$user);
				$data_res= $data[0]->password;
				$data_name=$data[0]->user_name;
				
				if($data_res!=$old || $data_name!=$user_name){ 
					$data['success']='Old password is invalid';
					$this->layout->view('admin/admin_passchange',$data);
				}else{
					$feild = array('password' =>$new);
					$where=array('password'=>$old,'user_name'=>$user_name);
					$this->query_model->UPDATEDATA('user',$where,$feild);
					$data['success']='Password Successfully updated';
					$this->layout->view('admin/admin_passchange',$data);
				}
		    }
  }

}