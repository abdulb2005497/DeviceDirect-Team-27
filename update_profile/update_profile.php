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
    $First_name = trim($_POST['First_name']);
    $Last_name = trim($_POST['Last_name']);
    $Email = trim($_POST['Email']);
    $Phone = trim($_POST['Phone']);
    $Address = trim($_POST['Address']);
    $password = trim($_POST['password']);
    
    
    // Validate email 
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['message'] = "Invalid email format";
        $_SESSION['message_type'] = "error";
        header("Location: update_profile.php");
        exit;
    }
    
    
    $stmt = $conn->prepare("SELECT id FROM users WHERE Email = ? AND id != ?");
    $stmt->bind_param("si", $Email, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $_SESSION['message'] = "Email already in use by another account";
        $_SESSION['message_type'] = "error";
        header("Location: update_profile.php");
        exit;
    }
    
    // Update user data
    $sql = "UPDATE users SET First_name = ?, Last_name = ?, Email = ?, Phone = ?, Address = ?, password = ? WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $First_name, $Last_name, $Email, $Phone, $Address, $password, $user_id);
    
    if ($stmt->execute()) {
        $_SESSION['message'] = "Profile updated successfully";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "Error updating profile: " . $conn->error;
        $_SESSION['message_type'] = "error";
    }
    
    $stmt->close();
    
    
    header("Location: update_profile.php");
    exit;
}



//current user data
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE user_id = ?";
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

    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&display=swap" rel="stylesheet">

    
</head>
<body>
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
                <label for="First_name">First_name</label>
                <input type="text" id="First_name" name="First_name" value="<?php echo htmlspecialchars($user['First_name']); ?>">
            </div>

            <div class="form-group">
                <label for="Last_name">Last_name</label>
                <input type="text" id="Last_name" name="Last_name" value="<?php echo htmlspecialchars($user['Last_name']); ?>">
            </div>
            
            <div class="form-group">
                <label for="Email">Email</label>
                <input type="Email" id="Email" name="Email" value="<?php echo htmlspecialchars($user['Email']); ?>">
            </div>
            
            <div class="form-group">
                <label for="Phone">Phone</label>
                <input type="text" id="Phone" name="Phone" value="<?php echo htmlspecialchars($user['Phone']); ?>">
            </div>
            
            <div class="form-group">
                <label for="Address">Address</label>
                <textarea id="Address" name="Address"><?php echo htmlspecialchars($user['Address']); ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="password">password</label>
                <input type="text" id="password" name="password" value="<?php echo htmlspecialchars($user['password']); ?>">
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