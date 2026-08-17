<?php session_start();

include("connection.php");
include("functions.php");

if($_SERVER['REQUEST_METHOD'] == "POST")
{
	$username = $_POST['user_name'];
	$password = $_POST['password'];

	if(!empty($username) && !empty($password) && !is_numeric($username))
	{
		$query = "select * from users where username = '$username' limit 1";
		$result = mysqli_query($conn, $query);

		if($result && mysqli_num_rows($result) > 0)
		{
			$user_data = mysqli_fetch_assoc($result);
			
			if($user_data['password'] === $password)
			{
				$_SESSION['user_id'] = $user_data['user_id'];
				header("Location: home.php");
				die;
			}
		}
		
		echo "wrong username or password!";
	}else
	{
		echo "wrong username or password!";
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="hero">
        <div class="form-box">
            <div class="button-box">
                <div id="btn"></div>
                <button type="button" class="toggle-btn" onclick="login()">Login</button>
                <button type="button" class="toggle-btn " onclick="register()">Register</button>
            </div>
            <!-- <div class="social-icons">
                <img src="fb.png" alt="">
                <img src="tw.png" alt="">
                <img src="gp.png" alt="">
            </div> -->
            <form id="Login" class="input-group" method="post" action="login.php">
                <input type="text" class="input-field" name="user_name" placeholder="User Name" required>
                <input type="password" class="input-field" name="password" placeholder="Enter Password" required>
                <input type="checkbox" class="check-box"><span>Remember Password</span>
                <button type="submit" class="submit-btn">Login</button>
            </form>
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
