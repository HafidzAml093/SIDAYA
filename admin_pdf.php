<?php
//memanggil library pdf
require('library/fpdf.php');
include 'koneksi.php';

// intance object dan memberikan pengaturan halaman PDF
$pdf = new FPDF('p', 'mm', 'A4');
$pdf->AddPage();

$pdf->SetFont('Arial', 'B', 13);
$pdf->Cell(200, 10, 'DATA MAHASISWA', 0, 0, 'C');

$pdf->Cell(10, 15, '', 0, 1);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(10, 7, 'NO', 1, 0, 'C');
$pdf->Cell(50, 7, 'NIM', 1, 0, 'C');
$pdf->Cell(75, 7, 'NAMA', 1, 0, 'C');
$pdf->Cell(55, 7, 'ALAMAT', 1, 0, 'C');


$pdf->Cell(10, 7, '', 0, 1);
$pdf->SetFont('Arial', '', 10);
$no = 1;
$data = mysqli_query($koneksi, "SELECT * FROM kantor");
while ($d = mysqli_fetch_array($data)) {
    $pdf->Cell(10, 6, $no++, 1, 0, 'C');
    $pdf->Cell(50, 6, $d['nama'], 1, 0);
    $pdf->Cell(75, 6, $d['umur'], 1, 0,);
    $pdf->Cell(55, 6, $d['alamat'], 1, 1);
}

$pdf->Output();

?>
