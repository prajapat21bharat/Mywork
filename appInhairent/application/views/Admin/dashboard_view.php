<?php
	$this->load->view('includes/admin_header');
	//echo"<pre>";print_r($this->session->userdata());
?>
        
        
<div class="contentpanel" >
	<div class="container clear_both padding_fix">
		<div class="row">
			<div class="col-sm-12 col-xs-12 left-space-r">
				<div class="block-web">
                     <h2>Dashboard</h2>   
                        <h5>Welcome <b><?php print(ucwords($this->session->userdata('firstname'))); ?></b> , Love to see you back. </h5>
                    </div>
                </div>
                </div>
                 <!-- /. ROW  -->
                 
			</div>
             <!-- /. PAGE INNER  -->
		</div>
         <!-- /. PAGE WRAPPER  -->
<?php
	$this->load->view('includes/footer');
?>
