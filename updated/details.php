<?php
require_once 'connection.php';

// Debugging: Print the entire $_GET array
// echo '<pre>';
// print_r($_GET);
// echo '</pre>';

if (isset($_GET['product_id']) && isset($_GET['brand'])) {
    $product_id = $_GET['product_id'];
    $brand = $_GET['brand'];

    // Validate the product_id
    if (!is_numeric($product_id)) {
        echo "Invalid product ID.";
        exit();
    }

    // Validate the brand parameter
    $valid_brands = ['bmw', 'mercedes']; // List of valid brands
    if (!in_array($brand, $valid_brands)) {
        echo "Invalid brand.";
        exit();
    }

    // Determine the table based on the brand
    $table = $brand . '_products';

    // Fetch product details from the appropriate table
    $stmt = $conn->prepare("SELECT product_name, price, description FROM $table WHERE product_id = ?");
    if (!$stmt) {
        echo "Failed to prepare statement: " . $conn->error;
        exit();
    }

    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result) {
        $product = $result->fetch_assoc();

        if (!$product) {
            echo "Product not found.";
            exit();
        }
    } else {
        echo "Failed to execute query: " . $stmt->error;
        exit();
    }

    $stmt->close();

    // Fetch product images
    $stmt = $conn->prepare("SELECT image_url FROM product_images WHERE product_id = ? AND brand = ?");
    $stmt->bind_param("is", $product_id, $brand);
    $stmt->execute();
    $result = $stmt->get_result();
    $images = [];
    while ($row = $result->fetch_assoc()) {
        $images[] = $row['image_url'];
    }
    $stmt->close();
} else {
    echo "Invalid product ID or brand.";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="font/css/all.min.css">
    <link rel="stylesheet" href="details.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title><?php echo htmlspecialchars($product['product_name']); ?> - Product Details</title>
    <style>
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    /* background-color: white; */
}

html{
    scroll-behavior: smooth;
}

body{
    background-color: black;

}

.product-image{

    display: grid;
    grid-template-columns: 1fr 1fr;
    row-gap: 0%;
    column-gap: 0%;
}


    </style>
</head>
<body>
<header>
    <h1 class="logo">
        <?php
        if ($brand == 'bmw') {
            echo '<a href="home.php"><img class="logo-img" src="./img/logo(3).png" alt="BMW Logo"></a>';
        } elseif ($brand == 'mercedes') {
            echo '<a href="home.php"><img class="logo-img" src="img/logo2.0.png" alt="Mercedes Logo"></a>';
        }
        ?>
    </h1>
</header>
`
<main class="main">
    <div class="product-details-container">
        <div class="product-image">
            <?php foreach ($images as $image): ?>
                <img src="<?php echo htmlspecialchars($image); ?>" alt="<?php echo htmlspecialchars($product['product_name']); ?>" style="width:100%; max-width:400px; height:auto; margin-bottom:10px;">
            <?php endforeach; ?>
        </div>
        <div class="product-info">
            <h1 class="product-name"><?php echo htmlspecialchars($product['product_name']); ?></h1>
            <p class="product-description"><?php echo nl2br(htmlspecialchars($product['description'])); ?></p>
            <p class="product-price"><strong>Price:</strong> $<?php echo htmlspecialchars($product['price']); ?></p>
            <a href="booking.php?product_name=<?php echo urlencode($product['product_name']); ?>&price=<?php echo urlencode($product['price']); ?>&brand=<?php echo urlencode($brand); ?>">
                <button class="book-now-btn">Book Now</button>
            </a>
        </div>
    </div>
</main>

<footer>
    <div class="footer-info">
        <!-- Footer content here -->
    </div>
    <p class="copyright"> All rights reserved.</p>
</footer>
</body>
</html>
