<?php require "helper/headers.php";?>

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

    $prod = safe($_GET["name"]);
    $query = "SELECT products.*, productstags.producer, productsimages.cover, productsimages.backcover, productsdescriptions.description
    FROM products INNER JOIN productstags on productstags.id=products.id
    INNER JOIN productsimages on productsimages.id = products.id
    INNER JOIN productsdescriptions on productsdescriptions.id = products.id
    WHERE products.product = ?";
    
    $res = $con->prepare($query);
    $res->execute(array($prod));
    $arr = $res->fetch();   
    
    if (!empty($arr)) {
      $res2 = $con->query("SELECT products.product, products.price, productsimages.cover FROM products
      INNER JOIN productsimages ON products.id = productsimages.id
      ORDER BY rand() LIMIT 4;");

      $rec = $res2->fetchAll();  
    }
?>

<?php if (!empty($arr)) { ?>
  <div class="main">
    <!--Product Info-->
    <div id="product-container" class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div id="product-background" style="background-image: url('<?php echo $arr['backcover'];?>');">
                    <?php 
                    echo '<img id="product-img" src="' . $arr['cover'] . '" class="d-block w-100" alt="...">';
                    ?>
                    </div>
                </div>
                <?php if ($arr['backcover'] != NULL) {?>
                  <div class="row">
                    <div class="col-md-6">
                        <?php
                          echo '<img id="preview1" src="' . $arr['cover'] . '" onclick="show(true)" class="d-block w-100" alt="...">'
                          ?>
                    </div>
                    <div class="col-md-6">
                        <?php
                        echo '<img id="preview2" src="' . $arr['backcover'] . '" onclick="show(false)" class="d-block w-100" alt="...">'
                        ?>
                    </div>    
                  </div>
                <?php }?>
                <script>
                  function show(bool) {
                    if (bool) {
                      $("#product-img").animate({opacity:1});
                    } else {
                      $("#product-img").animate({opacity:0});
                    }
                  }
                </script>
            </div>
            <div class="col-md-6">
              <div id="product">
                <h1 id="product-name"><?php echo $arr['product']?></h1>
                <h2 id="product-price"><?php echo $arr['price'] . '€'?></h2>
                <div><h3>Παραγωγός: </h3><p><?php echo $arr['producer']?></p></div>
                <div><h3>Βάρος: </h3><p>
                  <?php
                  echo '<select id="selector"><option value="' . $arr['price'] . '">' . $arr['weight'] . '</option>';
                  if ($arr['weight_alt'] != null) {
                    echo '<option value="' . $arr['price_alt'] . '">' . $arr['weight_alt'] . '</option>';
                    if ($arr['weight_alt2'] != null) {
                      echo '<option value="' . $arr['price_alt2'] . '">' . $arr['weight_alt2'] . '</option>';
                    }
                  }
                  echo '</select>' . ' ' . $arr['unit'];
                  ?>
                </p></div>
                <div><h3>Ποσότητα: </h3><p><input type="number" id="quantity" name="quantity" value="1" min="1"></p></div>
                <button id="cart-btn" name="cart-btn" value="<?php echo $arr['id']?>" onclick="addToCart()" class="btn btn-success">
                <i class="fa fa-shopping-cart"></i> Add to Cart</button>
                <button id="fav-btn" name="fav-btn" onclick="addToFav('<?php echo $arr['product']?>')" class="btn btn-success">
                <i class="fa fa-heart"></i> Add to Favourites</button>
              </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <h3>Description</h3>
                <p><?php echo $arr['description']?></p>
            </div>
        </div>
    </div>

    <!--Recommendations-->
    <form action="" name="fav" id="fav" method="post"></form>

    <div id="recommendation-container" class="container-fluid">
      <h2>Check out these too:</h2>
      <div class="row container-fluid">
      <?php
      foreach ($rec as $value) {
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
                    $("[id=\''. $value['product'] .'\']").find("a").attr("href", "product.php?name=' . $value['product'] . '");
                    });        
                  });
                </script>';
      }
      ?>
      </div>
    </div>
  </div>
<?php } else {
  echo '<div id="results-table" class="container-fluid main">
          <div class="row">
            <p>No items found.</p>
          </div>
        </div>';
} ?>

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
      document.getElementById("selector").onchange = changeListener;
      
      function changeListener(){
        var value = this.value;
        document.getElementById("product-price").innerHTML = value + '€';
      }
</script>

<script>
  function addToCart() {
      let num = document.getElementById("cart-btn").value;
      let name = document.getElementById("product-name").innerHTML;
      let q = document.getElementById("quantity").value;
      let p = document.getElementById("selector").value;
      
      $.ajax({
          type: "POST",
          url: "helper/cartMed.php",
          data: { item: JSON.stringify({"id":num , "name":name, "price":p, "quantity":q})},
          success: function(data){
            if (!data) {
              window.location = "signin.php";
            } else {
              alert('Item added to Cart!');
            };
          }
        });
  }
</script>

<script>
  function addToFav(name) {
    $.ajax({
          type: "POST",
          url: "helper/favUpdate.php",
          data: {product:name},
          success: function(data){
            if (!data) {
              window.location = "signin.php";
            } else {
              alert('Item added to Favourites!');
            };
          }
        });
  }
</script>
