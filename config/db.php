<?php
$host = "localhost";         
$dbname = "cs2team27_devicedirect"; 
$username = "cs2team27";          
$password = "BxYWD1WOJpecGSA";              

try {
    
    $pdo = new PDO('mysql:host=localhost;dbname=devicedirect', $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    
    header("Location: /login.php"); 
    exit; 
}
?>