<?php
    include('../../inc/connection/db-user.php');

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "UPDATE orders SET status = 'cancelled' WHERE order_id = '$id'";
        $cancelled = $conn->query($sql);
        if($cancelled == TRUE){
            $_SESSION['order-cancel'] = 'Order cancelled Successfully!';
            header("Location: ./orders.php");
            
        }else{
            $_SESSION['order-cancel'] = 'Error!';
            header("Location: ./orders.php");
        }
    }

    if(isset($_GET['undo'])){
        $undo = $_GET['undo'];
        $sql = "UPDATE orders SET status = 'pending' WHERE order_id = '$undo'";
        $pending = $conn->query($sql);
        if($pending == TRUE){
            $_SESSION['undo-cancel'] = 'Order Reordered Successfully!';
            header("Location: ./orders.php");
            
        }else{
            $_SESSION['undo-cancel'] = 'Error!';
            header("Location: ./orders.php");
        }
    }
?>