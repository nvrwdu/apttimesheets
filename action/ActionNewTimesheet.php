<?php
namespace Phppot;

/*
 * Called when user submits a new timesheet.
 */

require_once "../class/Timesheet.php";

$ts = new Timesheet();
$ts->setTimesheetValuesByAssocArray($_POST);
$ts->saveTimesheet();

echo "Here we are, in action new timesheet";

Header('Location: ../view/views/ViewTimesheetsSummary.php');
?> 