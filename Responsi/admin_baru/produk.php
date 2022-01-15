<h2>Data Produk</h2>
<a href="produk_json.php" class="btn btn-primary">Lihat Produk JSON</a>
<a href="produk_xml.php" class="btn btn-primary">Lihat Produk XML</a>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Produk</th>
            <th>Harga Produk</th>
            <th>Berat</th>
            <th>Foto</th>
            <th>Deskripsi Produk</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $nomor=1; ?>
        <?php $ambil=$koneksi->query("SELECT * FROM produk"); ?>
        <?php while($tampil = $ambil->fetch_assoc()){ ?>
        <tr>
            <td><?php echo $nomor ?></td>
            <td><?php echo $tampil['nama_produk']; ?></td>
            <td><?php echo $tampil['harga_produk']; ?></td>
            <td><?php echo $tampil['berat_produk']; ?></td>
            <td>
                <img src="../photo/<?php echo $tampil['foto_produk']; ?>" width="100">
            </td>
            <td><?php echo $tampil['deskripsi_produk']; ?></td>
            <td>
                <a href="index.php?halaman=hapusproduk&id=<?php echo $tampil['id_produk'] ?>" class="btn-danger btn">Hapus</a>
                <a href="index.php?halaman=ubahproduk&id=<?php echo $tampil['id_produk'] ?>" class="btn btn-warning">Ubah</a> 
            </td>
        </tr>
        <?php   $nomor++; ?>
        <?php } ?>
    </tbody>
</table>
<a href="index.php?halaman=tambahproduk" class="btn btn-primary">Tambah Data</a>