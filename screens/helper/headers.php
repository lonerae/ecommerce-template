<?php
session_start();
if (empty($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}
if (empty($_SESSION['loggedin'])) {
    $_SESSION['loggedin'] = False;
}

function login($id,$email) {
  session_regenerate_id();
  $_SESSION['loggedin'] = True;
  $_SESSION['email'] = $email;
  $_SESSION['id'] = $id;

  $_SESSION['success'] = 'Welcome ' . $_SESSION['email'];            
  header('Location: ../index.php');
  die();
}

function signin($id, $email) {
  session_regenerate_id();
  $_SESSION['loggedin'] = True;
  $_SESSION['email'] = $email;
  $_SESSION['id'] = $id;

  $_SESSION['success'] = 'Welcome ' . $_SESSION['email'];            
  header('Location: ../address.php');
  die();
}

function safe($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);

  return $data;
}

//Change default host, name, user, password and port to yours
function connect($db){
  $dbHost="localhost";
  $dbName = $db; 
  $dbUser="root";
  $dbPassword="";
     
  $con = new PDO("mysql:host=$dbHost;port=3308;dbname=$dbName",$dbUser,$dbPassword);
  return $con;
}
?>
