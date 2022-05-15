<?php
    session_start();
    require("./includes/db.php");
    require("./consoleLog.php");
    if(isset($_POST["create_account"])){
        $_SESSION["start"] = time();
        $_SESSION["expire"] = $_SESSION["start"] + (30*60);
        
        $email = $_POST["email"];
        $passwd = $_POST["passwd"];
        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $phone = $_POST["phone"];
        $now = date("Y-d-m H:i:s.v", strtotime('now'));

        $sql = new sql();

        $req = $sql->requete("INSERT INTO Person (FirstName, LastName, EmailAddress, Password, PhoneNumber, DateAdded, DateUpdated) VALUES(?, ?, ?, ?, ?, ?, ?)");

        try {
            $req->execute([$firstname, $lastname, $email, $passwd, $phone, $now, $now]);
        } catch (PDOException $e) {
            $errorCode = $req->errorInfo()[1];
            console_log($errorCode);
            if ($errorCode == 2627) {
                header('Location: signup.php');
                exit();
            } else {
                throw $e;
            }
        }

        $_SESSION["user_id"] = $sql->getLastInsertId();
        $_SESSION["firstname"] = $_POST["firstname"];
        $_SESSION["lastname"] = $_POST["lastname"];
        $_SESSION["email"] = $_POST["email"];

        header('Location: index.php');
        exit();
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="robots" content="noindex, nofollow">
        <link rel="stylesheet" href="./styles/common.css" />
        <link rel="stylesheet" href="./styles/style.css" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/fa06461fb1.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="./js/signup.js"></script>
    </head>
    <body>
    <div class="l-main">
            <div class="l-main__item">
                <div class="l-main__subitem--vertical-layout">
                    <div class="c-accordion">
                    <form action="" method="post" class="myform">
                        <div class="c-accordion__item" id="account-info">
                            <div class="c-accordion__header">
                                <div class="c-accordion__row">
                                    <div class="c-accordion__circle"><i></i></div>
                                    <h5>Informations relatives au compte</h5>
                                </div>
                                <button type="button" class="c-btn c-btn--transparent c-btn--bold" onclick="editInfoAccount()">
                                    Editer
                                    <i class="fa-solid fa-pen-to-square" style="color: #2b6fc9;"></i>
                                </button>
                            </div>
                            <div class="c-accordion__summary">
                                <p></p>
                                <p></p>
                            </div>
                            <div class="c-accordion__content">
                                <div class="c-field">
                                    <label class="c-field__label">Adresse électronique</label>
                                    <div class="c-field__outer-wrapper">
                                        <div class="c-field__wrapper">
                                            <input type="text" class="c-field__input" onchange="onEmailInputChangeHandler(event)" name="email" />
                                            <button type="button" class="c-btn c-btn--transparent c-btn--input" onclick="onEmailInputButtonClick(event)">
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
                                            <input type="password" class="c-field__input" oninput="onPasswdInputValidation(event)" name="passwd" id="passwd"/>
                                            <button type="button" class="c-btn c-btn--transparent c-btn--input" onclick="onPasswordButtonClick()">
                                                <i class="fa-solid fa-eye" style="color: white;"></i>
                                            </button>
                                        </div>
                                        <div class="c-field__requirements"></div>
                                    </div>
                                    <div class="c-password-helper__outer-wrapper">
                                        <div class="c-password-helper__wrapper">
                                            <div class="c-password-helper__item">
                                                <i class="fa-solid fa-square-check" id="rule1"></i>
                                                <div class="c-password-helper__info">8 à 31 caractères</div>
                                            </div>
                                            <div class="c-password-helper__item">
                                                <i class="fa-solid fa-square-check" id="rule2"></i>
                                                <div class="c-password-helper__info">Un caractère en majuscule</div>
                                            </div>
                                            <div class="c-password-helper__item">
                                                <i class="fa-solid fa-square-check" id="rule3"></i>
                                                <div class="c-password-helper__info">Un caractère en minuscule</div>
                                            </div>
                                            <div class="c-password-helper__item">
                                                <i class="fa-solid fa-square-check" id="rule4"></i>
                                                <div class="c-password-helper__info">Un caractère spécial</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="c-line-progress">
                                        <div class="c-line-progress__node"></div>
                                        <div class="c-line-progress__node"></div>
                                        <div class="c-line-progress__node"></div>
                                        <div class="c-line-progress__node"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="c-accordion__submit">
                                <div class="c-accordion__row">
                                    <button type="button" class="c-btn c-btn--medium" onclick="goNextFormularSection()">
                                        Suivant&nbsp;
                                        <i class="fa-solid fa-arrow-down-long" style="color: white; position: absolute; top: 40%; left: 120px;"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="c-accordion__item" id="personal-info">
                            <div class="c-accordion__header">
                                <div class="c-accordion__row">
                                    <div class="c-accordion__circle"></div>
                                    <h5>Informations personnelles</h5>
                                </div>
                            </div>
                            <div class="c-accordion__content">
                                <div class="c-field">
                                    <label class="c-field__label">Nom</label>
                                    <div class="c-field__outer-wrapper">
                                        <div class="c-field__wrapper">
                                            <input type="text" class="c-field__input" onchange="onEmailInputChangeHandler(event)" name="lastname"/>
                                        </div>
                                        <div class="c-field__requirements">Veuillez entrer un prénom</div>
                                    </div>
                                </div>
                                <div class="c-field">
                                    <label class="c-field__label">Prénom</label>
                                    <div class="c-field__outer-wrapper">
                                        <div class="c-field__wrapper">
                                            <input type="text" class="c-field__input" onchange="onEmailInputChangeHandler(event)" name="firstname" />
                                        </div>
                                        <div class="c-field__requirements">Veuillez entrer un nom</div>
                                    </div>
                                </div>
                                <div class="c-field">
                                    <label class="c-field__label">Numéro de téléphone</label>
                                    <div class="c-field__outer-wrapper">
                                        <div class="c-field__wrapper">
                                            <input type="tel" class="c-field__input" onchange="onEmailInputChangeHandler(event)" name="phone" pattern="[0-9]{10}" required/>
                                            <button type="button" class="c-btn c-btn--transparent c-btn--input" onclick="onEmailInputButtonClick(event)">
                                                <i class="fa-solid fa-arrow-right-long"></i>
                                            </button>
                                        </div>
                                        <div class="c-field__requirements">Veuillez entrer un numéro de téléphone valide</div>
                                    </div>
                                </div>
                            </div>
                            <div class="c-accordion__submit">
                                <div class="c-accordion__row">
                                    <button class="c-btn c-btn--medium" name="create_account" id="create_account">
                                        Créer le compte
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        <div class="l-main__item logo">
            <div class="c-logo">
                <a href="./index.php"><img src="./images/logo.svg"></a>
            </div>
        </div>
    </div>
    </body>
</html>
