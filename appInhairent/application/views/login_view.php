<?php
	$this->load->view('includes/header');
?>
        
        
<div class="contentpanel page-login" >
	<div class="container clear_both padding_fix">
		<div class="row">
			<div class="col-sm-12 col-xs-12 left-space-r">
				<div class="block-web">
                    	
                     <h2>Sign In</h2>
                     <?php
						if (isset($message))
						{
							echo $message;
						}
                     ?>
                      <div class="message" style="margin:0px auto;"><?php  if($this->session->flashdata('Logmsg'))   echo  $this->session->flashdata('Logmsg'); ?></div>
						<div class="clearfix"></div>
						<form method="post" action="<?php echo site_url('account/login');?>">

							<div class="form-group">

								<label for="inputEmail">Email <span class="mandetory"> *</span></label>

								<input type="text" name="email" value="<?php echo set_value('email'); ?>" class="form-control login-input" id="inputEmail" placeholder="Email" onblur="this.placeholder = 'Email'" onfocus="this.placeholder = ''">

							</div>

							<div class="form-group">

								<label for="inputPassword">Password <span class="mandetory"> *</span></label>

								<input type="password" name="password" value="" class="form-control login-input" id="inputPassword" placeholder="Password" onblur="this.placeholder = 'Password'" onfocus="this.placeholder = ''">

							</div>

							<!--<div class="checkbox">

								<label><input type="checkbox" name="rememberme" class="login-input-chkbox" value="1"> 
								<span class="checkbox"></span>
								Remember me</label>

							</div>-->
							<input type="submit" name="signin" class="btn-black-small square-btn-adjust login-input-bttn" value="Sign In">
						</form>


                    </div>
                    </div>
                </div>
                </div>
                 <!-- /. ROW  -->
                 
			</div>
             <!-- /. PAGE INNER  -->
		</div>
         <!-- /. PAGE WRAPPER  -->
<?php
	$this->load->view('includes/footer');
?>
