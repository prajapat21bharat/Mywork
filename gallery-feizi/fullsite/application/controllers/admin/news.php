<?php if (!defined('BASEPATH')) die();
class News extends Admin_Controller  {
	
	public $data 	= 	array();
	public function __construct(){		 
		parent::__construct();
		if($this->session->userdata('group')!='1'){
			redirect(site_url().'admin/login');		
		}
		$this->load->model('query_model');
		$this->load->helper('ckeditor');
		$where = array("status"=>1,"ID !="=>1);
		$feild = array("ID","first_name");
	    $this->data['artist']=$this->query_model->get_sql_select_data('user_profile',$where,$feild); 
		
		//$where=array('`news.user_id'=>$this->uri->segment(4));		
		$join=array(array('table' => 'news_image',
							'condition' => 'news.id=news_image.news_id',
							'jointype' => 'left'));
	    
	    $column=array('news.*','GROUP_CONCAT(image) as image');		
		$this->data['news'] = $this->query_model->get_joins('news',NULL, $join,$column,NULL,'news.id') ;
		$this->data['imgs'] = '';		
		//$this->data['news'] = $this->query_model->get_sql_select_data('news');	
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
            
		$this->layout->view('admin/news_view',$this->data);	
	}
	public function validation_chack(){
		$this->form_validation->set_rules('category_type[]', 'Artists', 'trim|required');
		$this->form_validation->set_rules('title1', 'Title1', 'trim|required');
		$this->form_validation->set_rules('title2', 'Title2', 'trim|required');
		$this->form_validation->set_rules('title3', 'Title3', 'trim|required');
		$this->form_validation->set_rules('palais', 'Url', 'required|trim|max_length[256]|xss_clean|prep_url|valid_url_format|url_exists|callback_duplicate_URL_check');
		$this->form_validation->set_rules('new_des', 'Description', 'trim|required');
		$this->form_validation->set_rules('start_date', 'Date', 'trim|required');
		$this->form_validation->set_rules('end_date', 'To Date', 'trim|required');
		if ($this->form_validation->run() == FALSE){			
			return false;		
		}else{
			return true;		
		}
	}
	public function form_data(){
		if($this->input->post()){			
			$artists  = implode($this->input->post('category_type'), ','); 
			$title1 = $this->input->post('title1');	
			$title3 = $this->input->post('title2');	
			$title2 = $this->input->post('title3');	
			$palais = $this->input->post('palais');	
			$newsdes = $this->input->post('new_des');	
			$start_date  = $this->input->post('start_date');
			$end_date    = $this->input->post('end_date');					
			$ins = array('user_id' =>$artists,'description' =>$newsdes,'title1' =>$title1,'title2' =>$title2,'title3' =>$title3,'palais' =>$palais,'start_date' =>$start_date,'end_date' =>$end_date);	
			return $ins;
		}
	}
	public function add(){		
		
		if ($this->validation_chack() != 'treu'){	
			if($this->input->post('userimg')){ $this->data['imgs'] = $this->input->post('userimg');}else{$this->data['imgs'] = '';}	
			$this->layout->view('admin/news_view',$this->data);			
		}else{
			$lastid = $this->query_model->INSERTDATA('new',$this->form_data());	
			foreach($this->input->post('userimg') as $img){ 
				$ins1 = array('news_id' =>$lastid,'image' =>$img);					 				 
				$this->query_model->insertdata('news_image',$ins1);
			}			
			$this->session->set_flashdata('work_msg', 'News successfully added.');
			redirect(site_url()."admin/news/");
		}
    }
    public function edit(){		     
	   
		$where = array("id"=>$this->uri->segment(4));
		$this->data['des'] = $this->query_model->get_sql_select_data('new',$where);
		
		$where1=array('news_id '=>$this->uri->segment(4));	
	    $this->data['news_img'] = $this->query_model->get_sql_select_data('news_image',$where1);
			
		if ($this->validation_chack() != 'treu'){							
			$this->layout->view('admin/news_edit',$this->data);			
		}else{	     	     
	        $where = array("id"=>$this->uri->segment(4));		 
			$this->query_model->UPDATEDATA('news',$where,$this->form_data());			
		
			foreach($this->input->post('userimg') as $img){ 
				$ins1 = array('news_id' =>$this->uri->segment(4),'image' =>$img);								 				 
				$this->query_model->INSERTDATA('news_image',$ins1);
			}
			$this->session->set_flashdata('work_msg', 'News successfully updated.');
	        redirect(site_url()."admin/news/add/");	        
		}
	    
	}
	public function delete(){		
		if(!$this->input->is_ajax_request()) $this->cms_redirect();
			 
	     $where=array('id'=>$this->query_model->input->Get('work_id'));		     
		 $this->query_model->DELETEDATA('news',$where);	
		 $where1 = array('news_id'=>$this->query_model->input->Get('work_id'));	
		 $img1   = $this->query_model->get_sql_select_data('news_image',$where1, $image);			
		 foreach($img1 as $imgs){
			$path  = './uploads/'.$imgs->image;
			unlink($path);
		 }
		 $this->query_model->DELETEDATA('news_image',$where1);	 
	}
	public function delete_img(){		
		if(!$this->input->is_ajax_request()) $this->cms_redirect();			 
	     $where=array('id'=>$this->query_model->input->Get('work_id'));
	     $image = array('image');
	     $img   = $this->query_model->get_sql_select_data('news_image',$where, $image);
	     $path  = './uploads/'.$img[0]->image;
	     unlink($path);		 
		 $this->query_model->DELETEDATA('news_image',$where);		 
	}
	public function img_delete(){		
		if(!$this->input->is_ajax_request()) $this->cms_redirect();			 
	     $name=$this->query_model->input->Get('work_id');	     
	     $path  = './uploads/'.$name;
	     unlink($path);					 
	}
	public function user_name($u_id){
		$where = array("ID"=>$u_id);
		$feild = array("ID","first_name");
		return $this->query_model->get_sql_select_data('user_profile',$where,$feild); 
	}
}

?>
