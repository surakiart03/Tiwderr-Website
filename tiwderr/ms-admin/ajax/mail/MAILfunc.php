<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendMail($FROM, $TO, $SUBJECT, $BODY)
{
    require_once("../../PHPMailer/PHPMailer.php");
    require_once("../../PHPMailer/SMTP.php");
    require_once("../../PHPMailer/Exception.php");

    $mail = new PHPMailer(true);

    try {

        //Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->isHTML(true);
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = $FROM;                     //SMTP username
        $mail->Password   = 'azqasvdhvddnqknv';                               //SMTP password
        // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
        // $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        $mail->Port       = 587;
        $mail->setFrom($FROM, 'TiWDERR');
        $mail->addAddress($TO);
        $mail->Subject = $SUBJECT;
        // $mail->AddEmbeddedImage('../../src/images/email_verify.png', 'email_verify');
        $mail->Body = $BODY;
        $mail->CharSet = "UTF-8";
        $mail->send();
        echo 'Message has been sent';
        return true;
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        return false;
    }
}
