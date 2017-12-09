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
	
	if($segment=="childcategory")
	{
		$add_child="cur-node";
	}
	else
	{
		$add_child="";
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

		<nav class="navigation ">
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						
                         <a class="test col-xs-3 col-sm-3 col-md-3 <?php echo $card ?>" href="<?php echo site_url()?>admin/card"><span class="ad">Add A Pack</span></a>
						<a class="test col-xs-3 col-sm-3 col-md-3 <?php echo $newcategory ?>"  href="<?php echo site_url()?>admin/addcategory"><span class="ad">Add Category</span></a>			
						<a class="test col-xs-3 col-sm-3 col-md-3 <?php echo $add_language ?>" href="<?php echo site_url()?>admin/subcategory"><span class="ad">Add Sub-Category</span></a>
						<a class="test col-xs-3 col-sm-3 col-md-3 <?php echo $add_child ?>" href="<?php echo site_url()?>admin/childcategory"><span class="ad">Add Child-Category</span></a>
							
				</div>
			</div>
		</nav>

<div class="container">
				<div class="menu">
					<ul>
                    <div class="col-xs-12 col-sm-12 col-md-12"> 
						
                       </div> 
                        
<!--						<a class="test" href="<?php echo site_url()?>/admin/users"><li class="<?php //echo $users ?>">Users</li></a>
						<a class="test" href="<?php echo site_url()?>/admin/changepassword"><li class="<?php //echo $changepassword ?>">Change Password</li></a>-->
						
					</ul>
				</div>
				<!----------------- Menu Ends Here ------------------------>
			</div>

