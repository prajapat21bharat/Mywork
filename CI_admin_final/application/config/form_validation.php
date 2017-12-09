<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$config=array(
		'register'=>array(
			array('field'=>'firstname','label'=>'Firstname','rules'=>'required'),
			array('field'=>'lastname','label'=>'Lastname','rules'=>'required'),
			array('field'=>'dob','label'=>'Date of Birth','rules'=>'required'),
			array('field'=>'gender','label'=>'Gender','rules'=>'required'),
			array('field'=>'email','label'=>'Email','rules'=>'required|trim'),
			array('field'=>'contactno','label'=>'Mobile Number','rules'=>'required'),
			array('field'=>'password','label'=>'Password','rules'=>'required|trim|matches[re_password]'),
			array('field'=>'re_password','label'=>'Confirm Password','rules'=>'required|trim|matches[re_password]'),
		),
		'login'=>array(
			array('field'=>'email','label'=>'Email','rules'=>'required|trim'),
			array('field'=>'password','label'=>'Password','rules'=>'required|trim'),
		),
		'forget'=>array(
			array('field'=>'email','label'=>'Email','rules'=>'required|trim'),
		),
		'reset'=>array(
			array('field'=>'password','label'=>'Password','rules'=>'required|trim|matches[re_password]'),
			array('field'=>'re_password','label'=>'Confirm Password','rules'=>'required|trim|matches[re_password]'),
		),


);


?>
