<!DOCTYPE html>
<html>

<head>
    <title>Export Data Ke Excel</title>
</head>

<body>
    <style type="text/css">
        body {
            font-family: sans-serif;
        }

        table {
            margin: 20px auto;
            border-collapse: collapse;
        }

        table th,
        table td{
            border: 1px solid #3c3c3c;
            padding: 3px 8px;
        }

        a{
            background: blue;
            color: #fff;
            padding: 8px 10px;
            text-decoration: none;
            border-radius: 2px;
        }
    </style>

    <?php
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=Data karyawan.xls");
    ?>

    <center>
        <h3>Export Data Ke Excel Dengan PHP </h3>
    </center>

    <table boder="1">
        <tr>
            <th>No</th>
            <th>NAMA</th>
            <th>UMUR</th>
            <th>ALAMAT</th>
        </tr>
        <?php
        //koneksi database
        include 'koneksi.php';
        //menampilkan data pegawai
        $data = mysqli_query($koneksi, "select * from kantor");
        $no = 1;
        while ($d = mysqli_fetch_array($data)){
        ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $d['nama']; ?></td>
                <td><?php echo $d['umur']; ?></td>
                <td><?php echo $d['alamat']; ?></td>
            </tr>   
        <?php 
        }
        ?>
    </table>
</body>