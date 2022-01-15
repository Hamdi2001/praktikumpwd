<h2>Ubah Produk</h2>
<?php 
  $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
  $tampilan = $ambil->fetch_assoc();
?>

<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>Nama</label>
        <input type="text" class="form-control" name="nama" value="<?php echo $tampilan['nama_produk'] ?>">
    </div>
    <div class="form-group">
        <label>Harga</label>
        <input type="number" class="form-control" name="harga" value="<?php echo $tampilan['harga_produk'] ?>">
    </div>
    <div class="form-group">
        <label>Berat</label>
        <input type="number" class="form-control" name="berat" value="<?php echo $tampilan['berat_produk'] ?>">
    </div>
    <div class="form-group">
        <label>Foto</label>
        <img src="../photo/<?php echo $tampilan['foto_produk'] ?>" width="200">
    </div>
    <div class="form-group">
        <label>Ganti Foto</label>
        <input type="file" class="form-control" name="foto">
    </div>
    <div class="form-group">
        <label>Deskripsi</label>
        <textarea class="form-control" name="deskripsi" rows="10"><?php echo $tampilan['deskripsi_produk'];?></textarea>
    </div>
    <button class="btn btn-primary" name="ubah">Ubah</button>
</form>

<?php 
    if(isset($_POST['ubah'])){
        $namafoto = $_FILES['foto']['name'];
        $lokasifoto = $_FILES['foto']['tmp_name'];
        
        if (!empty($lokasifoto)) {
            move_uploaded_file($lokasifoto, "../photo/".$namafoto);

            $koneksi->query("UPDATE produk SET 
            nama_produk = '$_POST[nama]', harga_produk = '$_POST[harga]', berat_produk = '$_POST[berat]', 
            foto_produk = '$namafoto', deskripsi_produk = '$_POST[deskripsi]' WHERE id_produk='$_GET[id]'");
        }else{
            $koneksi->query("UPDATE produk SET 
            nama_produk = '$_POST[nama]', harga_produk = '$_POST[harga]', berat_produk = '$_POST[berat]', 
            foto_produk = '$namafoto', deskripsi_produk = '$_POST[deskripsi]' WHERE id_produk='$_GET[id]'");
        }
        echo "<script>alert('Data Produk telah diubah');</script>";
        echo "<script>location='index.php?halaman=produk';</script>";
    }
?>