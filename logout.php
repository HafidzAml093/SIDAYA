
<?php
//mengaktifkan session
session_start();

//menghapus semua session
session_destroy();

//mengalihkan ke halaman login
header("location:login.php?pesan=logout");
?>