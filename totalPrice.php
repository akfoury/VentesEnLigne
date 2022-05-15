<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    function getTotalPrice() {
        $totalPrice = 0;
        if(!empty($_SESSION["shopping_card"])) {
            foreach($_SESSION["shopping_card"] as $innerArray) {
                if(is_array($innerArray)) {
                    $totalPrice += $innerArray["Price"] * $innerArray["Quantity"];
                }
            }
        }
        return $totalPrice;
    }
?>