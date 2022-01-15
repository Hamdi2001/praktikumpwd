<h2>Data Pembelian</h2>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Pelanggan</th>
            <th>Tanggal</th>
            <th>Total</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $nomor=1; ?>
        <?php $ambil=$koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan"); ?>
        <?php while($tampil = $ambil->fetch_assoc()){ ?>
        <tr>
            <td><?php echo $nomor ?></td>
            <td><?php echo $tampil['nama_pelanggan']; ?></td>
            <td><?php echo $tampil['tanggal_pembelian']; ?></td>
            <td><?php echo $tampil['total_pembelian']; ?></td>
            <td>
                <a href="index.php?halaman=detail&id=<?php echo $tampil['id_pembelian']; ?>" class="btn btn-info">Detail</a>
            </td>
        </tr>
        <?php   $nomor++; ?>
        <?php } ?>
        <a href="lap_penjualan.php">Download Data Pembelian</a>
    </tbody>
</table>