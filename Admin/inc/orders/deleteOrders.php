<?php
    include('../../inc/connection/db-user.php');

    if(isset($_GET['del'])){
        $id = $_GET['del'];
        $sql = "DELETE FROM orders WHERE order_id = '$id'";
        $deleted = $conn->query($sql);
        if($deleted == TRUE){
            $_SESSION['orders-del'] = 'Order Deleted Successfully!';
            header("Location: ./orders.php");
            
        }else{
            $_SESSION['orders-del'] = 'Error!';
            header("Location: ./orders.php");
        }
    }
?>