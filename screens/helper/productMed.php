<?php
    require "headers.php";

    $con = connect('db_template');

    $prod = safe($_POST["prod-btn"]);
    $query = "SELECT products.product FROM products WHERE products.product = ?";
    
    $res = $con->prepare($query);
    $res->execute(array($prod));
    $arr = $res->fetch();   

    header('Location: ../product.php?name='. $prod);
    die();    
?>