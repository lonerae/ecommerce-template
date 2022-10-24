<?php require "headers.php";
    $cart = JSON_decode($_POST["item"]);

    if (!in_array($cart->id, array_column($_SESSION['cart'],'id'))) {
        array_push($_SESSION['cart'], $cart);
    } 

    echo true;
?>
