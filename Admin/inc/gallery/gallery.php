<?php include('../../inc/connection/db-user.php');?>
<?php

$msg = "";
$message = "Image uploaded successfully!";
// If upload button is clicked ...
if (isset($_POST['upload'])) {
    $name = $_POST['item_name'];
    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    $folder = "./img/" . $filename;

    // Get all the submitted data from the form
    $sql = "INSERT INTO gallery (filename,name) VALUES ('$filename','$name')";

    // Execute query
    mysqli_query($conn, $sql);

    // Now let's move the uploaded image into the folder: image
    if (move_uploaded_file($tempname, $folder)) {
        echo "<script>alert('$message');</script>";
        echo '<script>window.location.href="./gallery.php"</script>';

    } else {
        echo "<h3>  Failed to upload image!</h3>";
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
                <a id="inventory"class= "not-active"  href="../..inventory.php"><span ><img src="../../icons/icons8-in-inventory-30.png" alt=""></span><h3 >Inventory</h3></a>
                <a id="purchase" class= "not-active" href="../../inc/purchase/purchase.php"><span ><img src="../../icons/icons8-purchase-order-32.png" alt=""></span><h3>Purchase</h3></a>
                <a id="orders" class= "not-active" href="../../inc/orders/orders.php"><span ><img src="../../icons/icons8-purchase-order-30.png" alt=""></span><h3>Orders</h3></a>
                <a id="sale" class= "not-active" href="../../inc/sale/sale.php"><span ><img src="../../icons/icons8-purchase-64.png" alt=""></span><h3>Sale</h3></a>
                <a id="supplier" class= "not-active" href="../../inc/suppliers/supplier.php"><span ><img src="../../icons/icons8-supplier-50.png" alt=""></span><h3>Suppliers</h3></a>
                <a id="customer" class= "not-active" href="../../inc/customer/customer.php"><span ><img src="../../icons/icons8-customers-64.png" alt=""></span><h3>Customers</h3></a>
                <a id="category" class= "not-active" href="../../inc/category/category.php"><span ><img src="../../icons/icons8-diversity-24.png" alt=""></span><h3>Category</h3></a>
                <a id="gallery" class= "active" href="../../inc/gallery/gallery.php"><span ><img src="../../icons/icons8-top-view-fish-50.png" alt=""></span><h3>Gallery</h3></a>
                <a href="../../logout.php"><span ><img src="../../icons/icons8-logout-24.png" alt=""></span><h3 class='danger'>Logout</h3></a>
            </div>
    </aside>
<main>
<!-- supplier -->
<div class="Gallery">
    <h1>Gallery</h1>
    <div class="date">
    <?php
        // Return current date from the remote server
        $date = date('m-d-Y');
        echo $date;
        ?>
    </div>
    <div class="table"><a href="#"><label class="btn" for="modal-2"><img src="../../icons/icons8-add-new-50.png" alt="">Add Photo</label></a></div>
        <div class="gal-img">
        <?php
        
// Include the database configuration file



// Set the number of records to display per page
$per_page = 6;

// Get the current page number from the URL
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Calculate the start index for the current page
$start = ($page - 1) * $per_page;
// Get images from the database
$query = $conn->query("SELECT * FROM gallery ORDER BY id DESC LIMIT $start, $per_page;");
// Create the pagination links
$prev_page = $page - 1;
$next_page = $page + 1;
if($query->num_rows > 0){
    while($row = $query->fetch_assoc()){
        $imageURL = './img/'.$row["filename"];
?>  
    <img src="<?php echo $imageURL; ?>" alt="" />
<?php }
}else{ ?>
    <p>No image(s) found...</p>
    
<?php } ?>
</div>

<input class="modal-state" id="modal-2" type="checkbox" />
    <div class="modal">
        <label class="modal__bg" for="modal-2"></label>
        <div class="modal__inner">
            <label class="modal__close" for="modal-2"></label>
            <form method="POST" action="" enctype="multipart/form-data">  
                <h1 style="text-align:center;">ADD PHOTO</h1>   
            <input type="file" name="uploadfile" value="" ><br>
            <label for="">Image Name</label>
            <input type="text" name="item_name"><br><br>
            <input  type="submit" name="upload" value='submit'>
        </form>
        </div>
    </div>
</main>
</div>
<script >
            const menu = document.querySelector("#menu-btn");
            const closes = document.querySelector("#close-btn");
            const aside = document.querySelector("aside");
            const logo = document.querySelector("#logo");

            menu.addEventListener('click', ()=>{
                if(getComputedStyle(aside).display == 'none'){
                aside.style.display = 'block';
                logo.style.display = 'block';}})

            closes.addEventListener('click', ()=>{
                if(getComputedStyle(aside).display == 'block'){
                aside.style.display = 'none';
                logo.style.display = 'none';}})
    </script>
</body>
</html>