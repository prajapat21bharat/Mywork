<?php
	$segment = $this->uri->segment(2);
	if($segment=="add_appoinment")
	{
		$appoinment="cur-node";
	}
	else
	{
		$appoinment="";
	}
?>
<div class="container">
				<div class="menu">
					<ul>
						<a class="test"  href="<?php echo site_url()?>/mentor/add_appoinment/"><li class="<?php echo $appoinment ?>">Profile</li></a>

					</ul>
				</div>
				<!----------------- Menu Ends Here ------------------------>
			</div>

