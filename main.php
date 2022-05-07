<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="c-page__header">
        <div>
            Délivrée à <?= $_SESSION["firstname"] ?>
        </div>
        <div class="c-search-field">
            <input type="text"/>
        </div>
        <div>
            <button>Commandes</button>
            <button>Panier</button>
        </div>
    </div>
    <div class="c-page__content"></div>
</body>
</html>