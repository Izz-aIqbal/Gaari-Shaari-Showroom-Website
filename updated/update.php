<?php
require_once 'connection.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_GET['edit']) && isset($_GET['brand'])) {
    $product_id = $_GET['edit'];
    $brand = $_GET['brand'];
    $table = ($brand === 'bmw') ? 'bmw_products' : 'mercedes_products';

    // Fetch the existing product details from the database
    $query = "SELECT * FROM $table WHERE product_id='$product_id'";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        die("Product not found.");
    }
} else {
    die("Invalid request.");
}

if (isset($_POST['update'])) {
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $discount = $_POST['discount'];
    $description = $_POST['description'];
    $product_image = $product['product_images']; // Default to existing image

    // Check if a new image is uploaded
    if ($_FILES['imageUpload']['name']) {
        $upload_dir = "uploads/";
        $product_image = $upload_dir . basename($_FILES["imageUpload"]["name"]);
        $imageType = strtolower(pathinfo($product_image, PATHINFO_EXTENSION));
        $check = $_FILES["imageUpload"]["size"];
        $upload_ok = 1;

        // Validate image file
        if (file_exists($product_image)) {
            echo "<script>alert('The file already exists')</script>";
            $upload_ok = 0;
        }

        if ($check === 0) {
            echo '<script>alert("The photo size is 0, please change the photo")</script>';
            $upload_ok = 0;
        }

        if ($imageType != 'jpg' && $imageType != 'png' && $imageType != 'jpeg' && $imageType != 'gif') {
            echo '<script>alert("Please change the image format")</script>';
            $upload_ok = 0;
        }

        if ($upload_ok == 1) {
            move_uploaded_file($_FILES["imageUpload"]["tmp_name"], $product_image);
        } else {
            $product_image = $product['product_images']; // Keep existing image if upload failed
        }
    }

    // Update product details in the database
    $stmt = $conn->prepare("UPDATE $table SET product_name=?, price=?, discount=?, product_images=?, description=? WHERE product_id=?");
    $stmt->bind_param("sddssi", $product_name, $price, $discount, $product_image, $description, $product_id);

    if ($stmt->execute()) {
        echo "<script>alert('Product updated successfully');</script>";
        echo "<script>window.location.href = 'admin_display.php';</script>";
    } else {
        echo "<script>alert('There was an error updating the product: " . $stmt->error . "');</script>";
    }

    $stmt->close();
} elseif (isset($_POST['delete'])) {
    // Handle delete request
    $stmt = $conn->prepare("DELETE FROM $table WHERE product_id=?");
    $stmt->bind_param("i", $product_id);

    if ($stmt->execute()) {
        echo "<script>alert('Product deleted successfully');</script>";
        echo "<script>window.location.href = 'admin_display.php?brand=$brand';</script>";
    } else {
        echo "<script>alert('There was an error deleting the product: " . $stmt->error . "');</script>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="font/css/all.min.css">
    <link rel="stylesheet" href="upload.css">
    <title>Update Product</title>
</head>
<body>
<header>
    <h1 class="logo">
        <a href="#"><img class="logo-img" src="img/logo.png" alt="Web Logo"></a>
    </h1>
</header>
<div class="hero">
    <section id="upload_container">
        <form id="upload-form" class="input-group" action="" method="POST" enctype="multipart/form-data">
            <input type="text" class="input-field" name="product_name" value="<?php echo $product['product_name']; ?>" placeholder="Product Name" required>
            <input type="number" class="input-field" name="price" value="<?php echo $product['price']; ?>" placeholder="Product Price" required>
            <input type="number" class="input-field" name="discount" value="<?php echo $product['discount']; ?>" placeholder="Product Discount">
            <textarea class="input-field" name="description" placeholder="Product Description" required><?php echo $product['description']; ?></textarea>
            <input type="file" class="img-upload" name="imageUpload" id="imageUpload" hidden>
            <button id="choose" type="button" onclick="upload();">Choose Image</button>
            <input type="submit" value="Update" class="submit-btn" name="update">
                <input type="submit" value="Delete" class="submit-btn" name="delete">

        </form>
        <a href="admin_display.php?brand=<?php echo $brand; ?>"><button class="submit-btn">Go Back</button></a>
    </section>
</div>

<script>
    var choose = document.getElementById("choose");
    var uploadImage = document.getElementById("imageUpload");

    function upload() {
        uploadImage.click();
    }

    uploadImage.addEventListener("change", function () {
        var file = this.files[0];
        choose.innerHTML = "You can change (" + file.name + ") picture";
    });
</script>
</body>
</html>
