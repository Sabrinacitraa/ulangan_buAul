<?php

@include 'koneksi.php';

if(isset($_POST['add_to_cart'])){

   $nama= $_POST['nama'];
   $harga = $_POST['harga'];
   $gambar = $_POST['gambar'];
   $jumlah = 1;

   $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE nama = '$nama'");

   if(mysqli_num_rows($select_cart) > 0){
      $message[] = 'Menu berhasil ditambahkan di keranjang';
   }else{
      $insert_product = mysqli_query($conn, "INSERT INTO `cart`(nama, harga, gambar, jumlah) VALUES('$nama', '$harga', '$gambar', '$jumlah')");
      $message[] = 'Menu berhasil ditambahkan!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>products</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
   
<?php

if(isset($message)){
   foreach($message as $message){
      echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   };
};

?>

<?php include 'header.php'; ?>

<div class="container">

<section class="products">

   <h1 class="heading">Menu yang tersedia</h1>

   <div class="box-container">

      <?php
      
      $select_products = mysqli_query($conn, "SELECT * FROM `produk`");
      if(mysqli_num_rows($select_products) > 0){
         while($fetch_product = mysqli_fetch_assoc($select_products)){
      ?>

      <form action="" method="post">
         <div class="box">
            <img src="uploaded_img/<?php echo $fetch_product['gambar']; ?>" alt="">
            <h3><?php echo $fetch_product['nama']; ?></h3>
            <div class="harga">Rp<?php echo $fetch_product['harga']; ?></div>
            <input type="hidden" name="nama" value="<?php echo $fetch_product['nama']; ?>">
            <input type="hidden" name="harga" value="<?php echo $fetch_product['harga']; ?>">
            <input type="hidden" name="gambar" value="<?php echo $fetch_product['gambar']; ?>">
            <input type="submit" class="btn" value="Tambah ke keranjang" name="add_to_cart">
         </div>
      </form>

      <?php
         };
      };
      ?>

   </div>

</section>

</div>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>