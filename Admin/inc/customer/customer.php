<?php

include '../connection/db-user.php';
include '../../inc/function.php';

// supplier create
if (isset($_POST['add-customer'])) {
    $customer_name = mysqli_real_escape_string($conn, check($_POST['customer_name']));
    $email = mysqli_real_escape_string($conn, check($_POST['email']));
    $phone = mysqli_real_escape_string($conn, check($_POST['phone']));
    $address = mysqli_real_escape_string($conn, check($_POST['address']));

    if ($customer_name != '' and $email != '' and $phone != '' and $address != '') {
        $customer_duplicate = mysqli_query($conn, "SELECT * FROM customer WHERE  fullname = '$customer_name' OR email = '$email' OR phone = '$phone';");
        if (!mysqli_num_rows($customer_duplicate) > 0) {
            $customer_insert = mysqli_query($conn, "INSERT INTO customer VALUES(null, '$customer_name', '$email', '$phone', '$address', null);");
            if ($customer_duplicate > 0) {
                $_SESSION['status-added'] = 'customer Added Successfully!';
                header('Location: ./customer.php');
            }
        } else {
            $_SESSION['status-err'] = 'Name or Email or Phone has Already Exist!';
            header('Location: ./customer.php');
        }
    }
}

$customer_read = mysqli_query($conn, "SELECT * FROM customer;");

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
                <a id="supplier" class= "not-active" href="../../inc/suppliers/supplier.php"><span ><img src="../../icons/icons8-supplier-50.png" alt=""></span><h3>Suppliers</h3></a>
                <a id="customer" class= "active" href="../../inc/customer/customer.php"><span ><img src="../../icons/icons8-customers-64.png" alt=""></span><h3>Customers</h3></a>
                <a id="category" class= "not-active" href="../../inc/category/category.php"><span ><img src="../../icons/icons8-diversity-24.png" alt=""></span><h3>Category</h3></a>
                <a id="gallery" class= "not-active" href="../../inc/gallery/gallery.php"><span ><img src="../../icons/icons8-top-view-fish-50.png" alt=""></span><h3>Gallery</h3></a>
                <a href="../../logout.php"><span ><img src="../../icons/icons8-logout-24.png" alt=""></span><h3 class='danger'>Logout</h3></a>
            </div>
    </aside>
<main>
<!-- customer -->
<div class="customer">
    <h1>Customer</h1>
    <div class="date">
    <?php
        // Return current date from the remote server
        $date = date('m-d-Y');
        echo $date;
        ?>
    </div>

    <div class="table">
        <div class="customer-details">
        <h2>Customer List</h2>

        <?php
        if (isset($_SESSION['status-added'])) {
        ?>
        <div class="alert-added alert">
            <p><?php echo $_SESSION['status-added']; ?></p>
            <!-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" id="x"></button> -->
        </div>
        <?php
        unset($_SESSION['status-added']);
        }
        ?>
        <?php
        if (isset($_SESSION['customer-del'])) {
        ?>
        <div class="alert-del alert">
            <p><?php echo $_SESSION['customer-del']; ?></p>
            <!-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" id="x"></button> -->
        </div>
        <?php
        unset($_SESSION['customer-del']);
        }
        ?>
        <?php
        if (isset($_SESSION['status-updated'])) {
        ?>
        <div class="alert-updated alert">
            <p><?php echo $_SESSION['status-updated']; ?></p>
            <!-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" id="x"></button> -->
        </div>
        <?php
        unset($_SESSION['status-updated']);
        }
        ?>

        <table >
        <tr>
            <th>CUSTOMER ID</th>
            <th>FULLNAME</th>
            <th>EMAIL</th>
            <th>PHONE</th>
            <th>ADDRESS</th>
            <th colspan="2">ACTION</th>
        </tr>
        <?php
        while ($customer_result = mysqli_fetch_assoc($customer_read)) {
        ?>
        <tr>
            <td><?php echo $customer_result['customer_id'] ?></td>
            <td><?php echo $customer_result['fullname'] ?></td>
            <td><?php echo $customer_result['email'] ?></td>
            <td><?php echo $customer_result['phone'] ?></td>
            <td><?php echo $customer_result['address'] ?></td>
            <td><a href="./editCustomer.php?edit=<?php echo $customer_result['customer_id'];?>"><img src="../../icons/icons8-pencil-24.png" alt="edit"></a></td>
            <td><a href="./deleteCustomer.php?del=<?php echo $customer_result['customer_id'];?>"><img src="../../icons/icons8-remove-48.png" alt="delete"></a></td>                                                                                                                                                
        </tr>
        <?php
        }
        ?>
        </table>

        <a href="#"><label class="btn" for="modal-2"><img src="../../icons/icons8-add-new-50.png" alt="">Add Customer</label></a>
        </div>
    </div>
    <input class="modal-state" id="modal-2" type="checkbox" />
    <div class="modal">
        <label class="modal__bg" for="modal-2"></label>
        <div class="modal__inner">
            <label class="modal__close" for="modal-2"></label>

    <form action="" method="POST">
        <label for="">Fullname</label>
        <input type="text" name="customer_name" placeholder="Fullname" required> <br>
        <label for="">Email</label>
        <input type="text" name="email" placeholder="Email" required> <br>
        <label for="">Phone</label>
        <input type="text" name="phone" maxlength="11" placeholder="Phone no." required> <br>
        <label for="">Address</label>
        <input type="text" name="address" placeholder="Address" required> <br><br>
        <input type="submit" name="add-customer" value="+Add">
    </form>

        </div>
    </div>
</div>
</main>
</div>
    <script src="../../js/index.js"></script>
</body>
</html>
