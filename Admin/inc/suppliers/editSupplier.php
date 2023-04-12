<?php

include('../../inc/connection/db-user.php');


if (isset($_POST['update-supplier'])) {
    $updateId = $_POST['updateId'];
    $updateSuppliername = $_POST['updateSuppliername'];
    $updateEmail = $_POST['updateEmail'];
    $updatePhone = $_POST['updatePhone'];
    $updateAddress = $_POST['updateAddress'];

    $update = mysqli_query($conn, "UPDATE supplier SET supplier_name = '$updateSuppliername', email = '$updateEmail', phone = '$updatePhone', address = '$updateAddress' WHERE supplier_id = '$updateId' ;");
    if ($update > 0) {
        $_SESSION['status-updated'] = ' Updated Successfully';
        echo "<script>alert('updated succesfully)</script>";
        header('Location: ./supplier.php');
    }
}


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
                <a id="orders" class= "not-active" href="../../inc/orders/orders.php"><span ><img src="../../icons/icons8-purchase-order-30.png" alt=""></span><h3>Orders</h3></a>
                <a id="sale" class= "not-active" href="../../inc/sale/sale.php"><span ><img src="../../icons/icons8-purchase-64.png" alt=""></span><h3>Sale</h3></a>
                <a id="supplier" class= "active" href="../../inc/suppliers/supplier.php"><span ><img src="../../icons/icons8-supplier-50.png" alt=""></span><h3>Suppliers</h3></a>
                <a id="customer" class= "not-active" href="../../inc/customer.php"><span ><img src="../../icons/icons8-customers-64.png" alt=""></span><h3>Customers</h3></a>
                <a id="category" class= "not-active" href="../../inc/category/category.php"><span ><img src="../../icons/icons8-diversity-24.png" alt=""></span><h3>Category</h3></a>
                <a id="gallery" class= "not-active" href="../../inc/gallery/gallery.php"><span ><img src="../../icons/icons8-top-view-fish-50.png" alt=""></span><h3>Gallery</h3></a>
                <a href="../../logout.php"><span ><img src="../../icons/icons8-logout-24.png" alt=""></span><h3 class='danger'>Logout</h3></a>
            </div>
    </aside>
<main>
    <?php

    if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $sql = "SELECT * FROM supplier WHERE supplier_id = '$id' ";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $editId = $row['supplier_id'];
            $editSuppliername = $row['supplier_name'];
            $editEmail = $row['email'];
            $editPhone = $row['phone'];
            $editAddress = $row['address'];
        }
        ?>

    <label class="btn" style="padding:10px;"><a href="supplier.php">Back</a></label>
    <h1 style="text-align:center;"><?php echo $editSuppliername;?> Details</h1>
    <div style="display:grid; grid-template-columns: 35rem auto ; margin-left:3rem; " class="inventory">
            <form action="#" enctype="multipart/form-data" method="POST">
            <input type="hidden" name="updateId" value = "<?php echo $editId; ?>">
            <label for="">Supplier name</label>
            <input type="text" name="updateSuppliername" value="<?php echo strval($editSuppliername); ?>" > <br>
            <label for="">Email</label>
            <input type="text" name="updateEmail" value="<?php echo strval($editEmail); ?>" > <br>
            <label for="">Phone</label>
            <input type="text" name="updatePhone" maxlength="11" value="<?php echo strval($editPhone); ?>" > <br>
            <label for="">Address</label>
            <input type="text" name="updateAddress" value="<?php echo strval($editAddress); ?>" > <br><br>
            <input type="submit" name="update-supplier" value="Update">
            </form>

    </div>
    </div>
    <?php
    }
}
?>

</main>
</div>
    <script src="../js/index.js"></script>
</body>
</html>