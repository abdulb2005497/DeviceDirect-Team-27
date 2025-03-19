<?php
require_once '../config/db.php';
include 'admin_action.php';

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

    $original_stmt = $pdo->prepare("SELECT * FROM users WHERE user_id = ?");
    $original_stmt->execute([$user_id]);
    $original = $original_stmt->fetch(PDO::FETCH_ASSOC);

    if ($original) {
        $changes = [];
        if ($first_name !== $original['first_name']) {
            $changes[] = "First Name changed from '{$original['first_name']}' to '{$first_name}'";
        }
        if ($last_name !== $original['last_name']) {
            $changes[] = "Last Name changed from '{$original['last_name']}' to '{$last_name}'";
        }
        if ($email !== $original['email']) {
            $changes[] = "Email changed from '{$original['email']}' to '{$email}'";
        }
        if ($role !== $original['role']) {
            $changes[] = "Role changed from '{$original['role']}' to '{$role}'";
        }
        if ($city !== $original['city']) {
            $changes[] = "City changed from '{$original['city']}' to '{$city}'";
        }
        if ($postcode !== $original['post_code']) {
            $changes[] = "Postcode changed from '{$original['post_code']}' to '{$postcode}'";
        }

        if (!empty($changes)) {
            $update_stmt = $pdo->prepare("
                UPDATE users
                SET first_name = ?, last_name = ?, email = ?, password = ?, role = ?, city = ?, post_code = ?
                WHERE user_id = ?
            ");

            if ($update_stmt->execute([$first_name, $last_name, $email, $hashed_password, $role, $city, $postcode, $user_id])) {
                $change_details = implode("; ", $changes);
                logAdminAction(
                    $pdo,
                    $_SESSION['user_id'],
                    "Updated user ID '{$user_id}' ({$original['email']}). Changes: {$change_details}",
                    "users"
                );

                echo "<script>alert('User updated successfully!'); window.location.href='users.php';</script>";
            } else {
                echo "Error updating user.";
            }
        } else {
            echo "<script>alert('No changes detected.'); window.location.href='users.php';</script>";
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $user_id = intval($_POST['user_id']);

    $original_stmt = $pdo->prepare("SELECT email, first_name, last_name FROM users WHERE user_id = ?");
    $original_stmt->execute([$user_id]);
    $user = $original_stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $delete_stmt = $pdo->prepare("DELETE FROM users WHERE user_id = ?");
        if ($delete_stmt->execute([$user_id])) {
            logAdminAction(
                $pdo,
                $_SESSION['user_id'],
                "Deleted user ID '{$user_id}' ({$user['email']}, {$user['first_name']} {$user['last_name']})",
                "users"
            );

            echo "<script>alert('User deleted successfully!'); window.location.href='users.php';</script>";
        } else {
            echo "Error deleting user.";
        }
    } else {
        echo "User not found.";
    }
}
?>