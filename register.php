<?php
    include ( "db.php");
    if(isset($_POST['signup'])&& $_POST['username'] != '' && $_POST['password'] != '' && $_POST['email'] != '' && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        session_start();
        $username =  mysqli_real_escape_string($connection,$_POST['username']);
        $password = mysqli_real_escape_string($connection,$_POST['password']);
        $email = mysqli_real_escape_string($connection,$_POST['email']);
        $query = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";
        $result = mysqli_query($connection, $query);
        if($result){
            $_SESSION['user'] = $username;
            unset($_POST);
            header("Location: index.php");
         }   
        else
            echo mysqli_error($connection); 
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<link rel="stylesheet" type="text/css" href="form.css">
</head>
<body>
    <div class="container">
    	<h1>SIGN UP</h1>
    	<form action = "register.php" method="POST">
    		<label>Username:</label>
            <input type="text" name="username" placeholder="Username"><br>
            <div class = "warning">
                <?php
                    if(isset($_POST['signup']))
                    if($_POST['username'] == '')
                        echo "Username is required! <br>";
                ?>
            </div>
    		<label>Email:</label> 
            <input type="text" name="email" placeholder="Email" ><br>
            <div class = "warning">
                <?php
                    if(isset($_POST['signup'])){
                        if($_POST['email'] == '')
                            echo "Email is required! <br>";
                        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                            echo "Email address is invalid!";
                            unset($_POST['email']);
                        }
                    }
                ?>
            </div>
    		<label>Password:</label> 
            <input type="password" name="password" placeholder="Password" autocomplete="off"><br>
            <div class = "warning">
                <?php
                    if(isset($_POST['signup']))
                    if($_POST['password'] == '')
                        echo "Password is required! <br>";
                ?>
            </div>
    		<input type="submit" name="signup" value="Sign Up">
    	</form>
    	<p>Existing user?</p>
    	<button>Login</button><br>
    </div>
</body>

<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript">
    $(function(){
        $('button').on('click', function(){
            location.href = "login.php";
        })
    })
</script>
</html>