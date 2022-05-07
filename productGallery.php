<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./productGallery.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
    <?php
        require("includes/db.php");
        $sql = new sql();
        $prepare = $sql->requete("SELECT * from Category");
        $prepare->execute();
        $categories_array = $prepare->fetchAll(\PDO::FETCH_ASSOC);
        if ($categories_array != null) {
            foreach($categories_array as $cat) {
                $prepare = $sql->requete("SELECT * from Product WHERE ProductType=?");
                $prepare->execute([$cat["Label"]]);
                $productByCategory = $prepare->fetchAll(\PDO::FETCH_ASSOC);
    ?>
    <div class="product-gallery">
        <h3><?php echo $cat["Label"]; ?></h3>
        <div>
            <button class="scroll-left">
                <i class="fa-solid fa-chevron-left fa-2xl"></i>
            </button>
            <?php
                if($productByCategory != null) {
                    foreach($productByCategory as $row) {
            ?>
                <div class="product-card">
                    <form class="myform" data-id="<?php echo $row["ProductId"] ?>">
                        <div class="product-card__image">
                            <img src="<?php echo $row["PhotoUrl"] ?>" />
                        </div>
                        <div class="product-card__label"><?php echo $row["Label"] ?></div>
                        <div class="product-card__price"><?php echo $row["Price"] ?></div>
                        <div class="product-card__quantity"><?php echo $row["Quantity"]?></div>
                        <div class="product-card__action">
                            <input type="number" min="0" value="0" name="Quantity" />
                            <button class="add">Ajouter au panier</button>
                        </div>
                    </form>
                </div>
            <?php
                    }
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
    ?>
    <script>
        $('document').ready(function(){
            $('.myform').on('submit',function(e, action, code) {
                e.preventDefault();
                const formData = new FormData($(e.target).closest("form")[0]);
                fetch('crudProducts.php?' + new URLSearchParams({ action: action, code: code }),
                    { 
                        method: "post", 
                        body: formData,
                    }
                ).then(response => {
                    fetch('nbProducts.php',
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
            });
        });
        $('.add').on("click", (e) => {
            e.preventDefault();
            const productId = $(e.target).closest("form").attr("data-id");
            $(e.target).closest("form").trigger('submit', ["add", productId]);
        });

        if($(".product-gallery")[0].scrollWidth === $(".product-gallery").innerWidth()) {
            $(".scroll-left").hide();
            $(".scroll-right").hide();
        } else {
            $(".scroll-left").hide();
            $(".scroll-right").show();
        }

        $(window).on("resize", () => {
            if($(".product-gallery")[0].scrollWidth === $(".product-gallery").innerWidth()) {
                $(".scroll-left").hide();
                $(".scroll-right").hide();
            } else {
                $(".scroll-left").hide();
                $(".scroll-right").show();
            }
        });


        $('.scroll-right').on("click", (e) => {
            e.preventDefault();
            $(e.target).closest(".product-gallery").scrollLeft($(e.target).closest(".product-gallery").scrollLeft() + $(e.target).closest(".product-gallery").innerWidth());

            if ($(e.target).closest(".product-gallery")[0].offsetWidth + $(e.target).closest(".product-gallery").scrollLeft() + $(e.target).closest(".product-gallery").innerWidth() >= $(e.target).closest(".product-gallery")[0].scrollWidth) {
                $(e.target).closest(".scroll-right").hide();
            }

            if($(e.target).closest(".product-gallery").scrollLeft() + $(e.target).closest(".product-gallery").innerWidth() > 0) {
                $(e.target).closest(".scroll-right").siblings(".scroll-left").show();
            }
            
        });

        $('.scroll-left').on("click", (e) => {
            e.preventDefault();
            $(e.target).closest(".product-gallery").scrollLeft($(e.target).closest(".product-gallery").scrollLeft() - $(e.target).closest(".product-gallery").innerWidth());
            
            if($(e.target).closest(".product-gallery").scrollLeft() - $(e.target).closest(".product-gallery").innerWidth() <= 0) {
                $(e.target).closest(".scroll-left").hide();
            }

            if($(e.target).closest(".product-gallery")[0].offsetWidth + $(e.target).closest(".product-gallery").scrollLeft() - $(e.target).closest(".product-gallery").innerWidth() < $(e.target).closest(".product-gallery")[0].scrollWidth) {
                $(e.target).closest(".scroll-left").siblings(".scroll-right").show();
            }

        });


    </script>
</body>
</html>
