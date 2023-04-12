<?php
    include('../../inc/connection/db-user.php');

    if(isset($_GET['del'])){
        $id = $_GET['del'];
        $sql = "DELETE FROM fish_items WHERE fish_id = '$id'";
        $deleted = $conn->query($sql);
        if($deleted == TRUE){
            $_SESSION['inventory-del'] = 'item Deleted Successfully!';
            header("Location: ./inventory.php");
            
        }else{
            $_SESSION['inventory-del'] = 'Error!';
            header("Location: ./inventory.php");
        }
    }
?>