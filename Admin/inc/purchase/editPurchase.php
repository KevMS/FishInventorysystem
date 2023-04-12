<?php

include '../connection/db-user.php';
include '../../inc/function.php';

if (isset($_GET['id'])) {
    $purchaseID= $_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM purchase WHERE purchase_id = '$purchaseID';");
}

//update Purchase
if (isset($_POST['updatePurchase'])) {
    $update_purchase_id = mysqli_real_escape_string($conn, check($_POST['purchase_id']));
    $update_item_number = mysqli_real_escape_string($conn, check($_POST['item_number']));
    $update_item_name = mysqli_real_escape_string($conn, check($_POST['item_name']));
    $update_supplier_name = mysqli_real_escape_string($conn, check($_POST['supplier_name']));
    $update_quantity = mysqli_real_escape_string($conn, check($_POST['quantity']));
    $update_unit_price = mysqli_real_escape_string($conn, check($_POST['price']));
    $update_total_cost = mysqli_real_escape_string($conn, check($_POST['total_cost']));

    $set_quantity = mysqli_query($conn, "SELECT * FROM purchase WHERE purchase_id = '$update_purchase_id';");
    while($chase = $set_quantity->fetch_assoc()){
    $currentQuantity = $chase['quantity'];

    if($currentQuantity == $update_quantity ){
        $insert = mysqli_query($conn, "UPDATE purchase SET quantity = '$update_quantity', unit_price = '$update_unit_price', total_cost = '$update_total_cost' WHERE purchase_id = '$update_purchase_id' ;");
        if(($insert > 0)){
        $_SESSION['purchase-updated'] = 'Purchase Updated Successfully!';
        header("Location: purchase.php");
        }else{
        $_SESSION['Purchase-update_error'] = 'Purchase Update error!';
        }
    }else{
        $reduce = mysqli_query($conn, "UPDATE fish_items SET stock = stock - '$currentQuantity' WHERE item_number = '$update_item_number'");
        if($reduce == TRUE){
            $updateQuanntity = mysqli_query($conn, "UPDATE fish_items SET stock = stock + '$update_quantity' WHERE item_number = '$update_item_number'");
            $insert = mysqli_query($conn, "UPDATE purchase SET quantity = '$update_quantity', unit_price = '$update_unit_price', total_cost = '$update_total_cost' WHERE purchase_id = '$update_purchase_id' ;");
                if(($insert > 0)  && ($updateQuanntity > 0) ){
                $_SESSION['purchase-updated'] = 'Purchase Updated Successfully!';
                header("Location: purchase.php");
                }else{
                $_SESSION['Purchase-update_error'] = 'Purchase Update Error!';
                }
        }  
    }
    }
    
}  

// display items
$purchase_read = mysqli_query($conn, "SELECT * FROM purchase;");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fish Inventory</title>
    <!-- Material CDN https://developers.google.com/fonts/docs/material_icons-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <!--STYLESHEET-->
    <link rel="stylesheet" href="../../css/style.css">
</head>

<body>
    <div class="top">
        <div class="logo">
            <img src="../../icons/fishlogo.png" alt="">
            <h1>FISH <span class="danger">INVENTORY SYSTEM</span></h1>
            <button id="menu-btn">
                <span class="material-symbols-sharp">menu</span>
            </button>
        </div>
        
        <div class="profile">
            <div class="admin-name">
                <div class="admin">
                    <br>
                    <span class="hovertext" data-hover= "Edit Admin"><a href="../../admin-update.php"><b class="text-muted">Admin</b></a></span>
                </div>
            </div>
            <div class="profile-photo">
                <a class="hovertext" href="admin-update.php" data-hover= "Edit Admin"><img src="../../icons/admin-logo.jpg" alt="pic"></a>
            </div>
        </div>
    </div>
<div class="container">
    <aside>
            <div class="nav">
                <div class="close" id="close-btn">
                    <span class="material-symbols-sharp">close</span>
                </div>
                <div class="logo" id="logo">
                    <h1>FISH <span class="danger">INVENTORY SYSTEM</span></h1>
                </div>
                <a id="dashboard" class= "not-active" href="../../index.php"><span ><img  src="../../icons/icons8-dashboard-layout-24.png" alt=""></span><h3>Dashboard</h3></a>
                <a id="inventory"class= "not-active"  href="../../inc/inventory/inventory.php"><span ><img src="../../icons/icons8-in-inventory-30.png" alt=""></span><h3 >Inventory</h3></a>
                <a id="purchase" class= "active" href="../../inc/purchase/purchase.php"><span ><img src="../../icons/icons8-purchase-order-32.png" alt=""></span><h3>Purchase</h3></a>
                <a id="orders" class= "not-active" href="../../inc/orders/orders.php"><span ><img src="../../icons/icons8-purchase-order-30.png" alt=""></span><h3>Orders</h3></a>
                <a id="sale" class= "not-active" href="../../inc/sale/sale.php"><span ><img src="../../icons/icons8-purchase-64.png" alt=""></span><h3>Sale</h3></a>
                <a id="supplier" class= "not-active" href="../../inc/suppliers/supplier.php"><span ><img src="../../icons/icons8-supplier-50.png" alt=""></span><h3>Suppliers</h3></a>
                <a id="customer" class= "not-active" href="../../inc/customer/customer.php"><span ><img src="../../icons/icons8-customers-64.png" alt=""></span><h3>Customers</h3></a>
                <a id="category" class= "not-active" href="../../inc/category/category.php"><span ><img src="../../icons/icons8-diversity-24.png" alt=""></span><h3>Category</h3></a>
                <a id="gallery" class= "not-active" href="../../inc/gallery/gallery.php"><span ><img src="../../icons/icons8-top-view-fish-50.png" alt=""></span><h3>Gallery</h3></a>
                <a href="../../logout.php"><span ><img src="../../icons/icons8-logout-24.png" alt=""></span><h3 class='danger'>Logout</h3></a>
            </div>
    </aside>
<main>
<!-- purchase -->
    <label class="btn" style="padding:10px;"><a href="purchase.php">Back</a></label>
    <h1 style="text-align:center;">Edit Purchase Details</h1>
    <div style="display:grid; grid-template-columns: 35rem auto ; margin-left:3rem; " >
    <?php while($row = mysqli_fetch_assoc($result)){
        $purchase_id = $row['purchase_id'];
        $purchaseItem_id = $row['item_number'];
        $purchaseItem_name = $row['item_name'];
        $itemPrice = $row['unit_price'];
        $quantity = $row['quantity'];
        $total = $row['total_cost'];
        $supplier = $row['supplier_name'];

        ?>
            <form action="" enctype="multipart/form-data" method="POST">
                    <input type="hidden" name="purchase_id" value= "<?php echo $purchase_id; ?>">
                    <label for="">Item Number</label>
                    <input type="text" name="item_number"  value="<?php echo intval($purchaseItem_id); ?>" READONLY><br>
                    <label for="">Item Name</label>
                    <input type="text" name="item_name"  value="<?php echo $purchaseItem_name; ?>" READONLY><br>
                    <label for="cat">Select Supplier:</label>
                    <select class='classic' name='supplier_name'>
                    <?php 
                    $queryOption = "SELECT * FROM supplier";
                    $sqlOption = mysqli_query($conn, $queryOption); 
                    ?>
                    <?php while($results = mysqli_fetch_array($sqlOption)){
                    $option = $results['supplier_name'];?>
                    <?php echo "<option value='$option'>$option</option>"; ?>
                    <?php
                    }?>
                </select><br>
                    <?php $fish_item = mysqli_query($conn,"SELECT * FROM fish_items WHERE item_number = '$purchaseItem_id';"); 
                while($row = mysqli_fetch_array($fish_item)){ 
                        $currentStock = $row['stock'];
                        $fish_image = $row['image']  ?>
                        <label for="stat">Current Stock</label>
                        <input type="text" name="stock"  value="<?php echo $currentStock; ?>"READONLY><br><?php
                        ?>
                        <label for="">Quantity</label>
                        <input id="quantity" type="number" name="quantity" onkeyup="mult()" value= <?php echo $quantity ;?> ><br>
                        <label for="">Unit Price</label>
                        <input id="price" type="number" name="price"  onkeyup="mult()" value= <?php echo $itemPrice ;?> ><br>
                        <label for="">Total Cost</label>
                        <input id="totalPrice" type="text" name="total_cost" value= <?php echo $total ;?>  READONLY><br><br>
                        <input type="submit" name="updatePurchase" value="Update Purchase">
                    </form>
                    <div style="margin-left:2rem; margin-top:2rem;" class="img">
                        <img style="width:100%; height:100%;" src="../inventory/fishIMG/<?php echo $fish_image; ?>" alt="">
                    </div><?php
                } ?>
            <script>

                function mult(){
                    const quantity = document.getElementById('quantity').value;
                    const price = document.getElementById('price').value;
                    var total = quantity * price;
                    document.getElementById("totalPrice").value = total;
                }

            </script>
            <?php
    }?>
            
</div>
<!--End of Inventory -->
</main>
    <script src="../../js/index.js"></script>
</body>
</html>                                                                                                