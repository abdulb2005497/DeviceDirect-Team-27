
<?php
// Start the session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Redirect to the login page if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: Login_page/login.php");
    exit();
}

include_once '../navbar.php';

// Display a welcome message for the logged-in user
$welcome_message = "Welcome, " . htmlspecialchars($_SESSION['first_name']);

$total_price = isset($_SESSION['total_price']) ? $_SESSION['total_price'] : 0;

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style_cart.css">
    <title></title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
    <!-- bootstrap links -->
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
       <!-- fonts links -->
       <link rel="preconnect" href="https://fonts.googleapis.com" />
       <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
       <link href="https://fonts.googleapis.com/css2?family=Merriweather&display=swap" rel="stylesheet" />
 </head>
 <body>



     <!-- Checkout Form -->
     <div class="container my-5">
      <h1 class="text-center mb-4">Checkout</h1>
      <form action="process_checkout.php" method="POST">
        <!-- Billing Information -->
        <div class="mb-4">
          <h3>Billing Information</h3>
          <div class="row g-3">
            <div class="col-md-6">
              <label for="billingFirstName" class="form-label">First Name</label>
              <input type="text" class="form-control" name="billingFirstName" placeholder="First name" required>
            </div>
            <div class="col-md-6">
              <label for="billingLastName" class="form-label">Last Name</label>
              <input type="text" class="form-control" name="billingLastName" placeholder="Surname" required>
            </div>
            <div class="col-12">
              <label for="billingAddress" class="form-label">Address</label>
              <input type="text" class="form-control" name="billingAddress" placeholder="Enter address" required>
            </div>
            <div class="col-md-6">
              <label for="billingCity" class="form-label">City</label>
              <input type="text" class="form-control" name="billingCity" placeholder="City" required>
            </div>
            <div class="col-md-6">
              <label for="billingPostalCode" class="form-label">Postal Code</label>
              <input type="text" class="form-control" name="billingPostalCode" placeholder="XX00 0XX" required>
            </div>
          </div>
        </div>

        <div class="mb-4">
          <h3>Payment Details</h3>
          <div class="row g-3">
            <div class="col-md-6">
              <label for="cardName" class="form-label">Name on Card</label>
              <input type="text" class="form-control" name="cardName" placeholder="Full name" required>
            </div>
            <div class="col-md-6">
              <label for="cardNumber" class="form-label">Card Number</label>
              <input type="text" class="form-control" name="cardNumber" placeholder="16 digit code" required>
            </div>
            <div class="col-md-4">
              <label for="expiryDate" class="form-label">Expiry Date</label>
              <input type="text" class="form-control" name="expiryDate" placeholder="MM/YY" required>
            </div>
            <div class="col-md-4">
              <label for="cvc" class="form-label">CVC</label>
              <input type="text" class="form-control" name="cvc" placeholder="3 digit code" required>
            </div>
          </div>
        </div>

        <button type="submit" class="btn btn-primary w-100">Place Order</button>
      </form>
    </div>

   <!-- footer -->
   <?php include '../footer.php'; ?>
   <!-- footer -->
    
    </body>
</html>
