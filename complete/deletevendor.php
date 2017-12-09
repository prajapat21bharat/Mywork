<?php 
$id=$_GET['DelUserId'];
include("connection.php");

$chk=mysql_query("delete from userregistration where id='$id'");
if($chk)
{

echo "<script type='text/javascript'> document.location='vendors.php';</script>";

}
else
{
 echo "<script type='text/javascript'> document.location='vendors.php';</script>";
}
?>