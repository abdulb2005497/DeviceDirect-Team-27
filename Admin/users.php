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
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $role = trim($_POST['role']);
    $city = trim($_POST['city']);
    $postcode = trim($_POST['post_code']);

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $update_stmt = $pdo->prepare("
        UPDATE users
        SET first_name = ?, last_name = ?, email = ?, password = ?, role = ?, city = ?, post_code = ?
        WHERE user_id = ?
    ");

    if ($update_stmt->execute([$first_name, $last_name, $email, $hashed_password, $role, $city, $postcode, $user_id])) {
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
                    <th>Address</th>
                    <th>City</th>
                    <th>Postcode</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($customers as $customer): ?>
                <tr>
                    <td><?php echo htmlspecialchars($customer['user_id']); ?></td>
                    <td><?php echo htmlspecialchars($customer['first_name']); ?></td>
                    <td><?php echo htmlspecialchars($customer['last_name']); ?></td>
                    <td><?php echo htmlspecialchars($customer['email']); ?></td>
                    <td><?php echo htmlspecialchars($customer['password']); ?></td>
                    <td><?php echo htmlspecialchars($customer['address']); ?></td>
                    <td><?php echo htmlspecialchars($customer['city']); ?></td>
                    <td><?php echo htmlspecialchars($customer['post_code']); ?></td>
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
                                        <input type="text" name="first_name" class="form-control" value="<?php echo htmlspecialchars($customer['first_name']); ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Last Name</label>
                                        <input type="text" name="last_name" class="form-control" value="<?php echo htmlspecialchars($customer['last_name']); ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Email</label>
                                        <input type="email" name="Email" class="form-control" value="<?php echo htmlspecialchars($customer['email']); ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Password</label>
                                        <input type="text" name="password" class="form-control" value="<?php echo htmlspecialchars($customer['password']); ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Role</label>
                                        <input type="text" name="role" class="form-control" value="<?php echo htmlspecialchars($customer['role']); ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Address</label>
                                        <input type="text" name="address" class="form-control" value="<?php echo htmlspecialchars($customer['address']); ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>City</label>
                                        <input type="text" name="city" class="form-control" value="<?php echo htmlspecialchars($customer['city']); ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Post Code</label>
                                        <input type="text" name="post_code" class="form-control" value="<?php echo htmlspecialchars($customer['post_code']); ?>" required>
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