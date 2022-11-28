<?php
//Include required PHPMailer files
require 'includes/PHPMailer.php';
require 'includes/SMTP.php';
require 'includes/Exception.php';

//Define name spaces
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
Class Mailer {
	/*##########Script Information#########
	# Purpose: Send mail Using PHPMailer#
	#          & Gmail SMTP Server 	  #
	# Created: 24-11-2019 			  #
	#	Author : Hafiz Haider			  #
	# Version: 1.0					  #
	# Website: www.BroExperts.com 	  #
	#####################################*/

	public function sendEmail($email, $otp){

	//Create instance of PHPMailer
		$mail = new PHPMailer();
	//Set mailer to use smtp
		$mail->isSMTP();
	//Define smtp host
		$mail->Host = "smtp.gmail.com";
	//Enable smtp authentication
		$mail->SMTPAuth = true;
	//Set smtp encryption type (ssl/tls)
		$mail->SMTPSecure = "tls";
	//Port to connect smtp
		$mail->Port = "587";
	//Set gmail username
		$mail->Username = "ritzrmfhardware@gmail.com";
	//Set gmail password
		$mail->Password = "lgsuwwslinkkywzl";
	//Email subject
		$mail->Subject = "RITZ - RMF Hardware Verification";
	//Set sender email
		$mail->setFrom('ritzrmfhardware@gmail.com');
	//Enable HTML
		$mail->isHTML(true);
	//Attachment
	//	$mail->addAttachment('img/attachment.png');
	//Email body
		$mail->Body = "<h1>RITZ - RMF HARDWARE AUTHENTICATION</h1></br><p>Here is your OTP: </p>".$otp;
	//Add recipient
		$mail->addAddress($email);
	//Finally send email
		if ( $mail->send() ) {
			echo "Email Sent..!";
		}else{
			echo "Message could not be sent. Mailer Error: ";
		}
	//Closing smtp connection
		$mail->smtpClose();

	}
}
?>
