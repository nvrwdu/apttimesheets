<?php
namespace Phppot;



use \Phppot\DataSource;

// Integrate PHPMailer functionality into Timesheet class

// Includes for PHP Mailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once getcwd() . '/vendor/autoload.php';

class Timesheet
{


    public $timesheetProperties = array();
    private $ds;

    function __construct()
    {
        require_once "DataSource.php";
        $this->ds = new DataSource();
    }

    public function getTimesheetById($timesheetId)
    {
        // get sql info by $id.
        // create and return new Timesheet object
        $query = "select * FROM Timesheets WHERE TimesheetID = ?";
        $paramType = "i";
        $paramArray = array($timesheetId);
        $timesheetResult = $this->ds->select($query, $paramType, $paramArray);

        return $timesheetResult;
    }

    public function getTimesheetsByUserId($userId) {
        // return timesheets by user id.
    }


    public function setTimesheetValuesByAssocArray($tsVals)
    {
        /* Assign form values to this objects values. */

        foreach ($tsVals as $key => $value) {
            echo '<br>' . $key;
        }

        if (
            array_key_exists('name', $tsVals) &&
            array_key_exists('datetime', $tsVals) &&
            array_key_exists('contract', $tsVals) &&
            array_key_exists('jobnumber', $tsVals) &&
            array_key_exists('estimate', $tsVals) &&
            array_key_exists('exchange', $tsVals) &&
            array_key_exists('plannedsynthetic', $tsVals) &&
            array_key_exists('unplannedsynthetic', $tsVals)
        ) {
            echo "All required keys exist.";

            $this->timesheetProperties['name'] = $tsVals['name'];

            $this->timesheetProperties['date'] = $tsVals['datetime'][0]["'date'"];
            $this->timesheetProperties['timefrom'] = $tsVals['datetime'][0]["'timefrom'"];
            $this->timesheetProperties['timeto'] = $tsVals['datetime'][0]["'timeto'"];

            $this->timesheetProperties['contract'] = $tsVals['contract'];
            $this->timesheetProperties['jobnumber'] = $tsVals['jobnumber'];
            $this->timesheetProperties['estimate'] = $tsVals['estimate'];
            $this->timesheetProperties['exchange'] = $tsVals['exchange'];

            $this->timesheetProperties['plannedsynthetic'] = $tsVals['plannedsynthetic'];
            $this->timesheetProperties['unplannedsynthetic'] = $tsVals['unplannedsynthetic'];

            print $this->timesheetProperties['timeto'];
            $this->printTimesheetProperties();

        } else {
            echo "Required keys missing";
        }
    }

    /*
     * Print out timesheet properties in a friendly format.
     */
    private function printTimesheetProperties() {
            foreach ($this->timesheetProperties as $property => $value) {
                echo "<br><b>Property : </b>" . $property . " ";
                echo "<b>Value : </b>" . $value;
            }
    }

    public function changeTimesheetStatus(String $newStatus)
    {
        $this->timesheetStatus = $newStatus;
    }

    public function saveTimesheet()
    {
        /* Save timesheet data */
        $query = "INSERT INTO Timesheets (Date, TimeFrom, TimeTo, Contract, JobNumber, Estimate, Exchange)
          VALUES (?, ?, ?, ?, ?, ?, ?)";
        //$query = "select * FROM registered_users WHERE id = ?";
        $paramType = "sssssss";
        $paramArray = array(
            $this->timesheetProperties['date'],
            $this->timesheetProperties['timefrom'],
            $this->timesheetProperties['timeto'],
            $this->timesheetProperties['contract'],
            $this->timesheetProperties['jobnumber'],
            $this->timesheetProperties['estimate'],
            $this->timesheetProperties['exchange']
        );
        $memberResult = $this->ds->insert($query, $paramType, $paramArray);
        echo "timesheet ID : " . $memberResult;

        /* Save synthetic details */

        /*
         * for each key val pair in synthetic
         * save each into syntheticName, syntheticQuantity, syntheticComment
         * save each element above to synthetics table
         */
        //print_r($this->timesheetProperties['plannedsynthetic'][1]);
        $syntheticName = $this->timesheetProperties['plannedsynthetic'][1]["'plannedsynthetic'"];
        $syntheticQuantity = $this->timesheetProperties['plannedsynthetic'][1]["'quantity'"];

        $query = "INSERT INTO Synthetics (TimesheetID, Name, Quantity, syntheticType)
          VALUES (?, ?, ?, ?)";
        $paramType = "isis";
        $paramArray = array(25, $syntheticName, $syntheticQuantity, 'planned');
        $memberResult = $this->ds->insert($query, $paramType, $paramArray);


        //$syntheticQuantity = $this->timesheetProperties['plannedsynthetic'][1];

        // dispatch email to submitter
        $email = "nvrwdu@hotmail.com";
        $this->sendMailTo($email);
        $this->sendMailTo($email, true);

    }





    /*
     * Send mail to submitter
     */
    private function sendMailTo($email, $isAdmin = false)
    {
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

        $name = "test";
        $mail->AddAddress("$email", "$name");


        $mail->isHTML(true);

        $mail->Subject = "New timesheet submitted";
        //$mail->addEmbeddedImage('path/to/image_file.jpg', 'image_cid');

        // Mail template. Different if user is admin
        if($isAdmin) {
            $mailTemplate = "<b>Admin, a new timesheet has been submitted. Please check inbox</b>";
        } else {
            $mailTemplate = "<b>Thank you for submitting your timesheet. You will be notified of any status updates.";
        }

                //<b><br><br><br><br>
//        $name<br>
//        $contract<br>
//        $jobnumber<br>
//        $estimate<br>
//        $exchange<br>
//        $email<br>

        // $mail->Body = '<b>Mail body in HTML. Message sent successfully<b>';
        $mail->Body = $mailTemplate;
        $mail->AltBody = 'This is the plain text version of the email content';

        if(!$mail->send()){
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }else{
            echo 'Message has been sent';
        }

        $mail->smtpClose();
    }

}


/* Testing Timesheets.php */

//$timesheet = new Timesheet();
//$result = $timesheet->getTimesheetById(1);
//echo "FROM TIMESHEET.PHP" . print_r($result);
//
//$timesheet->saveTimesheet();

//if (! empty($_SESSION["userId"])) {
//    require_once __DIR__ . './../class/Member.php';
//    $member = new Member();
//    $memberResult = $member->getMemberById($_SESSION["userId"]);
//    if(!empty($memberResult[0]["display_name"])) {
//        $displayName = ucwords($memberResult[0]["display_name"]);
//    } else {
//        $displayName = $memberResult[0]["user_name"];
//    }
//}