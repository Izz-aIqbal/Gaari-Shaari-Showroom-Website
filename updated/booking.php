<?php
require_once 'connection.php';
session_start();

$productName = '';
$totalAmount = '';
$brand = '';
$user_id = '';

if (isset($_SESSION['booking_completed']) && $_SESSION['booking_completed'] === true) {
    // Redirect to a confirmation page or show a message
    header("Location: booking_confirmation.php");
    exit();
}


if (isset($_GET['product_name']) && isset($_GET['price']) && isset($_GET['brand'])) {
    $productName = $_GET['product_name'];
    $totalAmount = $_GET['price'];
    $brand = $_GET['brand'];
    // Retrieve the user ID from the session
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
    } else {
        echo "User not logged in.";
        exit();
    }
} else {
    echo "Invalid request.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
    <link rel="stylesheet" href="booking.css">
</head>
<body>
    <header>
        <h1 class="logo">
            <a href="home.php"><img class="logo-img" src="img/logo.png" alt="Web Logo"></a>
        </h1>
        <!-- <ul class="menu-container">
            <a href="#"><li class="menu-item">Home</li></a>
            <a href="mercedes.php"><li class="menu-item">Mercedes Collections</li></a>
            <a href="bmw.php"><li class="menu-item">BMW Collection</li></a>
        </ul> -->
    </header>
    <div class="container">
        <h1 class="form-title">Booking</h1>
        <form action="submit_booking.php" method="POST">
            <div class="customer-info">
                <div class="input-box">
                    <label for="fullName">Full Name</label>
                    <input type="text" id="fullName" name="fullName" placeholder="Enter Your Name" required>
                </div>
                <div class="input-box">
                    <label for="address">Address</label>
                    <input type="text" id="address" name="address" placeholder="Enter Your Address" required>
                </div>
                <div class="input-box">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter Your Email" required>
                </div>
                <div class="input-box">
                    <label for="phoneNo">Phone Number</label>
                    <input type="text" id="phoneNo" name="phoneNo" placeholder="Enter Your Phone Number" required>
                </div>
                <div class="input-box">
                    <label for="productName">Product Name</label>
                    <input type="text" id="productName" name="productName" value="<?php echo htmlspecialchars($productName); ?>" readonly>
                </div>
                <div class="input-box">
                    <label for="brand">Brand</label>
                    <input type="text" id="brand" name="brand" value="<?php echo htmlspecialchars($brand); ?>" readonly>
                </div>
                <h3 class="total">Total Amount: $ <?php echo htmlspecialchars($totalAmount); ?></h3>
            </div>
            <div class="form-submit">
                <input type="hidden" name="totalAmount" value="<?php echo htmlspecialchars($totalAmount); ?>">
                <input type="hidden" name="brand" value="<?php echo htmlspecialchars($brand); ?>">
                <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user_id); ?>">
                <input type="submit" value="Book It">
                <p>Note: Your booking will be confirmed after you pay the initial 25% of the total amount at the dealership.</p>
            </div>
        </form>
    </div>
</body>
</html>
