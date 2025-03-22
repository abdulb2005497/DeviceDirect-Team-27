<?php
session_start();
require '../config/db.php';

// OPTIONAL: Check if user is an admin here
// if ($_SESSION['role'] !== 'admin') {
//     die("Access denied.");
// }

$stmt = $pdo->query("SELECT rr.*, o.total_price, u.first_name, u.last_name 
                     FROM refund_requests rr
                     JOIN orders o ON rr.order_id = o.order_id
                     JOIN users u ON rr.user_id = u.user_id
                     ORDER BY requested_at DESC");

$refunds = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Refund Requests</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="p-4">
    <div class="container">
        <h2>Refund Requests</h2>
        <table class="table table-bordered table-striped mt-4">
            <thead>
                <tr>
                    <th>Request ID</th>
                    <th>User</th>
                    <th>Order ID</th>
                    <th>Reason</th>
                    <th>Status</th>
                    <th>Requested At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($refunds as $r): ?>
                    <tr>
                        <td><?= $r['id'] ?></td>
                        <td><?= htmlspecialchars($r['first_name'] . ' ' . $r['last_name']) ?></td>
                        <td><?= $r['order_id'] ?></td>
                        <td><?= htmlspecialchars($r['reason']) ?></td>
                        <td><?= ucfirst($r['status']) ?></td>
                        <td><?= $r['requested_at'] ?></td>
                        <td>
                            <?php if ($r['status'] === 'pending'): ?>
                                <a href="process_refund.php?id=<?= $r['id'] ?>&action=approve" class="btn btn-success btn-sm">Approve</a>
                                <a href="process_refund.php?id=<?= $r['id'] ?>&action=reject" class="btn btn-danger btn-sm">Reject</a>
                            <?php else: ?>
                                <span class="text-muted">Processed</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>