<?php
include_once '../navbar.php';
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link rel="stylesheet" href="style.css">
    <style>

        .product-container {
          padding: 20px;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .product-top {
          padding: 20px;
            flex-wrap: wrap;
        }
        .product-item {
            border: 1px solid #ccc;
            padding: 10px;
            width: 200px;
            text-align: center;
            cursor: pointer;
        }
        .product-item img {
            width: 100%;
            height: auto;
        }
        select {
            padding: 5px;
            margin-bottom: 20px;
        }
    </style>

      <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
       <!-- bootstrap links -->
       <link
       href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
       rel="stylesheet"
       integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
       crossorigin="anonymous"
     />
     <!-- bootstrap links -->
     <!-- fonts links -->
     <link rel="preconnect" href="https://fonts.googleapis.com" />
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
     <link
       href="https://fonts.googleapis.com/css2?family=Merriweather&display=swap"
       rel="stylesheet"
     />
<body>



<div class="product-top">

    <h1>Product List</h1>

    <label for="category-select">Choose a Category:</label>
    <select id="category-select">
        <option value="">-- All Categories --</option>
    </select>

</div>

    <div id="product-container" class="product-container">
    </div>

    <script src = 'script.js'></script>

<?php include_once '../footer.php'; ?>

</body>
</html>
