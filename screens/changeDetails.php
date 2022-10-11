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
            $query = 'SELECT address, postcode, phone FROM users WHERE userId = ?';

            $res = $con->prepare($query);
            $res->execute(array(safe($_SESSION['id'])));
            $arr = $res->fetch();
        }
    ?>

    <div id="change-details" class="container-fluid main">
        <div id="change-details-table">
            <div class="row">
                <label for="street" class="form-label">Street:</label>
                <input class="form-control" name="street" id="street" value="<?php echo explode(" " , explode("," , $arr['address'])[0])[0]; ?>">
                <label for="number" class="form-label">Number:</label>
                <input class="form-control" name="number" id="number" value="<?php echo explode(" " , explode("," , $arr['address'])[0])[1]; ?>">
            </div>
            <div class="row">
                <label for="area" class="form-label">City:</label>
                <input class="form-control" name="area" id="area" value="<?php echo explode("," , $arr['address'])[1]; ?>">
            </div>
            <div class="row">
                <label for="postcode" class="form-label">Postal code:</label>
                <input class="form-control" name="postcode" id="postcode" value="<?php echo $arr['postcode']; ?>">
            </div>
            <div class="row">
                <label for="phone-sign-up" class="form-label">Phone number:</label>
                <input class="form-control" name="phone" id="phone" value="<?php echo $arr['phone']; ?>">
            </div>
            <div class="row">
                <button id="change-details-btn" onclick="changeDetails()">Submit</button>
            </div>
        </div>
    </div>

    <!--Footer-->
    <?php include "standalone/footer.html";?>

</body>
</html>

<script>
  function changeDetails() {
    $.ajax({
          type: "POST",
          url: "helper/addressChange.php",
          data: { street: document.getElementById("street").value, number: document.getElementById("number").value, 
                  area: document.getElementById("area").value, postcode: document.getElementById("postcode").value,
                  phone: document.getElementById("phone").value},
          success: function(data) {
            if (data == 0) {
                alert("Error! Details remain unchanged.");
            } else {
                window.location = "account.php";
            }
          }
        });
    }
</script>
