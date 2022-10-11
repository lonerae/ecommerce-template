<?php require "helper/headers.php";?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>ecommerce template</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="styles.css">

  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body class="container-fluid">

    <!--Navigation Bar-->
    <?php include "standalone/navbar.php";?>

    <?php
        if ($_SESSION['loggedin']) {
          $con = connect('db_template');
          $query = 'SELECT accounts.email, users.address, users.postcode, users.phone FROM accounts
          INNER JOIN users ON accounts.id = users.userId
          WHERE accounts.id = ?';

          $res = $con->prepare($query);
          $res->execute(array(safe($_SESSION['id'])));
          $arr = $res->fetch();
          
          echo '
            <div id="account-container" class="container-fluid main">
                <div class="row">
                    <h2>MY ACCOUNT</h2>
                    <div class="col-md-6 border">
                            <p>Email:</p>
                    </div>
                    <div class="col-md-6 border">'
                            . $arr['email'] .
                    '</div>
                </div>
                <div class="row">
                    <div class="col-md-6 border">
                            <p style="font-weight: bold;">Address:</p>
                    </div>
                    <div class="col-md-6 border">'
                            . $arr['address'] . ", " . $arr['postcode'] .
                    '</div>
                </div>
                <div class="row">
                    <div class="col-md-6 border">
                            <p style="font-weight: bold;">Phone:</p>
                    </div>
                    <div class="col-md-6 border">'
                            . $arr['phone'] .
                    '</div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div id="change-password-btn">
                            <button onclick="changePassword()">Change password</button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div id="change-details-btn">
                            <button onclick="changeDetails()">Edit address details</button>
                        </div>
                    </div>
                </div>
            </div>';
        } else {
            $_SESSION['failure'] = 'You must log in first!';            
            header('Location: signin.php');
            die();
        }
    ?>

    <!--Footer-->
    <?php include "standalone/footer.html";?>


</body>
</html>

<script>
    function changePassword() {
        window.location = "changePassword.php";
    }
    function changeDetails() {
        window.location = "changeDetails.php";

    }
</script>
