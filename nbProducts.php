<?php
session_start();
$nbProducts = array("nbProducts"=>$_SESSION["total_shopping_card"]);
header("Content-Type: application/json; charset=UTF-8");
$myJson=json_encode($nbProducts);

echo $myJson;
?>