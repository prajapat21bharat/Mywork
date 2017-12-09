<?php if (!defined('BASEPATH')) die();
class Home extends Admin_Controller {
	
	
	
	function __construct() {
      parent::__construct();
  
	  $this->load->model('query_model');
	}
	
	###-------INSERT NEW Resturant ---#####
   public function index()
	{
      
	  $where_owner=array('group_id'=>'3');
	  $feild_owner=array('user_id','user_name');
	  
	  
	  $feild_state=array('state','state_code');
	  $data=array(	
	  				'owner'=>$this->query_model->get_sql_select_data('user',$where_owner,$feild_owner),
	  				'state'=>$this->query_model->get_sql_select_data('states',NULL,$feild_state),
					'error'=>''
					);
     
	   if ($this->form_validation->run('restaurant_admin') == FALSE)
		{
			$this->layout->view('admin/restaurant_add_view',$data);
		}
		else
		{
			$config['upload_path'] ='./uploadimages/';
		    $config['allowed_types'] = 'gif|jpg|png';
			$this->load->library('upload');
			
			$i=1;
			$j=1;
			
			foreach($_FILES as $key => $value)
			{
				
				if($i==1)
				{
					if($_FILES['userfile']!='')
					{
						$this->upload->initialize($config);
						if(!empty($key['name']))
						{
							$this->upload->initialize($config);
						
							if ( !$this->upload->do_upload($key))
							{
								$data['error'][$j] =  $this->upload->display_errors();    
								$j++;
							}    
							else 
							{
								
								$this->query_model->process_pic($id,$i);
								$data['upload_data'][$i]  = $this->upload->data();
								$i++;
							}
						}
					}else{
						return false;
						}
					
				}else
				{		
				echo $i;
									
					$this->upload->initialize($config);
					if(!empty($key['name']))
					{
						$this->upload->initialize($config);
					
						if ( !$this->upload->do_upload($key))
						{
							$data['error'][$j] =  $this->upload->display_errors();    
							$j++;
						}    
						else 
						{
							
							
							$this->query_model->process_pic();
							$data['upload_data'][$i]  = $this->upload->data();
							$i++;
						}
					}
				}
			  }
			
				
		}
	}

	
	
	
   
   
   
   
   ###-------GEt City LIST  ---#####
    public function get_city()
   {
	   
	    //if(!$this->input->is_ajax_request()) $this->redirect();
        $where=array('state_code'=>$this->input->Get('state'));
	   	$feild=array('city_id','city');
	   	print_r(json_encode($this->query_model->get_sql_select_data_ajax('cities',$where,$feild)));
   }
   
   
   
   ###-------GEt Owner  LIST  ---#####
    public function get_owner()
   {
	   
	   // if(!$this->input->is_ajax_request()) $this->cms_redirect();
        $where=array('state_code'=>$this->input->Get('state'));
	   	$feild=array('city_id','city');
	   	print_r(json_encode($this->query_model->get_sql_select_data_ajax('cities',$where,$feild)));
   }
   
   
   
   ###-------INSERT IMAGE GALLERY   ---#####
   public function restaurant_gallery()
   {
	    if ($this->form_validation->run('restaurant_admin') == FALSE)
		{
			$this->layout->view('admin/restaurant_add_view',$data);
		}
		else
		{
			$config['upload_path'] ='./uploadimages/';
		    $config['allowed_types'] = 'gif|jpg|png';
			$this->load->library('upload');
			
			$i=1;
			$j=1;
			
			foreach($_FILES as $key => $value)
			{
								
				$this->upload->initialize($config);
				if(!empty($key['name']))
				{
					$this->upload->initialize($config);
				
					if ( !$this->upload->do_upload($key))
					{
						$data['error'][$j] =  $this->upload->display_errors();    
						$j++;
					}    
					else 
					{
						
						
						$this->query_model->process_pic();
						$data['upload_data'][$i]  = $this->upload->data();
						$i++;
					}
				}
		    }

			//$this->load->view('upload_success', $data);
		}
   }
   
   
   
}

