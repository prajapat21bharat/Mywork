<?php
	$sessionid=$this->session->userdata('id');
	$data['username']=$this->user_model->get_joins('tbl_user', array('id'=>$sessionid));
	//print_r($data['username']);
?>
Hello, <?php print $data['username'][0]['firstname'].' '.$data['username'][0]['lastname']?>
