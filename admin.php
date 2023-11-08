<?php

@include 'koneksi.php';

if(isset($_POST['add_product'])){
   $nama = $_POST['nama'];
   $harga = $_POST['harga'];
   $gambar = $_FILES['gambar']['name'];
   $p_image_tmp_name = $_FILES['gambar']['tmp_name'];
   $p_image_folder = 'uploaded_img/'.$gambar;

   $insert_query = mysqli_query($conn, "INSERT INTO `produk`(nama, harga, gambar) VALUES('$nama', '$harga', '$gambar')") or die('query failed');

   if($insert_query){
      move_uploaded_file($p_image_tmp_name, $p_image_folder);
      $message[] = 'Sukses menambahkan menu!';
   }else{
      $message[] = 'Tidak bisa menambahkan menu!';
   }
};

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_query = mysqli_query($conn, "DELETE FROM `produk` WHERE id = $delete_id ") or die('query failed');
   if($delete_query){
      header('location:admin.php');
      $message[] = 'Menu berhasil dihapus!';
   }else{
      header('location:admin.php');
      $message[] = 'Menu tidak bisa dihapus!';
   };
};

if(isset($_POST['update_product'])){
   $update_id = $_POST['update_id'];
   $update_nama = $_POST['update_nama'];
   $update_harga = $_POST['update_harga'];
   $update_gambar = $_FILES['update_gambar']['name'];
   $update_p_image_tmp_name = $_FILES['update_p_image']['tmp_name'];
   $update_p_image_folder = 'uploaded_img/'.$update_gambar;

   $update_query = mysqli_query($conn, "UPDATE `produk` SET nama = '$update_nama', harga = '$update_harga', gambar = '$update_gambar' WHERE id = '$update_id'");

   if($update_query){
      move_uploaded_file($update_p_image_tmp_name, $update_p_image_folder);
      $message[] = 'Sukses update menu';
      header('location:admin.php');
   }else{
      $message[] = 'produk tidak bisa di update';
      header('location:admin.php');
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin panel</title>

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

<section>

<form action="" method="post" class="add-product-form" enctype="multipart/form-data">
   <h3>Tambahkan Menu Baru</h3>
   <input type="text" name="nama" placeholder="Masukkan nama menu" class="box" required>
   <input type="number" name="harga" min="0" placeholder="Masukkan harga menu" class="box" required>
   <input type="file" name="gambar" accept="image/png, image/jpg, image/jpeg" class="box" required>
   <input type="submit" value="Tambah Menu" name="add_product" class="btn-menu">
</form>

</section>

<section class="display-product-table">

   <table>

      <thead>
         <th>Gambar</th>
         <th>Nama</th>
         <th>Harga</th>
         <th>Aksi</th>
      </thead>

      <tbody>
         <?php
         
            $select_products = mysqli_query($conn, "SELECT * FROM `produk`");
            if(mysqli_num_rows($select_products) > 0){
               while($row = mysqli_fetch_assoc($select_products)){
         ?>

         <tr>
            <td><img src="uploaded_img/<?php echo $row['gambar']; ?>" height="100" alt=""></td>
            <td><?php echo $row['nama']; ?></td>
            <td>Rp<?php echo $row['harga']; ?></td>
            <td>
               <a href="admin.php?delete=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Apakah kamu yakin ingin menghapus ini?');"> <i class="fas fa-trash"></i> Hapus </a>
               <a href="admin.php?edit=<?php echo $row['id']; ?>" class="option-btn"> <i class="fas fa-edit"></i> Edit </a>
            </td>
         </tr>

         <?php
            };    
            }else{
               echo "<div class='empty'>no product added</div>";
            };
         ?>
      </tbody>
   </table>

</section>

<section class="edit-form-container">

   <?php
   
   if(isset($_GET['edit'])){
      $edit_id = $_GET['edit'];
      $edit_query = mysqli_query($conn, "SELECT * FROM `produk` WHERE id = $edit_id");
      if(mysqli_num_rows($edit_query) > 0){
         while($fetch_edit = mysqli_fetch_assoc($edit_query)){
   ?>

   <form action="" method="post" enctype="multipart/form-data">
      <img src="uploaded_img/<?php echo $fetch_edit['image']; ?>" height="200" alt="">
      <input type="hidden" name="update_p_id" value="<?php echo $fetch_edit['id']; ?>">
      <input type="text" class="box" required name="update_nama" value="<?php echo $fetch_edit['nama']; ?>">
      <input type="number" min="0" class="box" required name="update_harga" value="<?php echo $fetch_edit['harga']; ?>">
      <input type="file" class="box" required name="update_gambar" accept="image/png, image/jpg, image/jpeg">
      <input type="submit" value="update menu" name="update_product" class="btn">
      <input type="reset" value="Kembali" id="close-edit" class="option-btn">
   </form>

   <?php
            };
         };
         echo "<script>document.querySelector('.edit-form-container').style.display = 'flex';</script>";
      };
   ?>

</section>

</div>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>