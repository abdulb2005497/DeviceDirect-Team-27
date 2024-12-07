<?php
require_once __DIR__ . '/../config/db.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();}
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));}
$email_error = false; 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        $error_message = "Invalid CSRF token.";
    }else{
        $first_name = htmlspecialchars($_POST['first_name']);
        $last_name = htmlspecialchars($_POST['last_name']);
        $email = htmlspecialchars($_POST['email']);
        $phone = htmlspecialchars($_POST['phone']);
        $address = htmlspecialchars($_POST['address']);
        $role = 'user'; 
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        if($password !== $confirm_password) {
            $error_message = "Passwords do not match.";
        }else{
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
          try{$stmt = $pdo->prepare("INSERT INTO users (First_name, Last_name, Email, Phone, Address, password, role) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute([$first_name, $last_name, $email, $phone, $address, $hashed_password, $role]);
                header("Location: login.php");
                exit();
            }catch (PDOException $e) {
                if ($e->getCode() == 23000) {
                    $email_error = true; 
                } else {
                    $error_message = "An error occurred. Please try again.";
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | DeviceDirect</title>
    <link href="styles.css" rel="stylesheet">
</head>
<body>
    <div class="form-container">
        <div class="form-box">
            <h1>Sign Up</h1>
            <h4>It's free</h4>
            <form method="POST" action="">
             
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">

                
                <label for="first-name">First Name</label>
                <input id="first-name" name="first_name" type="text" placeholder="Enter your first name" required>

                
                <label for="last-name">Last Name</label>
                <input id="last-name" name="last_name" type="text" placeholder="Enter your last name" required>

               
                <label for="email">Email</label>
                <input id="email" name="email" type="email" placeholder="Enter your email" 
                       class="<?php echo $email_error ? 'is-invalid' : ''; ?>" 
                       required>

                
                <label for="phone">Phone</label>
                <input id="phone" name="phone" type="text" placeholder="Enter your phone number" required>

                
                <label for="address">Address</label>
                <input id="address" name="address" type="text" placeholder="Enter your address" required>

                
                <label for="password">Password</label>
                <input id="password" name="password" type="password" placeholder="Enter your password" required>

                
                <label for="confirm-password">Confirm Password</label>
                <input id="confirm-password" name="confirm_password" type="password" placeholder="Confirm your password" required>

                
                <input type="submit" value="Sign Up">
            </form>
            <p>
                By clicking the Sign Up button, you agree to our
                <br>
                <a href="#">Terms and Conditions</a> and <a href="#">Privacy Policy</a>.
            </p>
            <p>Already have an account? <a href="login.php">Login Here</a></p>
        </div>
    </div>
    <script>
        
        document.addEventListener("DOMContentLoaded", function () {
            const emailInput = document.getElementById("email");

            <?php if ($email_error): ?>
            emailInput.setCustomValidity("Email already in use.");
            emailInput.reportValidity(); 
            <?php endif; ?>

            emailInput.addEventListener("input", () => {
                emailInput.setCustomValidity(""); 
            });
        });
    </script>
</body>
</html>