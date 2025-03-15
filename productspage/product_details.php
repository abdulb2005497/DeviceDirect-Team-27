<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once('../navbar.php');
include('../config/db.php');
include('../checkoutpage/cart_functions.php');

if (!isset($_GET['variant_id']) || !is_numeric($_GET['variant_id'])) {
    die("Invalid product variant ID.");
}

$variant_id = intval($_GET['variant_id']);

try {
    $query = "
        SELECT
            p.product_title,
            ca.category_name,
            pv.prod_variant_id,
            pv.image,
            pv.price
        FROM product_variants pv
        JOIN products p ON pv.product_id = p.product_id
        JOIN product_categories ca ON pv.category_id = ca.category_id
        WHERE pv.prod_variant_id = :variant_id
        LIMIT 1
    ";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':variant_id', $variant_id, PDO::PARAM_INT);
    $stmt->execute();

    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$product) {
        die("Product variant not found.");
    }

} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['product_title']); ?> - Product Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&display=swap" rel="stylesheet">
</head>
<body>

<!-- Product Details Container -->
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <img id="product-image" src="../productspage/images/<?= htmlspecialchars($product['image']) ?>"
                class="img-fluid"
                alt="<?= htmlspecialchars($product['product_title']) ?>">
        </div>
        <div class="col-md-6">
            <h2><?php echo htmlspecialchars($product['product_title']); ?></h2>
            <p class="text-muted">Category: <?php echo htmlspecialchars($product['category_name']); ?></p>

            <h4 id="product-price" class="mt-3">Price: £<?php echo number_format($product['price'], 2); ?></h4>

            <!-- Add to Cart Form -->
            <form method="post">
                <input type="hidden" name="variant_id" value="<?= $product['prod_variant_id'] ?>">

                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" value="1" min="1" class="form-control w-50 mb-3">

                <button type='submit' name='add_to_cart' class="btn btn-primary">Add to Cart</button>
            </form>

            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
                $user_id = $_SESSION['user_id'] ?? null;
                $variant_id = $_POST['variant_id'] ?? null;
                $quantity = $_POST['quantity'] ?? 1;

                if ($user_id && $variant_id && $quantity) {
                    $result = addToCart($pdo, $user_id, $variant_id, $quantity);
                    if ($result) {
                        echo "<p class='text-success mt-3'>Product added to cart successfully!</p>";
                    } else {
                        echo "<p class='text-danger mt-3'>Failed to add product to cart.</p>";
                    }
                } else {
                    echo "<p class='text-danger mt-3'>Error: Missing required fields.</p>";
                }
            }
            ?>
        </div>
    </div>
</div>

<!--Reviews (NEW)-->
<hr>
<h3 class="mt-5">Customer Reviews</h3>

<?php
//handling reviews submissions
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_review'])) {
    $user_id = $_SESSION['user_id'] ?? null;
    $rating = intval($_POST['rating'] ?? 0);
    $review_text = trim($_POST['review_text'] ?? '');

    if($user_id && $rating >= 1 && $rating <= 5 && !empty($review_text)) {
        $insert_review_query = "
        INSERT INTO product_reviews (prod_variant_id, user_id, review_text, rating, created_at)
        VALUES (:prod_variant_id, :user_id, :review_text, :rating, NOW())
        ";
        $stmt = $pdo->prepare($insert_review_query);
        $stmt->execute([
            ':prod_variant_id' => $variant_id,
            ':user_id' => $user_id,
            ':review_text' => $review_text,
            ':rating' => $rating
        ]);

        echo "<meta http-equiv = 'refresh' content = '0'>";
    } else {
            echo "<p class = 'text-danger'>Please provide a rating and a comment for the product.</p>";
        }
    

}
//fetching existing reviews
$review_query = "
SELECT r.rating, r.review_text, r.created_at, u.user_id
FROM product_reviews r
JOIN users u ON r.user_id = u.user_id
WHERE r.prod_variant_id = :prod_variant_id
ORDER BY r.created_at DESC
";

$stmt = $pdo->prepare($review_query);
$stmt->execute([':prod_variant_id' => $variant_id]);
$reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!--Displaying Reviews on each page-->

<div class ="mt-3">
    <?php if ($reviews): ?>
        <?php foreach ($reviews as $review): ?>
            <div class = "mb-3 p-3 border rounded bg-light">
                <strong><?= htmlspecialchars($review['user_id']) ?></strong>
                - <span class = "text-warning">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <i class ="fas fa-star <?= $i <= $review['rating'] ? 'text-warning' : 'text-secondary' ?>"></i>
                        <?php endfor; ?>
                    </span>
                    <p class="mt-2"><?= htmlspecialchars($review['review_text']) ?></p>
                    <small class = "text-muted"><? = htmlspecialchars($review['created_at']) ?></small>
                    </div>
                    <?php endforeach; ?>
                    <?php else: ?>
                        <p>No reviews yet. Be the first to review our AMAZING product!</p>
                        <?php endif; ?>
                    </div>

<!--Form to submit reviews-->
<?php if (isset($_SESSION['user_id'])): ?>
    <h4 class = "mt-5">Leave a Review<h4>
        <form method = "POST" class = "mt-3">
             <div class = "mb-3">
                <label for = "rating" class = "form-label">Rating:</label>
                <div id = "star-rating" class = "d-flex">
                    <?php for ($i = 1; $i <= 5; $i++) : ?>
                        <i class="fas fa-star star" data-value="<?= $i ?>"></i>
                        <?php endfor; ?>
                    </div>
                    <input type = "hidden" name = "rating" id = "rating" required>
                    </div>

                    <div class = "mb-3">
                        <label for = "comment" class = "form-label">Your Review:</label>
                        <textarea name = "review_text" id = "comment" rows = "5" class = "form-control" required></textarea>
                    </div>

                    <button type = "submit" name = "submit_review" class = "btn btn-success">Submit Review</button>
                    </form>
                    <?php else: ?>
                        <p class = "mt-3">You need to <a href= "../Login_page/login.php">log in to our website</a>to leave a review.</p>
                        <?php endif; ?>


<?php include_once'../footer.php';  ?>

<script src="imgchange.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const stars = document.querySelectorAll('.star');
    const ratingInput = document.getElementById('rating');
    stars.forEach(star => {
        star.addEventListener('click', (e) => {
        const value = e.target.getAttribute('data-value');
        ratingInput.value = value;
    stars.forEach(s => s.classList.remove('text-warning'));
for (let i = 0; i< value; i++){
    stars[i].classList.add('text-warning');

}
});
    });
</script>



</body>
</html>
