<?php
include '../SESSION-Login/session-cek.php'
?>

<?php
include '../SESSION-Login/koneksi.php';

// Memanggil kolom yang ada pada tabel driver
$query_mysql = mysqli_query($mysqli, "SELECT * FROM riwayat_kos WHERE tipe_kos = 'Putra';
");
$no = 1;

// Saat tombol Delete ditekan maka data akan dihapus setelah dikonfirmasi
if (isset($_POST['hapus'])) {
    $id_kos = $_POST['hapus'];

    // Mengambil informasi foto dari database berdasarkan ID driver
    $sql_select = "SELECT foto FROM riwayat_kos WHERE id_kos = $id_kos";
    $result_select = mysqli_query($mysqli, $sql_select);
    $row_select = mysqli_fetch_assoc($result_select);
    $namaFoto = $row_select['foto'];

    // Menghapus data berdasarkan kolom yang dipilih
    $sql_delete = "DELETE FROM riwayat_kos WHERE id_kos = $id_kos";
    if (mysqli_query($mysqli, $sql_delete)) {
        // Menghapus file foto dari folder uploadimg
        $target_file = "../Pemilik/uploadimg/" . $namaFoto;
        if (file_exists($target_file)) {
            unlink($target_file);
            echo "Data berhasil dihapus.";
        } else {
            echo "Data berhasil dihapus, tetapi file foto tidak ditemukan.";
        }
    } else {
        echo "Error: " . $sql_delete . "<br>" . mysqli_error($mysqli);
    }
}
?>

<!-- Melakukan Proses Hapus data berdasarkan data yang dipilih -->
<?php
if (isset($_GET['hapus'])) {
    $id_kos = $_GET['hapus'];

    // Mengambil informasi foto dari database berdasarkan ID driver
    $sql_select = "SELECT foto FROM riwayat_kos WHERE id_kos = $id_kos";
    $result_select = mysqli_query($mysqli, $sql_select);
    $row_select = mysqli_fetch_assoc($result_select);
    $namaFoto = $row_select['foto'];

    // Menghapus data berdasarkan kolom yang dipilih
    $sql_delete = "DELETE FROM riwayat_kos WHERE id_kos = $id_kos";
    if (mysqli_query($mysqli, $sql_delete)) {
        // Menghapus file foto dari folder uploadimg
        $target_file = "../Pemilik/uploadimg/" . $namaFoto;
        if (file_exists($target_file)) {
            unlink($target_file);
            echo "<p><b>Data deleted successfully</b></p>";
            echo "<meta http-equiv=refresh content=2;URL='pem.php'>";
        } else {
            echo "<p><b>Data deleted successfully, but the photo file was not found</b></p>";
            echo "<meta http-equiv=refresh content=2;URL='pem.php'>";
        }
    } else {
        echo "Error: " . $sql_delete . "<br>" . mysqli_error($mysqli);
    }
}
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

    <!-- Vendor CSS Files -->
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet">

    <!-- Bootsrtap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">

    <!-- icon -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <title>SINest</title>

    <style>
        span {
            color: black;
        }

        body {
            margin-top: 20px;
            background-color: #f5f7fa;
        }

        .mb-4x {
            margin-bottom: 24px;
        }

        .mt-4x {
            margin-top: 24px;
        }

        .bg-white {
            background-color: #fff !important;
            color: rgba(22, 24, 27, 0.87);
        }

        .panel {
            border: none;
            box-shadow: 0 1px 3px -1px rgba(22, 24, 27, 0.26);
            transition: background-color 250ms ease, opacity 250ms linear;
        }

        .panel-default {
            border-color: rgba(22, 24, 27, 0.12);
        }

        .corner-all,
        .corner-right,
        .corner-top,
        .corner-tr {
            border-top-right-radius: 2px;
        }

        .corner-all,
        .corner-left,
        .corner-tl,
        .corner-top {
            border-top-left-radius: 2px;
        }

        .embed-responsive-16by9 {
            padding-bottom: 56.25%;
        }

        .bg-grd-dark,
        .bg-grd-inverse {
            background: linear-gradient(45deg, #0a0213 0, rgba(10, 2, 19, 0) 70%),
                linear-gradient(135deg, #07252c 10%, rgba(7, 37, 44, 0) 80%),
                linear-gradient(225deg, #031b49 10%, rgba(3, 27, 73, 0) 80%),
                linear-gradient(315deg, #100462 100%, rgba(16, 4, 98, 0) 70%);
        }

        .embed-overlay {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            opacity: 0.6;
            filter: alpha(opacity=60);
        }

        .embed-extend-item {
            position: relative;
            padding: 0 15px 5px;
        }

        .embed-extend-item>.kit-avatar.kit-avatar-96 {
            margin-top: -48px;
        }

        .embed-extend-item>.kit-avatar.pull-left {
            margin-right: 10px;
        }

        .embed-extend-item>.kit-avatar {
            position: relative;
            padding: 0;
        }

        .kit-avatar.kit-avatar-96 {
            border: 3px solid rgba(22, 24, 27, 0.12);
            border-radius: 96px;
        }

        .embed-extend-item a,
        .embed-extend-item a:hover {
            color: inherit;
            text-decoration: none;
        }

        .kit-avatar.kit-avatar-96>img {
            width: 96px;
            height: auto;
            border-radius: 48px;
        }

        .embed-extend-item h3,
        .embed-extend-item h4,
        .embed-extend-item h5,
        .embed-extend-item h6 {
            margin: 0;
            padding-top: 3px;
        }

        .embed-extend-item h3>small,
        .embed-extend-item h4>small,
        .embed-extend-item h5>small,
        .embed-extend-item h6>small {
            display: block;
            color: rgba(22, 24, 27, 0.54);
        }

        .body-text,
        .headline,
        .subhead,
        .title {
            color: rgba(22, 24, 27, 0.87);
        }

        .h4,
        .subhead,
        h4 {
            font-size: 16px;
            font-weight: 400;
            line-height: 24px;
        }

        .bordered,
        .bordered-right {
            border-right: 1px solid rgba(22, 24, 27, 0.12) !important;
        }

        a {
            text-decoration: none;
        }

        .status-kos {
            position: absolute;
            top: -20px;
            right: 0;
            margin-left: 10px;
        }

        #card-style {
            background-color: #D9D9D9;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <?php
    include 'sidebar-penyewa2.php'
    ?>

    <main id="main" class="main">
        <!-- Profile Start -->
        <section class="section">
            <!-- Card with an image on top -->
            <div class="row row-cols-1 row-cols-md-2 g-4">
                <?php while ($result = mysqli_fetch_assoc($query_mysql)) { ?>
                    <div class="col">
                        <!-- Pengecekan Apakah Kos sudah di huni atau belum -->
                        <?php if ($result['status_kos'] == 'Tersedia') { ?>
                            <a href="sewa-kos.php?update=<?php echo $result['id_kos']; ?>">
                            <?php } ?>

                            <div class="card" id="card-style">
                                <img src="../Pemilik/uploadimg/<?php echo $result['foto']; ?>" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $result['nama_kos']; ?></h5>

                                    <!-- Status Kos Start -->
                                    <div class="status-kos">
                                        <?php if ($result['status_kos'] == 'Tersedia') { ?>
                                            <h5 class="card-title"><button type="button" class="btn btn-info"><i class="bi bi-check-circle"></i> <?php echo $result['status_kos']; ?></button></h5>
                                        <?php } else { ?>
                                            <h5 class="card-title"><button type="button" class="btn btn-danger"><i class="bi bi-exclamation-octagon"></i> <?php echo $result['status_kos']; ?></button></h5>
                                        <?php } ?>
                                    </div>
                                    <!-- Status Kos End -->

                                    <!-- Tipe Kos Start -->
                                    <?php if ($result['tipe_kos'] == 'Putra') { ?>
                                        <h5 class="card-title"><button type="button" class="btn btn-success"><?php echo $result['tipe_kos']; ?></button></h5>
                                    <?php } else if ($result['tipe_kos'] == 'Putri') { ?>
                                        <h5 class="card-title"><button type="button" class="btn btn-danger" style="background-color: #FF8E8E"><?php echo $result['tipe_kos']; ?></button></h5>
                                    <?php } else { ?>
                                        <h5 class="card-title"><button type="button" class="btn btn-primary"><?php echo $result['tipe_kos']; ?></button></h5>
                                    <?php } ?>
                                    <!-- Tipe Kos End -->

                                    <p class="card-text"><?php echo $result['lokasi_kos']; ?></p>
                                    <h5 class="card-title">Rp <?php echo $result['harga_kos']; ?>/Tahun</h5>
                                </div>
                            </div>
                            <!-- Pengecekan Apakah Kos sudah di huni atau belum -->
                            <?php if ($result['status_kos'] == 'Tersedia') { ?>
                            </a>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </section>
        <!-- Profile End -->
    </main>
    <!-- Main Menu End -->

    <!-- Bootsrtap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Vendor JS Files -->
    <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/chart.js/chart.umd.js"></script>
    <script src="../assets/vendor/echarts/echarts.min.js"></script>
    <script src="../assets/vendor/quill/quill.min.js"></script>
    <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="../assets/js/main.js"></script>

</body>

</html>