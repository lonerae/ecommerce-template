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

<?php if (!empty($_SESSION['failure'])) {
    echo '<span class="server-msg">'. $_SESSION['failure'] . '</span>';
    unset($_SESSION['failure']);
  }
?>

  <!--Navigation Bar-->
  <?php include "standalone/navbar.php";?>
  
  <div id="signin" class="main">
    <div class="row">
      <div class="col-md-3"></div>
      <div id="authenticate-col" class="col-md-3">
        <form id="authenticate-form" action="helper/authenticate.php" method="post">
          <p>Log In</p>
          <div class="mb-3">
            <label for="mail-sign-in" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="mail-sign-in" aria-describedby="emailHelp" required>
          </div>
          <div class="mb-3">
            <label for="pass-sign-in" class="form-label">Password</label>
            <i class="fa fa-eye" id="togglePassword" onclick="showPass('pass-sign-in')"></i>
            <input type="password" name="password" class="form-control" id="pass-sign-in" required>
          </div>
          <button type="submit" value="sign-in" class="btn btn-primary">Log In</button>
        </form>
      </div>
      <div id="register-col" class="col-md-3">
        <form id="register-form" name="register" action="helper/register.php" method="post">
          <p>Sign In</p>
          <div class="mb-3">
            <label for="mail-sign-up" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="mail-sign-up" aria-describedby="emailHelp" required>
          </div>
          <div class="mb-3">
            <label for="pass-sign-up" class="form-label">Password</label>
            <i class="fa fa-eye" id="togglePassword" onclick="showPass('pass-sign-up')"></i>
            <input type="password" name="password" class="form-control" id="pass-sign-up" required>
          </div>
          <div class="mb-3">
            <label for="confirm-pass" class="form-label">Repeat Password</label>
            <i class="fa fa-eye" id="togglePassword" onclick="showPass('confirm-pass')"></i>
            <input type="password" name="password-confirm" class="form-control" id="confirm-pass" required>
          </div>
          <button class="btn btn-primary" onclick="condSubmit()">Sign In</button>
        </form>
      </div>
      <div class="col-md-3"></div>
    </div>
  </div>

  <!--Footer-->
  <?php include "standalone/footer.html";?>
  
</body>
</html>

<script>
  function showPass(target) {
    let x = document.getElementById(target);
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  }
</script>

<script>
  function condSubmit() {
    event.preventDefault();
    if (document.getElementById("mail-sign-up").value.toLowerCase().match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) {
      if ((document.getElementById("pass-sign-up").value != "") && (document.getElementById("pass-sign-up").value == document.getElementById("confirm-pass").value)) {
        document.forms["register"].submit();
      } else {
        alert("Passwords don't match!");
      } 
    } else {
      alert("Invalid email!");
    }
  }
</script>
