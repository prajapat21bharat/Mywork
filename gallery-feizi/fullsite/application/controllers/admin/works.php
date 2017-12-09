<?php if (!defined('BASEPATH')) die();
class Works extends Admin_Controller  {

	public $data 	= 	array();
	public function __construct(){		 
		parent::__construct();
		if($this->session->userdata('group')!='1'){
			redirect(site_url().'admin/login');		
		}
		$this->load->model('query_model');
		$this->data['cat']   = $this->query_model->get_sql_select_data('category');
		$where=array('`works.user_id'=>$this->uri->segment(4));		
		$join=array(array('table' => 'works_image',
							'condition' => 'works.id=works_image.works_id',
							'jointype' => 'left'));
	    
	    $column=array('works.*','GROUP_CONCAT(image) as image');		
		$this->data['works'] = $this->query_model->get_joins('works',$where, $join,$column,NULL,'works.id','works.id DESC') ;
		//$this->data['works'] = $this->query_model->get_sql_select_data('works',$where);								 
		
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
		$this->layout->view('admin/works_view');	
	}
	public function add(){	
							
		if ($this->form_validation->run('works_validation') == FALSE){	
			if($this->input->post('userimg')){ $this->data['imgs'] = $this->input->post('userimg');}else{$this->data['imgs'] = '';}					
			$this->layout->view('admin/works_view',$this->data);			
		}else{	
			$post[]= $this->input->post();
			$ins = array(
					'user_id'     =>$post[0]['id'],
					'cat_id'      =>$post[0]['category_type'],
					'title'       =>$post[0]['title'],
					'work_date'   =>$post[0]['start_date'],
					'description' =>$post[0]['workdes'],
					'dimension'   =>$post[0]['dimension'],
					'edition'     =>$post[0]['edition'],
					'market_price'=>$post[0]['market_price'],
					'remark'      =>$post[0]['remark']
				   );
			$crop_x=$this->input->post('x');
			$crop_y=$this->input->post('y');
			$crop_w=$this->input->post('w');
			$crop_h=$this->input->post('h');
			
			$lastid = $this->query_model->insertdata('works',$ins);			
			foreach($this->input->post('userimg') as $img)
			{ 
				$ins1 = array('works_id' =>$lastid,'image' =>$img);					 				 
				$this->query_model->insertdata('works_image',$ins1);
				
				$this->create_crop($img,$crop_x,$crop_y,$crop_w,$crop_h);
			//	echo $img; exit;
			}
			$this->session->set_flashdata('work_msg', 'Works successfully added.');
			redirect(site_url()."admin/works/add/".$this->uri->segment(4));
		}
    }
    
	public function edit(){				 
	     $where=array('id'=>$this->uri->segment(5));	
	     $this->data['work_data'] = $this->query_model->get_sql_select_data('works',$where);
	     
	     $where1=array('works_id '=>$this->uri->segment(5));	
	     $this->data['work_img'] = $this->query_model->get_sql_select_data('works_image',$where1);		     
	      	    
	     if ($this->form_validation->run('works_validation') == FALSE){							
			$this->layout->view('admin/works_view_edit',$this->data);			
		 }else{	     	     
	        $id  = $this->input->post('id');
			$post[]= $this->input->post();
			
			$crop_x=$this->input->post('x');
			$crop_y=$this->input->post('y');
			$crop_w=$this->input->post('w');
			$crop_h=$this->input->post('h');
			
			$id=array('id'=>$id);
			$ins = array(
					'cat_id'      =>$post[0]['category_type'],
					'title'       =>$post[0]['title'],
					'work_date'   =>$post[0]['start_date'],
					'description' =>$post[0]['workdes'],
					'dimension'   =>$post[0]['dimension'],
					'edition'     =>$post[0]['edition'],
					'market_price'=>$post[0]['market_price'],
					'remark'      =>$post[0]['remark']
				   );	
			$this->query_model->UPDATEDATA('works',$id,$ins);	
			
			foreach($this->input->post('userimg') as $img)
			{ 
				$ins1 = array('works_id' =>$this->uri->segment(5),'image' =>$img);								 				 
				$this->query_model->insertdata('works_image',$ins1);
				$this->create_crop($img,$crop_x,$crop_y,$crop_w,$crop_h);
			}			
			
			$this->session->set_flashdata('work_msg', 'Works successfully updated.');
	        redirect(site_url()."admin/works/add/".$this->uri->segment(4).'/'.$this->input->post('id'));	        
		}	    
	}	
	public function delete(){		
		if(!$this->input->is_ajax_request()) $this->cms_redirect();			 
	     $where=array('id'=>$this->query_model->input->Get('work_id'));		 
		 $this->query_model->DELETEDATA('works',$where);
		 
		 $where1 = array('works_id'=>$this->query_model->input->Get('work_id'));	
		 $img1   = $this->query_model->get_sql_select_data('works_image',$where1, $image);			
		 foreach($img1 as $imgs){
			$this->delcrop($imgs->image);		
		 }
		 $this->query_model->DELETEDATA('works_image',$where1);		 
	}
	public function delete_img(){		
		if(!$this->input->is_ajax_request()) $this->cms_redirect();			 
	     $where=array('id'=>$this->query_model->input->Get('work_id'));
	     $image = array('image');
	     $img   = $this->query_model->get_sql_select_data('works_image',$where, $image);	
	     $this->delcrop($img[0]->image);			 
		 $this->query_model->DELETEDATA('works_image',$where);		 
	}
	public function img_delete(){		
		if(!$this->input->is_ajax_request()) $this->cms_redirect();			 
	     $name=$this->query_model->input->Get('work_id');	     
	     $this->delcrop($name);			 
	}
	public function delcrop($imgs){
		$path  = './uploads/'.$imgs;
	    unlink($path);	
		$path1  = './uploads/crop/'.$imgs;
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
  public function imgResize($imgName)
  {
		
		list($width, $height, $type, $attr) = getimagesize('./uploads/'.$imgName);
	
		$this->load->library('image_lib');
		$config['image_library'] = 'gd2';
		$config['image_library'] = 'imagemagick';
		$config['library_path'] = '/usr/bin/';
		$config['source_image'] = './uploads/'.$imgName;
		$config['maintain_ratio'] = false;
		$config['width'] = '169';
		$config['height'] = '169';
		$config['x_axis'] = (($width / 2) - ($config['width'] / 2));
		$config['y_axis'] = (($height / 2) - ($config['height'] / 2));
		
		$config['new_image'] = './uploads/crop/'.$imgName;
		$this->load->library('image_lib', $config);
		$this->image_lib->initialize($config);
		$this->image_lib->crop();
	}	
	
  public function create_crop($imgName,$x,$y,$w,$h)
  {
		
		list($width, $height, $type, $attr) = getimagesize('./uploads/'.$imgName);
	
		$this->load->library('image_lib');
		$config['image_library'] = 'gd2';
		$config['image_library'] = 'imagemagick';
		$config['library_path'] = '/usr/bin/';
		$config['source_image'] = './uploads/'.$imgName;
		$config['maintain_ratio'] = true;
		$config['width'] = '500';
		$this->load->library('image_lib', $config);
		$this->image_lib->initialize($config);
		$this->image_lib->resize();
		$this->image_lib->clear();
		
		
		$config['width'] = $w;
		$config['height'] = $h;
		$config['x_axis'] = $x;
		$config['y_axis'] = $y;
		
		$config['new_image'] = './uploads/crop/'.$imgName;
		$this->load->library('image_lib', $config);
		$this->image_lib->initialize($config);
		$this->image_lib->crop();
	}	
}

?>
