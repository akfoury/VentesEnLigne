<?php
    function startSession($firstname, $lastname) {
        session_start();
        $_SESSION["firstname"] = $firstname;
        $_SESSION["lastname"] = $lastname;
    }
?>