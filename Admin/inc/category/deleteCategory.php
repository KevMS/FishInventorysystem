<?php
    include('../inc/connection/db-user.php');

    if(isset($_GET['del'])){
        $id = $_GET['del'];
        $sql = "DELETE FROM category WHERE catID = '$id'";
        $deleted = $conn->query($sql);
        if($deleted == TRUE){
            $_SESSION['category-del'] = 'Category Added Successfully!';
            header("Location: ./category.php");
            
        }else{
            $_SESSION['category-del'] = 'Error!';
            header("Location: ./category.php");
        }
    }
