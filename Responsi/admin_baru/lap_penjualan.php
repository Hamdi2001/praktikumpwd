<?php
// memanggil library FPDF
require('fpdf/fpdf.php');
// intance object dan memberikan pengaturan halaman PDF
$pdf = new FPDF('l','mm','A5');
// membuat halaman baru
$pdf->AddPage();
// setting jenis font yang akan digunakan
$pdf->SetFont('Arial','B',16);
// mencetak string 
$pdf->Cell(190,7,'TOKO ONLINE',0,1,'C');
$pdf->SetFont('Arial','B',12);
$pdf->Cell(190,7,'DAFTAR PEMBELIAN TOKO ONLINE',0,1,'C');
// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(10,7,'',0,1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(50,6,'NAMA PELANGGAN',1,0);
$pdf->Cell(50,6,'TANGGAL',1,0);
$pdf->Cell(30,6,'TOTAL',1,1);
$pdf->SetFont('Arial','',10);
include 'config.php';
$penjualan = mysqli_query($koneksi, "select * from pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan");
while ($row = mysqli_fetch_array($penjualan)){
 $pdf->Cell(50,6,$row['nama_pelanggan'],1,0);
 $pdf->Cell(50,6,$row['tanggal_pembelian'],1,0);
 $pdf->Cell(30,6,$row['total_pembelian'],1,1);
}
$pdf->Output();
?>