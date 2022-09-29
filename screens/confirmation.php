<?php require "helper/headers.php";?>

<?php 
$cartServer = "";
$cartClient = "";
$cartScreen = "";
$sum = 0;

$con = connect('db_template');
$query = "SELECT address, postcode, phone FROM users WHERE userId = ?";

$res = $con->prepare($query);
$res->execute(array(safe($_SESSION['id'])));
$arr = $res->fetch();

foreach ($_SESSION['cart'] as $val) {
  $cartServer = $cartServer.nl2br('<li>'.$val->name.' (id:'. $val->id.'), quantity: '.$val->quantity.'</li>');
  $cartClient = $cartClient.nl2br('<li>'.$val->name.' , quantity: '.$val->quantity.'</li>');
  $cartScreen = $cartScreen.
  ('<div class="col-md-6 border">'.$val->name.'</div>
    <div class="col-md-6 border">'.$val->quantity.'</div>');
  $sum += $val->price * $val->quantity;
}
$_SESSION['cart'] = array();

//Visit https://sendgrid.com/ to set-up your Sendgrid account and get instructions.
//Mails will go to the spam folder, unless you authorize the Sendgrid account from your Server Settings
//UNCOMMENT FOR MAIL SERVICE
/*require "../vendor/autoload.php";

$API_KEY = "";

$emailS = new \SendGrid\Mail\Mail();
$emailS->setFrom("", "Template Server");
$emailS->setSubject("Order");

//Order sent to you from your server
$emailS->addTo("", "Yourself");

$emailS->addContent("text/plain", $cartServer);
$emailS->addContent(
    "text/html", "<ul>".$cartServer."</ul>"
);
$sendgridS = new \SendGrid($API_KEY);

$emailC = new \SendGrid\Mail\Mail();
$emailC->setFrom("", "Template Server");
$emailC->setSubject("Order");

//Order sent to your client for confirmation
$emailC->addTo($_SESSION['email']);

$emailC->addContent("text/plain", $cartClient);
$emailC->addContent(
    "text/html", "<ul>".$cartClient."</ul>"
);
$sendgridC = new \SendGrid($API_KEY);

try {
    $responseS = $sendgridS->send($emailS);
    $responseC = $sendgridC->send($emailC);
    //print $response->statusCode() . "\n";
    //print_r($response->headers());
    //print $response->body() . "\n";
} catch (Exception $e) {
    //echo 'Caught exception: '. $e->getMessage() ."\n";
}*/
?>

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

<div id="confirmation-table" class="container-fluid main">
  <h1>Thank you for Purchasing!</h1>
  <p>We've already received your Order! 
  <br> In a few seconds you'll have a copy in your emails as well.</p>
  <p style="text-align: center;">Order will be shipped to <?php echo explode(",", $arr['address'])[0]; ?> in a few days! </p>

  <div id="order-table">
    <h2>Order Information</h2>
    <div>
      <div class="row">
        <div class="col-md-6 border order-title">Item</div>
        <div class="col-md-6 border order-title">Quantity</div>
        <?php echo $cartScreen;?>
      </div>
      <div class="row">
        <div style="font-weight: bold; font-size: 20px; text-align: right;">TOTAL: <?php echo $sum ?>€</div>
      </div>
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
