<?php
    include('../../inc/connection/db-user.php');

    if(isset($_GET['del'])){
        $id = $_GET['del'];
        $purchase_read = mysqli_query($conn, "SELECT * FROM purchase WHERE purchase_id = '$id';");
        while($new = $purchase_read->fetch_assoc()){
            $quantity = $new['quantity'];
            $item_number = $new['item_number'];
            $reduceQuantity = mysqli_query($conn, "UPDATE fish_items SET stock = stock - '$quantity' WHERE item_number = '$item_number'");
            if($reduceQuantity == TRUE){
                $sql = "DELETE FROM purchase WHERE purchase_id = '$id'";
                $deleted = $conn->query($sql);
                if($deleted == TRUE){
                $_SESSION['inventory-del'] = 'item Deleted Successfully!';
                header("Location: ./purchase.php");
                }else{
                $_SESSION['inventory-del'] = 'Error!';
                header("Location: ./purchase.php");
                }
            }
        }
    }
?>