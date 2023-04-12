<?php
    include('./inc/connection/db-user.php');

    if(isset($_GET['del'])){
        $id = $_GET['del'];
        $sql = "DELETE FROM admin WHERE id = '$id'";
        $deleted = $conn->query($sql);
        if($deleted == TRUE){
            $_SESSION['admin-del'] = 'User Deleted Successfully!';
            header("Location: ./admin-update.php");
            
        }else{
            $_SESSION['admin-del'] = 'Error!';
            header("Location: ./admin-update.php");
        }
    }
?>