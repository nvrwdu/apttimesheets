<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//echo getcwd();


echo '<div>
    <div class="dashboard">
        <div class="member-dashboard">Welcome <b>' . $_SESSION['GDisplayName'] . '</b> 
        . You have successfully logged in!<br>
            <a href="../views/ViewTimesheetNew.php" class="logout-button">New timesheet    |    </a>
            <a href="../views/ViewTimesheetSummary.php" class="logout-button">All timesheets    |    </a>
            <a href="../../action/ActionLogout.php" class="logout-button">Logout</a><br>

        </div>
    </div>
</div>';

?>