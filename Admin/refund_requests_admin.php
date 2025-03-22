<?php
session_start();
require '../config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../Login_page/login.php");
    exit();
}

// Fetch refund requests
$stmt = $pdo->query("
    SELECT rr.id, rr.order_id, rr.user_id, rr.reason, rr.status, rr.requested_at,
           u.first_name, u.last_name, o.total_price
    FROM refund_requests rr
    JOIN users u ON rr.user_id = u.user_id
    JOIN orders o ON rr.order_id = o.order_id
    ORDER BY rr.requested_at DESC
");
$refunds = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Refund Requests</title>
    <link rel="stylesheet" href="../assests/css/style.css?v=<?php echo time(); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Merriweather', serif;
            background-color: #f8f9fa;
        }
        .refund-box {
            margin: 60px auto;
            max-width: 1000px;
        }
        .action-btn {
            margin-right: 5px;
        }
        .table td, .table th {
            vertical-align: middle;
            text-align: center;
        }
    </style>
</head>
<body>

<?php include '../navbar.php'; ?>

<div class="container refund-box">
    <h2 class="text-center mb-4">Refund Requests</h2>

    <?php if (count($refunds) > 0): ?>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Reason</th>
                    <th>Requested At</th>
                    <th>Status</th>
                    <th>Total (£)</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($refunds as $refund): ?>
                    <tr>
                        <td><?= $refund['order_id'] ?></td>
                        <td><?= htmlspecialchars($refund['first_name'] . ' ' . $refund['last_name']) ?></td>
                        <td><?= ucfirst(str_replace('_', ' ', $refund['reason'])) ?></td>
                        <td><?= $refund['requested_at'] ?></td>
                        <td>
                            <?php if ($refund['status'] === 'pending'): ?>
                                <span class="badge bg-warning text-dark">Pending</span>
                            <?php elseif ($refund['status'] === 'approved'): ?>
                                <span class="badge bg-success">Approved</span>
                            <?php elseif ($refund['status'] === 'declined'): ?>
                                <span class="badge bg-danger">Declined</span>
                            <?php endif; ?>
                        </td>
                        <td>£<?= number_format($refund['total_price'], 2) ?></td>
                        <td>
                            <?php if ($refund['status'] === 'pending'): ?>
                                <a href="process_refund.php?id=<?= $refund['id'] ?>&action=approve" class="btn btn-success btn-sm action-btn">Accept</a>
                                <a href="process_refund.php?id=<?= $refund['id'] ?>&action=decline" class="btn btn-danger btn-sm">Decline</a>
                            <?php else: ?>
                                <em>No action</em>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="text-center">No refund requests found.</p>
    <?php endif; ?>
</div>

<?php include '../footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>