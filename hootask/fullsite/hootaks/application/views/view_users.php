<?php
	$this->load->view('includes/header_session');
	$this->load->view('includes/admin_menu');
?>


<div class="container">
	<!----------------- Content Start from Here --------------->
		<div class="content-data">
			<div class="message" style="margin:0px auto;"><?php  if($this->session->flashdata('Logmsg'))   echo  $this->session->flashdata('Logmsg'); ?></div>
				<?php
					if(empty($getusers))
					{
						echo "<table align='center'><tr><td><span style='color:red; margin:0px auto; font-size:16px;font-weight:bold;'>No data found</span></td></tr></table>";
						//echo"<script>document.getElementById('datatable').style.display = 'none';</script>";
					}
					else
					{
						echo"<table id='datatable' width='800px' class='grid' align='center'>
						<tr class='td_center'>
							<th>S.No.</th><th>Name</th><th>Email</th><th>Gender</th><th>User Type</th><th>Active Status</th>
						</tr>";
						$sno=0;
						foreach($getusers as $row )
						{
							$sno++;
				?>
						<tr>
							<td class="td_center"><?php echo $sno;?></td><td><?php echo ucwords($row['firstname'] ." ".$row['lastname']) ?></td><td><?php echo $row['email']; ?></td><td><?php echo $row['gender']; ?></td><td><?php echo $row['user_type']; ?></td><td><a href="<?php echo site_url() ?>/admin/activestate/<?php echo $row['id'] ?>_<?php if($row['active_state']=="1"){echo "Active";}else{echo "Deactive";} ?>"><?php if($row['active_state']=="1"){echo "Active";}else{echo "Deactive";} ?></a></td>
						</tr>
						
				<?php
						}
						echo"</table>";
					}
				?>
					
		</div>
</div>

<?php
	$this->load->view('includes/footer_session');
?>
