<?php if (!defined('BASEPATH')) die();
class Contact extends Admin_Controller  {
	
	public $data 	= 	array();
	public function __construct(){		 
		parent::__construct();
		if($this->session->userdata('group')!='1'){
			redirect(site_url().'admin/login');		
		}
		$this->load->model('query_model');
		$this->load->helper('ckeditor');
		/*	
		$this->data['ckeditor'] = array(
			//ID of the textarea that will be replaced
			'id' 	=> 	'content',
			'path'	=>	'ckeditor',
			//Optionnal values
			'config' => array(
				'toolbar' 	=> 	"Full", 	//Using the Full toolbar
				'width' 	=> 	"",	//Setting a custom width
				'height' 	=> 	'200px',	//Setting a custom height
			),
			//Replacing styles from the "Styles tool"
			'styles' => array(
				//Creating a new style named "style 1"
				'style 1' => array (
					'name' 		=> 	'Blue Title',
					'element' 	=> 	'h2',
					'styles' => array(
						'color' 	=> 	'Blue',
						'font-weight' 	=> 	'bold'
					)
				),
				//Creating a new style named "style 2"
				'style 2' => array (
					'name' 	=> 	'Red Title',
					'element' 	=> 	'h2',
					'styles' => array(
						'color' 		=> 	'Red',
						'font-weight' 		=> 	'bold',
						'text-decoration'	=> 	'underline'
					)
				)
			)
		);*/
		
    }
    public function index(){
		$this->data['contact_data'] = $this->query_model->get_sql_select_data_ajax('contact');
		$this->layout->view('admin/contact_edit',$this->data);	
	}
	public function validation_chack(){
		
		$this->form_validation->set_rules('contact_data', 'Contact Data', 'trim|required');
		
		if ($this->form_validation->run() == FALSE){
			return false;		
		}else{
			return true;		
		}
	}
	
	public function form_data(){
		if($this->input->post()){
			$contact_data = $this->input->post('contact_data');		
			$google_map   =	$this->input->post('google_map');		
			$ins = array('contact_data' =>$contact_data,'google_map' =>$google_map);	
			return $ins;
		}
	}
	public function edit(){			     
	    
	    $where=array('id'=>$this->uri->segment(4));		     
		if($this->validation_chack() == 'treu'){											 				 
			$this->query_model->UPDATEDATA('contact',$where,$this->form_data());	
									
			$this->session->set_flashdata('work_msg', 'Contact Successfully Updated.');
			redirect(site_url()."admin/contact/edit/".$this->uri->segment(4));	        
		}else{
			$this->data['contact_data'] = $this->query_model->get_sql_select_data('contact',$where);
			$this->layout->view('admin/contact_edit',$this->data);
		}	    
	}
}

?>
