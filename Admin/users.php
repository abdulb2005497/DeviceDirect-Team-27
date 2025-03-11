<?php
require_once '../config/db.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: ../Login_page/login.php");
    exit();
}

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo "Access denied.";
    exit();
}

$query = "SELECT * FROM users WHERE role != 'admin'";
$stmt = $pdo->prepare($query);
$stmt->execute();
$customers = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $user_id = intval($_POST['user_id']);
    $first_name = trim($_POST['First_name']);
    $last_name = trim($_POST['Last_name']);
    $email = trim($_POST['Email']);
    $password = trim($_POST['password']);
    $role = trim($_POST['role']);

    
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $update_stmt = $pdo->prepare("
        UPDATE users
        SET First_name = ?, Last_name = ?, Email = ?, password = ?, role = ?
        WHERE user_id = ?
    ");

    if ($update_stmt->execute([$first_name, $last_name, $email, $hashed_password, $role, $user_id])) {
        echo "<script>alert('User updated successfully!'); window.location.href='users.php';</script>";
    } else {
        echo "Error updating user.";
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $user_id = intval($_POST['user_id']);

    $delete_stmt = $pdo->prepare("DELETE FROM users WHERE user_id = ?");
    if ($delete_stmt->execute([$user_id])) {
        echo "<script>alert('User deleted successfully!'); window.location.href='users.php';</script>";
    } else {
        echo "Error deleting user.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assests/css/style.css?v=<?php echo time(); ?>">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&display=swap" rel="stylesheet">
</head>
<body>
    <?php include('../navbar.php'); ?>

    <div class="container mt-5">
        <h2>Customer List</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($customers as $customer): ?>
                <tr>
                    <td><?php echo htmlspecialchars($customer['user_id']); ?></td>
                    <td><?php echo htmlspecialchars($customer['First_name']); ?></td>
                    <td><?php echo htmlspecialchars($customer['Last_name']); ?></td>
                    <td><?php echo htmlspecialchars($customer['Email']); ?></td>
                    <td><?php echo htmlspecialchars($customer['password']); ?></td>
                    <td><?php echo htmlspecialchars($customer['role']); ?></td>
                    <td>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editUserModal<?php echo $customer['user_id']; ?>">Edit</button>
                        <form action="" method="post" style="display:inline;">
                            <input type="hidden" name="user_id" value="<?php echo $customer['user_id']; ?>">
                            <button type="submit" name="delete" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?');">Delete</button>
                        </form>
                    </td>
                </tr>

                
                <div class="modal fade" id="editUserModal<?php echo $customer['user_id']; ?>" tabindex="-1" aria-labelledby="editUserModalLabel<?php echo $customer['user_id']; ?>" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editUserModalLabel<?php echo $customer['user_id']; ?>">Edit User</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="post">
                                    <input type="hidden" name="user_id" value="<?php echo $customer['user_id']; ?>">
                                    <div class="mb-3">
                                        <label>First Name</label>
                                        <input type="text" name="First_name" class="form-control" value="<?php echo htmlspecialchars($customer['First_name']); ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Last Name</label>
                                        <input type="text" name="Last_name" class="form-control" value="<?php echo htmlspecialchars($customer['Last_name']); ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Email</label>
                                        <input type="email" name="Email" class="form-control" value="<?php echo htmlspecialchars($customer['Email']); ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Password</label>
                                        <input type="text" name="password" class="form-control" value="<?php echo htmlspecialchars($customer['password']); ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Role</label>
                                        <input type="text" name="role" class="form-control" value="<?php echo htmlspecialchars($customer['role']); ?>" required>
                                    </div>
                                    <button type="submit" name="update" class="btn btn-primary">Update User</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php include('../footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>