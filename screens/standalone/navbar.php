<nav id="navbar-custom" class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
    <div class="container-fluid">
      
      <div class="logo-container">
        <a class="navbar-brand" href="index.php">
          <img src="../res/images/logo.png" alt="" width="150" height="40">
        </a>
      </div>
      <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      
      <form action="search.php" method="get" class="d-flex collapse navbar-collapse">
        <div class="input-group">
          <button class="btn" type="submit"><i class="fa fa-search"></i></button>
          <input type="text" name="search" class="form-control" placeholder="Search for an item..." aria-describedby="basic-addon1">
          <div class="btn-group">
            <button type="button" class="btn dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
              <span class="visually-hidden">Toggle Dropdown</span>
            </button>
            <ul id="dropdown-menu" class="dropdown-menu dropdown-menu-end">
            </ul>
          </div>
        </div>
      </form>
      <form id="categories-form" action="categories.php" method="get"></form>
  
      <div id="navbarSupportedContent" class="collapse navbar-collapse">
        <div class="navbar-nav ms-auto">
          <?php if (!($_SESSION['loggedin'])) {
              echo '<a class="nav-link" aria-current="page" href="signin.php"><i class="fa fa-sign-in"></i> Sign-in / Log-in </a>';
            } else {
              echo '<a class="nav-link" aria-current="page" href="helper/logout.php"><i class="fa fa-sign-out"></i> Log-out </a>
                    <a class="nav-link" aria-current="page" href="account.php"><i class="fa fa-user"></i> My Account</a>';
            }
          ?>
          <a class="nav-link" href="cart.php"><i class="fa fa-shopping-cart"></i> Cart</a>
          <a class="nav-link" href="favourites.php"><i class="fa fa-heart"></i> Favourites</a>
        </div>
      </div>
      
    </div>
</nav>

<script>
  var options = [{"title": "Menu1"},{"title": "Menu2"},{"title": "Menu3"},{"title": "Menu4"},{"title": "Menu5"},{"title": "Menu6"},
  {"title": "Menu7"},{"title": "Menu8"},{"title": "Menu9"}];  

  $.each( options, function( key, val ) {
  var $li = $("<button type='submit' name='category' value='" + val.title + "' form='categories-form'><li>"
   + val.title + "</li></button>");      
  $("#dropdown-menu").append($li);       
  });
</script>
