<?php
session_start();
//error_reporting(0);
define('SMPT_SERVER_HOST','mail.scangroup.biz');// SMPT_SERVER_HOST
define('SMPT_SERVER_PORT','2525');// SMPT_SERVER_PORT
define('SMPT_EMAIL_ACCOUNT','');// SMPT_EMAIL_ACCOUNT
define('SMPT_EMAIL_PASSWORD','');// SMPT_EMAIL_PASSWORD
define('EMAIL_SENDING_ADDRESS','george.waweru@squaddigital.com');// EMAIL_SENDING_ADDRESS
define('EMAIL_SENDING_NAME','Safaricom Athletics');// EMAIL_SENDING_NAME
define('EMAIL_SUBJECT','Safaricom Athletics');// EMAIL_SUBJECT
require("class.phpmailer.php");


$company_name=isset($_REQUEST['company_name']) ? base64_decode($_REQUEST['company_name']):'';
$contact_person=isset($_REQUEST['contact_person']) ? base64_decode($_REQUEST['contact_person']):'';
$email=isset($_REQUEST['email']) ? base64_decode($_REQUEST['email']):'';
$password=isset($_REQUEST['password']) ? base64_decode($_REQUEST['password']):'';
$site_path=Yii::app()->user->getState('pageSize',Yii::app()->params['site_path']);
$login_link="<a href=".$site_path." target='_blank'>".$site_path."</a>";
									

function SendEmail($email_subject, $email_body, $send_to_email, $user_names, $debug_mode = 0){
  $mail = new PHPMailer();
  $mail->IsHTML(true);
  //$mail->AddEmbeddedImage("mpesa_logo.png", "mpesa_logo", "mpesa_logo.png");
  $mail->AddEmbeddedImage("athletics_edm.jpg", "athletics_edm", "athletics_edm.jpg");
  $mail->AddEmbeddedImage("call.jpg", "call", "call.jpg");
  $mail->IsSMTP();
  $mail->SMTPDebug  = false;
  $mail->do_debug = 0;
  $mail->SMTPAuth   = false;
  $mail->Host       = SMPT_SERVER_HOST;
  $mail->SetFrom(EMAIL_SENDING_ADDRESS, EMAIL_SENDING_NAME);
  $mail->Subject    = !empty($email_subject) ? $email_subject : "";
  $mail->AltBody    = "To view the message, please use an HTML compatible email viewer!";
  $email_body = !empty($email_body) ? $email_body : "";
  $mail->MsgHTML($email_body);
  $send_to_name = !empty($send_to_name) ? $send_to_name : "";
  $mail->AddAddress($send_to_email, $send_to_name);
  if(!$mail->Send()) {
   //return $mail->ErrorInfo;
  } else {
    return true;
  } 
 }


$Century_Gothic='Century Gothic'; 
$apostrophy="'";
$email_body='
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title></title>
</head>
<body>
Dear '.$contact_person.',
<br><br>

The company <b>'.$company_name.'</b> as been created.<br><br>
use the blow details to login. <br><br>
<b>Login Url:</b>  '.$login_link.'<br><br>
<b>Email:</b>  '.$email.'<br><br>
<b>Password:</b> '.$password.'<br><br>
</body>
</html>';

SendEmail("Company Created", $email_body, $email,$user_names, $debug_mode = 0);
echo 1;
?>