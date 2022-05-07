<?php
    session_start();
    require("includes/db.php");
    include("./consoleLog.php");

    if(isset($_GET["action"])) {
        $sql = new sql();
        $prepare = $sql->requete("SELECT * FROM Product WHERE ProductId=?");
        $prepare->execute([$_GET['code']]);
        $productById = $prepare->fetchAll(\PDO::FETCH_ASSOC);

        switch($_GET["action"]) {
            case "add":
                $itemArray = array(
                    $productById[0]["ProductId"]=>array(
                        "ProductId"=>$productById[0]["ProductId"],
                        "Label"=>$productById[0]["Label"], 
                        "Description"=>$productById[0]["Description"],
                        "ProductType"=>$productById[0]["ProductType"],
                        "PhotoUrl"=>$productById[0]["PhotoUrl"],
                        "Quantity"=>$_POST["Quantity"],
                        "Price"=>$productById[0]["Price"],
                        "Available"=>$productById[0]["Available"],
                        "DateAdded"=>$productById[0]["DateAdded"],
                        "DateUpdated"=>$productById[0]["DateUpdated"],
                        "LastModifierId"=>$productById[0]["LastModifierId"]
                        )
                    );
                if(!empty($_SESSION["shopping_card"])) {
                    if(in_array(intval($productById[0]["ProductId"]), array_keys($_SESSION["shopping_card"]))) {
                        foreach($_SESSION["shopping_card"] as $key => $value) { 
                            if(intval($productById[0]["ProductId"]) == $key) {
                                if(empty($_SESSION["shopping_card"][$key]["Quantity"])) {
                                    $_SESSION["shopping_card"][$key]["Quantity"] = 0;
                                }
                                $_SESSION["shopping_card"][$key]["Quantity"] += $_POST["Quantity"];
                                $_SESSION["total_shopping_card"] += $_POST["Quantity"];
                            }
                        }
                    } else {
                        $_SESSION["shopping_card"] = $_SESSION["shopping_card"] + $itemArray;
                        $_SESSION["total_shopping_card"] += $_POST["Quantity"];
                    }
                } else {
                    $_SESSION["shopping_card"] = $itemArray;
                    $_SESSION["total_shopping_card"] += $_POST["Quantity"];
                }
                break;
            case "remove":
                if(!empty($_SESSION["shopping_card"])) {
                    if(in_array(intval($productById[0]["ProductId"]), array_keys($_SESSION["shopping_card"]))) {
                        foreach($_SESSION["shopping_card"] as $key => $value) {
                            if(intval($productById[0]["ProductId"]) == $key) {
                                unset($_SESSION["shopping_card"][$key]);
                                $_SESSION["total_shopping_card"] -= $_POST["Quantity"];
                            }
                        }
                    }
                }
                break;
            case "update":
                if(!empty($_SESSION["shopping_card"])) {
                    if(in_array(intval($productById[0]["ProductId"]), array_keys($_SESSION["shopping_card"]))) {
                        foreach($_SESSION["shopping_card"] as $key => $value) {
                            if(intval($productById[0]["ProductId"]) == $key) {
                                if($_SESSION["shopping_card"][$key]["Quantity"] > $_POST["Quantity"]) {
                                    $_SESSION["total_shopping_card"] -= abs($_SESSION["shopping_card"][$key]["Quantity"] - $_POST["Quantity"]);
                                } else {
                                    $_SESSION["total_shopping_card"] += abs($_SESSION["shopping_card"][$key]["Quantity"] - $_POST["Quantity"]);
                                }
                                $_SESSION["shopping_card"][$key]["Quantity"] = $_POST["Quantity"];
                            }
                        }
                    }
                }
                break;
        }
    }
?>