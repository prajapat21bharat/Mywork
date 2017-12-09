<?php if (!defined('BASEPATH')) die();
class Exhibitions extends Admin_Controller  {
	
	public $data 	= 	array();
	public function __construct(){		 
		parent::__construct();
		if($this->session->userdata('group')!='1'){
			redirect(site_url().'admin/login');		
		}
		$this->load->model('query_model');
		$this->load->helper('ckeditor');
		$this->data['ckeditor'] = array(
			//ID of the textarea that will be replaced
			'id' 	=> 	'content',
			'path'	=>	'ckeditor',
			//Optionnal values
			'config' => array(
				'toolbar' 	=> 	array(	//Setting a custom toolbar
					                  array('Bold', 'Italic'),
					                  array('Underline', 'FontSize','TextColor'),
					                    array('Smiley'),
															                            
				                             ), 	//Using the Full toolbar
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
		$this->data['cat'] = $this->query_model->get_sql_select_data_ajax('category');	
		$join=array(array('table' => 'exhibitions_image',
							'condition' => 'exhibitions.id=exhibitions_image.exhibitions_id',
							'jointype' => 'left'));
	    
	    $column=array('exhibitions.*','GROUP_CONCAT(image) as image');		
		$this->data['exhibitions'] = $this->query_model->get_joins('exhibitions','', $join,$column,NULL,'exhibitions.id') ;	
		
		$where = array("status"=>1,"ID !="=>1);
		$this->data['artist'] = $this->query_model->get_sql_select_data_ajax('user_profile',$where);
    }
    public function index(){
		if($this->input->post('userimg')){ $this->data['imgs'] = $this->input->post('userimg');}else{$this->data['imgs'] = '';}
		$this->layout->view('admin/exhibitions_tab',$this->data);	
	}
	public function validation_chack(){
		$this->form_validation->set_rules('category_type[]', 'Artists', 'trim|required');
		$this->form_validation->set_rules('ex_type', 'Exhibition Type', 'trim|required');
		$this->form_validation->set_rules('title', 'Title', 'trim|required');		
		$this->form_validation->set_rules('start_date', 'Date', 'trim|required');
		$this->form_validation->set_rules('end_date', 'To Date', 'trim|required');
		$this->form_validation->set_rules('description', 'Description', 'trim|required');
		//$this->form_validation->set_rules('userimg[]', 'Exhibition Image', 'trim|required');
		if ($this->form_validation->run() == FALSE){
			return false;		
		}else{
			return true;		
		}
	}
	public function form_data(){
		if($this->input->post()){
			//$cat_id = $this->input->post('category_type');
			$cat_id      = implode($this->input->post('category_type'), ',');
			$ex_type     = $this->input->post('ex_type');
			$title       = $this->input->post('title');
			$start_date  = $this->input->post('start_date');
			$end_date    = $this->input->post('end_date');
			$start_time  = $this->input->post('start_time');
			$end_time    = $this->input->post('end_time');
			$description = $this->input->post('description');
			//$userimg     = $this->input->post('userimg[]');
			$active      = $this->input->post('active');	
					
			$ins = array('user_id' =>$cat_id,'title' =>$title,'ex_type' =>$ex_type,'start_date' =>$start_date,'end_date' =>$end_date,'start_time' =>$start_time,'end_time' =>$end_time,'description' =>$description,'active' =>$active);	
			return $ins;
		}
	}
	public function add(){					
		if ($this->validation_chack() != 'true'){
			if($this->input->post('userimg')){ $this->data['imgs'] = $this->input->post('userimg');}else{$this->data['imgs'] = '';}
			$this->layout->view('admin/exhibitions_tab',$this->data);			
		}else{
			$lastid = $this->query_model->INSERTDATA('exhibition',$this->form_data());
			$userid= $this->input->post('category_type');
			foreach($this->input->post('userimg') as $img){ 
				$ins1 = array('exhibitions_id' =>$lastid,'image' =>$img,'user_id'=>$userid['0']);
									 				 
				$this->query_model->insertDataFromUser('exhibitions_image',$ins1);
			}			
			$this->session->set_flashdata('work_msg', 'Exhibition Successfully Inserted.');
			redirect(site_url()."admin/exhibitions/add/");
		}
    }
    public function edit(){			     
	     $where=array('id'=>$this->uri->segment(4));	
	     $this->data['exhibitions_data'] = $this->query_model->get_sql_select_data('exhibitions',$where);
	     
	     $where1=array('exhibitions_id '=>$this->uri->segment(4));	
	     $this->data['exhibitions_img'] = $this->query_model->get_sql_select_data('exhibitions_image',$where1);	
	     
		if($this->validation_chack() == 'treu'){		
			$id  = $this->uri->segment(4);			
			$id=array('id'=>$id);								 				 
			$this->query_model->UPDATEDATA('exhibitions',$id,$this->form_data());	
			//$userid= $this->input->post('category_type[]');
			foreach($this->input->post('userimg') as $img){ 
				$ins1 = array('exhibitions_id' =>$this->uri->segment(4),'image' =>$img,'user_id'=>'');								 				 
				$this->query_model->insertdata('exhibitions_image',$ins1);
			}						
			$this->session->set_flashdata('work_msg', 'Exhibitions Successfully Updated.');
			redirect(site_url()."admin/exhibitions/add/".$this->uri->segment(4));	        
		}else{
			$where=array('exhibitions.id'=>$this->uri->segment(4));		
			$join=array(array('table' => 'exhibitions_image',
							'condition' => 'exhibitions.id=exhibitions_image.exhibitions_id',
							'jointype' => 'left'));
	    
			$column=array('exhibitions.*','GROUP_CONCAT(image) as image');		
			$this->data['data'] = $this->query_model->get_joins('exhibition',$where, $join,$column,NULL,'exhibitions.id') ;		
			
			$this->layout->view('admin/exhibitions_edit',$this->data);
		}	    
	}
	public function delete(){		
		if(!$this->input->is_ajax_request()) $this->cms_redirect();			 
	     $where = array('id'=>$this->query_model->input->Get('work_id'));		     
		 $this->query_model->DELETEDATA('exhibition',$where);	
		 
		 $where1 = array('exhibitions_id'=>$this->query_model->input->Get('work_id'));	
		 $img1   = $this->query_model->get_sql_select_data('exhibitions_image',$where1, $image);			
		 foreach($img1 as $imgs){
			$path  = './uploads/'.$imgs->image;
			unlink($path);
			$this->delThumb($imgs->image);
		 }
		 $this->query_model->DELETEDATA('exhibitions_image',$where1);	 
	}
	public function delete_img(){		
		
		if(!$this->input->is_ajax_request()) $this->cms_redirect();			 
	     $where=array('id'=>$this->query_model->input->Get('work_id'));
	     $image = array('image');
	     $img   = $this->query_model->get_sql_select_data('exhibitions_image',$where, $image);
	     $path  = './uploads/'.$img[0]->image;
	     unlink($path);	
	     //$path1  = './uploads/thumb_new/'.$imgs->image;
		 //$this->delThumb($name);
		 $this->query_model->DELETEDATA('exhibitions_image',$where);			 
	}
	public function img_delete(){		
		if(!$this->input->is_ajax_request()) $this->cms_redirect();			 
	     $name=$this->query_model->input->Get('work_id');	     
	     $path  = './uploads/'.$name;
	     unlink($path);	
	     $this->delThumb($name);		 
	}
	public function delThumb($imgs){
		$img = explode('.',$imgs);
		$name = $img[0].'_thumb.'.$img[1];
		$path1  = './uploads/thumb_new/'.$name;
		unlink($path1);
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
			$this->imgResize($name.$data['file_ext']);
			}
		}
	 }	
	}     
  private function set_upload_options_header($dp){   
	$config = array();
	$path= $config['upload_path'] =$dp;
	$config['allowed_types'] = 'gif|jpg|png|jpeg|video/mp4';
	$config['overwrite']     = FALSE;
	return $config;
  }
  public function imgResize($imgName){
 
		$this->load->library('image_lib');
		$config['image_library'] = 'gd2';
		$config['source_image'] = './uploads/'.$imgName;
		$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = false;
		$config['height'] = 90;
		$config['width'] = 100;
		$config['new_image'] = './uploads/thumb_new/'.$imgName;
		$this->load->library('image_lib', $config); 
		$this->image_lib->initialize($config);
		$this->image_lib->resize();
	}
  public function name($id){
	  $where1=array('ID'=>$id);		 
	  $user = $this->query_model->get_sql_select_data('user_profile',$where1,'first_name');
	  return $user;
  }
}

?>
