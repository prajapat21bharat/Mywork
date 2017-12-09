<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$config=array(
		'register_get'=>array(
			array('field'=>'firstname','label'=>'Firstname','rules'=>'required'),
			array('field'=>'lastname','label'=>'Lastname','rules'=>'required'),
			array('field'=>'email','label'=>'email','rules'=>'required'),
			array('field'=>'contactno','label'=>'Mobile Number','rules'=>'required'),
			array('field'=>'password','label'=>'Password','rules'=>'required'),
		),

		'visa_post'=>array(
			array('field'=>'firstname','label'=>'Firstname','rules'=>'required'),
			array('field'=>'lastname','label'=>'Lastname','rules'=>'required'),
			array('field'=>'email','label'=>'email','rules'=>'required'),
			array('field'=>'contactno','label'=>'Mobile Number','rules'=>'required'),
			array('field'=>'t_journey_date','label'=>'Tentative Journey Date','rules'=>'required'),
			array('field'=>'country_from','label'=>'Country From','rules'=>'required'),
		),

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
		'content_get'=>array(
			array('field'=>'mid','label'=>'Menu Id','rules'=>'required'),
			),
		'service_content_get'=>array(
			array('field'=>'ss_id','label'=>'Sub Service Id','rules'=>'required'),
			),
		'm_sub_services_get'=>array(
			array('field'=>'s_id','label'=>'Service Id','rules'=>'required'),
			),
		'image_get'=>array(
			array('field'=>'image','label'=>'Image','rules'=>'required'),
			),
		'login_get'=>array(
			array('field'=>'contactno','label'=>'Contact No.','rules'=>'required'),
			array('field'=>'password','label'=>'Password','rules'=>'required'),
			),
		'sendmail_get'=>array(
			array('field'=>'contactno','label'=>'Contact No.','rules'=>'required'),
			),
);


?>
