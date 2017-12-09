<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<link rel="stylesheet" href="<?php echo base_url('assets/css/jquery.datepick.css') ?>">
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.datepick.js') ?>"></script>

<div class="container-fluid content-wrapper cluster_container mob-right-part span10">
  <div class="hero-unit">   
      <h3 class="title">Home Slider</h3>
	    	    
   
  <div class="success_msg"> 
    <?php if(!empty($success)){
           echo $success;
	       } ?>
	 <?php echo $this->session->flashdata('work_msg');?>      
  </div>               

<!---its is a Profile EDIT Div---> 
  

<form onsubmit="return checktrustedbyadd()" action="<?php echo site_url() . 'admin/home/home_slider' ?>" method="post" class="trainersc_form inform trusted-by" enctype="multipart/form-data" >
                        <ul class="list_block trusted-block">
                            <li>
                                <div class="left_label col-lg-2 col-sm-3 col-md-2 col-xs-5">
                                    <p>Upload Image :</p>
                                </div>
                                <!--div class="center_colon col-md-1">
                                  <p>:</p>
                                </div-->
                                <div class="right_ans col-lg-10 col-sm-9 col-md-10 col-xs-7">
                                    <p><input class="" required="required" title="hello" accept="image/*" type="file" id="r_profimg" name="slide_image" value="" /></p>
                                </div>
                            </li>
                          
                           
                            <li> 
                                <div align="center" class="controls">
                                    <input class="btn btn-success" type="submit" value="Add New" name="submit" /></div></li>
                        </ul>
                    </form>       
   

   </div>   
    <div class="home-slids"><?php
 foreach ($home_slider as $slide){
     
     //print_r($slide->slide_image); ?>
        <div id="delete_<?php echo $slide->slide_id; ?>">
     <div class="col-lg-3 col-sm-3 bottom"><img alt="image01" src="<?php echo base_url() . 'uploads/profile/' . $slide->slide_image ?>" height="200" width="300">
     <div  class="edt" style="margin-left: 5px;">
		<div class="col-lg-12">
			<?php
			$delete = "logo_delete(" . $slide->slide_id . ")";
			echo "<span class='btn btn-danger' onclick='" . $delete . "'>Delete</span>";
			?>
		</div>
	</div>
     
     
     </div>
      
     </div>
     
    <?php 
 }
    
    
    ?></div>
 </div>
<script>
     function logo_delete(id) {
        var r = confirm("Are you sure,You want to delete this logo..!");
        if (r == false) {
            return false;
        }

        var user_data = {slide_id: id};
//alert(id);
        $.ajax({
            url: 'http://www.gallery-feizi.com/index.php/admin/home/homeslide_delete',
            data: user_data,
            type: 'post',
            datatype: 'json',
            success: function(data) {
                if (data == "1") {
                    $('#delete_' + id).remove();
                    $("#success_delete_user").css("display", "block", "color", "red");
                    document.getElementById("success_delete_user").innerHTML = "<p style='color:red'>You have successfully delete logo...!</p>";
                }
            }
        });
    }
    </script>

 </body>
</html>
