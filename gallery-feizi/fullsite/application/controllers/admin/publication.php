<?php if (!defined('BASEPATH')) die();
class Publication extends Admin_Controller  {

	public $data 	= 	array();
	public function __construct(){		 
		parent::__construct();
		if($this->session->userdata('group')!='1'){
			redirect(site_url().'admin/login');		
		}
		$this->load->model('query_model');
		$where = array("status"=>1,"ID !="=>1);
		$feild = array("ID","first_name");
	    $this->data['artist']=$this->query_model->get_sql_select_data('user_profile',$where,$feild); 
		
		$join=array(array('table' => 'publications_image',
							'condition' => 'publications.id=publications_image.publications_id',
							'jointype' => 'left'));
	    
	    $column=array('publications.*','GROUP_CONCAT(publications_image.image) as image');		
		$this->data['publications'] = $this->query_model->get_joins('publications','', $join,$column,NULL,'publications.id') ;			
		//$this->data['publications'] = $this->query_model->get_sql_select_data_ajax('publications');	
    }
    public function index(){
		if($this->input->post('userimg')){ $this->data['imgs'] = $this->input->post('userimg');}else{$this->data['imgs'] = '';}
		$this->layout->view('admin/publication_view',$this->data);
	}
	public function validation_chack(){
		$this->form_validation->set_rules('category_type[]', 'Artists', 'trim|required');
		//$this->form_validation->set_rules('userimg', 'Publications Image', 'required');
		$this->form_validation->set_rules('title', 'Title', 'trim|required');
		$this->form_validation->set_rules('titre', 'Artists/Titre', 'trim|required');
		$this->form_validation->set_rules('prix', 'Prix', 'trim|required');
		//$this->form_validation->set_rules('isbn', 'ISBN', 'trim|required');
		if ($this->form_validation->run() == FALSE){
			return false;		
		}else{
			return true;		
		}
	}
	public function form_data(){
		if($this->input->post()){
			//$artists  = $this->input->post('category_type');
			//$userimg  = $this->input->post('userimg');
			$artists  = implode($this->input->post('category_type'), ',');	
			$title    = $this->input->post('title');	
			$titre    = $this->input->post('titre');	
			$prix     = $this->input->post('prix');	
			//$isbn     = $this->input->post('isbn');			
			$ins = array('user_id' =>$artists,'title' =>$title,'titre' =>$titre,'prix' =>$prix);	
			return $ins;
		}
	}
	public function add(){		
		
		if ($this->validation_chack() != 'treu'){
			if($this->input->post('userimg')){ $this->data['imgs'] = $this->input->post('userimg');}else{$this->data['imgs'] = '';}
			$this->layout->view('admin/publication_view',$this->data);			
		}else{
			$lastid = $this->query_model->INSERTDATA('publications',$this->form_data());
			foreach($this->input->post('userimg') as $img){ 
				$ins1 = array('publications_id' =>$lastid,'image' =>$img);					 				 
				$this->query_model->insertdata('publications_image',$ins1);
			}										
			$this->session->set_flashdata('work_msg', 'Publication successfully added.');
			redirect(site_url()."admin/publication/".$this->uri->segment(4));
		}
    }
    public function edit(){		
		$where=array('id'=>$this->uri->segment(4));			
		$this->data['des'] = $this->query_model->get_sql_select_data('publications',$where);		
		
		$where1=array('publications_id '=>$this->uri->segment(4));	
	    $this->data['publications_img'] = $this->query_model->get_sql_select_data('publications_image',$where1);
				 
		if ($this->validation_chack() != 'treu'){							
			$this->layout->view('admin/publication_edit',$this->data);			
		}else{	     	     
	        $where = array("id"=>$this->uri->segment(4));		 
			$this->query_model->UPDATEDATA('publications',$where,$this->form_data());
			foreach($this->input->post('userimg') as $img){ 
				$ins1 = array('publications_id' =>$this->uri->segment(4),'image' =>$img);								 				 
				$this->query_model->INSERTDATA('publications_image',$ins1);
			}					 				 		
			
			$this->session->set_flashdata('work_msg', 'Publication successfully updated.');
	        redirect(site_url()."admin/publication/add/");	        
		}
	    
	}
	public function delete(){		
		if(!$this->input->is_ajax_request()) $this->cms_redirect();			 
	     $where=array('id'=>$this->query_model->input->Get('work_id'));	 
		 $this->query_model->DELETEDATA('publications',$where);	
		 
		 $where1 = array('publications_id'=>$this->query_model->input->Get('work_id'));	
		 $img1   = $this->query_model->get_sql_select_data('publications_image',$where1, $image);			
		 foreach($img1 as $imgs){
			$path  = './uploads/'.$imgs->image;
			unlink($path);
			$this->delThumb($imgs->image);
		 } 	 
	}
	public function delete_img(){		
		if(!$this->input->is_ajax_request()) $this->cms_redirect();			 
	     $where=array('id'=>$this->query_model->input->Get('work_id'));
	     $image = array('image');
	     $img   = $this->query_model->get_sql_select_data('publications_image',$where, $image);
	     $path  = './uploads/'.$img[0]->image;
	     unlink($path);		
	     $this->delThumb($img[0]->image); 
		 $this->query_model->DELETEDATA('publications_image',$where);		 
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
		$config['height'] = 150;
		$config['width'] = 100;
		$config['new_image'] = './uploads/thumb_new/'.$imgName;
		$this->load->library('image_lib', $config); 
		$this->image_lib->initialize($config);
		$this->image_lib->resize();
	}
	public function user_name($u_id){
		$where = array("ID"=>$u_id);
		$feild = array("ID","first_name");
		return $this->query_model->get_sql_select_data('user_profile',$where,$feild); 
	}
}

?>
