<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Document</title>
    <link rel="stylesheet" href='./styles/style.css' />
    <link rel="stylesheet" href='./styles/productGallery.css' />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="./js/products.js" defer></script>
    <script src="./js/scroll.js" defer></script>
</head>
<body>
    <?php
        require_once("./includes/db.php");
        $sql = new sql();
        $prepare = $sql->requete("SELECT * from Category");
        $prepare->execute();
        $categories_array = $prepare->fetchAll(\PDO::FETCH_ASSOC);
        if ($categories_array != null) {
            foreach($categories_array as $cat) {
                $prepare = $sql->requete("SELECT * from Product WHERE ProductType=?");
                $prepare->execute([$cat["Label"]]);
                $productByCategory = $prepare->fetchAll(\PDO::FETCH_ASSOC);
                if($productByCategory != null) {
                
    ?>
    <div class="product-gallery">
        <div class="product-gallery__title">
            <h1><?php echo $cat["Label"]; ?></h1>
            <a href="<?php echo "./productPage.php?category=".$cat["Label"]; ?>">En savoir plus</a>
        </div>
        <div class="product-gallery__container">
            <button class="scroll-left">
                <i class="fa-solid fa-chevron-left fa-2xl"></i>
            </button>
            <?php
                foreach($productByCategory as $row) {
            ?>
                <div class="product-card">
                <form class="myform" data-id="<?php echo $row["ProductId"] ?>">
                    <div class="product-card__image">
                        <img src="<?php echo './'.$row["PhotoUrl"] ?>" />
                    </div>
                    <div class="product-card__details">
                        <div class="product-card__label"><?php echo $row["Label"] ?></div>
                        <div class="product-card__price">
                            <?php echo $row["Price"] ?>
                            <span class="product-card__price--currency">€</span>
                        </div>
                        <div class="product-card__quantity">Disponible: <?php echo $row["Quantity"]?></div>
                        
                        <button title="Ajouter au panier" class="add c-btn c-btn--big" id="btnAddToCart"><input type="number" min="1" max=<?php echo $row["Quantity"] ?> value="1" name="Quantity" id="productQuantity" class="product-card__input" />Ajouter au panier</button>
                    </div>
                </form>
                </div>
            <?php
                }
            ?>
            <button class="scroll-right">
                <i class="fa-solid fa-chevron-right fa-2xl"></i>
            </button>
        </div>
    </div>
    <?php
                }
            }
        }
    ?>
</body>
</html>
