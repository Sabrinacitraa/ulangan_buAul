<?php

@include 'koneksi.php';

if (isset($_POST['order_btn'])) {

   $nama = $_POST['nama'];
   $nomor = $_POST['nomor'];
   $email = $_POST['email'];
   $method = $_POST['method'];
   $flat = $_POST['flat'];
   $street = $_POST['street'];
   $kota = $_POST['kota'];
   $state = $_POST['state'];
   $country = $_POST['country'];
   $pin_code = $_POST['pin_code'];

   $cart_query = mysqli_query($conn, "SELECT * FROM `cart`");
   $total_price = 0;
   if (mysqli_num_rows($cart_query) > 0) {
      while ($product_item = mysqli_fetch_assoc($cart_query)) {
         $product_name[] = $product_item['nama'] . ' (' . $product_item['jumlah'] . ') ';
         $product_price = number_format($product_item['harga'] * $product_item['jumlah']);
         $total_price += $product_price;
      };
   };

   $total_product = implode(', ', $product_name);
   $detail_query = mysqli_query($conn, "INSERT INTO `order`(nama, nomor, email, method, flat, street, kota, state, country, pin_code, total_products, total_price) VALUES('$nama','$nomor','$email','$method','$flat','$street','$kota','$state','$country','$pin_code','$total_product','$total_price')") or die('query failed');

   if ($cart_query && $detail_query) {
      echo "
      <div class='order-message-container'>
      <div class='message-container'>
         <h3>thank you for shopping!</h3>
         <div class='order-detail'>
            <span>" . $total_product . "</span>
            <span class='total'> total : Rp" . $total_price . "  </span>
         </div>
         <div class='customer-details'>
            <p> Nama anda : <span>" . $nama . "</span> </p>
            <p> Nomor anda : <span>" . $nomor . "</span> </p>
            <p> Email anda : <span>" . $email . "</span> </p>
            <p> Alamat anda : <span>" . $flat . ", " . $street . ", " . $kota . ", " . $state . ", " . $country . " - " . $pin_code . "</span> </p>
            <p> Pembayaran: <span>" . $method . "</span> </p>
            <p>(*Bayar ketika menu sudah datang*)</p>
         </div>
            <a href='products.php' class='btn'>Lanjutkan Berbelanja</a>
         </div>
      </div>
      ";
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <?php include 'header.php'; ?>

   <div class="container">

      <section class="checkout-form">

         <h1 class="heading">Lengkapi Orderanmu</h1>

         <form action="" method="post">

            <div class="display-order">
               <?php
               $select_cart = mysqli_query($conn, "SELECT * FROM `cart`");
               $grand_total = 0;

               if (mysqli_num_rows($select_cart) > 0) {
                  while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                     $total_price = $fetch_cart['harga'] * $fetch_cart['jumlah'];
                     // $sub_total = $fetch_cart['harga'] * $fetch_cart['jumlah'];
                     // $grand_total += $total_price;
                     $grand_total += $total_price;
               ?>
                     <span><?= $fetch_cart['nama']; ?>(<?= $fetch_cart['jumlah']; ?>)</span>
               <?php
                  }
               } else {
                  echo "<div class='display-order'><span>your cart is empty!</span></div>";
               }
               ?>
               <span class="grand-total"> Total Bayar : Rp<?= $grand_total; ?> </span>
            </div>

            <div class="flex">
               <div class="inputBox">
                  <span>Nama Anda</span>
                  <input type="text" placeholder="Masukkan nama anda" name="nama" required>
               </div>
               <div class="inputBox">
                  <span>Nomor Anda</span>
                  <input type="number" placeholder="Masukkan nomor anda" name="nomor" required>
               </div>
               <div class="inputBox">
                  <span>Email Anda</span>
                  <input type="email" placeholder="Masukkan email anda" name="email" required>
               </div>
               <div class="inputBox">
                  <span>Pembayaran</span>
                  <select name="method">
                     <option value="Tunai" selected>Tunai</option>
                     <option value="Qris">Qris</option>
                     <option value="Dana">Dana</option>
                  </select>
               </div>
               <div class="inputBox">
                  <span>Alamat Rumah</span>
                  <input type="text" placeholder="Masukkan alamat rumah anda" name="flat" required>
               </div>
               <div class="inputBox">
                  <span>Jalan Rumah</span>
                  <input type="text" placeholder="Masukkan jalan rumah anda" name="street" required>
               </div>
               <div class="inputBox">
                  <span>Kota</span>
                  <input type="text" placeholder="Masukkan kota anda" name="kota" required>
               </div>
               <div class="inputBox">
                  <span>Provinsi</span>
                  <input type="text" placeholder="Masukkan provinsi anda" name="state" required>
               </div>
               <div class="inputBox">
                  <span>Negara</span>
                  <input type="text" placeholder="Masukkan negara anda" name="country" required>
               </div>
               <div class="inputBox">
                  <span>Code Pin</span>
                  <input type="text" placeholder="Masukkan code pin anda" name="pin_code" required>
               </div>
            </div>
            <input type="submit" value="Pesan Sekarang" name="order_btn" class="btn-co">
         </form>

      </section>

   </div>

   <!-- custom js file link  -->
   <script src="js/script.js"></script>

</body>

</html>