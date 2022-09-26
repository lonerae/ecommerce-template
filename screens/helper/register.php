<?php require "headers.php"; 

$con = connect('db_template');

$email = safe($_POST["email"]);
$password = password_hash(safe($_POST["password"]),PASSWORD_DEFAULT);

$query1 = 'INSERT INTO accounts (email, password) VALUES (:email, :password)';
$values = [':email' => $email, ':password' => $password];

$query2 = 'SELECT id FROM accounts WHERE email = ?';

try {
    $ins = $con->prepare($query1);
    $ins->execute($values);

    $res = $con->prepare($query2);
    $res->execute(array($email));
    $arr = $res->fetch();

    login($arr['id'],$email);
} catch (PDOException $e) {
    $_SESSION['failure'] = 'Email already in use!';            
    header('Location: ../signin.php');
    die();
}
?>
