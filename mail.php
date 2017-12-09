<?php
	$issent=mail('bharat.prajapat@newtechfusion.com','test sub','this is test message');
	if($issent)
	{
		echo"sent";
	}
	else
	{
		echo"Not sent";
	}
?>
