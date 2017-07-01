
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>LISTSSSSS</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script type="text/javascript" href="main.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
     <div class="container">
         <h1>TO-DO LIST</h1>
         <form  method = "post" action = "index.php">
             <input type="text" name="task" placeholder="Add another task..." autocomplete="off">
             <input type="submit" name="go" value="Add">
         </form>
         <h4> Double-click on a task to delete</h4>
        <ul  style="list-style: none;">
        <?php
            include("db.php");
            $query = "SELECT * FROM tasks";
            $printMessages = mysqli_query($connection, $query);
            $index = 1;
            while($row = mysqli_fetch_array($printMessages)){
                $index = $row['i'];
                if($row['done'] == 0)
                echo "<li id = '$index'>".$row['task']."</li>";
                $index = $index + 1;
            }
            $task = mysqli_real_escape_string($connection, $_POST['task']);
            if($task !== ''){
                $post = "INSERT INTO tasks (i,task,done) VALUES ('$index','$task','0')";
                $result = mysqli_query($connection, $post);
                if ($result) {
                    header("Location: index.php");
                }  
                else{
                    echo "Error: " . $result . "<br>" . mysqli_error($connection);
                }
            }
        ?>
        </ul>
    </div> 
</body>
<script type="text/javascript"
 src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $("li").on('click',function(){
        $(this).fadeOut();
        window.location = "?index=" + $(this).attr("id");
        <?php
            if (isset($_GET['index'])) 
                $i = $_GET['index'];
            $delete = "UPDATE tasks SET done = 1 WHERE i = '$i' ";
            $res = mysqli_query($connection, $delete);
        ?>
    })
  });
</script>

</html>
