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
?>

<!-- This is the working Navbar -->
    <nav class="navbar navbar-expand-lg" id="navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php" id="logo">
            <img src="http://localhost/DEVICEDIRECT-TEAM-27/assests/images/device_direct_logo.png" alt="Device Direct Logo" class="logo-img">
                <span id="span1">D</span>evice <span>Direct</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span><img src="../../assests/images/menu.png" alt="" width="30px"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="../DeviceDirect-Team-27/productspage/index.php">Shop</a></li>
                    <li class="nav-item"><a class="nav-link" href="../DeviceDirect-Team-27/aboutuspage/aboutus.php">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="../DeviceDirect-Team-27/contactuspage/contactus.php">Contact</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Account</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="background-color: rgb(67 0 86);">
                            <li><a class="dropdown-item" href="../DeviceDirect-Team-27/Login_page/login.php">Login</a></li>
                            <li><a class="dropdown-item" href="../DeviceDirect-Team-27/Login_page/signup.php">SignUp</a></li>
                            <li><a class="dropdown-item" href="../DeviceDirect-Team-27/previousorders/previousorders.php">Previous Orders</a></li>
                            <li><a class="dropdown-item" href="../DeviceDirect-Team-27/wishlist/wishlist.php">My Wishlist</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="config/logout.php">Logout</a></li>
                </ul>
                <div class="searchsectionwrappernav">
  <section class="searchsectionnav">
    <form>
      <img src="http://localhost/DEVICEDIRECT-TEAM-27/productspage/categoryimages/search.png" alt="Search Icon" />
      <input type="text" placeholder="Search" id="inputsearchnav" autocomplete="off" />
    </form>
    <div class="optionboxnav"></div>
  </section>
</div>
                <div class="cart-btn"><a href="checkoutpage/cart.php"><i class="fas fa-shopping-bag"></i></a></div>
            </div>
        </div>
        <script src="index.js"></script>
    </nav>
    
<!-- This is the working Navbar -->
