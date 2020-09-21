<?php
namespace Phppot;

require_once $_SERVER['DOCUMENT_ROOT'] . '/APT/APTTimesheets/www/class/Member.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/APT/APTTimesheets/www/class/Timesheet.php';




class TimesheetSummaryRenderView {

    public function render() {

        $user = new Member();
        //$userStatus = $user->getMemberUserStatus($_SESSION['userId']);
        $userStatus = $user->getMemberUserStatus(23);

        switch ($userStatus) {
            case 'submitter':
                // Render for submitter
                // get data for all submitters timesheets ($results)
                $userTimesheets = new Timesheet();
                $timesheets = $userTimesheets->getTimesheetsByUserId($_SESSION["userId"]);

                // Create table to print out timesheet
                //print_r($timesheets);

                $this->renderTimesheetSummary($timesheets);
                break;
            case 'admin' :
                // Add view to viewToRender for admin
                //$this->viewToRender .= "This is the view for user type admin";
                break;
            case 'superadmin' :
                // Add view to viewToRender for admin
                //$this->viewToRender .= "This is the view for user type superadmin";

        }



    }

    /*
     * Takes $timesheets which holds timesheets data.
     * Returns an HTML rendered table with the timesheets data.
     */
    private function renderTimesheetSummary($timesheets) {
        // Return html to render timesheet

        //  Render timesheets for user


        $timesheetAttributesUsed = array_keys($timesheets[0]);
        //print_r($timesheetAttributesUsed);

        // Display table headers
        echo '<table style="width:100%" class="pure-table pure-table-horizontal">
          <tr>';
            foreach ($timesheetAttributesUsed as $timesheetAttribute) {
                echo '<th>' . $timesheetAttribute . '</th>';
            }

            echo '</tr>';

        //Display table contents
        foreach ($timesheets as $timesheet) {
            echo '<tr>';
            foreach ($timesheet as $key => $value) {
                //print_r($value);
                echo '<td>' . $value . '</td>';
            }
            echo '</tr>';
        }

        echo '</table>';
    }

}




