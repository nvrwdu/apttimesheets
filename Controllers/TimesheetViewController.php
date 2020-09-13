<?php 

/* TimesheetViewController.php
 * Handles operation from when a new timesheet is submitted.
 * Reads, validates and stores timesheet data to the database.
 */

// First, get all form data input.
// Then validate input. If any error exists, keep form sticky, ask user to fix error.
// When data is valid, use db functions to store data to the database.

// Check if all required form values entered.
// There must be atleast one synthetic name-quantity pair for form submission.
// All further synthetics are optional.
require_once("../db/db_config.php");
require_once("../db/db_connect.php");

echo "Handle form";
//require_once("../../db_connect.php"); // DB connection held in $conn


// echo $_POST['date'];
// echo $_POST['name'];
// echo $_POST['contract'];
// echo $_POST['jobnumber'];

// echo $_POST['estimate'];
// echo $_POST['exchange'];
// echo $_POST['email'];
//print_r($_POST['plannedsynthetic']);
//print_r($_POST['unplannedsynthetic']);
// echo $_POST[''];
// echo $_POST[''];
// echo $_POST[''];
// echo $_POST[''];
// echo $_POST[''];




// Sample a data query from PDO.

/* Insert name into database */
// try {
//   $nameVal = $_POST["name"];



//   $sql = "INSERT INTO names (name)
//   VALUES ('$nameVal')";
//   // use exec() because no results are returned
//   $conn->exec($sql);
//   echo "New record created successfully<br/>";
// } catch(PDOException $e) {
//   echo $sql . "<br>" . $e->getMessage();
// }





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