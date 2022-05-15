<?php
    session_start();
    require("./includes/db.php");
    // require("utilities/session.php");
    if(isset($_POST["create_account"])){
        $email = $_POST["email"];
        $passwd = $_POST["passwd"];
        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $phone = $_POST["phone"];
        $now = date("Y-m-d H:i:s", strtotime('now'));
        console_log($firstname);

        $sql = new sql();

        $req = $sql->requete("INSERT INTO Person (FirstName, LastName, EmailAddress, Password, PhoneNumber, DateAdded, DateUpdated) VALUES(?, ?, ?, ?, ?, ?, ?)");
        $req->execute([$firstname, $lastname, $email, $passwd, $phone, $now, $now]);

        $_SESSION["personId"] = $sql->getLastInsertId();
        $_SESSION["firstname"] = $_POST["firstname"];
        $_SESSION["lastname"] = $_POST["lastname"];
        $_SESSION["email"] = $_POST["email"];

        console_log($_SESSION);

    }
?>