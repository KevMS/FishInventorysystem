<?php
    include('../../inc/connection/db-user.php');

    if(isset($_GET['del'])){
        $id = $_GET['del'];
        $sql = "DELETE FROM customer WHERE customer_id = '$id'";
        $deleted = $conn->query($sql);
        if($deleted == TRUE){
            $_SESSION['customer-del'] = 'item Deleted Successfully!';
            header("Location: ./customer.php");
            
        }else{
            $_SESSION['customer-del'] = 'Error!';
            header("Location: ./customer.php");
        }
    }