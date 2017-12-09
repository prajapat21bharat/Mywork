<?php
date_default_timezone_set('Etc/UTC');
require 'PHPMailerAutoload.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               						// Enable verbose debug output

$mail->isSMTP();															// Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';												// Specify main and backup SMTP servers
$mail->SMTPAuth = true;														// Enable SMTP authentication
$mail->Username = 'bharat.prajapat@newtechfusion.com';						// SMTP username
$mail->Password = 'ntf12345';												// SMTP password
$mail->SMTPSecure = 'tls';													// Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;															// TCP port to connect to

$mail->setFrom('prajapat21bharat@gmail.com', 'Admin');
$mail->addAddress('tachnew3@gmail.com', 'Bharat Prajapat');					// Add a recipient
$mail->addReplyTo('prajapat21bharat@gmail.com', 'Admin');

$mail->addCC('tachnew3@gmail.com');
$mail->addBCC('patel21devendra@gmail.com');

$mail->addAttachment('attachment/confidentially.png');						// Add attachments
$mail->addAttachment('attachment/test doc.docx', 'test doc.docx');			// Optional name
$mail->addAttachment('attachment/test.pdf', 'test.pdf');					// Optional name
$mail->isHTML(true);														// Set email format to HTML

$mail->Subject = 'Here is the subject';
$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send())
{
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}
else
{
    echo 'Message has been sent';
}
