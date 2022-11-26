<?php
include("Singleton.php");
session_start();
$bookingInfo = $_SESSION['bookingInfo'];

// setup connection to db
$mysqli = require __DIR__ . "/database.php";

// get user information
$sql = "SELECT * FROM user
          WHERE id = {$_SESSION["user_id"]}";
$result = $mysqli->query($sql);
$user = $result->fetch_assoc();
$userID = $user["id"];

// get ticket types
$sql = "SELECT * FROM `ticket_type`;";
    $result = $mysqli->query($sql);
    $ticketTypes = $result->fetch_all(MYSQLI_ASSOC);
    $ticketPrices = array_column($ticketTypes, "price", "type");

// get payment cards
$sql = "SELECT * FROM `payment_card_table` WHERE `userID` = $userID;";
$result = $mysqli->query($sql);
$paymentCards = $result->fetch_all(MYSQLI_ASSOC);

// get total price
$childPrice = $ticketPrices["CHILD"];
$adultPrice = $ticketPrices["ADULT"];
$seniorPrice = $ticketPrices["SENIOR"];
$totalPrice = $childPrice * $bookingInfo->childTickets + $adultPrice * $bookingInfo->adultTickets + $seniorPrice * $bookingInfo->seniorTickets;


$paymentID;
$checkout = false;
$promoID = -1;
// check for POSTS
if(isset($_POST['postID'])) {
  // if the POST is for selecting a promoCode
  if($_POST['postID'] == "submitPromo") {
    $promo = $_POST['promo'];

    // query for promoCodes
    $sql = "SELECT * FROM `promotions_table` WHERE `code` = '$promo';";
    $result = $mysqli->query($sql);
    $promo = $result->fetch_assoc();

    if($promo) {
      $bookingInfo->promoCode = $promo["code"];
      $bookingInfo->promoDiscount = $promo["discount"];
      $promoID = $promo["idPromotions"];
    } else {
      echo '<script>alert("Incorrect promocode.")</script>';
    }
  }

  if($_POST['postID'] == "submitPayment") {
    $paymentID = $_POST['cardID'];
    $checkout = true;
  }

  if($_POST['postID'] == "submitNewPayment") {
    $cardNum = $_POST['cardNumber'];
    $expiration = $_POST['expiration'];

    // create new payment Card, set user ID to -1, meaning 1 time card
    $stmt = $mysqli->stmt_init();
    $sql = "INSERT INTO `payment_card_table` (`idPaymentCard`, `cardNum`, `experationDate`, `userID`) VALUES (NULL, '$cardNum', '$expiration', '-1');";
    $stmt = $mysqli->prepare($sql);
    $stmt->execute();

    // get ID of card
    $sql = "SELECT * FROM `payment_card_table` WHERE `cardNum` = $cardNum;";
    $result = $mysqli->query($sql);
    $card = $result->fetch_assoc();
    $idCard = $card["idPaymentCard"];

    // set paymentID for booking info
    $paymentID = $idCard;
    $checkout = true;
  }
}

if($checkout) {
  // create booking
  $stmt = $mysqli->stmt_init();
  $sql = "INSERT INTO `booking_table` (`idBooking`, `totalPrice`, `showID`, `paymentID`, `promoID`, `customerID`) VALUES (NULL, '$totalPrice', 
            '$bookingInfo->showID', '$paymentID', '$promoID', '$userID');";
  $stmt = $mysqli->prepare($sql);
  $stmt->execute();

  // get bookingID
  $sql = "  SELECT * FROM `booking_table` WHERE `totalPrice` = $totalPrice AND `showID` = $bookingInfo->showID AND `paymentID` = $paymentID AND 
            `customerID` = $userID AND `promoID` = $promoID";
  $result = $mysqli->query($sql);
  $booking = $result->fetch_assoc();
  $bookingID = $booking["idBooking"];

  // create tickets
  foreach($bookingInfo->selectedSeatsArray as $seat) {
    $stmt = $mysqli->stmt_init();
    $sql = "INSERT INTO `tickets_table` (`idTicket`, `bookingID`, `seatNumber`) VALUES (NULL, '$bookingID', '$seat');";
    $stmt = $mysqli->prepare($sql);
    $stmt->execute();
  }

  // update the seats table to reserved for the show
  foreach($bookingInfo->selectedSeatsArray as $seat) {
    $stmt = $mysqli->stmt_init();
    $sql = "UPDATE `seats_table` SET `isReserved` = '1' WHERE `seats_table`.`seatNumber` = $seat AND `seats_table`.`showID` = $bookingInfo->showID;";
    $stmt = $mysqli->prepare($sql);
    $stmt->execute();
  }

  // send email


  // reset the bookingInfo session class
  $bookingInfo->showID = -1;
  unset($bookingInfo->selectedSeatsArray);
  $bookingInfo->selectedSeatsArray = array();
  // set the ticket types
  $bookingInfo->childTickets = 0;
  $bookingInfo->adultTickets = 0;
  $bookingInfo->seniorTickets = 0;
  // reset promo
  $bookingInfo->promoDiscount = 0;
  $bookingInfo->promoCode = "";


  // send to confirmation page
  header("Location: checkoutSuccess.html");

}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="../css/form-validation.css" rel="stylesheet">
	<link href="../css/homepage.css" rel="stylesheet"> <!Only needed for background>
    <meta name="generator" content="Hugo 0.101.0">
    <title>E-Booking Checkout</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/checkout/">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }
    </style>

  </head>
  <body class="bg-light" id="bg">
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="home.php">E-Booking Cinema</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle Navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav me-auto order-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="home.php" aria-current="page">Home</a>
                    </li>
                    <li>
                        <a class="nav-link active" href="checkout.php" aria-current="page">View Cart</a>
                    </li>
                </ul>
                <div class="mx-auto">
                    <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Search Movies"
                            aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
                <div class="d-flex ms-auto order-5">
                    <div class="nav-item dropdown justify-content-end">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Account
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                        <?php
                            if (isset($_SESSION["user_id"])) {
                                echo "<li><a class='dropdown-item' href='editprofile.php'>Edit Profile</a></li>";
                                echo "<li><a class='dropdown-item' href='logout.php'>Logout</a></li>";
                            } else {
                                echo "<li><a class='dropdown-item' href='login.php'>Login</a></li>";
                                echo "<li><a class='dropdown-item' href='signup.html'>Register</a></li>";
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    
<div class="container form-block">
  <main>
    <div class="py-5 text-center">
      <h2>Checkout</h2>
    </div>

    <div class="row g-5">
      <div class="col-md-5 col-lg-4 order-md-last">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-primary">Your cart</span>
          <span class="badge bg-primary rounded-pill"> <?php echo count($bookingInfo->selectedSeatsArray); ?> </span>
        </h4>
		
        <ul class="list-group mb-3">
          <li class="list-group-item d-flex justify-content-between lh-sm">
            <div>
              <h6 class="my-0">Ticket: Senior</h6>
              <small class="text-muted"> <?php echo "x" . $bookingInfo->seniorTickets; ?>  </small>
            </div>
            <span class="text-muted"> <?php echo "$" . $bookingInfo->seniorTickets * $ticketPrices["SENIOR"]; ?> </span>
          </li>
          <li class="list-group-item d-flex justify-content-between lh-sm">
            <div>
              <h6 class="my-0">Ticket: Adult</h6>
              <small class="text-muted"> <?php echo "x" . $bookingInfo->adultTickets; ?> </small>
            </div>
            <span class="text-muted"> <?php echo "$" . $bookingInfo->adultTickets * $ticketPrices["ADULT"]; ?> </span>
          </li>
          <li class="list-group-item d-flex justify-content-between lh-sm">
            <div>
              <h6 class="my-0">Ticket: Child</h6>
              <small class="text-muted"> <?php echo "x" . $bookingInfo->childTickets; ?> </small>
            </div>
            <span class="text-muted"> <?php echo "$" . $bookingInfo->childTickets * $ticketPrices["CHILD"]; ?> </span>
          </li>
          <li class="list-group-item d-flex justify-content-between bg-light">
            <div class="text-success">
              <h6 class="my-0">Promo code</h6>
              <small> <?php echo $bookingInfo->promoCode; ?> </small>
            </div>
            <span class="text-success"> <?php echo "-$" . $bookingInfo->promoDiscount * $totalPrice; ?> </span>
          </li>
          <li class="list-group-item d-flex justify-content-between">
            <span>Total (USD)</span>
            <strong> <?php echo "$" . $totalPrice - ($bookingInfo->promoDiscount * $totalPrice);?> </strong>
          </li>
        </ul>

        <form class="card p-2" method="POST">
          <div class="input-group">
            <input type='hidden' id='postID' name='postID' value='submitPromo'>
            <input type="text" class="form-control" placeholder="Promo code" name="promo" id ="promo" required>
            <button type="submit" class="btn btn-secondary">Redeem</button>
          </div>
        </form>
		
      </div>
	  
	  
	  
	  
	  
      <div class="col-md-7 col-lg-8">
          <hr class="my-4">
          <h4 class="mb-3">Payment</h4>
          <hr class="my-4">

          <?php foreach($paymentCards as $paymentCard) { ?>
            <form method="POST">
              <input type='hidden' id='postID' name='postID' value='submitPayment'>
              <input type='hidden' id='cardID' name='cardID' value='<?php echo $paymentCard["idPaymentCard"];?>'>
              <div class="row gy-3">
                <div class="col-md-6">
                  <label class="form-label">Card Number:</label>
                  <label class="form-label"> <?php echo $paymentCard["cardNum"]; ?> </label>
                </div>

                <div class="col-md-6">
                  <label for="cc-number" class="form-label">Expiration:</label>
                  <label class="form-label"> <?php echo $paymentCard["experationDate"]; ?> </label>
                </div>
              </div>
              <br>
              <button class="w-20 btn btn-primary btn-lg" type="submit">Checkout</button>
            </form>
            <hr class="my-4">
          <?php } ?>

        <h4 class="mb-3">One Time Payment</h4>
        <form method="POST">
          <input type='hidden' id='postID' name='postID' value='submitNewPayment'>
          <div class="row gy-3">
            <div class="col-md-6">
              <label for="cc-name" class="form-label">Card Number</label>
              <input type="text" class="form-control" id="cardNumber" name="cardNumber" placeholder="" required>
            </div>

            <div class="col-md-6">
              <label for="cc-number" class="form-label">Expiration</label>
              <input type="text" class="form-control" id="expiration" name="expiration" placeholder="" required>
            </div>
          </div>
          <br>
          <button class="w-20 btn btn-primary btn-lg" type="submit">Checkout</button>
        </form>
      </div>
    </div>
  </main>

</div>


    <script src="../node_modules/bootstrap/dist/css/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>

      <script src="../scripts/form-validation.js"></script>
  </body>
</html>
