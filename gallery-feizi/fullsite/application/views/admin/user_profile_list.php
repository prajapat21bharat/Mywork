<?php $site=site_url().'admin/home/'; ?>
<script type="text/javascript">
<?php /*?>
$(document).ready(function(){
$('#pagination .active').html('<a href="<?php echo $site ?>">1</a>');
$("#pagination a:last").remove();	
	});<?php */?>
	$(function(){	
$('#pagination .active').html('<a href="<?php echo $base_url; ?>/0">1</a>');
$("#pagination a:last").remove();
var val_loc=window.location;

var arr = String(val_loc).split("/");
var size=arr.length-1;

if(arr[size])
{
	var par_page='<?php echo $per_page; ?>';
	var page=Math.ceil(arr[size]/par_page)+1;
	$("#pagination >li.active").removeClass("active");
	$("#pagination li:nth-child("+page+") a ").addClass("active");

}
});
</script>

<script type="text/javascript">

function menu_item_delete(id)
{
var r=confirm('Are Sure Delete This User');
if (r==true)
	{
	var form_data = {
		 user_id:id
		  };
    $.ajax({
       url:'<?php echo $site.'delete_user';?>',
       data:form_data,    
       datatype:'json',
       success:function(data){ 
		  $('#'+id).hide();
		    location.reload();
		//  $('.msg').html('User Successfully Deleted !');
		  
       }
     });
}

}

function active(value,user_id)
{ 
var form_data = {
		 active:value,
		 user_id:user_id
		  };
		 
    $.ajax({
       url:'<?php echo $site.'user_active_inactive';?>',
       data:form_data,    
       datatype:'json',
       success:function(data){
		   if(data!='1')
		   {			   
            $('#actve_deactive_'+user_id).html("<a title='Enable' onclick='active(1,"+user_id+")' href='javascript:void(0)'><img src='<?php echo base_url().'assets/img/btn-red1.png'?>'/></a>");
			   
		   }else{
			       $('#actve_deactive_'+user_id).html("<a title='Enable' onclick='active(0,"+user_id+")' href='javascript:void(0)'><img src='<?php echo base_url().'assets/img/btn-green.png'?>'/></a>");
		   }
		  
		
       }
     });


}


</script>

<div class="container-fluid content-wrapper mob-right-part span10">
  <div class="hero-unit"> 
  
  <h3 class="title">Artist</h3>
  <div class="white_bg">
   <a class="add_restaurant_btn" href="<?php echo site_url().'admin/register' ?>">Add Artist</a>
    <div class="msg"></div>
     <table width="100%" class="table table-striped table-bordered table-radmin">
      <thead>
        <tr>
          <th width="">Name</th>
         <!-- <th width="">Phone Number</th>  -->        
          <th width="">Action</th>
        </tr>
      </thead>
      <?php foreach ($records as $records): ?>
      <tr id='<?php echo $records->ID; ?>'>
        <td><a href="<?php echo site_url().'admin/home/user_profile_view/'.$records->ID?>"><?php echo $records->first_name; ?>
        <?php echo $records->last_name;?></a></td>
      <!--  <td><?php echo $records->user_phone;?></td>-->        
        <td>  <?php if($records->status==1){			
			  echo "<span   id='actve_deactive_$records->ID'><a title='Disable' onclick='active(0,$records->ID)' href='javascript:void(0)'><img src='".base_url()."assets/img/btn-green.png'  /></a></span>";
			 
		}else{
			echo  "<span  id='actve_deactive_$records->ID'><a title='Enable'  onclick='active(1,$records->ID)' href='javascript:void(0)'><img src='".base_url()."assets/img/btn-red1.png' /></a></span>"; 
             } ?>
        |
        <a  href="<?php echo site_url().'admin/home/user_profile_view/'.$records->ID?>" title="edit"> <img src="<?php echo base_url().'uploadimages/site_image/edit.png';?>"/></a> 
        
       | <a href="javascript:void(0)"  onclick="menu_item_delete(<?php echo $records->ID; ?>)" title="delete"> <img src="<?php echo base_url().'uploadimages/site_image/delete.png';?>"/></a>
        
        </td>
      </tr>
      <?php endforeach; ?>
    </table>
    <?php echo $links;?> </div>
</div>
</div>
