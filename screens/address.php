<?php require "helper/headers.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>ecommerce template</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="styles.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body class="container-fluid">

    <?php if(!empty($_SESSION['success'])) {
        echo '<span class="server-msg">'. $_SESSION['success'] . '</span>';
        unset($_SESSION['success']);
    }
    ?>

  <!--Navigation Bar-->
  <?php include "standalone/navbar.php";?>

  <div id="address" class="main">
    <form id="register-form" name="register" action="helper/addressUpdate.php" method="post">
        <p>Fill with your address details for future orders!</p>
        <div class="row">
            <label for="street-sign-up" class="form-label">Street</label>
            <input class="form-control" name="street" id="street-sign-up" required>
            <label for="number-sign-up" class="form-label">Number</label>
            <input class="form-control" name="number" id="number-sign-up" required>
        </div>
        <div class="row">
            <label for="area-sign-up" class="form-label">City</label>
            <input class="form-control" name="area" id="area-sign-up" required>
        </div>
        <div class="row">
            <label for="postcode-sign-up" class="form-label">Postal code</label>
            <input class="form-control" name="postcode" id="postcode-sign-up" required>
        </div>
        <div class="row">
            <label for="phone-sign-up" class="form-label">Phone number (optional)</label>
            <input class="form-control" name="phone" id="phone-sign-up">
        </div>
        <button type="submit" class="btn btn-primary">Finish registration</button>
    </form>
  </div>

  <!--Footer-->
  <?php include "standalone/footer.html";?>

</body>
</html>
