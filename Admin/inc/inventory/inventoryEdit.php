
<?php
include '../connection/db-user.php';
include '../../inc/function.php';

if(isset($_POST['updateItem'])){
    $id = $_POST['id'];
    $item_name = $_POST['item_name'];
    $item_number = $_POST['item_number'];
    $status = $_POST['status'];
    $category_name = $_POST['category_name'];
    $discount = $_POST['discount'];
    $quantity = $_POST['quantity'];
    $unit_price = $_POST['price'];

    $sqli = "UPDATE fish_items SET item_name = '$item_name', item_number = '$item_number', status = '$status', category_name = '$category_name', discount = '$discount', stock = '$quantity', unit_price = '$unit_price' WHERE fish_id = '$id' ";
    $updated = $conn->query($sqli);
    if($updated == TRUE){
        echo '<script>alert("fish_items Succesfully Updated!")</script>';
        echo '<script>window.location.href="./inventory.php"</script>'; 
    }else{
        echo "Error". $sqli. "<br". $conn->error;
    }
}
if(isset($_POST['updatePhoto'])){
    $id = $_POST['id'];
    $filename = $_FILES['fishIMG']['name'];
    $tmp_name = $_FILES['fishIMG']['tmp_name'];
    $folder = '../../inc/inventory/fishIMG/' . $filename;

    $sqli = "UPDATE category SET  image =  '$filename' WHERE catID = '$id';";
    $updated = $conn->query($sqli);
    if($updated == TRUE){
        $_SESSION['Updated'] = "Category Updated Succesfully!";
        header("Location: category.php");
    }else{
        $_SESSION['Up-error'] = "Updated Denied!";
        header("Location: editCategory.php");
    }
    if (!move_uploaded_file($tmp_name, $folder)){
        die();
    }
    
}

if(isset($_GET['id']))
{
    $editID = $_GET['id'];
    $sql = "SELECT * FROM fish_items WHERE fish_id = '$editID'";
    $editResult = $conn->query($sql);
    if($editResult->num_rows>0){
        while($row = $editResult->fetch_assoc()){
            $edit_fish_id = $row['fish_id'];
            $edit_item_number = $row['item_number'];
            $edit_item_name = $row['item_name'];
            $edit_category_name = $row['category_name'];
            $edit_discount = $row['discount'];
            $edit_stock = $row['stock'];
            $edit_unit_price = $row['unit_price'];
            $edit_status = $row['status'];
            $showimg = $row['image'];
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
                <a id="inventory"class= "active"  href="../../inc/inventory/inventory.php"><span ><img src="../../icons/icons8-in-inventory-30.png" alt=""></span><h3 >Inventory</h3></a>
                <a id="purchase" class= "noot-active" href="../../inc/purchase/purchase.php"><span ><img src="../../icons/icons8-purchase-order-32.png" alt=""></span><h3>Purchase</h3></a>
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
    <label class="btn" style="padding:10px;"><a href="inventory.php">Back</a></label>
    <h1 style="text-align:center;">Item Details</h1>
    <div style="display:grid; grid-template-columns: 35rem auto ; margin-left:3rem; " class="inventory">
    <form action="" enctype="multipart/form-data" method="POST">
            <input type="hidden" name="id" value = "<?php echo $editID; ?>">
                <label for="">Item Name</label><br>
                <input type="text" name="item_name" value="<?php echo strval($edit_item_name); ?>"><br>

                <label for="">Item Number</label><br>
                <input type="text" name="item_number" value="<?php echo strval($edit_item_number); ?>" readonly><br>

                <label for="stat">Status:</label><br>
                    <select class='classic' id="stat" name="status" value="<?php echo strval($edit_status); ?>">
                        <option value="active"> active</option>
                        <option value="disabled"> disabled</option>
                    </select><br>

                <label for="cat">Select Category:</label><br>
                <select class='classic' name='category_name'>
                    <option value="<?php echo strval($edit_category_name); ?>"><?php echo strval($edit_category_name); ?></option>
                    <?php 
                $queryOption = "SELECT * FROM category";
                $sqlOption = mysqli_query($conn, $queryOption); 
                ?>
                <?php while($results = mysqli_fetch_array($sqlOption)){
                    $option = $results['categoryName'];?>
                    <?php echo "<option value='$option'>$option</option>"; ?>
                    <?php
                }
                ?>
                </select><br>
                
                <label for="cat">Select Discount %:</label><br>
                <select class='classic' name='discount'>"; 
                            <option value='.0'>0</option>
                            <option value='.10'>.10</option>
                            <option value='.20'>.20</option>
                            <option value='.30'>.30</option>
                            <option value='.40'>.40</option>
                            <option value='.50'>.50</option>
                </select><br>
                <label for="">Quantity</label><br>
                <input type="number" name="quantity" placeholder="" ><br>
                <label for="">Unit Price</label><br>
                <input type="number" name="price" value="<?php echo strval($edit_unit_price); ?>"><br><br>
                <input type="submit" name="updateItem" value="submit">

            </form>
            <div style="margin-left:2rem; margin-top:2rem;" class="img">
                <img style="width:100%; height:60%;" src="./fishIMG/<?php echo $showimg; ?>" alt="">
                <form action="#" enctype="multipart/form-data" method="POST">
                    <input type="hidden" name="id" value = "<?php echo $id; ?>">
                    <input type="file" name="fishIMG"  required><br><br>
                    <input type="submit" name="updatePhoto" value="submit">
                </form>
            </div>
    <?php
}
?>
    </div>
    <!--End of Inventory -->
    </main>
    </div>

    <script src="../../js/index.js"></script>
</body>
</html>