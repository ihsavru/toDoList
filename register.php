<?php
    include ( "db.php");
    if(isset($_POST['signup'])&& $_POST['username'] != '' && $_POST['password'] != '' && $_POST['email'] != ''){
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
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="form.css">
</head>
<body>
    <div class="container">
    	<h1>SIGN UP</h1>
    	<form action = "register.php" method="POST">
    		<label>Username:</label>
            <input type="text" name="username" placeholder="Username"><br>
    		<label>Email:</label> 
            <input type="text" name="email" placeholder="Email" ><br>
    		<label>Password:</label> 
            <input type="password" name="password" placeholder="Password" autocomplete="off"><br>
    		<input type="submit" name="signup" value="Sign Up">
    	</form>
    	Existing user?<br>
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