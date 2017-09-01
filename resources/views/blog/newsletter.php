<?php
//error_reporting(0);
//Composer Autoloader
require './vendor/autoload.php';
//Configuration Files
require 'class/config.php';
$db = new PDO(DATABASE_SERVER, DATABASE_USER, DATABASE_PASS) or die("Database Error");

//Getting the type of action expected
/* @var $action type */
$action = $_REQUEST['action'];

//Email Address to send to
$email = "'" . $_REQUEST['email'] . "'";

$mail = new PHPMailer;
//$mail->SMTPDebug = 3;

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'itblog.com.ng;server.globalhosting247.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'mail@itblog.com.ng';                 // SMTP username
$mail->Password = 'rn5C3m3m7W';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                                    // TCP port to connect to

$mail->setFrom('mail@itblog.com.ng', 'ITBLOG');
$mail->addReplyTo('mail@itblog.com.ng', 'ITBLOG');
$mail->isHTML(true);

if (!isset($action) || $action === "") {
    die();
}

$activationKey = sha1(sha1($email));
$activationMessage = '<!DOCTYPE html><html><head><meta name="author" content="MeetWEB &lt;lawboi4love@gmail.com&gt;" /></head>';
$activationMessage .= '<body><p><img style="display: block; margin-left: auto; margin-right: auto; width: 50%;" src="' . APP_IMAGE . '" alt="ITBlog Official Logo" /></p>';
$activationMessage .= '<h1 style="text-align: center; width: 100%; background-color: rgba(0,0,0,0.4); color: rgba(0,0,0,0.7);">Newsletter Subscription Activation</h1><p>Hello dear user,</p><p>Thank you for subscribing to our newsletter.</p><p style="text-align: left;">Please, if you did not request for this service delete this mail or don\'t reply to it.</p>';
$activationMessage .= '<p style="text-align: left;">&nbsp;</p><div style="padding: 10px 15px; background-color: black; color: white;"><p style="text-align: left;">Note: This mail is sent to you because either you or someone insert your e-mail address in our newsletter box for subscription.</p>';
$activationMessage .= '/div></body></html>';

switch ($action) {
    case 'add':
        header('Content-Type: application/json');

        //Checking if the user is already in the list
        $mail->addAddress(stripslashes($_REQUEST['email']));     // Add a recipient
//        $mail->addAddress('mail@itblog.com.ng');     // Add a recipient
        $mail->Subject = 'ITBlog Newsletter Activation';

        $mail->Body = $activationMessage;
        $mail->AltBody = 'Please view this mail in an updated browser or from a mail client!';

        $emailCheck = $db->query("SELECT * FROM `newsletter` WHERE email = $email");

        if ($emailCheck->rowCount() === 1) {
            echo json_encode(array('result' => 'exist'));
        } else {
            if ($mail->send()) {
                $db->query("INSERT INTO `newsletter`(`email`,`activation_key`,`active`) VALUES($email, '$activationKey','1')");
                echo json_encode(array('result' => 'added'));
            } else {
                echo json_encode(array('result' => 'error', 'message' => $mail->ErrorInfo));
            }
        }
        break;

    case 'remove':
        try {
            $db->query("UPDATE `newsletter` SET `active` = '2' WHERE email = " . $email . "");
            header('Content-Type: application/json');
            echo json_encode(array('result' => 'removed'));
        } catch (PDOException $e) {
            header('Content-Type: application/json');
            echo json_encode(array('result' => 'not-removed'));
        }
        break;

    case 'verify':
        try {
            $db->query("UPDATE `newsletter` SET `email` = '1' WHERE email = ' " . $email . "'");
            header('Content-Type: application/json');
            echo json_encode(array('result' => 'verified'));
        } catch (PDOException $e) {
            header('Content-Type: application/json');
            echo json_encode(array('result' => 'error'));
        }
        break;

    default:
        die();
        break;
}