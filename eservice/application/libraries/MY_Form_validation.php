<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation
{
	/*
	function __construct($rules=array())
	{
		
	}
*/	
	public function get_errors_as_array()
	{
		return $this->_error_array;
	}

	public function get_config_rules()
	{
		return $this->_config_rules;
	}

	public function get_field_names($form)
	{
		$field_names=array();
		$rules=$this->get_config_rules();
		
		$rules=$rules[$form];
		//print_r($rules);
		foreach($rules as $index=>$info)
		{
			$field_names[]=$info['field'];
		}
		return $field_names;
	}
}
