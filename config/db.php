<?php
$host = "localhost";         
$dbname = "devicedirectusercreds"; 
$username = "root";          
$password = "";              

try {
    
    $pdo = new PDO('mysql:host=localhost;dbname=devicedirectusercreds', $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    
    header("Location: /login.php"); 
    exit; 
}
?>