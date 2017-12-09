<?php if (!defined('BASEPATH')) die();
class Register extends Admin_Controller  {
	 
public function __construct(){
		 
		parent::__construct();
		if($this->session->userdata('group')!='1'){
			redirect(site_url().'admin/login');		
		}
		$this->load->library('session');
		$this->load->model('query_model');
	}

/****its Use to create a new owner user by a add user from*****/
public function index(){
      
     $this->form_validation->set_rules('first_name', 'First Name', 'required');
	 //$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|alpha_numeric');
	 $this->form_validation->set_rules('gender', 'Gender', 'required|xss_clean');
	 $this->form_validation->set_rules('typeOfRep', 'Type of representation', 'required|xss_clean');
	 $this->form_validation->set_rules('userimg', 'User File', 'trim|required');
	 
	 $this->form_validation->set_rules('order_type', 'Sort images', 'trim|required');
	 
	 
	
 		if ($this->form_validation->run() == FALSE){

			$this->layout->view('admin/register1');
			
		}else{
			$username  = $this->input->post('first_name');
			$lastname  = $this->input->post('last_name');
			//$userphone = $this->input->post('user_phone');
			$gender    = $this->input->post('gender');
			$typeOfRep  = $this->input->post('typeOfRep');
			$userimg  = $this->input->post('userimg');
			
			$order_type  = $this->input->post('order_type');
					
			//////////////////////////		
	    	/* $config['upload_path'] = './uploads/';
            $config['allowed_types'] = '*';
            $this->load->library('upload');
            $this->upload->initialize($config);
            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
               $this->layout->view('admin/register1', $error);
            } else {
                $uploads = array($this->upload->data());
                foreach ($uploads as $key => $value) {
                    $randomcode = random_string('alnum', 16);
                    $newimagename = $randomcode . $value['file_ext'];
                    rename($value['full_path'], $uploads[0]['file_path'] . $newimagename);
                }	
			    $userfile = $newimagename;
          */
					
			///////////////////////////						
			$data = array('first_name' =>$username,'last_name' =>$lastname,'gender' =>$gender,'typeOfRep'=>$typeOfRep,'userfile' =>$userimg,'order_type' =>$order_type);
					 $this->load->model('query_model');
					 //$last_id=$this->query_model->insertdata('user',$data);
					$this->query_model->insertdata('user_profile',$data);			
			
			$success=array('success'=>'Successfully User  Insert');
			$this->session->set_flashdata('work_msg', 'Successfully User  Insert.');
			redirect(site_url()."admin/register/");
			//$this->layout->view('admin/register1',$success);
			}
	}
	
public function upload_photo_vedio(){
	
		if($this->input->is_ajax_request()){
		
		$video_extension_array=array('swf','wmv','mp4','ogg');
		$config['upload_path'] ='./uploads/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$this->upload->initialize($config);
		$files_header = $_FILES;
		$cpt_header = count($_FILES['myfile']['name']);
		
		for($i=0; $i<$cpt_header; $i++){
		
		$_FILES['myfile']['name']= $files_header['myfile']['name'][$i];
		$_FILES['myfile']['type']= $files_header['myfile']['type'][$i];
		$_FILES['myfile']['tmp_name']= $files_header['myfile']['tmp_name'][$i];
		$_FILES['myfile']['error']= $files_header['myfile']['error'][$i];
		$_FILES['myfile']['size']= $files_header['myfile']['size'][$i];  
		$dirpath='./uploads/';  	
		$this->upload->initialize($this->set_upload_options_header($dirpath));
			if($this->upload->do_upload('myfile')){ 
			$data = $this->upload->data('myfile');
			$name=rand().time();
			rename($data['file_path'].$data['file_name'], $data['file_path'].$name.$data['file_ext']);
			echo $name.$data['file_ext'];
			}
		}
	 }	
	}
     
    public function user_update(){
		 $this->form_validation->set_rules('name', 'Nname', 'trim|required');
		 $this->form_validation->set_rules('user_name', 'User Name', 'trim|required');
		 $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		 $where  = array('user_id'=>1);	
		 $feilds = array('user_name','email','real_name');	
		 $user['user'] = $this->query_model->get_sql_select_data('user',$where,$feilds);	
		
		 $this->session->set_userdata('admin_mail', $user['user'][0]->email);
		 if ($this->form_validation->run() == FALSE){
			$this->layout->view('admin/user_update',$user);			
		 }else{
			$name  = $this->input->post('name');
			$username  = $this->input->post('user_name');
			$email = $this->input->post('email');
			$where  = array('user_id'=>1);						
			$data = array('real_name' =>$name,'user_name' =>$username,'email' =>$email);			
			$this->query_model->UPDATEDATA('user',$where,$data);
							
			$this->session->set_flashdata('work_msg', 'Successfully User  Updated.');
			redirect(site_url()."admin/register/user_update/");
		}
	} 
private function set_upload_options_header($dp){   
	$config = array();
	$path= $config['upload_path'] =$dp;
	$config['allowed_types'] = 'gif|jpg|png|jpeg|video/mp4';
	$config['overwrite']     = FALSE;
	return $config;
}
		
	function tobytes(){
		return $sizeinbytes=1024*1024*MAX_FILE_SIZE;
	}
	  	
}
