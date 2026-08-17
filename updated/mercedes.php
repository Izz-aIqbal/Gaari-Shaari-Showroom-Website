<?php
require_once 'connection.php';

// Set the brand dynamically or hardcoded for testing
$brand = 'mercedes'; 
$table = $brand . '_products'; 

// Fetch products from the brand-specific table
$products = $conn->query("SELECT * FROM $table");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="font/css/all.min.css">
    <link rel="stylesheet" href="mercedes.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title><?php echo ucfirst($brand); ?> Products</title>
</head>
<body>
<header>
    <div class="logo">
        <a href="home.php"><img class="logo-pic" src="img/logo2.0.png" alt="Logo"></a>
    </div>
</header>

<main>
    <div class="container">
        <div class="gridview">
            <?php while ($row = mysqli_fetch_assoc($products)) { ?>
            <div class="product">
                <div>
                    <?php
                    // Fetch images for this product
                    $productId = $row['product_id'];
                    $imageQuery = $conn->prepare("SELECT image_url FROM product_images WHERE product_id = ? AND brand = ?");
                    $imageQuery->bind_param("is", $productId, $brand);
                    $imageQuery->execute();
                    $imageResult = $imageQuery->get_result();
                    $imageRow = $imageResult->fetch_assoc();
                    $imageUrl = $imageRow['image_url'];
                    ?>
                    <img class="product-pic" src="<?php echo htmlspecialchars($imageUrl); ?>" alt="<?php echo htmlspecialchars($row['product_name']); ?>">
                </div>
                <div class="product-details">
                    <div class="product-info">
                        <p class="title"><?php echo htmlspecialchars($row["product_name"]); ?></p>
                        <p class="price"><b>$<?php echo htmlspecialchars($row["price"]); ?></b></p>
                        <p class="discount"><b><del>$<?php echo htmlspecialchars($row["discount"]); ?></del></b></p>
                        <!-- <p class="description"><?php echo htmlspecialchars($row["description"]); ?></p> -->
                    </div>
                    <a href="details.php?product_id=<?php echo urlencode($row['product_id']); ?>&brand=<?php echo urlencode($brand); ?>"><button class="exp-btn">Explore</button></a>
                </div>
            </div>
            <?php } ?>
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
