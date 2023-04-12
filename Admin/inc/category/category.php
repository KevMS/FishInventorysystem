<?php

include '../connection/db-user.php';
include '../../inc/function.php';

//add item
if(isset($_POST['submitCat'])){
    $category = ($_POST['category']);
    $description = ($_POST['description']);
    $filename = $_FILES['catIMG']['name'];
    $tmp_name = $_FILES['catIMG']['tmp_name'];
    $folder = '../../inc/category/categoryIMG/' . $filename;

    if (!move_uploaded_file($tmp_name, $folder)){
        die();
    }

    if($category != ''){
        $duplicate = mysqli_query($conn, "SELECT * FROM category WHERE categoryName = '$category';");
        if(!mysqli_num_rows($duplicate) > 0){
            $insert = mysqli_query($conn, "INSERT INTO category VALUES(null, '$category', '$description', '$filename');");
            if ($insert > 0) {
                $_SESSION['category-added'] = 'Category Added Successfully!';
                header("Location: category.php");
            }
        }else {
            $_SESSION['category-error'] = 'Category Name already exist!';
            
        }

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
                <a id="supplier" class= "not-active" href="../../inc/suppliers/supplier.php"><span ><img src="../../icons/icons8-supplier-50.png" alt=""></span><h3>Suppliers</h3></a>
                <a id="customer" class= "not-active" href="../../inc/customer/customer.php"><span ><img src="../../icons/icons8-customers-64.png" alt=""></span><h3>Customers</h3></a>
                <a id="category" class= "active" href="../../inc/category/category.php"><span ><img src="../../icons/icons8-diversity-24.png" alt=""></span><h3>Category</h3></a>
                <a id="gallery" class= "not-active" href="../../inc/gallery/gallery.php"><span ><img src="../../icons/icons8-top-view-fish-50.png" alt=""></span><h3>Gallery</h3></a>
                <a href="../../logout.php"><span ><img src="../../icons/icons8-logout-24.png" alt=""></span><h3 class='danger'>Logout</h3></a>
            </div>
    </aside>
<main>
<!-- category -->
<div class="category">
    <h1>Category</h1>
    <div class="date">
    <?php
        // Return current date from the remote server
        $date = date('m-d-Y');
        echo $date;
        ?>
    </div>

    <div class="table">
        <h2>Category Details</h2>
        <table>
            <thead>
                <tr>
                    <th>Category ID</th>
                    <th>Category Name</th>
                    <th>Description</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <?php

         $catlist = mysqli_query($conn, "SELECT * FROM category;");
            if($catlist->num_rows > 0){
            while($cat = $catlist->fetch_assoc()){
            ?>
            <tbody>
                <tr>
                    <td><?php echo $cat['catID'] ?></td>
                    <td><?php echo $cat['categoryName']; ?></td>
                    <td><?php echo $cat['description']; ?></td>
                    <td><a href="./editCategory.php?edit=<?php echo $cat['catID'];?>"><img src="../../icons/icons8-pencil-24.png" alt="edit"></a></td>
                    <td><a  href="./deleteCategory.php?del=<?php echo $cat['catID']; ?>"><img src="../../icons/icons8-remove-48.png" alt="delete"></a></td>
                </tr>
            </tbody>
            <?php }
            }else{ ?>
            <?php } ?>
        </table>
        <a href="#"><label class="btn" for="modal-2"><img src="../../icons/icons8-add-new-50.png" alt="">Add Category</label></a>
    </div>

    <input class="modal-state" id="modal-2" type="checkbox" />
    <div class="modal">
        <label class="modal__bg" for="modal-2"></label>
        <div class="modal__inner">
            <label class="modal__close" for="modal-2"></label>
            <form action="" enctype="multipart/form-data" method="POST">
                <label for="">Category Name</label>
                <input type="text" name="category" placeholder="Category Name:" required><br>
                <input type="file" name="catIMG"  required><br>
                <label for="">Description</label>
                <textarea name="description" id="" cols="30" rows="10" ></textarea><br>
                <input type="submit" name="submitCat" value="submit">
        </form>
        </div>
    </div>
</div>
</main>
    <script src="../../js/index.js"></script>
</body>
</html>