<?php include 'layout/header.php'?>



<!-- Content Row -->
<div class="container">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-4 text-gray-800 bold">HALAMAN TAMBAH</h1>
    </div>

    <form method="post" action="tambah_aksi.php" enctype="multipart/form-data">
            
        <div class="mb-3">
            <label for="nama" class="form-label">NAMA</label>
            <input type="text" class="form-control" id="nama" placeholder="NAMA" name="nama">
        </div>
        <div class="mb-3">
            <label for="umur" class="form-label">UMUR</label>
            <input type="text" class="form-control" id="umur" placeholder="UMUR" name="umur">
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea class="form-control" id="alamat" rows="3" name="alamat"> </textarea>
        </div>
        <div class="mb-3">
            <label for="file" class="form-label">FILE</label>
            <input type="file" class="form-control" id="file" placeholder="FILE" name="berkas" accept="application/pdf">
        </div>
        <a href="index.php"><button type="button" class="btn btn-danger mb-2">BATAL</button></a>
        <button type="submit" class="btn btn-success mb-2">TAMBAH</button>

    </form>
</div>