 
    
  </div>
  <!--\\\\\\\ inner end\\\\\\-->
</div>
<!--\\\\\\\ wrapper end\\\\\\-->

 
      



    
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/js/common-script.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.slimscroll.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jPushMenu.js"></script> 
<link href="<?php echo base_url();?>assets/css/all.css" rel="stylesheet">





      <!-- CUSTOM SCRIPTS -->
    <script src="<?php echo base_url();?>assets/js/custom.js"></script>
    
      <!-- Browser.js SCRIPTS -->
    <script src="<?php echo base_url();?>assets/js/browser.js"></script>
    
    <!--<script src="<?php echo base_url();?>assets/js/jquery.isotope.js"></script> -->

<!------ Fancybox ------->
<!------ 		<script src="<?php echo base_url();?>assets/js/fancybox/jquery.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/fancybox/jquery.fancybox.js"></script>
		
<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery(".fancybox").fancybox();
	});
</script>
-->
             <!-- DATA TABLE SCRIPTS -->
    <script src="<?php echo base_url();?>assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="<?php echo base_url();?>assets/js/dataTables/dataTables.bootstrap.js"></script>
    <script>
    /* for ajax table search on view pages*/

$(document).ready(function () {
   $('#dataTables-example').dataTable();
});

    </script>
    <!-----------------Jcarosel Slider--------------------->
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/jcarosel/jquery.jcarousel.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/jcarosel/jcarousel.responsive.js"></script>
        
        <!--------------------Auto Complete------------------------>
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.autocomplete.js"></script>
        <!--<script type="text/javascript" src="<?php // echo base_url();?>assets/js/jquery-ui.js"></script> -->
	
		
    <script>
		function doconfirm()
		{
			contact=confirm("Are you sure you want to delete?");
			if(contact!=true)
			{
				return false;
			}
		}
	</script>
    
    <script>
		     function readURL(input) {
		 //alert('ok');
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#img_avtar')
                        .attr('src', e.target.result)
                        .width(100)
                        .height(100);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
        
        jQuery(document).ready(function(){
			jQuery("#img_avtar").click(function () {
					jQuery("#pic").click();
				});
			})
	jQuery(document).ready(function(){
		jQuery("#pic").change(function(){
			readURL(this);
	})
})

    </script>
</body>
</html>
