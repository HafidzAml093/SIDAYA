<?php
// Koneksi database
include 'koneksi.php';

// Menangkap data yang dikirim dari form
$id = $_POST['id'];
$nama = $_POST['nama'];
$umur = $_POST['umur'];
$alamat = $_POST['alamat'];

// Update data ke database
$query = "UPDATE kantor SET nama='$nama', umur='$umur', alamat='$alamat' WHERE id='$id'";
$result = mysqli_query($koneksi, $query);

// Mengecek apakah query berhasil
if ($result) {
    // Mengalihkan halaman kembali ke index.php
    header("Location: index.php");
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
}

// Menutup koneksi database
mysqli_close($koneksi);
?>