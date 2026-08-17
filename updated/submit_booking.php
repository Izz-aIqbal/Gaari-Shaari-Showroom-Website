<?php
session_start();

require_once 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = $_POST['fullName'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $phoneNo = $_POST['phoneNo'];
    $productName = $_POST['productName'];
    $totalAmount = $_POST['totalAmount'];
    $brand = $_POST['brand'];
    $user_id = $_POST['user_id'];
    $order_date = date('Y-m-d H:i:s');

    // Insert booking details into the database
    $stmt = $conn->prepare("INSERT INTO orders (address, full_name, email, phone_number, product_name, total_amount, order_date, product_id, user_id, brand) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssdsiis", $address, $fullName, $email, $phoneNo, $productName, $totalAmount, $order_date, $product_id, $user_id, $brand);

    if ($stmt->execute()) {
        // echo "<script>alert('Booking successful');</script>";
        // echo "<script>window.location.href = 'home.php';</script>";
        $_SESSION['booking_completed'] = true;
        header("Location: booking_confirmation.php");
        exit();

    } else {
        echo "<script>alert('There was an error processing your booking: " . $stmt->error . "');</script>";
    }

    $stmt->close();
}
    $conn->close();

?>
