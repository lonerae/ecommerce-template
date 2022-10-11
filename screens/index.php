<?php require "helper/headers.php";

/*Check databases folder to see the default databases.
Make changes according to your needs.*/
$con = connect('db_template');

$query = "SELECT products.product, products.price, productsimages.cover 
    FROM products INNER JOIN productsimages ON products.id = productsimages.id
    ORDER BY products.id DESC LIMIT 4;";
$res = $con->prepare($query);
$res->execute();

$arr = $res->fetchAll();
?>

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

<?php if(!empty($_SESSION['success'])) {
    echo '<span class="server-msg">'. $_SESSION['success'] . '</span>';
    unset($_SESSION['success']);
  }
?>

<!--Navigation Bar-->
<?php include "standalone/navbar.php";?>
    
<!--Main Body-->
<div class="main">
  <!--Main Menu-->
  <div id="menu" class="container-fluid">
    
    <!--
    Default Menu:
    The values of menu buttons correspond to a category
    and of submenu buttons to a subcategory property of items
    in a mysql database.
    -->
    <div id="main-row" class="row">
      <div id="menu-column-container" class="col-md-3"> 
        <div id="menu-column">
          <form id="categories-form" action="categories.php" method="get">
            <div id="menu1" class="row categories">
              <div class="btn-group dropend">
                <button type="submit" name="category" value="Menu1" class="btn btn-secondary menu-btn">
                  Menu-1
                </button>
              </div>
            </div>
            <div id="menu2" class="row categories">
              <div class="btn-group dropend">
                <button type="submit" name="category" value="Menu2" class="btn btn-secondary menu-btn">
                  Menu-2
                </button>
              </div>
            </div>
            <div id="menu3" class="row categories">
              <div class="btn-group dropend">
                <button type="submit" name="category" value="Menu3" class="btn btn-secondary menu-btn">
                  Menu-3
                </button>
                <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split toggle-btn" data-bs-toggle="dropdown" aria-expanded="false">
                  <span class="visually-hidden">Toggle Dropright</span>
                </button>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="subcategories.php?subcategory=Submenu31">Submenu-3.1</a></li>
                  <li><a class="dropdown-item" href="subcategories.php?subcategory=Submenu32">Submenu-3.2</a></li>
                </ul>
              </div>
            </div>
            <div id="menu4" class="row categories">
              <div class="btn-group dropend">
                <button type="submit" name="category" value="Menu4" class="btn btn-secondary menu-btn">
                  Menu-4
                </button>
                <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split toggle-btn" data-bs-toggle="dropdown" aria-expanded="false">
                  <span class="visually-hidden">Toggle Dropright</span>
                </button>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="subcategories.php?subcategory=Submenu41">Submenu-4.1</a></li>
                  <li><a class="dropdown-item" href="subcategories.php?subcategory=Submenu42">Submenu-4.2</a></li>
                </ul>
              </div>
            </div>
            <div id="menu5" class="row categories">
              <div class="btn-group dropend">
                <button type="submit" name="category" value="Menu5" class="btn btn-secondary menu-btn">
                  Menu-5
                </button>
                <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split toggle-btn" data-bs-toggle="dropdown" aria-expanded="false">
                  <span class="visually-hidden">Toggle Dropright</span>
                </button>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="subcategories.php?subcategory=Submenu51">Submenu-5.1</a></li>
                  <li><a class="dropdown-item" href="subcategories.php?subcategory=Submenu52">Submenu-5.2</a></li>
                </ul>
              </div>
            </div>
            <div id="menu6" class="row categories">
              <div class="btn-group dropend">
                <button type="submit" name="category" value="Menu6" class="btn btn-secondary menu-btn">
                  Menu-6
                </button>
                <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split toggle-btn" data-bs-toggle="dropdown" aria-expanded="false">
                  <span class="visually-hidden">Toggle Dropright</span>
                </button>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="subcategories.php?subcategory=Submenu61">Submenu-6.1</a></li>
                  <li><a class="dropdown-item" href="subcategories.php?subcategory=Submenu62">Submenu-6.2</a></li>
                </ul>
              </div>
            </div>
            <div id="menu7" class="row categories">
              <div class="btn-group dropend">
                <button type="submit" name="category" value="Menu7" class="btn btn-secondary menu-btn">
                  Menu-7
                </button>
                <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split toggle-btn" data-bs-toggle="dropdown" aria-expanded="false">
                  <span class="visually-hidden">Toggle Dropright</span>
                </button>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="subcategories.php?subcategory=Submenu71">Submenu-7.1</a></li>
                  <li><a class="dropdown-item" href="subcategories.php?subcategory=Submenu72">Submenu-7.2</a></li>
                </ul>
              </div>
            </div>
            <div id="menu8" class="row categories">
              <div class="btn-group dropend">
                <button type="submit" name="category" value="Menu8" class="btn btn-secondary menu-btn">
                  Menu-8
                </button>
              </div>
            </div>
            <div id="menu9" class="row categories">
              <div class="btn-group dropend">
                <button type="submit" name="category" value="Menu9" class="btn btn-secondary menu-btn">
                  Menu-9
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>  
      
      <script>let helperHeight = document.getElementById('menu-column').offsetHeight;</script>

      <!--Category Photos-->
      <div id="photo-column" class="col-md-9">
        <div id="category-photo" class="carousel slide carousel-fade" data-bs-interval="false">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img id="img1" src="../res/images/placeholder.png" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img id="img2" src="../res/images/placeholder2.png" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img id="img3" src="../res/images/placeholder.png" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img id="img4" src="../res/images/placeholder2.png" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img id="img5" src="../res/images/placeholder.png" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img id="img6" src="../res/images/placeholder2.png" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img id="img7" src="../res/images/placeholder.png" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img id="img8" src="../res/images/placeholder2.png" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img id="img9" src="../res/images/placeholder.png" class="d-block w-100" alt="...">
            </div>       
          </div>
        </div>
        <script>
        document.getElementById('img1').style.height = helperHeight + "px";
        document.getElementById('img2').style.height = helperHeight + "px";
        document.getElementById('img3').style.height = helperHeight + "px";
        document.getElementById('img4').style.height = helperHeight + "px";
        document.getElementById('img5').style.height = helperHeight + "px";
        document.getElementById('img6').style.height = helperHeight + "px";
        document.getElementById('img7').style.height = helperHeight + "px";
        document.getElementById('img8').style.height = helperHeight + "px";
        document.getElementById('img9').style.height = helperHeight + "px";
        </script>
      </div>
    </div>  
  
  </div>

  <!--New-->
  <div id="new" class="container-fluid">
    <p id="new-title">New Items</p>
    <div class="row container-fluid">
    <?php
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
                    $("[id=\''. $value['product'] .'\']").find("a").attr("href", "product.php?name=' . $value['product'] . '");
                  });        
                });
              </script>';
    }
    ?>
    </div>
  </div>

</div>

<!--Footer-->
<?php include "standalone/footer.html";?>

</body>
</html>

<script>
  /*for interactive category photo height*/
  window.onresize = function(){
    helperHeight = document.getElementById('menu-column').offsetHeight;
    document.getElementById('img1').style.height = helperHeight + "px";
    document.getElementById('img2').style.height = helperHeight + "px";
    document.getElementById('img3').style.height = helperHeight + "px";
    document.getElementById('img4').style.height = helperHeight + "px";
    document.getElementById('img5').style.height = helperHeight + "px";
    document.getElementById('img6').style.height = helperHeight + "px";
    document.getElementById('img7').style.height = helperHeight + "px";
    document.getElementById('img8').style.height = helperHeight + "px";
    document.getElementById('img9').style.height = helperHeight + "px";
  };
</script>

<script>
  /*for category photo changing after cursor remains for 400ms on category*/
  $(document).ready(function(){
    let timer;

    $("#category-photo").carousel();  

    $("#menu1").mouseenter(function(){timer = setTimeout(function(){$("#category-photo").carousel(0);}, 400)});
    $("#menu1").mouseleave(function(){clearTimeout(timer)});

    $("#menu2").mouseenter(function(){timer = setTimeout(function(){$("#category-photo").carousel(1);}, 400)});
    $("#menu2").mouseleave(function(){clearTimeout(timer)});

    $("#menu3").mouseenter(function(){timer = setTimeout(function(){$("#category-photo").carousel(2);}, 400)});
    $("#menu3").mouseleave(function(){clearTimeout(timer)});

    $("#menu4").mouseenter(function(){timer = setTimeout(function(){$("#category-photo").carousel(3);}, 400)});
    $("#menu4").mouseleave(function(){clearTimeout(timer)});

    $("#menu5").mouseenter(function(){timer = setTimeout(function(){$("#category-photo").carousel(4);}, 400)});
    $("#menu5").mouseleave(function(){clearTimeout(timer)});
    
    $("#menu6").mouseenter(function(){timer = setTimeout(function(){$("#category-photo").carousel(5);}, 400)});
    $("#menu6").mouseleave(function(){clearTimeout(timer)});

    $("#menu7").mouseenter(function(){timer = setTimeout(function(){$("#category-photo").carousel(6);}, 400)});
    $("#menu7").mouseleave(function(){clearTimeout(timer)});

    $("#menu8").mouseenter(function(){timer = setTimeout(function(){$("#category-photo").carousel(7);}, 400)});
    $("#menu8").mouseleave(function(){clearTimeout(timer)});

    $("#menu9").mouseenter(function(){timer = setTimeout(function(){$("#category-photo").carousel(8);}, 400)});
    $("#menu9").mouseleave(function(){clearTimeout(timer)});
  });
</script>

