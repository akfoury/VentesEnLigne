<?php
    session_start();
    require("./includes/db.php");
    require("./consoleLog.php");
    if(isset($_SESSION["user_id"])) {
        $now = time();

        if($now > $_SESSION["expire"]) {
            session_destroy();
        }
    }

    if(isset($_POST['command-access']) && !isset($_SESSION["user_id"])) {
        header('Location: signin.php');
        exit();
    } else if(isset($_POST['command-access'])){
        $sql = new sql();

        $req1 = $sql->requete("INSERT INTO SalesOrder (CustomerId, Label, OrderDate) VALUES(?, ?, ?)");
        $orderDate = date("Y-d-m H:i:s.v", strtotime('now'));
        try {
            $req1->execute([$_SESSION["user_id"], "votre commande de livres chez Livreo", $orderDate]);
            $salesOrderId = $sql->getLastInsertId();
            $_SESSION["orderId"] = $salesOrderId;
        } catch (PDOException $e) {
            $errorCode = $req->errorInfo()[1];
            console_log($errorCode);
        }
        
        $req2 = $sql->requete("INSERT INTO OrderDetail (SalesOrderId, ProductId, Label, Quantity, Price) VALUES(?, ?, ?, ?, ?)");

        if(isset($_SESSION["shopping_card"]) && !empty($_SESSION["shopping_card"])) {
            foreach($_SESSION["shopping_card"] as $innerArray) {
                if(is_array($innerArray)) {
                    try {
                        $req2->execute([$salesOrderId, $innerArray["ProductId"], $innerArray["Label"], $innerArray["Quantity"], $innerArray["Price"]]);
                    } catch (PDOException $e) {
                        $errorCode = $req2->errorInfo()[1];
                        console_log($errorCode);
                    }
                }
            }
        }
        header('Location: payment.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href='./styles/common.css' />
    <link rel="stylesheet"href='./styles/style.css' />
    <link rel="stylesheet" href="./styles/headline.css" />
    <link rel="stylesheet" href='./styles/shoppingCardList.css' />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
    <?php
        require_once("./headline.php");
    ?>
    <div class="l-main">
        <div class="l-main__item" id="shopping">
            <div class="l-main__subitem--vertical-layout">
                <div class="shopping-card-list__headers">
                    <h1 class="shopping-card-list__title">Votre Panier</h1>
                    <h1 class="shopping-card-list__title_price">Prix</h1>
                </div>
                <hr>    
                <div class="shopping-card-list">
                    <?php
                        if(!empty($_SESSION["shopping_card"])) {
                            foreach($_SESSION["shopping_card"] as $innerArray) {
                                if(is_array($innerArray)) {
                    ?>
                    <form class="myform" data-id="<?php echo $innerArray["ProductId"] ?>">
                        <div class="shopping-card-list__row">
                            <div class="shopping-card-list__checkbox">
                                <input type="checkbox"></input>
                            </div>
                            <div class="shopping-card-list__img">
                                <img src=<?php echo './'.$innerArray["PhotoUrl"] ?>></img>
                            </div>
                            <div class="shopping-card-list__content">
                                <div class="shopping-card-list__item">
                                    <p class="shopping-card-list__label"><?php echo $innerArray["Label"] ?></p>
                                </div>
                                <div class="shopping-card-list__item">
                                    <p class="shopping-card-list__available"><span><?php echo ($innerArray["Available"]) ? "En stock" : "En rupture de stock"; ?></span></p>
                                </div>
                                <div class="shopping-card-list__item">
                                    <input type="number" min="1" max="" value="<?php echo $innerArray["Quantity"] ?>" name="Quantity" class="quantity"/>
                                    <button class="delete">Supprimer</button>
                                </div>
                            </div>
                            <p class="shopping-card-list__price">
                                <?php echo $innerArray["Price"] ?>
                                <span class="shopping-card-list__price--currency">€</span>
                            </p>
                        </div>
                    </form>
                    <?php
                                }
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
        <div class="l-main__item" id="command">
            <?php include("./commandTab.php") ?>
        </div>
    </div>
    <script>
        $('document').ready(function(){
            $('.myform').on('submit',function(e, action, code) {
                e.preventDefault();
                const formData = new FormData($(e.target).closest("form")[0]);
                fetch('./productController.php?' + new URLSearchParams({ action: action, code: code }),
                    { method: "post", body: formData }
                ).then((res) => {
                    if(action === "remove") {
                        this.remove();
                    }
                    
                });
            });
        });
        
        $('.quantity').on("change", (e) => {
            e.preventDefault();
            const productId = $(e.target).closest("form").attr("data-id");
            $(e.target).closest("form").trigger('submit', ["update", productId]);

            fetch('./commandTab.php', { method: "get" }).then((res) => {
                return res.text();
            }).then((html) => {
                $("#command").html(html);
            });

            fetch('./nbProducts.php',
                {
                    method: "get",
                    headers: {
                        'Content-Type': 'application/json'
                    }
                }
            ).then(res => {
                return res.json();
            }).then(data => {
                document.querySelector("#nb-products").textContent = data.nbProducts;
            });
    });

        $('.delete').on("click", (e) => {
            const productId = $(e.target).closest("form").attr("data-id");
            $(e.target).closest("form").trigger('submit', ["remove", productId]);

            fetch('./commandTab.php', { method: "get" }).then((res) => {
                return res.text();
            }).then((html) => {
                $("#command").html(html);
            });

            fetch('./nbProducts.php',
                {
                    method: "get",
                    headers: {
                        'Content-Type': 'application/json'
                    }
                }
            ).then(res => {
                return res.json();
            }).then(data => {
                document.querySelector("#nb-products").textContent = data.nbProducts;
            });
        });
    </script>
</body>
</html>
