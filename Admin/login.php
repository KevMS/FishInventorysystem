
<?php

include './inc/connection/db-user.php';
// include './inc/function.php';
if(count($_POST)>0) {
    $result = mysqli_query($conn,"SELECT * FROM admin WHERE username='" . $_POST["username"] . "' and password = '". $_POST["password"]."'");
    $row  = mysqli_fetch_array($result);
    if(is_array($row)) {
    $_SESSION["id"] = $row['id'];
    $_SESSION["username"] = $row['username'];
    $_SESSION["role"] = $row['role'];
    // Insert User Time Login
    $id = $_SESSION["id"];
    $success = false;
    // Get the User IP
    $userIP = $_SERVER['REMOTE_ADDR']; 
    date_default_timezone_set('Asia/Manila');                                       
    $nowTimeStamp = date("Y-m-d H:i:s");
        // Prepare the SQL Statements  to Insert User Login Time                                            

        $insertLogin_SQL = 'INSERT INTO accesslog (userID,timeLogin,IPaddress )VALUES('.$id.',"'.$nowTimeStamp.' ","'.$userIP.'"'.')';

    if ( $conn->query($insertLogin_SQL))  {  
                                $_SESSION['startTime'] = $nowTimeStamp;
                                $success = true;
                                } else {
                                    echo'Error';    
                                        }     
    } else {
        $_SESSION['status'] = 'Wrong username or password!';
    }
}
if(isset($_SESSION["id"])) {
header("Location:index.php");
}
// Admin login


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./bootstrap/bootstrap.css">
    <link rel="stylesheet" href="./css/login.css">
</head>
<body>

    <div class="user-login-cont">
        <!-- alert -->
        <?php
        if (isset($_SESSION['status'])) {
        ?>    
            <div class="alert alert-secondary alert-dismissible fade show w-50 m-auto" role="alert">
                <?php echo $_SESSION['status']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php 
        unset($_SESSION['status']);
        }
        ?>

        <div class="user-login-logo">
            <img src="./icons/fishlogo.png" alt="fish-logo">
            <h4>Fish <span class="red-text-logo">Inventory System</span></h4>
        </div>

        <h2 class="user-login-title">Login</h2>

        <form action="" method="POST" autocomplete="on">
            <input type="text" name="username" placeholder="Username" required> <br>
            <input type="password" name="password" placeholder="Password" required> <br>
            <input type="submit" name="login" id="btn" value="Login">
        </form>
    </div>
    
    <script src="./bootstrap/bootstrap.js"></script>
</body>
</html>