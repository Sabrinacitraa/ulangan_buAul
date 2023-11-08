<?php 
session_start();  
include("koneksi.php") ;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css" integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous">
    <link rel="stylesheet" href="css/home.css">
</head>
<body>

<?php
      
      $select_rows = mysqli_query($conn, "SELECT * FROM `cart`") or die('query failed');
      $row_count = mysqli_num_rows($select_rows);

      ?>
    
<nav>
        <!-- <div class="logo"> -->
            <img src="images/logo.png" width=100px>
        <!-- </div> -->
        <ul class="navigation">
            <li><a href="home.php">Home</a></li>
            <li><a href="user.php">Menu</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="logout.php">Logout</a></li>
            <a href="cart.php" class="cart"><i class="fa-solid fa-cart-shopping" style="color: #ffffff;"></i> <span><?php echo $row_count; ?></a>
            <div id="menu-btn" class="fas fa-bars"></div>
    </nav>
         

    <section class="home" id="home">
        <div class="isi">
            <h1 style="color:#865439; font-size:50px;"> Welcome to Djayantie !!</h1>
            <h1>Welcome to</h1><h1><b>Beverages And Desserts</b></h1>
            <p><b>Chill and fresh your day. Cause happiness is waiting for you ! </p>
            <a href="#footer" class="coffee"><button class="learn">Learn More</button></a>
        </div>
    </section>

    <div class="section">
        <div class="about">
            <div class="content-section">
                <div class="title">
                    <h2>Our Cafe</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur ex eum quasi. Deserunt natus, mollitia similique sit impedit quos dignissimos dolores, accusantium, itaque officiis non voluptatum. Earum itaque architecto pariatur porro labore illo maiores, velit vel quaerat voluptate id in, veritatis expedita quis, officia dicta assumenda quas consectetur quia incidunt delectus! Corporis aliquid veniam cum, dolorem qui natus voluptatibus corrupti.</p>
                </div>
            </div>
            <div class="img-section">
                <img src="image/home.jpg" alt="">
            </div>
        </div>
    </div>
    

    <section class="content" id="menu">
        <div class="menu">
            <h1><b>Menu</b></h1>
        </div>
        <div class="container">
            <main class="grid">
                <article>
                    <img src="image/bgbeverages.jpg" width="400px" height="300px" alt="">
                    <div class="content-text">
                        <h2>Beverages</h2>
                        <p>Menu for beverages</p>
                        <a href="beverages.php" class="coffee"><button class="learn">Check Here ! </button></a>
                    </div>
                </article>
                <article>
                    <img src="image/bgdesserts.jpg" width="400px" height="300px" alt="">
                    <div class="content-text">
                        <h2>Desserts</h2>
                        <p>Menu for desserts</p>
                        <a href="desserts.php" class="coffee"><button class="learn">Check Here ! </button></a>

                    </div>
                </article>
        </main>
    </div>
</section>

</body>
</html>