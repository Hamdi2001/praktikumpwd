<?php
    session_start();

    require 'config.php';

    if(empty($_SESSION["keranjang"]) OR !isset($_SESSION["keranjang"])){
        echo "<script>alert('Keranjang Kosong');</script>";
        echo "<script>location='index.php';</script>";
    }
?>

<!DOCTYPE html>
<html>
<head>
        <title>keranjang Belanja</title>
         <!-- Bootstrap core CSS -->
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="css/shop-homepage.css" rel="stylesheet">

        <!-- Logo daro Font Awesome -->
        <link rel="stylesheet" href="fontawesome-free/css/all.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a href="index.php"><h3><i class="fas fa-building mx-2"></i></h3></a>
      <a class="navbar-brand" href="index.php">Toko Online</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
          </li>
          <?php if(isset($_SESSION["pelanggan"])): ?>
        <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
         </li>
        <?php else: ?>
            <li class="nav-item">
                <a class="nav-link" href="login.php">Login</a>
            </li>
        <?php endif ?>
        </ul>
      </div>
    </div>
  </nav>

<section class="konten">
  <div class="container">
    <h1>Keranjang Belanja</h1>
    <hr>
    <table style="" class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Produk</th>
                        <th>Harga</th>   
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $nomor = 1;
                        foreach($_SESSION["keranjang"] as $id_produk => $jumlah): ?>
                    <?php 
                        $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk = '$id_produk'");
                        $tampil = $ambil->fetch_assoc();
                        $subtotal = $tampil["harga_produk"]*$jumlah;
                    ?>
                    <tr>
                        <td><?php echo $nomor?></td>
                        <td><?php echo $tampil["nama_produk"]; ?></td>
                        <td>Rp. <?php echo number_format($tampil["harga_produk"]); ?></td>
                        <td><?php echo $jumlah?></td>
                        <td>Rp. <?php echo number_format($subtotal); ?></td>
                        <td>
                            <a href="hapuskeranjang.php?id=<?php echo $id_produk ?>" class="btn btn-danger btn-xs">Hapus</a>
                        </td>
                    </tr>
                    <?php $nomor++; ?>
                    <?php endforeach ?>
                </tbody>
      </table>
      <a href="index.php" class="btn btn-default">Kembali Belanja</a>
      <a href="checkout.php" class="btn btn-primary">checkout</a>
  </div>
</section>
</body>
</html>