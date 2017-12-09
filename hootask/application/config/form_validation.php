<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$config=array(
		'isuser_get'=>array(
			array('field'=>'class','label'=>'class','rules'=>'required'),
		),
		'isuser_post'=>array(
			array('field'=>'class','label'=>'class','rules'=>'required'),
		),
		'packofcards_get'=>array(
			array('field'=>'packid','label'=>'packid','rules'=>'required'),
		),
		'getsub_category_get'=>array(
			array('field'=>'cate_id','label'=>'Category id','rules'=>'required'),
		),
		'child_category_get'=>array(
			array('field'=>'subcate_id','label'=>'Sub Category id','rules'=>'required'),
		),
		'getpackbychildcate_get'=>array(
			array('field'=>'child_id','label'=>'Child Category id','rules'=>'required'),
		),
		'getquestionsbychild_cate_get'=>array(
			array('field'=>'child_id','label'=>'Child Category id','rules'=>'required'),
		),
		'getquestions_get'=>array(
			array('field'=>'packid','label'=>'pack id','rules'=>'required'),
		),
		'getcardimagesbypackid_get'=>array(
			array('field'=>'pack_id','label'=>'pack id','rules'=>'required'),
		),
		'search_get'=>array(
			array('field'=>'keyword','label'=>'Search Keyword','rules'=>'required'),
		),
);


?>
