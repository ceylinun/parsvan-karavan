<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';


$fullname = $_POST["fullname"];
$email = $_POST["email"];
$message = $_POST["message"];


$mail = new PHPMailer();

try {
    
    $mail->SMTPDebug = false;                     
    $mail->isSMTP();                                           
    $mail->Host       = 'smtp-relay.brevo.com';                     
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = 'ceeyliin1@gmail.com';                     
    $mail->Password   = 'ySqd5U02Rmk93PAV';                              
    $mail->SMTPSecure = 'TLS';            
    $mail->Port       = 587;                                    
    $mail->charset = "UTF-8"; 
    $mail->setFrom($email);
    $mail->addAddress('ceeyliin1@gmail.com', 'Ceylin Un'); 


    $mail->isHTML(true);                                  
    $mail->Subject = 'Formunuzu aldik, ' . $fullname;
    $mail->Body    = $message;

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}


header("Location: /");