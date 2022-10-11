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
  
    <div id="change-password" class="container-fluid main">
        <div id="change-password-table">
            <div class="row">
                <div class="col-md-6">
                    <label for="old-password">Please type your old password:</label>
                </div>
                <div class="col-md-6">
                    <input id="old-password" name="old-password" type="password">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="new-password">Choose a new password:</label>
                </div>
                <div class="col-md-6">
                    <input id="new-password" name="new-password" type="password">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="new-password-rpt">Type the new password again:</label>
                </div>
                <div class="col-md-6">
                    <input id="new-password-rpt" name="new-password-rpt" type="password">
                </div>
            </div>
            <div class="row">
                <button id="change-password-btn" onclick="validatePassword()">Submit</button>
            </div>
        </div>
    </div>

    <!--Footer-->
    <?php include "standalone/footer.html";?>

</body>
</html>

<script>
let input1 = document.getElementById("old-password");
let input2 = document.getElementById("new-password");
let input3 = document.getElementById("new-password-rpt");

input1.addEventListener("keypress", function(event) {
  if (event.key === "Enter") {
    document.getElementById("change-password-btn").click();
  }
});
input2.addEventListener("keypress", function(event) {
  if (event.key === "Enter") {
    document.getElementById("change-password-btn").click();
  }
}); 
input3.addEventListener("keypress", function(event) {
  if (event.key === "Enter") {
    document.getElementById("change-password-btn").click();
  }
}); 
</script>

<script>
  function validatePassword() {
    $.ajax({
          type: "POST",
          url: "helper/passwordUpdate.php",
          data: { old: document.getElementById("old-password").value, new: document.getElementById("new-password").value, 
                  rpt: document.getElementById("new-password-rpt").value},
          success: function(data){
            if (data == 0) {
                alert("Wrong password provided!");
            } else if (data == 1) {
                alert("Passwords don't match!");
            } else {
                window.location = "index.php";
            }
          }
        });
  }
</script>
