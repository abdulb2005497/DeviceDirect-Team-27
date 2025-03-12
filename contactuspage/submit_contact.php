<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["success" => false, "error" => "User not logged in."]);
    exit();
}

include_once '../config/db.php'; // Include your PDO database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $fullname = $_POST['name'];
    $email = $_POST['email'];
    $query_text = $_POST['message'];

    try {
        $stmt = $pdo->prepare("INSERT INTO queries (user_id, fullname, email, query_text, resolved) VALUES (?, ?, ?, ?, 'No')");
        $stmt->execute([$user_id, $fullname, $email, $query_text]);

        echo json_encode([
            "success" => true,
            "name" => htmlspecialchars($fullname),
            "email" => htmlspecialchars($email),
            "message" => htmlspecialchars($query_text)
        ]);
    } catch (PDOException $e) {
        echo json_encode(["success" => false, "error" => $e->getMessage()]);
    }
}
?>
