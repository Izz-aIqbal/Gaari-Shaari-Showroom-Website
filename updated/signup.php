<?php session_start();

include("connection.php");
include("functions.php");

if($_SERVER['REQUEST_METHOD'] == "POST")
{
	$username = $_POST['user_name'];
	$password = $_POST['password'];
    $email = $_POST['email'];


	if(!empty($username) && !empty($password) && !is_numeric($username))
	{
		$user_id = random_num(20);
		$query = "insert into users (user_id,username,password,email) values ('$user_id','$username','$password','$email')";

		mysqli_query($conn, $query);

		header("Location: login.php");
		die;
	}else
	{
		echo "Please enter some valid information!";
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="hero">
        <div class="form-box">
            <div class="button-box">
                <div id="btn"></div>
                <a href="home.html"><button type="button" class="toggle-btn" >Login</button></a>
                <a href="signup.php"><button type="button" class="toggle-btn " >Register</button></a>
            </div>
            <div class="social-icons">
                <img src="fb.png" alt="">
                <img src="tw.png" alt="">
                <img src="gp.png" alt="">
            </div>
            <!-- <form id="Login" class="input-group" method="post" action="login.php">
                <input type="text" class="input-field" name="user_name" placeholder="User id" required>
                <input type="password" class="input-field" name="password" placeholder="Enter Password" required>
                <input type="checkbox" class="check-box"><span>Remember Password</span>
                <button type="submit" class="submit-btn">Login</button>
            </form> -->
            <form id="Register" class="input-group" method="post" action="signup.php">
                <input type="text" class="input-field" name="user_name" placeholder="User id" required>
                <input type="email" class="input-field" name="email" placeholder="Email id" required>
                <input type="password" class="input-field" name="password" placeholder="Enter Password" required>
                <input type="checkbox" class="check-box"><span>I agree to the terms and conditions</span>
                <button type="submit" class="submit-btn">Sign up</button>
            </form>
        </div>
    </div>
    <script>
        var x = document.getElementById("Login");
        var y = document.getElementById("Register");
        var z = document.getElementById("btn");

        function register() {
            x.style.left = "-400px";
            y.style.left = "50px";
            z.style.left = "110px";
        }
        function login() {
            x.style.left = "50px";
            y.style.left = "450px";
            z.style.left = "0px";
        }
    </script>
</body>
</html>
