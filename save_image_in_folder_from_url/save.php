<?php
	$url="http://server.ntftechnologies.com/budgetControl/catimage/uId_11/81.jpg";
	$contents=file_get_contents($url);
	$filename = basename($url);
	$save_path="test/".$filename;
	file_put_contents($save_path,$contents);
?>
