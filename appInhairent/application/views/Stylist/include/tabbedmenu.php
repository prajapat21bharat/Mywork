	<?php
				$segment=$this->uri->segment(2);
				
				if($segment=="viewprofile")
				{
					$viewprofile="active";
				}
				else
				{
					$viewprofile="";
				}
				
				if($segment=="viewclient")
				{
					$viewclient="active";
				}
				else
				{
					$viewclient="";
				}
				
				if($segment=="addclient")
				{
					$addclient="active";
				}
				else
				{
					$addclient="";
				}
				
				if($segment=="manageclient")
				{
					$manageclient="active";
				}
				else
				{
					$manageclient="";
				}
				
				if($segment=="add_booking")
				{
					$add_booking="active";
				}
				else
				{
					$add_booking="";
				}
				
				if($segment=="edit_booking")
				{
					$edit_booking="active";
				}
				else
				{
					$edit_booking="";
				}
				
				if($segment=="viewproducts")
				{
					$viewproducts="active";
				}
				else
				{
					$viewproducts="";
				}
				
				if($segment=="sendmail")
				{
					$sendmail="active";
				}
				else
				{
					$sendmail="";
				}
				
				if($segment=="communications")
				{
					$communications="active";
				}
				else
				{
					$communications="";
				}
				
				if($segment=="communication")
				{
					$communication="active";
				}
				else
				{
					$communication="";
				}
				
				if($segment=="sent_mails")
				{
					$sent_mails="active";
				}
				else
				{
					$sent_mails="";
				}
				
				if($segment=="message")
				{
					$message="active";
				}
				else
				{
					$message="";
				}
				
				
				/*Hiding menu as per package*/
				if($this->session->userdata('package')=="DELUXE")
				{
					$style="display:none";
				}
				else
				{
					$style="";
				}
			?>
						<ul id="myTab" class="nav nav-tabs">
							<li class="<?php print $viewprofile; ?>">
								<a href="<?php echo site_url('stylist/viewprofile');?>">Profile</a>
							</li>
							<li class="<?php print $manageclient; print $addclient; print $viewclient; ?>">
								<a href="<?php echo site_url('stylist/viewclient');?>" >Clients</a>
							</li>
							
							<li class="<?php print $add_booking; print $edit_booking; ?>">
								<a href="<?php echo site_url('stylist/add_booking');?>" >Booking</a>
							</li>
							<li class="<?php print $sendmail; print $sent_mails; print $message; print $communications; print $communication; ?>">
								<a href="<?php echo site_url('stylist/sendmail'); ?>" >Email</a>
							</li>
							<li class="<?php print $viewproducts; ?>" style="<?php print $style; ?>">
								<a href="<?php echo site_url('stylist/viewproducts');?>" >Products</a>
							</li>
						</ul>
