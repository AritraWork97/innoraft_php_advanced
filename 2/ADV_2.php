<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';
require '../../../.cred/auth.php';

$email_addr = $emailErr="";

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
 }

 if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["email"])) {
       $emailErr = "First Name is required";
    }else {
       $email_addr = test_input($_POST["email"]);
    }
}

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
    $mail->addAddress($email_addr); 
    $mail->addAddress($email_addr, 'Aritra banerjee'); 
       
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