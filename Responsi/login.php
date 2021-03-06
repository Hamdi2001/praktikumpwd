<?php 
    session_start();
    require 'config.php';
?>

<?php
    // define variables and set to empty values
    $emailErr = "";
    $email ="";

   if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["email"])) {
        }else {
            $email = test_input($_POST["email"]);
            // check if e-mail address is well-formed
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Email tidak sesuai format"; 
            }
        }
   }

    function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
   }
?>
<!DOCTYPE html>
<html>
<head>
    <style>
        .error {color: #FF0000;}
    </style>

    <title>LOGIN PELANGGAN</title>
    <link href="admin_baru/css/sb-admin-2.min.css" rel="stylesheet">

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
    <div class="container">
        
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Login Pelanggan</h3>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password">
                                <label>Captcha : </label>
                                <img src='captcha.php'/>
                                <input name='captcha_code' type='text' class="form-control">
                            </div>
                            <button class="btn btn-primary" name="login">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<?php
    if(isset($_POST['login'])){
        
        $email = $_POST["email"];
        $password = $_POST["password"];
        $ambil = $koneksi -> query("SELECT * FROM pelanggan WHERE email_pelanggan='$email'AND password_pelanggan='$password'");

        $akun = $ambil -> num_rows;
        if ($_POST["captcha_code"] == $_SESSION["captcha_code"]) {
            if($akun==1){
                $akun = $ambil->fetch_assoc();
                $_SESSION["pelanggan"] = $akun;
                echo "<script>alert('Anda Sukses Login')</script>";
                echo "<script>location='index.php';</script>";
            }
            else{
                echo "<script>alert('Email atau password bermasalah')</script>";
                echo "<script>location='login.php';</script>";
            }
            mysqli_close($koneksi); 
        } 
        else {
            echo "<script>alert('Captcha kosong atau captcha salah')</script>";
            echo "<script>location='login.php';</script>"; 
        } 
} 
    
?>
</body>
</html>