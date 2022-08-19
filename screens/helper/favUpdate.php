<?php require "headers.php";

if ($_SESSION['loggedin']) {
    $con = connect('db_template');
    $prod = safe($_POST['product']);

    if (!in_array($prod, $_SESSION['fav'])) {
        array_push($_SESSION['fav'], $prod);
    }

    echo true;
} else {
    $_SESSION['failure'] = 'You must sign in first!';            
    echo false;
}
?>