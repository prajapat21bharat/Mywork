<?php
	$this->load->view('includes/admin_header');
	//echo"<pre>";print_r($allimages);exit;
?>
        
        
<div class="contentpanel" >
	<div class="container clear_both padding_fix">
		
		<div class="row">
			<div class="col-sm-12 col-xs-12 left-space-r">
				<div class="breadcrums">
					<span>Stylists > </span>
					<a href="<?php echo site_url('admin/viewstylist') ?>">All Stylists > </a>
					<a href="<?php echo site_url()?>admin/publicimages/<?php print @$all_p_images[0]['user_id']; ?>">View Public Image </a>
				</div>
				<div class="ad-haeding">

					<h2>Stylists</h2>
					<?php
						if (isset($message))
						{
							echo $message;
						}
					 ?>
					 <div class="message" style="text-align: center; width: 100%;"><?php  if($this->session->flashdata('Logmsg'))   echo  $this->session->flashdata('Logmsg'); ?></div>
				</div>
                    </hr>
			</div>
		</div>
                 <!-- /. ROW  -->
               
			<!--Row start-->
			<div class="row">
				<div class="col-md-12">
					<!-- Advanced Tables -->
					<div class="panel panel-default">
						<div class="panel-body">
						<?php
							if(!empty($all_p_images))
							{
						?>
							<div class="feature-data">
								<p class="col-sm-12">Stylist Name : </span><span class="stylistname"><strong><?php echo $all_p_images[0]['firstname'].' '.$all_p_images[0]['lastname'] ?></strong></p>
								
								<form method="post" action="<?php echo site_url('admin/delete_public')?>" >
									<div class="col-sm-3">
										<label for="all_del_pic">
											<input type="checkbox" name="all_del_pic" value="" id="all_del_pic" />
											<span class="checkbox"></span>
											<strong>Select All </strong>
										</label>
									</div>
									<div class="col-sm-9">
										<input type="hidden" name="s_uid" value="<?php print @$all_p_images[0]['user_id']; ?>" >
										<input type="submit" name="delete_public" value="Delete" >
									</div>
									<div class="clearfix"></div>
								 <?php
									 $base_url=base_url('assets/uploads/thumbnails/244x244/');
									 $count=0;
									 foreach($all_p_images as $images)
									 {
										 if($count%2==0)
										 {
										$class="even";	 
										}
										else
										{
											$class="odd";
										}
										 echo"<div id='test-wrap' class='$class'>";
										if(!empty($images))
										{
											$imgarr=explode(',',$images['photos']);
											$i=0;
											foreach($imgarr as $imgarr)
											{
										?>		
											<div id="img-<?php echo $images['id'] ?>" class="col-sm-4 ">
												<a class="fancybox" rel="group" href="<?php print base_url('assets/uploads/thumbnails/600x600/'.$imgarr); ?>" /></a>
													<label for="delpic-<?php echo $images['id'].$i; ?>">
														<img src="<?php echo $base_url."/".$imgarr ?>" data-id='<?php echo $images['id']; ?>' width="150" height="150" alt=""/>
														<input type="checkbox" name="del_pic[]" <?php echo set_checkbox('del_pic[]', $images['id'].'^'.$i.'^'.$imgarr); ?> value="<?php echo $images['id'].'^'.$i.'^'.$imgarr; ?>" id="delpic-<?php echo $images['id'].$i; ?>" class="del_pic"/>
														<span class="checkbox"></span>
													</label>
													
												<a href="javascript:void(0)" onclick="works_delete('<?php echo $images['id']; ?>', '<?php echo $imgarr; ?>')" data-img="<?php echo $imgarr; ?>" >Delete</a>
											</div>
										<?php
											$i++;
											}
										?>
									<p class="col-sm-12 img-wrapper-<?php echo (++$count%2 ? "odd" : "even") ?>">Date : 
								<?php
									$Datetime=strtotime($images['createdate']);
									echo date("d - M - Y", $Datetime);
								?>
							</p>
									<?php
											
										} ?>
						
						<?php		echo"</div>";
								}
						?>
								</form>
							</div>
						<?php
							}
						 ?>
						</div>
					</div>
				</div>
			</div>
			<!--Row end-->
	</div>
             <!-- /. PAGE INNER  -->
</div>
         <!-- /. PAGE WRAPPER  -->
         <!------ Fancybox ------->
<script src="<?php echo base_url();?>assets/js/fancybox/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/js/fancybox/jquery.fancybox.js"></script>
		
<script type="text/javascript">
	jQuery(document).ready(function() {
	//	jQuery(".fancybox").fancybox();
	});
</script>

<?php
	$this->load->view('includes/footer');
?>


<script>
	/* Toggle Change Password*/
	$(".ajax-pass-a").click(function(){
		var id=$(this).attr('id');
		//alert(id);
        $("#ajax-pass-"+id).toggle();
    });
    
</script>

<script>
	/*Check All Checkboxes on Delete All Click*/
	$('#all_del_pic').on('change',function(){
		if(this.checked)
		{ // check select status
            $('.del_pic').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "del_pic"              
            });
        }
        else
        {
            $('.del_pic').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "del_pic"                      
            });        
        }
	})
</script>

<script>
	/*ajax delete featured image*/
	function works_delete(id,img)
	{	
		var r=confirm('Are Sure Delete This News');
		if (r==true)
		{
			//var url = '<?php echo site_url('admin/delete_featured')?>/'+id;
			var form_data = {_id:id, _img:img};
			//var form_data = {_img:img};
			$.ajax({
				url:"<?php echo site_url('admin/delete_featured')?>",
				data:form_data,    
				datatype:'json',
				success:function(data){ 
					$('#img-'+id).hide();
					location.reload();  
				}
			});
		}
	}
</script>
