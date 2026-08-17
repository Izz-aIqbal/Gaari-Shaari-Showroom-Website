<?php
session_start();
require_once 'connection.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user's order history from the database
$stmt = $conn->prepare("SELECT * FROM orders WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Order History</title>
    <link rel="stylesheet" href="order_history.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
html{
    scroll-behavior: smooth;
}

body{
    margin: 0;
}


    header {
    width: 100%;
    position: fixed;
    top: 0;
    left: 0;
    height: 80px;
    background-color: black;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 5%;
    z-index: 1000;
    margin-bottom: 50px;
}

.logo {
    display: flex;
    align-items: center;
    color: white;
}

.logo-img {
    width: 170px;
    height: 72px;
}

.menu-container {
    display: flex;
    justify-content: center;
    align-items: center;
    list-style-type: none;
    height: 100%;
    padding-right: 60px;;
}

.menu-container a {
    text-decoration: none;
    margin: 2rem;
    font-weight: 500;
    color: white;
}

.menu-item:hover {
    text-decoration: underline white;
}

.menu-container a.active {
    border-bottom: 3px solid white; 
}

.menu-item {
    margin: 2rem;
    cursor: pointer;
    font-weight: 500;
    color: white;
    
}

.menu-icons-container {
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
}

.menu-link{
    cursor: pointer;
}

.dropdown-checkbox {
    display: none;
}

.dropdown-checkbox:checked + .dropdown-content {
    display: block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: black;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.dropdown-content a {
    color: white;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown-content a:hover {
    background-color: gray;
}

.container{
    display: flex;
    justify-content: center;
    align-items: center;
}

.heading{
    margin-top: 150px;
    margin-left: 96.400px;
}

.logout-btn{
margin-top: 10px;
width: 100px;
border: 1px solid black;
margin-left: 96.400px;
text-align: center;
padding-top: 400px;
}


table {
    border-collapse: collapse;
    border-spacing: 10px; /* Space between cells */
    width: 80%;
    margin: 20px auto;
    font-weight: 450;
    /* border: 1px solid black; */
}

th, td {
    border: 1px solid black; /* Borders for cells */
    padding: 10px; /* Padding inside cells */
    text-align: left; /* Align text to the left */
}

th {
    background-color: #f2f2f2; /* Light gray background for header cells */
}

tbody tr:nth-child(even) {
    background-color: #f9f9f9; /* Light gray background for even rows */
}

.logout-btn {
    margin-top: 20px;
    margin-bottom: 30px;
    padding: 10px 20px;
    border: 1px solid black;
    background-color: black;
    text-decoration: none;
    color: white;
    display: inline-block;
    transition: color 0.7s, background-color ;
}

.logout-btn:active {
    background-color: white;
    color: black;
}

.logout-btn:hover {
    box-shadow: 5px 5px 10px  rgba(63, 114, 76, 0.4);
}

                           /* footer */
                           footer a{
    text-decoration: none;
    transition: 0.5s;
    color: #fff;
}
ul ,li{
    list-style-type: none;
}
footer{
    background-color: black;
    color: white;
    width: 100%;
}
.footer-info{
    width: 90%;
    margin: 0 ;
    display: flex;
    padding: 50px 0;
}
.footer-info , .footer-width{
    padding: 0 15px;
}
.footer-info h2{
    margin-bottom: 20px;
}
.about , .contact{
    width: 40%;
}
.links{
    width: 20%;
}
.social-media{
    margin-top: 30px;
}
.social-media ul{
    display: flex;
}
.social-media ul li a{
    display: inline-block;
    margin-right: 20px;
    width: 50px;
    height: 50px;
    padding-top: 12px;
    background-color: transparent;
    text-align: center;
}
.social-media ul li a:hover{
    opacity: 0.7;
    /* background-color: white; */
    /* color: black; */
}
.links ul li a{
    display: block;
    margin-bottom: 15px;
    font-size: 18px;
}
.links ul li a:hover{
    opacity: 0.7;

}
.contact ul li{
    display: flex;
    align-items: center;
    margin-bottom: 15px;
}
.contact ul li span{
    margin-right: 15px;
}
.copyright{
    padding: 15px 0 ;
    margin: 0;
    text-align: center;
    font-size: 15px;
    background-color: black;
}
@media screen and (max-width:767px) {
    .about , .contact , .links{
        width: 100%;
        margin-bottom: 30px;

    }
    .footer-info{
        flex-direction: column;
    }
    
}






</style>
</head>
<body>

<header>
        <h1 class="logo">
            <a href="home.php"><img class="logo-img" src="img/logo.png" alt="Web Logo"></a>
        </h1>
        <ul class="menu-container">
            <a href="home.php"><li class="menu-item">Home</li></a>
            <li class="menu-item dropdown">
                <label for="toggle-collections" class="menu-link">Collections</label>
                <input type="checkbox" id="toggle-collections" class="dropdown-checkbox">
                <ul class="dropdown-content">
                    <li><a href="mercedes.php">Mercedes Collection</a></li>
                    <li><a href="bmw.php">BMW Collection</a></li>
                </ul>
            </li>
            <a href="#about"><li class="menu-item">About</li></a>
            <a href="#contact"><li class="menu-item">Contact</li></a>
            
        </ul>
    </header>
<main>
    <div class="container"><h1 class="heading">Order History</h1></div>
    <?php if ($result->num_rows > 0) { ?>
        <table>
            <thead>
                <tr >
                    <th>Order Date</th>
                    <th>Product Name</th>
                    <th>Total Amount</th>
                    <th>Address</th>
                    <th>Phone Number</th>
                    <th>Brand</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($order = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($order['order_date']); ?></td>
                        <td><?php echo htmlspecialchars($order['product_name']); ?></td>
                        <td><?php echo htmlspecialchars($order['total_amount']); ?></td>
                        <td><?php echo htmlspecialchars($order['address']); ?></td>
                        <td><?php echo htmlspecialchars($order['phone_number']); ?></td>
                        <td><?php echo htmlspecialchars($order['brand']); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p>No orders found.</p>
    <?php } ?>
    <div class="container"><a class="logout-btn" href="logout.php">Logout</a></div>
    </main>
    <footer>
        <div class="footer-info">
            <div id="about" class="footer-width about">
                <h2>About</h2>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores repudiandae debitis delectus ipsa repellat, molestiae consequuntur, officiis dicta consequatur autem laboriosam praesentium ut aperiam veritatis impedit soluta commodi optio perspiciatis.
                </p>
                <div class="social-media">
                    <ul>
                        <li><a href="#"><i class="fa fa-facebook"></i>
                        <li><a href="#"><i class="fa fa-instagram"></i>
                        <li><a href="#"><i class="fa fa-twitter"></i>
                        </a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-width links">
                <h2>Quick Links</h2>
                <ul>
                    <li><a href="home.php">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <!-- <li><a href="#">Services</a></li> -->
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </div>
            <div id="contact" class="footer-width contact">
                <h2>Contact</h2>
                <ul>
                    <li>
                        <span><i class="fa fa-envelope"></i></span>
                        <p>engine@gaari-shaari.com</p>
                    </li>
                    <li>
                        <span><i class="fa fa-phone"></i></span>
                        <p>111 222 333</p>
                    </li>
                </ul>
            </div>
        </div>
        <p class="copyright"> All rights reserved.</p>
    </footer>
</body>
</html>
<?php
$stmt->close();
?>
