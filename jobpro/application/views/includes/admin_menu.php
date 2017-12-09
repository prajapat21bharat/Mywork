<?php
	$segment = $this->uri->segment(2);
	if($segment=="newcategory")
	{
		$newcategory="cur-node";
	}
	else
	{
		$newcategory="";
	}
	
	if($segment=="company")
	{
		$company="cur-node";
	}
	else
	{
		$company="";
	}
	
	if($segment=="add_language")
	{
		$add_language="cur-node";
	}
	else
	{
		$add_language="";
	}
	
	if($segment=="users")
	{
		$users="cur-node";
	}
	else
	{
		$users="";
	}
	
	if($segment=="changepassword")
	{
		$changepassword="cur-node";
	}
	else
	{
		$changepassword="";
	}
?>

<div class="container">
				<div class="menu">
					<ul>
						<a class="test"  href="<?php echo site_url()?>/admin/newcategory"><li class="<?php echo $newcategory ?>">Add Category</li></a>
						<a class="test" href="<?php echo site_url()?>/admin/company"><li class="<?php echo $company ?>">Add Company</li></a>
						<a class="test" href="<?php echo site_url()?>/admin/add_language"><li class="<?php echo $add_language ?>">Add Language</li></a>
						<a class="test" href="<?php echo site_url()?>/admin/users"><li class="<?php echo $users ?>">Users</li></a>
						<a class="test" href="<?php echo site_url()?>/admin/changepassword"><li class="<?php echo $changepassword ?>">Change Password</li></a>
						
					</ul>
				</div>
				<!----------------- Menu Ends Here ------------------------>
			</div>

