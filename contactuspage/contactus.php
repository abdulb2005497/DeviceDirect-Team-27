<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: Login_page/login.php");
    exit();
}

include_once '../config/db.php'; // Include your PDO database connection
include_once '../navbar.php';

$welcome_message = "Welcome, " . htmlspecialchars($_SESSION['first_name']);

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $fullname = $_POST['name'];
    $email = $_POST['email'];
    $query_text = $_POST['message'];

    try {
        // Insert data into the queries table
        $stmt = $pdo->prepare("INSERT INTO queries (user_id, fullname, email, query_text, resolved) VALUES (?, ?, ?, ?, 'No')");
        $stmt->execute([$user_id, $fullname, $email, $query_text]);

        $success_message = "Your message has been successfully sent.";
    } catch (PDOException $e) {
        $error_message = "Error: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DeviceDirect</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
    />
    <!-- bootstrap links -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />


    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Merriweather&display=swap"
      rel="stylesheet"
    />

    <style>

      #modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
      }
      #modalContent {
        background-color: white;
        padding: 20px;
        border-radius: 8px;
        text-align: center;
        width: 300px;
      }
      #modalContent h2 {
        margin: 0;
      }
      #modalContent p {
        margin: 10px 0;
      }
      .btn-close {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 10px;
        border-radius: 5px;
        cursor: pointer;
      }
      .btn-close:hover {
        background-color: #0056b3;
      }
    </style>
  </head>
  <body>

    <main>
      <section class="contact-section">
        <div class="container">
          <h2>Contact Us</h2>
          <p>
            Have questions or need assistance? Reach out to us using the form
            below.
          </p>
          <form id="contactForm" action="#" method="post">
            <div class="form-group">
              <label for="name">Full Name</label>
              <input
                type="text"
                id="name"
                name="name"
                placeholder="Enter your full name"
                required
              />
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input
                type="email"
                id="email"
                name="email"
                placeholder="Enter your email"
                required
              />
            </div>
            <div class="form-group">
              <label for="message">Message</label>
              <textarea
                id="message"
                name="message"
                placeholder="Write your message or enquiry"
                rows="5"
                required
              ></textarea>
            </div>
            <button type="submit" class="btn">Submit</button>
          </form>
        </div>
      </section>
    </main>

   <!-- footer -->
   <?php include '../footer.php'; ?>
   <!-- footer -->

    <!-- Modal for Success Message -->
    <div id="modal">
      <div id="modalContent">
        <h2>Thank You!</h2>
        <p>Your message has been successfully sent.</p>
        <p><strong>We'll get back to you soon.</strong></p>
        <button class="btn-close" id="closeModal">Close</button>
      </div>
    </div>

    <script>
      document
        .getElementById("contactForm")
        .addEventListener("submit", function (e) {

          if (!name || !email || !message) {
            alert("Please fill in all fields.");
            return;
            }

          const name = document.getElementById("name").value;
          const email = document.getElementById("email").value;
          const message = document.getElementById("message").value;

          // Show the modal with the user's data
          document.getElementById("modal").style.display = "flex";
          document.getElementById("modalContent").innerHTML = `
        <h2>Thank You, ${name}!</h2>
        <p>Your message has been received.</p>
        <p><strong>Email:</strong> ${email}</p>
        <p><strong>Message:</strong> ${message}</p>
        <button class="btn-close" id="closeModal">Close</button>
      `;

          // Reset the form
          document.getElementById("contactForm").reset();
        });

      // Close the modal
      document.getElementById("modal").addEventListener("click", function (e) {
        if (
          e.target === document.getElementById("modal") ||
          e.target.id === "closeModal"
        ) {
          document.getElementById("modal").style.display = "none";
        }
      });
    </script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
