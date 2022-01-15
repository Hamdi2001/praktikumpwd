<?php
  session_start();
  require 'config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <style type="text/css">
    .gambar{
      width: 252px;
      height: 200px;
    }
  </style>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="stylesheet" href="fontawesome-free/css/all.min.css">

  <title>TOKO ONLINE</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/shop-homepage.css" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a href="index.php"><h3><i class="fas fa-building mx-2"></i></h3></a>
      <a class="navbar-brand" href="index.php">Toko Online</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <form class="d-flex" action="pencarian.php" method="get">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="keyword">
        <button class="btn btn-outline-success mx-2 ">Search</button>
      </form>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="keranjang.php"><i class="fas fa-shopping-cart"></i></a>
          </li>
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

  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <div class="col-lg-3">

        <h2 class="my-4">TOKO ONLINE</h2>
        

      </div>
      <!-- /.col-lg-3 -->

      <div class="col-lg-9">

        <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
              <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="First slide">
            </div>
            <div class="carousel-item">
              <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="Second slide">
            </div>
            <div class="carousel-item">
              <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="Third slide">
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>

        <div class="row">

          <?php $ambil = $koneksi->query("SELECT * FROM produk")?>
          <?php while($perproduk = $ambil->fetch_assoc()){?>
          <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
              <img class="gambar" src="photo/<?php echo $perproduk['foto_produk']; ?>">
              <div class="card-body">
                <h4 class="card-title">
                  <a href="#"><?php echo $perproduk['nama_produk']; ?></a>
                </h4>
                <h5>Rp.<?php echo $perproduk['harga_produk']; ?></h5>
                <p class="card-text"><?php echo $perproduk['berat_produk']; ?> Kg</p>
                <p class="card-text"><?php echo $perproduk['deskripsi_produk']; ?></p>
                <a href="beli.php?id=<?php echo $perproduk['id_produk']; ?>" class="btn btn-primary">Beli</a>
              </div>
              
            </div>
          </div>
          <?php }?>

        </div>
        <!-- /.row -->

      </div>
      <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Hamdi 2021</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>