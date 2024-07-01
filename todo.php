<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
    <style>
        body{
            margin:0;
            padding:0;
            background-color:black;
        }
        .container{
            display:flex;
            flex-direction:column;
            justify-content:center;
            align-items:center;
            color:white;
        }
        .container h1{
            font-size :70px;
        }
        .inputcontainer{
            display:flex;
        }
        input[type="text"]{
            width:500px;
            font-size:large;
            height:30px;
        }
        input[type="submit"]{
            font-size:large;
            height:40px;
        }
        .taskbox{
            margin-top:70px;
            width:700px;
            height:400px;
            border:5px solid white;
        }
        li{
            display:flex;
            width:670px;
            justify-content:space-between;
            align-items:center;
            margin:5px;
            font-size:large;
            border:2px solid;
            padding:5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Todo List</h1>
        <div class="inputbox">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <input type="text" name="name" id="name" placeholder="Enter task">
                <input type="submit" value="Submit">
            </form>
        </div>
        <div class="taskbox">
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = 'todo';
                $conn = mysqli_connect($servername, $username, $password, $database);
                if (!$conn) {
                    die("Sorry we cannot establish the connection" . mysqli_connect_error());
                }

                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if (isset($_POST['name'])) {
                        $task = $_POST['name'];
                        $in = "INSERT INTO `tasks` (`user_tasks`) VALUES ('$task')";
                        $result1 = mysqli_query($conn, $in);
                        if (!$result1) {
                            echo "<br> Sorry we cannot enter the details";
                        }
                    }
                }

                if (isset($_POST['delete_task'])) {
                    $taskToDelete = $_POST['delete_task'];
                    $del = "DELETE FROM `tasks` WHERE `user_tasks` = '$taskToDelete'";
                    $result2 = mysqli_query($conn, $del);
                    if (!$result2) {
                        echo "<br> Sorry we cannot delete the details";
                    }
                }


                $dis = "SELECT * FROM `tasks`";
                $result3 = mysqli_query($conn, $dis);
                if (mysqli_num_rows($result3) > 0) {
                    while ($row = mysqli_fetch_assoc($result3)) {
                        echo "<li>" . ($row['user_tasks']) . " <form method='post' style='display: inline;'><input type='hidden' name='delete_task' value='" . htmlspecialchars($row['user_tasks']) . "'><button type='submit'>X</button></form></li>";
                    }
                }
                ?>
        </div>
    </div>

</body>
</html>
