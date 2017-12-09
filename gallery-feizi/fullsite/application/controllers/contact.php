<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Installation script for
 *
 * @author NTF Module Generator
 */
class Contact extends MY_Controller {
	
	public $data 	= 	array();
	public function __construct()
	{
		parent::__construct();
		$this->load->model('query_model');		
	}
	
   public function index(){    
	   $this->data['contact_data'] = $this->query_model->get_sql_select_data_ajax('contact');
	   $this->layout->view('contact',$this->data);	   
	}

 }
