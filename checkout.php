<?php
    session_start();
    require("./consoleLog.php");
    require("./includes/db.php");
    if(isset($_GET["oid"])) {
        $sql = new sql();

        $req1 = $sql->requete("INSERT INTO Invoice (OrderId, InvoiceDate, Label) VALUES(?, ?, ?)");
        $invoiceDate = date("Y-d-m H:i:s.v", strtotime('now'));
        $invoiceId = null;
        try {
            $req1->execute([$_GET["oid"], $invoiceDate, "votre commande de livres chez Livreo"]);
            $invoiceId = $sql->getLastInsertId();
            $_SESSION["invoiceId"] = $invoiceId;
        } catch (PDOException $e) {
            $errorCode = $req1->errorInfo()[1];
            console_log($errorCode);
        }

        $req2 = $sql->requete("INSERT INTO InvoiceDetail (InvoiceId, ProductId, Label, Description, Quantity, Price) VALUES(?, ?, ?, ?, ?, ?)");

        if(isset($_SESSION["shopping_card"]) && !empty($_SESSION["shopping_card"])) {
            foreach($_SESSION["shopping_card"] as $innerArray) {
                if(is_array($innerArray)) {
                    try {
                        $req2->execute([$invoiceId, $innerArray["ProductId"], $innerArray["Label"], $innerArray["Description"], $innerArray["Quantity"], $innerArray["Price"]]);
                    } catch (PDOException $e) {
                        $errorCode = $req2->errorInfo()[1];
                        console_log($errorCode);
                    }
                }
            }
        }

        // $to      = $_SESSION["email"];
        // $subject = 'recu Stripe';
        // $message = 'Bonjour voici votre recu Stripe';
        // $headers = 'From: webmaster@example.com'       . "\r\n" .
        //             'Reply-To: webmaster@example.com' . "\r\n" .
        //             'X-Mailer: PHP/' . phpversion();

        // mail($to, $subject, $message, $headers);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://kit.fontawesome.com/fa06461fb1.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./styles/confirmation.css" />
</head>
<body>
    <div class="confirmation-payment">
        <div class="confirmation-payment__icon">
            <span class="fa-stack fa-3x">
                <i class="fas fa-circle fa-stack-2x"></i>
                <i class="fa-solid fa-check fa-stack-1x fa-inverse"></i>
            </span>
        </div>
        <div class="confirmation-payment__message">
            <span>Votre paiement a été réalisé avec succès</span>
        </div>
    </div>
</body>
</html>