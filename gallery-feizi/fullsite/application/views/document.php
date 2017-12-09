<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php

	$fileName = $pdf; 
	$title = $title;	 
	header("Pragma: public"); 
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("Cache-Control: private", false);
	header("Content-Type: application/pdf");
	header("Content-Description: File Transfer");
	header("Content-disposition: attachment; filename=".$title.".pdf");
	header("Content-Transfer-Encoding: binary");
	readfile("./uploads/pdf/".$fileName);
?> 
