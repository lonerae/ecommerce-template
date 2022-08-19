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
    $con = connect('db_template');
    
    $subcat = safe($_GET['subcategory']);
    $query = "SELECT productstags.product, products.price, productsimages.cover FROM productstags 
    INNER JOIN products ON productstags.id = products.id
    INNER JOIN productsimages ON productstags.id = productsimages.id
    WHERE subcategory = ?";
    
    $res = $con->prepare($query);
    $res->execute(array($subcat));
    $arr = $res->fetchAll();
?>

<!--Results-->
<form action="helper/productMed.php" id="product" name="product" method="post"></form>

<div id="results-table" class="container-fluid main">
  <div class="row">
    <?php
      if (!empty($arr)) {
        foreach ($arr as $value) {
          echo '<div class="col-md-3">' .
             '<div id="' . $value['product'] . '"></div>  
             </div>
             <script>
                $(function() {
                  $("[id=\''. $value['product'] .'\']").load("standalone/card.html", function() {
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
        echo '<p>No items found.</p>';
      }
    ?>
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