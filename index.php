<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();

        if(isset($_SESSION["user_id"])) {
            $now = time();

            if($now > $_SESSION["expire"]) {
                session_destroy();
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href='./styles/common.css'/>
    <link rel="stylesheet" href='./styles/style.css' />
    <link rel="stylesheet" href='./styles/headline.css' />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
    <?php
        require('./headline.php');
        require('./productGallery.php');
    ?>
</body>
</html>