<?php
session_start();
require '../config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../Login_page/login.php");
    exit();
}

if (!isset($_GET['id']) || !isset($_GET['action'])) {
    die("Invalid request.");
}

$refund_id = intval($_GET['id']);
$action = $_GET['action'];

if (!in_array($action, ['approve', 'decline'])) {
    die("Invalid action.");
}

$status = $action === 'approve' ? 'approved' : 'declined';

try {
    $stmt = $pdo->prepare("UPDATE refund_requests SET status = ?, reviewed_at = NOW() WHERE refund_id = ?");
    $stmt->execute([$status, $refund_id]);

    $message = ucfirst($status) . " refund successfully.";
    header("Location: refund_requests_admin.php?msg=" . urlencode($message));
    exit();
} catch (PDOException $e) {
    $error = "Failed to update refund request: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Process Refund</title>
    <link rel="stylesheet" href="../assests/css/style.css?v=<?php echo time(); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Merriweather', serif;
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 80px;
            max-width: 600px;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

<?php include '../navbar.php'; ?>

<div class="container text-center">
    <h2>Refund Processing</h2>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger mt-3"><?php echo htmlspecialchars($error); ?></div>
    <?php else: ?>
        <div class="alert alert-success mt-3"><?php echo htmlspecialchars($message); ?></div>
        <a href="refund_requests_admin.php" class="btn btn-primary mt-3">Back to Refund Requests</a>
    <?php endif; ?>
</div>

<?php include '../footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
