<?php
session_start();

if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "devicedirect");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    
    $user_id = $_SESSION['user_id'];
    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);
    $city = trim($_POST['city']);
    $post_code = trim($_POST['post_code']);
    
    // Validate email 
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['message'] = "Invalid email format";
        $_SESSION['message_type'] = "error";
        header("Location: update_profile.php");
        exit;
    }
    
    
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ? AND id != ?");
    $stmt->bind_param("si", $email, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $_SESSION['message'] = "Email already in use by another account";
        $_SESSION['message_type'] = "error";
        header("Location: update_profile.php");
        exit;
    }
    
    // Update user data
    $sql = "UPDATE users SET full_name = ?, email = ?, phone = ?, address = ?, city = ?, post_code = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $full_name, $email, $phone, $address, $city, $post_code, $user_id);
    
    if ($stmt->execute()) {
        $_SESSION['message'] = "Profile updated successfully";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "Error updating profile: " . $conn->error;
        $_SESSION['message_type'] = "error";
    }
    
    $stmt->close();
    
    // Redirect to avoid form resubmission
    header("Location: update_profile.php");
    exit;
}



//current user data
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();
$conn->close();
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <?php include '../navbar.php'; ?>
    <!-- Navbar -->
    <div class="container">
        <h1>Update Your Profile</h1>

        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert <?php echo $_SESSION['message_type']; ?>">
                <?php 
                    echo $_SESSION['message']; 
                    unset($_SESSION['message']);
                    unset($_SESSION['message_type']);
                ?>
            </div>
        <?php endif; ?>
        
        <form action="update_profile.php" method="post">
            <div class="form-group">
                <label for="full_name">Full Name</label>
                <input type="text" id="full_name" name="full_name" value="<?php echo htmlspecialchars($user['full_name']); ?>">
            </div>
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>">
            </div>
            
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>">
            </div>
            
            <div class="form-group">
                <label for="address">Address</label>
                <textarea id="address" name="address"><?php echo htmlspecialchars($user['address']); ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="city">City</label>
                <input type="text" id="city" name="city" value="<?php echo htmlspecialchars($user['city']); ?>">
            </div>
            
            <div class="form-group">
                <label for="postal_code">Post Code</label>
                <input type="text" id="post_code" name="post_code" value="<?php echo htmlspecialchars($user['post_code']); ?>">
            </div>
            
            <div class="form-group">
                <button type="submit" name="update">Update Profile</button>
            </div>
        </form>
        
        <div class="links">
            <a href="change_password.php">Change Password</a>
            <a href="index.php">Back to Homepage</a>
        </div>
    </div>
</body>

</html>
