<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="robots" content="noindex, nofollow">
      <title>Document</title>
      <script src="https://kit.fontawesome.com/fa06461fb1.js" crossorigin="anonymous"></script>
  </head>
  <body>
    <div class="c-header">
      <div class="c-header__item">
          <a class="c-header__logo" href="./index.php"><img src="./images/logo.svg"></a>
      </div>
      <div class="c-header__item c-header__input">
          <input type="text" />
          <button type="button" class="c-btn c-btn--transparent c-btn--input">
            <i class="fa-solid fa-magnifying-glass"></i>
          </button>
      </div>
      <div class="c-header__item">
        <?php 
          if(!isset($_SESSION["user_id"])) {
            echo '<a class="active" href="./signin.php"><span>Connection</span><i class="fa fa-sign-in" aria-hidden="true"></i></a>';
          } else {
            echo "<div class='active-user'><span>Bonjour ".$_SESSION['firstname']."</span>";
            echo "<span>Votre compte <i class='fa-solid fa-caret-down fa-xs'></i></span><div class='user-account-info'><span><a href='./deconnexion.php'>Déconnexion<i class='fa-solid fa-right-from-bracket'></i></a></span></div></div>";
          }
        ?>
      </div>
      <div class="c-header__item">
          <a href="./commandes.php">Vos commandes</a>
        </a>
      </div>
      <div class="c-header__item">
        <a class="active" href="./shoppingCardList.php">
          <div class="active__col">
            <div id="nb-products">
              <?php
                if(!empty($_SESSION["shopping_card"])) {
                  echo sizeof($_SESSION["shopping_card"]);
                }
              ?>
            </div>
            <i class="fa-solid fa-cart-shopping fa-xl"></i>
          </div>
          <span>Panier</span>
        </a>
      </div>
  </div>
  <div class="c-subheader">
    <div class="c-subheader__container">
      <?php
        require_once("./includes/db.php");

        $sql = new sql();

        $req = $sql->requete("SELECT * from Category");
        $req->execute();

        $categories_array = $req->fetchAll(\PDO::FETCH_ASSOC);
        if ($categories_array != null) {
            foreach($categories_array as $cat) {
      ?>
        <div class="c-subheader__item"><a href="<?php echo "./productPage.php?category=".$cat["Label"]?>"><?php echo $cat["Label"]; ?></a></div>
      <?php 
          }
        }
      ?>
    </div>
  </div>
  <script>
    $(window).on('load', () => {
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

    $(window).on('pagehide', (event) => {
      if(event.originalEvent.persisted) {
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
      }
    });

    // window.onpopstate = () => {
    //   fetch('./nbProducts.php',
    //     {
    //         method: "get",
    //         headers: {
    //             'Content-Type': 'application/json'
    //         }
    //     }
    //     ).then(res => {
    //         return res.json();
    //     }).then(data => {
    //         document.querySelector("#nb-products").textContent = data.nbProducts;
    //     });
    // }
    // window.onunload = function(){}; 
    // $(window).on('popstate', () => {
    //   console.log("popstate");
    //   fetch('./nbProducts.php',
    //     {
    //         method: "get",
    //         headers: {
    //             'Content-Type': 'application/json'
    //         }
    //     }
    //     ).then(res => {
    //         return res.json();
    //     }).then(data => {
    //         document.querySelector("#nb-products").textContent = data.nbProducts;
    //     });
    // });
  </script>
  </body>
</html>