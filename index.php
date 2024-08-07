
<?php include 'layout/header.php'; ?>

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 bold">Dashboard</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
        </a>
    </div>

    <div class="container">
        <a href="tambah.php"><button type="button" class="btn btn-success mb-2">Tambah DATA</button></a>

        <!-- Form Pagination -->
        <form method="GET" action="index.php" class="form-inline mb-3">
            <input type="text" class="form-control mr-2" name="kata_cari" placeholder="Cari data..." value="<?php echo isset($_GET['kata_cari']) ? $_GET['kata_cari'] : ''; ?>">
            <button type="submit" class="btn btn-primary">Cari</button>
            <label class="ml-3">Show</label>
            <select name="batas" class="form-control ml-2" onchange="this.form.submit()">
                <option value="10" <?php echo (isset($_GET['batas']) && $_GET['batas'] == 10) ? 'selected' : ''; ?>>10</option>
                <option value="25" <?php echo (isset($_GET['batas']) && $_GET['batas'] == 25) ? 'selected' : ''; ?>>25</option>
                <option value="50" <?php echo (isset($_GET['batas']) && $_GET['batas'] == 50) ? 'selected' : ''; ?>>50</option>
                <option value="100" <?php echo (isset($_GET['batas']) && $_GET['batas'] == 100) ? 'selected' : ''; ?>>100</option>
            </select>
        </form>

        <table class="table table-striped" id="dataTable">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>NAMA</th>
                    <th>UMUR</th>
                    <th>ALAMAT</th>
                    <th>FILE</th>
                    <th>OPSI</th>
                </tr>
            </thead>

            <tbody>
                <?php 
                $no = 1;
                // Untuk menyambungkan dengan file koneksi.php
                include('koneksi.php');

                // Pagination
                $batas = isset($_GET['batas']) ? (int)$_GET['batas'] : 10;
                $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
                $halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

                $previous = $halaman - 1;
                $next = $halaman + 1;

                // Jika kita klik cari, maka yang tampil query cari ini
                if (isset($_GET['kata_cari'])) {
                    // Menampung variabel kata_cari dari form pencarian
                    $kata_cari = $_GET['kata_cari'];
                    // Mencari data dengan query
                    $query = "SELECT * FROM kantor WHERE nama LIKE '%$kata_cari%' OR umur LIKE '%$kata_cari%' OR alamat LIKE '%$kata_cari%' ORDER BY nama ASC";
                } else {
                    // Jika tidak ada pencarian, default yang dijalankan query ini
                    $query = "SELECT * FROM kantor ORDER BY nama ASC LIMIT $halaman_awal, $batas";
                }

                $result = mysqli_query($koneksi, $query);
                $jumlah_data = mysqli_num_rows($result);
                $total_halaman = ceil($jumlah_data / $batas);

                if (!$result) {
                    die("Query Error : " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
                }

                // Melakukan perulangan
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $row['nama']; ?></td>
                        <td><?php echo $row['umur']; ?></td>
                        <td><?php echo $row['alamat']; ?></td>
                        <td><?php echo $row['file']; ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $row['id']; ?>"><button type="button" class="btn btn-warning">EDIT</button></a>
                            <a href="hapus.php?id=<?php echo $row['id']; ?>"><button type="button" class="btn btn-danger">HAPUS</button></a>
                        </td>
                    </tr>
                <?php 
                }

                // Jika jumlah data kurang dari batas yang ditentukan, tambahkan baris kosong
                if ($jumlah_data < $batas) {
                    for ($i = $jumlah_data + 1; $i <= $batas; $i++) {
                ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                <?php
                    }
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>NO</th>
                    <th>NAMA</th>
                    <th>UMUR</th>
                    <th>ALAMAT</th>
                    <th>FILE</th>
                    <th>OPSI</th>
                </tr>
            </tfoot>

        </table>

        <a href="admin_pdf.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i> Generate PDF
        </a>
        <a href="admin_excel.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i> Generate Excel
        </a>

        <!-- Pagination -->
       

    </div>
</div>

<!-- Footer -->
<?php include 'layout/footer.php'; ?>
<!-- End of Footer -->

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>

</body>
</html>