<?php 
require "headers.php";

if ($_POST['action'] == 0) {
    $name = safe($_POST['item']);

    $con = connect('db_template');
    
    $query = "SELECT products.id,products.product,products.price FROM products WHERE products.product = ?";
    
    $res = $con->prepare($query);
    $res->execute(array($name));
    $arr = $res->fetch();

    $cart = new stdClass;
    $cart->id = $arr['id'];
    $cart->name = $arr['product'];
    $cart->price = $arr['price'];
    $cart->quantity = 1;
    
    if (!in_array($cart->id, array_column($_SESSION['cart'],'id'))) {
        array_push($_SESSION['cart'], $cart);
    }
        
    echo 'Item added to Cart!';
} else {
    $id=safe($_POST['id']);

    if ($_POST['action'] == 1) {
        $quantity = safe($_POST['quantity']);

        $pos = array_search($id, array_column($_SESSION['cart'], 'id'));
        $_SESSION['cart'][$pos]->quantity = $quantity;
    } else if ($_POST['action'] == 2) {
        
        $pos = array_search($id, array_column($_SESSION['cart'], 'id'));
        unset($_SESSION['cart'][$pos]);
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }
}
?>