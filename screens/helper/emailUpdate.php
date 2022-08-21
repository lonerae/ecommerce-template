<?php require "headers.php";
$con = connect('db_template');

$email = $_SESSION["email"];
$newEmail = safe($_POST["new-email"]);

$query = 'SELECT id FROM accounts WHERE email = ?';

$res = $con->prepare($query);
$res->execute(array($email));

$id = $res->fetch();

$query2 = 'UPDATE accounts SET email = ? WHERE id = ?';

$res2 = $con->prepare($query2);
$res2->execute(array($newEmail,$id[0]));
$_SESSION['email'] = $newEmail;

header('Location: ../account.php');
die();
?>