<?php
	$this->load->view('includes/header');
?>
<!--contant start-->

<div class="container">
	<!----------------- Content Start from Here --------------->
		<div class="content-data">
			<div class="message" style="margin:0px auto;"><?php  if($this->session->flashdata('Logmsg'))   echo  $this->session->flashdata('Logmsg'); ?></div>

			<table>
			<?php
				//echo"<pre>";print_r($data);exit;	
				foreach(@$data as $row)
				{
				$blog     = get_object_vars($row);
				
				$image= $blog['image'];
			 ?>
			 
			 <tr>
				<td align="center">
					<img src="<?php echo base_url().'/ast/images/uploads/userpic/'.$image?>" width="362" height="362" alt="mentor" />
					<span><h3><?php echo $blog['firstname'].' '.$blog['lastname'];?></h3></span>
					<span><?php echo $blog['jobtitle'];?></span>
					<span>Exp. : 10yrs</span>
					
				</td>
				<td><p width="300px"><?php echo $blog['description'];?></p></td>
			 </tr>
				
			<?php }?>
			</table>
		</div>
</div>
<!--contant end-->
<?php
	$this->load->view('includes/footer');
?>

