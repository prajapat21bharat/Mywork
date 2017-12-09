<?php

/*
 * What protocol to use?
 * mail, sendmail, smtp
 */
$config['protocol'] = 'mail';
//$config['protocol'] = 'sendmail';

/*
 * SMTP server address and port
 */
$config['smtp_host'] = '';
$config['smtp_port'] = '';

/*
 * SMTP username and password.
 */
$config['smtp_user'] = '';
$config['smtp_pass'] = '';



$config['mailpath'] = '/usr/sbin/sendmail';
$config['charset'] = 'iso-8859-1';
$config['wordwrap'] = TRUE;

//$this->email->initialize($config);
/*
 * Heroku Sendgrid information.
 */
/*
$config['protocol'] = 'smtp';
$config['smtp_host'] = 'smtp.sendgrid.net';
$config['smtp_port'] = 587;
$config['smtp_user'] = $_SERVER['SENDGRID_USERNAME'];
$config['smtp_pass'] = $_SERVER['SENDGRID_PASSWORD'];
*/
