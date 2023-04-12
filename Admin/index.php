<?php

include('./inc/connection/db-user.php');

if (!empty($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $result = mysqli_query($conn, "SELECT * FROM admin WHERE id = '$id';");
    $row = mysqli_fetch_assoc($result);
} else {
    header('Location: ./login.php');
}

// read
$read = mysqli_query($conn, "SELECT * FROM admin LIMIT 1;");
// Set the number of records to display per page
$per_page = 5;

// Get the current page number from the URL
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Calculate the start index for the current page
$start = ($page - 1) * $per_page;
$order_read = mysqli_query($conn, "SELECT * FROM orders LIMIT $start, $per_page;");
// Create the pagination links
$prev_page = $page - 1;
$next_page = $page + 1;

//Total Sales Read
$sale_Read = mysqli_query($conn, 'SELECT SUM(total_cost) AS value_sum FROM sales'); 
$row = mysqli_fetch_assoc($sale_Read); 
$total_sales = $row['value_sum'];
$total_sale = number_format($total_sales,0);

//Total expenses Read
$expense_Read = mysqli_query($conn, 'SELECT SUM(total_cost) AS value_sum FROM purchase'); 
$row = mysqli_fetch_assoc($expense_Read); 
$total_expenses = $row['value_sum'];
$total_expense = number_format($total_expenses,0);
//Get total income
$total_incomes = $total_sales - $total_expenses ;
$total_income = number_format($total_incomes,0);
//Get total Stock
$stockread = mysqli_query($conn, 'SELECT SUM(stock) AS value_sum FROM fish_items'); 
$row = mysqli_fetch_assoc($stockread); 
$total_stock = $row['value_sum'];
//Get total Stock Sold
$stockread2 = mysqli_query($conn, 'SELECT SUM(quantity) AS value_sum FROM sales'); 
$row = mysqli_fetch_assoc($stockread2); 
$total_stock_sold = $row['value_sum'];


?>
<?php require_once './inc/connection/pie.php'; ?>

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
        <div class="dashboard">
            <h1>Main Dashboard</h1>

            <div class="date">
            <?php
                // Return current date from the remote server
                $date = date('m-d-Y');
                echo $date;
            ?>
            </div>

            <div class="insights">
            
                <!----SALES-->

                <div class="sales">
                    <span class="material-symbols-outlined">analytics</span>
                    <div class="middle">
                        <div class="left">
                            <a href="./inc/sale/sale.php"><h3>Total Sales</h3></a>
                            <h1>&#8369;<?php echo $total_sale; ?></h1>
                        </div>
                        <div class="rigth">
                        </div>
                    </div>
                </div>

                <!----EXPENSES-->
                
                <div class="expenses">
                    <span class="material-symbols-outlined">bar_chart</span>

                    <div class="middle">
                        <div class="left">
                        <a href="./inc/purchase/purchase.php"><h3>Total Expenses</h3></a>
                            <h1>&#8369;<?php echo $total_expense; ?></h1>
                        </div>
                    </div>

                </div>

                <!----INCOME-->

                <div class="income">
                    <span class="material-symbols-outlined">stacked_line_chart</span>
                    <div class="middle">
                        <div class="left">
                        <h3>Total Income</h3>
                            <h1>&#8369;<?php echo $total_income; ?></h1>
                        </div>
                    </div>
                </div>
            

            <!----Total of all Fish Stock kls-->

                <div class="stock">
                <span class="material-symbols-sharp">inventory</span>
                    <div class="middle">
                        <div class="left">
                            <a href="./inc/inventory/inventory.php"></a><h3>Total Stock</h3></a>
                            <h1><?php echo $total_stock; ?></h1>
                        </div>
                    </div>
                    
                </div>
            

            <!----Total of all Fish Stock sold kls-->

            <div class="stock-sold">    
            <span class="material-symbols-sharp">show_chart</span>
                    <div class="middle">
                        <div class="left">
                        <a href="./inc/sale/sale.php"><h3>Total Stock Sold</h3></a>
                            <h1><?php echo $total_stock_sold; ?></h1>
                        </div>
                    </div>
                    
                </div>
            </div>


            <!-----------END OF INSIGHTS----------->

        
            <div class="table">
                <h2>Recent Orders</h2>

                <table>
                    <thead>
                        <tr>
                            <th>Customer</th>
                            <th>Item Name</th>
                            <th>Status</th>
                            <th>Order Date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while ($order = mysqli_fetch_assoc($order_read)) { ?>
                    <tr>
                        <td><?php echo $order['customer_name']; ?></td>
                        <td><?php echo $order['item_name']; ?></td>
                        <td><?php echo $order['status']; ?></td>
                        <td><?php echo $order['order_date']; ?></td>
                        <td class="success"><a  href="./inc/orders/orders.php" ><img src='./icons/icons8-more-details-16.png' alt='details'></a></td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <div class="pagination">
                <?php 
                echo "<a class='pagination-link' href='?page=$prev_page'><img src='./icons/icons8-prev-100.png' alt='prev'></a><a class='pagination-link' href='?page=$next_page'><img src='./icons/icons8-forward-80.png' alt='forward'></a> "; 
                ?>
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
