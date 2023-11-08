<?php

include('koneksi.php');

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

<!-- <header class="header"> -->

   <!-- <div class="flex">

      <a href="#" class="logo">Djayantie</a>

      <nav class="navbar">
         <a href="login.php">Login</a>
         <a href="admin.php">Tambah Menu</a>
         <a href="products.php">Menu</a>
      </nav>  -->
      
      <?php
      
      $select_rows = mysqli_query($conn, "SELECT * FROM `cart`") or die('query failed');
      $row_count = mysqli_num_rows($select_rows);

      ?>

      <nav>
        <!-- <div class="logo"> -->
            <img src="images/logo.png" width="100px" >
        <!-- </div> -->
        <ul class="navigation">
            <li><a href="home.php">Home</a></li>
            <li><a href="user.php">Menu</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="logout.php">Logout</a></li>
            <!-- <li><a href="admin.php" >Pesan</a></li> -->
            <!-- <a href="" class="cart"><i class="fa-light fa-cart-shopping"></i></a> -->
            <a href="cart.php" class="cart"><i class="fa-solid fa-cart-shopping" style="color: #ffffff;"></i> <span><?php echo $row_count; ?></a>

    </nav>
         <div id="menu-btn" class="fas fa-bars"></div>

