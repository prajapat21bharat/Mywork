
<?php
/*For Email template content*/

	//echo"<pre>";
	//print_r($templatedata);exit;
	//$id = $templatedata[0]['id'];
	$tinymce='';
	if(!empty($email_template))
	{
		$tinymce = $email_template[0]['content'];
	}
	
	if(!empty($sent_emails))
	{
		$tinymce = $sent_emails[0]['sent_content'];
	}
	
	print_r($tinymce);

?>

<?php
	/*For load more three img sets*/
	if(!empty($loadmore))
	{
		?>
		<div class="clearfix"></div>
		<div class="photos-part" id="photos-part">
		<div class="row">
			<?php
				if(isset($loadmore))
				{
					//echo"<pre>";print_r($loadmore);exit;
					if(!empty($loadmore))
					{
					foreach($loadmore as $photos)
					{
						
						$time=strtotime($photos['createdate']);												
						$date=date("d",$time);
						$month=date("F",$time);
						$year=date("Y",$time);
						
						$allphotos=explode(',',$photos['photos']);
						$photo_order=explode(',',$photos['photo_order']);
						
						$imgcount=count($allphotos);
						
						$i=0;
						$j=1;
						$k=2;
												
						
						if($photos['public']==1)
						{
							$public_select="checked";
						}
						else
						{
							$public_select="";
						}

						if($photos['featured']==1)
						{
							$featured_select="checked";
						}
						else
						{
							$featured_select="";
						}
						//echo"<pre>";print_r($photos);
						$defaultimg='find_user.png';
							//echo"<pre>";print_r($defaultimg);
						if(empty($allphotos[$photo_order[$i]]))
						{
							$allphotos[$photo_order[$i]]=$defaultimg;
						}
						//if($j<0)
						if(empty($allphotos[$photo_order[$j]]))
						{
							@$allphotos[$photo_order[$j]]=$defaultimg;
						}
						//if($k<0)
						if(empty($allphotos[$photo_order[$k]]))
						{
							$allphotos[$photo_order[$k]]=$defaultimg;
						}
					
			?>
			
				<div class="col-md-4 col-sm-4 col-xs-12 three_photos">
					<div class="date"><?php print $month.' '.$date.', '.$year; ?></div>
					<div class="image-section">
						<div class="client-img" data-id="<?php echo $photos['id']; ?>">
						 
						
						
							 <?php 
								// fix for space in image name
								$all_photos[0] =preg_replace('/\s+/', '_', $allphotos[$photo_order[$i]]);
								if($j<0)
								{
									$all_photos[1]	=	$defaultimg;
								}
								else
								{
									$all_photos[1] =preg_replace('/\s+/', '_', $allphotos[$photo_order[$j]]);
									
								}
								if($k<=0)
								{
									$all_photos[2] =	$defaultimg;
								}
								else
								{
									$all_photos[2] =preg_replace('/\s+/', '_', $allphotos[$photo_order[$k]]);
								}
								$pathToimg=base_url().'assets/uploads/thumbnails';
							 ?>
							<a class="fancybox" href="<?php print $pathToimg.'/600x600/'.$all_photos[0];?>" >
								<img src="<?php print $pathToimg.'/130x130/'.$all_photos[0];?>" class="img-responsive" id="main_three_set">
							</a>
						</div>
						
						<ul class="client-img-no clickable_imgs" id="clickable_imgs">
							<li class="first">
								<img src="<?php print @$pathToimg.'/130x130/'.$all_photos[0];?>" class="img-responsive img_set_mini" data-id="<?php @print $photos['id']; ?>">
							</li>
							<li>
								<img src="<?php print @$pathToimg.'/130x130/'.$all_photos[1];?>" class="img-responsive img_set_mini" data-id="<?php @print $photos['id']; ?>">
							</li>
							<li class="last">
								<img src="<?php print @$pathToimg.'/130x130/'.$all_photos[2];?>" class="img-responsive img_set_mini" data-id="<?php @print $photos['id']; ?>">
							</li>
						</ul>
						
					</div>
					<div class="clearfix"></div>
					<div class="edit-section">
						<div class="btn-part">
							<!--<a class="btn-black-x-small black-btn" href="#">Edit</a>-->
							<a class="btn-black-x-small purple-btn share_this" href="javascript:void(0)" data-id="<?php @print $photos['id']; ?>">Share</a>
							<a class="btn-black-x-small purple-btn ajax_edit_photo_set" href="#upload_images"  data-id="<?php @print $photos['id']; ?>">Edit</a>
							<a class="btn-black-x-small purple-btn ajax_delete_photo_set" href="javascript:void(0)"  data-id="<?php @print $photos['id']; ?>">Delete</a>
						</div>
						<div class="share_media" id="share_media-<?php @print $photos['id']; ?>">
								<?php
									$base_url=base_url().'';
								?>
								<a id="fbshare_link_<?php @print $photos['id']; ?>" href="http://www.facebook.com/sharer/sharer.php?u=<?php @print $pathToimg.'/600x600/'.$all_photos[0];?>&t=Description" target="_blank"><i class="fa fa-facebook"></i></a>
								<a id="twitshare_link_<?php @print $photos['id']; ?>"  href="http://twitter.com/share?text=Description <?php @print $pathToimg.'/600x600/'.$all_photos[0];?>" target="_blank"><i class="fa fa-twitter"></i></a>
								
								<a id="pinshare_link_<?php @print $photos['id']; ?>" href="https://pinterest.com/pin/create/button/?url=<?php @print $pathToimg.'/600x600/'.$all_photos[0]?>&media=&description=" target="_blank"><i class="fa fa-pinterest"></i></a>
								<!--<a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php // @print $allphotos[0];?>" target="_blank">LinkedIn</a>-->
								<a id="emailshare_link_<?php @print $photos['id']; ?>" href="<?php echo site_url('stylist/email_photos/'.$photos['id'].'/'.$clientinfo[0]['user_id']);?>">
									<i class="fa fa-envelope"></i>
								</a>
								<?php /*?><a class="btn-black btn_subs" href="<?php echo site_url('stylist/email_photos/'.$photos['id']);?>"><i class="fa fa-envelope"></i></a><?php */?>
							</div>
						<div class="feature-part">
							
								<label>
									<input type="checkbox" data-id="<?php @print $photos['id']; ?>" name="img_set_featured" id="img_set_featured" <?php print $featured_select;?> class="ajax_set_featued_public" data-column="featured" >
									<span class="checkbox"></span>Featured
								</label>
							
							
								<label>
									<input type="checkbox" data-id="<?php @print $photos['id']; ?>" name="img_set_public" id="img_set_public" <?php print $public_select;?> class="ajax_set_featued_public" data-column="public" >
									<span class="checkbox"></span>Public
								</label>
							
						</div>
					</div>
				</div>
				
				<?php
						}
					}
				?>
				<div class="clearfix"></div>
				<div class="show_more_main" id="show_more_main<?php echo $photos['id']; ?>">
					<span id="<?php echo $photos['id']; ?>" data-id="<?php echo $photos['c_id']; ?>" class="show_more" title="Load more posts">Show more</span>
					<span class="loding" style="display: none;"><span class="loding_txt">Loading...</span></span>
				</div>
				<?php
				}
			?>
				</div>
			</div>
			
<script>
	/*Clickable img strat*/
	$('#clickable_imgs li img').on('click',function(){
		var src= $(this).attr('src');
		var id= $(this).attr('data-id');
		var fileNameIndex = src.lastIndexOf("/") + 1;
		var filename = src.substr(fileNameIndex);
		var host=$(location).attr('hostname');
		var newsrc='http://'+host+'/inhairent/assets/uploads/thumbnails/600x600/'+filename;
		var newsrc_thumb='http://'+host+'/inhairent/assets/uploads/thumbnails/130x130/'+filename;
		console.log(host);
		var newhtml='<a class="fancybox" href='+newsrc+'><img src='+newsrc_thumb+' class="img-responsive" id="main_three_set"></a>';
		var main_img=$(this).parent().parent().prev().html(newhtml);
		$('#fbshare_link_'+id).attr('href','http://www.facebook.com/sharer/sharer.php?u='+newsrc);
		//alert(newhtml);
	});
	
	/* For showing share media*/
	$(document).ready(function(){
		$(".share_this").unbind('click').click(function(event){
		  var id=$(this).attr('data-id');
		  console.log(id);
		  $('#share_media-'+id).toggle();
	      event.stopImmediatePropagation(); 	// as long as not bubbling up the DOM is ok?
		})
	})
	
</script>

<script type="text/javascript">
/*Edit Photos*/

$('.ajax_edit_photo_set').on('click',function () {
	
	var id=$(this).attr('data-id');
	console.log(id);
	if(id!='')
	{
		var url = '<?php echo site_url('stylist/edit_photo_set');?>/'+id;
		//alert(url);
		 $.ajax({
                type: "POST",
                url: url,
                success: function(data) {
					$('#upload_images-popup-content').html(data);
                },
           });
	}
	else
	{
		//alert('test');
	}
	
});

</script>
<script type="text/javascript">
/*Delete 3 image Set */

$('.ajax_delete_photo_set').on('click',function () {
	
	var id=$(this).attr('data-id');
	var uid=$("#uid").val();
//	var url      = window.location.href;
	console.log(id);
	if(id!='')
	{
		var url = '<?php echo site_url('stylist/delete_photo_set');?>/'+id+'/'+uid;
		var htm =$("#three_photos_wrapper").html();
		//alert(url);
		 $.ajax({
                type: "POST",
                url: url,
                success: function(data) {
					//$('#slide-img-popup-content').html(data);
					//$("#three_photos_wrapper").load(location.href + " #three_photos_wrapper");
					location.reload();
					 //$('#three_photos_wrapper').load('#'); //note: the space before #div1 is very important 
				}
           });
	}
	else
	{
		//alert('test');
	}
	
});

</script>

<script type="text/javascript">

$('.ajax_set_featued_public').on('change',function () {
	
	var id=$(this).attr('data-id');
	var column=$(this).attr('data-column');
	
	if(this.checked)
	{
		var url = '<?php echo site_url('stylist/set_featued_public');?>/1/'+id+'/'+column;
		
		 $.ajax({
                type: "POST",
                url: url,
                success: function(data) {
					$('#photos-part .message').html("<b style='color:green'> Image Set to Featured </b>");
                },
           });
	}
	else
	{
		var url = '<?php echo site_url('stylist/set_featued_public');?>/0/'+id+'/'+column;
		//alert(fieldVal);
		 $.ajax({
                type: "POST",
                url: url,
                success: function(data){ 
					$('#photos-part .message').html("<b style='color:green'> Image Unset from Featured </b>");                   
                },
           });
	}
	
});

</script>

<script type="text/javascript">

$('.setfavorite').on('change',function () {
	
	var email=encodeURIComponent($('#email').val());
	var fieldVal = encodeURIComponent($(this).val());

	if(this.checked)
	{
		var url = '<?php echo site_url('stylist/setfavorite');?>/1/'+fieldVal+'/'+email;
		
		 $.ajax({
                type: "POST",
                url: url,
                success: function(data) {
					$('#find_photos .message').html("<b style='color:green'> Image Set To Favorite </b>");
                },
           });
	}
	else
	{
		var url = '<?php echo site_url('stylist/setfavorite');?>/0/'+fieldVal+'/'+email;
		//alert(fieldVal);
		 $.ajax({
                type: "POST",
                url: url,
                success: function(data){
					$('#find_photos .message').html("<b style='color:green'> Image Unset from Favorite </b>");
                },
           });
	}
	
});

</script>

		<?php						
	}
?>




<?php
	/*For img tags & popup*/
	if(!empty($images_tags))
	{
?>
		<div class="img-tags">
			<?php
			
				$photos=explode(',',$images_tags[0]['photos']);
				$pathToimg=base_url().'assets/uploads/thumbnails';
				$i=1;
				foreach($photos as $photo)
				{
					$newimg =preg_replace('/\s+/', '_', $photo);
					if($i>2)
					{
						$col=12;
					}
					else
					{
						$col=6;
					}
					echo"<div class='img-tagnames-img col-md-4'><img src='$pathToimg/600x600/$newimg' class='img-responsive ' /></div>";
					$i++;
				}
			?>
		
			<?php
				if(!empty($tags))
				{
					echo "<div class='clearfix'></div><div class='img-tagnames col-md-12'>";
					foreach($tags as $tag)
					{
						//echo"<pre>";print_r($tag);
						//$tag[0]['tagname'];
						//echo "<div class='clearfix'></div><div class='img-tagnames col-md-12'><h4>".$tag[0]['tagname']."</h4></div>";
						if(!empty($tag))
						{
							echo "<span class='img_tags'>".@$tag[0]['tagname']."</span>";
						}
					}
					echo "</div>";
				}
			?>
		</div>
<?php
//		exit();
	}
?>



<!-----------------/		/-------------->
<?php
	if(!empty($edit_img_set))
	{
?>

		<div class="col-md-12">
			<input type="file" name="pic[]" id="pic" multiple="" value="" accept="image/*"  >
			<span>( Maximum 3 photos are allowed )</span>
		</div>
		<!--<img id="uploadPreview" style="width: 100px; height: 100px;" /> -->

		<div id="gallery">
			<ul id="sortable" class="ui-sortable">
				<?php
					$photos=explode(',',$edit_img_set[0]['photos']);
					$photo_order=explode(',',$edit_img_set[0]['photo_order']);
					//echo"<pre>";print_r($photo_order);
					//exit;
					$li=0;
					$pathToimg=base_url().'assets/uploads/thumbnails';
					foreach($photo_order as $image)
					{
						if(empty($photos[$photo_order[$li]]))
						{
							$photos[$photo_order[$li]]=$defaultimg='default/user_female_512.png';
						}
						else
						{
						}
						$img_name=basename($photos[$photo_order[$li]]);
						//echo"<pre>";print_r($photo_order);
						//print_r($photos[$photo_order[$li]])
				?>
					<li id="<?php print $photo_order[$li]; ?>" class="ui-sortable-handle rotable" style="">
						<input type="hidden" name="img_order[]" value="0">
						<img class="img-responsive" src="<?php print preg_replace('/\s+/', '_', $pathToimg.'/244x244/'.$photos[$photo_order[$li]]) ; ?>" data-id="<?php print $photo_order[$li]; ?>" style="width:200px; height:200px;" />
						<input type="hidden" name="old_pic[]" value="<?php print $photos[$photo_order[$li]]; ?>" />
						<input type="hidden" value="<?php print $img_name; ?>" name="liname[]">
						<a class="remove_this" onclick="var li = this.parentNode; var ul = li.parentNode; ul.removeChild(li); remove_img(); add_ids(); file_browse();" href="#upload_images">Remove</a>
						<p class="btn rotate_me" onclick="Rotateimage()">Rotate</p>
						<span id="r_angle" style="display:none;">0</span>
						<input id="txt_degree" class="degree" type="hidden" value="0" name="cropbox[]">
					</li>
				<?php
					$li++;
					}
				?>
			</ul>
		</div>
		<input type="hidden" name="sortdiv" id="sortdiv" value="<?php print $edit_img_set[0]['photo_order']; ?>" />
		<input type="hidden" name="de_order" value="0,1,2" id="de_order"/>
		
		<input type="hidden" name="client_photo_id" value="<?php print $edit_img_set[0]['id']; ?>" id="client_photo_id"/>
		<!--<output id="sortable"></output>-->
	
	<?php
		if($edit_img_set[0]['featured']==1)
		{
			$featured='checked';
		}
		else
		{
			$featured='';
		}

		if($edit_img_set[0]['public']==1)
		{
			$public='checked';
		}
		else
		{
			$public='';
		}
	?>
	<div class="col-md-12">
		<div style="clear:both;">
			<label for="chk_featured">
				<input type="checkbox" name="chk_featured" id="chk_featured" value="1" <?php print $featured;?> />
				<span class="checkbox"></span>
				Make Set Featured
			</label>
		</div>
		<div>
			<label for="chk_public">
				<input type="checkbox" name="chk_public" id="chk_public" value="1" <?php print $public;?> />
				<span class="checkbox"></span>
				Make Set Public
			</label>
		</div>
	</div>
	
	<div class="col-md-12">
		<h3 class="tag_head">Tags</h3>
		<ul class="tag_list">
		
		
		<?php
		if(@$alltags)
		{
			$i=4;
			$j=0;
			$tagids=array();
			if(!empty($photo_tags))
			{
				foreach($photo_tags as $photo_tag)
				{
				
					array_push($tagids,$photo_tag[0]['id']);
					$j++;
				}
			}
			
			foreach(@$alltags as $tag)
			{
				//$tagids=array_push($tagids,$tag['id']);
				if(in_array($tag['id'],$tagids))
				{
					$checked="checked";
				}
				else
				{
					$checked='';
				}
				if($i % 4 == 0)
				{
					if($i==4)
					{
						$class="fisrt_li";
					}
					else
					{
						$class="last_li";
					}
					
				}
				else
				{
					$class="";
				}
				
		?>
		<li class="<?php print $class; ?>">
			<label for="tagids-<?php print $tag['id']?>">
				<input type="checkbox" name="tagids[]" id="tagids-<?php print $tag['id']?>" value="<?php print $tag['id']?>" class="tabids" <?php print $checked; ?> />
				<span class="checkbox"></span>
				<?php print $tag['tagname']?>
			</label>
		</li>
		<?php
				$i++;
			}
		}
		?>
		</ul>
	</div>
	<div class="col-md-12">
		<input type="submit" name="edit_image" id="upload" value="Save"  onclick="set_degree(); set_order();"  class="btn-black-small square-btn-adjust">
	</div>


<script>
	/*Setting images browse null or empty*/
	$('.upload_images-popup').on('click', function(){
		$('#sortable').html('');
		$('#pic').val('');
	})
	
	/*Setting images browse null or empty*/
	function remove_img()
	{
		var li_size=$('#sortable li').size();
		if(li_size=0)
		{
			$('#sortable').html('');
			$('#pic').val('');
		}
	}
	
</script>


<script>
	$(function(){
		file_browse();
	})
	
	function file_browse()
	{
		var li_length=$('#sortable li').length;
		if(li_length>2)
		{
			$('#pic').prop('disabled', true);
			//$('#pic').css('color','red');
		}
		else
		{
			$('#pic').prop('disabled', false);
			//$('#pic').css('color','blue');
		}
	}
</script>


<script>
$('#pic').change(function () {
	var li_length=$('#sortable li').length;
	var c=li_length;
	//var c=0;
    for (var i=0, len = this.files.length; i < len; i++) {
        (function (j, self) {
            var reader = new FileReader()
            reader.onload = function (e) {
				var fn= "+rotate";
				 var li = document.createElement('li');
				    li.setAttribute('id',+c);
				    li.setAttribute('class',"ui-sortable-handle rotable");
				    li.setAttribute('style',"");
				    li.innerHTML = '<input type="hidden" value="'+c+'" name="img_order[]"><img data-id="'+c+'" style="width: 200px;height: 200px;" src="' + e.target.result + '" class="img-responsive" ><input  name="liname[]" type="hidden" value="' + self.files[j].name + '"/><a href="#upload_images" onclick="var li = this.parentNode; var ul = li.parentNode; ul.removeChild(li); remove_img(); add_ids(); file_browse();" class="remove_this">Remove</a><p class="btn rotate_me" onclick = "Rotateimage()" >Rotate</p><span style="display:none;" id="r_angle">90</span><input class="degree" id="txt_degree" type="hidden" name="cropbox[]" value="0">';
					document.getElementById('sortable').appendChild(li);
               c++;
            };
            reader.readAsDataURL(self.files[j])
        })(i, this);
    }
    
    add_ids(); 
    
  
});

</script>
  
  <script>
	  
	   $(function() {
        $("#sortable" ).sortable({
            placeholder: "ui-state-highlight",
            cursor: 'crosshair',
            update: function(event, ui) {
                var order = $("#sortable").sortable("toArray");
               // alert(order);
                $('#sortdiv').val(order.join(","));
              $('#sortdiv').val();
                
            }
    });
        $( "#sortable" ).disableSelection();
});

</script>

<script>
/*Rotate image on click*/

	function Rotateimage()
	{
		$('.rotate_me').on('click',function(){
			var angle = $(this).next('span').html();
			var new_angle =  $(this).next('span').html(parseInt(angle)+90);
			$(this).next('span').next('input').val(parseInt(angle));
			var rotate_angle = angle+'deg';
			var i_data =  $(this).parent().attr('id');
			$('#'+i_data+'> img').css({ 'transform':'rotate('+rotate_angle+')'})
			if(angle>270)
			{
				$(this).next('span').html('90');
				angle=90;
			}
			})
	}

/*Setting rotate angle value on button click*/
function set_degree()
{
	  var values = [];
	  var final_degree='';
	  var id=0;
	  $('#sortable li').each(function() {
		var deg_value=$('#sortable li#'+id+' .degree').val();
		values.push(deg_value);
		final_degree=values.join(',');
		console.log(final_degree);
		id=id+1
	  });
	  //alert(final_degree);
	  $('#de_order').val(final_degree);
}

/*Add dynamic id to li*/
function add_ids()
{
	//alert('0');
	$('#sortable li').each(function(i,el){
			el.id = i+1-1;
		});
}
/*Setting order on button click*/
function set_order()
{
	
	  var values = [];
	  var final_order='';
	  var id=0;
	  $('#sortable li').each(function() {
		var order_value=$(this).attr('id');
		values.push(order_value);
		final_order=values.join(',');
		console.log(final_order);
		id=id+1
	  });
	//  alert(final_order);
	  $('#sortdiv').val(final_order);
}

</script>

<?php	

	}
?>


