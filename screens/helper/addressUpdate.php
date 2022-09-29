<?php require "headers.php"; 

$con = connect('db_template');

$street = $_POST["street"];
$number = $_POST["number"];
$area = $_POST["area"];
$postcode = $_POST["postcode"];

if (isset($_POST["phone"])) {
    $phone = $_POST["phone"];
} else {
    $phone = NULL;
}

$address = $street . " " . $number . ", " . $area;

$query = 'INSERT INTO users (userId, address, postcode, phone) VALUES (:userId, :address, :postcode, :phone)';
$values = [':userId' => $_SESSION['id'], ':address' => $address, ':postcode' => $postcode, ':phone' => $phone];

try {
    $ins = $con->prepare($query);
    $ins->execute($values);

    header('Location: ../account.php');
    die();
} catch (PDOException $e) {
    $_SESSION['failure'] = 'Error! Registration was not successful.';            
    header('Location: ../signin.php');
    die();
}
?>
