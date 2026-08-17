




<?php
require_once 'connection.php';

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
    $stmt = $conn->prepare("SELECT * FROM $table WHERE product_id = ?");
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
    <title><?php echo htmlspecialchars($product['product_name']); ?> - Product Details</title>
    <link rel="stylesheet" href="font/css/all.min.css">
    <link rel="stylesheet" href="details.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .wrapper {
            width: 100%;
            height: 500px; /* Adjust as needed */
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 50px; /* Adjust as needed */
        }

        .container {
            height: 400px;
            display: flex;
            flex-wrap: nowrap;
            overflow: hidden;
            position: relative;
            width: 80%;
        }

        .card {
            width: 100%;
            height: 100%;
            position: absolute;
            opacity: 0;
            transition: opacity 0.6s ease;
        }

        .card img {
            width: 100%;
            height: auto;
            border-radius: 0.75rem;
        }

        input[type="radio"] {
            display: none;
        }

        /* Show the active slide */
        input#c1:checked ~ .container label[for="c1"],
        input#c2:checked ~ .container label[for="c2"],
        input#c3:checked ~ .container label[for="c3"],
        input#c4:checked ~ .container label[for="c4"],
        input#c5:checked ~ .container label[for="c5"],
        input#c6:checked ~ .container label[for="c6"] {
            opacity: 1;
        }

        .product-info {
            margin-top: 20px;
        }

        .book-now-btn {
            margin-top: 20px;
            width: 120px;
            height: 40px;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            background-color: rgba(63, 114, 76, 0.7);
            color: white;
            font-size: 16px;
        }

        .book-now-btn:hover {
            opacity: 0.7;
        }

        .book-now-btn:active {
            background-color: white;
            color: black;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <a href="home.php">
                <?php if ($brand == 'bmw'): ?>
                    <img class="logo-img" src="./img/logo(3).png" alt="BMW Logo">
                <?php elseif ($brand == 'mercedes'): ?>
                    <img class="logo-img" src="img/logo2.0.png" alt="Mercedes Logo">
                <?php endif; ?>
            </a>
        </div>
    </header>

    <main>
        <div class="product-details-container">
            <div class="wrapper">
                <div class="container">
                  <?php foreach ($images as $index => $image): ?>
                        <input type="radio" name="slide" id="c<?php echo $index + 1; ?>" <?php echo $index === 0 ? 'checked' : ''; ?> />
                        <label for="c<?php echo $index + 1; ?>" class="card">
                            <img src="<?php echo htmlspecialchars($image); ?>" alt="Product Image <?php echo $index + 1; ?>">
                        </label>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="product-info">
                <h1 class="product-name"><?php echo htmlspecialchars($product['product_name']); ?></h1>
                <p class="product-description"><?php echo htmlspecialchars($product['description']); ?></p>
                <p class="product-price"><strong>Price: </strong>$<?php echo htmlspecialchars($product['price']); ?></p>
                <a href="booking.php?product_name=<?php echo urlencode($product['product_name']); ?>&price=<?php echo urlencode($product['price']); ?>&brand=<?php echo urlencode($brand); ?>">
                    <button class="book-now-btn">Book Now</button>
                </a>
            </div>
        </div>
    </main>

    <footer>
        <div class="footer-info">
            <div class="footer-width about">
                <h2>About</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores repudiandae debitis delectus ipsa repellat, molestiae consequuntur, officiis dicta consequatur autem laboriosam praesentium ut aperiam veritatis impedit soluta commodi optio perspiciatis.</p>
                <div class="social-media">
                    <ul>
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-width links">
                <h2>Quick Links</h2>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Services</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
            <div class="footer-width contact">
                <h2>Contact</h2>
                <ul>
                    <li><span><i class="fa fa-envelope"></i></span><p>engine@gaari-shaari.com</p></li>
                    <li><span><i class="fa fa-phone"></i></span><p>111 222 333</p></li>
                </ul>
            </div>
        </div>
        <p class="copyright">All rights reserved.</p>
    </footer>
</body>
</html>