<?php if (!defined('BASEPATH')) die();
class Bid extends Admin_Controller  {

	public $data 	= 	array();
	public function __construct(){		 
		parent::__construct();
		if($this->session->userdata('group')!='1'){
			redirect(site_url().'admin/login');		
		}
		$this->load->model('query_model');
		$this->data['cat'] = $this->query_model->get_sql_select_data_ajax('category');
		$this->load->helper('ckeditor');
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
		);
    }
    public function index(){			
		$this->layout->view('admin/bid_view',$this->data);	
	}
	public function add(){		
		$this->form_validation->set_rules('category_type', 'Category Type', 'trim|required');
		$this->form_validation->set_rules('bid_des', 'Bid', 'trim|required');
		$id = $this->uri->segment(4);
		$where=array('user_id'=>$id);		
		$this->data['news'] = $this->query_model->get_sql_select_data_ajax('bid',$where);	
		if ($this->form_validation->run() == FALSE){
			$this->layout->view('admin/bid_view',$this->data);			
		}else{
			$category_type  = $this->input->post('category_type');
			$newsdes = $this->input->post('bid_des');						
			$ins = array('user_id' =>$id,'cat_id' =>$category_type,'description' =>$newsdes);					 				 
			$this->query_model->insertdata('bid',$ins);
			
			$this->session->set_flashdata('work_msg', 'News successfully added.');
			redirect(site_url()."admin/bid/add/".$this->uri->segment(4));
		}
    }
    public function edit(){		
		$where=array('user_id'=>$this->uri->segment(4));			
		$this->data['bid'] = $this->query_model->get_sql_select_data_ajax('bid',$where);		
				 
	     $where=array('id'=>$this->uri->segment(5));	
	     $work = $this->query_model->get_sql_select_data_ajax('bid',$where);	 
	     $this->data['cat_id'] = $work[0]->cat_id; 
	     $this->data['des']    = $work[0]->description;   
	     
	    $this->form_validation->set_rules('category_type', 'Category Type', 'trim|required');
		$this->form_validation->set_rules('bid', 'Bid', 'trim|required');
		if ($this->form_validation->run() == FALSE){							
			$this->layout->view('admin/bid_edit',$this->data);			
		}else{	     	     
	        $id  = $this->uri->segment(5);
			$category_type  = $this->input->post('category_type');
			$workdes = $this->input->post('bid');
						
			$id=array('id'=>$id);
			$ins = array('cat_id' =>$category_type,'description' =>$workdes);								 				 
			$this->query_model->UPDATEDATA('bid',$id,$ins);			
			
			$this->session->set_flashdata('work_msg', 'Bid successfully updated.');
	        redirect(site_url()."admin/bid/add/".$this->uri->segment(4).'/'.$this->input->post('id'));	        
		}
	    
	}
	public function delete(){		
		if(!$this->input->is_ajax_request()) $this->cms_redirect();			 
	     $where=array('id'=>$this->query_model->input->Get('work_id'));	
		 $this->query_model->DELETEDATA('bid',$where);		 
	}
}

?>
