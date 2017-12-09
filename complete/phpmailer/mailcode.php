<?php

include("PhpMailer/class.phpmailer.php");
$sender_email = "no-reply@icaiindoreonline.org";
$sender_password = "icairegister";
$sender_name = "Indore ICAI";
//$send_to = $row['email_id'];
$send_to = 'vmakkadd@gmail.com';

$mail = new PHPMailer();
$mail->IsSMTP();  // set mailer to use SMTP
$mail->Host = "p3plcpnl0372.prod.phx3.secureserver.net";  // specify main and backup server
$mail->Port = 465;
$mail->Username = $sender_email;  // SMTP username
$mail->Password = $sender_password; // SMTP password
$mail->SMTPAuth = true;     // turn on SMTP authentication
$mail->SMTPSecure = 'ssl';

$mail->From = $sender_email;
$mail->FromName = $sender_name;
$mail->AddAddress($send_to);
$mail->AddReplyTo($sender_email, $sender_name);

$mail->WordWrap = 50;                                 // set word wrap to 50 characters
$mail->IsHTML(true);                                  // set email format to HTML
$mail->Subject = "Transaction Successful to Indore ICAI";
$mail->Body = "ad";
$mail->Send();
?>