<?php

@include 'koneksi.php';

if (isset($_POST['update_update_btn'])) {
   $update_nilai = $_POST['update_jumlah'];
   $update_id = $_POST['update_jumlah_id'];
   $update_quantity_query = mysqli_query($conn, "UPDATE `cart` SET jumlah = '$update_nilai' WHERE id = '$update_id'");
   if ($update_quantity_query) {
      header('location:cart.php');
   };
};

if (isset($_GET['remove'])) {
   $remove_id = $_GET['remove'];
   mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$remove_id'");
   header('location:cart.php');
};

if (isset($_GET['delete_all'])) {
   mysqli_query($conn, "DELETE FROM `cart`");
   header('location:cart.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>shopping cart</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <?php include 'header.php'; ?>

   <div class="container">

      <section class="shopping-cart">

         <h1 class="heading">Transaksi Berbelanja</h1>

         <table>

            <thead>
               <th>Gambar</th>
               <th>Nama</th>
               <th>Harga</th>
               <th>Jumlah</th>
               <th>Total Harga</th>
               <th>Aksi</th>
            </thead>

            <tbody>

               <?php

               $select_cart = mysqli_query($conn, "SELECT * FROM `cart`");
               $grand_total = 0;
               if (mysqli_num_rows($select_cart) > 0) {
                  while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                     $sub_total = $fetch_cart['harga'] * $fetch_cart['jumlah'];
               ?>

                     <tr>
                        <td><img src="uploaded_img/<?php echo $fetch_cart['gambar']; ?>" height="100" alt=""></td>
                        <td><?php echo $fetch_cart['nama']; ?></td>
                        <td>Rp<?php echo number_format($fetch_cart['harga']); ?></td>
                        <td>
                           <form action="" method="post">
                              <input type="hidden" name="update_jumlah_id" value="<?php echo $fetch_cart['id']; ?>">
                              <input type="number" name="update_jumlah" min="1" value="<?php echo $fetch_cart['jumlah']; ?>">
                              <input type="submit" value="edit" name="update_update_btn">
                           </form>
                        </td>
                        <td>Rp<?php echo number_format($sub_total); ?></td>
                        <td><a href="cart.php?remove=<?php echo $fetch_cart['id']; ?>" onclick="return confirm('Hapus menu dari pesanan?')" class="delete-btn"> <i class="fas fa-trash"></i> Hapus</a></td>
                     </tr>
               <?php
                     $grand_total += $sub_total;
                  };
               };
               ?>
               <tr class="table-bottom">
                  <td><a href="products.php" class="option-btn" style="margin-top: 0;">Kembali</a></td>
                  <td colspan="3">Total</td>
                  <td>Rp<?php echo $grand_total; ?></td>
                  <td><a href="cart.php?delete_all" onclick="return confirm('Anda yakin ingin menghapus semua?');" class="delete-btn"> <i class="fas fa-trash"></i> Hapus Semua </a></td>
               </tr>

            </tbody>

         </table>

         <div class="checkout-btn">
            <a href="checkout.php" class="btn <?= ($grand_total > 1) ? '' : 'disabled'; ?>">Proses Checkout</a>
         </div>

      </section>

   </div>

   <!-- custom js file link  -->
   <script src="js/script.js"></script>

</body>

</html>