<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$config=array(
		'visa_get'=>array(
			array('field'=>'firstname','label'=>'Firstname','rules'=>'required'),
			array('field'=>'lastname','label'=>'Lastname','rules'=>'required'),
			array('field'=>'email','label'=>'email','rules'=>'required'),
			array('field'=>'contactno','label'=>'Mobile Number','rules'=>'required'),
			array('field'=>'t_journey_date','label'=>'Tentative Journey Date','rules'=>'required'),
			array('field'=>'country_from','label'=>'Country From','rules'=>'required'),
		),
		'contact_get'=>array(
			array('field'=>'name','label'=>'Name','rules'=>'required'),
			array('field'=>'email','label'=>'Email','rules'=>'required'),
			array('field'=>'contactno','label'=>'Mobile Number','rules'=>'required'),
			array('field'=>'message','label'=>'Message ','rules'=>'required'),
			),
		'request_get'=>array(
			array('field'=>'name','label'=>'Name','rules'=>'required'),
			array('field'=>'email','label'=>'Email','rules'=>'required'),
			array('field'=>'contactno','label'=>'Mobile Number','rules'=>'required'),
			array('field'=>'country','label'=>'Country ','rules'=>'required'),
			),
		'image_get'=>array(
			array('field'=>'image','label'=>'Image','rules'=>'required'),
			),
);


?>
