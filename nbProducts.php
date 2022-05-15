<?php
    session_start();
    if(isset($_SESSION["total_shopping_card"])) {
        $nbProducts = array("nbProducts"=>$_SESSION["total_shopping_card"]);
        header("Content-Type: application/json; charset=UTF-8");
        $myJson=json_encode($nbProducts);

        echo $myJson;
    } else {
        echo json_encode(array("nbProducts" => 0));
    }
?>