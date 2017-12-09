<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $site=site_url().'admin/register/'; ?>
<script type="text/javascript">

$(document).ready(function () {
  $('.preview2').on("click", function (e) {
    e.preventDefault(); // avoids calling preview.php
    $.ajax({
      type: "POST",
      cache: false,
      url: this.href, // preview.php
      data: $("#postp").serializeArray(), // all form fields
      success: function (data) {
        // on success, post (preview) returned data in fancybox
        $.fancybox(data, {
          // fancybox API options
          fitToView: false,
          width: 'auto',
          height: 'auto',
          autoSize: true,
          closeClick: false,
          openEffect: 'none',
          closeEffect: 'none'
        }); // fancybox
      } // success
    }); // ajax
  }); // on
}); // ready


function check_owner(){
	
	parent.$.fancybox.open({href : "<?php echo site_url().'admin/register/popup';?>" , type: 'ajax',height: 800, width: 500,scrolling : 'no'});
	
	}

<?php if(!empty($success)){ ?>
parent.$.fancybox.close();
window.location.reload();

<?php } ?>

</script>

<div class="hero-unit">
<div class="chang-pass">
  <h3>Owner Registration</h3>
  </div>
  <div class="">
  
  <form id="postp">
   <div class="wit">
    <label>User Name </label>
    <input type="text" id="user_name" name="user_name" value="<?php echo set_value('user_name'); ?>"/>
    <?php echo form_error('user_name'); ?>
    </div>
    
     
	<div class="login_button">
    <a class="preview2" href="<?php echo site_url().'admin/register/popup';?>"><input type="button" value="Register" class="login-btn " /></a>
    </div>
   </form>
  </div>
</div>
