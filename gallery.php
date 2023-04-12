<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fish Inventory</title>
    <link rel="stylesheet" href="./styles.css">
</head>

<body>

    <header id="header">
        <div class="logo">
            <a href="./index.php">
                <img src="./img/fish-logo.png" alt="fishers-logo" width="49" height="45">

                <h2>Fishers</h2>
            </a>
        </div>

        <div class="nav-links">
            <a href="index.php">Home</a>
            <a href="#about-us">About us</a>
            <a href="./gallery.php">Gallery</a>

            <div class="dropdown">
                <button class="dropbtn">
                    <label for="fish" id="fish">Fish</label>

                    <img src="./img/down.png" alt="down-logo" id="fish" width="10" height="10">
                </button>

                <div class="dropdown-content">
                    <a href="./index.php#fish-categories">Categories</a>

                    <a href="./index.php#fish-products">Fish Products</a>
                </div>
            </div>
        </div>
    </header>

    <main>
    
        <section class="fish-products" id="fish-products">
            <div class="fish-products-title">
                <img src="./img/stick-fish.png" alt="fish" title="Don't tickle me!">

                <h2>Fish Gallery</h2>
            </div>

            <div class="fish-products-cont">
                <div class="fish-products-content">

                <?php include './db.php'; $read = mysqli_query($conn, "SELECT * FROM gallery;"); 
                    while ($result = mysqli_fetch_assoc($read)) 
                    { ?> 
                        <div class="fish-item-cont"> 
                            <div class="fish-item-img"> 
                            <img src="<?php echo './Admin/inc/gallery/img/' . $result['filename']; ?>" alt="<?php echo $result['name']; ?>" width="100%", height="100%"> 
                            </div> 
                        </div> <?php 
                    } ?>

                </div>
            </div>
        </section>

    </main>

    <footer>
        <p>Copyright Fish Inventory System 2022-<?php echo date("Y"); ?></p>
    </footer>

    <script src="./script.js"></script>
</body>

</html>