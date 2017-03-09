<?php
require 'vendor/phpmailer/phpmailer/PHPMailerAutoload.php';
session_start();
$mail = new PHPMailer;
$mail->setFrom($_POST['email'], $_POST['name']);
$mail->addAddress('qleilde@gmail.com');
$mail->Subject = "Nouveau message depuis ocblog.quentinleilde.com";
$mail->Body = $_POST['message'];
if(!$mail->send()) {
    $_SESSION['emailnotsent'] = "Oups! Votre message n'a pas été envoyé.";
    header('Location: index.php');
    die();
} else {
	$_SESSION['emailsent'] = "Votre message a bien été envoyé.";
    header('Location: index.php');
    die();
}
?>