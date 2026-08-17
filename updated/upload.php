<?php
require_once 'connection.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $brand = $_POST['brand'];
    $productName = $_POST['product_name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    // Choose the correct table based on brand
    $table = $brand == 'BMW' ? 'bmw_products' : 'mercedes_products';

    // Insert the product into the correct table
    $stmt = $conn->prepare("INSERT INTO $table (product_name, price, description) VALUES (?, ?, ?)");
    $stmt->bind_param("sds", $productName, $price, $description);
    $stmt->execute();

    // Get the last inserted product ID
    $productId = $stmt->insert_id;
    $stmt->close();

    // Handle image uploads
    foreach ($_FILES['product_images']['tmp_name'] as $key => $tmp_name) {
        $imageName = $_FILES['product_images']['name'][$key];
        $imageTmpName = $_FILES['product_images']['tmp_name'][$key];
        $uploadDir = 'uploads/';
        $imageUrl = $uploadDir . basename($imageName);

        if (move_uploaded_file($imageTmpName, $imageUrl)) {
            // Save image URL in product_images table
            $stmt = $conn->prepare("INSERT INTO product_images (product_id, image_url, brand) VALUES (?, ?, ?)");
            $stmt->bind_param("iss", $productId, $imageUrl, $brand);
            $stmt->execute();
            $stmt->close();
        }
    }

    echo "Product and images uploaded successfully.";
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
    <link rel="stylesheet" href="upload.css">
    <title>Upload Product</title>
</head>
<body>
<header>
    <h1 class="logo">
        <a href="#"><img class="logo-img" src="img/logo.png" alt="Web Logo"></a>
    </h1>
</header>
<div class="hero">
    <section id="upload_container">
    <form action="upload.php" method="post" enctype="multipart/form-data">
    <label for="brand">Brand:</label>
    <select name="brand" id="brand" required>
        <option value="BMW">BMW</option>
        <option value="Mercedes">Mercedes</option>
    </select>

    <label for="product_name">Product Name:</label>
    <input type="text" name="product_name" id="product_name" required>

    <label for="price">Price:</label>
    <input type="text" name="price" id="price" required>

    <label for="description">Description:</label>
    <textarea name="description" id="description" required></textarea>

    <label for="product_images">Upload Images:</label>
    <input type="file" name="product_images[]" id="product_images" multiple required>

    <input type="submit" value="Upload Product">
</form>

        <a href="admin_display.php"><button class="submit-btn">Edit</button></a>

    </section>
</div>

<script>
    var productname = document.getElementById("productname");
    var price = document.getElementById("price");
    var discount = document.getElementById("discount");
    var choose = document.getElementById("choose");
    var uploadImage = document.getElementById("imageUpload");

    function upload() {
        uploadImage.click();
    }

    uploadImage.addEventListener("change", function () {
        var file = this.files[0];
        if (productname.value == "") {
            productname.value = file.name;
        }
        choose.innerHTML = "You can change (" + file.name + ") picture";
    });
</script>
</body>
</html>
