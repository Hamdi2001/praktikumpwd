<?php
    include "config.php";
    
    $sql="select * from produk order by id_produk";
    $tampil = mysqli_query($koneksi,$sql);
    if (mysqli_num_rows($tampil) > 0) {
    $no=1;
    $response = array();
    $response["data"] = array();
    while ($r = mysqli_fetch_array($tampil)) {
    $h['nama_produk'] = $r['nama_produk'];
    $h['harga_produk'] = $r['harga_produk'];
    $h['berat_produk'] = $r['berat_produk'];
    $h['deskripsi_produk'] = $r['deskripsi_produk'];
    array_push($response["data"], $h);
    }
    echo json_encode($response);
    }
    else {
    $response["message"]="tidak ada data";
    echo json_encode($response);
    }
?>