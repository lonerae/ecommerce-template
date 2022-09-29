<?php require "headers.php";

if ($_SESSION['loggedin']) {
    $con = connect('db_template');
    $prod = safe($_POST['product']);

    
    $query = 'DELETE FROM favourites WHERE userId = ? AND product = ?';

    $ins = $con->prepare($query);
    $ins->execute(array($_SESSION['id'],$prod));

    echo true;
} else {
    $_SESSION['failure'] = 'You must log in first!';            
    echo false;
}
?>
