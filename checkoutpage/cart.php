
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style_cart.css">
    <title>Checkout</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
     <!-- bootstrap links -->
     <link
     href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
     rel="stylesheet"
     integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
     crossorigin="anonymous"
   />
   <!-- bootstrap links -->
   <!-- fonts links -->
   <link rel="preconnect" href="https://fonts.googleapis.com" />
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
   <link
     href="https://fonts.googleapis.com/css2?family=Merriweather&display=swap"
     rel="stylesheet"
   />
 </head>
 <body>
   <nav class="navbar navbar-expand-lg" id="navbar">
     <div class="container-fluid">
       <a class="navbar-brand" href="index.html" id="logo">
         <img
           src="/Landing-Page/assests/images/device_direct_logo.png"
           alt="Device Direct Logo"
           class="logo-img"
         />
         <span id="span1">D</span>evice <span>Direct</span></a
       >
       <button
         class="navbar-toggler"
         type="button"
         data-bs-toggle="collapse"
         data-bs-target="#navbarSupportedContent"
         aria-controls="navbarSupportedContent"
         aria-expanded="false"
         aria-label="Toggle navigation"
       >
         <span
           ><img src="./assests/images/menu.png" alt="" width="30px"
         /></span>
       </button>
       <div class="collapse navbar-collapse" id="navbarSupportedContent">
         <ul class="navbar-nav me-auto mb-2 mb-lg-0">
           <li class="nav-item">
             <a
               class="nav-link active"
               aria-current="page"
               href="/Landing-Page/index.html"
               >Home</a
             >
           </li>
           <li class="nav-item">
             <a class="nav-link" href="/productspage/index.html">Shop</a>
           </li>
           <li class="nav-item">
             <a class="nav-link" href="/aboutuspage/aboutus.html">About</a>
           </li>
           <li class="nav-item">
             <a class="nav-link" href="/contactuspage/contactus.html"
               >Contact</a
             >
           </li>
           <li class="nav-item dropdown">
             <a
               class="nav-link dropdown-toggle"
               href="#"
               id="navbarDropdown"
               role="button"
               data-bs-toggle="dropdown"
               aria-expanded="false"
             >
               Account
             </a>
             <ul
               class="dropdown-menu"
               aria-labelledby="navbarDropdown"
               style="background-color: rgb(67 0 86)"
             >
               <li>
                 <a class="dropdown-item" href="/loginpage/login.html"
                   >Login</a
                 >
               </li>
               <li><a class="dropdown-item" href="#">SignUp</a></li>
               <li>
                 <a
                   class="dropdown-item"
                   href="/previousorders/previousorders.html"
                   >Previous Orders</a
                 >
               </li>
             </ul>
           </li>
         </ul>
         <form class="d-flex" id="search">
           <input
             class="form-control me-2"
             type="search"
             placeholder="Search"
             aria-label="Search"
           />
           <button class="btn btn-outline-success" type="submit">
             Search
           </button>
         </form>
         <div class="cart-btn">
           <a href="/checkoutpage/cart.html"
             ><i class="fas fa-shopping-bag"></i
           ></a>
         </div>
       </div>
     </div>
   </nav>

    <div class="cart-container">
        <h1>CART PAGE</h1>

        <div class="cart-layout">
          <!-- These are placeholders will later be replaced with php code pulling the data from the database-->
            <div class="cart-items">
                <div class="cart-item">
                    <img src="../productspage/pagescode/tvcode/TVs/40inch/4K-40-Black.webp" alt="">
                    <div class="cart-details">
                        <p>4k 40 Inch TV</p>
                        <p>Black </p>
                        <p>£99.99</p>
                        <input type="number" name="quantity" value="1" min="1" style="width: 50px;">
                        <button type="button" name="button">x</button>
                    </div>
                </div>
                <div class="cart-item">
                    <img src="../productspage/pagescode/consolescode/Consoles/switch/switch red.webp" alt="">
                    <div class="cart-details">
                        <p>Nintendo Switch</p>
                        <p>Red</p>
                        <p>£149.99</p>
                        <input type="number" name="quantity" value="1" min="1" style="width: 50px;">
                        <button type="button" name="button">x</button>
                    </div>
                </div>
            </div>

            <!-- Placeholder until php is complete -->
            <div class="checkout-summary">
                <h2>Checkout Summary</h2>
                <p>Total: £250.98</p>
                <p>Shipping: Free</p>
                <p>Total: £250.98</p>
                <a href="checkout.html"><button class="checkout-btn">Checkout </button></a>
                <button class="paypal-btn">Pay with PayPal</button>
                <h3>Discount code:</h3>
                <form class="discount-code" action="index.html" method="post">
                  <input type="text" name="" placeholder="Enter code here">
                </form>
            </div>
        </div>
        <a href="wishlist.html">Enter wishlist</a>
    </div>
    </form>

        <footer id="footer">
        <div class="footer-top">
          <div class="container">
            <div class="row">
              <div class="col-lg-3 col-md-6 footer-contact">
                <h3>Device Direct</h3>
                <p>
                  236 Coventry Road <br />
                  TW4 5PF, Birmingham <br />
                  United Kingdom <br />
                </p>
                <strong>Phone:</strong> +44 7748374824 <br />
                <strong>Email:</strong>support@devicedirect.co.uk<br />
              </div>
  
              <div class="col-lg-3 col-md-6 footer-links">
                <h4>Usefull Links</h4>
                <ul>
                  <li><a href="/Landing-Page/index.html">Home</a></li>
                  <li><a href="/aboutuspage/aboutus.html">About Us</a></li>
                  <li><a href="/loginpage/login.html">Account</a></li>
                  <li>
                    <a href="/productspage/index.html">Shop Now</a>
                  </li>
                  <li><a href="/contactuspage/contactus.html">Contact Us</a></li>
                </ul>
              </div>
  
              <div class="col-lg-3 col-md-6 footer-links">
                <h4>Our Services</h4>
  
                <ul>
                  <li>
                    <a href="/productspage/pagescode/consolescode/consoles.html"
                      >Gaming Consoles</a
                    >
                  </li>
                  <li>
                    <a href="/productspage/pagescode/tvcode/tvs.html">TVs</a>
                  </li>
                  <li>
                    <a href="/productspage/pagescode/laptopscode/laptops.html"
                      >Laptops</a
                    >
                  </li>
                  <li>
                    <a href="/productspage/pagescode/monitorscode/monitors.html"
                      >Monitors</a
                    >
                  </li>
                  <li>
                    <a
                      href="/productspage/pagescode/headphonescode/headphones.html"
                      >Headphones</a
                    >
                  </li>
                </ul>
              </div>
  
              <div class="col-lg-3 col-md-6 footer-links">
                <h4>Our Social</h4>
                <div class="socail-links mt-3">
                  <a href="https://x.com/" target="_blank"><i class="fa-brands fa-twitter"></i></a>
                  <a href="https://facebook.com/" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
                  <a href="https://instagram.com/" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <hr/>
        <div class="container py-4">
          <div class="copyright">
            &copy; Copyright <strong><span>Device Direct Shop</span></strong
            >. All Rights Reserved
          </div>
        </div>
      </footer>

      <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
    ></script>
    </body>
</html>