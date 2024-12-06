<?php
require 'auth.php'; 

echo "<h1>Welcome, " . htmlspecialchars($_SESSION['first_name']) . "!</h1>";


if ($_SESSION['role'] === 'admin') {
    echo "<a href='admin_dashboard.php'>Go to Admin Dashboard</a>";
}

echo "<a href='logout.php'>Logout</a>";
?>