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
    <div id="nav-placeholder"></div>

    <?php
        //Haven't made the change email and password buttons yet
        if ($_SESSION['loggedin']) {
            echo '
            <div id="account-container" class="container-fluid main">
                <div class="row">
                    <h2>MY ACCOUNT</h2>
                    <div class="col-md-6 border">
                            <p>My email:</p>
                    </div>
                    <div class="col-md-6 border">'
                            . $_SESSION['email'] .
                    '</div>
                </div>
                <div class="row">
                    <div id="change-email-btn" class="col-md-6">
                        <button>Change email</button>
                    </div>
                    <div id="change-password-btn" class="col-md-6">
                        <button>Change password</button>
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
    <div id="footer-placeholder"></div>


</body>
</html>

<script>
$(function() {
  $("#nav-placeholder").load("standalone/navbar.php");
});
$(function() {
  $("#footer-placeholder").load("standalone/footer.html");
})
</script>