
<?php
include './inc/connection/db-user.php';

if (isset($_GET['id'])) {
    $id= $_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM admin WHERE id = '$id';");
    $result2 = mysqli_query($conn, "SELECT * FROM accesslog WHERE userID = '$id'  ORDER BY id DESC LIMIT 10;");
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <!--STYLESHEET-->
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <div class="top">
        <div class="logo">
            <img src="./icons/fishlogo.png" alt="">
            <h1>FISH <span class="danger">INVENTORY SYSTEM</span></h1>

            <button id="menu-btn">
                <span class="material-symbols-sharp">menu</span>
            </button>
        </div>
        <div class="profile">
            <div class="admin-name">
                <div class="admin">
                    <br>
                    <span class="hovertext" data-hover= "Edit Admin"><a href="admin-update.php"><b class="text-muted">Admin</b></a></span>
                </div>
            </div>
            <div class="profile-photo">
                <a class="hovertext" href="admin-update.php" data-hover= "Edit Admin"><img src="./icons/admin-logo.jpg" alt="pic"></a>
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
            <a id="dashboard" class= "active" href="index.php"><span ><img  src="./icons/icons8-dashboard-layout-24.png" alt=""></span><h3>Dashboard</h3></a>
            <a id="inventory"class= "not-active"  href="./inc/inventory/inventory.php"><span ><img src="./icons/icons8-in-inventory-30.png" alt=""></span><h3 >Inventory</h3></a>
            <a id="purchase" class= "not-active" href="./inc/purchase/purchase.php"><span ><img src="./icons/icons8-purchase-order-32.png" alt=""></span><h3>Purchase</h3></a>
            <a id="orders" class= "not-active" href="./inc/orders/orders.php"><span ><img src="./icons/icons8-purchase-order-30.png" alt=""></span><h3>Orders</h3></a>
            <a id="sale" class= "not-active" href="./inc/sale/sale.php"><span ><img src="./icons/icons8-purchase-64.png" alt=""></span><h3>Sale</h3></a>
            <a id="supplier" class= "not-active" href="./inc/suppliers/supplier.php"><span ><img src="./icons/icons8-supplier-50.png" alt=""></span><h3>Suppliers</h3></a>
            <a id="customer" class= "not-active" href="./inc/customer/customer.php"><span ><img src="./icons/icons8-customers-64.png" alt=""></span><h3>Customers</h3></a>
            <a id="category" class= "not-active" href="./inc/category/category.php"><span ><img src="./icons/icons8-diversity-24.png" alt=""></span><h3>Category</h3></a>
            <a id="gallery" class= "not-active" href="./inc/gallery/gallery.php"><span ><img src="./icons/icons8-top-view-fish-50.png" alt=""></span><h3>Gallery</h3></a>
            <a href="logout.php"><span ><img src="./icons/icons8-logout-24.png" alt=""></span><h3 class='danger'>Logout</h3></a>
        </div>
    </aside>

    <main>
<div class="admin-view">
    
    <div class="table">
    <label class="btn" style="padding:10px;"><a href="./admin-update.php">Back</a></label>
        <?php while ($item_result = mysqli_fetch_assoc($result)) { ?>
            <h2> Recent Access of '<?php echo $item_result['username']; ?>'</h2>
            <?php } ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>timeLogin</th>
                        <th>timeLogout</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($item_result = mysqli_fetch_assoc($result2)) { ?>
                    <tr>
                        <td><?php echo $item_result['ID']; ?></td>
                        <td><?php echo $item_result['timeLogin']; ?></td>
                        <td><?php echo $item_result['timeLogout']; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            
        </div>

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