<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title>team</title>
<link rel="stylesheet" href="<?php echo base_url()?>ast/css/style.css" />
<link rel="stylesheet" href="<?php echo base_url()?>ast/css/jobprostyle.css" />
<link rel="stylesheet" href="<?php echo base_url()?>ast/css/popup_form.css" />
<link rel="stylesheet" href="<?php echo base_url()?>ast/css/form_css.css" />
<link rel="stylesheet" href="<?php echo base_url()?>ast/css/editform.css" />

<!--bootstrap css and js-->
<link rel="stylesheet" href="<?php echo base_url()?>ast/css bootstrap/bootstrap.css" />
<link rel="stylesheet" href="<?php echo base_url()?>ast/css bootstrap/bootstrap.min.css" />
<link rel="stylesheet" href="<?php echo base_url()?>ast/css bootstrap/bootstrap-theme.css" />
<link rel="stylesheet" href="<?php echo base_url()?>ast/css bootstrap/bootstrap-theme.min.css" />

<script src="<?php echo base_url()?>ast/js bootstrap/bootstrap.js" /></script>
<script src="<?php echo base_url()?>ast/js bootstrap/bootstrap.min.js" /></script>
<script src="<?php echo base_url()?>ast/js bootstrap/npm.js" /></script>


<script src="<?php echo base_url()?>ast/jquery-1.9.1.js" /></script>
<script src="<?php echo base_url()?>ast/jquery.validate.min.js" /></script>
<script src="<?php echo base_url()?>ast/jquery-1.8.2.js" /></script>


<!--bootstrap css and js end-->
</head>
	<body>
		<header>
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<div class="header">
							<?php $getdata=array('id'=>$this->session->userdata('id'),);$getprofile = $this->user_model->get_sql_select_data('registration', $getdata); $role=trim(ucwords(strtolower($getprofile[0]['user_type']))); ?>
							<div class="logo">
								<a href="<?php 	if($role=="Admin"){ echo site_url().'/admin/dashboard';}
												if($role=="Mentor"){ echo site_url().'/mentor/dashboard';}
												if($role=="Jobseeker"){ echo site_url().'/dashboard/';}?>">
												<img src="<?php echo base_url()?>ast/images/logo1.png" class="img-responsive" /></a>
							</div>
								<div class="logout">
									
									<ul>
										<li><label for="user" class="user">Hi, <?php echo $getprofile[0]['firstname'];;?></label><?php ?></li>
										<li><a href="<?php 	if($role=="Admin"){ echo site_url().'/admin/profile';}
															if($role=="Mentor"){ echo site_url().'/mentor/profile';}
															if($role=="Jobseeker"){ echo site_url().'/dashboard/profile';}?>">
															<img src="<?php echo base_url().'/ast/images/uploads/userpic/'.$getprofile[0]['image'];?>" class="img-responsive" /></a></li>
										<li><a href="<?php 	if($role=="Admin"){ echo site_url().'/admin/profile';}
															if($role=="Mentor"){ echo site_url().'/mentor/profile';}
															if($role=="Jobseeker"){ echo site_url().'/dashboard/profile';}?>">Profile</a></li>
										<li><a href="<?php echo site_url()?>/login/logout">Logout</a></li>
									</ul>
								</div>
						</div>
					</div>
				</div>
			</div>
		</header>
		<section>
				
				<!------------------ Menu Start from here ----------------------->
