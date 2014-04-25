
<?php

ob_start();
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once('./inc/class.phpmailer.php');
$mail= new PHPMailer(); // defaults to using php "mail()"


//echo $_POST["contactData"];
//print_r($_POST["contactData"]);





if (isset($_POST["contactData"])){echo "ok";}
// If the js is working and jquery has sent ajax data through... //


	

if (isset($_POST["contactData"]) && isset($_POST["services"]))
	{
		
		// Basic contact info //
		
		$contactData = $_POST["contactData"];
		$fname = $contactData['fname'];
		$lname = $contactData['lname'];
		$email = $contactData['email'];
	 	$phone = $contactData['phone'];
		$callTime = $contactData['contactTime'];
		
		
		// Services - Connected to #checks //
		
		$clientNeeds = array();
		
		$services = $_POST["services"];
		
		if (!empty($services["retirement"]))
				{
					$retirement = "> ".$services["retirement"];
					$clientNeeds[] = $retirement;
					//echo $retirement;
				}
		else    {	$retirement = "";	}		

		if (!empty($services["investment"]))
			{
				$investment = "> ".$services["investment"];
				$clientNeeds[] = $investment;
				//echo $investment;
			}
		else    {	$investment = "";	}

		if (!empty($services["estate"]))
			{
				$estate = "> ".$services["estate"];
				$clientNeeds[] = $estate;
				//echo $estate;
			}
		else    {	$estate = "";	}
	print_r($clientNeeds);	
}

/*
if (!empty($_POST["contactData"]))
	{
	$json = $_POST["contactData"];
	$fname = $json['recipent'];
	$lname = $json['name'];
	$email = $json['email'];
	$phone = $json['phone']
	$services = $json['services']
	$callTime = $json['contactTime'];
	print_r($json);
	}
else {echo "something's wrong";}	
	
// If ajax did not send data through & $_post was sent \ NON-JS version //
else if(!empty($_POST["send"]))
	{
	$name = $_POST["name"];
	$email = $_POST["email"];
	$message=$_POST["message"];
	}



$needed = function services($x){
	foreach ($x as $needs){
		 $needs . '<br/>';
	}
}
*/


//$mail->IsSMTP();  // telling the class to use SMTP
$mail->Host     = "localhost"; // SMTP server
$mail->Port 	= 465;
$mail->From     = $email;
$mail->AddReplyTo=$email;
$mail->FromName = $fname." ".$lname;
$mail->AddAddress("jbarton@centerpointewealth.com", "John Barton");
$mail->AddCC ("nbarton@centerpointewealth.com", "Nancy Barton");
$mail->AddCC  ("n3w_y0rk@hotmail.com", "Brian Barton");
$mail->SMTPAuth = "true";
$mail->Username = "bkbarton@bkbarton.com";

$mail->Subject  = "CenterPointe Wealth test email:";

$mail->Body     = 	"A message was sent to you from CenterPointeWealth.com\r\n"
					."~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\r\n\r\n"
					."SENDER\r\n\r\n"
					.$fname." ".$lname."\r\n"
					.$email."\r\n"
					.$phone."\r\n\r\n";
					
$mail->Body     .=  "~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\r\n\r\n"
					."Services Requested:\r\n\r\n"
					.$investment."\r\n"
					.$retirement."\r\n"
					.$estate."\r\n\r\n";

$mail->Body     .=  "~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\r\n\r\n"
					."Would like to be contacted: \r\n\r\n"
					."> ".$callTime."\r\n\r\n"
					."~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\r\n\r\n"
					.$fname." ".$lname." <".$email.">";
					
$mail->WordWrap = 100;




if(!$mail->Send()) {
  echo 'Message was not sent.';
  echo 'Mailer error: ' . $mail->ErrorInfo;
} else {
	print_r($mail);
	}

?>

