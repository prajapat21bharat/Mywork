<?php
	$this->load->view('includes/header_session');
?>

<div class="container">
	
	<div class="inner_main">
		<table class="profile-candidate" cellpadding="5px" cellspacing="5px">
			<tr>
				<th class="tbl_add_cate" colspan="2" align="right"><label for=""><h4>Personal Details</h4></label></th>
			</tr>
			<tr>
				<td class="tbl_add_cate">
					<label for="name"></label>
						<img class="profile_image" src="<?php echo base_url().'/ast/uploads/'.$getprofile[0]['image'];?>" />
					<a href="">Add New Pic</a>
				</td>
			</tr>
			<tr>
				<td class="tbl_add_cate"><label for="name">Name</label></td><td class="tbl_add_cate"><?php echo $getprofile[0]['firstname']." ".$getprofile[0]['lastname']?></td>
			</tr>
			<tr>
				<td class="tbl_add_cate"><label for="email">Email</label></td><td class="tbl_add_cate"><?php echo $getprofile[0]['email'];?></td>
			</tr>
			</tr>
			<tr>
				<td class="tbl_add_cate"><label for="gender">Gender</label></td><td class="tbl_add_cate"><?php echo ucwords($getprofile[0]['gender']);?></td>
			</tr>			
			<tr>
				<td class="tbl_add_cate"><label for="contactno">Contact No</label></td><td class="tbl_add_cate"><?php echo $getprofile[0]['contact'];?></td>
			</tr>
			<tr>
				<td class="tbl_add_cate" colspan="2" align="right"><a href="">Edit</a></td>
			</tr>
		</table>
	</div>
	
	<!----------------------------------------------------------------------------------------------->
	<div class="inner_main">
		<table class="profile-candidate" cellpadding="5px" cellspacing="5px">
			<tr>
				<th class="tbl_add_cate" colspan="2" align="right"><label for=""><h4>Work Details</h4></label></th>
			</tr>
			<tr>
				<td class="tbl_add_cate">
					<label for="name"></label>
						<img class="profile_image" src="<?php echo base_url().'/ast/uploads/'.$getprofile[0]['image'];?>" />
					<a href="">Add New Pic</a>
				</td>
			</tr>
			<tr>
				<td class="tbl_add_cate"><label for="name">Name</label></td><td class="tbl_add_cate"><?php echo $getprofile[0]['firstname']." ".$getprofile[0]['lastname']?></td>
			</tr>
			<tr>
				<td class="tbl_add_cate"><label for="email">Email</label></td><td class="tbl_add_cate"><?php echo $getprofile[0]['email'];?></td>
			</tr>
			</tr>
			<tr>
				<td class="tbl_add_cate"><label for="gender">Gender</label></td><td class="tbl_add_cate"><?php echo ucwords($getprofile[0]['gender']);?></td>
			</tr>			
			<tr>
				<td class="tbl_add_cate"><label for="contactno">Contact No</label></td><td class="tbl_add_cate"><?php echo $getprofile[0]['contact'];?></td>
			</tr>
			<tr>
				<td class="tbl_add_cate" colspan="2" align="right"><a href="">Edit</a></td>
			</tr>
		</table>
	</div>
</div>

<?php
	$this->load->view('includes/footer_session');
?>


