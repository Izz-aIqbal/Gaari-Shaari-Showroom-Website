<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
}

.menu-container a {
    text-decoration: none;
    margin: 2rem;
    font-weight: 500;
    color: white;
}

/* For smaller screens */
@media screen and (max-width: 1024px) {
    .menu-container a {
        margin: 1rem; /* Decrease margin */
    }
}

@media screen and (max-width: 767px) {
    .menu-container a {
        margin: 0.5rem; /* Further decrease margin */
    }
}

@media screen and (max-width: 480px) {
    .menu-container a {
        margin: 0.1rem; /* Minimal margin on very small screens */
        font-size: 0.9rem; /* Reduce font size slightly */
    }
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

.container {
    display: flex;
    flex-direction: column;
    /* Display items vertically */
    align-items: center;
    /* Center items horizontally */
    padding: 100px 20px 20px;
}



.intro{
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-around;
}

.col{
    flex-basis: 50%;
    min-width: 300px;
}

.col h1{
    font-size: 30px;
    line-height: 60px;
    /* margin:  0; */
    margin-left: 50px;
    color: white;
    font-weight: 300;
}

.col p{
    color: white;
    margin: 25px 0;
    margin-left: 50px;
    line-height: 30px;
    padding-right: 30px;
}

.col img{
    max-width: 100%;
    padding: 50px 0;
}

.section {
    width: 100%;
    margin-bottom: 20px;
    position: relative;
    /* height: 500px; */
}
/* .category{
    position: relative;
    width: 400px;
}
.category-img{

}
.category-overlay{
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.6);
    color: #ffff;

} */

.section img {
    /* position: absolute; */
    top: 0;
    left: 0;
    /* background-color: white; */
    width: 100%;

    /* height: 100%; */
}



/* .footer {
    background-color: black;
    color: white;
    text-align: center;
    padding: 20px 5px;
    width: 100%;
}

.footer p {
    margin: 0;
}

.social-icons {
    margin-top: 20px;
}

.social-icons a {
    color: white;
    font-size: 20px;
    margin: 0 10px;
}

.social-icons a:hover {
    color: white;
}
footer {
    background-color: black;
    color: white;
    text-align: center;
    padding: 10px 0;
} */
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
        <li class="menu-item"><a href="home.php">Home</li></a>
            <li class="menu-item dropdown">
                <label for="toggle-collections" class="menu-link">Collections</label>
                <input type="checkbox" id="toggle-collections" class="dropdown-checkbox">
                <ul class="dropdown-content">
                    <li><a href="mercedes.php">Mercedes Collection</a></li>
                    <li><a href="bmw.php">BMW Collection</a></li>
                </ul>
            </li>
            <li class="menu-item"><a href="#about">About</li></a>
            <li class="menu-item"><a href="#contact">Contact</li></a>
            <?php if (!isset($_SESSION['user_id'])) { ?>
            <li><a href="login.php">Login</a></li>
            <?php } else { ?>
            <li><a href="order_history.php">Order History</a></li>
            <li><a href="logout.php">Logout</a></li>
            <?php } ?>
        </ul>
    </header>
    <div class="container">
        <div class="intro">
            <div class="col">
                <h1>Welcome to gaari-shaari!!!</h1>
                <p>"Unleash the power of luxury and precision with our premium car collection. Whether you're seeking the thrill of the open road or the comfort of a first-class drive, your journey begins here. Explore our range of vehicles and find the perfect ride to drive your dreams forward. Experience the innovation and performance that turn every journey into an adventure. Your next great driving experience awaits—discover it today!"</p>
            </div>
           
            <div class="col">
                <img src="img/bgg.png" alt="Image 1">
            </div>
        </div>
       
        <div class="section">
            <a href="mercedes.php"><img src="img/merc(1-0).jpg" alt="Image 3"></a>
        </div>

        <div class="section">
                
            <a href="bmw.php"><img src="img/2_7.png" alt="Image 2"></a>
            
        </div>
    </div>
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
