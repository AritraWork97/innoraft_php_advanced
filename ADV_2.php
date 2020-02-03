<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './vendor/autoload.php';
require '../../.cred/auth.php';

$mail = new PHPMailer(true); 
$mail->IsSMTP();
$mail->Mailer = "smtp";
  
try { 
    $mail->SMTPDebug  = 1;  
    $mail->SMTPAuth   = TRUE;
    $mail->SMTPSecure = "tls";
    $mail->Port       = 587;
    $mail->Host       = "smtp.gmail.com";
    $mail->Username   = $username;
    $mail->Password   = $password;

    $mail->setFrom('aritraWorkBanerjee@gmail.com', 'Aritra Banerjee',0);            
    $mail->addAddress('aritrabanerjee97@gmail.com'); 
    $mail->addAddress('aritrabanerjee97@gmail.com', 'Aritra banerjee'); 
       
    $mail->isHTML(true);                                   
    $mail->Subject = 'Subject'; 
    $mail->Body    = 'HTML message body in <b>bold</b> '; 
    $mail->AltBody = 'Body in plain text for non-HTML mail clients'; 
    if(!$mail->send())
    {
        echo "Mail has not been send!";
    }  
    else
    {
        echo "Mail has been send";
    }
} catch (Exception $e) { 
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"; 
} 
  

?>