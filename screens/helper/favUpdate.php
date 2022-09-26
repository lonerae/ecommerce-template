<?php require "headers.php";

if ($_SESSION['loggedin']) {
    $con = connect('db_template');
    $prod = safe($_POST['product']);
    
    $query = 'INSERT INTO favourites (userId,product) VALUES (:userId,:product)';
    $values = [':userId' => $_SESSION['id'],':product' => $prod];

    $ins = $con->prepare($query);
    $ins->execute($values);

    echo true;
} else {
    $_SESSION['failure'] = 'You must sign in first!';            
    echo false;
}
?>
