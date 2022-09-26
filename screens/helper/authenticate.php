<?php
require "headers.php";
$con = connect('db_template');

if (!isset($_POST['email'], $_POST['password'])) {
	exit('Give email and password!');
}

$query = 'SELECT id, password FROM accounts WHERE email = ?';

$res = $con->prepare($query);
$res->execute(array(safe($_POST['email'])));
$arr = $res->fetch();
    
    if (!empty($arr)) {
               
        if (password_verify($_POST['password'], $arr['password'])) {
            login($arr['id'],$_POST['email']);
        } else {
            $_SESSION['failure'] = 'Wrong password!';            
            header('Location: ../signin.php');
            die();
        }
    } else {
        $_SESSION['failure'] = 'Wrong email!';            
        header('Location: ../signin.php');
        die();
    }
?>
