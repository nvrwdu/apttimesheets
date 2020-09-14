<?php 

/* TimesheetViewController.php
 * Handles operation from when a new timesheet is submitted.
 * Reads, validates and stores timesheet data to the database.
 */

// Includes for PHP Mailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once '../vendor/autoload.php';

// Includes for database
require_once("../includes/db_config.php");
require_once("../includes/db_connect.php"); //Returns $conn as handle


echo "Handle form";

/*
Validate form data.
Insert form data into DB.
Dispatch email to submitter and admin with timesheet information
	Create a html template for the emails.
	Then attached to PHPMailer and dispatch.

Still required :
	Timesheet status.
	Add timesheet status to DB.

Is it worth creating a timesheet class ?


First steps :
Add timesheet status attribute.
Form data validated and saved to DB.
Email dispatched to submitter, as basic html.

*/



// Form input names
// echo $_POST['date'];
// echo $_POST['name'];
// echo $_POST['contract'];
// echo $_POST['jobnumber'];

// echo $_POST['estimate'];
// echo $_POST['exchange'];
//echo $_POST['email'];
//print_r($_POST['plannedsynthetic']);
//print_r($_POST['unplannedsynthetic']);
// echo $_POST[''];
// echo $_POST[''];
// echo $_POST[''];
// echo $_POST[''];
// echo $_POST[''];


/* Validate form input
*/


$dateTimeArray = $_POST['datetime'];

$name = $_POST['name'];
$contract = $_POST['contract'];
$jobnumber = $_POST['jobnumber'];

$estimate = $_POST['estimate'];
$exchange = $_POST['exchange'];
$email = $_POST['email'];
$plannedSyntheticArray = $_POST['plannedsynthetic'];
$unplannedSyntheticArray = $_POST['unplannedsynthetic'];






/* Insert timesheet into database */
try {

  $sql = "INSERT INTO Timesheets (Date, TimeFrom, TimeTo, Contract, JobNumber, Estimate, Exchange)
  VALUES ('2001/02/12', '08:00:00', '12:00:00', '$contract', '$jobnumber', '$estimate', '$exchange')";
  $conn->exec($sql);
  echo "New record created successfully<br/>";
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}


/* Dispatch email with timesheet data */

//PHPMailer Object
$mail = new PHPMailer(true); //Argument true in constructor enables exceptions


//smtp config
$mail->isSMTP();

// GMail SMTP Settings
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'nvrwdu@gmail.com';
$mail->Password =  '((Pi3141))';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

$mail->From = "nvrwdu@hotmail.com";
$mail->FromName = "Mohammed Amir";

$mail->AddAddress('nvrwdu@hotmail.com', 'Mohammed Amir');


$mail->isHTML(true);

$mail->Subject = "New timesheet submitted";
//$mail->addEmbeddedImage('path/to/image_file.jpg', 'image_cid');

// Mail template
$mailTemplate = "<b>Thank you for submitting your timesheet. You will be notified of any status updates.<b><br><br><br><br>
$name<br>
$contract<br>
$jobnumber<br>
$estimate<br>
$exchange<br>
$email<br>
";



// $mail->Body = '<b>Mail body in HTML. Message sent successfully<b>';
$mail->Body = $mailTemplate;
$mail->AltBody = 'This is the plain text version of the email content';

if(!$mail->send()){
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}else{
    echo 'Message has been sent';
}






/* Display all timesheets */
// try {
//   $sql = $conn->query("SELECT * FROM timesheet");
//   //print_r($sql->fetch());

//   while ($row = $sql->fetch()) {
//     echo $row['Name']."<br />\n"; // Associative array keys are case sensitive.
//   }
// } catch (PDOException $e) {
//   echo $sql . " " . $e->getMessage();
// }



// $conn = null;



// if (isset($_POST["date"]) && isset($_POST["name"]) && $_POST["contract"] && $_POST["jobnumber"] && $estimate = $_POST["estimate"] && $estimate = $_POST["exchange"] && $estimate = $_POST["email"] && $_POST["plannedsynthetic"] && $_POST["plannedquantity"] ) {
	
// 	// All required values set.
// 	// Save values to database.


// } else {
// 	echo "date is not set";
// }



?> 