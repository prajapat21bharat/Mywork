<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Installation script for
 *
 * @author NTF Module Generator
 */
class News extends MY_Controller {
	
	public $data 	= 	array();
	public function __construct()
	{
		parent::__construct();
		$this->load->model('query_model');		
	}
	
	public function ex(){		
		$c = date("Y-m-d");	
	    $where = array("start_date <="=>$c, "end_date >=" => $c);		
	    
	    $join=array(array('table' => 'news_image',
						'condition' => 'news.id=news_image.news_id',
						'jointype' => 'left'));
	
		$column=array('news.*','GROUP_CONCAT(image) as image');		
		$this->data['current'] = $this->query_model->get_joins('news',$where, $join,$column,NULL,'news.id') ;	    
		//$this->data['current'] = $this->query_model->get_sql_select_data('news',$where) ;		   
	    if($this->data['current']){
			$end = $this->data['current'][0]->end_date;  
			$where1 = array("start_date >"=>$end);	   
			$join=array(array('table' => 'news_image',
							'condition' => 'news.id=news_image.news_id',
							'jointype' => 'left'));
	    
			$column=array('news.*','GROUP_CONCAT(image) as image');		
			$this->data['next'] = $this->query_model->get_joins('news',$where1, $join,$column,NULL,'news.id') ;	
			//$this->data['next']=$this->query_model->get_sql_select_data('news',$where1);	    
			
			$where2 = array("end_date <"=>$c);
			$join=array(array('table' => 'news_image',
							'condition' => 'news.id=news_image.news_id',
							'jointype' => 'left'));
	    
			$column=array('news.*','GROUP_CONCAT(image) as image');		
			$this->data['past'] = $this->query_model->get_joins('news',$where2, $join,$column,NULL,'news.id','start_date DESC') ;
			//$this->data['past']=$this->query_model->get_joins('news',$where2,NULL,NULL,NULL,NULL,'start_date DESC');
			return $this->data; 
		}else{
			// for upcomming data
			$where3 = array("start_date >"=>$c);
			$join=array(array('table' => 'news_image',
							'condition' => 'news.id=news_image.news_id',
							'jointype' => 'left'));
	    
			$column=array('news.*','GROUP_CONCAT(image) as image');		
			$this->data['next'] = $this->query_model->get_joins('news',$where3, $join,$column,NULL,'news.id') ;	
			// for past data
			$where4 = array("start_date <"=>$c);
			$join=array(array('table' => 'news_image',
							'condition' => 'news.id=news_image.news_id',
							'jointype' => 'left'));
	    
			$column=array('news.*','GROUP_CONCAT(image) as image');		
			$this->data['past'] = $this->query_model->get_joins('news',$where4, $join,$column,NULL,'news.id','start_date DESC') ;	
			
			return $this->data;
		}
	}

    public function index(){ 	   
	   $this->ex();	   	   
	   $this->layout->view('news_view',$this->data);	   
	}
	public function upcoming(){
		$this->ex();	   	
		$this->layout->view('news_upcoming',$this->data);	
	}
	public function past(){
		$this->ex(); 	
		$this->layout->view('news_past',$this->data);	
	}
	public function newsDetail(){
        $this->data['artist_news']= $this->query_model->get_sql_select_data('news',NULL,NULL,NULL,'start_date DESC');
        $this->layout->view('news_newsDetail',$this->data);	
            
        }


        public function pdf(){
		$this->data['pdf'] = $this->uri->segment(3);
		$this->layout->view('document',$this->data);
	}
	public function user_name($u_id){
		$where = array("ID"=>$u_id);
		$feild = array("ID","first_name");
		return $this->query_model->get_sql_select_data('user_profile',$where,$feild); 
	}
 }
