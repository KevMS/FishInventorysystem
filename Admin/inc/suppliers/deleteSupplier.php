<?php
    include('../../inc/connection/db-user.php');

    if(isset($_GET['del'])){
        $id = $_GET['del'];
        $sql = "DELETE FROM supplier WHERE supplier_id = '$id'";
        $deleted = $conn->query($sql);
        if($deleted == TRUE){
            $_SESSION['supplier-del'] = 'item Deleted Successfully!';
            header("Location: ./supplier.php");
            
        }else{
            $_SESSION['supplier-del'] = 'Error!';
            header("Location: ./supplier.php");
        }
    }