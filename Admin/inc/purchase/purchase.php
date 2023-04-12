<?php

include '../connection/db-user.php';
include '../../inc/function.php';

// Set the number of records to display per page
$per_page = 5;

// Get the current page number from the URL
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Calculate the start index for the current page
$start = ($page - 1) * $per_page;
$purchase_read = mysqli_query($conn, "SELECT * FROM purchase LIMIT $start, $per_page;");
// Create the pagination links
$prev_page = $page - 1;
$next_page = $page + 1;

//item read
$item_read2 = mysqli_query($conn, "SELECT * FROM fish_items WHERE stock <= '10';");

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
<div class="purchase">

        <h1>Purchase</h1>
        <a href="../index.php/#"></a>

        <div class="date">
        <?php
        // Return current date from the remote server
        $date = date('m-d-Y');
        echo $date;
        ?>
        </div>
        <div class="table">
            <h2>Items To purchase</h2>
            <table>
                <thead>
                    <tr>
                        <th>Item ID</th>
                        <th>Item Number</th>
                        <th>Item Name</th>
                        <th>Stock on hand</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($toBuy = mysqli_fetch_assoc($item_read2)) { ?>
                    <tr>
                        <td><?php echo $toBuy['fish_id']; ?></td>
                        <td><?php echo $toBuy['item_number']; ?></td>
                        <td><?php echo $toBuy['item_name']; ?></td>
                        <td><?php echo $toBuy['stock']; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table><br><br>
            <h2>List of purchase</h2>

            <?php
            if (isset($_SESSION['purchase-added'])) {
            ?>
                <div class="item-alert">
                    <?php echo $_SESSION['purchase-added']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" id="x"></button>
                </div>
            <?php
            unset($_SESSION['purchase-added']);
            }
            ?>
            <?php
            if (isset($_SESSION['Purchase-error'])) {
            ?>
                <div class="item-alert">
                    <?php echo $_SESSION['Purchase-error']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" id="x"></button>
                </div>
            <?php
            unset($_SESSION['Purchase-error']);
            }
            ?>
            <?php
            if (isset($_SESSION['purchase-updated'] )) {
            ?>
                <div class="item-alert">
                    <?php echo $_SESSION['purchase-updated'] ; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" id="x"></button>
                </div>
            <?php
            unset($_SESSION['purchase-updated'] );
            }
            ?>
            <?php
            if (isset($_SESSION['Purchase-update_error'] )) {
            ?>
                <div class="item-alert">
                    <?php echo $_SESSION['Purchase-update_error'] ; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" id="x"></button>
                </div>
            <?php
            unset($_SESSION['Purchase-update_error'] );
            }
            ?>
            <?php
            if (isset($_SESSION['inventory-del'] )) {
            ?>
                <div class="item-alert">
                    <?php echo $_SESSION['inventory-del'] ; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" id="x"></button>
                </div>
            <?php
            unset($_SESSION['inventory-del'] );
            }
            ?>

            <table>
                <thead>
                    <tr>
                        <th>Purchase ID</th>
                        <th>Item Number</th>
                        <th>Item Name</th>
                        <th>Quantity</th>
                        <th>Unit Price per/kg</th>
                        <th>Total Cost</th>
                        <th>Supplier Name</th>
                        <th>Purchase Date</th>
                        <th colspan="2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($item_result = mysqli_fetch_assoc($purchase_read)) { ?>
                    <tr>
                        <td><?php echo $item_result['purchase_id']; ?></td>
                        <td><?php echo $item_result['item_number']; ?></td>
                        <td><?php echo $item_result['item_name']; ?></td>
                        <td><?php echo $item_result['quantity']; ?></td>
                        <td><?php echo $item_result['unit_price']; ?></td>
                        <td><?php echo $item_result['total_cost']; ?></td>
                        <td><?php echo $item_result['supplier_name']; ?></td>
                        <td><?php echo $item_result['puchase_date']; ?></td>
                        <td class="success"><a  href="editPurchase.php?id=<?php echo $item_result['purchase_id']; ?>"  ><img src="../../icons/icons8-pencil-24.png" alt="edit"></a></td>
                        <td class="danger" ><a href="deletePurchase.php?del=<?php echo $item_result['purchase_id']; ?>" ><img src="../../icons/icons8-remove-48.png" alt="delete"></a></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
             <div class="pagination">
                <?php 
                echo "<a class='pagination-link' href='?page=$prev_page'><img src='../../icons/icons8-prev-100.png' alt='prev'></a><a class='pagination-link' href='?page=$next_page'><img src='../../icons/icons8-forward-80.png' alt='forward'></a> "; 
                ?>
                </div>
            <a href="#"><label class="btn" for="modal-2"><img src="../../icons/icons8-add-new-50.png" alt="">Add Purchase</label></a>
        </div>

    <input class="modal-state" id="modal-2" type="checkbox" />
    <div class="modal" >
        <label class="modal__bg" for="modal-2"></label>
        <div class="modal__inner" style="height:25vh;">
            <label class="modal__close" for="modal-2"></label>

            <form action="./addPurchase.php" enctype="multipart/form-data" method="POST">
            <label for="">Select Item Name</label><br>
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