<?php require "headers.php";

    if ($_SESSION['loggedin']) {

        $cart = JSON_decode($_POST["item"]);
        
        if (!in_array($cart->id, array_column($_SESSION['cart'],'id'))) {
            array_push($_SESSION['cart'], $cart);
        } 
        
        echo true;
    } else {
        $_SESSION['failure'] = 'You must sign in first!';            
        echo false;
    }
?>