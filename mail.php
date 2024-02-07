<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

$errors ='';

if (empty($_POST['fname']) || empty($_POST['email']) || empty($_POST['phone']) || empty($_POST['service'])){
		$errors = 'Please Fill All fields';
		echo $errors;
		return false; 
}

if(is_numeric($_POST['fname'])){
	$errors = 'Please Enter Valid Name';
	echo $errors;
	return false;
}

function checkemail($str) {
   return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
   }
if(!checkemail($_POST['email'])){
	$errors = 'Please Enter Valid Email';
	echo $errors;
	return false;
}


if(!is_numeric($_POST['phone'])){
	$errors = 'Please Enter Valid Phone Number';
	echo $errors;
	return false;
}else{

$email_body_msg = '<!doctype html>
<html lang="en-US">
   <head>
      <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
      <title>Appointment Reminder Email Template</title>
      <meta name="description" content="New Lead From Google Ads">
   </head>
   <style>
      a:hover {text-decoration: underline !important;}
      td{font-size:15px;}
   </style>
   <body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f2f3f8;" leftmargin="0">
      <table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8"
         style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: "Open Sans", sans-serif;">
         <tr>
            <td>
               <table style="background-color: #f2f3f8; max-width:670px; margin:0 auto;" width="100%" border="0"
                  align="center" cellpadding="0" cellspacing="0">
                  <tr>
                     <td style="height:80px;">&nbsp;</td>
                  </tr>
                  <!-- Logo -->
                  <tr>
                     <td style="text-align:center;">
                        <a href="#" title="logo" target="_blank">
                        <img width="100" src="https://3ggsdo3d4yry1qyouz2jp6bb-wpengine.netdna-ssl.com/wp-content/uploads/2022/05/Final-03.png" title="logo" alt="logo">
                        </a>
                     </td>
                  </tr>
                  <tr>
                     <td style="height:20px;">&nbsp;</td>
                  </tr>
                  <!-- Email Content -->
                  <tr>
                     <td>
                        <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"
                           style="max-width:670px; background:#fff; border-radius:3px;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);padding:0 40px;">
                           <tr>
                              <td style="height:40px;">&nbsp;</td>
                           </tr>
                           <!-- Title -->
                           <tr>
                              <td style="padding:0 15px; text-align:center;">
                                 <h1 style="color:#1e1e2d; font-weight:400; margin:0;font-size:32px;font-family:"Rubik",sans-serif;">New Lead From Google Ads</h1>
                                 <span style="display:inline-block; vertical-align:middle; margin:29px 0 26px; border-bottom:1px solid #cecece; 
                                    width:100px;"></span>
                              </td>
                           </tr>
                           <!-- Details Table -->
                           <tr>
                              <td>
                                 <table cellpadding="0" cellspacing="0"
                                    style="width: 100%; border: 1px solid #ededed">
                                    <tbody>
                                       <tr>
                                          <td
                                             style="padding: 10px; border-bottom: 1px solid #ededed; border-right: 1px solid #ededed; width: 35%; font-weight:500; color:rgba(0,0,0,.64)">
                                             Name :
                                          </td>
                                          <td
                                             style="padding: 10px; border-bottom: 1px solid #ededed; color: #455056;">
                                             '.$_POST['fname'].'
                                          </td>
                                       </tr>
                                       <tr>
                                          <td
                                             style="padding: 10px; border-bottom: 1px solid #ededed; border-right: 1px solid #ededed; width: 35%; font-weight:500; color:rgba(0,0,0,.64)">
                                             Email :
                                          </td>
                                          <td
                                             style="padding: 10px; border-bottom: 1px solid #ededed; color: #455056;">
                                             '.$_POST['email'].'
                                          </td>
                                       </tr>
                                       <tr>
                                          <td
                                             style="padding: 10px; border-bottom: 1px solid #ededed; border-right: 1px solid #ededed; width: 35%; font-weight:500; color:rgba(0,0,0,.64)">
                                             Phone Number :
                                          </td>
                                          <td
                                             style="padding: 10px; border-bottom: 1px solid #ededed; color: #455056;">
                                             '.$_POST['phone'].'
                                          </td>
                                       </tr>
                                       <tr>
                                          <td
                                             style="padding: 10px; border-bottom: 1px solid #ededed;border-right: 1px solid #ededed; width: 35%; font-weight:500; color:rgba(0,0,0,.64)">
                                             Selected Service :
                                          </td>
                                          <td
                                             style="padding: 10px; border-bottom: 1px solid #ededed; color: #455056;">
                                             '.$_POST['service'].'
                                          </td>
                                       </tr>
                                       <tr>
                                          <td
                                             style="padding: 10px;  border-bottom: 1px solid #ededed; border-right: 1px solid #ededed; width: 35%;font-weight:500; color:rgba(0,0,0,.64)">
                                             Message :
                                          </td>
                                          <td
                                             style="padding: 10px; border-bottom: 1px solid #ededed; color: #455056;">
                                             '.$_POST['message'].'
                                          </td>
                                       </tr>
                                    </tbody>
                                 </table>
                              </td>
                           </tr>
                           <tr>
                              <td style="height:40px;">&nbsp;</td>
                           </tr>
                        </table>
                     </td>
                  </tr>
                  <tr>
                     <td style="height:20px;">&nbsp;</td>
                  </tr>
               </table>
            </td>
         </tr>
      </table>
   </body>
</html>';


//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->SMTPDebug = false;                                     //Enable verbose debug output
    $mail->isSMTP();                                             //Send using SMTP
    $mail->Host       = 'smtp-relay.sendinblue.com';            //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'amit@delimp.com';                     //SMTP username
    $mail->Password   = '5gtSQTcm6vZp1Cn0';                   //SMTP password
    $mail->SMTPSecure = 'TLS';                               //Enable implicit TLS encryption
    $mail->Port       = 587;                                //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('info@delimp.com', 'Delimp Techonology');
    $mail->addAddress('shivam.tiwari@delimp.com', 'Delimp Techonology');     //Add a recipient
    // $mail->addReplyTo('sales@delimp.com', 'Information');
    // $mail->addCC('delimpwork@gmail.com');




    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'New Lead From Google Ads';
    $mail->Body    = $email_body_msg;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

}


?>