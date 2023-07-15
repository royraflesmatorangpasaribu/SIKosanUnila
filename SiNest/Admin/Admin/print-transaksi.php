<?php
include '../SESSION-Login/session-cek.php'
?>

<?php
include '../SESSION-Login/koneksi.php';

// Memanggil kolom yang ada pada tabel driver_log
$query_mysql = mysqli_query($mysqli, "SELECT * FROM history_transaksi");
$no = 1;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Fonts Google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="../img/favicon.ico" type="image/x-icon">

    <!-- CSS Template -->
    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Bootsrtap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">


    <title>SINest</title>
    <style>
        /* Gaya CSS untuk tampilan cetak */
        body {
            background-image: url(../img/loginimage.png);
            backdrop-filter: blur(60px);
            margin: 0;
            padding: 0;
        }

        .container {
            padding: 20px;
        }

        table {
            font-size: 12px;
            width: 100%;
            border-collapse: collapse;
            padding: 20px;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1><img src="../img/logosinest.png" alt="" width="100px">
            <center>History Data Transaksi SINest</center>
        </h1><br>
        <hr>
        <table class="table table-hover table-responsive">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>ID Transaksi</th>
                    <th>Nama Penyewa</th>
                    <th>Nama Kos</th>
                    <th>Tanggal Masuk</th>
                    <th>Tanggal Keluar</th>
                    <th>Harga Kos</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($result = mysqli_fetch_assoc($query_mysql)) { ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?= $result['id_transaksi']; ?></td>
                        <td><?= $result['nama_penyewa']; ?></td>
                        <td><?= $result['nama_kos']; ?></td>
                        <td><?= $result['tanggal_masuk']; ?></td>
                        <td><?= $result['tanggal_keluar']; ?></td>
                        <td><?= $result['harga_kos']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <br>
        <button type="button" class="btn btn-light" style="background-color: #294354; color: white;" onclick="window.location.href = 'download-transaksi.php';">Download</button>
    </div>

    <!-- Bootsrtap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>