<?php

include '../connection/db-user.php';
include '../../inc/function.php';

if (isset($_POST['selectedItem'])) {
    $item_name= $_POST['item_name'];
    $result = mysqli_query($conn, "SELECT * FROM fish_items WHERE item_name= '$item_name';");
}

//add item
if (isset($_POST['addOrder'])) {
    $item_number = mysqli_real_escape_string($conn, check($_POST['item_number']));
    $item_name = mysqli_real_escape_string($conn, check($_POST['item_name']));
    $customer_name = mysqli_real_escape_string($conn, check($_POST['customer_name']));
    $quantity = mysqli_real_escape_string($conn, check($_POST['quantity']));
    $unit_price = mysqli_real_escape_string($conn, check($_POST['price']));
    $total_cost = mysqli_real_escape_string($conn, check($_POST['total_cost']));
    $stock = mysqli_real_escape_string($conn, check($_POST['stock']));
    $status = "pending";
    if ($stock == 0){
        echo '<script>alert("Out of Stock!")</script>';
        echo '<script>window.location.href="./orders.php"</script>'; 
    }else{
        $insert = mysqli_query($conn, "INSERT INTO orders VALUES(null, '$item_number', '$item_name', '$quantity', '$unit_price', '$total_cost', '$customer_name', null, '$status');");
        if(($insert > 0)){
            $_SESSION['Orders-added'] = 'Orders Added Successfully!';
            header("Location: orders.php");
        }else{
        $_SESSION['Orders-error'] = 'Orders Error!';
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
                <a id="purchase" class= "not-active" href="../../inc/purchase/purchase.php"><span ><img src="../../icons/icons8-purchase-order-32.png" alt=""></span><h3>Purchase</h3></a>
                <a id="orders" class= "active" href="../../inc/orders/orders.php"><span ><img src="../../icons/icons8-purchase-order-30.png" alt=""></span><h3>Orders</h3></a>
                <a id="sale" class= "not-active" href="../../inc/sale/sale.php"><span ><img src="../../icons/icons8-purchase-64.png" alt=""></span><h3>Sale</h3></a>
                <a id="supplier" class= "not-active" href="../../inc/suppliers/supplier.php"><span ><img src="../../icons/icons8-supplier-50.png" alt=""></span><h3>Suppliers</h3></a>
                <a id="customer" class= "not-active" href="../../inc/customer/customer.php"><span ><img src="../../icons/icons8-customers-64.png" alt=""></span><h3>Customers</h3></a>
                <a id="category" class= "not-active" href="../../inc/category/category.php"><span ><img src="../../icons/icons8-diversity-24.png" alt=""></span><h3>Category</h3></a>
                <a id="gallery" class= "not-active" href="../../inc/gallery/gallery.php"><span ><img src="../../icons/icons8-top-view-fish-50.png" alt=""></span><h3>Gallery</h3></a>
                <a href="../../logout.php"><span ><img src="../../icons/icons8-logout-24.png" alt=""></span><h3 class='danger'>Logout</h3></a>
            </div>
    </aside>
<main>
<!-- order -->
<div class="Order">
    <?php while($row = mysqli_fetch_assoc($result)){
        $orderItem_id = $row['item_number'];
        $orderItem_name = $row['item_name'];
        $itemPrice = $row['unit_price'];
        $stock = $row['stock'];
        ?>
            <form action="" enctype="multipart/form-data" method="POST">
                    <label for="">Item Number</label>
                    <input type="text" name="item_number"  value="<?php echo intval($orderItem_id); ?>" READONLY><br>
                    <label for="">Item Name</label>
                    <input type="text" name="item_name"  value="<?php echo $orderItem_name; ?>" READONLY><br>
                    <label for="cat">Select Customer:</label>
                    <select class='classic' name='customer_name'>
                    <?php 
                    $queryOption = "SELECT * FROM customer";
                    $sqlOption = mysqli_query($conn, $queryOption); 
                    ?>
                    <?php while($results = mysqli_fetch_array($sqlOption)){
                    $option = $results['fullname'];?>
                    <?php echo "<option value='$option'>$option</option>"; ?>
                    <?php
                    }?>
                </select><br>
                    <label for="">Stock on hand:</label>
                    <input type="text" name="stock" value="<?php echo $stock; ?>" readonly><br>
                    <label for="">Quantity <span>/kilogram</span></label>
                    <input id="quantity" type="number" name="quantity" onkeyup="mult()"  required><br>
                    <label for="">Unit Price</label>
                    <input id="price" type="number" name="price"  onkeyup="mult()" value=<?php echo $itemPrice;?> ><br>
                    <label for="">Total Cost</label>
                    <input id="totalPrice" type="" name="total_cost"  READONLY><br><br>
                    <input type="submit" name="addOrder" value="Add Order">
            </form>
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