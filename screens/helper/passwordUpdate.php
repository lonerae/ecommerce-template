<?php
require "headers.php";
$con = connect('db_template');

$oldPassword = $_POST['old'];

$query = 'SELECT id,password FROM accounts WHERE email = ?';

$res = $con->prepare($query);
$res->execute(array($_SESSION['email']));

$arr = $res->fetch();

if (password_verify($oldPassword, $arr['password'])) {
    if ($_POST['new']==$_POST['rpt']) {
        $query2 = 'UPDATE accounts SET password = ? WHERE id = ?';

        $res2 = $con->prepare($query2);
        $res2->execute(array(password_hash(safe($_POST['new']),PASSWORD_DEFAULT),$arr['id']));

        $_SESSION['success'] = 'Successfully changed password!';
        echo 2;
    } else {
        echo 1;
    }
} else {
    echo 0;
}
?>