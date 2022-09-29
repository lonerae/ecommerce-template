<?php require "headers.php"; 

$con = connect('db_template');

$street = $_POST["street"];
$number = $_POST["number"];
$area = $_POST["area"];
$postcode = $_POST["postcode"];
$phone = $_POST["phone"];

$address = $street . " " . $number . ", " . $area;

$query = 'UPDATE users SET address = ?, postcode = ?, phone = ? WHERE userId = ?';
$values = [$address, $postcode, $phone, $_SESSION['id']];

try {
    $ins = $con->prepare($query);
    $ins->execute($values);

    echo 1;
} catch (PDOException $e) {
    echo 0;
}
?>
