<?php

include '../connection/db-user.php';
include '../../inc/function.php';

// display items
// Set the number of records to display per page
$per_page = 5;

// Get the current page number from the URL
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Calculate the start index for the current page
$start = ($page - 1) * $per_page;
// Create the pagination links
$prev_page = $page - 1;
$next_page = $page + 1;
$sale_read = mysqli_query($conn, "SELECT * FROM sales LIMIT $start, $per_page;");
$queryOption = "SELECT * FROM orders WHERE status = 'pending' ";
$sql = mysqli_query($conn, $queryOption); 
$sqlOption = mysqli_query($conn, $queryOption); 


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
                <a id="sale" class= "active" href="../../inc/sale/sale.php"><span ><img src="../../icons/icons8-purchase-64.png" alt=""></span><h3>Sale</h3></a>
                <a id="supplier" class= "not-active" href="../../inc/suppliers/supplier.php"><span ><img src="../../icons/icons8-supplier-50.png" alt=""></span><h3>Suppliers</h3></a>
                <a id="customer" class= "not-active" href="../../inc/customer/customer.php"><span ><img src="../../icons/icons8-customers-64.png" alt=""></span><h3>Customers</h3></a>
                <a id="category" class= "not-active" href="../../inc/category/category.php"><span ><img src="../../icons/icons8-diversity-24.png" alt=""></span><h3>Category</h3></a>
                <a id="gallery" class= "not-active" href="../../inc/gallery/gallery.php"><span ><img src="../../icons/icons8-top-view-fish-50.png" alt=""></span><h3>Gallery</h3></a>
                <a href="../../logout.php"><span ><img src="../../icons/icons8-logout-24.png" alt=""></span><h3 class='danger'>Logout</h3></a>
            </div>
    </aside>
<main>
<!-- sale -->
<div class="sale">

        <h1>Sale</h1>
        <a href="../index.php/#"></a>

        <div class="date">
        <?php
        // Return current date from the remote server
        $date = date('m-d-Y');
        echo $date;
        ?>
        </div>
        <div class="table">
            <table>
                <tr>
                    <th style="width:100px;">Pending Order's ID</th>
                    <?php 
            while($results = mysqli_fetch_array($sql)){
                    $order_id = $results['order_id'];?>
                    <td style="background:#dce1eb;"><?php echo $order_id; ?></td>
                    <?php
            }
                ?>
                </tr>
            </table>
            <a href="#"><label class="btn" for="modal-2"><img src="../../icons/icons8-add-new-50.png" alt="">Add Sale Orders</label></a>
        </div>
        <div class="table">
            <h2>List of sale</h2>

            <?php
            if (isset($_SESSION['Sale-added'])) {
            ?>
                <div class="item-alert">
                    <?php echo $_SESSION['Sale-added']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" id="x"></button>
                </div>
            <?php
            unset($_SESSION['Sale-added']);
            }
            ?>
            <?php
            if (isset($_SESSION['Sale-error'])) {
            ?>
                <div class="item-alert">
                    <?php echo $_SESSION['Sale-error']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" id="x"></button>
                </div>
            <?php
            unset($_SESSION['Sale-error']);
            }
            ?>
            <?php
            if (isset($_SESSION['sale-update'])) {
            ?>
                <div class="item-alert">
                    <?php echo $_SESSION['sale-update']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" id="x"></button>
                </div>
            <?php
            unset($_SESSION['sale-update']);
            }
            ?>
        <table>
                <thead>
                    <tr>
                        <th>Sale ID</th>
                        <th>Customer Name</th>
                        <th>Item Number</th>
                        <th>Item Name</th>
                        <th>Unit Price per/kg</th>
                        <th>Discount %</th>
                        <th>Quantity/kg</th>
                        <th>Total Price</th>
                        <th>Sale Date</th>
                        <th colspan="2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($order = mysqli_fetch_assoc($sale_read)) { ?>
                    <tr>
                        <td><?php echo $order['sale_id']; ?></td>
                        <td><?php echo $order['customer_name']; ?></td>
                        <td><?php echo $order['item_number']; ?></td>
                        <td><?php echo $order['item_name']; ?></td>
                        <td><?php echo $order['unit_cost']; ?></td>
                        <td><?php echo $order['discount']; ?></td>
                        <td><?php echo $order['quantity']; ?></td>
                        <td><?php echo $order['total_cost']; ?></td>
                        <td><?php echo $order['sale_date']; ?></td>
                        <td class="success"><a  href="removeSale.php?id=<?php echo $order['sale_id']; ?>" ><img src="../../icons/icons8-remove-48.png" alt="delete"></a></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="pagination">
                <?php 
                echo "<a class='pagination-link' href='?page=$prev_page'><img src='../../icons/icons8-prev-100.png' alt='prev'></a><a class='pagination-link' href='?page=$next_page'><img src='../../icons/icons8-forward-80.png' alt='forward'></a> "; 
                ?>
                </div>
            <a href="#"><label class="btn" for="modal-3"><img src="../../icons/icons8-add-new-50.png" alt="">Add Walk-in Sales</label></a>
        </div>

    <input class="modal-state" id="modal-2" type="checkbox" />
    <div class="modal" >
        <label class="modal__bg" for="modal-2"></label>
        <div class="modal__inner" style="height:25vh;">
            <label class="modal__close" for="modal-2"></label>

            <form action="./addsale.php" enctype="multipart/form-data" method="POST">
            <label for="">Select Order ID</label>
                <?php 
                echo "<select class='classic' name='order_id'>"; 
                ?>
                <?php 
                while($results = mysqli_fetch_array($sqlOption)){
                    $option = $results['order_id'];?>
                    <?php echo "<option value='$option'>$option</option>"; ?>
                    <?php
                }echo "</select>";
                ?><br><br>
                <input type="submit" name="selectedOrder" value="submit">
            </form>

        </div>
    </div>
    <input class="modal-state" id="modal-3" type="checkbox" />
    <div class="modal" >
        <label class="modal__bg" for="modal-3"></label>
        <div class="modal__inner" style="height:25vh;">
            <label class="modal__close" for="modal-3"></label>

            <form action="./addWalkinSale.php" enctype="multipart/form-data" method="POST">
            <label for="">Select Item Name</label>
                <?php 
                echo "<select class='classic' name='item_name'>"; 
                $queryOption = "SELECT * FROM fish_items";
                $sqlOption = mysqli_query($conn, $queryOption); 
                ?>
                <?php 
                while($results = mysqli_fetch_array($sqlOption)){
                    $option = $results['item_name'];?>
                    <?php echo "<option value='$option'>$option</option>"; ?>
                    <?php
                }echo "</select>";
                ?><br><br>
                <input type="submit" name="selectedItem" value="submit">
            </form>

        </div>
    </div>

</div>
<!--End of Inventory -->
</main>
    <script src="../../js/index.js"></script>
</body>
</html>