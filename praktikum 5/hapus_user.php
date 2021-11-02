<?php
include "koneksi.php";
$id_user = $_GET['id'];
$sql="DELETE FROM user where id_user= '$id_user";
mysqli_query($con, $sql);
mysqli_close($conn);
header('location:tampil_user.php');
?>