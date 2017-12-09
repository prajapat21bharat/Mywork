<?php
	$segment = $this->uri->segment(2);
	if($segment=="addcategory")
	{
		$newcategory="cur-node";
	}
	else
	{
		$newcategory="";
	}
	
	if($segment=="card")
	{
		$card="cur-node";
	}
	else
	{
		$card="";
	}
	
	if($segment=="subcategory")
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
						<a class="test" href="<?php echo site_url()?>/admin/card"><li class="<?php echo $card ?>">Add A Pack</li></a>
						<a class="test"  href="<?php echo site_url()?>/admin/addcategory"><li class="<?php echo $newcategory ?>">Add Category</li></a>			
						<a class="test" href="<?php echo site_url()?>/admin/subcategory"><li class="<?php echo $add_language ?>">Add Sub-Category</li></a>
<!--						<a class="test" href="<?php echo site_url()?>/admin/users"><li class="<?php //echo $users ?>">Users</li></a>
						<a class="test" href="<?php echo site_url()?>/admin/changepassword"><li class="<?php //echo $changepassword ?>">Change Password</li></a>-->
						
					</ul>
				</div>
				<!----------------- Menu Ends Here ------------------------>
			</div>

