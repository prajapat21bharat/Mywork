<?php if (!defined('BASEPATH')) die();
class Category extends Admin_Controller  {
	
	public $data 	= 	array();
	public function __construct(){		 
		parent::__construct();
		if($this->session->userdata('group')!='1'){
			redirect(site_url().'admin/login');		
		}
		$this->load->model('query_model');
		$this->data['category'] = $this->query_model->get_sql_select_data_ajax('category');
    }
    public function index(){
		$this->layout->view('admin/category_view',$this->data);	
	}
	public function validation_chack(){
		
		$this->form_validation->set_rules('cat', 'Category Name', 'trim|required');
		if ($this->form_validation->run() == FALSE){
			return false;		
		}else{
			return true;		
		}
	}
	
	public function form_data(){
		if($this->input->post()){
			$cat = $this->input->post('cat');					
			$ins = array('cat_name' =>$cat);	
			return $ins;
		}
	}
	
	public function add(){					
		if ($this->validation_chack() != 'treu'){
			$this->layout->view('admin/category_view',$this->data);			
		}else{
			$lastid = $this->query_model->INSERTDATA('category',$this->form_data());						
			$this->session->set_flashdata('work_msg', 'Category Name Successfully Inserted.');
			redirect(site_url()."admin/category/add/");
		}
    }
    
    public function edit(){			     
	    
	    $where=array('cat_id'=>$this->uri->segment(4));		     
		if($this->validation_chack() == 'treu'){											 				 
			$this->query_model->UPDATEDATA('category',$where,$this->form_data());	
									
			$this->session->set_flashdata('work_msg', 'Category Successfully Updated.');
			redirect(site_url()."admin/category/add/".$this->uri->segment(4));	        
		}else{
			$this->data['category_data'] = $this->query_model->get_sql_select_data('category',$where);
			$this->layout->view('admin/category_edit',$this->data);
		}	    
	}
	
    public function delete(){		
		if(!$this->input->is_ajax_request()) $this->cms_redirect();			 
	     $where = array('cat_id'=>$this->query_model->input->Get('work_id'));		     
		 $this->query_model->DELETEDATA('category',$where);		 
	}
}

?>
