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
            <a href="#">Home</a>
            <a href="#about-us">About us</a>
            <a href="./gallery.php">Gallery</a>

            <div class="dropdown">
                <button class="dropbtn">
                    <label for="fish" id="fish">Fish</label>

                    <img src="./img/down.png" alt="down-logo" id="fish" width="10" height="10">
                </button>

                <div class="dropdown-content">
                    <a href="#fish-categories">Categories</a>

                    <a href="#fish-products">Fish Products</a>
                </div>
            </div>
        </div>
    </header>

    <main>
        <section class="website-title">
            <h2>Fish Inventory System</h2>

            <p>View latest prices of fish online</p>

            <a href="#fish-products">
                <button>View Fish</button>
            </a>
        </section>

        <section class="about-us" id="about-us">
            <div class="about-us-title">
                <img src="./img/stick-fish.png" alt="fish" title="Don't tickle me!">

                <h2>About Us</h2>
            </div>

            <div class="about-pre-content">
                <div class="about-sec1">
                    <div class="text">
                        <p>Our project is about fish inventory system. This project is design for small fish business.
                            The purpose of this system is to help the business track and manage its inventory more effeciently and effectively.
                        </p>

                        
                    </div>

                    <div class="pic">
                        <img src="./img/about-us-pre-pic.jpg" class="about-pre-img" alt="big catch fish">
                    </div>
                </div>

                <div class="about-scrolling-wrapper">
                    <div class="about-btn-left" onclick="scrolll()">
                        <img src="./img/left-arrow.png" alt="left" width="30" height="40">
                    </div>

                    <div class="about-cover">
                        <div class="about-scroll-images">
                            <div><img src="./img/f1.jpg" alt="fish"></div>
                            <div><img src="./img/f2.jpg" alt="fish"></div>
                            <div><img src="./img/f3.jpg" alt="fish"></div>
                            <div><img src="./img/f4.jpg" alt="fish"></div>
                            <div><img src="./img/f5.jpg" alt="fish"></div>
                            <div><img src="./img/f6.jpg" alt="fish"></div>
                            <div><img src="./img/f7.jpg" alt="fish"></div>
                        </div>
                    </div>

                    <div class="about-btn-right" onclick="scrollr()">
                        <img src="./img/right-arrow.png" alt="right" width="30" height="40">
                    </div>
                </div>
            </div>
        </section>

        <section class="fish-categories" id="fish-categories">
            <div class="fish-categories-title">
                <img src="./img/stick-fish.png" alt="fish" title="Don't tickle me!">

                <h2>Fish Categories</h2>
            </div>

            <div class="fish-categories-cont">
                <div class="fish-categories-content">
                    <div class="category raw">
                        <a href="#">
                            <h2>Whole Fish</h2>
                        </a>
                    </div>

                    <div class="category dried">
                        <a href="#">
                            <h2>Dried Fish</h2>
                        </a>
                    </div>

                    <div class="category canned">
                        <a href="#">
                            <h2>Canned Fish</h2>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section class="fish-products" id="fish-products">
            <div class="fish-products-title">
                <img src="./img/stick-fish.png" alt="fish" title="Don't tickle me!">

                <h2>Fish Products</h2>
            </div>

            <div class="fish-products-cont">
                <div class="fish-products-content">

                <?php include './db.php'; $read = mysqli_query($conn, "SELECT * FROM fish_items;"); 
                    while ($result = mysqli_fetch_assoc($read)) 
                    { ?> 
                        <div class="fish-item-cont"> 
                            <div class="fish-item-img"> 
                            <img src="<?php echo './Admin/inc/inventory/fishIMG/' . $result['image']; ?>" alt="<?php echo $result['item_name']; ?>" width="100%", height="100%"> 
                            </div> 
                        <div class="fish-item-name-price"> 
                            <p class="fish-name"><?php echo $result['item_name']; ?></p>
                            <p class="fish-price">&#8369;<?php echo $result['unit_price']; ?></p> 
                        </div> 
                        </div> <?php 
                    } ?>

                </div>
            </div>
        </section>

        <section class="our-team" id="our-team">
            <div class="our-team-title">
                <img src="./img/stick-fish.png" alt="fish" title="Don't tickle me!">

                <h2>Our Team</h2>
            </div>

            <div class="our-team-cont">
                <div class="our-team-content">
                    <div class="prof-cont">
                        <div class="profile">
                            <img src="./img/kevin.jpg" alt="kevin">
                        </div>

                       <div class="name">
                            <h1>Kevin Saludaga</h1>
                            <p>Full Stack</p>
                        </div>
                    </div>

                    <div class="prof-cont">
                        <div class="profile">
                            <img src="./img/Allester.jpg" alt="Allester">
                        </div>

                        <div class="name">
                            <h1>Allester Corton</h1>
                            <p>Full Stack</p>
                        </div>
                    </div>

                    <div class="prof-cont">
                        <div class="profile">
                            <img src="./img/elena_.jpg" alt="Elena">
                        </div>

                        <div class="name">
                            <h1>Ma. Elena Niegas</h1>
                            <p>Web Designer</p>
                        </div>
                    </div>
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