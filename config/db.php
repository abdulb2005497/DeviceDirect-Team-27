<?php
$host = "localhost";         
$dbname = "devicedirect"; 
$username = "root";          
$password = "";              
try {
    
    $pdo = new PDO('mysql:host=localhost;dbname=devicedirect', $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    
    header("Location: /login.php"); 
    exit; 
}
?>