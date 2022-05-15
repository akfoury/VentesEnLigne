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
    <link rel="stylesheet" href="./styles/productPage.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="./js/products.js" defer></script>
</head>
<body>
    <?php
        require_once("./headline.php");
    ?>
    <div class="product-page">
        <?php
            require_once("./includes/db.php");
            $sql = new sql();

            if(isset($_GET["category"])) {
                $category = $_GET["category"];
                echo $category;
            }
            $prepare = $sql->requete("SELECT * from Product WHERE ProductType=?");
            $prepare->execute([$category]);
            $productByCategory = $prepare->fetchAll(\PDO::FETCH_ASSOC);
            if($productByCategory != null) {
                    
        ?>
            <div>
                <?php
                    foreach($productByCategory as $row) {
                ?>
                    <div class="product-card">
                        <form class="myform" data-id="<?php echo $row["ProductId"] ?>">
                            <a href="./product?pid=<?php echo $row["ProductId"]; ?>">
                                <div class="product-card__image">
                                        <img src="<?php echo './'.$row["PhotoUrl"] ?>" />
                                </div>
                            </a>
                            <div class="product-card__details">
                                <div class="product-card__label"><?php echo $row["Label"] ?></div>
                                <div class="product-card__price">
                                    <?php echo $row["Price"] ?>
                                    <span class="product-card__price--currency">€</span>
                                </div>
                                <div class="product-card__quantity">Disponible: <?php echo $row["Quantity"]?></div>
                                
                                <button type="button" title="Ajouter au panier" class="add c-btn c-btn--big" id="btnAddToCart"><input type="number" min="1" max=<?php echo $row["Quantity"] ?> value="1" name="Quantity" id="productQuantity" class="product-card__input" />Ajouter au panier</button>
                            </div>
                        </form>
                    </div>
                <?php
                    }
                ?>
            </div>
        <?php
            }
        ?>
    </div>
</body>
</html>