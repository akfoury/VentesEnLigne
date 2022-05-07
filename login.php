<html>
    <head>
        <link rel="stylesheet" href="styles/common.css" />
        <link rel="stylesheet" href="styles/style.css" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/fa06461fb1.js" crossorigin="anonymous"></script>
        <script src="./login.js"></script>
    </head>
    <body>
    <div class="l-main">
            <div class="l-main__item">
                <div class="l-main__subitem--vertical-layout">
                    <div class="c-accordion">
                    <form action="" method="post">
                        <div class="c-accordion__item" id="account-info">
                            <div class="c-accordion__header">
                                <div class="c-accordion__row">
                                    <div class="c-accordion__circle"></div>
                                    <h5>Informations relatives au compte</h5>
                                </div>
                                <button class="c-btn c-btn--transparent" onclick="editInfoAccount()">
                                    Editer
                                    <i class="fa-solid fa-pen-to-square" style="color: rgba(101, 103, 221, 0.897);"></i>
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
                                            <input type="password" class="c-field__input" oninput="onPasswdInputValidation(event)" name="passwd"/>
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
                                    <button type="button" class="c-btn c-btn--big" onclick="goNextFormularSection()">
                                        Suivant&nbsp;
                                        <i class="fa-solid fa-arrow-down-long" style="color: white;"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="c-accordion__item">
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
                                            <input type="text" class="c-field__input" onchange="onEmailInputChangeHandler(event)" name="phone"/>
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
                                    <button class="c-btn c-btn--big" name="create_account">
                                        Valider le compte
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        <div class="l-main__item"> </div>
    </div>
    <?php
        include("includes/db.php");
        if(isset($_POST["create_account"])){
            $email = $_POST["email"];
            $passwd = $_POST["passwd"];
            $firstname = $_POST["firstname"];
            $lastname = $_POST["lastname"];
            $phone = $_POST["phone"];
            $now = date("Y-m-d H:i:s", strtotime('now'));

            $sql = new sql();

            $req = $sql->requete("INSERT INTO Person (FirstName, LastName, EmailAdress, Password, PhoneNumber, DateAdded, DateUpdated) VALUES(?, ?, ?, ?, ?, ?, ?)");
            $req->execute([$firstname, $lastname, $email, $passwd, $phone, $now, $now]);
            startSession($firstname, $lastname);
        }
    ?>
    <!-- <div class="main-layout">
        <div class="main-layout-child registration vertical-layout">
            <div class="main-layout-grandchild">
                <div class="account-step">
                    <div class="accordion">
                        <div id="account-info" class="accordion-item">
                            <div class="accordion-item__header_section">
                                <h5 class="accordion-item__header" id="account-info__header">
                                    <div class="accordion-item__row">
                                        <div class="accordion-item__circle" id="account-info__circle"></div>
                                        Informations relatives au compte
                                    </div>
                                    <button class="accordion-item__edit" id="account-info__edit">
                                        Editer
                                        <div class="edit"></div>
                                    </button>
                                </h5>
                            </div>
                            <div class="accordion-item__summary-section" id="account-info__summary">
                                <div id="email-recap">
                                    <p></p>
                                </div
                                ><div id="mdp-recap">
                                    <p></p>
                                </div>
                            </div>
                            <div class="accordion-item__content_section" id="account-info__content_section">
                                <div class="row-component">
                                    <label for="email-input" class="input-label">Adresse électronique</label>
                                    <div class="text-input__outer-wrapper">
                                        <div class="text-input__wrapper">
                                            <input id="email-input" type="text" class="text-input"></input>
                                            <button id="email-btn" class="input-button left-arrow"></button>
                                        </div>
                                        <div class="requirements" id="email-input-error-msg"></div>
                                    </div>
                                </div>
                                <div class="row-component">
                                    <label for="mdp-input" id="mdp-label"class="input-label label-disabled">Mot de passe</label>
                                    <div class="text-input__outer-wrapper">
                                        <div class="text-input__wrapper" id="text-input__focusarea">
                                            <input id="mdp-input" type="password" class="text-input"></input>
                                            <button id="mdp-btn" class="input-button open-eye"></button>
                                        </div>
                                        <div class="password-helper__outer-wrapper" id="mdp-popup">
                                        <div class="password-helper__wrapper">
                                            <div class="password-helper__item">
                                                <div class="passwd-indicator__icon" id="rule-1"></div>
                                                <div class="passwd-indicator__info">8 à 31 caractères</div>
                                            </div>
                                            <div class="password-helper__item">
                                                <div class="passwd-indicator__icon" id="rule-2"></div>
                                                <div class="passwd-indicator__info">Un caractère en majuscule</div>
                                            </div>
                                            <div class="password-helper__item">
                                                <div class="passwd-indicator__icon" id="rule-3"></div>
                                                <div class="passwd-indicator__info">Un caractère en minuscule</div>
                                            </div>
                                            <div class="password-helper__item">
                                                <div class="passwd-indicator__icon" id="rule-4"></div>
                                                <div class="passwd-indicator__info">Un caractère spécial</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="password-step" id="pwd-indicator">
                                        <div class="node"></div>
                                        <div class="node"></div>
                                        <div class="node"></div>
                                        <div class="node"></div>
                                    </div>
                                    <div class="requirements" id="mdp-input-error-msg"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="next" id="email-verif-step">
                                <button class="input-button" id="btn-info">
                                    Suivant
                                    <div class="down-arrow"></div>
                                </button>
                            </div>
                        </div>
                        <div id="verify-section" class="accordion-item">
                            <div class="accordion-item__header_section">
                                <h5 class="accordion-item__header">
                                    <div class="accordion-item__circle" id="verify-section__circle"></div>
                                    Vérifier l'email
                                </h5>
                            </div>
                            <div class="accordion-item__content_section" id="account-email-verification">
                                <div class="accordion-item__subtitle">Nous vous avons envoyé un code de vérification à 7 chiffres à alex17tri@gmail.com</div>
                                <div class="row-component">
                                    <label for="verif-input" class="input-label">Code de vérification</label>
                                    <div class="text-input__outer-wrapper">
                                        <div class="text-input__wrapper">
                                            <input id="verif-input" type="text" class="text-input"></input>
                                            <button id="verif-btn" class="input-button left-arrow"></button>
                                        </div>
                                        <div class="requirements" id="verif-input-error-msg"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="next" id="personal-info-step">
                                <button class="input-button" id="btn-verif">
                                    Suivant
                                    <div class="down-arrow"></div>
                                </button>
                            </div>
                        </div>
                        <div id="personal-information-section" class="accordion-item">
                            <div class="accordion-item__header_section">
                                <h5 class="accordion-item__header">
                                    <div class="accordion-item__circle" id="personal-section__circle"></div>
                                    Informations personnelles
                                </h5>
                            </div>
                            <div class="accordion-item__content_section" id="account-personal-informations">
                                <div class="row-component">
                                    <label for="surname-input" class="input-label">Prenom</label>
                                    <div class="text-input__outer-wrapper">
                                        <div class="text-input__wrapper">
                                            <input id="surname-input" type="text" class="text-input"></input>
                                            <button id="surname-btn" class="input-button left-arrow"></button>
                                        </div>
                                        <div class="requirements" id="surname-input-error-msg"></div>
                                    </div>
                                </div>
                                <div class="row-component">
                                    <label for="name-input" class="input-label">Nom</label>
                                    <div class="text-input__outer-wrapper">
                                        <div class="text-input__wrapper">
                                            <input id="name-input" type="text" class="text-input"></input>
                                            <button id="name-btn" class="input-button left-arrow"></button>
                                        </div>
                                        <div class="requirements" id="name-input-error-msg"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button id="create-btn" class="input-button left-arrow">Creér ton compte</button>
        </div>
        <div class="main-layout-child info-area vertical-layout">Hello world</div>
    </div>
            </div> -->
    </body>
</html>
