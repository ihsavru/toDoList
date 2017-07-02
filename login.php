<?php
    include ("db.php");
    if(isset($_POST['login']) && $_POST['username'] != '' && $_POST['password'] != ''){
        session_start();
        $username =  mysqli_real_escape_string($connection, $_POST['username']);
        $password = mysqli_real_escape_string($connection, $_POST['password']);
        $query = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($connection, $query);
        while($row = mysqli_fetch_array($result)){
            if($row["password"] == $password){
                $_SESSION['user'] = $username;
                unset($_POST);
                header("Location: index.php");
            }
            else{
                die("Wrong username/password".mysqli_error());
            }
        }
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
    	<h1>LOGIN</h1>
    	<form method="POST" action = "login.php">
    		Username: <input type="text" name="username" placeholder="Username" autocomplete="off"><br>
    		Password: <input type="password" name="password" placeholder="Password" autocomplete="off"><br>
    		<input type="submit" name="login" value="Login"><br>
    	</form>
    	New user?<br>
    	<button>Sign up</button>
    </div>
</body>

<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript">
    $(function(){
        $('button').on('click', function(){
            location.href = "register.php";
        })
    })
</script>
</html>