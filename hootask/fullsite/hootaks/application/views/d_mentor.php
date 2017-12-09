<?php
	$this->load->view('includes/header_session');
?>
<?php
	$this->load->view('includes/mentor_menu');
?>


<div class="container">
<div class="message" style="margin:0px auto;"><?php  if($this->session->flashdata('Logmsg'))   echo  $this->session->flashdata('Logmsg'); ?></div>

</div>
<?php
	$this->load->view('includes/footer_session');
?>

