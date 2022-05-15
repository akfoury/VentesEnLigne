<?php
    session_start();
    include("./consoleLog.php");
    function startSession($personId, $firstname, $lastname, $email) {
        $_SESSION["personId"] = $personId;
        $_SESSION["firstname"] = $firstname;
        $_SESSION["lastname"] = $lastname;
        $_SESSION["email"] = $email;
        console_log($_SESSION);
    }
?>