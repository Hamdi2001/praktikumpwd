<?php
    include "config.php";

    header('Content-Type: text/xml');
    $query = "SELECT * FROM produk";
    $hasil = mysqli_query($koneksi,$query);
    $jumField = mysqli_num_fields($hasil);
    
    echo "<?xml version='1.0'?>";
    echo "<data>";
    while ($data = mysqli_fetch_array($hasil))
    {
    echo "<produk>";
    echo"<nama_produk>",$data['nama_produk'],"</nama_produk>";
    echo"<harga_produk>",$data['harga_produk'],"</harga_produk>";
    echo"<berat_produk>",$data['berat_produk'],"</berat_produk>";
    echo"<deskripsi_produk>",$data['deskripsi_produk'],"</deskripsi_produk>";
    echo "</produk>";
    }
    echo "</data>";
?>
