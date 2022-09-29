<?php require "headers.php"; 

$con = connect('db_template');

$street = safe($_POST["street"]);
$number = safe($_POST["number"]);
$area = safe($_POST["area"]);
$postcode = safe($_POST["postcode"]);
$phone = safe($_POST["phone"]);

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
