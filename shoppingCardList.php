<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./styles/common.css"/>
    <link rel="stylesheet" href="./shoppingCardList.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
    <div class="shopping-card-list">
        <h1>Votre Panier</h1>
        <?php
            session_start();
            include("./consoleLog.php");
            if(!empty($_SESSION["shopping_card"])) {
                foreach($_SESSION["shopping_card"] as $innerArray) {
                    if(is_array($innerArray)) {
                        console_log($innerArray["ProductId"]);
        ?>
        <form class="myform" data-id="<?php echo $innerArray["ProductId"] ?>">
            <div class="shopping-card-list__row">
                <div class="shopping-card-list__img">
                    <img src=<?php echo $innerArray["PhotoUrl"] ?>></img>
                </div>
                <div class="shopping-card-list__content">
                    <div class="shopping-card-list__item">
                        <p><?php echo $innerArray["Label"] ?></p>
                        <p><?php echo $innerArray["Price"] ?></p>
                    </div>
                    <div class="shopping-card-list__item">
                        <p><span><?php echo ($innerArray["Available"]) ? "En stock" : "En rupture de stock"; ?></span></p>
                    </div>
                    <div class="shopping-card-list__item">
                        <input type="number" min="0" value="<?php echo $innerArray["Quantity"] ?>" name="Quantity" class="quantity"/>
                        <button class="delete">Supprimer</button>
                    </div>
                </div>
            </div>
        </form>
        <?php
                    }
                }
            }
        ?>
    </div>
    <script>
        $('document').ready(function(){
            $('.myform').on('submit',function(e, action, code) {
                e.preventDefault();
                const formData = new FormData($(e.target).closest("form")[0]);
                fetch('crudProducts.php?' + new URLSearchParams({ action: action, code: code }),
                    { method: "post", body: formData }
                ).then((res) => {
                    if(action === "remove") {
                        this.remove();
                    }
                    
                });
            });
        });
        $('.quantity').on("change", (e) => {
            console.log($(e.target).closest("form"));
            const productId = $(e.target).closest("form").attr("data-id");
            $(e.target).closest("form").trigger('submit', ["update", productId]);
        });

        $('.delete').on("click", (e) => {
            const productId = $(e.target).closest("form").attr("data-id");
            $(e.target).closest("form").trigger('submit', ["remove", productId]);
        });
    </script>
</body>
</html>
