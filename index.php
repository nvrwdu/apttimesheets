<?php


if(!session_start()){
    session_start();
}

if(!empty($_SESSION["userId"])) {
    require_once './view/submitterLandingView.php';
} else {
    require_once './view/loginFormView.php';
}

exit();

?>