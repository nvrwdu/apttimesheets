<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

echo "User ID:" . $_SESSION["userId"];

