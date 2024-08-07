<?php
//mengaktifkan session pada php
session_start();

//menghubungkan php dengan koneksi database
include 'koneksi.php';

//menagkap data yang dikirim dari form login
$username = $_POST['username'];
$password = $_POST['password'];


//menyeleksi data user dengan username dan password yang sesuai
$login = mysqli_query($koneksi, "select * from user where username='$username' and password='$password'");
//menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($login);

// cek apakah username dan password ditemukan pada database
if ($cek > 0) {
    
    $data = mysqli_fetch_assoc($login);

    //cek jika user login sebagai admin
    if ($data['level'] == "admin") {

        //buat session login dan username
        $_SESSION['username'] = $username;
        $_SESSION['level'] = "admin";
        $_SESSION['status'] = "login";
        //alihkan ke halaman dashboard admin
        header("location:index.php");

        //cek jika user login sebagai mahasiswa
    } else if ($data['level'] == "karyawan"){
        //buat session login dan username
        $_SESSION['username'] = $username;
        $_SESSION['level'] = "karyawan";
        $_SESSION['status'] = "login";
        //alihkan ke halaman dashboard mahasiswa
        header("location:index_mhs.php");
    } else{

        //alihkan ke halaman login kembali
        header("location:login.php?pesan=gagal");
    }
} else {
    header("location:login.php?pesan=gagal");
}