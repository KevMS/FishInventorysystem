
<?php
include './inc/connection/db-user.php';

if (!empty($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $result = mysqli_query($conn, "SELECT * FROM admin WHERE id = '$id';");
    $row = mysqli_fetch_assoc($result);
    $role = $row['role'] ;
    $notadmin = 'user';
    if($role == $notadmin){
        echo '<script>alert("Only Admin can Access!")</script>';
        echo '<script>window.location.href="./index.php"</script>'; 
    }
} else {

    header('Location: ./login.php');
}
$item_read = mysqli_query($conn, "SELECT * FROM admin ;");

if (isset($_POST['add'])) {
    $username_add = $_POST['username-add'];
    $password_add = $_POST['password-add'];
    $role = $_POST['role'];
    
    $update_query = mysqli_query($conn, "INSERT INTO admin VALUES(null,'$username_add','$password_add','$role'); ");
    if ($update_query > 0) {
        echo '<script>alert("New user Added Succesfuly!")</script>';
        echo '<script>window.location.href="./admin-update.php"</script>'; 
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
    <h1>Welcome, <?php echo $_SESSION["username"];?> </h1>
    <div class="date">
    <?php
        // Return current date from the remote server
        $date = date('m-d-Y');
        echo $date;
        ?>
    </div><br>
    <div class="table">
            <h2>Admin & Users Table</h2>

            <?php
        if (isset($_SESSION['status-add'])) {
        ?>
            <div class="alert alert-admin-login">
                <?php echo $_SESSION['status-add']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" id="x"></button>
            </div>
        <?php
        unset($_SESSION['status-add']);
        }
        ?>
         <?php
        if (isset($_SESSION['admin-del'])) {
        ?>
            <div class="alert alert-admin-login">
                <?php echo $_SESSION['admin-del']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" id="x"></button>
            </div>
        <?php
        unset($_SESSION['admin-del']);
        }
        ?>

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th colspan="3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($item_result = mysqli_fetch_assoc($item_read)) { ?>
                    <tr>
                        <td><?php echo $item_result['id']; ?></td>
                        <td><?php echo $item_result['username']; ?></td>
                        <td><?php echo $item_result['role']; ?></td>
                        <td class="success"><a  href="viewlog.php?id=<?php echo $item_result['id']; ?>" >View Log</a></td>
                        <td class="danger" ><a href="admin-del.php?del=<?php echo $item_result['id']; ?>" ><img src="./icons/icons8-remove-48.png" alt="delete"></a></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <a href="#"><label class="btn" for="modal-2"><img src="./icons/icons8-add-new-50.png" alt=""> Add User</label></a>
        </div>

            <input class="modal-state" id="modal-2" type="checkbox" />
        <div class="modal">
            <label class="modal__bg" for="modal-2"></label>
            <div class="modal__inner">
            <label class="modal__close" for="modal-2"></label>
            <form action="" method="POST">
            <label for="username">Username: </label>
            <input type="text" name="username-add" id="username" value=""> <br>
            <label for="password">Password: </label>
            <input type="text" name="password-add" id="password" value=""> <br>
            <label for="role">Select Role: </label>
            <select class='classic' name="role" id="">
                <option value="admin">admin</option>
                <option value="user">user</option>
            </select><br><br>
            <input type="submit" name="add" value="Add">
            </form>

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