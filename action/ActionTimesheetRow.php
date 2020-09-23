<?php
namespace Phppot;

use http\Header;

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once "../class/TimesheetSummaryRenderView.php";
require_once "../class/Timesheet.php";

//echo 'this page receives the timesheets row values. From it, renders a single timesheet summary';
//echo 'timesheetID: ' . $_GET['timesheetId'];



//Get timesheet to render
$timesheet = new Timesheet();
$singleTimesheet = $timesheet->getTimesheetById($_GET['timesheetId']);

//print_r($singleTimesheet[0]);


$_SESSION['singleTimesheet'] = $singleTimesheet;

Header('Location: ../view/views/ViewTimesheetNew.php');

//$timesheetRenderer = new TimesheetSummaryRenderView($singleTimesheet);
//$timesheetRenderer->renderSingleTimesheet();



?>