<h2>Data Pelanggan</h2>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Telpon</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $nomor=1; ?>
        <?php $ambil=$koneksi->query("SELECT * FROM pelanggan"); ?>
        <?php while($tampil = $ambil->fetch_assoc()){ ?>
        <tr>
            <td><?php echo $nomor ?></td>
            <td><?php echo $tampil['nama_pelanggan']; ?></td>
            <td><?php echo $tampil['email_pelanggan']; ?></td>
            <td><?php echo $tampil['telepon_pelanggan']; ?></td>
            <td>
                <a href="" class="btn-danger btn">Hapus</a>
            </td>
        </tr>
        <?php   $nomor++; ?>
        <?php } ?>
    </tbody>
</table>