<?php
    
        function getStatusCodeMessage($status) {
            // these could be stored in a .ini file and loaded
            // via parse_ini_file()... however, this will suffice
            // for an example
            $codes = Array(
                           100 => 'Continue',
                           101 => 'Switching Protocols',
                           200 => 'OK',
                           201 => 'Created',
                           202 => 'Accepted',
                           203 => 'Non-Authoritative Information',
                           204 => 'No Content',
                           205 => 'Reset Content',
                           206 => 'Partial Content',
                           300 => 'Multiple Choices',
                           301 => 'Moved Permanently',
                           302 => 'Found',
                           303 => 'See Other',
                           304 => 'Not Modified',
                           305 => 'Use Proxy',
                           306 => '(Unused)',
                           307 => 'Temporary Redirect',
                           400 => 'Bad Request',
                           401 => 'Unauthorized',
                           402 => 'Payment Required',
                           403 => 'Forbidden',
                           404 => 'Not Found',
                           405 => 'Method Not Allowed',
                           406 => 'Not Acceptable',
                           407 => 'Proxy Authentication Required',
                           408 => 'Request Timeout',
                           409 => 'Conflict',
                           410 => 'Gone',
                           411 => 'Length Required',
                           412 => 'Precondition Failed',
                           413 => 'Request Entity Too Large',
                           414 => 'Request-URI Too Long',
                           415 => 'Unsupported Media Type',
                           416 => 'Requested Range Not Satisfiable',
                           417 => 'Expectation Failed',
                           500 => 'Internal Server Error',
                           501 => 'Not Implemented',
                           502 => 'Bad Gateway',
                           503 => 'Service Unavailable',
                           504 => 'Gateway Timeout',
                           505 => 'HTTP Version Not Supported'
                           );
            
            return (isset($codes[$status])) ? $codes[$status] : '';
        }
        
        // Helper method to send a HTTP response code/message
        function sendResponse($status = 200, $body = '', $content_type = 'application/json') {
            $status_header = 'HTTP/1.1 ' . $status . ' ' . getStatusCodeMessage($status);
            header($status_header);
            header('Content-type: ' . $content_type);
            echo $body;
        }
        
              
     class grubtracker {
            
            private $db;
            //private $response = array();
            // Constructor - open DB connection
            function __construct() {
                
                
               /* $this->db = mysql_connect ( 'localhost', 'root', '' );
                mysql_select_db ('forever', $this->db ) or die(mysql_error());*/
                
				 $this->db = mysql_connect ('208.91.199.11', 'can_grub', 'QAZ123' );
	       		 mysql_select_db ('canoppwh_grubtracker', $this->db ) or die(mysql_error());
				 
				
            }  
				
/////////////////////////////////////////////////////UserRegistration///////////////////////////////////////////////

				public function UserRegistration()
				{				
						$firstname=$_POST["firstname"];
						$lastname=$_POST["lastname"];
						$emailid=$_POST["emailid"];
						$password=$_POST["password"];
						$usertype=0;
						//$usertype=$_POST["usertype"];
						$phoneno=$_POST["phoneno"];
						$city=$_POST["city"];
						$zipcode=$_POST["zipcode"];
						//$website='';
						$website=$_POST["website"];
						$facebookid=$_POST["facebookid"];
						$latitude=$_POST["latitude"];
						$longitude=$_POST["longitude"];
						$deviceId=$_POST["deviceId"];
						$golivestatus=1;
						$acceptorderstatus=1;
						//$status=$_POST["livestatus"];
						//$image=$_POST["image"];
						//$datetime=$_POST["datetime"];				
						
										
						if($_POST["image"]==''){
						$files='http://grubtracker.canopussystems.com/images/53fc654ab5966.png';
						
} 
else
{
define('UPLOAD_DIR','images/');
$img = $_POST["image"];

$img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$data = base64_decode($img);

$file = UPLOAD_DIR . uniqid() . '.png';

$success = file_put_contents($file, $data);
    $files='http://'.$_SERVER['HTTP_HOST'].'/'. $file;
}   

                       $sql="select * from userregistration where emailid='$emailid'";		
						$result=mysql_query($sql);
						if($result)
						{
							if(mysql_num_rows($result)<=0)
							{
							$sql="select * from userregistration where phoneno='$phoneno'";		
							$result=mysql_query($sql);
							if($result)
							{
							if(mysql_num_rows($result)<=0)
							{
							$sql="INSERT INTO userregistration(firstname,lastname,emailid,password,usertype,phoneno,city,zipcode,website,facebookid,latitude,longitude,deviceId,golivestatus,image,acceptorderstatus) VALUES ('$firstname','$lastname','$emailid','$password','$usertype','$phoneno','$city','$zipcode','$website','$facebookid','$latitude','$longitude','$deviceId','$status','$files','$acceptorderstatus')";
								$result=mysql_query($sql);
							
									if($result)
									{
									$user_id=mysql_insert_id();
									$checkreg = mysql_query("select * from userregistration where id='$user_id'");
	
									if(mysql_num_rows($checkreg))
										{
											$userInfo = mysql_fetch_assoc($checkreg); 
											$userid = $userInfo['id'];
											$firstname = $userInfo['firstname'];
											$lastname = $userInfo['lastname'];
											$emailid = $userInfo['emailid'];
											$password = $userInfo['password'];
											$usertype = $userInfo['usertype'];
											$phoneno = $userInfo['phoneno'];
											$city = $userInfo['city'];
											$zipcode = $userInfo['zipcode'];
											$website = $userInfo['website'];
											$facebookid = $userInfo['facebookid'];
											$latitude = $userInfo['latitude'];
											$longitude = $userInfo['longitude'];
											$deviceId = $userInfo['deviceId'];
											$livestatus = $userInfo['golivestatus'];
											$acceptorderstatus=$userInfo['acceptorderstatus'];;
											$image = $userInfo['image'];
											$final_result_2[] = array('userid'=>$userid,'firstname'=>$firstname,'lastname'=>$lastname,'emailid'=>$emailid,'password'=>$password,'usertype'=>$usertype,'phoneno'=>$phoneno,'city'=>$city,'zipcode'=>$zipcode,'website'=>$website,'facebookid'=>$facebookid,'latitude'=>$latitude,'longitude'=>$longitude,'deviceId'=>$deviceId,'livestatus'=>$livestatus,'image'=>$image,'acceptorderstatus'=>$acceptorderstatus);
										}
									
									$final_result_1 =  'true';
									$final_result_3 =  '';
									$final_result = $final_result_2[0];
										
									}
									else
									{
									$final_result_1 =  'false';
									$final_result_3 =  'Data Not Inserted';
									$final_result[] ='';
									}
							}
							else
							{
								$final_result_1 =  'false';
								$final_result_3 =  'Phone no Already Exist';
								$final_result[] ='';
								
							  
							}
							
							
							}
							else
						{
						            $final_result_1 =  'false';
									$final_result_3 =  'No Result';
									$final_result[] ='';
							
						}
							
								
							}
							else
							{
								$final_result_1 =  'false';
								$final_result_3 =  'Email Already Exist';
								$final_result[] ='';
								
							  
							}
							
						}
						else
						{
						            $final_result_1 =  'false';
									$final_result_3 =  'No Result';
									$final_result[] ='';
							
						}
						
						
					
					$json_response = json_encode(array('success'=>$final_result_1,'error'=>$final_result_3,'result'=>$final_result)); // return result
					
					sendResponse(200, $json_response);
			}
				
                 ////////////UserLogin//////////////

				public function UserLogin()
				{						
						$email=$_POST['emailid'];
						$password=$_POST['password'];
						//$usertype=$_POST['usertype'];						
						$facebook_id=$_POST['facebookid'];
						$latitude=$_POST['latitude'];
						$longitude=$_POST['longitude'];
				
						$c=0;
						if($facebook_id=="")
						{						
							$sql="SELECT `id` as userid, `firstname`, `lastname`, `emailid`, `password`, `usertype`, `phoneno`, `city`, `zipcode`, `website`, `facebookid`, `latitude`, `longitude`, `deviceId`, `golivestatus` as livestatus, `image`, `acceptorderstatus` FROM `userregistration` where emailid='$email' and password='$password'";
								
							$result=mysql_query($sql);		
							if($result)
							{
								if(mysql_num_rows($result)>0)
								{	
									$userInfo = mysql_fetch_assoc($result); 								
								    $final_result_1 =  'true';
									$final_result_3 =  '';										
									$response['userdata']=$userInfo;							
								}
								else
								{
								$final_result_1 =  'false';
								$final_result_3 =  'Invalid Email Id or Password';															
								$response['userdata']='';
									
								}
							}
							else
							{
							$final_result_1 =  'false';
							$final_result_3 =  'Invalid Email Id or Password';							
							$response['userdata']='';								
							}
						}
						/////For Facebook users
						else
						{							
							$sql="SELECT `id` as userid, `firstname`, `lastname`, `emailid`, `password`, `usertype`, `phoneno`, `city`, `zipcode`, `website`, `facebookid`, `latitude`, `longitude`, `deviceId`, `status` as livestatus, `image` FROM `userregistration` where facebookid='$facebook_id'";
							$result=mysql_query($sql);
							
							if($result)
							{	
								if(mysql_num_rows($result)>0)
								{									   
									$userInfo = mysql_fetch_assoc($result); 
									$final_result_1 =  'true';
									$final_result_3 =  '';																	
									$response['userdata']=$userInfo;																	
								
									$c=1;
								}
							}
							if($c==0)
							{
								$sql="INSERT INTO userregistration(firstname,lastname,emailid,password,usertype,phoneno,city,zipcode,website,facebookid,latitude,longitude,deviceId,status,image) VALUES ('','','$email','','$usertype','','','','','$facebook_id','','','',0,'')";
							
								$result=mysql_query($sql);
								if($result)
								{
								$user_id=mysql_insert_id();
								
								$sql1="SELECT `id` as userid, `firstname`, `lastname`, `emailid`, `password`, `usertype`, `phoneno`, `city`, `zipcode`, `website`, `facebookid`, `latitude`, `longitude`, `deviceId`, `status` as livestatus, `image` from userregistration where id=$user_id";								
								//echo $sql;
								$result1=mysql_query($sql1);		
								$row1 = mysql_fetch_assoc($result1);
								$final_result_1 =  'true';
								$final_result_3 =  '';								
								$response['userdata']=$row1;							
								}
								else
								{
								$final_result_1 =  'false';
								$final_result_3 =  'Data Not Inserted';
								//$final_result_4[]='';									
								$response['userdata']='';
								}
								
							}
							
						
						}
				    $json_response = json_encode(array('success'=>$final_result_1,'error'=>$final_result_3,'result'=>$response['userdata'])); // return result
					
					sendResponse(200, $json_response);
			}
			
                  //////////////////ForgotPassword
				  
		function ForgotPassword()
		{
         
                if (isset($_POST["email"]))
				{
                    $email = $_POST["email"];                    
                    $query = "SELECT * FROM userregistration WHERE emailid = '".$email."' LIMIT 1";
                    $query_result = mysql_query ($query);
                    $fetch_row = mysql_num_rows($query_result);                   
                    
                    if ( $fetch_row > 0 ) {
						$row=mysql_fetch_array($query_result);
						$Pass=$row['password'];
						$getid=$row['id'];
						$nm=$row['firstname'].$row['lastname'];						
$message='<table width="650" border="0" align="center" cellpadding="0" cellspacing="0">';
$message .='<tr>';
$message .='<td height="25" colspan="2" align="left" valign="middle" class="topfont colorGray"><strong>Dear,'.$nm.' Your Reset Password Link</strong></td>';
$message .='</tr>';
$message .='<tr>';
$message .='<td align="left" colspan="2" valign="middle" class="topfont colorGray"><a href="http://grubtracker.canopussystems.com/grublogin/newresetpassword.php">Click Here</a></td>';
$message .='</tr>';
$message .='<tr>';
$message .='<td align="left" colspan="2" valign="middle" class="topfont colorGray">&nbsp;</td>';
$message .='</tr>';
$message .='<tr>';
$message .='<td align="left" colspan="2" valign="middle" class="topfont colorGray">Thanks! </td>';
$message .='</tr>';
$message .='<tr>';
$message .='<td height="10" colspan="2" align="left" valign="middle" ></td>';
$message .='</tr>';											  
$message .='</table></td>';
$message .='</tr>';
$message .='</table>';						
						$email_to = $email;
						$email_subject="Reset Password";					
						//$email_from = "kapil.sariwal@canopusinfosystems.com";
						$email_message= $message;
						$headers = "MIME-Version: 1.0\r\n";
						$headers .= "Content-type: text/html; charset=ISO-8859-1\r\n";
						$headers .= 'From:php.admin@canopusinfosystems.com';
						if(mail($email_to, $email_subject, $email_message, $headers))
						{
								$final_result_1 =  'true';								
								$final_result_3 =  '';							
								$response='Your ResetPassword Link Send Successfully,Plz Check Your Email..';	
}							
						else
						{
								$final_result_1 =  'false';								
								$final_result_3 =  '';							
								$response='Invalid Email Id';							
						       								
                        }
						 
					}
					else
					{
								$final_result_1 =  'false';								
								$final_result_3 =  'Invalid Email Id';							
								$response='Invalid Email Id';    		
					}
			    }
				else
				{
								$final_result_1 =  'false';								
								$final_result_3 =  '';							
								$response='Invalid Email Id';
				}
				
					$json_response = json_encode(array('success'=>$final_result_1,'error'=>$final_result_3,'result'=>$response)); // return result
					
					sendResponse(200, $json_response);
                    
                    
        }
                   ///////////////////////GoLive			
			
				public function GoLive()				
				{
				$livestatus=$_POST['livestatus'];
				$vendorid=$_POST['vendorid'];
				$latitude=$_POST['latitude'];
				$longitude=$_POST['longitude'];
				
				$sql=mysql_query("update userregistration set golivestatus='$livestatus',latitude='$latitude',longitude='$longitude' where id='$vendorid'");
								
							if(mysql_affected_rows() == 1 )
							{
                                                            if($livestatus==1)
						            {
							        $final_result_1 =  'true';								
								$final_result_3 =  '';//$final_result_4='';								
								$response='Your GoLive Status Online Successfully,So Customers are able to Send you Order ';
                                                            }
                                                            else
						            {
							        $final_result_1 =  'true';								
								$final_result_3 =  '';//$final_result_4='';								
								$response='Your GoLive Status Offline Successfully,So Customers are not able to Send You Order';
                                                            }
							}							
							else
							{
							if($livestatus==1)
						            {
							        $final_result_1 =  'true';								
								$final_result_3 =  '';//$final_result_4='';								
								$response='Your GoLive Status Already On';
                                                            }
                                                            else
						            {
							        $final_result_1 =  'true';								
								$final_result_3 =  '';//$final_result_4='';								
								$response='Your GoLive Status Already Off';
                                                            }
							}
								
								$json_response = json_encode(array('success'=>$final_result_1,'error'=>$final_result_3,'result'=>$response)); // return result
					
					sendResponse(200, $json_response);
				}
				////////////////////////////Accept Order In App
				public function AcceptOrderInApp()				
				{
				$livestatus=$_POST['livestatus'];
				$vendorid=$_POST['vendorid'];
				$latitude=$_POST['latitude'];
				$longitude=$_POST['longitude'];
				
				$sql=mysql_query("update userregistration set acceptorderstatus='$livestatus',latitude='$latitude',longitude='$longitude' where id='$vendorid'");
								
							if(mysql_affected_rows() == 1 )
							{
						
							    $final_result_1 =  'true';								
								$final_result_3 =  '';//$final_result_4='';								
								$response='Vendor Accept Order Status Edited Successfully';
							}							
							else
							{
								$final_result_1 =  'true';									
								$final_result_3 =  '';
								$response='Vendor Accept Order Status Edited Successfully';
							}
								
								$json_response = json_encode(array('success'=>$final_result_1,'error'=>$final_result_3,'result'=>$response)); // return result
					
					sendResponse(200, $json_response);
				}
				
                ////////////GetAllOrderByVendorId
				
public function GetAllOrderByVendorId()				
{
	$vendorid=$_POST['vendorid'];
	$pagecount = $_REQUEST['pagecount'];
	$counter = $_REQUEST['pageindex']; 
	//$pagecount = 1;
	//$counter = 1; 
	
	$from=($counter-1)*$pagecount; 
 
 $sql=mysql_query("SELECT c.vid as cvid,c.datetime as cdatetime,c.id as cid,c.cid as ccid,c.totalamount as ctotalamount,c.tip as ctip,c.coupon as ccoupon,c.isspecial as cisspecial,c.orderstatus as corderstatus,u.firstname as ufirstname,u.lastname as ulastname,u.image as uimage FROM customerorder as c INNER JOIN userregistration as u ON c.cid=u.id where c.vid='$vendorid' order by c.id LIMIT ".$from.','.$pagecount);
		
		
 
 if(mysql_num_rows($sql))
	{	
	
	   while($userInfo = mysql_fetch_assoc($sql))
		{	   
		$count=$count['count'];
		$orderid = $userInfo['cid'];
		$vendorid = $userInfo['cvid'];
		$userid = $userInfo['ccid'];
		$datetime = $userInfo['cdatetime'];
		$totalamount = $userInfo['ctotalamount'];
		$tip = $userInfo['ctip'];
		$coupon = $userInfo['ccoupon'];
		$isspecial = $userInfo['cisspecial'];
		$firstname = $userInfo['ufirstname'];
		$lastname = $userInfo['ulastname'];
		$image = $userInfo['uimage']; 
        $corderstatus = $userInfo['corderstatus']; 		
		
		$final_result_2[] = array('customerid'=>$userid,'userid'=>$vendorid,'orderid'=>$orderid,'datetime'=>$datetime,'totalamount'=>$totalamount,'tip'=>$tip,'coupon'=>$coupon,'isspecial'=>$isspecial,'firstname'=>$firstname,'lastname'=>$lastname,'image'=>$image,'corderstatus'=>$corderstatus);
		}
	$sql1=mysql_query("select COUNT(*) as count from customerorder where vid='$vendorid' and orderstatus=0");
	if(mysql_num_rows($sql))
	{
	$userInfo1 = mysql_fetch_assoc($sql1);
	$count = $userInfo1['count'];
	$final_result_4[] = array('count'=>$count);	
	}
	else
	{
	$final_result_4='';
	}
	
									$final_result_1 =  'true';
									$final_result_3 =  '';
									$final_result['count'] = $final_result_4[0];
									$final_result['data'] = $final_result_2;
									$final_result1[]=$final_result;
									
	
	}
	else
	{
	$final_result_1 =  'false';
	$final_result_3 =  'No UserOrder For This Vendor ';
	$final_result1 ='';
	}
	$json_response = json_encode(array('success'=>$final_result_1,'error'=>$final_result_3,'result'=>$final_result1[0])); // return result
					
					sendResponse(200, $json_response);
	
}
/////////////////////////////////////////////InAppOrderDetails///////////////////////////////////////////////////////
public function InAppOrderDetails()				
{
 $vendorid=$_POST['vendorid'];
 $userid=$_POST['userid'];
 $orderid =$_POST['orderid'];

//$sql="select u.first_name,u.last_name,n.comment from news_comment as n,user as u where n.news_id='$news_id' and u.user_id=n.user_id";
 //$sql=mysql_query("select o.orderid,o.itemname,o.quantity,o.price from ordermenu as o  where o.orderid='$orderid'");
 $sql=mysql_query("select o.orderid,o.itemname,o.quantity,o.price,c.totalamount as totalamount,c.coupon as coupon,c.tip as tip from ordermenu as o INNER JOIN customerorder as c ON o.orderid=c.id where o.orderid='$orderid'");
 if(mysql_num_rows($sql))
	{
	   while($userInfo = mysql_fetch_assoc($sql))
{	   
		
		$orderid = $userInfo['orderid'];
		$itemname = $userInfo['itemname'];
		$quantity = $userInfo['quantity'];
		$price = $userInfo['price'];	
		
		$final_result_2[] = array('orderid'=>$orderid,'itemname'=>$itemname,'quantity'=>$quantity,'price'=>$price);
}
 $sql1=mysql_query("select o.orderid,o.itemname,o.quantity,o.price,c.totalamount as totalamount,c.coupon as coupon,c.tip as tip,c.subtotal as subtotal,c.orderstatus as orderstatus,u.image as image,u.firstname as firstname,u.lastname as lastname,u.phoneno as phoneno,u.emailid as emailid from ordermenu as o INNER JOIN customerorder as c ON o.orderid=c.id INNER JOIN userregistration as u ON u.id=c.cid  where o.orderid='$orderid'");

$userInfo1 = mysql_fetch_assoc($sql1);
$totalamount = $userInfo1['totalamount'];
$tip = $userInfo1['tip'];
$coupon = $userInfo1['coupon'];
$subtotal = $userInfo1['subtotal'];	
$orderstatus = $userInfo1['orderstatus'];
$image = $userInfo1['image'];
$firstname = $userInfo1['firstname'];
$lastname = $userInfo1['lastname'];	
$phoneno = $userInfo1['phoneno'];
$emailid = $userInfo1['emailid'];	
$username=$firstname.' '.$lastname;	
$final_result_4[] = array('username'=>$username,'totalamount'=>$totalamount,'tip'=>$tip,'coupon'=>$coupon,'subtotal'=>$subtotal,'orderstatus'=>$orderstatus,'image'=>$image,'phoneno'=>$phoneno,'emailid'=>$emailid);	
									$final_result_1 =  'true';
									$final_result_3 =  '';
									$final_result['AmountDetails'] = $final_result_4[0];
									$final_result['OrderDetails'] = $final_result_2;
									$final_result1[]=$final_result;
	}
	else
	{
		$final_result_1 =  'false';
		$final_result_3 =  'Invalid Order Id';
		$final_result1 ='';
	}
	
	$json_response = json_encode(array('success'=>$final_result_1,'error'=>$final_result_3,'result'=>$final_result1[0])); // return result
					
					sendResponse(200, $json_response);
	
}

//////////////////////////////////////////////OrderCompleteByVendor//////////////////////////////////////////////////

public function OrderCompleteByVendor()				
				{
				$orderstatus=$_POST['orderstatus'];
				$vendorid=$_POST['userid'];
				$userid=$_POST['customerid'];
				$orderid=$_POST['orderid'];
				
				$sql=mysql_query("update customerorder set orderstatus='$orderstatus' where id='$orderid' and vid='$vendorid'");
								
							if(mysql_affected_rows() == 1 )
							{
							    $final_result_1 =  'true';								
								$final_result_3 =  '';//$final_result_4='';								
								$response='Vendor Order Status Completed Successfully';
							}			
							
							else
							{
								$final_result_1 =  'false';									
								$final_result_3 =  'Error';
								$response='Vendor Order Status not Completed Successfully';
							}
								
								$json_response = json_encode(array('success'=>$final_result_1,'error'=>$final_result_3,'result'=>$response)); // return result
					
					sendResponse(200, $json_response);
				}

/////////////////////////////////////////////GetVendorDetails////////////////////////////////////////////////////////
				
public function GetVendorDetails()				
{
				$vendorid=$_POST['vendorid'];
				$sql=mysql_query("SELECT `id` as userid, `firstname`, `lastname`, `emailid`, `password`, `usertype`, `phoneno`, `city`, `zipcode`, `website`, `facebookid`, `latitude`, `longitude`, `deviceId`, `status` as livestatus, `image` from userregistration where id='$vendorid'");
				if(mysql_num_rows($sql))
	{
		$userInfo = mysql_fetch_assoc($sql); 
		//$userid = $userInfo['id'];
		//$firstname = $userInfo['firstname'];
		//$lastname = $userInfo['lastname'];
		//$emailid = $userInfo['emailid'];
		//$password = $userInfo['password'];
		//$usertype = $userInfo['usertype'];
		//$phoneno = $userInfo['phoneno'];
		//$city = $userInfo['city'];
		//$zipcode = $userInfo['zipcode'];
		//$website = $userInfo['website'];
		//$facebookid = $userInfo['facebookid'];
		//$latitude = $userInfo['latitude'];
		//$longitude = $userInfo['longitude'];
		//$deviceId = $userInfo['deviceId'];
		//$livestatus = $userInfo['livestatus'];
		//$image = $userInfo['image'];		
		//$final_result_2[] = array('vendorid'=>$userid,'vendorfirstname'=>$firstname,'vendorlastname'=>$lastname,'emailid'=>$emailid,'password'=>$password,'usertype'=>$usertype,'phoneno'=>$phoneno,'city'=>$city,'vendor_zipcode'=>$zipcode,'website'=>$website,'facebookid'=>$facebookid,'latitude'=>$latitude,'longitude'=>$longitude,'deviceId'=>$deviceId,'livestatus'=>$livestatus,'imageurl'=>$image);
								$final_result_1 =  'true';
								$final_result_3 =  '';
								$final_result = $userInfo;
	}
								
								
								else
								{
								$final_result_1 =  'false';									
								$final_result_3 =  'Invalid Vendor Id';
								$final_result='';
								}
								$json_response = json_encode(array('success'=>$final_result_1,'error'=>$final_result_3,'result'=>$final_result)); // return result
					
					sendResponse(200, $json_response);

}
//////////////////////////////////////Get Menu By VendorId///////////////////////////////////////		
				public function GetMenuByVendorId()				
				{
					$vendorid=$_POST['userid'];					
					$sql=mysql_query("SELECT menu.id as menuid,menu.itemname,menu.vid,menucategory.id,menucategory.name FROM menu INNER JOIN menucategory ON menu.categoryid=menucategory.id where menu.vid='$vendorid'");
					if(mysql_num_rows($sql))
						{
						while($userInfo = mysql_fetch_assoc($sql))
						{						
							$itemid = $userInfo['menuid'];
							$itemname = $userInfo['itemname'];
							$vendorid = $userInfo['vid'];
							$categoryid = $userInfo['id'];
							$categoryname = $userInfo['name'];
							
							$final_result_2[] = array('itemid'=>$itemid,'itemname'=>$itemname,'categoryid'=>$categoryid,'categoryname'=>$categoryname);
						}
						$sql1=mysql_query("SELECT id,name from menucategory where vid='$vendorid'");
					if(mysql_num_rows($sql1))
						{
						while($userInfo1 = mysql_fetch_assoc($sql1))
						{
						$categoryid = $userInfo1['id'];
							$categoryname = $userInfo1['name'];
						$final_result_4[] = array('categoryid'=>$categoryid,'categoryname'=>$categoryname);
						}
						}
						
						
								$final_result_1 =  'true';
													$final_result_3 =  '';
													$final_result['category'] = $final_result_4;
													$final_result['item'] = $final_result_2;
													$final_result1[]=$final_result;
						}
								
								else
								{
								$final_result_1 =  'false';									
								$final_result_3 =  'Invalid Vendor Id';
								$final_result1='';
								}
								$json_response = json_encode(array('success'=>$final_result_1,'error'=>$final_result_3,'result'=>$final_result1[0])); // return result
					
					sendResponse(200, $json_response);

				}
				//////////////////////////////////////Get User Order Details///////////////////////////////////////		
				public function GetUserOrderDetails()				
				{
					$orderid=$_POST['orderid'];
					
					$sql=mysql_query("SELECT * from ordermenu where orderid='$orderid'");
					if(mysql_num_rows($sql))
						{
						while($userInfo = mysql_fetch_assoc($sql))
						{
							$id=$userInfo['id'];
							$orderid = $userInfo['orderid'];
							$itemname = $userInfo['itemname'];
							$quantity = $userInfo['quantity'];
							$price = $userInfo['price'];
							$final_result_2[] = array('orderid'=>$orderid,'itemname'=>$itemname,'quantity'=>$quantity,'price'=>$price);
						}
								$final_result_1 =  'true';
													$final_result_3 =  '';
													$final_result = $final_result_2;
						}
						else
							{
							$final_result_1 =  'false';									
							$final_result_3 =  'Invalid Order Id';
							$final_result='';
							}
							$json_response = json_encode(array('success'=>$final_result_1,'error'=>$final_result_3,'result'=>$final_result)); // return result
					
							sendResponse(200, $json_response);

				}
				//////////////////////////////////////Get Special Offer By VendorId///////////////////////////////////////		
				public function GetSpecialOfferByVendorId()				
				{
					$vendorid=$_POST['userid'];
					$pagecount = $_REQUEST['pagecount'];
					$counter = $_REQUEST['pageindex']; 	
	
					$from=($counter-1)*$pagecount; 
					
					$sql=mysql_query("SELECT s.id as sid, s.vid as vid,s.toitem as toitem,s.fromitem as fromitem,s.mid as mid,s.discount as discount,s.status as status,s.type as type,s.datetime as datetime,s.expirydate as expirydate,menu.itemname from specialoffer as s INNER JOIN menu ON s.mid=menu.id where s.vid='$vendorid' order by sid desc LIMIT ".$from.','.$pagecount);
					if(mysql_num_rows($sql))
						{
						$final_result_2='';$final_result_4='';
						while($userInfo = mysql_fetch_assoc($sql))
						{
							$id=$userInfo['sid'];
							$vendorid = $userInfo['vid'];
							$tomenu = $userInfo['toitem'];
							$frommenu = $userInfo['fromitem'];
							$menuid = $userInfo['mid'];
							$discount = $userInfo['discount'];
							$itemname = $userInfo['itemname'];
							$status = $userInfo['status'];
							$datetime = $userInfo['datetime'];
							$expirydate = $userInfo['expirydate'];
							$type = $userInfo['type'];
							
							
							$final_result_2[] = array('specialofferid'=>$id,'userid'=>$vendorid,'tomenu'=>$tomenu,'frommenu'=>$frommenu,'menuid'=>$menuid,'itemname'=>$itemname,'status'=>$status,'datetime'=>$datetime,'expirydate'=>$expirydate,'discount'=>$discount,'type'=>$type);
							
						}	
								$final_result_1='true';
								$final_result_3='';
								$final_result=$final_result_2;
						}
						else
							{
							$final_result_1 =  'false';									
							$final_result_3 =  'Invalid VendorId Id';
							$final_result='';
							}
							$json_response = json_encode(array('success'=>$final_result_1,'error'=>$final_result_3,'result'=>$final_result)); // return result
					
					sendResponse(200, $json_response);

				}
				
				//////////////////////////////////////Create New Special Offer///////////////////////////////////////
				public function CreateNewSpecialOffer()
				{
					$vendorid=$_POST["userid"];
					$tomenu=$_POST["tomenu"];
					$frommenu=$_POST["frommenu"];
					$menuid=$_POST["menuid"];
					$discount=$_POST["discount"];
					$status=$_POST["status"];
					$expirydate=$_POST["expirydate"];
					$type=$_POST["type"];
					
					$sql="select * from specialoffer where vid='$vendorid' and toitem='$tomenu' and fromitem='$frommenu' and mid='$menuid' and discount='$discount'";
					
					$result=mysql_query($sql);
					if($result)
						{
							if(mysql_num_rows($result)<=0)
								{
									$sql="INSERT INTO specialoffer(vid,toitem,fromitem,mid,discount,status,expirydate,type)VALUES('$vendorid','$tomenu','$frommenu','$menuid','$discount','$status','$expirydate','$type')";									
									$result=mysql_query($sql);
									if($result)
										{
											$user_id=mysql_insert_id();
											$checkreg=mysql_query("SELECT * from specialoffer where id='$user_id'");
											if(mysql_num_rows($checkreg))
												{
													$userInfo=mysql_fetch_assoc($checkreg);
													$specialmenuid=$userInfo['id'];
													$vendorid=$userInfo['vid'];
													$tomenu=$userInfo['toitem'];
													$frommenu=$userInfo['fromitem'];
													$menuid=$userInfo['mid'];
													$discount=$userInfo['discount'];
													$status=$userInfo['status'];
													$expirydate=$userInfo['expirydate'];
													$final_result_2[]=array('specialmenuid'=>$specialmenuid,'vendorid'=>$vendorid,'tomenu'=>$tomenu,'frommenu'=>$frommenu,'menuid'=>$menuid,'discount'=>$discount,'status'=>$status,'expirydate'=>$expirydate,'type'=>$type);
												}
												$final_result_1='true';
												$final_result_3='';
												$final_result=$final_result_2;
										}
									else
									{
								$final_result_1='false';
								$final_result_3='Offer Not Inserted';
								$final_result='';
										}
								}
							else
								{
								$final_result_1='false';
								$final_result_3='Offer Already Exist';
								$final_result='';
								}
						}
						else
							{
							$final_result_1='false';
							$final_result_3='NoResult';
							$final_result='';

							}
						$json_response=json_encode(array('success'=>$final_result_1,'error'=>$final_result_3,'result'=>$final_result));//return result

						sendResponse(200,$json_response);
				}
				//////////////////specialofferstatus
				public function SpecialOfferStatusUpdatedById()				
				{
				$sid=$_POST['specialofferid'];				
				
				$sql=mysql_query("update specialoffer set status=1 where id='$sid'");
								
							if(mysql_affected_rows() == 1 )
							{
						
							    $final_result_1 =  'true';								
								$final_result_3 =  '';
								$response='Special Offer Activated Successfully';
							}			
							
							else
							{
							$checkreg=mysql_query("update specialoffer set status=0 where id='$sid'");
											if(mysql_affected_rows() == 1)
												{
													$final_result_1 =  'false';									
													$final_result_3 =  '';
													}
												else
												{
													$final_result_1 =  'false';									
													$final_result_3 =  '';
													$response='Invalid Special Offer Id';
												}
								
							}
								
								$json_response = json_encode(array('success'=>$final_result_1,'error'=>$final_result_3,'result'=>$response)); // return result
					
					sendResponse(200, $json_response);
				}
				/////////////////
	 //////////////////////////////////////Get Review Details By VendorId///////////////////////////////////////		
				public function GetReviewDetailsByVendorId()				
				{
					$reviewid=$_POST['reviewid'];
					$vendorid=$_POST['vendorid'];
					$sql=mysql_query("UPDATE `review` SET `isread`=1 WHERE id='$reviewid'");
					if(mysql_affected_rows() >= 0 )
							{
							$sql1=mysql_query("SELECT review.id, review.cid,review.starcount,review.review,userregistration.image,userregistration.firstname,userregistration.lastname,userregistration.phoneno,userregistration.emailid,review.datetime FROM review INNER JOIN userregistration ON review.cid=userregistration.id where review.id='$reviewid'");
					if(mysql_num_rows($sql1))
						{
							$userInfo = mysql_fetch_assoc($sql1);
							$reviewid=$userInfo['id'];
							$userid = $userInfo['cid'];
							$imageurl = $userInfo['image'];
							$userfirstname = $userInfo['firstname'];
							$userlastname = $userInfo['lastname'];
							$datetime = $userInfo['datetime'];
							$starrating = $userInfo['starcount'];
							$reviewdetails=$userInfo['review'];
							$phoneno = $userInfo['phoneno'];
							$emailid=$userInfo['emailid'];
							$username=$userfirstname.' '.$userlastname;
							$final_result_2[] = array('reviewid'=>$reviewid,'customerid'=>$userid,'imageurl'=>$imageurl,'username'=>$username,'datetime'=>$datetime,'starrating'=>$starrating,'reviewdetails'=>$reviewdetails,'phoneno'=>$phoneno,'emailid'=>$emailid);

								$final_result_1 =  'true';
													$final_result_3 =  '';
													$final_result = $final_result_2;
						}
						else
							{
							$final_result_1 =  'false';									
							$final_result_3 =  'Invalid Review Id';
							$final_result='';
							}
							}
							else
							{
							$final_result_1 =  'false';									
							$final_result_3 =  'Invalid Review Id';
							$final_result='';
							}
					
							$json_response = json_encode(array('success'=>$final_result_1,'error'=>$final_result_3,'result'=>$final_result)); // return result
					
					sendResponse(200, $json_response);

				}
				//////////////////////////////////////Get User Review By VendorId///////////////////////////////////////		
				public function GetUserReviewByVendorId()				
				{
					$vendorid=$_POST['vendorid'];
					$pagecount = $_REQUEST['pagecount'];
					$counter = $_REQUEST['pageindex']; 
					$from=($counter-1)*$pagecount; 
					
					$sql=mysql_query("SELECT review.id, review.cid, review.starcount, review.isread, review.review, userregistration.image, userregistration.firstname, userregistration.lastname, review.datetime FROM review INNER JOIN userregistration ON review.cid=userregistration.id where vid='$vendorid' order by isread asc LIMIT ".$from.','.$pagecount);
					if(mysql_num_rows($sql))
						{
						while($userInfo = mysql_fetch_assoc($sql))
						{
							$reviewid=$userInfo['id'];
							$userid = $userInfo['cid'];
							$imageurl = $userInfo['image'];
							$userfirstname = $userInfo['firstname'];
							$userlastname = $userInfo['lastname'];
							$datetime = $userInfo['datetime'];
							$starrating = $userInfo['starcount'];
							$isread = $userInfo['isread'];
							$review = $userInfo['review'];
							$username=$userfirstname.' '.$userlastname;
							$final_result_2[] = array('reviewid'=>$reviewid,'customerid'=>$userid,'imageurl'=>$imageurl,'username'=>$username,'datetime'=>$datetime,'starrating'=>$starrating,'isread'=>$isread,'review'=>$review);
                        }
						$sql1=mysql_query("select COUNT(*) as count from review where vid='$vendorid' and isread=0");
	if(mysql_num_rows($sql))
	{
	$userInfo1 = mysql_fetch_assoc($sql1);
	$count = $userInfo1['count'];
	$final_result_4[] = array('count'=>$count);	
	}
	else
	{
	$final_result_4='';
	}
						
						
						
								$final_result_1 =  'true';
													$final_result_3 =  '';
													$final_result['count'] = $final_result_4[0];
									$final_result['data'] = $final_result_2;
									$final_result1[]=$final_result;
									
						}
						else
							{
							$final_result_1 =  'false';
							$final_result_3 =  'No Data For this VendorId';
							$final_result='';
							}
							$json_response = json_encode(array('success'=>$final_result_1,'error'=>$final_result_3,'result'=>$final_result1[0])); // return result
					
					sendResponse(200, $json_response);

				}				
//////////////////////////////////////Get User Order Detail///////////////////////////////////////		
				public function GetUserOrderDetail()				
				{
					$userid=$_POST['userid'];						
					$sql=mysql_query("SELECT customerorder.vid as vid,customerorder.datetime,customerorder.id as oid,userregistration.id as id,userregistration.firstname,userregistration.lastname,userregistration.image FROM customerorder INNER JOIN userregistration ON customerorder.cid=userregistration.id where customerorder.cid='$userid'");
					if(mysql_num_rows($sql))
						{
						
						while($userInfo = mysql_fetch_assoc($sql))
						{
							$vendorid=$userInfo['vid'];
							$userfirstname = $userInfo['firstname'];
							$userlastname = $userInfo['lastname'];
							$vendorname=$userfirstname.' '.$userlastname;
							$imageurl = $userInfo['image'];
							$datetime = $userInfo['datetime'];
							//$count = $userInfo['lastname'];
							$orderid = $userInfo['oid'];
							
							$final_result_2[] = array('vendorid'=>$vendorid,'vendorname'=>$vendorname,'imageurl'=>$imageurl,'datetime'=>$datetime,'orderid'=>$orderid);
                        }
								$final_result_1 =  'true';
													$final_result_3 =  '';
													$final_result = $final_result_2;
						}
						else
							{
							$final_result_1 =  'false';
							$final_result_3 =  'Invalid UserId';
							$final_result='';
							}
							$json_response = json_encode(array('success'=>$final_result_1,'error'=>$final_result_3,'result'=>$final_result)); // return result
					
					sendResponse(200, $json_response);

				}				


//////////////////////////////////////Update Profile///////////////////////////////////////		
				public function updateprofile()
				{
					//$id=$_POST["id"];
					$emailid=$_POST["emailid"];
					$firstname=$_POST["firstname"];
					$lastname=$_POST["lastname"];
					$username=$firstname.' '.$lastname;
					$password=$_POST["password"];
				//	$usertype=$_POST["usertype"];
					$phoneno=$_POST["phoneno"];
					$city=$_POST["city"];
					$zipcode=$_POST["zipcode"];
					$website=$_POST["website"];
					$facebookid=$_POST["facebookid"];
					$latitude=$_POST["latitude"];
					$longitude=$_POST["longitude"];
					$deviceId=$_POST["deviceId"];
					if(isset($_POST["image"])){
						
						define('UPLOAD_DIR','images/');
$img = $_POST["image"];

$img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$data = base64_decode($img);

$file = UPLOAD_DIR . uniqid() . '.png';

$success = file_put_contents($file, $data);
    $files='http://'.$_SERVER['HTTP_HOST'].'/'. $file;
}  
					
				$sql="SELECT emailid FROM `userregistration` WHERE emailid='$emailid'";
					$result=mysql_query($sql);
					if($result)
					{
						$data=mysql_fetch_array($result);
						$mail=$data['emailid'];
						if($mail==$emailid)
						{
							
							$s=	$s="UPDATE `userregistration` SET `firstname`='$firstname',`lastname`='$lastname', password='$password', phoneno='$phoneno', city='$city', zipcode='$zipcode', website='$website', facebookid='$facebookid', latitude='$latitude', longitude='$longitude', deviceId='$deviceId',image='$files' WHERE `emailid`='$emailid'";
							//echo $s;
							$res=mysql_query($s);
							//echo $res;
							if((mysql_affected_rows() == 1 ) or die(mysql_error()))
							{
								$final_result_2[] = array('username'=>$username,'password'=>$password,'phoneno'=>$phoneno,'city'=>$city,'zipcode'=>$zipcode,'website'=>$website,'facebookid'=>$facebookid,'latitude'=>$latitude,'longitude'=>$longitude,'deviceId'=>$deviceId,'image'=>$files);

								$final_result_1 =  'true';
								$final_result_3 =  '';
								$final_result = $final_result_2;
							}
							
							else
							{ 
							//echo 'hello';
							$final_result_1 =  'false';
							$final_result_3 =  'Data not updated';
							$final_result[]='';
							}
						}
						else
						{
							//echo 'hi';
							$final_result_1='false';
							$final_result_3='No such user';
							$final_result[]='';
						}
							
					}
					$json_response = json_encode(array('success'=>$final_result_1,'error'=>$final_result_3,'result'=>$final_result)); // return result
							sendResponse(200, $json_response);	
				}
								

 //////////////////////////////////////New Get Menu By VendorId///////////////////////////////////////       
                public function NewGetMenuByVendorId()               
                {
                    $vendorid=$_POST['userid'];                   
                    $sql=mysql_query("select  DISTINCT * from menucategory where vid='$vendorid'");
                    if(mysql_num_rows($sql))
                        {
                        while($userInfo = mysql_fetch_assoc($sql))
                        {                       
                            $vendorid = $userInfo['vid'];
                            $categoryid = $userInfo['id'];
                            $categoryname = $userInfo['name'];
                            $myArray = array();
                            $myArray=array('categoryid'=>$categoryid,'categoryname'=>$categoryname);
                            $final_result_2[]= $myArray;
                            $sql1=mysql_query("SELECT DISTINCT * from menu where   categoryid='$categoryid' " );
                           
                            while($data = mysql_fetch_assoc($sql1))
                            {
                                $itemid=$data['id'];
                                $itemname=$data['itemname'];
                                $catid=$data['categoryid'];
                               
                                $myArray1 = array();
                               
                               
$myArray1 = array('itemid'=>$itemid ,'itemname'=>$itemname,'remark'=>$remark,'description'=>$description,'itemimage'=>$itemimage,'categoryid'=>$categoryid);
                                   
                                    $final_result_4[]=$myArray1;
                                   
                                                   
                            }
                        }
                        /*$sql1=mysql_query("SELECT * from menu where   categoryid='$categoryid' " );
                    if(mysql_num_rows($sql1))
                        {
                        while($userInfo1 = mysql_fetch_assoc($sql1))
                        {
                        $itemid = $userInfo1['id'];
                            $itemname = $userInfo1['itemname'];
                        $final_result_4[] = array('itemid'=>$itemid ,'itemname'=>$itemname);
                        }
                        }*/
                       
                       
                                $final_result_1 =  'true';
                                                    $final_result_3 =  '';
                                                   
                                                    $final_result['category'] = $final_result_2;
                                                    $final_result['item'] = $final_result_4;
                                                    $final_result1[]=$final_result;
                        }
                               
                                else
                                {
                                $final_result_1 =  'false';                                   
                                $final_result_3 =  'Invalid Vendor Id';
                                $final_result1='';
                                }
                                $json_response = json_encode(array('success'=>$final_result_1,'error'=>$final_result_3,'result'=>$final_result1)); // return result
                   
                    sendResponse(200, $json_response);

                }
//////////////////////////////////////Get Vendors///////////////////////////////////////		
				public function GetVendors()				
				{

					$sql=mysql_query("SELECT id,firstname,lastname,image,latitude,longitude,golivestatus FROM `userregistration` WHERE usertype='1'");
					if(mysql_num_rows($sql))
						{
						while($userInfo = mysql_fetch_assoc($sql))
						{	$vendorid = $userInfo['id'];
							$userfirstname = $userInfo['firstname'];
							$userlastname = $userInfo['lastname'];

							$vendorname=$userfirstname.' '.$userlastname;

							$imageurl = $userInfo['image'];
							$latitude = $userInfo['latitude'];
							$longitude = $userInfo['longitude'];
							$status = $userInfo['status'];
							
							$final_result_2[] = array('vendorid'=>$vendorid,'vendorname'=>$vendorname,'imageurl'=>$imageurl,'latitude'=>$latitude,'longitude'=>$longitude,'status'=>$status);
}
								$final_result_1 =  'true';
													$final_result_3 =  '';
													$final_result = $final_result_2;
						}
						else
							{
							$final_result_1 =  'false';
							$final_result_3 =  'Vendor Not Find';
							$final_result='';
							}
							$json_response = json_encode(array('success'=>$final_result_1,'error'=>$final_result_3,'result'=>$final_result)); // return result
					
					sendResponse(200, $json_response);

				}				
	 
}// end class
        
        $api = new grubtracker(); 
          
        switch ($_POST['Method']) {            
           
			case 'UserRegistration':            
                $api->UserRegistration();            
                break;
			case 'UserLogin':            
                $api->UserLogin();            
                break; 
            case 'GoLive':            
                $api->GoLive();            
                break; 
			case 'GetVendorDetails':            
                $api->GetVendorDetails();            
                break;
			case 'GetAllOrderByVendorId':            
                $api->GetAllOrderByVendorId();            
                break;
			case 'ForgotPassword':            
                $api->ForgotPassword();            
                break;      
			case 'InAppOrderDetails':            
                $api->InAppOrderDetails();            
                break;
			case 'OrderCompleteByVendor':            
                $api->OrderCompleteByVendor();            
                break;   
			case 'GetMenuByVendorId':            
                $api->GetMenuByVendorId();            
                break;  
			case 'GetUserOrderDetails':            
                $api->GetUserOrderDetails();            
                break;	
			case 'GetSpecialOfferByVendorId':            
                $api->GetSpecialOfferByVendorId();            
                break;
            case 'CreateNewSpecialOffer':            
                $api->CreateNewSpecialOffer();            
                break;	
            case 'GetReviewDetailsByVendorId':            
                $api->GetReviewDetailsByVendorId();            
                break;					
			case 'GetUserReviewByVendorId':            
                $api->GetUserReviewByVendorId();            
                break;                      			
			case 'GetUserOrderDetail':            
                $api->GetUserOrderDetail();            
                break;		
			case 'GetVendors':            
                $api->GetVendors();          
                break;	
            case 'SpecialOfferStatusUpdatedById':            
                $api->SpecialOfferStatusUpdatedById();           
                break;
			case 'AcceptOrderInApp':            
                $api->AcceptOrderInApp();           
                break;
               	 case 'updateprofile':            
                $api->updateprofile();           
                break;
case 'NewGetMenuByVendorId':           
                $api->NewGetMenuByVendorId();           
                break;
            default: 
           		
				 $final_result_1 =  'false';
				 $final_result_3 =  'Invalid Request';
				 $final_result_4='';
				 $final_result[] =$final_result_4;							
				 $json_response = json_encode(array('success'=>$final_result_1,'error'=>$final_result_3,'result'=>$final_result)); // return result
                 sendResponse(200, $json_response);
                 break;	
            }
    ?>