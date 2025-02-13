<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
require_once APPPATH . 'ThirdParty\\PHPMailer-master\\src\\Exception.php';
require_once APPPATH . 'ThirdParty\\PHPMailer-master\\src\\PHPMailer.php';
require_once APPPATH . 'ThirdParty\\PHPMailer-master\\src\\SMTP.php';

class ControllerEmail extends Controller
{
    public function index()
    {
        try {
            $mail = new PHPMailer(true);
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_LOWLEVEL;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host = 'sandbox.smtp.mailtrap.io';                     //Set the SMTP server to send through
            $mail->SMTPAuth = true;                                   //Enable SMTP authentication
            $mail->Username = 'fe51718e00a967';                     //SMTP username
            $mail->Password = '4dad06dba2ef2d';                               //SMTP password
            $mail->SMTPSecure = 'TLS';            //Enable implicit TLS encryption
            $mail->Port = 2525;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTL
            $mail->SMTPSecure = false;


            //Recipients
            $mail->setFrom('juandig52@gmail.com', 'Mailer');
            $mail->addAddress('juandig1212@gmail.com', 'Joe User');     //Add a recipient
            //$mail->addAddress('www');               //Name is optional
           // $mail->addReplyTo('www', 'Information');
            $mail->addCC('cc@example.com');
            $mail->addBCC('bcc@example.com');

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Here is the subject';
            $mail->Encoding = 'base64';

            $mail->Body = 'This is the HTML message body <b>in bold!</b>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            //$mail->msgHTML(file_get_contents('contents.html'), __DIR__);

            //Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
           // $mail->addAttachment(base_url("example.pdf"));    //Optional name
           $mail->addAttachment(FCPATH . 'example.pdf', 'example.pdf', 'base64', 'application/pdf');



            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
