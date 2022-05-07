<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./styles/common.css" />
    <link rel="stylesheet" href="./styles/style.css" />
    <link rel="stylesheet" href="./pageHeader.css" />
    <script src="https://kit.fontawesome.com/fa06461fb1.js" crossorigin="anonymous"></script>
</head>
<body>
<?php session_start(); 
  include("./consoleLog.php");
?>
  <div class="c-header">
    <div class="c-header__item">
        <a class="c-header__logo" href="#default">CompanyLogo</a>
    </div>
    <div class="c-header__item c-header__input">
        <input type="text" />
        <button type="button" class="c-btn c-btn--transparent c-btn--input">
          <i class="fa-solid fa-magnifying-glass"></i>
        </button>
    </div>
    <div class="c-header__item">
    <a class="active" href="./shoppingCardList.php">
      <div class="active__col">
        <div id="nb-products">
          <?php 
            if(isset($_SESSION["total_shopping_card"] )) {
              echo $_SESSION["total_shopping_card"];
            }
          ?>
        </div>
        <i class="fa-solid fa-cart-shopping fa-xl"></i>
      </div>
      <span>Panier</span>
    </a>
    </div>
</div>
</body>
</html>