<?php
    session_start();
    require("./includes/db.php");
    require("./consoleLog.php");
    if(isset($_POST["login"])){
        $email = $_POST["email"];
        $passwd = $_POST["passwd"];

        $sql = new sql();

        $prepare = $sql->requete("SELECT * FROM Person WHERE EmailAddress = ? AND Password = ?");
        $prepare->execute([$email, $passwd]);
        $user = $prepare->fetchAll(\PDO::FETCH_ASSOC);

        console_log($_SESSION);
        if(count($user) > 0) {
            $_SESSION["start"] = time();
            $_SESSION["expire"] = $_SESSION["start"] + (30*60);
            $_SESSION["user_id"] = $user[0]["PersonId"];
            $_SESSION["firstname"] = $user[0]["FirstName"];
            $_SESSION["lastname"] = $user[0]["LastName"];
            $_SESSION["email"] = $user[0]["EmailAddress"];

            header('Location: index.php');
        }

    }
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="./styles/common.css" />
        <link rel="stylesheet" href="./styles/style.css" />
        <link rel="stylesheet" href="./styles/signin.css" />
        <meta name="robots" content="noindex, nofollow">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/fa06461fb1.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="./js/signin.js"></script>
    </head>
    <body>
        <div class="c-logo">
            <a href="./index.php"><img src="./images/logo.svg"></a>
        </div>
        <div class="c-accordion">
            <form action="" method="post" class="myform">
                <div class="c-accordion__item" id="account-info">
                    <div class="c-accordion__header">
                        <div class="c-accordion__row">
                            <div class="c-accordion__circle"><i></i></div>
                            <h5>Connexion</h5>
                        </div>
                        <a href="./signup.php" class="c-btn c-btn--transparent">
                            Créer un compte
                        </a>
                    </div>
                    <div class="c-accordion__content">
                        <div class="c-field">
                            <label class="c-field__label">Adresse électronique</label>
                            <div class="c-field__outer-wrapper">
                                <div class="c-field__wrapper">
                                    <input type="text" class="c-field__input" name="email" />
                                    <button type="button" class="c-btn c-btn--transparent c-btn--input">
                                        <i class="fa-solid fa-arrow-right-long"></i>
                                    </button>
                                </div>
                                <div class="c-field__requirements">Veuillez entrer une adresse électronique valide</div>
                            </div>
                        </div>
                        <div class="c-field">
                            <label class="c-field__label">Mot de passe</label>
                            <div class="c-field__outer-wrapper">
                                <div class="c-field__wrapper">
                                    <input type="password" class="c-field__input" name="passwd" id="passwd" />
                                    <button type="button" class="c-btn c-btn--transparent c-btn--input" onclick="onPasswordButtonClick()">
                                        <i class="fa-solid fa-eye" style="color: white;"></i>
                                    </button>
                                </div>
                                <div class="c-field__requirements"></div>
                            </div>
                        </div>
                    </div>
                    <div class="c-accordion__submit">
                        <div class="c-accordion__row">
                            <button class="c-btn c-btn--extra-big" name="login">
                                <div>
                                    <span>Se connecter</span>
                                    <i class="fa fa-sign-in fa-lg"></i>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>
