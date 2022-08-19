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
<div id="nav-placeholder"></div>

<?php 
  if ($_SESSION['loggedin']) {
    if (!empty($_SESSION['cart'])) {
      $con = connect('db_template');

      $ids = array_column($_SESSION['cart'],'id');
        
      $help_in = str_repeat('?,', count($ids) - 1) . '?';
      $query = "SELECT productstags.product, products.id, products.price, productsimages.cover FROM productstags
      INNER JOIN products on products.id = productstags.id
      INNER JOIN productsimages on productsimages.id = productstags.id
      WHERE productstags.id IN ($help_in)";
      
      $res = $con->prepare($query);
      $res->execute($ids);
      
      $arr = $res->fetchAll();
    }
  } else {
    $_SESSION['failure'] = 'You must sign in first!';            
    header('Location: signin.php');
    die();
  }
?>

<div id="cart-table" class="container-fluid main"> 
    <?php
      if (!empty($arr)) {
        foreach ($arr as $value) {
          $q = array_column($_SESSION['cart'],'quantity')[array_search(strval($value['id']),array_column($_SESSION['cart'],'id'))];
          $p = array_column($_SESSION['cart'],'price')[array_search(strval($value['id']),array_column($_SESSION['cart'],'id'))];
          echo '<div class="row prod-row">
                  <div class="col-md-2 cart-col">
                    <img title="' . $value['product'] .'" src="' . $value['cover'] . '" alt="Card image">
                  </div>
                  <div class="col-md-7 cart-col">
                    <h4>' . $value['product'] . '</h4>
                    <input type="number" id="quantity-'.$value['id'].'" name="quantity" value="' . $q  . '" min="1">
                  </div>
                  <div class="col-md-2 align-self-center cart-col price">
                    <div id="price-'.$value['id'].'" data-value = "' . $p . '" class="price-box">' . $p * $q . '€</div>
                  </div>
                  <div class="col-md-1 align-self-center cart-col trash">
                    <button onclick="removeItem('.$value['id'].')"><i class="fa fa-trash"></i></button>
                  </div>
                </div>';
        }
      }
    ?>
    <div id="sum-row" class="row">
      <div class="col-md-11">TOTAL:</div>
      <div class="col-md-1"><p id="sum-box"></p></div>
    </div>
    <div id="pay-row" class="row align-items-center">
      <div class="col-md-2">
        <p>Payment Method: </p>
      </div>
      <div class="col-md-8">
        <select id="payment-method">
          <option value="confirmation.php">Cash on Delivery</option>
          <option value="#" disabled>Bank Deposit</option>
        </select>
      </div>
      <div class="col-md-2">
          <button onclick="loadPage()">Continue to Payment</button>
      </div>
    </div>
</div>


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

<script>
summer();
function summer() {
  let sum = 0;
  const col = document.getElementsByClassName("price-box");
  for (let i = 0; i<col.length; i++) {
    sum += parseFloat(col[i].innerHTML.substring(0,col[i].innerHTML.length - 1))
  }
  document.getElementById("sum-box").innerText = sum + "€";

  return sum;
}
</script>

<script>
  function loadPage() {
    if (summer() > 0) {
      let pay = document.getElementById("payment-method").value;
      if (pay != "") {
        window.location.href = pay;
      }
    } else {
      alert('Cart is empty!');
    }
  }
</script>
<script>
  function removeItem(itemId) {
    $.ajax({
          type: "POST",
          url: "helper/cartUpdate.php",
          data: { id:itemId, action:2},
          success: function(data){
            window.location = "cart.php";
          }
        });
  }
</script>

<?php
  if (!empty($arr)) {
    foreach ($arr as $value) {
      echo '<script>document.getElementById("quantity-' . $value['id'] . '").onchange = function changeListener(){
        var q = this.value;
        var p = document.getElementById("price-' . $value['id'] . '").getAttribute("data-value");
        if (q<1) {
          q = 1;
          document.getElementById("quantity-' . $value['id'] . '").value = 1;
        }
        if (q % 1 != 0) {
          q = ~~q;
          document.getElementById("quantity-' . $value['id'] . '").value = ~~q;
        }
        document.getElementById("price-' . $value['id'] . '").innerHTML = p*q + "€";
      
        $.ajax({
          type: "POST",
          url: "helper/cartUpdate.php",
          data: { id:'. $value['id'] . ', quantity:q, action:"1"}
        });

        summer();
      };</script>';
    }
  }
?>
