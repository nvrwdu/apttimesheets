<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$_SESSION["user_id"] = "";
session_destroy();
header("Location: index.php");