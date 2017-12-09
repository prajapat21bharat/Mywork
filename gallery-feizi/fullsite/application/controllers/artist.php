<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Installation script for
 *
 * @author NTF Module Generator
 */
class Artist extends MY_Controller {
	
	public $data 	= 	array();
	public function __construct()
	{
		parent::__construct();
		$this->load->model('query_model');
                $this->load->library('slug'); 
		$this->data['cat'] = $this->query_model->get_sql_select_data_ajax('category');
		$this->data['error_msg'] = '';
	}
	
   public function index(){ 
	   	   
	   $where = array("status"=>1,"ID !="=>1,"typeOfRep !="=>'ini');
	   $this->data['artist']=$this->query_model->get_sql_select_data('user_profile',$where,'','','user_profile.first_name'); 
	    
	   $where1 = array("status"=>1,"ID !="=>1,"typeOfRep"=>'ini');
	   $this->data['artist_ini']=$this->query_model->get_sql_select_data('user_profile',$where1,'','','user_profile.first_name');
	   
	   	   	   //user_profile.first_name
	   $this->layout->view('artist',$this->data);	   
	}
	
	public function artist_id(){
		
		$where = array('ID !='=>1,'status'=>1);
		$field = array('ID');
               // $field = array('first_name');
		$artist_id = $this->query_model->get_sql_select_data('user_profile',$where,$field);
		return $artist_id;
	}
	
	public function artist($id){
		
		$where = array('ID'=>$id,'status'=>1);
		$field = array('ID','first_name');
		$artist_data = $this->query_model->get_sql_select_data('user_profile',$where,$field);
		return $artist_data;
	}
	
	
	public function order_type($id){
		
		$where = array('ID'=>$id);
		$field = array('order_type');
		$user_type = $this->query_model->get_sql_select_data('user_profile',$where,$field);
		return $user_type;
	}
	
	public function works(){
		//Changes slugname to Id   
		$slugs = $this->uri->segment(3);
                //Chenge to upper case name
                   $zname_clean = strtoupper($slugs);
                   $slugName = str_replace('-',' ',$zname_clean);
                $where = array('first_name'=>$slugName);
                $getId = array_shift($this->query_model->get_sql_select_data('user_profile',$where));
                $id = $getId->ID;
               
		$this->data['artist_data'] = $this->artist($id);
		$this->data['artist_id'] = $this->artist_id();
		$order_type=$this->order_type($id);
		//echo"<pre>";print_r( $order_type[0]->order_type);
		$where1 = array('works.user_id'=>$id);
		$join=array(array('table' => 'works_image',
							'condition' => 'works.id=works_image.works_id',
							'jointype' => 'left'));
	    
	    $column=array('works.*','GROUP_CONCAT(image) as image');	
		$cat ='';	
	    if($getId->typeOfRep=='ini'){
			$cat = 'EXHIBITED';
		}
	    $this->data['artist_cat'] = $cat;
		$this->data['artist_works'] = $this->query_model->get_joins('works',$where1, $join,$column,NULL,'works.id',$order_type[0]->order_type) ;
		$this->layout->view('artist_view',$this->data);
		//$this->empty_page('artist_view',$this->data['artist_works'],);	
	}
	
	public function news(){
		
		//$id = $this->uri->segment(3);
                //Changes slugname to Id   
		  $slugs = $this->uri->segment(3);
                //Chenge to upper case name
                   $zname_clean = strtoupper($slugs);
                   $slugName = str_replace('-',' ',$zname_clean);
                $where = array('first_name'=>$slugName);
                $getId = array_shift($this->query_model->get_sql_select_data('user_profile',$where));
                $id = $getId->ID;
                
		$this->data['artist_id'] = $this->artist_id();
		$this->data['artist_data'] = $this->artist($id);
		$where = array('user_id'=>$id);
		$like = array('user_id'=>$id);
		$order = array('start_date');
	    $this->data['artist_news']=$this->query_model->get_joins('news',NULL,NULL,NULL,$like,NULL,'start_date ASC'); 
	    $this->layout->view('artist_news',$this->data);
	}
	
	public function bid(){
		
		//$id = $this->uri->segment(3);
                 //Changes slugname to Id   
		  $slugs = $this->uri->segment(3);
                 //Chenge to upper case name
                   $zname_clean = strtoupper($slugs);
                   $slugName = str_replace('-',' ',$zname_clean);
                $where = array('first_name'=>$slugName);
                $getId = array_shift($this->query_model->get_sql_select_data('user_profile',$where));
                $id = $getId->ID;
            
            
		$this->data['artist_id'] = $this->artist_id();
		$this->data['artist_data'] = $this->artist($id);
		$where = array('user_id'=>$id);
	    $this->data['artist_bid']=$this->query_model->get_sql_select_data('bid',$where); 
	    $this->layout->view('artist_bid',$this->data);
	}
	
	public function press(){
		
		//$id = $this->uri->segment(3); 
              //Changes slugname to Id   
		  $slugs = $this->uri->segment(3);
                //Chenge to upper case name
                   $zname_clean = strtoupper($slugs);
                   $slugName = str_replace('-',' ',$zname_clean);
                $where = array('first_name'=>$slugName);
                $getId = array_shift($this->query_model->get_sql_select_data('user_profile',$where));
                $id = $getId->ID;
            
		$this->data['artist_id'] = $this->artist_id();
		$this->data['artist_data'] = $this->artist($id);
		$where = array('user_id'=>$id);
		$like = array('user_id'=>$id);
                $join=array(array('table' => 'press_image',
						'condition' => 'press.id=press_image.press_id',
						'jointype' => 'left'));
	
		$column=array('press.*','GROUP_CONCAT(image) as image');		
             //$this->data['artist_press'] = $this->query_model->get_joins('press',NULL, $join,$column,NULL,'start_date DESC') ;
                
	    $this->data['artist_press']=$this->query_model->get_joins('press',NULL,NULL,NULL,$like,NULL,'start_date DESC');
	    $this->layout->view('artist_press',$this->data);
	}
	
	public function exhibitions(){
		
		 //$idUri = $this->uri->segment(3); 
               // $id = str_replace('-', ',',$idUri);
            //Changes slugname to Id   
		  $slugs = $this->uri->segment(3);
                //Chenge to upper case name
                   $zname_clean = strtoupper($slugs);
                   $slugName = str_replace('-',' ',$zname_clean);
                $where = array('first_name'=>$slugName);
                $getId = array_shift($this->query_model->get_sql_select_data('user_profile',$where));
                //print_r($getId);
                
                $id = $getId->ID;
		$this->data['artist_data'] = $this->artist($id);
		$this->data['artist_id'] = $this->artist_id();
		$like = array('user_id'=>$id);
		$where = array('ex_type'=>'Solo');		
		$this->data['solo_exhibitions']=$this->query_model->get_joins('exhibitions',$where,NULL,NULL,$like,NULL,'start_date ASC');
		
		$where1 = array('ex_type'=>'Group');		
		$this->data['group_exhibitions']= $this->query_model->get_joins('exhibitions',$where1,NULL,NULL,$like,NULL,'start_date ASC');
	    
                $this->layout->view('artist_exhibitions',$this->data);
	}
	
	public function publications(){
		
		//$id = $this->uri->segment(3); 
            //Changes slugname to Id   
		  $slugs = $this->uri->segment(3);
                //Chenge to upper case name
                   $zname_clean = strtoupper($slugs);
                   $slugName = str_replace('-',' ',$zname_clean);
                $where = array('first_name'=>$slugName);
                $getId = array_shift($this->query_model->get_sql_select_data('user_profile',$where));
                $id = $getId->ID;
                
		$this->data['artist_id'] = $this->artist_id();
		$this->data['artist_data'] = $this->artist($id);
		$where = array('user_id'=>$id);
		$like = array('user_id'=>$id);
	    //$this->data['artist_publications']=$this->query_model->get_sql_select_data('publications',$where); 
	    $this->data['artist_publications']=$this->query_model->get_joins('publications',NULL,NULL,NULL,$like,NULL);
	    $this->layout->view('artist_publications',$this->data);
	}
	
	public function detail(){
		
		$id = $this->uri->segment(3);
		//echo $id;
		$this->data['artist_id'] = $this->artist_id();
		$this->data['artist_data'] = $this->artist($id);
		$this->data['works_id'] = $this->uri->segment(4);
		$this->data['artist_works_ids'] = $this->works_ids($id);
		
		$where1 = array('works.id'=>$this->uri->segment(4),'works.user_id'=>$this->uri->segment(3));
		$join=array(array('table' => 'works_image',
							'condition' => 'works.id=works_image.works_id',
							'jointype' => 'left'));	    
	    $column=array('works.*','GROUP_CONCAT(image) as image');		
		$this->data['detail'] = $this->query_model->get_joins('works',$where1, $join,$column,NULL,'works.id') ;
		
		$this->empty_page($this->data['detail'],'artist_img_slider');
	}
	
	public function works_ids($id){
		// for show exist images only
		$where1 = array('works.user_id'=>$id);
		$join=array(array('table' => 'works_image',
							'condition' => 'works.id=works_image.works_id',
							'jointype' => 'inner'));	    
	    $column=array('works_id');		
		$artist_data = $this->query_model->get_joins('works',$where1, $join,$column,NULL,'works.id') ;
		
		// for all works
		//$where = array('user_id'=>$id);
		//$feild = array('id');
		//$artist_data = $this->query_model->get_sql_select_data('works',$where,$feild);		 
		return $artist_data;
	}
	
	public function name($id){
		
		$where = array('cat_id'=>$id);
		$name = $this->query_model->get_sql_select_data('category',$where,'cat_name');
		return $name;
	}
	
	public function pdf(){
		$this->data['pdf'] = $this->uri->segment(3);
		$this->layout->view('document',$this->data);
	}
	
	public function empty_page($chk="",$url=""){
		
		if(!empty($chk)){		
			$this->layout->view($url,$this->data);
		}else{
			$this->data['error_msg'] = 'error_msg';
			$this->layout->view($url,$this->data);
		}
	}	
	
	public function img_works_ids($id){
		$where1 = array('works.user_id'=>$id);
		$join=array(array('table' => 'works_image',
							'condition' => 'works.id=works_image.works_id',
							'jointype' => 'inner'));	    
	    $column=array('works_id');		
		$work_id = $this->query_model->get_joins('works',$where1, $join,$column,NULL,'works.id',NULL,1) ;
		
		return $work_id;
	}
 }
