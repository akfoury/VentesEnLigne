<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Document</title>
    <link rel="stylesheet" href="./styles/style.css" />
    <link rel="stylesheet" href="./styles/headline.css" />
    <link rel="stylesheet" href="./styles/product.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="./js/products.js" defer></script>
</head>
<body>
    <?php 
        require("./headline.php");
    ?>
    <?php
        require_once("./includes/db.php");
        $sql = new sql();
        if(isset($_GET["pid"])) {
            $prepare = $sql->requete("SELECT Product.ProductId, Product.Label, Product.Quantity, Product.Description, Product.PhotoUrl, OrderDetail.Price FROM Product INNER JOIN OrderDetail ON Product.ProductId = OrderDetail.ProductId WHERE Product.ProductId=?");
            $prepare->execute([$_GET["pid"]]);
            $product = $prepare->fetch(\PDO::FETCH_ASSOC);

    ?>

    <div class="c-product">
        <div class="rightCol">
            <form class="myform" data-id="<?php echo $product["ProductId"] ?>">
                <div class="product-card__price">Prix<span><?php echo $product["Price"]; ?>€</span></div>
                <button type="button" title="Ajouter au panier" class="add c-btn c-btn--big" id="btnAddToCart"><input type="number" min="1" max=<?php echo $product["Quantity"] ?> value="1" name="Quantity" id="productQuantity" class="product-card__input" />Ajouter au panier</button>
            </form>
        </div>
        <div class="leftCol">
            <div class="product-card__image">
                <img src="<?php echo './'.$product["PhotoUrl"] ?>" />
            </div>
        </div>
        <div class="centerCol">
            <div class="product-card__label"><span><?php echo $product["Label"]; ?></span></div>
            <div class="product-card__description"><?php echo $product["Description"]; ?></div>
        </div>
    </div>
    <?php 
        }
    ?>
</body>
</html>