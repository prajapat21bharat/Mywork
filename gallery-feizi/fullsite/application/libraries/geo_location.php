<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Geo_location {

   function get_geolocation($ip) {
        $d = file_get_contents("http://api.ipinfodb.com/v3/ip-city/?key=9b7ce0d410acedbaa143c640b6499ff997acd3648d61a5e3be0cd308a591bd48&ip=".$ip."&format=xml");
        
      
        if (!$d) {
            $backup =  file_get_contents("http://api.ipinfodb.com/v3/ip-city/?key=9b7ce0d410acedbaa143c640b6499ff997acd3648d61a5e3be0cd308a591bd48&ip=".$ip."&format=xml");
            $result = new SimpleXMLElement($backup);
            if (!$backup)
                return false; 
        } else {
            $result = new SimpleXMLElement($d);
        }
		
	
       
        return array('ip'=>$ip, 'country_code'=>$result->countryCode, 'country_name'=>$result->countryName, 'region_name'=>$result->regionName, 'city'=>$result->cityName, 'zip_postal_code'=>$result->zipCode, 'latitude'=>$result->latitude, 'longitude'=>$result->longitude, 'timezone'=>$result->timeZone);
    }
   
   
}
?> 