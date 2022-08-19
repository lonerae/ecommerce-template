<?php
    session_start();
    session_regenerate_id();
    $_SESSION['loggedin'] = FALSE;
    $_SESSION['email'] = "";
    $_SESSION['cart'] = array();
    $_SESSION['id'] = "";

    $_SESSION['success'] = 'Successfully logged out!';            
    header('Location: ..\index.php');
    die();
?>