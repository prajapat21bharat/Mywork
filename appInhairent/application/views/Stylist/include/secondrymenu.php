	<div class="container clear_both padding_fix">
		<div class="row">
			<div class="col-md-9 col-sm-12 col-xs-12 left-space-r">
				<div class="block-web">
					<h2>Dashboard</h2>
					<?php
						if (isset($message))
						{
							echo $message;
						}
					?>
					<div class="panel-body">
						<ul id="myTab" class="nav nav-tabs">
							<li class="active">
								<a href="<?php echo site_url('stylist/viewprofile');?>" data-toggle="tab">Profile</a>
							</li>
							<li>
								<a href="<?php echo site_url('stylist/viewprofile');?>" data-toggle="tab">Clients</a>
							</li>
							<li>
								<a href="<?php echo site_url('stylist/viewprofile');?>" data-toggle="tab">Manage client</a>
							</li>
							<li>
								<a href="#profile" data-toggle="tab">Booking</a>
							</li>
							<li>
								<a href="#profile" data-toggle="tab">Email</a>
							</li>
							<li>
								<a href="#profile" data-toggle="tab">Products</a>
							</li>
						</ul>
						
