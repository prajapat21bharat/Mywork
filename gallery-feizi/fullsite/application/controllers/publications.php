<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Installation script for
 *
 * @author NTF Module Generator
 */
class Publications extends MY_Controller {
	
	public $data 	= 	array();
	public function __construct()
	{
		parent::__construct();
		$this->load->model('query_model');		
	}
	
    public function index(){ 	   
	   $this->data['publications'] = $this->query_model->get_sql_select_data('publications');	   	   
	   $this->layout->view('publications_view',$this->data);	   
	}
	public function press(){
		
		$join=array(array('table' => 'press_image',
						'condition' => 'press.id=press_image.press_id',
						'jointype' => 'left'));
	
		$column=array('press.*','GROUP_CONCAT(image) as image');		
		$this->data['press'] = $this->query_model->get_joins('press',NULL, $join,$column,NULL,'press.id','start_date DESC') ;	
		//$this->data['press']=$this->query_model->get_joins('press',NULL,NULL,NULL,NULL,NULL,'start_date DESC');	   	
		$this->layout->view('publications_press',$this->data);	
	}
	public function pdf(){
		$this->data['pdf'] = $this->uri->segment(4);
		$this->data['title'] = $this->uri->segment(3);
		$this->layout->view('document',$this->data);
	}	
	
 }
