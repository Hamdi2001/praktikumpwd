<?php
    require 'config.php';
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
        <h2>Detail Pembelian</h2>
            <?php 
                $ambil=$koneksi->query("SELECT * FROM pembelian JOIN pelanggan
                    ON pembelian.id_pelanggan=pelanggan.id_pelanggan
                    WHERE pembelian.id_pembelian='$_GET[id]'");

                $detail=$ambil->fetch_assoc();
            ?>
            <strong><?php echo $detail['nama_pelanggan']; ?></strong><br>
            <p>
                <?php echo $detail['telepon_pelanggan'];?><br>
                <?php echo $detail['email_pelanggan']; ?>
            </p>

            <p>
                Tanggal : <?php echo $detail['tanggal_pembelian']; ?><br>
                Total   : <?php echo $detail['total_pembelian']; ?> 
            </p>

            <div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $nomor=1; ?>
                    <?php $ambil=$koneksi->query("SELECT * FROM pembelian_produk JOIN produk ON pembelian_produk.id_produk=produk.id_produk
                        WHERE pembelian_produk.id_pembelian='$_GET[id]'"); ?>
                    <?php while($tampil=$ambil->fetch_assoc()){ ?>
                    <tr>
                        <td><?php echo $nomor; ?></td>
                        <td><?php echo $tampil['nama_produk']; ?></td>
                        <td><?php echo $tampil['harga_produk']; ?></td>
                        <td><?php echo $tampil['jumlah']; ?></td>
                        <td>
                            <?php echo $tampil['harga_produk']*$tampil['jumlah']; ?>
                        </td>
                    </tr>
                    <?php } ?>  
                    <?php $nomor++; ?>
                </tbody>
            </table>
            <div class="row">
                <div class="cool-md-7">
                    <div class="alert alert-info">
                        <p>
                            Silahkan Melakukan Pembayaran Rp. <?php echo number_format($detail['total_pembelian']); ?>
                            <br>
                            <strong>BANK BNI 123-456001-7891 a/n. Athaariq Hamdi Bayyu Aji</strong>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>