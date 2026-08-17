<?php

require_once 'connection.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Fetch all products from both tables
$bmw_products = $conn->query("SELECT * FROM bmw_products");
$mercedes_products = $conn->query("SELECT * FROM mercedes_products");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="font/css/all.min.css">
    <link rel="stylesheet" href="mercedes.css">
    <title>Admin Display</title>
</head>
<body>
<header>
    <h1 class="logo">
        <a href="#"><img class="logo-img" src="img/logo.png" alt="Logo"></a>
    </h1>
</header>

<main>
    <div class="container">
        <div class="gridview">
            <!-- Display BMW Products -->
            <?php while($row = mysqli_fetch_assoc($bmw_products)){ ?>
            <div class="product">
                <div>
                    <img class="product-pic" src="<?php echo $row["product_images"]; ?>" alt="">
                </div>
                <div class="product-details">
                    <div class="product-info">
                        <p class="title"><?php echo $row["product_name"]; ?></p>
                        <p class="price"><b>$<?php echo $row["price"]; ?></b></p>
                        <p class="discount"><b><del>$<?php echo $row["discount"]; ?></del></b></p>
                    </div>
                    <a href="update.php?edit=<?php echo $row['product_id']; ?>&brand=bmw"><button class="exp-btn">Edit</button></a>
                </div>
            </div>
            <?php } ?>

            <!-- Display Mercedes Products -->
            <?php while($row = mysqli_fetch_assoc($mercedes_products)){ ?>
            <div class="product">
                <div>
                    <img class="product-pic" src="<?php echo $row["product_images"]; ?>" alt="">
                </div>
                <div class="product-details">
                    <div class="product-info">
                        <p class="title"><?php echo $row["product_name"]; ?></p>
                        <p class="price"><b>$<?php echo $row["price"]; ?></b></p>
                        <p class="discount"><b><del>$<?php echo $row["discount"]; ?></del></b></p>
                    </div>
                    <a href="update.php?edit=<?php echo $row['product_id']; ?>&brand=mercedes"><button class="exp-btn">Edit</button></a>
                </div>
            </div>
            <?php } ?>
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
    <p class="copyright"> All rights reserved.</p>
</footer>
</body>
</html>
