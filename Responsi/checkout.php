<?php
    session_start();
    require 'config.php';

    if(!isset($_SESSION["pelanggan"])){
        echo "<script>alert('Silahkan Login Dahulu');</script>";
        echo "<script>location='login.php';</script>";
    }
    
?>
<!DOCTYPE html>
<html>
<head>
    <title>Document</title>
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
</head>
<body>
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
                    </tr>
                </thead>
                <tbody>
                    <?php $totalbelanja=0; ?>
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
                    </tr>
                    <?php $nomor++; ?>
                    <?php $totalbelanja+=$subtotal; ?>
                    <?php endforeach ?>
                </tbody>
                <tfoot>
                    <th colspan="4">Total Belanja</th>
                    <th>Rp. <?php echo number_format($totalbelanja)?></th>
                </tfoot>
      </table>                           
      <form method="post">
          <div class="row">
              <div class="col-md-4">
                  <div class="form-group">
                    <input type="text" readonly value="<?php echo $_SESSION["pelanggan"]["nama_pelanggan"]?>" class="form-control">
                  </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                    <input type="text" readonly value="<?php echo $_SESSION["pelanggan"]["telepon_pelanggan"]?>" class="form-control">
                </div>
              </div>
              <div class="col-md-4">
                  <select class="form-control" name="id_ongkir">
                      <option>Pilih Pengiriman</option>
                      <?php 
                        $ambil = $koneksi->query("SELECT * FROM ongkir");
                        while($ongkir = $ambil->fetch_assoc()){
                      ?>
                      <option value="<?php echo $ongkir["id_ongkir"] ?>">
                        <?php echo $ongkir['nama_kota'] ?> -
                        Rp. <?php echo number_format($ongkir['tarif']) ?>
                     </option>
                      <?php } ?>
                  </select>
              </div>
          </div>
          <input type="submit" class="btn btn-primary" name="checkout" value="CHECKOUT">
      </form>

      <?php
        if(isset($_POST['checkout'])){
            $id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];
            $id_ongkir = $_POST["id_ongkir"];
            $tanggal_pembelian = date("Y-m-d");

            $ambil = $koneksi->query("SELECT * FROM ongkir WHERE id_ongkir='$id_ongkir'");
            $arrayongkir = $ambil->fetch_assoc();
            $tarif = $arrayongkir['tarif'];

            $total_pembelian = $totalbelanja+$tarif;

            $koneksi->query("INSERT INTO pembelian 
            (id_pelanggan,id_ongkir,tanggal_pembelian,total_pembelian)
            VALUES('$id_pelanggan','$id_ongkir','$tanggal_pembelian','$total_pembelian')");

            $id_pembelian_barusan = $koneksi->insert_id;

            foreach($_SESSION['keranjang'] as $id_produk=>$jumlah){
                $koneksi->query("INSERT INTO pembelian_produk (id_pembelian, id_produk, jumlah) 
                VALUES ('$id_pembelian_barusan', '$id_produk', '$jumlah')");
            }

            unset($_SESSION["keranjang"]);

            echo "<script>alert('Pembelian Sukses');</script>";
            echo "<script>location='nota.php?id=$id_pembelian_barusan';</script>";
        }
      ?>
  </div>
</section>
</body>
</html>