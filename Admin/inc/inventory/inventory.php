<?php

include '../connection/db-user.php';
include '../../inc/function.php';

//add item
if (isset($_POST['insertItem'])) {
    $item_number = mysqli_real_escape_string($conn, check($_POST['item_number']));
    $item_name = mysqli_real_escape_string($conn, check($_POST['item_name']));
    $category_name = mysqli_real_escape_string($conn, check($_POST['category_name']));
    $discount = mysqli_real_escape_string($conn, check($_POST['discount']));
    $stock = mysqli_real_escape_string($conn, check($_POST['quantity']));
    $unit_price = mysqli_real_escape_string($conn, check($_POST['price']));
    $status = mysqli_real_escape_string($conn, check($_POST['status']));
    $filename = $_FILES['fishIMG']['name'];
    $tmp_name = $_FILES['fishIMG']['tmp_name'];
    $folder = '../../inc/inventory/fishIMG/' . $filename;

    if (!move_uploaded_file($tmp_name, $folder)) {
        die();
    }

    if ($item_name != '' and $category_name != '' and $discount != '' and $stock != '' and $unit_price != '' and $status != '' and $filename != '') {
        $duplicate = mysqli_query($conn, "SELECT * FROM fish_items WHERE item_name = '$item_name';");
        if (mysqli_num_rows($duplicate) > 0) {
            $_SESSION['duplicate'] = 'Item name  already exist!';
        }else{
            $insert = mysqli_query($conn, "INSERT INTO fish_items VALUES(null, autoInc(), '$item_name', '$category_name', '$discount', '$stock', '$unit_price', '$status', '$filename', null);");
            if ($insert) {
                $_SESSION['status_added'] = 'Fish item added successfully!';
            }
        }
        
    }else{
        echo "<script>alert('erorr');</script>";
    }
}  

// display items
// Set the number of records to display per page
$per_page = 5;

// Get the current page number from the URL
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Calculate the start index for the current page
$start = ($page - 1) * $per_page;
$item_read = mysqli_query($conn, "SELECT * FROM fish_items LIMIT $start, $per_page;");
// Create the pagination links
$prev_page = $page - 1;
$next_page = $page + 1;

//get random number
$random =array();
for ($i = 0; $i < 1 ; $i++){
    $random[] = rand();
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
                <a id="inventory"class= "active"  href="../..inventory.php"><span ><img src="../../icons/icons8-in-inventory-30.png" alt=""></span><h3 >Inventory</h3></a>
                <a id="purchase" class= "noot-active" href="../../inc/purchase/purchase.php"><span ><img src="../../icons/icons8-purchase-order-32.png" alt=""></span><h3>Purchase</h3></a>
                <a id="orders" class= "not-active" href="../../inc/orders/orders.php"><span ><img src="../../icons/icons8-purchase-order-30.png" alt=""></span><h3>Orders</h3></a>
                <a id="sale" class= "not-active" href="../../inc/sale/sale.php"><span ><img src="../../icons/icons8-purchase-64.png" alt=""></span><h3>Sale</h3></a>
                <a id="supplier" class= "not-active" href="../../inc/suppliers/supplier.php"><span ><img src="../../icons/icons8-supplier-50.png" alt=""></span><h3>Suppliers</h3></a>
                <a id="customer" class= "not-active" href="../../inc/customer.php"><span ><img src="../../icons/icons8-customers-64.png" alt=""></span><h3>Customers</h3></a>
                <a id="category" class= "not-active" href="../../inc/category/category.php"><span ><img src="../../icons/icons8-diversity-24.png" alt=""></span><h3>Category</h3></a>
                <a id="gallery" class= "not-active" href="../../inc/gallery/gallery.php"><span ><img src="../../icons/icons8-top-view-fish-50.png" alt=""></span><h3>Gallery</h3></a>
                <a href="../../logout.php"><span ><img src="../../icons/icons8-logout-24.png" alt=""></span><h3 class='danger'>Logout</h3></a>
            </div>
    </aside>
<main>
<!-- Inventory -->
<div class="inventory">

        <h1>Inventory</h1>
        <a href="../index.php/#"></a>

        <div class="date">
        <?php
        // Return current date from the remote server
        $date = date('m-d-Y');
        echo $date;
        ?>
        </div>
        <div class="table">
            <h2>List of products</h2>

            <?php
            if (isset($_SESSION['duplicate'])) {
            ?>
                <div class="item-alert">
                    <?php echo $_SESSION['duplicate']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" id="x"></button>
                </div>
            <?php
            unset($_SESSION['duplicate']);
            }
            ?>
            <?php
            if (isset($_SESSION['status_added'])) {
            ?>
                <div class="item-alert">
                    <?php echo $_SESSION['status_added']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" id="x"></button>
                </div>
            <?php
            unset($_SESSION['status_added']);
            }
            ?>
            <?php
            if (isset($_SESSION['inventory-del'])) {
            ?>
                <div class="item-alert">
                    <?php echo $_SESSION['inventory-del']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" id="x"></button>
                </div>
            <?php
            unset($_SESSION['inventory-del']);
            }
            ?>

            <table>
                <thead>
                    <tr>
                        <th>Fish ID</th>
                        <th>Item Number</th>
                        <th>Item Name</th>
                        <th>Category</th>
                        <th>Distcount %</th>
                        <th>Stock Onhand /kg</th>
                        <th>Unit Price per/kg</th>
                        <th>Status</th>
                        <th colspan="2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($item_result = mysqli_fetch_assoc($item_read)) { ?>
                    <tr>
                        <td><?php echo $item_result['fish_id']; ?></td>
                        <td><?php echo $item_result['item_number']; ?></td>
                        <td><?php echo $item_result['item_name']; ?></td>
                        <td><?php echo $item_result['category_name']; ?></td>
                        <td><?php echo $item_result['discount']; ?><span>%</span></td>
                        <td><?php echo $item_result['stock']; ?><span>kls</span></td>
                        <td><span>Php</span> <span><?php echo $item_result['unit_price']; ?></span></td>
                        <td><?php echo $item_result['status']; ?></td>
                        <td class="success"><a  href="inventoryEdit.php?id=<?php echo $item_result['fish_id']; ?>"  ><img src="../../icons/icons8-pencil-24.png" alt="edit"></a></td>
                        <td class="danger" ><a href="inventoryDelete.php?del=<?php echo $item_result['fish_id']; ?>" ><img src="../../icons/icons8-remove-48.png" alt="delete"></a></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="pagination">
                <?php 
                echo "<a class='pagination-link' href='?page=$prev_page'><img src='../../icons/icons8-prev-100.png' alt='prev'></a><a class='pagination-link' href='?page=$next_page'><img src='../../icons/icons8-forward-80.png' alt='forward'></a> "; 
                ?>
                </div>
            <a href="#"><label class="btn" for="modal-2"><img src="../../icons/icons8-add-new-50.png" alt=""> Add Item</label></a>
        </div>

    <input class="modal-state" id="modal-2" type="checkbox" />
    <div class="modal">
        <label class="modal__bg" for="modal-2"></label>
        <div class="modal__inner">
            <label class="modal__close" for="modal-2"></label>

            <form action="" enctype="multipart/form-data" method="POST">
                <label for="">Item Name</label><br>
                <input type="text" name="item_name" placeholder="" required><br>
                    <label for="">Item Number</label><br>
                    <input type="text" name="item_number" value= "" READONLY><br>
                <label for="stat">Status:</label><br>
                    <select id="stat" name="status">
                        <option value="active"> active</option>
                        <option value="disabled"> disabled</option>
                    </select><br>

                <label for="cat">Select Category:</label><br>
                <?php 
                echo "<select class='classic' name='category_name'>"; 
                $queryOption = "SELECT * FROM category";
                $sqlOption = mysqli_query($conn, $queryOption); 
                ?>
                <option value='select item name'>Select Category:</option>
                <?php while($results = mysqli_fetch_array($sqlOption)){
                    $option = $results['categoryName'];?>
                    <?php echo "<option value='$option'>$option</option>"; ?>
                    <?php
                }echo "</select>";
                ?><br>

                <input type="file" name="fishIMG"  required><br>
                <label for="">Description</label><br>
                <textarea name="itemdescription" id="" cols="30" rows="10" ></textarea><br>
                <label for="cat">Select Discount %:</label><br>
                <select class='classic' name='discount'>"; 
                            <option value='.0'>0</option>
                            <option value='0.10'>0.10</option>
                            <option value='0.10'>0.20</option>
                            <option value='0.10'>0.30</option>
                            <option value='0.10'>0.40</option>
                            <option value='0.10'>0.50</option>
                </select><br>
                <label for="">Quantity</label><br>
                <input type="number" name="quantity" placeholder="" ><br>
                <label for="">Unit Price</label><br>
                <input type="number" name="price" placeholder="" required><br><br>
                <input type="submit" name="insertItem" value="submit"><br>
            </form>

        </div>
    </div>

</div>
<!--End of Inventory -->
</main>
    <script src="../../js/index.js"></script>
</body>
</html>