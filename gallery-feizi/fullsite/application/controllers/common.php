<?php if (!defined('BASEPATH')) die();
class Common extends MY_Controller {
	 
	public function __construct()
	{		 
		parent::__construct();	 
	}
	public function download_pdf(){
		
		//header("Content-disposition: attachment; filename=document.pdf");
	 //header("Content-type: application/pdf");
	 //readfile("./assets/pdf/document.pdf"); 
	 $file_name = $this->uri->segment(4);
	 header('Pragma: public'); 	// required
	header('Expires: 0');		// no cache
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	
	header('Cache-Control: private',false);
	header('Content-Type: application/pdf');
	header('Content-Disposition: attachment; filename="'.basename("./assets/pdf/document.pdf").'"');
	header('Content-Transfer-Encoding: binary');
	header('Content-Length: '.filesize("./assets/pdf/document.pdf"));	// provide file size
	header('Connection: close');
	readfile("./assets/pdf/document.pdf");
	 
	}

}

 
