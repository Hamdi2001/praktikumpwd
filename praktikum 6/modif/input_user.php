<?php
    session_start();
    include "koneksi.php";
    $id_user = $_POST['id_user'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $pass = md5($_POST['password']);

    if ($_POST["captcha_code"] == $_SESSION["captcha_code"]) {
        $sql = "INSERT INTO user(id_user,password, nama_lengkap, email) VALUES ('$id_user', '$pass', '$nama','$email')";
        $query=mysqli_query($con, $sql);
        mysqli_close($con);
        header('location:tampil_user.php');
        } 
        else {
        echo "<center>Input gagal! Captcha tidak sesuai<br>";
        echo "<a href=form_login.php><b>ULANGI LAGI</b></a></center>"; 
    }

    
?>