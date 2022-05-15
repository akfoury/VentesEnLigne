<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <div class="shopping-card-list__command">
            <p>Total (<?php
                    if(!empty($_SESSION["shopping_card"])) {
                        if($_SESSION['total_shopping_card'] > 1) {
                            echo $_SESSION['total_shopping_card']." articles"; 
                        } else {
                            echo $_SESSION['total_shopping_card']." article"; 
                        }   
                    }
                ?>) :
            <span>
                <?php
                    $totalPrice = 0;
                    if(isset($_SESSION["shopping_card"]) && !empty($_SESSION["shopping_card"])) {
                        foreach($_SESSION["shopping_card"] as $innerArray) {
                            if(is_array($innerArray)) {
                                $totalPrice += $innerArray["Price"] * $innerArray["Quantity"];
                            }
                        }
                    }
                    echo $totalPrice;
                ?>
            </span>
            <span class="shopping-card-list__price--currency">€</span>
            </p>
            <button class="c-btn c-btn--big c-btn--rounded c-btn--center" name="command-access" id="command-access">Passez la commande</button>
        </div>
    </form>
</body>
</html>