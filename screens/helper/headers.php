<?php
session_start();
if (empty($_SESSION['loggedin'])) {
    $_SESSION['loggedin'] = False;
}

function login($email) {
  session_regenerate_id();
  $_SESSION['loggedin'] = True;
  $_SESSION['email'] = $email;
  $_SESSION['cart'] = array();
  $_SESSION['fav'] = array();
  $_SESSION['id'] = $arr['id'];

  $_SESSION['success'] = 'Welcome ' . $_SESSION['email'];            
  header('Location: ../index.php');
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