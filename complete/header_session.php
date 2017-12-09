 <?php
			   		$mail=$_SESSION['login'];
					$sql="select firstname,image,id from userregistration where emailid='$mail'";
					$result=mysql_query($sql,$con);
					while($data=mysql_fetch_array($result))
					{
						$firstname=$data[0];
						$image=$data[1];
						$id=$data[2];
					}
			   ?>
                   <ul id="user-options">
                    <li class="boldtext">Welcome: <?php echo $firstname?></li>
<li> <?php echo '<img class=sessinoimage src='.$image.' height="50px" width="50px" />'?></li>
                     
                     <li ><a style="margin-top:2px;"  id="logout-link"  href="logout.php" alt="Logout" title="Logout"></a></li>
                  </ul>
