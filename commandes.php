<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href='./styles/common.css'/>
    <link rel="stylesheet" href='./styles/style.css' />
    <link rel="stylesheet" href='./styles/headline.css' />
    <link rel="stylesheet" href="./styles/commandes.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
    <?php 
        if (isset($_SESSION["user_id"])) {
            require_once("./includes/db.php");
            $sql = new sql();
            $prepare = $sql->requete("SELECT OrderDetail.SalesOrderId, OrderDetail.Quantity, OrderDetail.Price, Person.FirstName, Person.LastName, SalesOrder.OrderDate, Product.PhotoUrl, Product.Label
                                    FROM SalesOrder 
                                    INNER JOIN OrderDetail ON SalesOrder.SalesOrderId = OrderDetail.SalesOrderId  
                                    INNER JOIN Person ON SalesOrder.CustomerId = Person.PersonId
                                    INNER JOIN Product ON OrderDetail.ProductId = Product.ProductId
                                    WHERE CustomerId = (SELECT PersonId FROM Person WHERE PersonId = ?)");
            $prepare->execute([$_SESSION["user_id"]]);
            $orders = $prepare->fetchAll(\PDO::FETCH_ASSOC);
    ?>
    <?php 
        require("./headline.php");
    ?>
    <div class="c-accordion">
        <?php
                if ($orders != null) {
                    foreach($orders as $row) {                       
        ?>
        <form action="" method="post" class="myform">
            <div class="c-accordion__item" id="account-info">
                <div class="c-accordion__header">
                    <div class="c-accordion__col">
                        <h5>Commande effectuée le </h5>
                        <span>
                            <?php
                                setlocale(LC_ALL, 'french');
                                echo strftime("%e %B %G", strtotime($row["OrderDate"]));
                            ?>
                        </span>
                    </div>
                    <div class="c-accordion__col">
                        <h5>Total </h5>
                        <span>EUR <?php echo $row["Quantity"] * $row["Price"] ?></span>
                    </div>
                    <div class="c-accordion__col">
                        <h5>Livraison à </h5>
                        <span><?php echo $row["FirstName"]. " ".$row["LastName"] ?></span>
                    </div>
                    <div class="c-accordion__col">
                        <h5>N° de commande </h5>
                        <span><?php echo $row["SalesOrderId"] ?></span>
                    </div>
                </div>
                <div class="c-accordion__content">
                    <div class="c-accordion__row">
                        <div class="product-card__image">
                            <img src="<?php echo './'.$row["PhotoUrl"] ?>" />
                        </div>
                        <div class="c-accordion__col">
                            <div class="product-card__title">
                                <span><?php echo $row["Label"] ?> </span>
                            </div>
                            <div class="product-card__title">
                                <span>EUR <?php echo $row["Price"] ?> </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <?php 
                }
            }
        ?>
    </div>
    <?php 
        } else {
            header('Location: signin.php');
            exit();
        }
    ?>
</body>
</html>