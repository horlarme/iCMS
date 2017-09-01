<?php
//error_reporting(0);
//Composer Autoloader
require '../vendor/autoload.php';
//Configuration Files
require 'config.php';
$dataBase = new PDO(DATABASE_SERVER, DATABASE_USER, DATABASE_PASS);

$blog = new ITBLOG\Blogging($dataBase);


/** EMAIL CONFIGURATION */
$mail = new PHPMailer;
$mail->setFrom('mail@itblog.com.ng', 'ITBLOG');
$mail->addReplyTo('mail@itblog.com.ng', 'ITBLOG');
$mail->isHTML(true);
$mailBodyHead = '<!DOCTYPE html><html><head><meta name="author" content="MeetWEB &lt;lawboi4love@gmail.com&gt;" /></head>
<body><p><img style="display: block; margin-left: auto; margin-right: auto; width: 50%;" src="' . APP_IMAGE . '" alt="ITBlog Official Logo" /></p>';
$mailBodyFoot = '<p style="text-align: left;">Please, if you did not request for this service delete this mail or don\'t reply to it.</p>
<p style="text-align: left;">&nbsp;</p><div style="padding: 10px 15px; background-color: black; color: white;"><p style="text-align: left;">Note: This mail is sent to you because either you or someone insert your e-mail address in our newsletter box for subscription.</p>
</div></body></html>';

//Advertisement Form Request
if ($_REQUEST['action'] === 'advertise') {
    //The Data

    /** @var String $m Message */
    $m = $dataBase->quote($_REQUEST['message']);
    /** @var String $e Email Address */
    $e = $dataBase->quote($_REQUEST['email']);
    /** @var String $p Mobile Number / Phone Number */
    $p = $dataBase->quote($_REQUEST['mobile']);
    /** @var String $n Full Name */
    $n = $dataBase->quote($_REQUEST['name']);
    /** @var String $w Website */
    $w = $dataBase->quote($_REQUEST['website']);

    //Sending Message to the advertisement department
    $mail->Subject = 'New Advert Placement Request';
    $mail->addAddress($_REQUEST['email']);
    $mailContent = $mailBodyHead;
    $mailContent .= '<h1 style="text-align: center; width: 100%; background-color: rgba(0,0,0,0.4); color: rgba(0,0,0,0.7);">There has been a new advert placement request on ' . APP_ADD . '</h1>';
    $mailContent .= 'Message: ' . $m;
    $mailContent .= 'From: ' . $n;
    $mailContent .= 'Contact Email: <a href=mailto:' . $n . '>"' . $n . '</a>';
    $mailContent .= 'Mobile: ' . $p;
    $mailContent .= 'Website: ' . $w;
    $mailContent .= $mailBodyFoot;
    $mail->Body = $mailContent;
    header('Content-Type: application/JSON');
    if ($mail->send()) {
        //Adding the information to the database
        $dataBase->query("INSERT INTO advertContacts(`advert_name`,`advert_email`,`advert_mobile`,`advert_website`)
                      VALUES(" . $n . "," . $e . "," . $p . "," . $w . ")");
        echo json_encode(array('result' => 'true', 'message' => 'Thank you for requesting to advertise with us, a representative will contact you shortly.'));
    } else {
        echo json_encode(array('result' => 'false', 'message' => 'Opps!!! There\'s an error sending your advert request, please resend the information'));
    }

}