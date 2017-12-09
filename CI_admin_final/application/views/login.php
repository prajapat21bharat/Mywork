
<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Material Design Login Form</title>

       <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css')?>">

  </head>

  <body>
		<hgroup>
		  <h1>Material Design Form</h1>
		  <h3>By Josh Adamous</h3>
		</hgroup>
		<form class="login" action="<?php echo site_url('login');?>" method="post">
			<div class="message" style="margin:0px auto;">
				<?php  if($this->session->flashdata('Logmsg'))
						echo  $this->session->flashdata('Logmsg');
				?>
			</div>
		  <div class="group">
			<input type="text" name="email"><span class="highlight"></span><span class="bar"></span>
			<label>Email</label>
			<?php echo form_error('email'); ?>
		  </div>
		  <div class="group">
			<input type="password" name="password" ><span class="highlight"></span><span class="bar"></span>
			<label>Password</label>
			<?php echo form_error('password'); ?>
		  </div>
		  <button type="submit" class="button buttonBlue" name="login">Login
			<div class="ripples buttonRipples"><span class="ripplesCircle"></span></div>
		  </button>
		</form>
		<footer><a href="http://www.polymer-project.org/" target="_blank"><img src="https://www.polymer-project.org/images/logos/p-logo.svg"></a>
		  <p>You Gotta Love <a href="http://www.polymer-project.org/" target="_blank">Google</a></p>
		</footer>
	<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
	<script src="<?php echo base_url('assets/js/index.js')?>"></script>
  </body>
</html>
