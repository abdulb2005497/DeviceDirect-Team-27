<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: Login_page/login.php");
    exit();
}

include_once '../navbar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DeviceDirect</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&display=swap" rel="stylesheet">

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
        .btn-close {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-close:hover { background-color: #0056b3; }
    </style>
</head>
<body>

<main>
    <section class="contact-section">
        <div class="container">
            <h2>Contact Us</h2>
            <p>Have questions or need assistance? Reach out to us using the form below.</p>

            <form id="contactForm">
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter your full name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" placeholder="Write your message or enquiry" rows="5" required></textarea>
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
        <button class="btn-close" id="closeModal">Close</button>
    </div>
</div>

<script>
document.getElementById("contactForm").addEventListener("submit", function (e) {
    e.preventDefault(); // Prevent normal form submission

    const formData = new FormData(this);

    fetch("submit_contact.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById("modal").style.display = "flex";
            document.getElementById("modalContent").innerHTML = `
                <h2>Thank You, ${data.name}!</h2>
                <p>Your message has been received.</p>
                <p><strong>Email:</strong> ${data.email}</p>
                <p><strong>Message:</strong> ${data.message}</p>
                <button class="btn-close" id="closeModal">Close</button>
            `;
            document.getElementById("contactForm").reset();

            document.getElementById("closeModal").addEventListener("click", function () {
                document.getElementById("modal").style.display = "none";
            });
        } else {
            alert("Error: " + data.error);
        }
    })
    .catch(error => console.error("Error:", error));
});

// Close modal when clicking outside of it
document.getElementById("modal").addEventListener("click", function (e) {
    if (e.target === document.getElementById("modal")) {
        document.getElementById("modal").style.display = "none";
    }
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
