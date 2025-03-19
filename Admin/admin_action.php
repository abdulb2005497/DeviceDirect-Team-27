<?php
function logAdminAction($pdo, $user_id, $action, $affected_table) {
    $sql = "INSERT INTO admin_logs (user_id, action, affected_table, timestamp)
            VALUES (:user_id, :action, :affected_table, NOW())";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':user_id' => $user_id,
        ':action' => $action,
        ':affected_table' => $affected_table
    ]);
}
header("Location: adminpage.php");

 ?>
