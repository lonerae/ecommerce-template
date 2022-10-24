<?php require "headers.php"
  if ($_SESSION['loggedin']) {
    echo true;
  } else {
    $_SESSION['failure'] = "You must log-in first!";
    echo false;
  }
?>
