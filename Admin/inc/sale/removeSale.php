<?php
    include('../../inc/connection/db-user.php');

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $purchase_read = mysqli_query($conn, "SELECT * FROM sales WHERE sale_id = '$id';");
        while($new = $purchase_read->fetch_assoc()){
            $quantity = $new['quantity'];
            $item_number = $new['item_number'];
            $reduceQuantity = mysqli_query($conn, "UPDATE fish_items SET stock = stock + '$quantity' WHERE item_number = '$item_number'");
            if($reduceQuantity == TRUE){
                $sql = "DELETE FROM sales WHERE sale_id = '$id'";
                $updated = $conn->query($sql);
                if($updated == TRUE){
                $_SESSION['sale-update'] = 'item updated Successfully!';
                header("Location: ./sale.php");
                }else{
                $_SESSION['sale-update'] = 'Error!';
                header("Location: ./sale.php");
                }
            }
        }
    }
?>