<?php
	$this->load->view('includes/loggedin_header');
?>
        
<div class="contentpanel" >
<?php
	//$this->load->view('Stylist/include/subscribe_block');
?>
	<div class="container clear_both padding_fix top_space">
		<div class="row">
			<div class="col-lg-9 col-md-12 col-sm-12 col-xs-12 left-space-r">
				<div class="block-web">
					<h2><?php $this->load->view('Stylist/include/user'); ?></h2>
					<?php
						if (isset($message))
						{
							echo $message;
						}
					?>
					<div class="panel-body">
						<?php $this->load->view('Stylist/include/tabbedmenu'); ?>
						
						<div id="myTabContent" class="tab-content">
							<!----Section for Main content start ---->
							
							<!----Section for Main content start ---->
						</div>
					</div>
				</div>
			</div>
			<!-- /. ROW  -->
<?php
	$this->load->view('Stylist/include/right_bar');
?>
		</div>
	</div>

<!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER  -->
<?php
	$this->load->view('includes/footer');
?>
