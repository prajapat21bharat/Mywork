<?php

 
 function location_of_user()
{
   //$CI =& get_instance();
   
   // $key='87b64c5ebf6ddd522d5dc4efd50466f5027d821f412db9bc4d7e71b6376a6417'; 
//	$url = json_decode(file_get_contents("http://api.ipinfodb.com/v3/ip-city/?key=".$key."&ip=".$CI->input->ip_address()."&format=json"));		   
//	return $location=array(
			//'lat'=>$url->latitude,
			//'lng'=> $url->longitude,
			//'state'=>$url->regionName,
//			'city'=>$url->cityName
//		);
	/* $url->countryName;
	 $url->cityName;
	 $url->regionName;
	 $url->ipAddress;
	 $url->countryCode;
	 $url->latitude;
	 $url->longitude;
	 $url->timeZone;*/
	 ?>
	<script language="JavaScript" src="http://j.maxmind.com/app/geoip.js"></script>
	<?php
return $location=array(
			 'state'=>'<script language="JavaScript">document.write(geoip_region_name());</script>',
			'city'=>'<script language="JavaScript">document.write(geoip_city());</script>'
		);
}





 
 function getNearby($lat, $lng, $type = 'cities', $limit, $distance, $unit)
{
   $CI =& get_instance();  									
    if ($unit == 'km')  $radius = 6371.009; // in kilometers
    elseif ($unit == 'mi') $radius = 3958.761; // in miles

    $maxLat = (float) $lat + rad2deg($distance / $radius);
    $minLat = (float) $lat - rad2deg($distance / $radius);

    
    $maxLng = (float) $lng + rad2deg($distance / $radius / cos(deg2rad((float) $lat)));
    $minLng = (float) $lng - rad2deg($distance / $radius / cos(deg2rad((float) $lat)));
	$query = $CI->db->query('SELECT ID,restaurant_name,restaurant_logo ,city_id FROM   restaurants
										WHERE latitude >'.$minLat.' AND latitude <'.$maxLat.' AND longitude > '.$minLng.' AND longitude < '.$maxLng.' and restaurant_is_active="1"
										ORDER BY ABS(latitude - '.(float) $lat.') + ABS(longitude - '.(float) $lng.') ASC
										LIMIT '.$limit.'');
	
	
	/*$query = $CI->db->query('SELECT ID FROM   restaurants
										WHERE latitude > ? AND latitude < ? AND longitude > ? AND longitude < ?
										ORDER BY ABS(latitude - ?) + ABS(longitude - ?) ASC
										LIMIT '.$limit.';',
										array($minLat, $maxLat, $minLng, $maxLng, (float) $lat, (float) $lng, (int) $limit));*/
										
	return $query->result();
 	
   
}

function location_get(){
	?>
<script language="JavaScript" src="http://j.maxmind.com/app/geoip.js"></script>
<script language="JavaScript">
var state= geoip_region_name();
var city= geoip_city();
</script>
<?php 
$_SESSION['state']='<script language="JavaScript">geoip_region_name()</script>'; 
$_SESSION['city']='<script language="JavaScript">geoip_region_name()</script>';
/*$data=array('state'=>'<script language="JavaScript">state</script>',
			'city'=>'<script language="JavaScript">city</script>');
$this->session->set_userdata($data);*/
	
	}
 

