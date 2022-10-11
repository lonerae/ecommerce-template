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

<!--Navigation Bar-->
<?php include "standalone/navbar.php";?>
  
<?php 
  if ($_SESSION['loggedin']) {
    
      $con = connect('db_template');

      $query = "SELECT favourites.product,products.price,productsimages.cover FROM favourites
      INNER JOIN products ON favourites.product=products.product
      INNER JOIN productsimages ON favourites.product = productsimages.product
      WHERE userId = (:userId)";

      $res = $con->prepare($query);
      $res->execute([':userId' => $_SESSION['id']]);

      $arr = $res->fetchAll();      
  } else {
    $_SESSION['failure'] = 'You must sign in first!';            
    header('Location: signin.php');
    die();
  }
?>

<form action="helper/productMed.php" id="product" name="product" method="post"></form>

<div id="fav-table" class="row container-fluid main">
  <div class="row">
    <?php
        if (!empty($arr)) {
          foreach ($arr as $value) {
            echo '<div class="col-md-3">' .
                  '<div id="' . $value['product'] . '"></div>  
                  </div>
                  <script>
                      $(function() {
                        $("[id=\''. $value['product'] .'\']").load("standalone/card2.html", function() {
                          $("[id=\''. $value['product'] .'\']").find("img").attr("title","' . $value['product'] . '");
                          $("[id=\''. $value['product'] .'\']").find("img").attr("src","' . $value['cover'] . '");
                          $("[id=\''. $value['product'] .'\']").find("h4").text("' . $value['product'] . '");
                          $("[id=\''. $value['product'] .'\']").find("p").text("' . $value['price'] . '€");
                          $("[id=\''. $value['product'] .'\']").find("button").val("' . $value['product'] . '");
                        });        
                      });
                    </script>';
          }
        } else {
          echo '<p>No items to show.</p>';
        }
      ?>
  </div>
</div>

<!--Footer-->
<?php include "standalone/footer.html";?>
  
</body>
</html>
