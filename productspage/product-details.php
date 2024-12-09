<?php
include_once '../config/db.php';
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <style>
        /* Basic styling */
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        .product-details {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        img {
            width: 300px;
            height: auto;
        }
        .details-container {
            margin-top: 20px;
        }
        select {
            padding: 5px;
            margin-top: 10px;
        }
        .clickable-image {
            cursor: pointer;
        }
        .button {
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
        }
        .button:disabled {
            background-color: #cccccc;
            cursor: not-allowed;
        }
        .cart-message {
            color: green;
            margin-top: 10px;
        }
    </style>
</head>
<body>

    <h1>Product Details</h1>
    <div id="product-details-container" class="product-details">
    </div>

    <script src = 'product-details.js'></script>
</body>
</html>
