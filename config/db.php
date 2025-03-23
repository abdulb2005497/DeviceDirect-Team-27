<?php
$host = "localhost";
$dbname = "devicedirect";
$username = "root";
$password = "";

try {
  $pdo = new PDO('mysql:host=localhost;dbname=devicedirect', $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    if (str_contains($e->getMessage(), "Unknown database")) {
        die("Error: The database '$dbname' does not exist. Please create it before proceeding. The file can be found in DeviceDirect-Team-27/devicedirect.sql.");
    } else {
        header("Location: Login_page/login.php");
        exit;
    }
}
?>
